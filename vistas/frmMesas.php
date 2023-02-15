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
function valuecheckS(check){        
			
			if(check.value=='Libre'){
				  $("#estamesa").attr("value","Libre");
			}else if(check.value=='Ocupada'){
				  $("#estamesa").attr("value","Ocupada");
			}else if(check.value=='Inactiva'){
				  $("#estamesa").attr("value","Inactiva");
			}//'Ocupada','Libre','Inactiva'
}
		
jQuery(document).ready(function(){

    $("#nomesa").attr("onkeyup","this.value=this.value.toUpperCase()");
	$("#14ocum").hide();
		
		
			jQuery("#listadomesa").jqGrid({
				url:'../controlador/mesas.php',
				datatype: "json",
				colNames:['id','Número','Nombre','Estatus'],
				colModel:[
					{name:'idmes'
						,index:'mesasIdE'
						,width:20
						,key:true
						,hidden:true
					},
					{name:'num'
						,index:'mesasNum'
						,width:150
						,align:"center"
						,hidden:false
					},
					{name:'descrip'
						,index:'mesasDescripC'
						,width:350
						,hidden:false
					},
					{name:'estatus'
						,index:'mesasEstatusE'
						,width:172
						,align:"center"
						,hidden:false
					}
					
					],
				rowNum:10,
				width:"700",
				height:"auto",
				rowList:[10,20,30],
				pager: '#paginadormesa',
				caption:"",
				sortname: 'mesasIdE',
				shrinkToFit: false,
				sortorder: "ASC",
				editurl:'../controlador/mesas.php',
				viewrecords: true,
				rownumbers: true,
				onSelectRow: function(id){ 
				
			
					var ax = jQuery("#listadomesa").jqGrid('getRowData',id).idmes;
			
				    var a = parseInt(ax);
	
					$.ajax({
						  url: '../controlador/mesas.php',
						  data: {
									term: a,
									oper: 'buscar_infor'
								},
						  type: "POST",
						  success: function(data){
						  
						 
							   var dat = data.split('||');
															 
								$("#idxmesa").attr("value",dat[0]);
								$("#numesa").attr("value",dat[1]);
								$("#nomesa").attr("value",dat[2]);
								$("#estamesa").attr("value",dat[3]);
											  
							//$salida = $row['mesasIdE'].'||'.$row['mesasNum'].'||'.$row['mesasDescripC'].'||'.$row['mesasEstatusE'];	
								if(dat[3]=='Libre'){
									$("#radix").attr('checked',true);
								}else if(dat[3]=='Ocupada'){
									$("#radi2x").attr('checked',true);
								}else if(dat[3]=='Inactiva'){
									$("#radi3x").attr('checked',true);
								}//'Ocupada','Libre','Inactiva'
						  }						
					});
				},
				loadError : function(xhr,st,err) { jQuery("#rsperrormesa").html("Tipo: "+st+"; Mensaje: "+ xhr.status + " "+xhr.statusText); }
			}); 

			jQuery("#listadomesa").jqGrid('navGrid','#paginadormesa',
						{edit:false,add:false,del:false,refresh:true,searchtext:"Buscar"}, //options
				{}, // options Editar
				{}, // options Agregar
				{}, // options Eliminar 
				{} // search options
			);
			
			$("#Limpiarx").click( function(){
				$("#idxmesa,#numesa,#nomesa,#estamesa").attr("value","");
				$("#radix,#radi2x,#radi3x").attr('checked',false);
		    });
			
			$("#Registrarx").click( function(){
			
			    var xnumesa = $("#numesa").val();
				var xnomesa = $("#nomesa").val();
				var xestamesa = $("#estamesa").val();

			   
				if(xnumesa==''){
					    alert('Por favor ingrese el número de la mesa');
				}else if(xnomesa==''){
						alert('Por favor ingrese el nombre de la mesa');
				}else if(xestamesa==''){
						alert('Por favor ingrese el estatus de la mesa');
				}else{
				
						$.ajax({
							  url: '../controlador/mesas.php',
							  data: {
									oper:'agregar',
									xnumesa:xnumesa,
									xnomesa:xnomesa,
									xestamesa:xestamesa
							   },
					
							  type: "POST",
							  success: function(data){
									
									if(data=='1'){
										$("#idxmesa,#numesa,#nomesa,#estamesa").attr("value","");
										$("#radix,#radi2x,#radi3x").attr('checked',false);
										jQuery("#refresh_listadomesa").click();
										alert('Mesa registrada con éxito');
										
									}else{
										alert(data);
									}
								
							  }
						});
					
													
				}
		});
		
		$("#Modificarx").click( function(){
			
				var xidxmesa = $("#idxmesa").val();
				var xnumesa = $("#numesa").val();
				var xnomesa = $("#nomesa").val();
				var xestamesa = $("#estamesa").val();
				
		
				if(xidxmesa==''){
					alert('Por favor haga clic en cualquier fila del listado superior');
				}else if(xnumesa==''){
					alert('Por favor ingrese el número de mesa');
				}else if(xnomesa==''){
					alert('Por favor ingrese el nombre de la mesa');
				}else{
				
						$.ajax({
							  url: '../controlador/mesas.php',
							  data: {
									oper:'modificar',
									xidxmesa:xidxmesa,
									xnumesa:xnumesa,
									xnomesa:xnomesa,
									xestamesa:xestamesa
							   },
					
							  type: "POST",
							  success: function(data){
									if(data=='1'){
										
										$("#idxmesa,#numesa,#nomesa,#estamesa").attr("value","");
										$("#radix,#radi2x,#radi3x").attr('checked',false);
										jQuery("#refresh_listadomesa").click();
										alerta('Mesa actualizada con éxito');
										
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
			<table id="listadomesa"></table><br/>
			<div   id="paginadormesa"></div>
	</div>
	<br/>
		
		<form class="formoid-solid-green" style="font-family:Arial,Helvetica,sans-serif; font-size: 14px !important;background-image: url('../images/modulos/fondo1.png') !important;color: #68696A; font-weight: normal;" method="post"><div class="title" style="height:20px !important"><h2 style="padding-top: 0px !important;"><img src="../images/modulos/icon/usuarios.png" alt="icon_datos"/>&nbsp;Mesas</h2></div><br/>
			<div>
				<table border='0' style="width: 100%">
					
					<tr>
					    <td style="width: 15%; text-align: center !important;"><label class="title"><span class="required">Número</span></label></td>
						<td style="width: 25%">
							<div class="element-number">
								<div class="item-cont">
									<input  id="numesa" type="text" style="width: 100%" maxlength="3" placeholder="Número"/>
								<span class="icon-place"></span>
								</div>
							</div>
						</td>
						 <td style="width: 15%; text-align: center !important;"><label class="title"><span class="required">Descripción</span></label></td>
						 <td>
							<div class="element-textarea">
								<div class="item-cont">
									<input placeholder=" Nombre" id="nomesa" type="text"  style="width:100%" />
									<span class="icon-place"></span>
								</div>
						   </div>
						</td>
					</tr>
					<tr>
						<td style="width: 15%; text-align: center !important;"><label class="title"><span class="required">Estatus</span></label></td>
						<td style="padding-top: 10px;" colspan = "3">
							<div class="column column1">
									<label>
										<input id='radix'  type="radio" name="radio" value="Libre"    onclick="valuecheckS(this)"/><span>Libre</span>
									</label>
									<label>
										<input id='radi2x' type="radio" name="radio" value="Ocupada"  onclick="valuecheckS(this)"/><span>Ocupada</span>
									</label>
									<label>
										<input id='radi3x' type="radio" name="radio" value="Inactiva" onclick="valuecheckS(this)"/><span>Inactiva</span>
									</label>
									<span class="clearfix"></span>
							</div>
					    </td>
					</tr>
					<tr>
					<td id="14ocum" colspan = "4">
						<input id='idxmesa' type="text" />
						<input id='estamesa' type="text" />
					</tr>
					
					
				</table>
			</div>
			
				<!--<table border='0'>
					<tr>
						<td id='boton1'><input id = "Limpiarx"   type="button" value="Limpiar"  /></td>
						<td id='boton2'><input id = "Registrarx" type="button" value="Registrar"/></td>
						<td id='boton3'><input id = "Modificarx" type="button" value="Modificar"/></td>
				
					</tr>
				</table>-->
				
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