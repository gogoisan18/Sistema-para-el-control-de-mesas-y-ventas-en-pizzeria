<?php
session_start();
 
     $base = 'pizzeria';
	//Incluir las Clases y Objetos
	include ("../compartida/funciones/funciones.class.php");
	$objetoG = new funciones;
	$objetoG->con->BaseDatos = $base; //Base de Datos
	
	//Incluir las Clases y Objetos
	include ("../modelo/licores.class.php");
	$objeto = new licores;
	$objeto->con->BaseDatos = $base; //Base de Datos
	
	//Parametros
		$entidad  = 'licores';

		
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
		

switch ($oper) {

			case 'agregar':
									
				$existe = $objetoG->cantidadReg($entidad," Where licoresDescripC = '" . $descrix . "' ");
              
				if($existe>0){
					echo ('Ya existe un licor registrado con este nombre');
				}else{
										
					$res = $objeto->agregar($precioplatox,$descrix);
					echo $res;
				}
				                 
			break;

			case 'modificar':
								 
					 $res = $objeto->editar($idLicoresx,$precioplatox,$descrix);
					 echo $res;
					 //echo $idplx.'--'.$precioplatox.'--'.$descrix;
							
			break;
			
			case 'eliminar':
									 
					 $res = $objeto->eliminar($idLicoresx);
					 echo $res;
					
			break;
			
			case 'buscar_infor':
			      
				  $csql="SELECT * from licores WHERE licoresIdE = '".$term."' ";
		
				  $accion = $objetoG->ejecutarcomando($csql);
			
				  $salida='';
				
				  if(count($accion)>0){
						foreach($accion as $row){
				
							$salida = (int)$row['licoresIdE'].'||'.$row['licoresDescripC'].'||'.$row['licoresPrecioD'];
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
                    
			
					$where=" WHERE licoresEstatusE='Disponible' ";
					
					
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
						//colNames:['id','Descripci??n','Precio'],
						
						$responce->rows[$i]['id'] = $row['licoresIdE'];
						$responce->rows[$i]['cell'] = array(
							$row['licoresIdE'],
							$row['licoresDescripC'],
							$row['licoresPrecioD']
							
						);
						$i++;
					}
					echo json_encode($responce);
				break;
		}

//***** Fin Oper
?>