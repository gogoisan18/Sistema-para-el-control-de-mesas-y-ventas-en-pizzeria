<?php
require_once("../compartida/conexion.class.php");
class buscarInfPlatos {
		var $con;
		var $resultado;
	
		function __construct() {
			$this->con = new DBManager;
		}

	   function BuscarPizzas() {
			if ($this->con->conectar() == true) {


			$res = " SELECT
				      g.pizzasDescripC as descrip,
				      concat(g.pizzasDescripC,' ',g.pizzasTipoE) as descrip1,
				      MAX( case when g.pizzasTipoE = 'Mini'     then concat(CAST(g.pizzasIdE AS UNSIGNED),'-',g.pizzasPrecioD) else 0 end ) as mini,
				      MAX( case when g.pizzasTipoE = 'Pequeña'  then concat(CAST(g.pizzasIdE AS UNSIGNED),'-',g.pizzasPrecioD) else 0 end ) as peq,
				      MAX( case when g.pizzasTipoE = 'Mediana'  then concat(CAST(g.pizzasIdE AS UNSIGNED),'-',g.pizzasPrecioD) else 0 end ) as medi,
				      MAX( case when g.pizzasTipoE = 'Familiar' then concat(CAST(g.pizzasIdE AS UNSIGNED),'-',g.pizzasPrecioD) else 0 end ) as fami
				   from
				      pizzas g
				      where g.pizzasEstatusE='Disponible'
				   group by 
				      g.pizzasDescripC "; 
								
				$res = $this->resultado = mysql_query($res) or die ($res.mysql_error($this->con->conect));
			    $datos = array();
                while ($registro= mysql_fetch_assoc($res)){
                    $datos[]=$registro;
                }
                $this->con->desconectar();
              return $datos;
			}
		}

		function BuscarCarnes() {
			if ($this->con->conectar() == true) {
								
				$res = $this->resultado = mysql_query("SELECT carnesIdE as id,CONCAT(carnesDescripC,' ',carnesTipoE) as descrip,carnesPrecioD as precio FROM carnes where carnesEstatusE='Disponible' order by carnesDescripC" ) or die ("SELECT * FROM carnes ".mysql_error($this->con->conect));
			    $datos = array();
                while ($registro= mysql_fetch_assoc($res)){
                    $datos[]=$registro;
                }
                $this->con->desconectar();
              return $datos;
			}
		}
		

		function BuscarOtrosP() {
			if ($this->con->conectar() == true) {
								
				$res = $this->resultado = mysql_query("SELECT otrosIdE as id,otrosDescripC as descrip,otrosPrecioD as precio FROM otros_platos where otrosEstatusE='Disponible' order by otrosDescripC asc" ) or die ("SELECT * FROM otros_platos".mysql_error($this->con->conect));
			    $datos = array();
                while ($registro= mysql_fetch_assoc($res)){
                    $datos[]=$registro;
                }
                $this->con->desconectar();
              return $datos;
			}
		}

		function BuscarBebidas() {
			if ($this->con->conectar() == true) {
								
				$res = $this->resultado = mysql_query("SELECT bebidasIdE as id,bebidasDescripC as descrip,bebidasPrecioD as precio FROM bebidas where bebidasEstatusE='Disponible' order by bebidasDescripC" ) or die ("SELECT * FROM bebidas".mysql_error($this->con->conect));
			    $datos = array();
                while ($registro= mysql_fetch_assoc($res)){
                    $datos[]=$registro;
                }
                $this->con->desconectar();
              return $datos;
			}
		}	
	
		
		function BuscarLicores() {
			if ($this->con->conectar() == true) {
								
				$res = $this->resultado = mysql_query("SELECT licoresIdE as id,licoresDescripC as descrip,licoresPrecioD as precio FROM licores where licoresEstatusE='Disponible' order by licoresDescripC" ) or die ("SELECT * FROM licores".mysql_error($this->con->conect));
			    $datos = array();
                while ($registro= mysql_fetch_assoc($res)){
                    $datos[]=$registro;
                }
                $this->con->desconectar();
              return $datos;
			}
		}
 
       function BuscarAdicionales() {
			if ($this->con->conectar() == true) {
								
				$res = $this->resultado = mysql_query("SELECT adicionalesIdE as id,adicionalesDescripC as descrip,adicionalesPrecioD as precio FROM adicionales where adicionalesEstatusE='Disponible' order by adicionalesDescripC" ) or die ("SELECT * FROM adicionales".mysql_error($this->con->conect));
			    $datos = array();
                while ($registro= mysql_fetch_assoc($res)){
                    $datos[]=$registro;
                }
                $this->con->desconectar();
              return $datos;
			}
		}
		
