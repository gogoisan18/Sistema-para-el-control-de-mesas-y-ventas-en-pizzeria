<?php
session_start();

	$regiRes = $_GET['regisResx'];
	$_SESSION['regisResx']=$_GET['regisResx'];

	include ("../compartida/funciones/funciones.class.php");
	$objetoG = new funciones;
	$objetoG->con->BaseDatos = 'pizzeria';
	
	$wherey="where cuentarRegistrorIdE = '".$regiRes."'  ";
					
	$sql = "SELECT
				cuentas.cuentarIdE,
				cuentas.cuentarRegistrorIdE,
				registros.registrorNumMesas,				
				cuentas.cuentarMontoMovimiento,
				cuentas.cuentarMontoDescuentoMovimiento,
				cuentas.cuentarMontoRecargaMovimiento,
				cuentas.cuentarMontoTotalMovimiento
				
				FROM
				cuentas
				INNER JOIN registros ON cuentas.cuentarIdE = registros.registrorIdE
				INNER JOIN consumos ON consumos.controlRegistrorIdE = registros.registrorIdE
	
	
            $wherey GROUP BY cuentarRegistrorIdE";
	//echo $sql;
	
	$data = $objetoG->ejecutarcomando($sql);


	$where="where registrorIdE = '".$regiRes."'  ";
	$sql1 = "SELECT
					Max(detallecuenta.detallerGrupoE) AS maxgrupo,
					detallecuenta.detallerCuentarIdE,
					registros.registrorIdE
					
			FROM
					detallecuenta
					INNER JOIN cuentas ON detallecuenta.detallerCuentarIdE = cuentas.cuentarIdE
					INNER JOIN registros ON cuentas.cuentarRegistrorIdE = registros.registrorIdE
			$where 	GROUP BY detallerCuentarIdE";

			
	$data1 = $objetoG->ejecutarcomando($sql1);
	
	foreach($data1 as $row){
		$cuen = (int)$row['detallerCuentarIdE'];
	}
	
	$wheree="where registrorIdE = '".$regiRes."'  ";
	$sql1e = "SELECT
					Max(detallecuenta.detallerGrupoE) AS maxgrupo,
					detallecuenta.detallerCuentarIdE,
					registros.registrorIdE
					
			FROM
					detallecuenta
					INNER JOIN cuentas ON detallecuenta.detallerCuentarIdE = cuentas.cuentarIdE
					INNER JOIN registros ON cuentas.cuentarRegistrorIdE = registros.registrorIdE
					INNER JOIN pagos ON pagos.pagosrCuentarIdE = cuentas.cuentarIdE
			$wheree
			GROUP BY detallerCuentarIdE";

			
	$data1e = $objetoG->ejecutarcomando($sql1e);
	$maxgrupo='';
	
	foreach($data1e as $row){
		$maxgrupo = $row['maxgrupo'];	
	}
	
	//echo $maxgrupo.'aquiiiiiiiiiiiiiiiiiii';
	if($maxgrupo==''){
		$max = 1;
	}else{
		$max = $maxgrupo+1;
	}
				


?>
<style type="text/css">

	.formulariox{ 
		border: 1px solid #dadada; 
		color: #000; 
		border-radius: 5px;
		font: 15px 'Segoe UI',Arial, Helvetica, sans-serif;
	   	opacity:0.7;
	}
		
	.titulosfilas{font-weight: bold; font-family: Arial, Helvetica, sans-serif; padding:5px;}

	
	#mensajeAlertRerv{font-size:19px; font-family: Arial, Helvetica, sans-serif; color: #000; padding-bottom: 5px;}
	#mensajeAlertRerv{border-bottom: 1px solid rgba(253, 151, 40, 0.9);}
	#mensajeAlertRerv i:before{
		   content: "\25BA ";
		   color: rgba(253, 151, 40, 0.9);
	}
	
	#fila {
    background: #f5f5f5;  
    box-shadow: 0 1px 0 rgba(255,255,255,.8) inset;        
    }
	
	.ui-jqgrid-title{
		font-size: 16px !important;
	}
	.ui-jqgrid-sortable{
		font-size: 15px !important;
		font-family: Arial, Helvetica, sans-serif;
	}
	
