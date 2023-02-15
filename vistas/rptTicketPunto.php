<?php
session_start();
if (isset($_SESSION['usuId'])){
			$usuario = $_SESSION['usuId'];
			$base = 'pizzeria';
}else{
			header('Location:../index.php');
  
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



if(($handle = @fopen("COM5", "w")) === FALSE){
        die('No se puedo Imprimir, Verifique su conexion con la impresora');
    }

$dato = 'probandoooooo';

fwrite($handle,chr(27). chr(64));//reinicio

//fwrite($handle, chr(27). chr(112). chr(48));//ABRIR EL CAJON
fwrite($handle, chr(27). chr(100). chr(0));//salto de linea VACIO
fwrite($handle, chr(27). chr(33). chr(8));//negrita
fwrite($handle, chr(27). chr(97). chr(1)."P&R Flaco's C.A.");//centrado
fwrite($handle,"P&R Flaco's C.A.");
fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
fwrite($handle, chr(27). chr(32). chr(3));//ESTACIO ENTRE LETRAS
fwrite($handle, chr(27). chr(97). chr(1));//centrado
fwrite($handle,"Orden de Compra");
fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
fwrite($handle, chr(27). chr(32). chr(3));//ESTACIO ENTRE LETRAS
fwrite($handle, chr(27). chr(97). chr(1));//centrado
fwrite($handle,"SIN VALOR FISCAL");

fwrite($handle, chr(27). chr(100). chr(0));//salto de linea VACIO
fwrite($handle, chr(27). chr(33). chr(8));//negrita
fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
fwrite($handle,"=====================================");
fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
fwrite($handle,"PALABRA A IMPRIMIR: ".$dato);


fclose($handle); // cierra el fichero PRN
$salida = shell_exec('lpr COM5'); //lpr->puerto impresora, imprimir archivo PRN
?>