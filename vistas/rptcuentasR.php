<?php
session_start();
if (isset($_SESSION['usuId'])){
			$usuario = $_SESSION['usuId'];
			$base = 'pizzeria';
}else{
			header('Location:../index.php');
}
	
	require('../controlador/ajustar_rptcuentasH.php');
	include("../modelo/rptcuentasH.class.php");
	$objeto = new rptcuentasH;
	$objeto->con->BaseDatos = $base;
	

	foreach ($_GET as $variable => $valor){
			  $$variable = htmlspecialchars($valor);
	}
    
	$_POST['tipo']=$tipo;
	

	$data = $objeto->consultar_basicosR($cuenta,$tipo);
	$data1 = $objeto->consultarR($mesa,$tipo);
	

    $pdf=new PDF_MC_Table($orientation='L',$unit='mm',$format='letter');
	$pdf->AliasNbPages(); 
	$pdf->AddPage();

//**************************************************************IMPRIMIR CONSULTA***************************************************************************************
	if($tipo=='1'){
			foreach($data as $row){
			
				
					$desc = number_format($row['cuentarMontoDescuentoD'],2,',','.');
					$rec = number_format($row['cuentarMontoRecargaD'],2,',','.');
					$tot = number_format($row['cuentarMontoTotalMovimiento'],2,',','.');
					
					$columns = array(); 
					$col = array();
				
					$col[]   = array('text' => utf8_decode('Mesa # ').$row['registrorNumMesas'], 'width' => '114', 'height' => '5', 'align' => 'L', 'font_name' => 'Arial', 'font_size' => '12', 'font_style' => '', 'fillcolor' => '240,240,240', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => 'LTBR');
					
					$col[]   = array('text' => 'Descuento: '.$desc, 'width' => '47', 'height' => '5', 'align' => 'R', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => '', 'fillcolor' => '240,240,240', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => 'LTBR');
					$col[]   = array('text' => 'Recarga: '.$rec,    'width' => '47', 'height' => '5', 'align' => 'R', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => '', 'fillcolor' => '240,240,240', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => 'LTBR');
					$col[]   = array('text' => 'Total: '.$tot,        'width' => '50', 'height' => '5', 'align' => 'R', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => '', 'fillcolor' =>'240,240,240', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => 'LTBR');

					
					$columns[] = $col;
					$pdf->SetX(8);
					$pdf->WriteTable($columns);
														
			}
			
			$pdf->Ln(5);
			
					$columns = array(); 
					$col = array();
				
					$col[]   = array('text' => 'CONSUMOS RESTURANTE',  'width' => '258', 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '240,240,240', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => 'LTBR');
					
					
					$columns[] = $col;
					$pdf->SetX(8);
					$pdf->WriteTable($columns);
			
					$columns = array(); 
					$col = array();
				
					$col[]   = array('text' => 'Servicio',   'width' => '153', 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '240,240,240', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => 'LTBR');
					$col[]   = array('text' => 'Cantidad',   'width' => '35', 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '240,240,240', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => 'LTBR');
					$col[]   = array('text' => 'Precio',     'width' => '35', 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '240,240,240', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => 'LTBR');
					$col[]   = array('text' => 'Monto',      'width' => '35', 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '240,240,240', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => 'LTBR');

					
					$columns[] = $col;
					$pdf->SetX(8);
					$pdf->WriteTable($columns);
					
			$sumh = 0;	 $sumr = 0;	
			
			foreach($data1 as $row){
				
					$precr = number_format($row['controlPrecioPlato'],2,',','.');
					$montor = number_format($row['controlTotal'],2,',','.');
					$cantr = $row['controlCantPlato'];
					
					
					$sumr = $sumr + $row['controlTotal'];
								
					
					$columns = array(); 
					$col = array();
				
					
					$col[]   = array('text' => utf8_decode($row['controlDescripPlato']),     'width' => '153', 'height' => '5', 'align' => 'L', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => 'LTBR');
					$col[]   = array('text' => $cantr,                          'width' => '35', 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => 'LTBR');
					$col[]   = array('text' => $precr,                          'width' => '35', 'height' => '5', 'align' => 'R', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => 'LTBR');
					$col[]   = array('text' => $montor,                         'width' => '35', 'height' => '5', 'align' => 'R', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => 'LTBR');

					
					$columns[] = $col;
					$pdf->SetX(8);
					$pdf->WriteTable($columns);
								
			}
					$columns = array(); 
					$col = array();
				
				
					$col[]   = array('text' => 'Total:  '.number_format($sumr,2,',','.'),   'width' => '258', 'height' => '5', 'align' => 'R', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => 'LTBR');
			

					
					$columns[] = $col;
					$pdf->SetX(8);
					$pdf->WriteTable($columns);
		}else{
			foreach($data as $row){
			
				
					$desc = number_format($row['cuentarMontoDescuentoD'],2,',','.');
					$rec = number_format($row['cuentarMontoRecargaD'],2,',','.');
					$tot = number_format($row['cuentarMontoTotalMovimiento'],2,',','.');
					
					$columns = array(); 
					$col = array();
				
					$col[]   = array('text' => utf8_decode('Mesa # ').$row['registrorNumMesas'], 'width' => '114', 'height' => '5', 'align' => 'L', 'font_name' => 'Arial', 'font_size' => '12', 'font_style' => '', 'fillcolor' => '240,240,240', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => 'LTBR');
					
					$col[]   = array('text' => 'Descuento: '.$desc, 'width' => '47', 'height' => '5', 'align' => 'R', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => '', 'fillcolor' => '240,240,240', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => 'LTBR');
					$col[]   = array('text' => 'Recarga: '.$rec,    'width' => '47', 'height' => '5', 'align' => 'R', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => '', 'fillcolor' => '240,240,240', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => 'LTBR');
					$col[]   = array('text' => 'Total: '.$tot,        'width' => '50', 'height' => '5', 'align' => 'R', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => '', 'fillcolor' =>'240,240,240', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => 'LTBR');

					
					$columns[] = $col;
					$pdf->SetX(8);
					$pdf->WriteTable($columns);
					
					
					$pdf->Ln(5);
			
					$columns = array(); 
					$col = array();
				
					$col[]   = array('text' => 'CONSUMOS RESTURANTE',  'width' => '258', 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '240,240,240', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => 'LTBR');
					
					
					$columns[] = $col;
					$pdf->SetX(8);
					$pdf->WriteTable($columns);
			
					$columns = array(); 
					$col = array();
				
					$col[]   = array('text' => 'Servicio',   'width' => '153', 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '240,240,240', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => 'LTBR');
					$col[]   = array('text' => 'Cantidad',   'width' => '35', 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '240,240,240', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => 'LTBR');
					$col[]   = array('text' => 'Precio',     'width' => '35', 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '240,240,240', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => 'LTBR');
					$col[]   = array('text' => 'Monto',      'width' => '35', 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '240,240,240', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => 'LTBR');

					
					$columns[] = $col;
					$pdf->SetX(8);
					$pdf->WriteTable($columns);
					
			   $sumh = 0;	 $sumr = 0;	
			   $data1 = $objeto->consultarR($row['registrorNumMesas'],$tipo='1');
			   
				foreach($data1 as $row1){
					
						$precr = number_format($row1['controlPrecioPlato'],2,',','.');
						$montor = number_format($row1['controlTotal'],2,',','.');
						$cantr = $row1['controlCantPlato'];
						
						
						$sumr = $sumr + $row1['controlTotal'];
									
						
						$columns = array(); 
						$col = array();
					
						
						$col[]   = array('text' => utf8_decode($row1['controlDescripPlato']),     'width' => '153', 'height' => '5', 'align' => 'L', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => 'LTBR');
						$col[]   = array('text' => $cantr,                          'width' => '35', 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => 'LTBR');
						$col[]   = array('text' => $precr,                          'width' => '35', 'height' => '5', 'align' => 'R', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => 'LTBR');
						$col[]   = array('text' => $montor,                         'width' => '35', 'height' => '5', 'align' => 'R', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => 'LTBR');

						
						$columns[] = $col;
						$pdf->SetX(8);
						$pdf->WriteTable($columns);
									
				}
					$columns = array(); 
					$col = array();
				
				
					$col[]   = array('text' => 'Total:  '.number_format($sumr,2,',','.'),   'width' => '258', 'height' => '5', 'align' => 'R', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => 'LTBR');
			

					
					$columns[] = $col;
					$pdf->SetX(8);
					$pdf->WriteTable($columns);
					
					$pdf->Ln(8);
														
			}
			
			
			
		}

	    $pdf->Output();
		//$pdf->Output('Cuenta.pdf','D');
?>