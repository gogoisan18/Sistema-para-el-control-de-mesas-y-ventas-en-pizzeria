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
	
		
	$tickx=(int)$tick;
	$data  = $objeto->cajero($tickx);
	$data1 = $objeto->compras($tickx);
	$data2 = $objeto->detalle($tickx);
	$data3 = $objeto->resx($tickx);
	
	
	foreach($data as $row){
		
		$fecha = $objeto->convertirFecha($row['fecha']);
		$cajero = ucwords(strtolower($row['cajero']));
		$hora = $row['hora'];
		$pago= $row['pago'];
		$tipo= $row['tipo'];
	}

    //$_SESSION['alturat']=100;
	$pdf=new PDF_MC_Table($orientation='P',$unit='mm',$format='ticket');
	//$pdf->AliasNbPages(); 
	$pdf->AddPage();

  
    $subt = 0; $montodeivax = 0; $preciosinivax = 0;

    $columns = array(); 
	$col = array();
	$col[] = array('text' => "P&R Flaco's C.A.", 'width' => '130', 'height' => '3', 'align' => 'C', 'font_name' => 'Courier', 'font_size' => '12', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
		
	$columns[] = $col;
	$pdf->SetX(2);
	$pdf->WriteTable($columns);

	//$pdf->CellFitSpaceForce(2,100,'P&R Flaco s C.A.',1,1,'',1);

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
    $col[] = array('text' => "Cajero: ".utf8_decode($cajero), 'width' => '130', 'height' => '3', 'align' => 'L', 'font_name' => 'Courier', 'font_size' => '10', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
        
    $columns[] = $col;
    $pdf->SetX(2);
    $pdf->WriteTable($columns);

    $columns = array(); 
    $col = array();
    $col[] = array('text' => $fecha.' '.$hora, 'width' => '130', 'height' => '5', 'align' => 'R', 'font_name' => 'Courier', 'font_size' => '10', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
        
    $columns[] = $col;
    $pdf->SetX(2);
    $pdf->WriteTable($columns);

    $columns = array(); 
    $col = array();
    $col[] = array('text' => '# Compra: '.$pago, 'width' => '130', 'height' => '5', 'align' => 'C', 'font_name' => 'Courier', 'font_size' => '10', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
        
    $columns[] = $col;
    $pdf->SetX(2);
    $pdf->WriteTable($columns);


    $columns = array(); 
    $col = array();
    $col[] = array('text' => '========================================================', 'width' => '130', 'height' => '3', 'align' => 'C', 'font_name' => 'Courier', 'font_size' => '10', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
        
    $columns[] = $col;
    $pdf->SetX(2);
    $pdf->WriteTable($columns);


    $columns = array(); 
	$col = array();


	//if($tipo=='C'){

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

		foreach($data2 as $row){
			
			
			$inicial = $row['inicial'];
			$descuento = $row['descuento'];
			$recarga= $row['recarga'];
			$final = ($row['inicial']+$row['recarga'])-$row['descuento'];		
		}

		if($tipo=='C'){

			$columns = array(); 
			$col = array();

			$col[]   = array('text' => 'Total','width' => '100', 'height' => '3.7', 'align' => 'R', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
			$col[]   = array('text' => number_format($inicial,2,',','.'),'width' => '30', 'height' => '3.7', 'align' => 'R', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
			
			
			$columns[] = $col;
			$pdf->SetX(3);
			$pdf->WriteTable($columns);

		    $columns = array(); 
			$col = array();

			$col[]   = array('text' => 'Recarga','width' => '100', 'height' => '3.7', 'align' => 'R', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
			$col[]   = array('text' => number_format($recarga,2,',','.'),'width' => '30', 'height' => '3.7', 'align' => 'R', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
			
			
			$columns[] = $col;
			$pdf->SetX(3);
			$pdf->WriteTable($columns);

			$columns = array(); 
			$col = array();

			$col[]   = array('text' => 'Descuento','width' => '100', 'height' => '3.7', 'align' => 'R', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
			$col[]   = array('text' => number_format($descuento,2,',','.'),'width' => '30', 'height' => '3.7', 'align' => 'R', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
			
			
			$columns[] = $col;
			$pdf->SetX(3);
			$pdf->WriteTable($columns);

		    $columns = array(); 
			$col = array();

			$col[]   = array('text' => 'TOTAL FINAL','width' => '100', 'height' => '3.7', 'align' => 'R', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
			$col[]   = array('text' => number_format($final,2,',','.'),'width' => '30', 'height' => '3.7', 'align' => 'R', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
			
			
			$columns[] = $col;
			$pdf->SetX(3);
			$pdf->WriteTable($columns);
			
			$_POST['altotick']=$pdf->GetPageHeight();
		}else{

			foreach($data3 as $row){
			
				$monto1 = $row['monto1'];
				$pagos = $row['pagos'];
				$resta = $row['resta'];

			}


			$columns = array(); 
			$col = array();

			$col[]   = array('text' => 'TOTAL','width' => '100', 'height' => '3.7', 'align' => 'R', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
			$col[]   = array('text' => number_format($monto1,2,',','.'),'width' => '30', 'height' => '3.7', 'align' => 'R', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
			
			
			$columns[] = $col;
			$pdf->SetX(3);
			$pdf->WriteTable($columns);
			
		
			$columns = array(); 
			$col = array();

			$col[]   = array('text' => 'Pago Parcial','width' => '100', 'height' => '3.7', 'align' => 'R', 'font_name' => 'Courier', 'font_size' => '10', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
			$col[]   = array('text' => number_format($pagos,2,',','.'),'width' => '30', 'height' => '3.7', 'align' => 'R', 'font_name' => 'Courier', 'font_size' => '10', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
			
			
			$columns[] = $col;
			$pdf->SetX(3);
			$pdf->WriteTable($columns);


			$columns = array(); 
			$col = array();

			$col[]   = array('text' => 'Resta','width' => '100', 'height' => '3.7', 'align' => 'R', 'font_name' => 'Courier', 'font_size' => '10', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
			$col[]   = array('text' => number_format($resta,2,',','.'),'width' => '30', 'height' => '3.7', 'align' => 'R', 'font_name' => 'Courier', 'font_size' => '10', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
			
			
			$columns[] = $col;
			$pdf->SetX(3);
			$pdf->WriteTable($columns);
			$pdf->Ln(5);

			$_SESSION['alturat']=$pdf->GetPageHeight();



		}
			
    $pdf->Output();
?>