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
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Pizzeria</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="banner, WOW Slider, Slideshow In HTML, Slideshow HTML Code" />
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />  
	<meta name="description" content="banner created with WOW Slider, a free wizard program that helps you easily generate beautiful web slideshow" />
	<link rel="shortcut icon" type="image/x-icon" href="images/icon/#.png" />
	<!-- css -->
		<link rel="stylesheet" type="text/css" href="../engine1/style.css" /> <!--Banner-->
		<link rel="stylesheet" type="text/css" href="../estilo/estilo-cont.css" /> <!--Estilo contenedor-->
        <link rel="stylesheet" type="text/css" href="../estilo/css/style.css" />
	<!-- Scripts -->
			
		<!--  ***************************************Libreria jQuery*************************************************  -->
	    <link rel="stylesheet" type="text/css" media="screen" href="../compartida/libreria/jquery/css/jquery-ui.css" />
		<script src="../compartida/libreria/jquery/js/jquery.min.js" type="text/javascript"></script>
		<script src="../compartida/libreria/jquery/js/jquery-ui.min.js" type="text/javascript"></script>
		<script src="../compartida/libreria/jquery/js/jquery.datepick-es.js" type="text/javascript"></script>
		<script src="../compartida/libreria/jquery/js/jquery.maskedinput.js" type="text/javascript"></script>
		<script src="../compartida/libreria/jquery/js/jquery-ui.multidatespicker.js" type="text/javascript"></script>
		<!--  *******************************************************************************************************  -->
		
		<!--  **********************************************Libreria jqGrid******************************************* -->
		<link rel="stylesheet" type="text/css" media="screen" href="../compartida/libreria/plugins/jqgrid/css/ui.jqgrid.css" />
		<link rel="stylesheet" type="text/css" media="screen" href="../compartida/libreria/plugins/jqgrid/plugins/ui.multiselect.css" />
		<script src="../compartida/libreria/plugins/jqgrid/js/i18n/grid.locale-es.js" type="text/javascript"></script>
		<script type="text/javascript">
			$.jgrid.no_legacy_api = true;
			$.jgrid.useJSON = true;
		</script>
		<script src="../compartida/libreria/plugins/jquery.blockUI.js" type="text/javascript"></script>
		<script src="../compartida/libreria/plugins/jqgrid/js/jquery.jqGrid.src.js" type="text/javascript"></script>
		<script src="../compartida/libreria/plugins/jqgrid/plugins/jquery.tablednd.js" type="text/javascript"></script>
		<script src="../compartida/libreria/plugins/jquery.bt.min.js" type="text/javascript"></script>
		<script src="../compartida/libreria/plugins/jqgrid/plugins/jquery.contextmenu.js" type="text/javascript"></script>
		<!--  ************************************************************************************************************-->	
		
		<!--  ***********************Tap******************************--> 
			<script type="text/javascript" src="../compartida/libreria/jquery/js/tabs.js"></script>
		<!--  ********************************************************-->
		
		<!--*******************Estilo modulos pag principal************************--> 
			<!--<script type="text/javascript" src="../compartida/libreria/jquery/js/modernizr.custom.97074.js"></script> 
			<script type="text/javascript" src="../compartida/libreria/jquery/js/ jquery-modulos.js"></script>-->
		<!--  ************************************************************************-->
		
		<!--  ************Funciones Compartidas del Sistema*************  -->
			<script src="../compartida/funciones/funciones.js" type="text/javascript"></script>
	
	 
		<!-- Funcion Encriptacion en Javascript -->
            <script src="../compartida/libreria/plugins/encriptado/base_64.js" type="text/javascript"></script>
			
			<script type="text/javascript">
			
			         jQuery(document).ready(function(){
							$("#salio").click(function(){
								destruir_variable("usuId",'');
								destruir_variable("tipousu",'');
								destruir_variable("logeado",'');
						
						    });	
						
					 });
		   </script>
<!-- Fin Scripts-->