		function BuscarHelados() {
			if ($this->con->conectar() == true) {
								
				$res = $this->resultado = mysql_query("SELECT heladosIdE as id,heladosDescripC as descrip,heladosPrecioD as precio FROM helados where heladosEstatusE='Disponible' order by heladosDescripC" ) or die ("SELECT * FROM helados".mysql_error($this->con->conect));
			    $datos = array();
                while ($registro= mysql_fetch_assoc($res)){
                    $datos[]=$registro;
                }
                $this->con->desconectar();
              return $datos;
			}
		}		
		function BuscarMerengadas() {
			if ($this->con->conectar() == true) {
								
				$res = $this->resultado = mysql_query("SELECT merengadaIdE as id,CONCAT(merengadaDescripC,' ',merengadaTipoE) as descrip,merengadaPrecioD as precio FROM merengadas where merengadaEstatusE='Disponible' order by merengadaDescripC" ) or die ("SELECT * FROM merengadas".mysql_error($this->con->conect));
			    $datos = array();
                while ($registro= mysql_fetch_assoc($res)){
                    $datos[]=$registro;
                }
                $this->con->desconectar();
              return $datos;
			}
		}
		function BuscarGolosinas() {
			if ($this->con->conectar() == true) {
								
				$res = $this->resultado = mysql_query("SELECT id as id,descrip as descrip,precio as precio FROM golosinas where estatus='Disponible' order by descrip" ) or die ("SELECT * FROM golosinas ".mysql_error($this->con->conect));
			    $datos = array();
                while ($registro= mysql_fetch_assoc($res)){
                    $datos[]=$registro;
                }
                $this->con->desconectar();
              return $datos;
			}
		}		
		
		
		function aperturar_mesa($numxmesax,$idmesoxx,$fecha) {
			if ($this->con->conectar() == true) {
								
				$Sql = "INSERT INTO registros
				(registrorNumMesas,registrorMesoneroIdE,registrorFechaF) 
				VALUES ('".$numxmesax."','".$idmesoxx."','".$fecha."')";
				$result= mysql_query($Sql)  or die (mysql_error());
				$ultimoreg = mysql_insert_id();
				
				$Sql = "INSERT INTO cuentas 
				       (cuentarRegistrorIdE,cuentarCantPartesE,cuentarMontoD,cuentarMontoDescuentoD,cuentarMontoRecargaD,cuentarMontoTotalD,
					    cuentarEstatusE,cuentarMontoMovimiento,cuentarMontoDescuentoMovimiento,cuentarMontoRecargaMovimiento,
						cuentarMontoTotalMovimiento) 
				VALUES ('".$ultimoreg."','1','0,00','0,00','0,00','0,00','Abierta','0,00','0,00','0,00','0,00')";
				$result= mysql_query($Sql)  or die (mysql_error());
				
				$Sql = "UPDATE mesas SET mesasEstatusE = 'Ocupada' WHERE mesasNum = '".$numxmesax."'";
				$result= mysql_query($Sql)  or die (mysql_error());	
				
	            $this->con->desconectar();
				
                if($result==1){
					
					$resultadox = '1'.'||'.(int)$ultimoreg;
				}else{
					$resultadox = '0||0';
				}
				
				return $resultadox;
			}
		}
		
