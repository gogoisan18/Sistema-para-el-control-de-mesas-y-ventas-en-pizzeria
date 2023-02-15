<?php
session_start();
    if (isset($_SESSION['numM'])){
		$numMesa = $_SESSION['numM'];
	}else{
		$numMesa = '';

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
	.filatable{ 
		border: 1px solid #dadada; 
		color: #000; 
		border-radius: 20px;
		font: 15px 'Segoe UI',Arial, Helvetica, sans-serif;
		font-family: Arial,Helvetica,sans-serif;
		
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
	
	
</style>
<script type="text/javascript">

    function valuecheck(check){        
			
			if(check.value=='Si'){
				 $("#cargar").attr("value","Si");
			}else{
				  $("#cargar").attr("value","No");
			}
	}
	 jQuery(document).ready(function(){	
   
		var mesa = $("#xmesax").val();
		$("#numxmesa").attr("value",mesa);
		//alert(mesa+' esta');
		
		$('#oculatdatos,#ocultartabla').hide();
		$('#nombremeso,#apellimeso').attr("onkeyup","this.value=this.value.toUpperCase()");	 
		
		$("#nombremeso").autocomplete({
				source: function(request, response) {
					$.ajax({
					  url: '../controlador/buscarInfPlatos.php',
					  data: {
								term: request.term,
								oper: 'autocompletar_mesonero'
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
				        $('input[id=apellimeso]').attr("value",ui.item.apemeso);
						$('input[id=idmesox]').attr("value",ui.item.idmeso);
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
				minChars: 2,
				selectFirst: false,
				mustMatch: true
		});
		jQuery('.ui-autocomplete').css({'font-size':'14px'});
		
		$("#consulx").autocomplete({
				source: function(request, response) {
					$.ajax({
					  url: '../controlador/buscarInfPlatos.php',
					  data: {
								term: request.term,
								oper: 'consultar_hospedaje'
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
				        $('input[id=nombreCH]').attr("value",ui.item.nomcli);
						$('input[id=apelliCH]').attr("value",ui.item.apecli);
						$('input[id=idRegHotel]').attr("value",ui.item.idregHo);
						$('input[id=idCuenHotel]').attr("value",ui.item.idcueHo);
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
				minChars: 2,
				selectFirst: false,
				mustMatch: true
		});
		jQuery('.ui-autocomplete').css({'font-size':'14px'});
		
		$("#radio1").click( function(){ 
			$('#ocultartabla').show();
		});
		$("#radio2").click( function(){ 
			$('#ocultartabla').hide();
		});
		
		
	   
	 });
</script>
<form enctype="multipart/form-data" class="formulariox">
	<table style="aling:left; width:700px;">

		  <tr>
			<td class="titulosfilas">Mesa</td> 
			<td colspan = "3" ><input class="filatable" id="numxmesa"  type="text" style="width:10%;" name="numxmesa"  readonly></td>
			
		  </tr>
		  <tr><td colspan="4" style=" height:20px !important; "></td></tr>
		  <tr><td colspan="4"><div style="width:95.5%; font-size: 16px; height:25px !important; background-color: rgb(191, 220, 232) !important;">&nbsp;<b>Datos del mesonero</b></div></td></tr>
          <tr><td colspan="4" style=" height:20px !important; "></td></tr>
	       <tr>
			<td>Nombre</td> 
			<td><input id="nombremeso"  type="text" style="width:85%;"  name="nombremeso" /></td>
			<td>Apellido</td>
			<td ><input id="apellimeso"  type="text" style="width:85%;" name="apellimeso" readonly /></td>
		  </tr>
		  
		    <tr id="oculatdatos">
		
				<td colspan="4">
					<input id="idmesox"  type="text" style="width:10%;" />					
				</td>
		    </tr>
		  
	</table>
	
</form>