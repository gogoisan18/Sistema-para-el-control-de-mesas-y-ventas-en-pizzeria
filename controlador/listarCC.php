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
		$entidad  = 'tiket
					INNER JOIN pagos ON tiket.tiketrPagoshIdE = pagos.pagosrIdE
					INNER JOIN usuarios ON pagos.usuario = usuarios.usuCedulaC
					INNER JOIN cuentas ON pagos.pagosrCuentarIdE = cuentas.cuentarIdE
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
                    
					
					$dsd = $objetoG->convertirFecha($_SESSION['dsd']); $hst = $objetoG->convertirFecha($_SESSION['hst']);
					$where = " where SUBSTR(pagos.fechahora,1,10) BETWEEN '".$dsd."' and '".$hst."' ";

					
					
					
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

					$campos = " registros.registrorNumMesas as mesa,
							   SUBSTR(pagos.fechahora,1,10) AS fecha,
							   pagos.pagosrHora AS hora,
							   CONCAT(usuarios.usuNombreC,' ',usuarios.usuApellidoC) AS cajero,
							   pagos.pagosrMontoFinalD as monto,
							   tiket.tiketrIdE as id";
			
					
					///******* Sentencia SQL para mostrar Registros
					$registros = $objetoG->consultaGeneral($entidad, $where,'tiketrIdE', 'desc', $inicio, $limite, $campos);
										
					$responce = new stdClass;          
					$responce->page    = $pag;
					$responce->total   = $total_pag;
					$responce->records = $cantidad;
					$i=0;

					foreach ($registros as $row) {
						$fecha = $objetoG->convertirFecha($row['fecha']);
						$tick=(int)$row['id'];
						
						$responce->rows[$i]['id'] = $row['id'];
						$responce->rows[$i]['cell'] = array(
							$row['id'],
							'<a class=imprimir name='.$tick.' href="#"><img src=../images/impresora.png style=width:28px; border:none; height:25px title=Imprimir Ticket alt=Impresora /></a>',
							$row['mesa'],
							$fecha,
							$row['hora'],
							$row['cajero'],
							$row['monto']
							
						);
						$i++;
					}
					echo json_encode($responce);
				break;
		}

//***** Fin Oper
?>