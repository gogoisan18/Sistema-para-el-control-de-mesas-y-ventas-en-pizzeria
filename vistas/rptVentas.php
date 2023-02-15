<?php
session_start();
	if (isset($_SESSION['usuId'])){
				$usuario = $_SESSION['usuId'];
				$base = 'pizzeria';
				$cajero = ucwords(strtolower($_SESSION['usuNombres']));
	}else{
				header('Location:../index.php');
	}

	
	require('../controlador/ajustar_rptventas.php');
	include_once("../modelo/rptTicket.class.php");
	$objeto = new rptTicket;
	$objeto->con->BaseDatos = $base;

	foreach ($_GET as $variable => $valor){
		$$variable = htmlspecialchars($valor);
	}
	
		
	$desde=$_SESSION['dsd'];
	$hasta=$_SESSION['hst'];
	$desdex=$objeto->convertirFecha($_SESSION['dsd']);
	$hastax=$objeto->convertirFecha($_SESSION['hst']);
	$data = $objeto->pizzas($desdex,$hastax,$usuario);
	$data1 = $objeto->adicionales($desdex,$hastax,$usuario);
	$data2 = $objeto->carnes($desdex,$hastax,$usuario);
	$data3 = $objeto->bebidas($desdex,$hastax,$usuario);
	$data4 = $objeto->licores($desdex,$hastax,$usuario);
	$data5 = $objeto->envases($desdex,$hastax,$usuario);
	$data6 = $objeto->otrosP($desdex,$hastax,$usuario);
	$data7 = $objeto->helados($desdex,$hastax,$usuario);
	$data8 = $objeto->merengadas($desdex,$hastax,$usuario);
	$data9 = $objeto->golosinas($desdex,$hastax,$usuario);

	$fechahora = $objeto->ObtenerFechaHora();
    //global $altopag;
 	$pdf=new PDF_MC_Table($orientation='P',$unit='mm',$format='ventas');
	//$pdf=new PDF_MC_Table($orientation='P',$unit='mm',array(400,$altopag));
	//$pdf->AliasNbPages(); 
	$pdf->AddPage();

    $subt = 0; $montodeivax = 0; $preciosinivax = 0;

    $columns = array(); 
	$col = array();
	$col[] = array('text' => "P&R Flaco's C.A.", 'width' => '130', 'height' => '5', 'align' => 'C', 'font_name' => 'Courier', 'font_size' => '12', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
		
	$columns[] = $col;
	$pdf->SetX(2);
	$pdf->WriteTable($columns);

    $columns = array(); 
    $col = array();
    $col[] = array('text' => "Reporte Z", 'width' => '130', 'height' => '3', 'align' => 'C', 'font_name' => 'Courier', 'font_size' => '10', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
        
    $columns[] = $col;
    $pdf->SetX(2);
    $pdf->WriteTable($columns);

   
    $columns = array(); 
    $col = array();
    $col[] = array('text' => "Cajero: ".utf8_decode(ucwords(strtolower($_SESSION['usuNombres']))), 'width' => '130', 'height' => '3', 'align' => 'L', 'font_name' => 'Courier', 'font_size' => '10', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
        
    $columns[] = $col;
    $pdf->SetX(2);
    $pdf->WriteTable($columns);

    $columns = array(); 
    $col = array();
    $col[] = array('text' => $fechahora, 'width' => '130', 'height' => '5', 'align' => 'R', 'font_name' => 'Courier', 'font_size' => '10', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
        
    $columns[] = $col;
    $pdf->SetX(2);
    $pdf->WriteTable($columns);

    $columns = array(); 
    $col = array();
    $col[] = array('text' => 'Desde: '.$desde.' Hasta: '.$hasta, 'width' => '130', 'height' => '5', 'align' => 'C', 'font_name' => 'Courier', 'font_size' => '10', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
        
    $columns[] = $col;
    $pdf->SetX(2);
    $pdf->WriteTable($columns);

  
    $columns = array(); 
    $col = array();
    $col[] = array('text' => '=====================================================', 'width' => '130', 'height' => '3', 'align' => 'C', 'font_name' => 'Courier', 'font_size' => '10', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
        
    $columns[] = $col;
    $pdf->SetX(2);
    $pdf->WriteTable($columns);

    if(count($data)>0){


	    $columns = array(); 
	    $col = array();
	    $col[] = array('text' => 'Cantidad de Pizzas Vendidas', 'width' => '130', 'height' => '3', 'align' => 'C', 'font_name' => 'Courier', 'font_size' => '10', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
	        
	    $columns[] = $col;
	    $pdf->SetX(2);
	    $pdf->WriteTable($columns);


	    $columns = array(); 
		$col = array();

		$col[]   = array('text' => 'Menu',      'width' => '80', 'height' => '3', 'align' => 'C', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
		$col[]   = array('text' => 'Cant.',     'width' => '20', 'height' => '3', 'align' => 'C', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
		$col[]   = array('text' => 'Importe', 	'width' => '30', 'height' => '3', 'align' => 'C', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
		
		
		$columns[] = $col;
		$pdf->SetX(3);
		$pdf->WriteTable($columns);

	
		$cantpizzas=0;
		$subpizzas=0;
		    foreach($data as $row){
				
			    $prech = number_format($row['precio'],2,',','.');
					

				$columns = array(); 
				$col = array();

				$col[]   = array('text' => ucwords(strtolower(utf8_decode($row['descrip']))), 'width' => '80', 'height' => '3.7', 'align' => 'L', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
				$col[]   = array('text' => $row['canti'],  		     'width' => '20', 'height' => '3.7', 'align' => 'C', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
				$col[]   = array('text' => $prech,		       	     'width' => '30', 'height' => '3.7', 'align' => 'R', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
				
				
				$columns[] = $col;
				$pdf->SetX(3);
				$pdf->WriteTable($columns);
			
				
				$cantpizzas+=$row['canti'];
				$subpizzas+=$row['total'];
			}

			$columns = array(); 
			$col = array();
			
			$col[]   = array('text' => 'Conteo de Pizzas ', 	'width' => '80', 'height' => '3', 'align' => 'L', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
			$col[]   = array('text' => $cantpizzas, 	'width' => '20', 'height' => '3', 'align' => 'C', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
		
			
			$columns[] = $col;
			$pdf->SetX(3);
			$pdf->WriteTable($columns);

			$columns = array(); 
			$col = array();
			
			$col[]   = array('text' => 'SubTotal', 	'width' => '100', 'height' => '3', 'align' => 'L', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
			$col[]   = array('text' => number_format($subpizzas,2,',','.'), 	'width' => '30', 'height' => '3', 'align' => 'R', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
			
			
			$columns[] = $col;
			$pdf->SetX(3);
			$pdf->WriteTable($columns);

	}$pdf->Ln(4);

	if(count($data1)>0){


	    $columns = array(); 
	    $col = array();
	    $col[] = array('text' => 'Cantidad de Adicionales Vendidos', 'width' => '130', 'height' => '3', 'align' => 'C', 'font_name' => 'Courier', 'font_size' => '10', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
	        
	    $columns[] = $col;
	    $pdf->SetX(2);
	    $pdf->WriteTable($columns);


	    $columns = array(); 
		$col = array();

		$col[]   = array('text' => 'Menu',      'width' => '80', 'height' => '3', 'align' => 'C', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
		$col[]   = array('text' => 'Cant.',     'width' => '20', 'height' => '3', 'align' => 'C', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
		$col[]   = array('text' => 'Importe', 	'width' => '30', 'height' => '3', 'align' => 'C', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
		
		
		$columns[] = $col;
		$pdf->SetX(3);
		$pdf->WriteTable($columns);

	
		$cantadi=0;
		$subadi=0;
		    foreach($data1 as $row){
				
			    $prech = number_format($row['precio'],2,',','.');
					

				$columns = array(); 
				$col = array();

				$col[]   = array('text' => ucwords(strtolower(utf8_decode($row['descrip']))), 'width' => '80', 'height' => '3.7', 'align' => 'L', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
				$col[]   = array('text' => $row['canti'],  		     'width' => '20', 'height' => '3.7', 'align' => 'C', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
				$col[]   = array('text' => $prech,		       	     'width' => '30', 'height' => '3.7', 'align' => 'R', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
				
				
				$columns[] = $col;
				$pdf->SetX(3);
				$pdf->WriteTable($columns);
				
				$cantadi+=$row['canti'];
				$subadi+=$row['total'];
			}

			$columns = array(); 
			$col = array();
			
			$col[]   = array('text' => 'Conteo de Adicionales', 	'width' => '80', 'height' => '3', 'align' => 'L', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
			$col[]   = array('text' => $cantadi, 	'width' => '20', 'height' => '3', 'align' => 'C', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
			
			
			$columns[] = $col;
			$pdf->SetX(3);
			$pdf->WriteTable($columns);

			$columns = array(); 
			$col = array();
			
			$col[]   = array('text' => 'SubTotal', 	'width' => '100', 'height' => '3', 'align' => 'L', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
			$col[]   = array('text' => number_format($subadi,2,',','.'), 	'width' => '30', 'height' => '3', 'align' => 'R', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
			
			
			$columns[] = $col;
			$pdf->SetX(3);
			$pdf->WriteTable($columns);

	}$pdf->Ln(4);

	if(count($data2)>0){


	    $columns = array(); 
	    $col = array();
	    $col[] = array('text' => 'Cantidad de Carnes Vendidas', 'width' => '130', 'height' => '3', 'align' => 'C', 'font_name' => 'Courier', 'font_size' => '10', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
	        
	    $columns[] = $col;
	    $pdf->SetX(2);
	    $pdf->WriteTable($columns);


	    $columns = array(); 
		$col = array();

		$col[]   = array('text' => 'Menu',      'width' => '80', 'height' => '3', 'align' => 'C', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
		$col[]   = array('text' => 'Cant.',     'width' => '20', 'height' => '3', 'align' => 'C', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
		$col[]   = array('text' => 'Importe', 	'width' => '30', 'height' => '3', 'align' => 'C', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
		
		
		$columns[] = $col;
		$pdf->SetX(3);
		$pdf->WriteTable($columns);

	
		$cantcar=0;
		$subcarne=0;
		    foreach($data2 as $row){
				
			    $prech = number_format($row['precio'],2,',','.');
					

				$columns = array(); 
				$col = array();

				$col[]   = array('text' => ucwords(strtolower(utf8_decode($row['descrip']))), 'width' => '80', 'height' => '3.7', 'align' => 'L', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
				$col[]   = array('text' => $row['canti'],  		     'width' => '20', 'height' => '3.7', 'align' => 'C', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
				$col[]   = array('text' => $prech,		       	     'width' => '30', 'height' => '3.7', 'align' => 'R', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
				
				
				$columns[] = $col;
				$pdf->SetX(3);
				$pdf->WriteTable($columns);
			
				$cantcar+=$row['canti'];
				$subcarne+=$row['total'];
			}

			$columns = array(); 
			$col = array();
			
			$col[]   = array('text' => 'Conteo de Carnes', 	'width' => '80', 'height' => '3', 'align' => 'L', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
			$col[]   = array('text' => $cantcar, 	'width' => '20', 'height' => '3', 'align' => 'C', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
			
			
			$columns[] = $col;
			$pdf->SetX(3);
			$pdf->WriteTable($columns);

			$columns = array(); 
			$col = array();
			
			$col[]   = array('text' => 'SubTotal', 	'width' => '100', 'height' => '3', 'align' => 'L', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
			$col[]   = array('text' => number_format($subcarne,2,',','.'), 	'width' => '30', 'height' => '3', 'align' => 'R', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
			
			
			$columns[] = $col;
			$pdf->SetX(3);
			$pdf->WriteTable($columns);

	}$pdf->Ln(4);

	if(count($data3)>0){


	    $columns = array(); 
	    $col = array();
	    $col[] = array('text' => 'Cantidad de Bebidas Vendidas', 'width' => '130', 'height' => '3', 'align' => 'C', 'font_name' => 'Courier', 'font_size' => '10', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
	        
	    $columns[] = $col;
	    $pdf->SetX(2);
	    $pdf->WriteTable($columns);


	    $columns = array(); 
		$col = array();

		$col[]   = array('text' => 'Menu',      'width' => '80', 'height' => '3', 'align' => 'C', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
		$col[]   = array('text' => 'Cant.',     'width' => '20', 'height' => '3', 'align' => 'C', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
		$col[]   = array('text' => 'Importe', 	'width' => '30', 'height' => '3', 'align' => 'C', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
		
		
		$columns[] = $col;
		$pdf->SetX(3);
		$pdf->WriteTable($columns);

	
		$cantbebi=0;
		$subbebi=0;
		    foreach($data3 as $row){
				
			    $prech = number_format($row['precio'],2,',','.');
					

				$columns = array(); 
				$col = array();

				$col[]   = array('text' => ucwords(strtolower(utf8_decode($row['descrip']))), 'width' => '80', 'height' => '3.7', 'align' => 'L', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
				$col[]   = array('text' => $row['canti'],  		     'width' => '20', 'height' => '3.7', 'align' => 'C', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
				$col[]   = array('text' => $prech,		       	     'width' => '30', 'height' => '3.7', 'align' => 'R', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
				
				
				$columns[] = $col;
				$pdf->SetX(3);
				$pdf->WriteTable($columns);
				
				
				$cantbebi+=$row['canti'];
				$subbebi+=$row['total'];
			}

			$columns = array(); 
			$col = array();
			
			$col[]   = array('text' => 'Conteo de Bebidas', 	'width' => '80', 'height' => '3', 'align' => 'L', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
			$col[]   = array('text' => $cantbebi, 	'width' => '20', 'height' => '3', 'align' => 'C', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
			
			
			$columns[] = $col;
			$pdf->SetX(3);
			$pdf->WriteTable($columns);

			$columns = array(); 
			$col = array();
			
			$col[]   = array('text' => 'SubTotal', 	'width' => '100', 'height' => '3', 'align' => 'L', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
			$col[]   = array('text' => number_format($subbebi,2,',','.'), 	'width' => '30', 'height' => '3', 'align' => 'R', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
			
			
			$columns[] = $col;
			$pdf->SetX(3);
			$pdf->WriteTable($columns);

	}$pdf->Ln(4);

	if(count($data4)>0){


	    $columns = array(); 
	    $col = array();
	    $col[] = array('text' => 'Cantidad de Licores Vendidos', 'width' => '130', 'height' => '3', 'align' => 'C', 'font_name' => 'Courier', 'font_size' => '10', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
	        
	    $columns[] = $col;
	    $pdf->SetX(2);
	    $pdf->WriteTable($columns);


	    $columns = array(); 
		$col = array();

		$col[]   = array('text' => 'Menu',      'width' => '80', 'height' => '3', 'align' => 'C', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
		$col[]   = array('text' => 'Cant.',     'width' => '20', 'height' => '3', 'align' => 'C', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
		$col[]   = array('text' => 'Importe', 	'width' => '30', 'height' => '3', 'align' => 'C', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
		
		
		$columns[] = $col;
		$pdf->SetX(3);
		$pdf->WriteTable($columns);

	
		$cantlic=0;
		$sublic=0;
		    foreach($data4 as $row){
				
			    $prech = number_format($row['precio'],2,',','.');
					

				$columns = array(); 
				$col = array();

				$col[]   = array('text' => ucwords(strtolower(utf8_decode($row['descrip']))), 'width' => '80', 'height' => '3.7', 'align' => 'L', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
				$col[]   = array('text' => $row['canti'],  		     'width' => '20', 'height' => '3.7', 'align' => 'C', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
				$col[]   = array('text' => $prech,		       	     'width' => '30', 'height' => '3.7', 'align' => 'R', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
				
				
				$columns[] = $col;
				$pdf->SetX(3);
				$pdf->WriteTable($columns);
				
				$cantlic+=$row['canti'];
				$sublic+=$row['total'];
			}

			$columns = array(); 
			$col = array();
			
			$col[]   = array('text' => 'Conteo de Licores', 	'width' => '80', 'height' => '3', 'align' => 'L', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
			$col[]   = array('text' => $cantlic, 	'width' => '20', 'height' => '3', 'align' => 'C', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
			
			
			$columns[] = $col;
			$pdf->SetX(3);
			$pdf->WriteTable($columns);

			$columns = array(); 
			$col = array();
			
			$col[]   = array('text' => 'SubTotal', 	'width' => '100', 'height' => '3', 'align' => 'L', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
			$col[]   = array('text' => number_format($sublic,2,',','.'), 	'width' => '30', 'height' => '3', 'align' => 'R', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
			
			
			$columns[] = $col;
			$pdf->SetX(3);
			$pdf->WriteTable($columns);

	}$pdf->Ln(4);


	if(count($data5)>0){


	    $columns = array(); 
	    $col = array();
	    $col[] = array('text' => 'Cantidad de Envases Vendidos', 'width' => '130', 'height' => '3', 'align' => 'C', 'font_name' => 'Courier', 'font_size' => '10', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
	        
	    $columns[] = $col;
	    $pdf->SetX(2);
	    $pdf->WriteTable($columns);


	    $columns = array(); 
		$col = array();

		$col[]   = array('text' => 'Menu',      'width' => '80', 'height' => '3', 'align' => 'C', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
		$col[]   = array('text' => 'Cant.',     'width' => '20', 'height' => '3', 'align' => 'C', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
		$col[]   = array('text' => 'Importe', 	'width' => '30', 'height' => '3', 'align' => 'C', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
		
		
		$columns[] = $col;
		$pdf->SetX(3);
		$pdf->WriteTable($columns);

	
		$cantenv=0;
		$subenv=0;
		    foreach($data5 as $row){
				
			    $prech = number_format($row['precio'],2,',','.');
					

				$columns = array(); 
				$col = array();

				$col[]   = array('text' => ucwords(strtolower(utf8_decode($row['descrip']))), 'width' => '80', 'height' => '3.7', 'align' => 'L', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
				$col[]   = array('text' => $row['canti'],  		     'width' => '20', 'height' => '3.7', 'align' => 'C', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
				$col[]   = array('text' => $prech,		       	     'width' => '30', 'height' => '3.7', 'align' => 'R', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
				
				
				$columns[] = $col;
				$pdf->SetX(3);
				$pdf->WriteTable($columns);
			
				
				$cantenv+=$row['canti'];
				$subenv+=$row['total'];
			}

			$columns = array(); 
			$col = array();
			
			$col[]   = array('text' => 'Conteo de Envases', 	'width' => '80', 'height' => '3', 'align' => 'L', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
			$col[]   = array('text' => $cantenv, 	'width' => '20', 'height' => '3', 'align' => 'C', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
			
			
			$columns[] = $col;
			$pdf->SetX(3);
			$pdf->WriteTable($columns);

			$columns = array(); 
			$col = array();
			
			$col[]   = array('text' => 'SubTotal', 	'width' => '100', 'height' => '3', 'align' => 'L', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
			$col[]   = array('text' => number_format($subenv,2,',','.'), 	'width' => '30', 'height' => '3', 'align' => 'R', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
			
			
			$columns[] = $col;
			$pdf->SetX(3);
			$pdf->WriteTable($columns);

	}$pdf->Ln(4);

	if(count($data6)>0){


	    $columns = array(); 
	    $col = array();
	    $col[] = array('text' => 'Cantidad de Otros Platos Vendidos', 'width' => '130', 'height' => '3', 'align' => 'C', 'font_name' => 'Courier', 'font_size' => '10', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
	        
	    $columns[] = $col;
	    $pdf->SetX(2);
	    $pdf->WriteTable($columns);


	    $columns = array(); 
		$col = array();

		$col[]   = array('text' => 'Menu',      'width' => '80', 'height' => '3', 'align' => 'C', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
		$col[]   = array('text' => 'Cant.',     'width' => '20', 'height' => '3', 'align' => 'C', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
		$col[]   = array('text' => 'Importe', 	'width' => '30', 'height' => '3', 'align' => 'C', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
		
		
		$columns[] = $col;
		$pdf->SetX(3);
		$pdf->WriteTable($columns);

	
		$cantotros=0;
		$subotros=0;
		    foreach($data6 as $row){
				
			    $prech = number_format($row['precio'],2,',','.');
					

				$columns = array(); 
				$col = array();

				$col[]   = array('text' => ucwords(strtolower(utf8_decode($row['descrip']))), 'width' => '80', 'height' => '3.7', 'align' => 'L', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
				$col[]   = array('text' => $row['canti'],  		     'width' => '20', 'height' => '3.7', 'align' => 'C', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
				$col[]   = array('text' => $prech,		       	     'width' => '30', 'height' => '3.7', 'align' => 'R', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
				
				
				$columns[] = $col;
				$pdf->SetX(3);
				$pdf->WriteTable($columns);
				
				$cantotros+=$row['canti'];
				$subotros+=$row['total'];
			}

			$columns = array(); 
			$col = array();
			
			$col[]   = array('text' => 'Conteo de Otros Platos', 	'width' => '80', 'height' => '3', 'align' => 'L', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
			$col[]   = array('text' => $cantotros, 	'width' => '20', 'height' => '3', 'align' => 'C', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
			
			
			$columns[] = $col;
			$pdf->SetX(3);
			$pdf->WriteTable($columns);

			$columns = array(); 
			$col = array();
			
			$col[]   = array('text' => 'SubTotal', 	'width' => '100', 'height' => '3', 'align' => 'L', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
			$col[]   = array('text' => number_format($subotros,2,',','.'), 	'width' => '30', 'height' => '3', 'align' => 'R', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
			
			
			$columns[] = $col;
			$pdf->SetX(3);
			$pdf->WriteTable($columns);

	}$pdf->Ln(4);

	if(count($data7)>0){


	    $columns = array(); 
	    $col = array();
	    $col[] = array('text' => 'Cantidad Helados Vendidos', 'width' => '130', 'height' => '3', 'align' => 'C', 'font_name' => 'Courier', 'font_size' => '10', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
	        
	    $columns[] = $col;
	    $pdf->SetX(2);
	    $pdf->WriteTable($columns);


	    $columns = array(); 
		$col = array();

		$col[]   = array('text' => 'Menu',      'width' => '80', 'height' => '3', 'align' => 'C', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
		$col[]   = array('text' => 'Cant.',     'width' => '20', 'height' => '3', 'align' => 'C', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
		$col[]   = array('text' => 'Importe', 	'width' => '30', 'height' => '3', 'align' => 'C', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
		
		
		$columns[] = $col;
		$pdf->SetX(3);
		$pdf->WriteTable($columns);

	
		$canthelad=0;
		$subhelad=0;
		    foreach($data7 as $row){
				
			    $prech = number_format($row['precio'],2,',','.');
					

				$columns = array(); 
				$col = array();

				$col[]   = array('text' => ucwords(strtolower(utf8_decode($row['descrip']))), 'width' => '80', 'height' => '3.7', 'align' => 'L', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
				$col[]   = array('text' => $row['canti'],  		     'width' => '20', 'height' => '3.7', 'align' => 'C', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
				$col[]   = array('text' => $prech,		       	     'width' => '30', 'height' => '3.7', 'align' => 'R', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
				
				
				$columns[] = $col;
				$pdf->SetX(3);
				$pdf->WriteTable($columns);
				
				
				$canthelad+=$row['canti'];
				$subhelad+=$row['total'];
			}

			$columns = array(); 
			$col = array();
			
			$col[]   = array('text' => 'Conteo de Helados', 	'width' => '80', 'height' => '3', 'align' => 'L', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
			$col[]   = array('text' => $canthelad, 	'width' => '20', 'height' => '3', 'align' => 'C', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
			
			
			$columns[] = $col;
			$pdf->SetX(3);
			$pdf->WriteTable($columns);

			$columns = array(); 
			$col = array();
			
			$col[]   = array('text' => 'SubTotal', 	'width' => '100', 'height' => '3', 'align' => 'L', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
			$col[]   = array('text' => number_format($subhelad,2,',','.'), 	'width' => '30', 'height' => '3', 'align' => 'R', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
			
			
			$columns[] = $col;
			$pdf->SetX(3);
			$pdf->WriteTable($columns);

	}$pdf->Ln(4);

	if(count($data8)>0){


	    $columns = array(); 
	    $col = array();
	    $col[] = array('text' => 'Cantidad Merengadas Vendidas', 'width' => '130', 'height' => '3', 'align' => 'C', 'font_name' => 'Courier', 'font_size' => '10', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
	        
	    $columns[] = $col;
	    $pdf->SetX(2);
	    $pdf->WriteTable($columns);


	    $columns = array(); 
		$col = array();

		$col[]   = array('text' => 'Menu',      'width' => '80', 'height' => '3', 'align' => 'C', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
		$col[]   = array('text' => 'Cant.',     'width' => '20', 'height' => '3', 'align' => 'C', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
		$col[]   = array('text' => 'Importe', 	'width' => '30', 'height' => '3', 'align' => 'C', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
		
		
		$columns[] = $col;
		$pdf->SetX(3);
		$pdf->WriteTable($columns);

	
		$cantmeren=0;
		$submeren=0;
		    foreach($data8 as $row){
				
			    $prech = number_format($row['precio'],2,',','.');
					

				$columns = array(); 
				$col = array();

				$col[]   = array('text' => ucwords(strtolower(utf8_decode($row['descrip']))), 'width' => '80', 'height' => '3.7', 'align' => 'L', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
				$col[]   = array('text' => $row['canti'],  		     'width' => '20', 'height' => '3.7', 'align' => 'C', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
				$col[]   = array('text' => $prech,		       	     'width' => '30', 'height' => '3.7', 'align' => 'R', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
				
				
				$columns[] = $col;
				$pdf->SetX(3);
				$pdf->WriteTable($columns);
			
				$cantmeren+=$row['canti'];
				$submeren+=$row['total'];
			}

			$columns = array(); 
			$col = array();
			
			$col[]   = array('text' => 'Conteo de Merengadas', 	'width' => '80', 'height' => '3', 'align' => 'L', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
			$col[]   = array('text' => $cantmeren, 	'width' => '20', 'height' => '3', 'align' => 'C', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
			
			
			$columns[] = $col;
			$pdf->SetX(3);
			$pdf->WriteTable($columns);

			$columns = array(); 
			$col = array();
			
			$col[]   = array('text' => 'SubTotal', 	'width' => '100', 'height' => '3', 'align' => 'L', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
			$col[]   = array('text' => number_format($submeren,2,',','.'), 	'width' => '30', 'height' => '3', 'align' => 'R', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
			
			
			$columns[] = $col;
			$pdf->SetX(3);
			$pdf->WriteTable($columns);

	}$pdf->Ln(4);

	if(count($data9)>0){


	    $columns = array(); 
	    $col = array();
	    $col[] = array('text' => 'Cantidad de Golosinas Vendidos', 'width' => '130', 'height' => '3', 'align' => 'C', 'font_name' => 'Courier', 'font_size' => '10', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
	        
	    $columns[] = $col;
	    $pdf->SetX(2);
	    $pdf->WriteTable($columns);


	    $columns = array(); 
		$col = array();

		$col[]   = array('text' => 'Menu',      'width' => '80', 'height' => '3', 'align' => 'C', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
		$col[]   = array('text' => 'Cant.',     'width' => '20', 'height' => '3', 'align' => 'C', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
		$col[]   = array('text' => 'Importe', 	'width' => '30', 'height' => '3', 'align' => 'C', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
		
		
		$columns[] = $col;
		$pdf->SetX(3);
		$pdf->WriteTable($columns);

	
		$cantgolo=0;
		$subgolo=0;
		    foreach($data9 as $row){
				
			    $prech = number_format($row['precio'],2,',','.');
					

				$columns = array(); 
				$col = array();

				$col[]   = array('text' => ucwords(strtolower(utf8_decode($row['descrip']))), 'width' => '80', 'height' => '3.7', 'align' => 'L', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
				$col[]   = array('text' => $row['canti'],  		     'width' => '20', 'height' => '3.7', 'align' => 'C', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
				$col[]   = array('text' => $prech,		       	     'width' => '30', 'height' => '3.7', 'align' => 'R', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
				
				
				$columns[] = $col;
				$pdf->SetX(3);
				$pdf->WriteTable($columns);
				
				
				$cantgolo+=$row['canti'];
				$subgolo+=$row['total'];
			}

			$columns = array(); 
			$col = array();
			
			$col[]   = array('text' => 'Conteo de Golosinas', 	'width' => '80', 'height' => '3', 'align' => 'L', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
			$col[]   = array('text' => $cantgolo, 'width' => '30', 'height' => '3', 'align' => 'C', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
			
			
			$columns[] = $col;
			$pdf->SetX(3);
			$pdf->WriteTable($columns);

			$columns = array(); 
			$col = array();
			
			$col[]   = array('text' => 'SubTotal', 	'width' => '100', 'height' => '3', 'align' => 'L', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
			$col[]   = array('text' => number_format($subgolo,2,',','.'), 	'width' => '30', 'height' => '3', 'align' => 'R', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
			
			
			$columns[] = $col;
			$pdf->SetX(3);
			$pdf->WriteTable($columns);

	}
	   $pdf->Ln(4);

	    $columns = array(); 
		$col = array();
		
		$col[]   = array('text' => '======================================================', 'width' => '130', 'height' => '3', 'align' => 'C', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
		
				
		$columns[] = $col;
		$pdf->SetX(3);
		$pdf->WriteTable($columns);

		$pdf->Ln(4);
      
	    $columns = array(); 
		$col = array();
		
		$col[]   = array('text' => 'TOTALES GENERALES (Bs.)', 'width' => '130', 'height' => '3', 'align' => 'C', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
		
				
		$columns[] = $col;
		$pdf->SetX(3);
		$pdf->WriteTable($columns);

		if(count($data)>0){
			$columns = array(); 
			$col = array();
			
			$col[]   = array('text' => 'Total Pizzas', 	'width' => '100', 'height' => '3', 'align' => 'L', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
			$col[]   = array('text' => number_format($subpizzas,2,',','.'), 	'width' => '30', 'height' => '3', 'align' => 'R', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
			
			
			$columns[] = $col;
			$pdf->SetX(3);
			$pdf->WriteTable($columns);

		}
		if(count($data1)>0){
			$columns = array(); 
			$col = array();
			
			$col[]   = array('text' => 'Total Adicionales', 	'width' => '100', 'height' => '3', 'align' => 'L', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
			$col[]   = array('text' => number_format($subadi,2,',','.'), 	'width' => '30', 'height' => '3', 'align' => 'R', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
			
			
			$columns[] = $col;
			$pdf->SetX(3);
			$pdf->WriteTable($columns);

		}
		if(count($data2)>0){
			$columns = array(); 
			$col = array();
			
			$col[]   = array('text' => 'Total Carnes', 	'width' => '100', 'height' => '3', 'align' => 'L', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
			$col[]   = array('text' => number_format($subcarne,2,',','.'), 	'width' => '30', 'height' => '3', 'align' => 'R', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
			
			
			$columns[] = $col;
			$pdf->SetX(3);
			$pdf->WriteTable($columns);

		}
		if(count($data3)>0){
			$columns = array(); 
			$col = array();
			
			$col[]   = array('text' => 'Total Bebidas', 	'width' => '100', 'height' => '3', 'align' => 'L', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
			$col[]   = array('text' => number_format($subbebi,2,',','.'), 	'width' => '30', 'height' => '3', 'align' => 'R', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
			
			
			$columns[] = $col;
			$pdf->SetX(3);
			$pdf->WriteTable($columns);

		}
		if(count($data4)>0){
			$columns = array(); 
			$col = array();
			
			$col[]   = array('text' => 'Total Licores', 	'width' => '100', 'height' => '3', 'align' => 'L', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
			$col[]   = array('text' => number_format($sublic,2,',','.'), 	'width' => '30', 'height' => '3', 'align' => 'R', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
			
			
			$columns[] = $col;
			$pdf->SetX(3);
			$pdf->WriteTable($columns);

		}
		if(count($data5)>0){
			$columns = array(); 
			$col = array();
			
			$col[]   = array('text' => 'Total Envases', 	'width' => '100', 'height' => '3', 'align' => 'L', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
			$col[]   = array('text' => number_format($subenv,2,',','.'), 	'width' => '30', 'height' => '3', 'align' => 'R', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
			
			
			$columns[] = $col;
			$pdf->SetX(3);
			$pdf->WriteTable($columns);

		}
		if(count($data6)>0){
			$columns = array(); 
			$col = array();
			
			$col[]   = array('text' => 'Total Otros Platos', 	'width' => '100', 'height' => '3', 'align' => 'L', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
			$col[]   = array('text' => number_format($subotros,2,',','.'), 	'width' => '30', 'height' => '3', 'align' => 'R', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
			
			
			$columns[] = $col;
			$pdf->SetX(3);
			$pdf->WriteTable($columns);

		}
		if(count($data7)>0){
			$columns = array(); 
			$col = array();
			
			$col[]   = array('text' => 'Total Helados', 	'width' => '100', 'height' => '3', 'align' => 'L', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
			$col[]   = array('text' => number_format($subhelad,2,',','.'), 	'width' => '30', 'height' => '3', 'align' => 'R', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
			
			
			$columns[] = $col;
			$pdf->SetX(3);
			$pdf->WriteTable($columns);

		}
		if(count($data8)>0){
			$columns = array(); 
			$col = array();
			
			$col[]   = array('text' => 'Total Merengadas', 	'width' => '100', 'height' => '3', 'align' => 'L', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
			$col[]   = array('text' => number_format($submeren,2,',','.'), 	'width' => '30', 'height' => '3', 'align' => 'R', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
			
			
			$columns[] = $col;
			$pdf->SetX(3);
			$pdf->WriteTable($columns);

		}
		if(count($data9)>0){
			$columns = array(); 
			$col = array();
			
			$col[]   = array('text' => 'Total Golosinas', 	'width' => '100', 'height' => '3', 'align' => 'L', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
			$col[]   = array('text' => number_format($subgolo,2,',','.'), 	'width' => '30', 'height' => '3', 'align' => 'R', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
			
			
			$columns[] = $col;
			$pdf->SetX(3);
			$pdf->WriteTable($columns);

		}

		

		$columns = array(); 
		$col = array();
		
		$col[]   = array('text' => '', 	'width' => '100', 'height' => '3', 'align' => 'L', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
		$col[]   = array('text' => '=============', 	'width' => '30', 'height' => '3', 'align' => 'R', 'font_name' => 'Courier', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
		
		
		$columns[] = $col;
		$pdf->SetX(3);
		$pdf->WriteTable($columns);
		
		if(!isset($subpizzas)) $subpizzas=0;
		if(!isset($subadi)) $subadi=0;
		if(!isset($subcarne)) $subcarne=0;
		if(!isset($subbebi)) $subbebi=0;
		if(!isset($sublic)) $sublic=0;
		if(!isset($subenv)) $subenv=0;
		if(!isset($subotros)) $subotros=0;
		if(!isset($subhelad)) $subhelad=0;
		if(!isset($submeren)) $submeren=0;
		if(!isset($subgolo)) $subgolo=0;
		

		$gene= $subpizzas+$subadi+$subcarne+$subbebi+$sublic+$subenv+$subotros+$subhelad+$submeren+$subgolo;
	

		$columns = array(); 
		$col = array();
		
		$col[]   = array('text' => 'Total General', 	'width' => '100', 'height' => '3', 'align' => 'L', 'font_name' => 'Courier', 'font_size' => '10', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
		$col[]   = array('text' => number_format($gene,2,',','.'), 	'width' => '30', 'height' => '3', 'align' => 'R', 'font_name' => 'Courier', 'font_size' => '10', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '32, 32, 32', 'drawcolor' => '139, 141, 141', 'linewidth' => '0.05', 'linearea' => '');
		
		
		$columns[] = $col;
		$pdf->SetX(3);
		$pdf->WriteTable($columns);

		$pdf->Ln(5);

		$_SESSION['alturav']=$pdf->GetPageHeight();

			
    $pdf->Output();
?>