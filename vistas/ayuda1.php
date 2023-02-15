<?php
session_start();
if (isset($_SESSION['usuId'])){
			$usuario = $_SESSION['usuId'];
			$base = 'pizzeria';
}else{
			header('Location:../index.php');
}

$nombre_archivo = 'reporteFactura.txt';
fopen($nombre_archivo, 'a+');
if (is_writable($nombre_archivo)) {
	if (!$handle = fopen($nombre_archivo, 'a')) {
	echo "No se puede abrir el archivo ($nombre_archivo)";
	exit;
	}
	$fecha_emision='15/06/2017';
	$razon_soc='P&R Flacos C.A';
	$serie='LKH';
	$numero='123';
	$direccion='direccion';
	$condicion='condicion';
	$ruc='ruc';
	$oc='oc';

	/*fwrite($handle,chr(13).chr(10));
	fwrite($handle,chr(13).chr(10));
	fwrite($handle,chr(13).chr(10));

	fwrite($handle," ".$fecha_emision);
	fwrite($handle,chr(13).chr(10));
	fwrite($handle,str_pad(" ".$razon_soc,100,' ',STR_PAD_RIGHT));
	fwrite($handle,$serie."-".$numero);
	fwrite($handle,chr(13).chr(10));
	fwrite($handle,str_pad(" ".$direccion,100,' ',STR_PAD_RIGHT));
	fwrite($handle,$condicion);
	fwrite($handle,chr(13).chr(10));
	fwrite($handle,str_pad($ruc,100,' ',STR_PAD_LEFT));
	fwrite($handle,chr(13).chr(10));
	fwrite($handle,str_pad($oc,100,' ',STR_PAD_LEFT));*/

	$dato = 'probandoooooo';

fwrite($handle,chr(27). chr(64));//reinicio

//fwrite($handle, chr(27). chr(112). chr(48));//ABRIR EL CAJON
fwrite($handle, chr(27). chr(100). chr(0));//salto de linea VACIO
fwrite($handle, chr(27). chr(33). chr(8));//negrita
fwrite($handle, chr(27). chr(97). chr(1));//centrado
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
}
	fclose($handle); // cierra el fichero PRN
$salida = shell_exec('lpr COM5');

?>