</head>
<body>
	<!--SLIDER-->
		<div id="wowslider-container1">
			<div class="ws_images"><ul>
				<li><img src="../data1/images/1-1.jpg"  alt="" title="" id="wows1_0"/></li>
				<li><img src="../data1/images/2-2.jpg"  alt="" title="" id="wows1_1"/></li>
				<li><img src="../data1/images/3-3.jpg"  alt="" title="" id="wows1_2"/></li>
				<li><img src="../data1/images/4-4.jpg"  alt="" title="" id="wows1_3"/></li>
				<li><img src="../data1/images/5-5.jpg"  alt="" title="" id="wows1_4"/></li>
				<li><img src="../data1/images/6-6.jpg"  alt="" title="" id="wows1_5"/></li>
				<li><img src="../data1/images/7-7.jpg"  alt="" title="" id="wows1_6"/></li>
				<li><img src="../data1/images/8-8.jpg"  alt="" title="" id="wows1_7"/></li>
				<li><img src="../data1/images/9-9.jpg"  alt="" title="" id="wows1_8"/></li>
				<li><img src="../data1/images/10-10.jpg"  alt="" title="" id="wows1_9"/></li>
				<li><img src="../data1/images/11-11.jpg"  alt="" title="" id="wows1_10"/></li>
				<li><img src="../data1/images/12-12.jpg"  alt="" title="" id="wows1_11"/></li>
				<li><img src="../data1/images/13-13.jpg"  alt="" title="" id="wows1_12"/></li>
			

				</ul>
			</div>
			<div class="ws_shadow"></div>
			
		</div>
		
		<script type="text/javascript" src="../engine1/wowslider.js"></script>
		<script type="text/javascript" src="../engine1/script.js"></script>
		
		<?php //include("referenciaUsuario.php");?>
	<!--FIN-->
	
  <!--MENU-->
		<div>	
			<ul id="menu">
			
				<?php 
				if($_SESSION['tipousu']=='Administrador'){ 
					
					echo "<li><a class='selected'  style='color:#ffffff;' href='frmModulos.php'>Inicio</a></li>";
					echo "<li class='titulo_m'><a href='frmReservaciones.php'>Reservaciones</a></li>";
					echo "<li class='titulo_m'><a href='frmHospedaje.php'>Hospedaje</a></li>";
					//echo "<li class='titulo_m'><a  style='color:#ffffff;font-family:Arial,Helvetica,sans-serif;' href='frmReserv.php'>Reserva</a></li>";
					echo "<li class='titulo_m'><a href='frmBusque.php'>Búsqueda</a></li>";
					echo "<li class='titulo_m'><a >Clientes</a>";
							echo "<ul>";
							    echo "<li class='list_menu'><a href='frmRegistroCliente.php'>Consultar</a></li>";
							echo "</ul>";
					echo "</li>";

					echo "<li class='titulo_m'><a href='#'>Control</a>";
							echo "<ul>";
							    echo "<li class='list_menu'><a href='frmPresu.php'>Presupuestos</a></li>";
								echo "<li class='list_menu'><a href='frmControLimpiHab.php'>Limpieza de Habitación</a></li>";
								echo "<li class='list_menu'><a href='frmMovimientoCajaH.php'>Caja</a></li>";
								//echo "<li class='list_menu'><a>Asignación de Amenities</a></li>";
							
							echo "</ul>";
					echo "</li>";
					
					echo "<li class='titulo_m'><a  style='color:#ffffff;font-family:Arial,Helvetica,sans-serif;' href='frmConfi.php'>Configuraci&oacute;n</a></li>";
					echo "<li class='titulo_m'><a  style='color:#ffffff;font-family:Arial,Helvetica,sans-serif;' href='comboreportes.php'>Reportes</a></li>";
					echo "<li class='titulo_m'><a  style='color:#ffffff;font-family:Arial,Helvetica,sans-serif;' href='../restaurante/index.php'>Restaurante</a></li>";
					
				}
				?>	
						
				<li class="titulo_m"><a  id='salio' href="../index.php">Salir</a></li>
			</ul>
		</div>
<div id="nombre_modulos">
<table id="modulosTitulos" border="0">
    <tr id="referenciaUsuario" > 
	   <td>  
		   <img src="../images/modulos/icon/home.png" /><span class="text_modulos" style="font-family:Arial,Helvetica,sans-serif;">&nbsp;Bienvenido(a) al Sistema&nbsp;&nbsp;&nbsp;&nbsp;</span>
		   <?php echo $texto; ?>&nbsp;&nbsp;&nbsp;<?php //echo //$tipo; ?>
	   </td>
    </tr>
</table>
</div>
		
<br /><br /><br /><br /><div id="contenidoTotal">