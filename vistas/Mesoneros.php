<?php
session_start();
if (isset($_SESSION['usuId'])){
	$usuario = $_SESSION['usuId'];
?>

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
					  url: '../controlador/registroclientes.php',
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
					  url: '../controlador/personal.php',
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
					  url: '../controlador/personal.php',
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
		
				url:'../controlador/personal.php',
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
				editurl:'../controlador/personal.php',
				viewrecords: true,
				rownumbers: true,
				onSelectRow: function(id){ 
				
				//$('#listadopersonal tr').click(function(){
				    var a = jQuery("#listadopersonal").jqGrid('getRowData',id).ced;
					//var a = $(this).find("td").eq(1).html();
				    var cedpers = parseInt(a);
			
					
					$.ajax({
					  url: '../controlador/personal.php',
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
								/*if(dat[4]=='Limpieza'){
									$("#tipoper").attr("value",1);					
								}else if(dat[4]=='Cocinero'){
									 $("#tipoper").attr("value",2);					
								}else if(dat[4]=='Vigilante'){
									 $("#tipoper").attr("value",3);					
								}else if(dat[4]=='Jardinero'){
									 $("#tipoper").attr("value",4);					
								}else if(dat[4]=='Obrero'){
									 $("#tipoper").attr("value",5);					
								}else if(dat[4]=='Otro'){
									 $("#tipoper").attr("value",6);					
								}*/
								
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

<div id="ajustarx2">
	<div id="titulForm"><img src="../images/modulos/icon/config.png" alt="icon_clientes" class="icon_config"/>Configuración de personal</div>
	<div style="border-bottom: 1px solid #dadada;">
		<span  id="rsperrorpersonal" style="color:#BB0323"></span> <br/>
		<table id="listadopersonal"></table> <br/>
		<div   id="paginadorpersonal"></div>
	</div>
	<br/>
	<form class="formoid-solid-green" method="post"><div class="title"><h2><img src="../images/modulos/icon/personal.png" alt="icon_datos"/>&nbsp;Personal</h2></div><br/>
		<table border='0'>
				<tr>
					<td><label class="title1"><span class="required">Nombre</span></label></td>
					<td>
						<div class="element-name">
							<span class="nameFirst">
								<input placeholder=" Nombre" id="nombreper" type="text" style="width:125%"  name="name[first]" required="required"/>
								<span class="icon-place"></span>
							</span>
						</div>
					</td>
					<td><label class="title1"><span class="required">Apellido</span></label></td>
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
					<td><label class="title1"><span class="required">C&eacute;dula</span></label></td>
					<td>
						<div class="element-number">
							<div class="item-cont">
								<input style="width:100%"  id="cedulaper" type="text" maxlength="8"  name="number" required="required" placeholder="Cédula" value=""/>
								<span class="icon-place"></span>
							</div>
						</div>
					</td>
				<td><label style="text-align: center !important;"><span>Estado Civil</span></label></td>
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
		       <td><label style="text-align: center !important;"><span class="required">Fecha</span></label></td>
				<td>
					<div class="element-date">
						<div class="item-cont"><input style="width:100%" type="text" id="fechanacC" placeholder="Fecha de Nacimiento"/>
							<span class="icon-place"></span>
						</div>
					</div>
			   </td>
			   <td><label class="title1"><span class="required">Tipo de Personal</span></label></td>
				<td>
					<div class="element-select">
						<div class="item-cont">
							<div class="medium"><span>
									<select id="tipoper" name="select" style="width:125%"  required="required">
										<?php
										  if($_SESSION['existe']=="Mesonero"){
										      echo "<option value='Mesonero'>Mesonero</option>";
										  }else if($_SESSION['existe']=="0"){
												echo "<option value='0'>Seleccione</option>";
												echo "<option value='Limpieza'>De Limpieza</option>";
												echo "<option value='Cocinero'>Cocinero</option>";
												echo "<option value='Vigilante'>Vigilante</option>";
												echo "<option value='Jardinero'>Jardinero</option>";
												echo "<option value='Obrero'>Obrero</option>";
												echo "<option value='Mesonero'>Mesonero</option>";
												echo "<option value='Otro'>Otro</option>";
										  }
										?>
									</select><i></i><span class="icon-place"></span></span>
								
							</div>
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td style="text-align: center !important;"><label><span>Teléfono habitación</span></label></td>
				<td>
					<div class="element-phone">
						  <div class="item-cont">
							  <input id="tlfper1" style="width:100%"  type="tel" pattern="[+]?[\.\s\-\(\)\*\#0-9]{3,}" maxlength="11" name="phone" placeholder="Teléfono" value=""/>
							  <span class="icon-place"></span>
						  </div>
					</div>
				</td>
				
				<td><label class="title1"><span class="required">Teléfono móvil</span></label></td>
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
				 <td><label style="text-align: center !important;"><span class="required">Parroquia</span></label></td>
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
				 	<td width='50' ><label style="text-align: center !important;"><span class="required">Dirección</span></label></td>
					<td width='135' colspan="3">
						<div class="element-textarea">
							<div class="item-cont">
								<textarea id="direcc" cols="4" rows="1" placeholder="Dirección" style="width: 100%"></textarea>
								<span class="icon-place"></span>
							</div>
						</div>
					</td>
			   </tr>
		</table>
		<table border='0' style="padding-left: 40px; width: 690px;">
			<tr><td colspan="10"><div id="titulForm_2"><img src="../images/modulos/icon/estatus.png" alt="icon_datos"/>&nbsp;<b>Estatus</b></div></td></tr>
			<tr>
				<td>
					<div class="column column1"><label>
							<input id='radio1' type="radio" name="radio" value="Activo"    required="required"  onclick="valuecheck(this)"/><span>Activo</span></label><label>
							<input id='radio2' type="radio" name="radio" value="Inactivo"  required="required"  onclick="valuecheck(this)"/><span>Inactivo</span></label></div><span class="clearfix"></span>
				</td>
			</tr>
			<tr id="troculto">
				<td colspan="3">idxparro</td>
				<td><input  size="7" type="text" id="idxparro"  /></td>
				

			</tr>
		</table>
		<div  id="border_regBottom2">
			<table border='0'>
				<tr>
					<td id='boton1'><input id = "Limpiarx"   type="button" value="Limpiar"  /></td>
					<td id='boton2'><input id = "Registrarx" type="button" value="Registrar"/></td>
					<td id='boton3'><input id = "Modificarx" type="button" value="Modificar"/></td>
				</tr>
			</table>
		</div>
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