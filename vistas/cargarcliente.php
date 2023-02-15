<?php
session_start();
if (isset($_SESSION['usuId'])){
	$usuario = $_SESSION['usuId'];
	
	$idcli = $_SESSION['idcli'];
	$idregis = $_SESSION['idregis'];
?>
<script type="text/javascript">
	    
		function valuecheckmasco(check){        
			
			if(check.value=='Si'){
				 $("#masx").attr("value","Si");
			}else{
				  $("#masx").attr("value","No");
			}
		}
		
		function valuecheckvehi(check){        
			
			if(check.value=='Si'){
				  $("#vihx").attr("value","Si");
			}else{
				   $("#vihx").attr("value","No");
			}
		}
	
jQuery(document).ready(function(){

		$("#troculto,#troculto1").hide();
		$('#cedulaC,#tlfC,#codpostal').attr("onKeyPress", "return soloNum(event)");
		$('#nombreC,#apellidoC,#ocupaC,#pais,#idparro,#direcc,#descripmasc,#modelo,#otrovehi,#color,#placa').attr("onkeyup","this.value=this.value.toUpperCase()");
		$("#idxparro,#idxpais,#idxmodelo").attr("value","");
		
		
	   var idclix = $("#idcli").val();
	   var idregis = $("#idregis").val();
	   
	   $.ajax({
		  url: '../controlador/registroclientes.php',
		  data: {
					term: idregis,
					oper: 'buscar_infor'
				},
		  type: "POST",
		  success: function(data){
			   var dat = data.split('||');
			   
			  /* $salida  = $row['clienteCIC'].'||'.$row['clienteNacionaE'].'||'.$row['clientePasaporte'].'||';
						$salida .= $row['clienteNombreC'].'||'.$row['clienteApellidoC'].'||'.$parro.'||';
						$salida .= $row['parrIdC'].'||'.$row['paisNombreC'].'||'.$row['clientePaisC'].'||';
						$salida .= $row['clienteDireccC'].'||'.$row['clienteTelfC'].'||'.$fechan.'||';
						$salida .= $row['clienteSexoE'].'||'.$row['registroPoseeMas'].'||'.$row['registroDescMasco'].'||';
						$salida .= $row['registroPoseeVehi'].'||'.$model.'||'.$row['registroVehiOtro'].'||'.$row['clienteEdoCivilE'].'||';
						$salida .= $row['clienteCorreo'].'||'.$row['clienteOcupacion'].'||'.$row['registroPlacaVehi'].'||'.$row['registroVehiColor'].'||';
						$salida .= $row['registroModeloVehi'].'||'.$row['clienteZonaP'];*/
					  
				$("#cedulaC").attr("value",dat[0]);
				$("#nacio").attr("value",dat[1]);
				$("#nombreC").attr("value",dat[3]);
				$("#pasaporteC").attr("value",dat[2]);
				$("#sexoC").attr("value",dat[12]);
				$("#apellidoC").attr("value",dat[3]);
				
				if(dat[18]=='Soltero'){
					$("#edocivilC").attr("value",1);					
				}else if(dat[18]=='Casado'){
					$("#edocivilC").attr("value",2);				
				}else if(dat[18]=='Divorciado'){
					$("#edocivilC").attr("value",3);					
				}else if(dat[18]=='Viudo'){
					$("#edocivilC").attr("value",4);				
				}		

				$("#correoC").attr("value",dat[19]);
				$("#tlfC").attr("value",dat[10]);
				$("#fechanacC").attr("value",dat[11]);
				$("#ocupaC").attr("value",dat[20]);
				$("#pais").attr("value",dat[7]);
				$("#idparro").attr("value",dat[5]);
				$("#direcc").attr("value",dat[9]);
				
				if(dat[13]=='Si'){
					$("#radio1").attr('checked',true);
					$("#masx").attr("value","Si");
				}else{
					$("#radio2").attr('checked',true);
					$("#masx").attr("value","No");
				}	
				$("#descripmasc").attr("value",dat[14]);
				
				
				if(dat[15]=='Si'){
					$("#radio3").attr('checked',true);
					$("#vihx").attr("value","Si");
				}else{
					$("#radio4").attr('checked',true);
					$("#vihx").attr("value","No");
				}

				
				$("#modelo").attr("value",dat[16]);
				$("#otrovehi").attr("value",dat[17]);
				$("#color").attr("value",dat[22]);
				$("#placa").attr("value",dat[21]);
				
				$("#idxparro").attr("value",dat[6]);
				$("#idxpais").attr("value",dat[8]);
				$("#idxmodelo").attr("value",dat[25]);
				
				$("#codpostal").attr("value",dat[24]);
				
									
		  }
		});
		
		$("#Acompx").click( function(){
			     
				    $("#cargaracompa").load("frmRegisAcompa.php");
					$("#cargaracompa").dialog({
					      title: "Control de Acompañantes",
						  modal: true,
						  width: 850,
						  show: "fold",
						  hide: "scale",
						  buttons: {
							"Registrar": function () {
							
								var cedulaA = $("#cedulaA").val();
								var pasapA = $("#pasapA").val();
								var nacionA = $("#nacionA").val();
								var nombreA = $("#nombreA").val();
								var apelliA = $("#apelliA").val();
								var fechanacA = $("#fechanacA").val();
								var sexoA = $("#sexoA").val();
								var tlfA = $("#tlfA").val();
								var ocupaA = $("#ocupaA").val();
								var correoA = $("#correoA").val();
								var edocivilA = $("#edocivilA").val();
								var idreg = $("#idreg").val();
								var parentescoA = $("#parentescoA").val();
								
								if(nombreA==''){
									alerta('Por favor ingrese el nombre');
								}else if(apelliA==''){
									alerta('Por favor ingrese el apellido');
								}else if(fechanacA==0){
									alerta('Por favor ingrese la fecha de nacimiento');
								}else if(sexoA==0){
									alerta('Por favor ingrese el sexo');
								}else if(edocivilA==0){
									alerta('Por favor ingrese el estado civil');
								}else if(parentescoA==0){
									alerta('Por favor ingrese el parentesco');
								}else{
								//alert('cuasii');
										$.ajax({
										  url: '../controlador/registroacomp.php',
										  data: {
													oper: 'registraracomp',
													cedulaA: cedulaA,
													pasapA: pasapA,
													nacionA: nacionA,
													nombreA: nombreA,
													apelliA: apelliA,
													fechanacA: fechanacA,
													sexoA: sexoA,
													tlfA: tlfA,
													ocupaA: ocupaA,
													correoA: correoA,
													edocivilA: edocivilA,
													idreg: idreg,
													parentescoA	:parentescoA
												},
								
										  type: "POST",
										  success: function(retor){
												//alert(retor);
												if(retor==1){
												
													alerta('Registro realizado con éxito');
												    /*$("#cedulaA,#pasapA,#nombreA,#apelliA,#fechanacA,#tlfA,#ocupaA,#correoA,#idhabita").val('');
													$("#nacionA").attr("value",'V');
													$("#sexoA").attr("value",0);
													$("#edocivilA").attr("value",0);*/
													jQuery("#refresh_listadoacomp").click();
																																		
												}else{
												   alerta('Problemas para registrar');
												}
										  }
										});
									}
																			
							},
							"Modificar": function () {
							
								var cedulaA = $("#cedulaA").val();
								var pasapA = $("#pasapA").val();
								var nacionA = $("#nacionA").val();
								var nombreA = $("#nombreA").val();
								var apelliA = $("#apelliA").val();
								var fechanacA = $("#fechanacA").val();
								var sexoA = $("#sexoA").val();
								var tlfA = $("#tlfA").val();
								var ocupaA = $("#ocupaA").val();
								var correoA = $("#correoA").val();
								var edocivilA = $("#edocivilA").val();
								var idreg = $("#idreg").val();
								var parentescoA = $("#parentescoA").val();
								
								if(nombreA==''){
									alerta('Por favor ingrese el nombre');
								}else if(apelliA==''){
									alerta('Por favor ingrese el apellido');
								}else if(fechanacA==0){
									alerta('Por favor ingrese la fecha de nacimiento');
								}else if(sexoA==0){
									alerta('Por favor ingrese el sexo');
								}else if(edocivilA==0){
									alerta('Por favor ingrese el estado civil');
								}else if(parentescoA==0){
									alerta('Por favor ingrese el parentesco');
								}else{
								//alert('cuasii');
										$.ajax({
										  url: '../controlador/registroacomp.php',
										  data: {
													oper: 'modificaracomp',
													cedulaA: cedulaA,
													pasapA: pasapA,
													nacionA: nacionA,
													nombreA: nombreA,
													apelliA: apelliA,
													fechanacA: fechanacA,
													sexoA: sexoA,
													tlfA: tlfA,
													ocupaA: ocupaA,
													correoA: correoA,
													edocivilA: edocivilA,
													idreg: idreg,
													parentescoA:parentescoA
												},
								
										  type: "POST",
										  success: function(retor){
												//alert(retor);
												if(retor==1){
												
													alerta('Registro actualizado con éxito');
												    /*$("#cedulaA,#pasapA,#nombreA,#apelliA,#fechanacA,#tlfA,#ocupaA,#correoA,#idhabita").val('');
													$("#nacionA").attr("value",'V');
													$("#sexoA").attr("value",0);
													$("#edocivilA").attr("value",0);*/
													jQuery("#refresh_listadoacomp").click();
												
																																		
												}else{
												   alerta('Problemas para registrar');
												}
										  }
										});
									}
																			
							},
							"Limpiar": function () {
								$("#cedulaA,#pasapA,#nombreA,#apelliA,#fechanacA,#tlfA,#ocupaA,#correoA,#idhabita").val('');
								
								$("#nacionA").attr("value",'V');
								$("#sexoA").attr("value",0);
								$("#edocivilA").attr("value",0);	
								jQuery("#refresh_listadoacomp").click();								
						        
							},
							
							"Salir": function () {
							    //destruir_variable("idregis",'');
								$(this).dialog("close");
							}
							
						  }
				});
			
		});
		
		$("#Evaluar").click( function(){
		
				 $("#cargarevaluar").load("frmEvaluar.php");
				 $("#cargarevaluar").dialog({
					      title: "Evaluar al Cliente",
						  modal: true,
						
						  width: 500,
						  show: "fold",
						  hide: "scale",
						  buttons: {
							"Guardar": function () {
							
								var evalu = $("#evalu").val();
								var idreg = $("#idreg").val();
								var idchequ = $("#idchequ").val();
								
								if(evalu==''){
									alerta('Por favor ingrese la evaluación');
								}else{
								
										$.ajax({
										  url: '../controlador/registroclientes.php',
										  data: {
													oper: 'registrarevaluacion',
													evalu: evalu,
													idreg: idreg,
													idchequ:idchequ
												},
								
										  type: "POST",
										  success: function(retor){
												//alert(retor);
												if(retor==1){
												
													alerta('Registro realizado con éxito');
												    $("#evalu").val('');
													$(this).dialog("close");
																																														
												}else{
												   alerta('Problemas al evaluar');
												}
										  }
										});
									}
																			
							},
							"Limpiar": function () {
								$("#evalu").val('');
							},
							
							"Salir": function () {
							    //destruir_variable("idregis",'');
								$(this).dialog("close");
							}
							
						  }
				});
		});
	
		$("#pais").autocomplete({
				source: function(request, response) {
					$.ajax({
					  url: '../controlador/registroclientes.php',
					  data: {
								term: request.term,
								oper: 'autocompletar_pais'
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
				        $('input[id=idxpais]').attr("value",ui.item.idpaiss);
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
		
		$("#modelo").autocomplete({
				source: function(request, response) {
					$.ajax({
					  url: '../controlador/registroclientes.php',
					  data: {
								term: request.term,
								oper: 'autocompletar_modelo'
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
				        $('input[id=idxmodelo]').attr("value",ui.item.modeloIdd);
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
		jQuery('.ui-autocomplete').css({'font-size':'14px'});
	
		
        $("#fechanacC").datepicker({
				
					  changeYear: true,
					  maxDate: 0,
					  numberOfMonths: 1,
					  onSelect: function(textoFecha, objDatepicker){
						
					  }
		});
		
		$("#Limpiarx").click( function(){
			
			$("#cedulaC,#nombreC,#pasaporteC,#codpostal").attr("value","");
			$("#apellidoC,#correoC,#tlfC,#fechanacC,#ocupaC").attr("value","");
			$("#pais,#idparro,#direcc,#descripmasc,#modelo,#otrovehi,#color,#placa").attr("value","");
			$("#edocivilC,#sexoC").attr("value",0);
			$("#nacio").attr("value",'V');
			//destruir_variable("idregis",'');
			$("#idxparro,#idxpais,#idxmodelo,#masx,#vihx").attr("value","");			
			$("#radio1,#radio2,#radio3,#radio4").attr('checked',false);
			
		});
			
		$("#Modificarx").click( function(){
			
			
			//alerta('en construcción');
			var cedulaC = $("#cedulaC").val();
			var nombreC = $("#nombreC").val();
			var pasaporteC = $("#pasaporteC").val();
			var apellidoC = $("#apellidoC").val();
			var correoC = $("#correoC").val();
			var tlfC  = $("#tlfC").val();
			
			var fechanacC  = $("#fechanacC").val();
			var ocupaC  = $("#ocupaC").val();
			var idxparro  = $("#idxparro").val();
			var idxpais  = $("#idxpais").val();
			var idxmodelo  = $("#idxmodelo").val();
			var direcc  = $("#direcc").val();
			var descripmasc  = $("#descripmasc").val();
			var otrovehi  = $("#otrovehi").val();
			var color  = $("#color").val();
			var placa  = $("#placa").val();
			var edocivilC  = $("#edocivilC").val();
			var sexoC  = $("#sexoC").val();
			var nacio  = $("#nacio").val();
			var codpostalx  = $("#codpostal").val();//#codpostal
			
			
			var masx  = $("#masx").val();
			var vihx  = $("#vihx").val();

			 
		   
			if(cedulaC==''){
				alerta('Por favor introduzca la Cédula');
			}else if(sexoC=='0'){
				alerta('Por favor seleccione el Sexo');
			}else if(nombreC==''){
				alerta('Por favor introduzca el Nombre');
			}else if(apellidoC==''){
				alerta('Por favor introduzca el Apellido');
			}else if(edocivilC=='0'){
				alerta('Por favor seleccione el Estado Civil');
			}else if(tlfC==''){
				alerta('Por favor introduzca el Teléfono');
			}else if(fechanacC==''){
				alerta('Por favor introduzca la Fecha de Nacimiento');
			}else if(ocupaC==''){
				alerta('Por favor introduzca la Ocupación');
			}else if(idxpais==''){
				alerta('Por favor introduzca el País de origen');
			}else if(idxparro==''){
				alerta('Por favor introduzca la Parroquia');
			}else if(direcc==''){
				alerta('Por favor introduzca la Dirección');
			}else if(masx==''){
				alerta('Por favor indique si el cliente se hospeda con mascotas');
			}else if(vihx==''){
				alerta('Por favor indique si el cliente se registra con vehículo');
			}else if(correoC==''){
				alerta('Por favor indique el Correo');
			}else if(correoC!=''){
				
				var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
		 
				if(regex.test($('#correoC').val().trim())) {
					if(masx=='Si' &&  descripmasc==''){
						alerta('Por favor indique la mascota del cliente');
					}else if(vihx=='Si' &&  (idxmodelo=='' || color=='' || placa=='')){
						alerta('Por favor indique los datos del vehículo del cliente');
					}else{
						$.ajax({
							  url: '../controlador/registroclientes.php',
							  data: {
									oper:'modificar',
									nacio:nacio,
									cedulaC:cedulaC,
									pasaporteC:pasaporteC,
									sexoC:sexoC,
									nombreC:nombreC,
									apellidoC:apellidoC,
									edocivilC:edocivilC,
									fechanacC:fechanacC,
									correoC:correoC,
									tlfC:tlfC,
									ocupaC:ocupaC,
									idxpais:idxpais,
									idxparro:idxparro,
									direcc:direcc,
									masx:masx,
									descripmasc:descripmasc,
									vihx:vihx,
									idxmodelo:idxmodelo,
									color:color,
									placa:placa,
									otrovehi:otrovehi,
									codpostalx:codpostalx
									
							   },
							  type: "POST",
							  success: function(data){
									if(data=='1'){
										
										/*$("#cedulaC,#nombreC,#pasaporteC").attr("value","");
										$("#apellidoC,#correoC,#tlfC,#fechanacC,#ocupaC").attr("value","");
										$("#pais,#idparro,#direcc,#descripmasc,#modelo,#otrovehi,#color,#placa").attr("value","");
										$("#edocivilC,#sexoC").attr("value",0);
										$("#nacio").attr("value",'V');
										destruir_variable("idregis",'');
										$("#idxparro,#idxpais,#idxmodelo,#masx,#vihx").attr("value","");			
										$("#radio1,#radio2,#radio3,#radio4").attr('checked',false);*/
										jQuery("#refresh_listadoRC").click();
										alerta('Cliente actualizado con éxito');
									}else{
										alerta(data);
									}
								
							  }
					    });
				    }
				
				}else{
					alerta('Por favor corrija la dirección de correo');
				}
			}
		});		
			
});
	
</script>
<!--<link rel="stylesheet" href="../estilo/formoid/formoid-solid-green.css" type="text/css" />-->
<!--
<style type="text/css">

.formoid-solid-green input[type=radio]:hover+span:before{
  color: #62D0BA !important;
}
.formoid-solid-green input[type=radio]:checked+span:before{
  color: #1abc9c !important;
}
</style>-->
<br/>


<div id="ajustarxx">
<form style="padding-top: 30px; padding-left: 50px; width: 105%; height: auto; padding: 50px; background-image: url('../images/modulos/fondo1.png') !important;"   method="post">

		<table border="0" style="width: 100%; height: auto;">
			<tr><td colspan="10"><div id="titulForm_2"><img src="../images/modulos/icon/registrar.png" alt="icon_datos"/>&nbsp;<b>Datos personales</b></div></td></tr>
			  <tr>
					<td style="width:15%;">C&eacute;dula</td>
					<td style="width:3%;height:35px;">
						<select id="nacio">
								<option value="V">V</option>
								<option value="E">E</option>
								<option value="N">N</option>
						</select>
					</td>
					<td style="width: 40% !important;">
								<input style="width:40%;height:35px;" id="cedulaC" type="text" maxlength="8"  placeholder="Cédula"/>
					</td>
					<td style="width:12%;">Pasaporte</td>
					<td style="width:22%;">
								<input  style="width:100%;height:35px;" type="text" id="pasaporteC"  placeholder="Pasaporte"/>
					</td>

					<td width='50'>Sexo</td>
					<td width='90'>
							<select id="sexoC">
								   <option value="0">Seleccione</option>
									<option value="M">Masculino</option>
									<option value="F">Femenino</option>
							</select>
					</td>
			   </tr>
			   <tr><td colspan = "4" style="height:10px;"></td></tr>
			   <tr>
				 <td>Nombre</td>
					<td colspan="2" style="width: 40% !important;">
								<input placeholder="Nombre" id="nombreC" type="text" style="width: 100%;height:35px;"/>
					</td>
					<td>Apellido</td>
					<td colspan="3">
								<input placeholder="Apellido" id="apellidoC" type="text" style="width: 100%;height:35px;"/>
					</td>
			   </tr>
			  <tr><td colspan = "4" style="height:10px;"></td></tr>	
			  <tr>
				<td>Estado Civil</td>
				<td colspan="2" style="width: 40% !important;">
							<select id="edocivilC">
								<option value="0">Seleccione</option>
								<option value="1">Soltero(a)</option>
								<option value="2">Casado(a)</option>
								<option value="3">Divorciado(a)</option>
								<option value="4">Viudo(a)</option>
							</select>
					</td>
					<td>Correo</td>
					<td colspan="3">
								<input  style="width: 100%;height:35px;" maxlength="30" type="email" id="correoC" value="" placeholder="Email"/>
					</td>
			   </tr>
			   <tr><td colspan = "4" style="height:10px;"></td></tr>
			   <tr>
				 <td>Teléfono</td>
					<td colspan="2" style="width: 40% !important;">
								<input  style="width: 50%;height:35px;" type="tel" pattern="[+]?[\.\s\-\(\)\*\#0-9]{3,}" maxlength="11" id="tlfC" placeholder="Teléfono" value=""/>
					</td>
					<td>Fecha Nac.</td>
					<td style="width: 20% !important;"><input type="text" id="fechanacC" placeholder="dd-mm-aaaa" style="width: 100% !important;height:35px;"/></td>
					
					<td width='50'>Zona postal</td>
					<td style="width: 20% !important;"><input type="text" id="codpostal" placeholder="Zona postal" style="width: 100% !important;height:35px;"/></td>
					
					
			   </tr>
			   <tr><td colspan = "4" style="height:10px;"></td></tr>
			   <tr>
				 <td>Ocupación</td>
					<td colspan="2" style="width: 40% !important;">
								<textarea id="ocupaC" placeholder="Ocupación" style="width: 100%;height:60px;"></textarea>
					</td>
					<td>País</td>
					<td colspan="3">
					            <textarea id="pais"  placeholder="País" style="width: 100%;height:60px;"></textarea>
								
					</td>
			   </tr>
			   <tr><td colspan = "4" style="height:10px;"></td></tr>
			   <tr>
				 <td>Parroquia</td>
					<td colspan="2" style="width: 70%;">
								<textarea id="idparro"  placeholder="Parroquia" style="width: 100%;height:60px;"></textarea>
					</td>
					<td>Dirección</td>
					<td style="width: 70%;" colspan="3">
								<textarea id="direcc"   placeholder="Dirección" style="width: 100%;height:60px;"></textarea>
					</td>
			   </tr>

			</table>
			<br/>
			<table border="0" style="width: 100%; height: auto;">
			<tr><td colspan="10"><div id="titulForm_2"><img src="../images/modulos/icon/mascota.png" alt="icon_datos"/>&nbsp;<img src="../images/modulos/icon/vehiculo.png" alt="icon_datos"/>&nbsp;<b>Información Extra</b></div></td></tr>
				<tr>
				 <td style="width:10%">Mascotas</td>
					<td colspan="5">
							<input id='radio1' type="radio" name="mascota" value="Si" onclick="valuecheckmasco(this)"/><span>Si</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input id='radio2' type="radio" name="mascota" value="No" onclick="valuecheckmasco(this)"/><span>No</span>
							<input  style="width:87%;height:35px;" type="text" id="descripmasc" placeholder="Descripción de Mascota"/>
							
					</td>

			   </tr>
			   <tr><td colspan = "6" style="height:10px;"></td></tr>
			   <tr>
				 <td style="width:10%">Vehículo</td>
					<td colspan="5">
					
							<input id='radio3' type="radio" name="vehiculo" value="Si" onclick="valuecheckvehi(this)"/><span>Si</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input id='radio4' type="radio" name="vehiculo" value="No" onclick="valuecheckvehi(this)"/><span>No</span>
							<input  style="width:87%;height:35px;height:35px;" type="text" id="modelo" placeholder="Marca y Modelo"/>
					
					</td>

			   </tr>
			   <tr><td colspan = "6" style="height:10px;"></td></tr>
			   <tr>
				 <td style="width:10%"><span style="text-align: center !important;">Otro</span></td>
					<td id="x" style="width:25%">
								<input style="width:100%;height:35px;" type="text" id="otrovehi" placeholder="Otra Marca"/>
					</td>
					<td style="width:5% !important;"><label class="title"><span>Color</span></label></td>
					<td style="width:20% !important;"><input  style="width:100%;height:35px;" type="text" id="color" placeholder="Color"/></td>
					<td style="width:5% !important;"><label class="title"><span>Placa</span></label></td>
					<td style="width:20% !important;"><input  style="width:100%;height:35px;" type="text" id="placa" placeholder="Placa"/></td>
			   </tr>

			<tr id="troculto">
				<td>idxparro</td>
				<td><input  size="7" type="text" id="idxparro"  /></td>
				<td>idxpais</td>
				<td><input  size="7" type="text" id="idxpais"   /></td>
				<td>idxmodelo</td>
				<td><input  size="7" type="text" id="idxmodelo" /></td>

			</tr>
			<tr id="troculto1">
				<td>masx</td>
				<td><input  size="7" type="text" id="masx"  /><input  size="7" type="text" id="idregis" value= "<?php  echo $idregis; ?>" /></td>
				<td>vihx</td>
				<td><input  size="7" type="text" id="vihx"   /></td>
				<td>xxxx</td>
				<td><input  size="7" type="text" id="idcli" value= "<?php  echo $idcli; ?>" /></td>

			</tr>
			</table>
	    <br />
		<table >
				<tr>
					<td id='boton1'><input id = "Limpiarx"   type="button" value="Limpiar"  /></td>
					<td id='boton3'><input id = "Modificarx" type="button" value="Modificar"/></td>
					<td id='boton3'><input id = "Acompx" type="button" value="Acompañantes"/></td>
					<td id='boton3'><input id = "Evaluar" type="button" value="Evaluar"/></td>

				</tr>
		</table>
		<div id="cargaracompa"></div>
		<div id="cargarevaluar"></div>
	
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