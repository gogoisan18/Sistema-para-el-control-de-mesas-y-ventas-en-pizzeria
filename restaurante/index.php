<?php
session_start();

	if(isset($_SESSION['tipousu'])){
		$tipo = $_SESSION['tipousu'];
		
	}else{	
		$tipo ='Temporal';
	}

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>P&R Flaco's C.A</title>		
		<link rel="shortcut icon" href="images/favicon.ico">
		<link rel="stylesheet" href="css/camera.css">
		<link rel="stylesheet" href="css/component.css">
		<link rel="stylesheet" href="css/style.css">
		<script src="js/jquery.js"></script>
		<script src="js/jquery-migrate-1.1.1.js"></script>
		<script src="js/jquery.equalheights.js"></script>
		<script src="js/jquery.ui.totop.js"></script>
		<script src="js/jquery.easing.1.3.js"></script>
		<script src="js/camera.js"></script>
		<script src="js/snap.svg-min.js"></script>
		<!--[if (gt IE 9)|!(IE)]><!-->
		<script src="js/jquery.mobile.customized.min.js"></script>
		<!--<![endif]-->
		<script>
		$(document).ready(function(){
	
			
			jQuery('#camera_wrap').camera({
			loader: false,
			pagination: true ,
			minHeight: '394',
			thumbnails: false,
			height: '40.1875%',
			caption: false,
			navigation: false,
			fx: 'mosaic'
			});
			$().UItoTop({ easingType: 'easeOutQuart' });
			///////////////////////////////////////////////////////
			$("#consumos").on("click", function() {
				location.href='index-2.php';
			});
			$("#config").on("click", function() {
				location.href='index-3.php';
			});
			$("#cajax").on("click", function() {
				location.href='index-4.php';
			});
			$("#reportex").on("click", function() {
				location.href='index-6.php';
			});
			
		})
		</script>
	
	</head>
	<body class="page1">
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

	
		
		<div class="container_12">
			<section class="grid" id="grid">
				<a href="#" data-path-hover="m 180,70.57627 -180,0 L 0,0 180,0 z">
					<figure>
						<svg viewBox="0 0 180 320" preserveAspectRatio="none"><path d="M 180,160 0,262 0,0 180,0 z"/></svg>
						<figcaption>
						<div class="title">Consumos</div>
						</figcaption>
					</figure>
					<span id="consumos">Acceder</span>
				</a>
    <?php 
			if($tipo=='Administrador'){ 
			  echo "<a href='#'' data-path-hover='m 180,70.57627 -180,0 L 0,0 180,0 z'>
						<figure>
							<svg viewBox='0 0 180 320' preserveAspectRatio='none'><path d='M 180,160 0,262 0,0 180,0 z'/></svg>
							<figcaption>
								<div class='title'>Configuración</div>
							</figcaption>
						</figure>
						<span id='config'>Acceder</span>
					</a>
					<a href='#'' data-path-hover='m 180,70.57627 -180,0 L 0,0 180,0 z'>
							<figure>
								<svg viewBox='0 0 180 320' preserveAspectRatio='none'><path d='M 180,160 0,262 0,0 180,0 z'/></svg>
								<figcaption>
								<div class='title'>Caja</div>
								</figcaption>
							</figure>
							<span id='cajax'>Acceder</span>
					</a>
					<a href='#'' data-path-hover='m 180,70.57627 -180,0 L 0,0 180,0 z'>
							<figure>
								<svg viewBox='0 0 180 320' preserveAspectRatio='none'><path d='M 180,160 0,262 0,0 180,0 z'/></svg>
								<figcaption>
								<div class='title'>Reportes</div>
								</figcaption>
							</figure>
							<span id='reportex'>Acceder</span>
					</a>";
				}else{

					echo "<a href='#'' data-path-hover='m 180,70.57627 -180,0 L 0,0 180,0 z'>
						<figure>
							<svg viewBox='0 0 180 320' preserveAspectRatio='none'><path d='M 180,160 0,262 0,0 180,0 z'/></svg>
							<figcaption>
								<div class='title'>Reportes</div>
							</figcaption>
						</figure>
						<span id='reportex'>Acceder</span>
					</a>
					<a href='#'' data-path-hover='m 180,70.57627 -180,0 L 0,0 180,0 z'>
							<figure>
								<svg viewBox='0 0 180 320' preserveAspectRatio='none'><path d='M 180,160 0,262 0,0 180,0 z'/></svg>
								<figcaption>
								<div class='title'>Caja</div>
								</figcaption>
							</figure>
							<span id='cajax'>Acceder</span>
					</a>";
				}					
		?>
			</section>
		</div>
<!--==============================Content=================================-->
	
		<div class="gray_block">
			<div class="container_12">
				
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
			});
			(function() {
			function init() {
				var speed = 250,
				easing = mina.easeinout;
				[].slice.call ( document.querySelectorAll( '#grid > a' ) ).forEach( function( el ) {
				var s = Snap( el.querySelector( 'svg' ) ), path = s.select( 'path' ),
					pathConfig = {
					from : path.attr( 'd' ),
					to : el.getAttribute( 'data-path-hover' )
					};
				el.addEventListener( 'mouseenter', function() {
					path.animate( { 'path' : pathConfig.to }, speed, easing );
				} );
				el.addEventListener( 'mouseleave', function() {
					path.animate( { 'path' : pathConfig.from }, speed, easing );
				} );
				} );
			}
			init();
			})();
		</script>
	</body>
</html>