</style>
<script type="text/javascript">

	function upd() {

		var monto = $("#montoh").val();
		var total = $("#totalh").val();
		var descuento = $("#descuentoh").val();
		var recarga = $("#recargah").val();
		
		var cambio = (parseFloat(monto) + parseFloat(recarga))-parseFloat(descuento);
		$("#totalh").attr("value",cambio);
		
	}
	function upr() {

		var monto = $("#montoh").val();
		var total = $("#totalh").val();
		var recarga = $("#recargah").val();
		var descuento = $("#descuentoh").val();
		
			
		var cambio = (parseFloat(monto) + parseFloat(recarga))-parseFloat(descuento);
		if(recarga!=''){
			$("#totalh").attr("value",cambio);
		}
		
	}
	function valuecheckcuenta(check){        
			
			
			if(check.value==1){
				  $("#tipocan").attr("value",1);
				  jQuery("#desc").click();
				  jQuery("#recar").click();
				  $("#deescuento").attr("value",1);
				  $("#reecarga").attr("value",1);
							  
			}else{
				  $("#tipocan").attr("value",2);
				  
				  $("#desc").attr('checked', false);
				  $("#recar").attr('checked', false);
				  $("#desc1").attr('checked', false);
				  $("#recar1").attr('checked', false);
				 				  
				  $("#deescuento").attr("value",'');
				  $("#reecarga").attr("value",'');
				 
			}
	}
	
	function chequea(check){
	
			if(check.value==1){
				  $("#deescuento").attr("value",1);
			}else{
				  $("#deescuento").attr("value",'');
			}
	}
	
	function chequea1(check){
	
			if(check.value==1){
				  $("#reecarga").attr("value",1);
			}else{
				  $("#reecarga").attr("value",'');
			}
	}
	
