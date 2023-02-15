<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd" >
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Pizzeria</title>
    <link rel="shortcut icon" href="restaurante/images/favicon.ico">
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="banner, WOW Slider, Slideshow In HTML, Slideshow HTML Code" />
    <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
    <meta name="description" content="banner created with WOW Slider, a free wizard program that helps you easily generate beautiful web slideshow" />
    <link rel="shortcut icon" type="image/x-icon" href="images/icon/gafas.png" />
    <!-- css -->
    <link rel="stylesheet" type="text/css" href="engine1/style.css" /> <!--Banner-->
    <link rel="stylesheet" type="text/css" href="estilo/estilo-cont.css" /> <!--Estilo contenedor-->
    <!-- Scripts -->

    <!--  ***************************************Libreria jQuery*************************************************  -->
    <link rel="stylesheet" type="text/css" media="screen" href="compartida/libreria/jquery/css/jquery-ui.css" />
    <script src="compartida/libreria/jquery/js/jquery.min.js" type="text/javascript"></script>
    <script src="compartida/libreria/jquery/js/jquery-ui.min.js" type="text/javascript"></script>
    <script src="compartida/libreria/jquery/js/jquery.datepick-es.js" type="text/javascript"></script>
    <script src="compartida/libreria/jquery/js/jquery.maskedinput.js" type="text/javascript"></script>
    <!--  *******************************************************************************************************  -->

    <!--  **********************************************Libreria jqGrid*******************************************************  -->
    <link rel="stylesheet" type="text/css" media="screen" href="compartida/libreria/plugins/jqgrid/css/ui.jqgrid.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="compartida/libreria/plugins/jqgrid/plugins/ui.multiselect.css" />
    <script src="compartida/libreria/plugins/jqgrid/js/i18n/grid.locale-es.js" type="text/javascript"></script>
    <script type="text/javascript">
        $.jgrid.no_legacy_api = true;
        $.jgrid.useJSON = true;
    </script>
    <script src="compartida/libreria/plugins/jquery.blockUI.js" type="text/javascript"></script>
    <script src="compartida/libreria/plugins/jqgrid/js/jquery.jqGrid.src.js" type="text/javascript"></script>
    <script src="compartida/libreria/plugins/jqgrid/plugins/jquery.tablednd.js" type="text/javascript"></script>
    <script src="compartida/libreria/plugins/jquery.bt.min.js" type="text/javascript"></script>
    <script src="compartida/libreria/plugins/jqgrid/plugins/jquery.contextmenu.js" type="text/javascript"></script>
    <!----librerias para login------>
    <script type="text/javascript" src="js/jquery.tickertype--.js"></script> <!--Libreria efecto maquina de Escribir -->
    <!--  ***********************************************************************************************************************  -->

    <!--  ***********************Tap******************************-->
    <script type="text/javascript" src="compartida/libreria/jquery/js/tabs.js"></script>  <!-- Quienes Somos -->
    <!--  ********************************************************************  -->

    <!--  ************Funciones Compartidas del Sistema*************  -->
    <script src="compartida/funciones/funciones.js" type="text/javascript"></script>


    <!-- Contactanos
             <script src="js/modernizr.custom.63321-1.js" type="text/javascript"></script> <!--Formulario-->
    <script src="compartida/libreria/jquery/js/msdropdown/jquery.dd.js" type="text/javascript"></script> <!--Select-->
    <script src="compartida/libreria/jquery/js/msdropdown/jquery.dd.min.js" type="text/javascript"></script> <!--Select-->


    <!-- Fin Scripts-->

    <script type="text/javascript">
        jQuery(document).ready(function() {

            $("#usuario,#contra").val("");
            $('#usuario').attr("onKeyPress", "return soloNum(event)");


            function crear_sesion(variable,valor){
                $.ajax({
                    url: "compartida/funciones/funciones.php",
                    data:"oper=crear_variable&"+variable+"="+valor,
                    type: "POST",
                    async:false,
                    cache:false,
                    success: function(ret){	}
                });
            };

            function obtener_sesion(variable,valor){
                var $valor = "";
                $.ajax({
                    url: "compartida/funciones/funciones.php",
                    data:"oper=obtener_variable&"+variable+"="+valor,
                    type: "POST",
                    async:false,
                    cache:false,
                    success: function(ret){
                        $valor = ret;
                    }
                });
                return $valor;
            };


            $("#enviar").on("click", function() {

                $("#frmError").empty();
                var usu = $("#usuario").attr("value");
                var contr = $("#contra").attr("value");
                //alert(usu+' '+contr);
                if (usu == "") {
                    var message = 'Por favor ingrese su c&eacute;dula..';
					 alerta(message);
                    //$("#frmError").append("<p id='xmsj'>" + message + "</p>");
                }else if (contr == "") {
                    var message = 'Por favor ingrese su contrase&ntilde;a..';
                   // $("#frmError").append("<p id='xmsj' >" + message + "</p>");
				   alerta(message);
                }else {


                    var hjklp = usu + "||" + contr;
                    alerta2('Verificando, espere un momento por favor.');

                    $.ajax({
                        url: "controlador/usuarios.php",
                        data:'oper=buscar&xt56yz='+hjklp,
                        type: "POST",
                        success: function(retorno){
                            //alert(retorno);
                            var acento = '&eacute;';
                            var n = '&ntilde';
							
                            var dat = retorno.split('||');
							
                            if(dat[0] == 'true'){
                            	location.href = "restaurante/index.php";
                            }else{
                                $("#usuario,#contra").val("");

                                if(retorno == 'inactivo'){
                                    alerta('Su cuenta de usuario se encuentra Inactiva');
                                }else{
                                    alerta('Usuario o contrase' + n + 'a incorrecta, por favor verifique');
                                }
                            }
                            return true;
                        }
                    });
                }

            });
        });
    </script>
<style type="text/css">
.bottom {
	width:345px;
	
}

.envi {
    width:345px;
	margin:20px 20px 10px 10px;
	text-align: center !important;
}

</style>
</head>
<!--<img src="images/login/logo.png" id="icon_logo" alt="icon_logo"/>-->
<div id="conten_log">
    
	<table>
        <br />  <br />  <br />  
		    <tr><td><p id="nameSistema" ><b>P&R Flacos C.A'</b></p></td></tr>
			
     </table><br />	
    <div class="form_login" id="conten-sist">
        <form class="login active" id="formLogin">
        
		    <h3 >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Inicio de Sesión</h3>
				
		           
		   <div>
                <label>Usuario</label>
                <input type="text" id="usuario" name="usuario" maxlength="8" placeholder="Ingrese el usuario"  />
          
            </div>
            <div>
                <label>Contraseña<a href="#" rel="forgot_password" class="forgot linkform"></a></label>
                <input type="password" id="contra" type="password" name="contra" maxlength="15" placeholder="Ingrese la Contrase&ntilde;a"/>
             
            </div>
         
            <div class="bottom"></div>
		<div class="envi">
				<!--<table  id="envi" border='1'>
					<tr>
						<td>-->
							<a id="enviar" type="submit" name="infor" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Entrar&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
						<!--</td>
					</tr>
				</table>-->
		</div>
            <div class="clear"></div>
        </form>
    </div><br/>
    <?php include_once('footer.php'); ?>
</div>

