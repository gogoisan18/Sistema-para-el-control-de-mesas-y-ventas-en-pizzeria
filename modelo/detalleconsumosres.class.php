<?php
include_once("../compartida/funciones/funciones.class.php");

class consumosres extends funciones {
    
	function editardescuento($idre,$total,$descuento) {
		if ($this->con->conectar() == true) { 
		
		        $Sqlf = "SELECT
							cuentas.cuentarMontoTotalD,
							cuentas.cuentarMontoRecargaD,
							cuentas.cuentarMontoDescuentoD,
							cuentas.cuentarMontoRecargaMovimiento,
							cuentas.cuentarMontoDescuentoMovimiento,
							cuentas.cuentarMontoTotalMovimiento,
							cuentas.cuentarMontoD,
							cuentas.cuentarMontoMovimiento
						FROM
							cuentas
						where cuentarRegistrorIdE = '".$idre."' ";
							
				$resultf = mysql_query($Sqlf)  or die (mysql_error());
			    $row = mysql_fetch_assoc($resultf);
										
				$montoo = ($row['cuentarMontoD']+$row['cuentarMontoRecargaD'])-$descuento;
				$montoM = ($row['cuentarMontoMovimiento']+$row['cuentarMontoRecargaMovimiento'])-$descuento;
							
				$Sql = "UPDATE cuentas
						SET 
							cuentarMontoDescuentoD  = '".$descuento."',
							cuentarMontoTotalD = '".$montoo."',
							cuentarMontoTotalMovimiento = '".$montoM."', 
							cuentarMontoDescuentoMovimiento = '".$descuento."'
							
						WHERE cuentarRegistrorIdE = '".$idre."' ";
				$result= mysql_query($Sql)  or die (mysql_error());	
				$this->con->desconectar();
				return $result;
			
		}
			
	}
	
	function actualizarecargah($idre,$total,$recarga) {
		if ($this->con->conectar() == true) { 
							
				 $Sqlf = "SELECT
							cuentas.cuentarMontoTotalD,
							cuentas.cuentarMontoRecargaD,
							cuentas.cuentarMontoDescuentoD,
							cuentas.cuentarMontoRecargaMovimiento,
							cuentas.cuentarMontoDescuentoMovimiento,
							cuentas.cuentarMontoTotalMovimiento,
							cuentas.cuentarMontoD,
							cuentas.cuentarMontoMovimiento
						FROM
							cuentas
						where cuentarRegistrorIdE = '".$idre."' ";
							
				$resultf = mysql_query($Sqlf)  or die (mysql_error());
			    $row = mysql_fetch_assoc($resultf);
										
				$montoo = ($row['cuentarMontoD']+$recarga)-$row['cuentarMontoDescuentoD'];
				$montoM = ($row['cuentarMontoMovimiento']+$recarga)-$row['cuentarMontoDescuentoMovimiento'];
										
				$Sql = "UPDATE cuentas
						SET 
							cuentarMontoRecargaD  = '".$recarga."',
							cuentarMontoTotalD = '".$montoo."',
							cuentarMontoTotalMovimiento = '".$montoM."', 
							cuentarMontoRecargaMovimiento = '".$recarga."'
							
						WHERE cuentarRegistrorIdE = '".$idre."' ";
				$result= mysql_query($Sql)  or die (mysql_error());	
				$this->con->desconectar();
				return $result;
				
		}
	}
	
	function registrarconsumostempo($idcon,$cuentax,$montotemp){
		
		if ($this->con->conectar() == true) { 
								
				$enti = "consumostemporales";
				$where = "where tempconsuCuentarIdE = '".$cuentax."' and  tempconsuConsumosrIdE = '".$idcon."' ";
				
				$resultado=mysql_query("SELECT COUNT(*) as cant FROM $enti $where" ) or die (mysql_error());
			    $cant=mysql_fetch_array($resultado);
			   	  
				if($cant['cant']==0){
				
					$Sql = "INSERT INTO consumostemporales (tempconsuCuentarIdE,tempconsuConsumosrIdE,tempconsuTotal) 
					VALUES ('".$cuentax."','".$idcon."','".$montotemp."')";
					$result= mysql_query($Sql)  or die (mysql_error());
					
					$this->con->desconectar();
					return $result;
				}else{
					$this->con->desconectar();
				}
		}
	}
	
