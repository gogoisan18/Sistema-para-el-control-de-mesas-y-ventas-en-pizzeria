<?php
session_start();
	if (isset($_SESSION['usuId'])){
				$usuario = $_SESSION['usuId'];
				$base = 'pizzeria';
	}else{
				header('Location:../index.php');
	}
		
	require('../controlador/ajustar_rptCuentaTHotel.php');
	include_once("../modelo/rptCuentaTHotel.class.php");
	$objeto = new rptCuentaTHotel;
	$objeto->con->BaseDatos = $base;



	foreach ($_GET as $variable => $valor){
			  $$variable = htmlspecialchars($valor);
	}
	
	$idtic=(int)$_SESSION['idtic'];
	
	
	
    $data  = $objeto->consultar_basicos($idtic);
	$data1 = $objeto->consultar($idtic);
	$data2 = $objeto->consultar_RD($idtic);
	$data3 = $objeto->iva();
	
	foreach($data as $row){
		
		$_POST['fechaS'] = $objeto->convertirFecha($row['tikethFechaF']);
		$_POST['cedula'] = $row['tikethCedulaC'];
	
	}
	foreach($data3 as $row){
		
		$_POST['iva'] = $row['ivaPorcen'];
		$iva = $row['ivaPorcen'];
	}
    
	$pdf=new PDF_MC_Table($orientation='P',$unit='mm',$format='factura');
	$pdf->AliasNbPages(); 
	$pdf->AddPage();

    $subt = 0;
	foreach($data1 as $row){
	    $prech = number_format($row['detallehPrecio'],2,',','.');
		
		$canth = $row['detallehCant'];
		$montodeiva = $row['detallehPrecio']*($iva/100);
		$preciosiniva = $row['detallehPrecio']-$montodeiva;
		
		$montodeivax = number_format($montodeiva,2,',','.');
		$preciosinivax = number_format($preciosiniva,2,',','.');
		
		$resul = $row['detallehPrecio']*$row['detallehCant'];
		$montoh = number_format($resul,2,',','.'); 
		
		 
			
		
		$columns = array(); 
		$col = array();

		$col[]   = array('text' => $row['detallehDescripC'], 'width' => '80', 'height' => '3.7', 'align' => 'L', 'font_name' => 'Arial', 'font_size' => '7', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
		$col[]   = array('text' => $canth, 					 'width' => '20', 'height' => '3.7', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '7', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
		$col[]   = array('text' => $preciosinivax,			 'width' => '27', 'height' => '3.7', 'align' => 'R', 'font_name' => 'Arial', 'font_size' => '7', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
		$col[]   = array('text' => $montodeivax,			 'width' => '27', 'height' => '3.7', 'align' => 'R', 'font_name' => 'Arial', 'font_size' => '7', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
		$col[]   = array('text' => $montoh, 				 'width' => '29', 'height' => '3.7', 'align' => 'R', 'font_name' => 'Arial', 'font_size' => '7', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
		
		
		$columns[] = $col;
		$pdf->SetX(8);
		$pdf->WriteTable($columns);
		
		//$subt =	$subt+$preciosiniva;
        
			
	}
	//$pdf->Ln();
	
	foreach($data2 as $row){
	    	
		$recargamonto = number_format($row['cuentahMontoRecargaD'],2,',','.');
		$rec = $row['cuentahMontoRecargaD'];
			
		$descumonto = number_format($row['cuentaMontoDescuentoD'],2,',','.');
		$desc = $row['cuentaMontoDescuentoD'];
	
		$ivadesub = $row['cuentaMontoD']*($iva/100);
		$subsiniva = $row['cuentaMontoD']-$ivadesub;
		
		$subsinivax = number_format($subsiniva,2,',','.');
		$ivadesubx = number_format($ivadesub,2,',','.');
	
		$total = $row['cuentahMontoTotalD'];
		$totalx = number_format($total,2,',','.');
		
		
		    $pdf->Ln(2);
		    $columns = array(); 
			$col = array();

			$col[]   = array('text' =>'SUBTOTAL', 'width' => '154', 'height' => '3.7', 'align' => 'R', 'font_name' => 'Arial', 'font_size' => '7', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
			$col[]   = array('text' =>$subsinivax, 	  'width' => '29', 'height' => '3.7', 'align' => 'R', 'font_name' => 'Arial', 'font_size' => '7', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
						
			$columns[] = $col;
			$pdf->SetX(8);
			$pdf->WriteTable($columns);

			$ivax = number_format($iva,2,',','.');
			
			$columns = array(); 
			$col = array();

			$col[]   = array('text' =>'I.V.A ('.$ivax.'%)','width' => '154', 'height' => '3.7', 'align' => 'R', 'font_name' => 'Arial', 'font_size' => '7', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
			$col[]   = array('text' =>$ivadesubx, 	       'width' => '29', 'height' => '3.7', 'align' => 'R', 'font_name' => 'Arial', 'font_size' => '7', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
						
			$columns[] = $col;
			$pdf->SetX(8);
			$pdf->WriteTable($columns);
					
	}
	
	    if($rec!='0.00'){
	   
		    $columns = array(); 
			$col = array();

			$col[]   = array('text' => 'RECARGA',     'width' => '154', 'height' => '3.7', 'align' => 'R', 'font_name' => 'Arial', 'font_size' => '7', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
			$col[]   = array('text' => $recargamonto, 'width' => '29', 'height' => '3.7', 'align' => 'R', 'font_name' => 'Arial', 'font_size' => '7', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
			
			
			$columns[] = $col;
			$pdf->SetX(8);
			$pdf->WriteTable($columns);
		}
		
		if($desc!='0.00'){
	   
		    $columns = array(); 
			$col = array();

			$col[]   = array('text' => 'DESCUENTO','width' => '154', 'height' => '3.7', 'align' => 'R', 'font_name' => 'Arial', 'font_size' => '7', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
			$col[]   = array('text' => $descumonto,'width' => '29', 'height' => '3.7', 'align' => 'R', 'font_name' => 'Arial', 'font_size' => '7', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
			
			
			$columns[] = $col;
			$pdf->SetX(8);
			$pdf->WriteTable($columns);
			
		}
		
		    $columns = array(); 
			$col = array();

			$col[]   = array('text' => 'TOTAL','width' => '154', 'height' => '3.7', 'align' => 'R', 'font_name' => 'Arial', 'font_size' => '7', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
			$col[]   = array('text' => $totalx,'width' => '29', 'height' => '3.7', 'align' => 'R', 'font_name' => 'Arial', 'font_size' => '7', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
			
			
			$columns[] = $col;
			$pdf->SetX(8);
			$pdf->WriteTable($columns);
	
	
			
    $pdf->Output();
?>