		function cargar_plato_cuenta($xprecplato,$xnombplato,$registroResx) {
			
			if ($this->con->conectar() == true) {
								
				$Sql = "INSERT INTO consumos 
				(controlRegistrorIdE,controlDescripPlato,controlCantPlato,controlPrecioPlato,controlTotal,controlEstatusE) 
				VALUES ('".$registroResx."','".$xnombplato."','1','".$xprecplato."','".$xprecplato."','Por Cancelar')";
				$result= mysql_query($Sql)  or die (mysql_error());
				$ultimocon = mysql_insert_id();
				
				$Sqldf = "SELECT
							registros.registrorIdE,cuentas.cuentarIdE,
							cuentas.cuentarMontoD,cuentas.cuentarMontoDescuentoD,
							cuentas.cuentarMontoRecargaD,cuentas.cuentarMontoTotalD,
							cuentas.cuentarMontoMovimiento,cuentas.cuentarMontoDescuentoMovimiento,
							cuentas.cuentarMontoRecargaMovimiento,cuentas.cuentarMontoTotalMovimiento
							FROM
							cuentas
							INNER JOIN registros ON cuentas.cuentarRegistrorIdE = registros.registrorIdE
						where registrorIdE = '".$registroResx."' ";
							
				$resultdf= mysql_query($Sqldf)  or die (mysql_error());
				$rowdf = mysql_fetch_array($resultdf);
                $cuenta = (int)$rowdf['cuentarIdE'];
				
				
				$Sql = "INSERT INTO detallecuenta (detallerCuentarIdE,detallerIdConsumo,detallerGrupoE,detallerDescripC,detallerPrecio,detallerCant) 
						VALUES ('".$cuenta."','".$ultimocon."','0','".$xnombplato."','".$xprecplato."','1')";
				$result= mysql_query($Sql)  or die (mysql_error());
			
				
				
				$sqlx = "SELECT
							detallerCuentarIdE,
							sum(monto) as monto
						from
							(SELECT
							detallecuenta.detallerCuentarIdE,
							detallecuenta.detallerPrecio,
							detallecuenta.detallerCant,
							(detallecuenta.detallerPrecio*detallecuenta.detallerCant) as monto
							FROM
							detallecuenta) as resul
						 
						where detallerCuentarIdE = '".$cuenta."'
						GROUP BY detallerCuentarIdE";
				
				$resultx= mysql_query($sqlx)  or die (mysql_error());
				$rowxx = mysql_fetch_array($resultx);		
										
				$montocuenta = ($rowxx['monto']+$rowdf['cuentarMontoRecargaD']) - $rowdf['cuentarMontoDescuentoD'];
				
				$sqlrg = "SELECT
							detallerCuentarIdE,
							sum(monto) as monto
						from
							(SELECT
								detallecuenta.detallerCuentarIdE,
								detallecuenta.detallerPrecio,
								detallecuenta.detallerCant,
								(detallecuenta.detallerPrecio*detallecuenta.detallerCant) AS monto
					
								FROM
								detallecuenta
								INNER JOIN consumos ON detallecuenta.detallerIdConsumo = consumos.controlId
								where controlEstatusE = 'Por Cancelar') as resul
						 
						where detallerCuentarIdE = '".$cuenta."'
						GROUP BY detallerCuentarIdE	";
				
				$resultrg= mysql_query($sqlrg)  or die (mysql_error());
				$rowrg = mysql_fetch_array($resultrg);
				
				$montocuentaM = ($rowrg['monto']+$rowdf['cuentarMontoRecargaMovimiento']) - $rowdf['cuentarMontoDescuentoMovimiento'];
				
				$Sql = "UPDATE cuentas
						SET 
							cuentarMontoD = '".$rowxx['monto']."',
							cuentarMontoTotalD = '".$montocuenta."',
							cuentarMontoMovimiento = '".$rowrg['monto']."',
							cuentarMontoTotalMovimiento = '".$montocuentaM."'
							
						WHERE cuentarRegistrorIdE   = '".$registroResx."'";
				$result= mysql_query($Sql)  or die (mysql_error());	
				
	            $this->con->desconectar();
								
				return $result;
			}
		}
		
