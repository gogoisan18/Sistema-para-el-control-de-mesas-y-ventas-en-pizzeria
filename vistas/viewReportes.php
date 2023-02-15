<?php
session_start();
if (isset($_SESSION['usuId'])){
	$usuario = $_SESSION['usuId'];
?>
<script type="text/javascript">
	jQuery(document).ready(function(){
		
		$('#pulga').hide();
		limpiarCampos();
		$('#numhabi').attr("onKeyPress", "return soloNum(event)");
		
			/******FECHAS INICIO Y CULMINACION*******/	
			$("#fechaI, #fechaC").datepicker({
				  showOn: 'both',
				  //buttonImage: '../compartida/imagenes/calendario.png',
				  buttonImageOnly: true,
				  changeMonth: false, 
				  changeYear: true, 
				  maxDate:"+3m +0w +0y +0d",
				  numberOfMonths: 1,
				  onSelect: function(textoFecha, objDatepicker){  }
			   });
			
			$("#limpiarREP").click(function(){
				limpiarCampos();
			});

			/*****************AUTOCOMPLETA habitacion con cuenta abierta PARA GENERAR REPORTES********************/
				$("#numhabi").autocomplete({
					source: function(request, response) {
						$.ajax({
							url: '../controlador/viewreportes.php',
							data: {
								term: request.term,
								oper: 'autocompletar_habi_cuenta'
							},
							dataType: "json",
							type: "POST",
							success: function(data){
								response(data);
							}
						});
					},
					select: function(event, ui) {
					    
						if(ui.item.evaluo=='1'){
							$("#cuentax").val(ui.item.idcuenta);
							$("#idhabx").val(ui.item.idhab);
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
					width: 250,
					minChars: 3,
					selectFirst: false,
					mustMatch: true
				});
				$('.ui-autocomplete').css({'font-size':'11px'});
				
				/*****************AUTOCOMPLETA mesa con cuenta abierta PARA GENERAR REPORTES********************/
				
				$("#nummesa").autocomplete({
					source: function(request, response) {
						$.ajax({
							url: '../controlador/viewreportes.php',
							data: {
								term: request.term,
								oper: 'autocompletar_mesa_cuenta'								
							},
							dataType: "json",
							type: "POST",
							success: function(data){
								response(data);
							}
						});
					},
					select: function(event, ui) {
					    if(ui.item.evaluo=='1'){
							$("#cuentaR").val(ui.item.idcuenta);
							$("#mesa").val(ui.item.value);
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
					width: 250,
					minChars: 3,
					selectFirst: false,
					mustMatch: true
				});
				$('.ui-autocomplete').css({'font-size':'11px'});
				
				/*****************AUTOCOMPLETA DATOS DE PROVEEDOR PARA GENERAR REPORTES********************/
				
				$("#rifprovee").autocomplete({
					source: function(request, response) {
						$.ajax({
							url: '../controlador/viewreportes.php',
							data: {
								term: request.term,
								oper: 'autocompletar_datos_provee'
							},
							dataType: "json",
							type: "POST",
							success: function(data){
								response(data);
							}
						});
					},
					select: function(event, ui) {
						
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
					width: 250,
					minChars: 3,
					selectFirst: false,
					mustMatch: true
				});
				$('.ui-autocomplete').css({'font-size':'11px'});
			
			/******ENVIAR FILTROS PARA GENERAR REPORTES**********/
			 $("#imprimirREP").on( "click", function(){
			    
				var opcion = $("#cmbListado").val();
						
				var fechai = $("#fechaI").val();
				var fechac = $("#fechaC").val();
				
						
				
				if(opcion=='1'){
				    var datos="fechai="+fechai+"&fechac="+fechac+"&tipo=HOSPEDAJE";
					window.open('rptPagos.php?'+datos);
				}else if(opcion=='2'){
				    var datos="fechai="+fechai+"&fechac="+fechac+"&tipo=RESTAURANTE";
					window.open('rptPagos.php?'+datos);
				}else if(opcion=='3'){
				    var xcuentax = $("#cuentax").val();
					var xidhabx = $("#idhabx").val();
					var opciontipo = $("#cmbtipoCuenta").val();
					
					if(opciontipo=='1'){
						var datos="cuenta="+xcuentax+"&idhab="+xidhabx+"&tipo=1";
						window.open('rptcuentasH.php?'+datos);
					}else{
						var datos="tipo=2";
						window.open('rptcuentasH.php?'+datos);
					}
				}else if(opcion=='4'){
				    var xcuentaR = $("#cuentaR").val();
					var mesax = $("#mesa").val();
					var opciontipo = $("#cmbtipoCuentaR").val();
			
					if(opciontipo=='1'){
						var datos="cuenta="+xcuentaR+"&mesa="+mesax+"&tipo=1";
				
						window.open('rptcuentasR.php?'+datos);
					}else{
						var datos="tipo=2";
						window.open('rptcuentasR.php?'+datos);
					}
				}else if(opcion=='5'){
				    var datos="fechai="+fechai+"&fechac="+fechac+"&tipo=1";
					window.open('rptcaja.php?'+datos);
				}else if(opcion=='6'){
				    var datos="fechai="+fechai+"&fechac="+fechac+"&tipo=2";
					window.open('rptcaja.php?'+datos);
				}else if(opcion=='7'){
				    var datos="fechai="+fechai+"&fechac="+fechac;
					window.open('rptreservaciones.php?'+datos);
				}else if(opcion=='8'){
				    var datos="fechai="+fechai+"&fechac="+fechac;
					window.open('rptdisponi.php?'+datos);
				}else if(opcion=='9'){
				    var datos="fechai="+fechai+"&fechac="+fechac;
					window.open('rptpresu.php?'+datos);
				}else if(opcion=='10'){
				    var datos="fechai="+fechai+"&fechac="+fechac;
					window.open('rptlimpieza.php?'+datos);
				}else if(opcion=='12'){
		          
					var opciontipo = $("#cmbprovee").val();
					var rifproveex = $("#rifprovee").val();
			       // alert(opciontipo);
					
					if(opciontipo=='1'){
					    if(rifproveex==''){
							alerta('Por favor ingrese los datos del proveedor');
						}else{
							var datos="rif="+rifproveex;
							window.open('rptprovee.php?'+datos);
						}
						
					}else if(opciontipo=='2'){
						   window.open('rptproveeL.php');
					}
				}else if(opcion=='13'){
		
					var opciontipo = $("#cmbartic").val();
			
					if(opciontipo=='1'){
						var datos="tipo=1";
						window.open('rptarticulo.php?'+datos);
						
					}else if(opciontipo=='2'){
						var datos="fechai="+fechai+"&fechac="+fechac;
					   window.open('rptdesincorpor.php?'+datos);
					}else {
						var datos="tipo=2";
						window.open('rptarticulo.php?'+datos);
					}
				}
				
				
				/*var ordenar = $("#cmbOrdenar").val();
				var cedula = $("#cedula").val();
				var coddesde = $("#coddesde").val();
				var codhasta = $("#codhasta").val();
				var direccion = $("#cmbDireccion").val();
				var cargo = $("#cmbCargo").val();
				var jerarquia = $("#cmbJerarquia").val();
				var estatus = $("#cmbEstatus").val();
				
				
				var datos="ordenar="+ordenar+"&cedula="+cedula+"&coddesde="+coddesde+"&codhasta="+codhasta+"&direccion="+direccion+"&cargo="+cargo+"&jerarquia="+jerarquia+"&estatus="+estatus+"&fechai="+fechai+"&fechac="+fechac;
				var tiporeporte = $("#cmbListado").val();
				var reporte='';
				
				if(tiporeporte==0){
					reporte="vistas/rptListadoPolicia.php";
				}else if(tiporeporte==1){
					reporte="vistas/rptListadoPolicia_oficio.php";
				}else{
					reporte=consultar_disenoactivo();
				}
				abrirVentana(reporte+"?"+datos,'Reporte en pdf',800,700);
				*/		
				
			});

			$("#cmbListado").on( "change", function(){
				var opcion = $("#cmbListado").val();
				//alert(opcion);
				
				if(opcion=='1' || opcion=='2' || opcion=='5' || opcion=='6' || opcion=='7' || opcion=='8' || opcion=='9' || opcion=='10' || opcion=='17'){
					$("#filatipoCuenta,#filatipoCuentaR,#filaclientes,#filaprovee,#filaArticulos,#filakit,#filacompra,#filaentrega").hide();
					$("#filafecha").show();
				}else if(opcion=='3'){
					$("#filafecha,#filatipoCuentaR,#filaclientes,#filaprovee,#filaArticulos,#filakit,#filacompra,#filaentrega").hide();
					$("#filatipoCuenta").show();
				}else if(opcion=='4'){
					$("#filafecha,#filatipoCuenta,#filaclientes,#filaprovee,#filaArticulos,#filakit,#filacompra,#filaentrega").hide();
					$("#filatipoCuentaR").show();
				}else if(opcion=='11'){
					$("#filafecha,#filatipoCuenta,#filatipoCuentaR,#filaprovee,#filaArticulos,#filakit,#filacompra,#filaentrega").hide();
					$("#filaclientes").show();
				}else if(opcion=='12'){
					$("#filafecha,#filatipoCuenta,#filatipoCuentaR,#filaclientes,#filaArticulos,#filakit,#filacompra,#filaentrega").hide();
					$("#filaprovee").show();
				}else if(opcion=='13'){
					$("#filafecha,#filatipoCuenta,#filatipoCuentaR,#filaclientes,#filaprovee,#filacompra,#filaentrega").hide();
					$("#filaArticulos").show();
				}else if(opcion=='14'){
					$("#filafecha,#filatipoCuenta,#filatipoCuentaR,#filaclientes,#filaprovee,#filaArticulos,#filacompra,#filaentrega").hide();
					$("#filakit").show();
				}else if(opcion=='15'){
					$("#filafecha,#filatipoCuenta,#filatipoCuentaR,#filaclientes,#filaprovee,#filaArticulos,#filakit,#filaentrega").hide();
					$("#filacompra").show();
				}else if(opcion=='16'){
					$("#filafecha,#filatipoCuenta,#filatipoCuentaR,#filaclientes,#filaprovee,#filaArticulos,#filakit,#filacompra").hide();
					$("#filaentrega").show();
				}
			});	
			
			$("#cmbtipoCuenta").on( "change", function(){
				var opcionti = $("#cmbtipoCuenta").val();
				$('#idhabx,#cuentax').val('');
				
				if(opcionti=='1'){
					$("#col2").show();
				}else{
					$("#col2").hide();
					
				}
			});
			
			$("#cmbtipoCuentaR").on( "change", function(){
				var opcionti = $("#cmbtipoCuentaR").val();
				$('#cuentaR,#mesa').val('');
				
				if(opcionti=='1'){
					$("#col3").show();
				}else{
					$("#col3").hide();
					
				}
			});
			
			/*$("#cmbcliente").on( "change", function(){
				var opcionti = $("#cmbcliente").val();
				
				if(opcionti=='1'){
					$("#col4").show();
				}else{
					$("#col4").hide();
					
				}
			});*/
			
			$("#cmbprovee").on( "change", function(){
				var opcionti = $("#cmbprovee").val();
						
				if(opcionti=='1'){
					$("#col5").show();
				}else{
					$("#col5").hide();
					
				}
			});
			
			$("#cmbartic").on( "change", function(){
				var opcionti = $("#cmbartic").val();
				if(opcionti=='2'){
					$("#filafecha").show();
				}
			});
			
			$("#cmbkit").on( "change", function(){
				var opcionti = $("#cmbkit").val();
						
				if(opcionti=='1'){
					$("#col6").show();
				}else{
					$("#col6").hide();
					
				}
			});
			
			$("#cmbcompra").on( "change", function(){
				var opcionti = $("#cmbcompra").val();
				//alert(opcion);
				
				if(opcionti=='1'){
					$("#filafecha").show();
					$("#col7").hide();
				}else if(opcionti=='2'){
					$("#col7").show();
					$("#filafecha").hide();
				}else{
					$("#col7").hide();
					$("#filafecha").hide();
				}
			});
			
			$("#cmbentrega").on( "change", function(){
				var opcionti = $("#cmbentrega").val();
				//alert(opcion);
				
				if(opcionti=='1'){
					$("#filafecha").show();
					$("#col8").hide();
				}else if(opcionti=='2'){
					$("#col8").show();
					$("#filafecha").hide();
				}else{
					$("#col8").hide();
					$("#filafecha").hide();
				}
			});
		
	});


	
/******FUNCION LIMPIAR*******/
function limpiarCampos(){
	$('#fechaI,#fechaC,#numhabi,#rifprovee,#cedcliente,#rifproveex,#idhabx,#cuentax,#cuentaR,#mesa').val('');
	$("#cmbListado,#cmbtipoCuenta,#cmbtipoCuentaR,#cmbcliente,#cmbprovee,#cmbartic,#cmbkit,#cmbcompra,#cmbentrega").attr("value","0");
	$("#filafecha,#filatipoCuenta,#filatipoCuentaR,#filaclientes,#filaprovee,#filaArticulos,#filakit,#filacompra,#filaentrega,#col2,#col3,#col3,#col4,#col5,#col6,#col7,#col8").hide();

}
</script>
    <link rel="stylesheet" href="../estilo/formoid/formoid-solid-green.css" type="text/css" />
<div id="ajustarx2">	
	<form class="formoid-solid-green" method="post"><div class="title"><h2><img src="../images/modulos/icon/cliente.png" alt="icon_datos"/>&nbsp;Área de Reportes</h2></div><br/>

		<table style="width:95%; left: 20px; !important; position: relative;" border="0">
					<tr>
					    <td><label class="title"><span class="required">Reporte</span></label></td>
						<td colspan="3">							
							<div class="element-select">
								<div class="item-cont">
									<div class="medium"><span>
										<select id="cmbListado" name="cmbListado" required="required">
											<option value="0">Seleccione</option>
											<option value="1">Pagos - Hospedaje</option>
											<option value="2">Pagos - Restaurante</option>
											<option value="3">Cuentas - Hospedaje</option>
											<option value="4">Cuentas - Restaurante</option>
											<option value="5">Caja - Hospedaje</option>
											<option value="6">Caja - Restaurante</option>
											
											<option value="7">Reservaciones</option>
											<option value="8">Disponibilad de Habitaciones</option>
											<option value="9">Presupuestos</option>
											<option value="10">Control de Limpieza Habitaciones</option>
											<!--<option value="11">Ficha de Hospedaje</option>-->
											
											<option value="12">Proveedores</option>
											<option value="13">Artículo o Bien</option>
											<option value="14">Kit de Amenities</option>
											<option value="15">Compras</option>
											<option value="16">Entrega de artículos</option>
											<option value="17">Prestamos</option>
											
											<!--<option value="18">Desincorporaciones</option>											
												<option value="19">Personal</option>
												<option value="20">Usuarios</option>-->
											
										</select><i></i><span class="icon-place"></span></span>
									</div>
								</div>
							</div>
						</td>
						
					</tr>
					<tr>
						<td style="border-top: 4px double #dadada;" colspan="4"></td>                              
					</tr>
					
					 <tr id="filatipoCuenta">
					    <td><label class="title"><span class="required">Tipo</span></label></td>
						<td colspan="2">							
							<div class="element-select">
								<div class="item-cont">
									<div class="medium"><span>
										<select id="cmbtipoCuenta" name="cmbtipoCuenta" required="required">
											<option value="0">Seleccione</option>
											<option value="1">Por Habitación</option>
											<option value="2">Todas las cuentas abiertas</option>
											
										</select><i></i><span class="icon-place"></span></span>
									</div>
								</div>
							</div>
						</td>
					    <td id="col2">
							<div class="element-number">
								<div class="item-cont">
									<input style="width:66%"  id="numhabi" type="text"  placeholder="Número de Habitación"/>
									<span class="icon-place"></span>
								</div>
							</div>
					    </td>
					</tr>
					 <tr id="filatipoCuentaR">
					    <td><label class="title"><span class="required">Tipo</span></label></td>
						<td colspan="2">							
							<div class="element-select">
								<div class="item-cont">
									<div class="medium"><span>
										<select id="cmbtipoCuentaR" name="cmbtipoCuentaR" required="required">
											<option value="0">Seleccione</option>
											<option value="1">Por Mesa</option>
											<option value="2">Todas las cuentas abiertas</option>
											
										</select><i></i><span class="icon-place"></span></span>
									</div>
								</div>
							</div>
						</td>
						 <td id="col3">
							<div class="element-number">
								<div class="item-cont">
									<input style="width:66%"  id="nummesa" type="text"  placeholder="Número de Mesa"/>
									<span class="icon-place"></span>
								</div>
							</div>
					    </td>
					</tr>
					<tr id="filaclientes">
					    <td><label class="title"><span class="required">Ingrese</span></label></td>
						<td colspan="3">
							<div class="element-number">
								<div class="item-cont">
									<input style="width:50%"  id="cedcliente" type="text"  placeholder="Número de habitación"/>
									<span class="icon-place"></span>
								</div>
							</div>
					    </td>
					</tr>
					<tr id="filaprovee">
					    <td><label class="title"><span class="required">Tipo</span></label></td>
						<td colspan="2">							
							<div class="element-select">
								<div class="item-cont">
									<div class="medium"><span>
										<select id="cmbprovee" name="cmbprovee" required="required">
											<option value="0">Seleccione</option>
											<option value="1">Por Proveedor</option>
											<option value="2">Todos</option>
											
										</select><i></i><span class="icon-place"></span></span>
									</div>
								</div>
							</div>
						</td>
						 <td id="col5">
							<div class="element-number">
								<div class="item-cont">
									<input style="width:67%"  id="rifprovee" type="text"  placeholder="RIF o Empresa"/>
									<span class="icon-place"></span>
								</div>
							</div>
					    </td>
					</tr>
					<tr id="filaArticulos">
					    <td><label class="title"><span class="required">Tipo</span></label></td>
						<td colspan="3">							
							<div class="element-select">
								<div class="item-cont">
									<div class="medium"><span>
										<select id="cmbartic" name="cmbartic" required="required">
											<option value="0">Seleccione</option>
											<option value="1">Por Agotarse (Menos de 10)</option>
											<option value="2">Desincorporados</option>
											<option value="3">Todos</option>
											
										</select><i></i><span class="icon-place"></span></span>
									</div>
								</div>
							</div>
						</td>
					</tr>
					<tr id="filakit">
					    <td><label class="title"><span class="required">Tipo</span></label></td>
						<td colspan="2">							
							<div class="element-select">
								<div class="item-cont">
									<div class="medium"><span>
										<select id="cmbkit" name="cmbkit" required="required">
											<option value="0">Seleccione</option>
											<option value="1">Por Kit</option>
											<option value="2">Todos</option>
											
										</select><i></i><span class="icon-place"></span></span>
									</div>
								</div>
							</div>
						</td>
						 <td id="col6">
							<div class="element-number">
								<div class="item-cont">
									<input style="width:67%"  id="numkit" type="text"  placeholder="Número o Nombre"/>
									<span class="icon-place"></span>
								</div>
							</div>
					    </td>
					</tr>
					<tr id="filacompra">
					    <td><label class="title"><span class="required">Tipo</span></label></td>
						<td colspan="2">							
							<div class="element-select">
								<div class="item-cont">
									<div class="medium"><span>
										<select id="cmbcompra" name="cmbcompra" required="required">
											<option value="0">Seleccione</option>
											<option value="1">Por Rango de Fechas</option>
											<option value="2">Por Proveedor</option>
											<option value="3">Todos</option>
											
										</select><i></i><span class="icon-place"></span></span>
									</div>
								</div>
							</div>
						</td>
						 <td id="col7">
							<div class="element-number">
								<div class="item-cont">
									<input style="width:67%"  id="rifproveex" type="text"  placeholder="RIF o Empresa"/>
									<span class="icon-place"></span>
								</div>
							</div>
					    </td>
					</tr>
					<tr id="filaentrega">
					    <td><label class="title"><span class="required">Tipo</span></label></td>
						<td colspan="2">							
							<div class="element-select">
								<div class="item-cont">
									<div class="medium"><span>
										<select id="cmbentrega" name="cmbentrega" required="required">
											<option value="0">Seleccione</option>
											<option value="1">Por Rango de Fechas</option>
											<option value="2">Por Personal</option>
										</select><i></i><span class="icon-place"></span></span>
									</div>
								</div>
							</div>
						</td>
						 <td id="col8">
							<div class="element-number">
								<div class="item-cont">
									<input style="width:62%"  id="cedperso" type="text"  placeholder="Cédula de Personal"/>
									<span class="icon-place"></span>
								</div>
							</div>
					    </td>
					</tr>
					
					<tr>
					<tr id="filafecha">
						<td><label class="title"><span class="required">Fecha</span></label></td>
						<td colspan="3">
							<input type="text" name="desde" id="fechaI" class="estilo-input" size="15" placeholder="Desde" readonly >  &nbsp;  &nbsp; 
							<input type="text" name="hasta" id="fechaC" class="estilo-input" size="15" placeholder="Hasta" readonly>
						</td>
					 </tr>
					
					<tr>	
						<td colspan="4" style="left: 280px; !important; position: relative;">
							<input id = "imprimirREP"   type="button" value="Imprimir"  />
							<input id = "limpiarREP"    type="button" value="Limpiar"/>
						</td>
					
					</tr>
					
					<tr id="pulga">
						<td colspan="4">
							<input type="text" name="cuentax" id="cuentax" size="2">
							<input type="text" name="idhabx"  id="idhabx"  size="2">
							<input type="text" name="cuentaR" id="cuentaR" size="2">
							<input type="text" name="mesa"    id="mesa"    size="2">
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