<?php
session_start();
 
    $base = 'pizzeria';
	//Incluir las Clases y Objetos
	include ("../compartida/funciones/funciones.class.php");
	$objetoG = new funciones;
	$objetoG->con->BaseDatos = $base; //Base de Datos
	
	//Incluir las Clases y Objetos
	include ("../modelo/usuarios.class.php");
	$objeto = new usuarios;
	$objeto->con->BaseDatos = $base; //Base de Datos
	
	//Parametros
		$entidad  = 'usuarios';

		
		foreach ($_POST as $variable => $valor){
		  $$variable = htmlspecialchars($valor);
		}
		
		//**********Paginador		
		/*if (isset($_POST['oper'])) // get oper a ejecutar
			$oper = $_POST['oper'];*/
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
		
		
		if (isset($_POST['accion'])){
			
				if ($_POST['accion'] == 'xssggx') {
					$oper = 'buscar';
					$datos = explode("||", base64_decode($_POST['xt56yz'])); //
					$cedula = $datos[0];
					$clave = $datos[1];
				}
				
		}

		//***Fin de Parametros
 //echo $oper.'esto';
switch ($oper) {

			case 'agregar':
			    //echo $oper.'esto';
				$existe = $objetoG->cantidadReg($entidad," Where usuCedulaC = '" . $cedu . "' ");
                $estatus = $_SESSION['tipoest'];
				 
				if($existe>0){
					echo ('Ya existe un usuario registrado con el Nro. Cédula '.$cedu);
				}else if($estatus==''){
					echo ('Por favor Seleccione un Estatus');
				}else{
				          if($tipo=='1'){ $tipox = 'Administrador';}
					 else if($tipo=='2'){ $tipox = 'Operador';}

					      if($estatus=='1'){ $estatusx = 'Activo';}
					 else if($estatus=='2'){ $estatusx = 'Inactivo';}
										
					$res = $objeto->agregar($cedu,$nomb,$apel,$tlf,$tipox,$pass,$estatusx);
					echo $res;
				}
				
				                 
			break;

			case 'modificar':
				
					$estatus = $_SESSION['tipoest'];
						 if($estatus=='1' or $estatus==''){ $estatusx = 'Activo';}
					else if($estatus=='2'){ $estatusx = 'Inactivo';}
				
				
				          if($tipo=='1'){ $tipox = 'Administrador';}
					 else if($tipo=='2'){ $tipox = 'Operador';}					 
					 	
					 
					 $res = $objeto->editar($cedu,$nomb,$apel,$tlf,$tipox,$pass,$estatusx);
					 echo $res;
					
			break;
			
			case 'eliminar':
									 
					 $res = $objeto->eliminar($cedu);
					 echo $res;
					
			break;
			
					
			case 'buscar':
			
			    $datos = explode("||", $_POST['xt56yz']); 
				$cedula = $datos[0];
				$clave = $datos[1];
				
				$where = " WHERE usuCedulaC = '" . $cedula . "' ";
				//echo $where;
				$registros = $objetoG->consultaGeneral('usuarios', $where);			

				$_SESSION['logeado'] = false;

				foreach ($registros as $row) {
					
					$_SESSION['usuNombres'] = $row['usuNombreC'] . ' ' . $row['usuApellidoC'];
				
					if ($row['usuEstatusE'] == 'Inactivo') {
						$acceso = "inactivo"."||0";
					}else if ($row['usuClaveC'] == SHA1($clave)) {
						
						$acceso = "true"."||".$row['usuTipoE'];
						$_SESSION['logeado'] = true;
						$_SESSION['usuId'] = $row['usuCedulaC'];
						$_SESSION['tipousu'] = $row['usuTipoE'];
				
					} else {
						$acceso = "invalido."."||0";
					}
				}

				echo $acceso;
			break;
			
			case 'autocompletar_usu':
			
				$where=" where usuCedulaC like '%" . $term  . "%' ";
				$enti = 'usuarios';
				$accion = $objetoG->consultaGeneral($enti, $where, 'usuCedulaC', 'asc', 0, 10);
				$responce='';
				foreach($accion as $row){
				  $responce[] = array(
						'label'    	  => $row['usuCedulaC'] . " De " .ucwords(strtolower($row['usuNombreC'])). " " .utf8_encode(ucwords(strtolower( $row['usuApellidoC'] ))),
						'value'    	  => $row['usuCedulaC'],
						'nombre'      => $row['usuNombreC'],
						'apelli'   	  => $row['usuApellidoC'],
						'tlf'    	  => $row['usuTelfCelC'],
						'tipousu'     => $row['usuTipoE'],
						'estat'    	  => $row['usuEstatusE'],
						'evaluo'      => 1
					);
				 }
				  if (count($accion) == 0) {
					$responce[] = array(
						
						'label'    	  => $term . ' Usuario No Registrado..',
						'value'    	  => $term ,
						'evaluo'      => 0
					);
				 }
				
				echo json_encode($responce);
			break;
			
			case 'buscar_infor':
			      
				  $csql="SELECT * from usuarios  WHERE usuCedulaC = '".$term."' ";
		
				  $accion = $objetoG->ejecutarcomando($csql);
			
				  $salida='';
				
				  if(count($accion)>0){
						foreach($accion as $row){
				
							$salida = $row['usuCedulaC'].'||'.$row['usuNombreC'].'||'.$row['usuApellidoC'].'||'.$row['usuTelfCelC'].'||'.$row['usuTipoE'].'||'.$row['usuEstatusE'];
					    }
				  }
				echo $salida;
		
		    break;
            default:
		
					///******* contruccion de variable where		
					$ops = array(//array to translate the search type
						'eq' => '=', //equal
						'ne' => '<>', //not equal
						'lt' => '<', //less than
						'le' => '<=', //less than or equal
						'gt' => '>', //greater than
						'ge' => '>=', //greater than or equal
						'bw' => 'LIKE', //begins with
						'bn' => 'NOT LIKE', //doesn't begin with
						'in' => 'LIKE', //is in
						'ni' => 'NOT LIKE', //is not in
						'ew' => 'LIKE', //ends with
						'en' => 'NOT LIKE', //doesn't end with
						'cn' => 'LIKE', // contains
						'nc' => 'NOT LIKE'  //doesn't contain
					);

					function getWhereClause($col, $oper, $val) {
						global $ops;
						if ($oper == 'bw' || $oper == 'bn')
							$val .= '%';
						if ($oper == 'ew' || $oper == 'en')
							$val = '%' . $val;
						if ($oper == 'cn' || $oper == 'nc' || $oper == 'in' || $oper == 'ni')
							$val = '%' . $val . '%';
						return $where = " WHERE $col {$ops[$oper]} '$val' ";
					}
                    
			
					$where="";
					
					
					if ($_GET['_search'] == 'true') {
						$searchField = isset($_GET['searchField']) ? $_GET['searchField'] : false;
						$searchOper = isset($_GET['searchOper']) ? $_GET['searchOper'] : false;
						$searchString = isset($_GET['searchString']) ? $_GET['searchString'] : false;
						$where = getWhereClause($searchField, $searchOper, $searchString);
					}
					///******* Fin contruccion de variable where
					
									
					///******* Obtener Datos Paginador
					$cantidad = $objetoG->cantidadReg($entidad, $where);
					$total_pag = $objetoG->totalPagina($cantidad, $limite);
					$inicio = $objetoG->inicioPagina($pag, $total_pag, $limite);
			
					
					///******* Sentencia SQL para mostrar Registros
					$registros = $objetoG->consultaGeneral($entidad, $where, $ord, $dir, $inicio, $limite);
					
					
					$responce = new stdClass;          
					$responce->page    = $pag;
					$responce->total   = $total_pag;
					$responce->records = $cantidad;
					$i=0;

					foreach ($registros as $row) {
						
										
						$responce->rows[$i]['id'] = $row['usuCedulaC'];
						$responce->rows[$i]['cell'] = array(
							$row['usuCedulaC'],
							$row['usuNombreC'],
							$row['usuApellidoC'],
							$row['usuTelfCelC'],
							$row['usuTipoE'],
							$row['usuClaveC'],
							$row['usuEstatusE']
							
						);
						$i++;
					}

					echo json_encode($responce);
					///******* Fin Sentencia SQL para mostrar Registros
				
				break;
		}

//***** Fin Oper
?>