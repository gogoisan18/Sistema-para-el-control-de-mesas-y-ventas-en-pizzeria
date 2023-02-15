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
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>P&R Flaco's C.A</title>
		<link rel="icon" href="images/favicon.ico">
		<link rel="shortcut icon" href="images/favicon.ico">
		<link rel="stylesheet" href="css/list.css">
		<link rel="stylesheet" href="css/style.css">

		<script src="js/jquery.js"></script>
		<script src="js/jquery-migrate-1.1.1.js"></script>
		<!--<script src="js/jquery.equalheights.js"></script> -->
		<script src="js/main.js"></script>
		<script src="js/jquery.ui.totop.js"></script>
		<script src="js/jquery.easing.1.3.js"></script>
		<script src="js/m.js"></script>

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
		<div class="content cont1"><div class="ic"></div>
			<div class="container_12">
				<div class="grid_12">
					<h2 class="mb0">Control de Mesas</h2>
				</div>
			</div>
		</div>
	<!-- carga los div que contienen los dialogos -->
		<div id="CargarApertura"  style="background: #ebebeb !important;"></div>
		<div id="CancelarCuenta"  style="background: #ebebeb !important;"></div>
		<div id="CambiarMesa"     style="background: #ebebeb !important;"></div>
		<input id="xmesax"        type="text" style="width:5%;display:none;" />
		<input id="estatusmesa"   type="text" style="width:5.3%;display:none;" />
		<input id="registroRes"   type="text" style="width:5%;display:none;" />
		<a  id="aperturarmesax"   href="#" class="btnNew" style="margin-left: 240px !important;width:6.5% !important" >Aperturar</a>
		<a  id="cancecuenta"      href="#" class="btnNew" >Cancelar Cuenta</a>
		<a  id="cambiarmesa"      href="#" class="btnNew" >Cambiar de Mesa</a>
		<?php
			if($tipo=='Administrador'){
			 echo "<a  id='cerrarmesa'  href='#' class='btnNew' >Cerrar Mesa</a>";
			}
		?>

	<!-- Fin -->

		<div class="gray_block gb1">
			<div class="container_12">
				<div class="grid_12">
					<div class="responsive">
						<ul class="a_content">
<!-- 1 -->
							<li id="1" class="toco">

								<div  class="card-front">
									<div class="text2">Mesa 1</div>
									<div><table id="retorno1" ><tbody></tbody></table></div>
								</div>
								<div class="card-back">
									<h2><a  href="#">Click Aquí</a></h2>
								</div>
								<!-- Content -->
								<div  class="all-content">
									<div class="text2">Mesa 1</div>
									<div id="mes1"></div>
								</div>
							</li>

							<li id="2" class="toco">

								<div class="card-front">
									<div class="text2">Mesa 2</div>
									<div><table id="retorno2" ><tbody></tbody></table></div>

								</div>
								<div class="card-back">
									<h2><a  href="#">Click Aquí</a></h2>
								</div>
								<!-- Content -->
								<div class="all-content">
									<div class="text2">Mesa 2</div>
									<div id="mes2"></div>

								</div>
							</li>
							<li id="3" class="toco">
								<div class="card-front">
									<div class="text2">Mesa 3</div>
									<div><table id="retorno3" ><tbody></tbody></table></div>

								</div>
								<div class="card-back">
									<h2><a href="#">Click Aquí</a></h2>
								</div>
								<!-- Content -->
								<div class="all-content">
								    <div  class="text2">Mesa 3</div>
									<div id="mes3"></div>

								</div>
							</li>
<!-- 2 -->
							<li id="4" class="toco">
								<div class="card-front">
									<div class="text2">Mesa 4</div>
									<div><table id="retorno4" ><tbody></tbody></table></div>

								</div>
								<div class="card-back">
									<h2><a href="#">Click Aquí</a></h2>
								</div>
								<!-- Content -->
								<div class="all-content">
								    <div  class="text2">Mesa 4</div>
									<div id="mes4"></div>

								</div>
							</li>
							<li id="5" class="toco">
								<div class="card-front">
									<div class="text2">Mesa 5</div>
									<div><table id="retorno5" ><tbody></tbody></table></div>


								</div>
								<div class="card-back">
									<h2><a href="#">Click Aquí</a></h2>
								</div>
								<!-- Content -->
								<div class="all-content">
									<div class="text2">Mesa 5</div>
									<div id="mes5"></div>

								</div>
							</li>
							<li id="6" class="toco">
								<div class="card-front">
									<div class="text2">Mesa 6</div>
									<div>
										<table id="retorno6" >
											<tbody style="width:100% !important; font-size: 16px !important; font-family: Arial, Helvetica, sans-serif; color: #FFF !important;"></tbody>
										</table>
									</div>

								</div>
								<div class="card-back">
									<h2><a href="#">Click Aquí</a></h2>
								</div>
								<!-- Content -->
								<div class="all-content">
									<div class="text2">Mesa 6</div>
									<div id="mes6"></div>

								</div>
							</li>
