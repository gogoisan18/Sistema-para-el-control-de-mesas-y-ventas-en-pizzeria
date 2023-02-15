<?php
session_start();
if (isset($_SESSION['usuNombres'])){
	$nombre =  $_SESSION['usuNombres'];
	$texto =ucwords($nombre);
}else{
	$texto = 'Usuario';
}
	
if (isset($_SESSION['tipousu'])){
	$tipo = $_SESSION['tipousu'];
}else{
	$tipo = 'Temporal';
}

?>
<!-- Fin Scripts-->
<br />
<table id="referenciaUsuario" > 
	<tr>
	<td width="4%"><img src="../images/modulos/icon/logeado.png" width="25px" alt="iconLogeado"/></td>
	<td width="96%"><span style="font-family:Arial,Helvetica,sans-serif;" id="nameUser"><?php echo $texto; ?></span><span id="nameTip">&nbsp;&nbsp;&nbsp;<?php echo $tipo; ?></span></td>
	</tr>
</table>
