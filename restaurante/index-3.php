<?php
session_start();
	if (isset($_SESSION['tipousu'])){
		$tipo = $_SESSION['tipousu'];

	}else{
		$tipo = 'Temporal';

	}
	//echo $tipo;
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>P&R Flaco's C.A</title>
		<link rel="icon" href="images/favicon.ico">
		<link rel="shortcut icon" href="images/favicon.ico">
		<link rel="stylesheet" href="css/touchTouch.css">
		<link rel="stylesheet" href="css/style.css">
		<script src="js/jquery.js"></script>
		<script src="js/jquery-migrate-1.1.1.js"></script>
		<script src="js/jquery.equalheights.js"></script>
		<script src="js/jquery.ui.totop.js"></script>
		<script src="js/jquery.easing.1.3.js"></script>
		<script src="js/touchTouch.jquery.js"></script>



		<script>
		$(document).ready(function(){
			$().UItoTop({ easingType: 'easeOutQuart' });
			$('.gallery a.gal').touchTouch();

			$(".btn").on("click", function() {
				var cliccaso = $(this).attr('id');
				//Mesas//Personal//Platos//Reportes
				var casx = "../vistas/frm"+cliccaso+".php";
				$("#cargar").load(casx);

				//alert(cliccaso);

			});

		})
		</script>

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
					<h2 class="mb0">Configuración</h2>
				</div>
			</div>
		</div>
		<div class="gray_block gb1">
			<div class="container_12">
				<div class="gallery">
					<div class="grid_2">
						<a href="images/big1.jpg" class="gal"><img src="images/page4_img1.jpg" alt="" style="width:400px !important; height: 90px !important;"></a>
						<div class="text1"><a href="#">Mesas</a></div>
						Área para el control de las mesas del restaurante
						<br>
						<a href="#" id="Mesas" class="btn">Ir</a>
					</div>
					<div class="grid_2">
						<a href="images/big2.jpg" class="gal bd1"><img src="images/page4_img2.jpg" alt="" style="width:400px !important; height: 90px !important;"></a>
						<div class="text1"><a href="#">Mesoneros</a></div>
						Área para el control del personal (datos personales)
						<br>
						<a href="#" id="Mesoneros" class="btn">Ir</a>
					</div>
					<div class="grid_2">
						<a href="images/big3.jpg" class="gal bd2"><img src="images/page4_img3.jpg" alt="" style="width:400px !important; height: 90px !important;"></a>
						<div class="text1"><a href="#">Platos</a></div>
						Área para el control de los platos y bebidas
						<br>
						<a href="#" id="Platos"  class="btn">Ir</a>
					</div>
					<div class="grid_2">
						<a href="images/big4.jpg" class="gal bd3"><img src="images/page4_img4.jpg" alt="" style="width:400px !important; height: 90px !important;"></a>
						<div class="text1"><a href="#">Usuarios</a></div>
						Área para el control de Usuarios<br>
						<br>
						<a href="#" id="Usuarios" class="btn">Ir</a>
					</div>
					<div class="grid_2">
						<a href="images/big5.jpg" class="gal bd3"><img src="images/page4_img5.jpg" alt="" style="width:400px !important; height: 90px !important;"></a>
						<div class="text1"><a href="#">Bancos</a></div>
						Área para el control de Bancos<br>
						<br>
						<a href="#" id="Bancos" class="btn">Ir</a>
					</div>
					<br /><br />

				</div>
				<div id="cargar"></div>

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
			$(".bt-menu-trigger").toggle(
				function(){
					$('.bt-menu').addClass('bt-menu-open');
				},
				function(){
					$('.bt-menu').removeClass('bt-menu-open');
				}
			);
			$('.responsive').on('click', '.close', function(){
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
			});
		});
		</script>
	</body>
</html>