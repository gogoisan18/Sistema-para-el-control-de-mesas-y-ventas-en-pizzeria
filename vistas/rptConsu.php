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
	
	$data1 = $objeto->consumos($cuenta);
	$fecha = $objeto->ObtenerFechaHora();
  

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
fwrite($handle,"Sin Valor Fiscal");
fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
fwrite($handle, chr(27). chr(100). chr(0));//salto de linea VACIO
fwrite($handle, chr(27). chr(97). chr(2)); //->Derecha
fwrite($handle,$fecha);

fwrite($handle, chr(27). chr(97). chr(1));//centrado
fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
fwrite($handle,"==========================");
fwrite($handle, chr(27). chr(100). chr(1));//salto de linea

//***********************E N C A B E Z A D O   D E DETALLE *************************//
fwrite($handle, chr(27). chr(97). chr(1));//centrado
fwrite($handle, chr(27). chr(100). chr(0));//salto de linea VACIO
fwrite($handle, chr(27). chr(32). chr(3));//ESPACIO ENTRE CADENAS

fwrite($handle,"Menu  Cant.  Prec. Importe");
fwrite($handle, chr(27). chr(100). chr(1));//salto de linea

//***********************CUERPO DEL REPORTE*************************//
$total=0;
foreach($data1 as $row){

	 $prech = number_format($row['precio'],2,',','.');				
	 $resul = $row['precio']*$row['canti'];
	 $montoh = number_format($resul,2,',','.');
	 $menu = ucwords(strtolower(utf8_decode($row['descrip'])));

	fwrite($handle, chr(27). chr(97). chr(0));//Izquierda
	fwrite($handle, chr(27). chr(33). chr(4));//comprimir resultado
	fwrite($handle,$menu);
    fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
	fwrite($handle, chr(27). chr(32). chr(3));//ESPACIO ENTRE CADENAS
	fwrite($handle, chr(27). chr(33). chr(4));//comprimir resultado
	fwrite($handle, chr(27). chr(97). chr(2)); //->Derecha
	fwrite($handle,'     '.$row['canti'].' '.$prech.' '.$montoh);
	fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
	fwrite($handle,"--------------------------");
	fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
    $total+=$resul;
}


    $totalx = number_format($total,2,',','.');	 
    fwrite($handle, chr(27). chr(100). chr(1));//salto de linea

    fwrite($handle, chr(27). chr(32). chr(3));//ESPACIO ENTRE CADENAS
	fwrite($handle, chr(27). chr(97). chr(2)); //->Derecha
	fwrite($handle, chr(27). chr(33). chr(4));//comprimir resultado
	fwrite($handle,'Total '.$totalx);
	fwrite($handle, chr(27). chr(100). chr(1));//salto de linea



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