<?php
session_start();
if (isset($_SESSION['usuId'])){
			$usuario = $_SESSION['usuId'];
			$base = 'pizzeria';
}else{
			header('Location:../index_org.php');
}
   

	//Incluir las Clases y Objetos
	include ("../compartida/funciones/funciones.class.php");
	$objetoG = new funciones;
	$objetoG->con->BaseDatos = $base; //Base de Datos
	
	//Incluir las Clases y Objetos
	include ("../modelo/personal.class.php");
	$objeto = new personal;
	$objeto->con->BaseDatos = $base; //Base de Datos
	
	//Parametros
		$entidad  = 'personal';

		
		foreach ($_POST as $variable => $valor){
		  $$variable = htmlspecialchars($valor);
		}
		
		//**********Paginador		
		if (isset($_GET['oper'])) // get oper a ejecutar
			$oper   = $_GET['oper'];
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
									
			$existe  = $objetoG->cantidadReg($entidad," Where perCedulaC = '" . $cedup . "' ");
			$estatus = $_SESSION['tipoest'];
			 
			if($existe>0){
				echo ('Ya existe una persona registrada con la cédula '.$cedup);
			}else if($estatus==''){
				echo ('Por favor seleccione un estatus');
			}else{
					  /*if($tipo=='1'){ $tipox = 'Limpieza';}
				 else if($tipo=='2'){ $tipox = 'Cocinero';}
				 else if($tipo=='3'){ $tipox = 'Vigilante';}
				 else if($tipo=='4'){ $tipox = 'Jardinero';}
				 else if($tipo=='5'){ $tipox = 'Obrero';}
				 else if($tipo=='6'){ $tipox = 'Otro';}*/
				   
					  if($estatus=='1'){ $estatusx = 'Activo';}
				 else if($estatus=='2'){ $estatusx = 'Inactivo';}
				 
					  if($edociv=='1'){ $edocivx = 'Soltero';}
				 else if($edociv=='2'){ $edocivx = 'Casado';}
				 else if($edociv=='3'){ $edocivx = 'Divorciado';}
				 else if($edociv=='4'){ $edocivx = 'Viudo';}
				 
				/* <option value="0">Seleccione</option>
				<option value="1">Soltero(a)</option>
				<option value="2">Casado(a)</option>
				<option value="3">Divorciado(a)</option>
				<option value="4">Viudo(a)</option>
				
				'Soltero','Casado','Divorciado','Viudo'*/
		        $fechanX = $objetoG->convertirFecha($fechan);
				
				$res = $objeto->agregar($cedup,$nombp,$apellp,$tipo,$tlf1p,$tlf2p,$fechanX,$idxprro,$edocivx,$direcc,$estatusx);
				echo $res;
			}
							 
		break;
	
		case 'modificar':
			
				$estatus = $_SESSION['tipoest'];
					 if($estatus=='1' or $estatus==''){ $estatusx = 'Activo';}
				else if($estatus=='2'){ $estatusx = 'Inactivo';}
		
			
					  /*if($tipo=='1'){ $tipox = 'Limpieza';}
				 else if($tipo=='2'){ $tipox = 'Cocinero';}
				 else if($tipo=='3'){ $tipox = 'Vigilante';}
				 else if($tipo=='4'){ $tipox = 'Jardinero';}
				 else if($tipo=='5'){ $tipox = 'Obrero';}
				 else if($tipo=='6'){ $tipox = 'Otro';}*/
				 
					  if($edociv=='1'){ $edocivx = 'Soltero';}
				 else if($edociv=='2'){ $edocivx = 'Casado';}
				 else if($edociv=='3'){ $edocivx = 'Divorciado';}
				 else if($edociv=='4'){ $edocivx = 'Viudo';}
				 
				 $fechanX = $objetoG->convertirFecha($fechan);
				 $res = $objeto->editar($cedup,$nombp,$apellp,$tipo,$tlf1p,$tlf2p,$fechanX,$idxprro,$edocivx,$direcc,$estatusx);
				 echo $res;
				
		break;
		

		case 'buscar_infor':
			      
				  $csql="SELECT
							personal.perCedulaC,personal.perNombreC,
							personal.perApellidoC,parroquia.parrDescripcionC,
							municipio.muniDescripcionC,estado.edoDescripcionC,
							personal.perFechaNacF,personal.perEdoCivilE,
							personal.perTelf1CelC,personal.perTelf2CelC,
							personal.perParrIdE,personal.perDireccC,
							personal.perTipoE,personal.perEstatusE,parroquia.parrIdC
						FROM
						personal
						INNER JOIN parroquia ON personal.perParrIdE = parroquia.parrIdC
						INNER JOIN municipio ON parroquia.parrMuniIdC = municipio.muniIdC
						INNER JOIN estado ON municipio.muniEdoIdC = estado.edoIdC 

						WHERE perCedulaC = '".$term."' ";
		
				  $accion = $objetoG->ejecutarcomando($csql);
			
				  $salida='';
				
				  if(count($accion)>0){
						foreach($accion as $row){
				            $fech = $objetoG->convertirFecha($row['perFechaNacF']);
							$parro = $row['parrDescripcionC'].' '.$row['muniDescripcionC'].' '.$row['edoDescripcionC'];
							
							$salida = $row['perCedulaC'].'||'.$row['perNombreC'].'||'.$row['perApellidoC'];
							$salida.= '||'.$row['perTelf1CelC'].'||'.$row['perTipoE'].'||'.$row['perEstatusE'];
							$salida.= '||'.$row['perTelf2CelC'].'||'.$fech.'||'.$parro.'||'.$row['parrIdC'];
							$salida.= '||'.$row['perDireccC'].'||'.$row['perEdoCivilE'];
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
                    
			       
					
					if ($_GET['_search'] == 'true') {
						$searchField = isset($_GET['searchField']) ? $_GET['searchField'] : false;
						$searchOper = isset($_GET['searchOper']) ? $_GET['searchOper'] : false;
						$searchString = isset($_GET['searchString']) ? $_GET['searchString'] : false;
						$where = getWhereClause($searchField, $searchOper, $searchString);
					}
					///******* Fin contruccion de variable where
					if($_SESSION['existe']=="Mesonero"){
						$where="where perTipoE = 'Mesonero'";
					}else
						$where="";			
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
						
					//colNames:['C&eacute;dula','Nombre','Apellido','Tel&eacute;fono','Tipo','Estatus'],					
						$responce->rows[$i]['id'] = $row['perCedulaC'];
						$responce->rows[$i]['cell'] = array(
							$row['perCedulaC'],
							$row['perNombreC'],
							$row['perApellidoC'],
							$row['perTelf1CelC'],
							$row['perTelf2CelC'],
							$row['perTipoE'],
							$row['perEstatusE']
							
						);
						$i++;
					}

					echo json_encode($responce);
					///******* Fin Sentencia SQL para mostrar Registros
				
				break;
		}

//***** Fin Oper
?>