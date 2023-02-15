<?php
session_start();
if (isset($_SESSION['usuId'])){
	$usuario = $_SESSION['usuId'];
?>

<script type="text/javascript">
	
jQuery(document).ready(function(){

	$("a[class='ver']").live("click",function(){

			 var datos=(this.name);
			// window.open('../vistas/rptConsumos.php?cuenta='+datos);
			 $.ajax({
		        url: "../vistas/rptConsu.php",
		       type: "POST",
		       data: "cuenta="+datos,
		       success: function(data){}
		    });
			 return false;

	});
   
		jQuery("#ListarCons").jqGrid({
				url:'../controlador/ListarCons.php',
				datatype: "json",
				colNames:['id','Ver','Mesa','Descuento','Recarga','Total'],
				colModel:[
					{name:'id'
						,index:'id'
						,width:100
						,key: true
						,hidden:true
					},
					{name:'mesa'
						,index:'mesa'
						,width:70
						,align:"center"
						,hidden:false
					},
					{name:'mesa'
						,index:'mesa'
						,width:70
						,align:"center"
						,hidden:false
					},
					{name:'descuento'
						,index:'descuento'
						,width:130
						,align:"center"
						,hidden:false
					},
					{name:'recarga'
						,index:'recarga'
						,width:125
						,align:"center"
						,hidden:false
					},
					{name:'total'
						,index:'total'
						,width:150
						,align:"center"
						,hidden:false
					}
					],
				rowNum:10,
				width:"600",
				height:"auto",
				rowList:[10,20,30],
				pager: '#paginadorListarCons',
				caption:"Cuentas Abiertas",
				sortname: 'CAST(mesa AS SIGNED)',
				sortorder: "ASC",
				shrinkToFit: false,
				editurl:'../controlador/ListarCons.php',
				viewrecords: true,
				rownumbers: true,
				onSelectRow: function(id){},
				loadError : function(xhr,st,err) { jQuery("#rsperrListarCons").html("Tipo: "+st+"; Mensaje: "+ xhr.status + " "+xhr.statusText); }
			}); 
			

			jQuery("#ListarCons").jqGrid('navGrid','#paginadorListarCons',
				{edit:false,add:false,del:false,refresh:true}, //options
				
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
			<span  id="rsperrListarCons" style="color:#595959"></span> <br/>
			<table id="ListarCons"></table><br/>
			<div   id="paginadorListarCons"></div>
		</div>
		<br/>

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