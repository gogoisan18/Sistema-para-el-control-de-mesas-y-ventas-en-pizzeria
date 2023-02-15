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
	include ("../modelo/retorno.class.php");
	$objeto = new retorno;
	$objeto->con->BaseDatos = $base; //Base de Datos
	
	//Parametros
		$entidad  = 'entrega_articulos
					INNER JOIN personal ON entrega_articulos.entregaPerCedulaC = personal.perCedulaC
					INNER JOIN articulos ON entrega_articulos.entregaArticuloId = articulos.articuloIdE
					INNER JOIN marcas ON articulos.articuloMarcasIdE = marcas.marcasIdE
					INNER JOIN articulotipo ON articulos.articuloArticulotipoIdE = articulotipo.articulotipoIdE';

		
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
		
			
		case 'editar':
						/*identreartx:identreartx,
							idoartx:idoartx,
							observretornx:observretornx,
							candevueltax:candevueltax,
							cantiAdevx:cantiAdevx,
							pordevolverx:pordevolverx*/
							
				 $res = $objeto->editar($identreartx,$idoartx,$observretornx,$candevueltax,$cantiAdevx,$pordevolverx);
				 echo $res;
				
		break;
		

		case 'buscar_infor':
			      
				  $csql="SELECT
							personal.perCedulaC,
							personal.perNombreC,
							personal.perApellidoC,
							articulos.articuloDescripcionC,
							marcas.marcasDescripcionC,
							articulotipo.articulotipoDescripcionC,
							entrega_articulos.entregaCantidad,
							entrega_articulos.entregaFecha,
							articulos.articulocirculante,
							entrega_articulos.entregaId,
							articulos.articuloIdE,
							entrega_articulos.entregadevuelta,
							entrega_articulos.entregacanXdevolver,
							entrega_articulos.entregaObserva
							
						FROM
						entrega_articulos
						INNER JOIN personal ON entrega_articulos.entregaPerCedulaC = personal.perCedulaC
						INNER JOIN articulos ON entrega_articulos.entregaArticuloId = articulos.articuloIdE
						INNER JOIN marcas ON articulos.articuloMarcasIdE = marcas.marcasIdE
						INNER JOIN articulotipo ON articulos.articuloArticulotipoIdE = articulotipo.articulotipoIdE
											
						WHERE articuloIdE = '".$term."'";
		
				  $accion = $objetoG->ejecutarcomando($csql);
			
				  $salida='';
				
				  if(count($accion)>0){
						foreach($accion as $row){
				       				
							$nombres = $row['perNombreC'].' '.$row['perApellidoC'];
							
							$salida = (int)$row['articuloIdE'].'||'.(int)$row['entregaId'].'||'.$row['articuloDescripcionC'];
							$salida.= '||'.$row['marcasDescripcionC'].'||'.$row['articulotipoDescripcionC'].'||'.$row['entregaCantidad'];
							$salida.= '||'.$nombres.'||'.$row['perCedulaC'].'||'.$row['entregadevuelta'].'||'.$row['entregacanXdevolver'].'||'.$row['entregaObserva'];
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
                    
			
					$where="where articulocirculante = 'Si'";
					
					
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
						
					//colNames:['Código','idart','Personal','Fecha Entrega','Descripción','Marca','Tipo de Artículo','Cantidad'],
						$responce->rows[$i]['id'] = $row['entregaId'];
						$responce->rows[$i]['cell'] = array(
							$row['entregaId'],
							$row['articuloIdE'],
							$row['perNombreC'].' '.$row['perApellidoC'],
							$row['entregaFecha'],
							$row['articuloDescripcionC'],
							$row['marcasDescripcionC'],
							$row['articulotipoDescripcionC'],
							$row['entregaCantidad']
							
						);
						$i++;
					}

					echo json_encode($responce);
							
				break;
		}

//***** Fin Oper
?>