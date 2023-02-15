<?php
session_start();
if (isset($_SESSION['usuId'])){
	$usuario = $_SESSION['usuId'];
?>

<script type="text/javascript">
	
jQuery(document).ready(function(){

	$("a[class='imprimir']").live("click",function(){

			 var datos=(this.name);
			 //window.open('../vistas/rptTicket.php?tick='+datos);
			 //window.open('../vistas/ayuda3.php?tick='+datos);
			 //window.location.href=('../vistas/ayuda3.php?tick='+datos);
		    $.ajax({
		        url: "../vistas/ayuda3.php",
		       type: "POST",
		       data: "tick="+datos,
		       success: function(data){}
		    });
			return false;

	});
   
		jQuery("#listar").jqGrid({
				url:'../controlador/listarCC.php',
				datatype: "json",
				colNames:['id','Imprimir','Mesa','Fecha','Hora','Cajero','Monto Cancelado'],
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
					{name:'fecha'
						,index:'fecha'
						,width:100
						,align:"center"
						,hidden:false
					},
					{name:'hora'
						,index:'hora'
						,width:100
						,align:"center"
						,hidden:false
					},
					{name:'cajero'
						,index:'cajero'
						,width:180
						,align:"center"
						,hidden:false
					},
					{name:'monto'
						,index:'monto'
						,width:130
						,align:"center"
						,hidden:false
					}
					],
				rowNum:10,
				width:"700",
				height:"auto",
				rowList:[10,20,30],
				pager: '#paginadorListar',
				caption:"Cuentas Canceladas",
				sortname: 'CAST(mesa AS SIGNED),fecha,hora',
				sortorder: "ASC",
				shrinkToFit: false,
				editurl:'../controlador/listarCC.php',
				viewrecords: true,
				rownumbers: true,
				onSelectRow: function(id){ 
				
					    var a = jQuery("#listar").jqGrid('getRowData',id).id;
					
				},
				loadError : function(xhr,st,err) { jQuery("#rsperrListar").html("Tipo: "+st+"; Mensaje: "+ xhr.status + " "+xhr.statusText); }
			}); 
			

			jQuery("#listar").jqGrid('navGrid','#paginadorListar',
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
			<span  id="rsperrListar" style="color:#595959"></span> <br/>
			<table id="listar"></table><br/>
			<div   id="paginadorListar"></div>
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