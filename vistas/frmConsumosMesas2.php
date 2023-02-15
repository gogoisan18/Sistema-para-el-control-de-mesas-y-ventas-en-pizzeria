<?php
session_start();
if (isset($_SESSION['usuId'])){
	
	$usuario = $_SESSION['usuId'];
	$numM = $_SESSION['numM'];

	
	$tipo = $_SESSION['tipousu'];
	
	$rsperrorxx = "rsperrorConsuResta".$numM;
	$listadoxx = "listadoConsuResta".$numM;
	$paginadorxx = "paginadorConsuResta".$numM;
	
		
	$cargaDetalleMenu = "cargaDetalleMenu_".$numM;
	
	$xPizzas = "xPizzas_".$numM;
	$xCarnes = "xCarnes_".$numM;
	$xOtros = "xOtros_".$numM;
	$xBebidas = "xBebidas_".$numM;
	$xLicores = "xLicores_".$numM;
	$xadi = "xadi_".$numM;	
	$xHelados = "xHelados_".$numM;
	$xMerengadas = "xMerengadas_".$numM;
	$xGolosinas = "xGolosinas_".$numM;

	
?>

<style>
.vista {
    width: 90px;
    height: 70px;
    margin: 0px;
    float: left;
    border: 10px solid #fff;
    overflow: hidden;
    position: relative;
    text-align: center;
    box-shadow: 1px 1px 2px #e6e6e6;
    cursor: default;
	
}
.vista .mascara, .vista .contenido {
    width: 90px;
    height: 70px;
    position: absolute;
    overflow: hidden;
    top: 0;
    left: 0;
}
.vista img {
    display: block;
    position: relative;
}
.vista h2 {
    text-transform: uppercase;
    color: #595959;
    text-align: center;
    position: relative;
    font-size: 11px;
    padding: 0px;
    background-color: rgb(191, 220, 232);
    margin: 0 0 0 0;
}
.vista p {
    font-family: Arial, Helvetica, sans-serif;
    font-size: 10px;
    position: relative;
    color: #fff;
    padding: 10px 20px 20px;
    text-align: center;
}
.vista a.informacion {
    display: inline-block;
    text-decoration: none;
    padding: 7px 14px;
    background: #000;
    color: #fff;
    text-transform: uppercase;
    box-shadow: 0 0 1px #000;
}
.vista a.informacion:hover {
    box-shadow: 0 0 5px #000
}

.vista img {
    -webkit-transition: all 0.2s linear;
    -moz-transition: all 0.2s linear;
    -o-transition: all 0.2s linear;
    -ms-transition: all 0.2s linear;
    transition: all 0.2s linear;
}
.vista .mascara {
    opacity: 0;
    background-color: hsla(34,93%,45%,0.7);
    -webkit-transition: all 0.4s ease-in-out;
    -moz-transition: all 0.4s ease-in-out;
    -o-transition: all 0.4s ease-in-out;
    -ms-transition: all 0.4s ease-in-out;
    transition: all 0.4s ease-in-out;
}
.vista h2 {
    opacity: 0;
    -webkit-transform: translateY(-100px);
    -moz-transform: translateY(-100px);
    -o-transform: translateY(-100px);
    -ms-transform: translateY(-100px);
    transform: translateY(-100px);
    -webkit-transition: all 0.2s ease-in-out;
    -moz-transition: all 0.2s ease-in-out;
    -o-transition: all 0.2s ease-in-out;
    -ms-transition: all 0.2s ease-in-out;
    transition: all 0.2s ease-in-out;
}
.vista p { 
    opacity: 0;
    -webkit-transform: translateY(100px);
    -moz-transform: translateY(100px);
    -o-transform: translateY(100px);
    -ms-transform: translateY(100px);
    transform: translateY(100px);
    -webkit-transition: all 0.2s linear;
    -moz-transition: all 0.2s linear;
    -o-transition: all 0.2s linear;
    -ms-transition: all 0.2s linear;
    transition: all 0.2s linear;
}
.vista a.informacion{
    opacity: 0;
    -webkit-transition: all 0.2s ease-in-out;
    -moz-transition: all 0.2s ease-in-out;
    -o-transition: all 0.2s ease-in-out;
    -ms-transition: all 0.2s ease-in-out;
    transition: all 0.2s ease-in-out;
}
.vista:hover img { 
    -webkit-transform: scale(1.1);
    -moz-transform: scale(1.1);
    -o-transform: scale(1.1);
    -ms-transform: scale(1.1);
    transform: scale(1.1);
} 
.vista:hover .mascara { 
    opacity: 1;
}
.vista:hover h2,
.vista:hover p,
.vista:hover a.informacion {
    opacity: 1;
    -webkit-transform: translateY(0px);
    -moz-transform: translateY(0px);
    -o-transform: translateY(0px);
    -ms-transform: translateY(0px);
    transform: translateY(0px);
}
.vista:hover p {
    -webkit-transition-delay: 0.1s;
    -moz-transition-delay: 0.1s;
    -o-transition-delay: 0.1s;
    -ms-transition-delay: 0.1s;
    transition-delay: 0.1s;
}
.vista:hover a.informacion {
    -webkit-transition-delay: 0.2s;
    -moz-transition-delay: 0.2s;
    -o-transition-delay: 0.2s;
    -ms-transition-delay: 0.2s;
    transition-delay: 0.2s;
}
.contenex {
    width: 950px;
    height: 250px;
    margin: 0 auto;
	
}
</style>
<script type="text/javascript">

$(document).ready(function() {

	var retx = $("#xmesax").val();
	
	var rsperrorx = "#rsperrorConsuResta"+retx;
	var listadox = "#listadoConsuResta"+retx;
	var paginadorx = "#paginadorConsuResta"+retx;
	var refreshx = "#refresh_listadoConsuResta"+retx;
	
	//alert(listadox+'--'+paginadorx+'--'+rsperrorx+'--'+refreshx);
	
	jQuery(refreshx).click();
	
    jQuery(listadox).jqGrid({
	//jQuery("#listadoConsuResta").jqGrid({
				url:'../controlador/buscarInfPlatos.php',
				datatype: "json",
				colNames:['id','Descripción','Precio','Cantidad'],
				colModel:[
					{name:'id'
						,index:'controlId'
						,width:20
						,key: true
						,hidden:true
					},
					{name:'desc'
						,index:'controlDescripPlato'
						,width:320
						,align:"left"
						,hidden:false
					},
					{name:'preci'
						,index:'controlPrecioPlato'
						,width:80
						,align:"center"
						,hidden:true
					},
					{name:'cant'
						,index:'controlCantPlato'
						,width:60
						,align:"center"
						,hidden:false
					}
					],
				rowNum:40,
				width:"415",
				height:"auto",
				rowList:[40,60,80],
				pager: paginadorx,
				//caption:"Consumos",
				sortname: 'controlDescripPlato',
				sortorder: "ASC",
				shrinkToFit: false,
				editurl:'../controlador/buscarInfPlatos.php',
				viewrecords: true,
				rownumbers: true,
				onSelectRow: function(id){ 
				
					var a = jQuery(listadox).jqGrid('getRowData',id).id;
					var b = jQuery(listadox).jqGrid('getRowData',id).preci;
					var c = jQuery(listadox).jqGrid('getRowData',id).cant;
						
			
					var retx = $("#xmesax").val();
					var tipousu = $("#tipousu").val();
					
					$("#DialogoModificar").load("../vistas/frmModificarCR.php?id="+a+"&cant="+c+"&prec="+b+"&mesax="+retx);
				    
			if(tipousu=='Administrador'){
				    $("#DialogoModificar").dialog({
						  modal: true,
						  width: 700,
						  show: "fold",
						  hide: "scale",
						  buttons: {
							"Modificar": function () {
									
									var idpla = a;
									var can = $("#cantxx").val();		
									var registroResx = $("#registroRes").val();
									var precioplatox = b;
										
		                            //alert(can);
                                									  
							        if(can!='' && can!=0){
									
										$.ajax({
											  url: '../controlador/buscarInfPlatos.php',
											  data: {
													oper:'modificar_consumo',
													idplatox:idpla,
													cantplax:can,
													registroResx:registroResx,
													precioplatox:precioplatox
											   },
											  type: "POST",
											  success: function(retor){
											  
													if(retor==1){
													    
														$(refreshx).click();
														
														$("div#DialogoModificar").dialog("close");
													
													}else{
														alerta('Problemas para actualizar');
													}
											       
											  }
										});
										return false;
									}else{
										alerta('Por favor corrija la cantidad del consumo');
									}
																	
							},"Eliminar": function () {
							
							        var retx = "<?php echo $numM; ?>";
								    var idplatox = a;
									var registroResx = $("#registroRes").val();
                                      
                                    if (confirm('¿Esta seguro que desea eliminar este consumo?')){
								
										$.ajax({
											  url: '../controlador/buscarInfPlatos.php',
											  data: {
													oper:'eliminar_consumo',
													idplatox:idplatox,
													registroResx:registroResx
													
											   },
											  type: "POST",
											  success: function(retor){
											  
													if(retor==1){
														$(refreshx).click();
														$("div#DialogoModificar").dialog("close");
													}else{
														alerta('Problemas para eliminar');
													}
											       
											  }
										});
									}
								},
							
							"Salir": function () {
							    $("#idpl,#precioplato,#cantxx").val('');
								$(this).dialog("close");
							}
						  }
				      });
					}else{

						$("#DialogoModificar").dialog({
						  modal: true,
						  width: 700,
						  show: "fold",
						  hide: "scale",
						  buttons: {
							"Modificar": function () {
									
									var idpla = a;
									var can = $("#cantxx").val();		
									var registroResx = $("#registroRes").val();
									var precioplatox = b;
										
		                            //alert(can);
                                									  
							        if(can!='' && can!=0){
									
										$.ajax({
											  url: '../controlador/buscarInfPlatos.php',
											  data: {
													oper:'modificar_consumo',
													idplatox:idpla,
													cantplax:can,
													registroResx:registroResx,
													precioplatox:precioplatox
											   },
											  type: "POST",
											  success: function(retor){
											  
													if(retor==1){
													    
														$(refreshx).click();
														
														$("div#DialogoModificar").dialog("close");
													
													}else{
														alerta('Problemas para actualizar');
													}
											       
											  }
										});
										return false;
									}else{
										alerta('Por favor corrija la cantidad del consumo');
									}
																	
							},						
							"Salir": function () {
							    $("#idpl,#precioplato,#cantxx").val('');
								$(this).dialog("close");
							}
						  }
				      });

					}
				},
				loadError : function(xhr,st,err) { jQuery(paginadorx).html("Tipo: "+st+"; Mensaje: "+ xhr.status + " "+xhr.statusText); }
			
			
			}); 
			

			jQuery(listadox).jqGrid('navGrid',paginadorx,
				{edit:false,add:false,del:false,refresh:true,searchtext:"Buscar"}, //options
				
				{}, // options Editar
				{}, // options Agregar
				{}, // options Eliminar 
				{} // search options
			);
	
    $(".mascara").click(function () {
		
		var tipoAlimento = $(this).attr('id');
		
		$.ajax({
				url: '../controlador/buscarInfPlatos.php',
				data: {
						oper: 'detalleMenu',
						entrada: tipoAlimento
			    },
			    type: "POST",
				dataType: "json",
			    success: function(retor){
			
			            var cant = retor.length;
						$("#cargaDetalleMenu tbody").empty();

						if(tipoAlimento=='Pizzas'){

							for (i=0;i<cant;i++) {
					  
							 var preciomini = retor[i].mini;
							 var preciopeq = retor[i].peq;
							 var preciomedi = retor[i].medi;
							 var preciofami = retor[i].fami;
							 var nombreplato = retor[i].descrip;
							 
							 
							   $("#cargaDetalleMenu tbody").append("<tr>"+
									"<td>"+"<input style='width:215px;' class='filas1' name='"+nombreplato+"'  type=\"text\"  id='"+nombreplato+"' value=\""+nombreplato+"\" title=\""+nombreplato+"\"  />"+
									"</td>"+

									"<td>"+"<input style='width:50px;' class='filas' name='"+preciomini+"'  type=\"text\"  id=\""+preciomini+"\" value='Min' title=\""+nombreplato+' Min'+"\"  />"+
									"</td>"+

									"<td>"+"<input style='width:50px;' class='filas' name='"+preciopeq+"'  type=\"text\"  id=\""+preciopeq+"\" value='Peq' title=\""+nombreplato+' Peq'+"\"  />"+
									"</td>"+

									"<td>"+"<input style='width:50px;' class='filas' name='"+preciomedi+"'  type=\"text\"  id=\""+preciomedi+"\" value='Med' title=\""+nombreplato+' Med'+"\"  />"+
									"</td>"+

									"<td>"+"<input style='width:50px;' class='filas' name='"+preciofami+"'  type=\"text\"  id=\""+preciofami+"\" value='Fam' title=\""+nombreplato+' Fam'+"\"  />"+
									"</td>"+

									"</tr>");
					  		 }


						}else{
							for (i=0;i<cant;i++) {
					  
							 var precioplato = retor[i].precio;
							 var nombreplato = retor[i].descrip;
							 
							   $("#cargaDetalleMenu tbody").append("<tr>"+
									"<td>"+
										"<input style='width:410px;' class='filas' name='"+precioplato+"'  type=\"text\"  id=\""+retor[i].id+"\" value=\""+retor[i].descrip+"\" title=\""+retor[i].descrip+"\"  />"+
									"</td></tr>");
					  		 }
						}
						
					   
					   $(".filas").on("click",function(){
												   	
								
								

								if(tipoAlimento=='Pizzas'){

									//console.log('id-->'+this.name);

									var str = this.name;
                                    var res = str.split("-");

                                    var xidplato   = res[0];
								    var xprecplato = res[1];
								    //console.log('id-->'+xidplato+' precio-->'+xprecplato);

								}else{
									var xidplato   = parseInt(this.id);
								    var xprecplato = this.name;

								}
								var xnombplato = this.title;
								var estatmezx = $("#estatusmesa").val();
								var registroResx = $("#registroRes").val();
								
								
								//alert(estatmezx+'--'+registroResx);
								
								if(estatmezx=='Ocupada'){
									
									$.ajax({
										url: '../controlador/buscarInfPlatos.php',
										data: {
												oper: 'guardarplato',
												xidplato: xidplato,
												xprecplato:xprecplato,
												xnombplato:xnombplato,
												registroResx:registroResx
										},
										type: "POST",

										success: function(retor){
										   
										     if(retor=='1'){
											    jQuery(refreshx).click();
											
											 }else{
												alerta(retor);
											 }
											 
										}
								   });
									
								}else{
									alerta('Esta mesa no posee cuenta abierta, por favor aperture la mesa para poder continuar');
								}
													
					    });
				}
		});
		return false;
	
	});

   
});
</script>

<div style="overflow:scroll; left: 22px !important; top: 25px !important; width:440px !important; height:450px !important; position: relative; font-size: 14px; font-family: Arial, Helvetica, sans-serif;color: #595959;background: #ebebeb !important;" >
	<div style="font-size: 22px; height:25px !important; font-family: Arial, Helvetica, sans-serif;color: #595959; background-color: rgb(191, 220, 232) !important;">Consumos</div>
    
	<div id="cargarlistado" style="border-bottom: 1px solid #dadada;">
			<span  id="<?php echo $rsperrorxx;  ?>" style="color:#595959"></span>
			<table id="<?php echo $listadoxx;   ?>" ></table>
			<div   id="<?php echo $paginadorxx; ?>" ></div>
			
			<!--<span  id="rsperrorConsuResta" style="color:#595959"></span>
			<table id="listadoConsuResta" ></table>
			<div   id="paginadorConsuResta" ></div>-->
				
	</div>
	
</div>
	

<div style="overflow:scroll; top: -422px !important; left: 475px !important;  width:440px !important; height:450px !important; position: relative; font-size: 14px; font-family: Arial, Helvetica, sans-serif;color: #595959;background: #ebebeb !important;" >
	<div style="font-size: 22px; width:440px !important; height:25px !important; font-family: Arial, Helvetica, sans-serif;color: #595959; background-color: rgb(191, 220, 232) !important;"></div>
	<br />

	<table border="1" id="cargaDetalleMenu" >
		 <tbody style="width:100% !important; font-size: 16px !important; font-family: Arial, Helvetica, sans-serif; color: #FFF !important;"></tbody>
	</table>

</div ><input id="tipousu" type="text" value="<?php echo $tipo; ?>" style="width:5.3%;display:none;"></input></div>

</div>
<br />
<div style="overflow:scroll; top: -430px !important; left: 22px; width:895px !important; height:250px !important; position: relative; font-size: 14px; font-family: Arial, Helvetica, sans-serif;background: #ffffff !important;" >
	<div style="font-size: 22px; height:50px !important; font-family: Arial, Helvetica, sans-serif;color: #595959; background-color: rgb(191, 220, 232) !important;">Platos y Bebidas</div>
		<div class="contenex">
            <div class="vista">  
			<img src="../images/menuRes/1.jpg">  
			<div id="Pizzas"  class="mascara">  
				<h2>Pizzas</h2>  
			</div>  
		</div>
		<div class="vista">  
			<img src="../images/menuRes/2.jpg">  
			<div id="Carnes"  class="mascara">  
				<h2>Carnes</h2>  
			</div>  
		</div>
		<div class="vista">  
			<img src="../images/menuRes/3.jpg">  
			<div id="OtrosPlatos" class="mascara">  
				<h2>Otros Platos</h2>  
			</div>  
		</div>
		<div class="vista"  >  
			<img src="../images/menuRes/4.jpg">  
			<div class="mascara" id='Bebidas' >  
				<h2>Bebidas</h2> 
			</div>  
		</div>
		<div class="vista">  
			<img src="../images/menuRes/5.jpg">  
			<div id="Licores" class="mascara">  
				<h2>Licores</h2>  
			</div>  
		</div>

		<div class="vista" >  
			<img src="../images/menuRes/6.jpg">  
			<div class="mascara" id='Adicionales' >
				<h2>&nbsp; Adicionales</h2>
			</div>  
		</div>
		
		<div class="vista">  
			<img src="../images/menuRes/7.jpg">  
			<div id="Helados"  class="mascara">  
				<h2>Helados</h2>  
			</div>  
		</div>
		<div class="vista">  
			<img src="../images/menuRes/8.jpg">  
			<div id="Merengadas" class="mascara">  
				<h2>Merengadas</h2>  
			</div>  
		</div>

			<div class="vista">  
				<img src="../images/menuRes/9.jpg">  
				<div id="Golosinas" class="mascara">  
					<h2>Golosinas</h2>  
				</div>  
			</div>
		</div>

	
</div>
<!--<div id="<?php /*echo $DialogoModificar;*/ ?>" ></div>-->
<div id="DialogoModificar" ></div>
<?php

}else {
	include("../validar.php");
	?> 
		<script type="text/javascript">
					function redireccionar(){
					  alerta2 ('No tiene perrmisos para acceder a esta página');
					  window.location="../index.php";
					}  
					setTimeout ("redireccionar()", 1000); //tiempo de espera en milisegundos
		 </script> 
<?php } ?> 	