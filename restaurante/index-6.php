<?php
session_start();
	if (isset($_SESSION['tipousu'])){
		$tipo = $_SESSION['tipousu'];
	}else{
		$tipo = 'Temporal';
	}


	if (isset($_SESSION['numM'])){
		$numM = $_SESSION['numM'];
	}else{
		$numM = '';
	}

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>P&R Flaco's C.A</title>
		<link rel="icon" href="images/favicon.ico">
		<link rel="shortcut icon" href="images/favicon.ico">
		<link rel="stylesheet" href="css/style.css">
		<script src="js/jquery.js"></script>
		<script src="js/jquery-migrate-1.1.1.js"></script>
		<script src="js/jquery.equalheights.js"></script>
		<script src="js/jquery.ui.totop.js"></script>
		<script src="js/jquery.easing.1.3.js"></script>
		<script src="js/touchTouch.jquery.js"></script>	
		
		<!--  ***************************************Libreria jQuery*************************************************  -->
	    <link rel="stylesheet" type="text/css" media="screen" href="../compartida/libreria/jquery/css/jquery-ui.css" />
		<script src="../compartida/libreria/jquery/js/jquery.min.js" type="text/javascript"></script>
		<script src="../compartida/libreria/jquery/js/jquery-ui.min.js" type="text/javascript"></script>
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
		
		<!--  ************Funciones Compartidas del Sistema*************  -->
		<script src="../compartida/funciones/funciones.js" type="text/javascript"></script>
	
	</head>
	<body class="">
<!--==============================header=================================-->
		<header>
			<div class="container_12">
				<div class="grid_12">
					<span style="width: 940px; position: absolute;  text-align: center !important; text-decoration: none;font-family: Arial,Helvetica,sans-serif;font-size: 32px;">P&R Flaco's C.A</span>
										
					<br /><br /><br />
					<div class="menu_block">
						<nav id="bt-menu" class="bt-menu">
							<a href="#" class="bt-menu-trigger"><span>Menu</span></a>
							<ul>
																
								<?php 
								   if($tipo=='Administrador'){ 
									    echo "<li class='current bt-icon'><a href='index.php'>Inicio</a></li>";
										echo "<li class='bt-icon'><a href='index-2.php'>Consumos</a></li>";
										echo "<li class='bt-icon'><a href='index-4.php'>Caja</a></li>";
										echo "<li class='bt-icon'><a href='index-3.php'>Configuración</a></li>";										
									    echo "<li class='bt-icon'><a href='index-6.php'>Reportes</a></li>";
									
									}else{
									    echo "<li class='current bt-icon'><a href='index.php'>Inicio</a></li>";
										echo "<li class='bt-icon'><a href='index-2.php'>Consumos</a></li>";
										echo "<li class='bt-icon'><a href='·'>.</a></li>";
										echo "<li class='bt-icon'><a href='index-6.php'>Reportes</a></li>";
										echo "<li class='bt-icon'><a href='index-4.php'>Caja</a></li>";
									}
								?>
								<li class="bt-icon"><a href="../index.php">Salir</a></li>
							</ul>
						</nav>
						<div class="clear"></div>
					</div>
					<div class="clear"></div>
				</div>
			</div>
		</header>
<!--==============================Content=================================-->
		<div class="content cont2"><div class="ic"></div>
			<div class="container_12">
				<div class="grid_12">
					<h2 class="mb0">Reportes</h2>
					<br />
					
				</div>
			</div>
		</div>
		<div class="gray_block gb1">
			<div class="container_12">
				<div id="cargarreportes"></div>
			</div>
		</div>
<!--==============================footer=================================-->
		<footer>
			<div class="container_12">
				<div class="grid_12">
					<div class="socials">
				
						<a href="#" class="fa fa-twitter"></a>
					
					</div>
					<div class="clear"></div>
					<div class="copy">
						Derechos Reservados &copy; 2017<br/>
						Contacto: inversionesskybarca@gmail.com
					</div>
				</div>
			</div>
		</footer>
		<script>
		$(document).ready(function(){
			$(".bt-menu-trigger").toggle(
				function(){
					$('.bt-menu').addClass('bt-menu-open');
				},
				function(){
					$('.bt-menu').removeClass('bt-menu-open');
				}
			);
			
			$("#cargarreportes").load("../vistas/comboreportesRES.php");	
		});
		</script>
	</body>
</html>