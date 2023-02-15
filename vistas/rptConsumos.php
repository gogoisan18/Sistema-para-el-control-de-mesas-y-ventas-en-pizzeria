<?php
session_start();
	if (isset($_SESSION['usuId'])){
				$usuario = $_SESSION['usuId'];
				$base = 'pizzeria';
	}else{
				header('Location:../index.php');
	}

	
	require('../controlador/ajustar_rptTicket.php');
	include_once("../modelo/rptTicket.class.php");
	$objeto = new rptTicket;
	$objeto->con->BaseDatos = $base;

	foreach ($_GET as $variable => $valor){
		$$variable = htmlspecialchars($valor);
	}
	

	
	$data1 = $objeto->consumos($cuenta);
	$fecha = $objeto->convertirFecha($objeto->ObtenerFecha());
	
  
	$pdf=new PDF_MC_Table($orientation='P',$unit='mm',$format='ticket');
	$pdf->AliasNbPages(); 
	$pdf->AddPage();

    $subt = 0; $montodeivax = 0; $preciosinivax = 0;

    $columns = array(); 
	$col = array();
	$col[] = array('text' => "P&R Flaco's C.A.", 'width' => '130', 'height' => '3', 'align' => 'C', 'font_name' => 'Courier', 'font_size' => '10', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
		
	$columns[] = $col;
	$pdf->SetX(2);
	$pdf->WriteTable($columns);

    $columns = array(); 
    $col = array();
    $col[] = array('text' => "Orden de Compra", 'width' => '130', 'height' => '3', 'align' => 'C', 'font_name' => 'Courier', 'font_size' => '10', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
        
    $columns[] = $col;
    $pdf->SetX(2);
    $pdf->WriteTable($columns);

    $columns = array(); 
    $col = array();
    $col[] = array('text' => "SIN VALOR FISCAL", 'width' => '130', 'height' => '5', 'align' => 'C', 'font_name' => 'Courier', 'font_size' => '10', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
        
    $columns[] = $col;
    $pdf->SetX(2);
    $pdf->WriteTable($columns);

    
    $columns = array(); 
    $col = array();
    $col[] = array('text' => $fecha, 'width' => '130', 'height' => '5', 'align' => 'R', 'font_name' => 'Courier', 'font_size' => '10', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
        
    $columns[] = $col;
    $pdf->SetX(2);
    $pdf->WriteTable($columns);

 
    $columns = array(); 
    $col = array();
    $col[] = array('text' => '======================================================', 'width' => '130', 'height' => '3', 'align' => 'C', 'font_name' => 'Courier', 'font_size' => '10', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
        
    $columns[] = $col;
    $pdf->SetX(2);
    $pdf->WriteTable($columns);


    $columns = array(); 
	$col = array();

	$col[]   = array('text' => 'Menu',      'width' => '50', 'height' => '3', 'align' => 'C', 'font_name' => 'Courier', 'font_size' => '10', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
	$col[]   = array('text' => 'Cant.',     'width' => '20', 'height' => '3', 'align' => 'C', 'font_name' => 'Courier', 'font_size' => '10', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
	$col[]   = array('text' => 'Precio Un.','width' => '30', 'height' => '3', 'align' => 'C', 'font_name' => 'Courier', 'font_size' => '10', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
	$col[]   = array('text' => 'Importe', 	'width' => '30', 'height' => '3', 'align' => 'C', 'font_name' => 'Courier', 'font_size' => '10', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
	
	
	$columns[] = $col;
	$pdf->SetX(4);
	$pdf->WriteTable($columns);

	$total=0;

	foreach($data1 as $row){
		
	    $prech = number_format($row['precio'],2,',','.');
			
		$resul = $row['precio']*$row['canti'];
		$montoh = number_format($resul,2,',','.'); 
			
		
		$columns = array(); 
		$col = array();

		$col[]   = array('text' => ucwords(strtolower(utf8_decode($row['descrip']))), 'width' => '50', 'height' => '3.7', 'align' => 'L', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
		$col[]   = array('text' => $row['canti'],  				 'width' => '20', 'height' => '3.7', 'align' => 'C', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
		$col[]   = array('text' => $prech,		       	     'width' => '30', 'height' => '3.7', 'align' => 'R', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
		$col[]   = array('text' => $montoh, 				 'width' => '30', 'height' => '3.7', 'align' => 'R', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
		
		$columns[] = $col;
		$pdf->SetX(3);
		$pdf->WriteTable($columns);
		$total+=$resul;
			
	}
	    $pdf->Ln(4);

	    $columns = array(); 
		$col = array();

		$col[]   = array('text' => 'TOTAL','width' => '100', 'height' => '3.7', 'align' => 'R', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
		$col[]   = array('text' => number_format($total,2,',','.'),'width' => '30', 'height' => '3.7', 'align' => 'R', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
		
		
		$columns[] = $col;
		$pdf->SetX(3);
		$pdf->WriteTable($columns);
	
	
			
    $pdf->Output();
?>