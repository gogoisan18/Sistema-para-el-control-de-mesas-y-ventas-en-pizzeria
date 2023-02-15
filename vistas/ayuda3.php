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
	
	$tickx=(int)$tick;
	$data  = $objeto->cajero($tickx);
	$data1 = $objeto->compras($tickx);
	$data2 = $objeto->detalle($tickx);
	$data3 = $objeto->resx($tickx);
	
	
	foreach($data as $row){
		
		$fecha = $objeto->convertirFecha($row['fecha']);
		$cajero = ucwords(strtolower(utf8_decode($row['cajero'])));
		$hora = $row['hora'];
		$pago= $row['pago'];
		$tipo= $row['tipo'];
	}
  

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

fwrite($handle, chr(27). chr(97). chr(0));//Izquierda
fwrite($handle,"Cajero: ".$cajero);
fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
fwrite($handle, chr(27). chr(100). chr(0));//salto de linea VACIO
fwrite($handle, chr(27). chr(97). chr(2)); //->Derecha
fwrite($handle,$fecha.' '.$hora);
fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
fwrite($handle, chr(27). chr(97). chr(1));//centrado
fwrite($handle," Orden # ".$pago);

fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
fwrite($handle, chr(27). chr(97). chr(1));//centrado
fwrite($handle,"==========================");
fwrite($handle, chr(27). chr(100). chr(1));//salto de linea

//***********************E N C A B E Z A D O   D E DETALLE *************************//
fwrite($handle, chr(27). chr(97). chr(1));//centrado
fwrite($handle, chr(27). chr(100). chr(0));//salto de linea VACIO
fwrite($handle, chr(27). chr(32). chr(3));//ESPACIO ENTRE CADENAS

fwrite($handle,"Menu  Cant.  Prec. Importe");
fwrite($handle, chr(27). chr(100). chr(1));//salto de linea

//***********************CUERPO DEL REPORTE*************************//

foreach ($data1 as $row) {

	 $prech = number_format($row['precio'],2,',','.');				
	 $resul = $row['precio']*$row['canti'];
	 $montoh = number_format($resul,2,',','.');
	 $menu = ucwords(strtolower(utf8_decode($row['descrip'])));
	 $menux =substr($menu,0,26);

	fwrite($handle, chr(27). chr(97). chr(0));//Izquierda
	fwrite($handle, chr(27). chr(33). chr(4));//comprimir resultado
	fwrite($handle, chr(27). chr(33). chr(0));//fuente 10 cpp
	fwrite($handle,$menux);
    fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
	fwrite($handle, chr(27). chr(32). chr(3));//ESPACIO ENTRE CADENAS
	fwrite($handle, chr(27). chr(33). chr(4));//comprimir resultado
	fwrite($handle, chr(27). chr(33). chr(0));//fuente 10 cpp
	fwrite($handle, chr(27). chr(97). chr(2)); //->Derecha
	fwrite($handle,'     '.$row['canti'].' '.$prech.' '.$montoh);
	fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
	fwrite($handle,"--------------------------");
	fwrite($handle, chr(27). chr(100). chr(1));//salto de linea

}

fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
fwrite($handle, chr(27). chr(33). chr(1));//fuente 10 cpp

if($tipo=='C'){

	foreach($data2 as $row){
		$inicial = $row['inicial'];
		$descuento = $row['descuento'];
		$recarga= $row['recarga'];
		$final = ($row['inicial']+$row['recarga'])-$row['descuento'];
        $inicialx= number_format($inicial,2,',','.');
        $recargax= number_format($recarga,2,',','.');
        $descuentox= number_format($descuento,2,',','.');
        $finalx= number_format($final,2,',','.');

		fwrite($handle, chr(27). chr(32). chr(3));//ESPACIO ENTRE CADENAS
		fwrite($handle, chr(27). chr(97). chr(2)); //->Derecha
		fwrite($handle, chr(27). chr(33). chr(4));//comprimir resultado
		fwrite($handle,'Total '.$inicialx);
		fwrite($handle, chr(27). chr(100). chr(1));//salto de linea

		fwrite($handle, chr(27). chr(32). chr(3));//ESPACIO ENTRE CADENAS
		fwrite($handle, chr(27). chr(97). chr(2)); //->Derecha
		fwrite($handle, chr(27). chr(33). chr(4));//comprimir resultado
		fwrite($handle,'Recarga '.$recargax);
		fwrite($handle, chr(27). chr(100). chr(1));//salto de linea

		fwrite($handle, chr(27). chr(32). chr(3));//ESPACIO ENTRE CADENAS
		fwrite($handle, chr(27). chr(97). chr(2)); //->Derecha
		fwrite($handle, chr(27). chr(33). chr(4));//comprimir resultado
		fwrite($handle,'Descuento '.$descuentox);
		fwrite($handle, chr(27). chr(100). chr(1));//salto de linea

		fwrite($handle, chr(27). chr(32). chr(3));//ESPACIO ENTRE CADENAS
		fwrite($handle, chr(27). chr(97). chr(2)); //->Derecha
		fwrite($handle, chr(27). chr(33). chr(4));//comprimir resultado
		fwrite($handle,'Total Final '.$finalx);
		fwrite($handle, chr(27). chr(100). chr(1));//salto de linea

	}

}else{

	foreach($data3 as $row){	
		$monto1 = $row['monto1'];
		$pagos = $row['pagos'];
		$resta = $row['resta'];

		$monto1x= number_format($monto1,2,',','.');
		$pagosx= number_format($pagos,2,',','.');
		$restax= number_format($resta,2,',','.');

		fwrite($handle, chr(27). chr(32). chr(3));//ESPACIO ENTRE CADENAS		
		fwrite($handle, chr(27). chr(97). chr(2)); //->Derecha
		fwrite($handle, chr(27). chr(33). chr(4));//comprimir resultado
		fwrite($handle,'Total '.$monto1x);
		fwrite($handle, chr(27). chr(100). chr(1));//salto de linea

		fwrite($handle, chr(27). chr(32). chr(3));//ESPACIO ENTRE CADENAS
		fwrite($handle, chr(27). chr(97). chr(2)); //->Derecha
		fwrite($handle, chr(27). chr(33). chr(4));//comprimir resultado
		fwrite($handle,'Pago Parcial '.$pagosx);

		fwrite($handle, chr(27). chr(32). chr(3));//ESPACIO ENTRE CADENAS
		fwrite($handle, chr(27). chr(97). chr(2)); //->Derecha
		fwrite($handle, chr(27). chr(33). chr(4));//comprimir resultado
		fwrite($handle,'Resta '.$restax);
		fwrite($handle, chr(27). chr(100). chr(1));//salto de linea


	}

}

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