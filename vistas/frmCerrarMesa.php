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
       
		$('#oculatdatos').hide();
		$('#obsercerrar').attr("onkeyup","this.value=this.value.toUpperCase()");
   	
	 });
</script>
<form enctype="multipart/form-data" class="formulariox">
	<table style="aling:left; width:700px;">

		   <tr><td colspan="4" style=" height:20px !important; "></td></tr>
	       <tr>
			<td style="width:15%;" class="titulosfilas">Observación</td> 
			<td colspan="3">
			 <textarea id="obsercerrar"  style="width: 90%;height:60px;"></textarea>
			</td>
			
		  </tr>
		  
	</table>
 
	
</form>