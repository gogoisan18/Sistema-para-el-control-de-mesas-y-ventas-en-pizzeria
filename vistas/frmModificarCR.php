<?php
session_start();
$numMesa = $_SESSION['numM'];

	foreach ($_GET as $variable => $valor){
		  $$variable = htmlspecialchars($valor);
	}
	
	include ("../compartida/funciones/funciones.class.php");
	$objetoG = new funciones;
	$objetoG->con->BaseDatos = 'pizzeria';
	
					
	$sql = "SELECT 	controlDescripPlato	FROM consumos	where controlId = '".$id."' ";
	$data = $objetoG->ejecutarcomando($sql);
	
	 foreach($data as $row){
	 	$nombreplato = $row['controlDescripPlato'];
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

	
</style>
<script type="text/javascript">
      function compruebaCambio(entrada){ 
		var cantpla = entrada.value;
		//alert(cantpla);
		$("input[id=cantxx]").attr("value",cantpla);
	  }
	
	 jQuery(document).ready(function(){	
	        
			$("tr#simpleoculta").hide();
            $("#cantpla").attr("onKeyPress", "return soloNum(event)");
		
		    var id = <?php  echo $id; ?>
		
			$.ajax({
				url: '../controlador/buscarInfPlatos.php',
				data: {oper: 'buscarcanti',id:id},
				type: "POST",
				success: function(retor){
				    //alert(retor+' nada')
					
					$("input[id=xcantpla]").attr("value",retor);
					$("input[id=cantxx]").attr("value",retor);
				}
			});
		
	 });
</script>
<form class="formulariox" name="formcambio" >
	<table style="aling:left; width:700px;">

		  <tr>
			<td class="titulosfilas">Mesa</td> 
			<td colspan = "3" ><input class="filatable" id="numxmesa"  type="text" style="width:10%;" name="numxmesa"  value= "<?php  echo $mesax; ?>" readonly></td>
			
		  </tr>
		  <tr><td colspan="4" style=" height:20px !important; "></td></tr>
		  <tr><td colspan="4"><div style="width:95.5%; font-size: 16px; height:25px !important; background-color: rgb(191, 220, 232) !important;">&nbsp;<b>Datos del Consumo</b></div></td></tr>
          <tr><td colspan="4" style=" height:20px !important; "></td></tr>
	       <tr>
			<td style="width:12%;">Descripción</td> 
			<td>
			 <textarea id="nombreplato"  style="width: 92%;height:60px;" readonly ><?php  echo $nombreplato; ?></textarea>
			</td>
			
		  </tr>
		  <tr>
		
			<td style="width:12%;">Cantidad</td>
			<td ><input id="xcantpla"  type="text" name="xcantpla" style="width:20%;height:25px;" onblur="compruebaCambio(this)"/></td>
		  </tr>
		  <tr id="simpleoculta">
		
				<td colspan="2">
					<input id="idpl"  type="text" style="width:10%;" value= "<?php  echo $id; ?>" readonly />
					<input id="precioplato"  type="text" style="width:20%;" value= "<?php  echo $prec; ?>" readonly />
					<input id="cantxx"  name="cantxx" type="text" style="width:20%;" readonly />
				</td>
				
		   </tr>
		  
	</table>
	
</form>