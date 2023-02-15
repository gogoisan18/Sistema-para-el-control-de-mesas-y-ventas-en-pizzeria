<?php
session_start();
if (isset($_SESSION['usuId'])){
			$usuario = $_SESSION['usuId'];
			$base = 'pizzeria';
}else{
			header('Location:../index.php');
}

$handle = fopen(”\\\\localhost\\FACTURA1”, “w”); // note 1

//LO DEMAS SERIA IGUAL

fwrite($handle,chr(27). chr(64)); //

//Alineación:
fwrite($handle, chr(27). chr(97). chr(0)); //->Izquierda
fwrite($handle, chr(27). chr(97). chr(1)); //->Centro
fwrite($handle, chr(27). chr(97). chr(2)); //->Derecha

fwrite($handle, chr(27). chr(100). chr(N)); //-> Limpia el buffer, 
//y salta N lineas, poner numero de saltos en la ‘N’, admite un 0.

fclose($handle); // cierra el fichero PRN

//Otra forma es instalar y emular un puerto COM/SERIAL desde uno USB, es decir, estos emuladores te crean un puerto ejemplo COM05, es decir, todo lo que envíes al puerto COM5 Virtual lo redireccionaria al puerto USB00X, quedando el llamado así

$handle = fopen(”COM05”, “w”); // note 1

fwrite($handle,chr(27). chr(64));  //->Reinicializa la impresion, 
//esto hay que hacerlo siempre al inicio.

//Alineación:
fwrite($handle, chr(27). chr(97). chr(0)); //->Izquierda
fwrite($handle, chr(27). chr(97). chr(1)); //->Centro
fwrite($handle, chr(27). chr(97). chr(2)); //->Derecha

//Este comando es bastante importante, ya que por ejemplo, en las alineaciones de múltiples palabras en una misma linea, por ejemplo para hacer una columna en centro y otra en derecha, si no hay un limpiado de buffer no funciona.

fwrite($handle, chr(27). chr(100). chr(N)); //-> Limpia el buffer, 
//y salta N lineas, poner numero de saltos en la ‘N’, admite un 0.



//Para cerrar el ‘PRN’ y imprimirlo, como explicamos en anteriores entradas:

fclose($handle); // cierra el fichero PRN
$salida = shell_exec(’lpr PRN’); //lpr->puerto impresora, imprimir archivo PRN

?>