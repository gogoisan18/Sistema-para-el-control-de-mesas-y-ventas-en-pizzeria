<?php
session_start();
$numMesa = $_SESSION['numM'];
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

	
</style>
<script type="text/javascript">

	 jQuery(document).ready(function(){	
	   
		
        $('#nuevamesa').attr("onKeyPress", "return soloNum(event)");
		$('#oculatdatos').hide();
		$('#obserCambio').attr("onkeyup","this.value=this.value.toUpperCase()");

        /*$("#nuevamesa").autocomplete({
				source: function(request, response) {
					$.ajax({
					  url: '../controlador/buscarInfPlatos.php',
					  data: {
								oper: 'consultar_mesas_libres'
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
				width: 400,
				minChars: 1,
				selectFirst: false,
				mustMatch: true
		}); 
    	jQuery('.ui-autocomplete').css({'font-size':'14px'});*/
		
	 });
</script>
<form enctype="multipart/form-data" class="formulariox">
	<table style="aling:left; width:700px;">

		  <tr>
			<td class="titulosfilas" style="width:15%;">Mesa actual</td> 
			<td><input class="filatable" id="numxmesa"  type="text" style="width:20%;" name="numxmesa" value="<?php echo $numMesa; ?>" readonly></td>
			<td class="titulosfilas" style="width:15%;">Mesa Nueva</td> 
			<td><input class="filatable" id="nuevamesa"  type="text" style="width:20%;" maxlength = "3"></td>
			
		  </tr>
	       <tr><td colspan="4" style=" height:20px !important; "></td></tr>
	       <tr>
			<td style="width:15%;" class="titulosfilas">Observación</td> 
			<td colspan="3">
			 <textarea id="obserCambio"  style="width: 90%;height:60px;"></textarea>
			</td>
			
		  </tr>
		  <tr id="oculatdatos">
		
				<td colspan="2">
					<input id="newmesa" type="text" style="width:10%;" />
				</td>
				
		   </tr>
		  
	</table>
 
	
</form>