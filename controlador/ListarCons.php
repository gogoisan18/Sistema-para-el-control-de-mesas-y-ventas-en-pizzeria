<?php
session_start();
 
    $base = 'pizzeria';
	include ("../compartida/funciones/funciones.class.php");
	$objetoG = new funciones;
	$objetoG->con->BaseDatos = $base; //Base de Datos
	

	include ("../modelo/listarCC.class.php");
	$objeto = new listarCC;
	$objeto->con->BaseDatos = $base; //Base de Datos
	
	//Parametros
		$entidad  = 'cuentas
							INNER JOIN consumos ON cuentas.cuentarRegistrorIdE = consumos.controlRegistrorIdE
							INNER JOIN registros ON cuentas.cuentarRegistrorIdE = registros.registrorIdE';

		
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
                    
					
					
					$where = " where cuentas.cuentarEstatusE='Abierta'";

					
					
					
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

					$campos = " cuentas.cuentarMontoDescuentoMovimiento as descuento,
								cuentas.cuentarMontoRecargaMovimiento as recarga,
								cuentas.cuentarMontoTotalD as total,
								registros.registrorNumMesas as mesa,
								cuentas.cuentarIdE as id,
								registros.registrorFechaF as fecha";
			
					
					///******* Sentencia SQL para mostrar Registros
					$grupo='cuentarIdE';
					$registros = $objetoG->consultaGeneral($entidad, $where, $ord, $dir, $inicio, $limite, $campos, $grupo);
										
					$responce = new stdClass;          
					$responce->page    = $pag;
					$responce->total   = $total_pag;
					$responce->records = $cantidad;
					$i=0;
				
					foreach ($registros as $row) {
											
						$cuenta=(int)$row['id'];
						
						$responce->rows[$i]['id'] = $row['id'];
						$responce->rows[$i]['cell'] = array(
							$row['id'],
							'<a class=ver name='.$cuenta.' href="#"><img src=../images/ver1.png style=width:28px; border:none; height:25px title=Ver Cuenta alt=Ver /></a>',
							$row['mesa'],
							$row['descuento'],							
							$row['recarga'],
							$row['total']
							
						);
						$i++;
					}
					echo json_encode($responce);
				break;
		}

//***** Fin Oper
?>