<!-- 3 -->
							<li id="7" class="toco">
								<div class="card-front">
									<div class="text2">Mesa 7</div>
									<div>
										<table id="retorno7" >
											<tbody style="width:100% !important; font-size: 16px !important; font-family: Arial, Helvetica, sans-serif; color: #FFF !important;"></tbody>
										</table>
									</div>

								</div>
								<div class="card-back">
									<h2><a href="#">Click Aquí</a></h2>
								</div>
								<!-- Content -->
								<div class="all-content">
									<div  class="text2">Mesa 7</div>
									<div id="mes7"></div>

								</div>
							</li>
							<li id="8" class="toco">
								<div class="card-front">
									<div class="text2">Mesa 8</div>
									<div>
										<table id="retorno8" >
											<tbody style="width:100% !important; font-size: 16px !important; font-family: Arial, Helvetica, sans-serif; color: #FFF !important;"></tbody>
										</table>
									</div>

								</div>
								<div class="card-back">
									<h2><a href="#">Click Aquí</a></h2>
								</div>
								<!-- Content -->
								<div class="all-content">
									<div  class="text2">Mesa 8</div>
									<div id="mes8"></div>

								</div>
							</li>
							<li id="9" class="toco" >
								<div class="card-front">
									<div class="text2">Mesa 9</div>
									<div>
										<table id="retorno9" >
											<tbody style="width:100% !important; font-size: 16px !important; font-family: Arial, Helvetica, sans-serif; color: #FFF !important;"></tbody>
										</table>
									</div>

								</div>
								<div class="card-back">
									<h2><a  href="#">Click Aquí</a></h2>
								</div>
								<!-- Content -->
								<div class="all-content">
									<div class="text2">Mesa 9</div>
									<div id="mes9"></div>

								</div>
							</li>

							<!-----------------------------------------PROBANDO CON MAS MESAS------------------------------------>
							<li id="10" class="toco">

								<div class="card-front">
									<div class="text2">Mesa 10</div>
									<div>
										<table id="retorno10" >
											<tbody style="width:100% !important; font-size: 16px !important; font-family: Arial, Helvetica, sans-serif; color: #FFF !important;"></tbody>
										</table>
									</div>

								</div>
								<div class="card-back">
									<h2><a href="#">Click Aquí</a></h2>
								</div>
								<!-- Content -->
								<div class="all-content">
									<div  class="text2">Mesa 10</div>
									<div id="mes10"></div>

								</div>
							</li>

							<li id="11" class="toco">
								<div class="card-front">
									<div class="text2">Mesa 11</div>
									<div>
										<table id="retorno11" >
											<tbody style="width:100% !important; font-size: 16px !important; font-family: Arial, Helvetica, sans-serif; color: #FFF !important;"></tbody>
										</table>
									</div>

								</div>
								<div class="card-back">
									<h2><a  href="#">Click Aquí</a></h2>
								</div>
								<!-- Content -->
								<div class="all-content">
								    <div  class="text2">Mesa 11</div>
									<div id="mes11"></div>

								</div>
							</li>

							<li id="12" class="toco">

								<div  class="card-front">
									<div class="text2">Mesa 12</div>
									<div>
										<table id="retorno12" >
											<tbody style="width:100% !important; font-size: 16px !important; font-family: Arial, Helvetica, sans-serif; color: #FFF !important;"></tbody>
										</table>
									</div>
								</div>
								<div class="card-back">
									<h2><a href="#">Click Aquí</a></h2>
								</div>
								<!-- Content -->
								<div  class="all-content">
									<div class="text2">Mesa 12</div>
									<div id="mes12"></div>
								</div>
							</li>

							<li id="13" class="toco">

								<div class="card-front">
									<div class="text2">Mesa 13</div>
									<table id="retorno13" >
											<tbody style="width:100% !important; font-size: 16px !important; font-family: Arial, Helvetica, sans-serif; color: #FFF !important;"></tbody>
									</table>

								</div>
								<div class="card-back">
									<h2><a  href="#">Click Aquí</a></h2>
								</div>
								<!-- Content -->
								<div class="all-content">
									<div  class="text2">Mesa 13</div>
									<div id="mes13"></div>

								</div>
							</li>
							<li id="14" class="toco">
								<div class="card-front">
									<div class="text2">Mesa 14</div>
									<table id="retorno14" >
											<tbody style="width:100% !important; font-size: 16px !important; font-family: Arial, Helvetica, sans-serif; color: #FFF !important;"></tbody>
									</table>

								</div>
								<div class="card-back">
									<h2><a href="#">Click Aquí</a></h2>
								</div>
								<!-- Content -->
								<div class="all-content">
								    <div  class="text2">Mesa 14</div>
									<div id="mes14"></div>

								</div>
							</li>
