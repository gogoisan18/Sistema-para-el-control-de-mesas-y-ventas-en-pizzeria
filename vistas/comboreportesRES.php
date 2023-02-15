<?php
session_start();
if (isset($_SESSION['usuId'])){
	$usuario = $_SESSION['usuId'];

	if(isset($_SESSION['tipousu'])){
		$tipo = $_SESSION['tipousu'];
		
	}else{
		$tipo = 'Temporal';
	}
;
?>
<script>
    $(document).ready(function() {
	
		$("#tr1,#tr2").hide();
	    
		jQuery('#fechadesde').datepicker({dateFormat:"dd-mm-yy"});
        jQuery('#fechahasta').datepicker({dateFormat:"dd-mm-yy"});
		
	
		/**Cada vez que cambien las opciones de consulta***/
		$("#seleconsultas").on("change",function(){
	       
			    destruir_variable("dsd",'');
			    destruir_variable("hst",'');
				
				$("#fechadesde").attr("value",'');
			    $("#fechahasta").attr("value",'');
				
		       var opcion = $("#seleconsultas").val();
			   if(opcion=='1' || opcion=='3'){
					$("#tr1,#tr2").show();
			   }else  if(opcion=='2'){
			        $("#tr1,#tr2").hide();										
			   }else{
			        $("#tr1,#tr2").hide();
					alerta('Por favor Seleccione una consulta');
					
			   }	
		});  
		
		$("#mostrarr").click(function(){
		
			var opcion = $("#seleconsultas").val();

			var filtro1 = $("#fechadesde").attr("value");
            var filtro2 = $("#fechahasta").attr("value");
			 
				if(opcion=='0'){
				 	alerta('Por favor Seleccione una consulta');
				}else if(opcion=='1' || opcion=='3'){

					if(filtro1=='' || filtro2==''){
						alerta('Por favor Ingrese ambas fechas');
				    }else{

						crear_variable('dsd',filtro1);
						crear_variable('hst',filtro2);

						 if(opcion=='1'){
							 $("#listarventas").show();$("#listarconsulta").hide();
							 $("#listarventas").load("../vistas/frmListar.php");				   
						}else if(opcion=='3'){
							//window.open('../vistas/rptReporteZ.php');
							$.ajax({
						        url: "../vistas/rptReporteZ.php",
						       type: "POST",						     
						       success: function(data){}
						    });
					    }
					}
				}else{
					 $("#listarconsulta").show();$("#listarventas").hide();
					 $("#listarconsulta").load("../vistas/frmListarC.php");
				}							
		
		});
		
		$("#limpiarr").click(function(){
		
		
			$("#fechadesde").attr("value",'');
			$("#fechahasta").attr("value",'');			
			$("#tr1,#tr2,#listarventas,#listarconsulta").hide();
			destruir_variable("dsd",'');destruir_variable("hst",'');
			$("#seleconsultas").attr("value",0);
			  					
		});

    });
</script><br/><br/><br/><br/>
		<table id= "contenido" style="width: 520px; padding-left:20px;" border='0'>
						<tr><td style="width: 100px; padding-top: 10px;">Reporte:</td>
							
							<td><div id="consulta" width="10%">
 							   <select id="seleconsultas" class="estilo-input"  size="1" >
									<option role="option" value="0">Seleccione&nbsp;&nbsp;</option>
									<option role="option" value="1">Reimprimir Ticket</option>
									<option role="option" value="2">Consultar Cuenta</option>
									<?php 
									      if($tipo=='Administrador'){ 	
										     echo "<option role='option' value='3'>Ventas</option>";
										  }
								     ?>

								</select>
							</div></td>
						
						</tr>
						<tr ><td style="border-bottom: 2px solid #343536;" colspan="2"><br /></td></tr>
						
						<tr id='tr1'>
							<td align='left'>Desde:</td>
							<td>
								<input name='fechadesde' id='fechadesde' size='15' />
							</td>
					   </tr>
						<tr id='tr2'>
							<td align='left'>Hasta:</td>
							<td>
								<input name='fechahasta' id='fechahasta' size='15' />
							</td>
						</tr>
						<tr><td></td></tr>
						
										
						<tr >
							<td align="right"  style="border-top: 2px solid #343536;" colspan="2"><br/>
								<a id='mostrarr'> Mostrar &nbsp;&nbsp;&nbsp;</a>	
								<a id='limpiarr'> Limpiar&nbsp;&nbsp;&nbsp;</a>
							</td>
						</tr>
					
				</table>

				<div class="gray_block gb1">
					<div class="container_12">
						<div id="listarventas"></div>
					</div>
				</div>
				<div class="gray_block gb1">
					<div class="container_12">
						<div id="listarconsulta"></div>
					</div>
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