<?php
	session_start();
	$_SESSION['logeado']=FALSE;
	
	header('Location: ../../index_org.php');
?>

