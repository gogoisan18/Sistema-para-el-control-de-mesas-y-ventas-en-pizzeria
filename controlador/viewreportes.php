<?php
session_start();
if (isset($_SESSION['usuId'])){
			$usuario = $_SESSION['usuId'];
			$base = 'pizzeria';
}else{
			header('Location:../index_org.php');
}


include ("../compartida/funciones/funciones.class.php");
$objetoG = new funciones;
$objetoG->con->BaseDatos = $base;


		
foreach ($_POST as $variable => $valor){
  $$variable = $valor;
}


switch ($oper) {

	case 'autocompletar_habi_cuenta':
		 					
				$csql="SELECT
							habitacion.habitaNumC,
							cuenta_hotel.cuentahIdE,
							habitacion.habitaIdE

						FROM
						cuenta_hotel
							INNER JOIN registro_hotel ON cuenta_hotel.cuentahRegistroIdE = registro_hotel.registroIdE
							INNER JOIN consumos_hotel ON consumos_hotel.consumoshRegistroIdE = registro_hotel.registroIdE
							INNER JOIN habitacion ON consumos_hotel.consumoshHabitaIdE = habitacion.habitaIdE
						where cuentahEstatusE = 'Abierta' and habitaNumC like '%" . $term  . "%'
						GROUP BY cuentahIdE";
	
			    $accion = $objetoG->ejecutarcomando($csql);
				

	
				$responce='';
				
				if(count($accion)>0){
					foreach($accion as $row){
					  $responce[] = array(
							'label'    	  => 'Habitación #: '.$row['habitaNumC'],
							'value'    	  => $row['habitaNumC'],
							'idcuenta'	  => (int)$row['cuentahIdE'],
							'idhab'	      => (int)$row['habitaIdE'],
							'evaluo'      => 1
						);
					}
				}else{
					 
					$responce[] = array(
						
						'label'    	  => $term .'Sin Información',
						'value'    	  => '',
						'idcuenta'    => '',
						'evaluo'      => 0
					);
				 
				}
				
				echo json_encode($responce);
		break;
		
		case 'autocompletar_mesa_cuenta':
		 					
				$csql="SELECT
						cuenta_restaurante.cuentarIdE,
						registro_restaurante.registrorNumMesas

						FROM
						cuenta_restaurante
						INNER JOIN registro_restaurante ON cuenta_restaurante.cuentarRegistrorIdE = registro_restaurante.registrorIdE
						where cuentarEstatusE = 'Abierta' and registrorNumMesas like '%" . $term  . "%'";
	
			    $accion = $objetoG->ejecutarcomando($csql);
				

	
				$responce='';
				
				if(count($accion)>0){
					foreach($accion as $row){
					  $responce[] = array(
							'label'    	  => 'Mesa #: '.$row['registrorNumMesas'],
							'value'    	  => $row['registrorNumMesas'],
							'idcuenta'	  => (int)$row['cuentarIdE'],
							'evaluo'      => 1
						);
					}
				}else{
					 
					$responce[] = array(
						
						'label'    	  => $term .'Sin Información',
						'value'    	  => '',
						'idcuenta'    => '',
						'evaluo'      => 0
					);
				 
				}
				
				echo json_encode($responce);
		break;
		
		case 'autocompletar_datos_provee':
		 					
				$csql="SELECT
							proveedor.empresaRifC,
							proveedor.empresaDescrip
							FROM
							proveedor
						where empresaRifC like '%" . $term  . "%' or empresaDescrip like '%" . $term  . "%'";
	
			    $accion = $objetoG->ejecutarcomando($csql);
				

	
				$responce='';
				
				if(count($accion)>0){
					foreach($accion as $row){
					  $responce[] = array(
							'label'    	  => $row['empresaDescrip'].' R.I.F: '.$row['empresaRifC'],
							'value'    	  => $row['empresaRifC']
						
						);
					}
				}else{
					 
					$responce[] = array(
						
						'label'    	  => $term .'Sin Información',
						'value'    	  => ''
					
					);
				 
				}
				
				echo json_encode($responce);
		break;

}	
?>