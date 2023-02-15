<?php
session_start();
if (isset($_SESSION['usuId'])){
			$usuario = $_SESSION['usuId'];
			$base = 'pizzeria';
}else{
			header('Location:../index.php');
}

	include_once("../modelo/rptTicket.class.php");
	$objeto = new rptTicket;
	$objeto->con->BaseDatos = $base;

	foreach ($_GET as $variable => $valor){
		$$variable = htmlspecialchars($valor);
	}

	foreach ($_POST as $variable => $valor){
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
	$cajero = utf8_decode(ucwords(strtolower($_SESSION['usuNombres'])));
	
 

if(($handle = @fopen("LPT1", "w")) === FALSE){
die('No se puedo Imprimir, Verifique su conexion con la impresora');
}

fwrite($handle,chr(27). chr(64));//reinicio

//***********************E N C A B E Z A D O *************************//

fwrite($handle, chr(27). chr(33). chr(8));//negrita
fwrite($handle, chr(27). chr(97). chr(1));//centrado
fwrite($handle,"=================================");
fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
fwrite($handle, chr(27). chr(32). chr(3));//ESPACIO ENTRE CADENAS
fwrite($handle,"P&R FLACO'S C.A.");
fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
fwrite($handle,"Reporte Z");
fwrite($handle, chr(27). chr(100). chr(1));//salto de linea

fwrite($handle, chr(27). chr(97). chr(0));//Izquierda
fwrite($handle,"Cajero: ".$cajero);
fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
fwrite($handle, chr(27). chr(100). chr(0));//salto de linea VACIO
fwrite($handle, chr(27). chr(97). chr(2)); //->Derecha
fwrite($handle,$fechahora);
fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
fwrite($handle, chr(27). chr(97). chr(1));//centrado
fwrite($handle, chr(27). chr(4));//comprimir resultado
fwrite($handle,$desde." / ".$hasta);

fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
fwrite($handle,"==========================");
fwrite($handle, chr(27). chr(100). chr(1));//salto de linea

/*****************************P I Z Z A S **************************************/

if(count($data)>0){
		fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
		fwrite($handle, chr(27). chr(97). chr(1));//centrado
		fwrite($handle, chr(27). chr(4));//comprimir resultado
		fwrite($handle,"Pizzas Vendidas");
		fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
		fwrite($handle, chr(27). chr(97). chr(0));//Izquierda
		fwrite($handle, chr(27). chr(100). chr(0));//salto de linea VACIO
		fwrite($handle, chr(27). chr(32). chr(3));//ESPACIO ENTRE CADENAS

		fwrite($handle,"Menu   Cantidad   Importe");
		fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
        $cantpizzas=0;
		$subpizzas=0;

		foreach ($data as $row) {

			$prech = number_format($row['precio'],2,',','.');			
			$menu = ucwords(strtolower(utf8_decode($row['descrip'])));
			$menux =substr($menu,0,26);
    
			fwrite($handle, chr(27). chr(97). chr(0));//Izquierda
			fwrite($handle, chr(27). chr(33). chr(4));//comprimir resultado
			fwrite($handle,$menux);
		    fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
			fwrite($handle, chr(27). chr(32). chr(3));//ESPACIO ENTRE CADENAS
			fwrite($handle, chr(27). chr(33). chr(4));//comprimir resultado
			fwrite($handle, chr(27). chr(97). chr(2)); //->Derecha
			fwrite($handle,'     '.$row['canti'].' '.$prech);
			fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
			
			$cantpizzas+=$row['canti'];
			$subpizzas+=$row['total'];

		}//chr(27)+"!"+chr(64)

		fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
        $subpizzasx =number_format($subpizzas,2,',','.');
		fwrite($handle, chr(27). chr(32). chr(3));//ESPACIO ENTRE CADENAS
		fwrite($handle, chr(27). chr(97). chr(0));//Izquierda
		fwrite($handle, chr(27). chr(33). chr(4));//comprimir resultado
		fwrite($handle,'Cant. de Pizzas         '.$cantpizzas);
		fwrite($handle, chr(27). chr(100). chr(1));//salto de linea

		fwrite($handle, chr(27). chr(32). chr(3));//ESPACIO ENTRE CADENAS
		fwrite($handle, chr(27). chr(97). chr(0));//Izquierda
		fwrite($handle, chr(27). chr(33). chr(4));//comprimir resultado
		fwrite($handle,'SubTotal        '.$subpizzasx);
		fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
}

/*****************************Adicionales **************************************/

if(count($data1)>0){
		fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
		fwrite($handle, chr(27). chr(97). chr(1));//centrado
		fwrite($handle, chr(27). chr(4));//comprimir resultado
		fwrite($handle,"Adicionales Vendidos");
		fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
		fwrite($handle, chr(27). chr(97). chr(0));//Izquierda
		fwrite($handle, chr(27). chr(100). chr(0));//salto de linea VACIO
		fwrite($handle, chr(27). chr(32). chr(3));//ESPACIO ENTRE CADENAS

		fwrite($handle,"Menu   Cantidad   Importe");
		fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
        $cantadi=0;
		$subadi=0;

		foreach ($data1 as $row) {

			$prech = number_format($row['precio'],2,',','.');			
			$menu = ucwords(strtolower(utf8_decode($row['descrip'])));
			$menux =substr($menu,0,26);
    
			fwrite($handle, chr(27). chr(97). chr(0));//Izquierda
			fwrite($handle, chr(27). chr(33). chr(4));//comprimir resultado
			fwrite($handle,$menux);
		    fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
			fwrite($handle, chr(27). chr(32). chr(3));//ESPACIO ENTRE CADENAS
			fwrite($handle, chr(27). chr(33). chr(4));//comprimir resultado
			fwrite($handle, chr(27). chr(97). chr(2)); //->Derecha
			fwrite($handle,'     '.$row['canti'].' '.$prech);
			fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
			
			$cantadi+=$row['canti'];
			$subadi+=$row['total'];

		}//chr(27)+"!"+chr(64)

		fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
        $subadix =number_format($subadi,2,',','.');
		fwrite($handle, chr(27). chr(32). chr(3));//ESPACIO ENTRE CADENAS
		fwrite($handle, chr(27). chr(97). chr(0));//Izquierda
		fwrite($handle, chr(27). chr(33). chr(4));//comprimir resultado
		fwrite($handle,'Cant. de Adicionales       '.$cantadi);
		fwrite($handle, chr(27). chr(100). chr(1));//salto de linea

		fwrite($handle, chr(27). chr(32). chr(3));//ESPACIO ENTRE CADENAS
		fwrite($handle, chr(27). chr(97). chr(0));//Izquierda
		fwrite($handle, chr(27). chr(33). chr(4));//comprimir resultado
		fwrite($handle,'SubTotal        '.$subadi);
		fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
}

/*****************************Carnes **************************************/

if(count($data2)>0){
		fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
		fwrite($handle, chr(27). chr(97). chr(1));//centrado
		fwrite($handle, chr(27). chr(4));//comprimir resultado
		fwrite($handle,"Carnes Vendidos");
		fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
		fwrite($handle, chr(27). chr(97). chr(0));//Izquierda
		fwrite($handle, chr(27). chr(100). chr(0));//salto de linea VACIO
		fwrite($handle, chr(27). chr(32). chr(3));//ESPACIO ENTRE CADENAS

		fwrite($handle,"Menu   Cantidad   Importe");
		fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
        $cantcar=0;
		$subcarne=0;

		foreach ($data2 as $row) {

			$prech = number_format($row['precio'],2,',','.');			
			$menu = ucwords(strtolower(utf8_decode($row['descrip'])));
			$menux =substr($menu,0,26);
    
			fwrite($handle, chr(27). chr(97). chr(0));//Izquierda
			fwrite($handle, chr(27). chr(33). chr(4));//comprimir resultado
			fwrite($handle,$menux);
		    fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
			fwrite($handle, chr(27). chr(32). chr(3));//ESPACIO ENTRE CADENAS
			fwrite($handle, chr(27). chr(33). chr(4));//comprimir resultado
			fwrite($handle, chr(27). chr(97). chr(2)); //->Derecha
			fwrite($handle,'     '.$row['canti'].' '.$prech);
			fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
			
			$cantcar+=$row['canti'];
			$subcarne+=$row['total'];

		}//chr(27)+"!"+chr(64)

		fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
        $subcarnex =number_format($subcarne,2,',','.');
		fwrite($handle, chr(27). chr(32). chr(3));//ESPACIO ENTRE CADENAS
		fwrite($handle, chr(27). chr(97). chr(0));//Izquierda
		fwrite($handle, chr(27). chr(33). chr(4));//comprimir resultado
		fwrite($handle,'Cant. de Carnes       '.$cantcar);
		fwrite($handle, chr(27). chr(100). chr(1));//salto de linea

		fwrite($handle, chr(27). chr(32). chr(3));//ESPACIO ENTRE CADENAS
		fwrite($handle, chr(27). chr(97). chr(0));//Izquierda
		fwrite($handle, chr(27). chr(33). chr(4));//comprimir resultado
		fwrite($handle,'SubTotal        '.$subcarnex);
		fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
}

/*****************************Bebidas **************************************/

if(count($data3)>0){
		fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
		fwrite($handle, chr(27). chr(97). chr(1));//centrado
		fwrite($handle, chr(27). chr(4));//comprimir resultado
		fwrite($handle,"Bebidas Vendidas");
		fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
		fwrite($handle, chr(27). chr(97). chr(0));//Izquierda
		fwrite($handle, chr(27). chr(100). chr(0));//salto de linea VACIO
		fwrite($handle, chr(27). chr(32). chr(3));//ESPACIO ENTRE CADENAS

		fwrite($handle,"Menu   Cantidad   Importe");
		fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
        $cantbebi=0;
		$subbebi=0;

		foreach ($data3 as $row) {

			$prech = number_format($row['precio'],2,',','.');			
			$menu = ucwords(strtolower(utf8_decode($row['descrip'])));
			$menux =substr($menu,0,26);
    
			fwrite($handle, chr(27). chr(97). chr(0));//Izquierda
			fwrite($handle, chr(27). chr(33). chr(4));//comprimir resultado
			fwrite($handle,$menux);
		    fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
			fwrite($handle, chr(27). chr(32). chr(3));//ESPACIO ENTRE CADENAS
			fwrite($handle, chr(27). chr(33). chr(4));//comprimir resultado
			fwrite($handle, chr(27). chr(97). chr(2)); //->Derecha
			fwrite($handle,'     '.$row['canti'].' '.$prech);
			fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
			
			$cantbebi+=$row['canti'];
			$subbebi+=$row['total'];

		}//chr(27)+"!"+chr(64)

		fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
        $subbebix =number_format($subbebi,2,',','.');
		fwrite($handle, chr(27). chr(32). chr(3));//ESPACIO ENTRE CADENAS
		fwrite($handle, chr(27). chr(97). chr(0));//Izquierda
		fwrite($handle, chr(27). chr(33). chr(4));//comprimir resultado
		fwrite($handle,'Cant. de Bebidas     '.$cantbebi);
		fwrite($handle, chr(27). chr(100). chr(1));//salto de linea

		fwrite($handle, chr(27). chr(32). chr(3));//ESPACIO ENTRE CADENAS
		fwrite($handle, chr(27). chr(97). chr(0));//Izquierda
		fwrite($handle, chr(27). chr(33). chr(4));//comprimir resultado
		fwrite($handle,'SubTotal        '.$subbebix);
		fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
}

/*****************************Licores **************************************/

if(count($data4)>0){
		fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
		fwrite($handle, chr(27). chr(97). chr(1));//centrado
		fwrite($handle, chr(27). chr(4));//comprimir resultado
		fwrite($handle,"Licores Vendidos");
		fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
		fwrite($handle, chr(27). chr(97). chr(0));//Izquierda
		fwrite($handle, chr(27). chr(100). chr(0));//salto de linea VACIO
		fwrite($handle, chr(27). chr(32). chr(3));//ESPACIO ENTRE CADENAS

		fwrite($handle,"Menu   Cantidad   Importe");
		fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
        $cantlic=0;
		$sublic=0;

		foreach ($data4 as $row) {

			$prech = number_format($row['precio'],2,',','.');			
			$menu = ucwords(strtolower(utf8_decode($row['descrip'])));
			$menux =substr($menu,0,26);
    
			fwrite($handle, chr(27). chr(97). chr(0));//Izquierda
			fwrite($handle, chr(27). chr(33). chr(4));//comprimir resultado
			fwrite($handle,$menux);
		    fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
			fwrite($handle, chr(27). chr(32). chr(3));//ESPACIO ENTRE CADENAS
			fwrite($handle, chr(27). chr(33). chr(4));//comprimir resultado
			fwrite($handle, chr(27). chr(97). chr(2)); //->Derecha
			fwrite($handle,'     '.$row['canti'].' '.$prech);
			fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
			
			$cantlic+=$row['canti'];
			$sublic+=$row['total'];

		}//chr(27)+"!"+chr(64)

		fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
        $sublicx =number_format($sublic,2,',','.');
		fwrite($handle, chr(27). chr(32). chr(3));//ESPACIO ENTRE CADENAS
		fwrite($handle, chr(27). chr(97). chr(0));//Izquierda
		fwrite($handle, chr(27). chr(33). chr(4));//comprimir resultado
		fwrite($handle,'Cant. de Licores    '.$cantlic);
		fwrite($handle, chr(27). chr(100). chr(1));//salto de linea

		fwrite($handle, chr(27). chr(32). chr(3));//ESPACIO ENTRE CADENAS
		fwrite($handle, chr(27). chr(97). chr(0));//Izquierda
		fwrite($handle, chr(27). chr(33). chr(4));//comprimir resultado
		fwrite($handle,'SubTotal        '.$sublicx);
		fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
}

/*****************************Envases **************************************/

if(count($data5)>0){
		fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
		fwrite($handle, chr(27). chr(97). chr(1));//centrado
		fwrite($handle, chr(27). chr(4));//comprimir resultado
		fwrite($handle,"Envases Vendidos");
		fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
		fwrite($handle, chr(27). chr(97). chr(0));//Izquierda
		fwrite($handle, chr(27). chr(100). chr(0));//salto de linea VACIO
		fwrite($handle, chr(27). chr(32). chr(3));//ESPACIO ENTRE CADENAS

		fwrite($handle,"Menu   Cantidad   Importe");
		fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
        $cantenv=0;
		$subenv=0;

		foreach ($data5 as $row) {

			$prech = number_format($row['precio'],2,',','.');			
			$menu = ucwords(strtolower(utf8_decode($row['descrip'])));
			$menux =substr($menu,0,26);
    
			fwrite($handle, chr(27). chr(97). chr(0));//Izquierda
			fwrite($handle, chr(27). chr(33). chr(4));//comprimir resultado
			fwrite($handle,$menux);
		    fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
			fwrite($handle, chr(27). chr(32). chr(3));//ESPACIO ENTRE CADENAS
			fwrite($handle, chr(27). chr(33). chr(4));//comprimir resultado
			fwrite($handle, chr(27). chr(97). chr(2)); //->Derecha
			fwrite($handle,'     '.$row['canti'].' '.$prech);
			fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
			
			$cantenv+=$row['canti'];
			$subenv+=$row['total'];

		}//chr(27)+"!"+chr(64)

		fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
        $subenvx =number_format($subenv,2,',','.');
		fwrite($handle, chr(27). chr(32). chr(3));//ESPACIO ENTRE CADENAS
		fwrite($handle, chr(27). chr(97). chr(0));//Izquierda
		fwrite($handle, chr(27). chr(33). chr(4));//comprimir resultado
		fwrite($handle,'Cant. de Envases    '.$cantenv);
		fwrite($handle, chr(27). chr(100). chr(1));//salto de linea

		fwrite($handle, chr(27). chr(32). chr(3));//ESPACIO ENTRE CADENAS
		fwrite($handle, chr(27). chr(97). chr(0));//Izquierda
		fwrite($handle, chr(27). chr(33). chr(4));//comprimir resultado
		fwrite($handle,'SubTotal        '.$subenvx);
		fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
}

/*****************************Otros Platos **************************************/

if(count($data6)>0){
		fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
		fwrite($handle, chr(27). chr(97). chr(1));//centrado
		fwrite($handle, chr(27). chr(4));//comprimir resultado
		fwrite($handle,"Otros Platos Vendidos");
		fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
		fwrite($handle, chr(27). chr(97). chr(0));//Izquierda
		fwrite($handle, chr(27). chr(100). chr(0));//salto de linea VACIO
		fwrite($handle, chr(27). chr(32). chr(3));//ESPACIO ENTRE CADENAS

		fwrite($handle,"Menu   Cantidad   Importe");
		fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
        $cantotros=0;
		$subotros=0;

		foreach ($data6 as $row) {

			$prech = number_format($row['precio'],2,',','.');			
			$menu = ucwords(strtolower(utf8_decode($row['descrip'])));
			$menux =substr($menu,0,26);
    
			fwrite($handle, chr(27). chr(97). chr(0));//Izquierda
			fwrite($handle, chr(27). chr(33). chr(4));//comprimir resultado
			fwrite($handle,$menux);
		    fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
			fwrite($handle, chr(27). chr(32). chr(3));//ESPACIO ENTRE CADENAS
			fwrite($handle, chr(27). chr(33). chr(4));//comprimir resultado
			fwrite($handle, chr(27). chr(97). chr(2)); //->Derecha
			fwrite($handle,'     '.$row['canti'].' '.$prech);
			fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
			
			$cantotros+=$row['canti'];
			$subotros+=$row['total'];

		}//chr(27)+"!"+chr(64)

		fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
        $subotrosx =number_format($subotros,2,',','.');
		fwrite($handle, chr(27). chr(32). chr(3));//ESPACIO ENTRE CADENAS
		fwrite($handle, chr(27). chr(97). chr(0));//Izquierda
		fwrite($handle, chr(27). chr(33). chr(4));//comprimir resultado
		fwrite($handle,'Cant. Otros Platos   '.$cantotros);
		fwrite($handle, chr(27). chr(100). chr(1));//salto de linea

		fwrite($handle, chr(27). chr(32). chr(3));//ESPACIO ENTRE CADENAS
		fwrite($handle, chr(27). chr(97). chr(0));//Izquierda
		fwrite($handle, chr(27). chr(33). chr(4));//comprimir resultado
		fwrite($handle,'SubTotal        '.$subotrosx);
		fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
}

/*****************************Helados **************************************/

if(count($data7)>0){
		fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
		fwrite($handle, chr(27). chr(97). chr(1));//centrado
		fwrite($handle, chr(27). chr(4));//comprimir resultado
		fwrite($handle,"Helados Vendidos");
		fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
		fwrite($handle, chr(27). chr(97). chr(0));//Izquierda
		fwrite($handle, chr(27). chr(100). chr(0));//salto de linea VACIO
		fwrite($handle, chr(27). chr(32). chr(3));//ESPACIO ENTRE CADENAS

		fwrite($handle,"Menu   Cantidad   Importe");
		fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
        $canthelad=0;
		$subhelad=0;

		foreach ($data7 as $row) {

			$prech = number_format($row['precio'],2,',','.');			
			$menu = ucwords(strtolower(utf8_decode($row['descrip'])));
			$menux =substr($menu,0,26);
    
			fwrite($handle, chr(27). chr(97). chr(0));//Izquierda
			fwrite($handle, chr(27). chr(33). chr(4));//comprimir resultado
			fwrite($handle,$menux);
		    fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
			fwrite($handle, chr(27). chr(32). chr(3));//ESPACIO ENTRE CADENAS
			fwrite($handle, chr(27). chr(33). chr(4));//comprimir resultado
			fwrite($handle, chr(27). chr(97). chr(2)); //->Derecha
			fwrite($handle,'     '.$row['canti'].' '.$prech);
			fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
			
			$canthelad+=$row['canti'];
			$subhelad+=$row['total'];

		}//chr(27)+"!"+chr(64)

		fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
        $subheladx =number_format($subhelad,2,',','.');
		fwrite($handle, chr(27). chr(32). chr(3));//ESPACIO ENTRE CADENAS
		fwrite($handle, chr(27). chr(97). chr(0));//Izquierda
		fwrite($handle, chr(27). chr(33). chr(4));//comprimir resultado
		fwrite($handle,'Cant. Helados   '.$canthelad);
		fwrite($handle, chr(27). chr(100). chr(1));//salto de linea

		fwrite($handle, chr(27). chr(32). chr(3));//ESPACIO ENTRE CADENAS
		fwrite($handle, chr(27). chr(97). chr(0));//Izquierda
		fwrite($handle, chr(27). chr(33). chr(4));//comprimir resultado
		fwrite($handle,'SubTotal        '.$subheladx);
		fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
}

/*****************************Merengadas **************************************/

if(count($data8)>0){
		fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
		fwrite($handle, chr(27). chr(97). chr(1));//centrado
		fwrite($handle, chr(27). chr(4));//comprimir resultado
		fwrite($handle,"Merengadas Vendidas");
		fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
		fwrite($handle, chr(27). chr(97). chr(0));//Izquierda
		fwrite($handle, chr(27). chr(100). chr(0));//salto de linea VACIO
		fwrite($handle, chr(27). chr(32). chr(3));//ESPACIO ENTRE CADENAS

		fwrite($handle,"Menu   Cantidad   Importe");
		fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
        $cantmeren=0;
		$submeren=0;

		foreach ($data8 as $row) {

			$prech = number_format($row['precio'],2,',','.');			
			$menu = ucwords(strtolower(utf8_decode($row['descrip'])));
			$menux =substr($menu,0,26);
    
			fwrite($handle, chr(27). chr(97). chr(0));//Izquierda
			fwrite($handle, chr(27). chr(33). chr(4));//comprimir resultado
			fwrite($handle,$menux);
		    fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
			fwrite($handle, chr(27). chr(32). chr(3));//ESPACIO ENTRE CADENAS
			fwrite($handle, chr(27). chr(33). chr(4));//comprimir resultado
			fwrite($handle, chr(27). chr(97). chr(2)); //->Derecha
			fwrite($handle,'     '.$row['canti'].' '.$prech);
			fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
			
			$cantmeren+=$row['canti'];
			$submeren+=$row['total'];

		}//chr(27)+"!"+chr(64)

		fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
        $submerenx =number_format($submeren,2,',','.');
		fwrite($handle, chr(27). chr(32). chr(3));//ESPACIO ENTRE CADENAS
		fwrite($handle, chr(27). chr(97). chr(0));//Izquierda
		fwrite($handle, chr(27). chr(33). chr(4));//comprimir resultado
		fwrite($handle,'Cant. Merengadas   '.$cantmeren);
		fwrite($handle, chr(27). chr(100). chr(1));//salto de linea

		fwrite($handle, chr(27). chr(32). chr(3));//ESPACIO ENTRE CADENAS
		fwrite($handle, chr(27). chr(97). chr(0));//Izquierda
		fwrite($handle, chr(27). chr(33). chr(4));//comprimir resultado
		fwrite($handle,'SubTotal        '.$submerenx);
		fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
}

/*****************************Golosinas **************************************/

if(count($data9)>0){
		fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
		fwrite($handle, chr(27). chr(97). chr(1));//centrado
		fwrite($handle, chr(27). chr(4));//comprimir resultado
		fwrite($handle,"Golosinas Vendidas");
		fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
		fwrite($handle, chr(27). chr(97). chr(0));//Izquierda
		fwrite($handle, chr(27). chr(100). chr(0));//salto de linea VACIO
		fwrite($handle, chr(27). chr(32). chr(3));//ESPACIO ENTRE CADENAS

		fwrite($handle,"Menu   Cantidad   Importe");
		fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
        $cantgolo=0;
		$subgolo=0;

		foreach ($data9 as $row) {

			$prech = number_format($row['precio'],2,',','.');			
			$menu = ucwords(strtolower(utf8_decode($row['descrip'])));
			$menux =substr($menu,0,26);
    
			fwrite($handle, chr(27). chr(97). chr(0));//Izquierda
			fwrite($handle, chr(27). chr(33). chr(4));//comprimir resultado
			fwrite($handle,$menux);
		    fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
			fwrite($handle, chr(27). chr(32). chr(3));//ESPACIO ENTRE CADENAS
			fwrite($handle, chr(27). chr(33). chr(4));//comprimir resultado
			fwrite($handle, chr(27). chr(97). chr(2)); //->Derecha
			fwrite($handle,'     '.$row['canti'].' '.$prech);
			fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
			
			$cantgolo+=$row['canti'];
			$subgolo+=$row['total'];

		}

		fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
        $subgolox =number_format($subgolo,2,',','.');
		fwrite($handle, chr(27). chr(32). chr(3));//ESPACIO ENTRE CADENAS
		fwrite($handle, chr(27). chr(97). chr(0));//Izquierda
		fwrite($handle, chr(27). chr(33). chr(4));//comprimir resultado
		fwrite($handle,'Cant. Golosinas   '.$cantgolo);
		fwrite($handle, chr(27). chr(100). chr(1));//salto de linea

		fwrite($handle, chr(27). chr(32). chr(3));//ESPACIO ENTRE CADENAS
		fwrite($handle, chr(27). chr(97). chr(0));//Izquierda
		fwrite($handle, chr(27). chr(33). chr(4));//comprimir resultado
		fwrite($handle,'SubTotal        '.$subgolox);
		fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
}

fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
fwrite($handle, chr(27). chr(97). chr(1));//centrado
fwrite($handle,"==========================");
fwrite($handle, chr(27). chr(100). chr(1));//salto de linea

fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
fwrite($handle, chr(27). chr(97). chr(1));//centrado
fwrite($handle,"TOTALES GENERALES (Bs.)");
fwrite($handle, chr(27). chr(100). chr(1));//salto de linea

if(count($data)>0){
	fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
	fwrite($handle, chr(27). chr(97). chr(2)); //->Derecha
	fwrite($handle,"Total Pizzas ".$subpizzasx);
	fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
}

if(count($data1)>0){
	fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
	fwrite($handle, chr(27). chr(97). chr(2)); //->Derecha
	fwrite($handle,"Total Adicionales ".$subadix);
	fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
}

if(count($data2)>0){
	fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
	fwrite($handle, chr(27). chr(97). chr(2)); //->Derecha
	fwrite($handle,"Total Carnes ".$subcarnex);
	fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
}

if(count($data3)>0){
	fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
	fwrite($handle, chr(27). chr(97). chr(2)); //->Derecha
	fwrite($handle,"Total Bebidas ".$subbebix);
	fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
}
if(count($data4)>0){
	fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
	fwrite($handle, chr(27). chr(97). chr(2)); //->Derecha
	fwrite($handle,"Total Licores ".$sublicx);
	fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
}
if(count($data5)>0){
	fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
	fwrite($handle, chr(27). chr(97). chr(2)); //->Derecha
	fwrite($handle,"Total Envases ".$subenvx);
	fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
}
if(count($data6)>0){
	fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
	fwrite($handle, chr(27). chr(97). chr(2)); //->Derecha
	fwrite($handle,"Total Otros Platos ".$subotrosx);
	fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
}
if(count($data7)>0){
	fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
	fwrite($handle, chr(27). chr(97). chr(2)); //->Derecha
	fwrite($handle,"Total Helados ".$subheladx);
	fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
}
if(count($data8)>0){
	fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
	fwrite($handle, chr(27). chr(97). chr(2)); //->Derecha
	fwrite($handle,"Total Merengadas ".$submerenx);
	fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
}
if(count($data9)>0){
	fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
	fwrite($handle, chr(27). chr(97). chr(2)); //->Derecha
	fwrite($handle,"Total Golosinas ".$subgolox);
	fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
}

	fwrite($handle, chr(27). chr(32). chr(3));//ESPACIO ENTRE CADENAS
	fwrite($handle, chr(27). chr(97). chr(2)); //->Derecha
	fwrite($handle, chr(27). chr(33). chr(4));//comprimir resultado
	fwrite($handle,'===========');
	fwrite($handle, chr(27). chr(100). chr(1));//salto de linea

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
		$genex = number_format($gene,2,',','.');	

    fwrite($handle, chr(27). chr(32). chr(3));//ESPACIO ENTRE CADENAS
	fwrite($handle, chr(27). chr(97). chr(2)); //->Derecha
	fwrite($handle, chr(27). chr(33). chr(4));//comprimir resultado
	fwrite($handle,'Total General '.$genex);
	fwrite($handle, chr(27). chr(100). chr(1));//salto de linea



	fwrite($handle, chr(27). chr(97). chr(1));//centrado
	fwrite($handle,"==========================");
	fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
	fwrite($handle,"Gracias Por Preferirnos");
	fwrite($handle, chr(27). chr(100). chr(6));//salto de linea
	fwrite($handle, chr(29). chr(86). chr(1));//corta hoja automaticamente 
	fclose($handle); // cierra el fichero PRN
	$salida = shell_exec('lpr LPT1'); //lpr->puerto impresora, imprimir archivo PRN

?>