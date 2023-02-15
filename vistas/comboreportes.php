<?php
session_start();
if (isset($_SESSION['usuId'])){
    include("../header.php");
	$usuario = $_SESSION['usuId'];
?>
<script>
    $(document).ready(function() {
	
		$("#ced,#impcuen,#tr1,#tr2,#tipo").hide();
	    $("#idced,#precuentaId").attr("value",'');
	    
		jQuery('#fechadesde').datepicker({dateFormat:"dd-mm-yy"});
        jQuery('#fechahasta').datepicker({dateFormat:"dd-mm-yy"});
		
	function autocompletaPer(){
				$("#idced").autocomplete({
						source: function(request, response) {
							$.ajax({
							  url: '../controlador/comborepor.php',
							  data: {
										term: request.term,
										oper: 'buscar_cuentat'
									},
							  dataType: "json",
							  type: "POST",
							  success: function(data){
								  response(data);
							  }
							});
						},
						select: function(event, ui) { 
														
							if(ui.item.evaluo==1 && ui.item.tipo==1){
								crear_variable('idtic',ui.item.idtic);
								crear_variable('tiposal','1');
								
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
						minChars: 1,
						selectFirst: false,
						mustMatch: true,
						//delay: 1000
					});
					jQuery('.ui-autocomplete').css({'font-size':'100%'});
	}
	function autocompletaPers(){
				$("#idced").autocomplete({
						source: function(request, response) {
							$.ajax({
							  url: '../controlador/comborepor.php',
							  data: {
										term: request.term,
										oper: 'buscar_cuentaf'
									},
							  dataType: "json",
							  type: "POST",
							  success: function(data){
								  response(data);
							  }
							});
						},
						select: function(event, ui) { 
														
							if(ui.item.evaluo==1 && ui.item.tipo==2){
								crear_variable('idfac',ui.item.idfac);
								crear_variable('tiposal','2');
								
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
						width: 400,
						minChars: 1,
						selectFirst: false,
						mustMatch: true,
						//delay: 1000
					});
					jQuery('.ui-autocomplete').css({'font-size':'70%'});
	}
	function autocompletahabi(){
				$("#precuentaId").autocomplete({
						source: function(request, response) {
							$.ajax({
							  url: '../controlador/comborepor.php',
							  data: {
										term: request.term,
										oper: 'autocompletar_habcuenta'
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
								crear_variable('idcuenhot',ui.item.idcuex);
								crear_variable('idha',ui.item.idha);
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
						minChars: 1,
						selectFirst: false,
						mustMatch: true
					});
					jQuery('.ui-autocomplete').css({'font-size':'90%'});
			}

		
		/**Cada vez que cambien las opciones de consulta***/
		$("#seleconsultas").on("change",function(){
	       
			    destruir_variable("cedu",'');
				$("#idced,").attr("value",'');
				$("#fechadesde").attr("value",'');
			    $("#fechahasta").attr("value",'');
				
		       var opcion = $("#seleconsultas").val();
			   if(opcion=='1'){
			        
				    autocompletaPer();
					$("#ced,#tipo").show();
					$("#impcuen,#tr1,#tr2").hide();
					 
			   }else if(opcion=='2'){
			        
				    autocompletaPers();
					$("#ced,#tipo").show();
					$("#impcuen,#tr1,#tr2").hide();
					 
			   }
			   else if(opcion=='3'){
			        
				    autocompletahabi();
					$("#impcuen").show();
					$("#ced,#tr1,#tr2,#tipo").hide();
					 
			   }else if(opcion=='4'){
				   
					$("#ced,#impcuen").hide();
					$("#tr1,#tr2,#tipo").show();
					 
			   }else{
			        $("#ced,#impcuen,#tr1,#tr2,#tipo").hide();
					alerta('Por favor Seleccione una consulta');
					
			   }	
		});  
		
		$("#mostrarr").click(function(){
		
			var opcion = $("#seleconsultas").val();
			 
				if(opcion=='0'){
				 	alerta('Por favor Seleccione una consulta');
				}else if(opcion=='1'){
				   
				   var cedulaPer= $("#idced").attr("value");
				   var tipopapel= $("#tipopapel").attr("value");
				   
				   if(cedulaPer==''){
						alerta('Por favor Ingrese todos los datos');
			       }else if(tipopapel==0){
						alerta('Por favor seleccione el tipo de papel');
			       }else{
				        crear_variable('tp',tipopapel);
				      	window.open('rptCuentaTFXHotel.php');
						window.open('rptCuentaTFXCHotel.php');
				   }
				}else if(opcion=='2'){
				   
				   var cedulaPer= $("#idced").attr("value");
				   var tipopapel= $("#tipopapel").attr("value");
				   
				   
				   if(cedulaPer==''){
						alerta('Por favor Ingrese todos los datos');
			       }else if(tipopapel==0){
						alerta('Por favor seleccione el tipo de papel');
			       }else{
				        crear_variable('tp',tipopapel);
						window.open('rptCuentaTFXHotel.php');
						window.open('rptCuentaTFXCHotel.php');
				   }
				}else if(opcion=='3'){
				   
				   var precuentaId= $("#precuentaId").attr("value");
				   
				   if(precuentaId==''){
						alerta('Por favor Ingrese todos los datos');
			       }else{
				        window.location="rptImpresCuentaHotel.php";
				   }
				}else if(opcion=='4'){
				    var filtro1 = $("#fechadesde").attr("value");
                    var filtro2 = $("#fechahasta").attr("value");
					
					if(filtro1=='' || filtro2==''){
						alerta('Por favor Ingrese ambas fechas');
					}else{
						window.location="rptReservacionesH.php?desde="+filtro1+"&hasta="+filtro2;
					}
					
				}
		
		});
		
		$("#limpiarr").click(function(){
		
			$("#idced").attr("value",'');
			$("#fechadesde").attr("value",'');
			$("#fechahasta").attr("value",'');
			$("#precuentaId").attr("value",'');
			$("#ced,#impcuen,#tr1,#tr2,#tipo").hide();
			destruir_variable("cedu",'');
			$("#seleconsultas").attr("value",0);
		
			  					
		});

    });
</script><br/><br/><br/><br/>
<table  id="formreportes" style="border-right: 2px solid #34353;"> 
		<tr><td>
				<table id= "contenido" style="width: 520px; padding-left:20px;" border='0'>
						<tr><td style="width: 100px; padding-top: 10px;">Reporte:</td>
							
							<td><div id="consulta" width="10%">
 							   <select id="seleconsultas" class="estilo-input"  size="1" >
									<option role="option" value="0">Seleccione&nbsp;&nbsp;</option>
									<option role="option" value="1">Reimprimir Ticket</option>	
									<option role="option" value="2">Reimprimir Factura</option>
									<option role="option" value="3">Impresi&oacute;n de Cuenta</option>	
									<!--<option role="option" value="4">Reservaciones</option>-->										
								</select>
							</div></td>
						
						</tr>
						<tr ><td style="border-bottom: 2px solid #343536;" colspan="2"><br /></td></tr>
						<tr  id="ced">
							<td  style="width: 100px;  padding-top: 10px;">C&eacute;dula:</td>
							<td><input type="text" title= ""  id="idced" size="40" /></td>
						</tr>	
						<tr  id="impcuen">
							<td style="width: 100px;  padding-top: 10px;">Habitaci&oacute;n:</td>
							<td><input type="text" title= ""  id="precuentaId" size="40" /></td>
						</tr>
						<tr id='tr1'>
							<td align='left'>Desde:</td>
							<td>
								<input name='fechadesde' id='fechadesde' size='15' />
							</td>
					   </tr>
						<tr id='tr2'>
							<td align='left'>Hasta:</td>
							<td>
								<input name='fechahasta' id='fechahasta' size='15' />
							</td>
						</tr>
						<tr><td></td></tr>
						
						<tr id="tipo">
							<td  style="width: 100px;  padding-top: 10px;">Papel:</td>
							<td><select id="tipopapel" class="estilo-input" size="1">
									<option role="option" value="0">Seleccione&nbsp;&nbsp;</option>
									<option role="option" value="1">Tipo Carta</option>	
									<option role="option" value="2">Tipo Factura</option>
								</select>
							</td>
						</tr>
						
						<tr >
							<td align="right"  style="border-top: 2px solid #343536;" colspan="2"><br/>
								<a id='mostrarr'> Mostrar &nbsp;&nbsp;&nbsp;</a>	
								<a id='limpiarr'> Limpiar&nbsp;&nbsp;&nbsp;</a>
							</td>
						</tr>
					
				</table><br/>		
	</td></tr>
</table>
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