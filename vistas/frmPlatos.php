<?php
session_start();
if (isset($_SESSION['usuId'])){
	$usuario = $_SESSION['usuId'];
?>
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
<style>
.vista {
    width: 90px;
    height: 70px;
    margin: 0px;
    float: left;
    border: 10px solid #fff;
    overflow: hidden;
    position: relative;
    text-align: center;
    box-shadow: 1px 1px 2px #e6e6e6;
    cursor: default;
	
}
.vista .mascara, .vista .contenido {
    width: 90px;
    height: 70px;
    position: absolute;
    overflow: hidden;
    top: 0;
    left: 0;
}
.vista img {
    display: block;
    position: relative;
}
.vista h2 {
    text-transform: uppercase;
    color: #595959;
    text-align: center;
    position: relative;
    font-size: 11px;
    padding: 0px;
    background-color: rgb(191, 220, 232);
    margin: 0 0 0 0;
}
.vista p {
    font-family: Arial, Helvetica, sans-serif;
    font-size: 10px;
    position: relative;
    color: #fff;
    padding: 10px 20px 20px;
    text-align: center;
}
.vista a.informacion {
    display: inline-block;
    text-decoration: none;
    padding: 7px 14px;
    background: #000;
    color: #fff;
    text-transform: uppercase;
    box-shadow: 0 0 1px #000;
}
.vista a.informacion:hover {
    box-shadow: 0 0 5px #000
}

.vista img {
    -webkit-transition: all 0.2s linear;
    -moz-transition: all 0.2s linear;
    -o-transition: all 0.2s linear;
    -ms-transition: all 0.2s linear;
    transition: all 0.2s linear;
}
.vista .mascara {
    opacity: 0;
    background-color: hsla(34,93%,45%,0.7);
    -webkit-transition: all 0.4s ease-in-out;
    -moz-transition: all 0.4s ease-in-out;
    -o-transition: all 0.4s ease-in-out;
    -ms-transition: all 0.4s ease-in-out;
    transition: all 0.4s ease-in-out;
}
.vista h2 {
    opacity: 0;
    -webkit-transform: translateY(-100px);
    -moz-transform: translateY(-100px);
    -o-transform: translateY(-100px);
    -ms-transform: translateY(-100px);
    transform: translateY(-100px);
    -webkit-transition: all 0.2s ease-in-out;
    -moz-transition: all 0.2s ease-in-out;
    -o-transition: all 0.2s ease-in-out;
    -ms-transition: all 0.2s ease-in-out;
    transition: all 0.2s ease-in-out;
}
.vista p { 
    opacity: 0;
    -webkit-transform: translateY(100px);
    -moz-transform: translateY(100px);
    -o-transform: translateY(100px);
    -ms-transform: translateY(100px);
    transform: translateY(100px);
    -webkit-transition: all 0.2s linear;
    -moz-transition: all 0.2s linear;
    -o-transition: all 0.2s linear;
    -ms-transition: all 0.2s linear;
    transition: all 0.2s linear;
}
.vista a.informacion{
    opacity: 0;
    -webkit-transition: all 0.2s ease-in-out;
    -moz-transition: all 0.2s ease-in-out;
    -o-transition: all 0.2s ease-in-out;
    -ms-transition: all 0.2s ease-in-out;
    transition: all 0.2s ease-in-out;
}
.vista:hover img { 
    -webkit-transform: scale(1.1);
    -moz-transform: scale(1.1);
    -o-transform: scale(1.1);
    -ms-transform: scale(1.1);
    transform: scale(1.1);
} 
.vista:hover .mascara { 
    opacity: 1;
}
.vista:hover h2,
.vista:hover p,
.vista:hover a.informacion {
    opacity: 1;
    -webkit-transform: translateY(0px);
    -moz-transform: translateY(0px);
    -o-transform: translateY(0px);
    -ms-transform: translateY(0px);
    transform: translateY(0px);
}
.vista:hover p {
    -webkit-transition-delay: 0.1s;
    -moz-transition-delay: 0.1s;
    -o-transition-delay: 0.1s;
    -ms-transition-delay: 0.1s;
    transition-delay: 0.1s;
}
.vista:hover a.informacion {
    -webkit-transition-delay: 0.2s;
    -moz-transition-delay: 0.2s;
    -o-transition-delay: 0.2s;
    -ms-transition-delay: 0.2s;
    transition-delay: 0.2s;
}
.contenex {
    width: 950px;
    height: 250px;
    margin: 0 auto;
	
}
</style>

<br /><br />
<div style="left: 22px; width:895px !important; height:250px !important; position: relative; font-size: 14px; font-family: Arial, Helvetica, sans-serif;background: #ffffff !important;" >
<div style="font-size: 22px; height:50px !important; font-family: Arial, Helvetica, sans-serif;color: #595959; background-color: rgb(191, 220, 232) !important;">Platos y Bebidas</div>
	<div class="contenex">
		<div class="vista">  
			<img src="../images/menuRes/1.jpg" style="width:400px !important; height: 90px !important;">  
			<div id="Pizzas"  class="mascara">  
				<h2>Pizzas</h2>  
			</div>  
		</div>
		<div class="vista">  
			<img src="../images/menuRes/2.jpg" style="width:400px !important; height: 90px !important;">  
			<div id="Carnes"  class="mascara">  
				<h2>Carnes</h2>  
			</div>  
		</div>
		<div class="vista">  
			<img src="../images/menuRes/3.jpg" style="width:400px !important; height: 90px !important;">  
			<div id="OtrosPlatos" class="mascara">  
				<h2>Otros Platos</h2>  
			</div>  
		</div>
		<div class="vista"  >  
			<img src="../images/menuRes/4.jpg">  
			<div class="mascara" id='Bebidas' >  
				<h2>Bebidas</h2> 
			</div>  
		</div>
		<div class="vista">  
			<img src="../images/menuRes/5.jpg" style="width:400px !important; height: 90px !important;">  
			<div id="Licores" class="mascara">  
				<h2>Licores</h2>  
			</div>  
		</div>

		<div class="vista" >  
			<img src="../images/menuRes/6.jpg" style="width:400px !important; height: 90px !important;">  
			<div class="mascara" id='Adicionales' >
				<h2>&nbsp; Adicionales</h2>
			</div>  
		</div>
		
		<div class="vista">  
			<img src="../images/menuRes/7.jpg" style="width:400px !important; height: 90px !important;">  
			<div id="Helados"  class="mascara">  
				<h2>Helados</h2>  
			</div>  
		</div>
		<div class="vista">  
			<img src="../images/menuRes/8.jpg" style="width:400px !important; height: 90px !important;">  
			<div id="Merengadas" class="mascara">  
				<h2>Merengadas</h2>  
			</div>  
		</div>
        <div class="vista">  
            <img src="../images/menuRes/9.jpg" style="width:400px !important; height: 90px !important;">  
            <div id="Golosinas" class="mascara">  
                <h2>Golosinas</h2>  
            </div>  
        </div>
	</div>	
</div>
<br /><br />
<div id="cargarmenu"></div>
<script>
		$(document).ready(function(){
		
			$(".mascara").on("click", function() {
				var clicplato = $(this).attr('id');
			
				var casx = "../vistas/frm"+clicplato+".php";
				$("#cargarmenu").load(casx);
              		
			});
			
		})
</script>		

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