		function modificar_consumox($idplatox,$cantplax,$registroResx,$precioplatox) {
			if ($this->con->conectar() == true) {
			
				$total = $cantplax*$precioplatox;
				$Sql = "UPDATE consumos 
						   SET 
						   controlCantPlato = '".$cantplax."',
						   controlTotal = '".$total."'
						WHERE controlId = '".$idplatox."' ";
				$result= mysql_query($Sql)  or die (mysql_error());	
				
				$Sqlx1 = "UPDATE detallecuenta 
						   SET 
						   detallerCant = '".$cantplax."'
						  
						WHERE detallerIdConsumo = '".$idplatox."' ";
				$resultx1= mysql_query($Sqlx1)  or die (mysql_error());

             	$Sqldf = "SELECT
							registros.registrorIdE,cuentas.cuentarIdE,
							cuentas.cuentarMontoD,cuentas.cuentarMontoDescuentoD,
							cuentas.cuentarMontoRecargaD,cuentas.cuentarMontoTotalD,
							cuentas.cuentarMontoMovimiento,cuentas.cuentarMontoDescuentoMovimiento,
							cuentas.cuentarMontoRecargaMovimiento,cuentas.cuentarMontoTotalMovimiento
							FROM
							cuentas
							INNER JOIN registros ON cuentas.cuentarRegistrorIdE = registros.registrorIdE
						where registrorIdE = '".$registroResx."' ";
							
				$resultdf= mysql_query($Sqldf)  or die (mysql_error());
				$rowdf = mysql_fetch_array($resultdf);
                $cuenta = (int)$rowdf['cuentarIdE'];
							
				
				$sqlx = "SELECT
							detallerCuentarIdE,
							sum(monto) as monto
						from
							(SELECT
							detallecuenta.detallerCuentarIdE,
							detallecuenta.detallerPrecio,
							detallecuenta.detallerCant,
							(detallecuenta.detallerPrecio*detallecuenta.detallerCant) as monto
							FROM
							detallecuenta) as resul
						 
						where detallerCuentarIdE = '".$cuenta."' 
						GROUP BY detallerCuentarIdE";
				
				$resultx= mysql_query($sqlx)  or die (mysql_error());
				$rowxx = mysql_fetch_array($resultx);		
										
				$montocuenta = ($rowxx['monto']+$rowdf['cuentarMontoRecargaD']) - $rowdf['cuentarMontoDescuentoD'];
				
				$sqlrg = "SELECT
							detallerCuentarIdE,
							sum(monto) as monto
						from
							(SELECT
								detallecuenta.detallerCuentarIdE,
								detallecuenta.detallerPrecio,
								detallecuenta.detallerCant,
								(detallecuenta.detallerPrecio*detallecuenta.detallerCant) AS monto
					
								FROM
								detallecuenta
								INNER JOIN consumos ON detallecuenta.detallerIdConsumo = consumos.controlId
								where controlEstatusE = 'Por Cancelar') as resul
						 
						where detallerCuentarIdE = '".$cuenta."'
						GROUP BY detallerCuentarIdE";
				
				$resultrg= mysql_query($sqlrg)  or die (mysql_error());
				$rowrg = mysql_fetch_array($resultrg);
				
				$montocuentaM = ($rowrg['monto']+$rowdf['cuentarMontoRecargaMovimiento']) - $rowdf['cuentarMontoDescuentoMovimiento'];
				
				$Sql = "UPDATE cuentas
						SET 
							cuentarMontoD = '".$rowxx['monto']."',
							cuentarMontoTotalD = '".$montocuenta."',
							cuentarMontoMovimiento = '".$rowrg['monto']."',
							cuentarMontoTotalMovimiento = '".$montocuentaM."'
							
						WHERE cuentarRegistrorIdE   = '".$registroResx."' ";
				$result= mysql_query($Sql)  or die (mysql_error());				
				
	            $this->con->desconectar();
				return $result;
			}
		}
		