jQuery(document).ready(function(){	
       
        $('#montodeu').attr("onKeyPress", "return NumDeciPunto(event)");
	    $("#trocul,#filaoculta,#filaoculta1,#troculltaa").hide();
		
		$('#nomcli,#direcli,#observa').attr("onkeyup","this.value=this.value.toUpperCase()");
		$('#telfc').attr("onKeyPress", "return soloNum(event)");
			
       	jQuery("#listadoConsumosR").jqGrid({
				url:"../controlador/detalleConsumosRes.php",
							datatype: "json",
							colNames: ['idconsumo','Consumo','Precio','Cantidad','Total','Estatus'],
							colModel: [
							{name:"idconsumo", index:"consumoshIdE", width:50,align:"center",hidden:true,key:true},
							{name:'cons',index:'controlDescripPlato',width:400,hidden:false},
							{name:'precioConsumo',index:'controlPrecioPlato',width:130,align:"center",hidden:false},
							{name:'cantConsumo'	,index:'controlCantPlato',width:100,align:"center",hidden:false},
							{name:'MontoConsumo',index:'controlTotal',width:130,align:"center",hidden:false},
							{name:'estausserv',index:'controlEstatusE',width:120,align:"center",hidden:false}
						
							],
							rowNum:10,
							width:"830",
							height:"auto",
							rowList:[10,20,30],
							caption:"Consumos",
							sortname: 'controlDescripPlato',
							shrinkToFit: false,
							sortorder: "asc",
							editurl:'../controlador/detalleConsumosRes.php',
							viewrecords: true,
							rownumbers: true,
							recordpos: 'left',
							multiselect: true,
							
							onSelectRow: function(id){ 
				                  										
										var cuentax = $("#cuenta").val();
										
										var idcon   = jQuery("#listadoConsumosR").jqGrid('getRowData',id).idconsumo;
										var descser = jQuery("#listadoConsumosR").jqGrid('getRowData',id).cons;
 										var montoserg = jQuery("#listadoConsumosR").jqGrid('getRowData',id).MontoConsumo;
																	
										var montotemp = montoserg;
										
										var boton = $("#jqg_listadoConsumosR_"+id).is(':checked');
																				
										if(boton==true){
											
											$.ajax({
											  url: '../controlador/detalleConsumosRes.php',
											  data: {
														idcon: idcon,
														cuentax: cuentax,
														montotemp: montotemp,
														caso: 1,
														oper: 'chequear_consumos'
													},
											  type: "POST",
											  success: function(ret){
											  		console.log(ret);
													$("#montodeu").attr("value",ret);												
											  }
											});
										
										}else{
										
											$.ajax({
											  url: '../controlador/detalleConsumosRes.php',
											  data: {
														idcon: idcon,
														cuentax: cuentax,
														montotemp: montotemp,
														caso: 2,
														oper: 'chequear_consumos'
													},
											  type: "POST",
											  success: function(ret){
											  		console.log(ret);
													$("#montodeu").attr("value",ret);												
											  }
											});
										}
				            },
						
							
				loadError : function(xhr,st,err) { jQuery("#rsperrorConsumosh").html("Tipo: "+st+"; Mensaje: "+ xhr.status + " "+xhr.statusText); }
			});
			

		jQuery("#listadoConsumosR").jqGrid('navGrid','#paginadorConsumosR',
		{edit:false,add:false,del:false,refresh:true,searchtext:"Buscar"});
				
		var cuentax = $("#cuenta").val();
		
		$.ajax({
		  url: '../controlador/detalleConsumosRes.php',
		  data: {
					cuentax: cuentax,
					caso: 3,
					oper: 'chequear_consumos'
				},
		  type: "POST",
		  success: function(ret){
		  	console.log(ret);
				$("#montodeu").attr("value",ret);												
		  }
		});
				
  ///////////////////////////////////// AREA SUPERIOR //////////////////////////////////    	
		$("#descuentoh").change( function(){
		
			var idre = $("#idregixx").val();
			var total = $("#totalh").val();
			var descuento = $("#descuentoh").val();
			
				$.ajax({
				  url: '../controlador/detalleConsumosRes.php',
				  data: {
							oper: 'actualizardesh',
							idre: idre,
							total: total,
							descuento : descuento
						
						},
				  type: "POST",
				  success: function(retor){
				  
						if(retor==1){
							 //window.location.reload();
							 alerta('Monto actualizado con éxito');
							 $("#tabpagosx").load('frmPagosRes.php');
						}else{
							alerta('Hubo un problema al tratar de actualizar los montos');
						}
				  }
				});
		});
		
		$("#recargah").change( function(){
		
			var idre = $("#idregixx").val();
			var total = $("#totalh").val();
			var recarga = $("#recargah").val();
			
				$.ajax({
					  url: '../controlador/detalleConsumosRes.php',
					  data: {
								oper: 'actualizarecargah',
								idre: idre,
								total: total,
								recarga : recarga
							
							},
					  type: "POST",
					  success: function(retor){
							if(retor==1){
							     alerta('Monto actualizado con éxito');
								 $("#tabpagosx").load('frmPagosRes.php');
							}else{
								alerta('Hubo un problema al tratar de actualizar los montos');
							}
					  }
				});
		});
		
		
		$('#LimpiarCH').click(function(){
			$("#fentraserv,#fsaliserv,#diasserv,#preciohabserv,#totalhabserv,#obhabserv").attr("value",''); 
					
		});
		
		$('#comp').click(function(){
		    var cuentacompl = $("#totalh").val();
			$("#montodeu").attr("value",cuentacompl); 	
		});
		
		$('#fracc').click(function(){
		   
			$("#montodeu").attr("value",''); 	
		});
		
		
		$("#ceduclif").autocomplete({
		
				source: function(request, response) {
					$.ajax({
					  url: '../controlador/detalleConsumosRes.php',
					  data: {
								term: request.term,
								oper: 'autocompletar_cliente'
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
				   
				        $('input[id=telfc]').attr("value",ui.item.teleclii);
				        $('input[id=nomcli]').attr("value",ui.item.nomclii);
						$('textarea[id=direcli]').attr("value",ui.item.direclii);
						
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
		
		$("#tipotarj").autocomplete({
		
				source: function(request, response) {
					$.ajax({
					  url: '../controlador/detalleConsumosRes.php',
					  data: {
								term: request.term,
								oper: 'autocompletar_tipotarjeta'
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
				   
				        $('input[id=banco]').attr("value",ui.item.banco);
									
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

		$("#banco").autocomplete({
		
				source: function(request, response) {
					$.ajax({
					  url: '../controlador/detalleConsumosRes.php',
					  data: {
								term: request.term,
								oper: 'autocompletar_banco'
							},
					  dataType: "json",
					  type: "POST",
					  success: function(data){
						  response(data);
					  }
					});
				},
				select: function(event, ui) { },
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
	   	 
});
</script>

<form enctype="multipart/form-data" class="formulariox" style="border: none !important;">
	<table id="tableconsumos">
		<tr>
			<td class="td_backgro" style="width:180px; text-align: center;background-color: rgb(191, 221, 232)">Mesa</td>
			<td class="td_backgro" style="width:180px; text-align: center;background-color: rgb(191, 221, 232)">Monto Cuenta ( Bs.)</td>
			<td class="td_backgro" style="width:180px; text-align: center;background-color: rgb(191, 221, 232)">Descuento ( Bs.)</td>
			<td class="td_backgro" style="width:180px; text-align: center;background-color: rgb(191, 221, 232)">Recarga ( Bs.)</td>
			<td class="td_backgro" style="width:175px; text-align: center;background-color: rgb(191, 221, 232)">Total ( Bs.)</td>
			
		</tr>
		<?php	
			 foreach($data as $row){
						   
				$nummes  = (int)$row['registrorNumMesas'];
				$idregii = (int)$row['cuentarIdE'];
				$MontoD = $row['cuentarMontoMovimiento'];
				$DescuentoD = $row['cuentarMontoDescuentoMovimiento'];
				$RecargaD = $row['cuentarMontoRecargaMovimiento'];
				$TotalD = $row['cuentarMontoTotalMovimiento'];
							
				echo "<tr><td><input style='width:100%; text-align: center;' id = 'numes' type='text'  value=$nummes readonly='readonly' /></td>";
				echo "<td><input style='width:100%; text-align: center;' id = 'montoh' type='text'  value=$MontoD readonly='readonly' /></td>";
				echo "<td><input style='width:100%; text-align: center;' id = 'descuentoh' onKeyUp='upd()' type='text'  value=$DescuentoD /> </td>";
				echo "<td><input style='width:100%; text-align: center;' id = 'recargah'   onKeyUp='upr()' type='text'  value=$RecargaD /></td>";
				echo "<td><input style='width:97%; text-align: center;' id = 'totalh' type='text'  value=$TotalD readonly='readonly' /></td></tr>\n";
				echo "<tr id='trocul'><td colspan = '5'><input  style='width:10%;' id = 'idregixx' type='text'  value=$idregii /></td></tr>\n";

			}
		?>		
	</table>        
</form>
<br />
	<span  id="rsperrorConsumosR" style="color:#595959"></span> <br/>
	<table id="listadoConsumosR"></table><br/>
	<div   id="paginadorConsumosR"></div>
	
<br />
<br />
<br />
<form  style=";color: #68696A; padding-top: 10px; padding-left: 10px; width: 100%; height: auto; background-image: url('../images/modulos/fondo1.png') !important;" method="POST" onsubmit="return false;" >
	<table  style="width: 99%;" class="ui-jqgrid-sortable"   border="0">
	
			<tr> 
				<td style="width: 15%;">Completa:</td><td style="width: 15%;">                 <input id="comp"  name="pagarr" value="1" type="radio" onclick="valuecheckcuenta(this)"/></td>
				<td style="width: 15%;">Fraccionada:</td><td style="width: 15%;"><input id="fracc" name="pagarr" value="2" type="radio" onclick="valuecheckcuenta(this)"/></td>
				<td style="width: 20%;">Monto a cancelar:</td><td style="width: 50%;"><input id="montodeu"  type="text" style="width: 100%;height:35px; text-align: right;"/></td>
			
						   
			</tr>
			
		
			<tr><td colspan = "6" style="height:10px;"></td></tr>
			<tr> 
				<td style="width: 15%;">Descuento:</td><td style="width: 15%;">          Si <input  id="desc"   type="radio" name="desc"  value="1" onclick="chequea(this)"/>  No <input  id="desc1"  name="desc"  type="radio" value="2" onclick="chequea(this)"/></td>
				<td style="width: 15%;">Recarga:</td><td style="width: 15%;" colspan = "3">Si <input id="recar"  type="radio" name="recar" value="1" onclick="chequea1(this)"/>  No <input  id="recar1" name="recar" type="radio" value="2" onclick="chequea1(this)"/></td>
			
						   
			</tr>
			<tr><td colspan = "6" style="height:10px;"></td></tr>
	</table>
	<table  class="ui-jqgrid-sortable"  style="width: 99%;" border="2">
		<tr> 
			<td style="width: 15%;">Forma de Pago:</td><td style="width: 30%;height:50px;">
						<select id="tipopago">
							   <option  value="0">Seleccione</option>
								<option value="1">Efectivo</option>
								<option value="2">Tarjeta de Débito</option>
								<option value="3">Tarjeta de Crédito</option>
								<option value="4">Cheque</option>
								<option value="5">Transferencia</option>
								<option value="6">Depósito</option>
						</select>
			</td>
			<td style="width: 15%;">Tipo Tarjeta:</td><td><input style="height:35px;" id="tipotarj"  type="text" /></td>	
								   
		</tr>
		<tr><td colspan = "4" style="height:10px;"></td></tr>
		
		<tr> 
		
			<td style="width: 15%;">Banco:</td><td><input style="height:35px;width: 95%;" id="banco"  type="text" /></td>	
			<td style="width: 15%;"># Control:</td><td><input id="contclien" type="text" style="height:35px;" /></td>
					   
		</tr>
		<tr><td colspan = "4" style="height:10px;"></td></tr>
		
		
		<tr id='troculltaa'> 
			<td colspan="6" style="width: 100%;">
				<input id="max" 	  type="text" style="width: 10%;" value = "<?php echo $max; ?>" />
				<input id="cuenta"    type="text" style="width: 10%;" value = "<?php echo $cuen; ?>" />
				<input id="maxanteri" type="text" style="width: 10%;" value = "<?php echo $maxgrupo; ?>" />
				<input id="tipocan"    type="text" style="width: 10%;" />
				<input id="tipofactu" type="text" style="width: 10%;" value = "1" />
				<input id="deescuento" type="text" style="width: 10%;" />
				<input id="reecarga" type="text" style="width: 10%;" />
				<input id="ixregx"  type="text" style="width: 10%;" value = "<?php echo $regiRes; ?>" />
			
			</td>					
		</tr>
		
	</table>
</form>