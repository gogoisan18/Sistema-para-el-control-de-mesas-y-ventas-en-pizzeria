<?php
session_start();
if (isset($_SESSION['usuId'])){
	$usuario = $_SESSION['usuId'];
?>

<script type="text/javascript">
	
jQuery(document).ready(function(){
   
        $("#trocultos").hide();
		$("#preciobebida").attr("onKeyPress", "return NumDeci(event)");
		//$("#descri").attr("onkeyup","this.value=this.value.toUpperCase()");
 
				
		$("#Limpiarx").click( function(){
			$("#preciobebida,#descri,#idbebida").attr("value","");
		});
		
		$("#Registrarx").click( function(){
			
			var preciobebidax = $("#preciobebida").val();
			var descrix = $("#descri").val();
			
		   
			if(descrix==''){
				alert('Por favor ingrese la descripción de la bebida');
			}else if(preciobebidax==''){
				alert('Por favor ingrese el precio de la bebida');
			}else{
			
					$.ajax({
						  url: '../controlador/bebidas.php',
						  data: {
								oper:'agregar',
								preciobebidax:preciobebidax,
								descrix:descrix
						   },
						  type: "POST",
						  success: function(data){
								
								if(data=='1'){
									$("#preciobebida,#descri,#idbebida").attr("value","");
									jQuery("#refresh_listadobebidas").click();
									alert('Bebida registrada con éxito');
								}else{
									alert(data);
								}
						  }
					});
				
												
			}
		});
		
		$("#Modificarx").click( function(){
			
			var preciobebidax = $("#preciobebida").val();
			var descrix = $("#descri").val();
			var idbebidax = $("#idbebida").val();
			
		   //alert(idbebidax);
			if(descrix==''){
				alert('Por favor ingrese la descripción de la bebida');
			}else if(preciobebidax==''){
				alert('Por favor ingrese el precio de la bebida');
			}else{
			
					$.ajax({
						  url: '../controlador/bebidas.php',
						  data: {
								oper:'modificar',
								preciobebidax:preciobebidax,
								descrix:descrix,
								idbebidax:idbebidax
						   },
						  type: "POST",
						  success: function(data){
								if(data=='1'){
								    $("#preciobebida,#descri,#idbebida").attr("value","");
									jQuery("#refresh_listadobebidas").click();
									alert('Bebida actualizada con éxito');
								}
						  }
					});								
			}
		});
		
		$("#Eliminarx").click( function(){
			
			var idbebidax = $("#idbebida").val();
			   
			if(idbebidax==''){
				alert('Por favor seleccione la bebida a eliminar');
			}else{
			     if (confirm('Esta seguro que desea eliminar esta bebida?')){
					$.ajax({
						  url: '../controlador/bebidas.php',
						  data: {
								oper:'eliminar',
								idbebidax:idbebidax
						   },
						  type: "POST",
						  success: function(data){
								if(data=='1'){
									 $("#preciobebida,#descri,#idbebida").attr("value","");
									jQuery("#refresh_listadobebidas").click();
									alert('Bebida eliminada con éxito');
								}
						  }
					});
				}								
			}
		});
		
		jQuery("#listadobebidas").jqGrid({
				url:'../controlador/bebidas.php',
				datatype: "json",
				colNames:['id','Descripción','Precio'],
				colModel:[
					{name:'id'
						,index:'bebidasIdE'
						,width:100
						,key: true
						,hidden:true
					},
					{name:'desc'
						,index:'bebidasDescripC'
						,width:525
						,align:"left"
						,hidden:false
					},
					{name:'preci'
						,index:'bebidasPrecioD'
						,width:150
						,align:"center"
						,hidden:false
					}
					],
				rowNum:10,
				width:"700",
				height:"auto",
				rowList:[10,20,30],
				pager: '#paginadorbebidas',
				caption:"Bebidas",
				sortname: 'bebidasDescripC',
				sortorder: "ASC",
				shrinkToFit: false,
				editurl:'../controlador/bebidas.php',
				viewrecords: true,
				rownumbers: true,
				onSelectRow: function(id){ 
				
					    var a = jQuery("#listadobebidas").jqGrid('getRowData',id).id;
						
						$.ajax({
						  url: '../controlador/bebidas.php',
						  data: {
									term: a,
									oper: 'buscar_infor'
								},
						  type: "POST",
						  success: function(data){
							  
							  var dat = data.split('||');
									  
								$("#preciobebida").attr("value",dat[2]);
								$("#descri").attr("value",dat[1]);
								$("#idbebida").attr("value",dat[0]);								
						  }
											
						});
				},
				loadError : function(xhr,st,err) { jQuery("#rsperrorbebidas").html("Tipo: "+st+"; Mensaje: "+ xhr.status + " "+xhr.statusText); }
			}); 
			

			jQuery("#listadobebidas").jqGrid('navGrid','#paginadorbebidas',
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
			<span  id="rsperrorbebidas" style="color:#595959"></span> <br/>
			<table id="listadobebidas"></table><br/>
			<div   id="paginadorbebidas"></div>
		</div>
		<br/>
		<!--<form class="formoid-solid-green" method="post"><div class="title"><h2><img src="../images/modulos/icon/usuarios.png" alt="icon_datos"/>&nbsp;Bebidas</h2></div><br/>-->
		<form class="formoid-solid-green" style="font-family:Arial,Helvetica,sans-serif; font-size: 14px !important;background-image: url('../images/modulos/fondo1.png') !important;color: #68696A; font-weight: normal;" method="post"><div class="title" style="height:20px !important"><h2 style="padding-top: 0px !important;"><img src="../images/modulos/icon/usuarios.png" alt="icon_datos"/>&nbsp;Bebidas</h2></div><br/>	
			<div>
				<table style="width: 100%;" border='0'>
					<tr>
						<td style="width: 15%; text-align: center !important; padding-top: 10px !important;" ><label><span class="required">Descripción</span></label></td>
						<td colspan="3">
							<div class="element-textarea">
								<div class="item-cont">
									<textarea id="descri" cols="4" rows="1" placeholder="Descripción de Bebida" style="width: 100%"></textarea>
									<span class="icon-place"></span>
								</div>
							</div>
						</td>
			        </tr>
					
					<tr>
						<td style="width: 15%; text-align: center !important; padding-top: 10px !important;" ><label ><span class="required">Precio</span></label></td>
						<td colspan="3">
							<div class="element-number">
								<div class="item-cont">
									<input placeholder="Precio Unitario" id="preciobebida" type="text" style="width:30%"  />
									<span class="icon-place"></span>
								</div>
						    </div>
						</td>
					</tr>
					<tr id="trocultos">
						<td colspan="4">
							<input  size="7" type="text" id="idbebida" />
						</td>
					</tr>
				</table>
			</div>
			
				<!--<table border='0'>
					<tr>
						<td id='boton1'><input id = "Limpiarx"   type="button" value="Limpiar"  /></td>
						<td id='boton2'><input id = "Registrarx" type="button" value="Registrar"/></td>
						<td id='boton3'><input id = "Modificarx" type="button" value="Modificar"/></td>
						<td id='boton4'><input id = "Eliminarx"  type="button" value="Eliminar"/></td>
					</tr>
				</table>-->
				
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