		function eliminar_consumox($idplatox,$registroResx) {
			
			if ($this->con->conectar() == true) {
			
				
				$result = mysql_query("DELETE FROM consumos WHERE controlId = '" . $idplatox . "'");
				
				$result = mysql_query("DELETE FROM detallecuenta WHERE detallerIdConsumo = '" . $idplatox . "'");
				
             	$Sqldf = "SELECT
							registros.registrorIdE,cuentas.cuentarIdE,
							cuentas.cuentarMontoD,cuentas.cuentarMontoDescuentoD,
							cuentas.cuentarMontoRecargaD,cuentas.cuentarMontoTotalD,
							cuentas.cuentarMontoMovimiento,cuentas.cuentarMontoDescuentoMovimiento,
							cuentas.cuentarMontoRecargaMovimiento,cuentas.cuentarMontoTotalMovimiento
							FROM
							cuentas
							INNER JOIN registros ON cuentas.cuentarRegistrorIdE = registros.registrorIdE
						where registrorIdE = '".$registroResx."' ";
							
				$resultdf= mysql_query($Sqldf)  or die (mysql_error());
				$rowdf = mysql_fetch_array($resultdf);
                $cuenta = (int)$rowdf['cuentarIdE'];
							
				
				$sqlx = "SELECT
							detallerCuentarIdE,
							sum(monto) as monto
						from
							(SELECT
							detallecuenta.detallerCuentarIdE,
							detallecuenta.detallerPrecio,
							detallecuenta.detallerCant,
							(detallecuenta.detallerPrecio*detallecuenta.detallerCant) as monto
							FROM
							detallecuenta) as resul
						 
						where detallerCuentarIdE = '".$cuenta."'
						GROUP BY detallerCuentarIdE";
				
				$resultx= mysql_query($sqlx)  or die (mysql_error());
				$rowxx = mysql_fetch_array($resultx);		
										
				$montocuenta = ($rowxx['monto']+$rowdf['cuentarMontoRecargaD']) - $rowdf['cuentarMontoDescuentoD'];
				
				$sqlrg = "SELECT
							detallerCuentarIdE,
							sum(monto) as monto
						from
							(SELECT
								detallecuenta.detallerCuentarIdE,
								detallecuenta.detallerPrecio,
								detallecuenta.detallerCant,
								(detallecuenta.detallerPrecio*detallecuenta.detallerCant) AS monto
					
								FROM
								detallecuenta
								INNER JOIN consumos ON detallecuenta.detallerIdConsumo = consumos.controlId
								where controlEstatusE = 'Por Cancelar') as resul
						 
						where detallerCuentarIdE = '".$cuenta."' 
						GROUP BY detallerCuentarIdE";
				
				$resultrg= mysql_query($sqlrg)  or die (mysql_error());
				$rowrg = mysql_fetch_array($resultrg);
				
				$montocuentaM = ($rowrg['monto']+$rowdf['cuentarMontoRecargaMovimiento']) - $rowdf['cuentarMontoDescuentoMovimiento'];
				
				$Sql = "UPDATE cuentas
						SET 
							cuentarMontoD = '".$rowxx['monto']."',
							cuentarMontoTotalD = '".$montocuenta."',
							cuentarMontoMovimiento = '".$rowrg['monto']."',
							cuentarMontoTotalMovimiento = '".$montocuentaM."'
							
						WHERE cuentarRegistrorIdE   = '".$registroResx."' ";
				$result= mysql_query($Sql)  or die (mysql_error());				
				
	            $this->con->desconectar();
				return $result;
			}
		}
		
		function cambiar_mesa($numxmesax,$nuevamesax,$registroResx,$obserCambiox) {
			
			if ($this->con->conectar() == true) {
			
				$Sql = "UPDATE registros
						SET 
							registrorNumMesas = '".$nuevamesax."',
							registrorObserva = '".$obserCambiox."'
							
						WHERE registrorIdE   = '".$registroResx."' ";
				$result= mysql_query($Sql)  or die (mysql_error());	

                $Sql = "UPDATE mesas
						SET 
							mesasEstatusE = 'Libre'
							
						WHERE mesasNum   = '".$numxmesax."' ";
				$result= mysql_query($Sql)  or die (mysql_error());	
				
				$Sql = "UPDATE mesas
						SET 
							mesasEstatusE = 'Ocupada'
							
						WHERE mesasNum   = '".$nuevamesax."' ";
				$result= mysql_query($Sql)  or die (mysql_error());	
				
	            $this->con->desconectar();
				return $result;
			}
		}
		
		function Buscaresta() {
			
			if ($this->con->conectar() == true) {
								
				$res = $this->resultado = mysql_query("SELECT mesasNum, mesasEstatusE FROM mesas" ) or die ("SELECT mesasNum, mesasEstatusE FROM mesas".mysql_error($this->con->conect));
			    $datos = array();
                while ($registro= mysql_fetch_assoc($res)){
                    $datos[]=$registro;
                }
                $this->con->desconectar();
              return $datos;
			}
		}

		function cerrar_mesa($numxmesax,$registro,$obsercerrar) {
			
			if ($this->con->conectar() == true) {
								
				$Sql = "UPDATE registros
						SET 
							registrorObserva = '".$obsercerrar."'
							
						WHERE registrorIdE   = '".$registro."' ";
				$result= mysql_query($Sql)  or die (mysql_error());	

                $Sql = "UPDATE cuentas
						SET 
							cuentarEstatusE = 'Cerrada'
							
						WHERE cuentarRegistrorIdE   = '".$registro."' ";
				$result= mysql_query($Sql)  or die (mysql_error());	
				
				$Sql = "UPDATE mesas
						SET 
							mesasEstatusE = 'Libre'
							
						WHERE mesasNum   = '".$numxmesax."' ";
				$result= mysql_query($Sql)  or die (mysql_error());	
				
	            $this->con->desconectar();
				return $result;
			}
		}
		
}
?>