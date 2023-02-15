<?php
session_start();

if (isset($_SESSION['usuId'])){
	
	include("../header.php");
	$usuario = $_SESSION['usuId'];

?>
	<script src="../compartida/libreria/jquery/js/jquery.hoverdir.js" type="text/javascript"></script>
		<script type="text/javascript">
			$(function() {
			
				$(' #da-thumbs > li ').each( function() { $(this).hoverdir(); } );

			});
		</script>
<br/>
	
  <div id="pie-pag" >	
	<?php //include("../footer.php");?>
	 <?php

		}else {
			include("../validar.php");
			?> 
				<script type="text/javascript">
							function redireccionar(){
							  alerta ('No tiene perrmisos para acceder a esta página');
							  window.location="../index.php";
							}  
							setTimeout ("redireccionar()", 1000); //tiempo de espera en milisegundos
				 </script> 
		<?php } ?> 	