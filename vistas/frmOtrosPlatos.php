<?php
session_start();
if (isset($_SESSION['usuId'])){
	$usuario = $_SESSION['usuId'];
?>

<script type="text/javascript">
	
jQuery(document).ready(function(){
   
        $("#trocultos").hide();
		$("#precioplato").attr("onKeyPress", "return NumDeci(event)");
		//$("#descri").attr("onkeyup","this.value=this.value.toUpperCase()");
 
				
		$("#Limpiarx").click( function(){
			$("#precioplato,#descri,#idotrospla").attr("value","");
		});
		
		$("#Registrarx").click( function(){
			
			var precioplatox = $("#precioplato").val();
			var descrix = $("#descri").val();
			
		   
			if(descrix==''){
				alert('Por favor ingrese la descripción del plato');
			}else if(precioplatox==''){
				alert('Por favor ingrese el precio del plato');
			}else{
			
					$.ajax({
						  url: '../controlador/otrosplatos.php',
						  data: {
								oper:'agregar',
								precioplatox:precioplatox,
								descrix:descrix
						   },
						  type: "POST",
						  success: function(data){
								
								if(data=='1'){
									$("#precioplato,#descri,#idotrospla").attr("value","");
									jQuery("#refresh_listadoOtrosPlatos").click();
									alert('Plato registrado con éxito');
								}else{
									alert(data);
								}
						  }
					});
				
												
			}
		});
		
		$("#Modificarx").click( function(){
			
			var precioplatox = $("#precioplato").val();
			var descrix = $("#descri").val();
			var idotrosplax = $("#idotrospla").val();
			
		   //alert(idotrosplax);
			if(descrix==''){
				alert('Por favor ingrese la descripción del plato');
			}else if(precioplatox==''){
				alert('Por favor ingrese el precio del plato');
			}else{
			
					$.ajax({
						  url: '../controlador/otrosplatos.php',
						  data: {
								oper:'modificar',
								precioplatox:precioplatox,
								descrix:descrix,
								idotrosplax:idotrosplax
						   },
						  type: "POST",
						  success: function(data){
								if(data=='1'){
								    $("#precioplato,#descri,#idotrospla").attr("value","");
									jQuery("#refresh_listadoOtrosPlatos").click();
									alert('Plato actualizado con éxito');
								}
						  }
					});								
			}
		});
		
		$("#Eliminarx").click( function(){
			
			var idotrosplax = $("#idotrospla").val();
			   
			if(idotrosplax==''){
				alert('Por favor seleccione el plato a eliminar');
			}else{
			     if (confirm('Esta seguro que desea eliminar este plato?')){
					$.ajax({
						  url: '../controlador/otrosplatos.php',
						  data: {
								oper:'eliminar',
								idotrosplax:idotrosplax
						   },
						  type: "POST",
						  success: function(data){
								if(data=='1'){
									 $("#precioplato,#descri,#idotrospla").attr("value","");
									jQuery("#refresh_listadoOtrosPlatos").click();
									alert('Plato eliminado con éxito');
								}
						  }
					});
				}								
			}
		});
		
		jQuery("#listadoOtrosPlatos").jqGrid({
				url:'../controlador/otrosplatos.php',
				datatype: "json",
				colNames:['id','Descripción','Precio'],
				colModel:[
					{name:'id'
						,index:'otrosIdE'
						,width:100
						,key: true
						,hidden:true
					},
					{name:'desc'
						,index:'otrosDescripC'
						,width:525
						,align:"left"
						,hidden:false
					},
					{name:'preci'
						,index:'otrosPrecioD'
						,width:150
						,align:"center"
						,hidden:false
					}
					],
				rowNum:10,
				width:"700",
				height:"auto",
				rowList:[10,20,30],
				pager: '#paginadorOtrosPlatos',
				caption:"Otros Platos",
				sortname: 'otrosDescripC',
				sortorder: "ASC",
				shrinkToFit: false,
				editurl:'../controlador/otrosplatos.php',
				viewrecords: true,
				rownumbers: true,
				onSelectRow: function(id){ 
				
					    var a = jQuery("#listadoOtrosPlatos").jqGrid('getRowData',id).id;
						
						$.ajax({
						  url: '../controlador/otrosplatos.php',
						  data: {
									term: a,
									oper: 'buscar_infor'
								},
						  type: "POST",
						  success: function(data){
							  
							  var dat = data.split('||');
									  
								$("#precioplato").attr("value",dat[2]);
								$("#descri").attr("value",dat[1]);
								$("#idotrospla").attr("value",dat[0]);								
						  }
											
						});
				},
				loadError : function(xhr,st,err) { jQuery("#rsperrorOtrosPlatos").html("Tipo: "+st+"; Mensaje: "+ xhr.status + " "+xhr.statusText); }
			}); 
			

			jQuery("#listadoOtrosPlatos").jqGrid('navGrid','#paginadorOtrosPlatos',
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
		
		<div style="border-bottom: 1px solid #dadada;">
			<span  id="rsperrorOtrosPlatos" style="color:#595959"></span> <br/>
			<table id="listadoOtrosPlatos"></table><br/>
			<div   id="paginadorOtrosPlatos"></div>
		</div>
		<br/>

		<form class="formoid-solid-green" style="font-family:Arial,Helvetica,sans-serif; font-size: 14px !important;background-image: url('../images/modulos/fondo1.png') !important;color: #68696A; font-weight: normal;" method="post"><div class="title" style="height:20px !important"><h2 style="padding-top: 0px !important;"><img src="../images/modulos/icon/usuarios.png" alt="icon_datos"/>&nbsp;Otros Platos</h2></div><br/>		
			<div>
				<table style="width: 100%;" border='0'>
					<tr>
						<td style="width: 15%; text-align: center !important; padding-top: 10px !important;" ><label><span class="required">Descripción</span></label></td>
						<td colspan="3">
							<div class="element-textarea">
								<div class="item-cont">
									<textarea id="descri" cols="4" rows="1" placeholder="Descripción del Plato" style="width: 100%"></textarea>
									<span class="icon-place"></span>
								</div>
							</div>
						</td>
			        </tr>
					
					<tr>
						<td style="width: 15%; text-align: center !important; padding-top: 10px !important;" ><label><span class="required">Precio</span></label></td>
						<td colspan="3">
							<div class="element-number">
								<div class="item-cont">
									<input placeholder="Precio Unitario" id="precioplato" type="text" style="width:30%"  />
									<span class="icon-place"></span>
								</div>
						    </div>
						</td>
					</tr>
					<tr id="trocultos">
						<td colspan="4">
							<input  size="7" type="text" id="idotrospla" />
						</td>
					</tr>
				</table>
			</div>
			    <table style="margin-left: 100px;">
					<tr>
						<td>
							<a  id="Limpiarx"    href="#" class="btnNew" >Limpiar</a>
							<a  id="Registrarx"  href="#" class="btnNew" >Registrar</a>
							<a  id="Modificarx"  href="#" class="btnNew" >Modificar</a>
							<a  id="Eliminarx"    href="#" class="btnNew" >Eliminar</a>
						
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
					function redescriionar(){
					  alerta ('No tiene perrmisos para acceder a esta página');
					  window.location="../index.php";
					}  
					setTimeout ("redescriionar()", 1000); //tiempo de espera en milisegundos
		 </script> 
<?php } ?>	