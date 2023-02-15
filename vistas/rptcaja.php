<?php
session_start();
if (isset($_SESSION['usuId'])){
			$usuario = $_SESSION['usuId'];
			$base = 'pizzeria';
}else{
			header('Location:../index.php');
}
	
	require('../controlador/ajustar_rptcaja.php');
	include("../modelo/rptcuentasH.class.php");
	$objeto = new rptcuentasH;
	$objeto->con->BaseDatos = $base;
	
     
	foreach ($_GET as $variable => $valor){
			  $$variable = htmlspecialchars($valor);
	}

	//var datos="fechai="+fechai+"&fechac="+fechac+"&tipo=Hospedaje";
	$fdesde = $objeto->convertirFecha($fechai);
	$fhasta = $objeto->convertirFecha($fechac);
	
	$_POST['fechai'] = $fechai;
	$_POST['fechac'] = $fechac;
	$_POST['tipo'] = $tipo;

	$data1 = $objeto->consultarcaja($fdesde,$fhasta,$tipo);

    $pdf=new PDF_MC_Table($orientation='L',$unit='mm',$format='letter');
	$pdf->AliasNbPages(); 
	$pdf->AddPage();

//**************************************************************IMPRIMIR CONSULTA***************************************************************************************

 	foreach($data1 as $row){	

            	/*movimiento_caja_restaurante.movimcajarFechaF as fecha,
							movimiento_caja_restaurante.movimcajarDescEgres as egreso,
							movimiento_caja_restaurante.movimcajarMontoD as monto,
							movimiento_caja_restaurante.movimcajarObserC as observ,
							movimiento_caja_restaurante.movimcajarDescPago as ingreso*/	

	      	$mon = number_format($row['monto'],2,',','.');
							
			$f = $objeto->convertirFecha($row['fecha']);
			
			$columns = array(); 
			$col = array();
					
			$col[]   = array('text' => $f,               'width' => '35', 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => 'LTBR');
			$col[]   = array('text' => utf8_decode($row['egreso']),   'width' => '60', 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => 'LTBR');
			$col[]   = array('text' => utf8_decode($row['ingreso']),  'width' => '72', 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => 'LTBR');
			$col[]   = array('text' => $mon,             'width' => '35', 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => 'LTBR');
			$col[]   = array('text' => utf8_decode($row['observ']),   'width' => '60', 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => 'LTBR');
		    
	
			/*$col[] = array('text' => 'EGREO', 'width' => '60', 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '9.5', 'font_style' => '', 'fillcolor' => '240,240,240', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => 'LTBR');
			$col[] = array('text' => 'INGRESO', 'width' => '72', 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '9.5', 'font_style' => '', 'fillcolor' => '240,240,240', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => 'LTBR');
			$col[] = array('text' => 'MONTO', 'width' => '35', 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '9.5', 'font_style' => '', 'fillcolor' => '240,240,240', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => 'LTBR');
			
			$col[] = array('text' => 'OBSERVACIÓN', 'width' => '60', 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '9.5', 'font_style' => '', 'fillcolor' => '240,240,240', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => 'LTBR');
		*/
			
			$columns[] = $col;
			$pdf->SetX(8);
			$pdf->WriteTable($columns);
							
	}


	    $pdf->Output();
		//$pdf->Output('Pagos.pdf','D');
?>