<!-- 2 -->
							<li id="15" class="toco">
								<div class="card-front">
									<div class="text2">Mesa 15</div>
									<table id="retorno15" >
											<tbody style="width:100% !important; font-size: 16px !important; font-family: Arial, Helvetica, sans-serif; color: #FFF !important;"></tbody>
									</table>

								</div>
								<div class="card-back">
									<h2><a  href="#">Click Aquí</a></h2>
								</div>
								<!-- Content -->
								<div class="all-content">
								    <div  class="text2">Mesa 15</div>
									<div id="mes15"></div>

								</div>
							</li>
							<li id="16" class="toco">
								<div class="card-front">
									<div class="text2">Mesa 16</div>
									<table id="retorno16" >
											<tbody style="width:100% !important; font-size: 16px !important; font-family: Arial, Helvetica, sans-serif; color: #FFF !important;"></tbody>
									</table>


								</div>
								<div class="card-back">
									<h2><a  href="#">Click Aquí</a></h2>
								</div>
								<!-- Content -->
								<div class="all-content">
									<div class="text2">Mesa 16</div>
									<div id="mes16"></div>

								</div>
							</li>
							<li id="17" class="toco">
								<div class="card-front">
									<div class="text2">Mesa 17</div>
									<table id="retorno17" >
											<tbody style="width:100% !important; font-size: 16px !important; font-family: Arial, Helvetica, sans-serif; color: #FFF !important;"></tbody>
									</table>

								</div>
								<div class="card-back">
									<h2><a  href="#">Click Aquí</a></h2>
								</div>
								<!-- Content -->
								<div class="all-content">
									<div class="text2">Mesa 17</div>
									<div id="mes17"></div>

								</div>
							</li>
