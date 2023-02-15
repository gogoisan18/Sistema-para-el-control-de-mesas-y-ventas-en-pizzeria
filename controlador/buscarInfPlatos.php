<?php
session_start();
 
	include ("../compartida/funciones/funciones.class.php");
	$objetoG = new funciones;
	$objetoG->con->BaseDatos = 'pizzeria'; //Base de Datos
	

	include ("../modelo/buscarInfPlatos.class.php");
	$objeto = new buscarInfPlatos;
	$objeto->con->BaseDatos = 'pizzeria'; //Base de Datos
	

		
	foreach ($_POST as $variable => $valor){
		  $$variable = htmlspecialchars($valor);
	}
		

	if (isset($_GET['page']))
		$pag    = $_GET['page'];  // get the requested page
	if (isset($_GET['rows']))			
		$limite = $_GET['rows'];  // get how many rows we want to have into the grid
	$ord=1;
	if (isset($_GET['sidx']))	
		$ord    = $_GET['sidx']; // get index row - i.e. user click to sort
	
	if (isset($_GET['sord']))			
		$dir    = $_GET['sord'];  // get the direction Acs o Desc
	if (!isset($oper))	$oper = '';	


	switch($oper){
			
			case 'detalleMenu':
			
			    if($entrada=='Pizzas'){
					$registros= $objeto->BuscarPizzas();
			        echo json_encode($registros);
					
				}else if($entrada=='Carnes'){
					$registros= $objeto->BuscarCarnes();
			        echo json_encode($registros);
					
				}else if($entrada=='OtrosPlatos'){
					$registros= $objeto->BuscarOtrosP();
			        echo json_encode($registros);
					
				}else if($entrada=='Bebidas'){
					$registros= $objeto->BuscarBebidas();
			        echo json_encode($registros);
					
				}else if($entrada=='Licores'){
					$registros= $objeto->BuscarLicores();
			        echo json_encode($registros);
					
				}else if($entrada=='Adicionales'){
				
					$registros= $objeto->BuscarAdicionales();
			        echo json_encode($registros);
					
				}else if($entrada=='Helados'){
					$registros= $objeto->BuscarHelados();
			        echo json_encode($registros);
					
				}else if($entrada=='Merengadas'){
					$registros= $objeto->BuscarMerengadas();
			        echo json_encode($registros);
					
				}else if($entrada=='Golosinas'){
					$registros= $objeto->BuscarGolosinas();
			        echo json_encode($registros);
					
				}
		
		    break;
			
			case 'autocompletar_mesonero':
			

				$where=" where perCedulaC like '%".$term."%' or perNombreC like '%".$term."%' or perApellidoC like '%".$term."%' and perEstatusE = 'Activo'";
				$enti = 'personal';
				$accion = $objetoG->consultaGeneral($enti, $where, 'perCedulaC', 'asc', 0, 10);
				$responce='';
				foreach($accion as $row){
				  $responce[] = array(
						'label'    	  => '[ '.$row['perCedulaC'].' ] '.$row['perNombreC'].' '.$row['perApellidoC'],
						'value'    	  => $row['perNombreC'],
						'apemeso'     => $row['perApellidoC'],
						'cedmeso'     => $row['perCedulaC'],
						'idmeso'      => (int)$row['perIdE'],
						'evaluo'      => 1
					);
				 }
				  if (count($accion) == 0) {
					$responce[] = array(
						
						'label'    	  => $term .' Personal no encontrado..',
						'value'    	  => $term,
						'evaluo'      => 0
					);
				 }
				
				echo json_encode($responce);
			break;
			
			
			case 'guardar_apert_mesa':
			
							
		        $enti = 'mesas';
				$existe  = $objetoG->cantidadReg($enti," Where mesasNum = '" . $numxmesax . "' and  mesasEstatusE = 'Inactiva'");
              	$existe1 = $objetoG->cantidadReg($enti," Where mesasNum = '" . $numxmesax . "' and  mesasEstatusE = 'Ocupada'");
				
				if($existe>0){
					$res = 'Disculpe, esta mesa se encuentra inactiva';
				}else if($existe1>0){
					$res = 'Disculpe, esta mesa se encuentra Ocupada';
				}else{
					$fecha = gmdate("Y-m-d");
					
					$res = $objeto->aperturar_mesa($numxmesax,$idmesoxx,$fecha);
					
				}
				echo $res;
								                 
			break;
			
			case 'guardarplato':
			
													
		        $enti = 'cuentas
						INNER JOIN registros ON cuentas.cuentarRegistrorIdE = registros.registrorIdE
						INNER JOIN consumos ON consumos.controlRegistrorIdE = registros.registrorIdE';
				$where = " Where controlDescripPlato = '" . $xnombplato . "' and  controlRegistrorIdE = '" . $registroResx . "' ";		
				$existe  = $objetoG->cantidadReg($enti,$where);
              					
				if($existe>0){
					$res = 'Ya existe registrado un consumo con esta descripción';
				}else{
									
					$res = $objeto->cargar_plato_cuenta($xprecplato,$xnombplato,$registroResx);
					
				}
				
				echo $res;

				//echo $enti.' '.$where;								                 
			break;
			
			case 'revisarEstatus':
			    if(isset($_SESSION['numM'])){
				
				    $numM = $_SESSION['numM'];
				
					$csql="SELECT
								cuentas.cuentarEstatusE,
								registros.registrorIdE
							FROM
								cuentas
								INNER JOIN registros ON cuentas.cuentarRegistrorIdE = registros.registrorIdE
								INNER JOIN mesas ON registros.registrorNumMesas = mesas.mesasNum
							WHERE  mesasNum = '".$numM."' and cuentarEstatusE='Abierta'";

					$accion = $objetoG->ejecutarcomando($csql);
					
					if(count($accion)>0){
						foreach($accion as $row){
							$resultadox = '1'.'||'.(int)$row['registrorIdE'];
						}
					}else{
						    $resultadox = '0'.'|| ';
					}
					
					echo $resultadox;
				}
								                 
			break;
			
			case 'modificar_consumo':
			
						/*oper:'modificar_consumo',
							idplatox:idplatox,
							cantplax:cantplax,
							registroResx:registroResx,
							precioplatox:precioplatox*/
							
				$res = $objeto->modificar_consumox($idplatox,$cantplax,$registroResx,$precioplatox);
			
				echo $res;
								                 
			break;
			
			case 'eliminar_consumo':
			
						/*oper:'eliminar_consumo',
							idplatox:idplatox,
							registroResx:registroResx*/
							
				$res = $objeto->eliminar_consumox($idplatox,$registroResx);
				
				echo $res;
								                 
			break;
			
			case 'cambiar_de_mesa':
			
						/*oper:'cambiar_de_mesa',
							numxmesax:numxmesax,
							nuevamesax:nuevamesax,
							registroResx:registroResx,
							obserCambiox:obserCambiox*/
							
				$enti = 'mesas';
				$existe  = $objetoG->cantidadReg($enti," Where mesasNum = '" . $nuevamesax . "' and  mesasEstatusE = 'Inactiva'");
              	$existe1 = $objetoG->cantidadReg($enti," Where mesasNum = '" . $nuevamesax . "' and  mesasEstatusE = 'Ocupada'");
				
				if($existe>0){
					$res = 'Disculpe, la nueva mesa se encuentra inactiva';
				}else if($existe1>0){
					$res = 'Disculpe, la nueva mesa se encuentra Ocupada';
				}else{
					
					$res = $objeto->cambiar_mesa($numxmesax,$nuevamesax,$registroResx,$obserCambiox);
					
				}	
				echo $res;
								                 
			break;
			
			case 'consultar_mesas_libres':
			

				$where=" where mesasEstatusE='Libre'";
				$enti = 'mesas';
				$accion = $objetoG->consultaGeneral($enti, $where, 'mesasNum');
				$responce='';
				foreach($accion as $row){
				  $responce[] = array(
						'label'   => 'Num: '.$row['mesasNum'],
						'value'   => $row['mesasNum'],
						'evaluo'  => 1
					);
				 }
				  if (count($accion) == 0) {
					$responce[] = array(
						'label'    => $term .'Mesa no disponible',
						'value'    => '',
						'evaluo'   => 0
					);
				 }
				
				echo json_encode($responce);
			break;
			
			case 'buscarcanti':
			   				
					$csql="SELECT controlCantPlato FROM consumos WHERE controlId = '".$id."' ";

					$accion = $objetoG->ejecutarcomando($csql);
					
					if(count($accion)>0){
						foreach($accion as $row){
							$resultadox = $row['controlCantPlato'];
						}
					}else{
						    $resultadox = '';
					}
					
					echo $resultadox;
					
					//echo $csql;
							                 
			break;
			
			case 'consulEstatus':
			
					$registros = $objeto->Buscaresta();
			        echo json_encode($registros);
			break;

			case 'consumos_mesa':
			   				
					$wherey="where controlRegistrorIdE = '".$registro."' and controlEstatusE = 'Por Cancelar' ";
					
					$sql = "SELECT
								count(consumos.controlId) as cant
							FROM consumos
							INNER JOIN registros ON consumos.controlRegistrorIdE = registros.registrorIdE
												
							$wherey 
							GROUP BY controlRegistrorIdE ";
			        //echo $sql;
					$eje = $objetoG->ejecutarcomando($sql);

					if(count($eje)>0){
						foreach($eje as $row){
							$resultadox = $row['cant'];
						}
					}else{
						    $resultadox = '0';
					}
					
					echo $resultadox;

						                 
			break;

			case 'cerrar_mesa':
										
				$res = $objeto->cerrar_mesa($numxmesax,$registro,$obsercerrar);
				
				echo $res;
								                 
			break;
			
			
			default:
		           
					
					
					//$mesa = '1';
					$mesa = $_SESSION['numM'];
				    $entidad = "consumos
					INNER JOIN registros ON consumos.controlRegistrorIdE = registros.registrorIdE
					INNER JOIN cuentas ON cuentas.cuentarRegistrorIdE = registros.registrorIdE
					INNER JOIN mesas ON  registros.registrorNumMesas = mesas.mesasNum";

					$where = 'where mesasNum ="'.$mesa.'" and cuentarEstatusE = "Abierta" and controlEstatusE="Por Cancelar"';
				
					$registros = $objetoG->consultaGeneral($entidad, $where);
					
					 ///******* Obtener Datos Paginador
					$cantidad = $objetoG->cantidadReg($entidad, $where);
					$total_pag = $objetoG->totalPagina($cantidad, $limite);
					$inicio = $objetoG->inicioPagina($pag, $total_pag, $limite);
										
					$responce = new stdClass;          
					$responce->page    = $pag;
					$responce->total   = $total_pag;
					$responce->records = $cantidad;
					$i=0;

					foreach ($registros as $row) {
						//colNames:['id','Descripción','Precio','Cantidad','Eliminar'],
						
						$responce->rows[$i]['id'] = (int)$row['controlId'];
						$responce->rows[$i]['cell'] = array(
							(int)$row['controlId'],
							$row['controlDescripPlato'],
							$row['controlPrecioPlato'],
							$row['controlCantPlato']/*,
							'Eliminar'*/
							
						);
						$i++;
					}
					echo json_encode($responce);
				break;
	}

?>