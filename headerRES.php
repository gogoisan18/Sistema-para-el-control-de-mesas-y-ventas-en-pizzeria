<?php
//session_start();
	/*if (isset($_SESSION['usuNombres'])){
		$nombre =  $_SESSION['usuNombres'];
		$texto =ucwords($nombre);
	}else{
		$texto = 'Usuario';
	}
	if (isset($_SESSION['tipousu'])){
		$tipo = $_SESSION['tipousu'];
	}else{
		$tipo = 'Temporal';
	}*/
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Pizzeria</title>
		<meta charset="UTF-8" />
     
       <!--------------------------CUERPO RESTAURANTE---------------------->
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <meta name="description" content="Draggable Image Boxes Grid" />
        <meta name="keywords" content="images, boxes, template, thumbnail, css3, transition, jquery, template, fullscreen, grid, draggable" />
        <meta name="author" content="Codrops" />
        <link rel="stylesheet" type="text/css" href="cssRES/style.css" />
		<noscript>
			<style>
				.ib-main a{
					cursor:pointer;
				}
				.ib-main-wrapper{
					position:absolute;
					top:0px;
					bottom:24px;
					overflow:scroll;
				}
			</style>
		</noscript>
		<script id="previewTmpl" type="text/x-jquery-tmpl">
			<div id="ib-img-preview" class="ib-preview">
                <img src="${src}" alt="" class="ib-preview-img"/>
                <span class="ib-preview-descr" style="display:none;">${description}</span>
                <div class="ib-nav" style="display:none;">
                    <span class="ib-nav-prev">Previous</span>
                    <span class="ib-nav-next">Next</span>
                </div>
                <span class="ib-close" style="display:none;">Close Preview</span>
                <div class="ib-loading-large" style="display:none;">Loading...</div>
            </div>		
		</script>
		<script id="contentTmpl" type="text/x-jquery-tmpl">	
			 <div id="ib-content-preview" class="ib-content-preview">
                <div class="ib-teaser" style="display:none;">{{html teaser}}</div>
                <div class="ib-content-full" style="display:none;">{{html content}}</div>
                <span class="ib-close" style="display:none;">Close Preview</span>
            </div>
		</script>
    </head>
    <body>
		<!--<div class="containerx" >
				<div  class="content">
				<div  id="sbi_container" class="sbi_container" >
					<div class="sbi_panel" data-bg="imagesMR/1.png">
						<a href="#" class="sbi_label">About</a>
						<div class="sbi_content">
							<ul>
								<li><a href="#">Subitem</a></li>
								<li><a href="#">Subitem</a></li>
								<li><a href="#">Subitem</a></li>
							</ul>
						</div>
					</div>
					<div class="sbi_panel" data-bg="imagesMR/2.png">
						<a href="#" class="sbi_label">Menu</a>
						<div class="sbi_content">
							<ul>
								<li><a href="#">Subitem</a></li>
								<li><a href="#">Subitem</a></li>
								<li><a href="#">Subitem</a></li>
							</ul>
						</div>
					</div>
					<div class="sbi_panel" data-bg="imagesMR/3.png">
						<a href="#" class="sbi_label">Location</a>
						<div class="sbi_content">
							<ul>
								<li><a href="#">Subitem</a></li>
								<li><a href="#">Subitem</a></li>
								<li><a href="#">Subitem</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		
		</div>

		<script type="text/javascript" src="../compartida/libreria/jquery/js/jquery.min.js" ></script>
		<script type="text/javascript" src="jsMR/jquery.easing.1.3.js"></script>
		<script type="text/javascript" src="jsMR/jquery.bgImageMenu.js"></script>
		<script type="text/javascript">
			$(function() {
				$('#sbi_container').bgImageMenu({
					defaultBg	: 'imagesMR/default.png',
					border		: 1,
					type		: {
						mode		: 'seqHorizontalSlide',
						speed		: 250,
						easing		: 'jswing',
						seqfactor	: 100
					}
				});
			});
		</script>-->
    <!--</body>
</html>-->
