<?php
session_start();
if (isset($_SESSION['usuId'])){

	$usuario = $_SESSION['usuId'];
?>
<script type="text/javascript">
jQuery(document).ready(function(){

		$('#montoegre').attr("onKeyPress", "return soloNum(event)");
		$('#obseregres').attr("onkeyup","this.value=this.value.toUpperCase()");
        $("#troculto1").hide();
	          
		$("#Limpiarx").click( function(){
			
			$("#idmovi,#idegre,#montoegre,#desegreso,#obseregres").attr("value","");
			jQuery("#refresh_listadomovicaja").click();
		
		});
		
		$("#Registrarx").click( function(){
			
			var idegre = $("#idegre").val();
			var montoegre = $("#montoegre").val();
			var obseregres = $("#obseregres").val();
			var desegreso = $("#desegreso").val();
		   
			if(idegre==''){
				alerta('Por favor indique el tipo de egreso');
			}else if(montoegre==''){
				alerta('Por favor indique el monto del egreso');
			}else if(obseregres==''){
				alerta('Por favor indique la razón del egreso');
			}else{

					$.ajax({
						  url: '../controlador/movicajaR.php',
						  data: {
								oper:'agregar',
								idegre:idegre,
								montoegre:montoegre,
								obseregres:obseregres,
								desegreso:desegreso
						   },
						  type: "POST",
						  success: function(data){
						
								if(data=='1'){
								    $("#idmovi,#idegre,#montoegre,#desegreso,#obseregres").attr("value","");
									jQuery("#refresh_listadomovicaja").click();
									alerta('Registro Ingresado con Exito');
								}else{
									alerta('No se logro registrar el egreso');
								}
						  }
					});								
			}
		});
		
		$("#Modificarx").click( function(){
			
			
			var idmovi = $("#idmovi").val();
			var idegre = $("#idegre").val();
			var montoegre = $("#montoegre").val();
			var obseregres = $("#obseregres").val();
			var desegreso = $("#desegreso").val();
			
			
		   
			if(idmovi==''){
				alerta('Por favor seleccione del listado superior el egreso que desea modificar, dandole doble click a la fila');
			}else if(idegre==''){
				alerta('Por favor indique el tipo de egreso');
			}else if(montoegre==''){
				alerta('Por favor indique el monto del egreso');
			}else if(obseregres==''){
				alerta('Por favor indique la razón del egreso');
			}else{

					$.ajax({
						  url: '../controlador/movicajaR.php',
						  data: {
								oper:'modifi',
								idmovi:idmovi,
								idegre:idegre,
								montoegre:montoegre,
								obseregres:obseregres,
								desegreso:desegreso
						   },
						  type: "POST",
						  success: function(data){
						
								if(data=='1'){
								    $("#idmovi,#idegre,#montoegre,#desegreso,#obseregres").attr("value","");
									jQuery("#refresh_listadomovicaja").click();
									alerta('Registro Modificado con Exito');
								}else{
									alerta('No se logro registrar el egreso');
								}
						  }
					});								
			}
		});
		

			jQuery("#listadomovicaja").jqGrid({
					url:'../controlador/movicajaR.php',
					datatype: "json",
					colNames:['idcaja','idegreso','Fecha','Egreso','Ingreso',/*'Forma de Pago',*/'Monto','Observaci&oacute;n'], 
					colModel:[
						{name:'idcaja',index:'movimcajarIdE',key:true,width:80,hidden:true},
						{name:'idegreso',index:'movimcajarEgresoIdE',hidden:true,width:100},
						{name:'fechaEgreso',index:'movimcajarFechaF',width:150 ,hidden:false,align:"center"},
						{name:'egreso',index:'movimcajarDescEgres',width:250,hidden:false,align:"left"},	
						{name:'ingreso',index:'movimcajarDescPago',width:400,hidden:false,align:"left"},	
						//{name:'formapago',index:'pagoshformaPago',width:250,hidden:false,align:"left"},
						{name:'montoegre',index:'movimcajarMontoD',width:150,hidden:false,align:"right"},
						{name:'obsermonto', index:'movimcajarObserC', width:350, hidden:false, align:"left"}

						],
				rowNum:5,
				//autowidth: true,
				width:"800",
				height:"auto",
				rowList:[5,10,20],
				pager: '#paginadorlistadomovicaja',
				caption:"",
				sortname: 'movimcajarFechaF',
				shrinkToFit: false,
				sortorder: "DESC",
				editurl:'../controlador/movicajaR.php',
				viewrecords: true,
				rownumbers: true,
				onSelectRow: function(id){ 
				
				//$('#listadomovicaja tr').click(function(){
				    var a = jQuery("#listadomovicaja").jqGrid('getRowData',id).idcaja;
					//var a = $(this).find("td").eq(1).html();
				    var idmovimiento = parseInt(a);
			
					$.ajax({
					  url: '../controlador/movicajaR.php',
					  data: {
								term: idmovimiento,
								oper: 'buscar_infor'
							},
					  type: "POST",
					  success: function(data){
					
						   
						   if(data==''){
								alerta('Solo se pueden modificar los egresos');
						   }else{
							
							var dat = data.split('||');
						    
							$("#idmovi").attr("value",dat[0]);
						    $("#idegre").attr("value",dat[1]);
						    $("#montoegre").attr("value",dat[2]);	
							$("#desegreso").attr("value",dat[3]);
							$("#obseregres").attr("value",dat[4]);
						   }
						   	
						
					  }
					//});
										
					});
				},
				loadError : function(xhr,st,err) { jQuery("#rsperrorlistadomovicaja").html("Tipo: "+st+"; Mensaje: "+ xhr.status + " "+xhr.statusText); }
			}); 

			jQuery("#listadomovicaja").jqGrid('navGrid','#paginadorlistadomovicaja',
					{edit:false,add:false,del:false,refresh:true,searchtext:"Buscar"}, //options
				{}, // options Editar 
				{}, // options Agregar				
				{}, // options Eliminar 
				{} // search options
			);
			
		$("#desegreso").autocomplete({
				source: function(request, response) {
					$.ajax({
					  url: '../controlador/movicajaR.php',
					  data: {
								term: request.term,
								oper: 'autocompletar'
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
					   $('input[id=idegre]').attr("value",ui.item.idegr);
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
		jQuery('.ui-autocomplete').css({'font-size':'12px'});
});	

</script><br/><link rel="stylesheet" href="../estilo/formoid/formoid-solid-green.css" type="text/css" />
<div id="ajustarx">
	
	<div style="border-bottom: 1px solid #dadada; padding-bottom: 10px;">
		<span  id="rsperrorlistadomovicaja" style="color:#BB0323"></span> <br/>
		<table id="listadomovicaja"></table>
		<div   id="paginadorlistadomovicaja"></div>
	</div>
	<br/>
<form class="formoid-solid-green"  style="font-family:Arial,Helvetica,sans-serif; font-size: 14px !important;background-image: url('../images/modulos/fondo1.png') !important;color: #68696A; font-weight: normal;" method="post"><div class="title" style="background-color: rgb(162, 202, 194) !important;height:20px !important;"></div>
	<div style="left:-5px;">
		<table border='0' width='800'>
		   <tr> 
    			<td style="width: 15%;text-align: center !important;padding-top: 13px !important;">Tipo de Egreso</td>
				<td style="width: 58%">
					<div class="element-input">
						<div class="item-cont">
							<input placeholder="Descripción de Egreso" style="width: 100%" id="desegreso" type="text"  name="desegreso" required="required"/>
								<span class="icon-place"></span>
						</div>
					</div>
					
				</td>
				
				<td style="width: 5%;text-align: center !important;padding-top: 13px !important;">Monto</td>
				<td>
					<div class="element-number">
						<div class="item-cont">
							<input placeholder="Monto" style="width: 83%" id="montoegre" type="text"  name="montoegre" />
								<span class="icon-place"></span>
						</div>
					</div>		
				</td>
				
		   </tr>
		   <tr><td colspan="4" style="width: 100%;height:25px;"></td></tr>
		   <tr>
    			<td style="width: 15%;text-align: center !important;padding-top: 10px !important;">Observación</td>
				<td colspan="3">
				    <div class="element-input">
						<div class="item-cont">
							<input placeholder="Observación" id="obseregres" type="text"  style="width: 96%;height:35px;" name="obseregres" />
								<span class="icon-place"></span>
						</div>
					</div>
				</td>
		   </tr>
		    <tr id="troculto1"> 
			    <td colspan="4">
					<input  size="7" type="text" id="idmovi"  />
					<input  size="7" type="text" id="idegre"  />
				</td>
			
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
<!-- Stop Formoid form-->

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