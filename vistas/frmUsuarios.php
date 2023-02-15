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

<script type="text/javascript">
		function valuecheck(check){        
			
			if(check.value=='Activo'){
				   crear_variable("tipoest",1);
				 // alert('Activo');
				 
			}else{
				   crear_variable("tipoest",2);
				   //alert('Inactivo');
			}
		}
	
jQuery(document).ready(function(){
        destruir_variable("tipoest",'');
		$('#cedula,#tlf').attr("onKeyPress", "return soloNum(event)");
		$('#nombre,#apellido').attr("onkeyup","this.value=this.value.toUpperCase()");
 
		$("#cedula").autocomplete({
				source: function(request, response) {
					$.ajax({
					  url: '../controlador/usuarios.php',
					  data: {
								term: request.term,
								oper: 'autocompletar_usu'
							},
					  dataType: "json",
					  type: "POST",
					  success: function(data){
						  response(data);
					  }
					});
				},
				select: function(event, ui) { 
				   
				   if(ui.item.evaluo==1){
				            $('input[id=cedula]').attr("value",ui.item.value);
					        $('input[id=nombre]').attr("value",ui.item.nombre);
							$('input[id=apellido]').attr("value",ui.item.apelli);
							$('input[id=tlf]').attr("value",ui.item.tlf);
							
							//alert(ui.item.tipousu);
							if(ui.item.tipousu=='Operador Restaurante'){
							    var otro = $("#tipousu").attr("value",2);
													
							}else if(ui.item.tipousu=='Administrador'){
								var otro = $("#tipousu").attr("value",1);
													
							}else if(ui.item.tipousu=='Operador Hotel'){
							    var otro = $("#tipousu").attr("value",3);
													
							}else if(ui.item.tipousu=='Operador Dual'){
								var otro = $("#tipousu").attr("value",4);
							}		   
				
				   }
				   
				},
				formatItem: function(row, i, max) {
					return i + "/" + max + ": \"" + row.value + "\" [" + row.label + "]";
				},
				formatMatch: function(row, i, max) {
					return row.value + " " + row.label;
				},
				formatResult: function(row) {
					return row.label;
				},	
				width: 350,
				minChars: 3,
				selectFirst: false,
				mustMatch: true
		});
			jQuery('.ui-autocomplete').css({'font-size':'100%'});
		/**Fin**/	
		

		
		$("#Limpiarx").click( function(){
			
			$("#cedula,#nombre,#apellido,#tlf,#password").attr("value","");
			$("#tipousu").attr("value",0);
			destruir_variable('tipoest','');
			$("#radio1,#radio2").attr('checked',false);
		});
		
		$("#Registrarx").click( function(){
			
			var cedu = $("#cedula").val();
			var pass = $("#password").val();
			var nomb = $("#nombre").val();
			var apel = $("#apellido").val();
			var tipo = $("#tipousu").val();
			var tlf  = $("#tlf").val();

		   
			if(cedu==''){
				alert('Por favor Introduzca la Cédula');
			}else if(nomb==''){
				alert('Por favor Introduzca el Nombre');
			}else if(apel==''){
				alert('Por favor Introduzca el Apellido');
			}else if(cedu==''){
				alert('Por favor Introduzca la Cédula');
			}else if(tipo==0){
				alert('Por favor Seleccione el Tipo de Usuario');
			}else{
			
					$.ajax({
						  url: '../controlador/usuarios.php',
						  data: {
								oper:'agregar',
								cedu:cedu,
								pass:pass,
								nomb:nomb,
								apel:apel,
								tipo:tipo,
								tlf:tlf
						   },
						  //dataType: "json",
						  type: "POST",
						  success: function(data){
								if(data=='1'){
								    
									$("#cedula,#nombre,#apellido,#tlf,#password").attr("value","");
									$("#tipousu").attr("value",0);
									jQuery("#refresh_listadoUsuarios").click();
									alert('Usuario Registrado con Exito');
								}else{
									alert(data);
								}
							
						  }
					});
				
												
			}
		});
		
		$("#Modificarx").click( function(){
			
			var cedu = $("#cedula").val();
			var pass = $("#password").val();
			var nomb = $("#nombre").val();
			var apel = $("#apellido").val();
			var tipo = $("#tipousu").val();
			var tlf  = $("#tlf").val();
		   
			if(cedu==''){
				alert('Por favor Introduzca la Cédula');
			}else if(nomb==''){
				alert('Por favor Introduzca el Nombre');
			}else if(apel==''){
				alert('Por favor Introduzca el Apellido');
			}else if(cedu==''){
				alert('Por favor Introduzca la Cédula');
			}else if(tipo==0){
				alert('Por favor Seleccione el Tipo de Usuario');
			}else{
			
					$.ajax({
						  url: '../controlador/usuarios.php',
						  data: {
								oper:'modificar',
								cedu:cedu,
								pass:pass,
								nomb:nomb,
								apel:apel,
								tipo:tipo,
								tlf:tlf
						   },
						  //dataType: "json",
						  type: "POST",
						  success: function(data){
								if(data=='1'){
								    $("#cedula,#nombre,#apellido,#tlf,#password").attr("value","");
									$("#tipousu").attr("value",0);
									jQuery("#refresh_listadoUsuarios").click();
									alert('Usuario Modificado con Exito');
									
								}
							
						  }
					});
				
												
			}
		});
		
		$("#Eliminarx").click( function(){
			
			var cedu = $("#cedula").val();
			   
			if(cedu==''){
				alert('Por favor Introduzca la Cédula');
			}else{
			     if (confirm('Esta seguro que desea eliminar este usuario?')){
					$.ajax({
						  url: '../controlador/usuarios.php',
						  data: {
								oper:'eliminar',
								cedu:cedu
						   },
						  type: "POST",
						  success: function(data){
								if(data=='1'){
								    $("#cedula,#nombre,#apellido,#tlf,#password").attr("value","");
									$("#tipousu").attr("value",0);
									jQuery("#refresh_listadoUsuarios").click();
									alert('Usuario Eliminado con Exito');
									
								}
							
						  }
					});
				
				}								
			}
		});
		
		jQuery("#listadoUsuarios").jqGrid({
				url:'../controlador/usuarios.php',
				datatype: "json",
				colNames:['C&eacute;dula','Nombre','Apellido','Tel&eacute;fono','Tipo','Contrase&ntilde;a','Estatus'],
				colModel:[
					
					{name:'cedula'
						,index:'usuCedulaC'
						,width:100
						,align:"center"
						,key: true
						,hidden:false
					
					},
					
					{name:'nombre'
						,index:'usuNombreC'
						,width:200
						,align:"center"
						,hidden:false
					
					},
					{name:'apellido'
						,index:'usuApellidoC'
						,width:200
						,align:"center"
						,hidden:false
						
					},
					{name:'tlf'
						,index:'usuTelfCelC'
						,width:100
						,align:"center"
						,hidden:false
							
					},
				
					{name:'tipo'
						,index:'usuTipoE'
						,width:150
						,align:"center"
						,hidden:false
						
					},
					{name:'clavex'
						,index:'usuClaveC'
						,width:100
						,align:"center"
						,hidden:true
						
					},
					{name:'estatus'
						,index:'usuEstatusE'
						,width:100
						,align:"center"
						,hidden:false
						
					}
					],
				rowNum:10,
				width:"700",
				height:"auto",
				rowList:[10,20,30],
				pager: '#paginadorUsuarios',
				caption:"Usuarios",
				sortname: 'usuCedulaC',
				sortorder: "ASC",
				shrinkToFit: false,
				editurl:'../controlador/usuarios.php',
				viewrecords: true,
				rownumbers: true,
				onSelectRow: function(id){ 
				
				//$('#listadoUsuarios tr').click(function(){
					//var a = $(this).find("td").eq(1).html();
					var a = jQuery("#listadoUsuarios").jqGrid('getRowData',id).cedula;
				    //var cedu = parseInt(a);
			//alert(a);
					$.ajax({
					  url: '../controlador/usuarios.php',
					  data: {
								term: a,
								oper: 'buscar_infor'
							},
					  type: "POST",
					  success: function(data){
						   var dat = data.split('||');
								  
						    $("#cedula").attr("value",dat[0]);
						    $("#nombre").attr("value",dat[1]);
							$("#apellido").attr("value",dat[2]);
							$("#tlf").attr("value",dat[3]);
							
							//$salida = $row['usuCedulaC'].'||'.$row['usuNombreC'].'||'.$row['usuApellidoC'].'||'.$row['usuTelfCelC'].'||'.$row['usuTipoE'];	
						 
   						   if(dat[4]=='Administrador'){
							    $("#tipousu").attr("value",1);					
							}else if(dat[4]=='Operador'){
								$("#tipousu").attr("value",2);
							}			  
							
							
							if(dat[5]=='Activo')
								$("#radio1").attr('checked',true);
							else
								$("#radio2").attr('checked',true);
									
					  }
					//});
										
					});
				},
				loadError : function(xhr,st,err) { jQuery("#rsperrorUsuarios").html("Tipo: "+st+"; Mensaje: "+ xhr.status + " "+xhr.statusText); }
			}); 
			

			jQuery("#listadoUsuarios").jqGrid('navGrid','#paginadorUsuarios',
				{edit:false,add:false,del:false,refresh:true,searchtext:"Buscar"}, //options
				
				{}, // options Editar
				{}, // options Agregar
				{}, // options Eliminar 
				{} // search options
			);
			
});
</script>
<link rel="stylesheet" href="../estilo/formoid/formoid-solid-green.css" type="text/css" />
<br /><br />
	<div id="ajustarx2">
		<div style="border-bottom: 1px solid #dadada;">
			<span  id="rsperrorUsuarios" style="color:#BB0323"></span> <br/>
			<table id="listadoUsuarios"></table> <br/>
			<div   id="paginadorUsuarios"></div>
	    </div>
	<br/>
		
			<form class="formoid-solid-green" style="font-family:Arial,Helvetica,sans-serif; font-size: 14px !important;background-image: url('../images/modulos/fondo1.png') !important;color: #68696A; font-weight: normal;" method="post"><div class="title" style="height:20px !important"><h2 style="padding-top: 0px !important;"><img src="../images/modulos/icon/usuarios.png" alt="icon_datos"/>&nbsp;Usuarios</h2></div><br/>
			<div>
				<table border='0' style="width: 100%">
					<tr>
						<td style="text-align: center !important;padding-top: 10px !important;"><label class="title"><span class="required">C&eacute;dula</span></label></td>
	
						<td>
							<div class="element-number">
								<div class="item-cont">
									<input style="width:100%" id="cedula" type="text" maxlength="8"  name="number" required="required" placeholder="Cédula" value=""/>
									<span class="icon-place"></span>
								</div>
							</div>
						</td>
						<td style="text-align: center !important;padding-top: 10px !important;"><label class="title"><span class="required">Clave</span></label></td>
						
						<td>
							<div class="element-password">
								<div class="item-cont">
									<input style="width:100%" id="password" type="password" name="password" value="" placeholder="Clave"/>
									<span class="icon-place"></span>
								</div>
							</div>
						</td>
					</tr>
					<tr><td style="text-align: center !important;padding-top: 10px !important;"><label class="title"><span class="required">Nombre</span></label></td>
						
						<td>
							<div class="element-name">
								<span class="nameFirst">
									<input placeholder=" Nombre" id="nombre" type="text" style="width:125%" name="name[first]" required="required"/>
									<span class="icon-place"></span>
								</span>
							</div>
						</td>
						<td style="text-align: center !important;padding-top: 10px !important;"><label class="title"><span class="required">Apellido</span></label></td>
						
						<td>
							<div class="element-name">
								<span class="nameLast">
									<input placeholder=" Apellido" id="apellido" type="text"  style="width:125%" required="required"/>
									<span class="icon-place"></span>
								</span>
							</div>
						</td>
					</tr>
					<tr>
						<td style="text-align: center !important;padding-top: 10px !important;"><label class="title"><span class="required">Tipo de Usuario</span></label></td>
						
						<td>
							<div class="element-select">
								<div class="item-cont">
									<div class="medium"><span>
											<select id="tipousu" name="select" style="width:125%" required="required">
												<option value="0">Seleccione</option>
												<option value="1">Administrador</option>
												<option value="2">Operador</option>
											</select><i></i><span class="icon-place"></span></span>
									</div>
								</div>
							</div>
						</td>
						<td style="text-align: center !important;padding-top: 10px !important;"><label class="title"><span class="required">Tel&eacute;fono</span></label></td>
						
						<td>
							<div class="element-phone">
								<div class="item-cont">
									<input style="width:100%" id="tlf" type="tel" pattern="[+]?[\.\s\-\(\)\*\#0-9]{3,}" maxlength="11" name="phone" placeholder="Teléfono" value=""/>
									<span class="icon-place"></span>
								</div>
							</div>
						</td>
					</tr>
				</table>
			</div>
			<table border='0' style="margin-left: 70px;">
				<tr>
					<td colspan="10"><div id="titulForm_2"><img src="../images/modulos/icon/estatus.png" alt="icon_datos"/>&nbsp;<b>Estatus</b></div></td>

				</tr>
				<tr>
					<td>
						<div class="column column1"><label>
								<input id='radio1' type="radio" name="radio" value="Activo"    required="required"  onclick="valuecheck(this)"/><span>Activo</span></label><label>
								<input id='radio2' type="radio" name="radio" value="Inactivo"  required="required"  onclick="valuecheck(this)"/><span>Inactivo</span>
								</label>
								</div><span class="clearfix"></span>
						</div>
					</td>
				</tr>
			</table>
				<table style="margin-left: 110px;">
					<tr>
						<td>
							<a  id="Limpiarx"    href="#" class="btnNew" >Limpiar</a>
							<a  id="Registrarx"  href="#" class="btnNew" >Registrar</a>
							<a  id="Modificarx"  href="#" class="btnNew" >Modificar</a>
							<a  id="Eliminarx"   href="#" class="btnNew" >Eliminar</a>
						
						</td>
					</tr>
				</table>
			
		</form>
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