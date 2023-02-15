<?php
session_start();

//echo 'esto: '.$_SESSION['usuId'];
	if (isset($_SESSION['usuId'])){
				$usuario = $_SESSION['usuId'];
				$base = 'pizzeria';
	}else{
				header('Location:../index.html');
	}

	include ("../compartida/funciones/funciones.class.php");
	$objetoG = new funciones;
	$objetoG->con->BaseDatos = $base;
										
		foreach ($_POST as $variable => $valor){
		  $$variable = htmlspecialchars($valor);
		}

	 
switch ($oper) {

		case 'buscar_cuentat':

					  $csql="SELECT
									tiket_hotel.tikethIdE AS id,
									tiket_hotel.tikethFechaF AS fechaf,
									tiket_hotel.tikethCedulaC AS cedula,
									pagos_hotel.pagoshMontoFinalD AS monto,
								'1' AS tipo
								FROM
								pagos_hotel
								INNER JOIN tiket_hotel ON tiket_hotel.tikethPagoshIdE = pagos_hotel.pagoshIdE
								where tikethCedulaC like '%" . $term  . "%' ";
				  
				  $accion = $objetoG->ejecutarcomando($csql);
			
				  $responce='';
				
				  if(count($accion)>0){
						foreach($accion as $row){
						  
							  $fecha = $objetoG->convertirFecha($row['fechaf']);
							  $monto = number_format($row['monto'],2,',','.');						  
							  $mostrar = $row['cedula'].' Fecha.: '.$fecha.' Monto: '.$monto;
							  $ticket = (int)$row['id'];
						
							  $responce[] = array(
									'label'     => $mostrar,
									'value'    	=> $row['cedula'],
									'idtic'     => $ticket,
									'tipo'      => $row['tipo'],
									'evaluo'    => 1
								);
						 }
				  }else{
					 
						$responce[] = array(
							'label'       => 'Sin Información',
    						'value'    	  => '',
							'idtic'       => '',
							'tipo'        => '',
							'evaluo'      => 0
						);
				 
				 }
				
				echo json_encode($responce);
   				
		break;
		
		case 'buscar_cuentaf':

					  $csql="SELECT
									facturas_hotel.facturahIdE AS id,
									facturas_hotel.facturahFechaF AS fechaf,
									facturas_hotel.facturahCedRifC AS cedula,
									'2' AS tipo,
									facturas_hotel.facturahNombreC,
									pagos_hotel.pagoshMontoFinalD
							FROM
								pagos_hotel
								INNER JOIN facturas_hotel ON facturas_hotel.facturahPagoshIdE = pagos_hotel.pagoshIdE
							where facturahCedRifC like '%" . $term  . "%'";
				  
				  $accion = $objetoG->ejecutarcomando($csql);
			
				  $responce='';
				
				  if(count($accion)>0){
						foreach($accion as $row){
						  
							  $fecha = $objetoG->convertirFecha($row['fechaf']);
							  $monto = number_format($row['pagoshMontoFinalD'],2,',','.');						  
							  $mostrar = $row['cedula'].' Fecha: '.$fecha.' Monto: '.$monto;
							  $ticket = (int)$row['id'];
						
							  $responce[] = array(
									'label'     => $mostrar,
									'value'    	=> $row['cedula'],
									'idfac'     => $ticket,
									'tipo'      => $row['tipo'],
									'evaluo'    => 1
								);
						 }
				  }else{
					 
						$responce[] = array(
							'label'       => 'Sin Información',
    						'value'    	  => '',
							'idfac'       => '',
							'tipo'        => '',
							'evaluo'      => 0
						);
				 
				 }
				
				echo json_encode($responce);
   				
		break;
		
		case 'autocompletar_habcuenta':

					  $csql="SELECT
								registro_hotel.registroClienteCIC,
								habitacion.habitaNumC,
								cuenta_hotel.cuentahIdE,
								habitacion.habitaIdE
							 FROM
								cuenta_hotel
							 INNER JOIN registro_hotel ON cuenta_hotel.cuentahRegistroIdE = registro_hotel.registroIdE
							 INNER JOIN consumos_hotel ON consumos_hotel.consumoshRegistroIdE = registro_hotel.registroIdE
							 INNER JOIN habitacion ON consumos_hotel.consumoshHabitaIdE = habitacion.habitaIdE
							 where habitaNumC like '%" . $term  . "%' or registroClienteCIC like '%" . $term  . "%' and cuentahEstatusE = 'Abierta'
							 GROUP BY cuentahIdE";
							 
					//echo $csql;		 
				  
				  $accion = $objetoG->ejecutarcomando($csql);
			
				  $responce='';
				
				  if(count($accion)>0){
						foreach($accion as $row){
						  $mostrar = $row['registroClienteCIC'].' Habit.: '.$row['habitaNumC'];
						  $responce[] = array(
						        'label'     => $mostrar,
								'value'    	=> $row['registroClienteCIC'],
								'idcuex'     => $row['cuentahIdE'],
								'idha'       => $row['habitaIdE'],
								'evaluo'    => 1
							);
						 }
				  }else{
					 
						$responce[] = array(
							'label'        => 'No hay información o ya se cancelaron todas las cuentas',
    						'value'    	   => '',
							'idcuex'       => '',
							'idha'         => '',
							'evaluo'       => 0
						);
				 
				 }
				
				echo json_encode($responce);
   				
		break;
}	
?>