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
<script type="text/javascript">
$(document).ready(function(){
        $("#accordion").accordion({ 
            autoHeight: false,
            active: false,
            disabled: false,
            collapsible: true
				
        });

        $("div[id^='tabs']").tabs({
            ajaxOptions: {
                error: function( xhr, status, index, anchor ) {
                    $( anchor.hash ).html("Documento no encontrado.!" );
                }
            }
        });
	
        $('#accordion div a').on("click",function(){
            $("#tabVista").load(this.href);
			
            return false;
        });
		 
		$("#enlaces li").attr("style","font-weight: bold; color:#AFC271; ");
		$("#tab1,#tab2,#tab3,#tab4,#tab5").attr("style"," font-size: 14px;");

		
		$("#salir").click(function(){
			$("body").fadeOut(1200, redireccionarPag);
			destruir_variable("usuId",'');
			destruir_variable("tipousu",'');
			destruir_variable("logeado",'');
					
		});
		
		$("#meso").click(function(){
			crear_variable("existe","Mesonero");					
		});
		$("#mes").click(function(){
			crear_variable("existe","0");					
		});

										 
										 
});	
function redireccionarPag(){
	window.location="../index.php";
}
</script>
  <br />
<div class="container">
   <div id="accordion" style="width:190px; float: left;">
				<h3 id="tab1"><a href="#"><img src="../images/modulos/icon/hotel_1.png"> Hotel</a></h3>
				<div id="enlaces">
					<ul>
					    <li><a href="frmTemporada.php">Temporada</a><br /></li>
						<li><a href="frmHabitaciones.php">Habitaciones</a><br /></li>
						<li><a href="frmBienesHabitacion.php">Inventario</a><br /></li>
						<li><a href="frmSpa.php">Spa</a><br /></li>
						<li><a href="frmPaquetes.php">Paquete Turístico</a><br /></li>
						<li><a href="frmSalon.php">Salón</a><br /></li>
						<li><a href="frmOtrosServ.php">Otros Servicios</a><br /></li>
						
					</ul>
				</div>
				<h3 id="tab3"><a href="#"><img src="../images/modulos/icon/reportes.png"> Reportes</a></h3>
				<div id="enlaces">
					<ul>
						<li><a href="viewReportes.php">Reportes</a><br /></li>
					</ul>
				</div>
				<h3 id="tab4"><a href="#"><img src="../images/modulos/icon/seguridad_1.png"> Seguridad</a></h3>
				<div id="enlaces">
					<ul>
						<li><a  href="frmUsuarios.php" >Usuarios</a><br /></li>
						<li><a id="mes" href="frmPersonal.php" >Personal</a><br /></li>
					</ul>
				</div>
				<h3 id="tab5"><a href="#"><img src="../images/modulos/icon/listar.png"> Inventario</a></h3>
				<div id="enlaces">
					<ul>
						<li><a href="frmProveedor.php" >Proveedores</a><br /></li>
						<li><a href="frmMarcas.php">Marcas</a><br /></li>
						<li><a href="frmComprasInv.php">Compras</a><br /></li>
						<li><a href="frmArticulo.php">Artículos</a><br /></li>
						<li><a href="frmKit.php">Kit Amenities</a><br /></li>
						<li><a href="frmEntrega.php">Entrega</a><br /></li>
						<li><a href="frmRetorno.php">Retorno</a><br /></li>
						<li><a href="frmDesincorporar.php">Desincorporar</a><br /></li>
					</ul>
				</div>
	</div>
	<div style=" float: left;">
		<div id="tabVista" ></div>
    </div>
</div>
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