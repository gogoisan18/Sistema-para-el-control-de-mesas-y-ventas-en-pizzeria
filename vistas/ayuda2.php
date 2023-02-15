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


/*Si se puede amigo, yo también estuve con dolores de cabeza con este tipo de impresoras, 
hasta que este post me ayudo muchisimo, gracias a Sergio Zegarra por haberlo publicado y seguir ayudando 
a los que necesitamos orientación. 

Debes primero compartir tu impresora (te recomiendo ponerle un nombre corto al recurso de red) 
y luego ejecutar el comando ms-dos:

net use lpt1: \\nombre_de_equipo\nombre_impresora_compartida /persistent:yes

Luego ejecuta el codigo, yo hice pruebas directamente ejecutando el archivo prueba.php con este 
codigo en servidor local con xampp (nota cambiar COM5 por LPT1) y funciona perfectamente, espero te ayude:
*/
/**
* @author ZEGARRA CORNE, Sergio
* @copyright 2009
*/


if(($handle = @fopen("LPT1", "w")) === FALSE){
die('No se puedo Imprimir, Verifique su conexion con el Terminal');
}

$dato = $_POST['datos']; 

fwrite($handle,chr(27). chr(64));//reinicio

//fwrite($handle, chr(27). chr(112). chr(48));//ABRIR EL CAJON
fwrite($handle, chr(27). chr(100). chr(0));//salto de linea VACIO
fwrite($handle, chr(27). chr(33). chr(8));//negrita
fwrite($handle, chr(27). chr(97). chr(1));//centrado
fwrite($handle,"=================================");
fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
fwrite($handle, chr(27). chr(32). chr(3));//ESTACIO ENTRE LETRAS
fwrite($handle," ORDEN No 1005 ");
fwrite($handle, chr(27). chr(32). chr(0));//ESTACIO ENTRE LETRAS
fwrite($handle, chr(27). chr(100). chr(0));//salto de linea VACIO
fwrite($handle, chr(27). chr(33). chr(8));//negrita
fwrite($handle, chr(27). chr(100). chr(0));//salto de linea VACIO
fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
fwrite($handle,"RESTAURANT LEGENDS SPORTS");
fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
fwrite($handle,"=================================");
fwrite($handle, chr(27). chr(100). chr(3));//salto de linea
fwrite($handle,"PALABRA A IMPRIMIT: ".$dato);
fwrite($handle, chr(27). chr(100). chr(6));//salto de linea
fwrite($handle, chr(29). chr(86). chr(1));//corta hoja automaticamente


fclose($handle); // cierra el fichero PRN
$salida = shell_exec('lpr LPT1'); //lpr->puerto impresora, imprimir archivo PRN

?>