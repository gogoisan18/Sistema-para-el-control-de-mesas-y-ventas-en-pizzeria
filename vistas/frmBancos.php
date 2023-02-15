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

		
jQuery(document).ready(function(){

    $("#banco").attr("onkeyup","this.value=this.value.toUpperCase()");
	$("#14ocum").hide();
		
		
			jQuery("#listabancos").jqGrid({
				url:'../controlador/bancos.php',
				datatype: "json",
				colNames:['id','Nombre'],
				colModel:[
					{name:'idb'
						,index:'bancoIdE'
						,width:20
						,key:true
						,hidden:true
					},
					{name:'banco'
						,index:'bancoDescripC'
						,width:655
						,align:"left"
						,hidden:false
					}
					
					],
				rowNum:10,
				width:"700",
				height:"auto",
				rowList:[10,20,30],
				pager: '#paginadorbancos',
				caption:"",
				sortname: 'bancoDescripC',
				shrinkToFit: false,
				sortorder: "ASC",
				editurl:'../controlador/bancos.php',
				viewrecords: true,
				rownumbers: true,
				onSelectRow: function(id){ 
				
			
					var ax = jQuery("#listabancos").jqGrid('getRowData',id).idb;
			
				    var a = parseInt(ax);
	
					$.ajax({
						  url: '../controlador/bancos.php',
						  data: {
									term: a,
									oper: 'buscar_infor'
								},
						  type: "POST",
						  success: function(data){
						 
							   var dat = data.split('||');
															 
								$("#idban").attr("value",dat[0]);
								$("#banco").attr("value",dat[1]);
											  
							
						  }						
					});
				},
				loadError : function(xhr,st,err) { jQuery("#rsperrormesa").html("Tipo: "+st+"; Mensaje: "+ xhr.status + " "+xhr.statusText); }
			}); 

			jQuery("#listabancos").jqGrid('navGrid','#paginadorbancos',
						{edit:false,add:false,del:false,refresh:true,searchtext:"Buscar"}, //options
				{}, // options Editar
				{}, // options Agregar
				{}, // options Eliminar 
				{} // search options
			);
			
			$("#Limpiarx").click( function(){
				$("#idban,#banco").attr("value","");
		    });
			
			$("#Registrarx").click( function(){
			
			    var xidban = $("#idban").val();
				var xbanco = $("#banco").val();

			   
				if(xbanco==''){
						alert('Por favor ingrese el nombre del Banco');
				}else{
				
						$.ajax({
							  url: '../controlador/bancos.php',
							  data: {
									oper:'agregar',
									xbanco:xbanco
							   },
					
							  type: "POST",
							  success: function(data){
									
									if(data=='1'){
										$("#idban,#banco").attr("value","");
										jQuery("#refresh_listabancos").click();
										alerta('Banco registrado con éxito');
										
									}else{
										alert(data);
									}
								
							  }
						});
					
													
				}
		});
		
		$("#Modificarx").click( function(){
			
				var xidban = $("#idban").val();
				var xbanco = $("#banco").val();
		
				if(xidban==''){
					alert('Por favor haga clic en cualquier fila del listado superior');
				}else if(xbanco==''){
					alert('Por favor ingrese el nombre del Banco');
				}else{
				
						$.ajax({
							  url: '../controlador/bancos.php',
							  data: {
									oper:'modificar',
									xidban:xidban,
									xbanco:xbanco
							   },
					
							  type: "POST",
							  success: function(data){
									if(data=='1'){
										
										$("#idban,#banco").attr("value","");
										jQuery("#refresh_listabancos").click();
										alerta('Banco actualizado con éxito');
										
									}else{
										alerta('Problemas al actualizar');
										
									}
								
							  }
						});
					
													
				}
		});
});
</script>
<br /><br />
	<link rel="stylesheet" href="../estilo/formoid/formoid-solid-green.css" type="text/css" />
	<div id="ajustarx2">
		<div style="border-bottom: 1px solid #dadada;">
			<span  id="rsperrormesa" style="color:#595959"></span> <br/>
			<table id="listabancos"></table><br/>
			<div   id="paginadorbancos"></div>
	</div>
	<br/>
		
		<form class="formoid-solid-green" style="font-family:Arial,Helvetica,sans-serif; font-size: 14px !important;background-image: url('../images/modulos/fondo1.png') !important;color: #68696A; font-weight: normal;" method="post"><div class="title" style="height:25px !important"><h2 style="padding-top: 0px !important;"><img src="../images/modulos/icon/caja.png" alt="icon_datos"/>&nbsp;Bancos</h2></div><br/>
			<div>
				<table border='0' style="width: 100%">
					
					<tr>
					    <td style="text-align: center !important;"><label class="title"><span class="required">Nombre</span></label></td>
						 <td>
							<div class="element-textarea">
								<div class="item-cont">
									<input placeholder=" Nombre del Banco" id="banco" type="text"  style="width:100%" />
									<span class="icon-place"></span>
								</div>
						   </div>
						</td>
					</tr>
					
					<tr><td id="14ocum" colspan = "4"><input id='idban' type="text" /></td></tr>
					
					
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
					  alerta ('No tiene perrmisos para acceder a esta página');
					  window.location="../index.php";
					}  
					setTimeout ("redireccionar()", 1000); //tiempo de espera en milisegundos
		 </script> 
<?php } ?>