<!-- 3 -->
							<li id="18" class="toco">
								<div class="card-front">
									<div class="text2">Mesa 18</div>
									<table id="retorno18" >
											<tbody style="width:100% !important; font-size: 16px !important; font-family: Arial, Helvetica, sans-serif; color: #FFF !important;"></tbody>
									</table>

								</div>
								<div class="card-back">
									<h2><a  href="#">Click Aquí</a></h2>
								</div>
								<!-- Content -->
								<div class="all-content">
									<div  class="text2">Mesa 18</div>
									<div id="mes18"></div>

								</div>
							</li>
							<li id="19" class="toco">
								<div class="card-front">
									<div class="text2">Mesa 19</div>
									<table id="retorno19" >
											<tbody style="width:100% !important; font-size: 16px !important; font-family: Arial, Helvetica, sans-serif; color: #FFF !important;"></tbody>
									</table>

								</div>
								<div class="card-back">
									<h2><a  href="#">Click Aquí</a></h2>
								</div>
								<!-- Content -->
								<div class="all-content">
									<div  class="text2">Mesa 19</div>
									<div id="mes19"></div>

								</div>
							</li>
							<li id="20" class="toco">
								<div class="card-front">
									<div class="text2">Mesa 20</div>
									<table id="retorno20" >
											<tbody style="width:100% !important; font-size: 16px !important; font-family: Arial, Helvetica, sans-serif; color: #FFF !important;"></tbody>
									</table>

								</div>
								<div class="card-back">
									<h2><a  href="#">Click Aquí</a></h2>
								</div>
								<!-- Content -->
								<div class="all-content">
									<div class="text2">Mesa 20</div>
									<div id="mes20"></div>

								</div>
							</li>

							<li id="21" class="toco" >
								<div class="card-front">
									<div class="text2">Mesa 21</div>
									<table id="retorno21" >
											<tbody style="width:100% !important; font-size: 16px !important; font-family: Arial, Helvetica, sans-serif; color: #FFF !important;"></tbody>
									</table>

								</div>
								<div class="card-back">
									<h2><a  href="#">Click Aquí</a></h2>
								</div>
								<!-- Content -->
								<div class="all-content">
									<div class="text2">Mesa 21</div>
									<div id="mes21"></div>

								</div>
							</li>

							<li id="22" class="toco">
								<div class="card-front">
									<div class="text2">Mesa 22</div>
									<table id="retorno22" >
											<tbody style="width:100% !important; font-size: 16px !important; font-family: Arial, Helvetica, sans-serif; color: #FFF !important;"></tbody>
									</table>

								</div>
								<div class="card-back">
									<h2><a  href="#">Click Aquí</a></h2>
								</div>
								<!-- Content -->
								<div class="all-content">
									<div class="text2">Mesa 22</div>
									<div id="mes22"></div>

								</div>
							</li>

							<li id="23" class="toco">
								<div class="card-front">
									<div class="text2">Mesa 23</div>
									<table id="retorno23" >
											<tbody style="width:100% !important; font-size: 16px !important; font-family: Arial, Helvetica, sans-serif; color: #FFF !important;"></tbody>
									</table>

								</div>
								<div class="card-back">
									<h2><a  href="#">Click Aquí</a></h2>
								</div>
								<!-- Content -->
								<div class="all-content">
									<div class="text2">Mesa 23</div>
									<div id="mes23"></div>

								</div>
							</li>

							<li id="24" class="toco">
								<div class="card-front">
									<div class="text2">Mesa 24</div>
									<table id="retorno24" >
											<tbody style="width:100% !important; font-size: 16px !important; font-family: Arial, Helvetica, sans-serif; color: #FFF !important;"></tbody>
									</table>

								</div>
								<div class="card-back">
									<h2><a  href="#">Click Aquí</a></h2>
								</div>
								<!-- Content -->
								<div class="all-content">
									<div class="text2">Mesa 24</div>
									<div id="mes24"></div>

								</div>
							</li>

							<li id="25" class="toco">
								<div class="card-front">
									<div class="text2">Mesa 25</div>
									<table id="retorno25" >
											<tbody style="width:100% !important; font-size: 16px !important; font-family: Arial, Helvetica, sans-serif; color: #FFF !important;"></tbody>
									</table>

								</div>
								<div class="card-back">
									<h2><a  href="#">Click Aquí</a></h2>
								</div>
								<!-- Content -->
								<div class="all-content">
									<div class="text2">Mesa 25</div>
									<div id="mes25"></div>

								</div>
							</li>

							<li id="26" class="toco">
								<div class="card-front">
									<div class="text2">Mesa 26</div>
									<table id="retorno26" >
											<tbody style="width:100% !important; font-size: 16px !important; font-family: Arial, Helvetica, sans-serif; color: #FFF !important;"></tbody>
									</table>

								</div>
								<div class="card-back">
									<h2><a  href="#">Click Aquí</a></h2>
								</div>
								<!-- Content -->
								<div class="all-content">
									<div class="text2">Mesa 26</div>
									<div id="mes26"></div>

								</div>
							</li>

							<li id="27" class="toco">
								<div class="card-front">
									<div class="text2">Mesa 27</div>
									<table id="retorno27" >
											<tbody style="width:100% !important; font-size: 16px !important; font-family: Arial, Helvetica, sans-serif; color: #FFF !important;"></tbody>
									</table>

								</div>
								<div class="card-back">
									<h2><a  href="#">Click Aquí</a></h2>
								</div>
								<!-- Content -->
								<div class="all-content">
									<div class="text2">Mesa 27</div>
									<div id="mes27"></div>

								</div>
							</li>

							<li id="28" class="toco">
								<div class="card-front">
									<div class="text2">Mesa 28</div>
									<table id="retorno28" >
											<tbody style="width:100% !important; font-size: 16px !important; font-family: Arial, Helvetica, sans-serif; color: #FFF !important;"></tbody>
									</table>

								</div>
								<div class="card-back">
									<h2><a  href="#">Click Aquí</a></h2>
								</div>
								<!-- Content -->
								<div class="all-content">
									<div class="text2">Mesa 28</div>
									<div id="mes28"></div>

								</div>
							</li>

							<li id="29" class="toco">
								<div class="card-front">
									<div class="text2">Mesa 29</div>
									<table id="retorno29" >
											<tbody style="width:100% !important; font-size: 16px !important; font-family: Arial, Helvetica, sans-serif; color: #FFF !important;"></tbody>
									</table>

								</div>
								<div class="card-back">
									<h2><a  href="#">Click Aquí</a></h2>
								</div>
								<!-- Content -->
								<div class="all-content">
									<div class="text2">Mesa 29</div>
									<div id="mes29"></div>

								</div>
							</li>

							<li id="30" class="toco">
								<div class="card-front">
									<div class="text2">Mesa 30</div>
									<table id="retorno30" >
											<tbody style="width:100% !important; font-size: 16px !important; font-family: Arial, Helvetica, sans-serif; color: #FFF !important;"></tbody>
									</table>

								</div>
								<div class="card-back">
									<h2><a  href="#">Click Aquí</a></h2>
								</div>
								<!-- Content -->
								<div class="all-content">
									<div class="text2">Mesa 30</div>
									<div id="mes30"></div>

								</div>
							</li>

							<li id="31" class="toco">
								<div class="card-front">
									<div class="text2">Mesa 31</div>
									<table id="retorno31" >
											<tbody style="width:100% !important; font-size: 16px !important; font-family: Arial, Helvetica, sans-serif; color: #FFF !important;"></tbody>
									</table>

								</div>
								<div class="card-back">
									<h2><a  href="#">Click Aquí</a></h2>
								</div>
								<!-- Content -->
								<div class="all-content">
									<div class="text2">Mesa 31</div>
									<div id="mes31"></div>

								</div>
							</li>

							<li id="32" class="toco">
								<div class="card-front">
									<div class="text2">Mesa 32</div>
									<table id="retorno32" >
											<tbody style="width:100% !important; font-size: 16px !important; font-family: Arial, Helvetica, sans-serif; color: #FFF !important;"></tbody>
									</table>

								</div>
								<div class="card-back">
									<h2><a  href="#">Click Aquí</a></h2>
								</div>
								<!-- Content -->
								<div class="all-content">
									<div class="text2">Mesa 32</div>
									<div id="mes32"></div>

								</div>
							</li>

							<li id="33" class="toco">
								<div class="card-front">
									<div class="text2">Mesa 33</div>
									<table id="retorno33" >
											<tbody style="width:100% !important; font-size: 16px !important; font-family: Arial, Helvetica, sans-serif; color: #FFF !important;"></tbody>
									</table>

								</div>
								<div class="card-back">
									<h2><a  href="#">Click Aquí</a></h2>
								</div>
								<!-- Content -->
								<div class="all-content">
									<div class="text2">Mesa 33</div>
									<div id="mes33"></div>

								</div>
							</li>

							<li id="34" class="toco">
								<div class="card-front">
									<div class="text2">Mesa 34</div>
									<table id="retorno34" >
											<tbody style="width:100% !important; font-size: 16px !important; font-family: Arial, Helvetica, sans-serif; color: #FFF !important;"></tbody>
									</table>

								</div>
								<div class="card-back">
									<h2><a  href="#">Click Aquí</a></h2>
								</div>
								<!-- Content -->
								<div class="all-content">
									<div class="text2">Mesa 34</div>
									<div id="mes34"></div>

								</div>
							</li>

							<li id="35" class="toco">
								<div class="card-front">
									<div class="text2">Mesa 35</div>
									<table id="retorno35" >
											<tbody style="width:100% !important; font-size: 16px !important; font-family: Arial, Helvetica, sans-serif; color: #FFF !important;"></tbody>
									</table>

								</div>
								<div class="card-back">
									<h2><a  href="#">Click Aquí</a></h2>
								</div>
								<!-- Content -->
								<div class="all-content">
									<div class="text2">Mesa 35</div>
									<div id="mes35"></div>

								</div>
							</li>


						</ul>
					</div>
				</div>
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
						Correo: inversionesskybarca@gmail.com
					</div>
				</div>
			</div>
		</footer>
		<script>
		$(document).ready(function(){

			$("#xmesax,#estatusmesa,#registroRes").attr("value",'');
			destruir_variable("numM","");


			$(".bt-menu-trigger").toggle(
				function(){
					$('.bt-menu').addClass('bt-menu-open');
				},
				function(){
					$('.bt-menu').removeClass('bt-menu-open');
				}
			);
			$('.responsive').on('click', '.close', function(){
				$("#xmesax,#estatusmesa,#registroRes").attr("value",'');
				destruir_variable("numM","");
				destruir_variable("regisResx","");

				$('.close').remove();
				bgColor = $('.active .card-front').css('background-color');
				$('.responsive').removeClass(effect);
				$('.all-content').hide();
				$('.content li').removeClass('active').show().css({
					'border-bottom':'1px solid #2c2c2c',
					'border-left':'1px solid #2c2c2c'
				});
				$('.card-front, .card-back').show();
				$('.content').css('background-color',bgColor);
				window.location.reload();

			});

			$('.close').click(function(){
				/*$("#xmesax,#estatusmesa,#registroRes").attr("value",'');
				destruir_variable("numM","");
				destruir_variable("regisResx","");
				window.location.reload();*/
				alert('le dioo');

			});

			$.ajax({
					url: '../controlador/buscarInfPlatos.php',
					data: {oper: 'consulEstatus'},
					type: "POST",
					dataType: "json",
					success: function(retor){

					    var cant = retor.length;
						//$("#retor+").empty();

					    for (i=0;i<cant;i++) {

							 var xestatx = retor[i].mesasEstatusE;
							 var y = i+1;
							 var nombre = "estat"+y;

                             var color;
							 if(xestatx=="Ocupada"){
								color = "#FF0000";
							 }else if(xestatx=="Libre"){
								color = "#7FFFD4";
							 }else if(xestatx=="Inactiva"){
								color = "#D2691E";
							 }
							 $("#retorno"+y+" tbody").append("<tr>"+
								"<td>"+
									"<input name='"+nombre+"'  type=\"text\"   style=\"width:70% !important;height:25px;font-size: 20px; color:"+color+";text-align: center;background: transparent;margin-right: 30px;border: none;\" id=\""+nombre+"\" value=\""+xestatx+"\" title=\"Estatus de Mesa\"  />"+
								"</td></tr>");
					   }
					}

			});

			$(".toco").click(function () {

					var clicmesa = $(this).attr('id');

					$("#xmesax").attr("value",clicmesa);
					crear_variable('numM',clicmesa);


					$("#mes"+clicmesa).load("../vistas/frmConsumosMesas2.php");
					var refreshx = "#refresh_listadoConsuResta"+clicmesa;

					$.ajax({
						url: '../controlador/buscarInfPlatos.php',
						data: {oper: 'revisarEstatus'},
						type: "POST",
						success: function(retor){

						   jQuery(refreshx).click();
						   var dat = retor.split('||');

							if(dat[0]=='1'){
							   $("#registroRes").attr("value",dat[1]);
							   $("#estatusmesa").attr("value",'Ocupada');
							}else{
							   $("#estatusmesa").attr("value",'Libre');

							}
						}
					});

			});


			$(".btnNew").click(function () {

				var clicbotn = $(this).attr('id');

				var campmesa = $("#xmesax").val();


				if(campmesa==''){
					alerta('Por favor seleccione una mesa');
				}else{
				    var refreshx = "#refresh_listadoConsuResta"+campmesa;
				    if(clicbotn=='aperturarmesax'){

					    var estatusmesax = $("#estatusmesa").val();

						if(estatusmesax=='Libre'){

								$("#CargarApertura").load("../vistas/frmAperturarMesa.php");
								$("#CargarApertura").dialog({
									  modal: true,
									  width: 700,
									  show: "fold",
									  hide: "scale",
									  buttons: {
										"Guardar": function () {


											var numxmesax = $("#xmesax").val();
											var idmesoxx = $("#idmesox").val();


											$.ajax({
												  url: '../controlador/buscarInfPlatos.php',
												  data: {
														oper:'guardar_apert_mesa',

														numxmesax:numxmesax,
														idmesoxx:idmesoxx
												   },
												  type: "POST",
												  success: function(data){

														var dat = data.split('||');

														if(dat[0]=='1'){
															$("#nombremeso,#apellimeso,#idmesox").attr("value","");
															$("#radio1,#radio2").attr('checked',false);
															$("#ocultartabla").hide();

															$("#registroRes").attr('value',dat[1]);
															$("#estatusmesa").attr('value','Ocupada');
															jQuery(refreshx).click();
															alerta('Mesa aperturada con éxito');

															jQuery('#CargarApertura').dialog('close');
														}else{
															alerta(data);
														}
												  }
											});

										},
										"Limpiar": function () {

											$("#nombremeso,#apellimeso,#idmesox,#cargar,#idRegHotel,#idCuenHotel,#consulx,#nombreCH,#apelliCH").attr("value","");
											$("#radio1,#radio2").attr('checked',false);
											$("#ocultartabla").hide();

										},
										"Salir": function () {
											$(this).dialog("close");
										}
									  }
							   });
							}else if(estatusmesax=='Ocupada'){
								alerta('Disculpe esta la cuenta de esta mesa ya fue abierta');
							}
						}else if(clicbotn=='cambiarmesa'){

						    var estatusmesax = $("#estatusmesa").val();

							if(estatusmesax=='Ocupada'){

								$("#CambiarMesa").load("../vistas/frmCambiarMesa.php");
								$("#CambiarMesa").dialog({
									  modal: true,
									  width: 700,
									  show: "fold",
									  hide: "scale",
									  buttons: {
										"Cambiar": function () {

												var numxmesax = $("#xmesax").val();
												var nuevamesax = $("#nuevamesa").val();
												var registroResx = $("#registroRes").val();
												var obserCambiox = $("#obserCambio").val();


											if(nuevamesax==''){
												alerta('Por favor indique la nueva mesa');
											}else if(obserCambiox==''){
											   alerta('Por favor indique las razones del cambio');
											}else{
												if (confirm('¿Esta seguro que desea cambiar los consumos de esta mesa?')){

													$.ajax({
														  url: '../controlador/buscarInfPlatos.php',
														  data: {
																oper:'cambiar_de_mesa',
																numxmesax:numxmesax,
																nuevamesax:nuevamesax,
																registroResx:registroResx,
																obserCambiox:obserCambiox
														   },
														  type: "POST",
														  success: function(retor){

																if(retor==1){
																	window.location.reload();
																}else{
																	alerta(retor);
																}

														  }
													});
												}
											}
										},
										"Salir": function () {

											$(this).dialog("close");
										}
									  }
							   });
							}else{
								alerta('Disculpe esta mesa no posee cuenta abierta');
							}
						}else if(clicbotn=='cerrarmesa'){

						    var estatusmesax = $("#estatusmesa").val();

							if(estatusmesax=='Ocupada'){

								$("#CambiarMesa").load("../vistas/frmCerrarMesa.php");
								$("#CambiarMesa").dialog({
									  modal: true,
									  width: 700,
									  show: "fold",
									  hide: "scale",
									  buttons: {
										"Cerrar": function () {

												var numxmesax = $("#xmesax").val();
												var registro = $("#registroRes").val();
												var obsercerrar = $("#obsercerrar").val();

												$.ajax({
														  url: '../controlador/buscarInfPlatos.php',
														  data: {
																oper:'consumos_mesa',										
																registro:registro																
														   },
														  type: "POST",
														  success: function(retor){

																console.log('--->'+retor)
																if(retor==0){
																	if (confirm('¿Esta seguro que desea cerrar esta mesa?')){

																		$.ajax({
																			  url: '../controlador/buscarInfPlatos.php',
																			  data: {
																					oper:'cerrar_mesa',
																					numxmesax:numxmesax,																
																					registro:registro,
																					obsercerrar:obsercerrar
																			   },
																			  type: "POST",
																			  success: function(retor){

																					if(retor==1){
																						window.location.reload();
																					}else{
																						alerta(retor);
																					}

																			  }
																		});
																	}

																}else{
																	alerta('Disculpe esta mesa posee consumos registrados, Comuniquese con un Administrador');

																}
														  }
													});
												
											
										},
										"Salir": function () {

											$(this).dialog("close");
										}
									  }
							   });
							}else{
								alerta('Disculpe esta mesa no posee cuenta abierta');
							}
						}else if(clicbotn=='cancecuenta'){
						        var registroResx = $("#registroRes").val();
								var estatusmesax = $("#estatusmesa").val();

							if(estatusmesax=='Ocupada'){

						        $("#CancelarCuenta").load("../vistas/frmPagosRes.php?regisResx="+registroResx);
								$("#CancelarCuenta").dialog({
									      title: "Pagos",
										  modal: true,
										  width: 920,
										  show: "fold",
										  hide: "scale",
										  buttons: {
											"Realizar Pago": function () {


												var recarghox = $("#recargho").val();
												var cuentax = $("#cuenta").val();
												var tipocanx = $("#tipocan").val();
												var tipofactux = $("#tipofactu").val();
												var montodeux = $("#montodeu").val();

												var contclienx = $("#contclien").val();



												var deescuentox = $("#deescuento").val();
												var reecargax = $("#reecarga").val();

												var tipopagox = $("#tipopago").val();

												var grupo = $("#max").val();
												var grupoanter = $("#maxanteri").val();
												var ixregx = $("#ixregx").val();

												var tipotarjx = $("#tipotarj").val();
												var bancox = $("#banco").val();



														if(cuentax==''){
															alerta('Se perdio la sesión por inactividad en la página, por favor cierre este formulario y vuelva a entrar');
														}else if(tipocanx==''){
															alerta('Por favor seleccione si el pago es fraccionado o completo');
														}else if(tipopagox==0){
															alerta('Por favor seleccione la forma de pago');
														}else if((tipopagox=='2' || tipopagox=='3' || tipopagox=='4' || tipopagox=='5' || tipopagox=='5') && bancox==''){
															alerta('Por favor ingrese el nombre del banco');
														}else if(tipopagox=='3' && tipotarjx==''){
															alerta('Por favor ingrese el tipo de tarjeta de crédito');
														}else if(tipopagox!='1' && contclienx == ''){
															alerta('Por favor ingrese el número de control emitido segun el pago');
														}else{


															if (confirm('¿Esta seguro que desea cancelar?')){


																$.ajax({
																  url: '../controlador/detalleConsumosRes.php',
																  data: {
																			oper: 'emitirTF',
																			cuentax: cuentax,
																			tipocanx: tipocanx,
																			tipofactux:tipofactux,
																			montodeux:montodeux,
																			deescuentox:deescuentox,
																			reecargax: reecargax,
																			tipopagox:tipopagox,
																			contclienx:contclienx,

																			grupoanter:grupoanter,
																			grupo:grupo,
																			ixregx:ixregx,

																			tipotarjx:tipotarjx,
																			bancox:bancox

																		},

																  type: "POST",
																  success: function(retor){

																		var dat = retor.split('||');
																		//console.log('esto---->'+dat[0]);

																	if(dat[0]=='1'){
																		
																		//alerta('Pago realizado con éxito');
																		//window.open('../vistas/rptTicket.php?tick='+dat[2]);
																		$.ajax({
																	        url: "../vistas/ayuda3.php",
																	       type: "POST",
																	       data: "tick="+dat[2],
																	       success: function(data){
																	       	 setTimeout(window.location.reload(),10000);
																	       }
																	    });
																		
																	}else{
																		   alerta('Problemas al realizar el pago');
																	}
																  }
																});

															};
														}

											},
											"Salir": function () {

												var cuentax = $("#cuenta").val();

												$.ajax({
												  url: '../controlador/detalleConsumosRes.php',
												  data: {
															cuentax: cuentax,
															caso: 3,
															oper: 'chequear_consumos'
														},
												  type: "POST",
												  success: function(ret){
														$("#montodeu").attr("value",ret);
												  }
												});

												$(this).dialog("close");
											}

										  }
							   });
							}else{
								alerta('Disculpe esta mesa no posee cuenta pendiente');
							}
						}
				}
			});

		});
		</script>
	</body>
</html>