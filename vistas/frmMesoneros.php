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
	}else{
		   crear_variable("tipoest",2);
	}
}
		
jQuery(document).ready(function(){
        destruir_variable("tipoest",'');
		$('#troculto').hide();
		$('#cedulaper,#tlfper1,#tlfper2').attr("onKeyPress", "return soloNum(event)");
		$('#nombreper,#apellidoper,#direcc').attr("onkeyup","this.value=this.value.toUpperCase()");
			
		$("#Limpiarx").click( function(){
			
			$("#cedulaper,#nombreper,#apellidoper,#tlfper1,#tlfper2,#fechanacC").attr("value","");
			$("#idxparro,#idparro,#direcc").attr("value","");
			$("#tipoper").attr("value",0);
			destruir_variable('tipoest','');
			$("#radio1,#radio2").attr('checked',false);
			$("#edocivilC").attr("value",0);
			
			
		});
		
		$("#fechanacC").datepicker({
			  changeYear: true,
			  maxDate:"+3m +0w +0y +0d",
			  numberOfMonths: 1,
			  onSelect: function(textoFecha, objDatepicker){
			  }
		});
										
		$("#idparro").autocomplete({
				source: function(request, response) {
					$.ajax({
					  url: '../controlador/mesoneros.php',
					  data: {
								term: request.term,
								oper: 'autocompletar_parro'
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
				        $('input[id=idxparro]').attr("value",ui.item.idparroo);
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
		jQuery('.ui-autocomplete').css({'font-size':'90%'});							
		
		$("#Registrarx").click( function(){
			
			var cedup  = $("#cedulaper").val();
			var nombp  = $("#nombreper").val();
			var apellp = $("#apellidoper").val();
			var tipo   = $("#tipoper").val();
			var tlf1p  = $("#tlfper1").val();
			var tlf2p  = $("#tlfper2").val();
			var fechan = $("#fechanacC").val();
			var idxprro = $("#idxparro").val();
			var edociv = $("#edocivilC").val();
			var direcc = $("#direcc").val();
			
		
		   
			if(nombp==''){
				alerta('Por favor introduzca el nombre');
			}else if(apellp==''){
				alerta('Por favor introduzca el apellido');
			}else if(cedup==''){
				alerta('Por favor introduzca la cédula');
			}else if(edociv==0){
				alerta('Por favor seleccione el estado civil');
			}else if(fechan==''){
				alerta('Por favor introduzca la fecha de nacimiento');
			}else if(tipo==0){
				alerta('Por favor seleccione el tipo de personal');
			}else if(tlf1p==''){
				alerta('Por favor introduzca el teléfono');
			}else if(idxparro==''){
				alerta('Por favor introduzca la parroquia');
			}else if(direcc==''){
				alerta('Por favor introduzca la dirección');
			}else{
			
				$.ajax({
					  url: '../controlador/mesoneros.php',
					  data: {
							oper:'agregar',
							cedup:cedup,
							nombp:nombp,
							apellp:apellp,
							tipo:tipo,
							tlf1p:tlf1p,
							tlf2p:tlf2p,
							fechan:fechan,
							idxprro:idxprro,
							edociv:edociv,
							direcc:direcc							
					   },
					  type: "POST",
					  success: function(data){
							if(data=='1'){
							    alerta('Personal registrado con éxito');
								$("#cedulaper,#nombreper,#apellidoper,#tlfper1,#tlfper2,#fechanacC").attr("value","");
								$("#idxparro,#idparro,#direcc").attr("value","");
								$("#tipoper").attr("value",0);
								destruir_variable('tipoest','');
								$("#radio1,#radio2").attr('checked',false);
								$("#edocivilC").attr("value",0);
								jQuery("#refresh_listadopersonal").click();
								
							}else{
								alerta(data);
							}
					  }
				});
												
			}
		});
		
		$("#Modificarx").click( function(){
			
			var cedup  = $("#cedulaper").val();
			var nombp  = $("#nombreper").val();
			var apellp = $("#apellidoper").val();
			var tipo   = $("#tipoper").val();
			var tlf1p  = $("#tlfper1").val();
			var tlf2p  = $("#tlfper2").val();
			var fechan = $("#fechanacC").val();
			var idxprro = $("#idxparro").val();
			var edociv = $("#edocivilC").val();
			var direcc = $("#direcc").val();
		
		   
			if(nombp==''){
				alerta('Por favor introduzca el nombre');
			}else if(apellp==''){
				alerta('Por favor introduzca el apellido');
			}else if(cedup==''){
				alerta('Por favor introduzca la cédula');
			}else if(edociv==0){
				alerta('Por favor seleccione el estado civil');
			}else if(fechan==''){
				alerta('Por favor introduzca la fecha de nacimiento');
			}else if(tipo==0){
				alerta('Por favor seleccione el tipo de personal');
			}else if(tlf1p==''){
				alerta('Por favor introduzca el teléfono');
			}else if(idxparro==''){
				alerta('Por favor introduzca la parroquia');
			}else if(direcc==''){
				alerta('Por favor introduzca la dirección');
			}else{
			
				$.ajax({
					  url: '../controlador/mesoneros.php',
					  data: {
							oper:'modificar',
							cedup:cedup,
							nombp:nombp,
							apellp:apellp,
							tipo:tipo,
							tlf1p:tlf1p,
							tlf2p:tlf2p,
							fechan:fechan,
							idxprro:idxprro,
							edociv:edociv,
							direcc:direcc							
					   },
					   type: "POST",
					   success: function(data){
							if(data=='1'){
								alerta('Personal modificado con éxito');
								$("#cedulaper,#nombreper,#apellidoper,#tlfper1,#tlfper2,#fechanacC").attr("value","");
								$("#idxparro,#idparro,#direcc").attr("value","");
								$("#tipoper").attr("value",0);
								destruir_variable('tipoest','');
								$("#radio1,#radio2").attr('checked',false);
								$("#edocivilC").attr("value",0);
								jQuery("#refresh_listadopersonal").click();
								
							}else{
								alerta(data);
							}
						
					    }
					});
				
												
			}
		});
		
		jQuery("#listadopersonal").jqGrid({
		
				url:'../controlador/mesoneros.php',
				datatype: "json",
				colNames:['C&eacute;dula','Nombre','Apellido','Tel&eacute;fono 1','Tel&eacute;fono 2','Tipo','Estatus'],
				colModel:[
					{name:'ced',index:'perCedulaC',width:100,key:true,hidden:false},
	                {name:'nomperso',index:'perNombreC',width:150,align:"center",hidden:false},					
					{name:'apeperso',index:'perApellidoC',width:150,hidden:false},	
					{name:'telperso1', index:'perTelf1CelC',width:120,align:"center",hidden:false},	
					{name:'telperso2', index:'perTelf2CelC',width:120,align:"center",hidden:false},	
					{name:'tipoperso', index:'perTipoE',width:120,align:"center",hidden:false},	  
					{name:'estaperso',index:'perEstatusE',width:120,align:"center",hidden:false}
				],
				rowNum:5,
				//autowidth: true,
				width:"725",
				height:"auto",
				rowList:[5,10,20],
				pager: '#paginadorpersonal',
				caption:"",
				sortname: 'perCedulaC',
				shrinkToFit: false,
				sortorder: "ASC",
				editurl:'../controlador/mesoneros.php',
				viewrecords: true,
				rownumbers: true,
				onSelectRow: function(id){ 
				
				//$('#listadopersonal tr').click(function(){
				    var a = jQuery("#listadopersonal").jqGrid('getRowData',id).ced;
					//var a = $(this).find("td").eq(1).html();
				    var cedpers = parseInt(a);
			
					
					$.ajax({
					  url: '../controlador/mesoneros.php',
					  data: {
								term: cedpers,
								oper: 'buscar_infor'
							},
				
					  type: "POST",
					  success: function(data){
						   var dat = data.split('||');
	//$salida = $row['perCedulaC'].'||'.$row['perNombreC'].'||'.$row['perApellidoC'].'||'.$row['perTelfCelC'].'||'.$row['perTipoE'].'||'.$row['perEstatusE'];		  
						  
								$("#cedulaper").attr("value",dat[0]);
								$("#nombreper").attr("value",dat[1]);
								$("#apellidoper").attr("value",dat[2]);
								$("#tlfper1").attr("value",dat[3]);
								$("#tlfper2").attr("value",dat[6]);
								$("#fechanacC").attr("value",dat[7]);
								
								$("#idxparro").attr("value",dat[9]);
								$("#idparro").attr("value",dat[8]);
								$("#direcc").attr("value",dat[10]);
								
							     $("#tipoper").attr("value",dat[4]);	
																
								if(dat[5]=='Activo')
									$("#radio1").attr('checked',true);
								else
									$("#radio2").attr('checked',true);
									
								
								if(dat[11]=='Soltero'){
									$("#edocivilC").attr("value",1);					
								}else if(dat[11]=='Casado'){
									$("#edocivilC").attr("value",2);				
								}else if(dat[11]=='Divorciado'){
									$("#edocivilC").attr("value",3);					
								}else if(dat[11]=='Viudo'){
									$("#edocivilC").attr("value",4);				
								}
								
						  }
						});
										
						//});
					},
				loadError : function(xhr,st,err) { jQuery("#rsperrorpersonal").html("Tipo: "+st+"; Mensaje: "+ xhr.status + " "+xhr.statusText); }
			}); 

			jQuery("#listadopersonal").jqGrid('navGrid','#paginadorpersonal',
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
		<span  id="rsperrorpersonal" style="color:#BB0323"></span> <br/>
		<table id="listadopersonal"></table> <br/>
		<div   id="paginadorpersonal"></div>
	</div>
	<br/>
	<!--<form class="formoid-solid-green" method="post"><div class="title"><h2><img src="../images/modulos/icon/personal.png" alt="icon_datos"/>&nbsp;Personal</h2></div><br/>-->
	<form class="formoid-solid-green" style="font-family:Arial,Helvetica,sans-serif; font-size: 14px !important;background-image: url('../images/modulos/fondo1.png') !important;color: #68696A; font-weight: normal;" method="post"><div class="title" style="height:20px !important"><h2 style="padding-top: 0px !important;"><img src="../images/modulos/icon/usuarios.png" alt="icon_datos"/>&nbsp;Personal</h2></div><br/>
		<div>
			<table border='0' style="width: 100%">
				<tr>
				
					<td style="text-align: center !important;padding-top: 10px !important;"><label class="title"><span class="required">Nombre</span></label></td>
					<td>
						<div class="element-name">
							<span class="nameFirst">
								<input placeholder=" Nombre" id="nombreper" type="text" style="width:125%"  name="name[first]" required="required"/>
								<span class="icon-place"></span>
							</span>
						</div>
					</td>
					<td style="text-align: center !important;padding-top: 10px !important;"><label class="title"><span class="required">Apellido</span></label></td>
					<td>
						<div class="element-name">
							<span class="nameLast">
								<input placeholder=" Apellido" id="apellidoper" type="text" style="width:125%"  name="name[last]" required="required"/>
								<span class="icon-place"></span>
							</span>
						</div>
					</td>
				</tr>
				<tr>
					<td style="text-align: center !important;padding-top: 10px !important;"><label class="title"><span class="required">C&eacute;dula</span></label></td>
					<td>
						<div class="element-number">
							<div class="item-cont">
								<input style="width:100%"  id="cedulaper" type="text" maxlength="8"  name="number" required="required" placeholder="Cédula" value=""/>
								<span class="icon-place"></span>
							</div>
						</div>
					</td>
				<td style="text-align: center !important;padding-top: 10px !important;">Estado Civil</td>
				<td>
							<div class="element-select">
								<div class="item-cont">
									<div>
										<select id="edocivilC" required="required" style="width:100%">
											<option value="0">Seleccione</option>
											<option value="1">Soltero(a)</option>
											<option value="2">Casado(a)</option>
											<option value="3">Divorciado(a)</option>
											<option value="4">Viudo(a)</option>
										</select><i></i><span class="icon-place"></span>
									</div>
								</div>
							</div>
					</td>
				</tr>
				
		   <tr>
		       <td style="text-align: center !important;padding-top: 10px !important;"><label><span class="required">Fecha</span></label></td>
				<td>
					<div class="element-date">
						<div class="item-cont"><input style="width:100%" type="text" id="fechanacC" placeholder="Fecha de Nacimiento"/>
							<span class="icon-place"></span>
						</div>
					</div>
			   </td>
			   <td style="text-align: center !important;padding-top: 10px !important;"><label class="title"><span class="required">Tipo de Personal</span></label></td>
				<td>
					<div class="element-select">
						<div class="item-cont">
							<div class="medium"><span>
									<select id="tipoper" name="select" style="width:125%">
										    <option value='0'>Seleccione</option>
										    <option value='Mesonero'>Mesonero</option>
										
									</select><i></i><span class="icon-place"></span></span>
								
							</div>
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td style="text-align: center !important;padding-top: 10px !important;"><label><span>Teléfono habitación</span></label></td>
				<td>
					<div class="element-phone">
						  <div class="item-cont">
							  <input id="tlfper1" style="width:100%"  type="tel" pattern="[+]?[\.\s\-\(\)\*\#0-9]{3,}" maxlength="11" name="phone" placeholder="Teléfono" value=""/>
							  <span class="icon-place"></span>
						  </div>
					</div>
				</td>
				
				<td style="text-align: center !important;padding-top: 10px !important;"><label class="title"><span class="required">Teléfono móvil</span></label></td>
				<td>
					<div class="element-phone">
						  <div class="item-cont">
							  <input id="tlfper2" style="width:100%"  type="tel" pattern="[+]?[\.\s\-\(\)\*\#0-9]{3,}" maxlength="11" name="phone" placeholder="Teléfono" value=""/>
							  <span class="icon-place"></span>
						  </div>
					</div>
				</td>
		   </tr>
		    <tr>
				 <td style="text-align: center !important;padding-top: 10px !important;"><label><span class="required">Parroquia</span></label></td>
					<td colspan="3">

						<div class="element-textarea">
							<div class="item-cont">
								<textarea id="idparro" cols="4" rows="1" placeholder="Parroquia" style="width: 100%"></textarea>
								<span class="icon-place"></span>
							</div>
						</div>
					</td>
				
			 </tr>
			  <tr>
				 	<td style="text-align: center !important;padding-top: 10px !important;" ><label><span class="required">Dirección</span></label></td>
					<td colspan="3">
						<div class="element-textarea">
							<div class="item-cont">
								<textarea id="direcc" cols="4" rows="1" placeholder="Dirección" style="width: 100%"></textarea>
								<span class="icon-place"></span>
							</div>
						</div>
					</td>
			   </tr>
		</table>
		<table border='0' style="padding-left: 100px; width: 690px;">
			<tr><td colspan="10"><div id="titulForm_2"><img src="../images/modulos/icon/estatus.png" alt="icon_datos"/>&nbsp;<b>Estatus</b></div></td></tr>
			<tr>
				<td>
					<div class="column column1"><label>
							<input id='radio1' type="radio" name="radio" value="Activo"     onclick="valuecheck(this)"/><span>Activo</span></label><label>
							<input id='radio2' type="radio" name="radio" value="Inactivo"   onclick="valuecheck(this)"/><span>Inactivo</span></label></div><span class="clearfix"></span>
				</td>
			</tr>
			<tr id="troculto">
				<td colspan="3">idxparro</td>
				<td><input  size="7" type="text" id="idxparro"  /></td>
			</tr>
		</table>
	</div>
			
			    <table style="margin-left: 170px;">
					<tr>
						<td>
							<a  id="Limpiarx"    href="#" class="btnNew" >Limpiar</a>
							<a  id="Registrarx"  href="#" class="btnNew" >Registrar</a>
							<a  id="Modificarx"  href="#" class="btnNew" >Modificar</a>
						
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
					  alertaa ('No tiene perrmisos para acceder a esta página');
					  window.location="../index.php";
					}  
					setTimeout ("redireccionar()", 1000); //tiempo de espera en milisegundos
		 </script> 
<?php } ?> 	