	function eliminarconsumostempo($idcon,$cuentax){
		
		if ($this->con->conectar() == true) { 
		
				
				$Sql = "DELETE FROM consumostemporales 
						where tempconsuCuentarIdE = '".$cuentax."' and
						      tempconsuConsumosrIdE = '".$idcon."'";
				$result= mysql_query($Sql)  or die (mysql_error());
				
				$this->con->desconectar();
				return $result;
		}
	}
	
	function elimiconsumtempo($cuentax){
		
		if ($this->con->conectar() == true) { 
		
				
				$Sql = "DELETE FROM consumostemporales 
						where tempconsuCuentarIdE = '".$cuentax."'";
				$result= mysql_query($Sql)  or die (mysql_error());
				
				$this->con->desconectar();
				return $result;
		}
	}
	
	function realizarpago($contclienx,$tipofactux,$cuentax,$tipocanx,$deescuentox,$reecargax,$montodeux,$tipopagox,$grupoanter,$grupo,$ixregx,$tipotarjx,$bancox,$usuario){
		
		if ($this->con->conectar() == true) { 
						
					
							
				$Sqlde = "SELECT
							cuentas.cuentarMontoDescuentoMovimiento,
							cuentas.cuentarMontoRecargaMovimiento,
							cuentas.cuentarMontoTotalD,
							registros.registrorNumMesas,
							cuentas.cuentarMontoTotalMovimiento
							
							FROM
							cuentas
							INNER JOIN consumos ON cuentas.cuentarRegistrorIdE = consumos.controlRegistrorIdE
							INNER JOIN registros ON cuentas.cuentarRegistrorIdE = registros.registrorIdE
							
							where cuentarIdE = '".$cuentax."'
							GROUP BY cuentarIdE";

				$resultde = mysql_query($Sqlde)  or die (mysql_error());
				$rowde = mysql_fetch_assoc($resultde);

								
				if($tipocanx==1){
				
						$monto = ($montodeux+$reecargax)-$deescuentox;
						$rest=0;
						$deescu = 0;
						$reecar = 0;
						$deescupago = 'Si';
						$reecarpago = 'Si';
				
				}else{
					$rest=$rowde['cuentarMontoTotalMovimiento']-$montodeux;
						if($deescuentox==1 and $reecargax==1){
							$monto = ($montodeux+$reecargax)-$deescuentox;
							$deescu = 0;
							$reecar = 0;
							
							$deescupago = 'Si';
							$reecarpago = 'Si';
							
						}else if($deescuentox==1 and $reecargax==0){
							$monto = $montodeux-$deescuentox;
							$deescu = 0;
							$reecar = $rowde['cuentarMontoRecargaMovimiento'];
							
							$deescupago = 'Si';
							$reecarpago = 'No';
							
						}else if($deescuentox==0 and $reecargax==1){
							$monto = $montodeux+$deescuentox;
							$deescu = $rowde['cuentarMontoDescuentoMovimiento'];
							$reecar = 0;
							$deescupago = 'No';
							$reecarpago = 'Si';
							
						}else if($deescuentox==0 and $reecargax==0){
							$monto = $montodeux;
							$deescu = $rowde['cuentarMontoDescuentoMovimiento'];
							$reecar = $rowde['cuentarMontoRecargaMovimiento'];
							
							$deescupago = 'No';
							$reecarpago = 'No';
						}
				
				}
					
			
					
					$fecha = gmdate("Y-m-d");
					$timezone = -5.5;
					$hora = gmdate("H:i:s", time() + 3600*($timezone+date("I")));
					$fechahora = gmdate("Y-m-d H:i:s", time() + 3600*($timezone+date("I")));
			
				        
						 if($tipopagox==1){ $forma = 'Efectivo';}
					else if($tipopagox==2){ $forma = 'Tarjeta de Débito';}
					else if($tipopagox==3){ $forma = 'Tarjeta de Crédito';}
					else if($tipopagox==4){ $forma = 'Cheque';}
					else if($tipopagox==5){ $forma = 'Transferencia';}
					else if($tipopagox==6){ $forma = 'Depósito';}
		
								
				$xxmonto =$monto+1;                       
				$Sql = "INSERT INTO pagos (pagosrCuentarIdE,pagosrDetallerGrupoE,pagosrTipopIdE,
						pagosrMontoFinalD,resta,
						pagosrNumTikCheDepC,pagosrFechaF,pagosrObservacionC,pagosrDescuento,pagosrRecarga,
						pagosrDescuentoMon,pagosrRecargaMon,pagosrformaPago,pagosrTipotarjeta,pagosrBanco,usuario,pagosrHora,fechahora)
										
				VALUES ('".$cuentax."','".$grupo."','".$tipopagox."','".$monto."','".$rest."',
						'".$contclienx."',
						'".$fecha."','','".$deescupago."','".$reecarpago."','".$rowde['cuentarMontoDescuentoMovimiento']."',
						'".$rowde['cuentarMontoRecargaMovimiento']."','".$forma."','".$tipotarjx."','".$bancox."','".$usuario."','".$hora."','".$fechahora."') ";
						
				$result= mysql_query($Sql)  or die (mysql_error());
				$ultimopago = mysql_insert_id();
				
				$obserCaja = 'PAGO PARCIAL O TOTAL DE LA CUENTA # '.$cuentax.', MESA # '.$rowde['registrorNumMesas'];
				
				$Sql = "INSERT INTO movimiento_caja (movimcajarFechaF,movimcajarIngrePagoId,movimcajarDescPago,movimcajarMontoD,movimcajarObserC) 
					VALUES ('".$fecha."','".$ultimopago."','".$obserCaja."','".$monto."','')";
				$result= mysql_query($Sql)  or die (mysql_error());
				
				if($tipocanx==1){
					$tipot = 'C';
				}else{
					$tipot = 'P';
				}			
				
				$Sql = "INSERT INTO tiket (tiketrFechaF,tiketrPagoshIdE,tiketrCuentahIdE,tipo,fechahora) 
				VALUES ('".$fecha."','".$ultimopago."','".$cuentax."','".$tipot."','".$fechahora."')";
				$result= mysql_query($Sql)  or die (mysql_error());
				$ultimoticket = mysql_insert_id();
				
				
				$Sql1 = "SELECT tempconsuConsumosrIdE FROM consumostemporales where tempconsuCuentarIdE = '".$cuentax."'";
				$result1  = mysql_query($Sql1)  or die (mysql_error());
				
				$secu = array();
				while ($registro = mysql_fetch_assoc($result1)){
					$secu[]=$registro;
				}
				
                if($tipocanx==2){
				
					 /*foreach($secu as $row){
					
						    $Sql = "update consumos set controlEstatusE = 'Cancelado' where controlId = '".$row['tempconsuConsumosrIdE']."' ";
						  
							$result= mysql_query($Sql)  or die (mysql_error());
						 
							$Sql = "update detallecuenta 
										set 
											detallerGrupoE = '".$grupo."'
											
									where detallerCuentarIdE = '".$cuentax."' and detallerIdConsumo = '".$row['tempconsuConsumosrIdE']."' ";
									
							$result= mysql_query($Sql)  or die (mysql_error());
					
					  }*/
					  
					  $Sql = "DELETE FROM consumostemporales where tempconsuCuentarIdE = '".$cuentax."'";
				      $result= mysql_query($Sql)  or die (mysql_error());
				}else{
				
				    $Sql11 = "SELECT controlId FROM consumos where controlEstatusE = 'Por Cancelar' and controlRegistrorIdE = '".$ixregx."'";
					$result11  = mysql_query($Sql11)  or die (mysql_error());
					
					$secu1 = array();
					while ($registro = mysql_fetch_assoc($result11)){
						$secu1[]=$registro;
					}
					
					foreach($secu1 as $row){
				 
						$Sql = "update detallecuenta 
									set 
										detallerGrupoE = '".$grupo."'
										
								where detallerCuentarIdE = '".$cuentax."' and detallerIdConsumo = '".$row['controlId']."'";
								
						$result= mysql_query($Sql)  or die (mysql_error());
					}
					
					$Sql = "update consumos set controlEstatusE = 'Cancelado' where controlRegistrorIdE = '".$ixregx."' ";
					$result= mysql_query($Sql)  or die (mysql_error());
				
				}
				
				 
				 $Sqlf = "SELECT
								sum(consumos.controlTotal) as total
							
							FROM
								consumos
							INNER JOIN registros ON consumos.controlRegistrorIdE = registros.registrorIdE
							INNER JOIN cuentas ON cuentas.cuentarRegistrorIdE = registros.registrorIdE

							where cuentarIdE = '".$cuentax."' and controlEstatusE = 'Por Cancelar'
							GROUP BY cuentarIdE";
							
				$resultf = mysql_query($Sqlf)  or die (mysql_error());
			    $row = mysql_fetch_assoc($resultf);
			
			    $total = $row['total'];
				//echo $total;	

				if($total==''){
					$Sql = "update cuentas 
							set 	cuentarEstatusE = 'Cerrada',
									cuentarMontoMovimiento = '0', 
									cuentarMontoDescuentoMovimiento = '0', 
									cuentarMontoRecargaMovimiento = '0',  
									cuentarMontoTotalMovimiento = '0'
						where cuentarIdE = '".$cuentax."' ";
			        $result= mysql_query($Sql)  or die (mysql_error());
				 
				    $Sql = "update mesas set mesasEstatusE = 'Libre' where mesasNum = '".$rowde['registrorNumMesas']."' ";
			        $result= mysql_query($Sql)  or die (mysql_error());
				}else{

					$Sqlpc = "SELECT
								cuentas.cuentarMontoMovimiento as deuda,
								cuentas.cuentarMontoTotalMovimiento as deuda1
								FROM
								cuentas

							where cuentarIdE = '".$cuentax."' and cuentarEstatusE = 'Abierta' ";
							
						$resultpc= mysql_query($Sqlpc)  or die (mysql_error());
					    $rowpc = mysql_fetch_assoc($resultpc);

					if($rowpc['deuda1']=='0.00'){
						$montoo = ($total+$reecar)-$deescu-$monto;
						$estado = 'Abierta';
					}else{
						if($rowpc['deuda1']==$monto){
							

							$Sql = "update consumos 
								set 
									controlEstatusE = 'Cancelado'
							where controlRegistrorIdE = '".$ixregx."' ";
			        		$result= mysql_query($Sql)  or die (mysql_error());

			        		$Sql = "update mesas set mesasEstatusE = 'Libre' where mesasNum = '".$rowde['registrorNumMesas']."' ";
			                $result= mysql_query($Sql)  or die (mysql_error());

			        		$montoo = $rowpc['deuda'];
							$estado = 'Cerrada';

						}else{
							$montoo = ($rowpc['deuda1']+$reecar)-$deescu-$monto;
							$estado = 'Abierta';
						}
						
					}
					
					$Sql = "update cuentas 
								set 
									cuentarEstatusE = '".$estado."',
									cuentarMontoMovimiento = '".$total."', 
									cuentarMontoDescuentoMovimiento = '".$deescu."', 
									cuentarMontoRecargaMovimiento = '".$reecar."', 
									cuentarMontoTotalMovimiento = '".$montoo."'
									
							where cuentarIdE = '".$cuentax."' ";
			        $result= mysql_query($Sql)  or die (mysql_error());

					//echo $Sql;
				}
				
			$this->con->desconectar();
			
			if($result==1){
			    if($tipofactux==1){
					$ticfa = $ultimoticket;
				}
			    
				$resultadox = '1'.'||'.$tipofactux.'||'.$ticfa.'||'.$grupo;
			}else{
				$resultadox = 0;
			}
			
			return $resultadox;
		}	
	}
	
	
}
?>