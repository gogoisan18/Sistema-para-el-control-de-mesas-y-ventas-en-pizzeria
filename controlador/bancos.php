<?php
session_start();
 
     $base = 'pizzeria';
	//Incluir las Clases y Objetos
	include ("../compartida/funciones/funciones.class.php");
	$objetoG = new funciones;
	$objetoG->con->BaseDatos = $base; //Base de Datos
	
	//Incluir las Clases y Objetos
	include ("../modelo/bancos.class.php");
	$objeto = new bancos;
	$objeto->con->BaseDatos = $base; //Base de Datos
	
	//Parametros
		$entidad = 'bancos';

		
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
		

switch ($oper) {

			case 'agregar':
				
				
                $existe1 = $objetoG->cantidadReg($entidad," Where bancoDescripC = '" . $xbanco . "' ");
				 
				if($existe>0){
					$res = 'Ya existe un Banco registrado con este nombre: '.$xbanco;
				}else{					
					$res = $objeto->agregar($xbanco);
				}
				 echo $res;                
			break;

			case 'modificar':
					 
					 $res = $objeto->editar($xidban,$xbanco);
					 echo $res;
					
			break;
			
			case 'eliminar':
									 
					 $res = $objeto->eliminar($xidban);
					 echo $res;
					
			break;
			
						
			case 'buscar_infor':
			      
				  $csql="SELECT * from bancos  WHERE bancoIdE = '".$term."' ";
		
				  $accion = $objetoG->ejecutarcomando($csql);
			
				  $salida='';
				
				  if(count($accion)>0){
						foreach($accion as $row){
							$salida = (int)$row['bancoIdE'].'||'.$row['bancoDescripC'];
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
						
										
						$responce->rows[$i]['id'] = $row['bancoIdE'];
						$responce->rows[$i]['cell'] = array(
							$row['bancoIdE'],
							$row['bancoDescripC']
							
						);
						$i++;
					}

					echo json_encode($responce);
					///******* Fin Sentencia SQL para mostrar Registros
				
				break;
		}

//***** Fin Oper
?>