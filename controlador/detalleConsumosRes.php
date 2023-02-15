<?php
session_start();
if (isset($_SESSION['usuId'])){
			$usuario = $_SESSION['usuId'];
			$base = 'pizzeria';
}else{
			header('Location:index.php');
}
	
	include ("../modelo/detalleconsumosres.class.php");
	$objeto = new consumosres;
	$objeto->con->BaseDatos = $base; //Base de Datos

		$entidad = "cuentas
					INNER JOIN registros ON cuentas.cuentarRegistrorIdE = registros.registrorIdE";
						
		foreach ($_POST as $variable => $valor){
		  $$variable = htmlspecialchars($valor);
		}
		
	
	/*****Paginador*********/
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
      
	
		
		case 'chequear_consumos':
		
		          if($caso==1){
					$salida = $objeto->registrarconsumostempo($idcon,$cuentax,$montotemp);
				  }else if($caso==2){
					$salida = $objeto->eliminarconsumostempo($idcon,$cuentax);
				  }else if($caso==3){
					$salida = $objeto->elimiconsumtempo($cuentax);
				  }
				  		  
				  $sql = "SELECT
								consumostemporales.tempconsuCuentarIdE,
								sum(consumostemporales.tempconsuTotal) as acumulado
							FROM
								consumostemporales
								
							where tempconsuCuentarIdE = '".$cuentax."'	
							GROUP BY tempconsuCuentarIdE";
							
				  $acci = $objeto->ejecutarcomando($sql);
				  $sumtem=0;
				  foreach($acci as $row){
					$sumtem = $row['acumulado'];
				  }
				  echo $sumtem;

		break;
		
		case 'actualizardesh':  

			$res = $objeto->editardescuento($idre,$total,$descuento);
			echo $res;
			
		break;
		
		case 'actualizarecargah':  

			$res = $objeto->actualizarecargah($idre,$total,$recarga);
			echo $res;
			
		break;

		
		case 'autocompletar_tipotarjeta':

			    $sql = "SELECT
								tipotarjeta.tipotarjeDescrip,
								bancos.bancoDescripC
							FROM
								tipotarjeta
							INNER JOIN bancos ON tipotarjeta.tipotarjeBancoId = bancos.bancoIdE
															
							where tipotarjeDescrip like '%".$term."%' or bancoDescripC like '%".$term."%' ";
				//echo $sql;			
				$acci = $objeto->ejecutarcomando($sql);
				  
		
				$responce='';
				
				foreach($acci as $row){
									
					  $salida = $row['tipotarjeDescrip'].' -- '.$row['bancoDescripC'];
					  $responce[] = array(
							'label'    	=> $salida,
							'value'     => $row['tipotarjeDescrip'],
							'banco'     => $row['bancoDescripC'],
							'evaluo'    => 1
						);
					 }
					  if (count($accion) == 0) {
						$responce[] = array(
							
							'label'    	 => $term .' Datos no registrados',
							'value'    	 => $term ,
							'banco'      => '',
							'evaluo'     => 0
						);
				 }
				
				echo json_encode($responce);
						
		break;
		
		case 'autocompletar_banco':

			    $sql = "SELECT 	bancoDescripC FROM 	bancos
																						
						where  bancoDescripC like '%".$term."%' ";
						
				$acci = $objeto->ejecutarcomando($sql);
				  
		
				$responce='';
				
				foreach($acci as $row){
				
					  $responce[] = array(
							'label'    	=> $row['bancoDescripC'],
							'value'     => $row['bancoDescripC'],
							'evaluo'    => 1
						);
					 }
					  if (count($acci) == 0) {
						$responce[] = array(
							
							'label'    	 => $term .' Datos no registrados',
							'value'    	 => $term ,
							'evaluo'     => 0
						);
				 }
				
				echo json_encode($responce);
						
		break;
		
		case 'emitirTF':
                                 
                              
				$salida = $objeto->realizarpago($contclienx,$tipofactux,$cuentax,$tipocanx,$deescuentox,$reecargax,$montodeux,$tipopagox,$grupoanter,$grupo,$ixregx,$tipotarjx,$bancox,$usuario);
				 
				echo $salida;
				          // 1      --      10    --    1        --        1       --       1      --    1890.00   --       1      --               --     14328876  --ISMAR ISMAR--CON DIRECCION--       NADA  --               --    1     --     10    --04123693636--              --
				//echo $tipofactux.'--'.$cuentax.'--'.$tipocanx.'--'.$deescuentox.'--'.$reecargax.'--'.$montodeux.'--'.$tipopagox.'--'.$contclienx.'--'.$ceduclifx.'--'.$nomclix.'--'.$direclix.'--'.$observax.'--'.$grupoanter.'--'.$grupo.'--'.$ixregx.'--'.$telfcx.'--'.$tipotarjx.'--'.$bancox;
		break;
		
		default:
			if ($_SESSION['logeado'] == true) {
				        
					$wherey="where controlRegistrorIdE = '".$_SESSION['regisResx']."' and controlEstatusE = 'Por Cancelar' ";
					
					$sql = "SELECT
								consumos.controlId,
								consumos.controlRegistrorIdE,
								consumos.controlDescripPlato,
								consumos.controlCantPlato,
								consumos.controlPrecioPlato,
								consumos.controlTotal,
								consumos.controlEstatusE
							FROM consumos
							INNER JOIN registros ON consumos.controlRegistrorIdE = registros.registrorIdE
												
							$wherey order by controlDescripPlato asc";
			        //echo $sql;
					$eje = $objeto->ejecutarcomando($sql);		
							
				
					$cantidad = count($eje);
					$total_pag = $objeto->totalPagina($cantidad, $limite);
					$inicio = $objeto->inicioPagina($pag, $total_pag, $limite);

					$responce = new stdClass;          
					$responce->page    = $pag;
					$responce->total   = $total_pag;
					$responce->records = $cantidad;
					$i=0;
					foreach($eje as $row){
					
							$responce->rows[$i]['id']=(int)$row['controlId'];
							$responce->rows[$i]['cell']=array(
                                                    (int)$row['controlId'],                                                
													$row['controlDescripPlato'],
													$row['controlPrecioPlato'],
													$row['controlCantPlato'],
													$row['controlTotal'],
													$row['controlEstatusE']												
                                                    );
													$i++;
					}    
					echo json_encode($responce);
				//}
			}else{
				require('index.php');
			}
			break;
	}	
	/***Fin Oper*****/
?>