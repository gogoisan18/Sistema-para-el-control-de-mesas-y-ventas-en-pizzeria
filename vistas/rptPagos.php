<?php
session_start();
if (isset($_SESSION['usuId'])){
			$usuario = $_SESSION['usuId'];
			$base = 'pizzeria';
}else{
			header('Location:../index.php');
}
	
	require('../controlador/ajustar_rptPagos.php');
	include("../modelo/rptPagos.class.php");
	$objeto = new rptPagos;
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

	$data1 = $objeto->consultar($fdesde,$fhasta,$tipo);

    $pdf=new PDF_MC_Table($orientation='L',$unit='mm',$format='letter');
	$pdf->AliasNbPages(); 
	$pdf->AddPage();

//**************************************************************IMPRIMIR CONSULTA***************************************************************************************
	$sumh = 0;
 	foreach($data1 as $row){
            /*pagos_restaurante.pagosrformaPago as forma,
							pagos_restaurante.pagosrMontoFinalD as monto,
							registro_restaurante.registrorNumMesas as caso,
							pagos_restaurante.pagosrDescuentoMon as desc,
							pagos_restaurante.pagosrRecargaMon as recarg,
							pagos_restaurante.pagosrtipoEmision as emi,
							pagos_restaurante.pagosrFechaF as fecha,
							facturas_restaurante.facturarCedRifC as ced,
							facturas_restaurante.facturarNombreC as nomb*/
							
	
	        if($row['descue']=='0.00'){
				$desc = '';		
			}else{
				$desc = number_format($row['descue'],2,',','.');
			}
			if($row['recarg']=='0.00'){
				$reca = '';		
			}else{
				$reca = number_format($row['recarg'],2,',','.');
			}
			
			$tot = ($row['monto']+$row['recarg'])-$row['descue'];
			
		    $mont = number_format($tot,2,',','.');
						
			$sumh = $sumh + $tot;
					
			$f = $objeto->convertirFecha($row['fecha']);
			
			$columns = array(); 
			$col = array();
					
			$col[]   = array('text' => $row['caso'],             'width' => '25', 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => 'LTBR');
			$col[]   = array('text' => $f,                       'width' => '30', 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => 'LTBR');
			$col[]   = array('text' => $row['emi'],              'width' => '28', 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => 'LTBR');
			$col[]   = array('text' => $row['ced'],              'width' => '30', 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => 'LTBR');
			$col[]   = array('text' => utf8_decode($row['nomb']),'width' => '70', 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => 'LTBR');
		
			$col[]   = array('text' => $desc,                    'width' => '28', 'height' => '5', 'align' => 'R', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => 'LTBR');
			$col[]   = array('text' => $reca,                    'width' => '28', 'height' => '5', 'align' => 'R', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => 'LTBR');
			$col[]   = array('text' => $mont,                    'width' => '28', 'height' => '5', 'align' => 'R', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => 'LTBR');
			
			
			$columns[] = $col;
			$pdf->SetX(8);
			$pdf->WriteTable($columns);
							
	}
	       /* $columns = array(); 
			$col = array();
		
			$col[]   = array('text' => 'Total: '.$mont,   'width' => '267', 'height' => '5', 'align' => 'R', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => 'LTBR');
	*

			
			$columns[] = $col;
			$pdf->SetX(8);
			$pdf->WriteTable($columns);*/

	    $pdf->Output();
		//$pdf->Output('Pagos.pdf','D');
?>