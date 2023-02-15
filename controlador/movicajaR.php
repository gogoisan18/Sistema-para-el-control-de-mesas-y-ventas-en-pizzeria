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
		
		include ("../modelo/movicajaR.class.php");
		$objeto = new movicajaR;
		$objeto->con->BaseDatos = $base; //Base de Datos


		$entidad = 'movimiento_caja
					left JOIN egresos_caja ON movimiento_caja.movimcajarEgresoIdE = egresos_caja.egresoIdE
					left JOIN pagos ON movimiento_caja.movimcajarIngrePagoId = pagos.pagosrIdE';	
							
		foreach ($_POST as $variable => $valor){
		  $$variable = $valor;
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
		
	//***Fin de Parametros

	switch ($oper) {
		case 'agregar':
		    
			$fechaEgre = gmdate("Y-m-d");
			$ret = $objeto->agregar($idegre,$fechaEgre,$montoegre,$obseregres,$desegreso);
			echo $ret;
		break;

		case 'modifi':
		    $fechaEgre = gmdate("Y-m-d");
			$accion = $objeto->editar($idmovi,$idegre,$fechaEgre,$montoegre,$obseregres,$desegreso);
			echo $accion;
		break;
		
			
		case 'autocompletar':

				    $where = "where egresoDescripC like '%" . $term  . "%' ";
					$enti = 'egresos_caja';
					$accion = $objetoG->consultaGeneral($enti, $where, 'egresoDescripC', 'asc', 0, 8);
					$responce='';
				
				  if(count($accion)>0){
						foreach($accion as $row){
					
						  $responce[] = array(
								'label'    => $row['egresoDescripC'],
								'value'    => $row['egresoDescripC'],
								'idegr'    => (int)$row['egresoIdE'],
								'evaluo'   => 1
							);
						 }
				  }else{
						$responce[] = array(
							
							'label'    	  => $term .'Egreso No Existe',
							'value'    	  => '',
							'idegr'       => '',
							'evaluo'      => 0
						);
				 }
				echo json_encode($responce);		
		break;	

        case 'buscar_infor':
			      
				  $csql="SELECT
							movimiento_caja.movimcajarIdE,
							movimiento_caja.movimcajarFechaF,
							movimiento_caja.movimcajarEgresoIdE,
							movimiento_caja.movimcajarMontoD,
							movimiento_caja.movimcajarObserC,
							egresos_caja.egresoDescripC
						FROM
							movimiento_caja
						INNER JOIN egresos_caja ON movimiento_caja.movimcajarEgresoIdE = egresos_caja.egresoIdE


				  WHERE movimcajarIdE = '".$term."' ";
				  $accion = $objetoG->ejecutarcomando($csql);
			
				  $salida='';
				
				  if(count($accion)>0){
						foreach($accion as $row){
						    $idegx = (int)$row['movimcajarIdE'];
							$salida = $idegx.'||'.$row['movimcajarEgresoIdE'].'||'.$row['movimcajarMontoD'].'||'.$row['egresoDescripC'].'||'.$row['movimcajarObserC'];
						}	
				  }
				echo $salida;
		break;
		
		default:	
			
			///******* contruccion de variable where		
				$ops = array(  //array to translate the search type
					'eq'=>'=', //equal
					'ne'=>'<>',//not equal
					'lt'=>'<', //less than
					'le'=>'<=',//less than or equal
					'gt'=>'>', //greater than
					'ge'=>'>=',//greater than or equal
					'bw'=>'LIKE', //begins with
					'bn'=>'NOT LIKE', //doesn't begin with
					'in'=>'LIKE', //is in
					'ni'=>'NOT LIKE', //is not in
					'ew'=>'LIKE', //ends with
					'en'=>'NOT LIKE', //doesn't end with
					'cn'=>'LIKE', // contains
					'nc'=>'NOT LIKE'  //doesn't contain
				);
				function getWhereClause($col, $oper, $val){
					global $ops;
					if($oper == 'bw' || $oper == 'bn') $val .= '%';
					if($oper == 'ew' || $oper == 'en' ) $val = '%'.$val;
					if($oper == 'cn' || $oper == 'nc' || $oper == 'in' || $oper == 'ni') $val = '%'.$val.'%';
					return  $where = " WHERE $col {$ops[$oper]} '$val' ";
					
				} 
				
				
				if ($_GET['_search'] == 'true') {
				
					$searchField = isset($_GET['searchField']) ? $_GET['searchField'] : false;
					$searchOper = isset($_GET['searchOper']) ? $_GET['searchOper']: false;
					$searchString = isset($_GET['searchString']) ? $_GET['searchString'] : false;
					$where = getWhereClause($searchField,$searchOper,$searchString);
					
				}
		     
			    //$where = "where consumoshServDescripC = 'HOSPEDAJE'";filters: 
				$where = "";
				
				$cantidad = $objetoG->cantidadReg($entidad, $where);
				$total_pag = $objetoG->totalPagina($cantidad, $limite);
				$inicio = $objetoG->inicioPagina($pag, $total_pag, $limite);
				
					
				$registros = $objetoG->consultaGeneral($entidad,$where,$ord,$dir,$inicio,$limite);
				
				$responce = new stdClass;          
				$responce->page    = $pag;
				$responce->total   = $total_pag;
				$responce->records = $cantidad;
				$i=0;
				
				foreach ($registros as $row) {
				
	        //colNames:['idcaja','idegreso','Fecha','Egreso','Ingreso','Forma de Pago','Monto','Observaci&oacute;n'], 					
					
					$movimcajahFechaF = $objetoG->convertirFecha($row['movimcajarFechaF']);
				   
					
					$responce->rows[$i]['id']=$row['movimcajarIdE'];
					$responce->rows[$i]['cell']=array(
							$row['movimcajarIdE'],
							$row['egresoIdE'],
							$movimcajahFechaF,
							$row['movimcajarDescEgres'],	
							$row['movimcajarDescPago'],
							/*$row['pagoshformaPago'],*/
							$row['movimcajarMontoD'],
							$row['movimcajarObserC']
					);
					$i++;
				} 
				echo json_encode($responce);
			break;
	}	

?>