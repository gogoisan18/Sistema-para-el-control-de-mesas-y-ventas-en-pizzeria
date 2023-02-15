<?php
include_once ("../compartida/funciones/funciones.class.php");

class rptTicket extends funciones {

	function cajero($tick) {
    	if ($this->con->conectar() == true) {
		
			
				$Sql = "SELECT
						SUBSTR(pagos.fechahora,1,10) as fecha,
						pagos.pagosrHora as hora,
						CONCAT(usuarios.usuNombreC,' ',usuarios.usuApellidoC) as cajero,
						pagos.pagosrIdE as pago,
						tiket.tipo
						
						FROM
						tiket
						INNER JOIN pagos ON tiket.tiketrPagoshIdE = pagos.pagosrIdE
						INNER JOIN usuarios ON pagos.usuario = usuarios.usuCedulaC
						where tiket.tiketrIdE='".$tick."' ";

				$res = $this->resultado =  mysql_query($Sql)  or die (mysql_error());

			$nfilas = count($res);
						
			$datos = array();
				if ($nfilas > 0) {
					while($registro= mysql_fetch_assoc($res)) {
						$datos[]=$registro;
					}
				}else{
						$datos[] = '';
				}			
			$this->con->desconectar();
			return $datos;	
		}
	}

	function compras($tick) {
    	if ($this->con->conectar() == true) {
		
			
				$Sql = " 	SELECT
						detallecuenta.detallerDescripC as descrip,
						detallecuenta.detallerPrecio as precio,
						detallecuenta.detallerCant as canti
						FROM
						tiket
						INNER JOIN detallecuenta ON tiket.tiketrCuentahIdE = detallecuenta.detallerCuentarIdE
						where tiket.tiketrIdE='".$tick."' ";

				$res = $this->resultado =  mysql_query($Sql)  or die (mysql_error());

			$nfilas = count($res);
						
			$datos = array();
				if ($nfilas > 0) {
					while($registro= mysql_fetch_assoc($res)) {
						$datos[]=$registro;
					}
				}else{
						$datos[] = '';
				}			
			$this->con->desconectar();
			return $datos;	
		}
	}

	function consumos($cuenta) {
    	if ($this->con->conectar() == true) {
		
			
				$Sql = " SELECT
						detallecuenta.detallerDescripC as descrip,
						detallecuenta.detallerPrecio as precio,
						detallecuenta.detallerCant as canti
						FROM
						detallecuenta
						INNER JOIN cuentas ON detallecuenta.detallerCuentarIdE = cuentas.cuentarIdE
						INNER JOIN registros ON cuentas.cuentarRegistrorIdE = registros.registrorIdE
						where cuentas.cuentarIdE='".$cuenta."' ";

				$res = $this->resultado =  mysql_query($Sql)  or die (mysql_error());

			$nfilas = count($res);
						
			$datos = array();
				if ($nfilas > 0) {
					while($registro= mysql_fetch_assoc($res)) {
						$datos[]=$registro;
					}
				}else{
						$datos[] = '';
				}			
			$this->con->desconectar();
			return $datos;	
		}
	}

	function detalle($tickx) {
    	if ($this->con->conectar() == true) {
		
			
				$Sql = " SELECT
						tiket.tiketrIdE,
						cuentas.cuentarMontoD as inicial,
						pagos.pagosrMontoFinalD as final,
						pagos.pagosrRecargaMon as recarga,
						pagos.pagosrDescuentoMon as descuento,
						registros.registrorNumMesas as mesa

						FROM
						tiket
						INNER JOIN pagos ON tiket.tiketrPagoshIdE = pagos.pagosrIdE
						INNER JOIN cuentas ON pagos.pagosrCuentarIdE = cuentas.cuentarIdE
						INNER JOIN registros ON cuentas.cuentarRegistrorIdE = registros.registrorIdE
						where tiket.tiketrIdE='".$tickx."' ";

				$res = $this->resultado =  mysql_query($Sql)  or die (mysql_error());

			$nfilas = count($res);
						
			$datos = array();
				if ($nfilas > 0) {
					while($registro= mysql_fetch_assoc($res)) {
						$datos[]=$registro;
					}
				}else{
						$datos[] = '';
				}			
			$this->con->desconectar();
			return $datos;
		}
	}

	function pizzas($desdex,$hastax,$usuario) {
    	if ($this->con->conectar() == true) {
		
			
	   $Sql = " SELECT
						SUBSTR(descrip,7) as descrip,
						precio,
						sum(cant) as canti,
						(precio *(sum(cant))) as total

				from(
					SELECT
					detallecuenta.detallerDescripC as descrip,
					detallecuenta.detallerPrecio as precio,
					detallecuenta.detallerCant as cant,
					cuentas.cuentarIdE as cuentaid,
					pagos.pagosrFechaF as fecha
					FROM
					pagos
					INNER JOIN usuarios ON pagos.usuario = usuarios.usuCedulaC
					INNER JOIN cuentas ON pagos.pagosrCuentarIdE = cuentas.cuentarIdE
					INNER JOIN detallecuenta ON detallecuenta.detallerCuentarIdE = cuentas.cuentarIdE
					where SUBSTR(pagos.fechahora,1,10) BETWEEN '".$desdex."' and '".$hastax."' 
					and pagos.usuario='".$usuario."'
					and  detallecuenta.detallerDescripC in 
					(SELECT CONCAT(pizzasDescripC,' ',tipo) from pizzas)
					GROUP BY cuentas.cuentarIdE,detallecuenta.detallerDescripC) as todas
				GROUP BY descrip
				ORDER BY descrip asc ";


		
			$res = $this->resultado =  mysql_query($Sql)  or die (mysql_error());

			$nfilas = count($res);
						
			$datos = array();
				if ($nfilas > 0) {
					while($registro= mysql_fetch_assoc($res)) {
						$datos[]=$registro;
					}
				}else{
						$datos[] = '';
				}			
			$this->con->desconectar();
			return $datos;
		}
	}

	function adicionales($desdex,$hastax,$usuario) {
    	if ($this->con->conectar() == true) {
		
			
			$Sql = " SELECT
						descrip,
						precio,
						sum(cant) as canti,
						(precio *(sum(cant))) as total

				from(
					SELECT
					detallecuenta.detallerDescripC as descrip,
					detallecuenta.detallerPrecio as precio,
					detallecuenta.detallerCant as cant,
					cuentas.cuentarIdE as cuentaid,
					pagos.pagosrFechaF as fecha
					FROM
					pagos
					INNER JOIN usuarios ON pagos.usuario = usuarios.usuCedulaC
					INNER JOIN cuentas ON pagos.pagosrCuentarIdE = cuentas.cuentarIdE
					INNER JOIN detallecuenta ON detallecuenta.detallerCuentarIdE = cuentas.cuentarIdE
					where SUBSTR(pagos.fechahora,1,10) BETWEEN '".$desdex."' and '".$hastax."' 
					and pagos.usuario='".$usuario."'
					and  detallecuenta.detallerDescripC in 
					(SELECT adicionalesDescripC FROM adicionales where adicionalesDescripC not LIKE '%ENVASE%')
					GROUP BY cuentas.cuentarIdE,detallecuenta.detallerDescripC) as todas
				GROUP BY descrip
				ORDER BY descrip asc ";


			$res = $this->resultado =  mysql_query($Sql)  or die (mysql_error());

			$nfilas = count($res);
						
			$datos = array();
				if ($nfilas > 0) {
					while($registro= mysql_fetch_assoc($res)) {
						$datos[]=$registro;
					}
				}else{
						$datos[] = '';
				}			
			$this->con->desconectar();
			return $datos;
		}
	}

	function carnes($desdex,$hastax,$usuario) {
    	if ($this->con->conectar() == true) {


    		$Sql = " SELECT
						descrip,
						precio,
						sum(cant) as canti,
						(precio *(sum(cant))) as total

				from(
					SELECT
					detallecuenta.detallerDescripC as descrip,
					detallecuenta.detallerPrecio as precio,
					detallecuenta.detallerCant as cant,
					cuentas.cuentarIdE as cuentaid,
					pagos.pagosrFechaF as fecha
					FROM
					pagos
					INNER JOIN usuarios ON pagos.usuario = usuarios.usuCedulaC
					INNER JOIN cuentas ON pagos.pagosrCuentarIdE = cuentas.cuentarIdE
					INNER JOIN detallecuenta ON detallecuenta.detallerCuentarIdE = cuentas.cuentarIdE
					where SUBSTR(pagos.fechahora,1,10) BETWEEN '".$desdex."' and '".$hastax."' 
					and pagos.usuario='".$usuario."'
					and  detallecuenta.detallerDescripC in 
					(SELECT CONCAT(carnesDescripC,' ',carnesTipoE) as descrip FROM carnes)
					GROUP BY cuentas.cuentarIdE,detallecuenta.detallerDescripC) as todas
				GROUP BY descrip
				ORDER BY descrip asc ";

			$res = $this->resultado =  mysql_query($Sql)  or die (mysql_error());

			$nfilas = count($res);
						
			$datos = array();
				if ($nfilas > 0) {
					while($registro= mysql_fetch_assoc($res)) {
						$datos[]=$registro;
					}
				}else{
						$datos[] = '';
				}			
			$this->con->desconectar();
			return $datos;
		}
	}

	function bebidas($desdex,$hastax,$usuario) {
    	if ($this->con->conectar() == true) {

    		$Sql = " SELECT
						descrip,
						precio,
						sum(cant) as canti,
						(precio *(sum(cant))) as total

				from(
					SELECT
					detallecuenta.detallerDescripC as descrip,
					detallecuenta.detallerPrecio as precio,
					detallecuenta.detallerCant as cant,
					cuentas.cuentarIdE as cuentaid,
					pagos.pagosrFechaF as fecha
					FROM
					pagos
					INNER JOIN usuarios ON pagos.usuario = usuarios.usuCedulaC
					INNER JOIN cuentas ON pagos.pagosrCuentarIdE = cuentas.cuentarIdE
					INNER JOIN detallecuenta ON detallecuenta.detallerCuentarIdE = cuentas.cuentarIdE
					where SUBSTR(pagos.fechahora,1,10) BETWEEN '".$desdex."' and '".$hastax."' 
					and pagos.usuario='".$usuario."'
					and  detallecuenta.detallerDescripC in 
					(SELECT bebidasDescripC FROM bebidas)
					GROUP BY cuentas.cuentarIdE,detallecuenta.detallerDescripC) as todas
				GROUP BY descrip
				ORDER BY descrip asc ";

			$res = $this->resultado =  mysql_query($Sql)  or die (mysql_error());

			$nfilas = count($res);
						
			$datos = array();
				if ($nfilas > 0) {
					while($registro= mysql_fetch_assoc($res)) {
						$datos[]=$registro;
					}
				}else{
						$datos[] = '';
				}			
			$this->con->desconectar();
			return $datos;
		}
	}

	function licores($desdex,$hastax,$usuario) {
    	if ($this->con->conectar() == true) {

    		$Sql = " SELECT
						descrip,
						precio,
						sum(cant) as canti,
						(precio *(sum(cant))) as total

				from(
					SELECT
					detallecuenta.detallerDescripC as descrip,
					detallecuenta.detallerPrecio as precio,
					detallecuenta.detallerCant as cant,
					cuentas.cuentarIdE as cuentaid,
					pagos.pagosrFechaF as fecha
					FROM
					pagos
					INNER JOIN usuarios ON pagos.usuario = usuarios.usuCedulaC
					INNER JOIN cuentas ON pagos.pagosrCuentarIdE = cuentas.cuentarIdE
					INNER JOIN detallecuenta ON detallecuenta.detallerCuentarIdE = cuentas.cuentarIdE
					where SUBSTR(pagos.fechahora,1,10) BETWEEN '".$desdex."' and '".$hastax."' 
					and pagos.usuario='".$usuario."'
					and  detallecuenta.detallerDescripC in 
					(SELECT licoresDescripC FROM licores)
					GROUP BY cuentas.cuentarIdE,detallecuenta.detallerDescripC) as todas
				GROUP BY descrip
				ORDER BY descrip asc ";

			$res = $this->resultado =  mysql_query($Sql)  or die (mysql_error());

			$nfilas = count($res);
						
			$datos = array();
				if ($nfilas > 0) {
					while($registro= mysql_fetch_assoc($res)) {
						$datos[]=$registro;
					}
				}else{
						$datos[] = '';
				}			
			$this->con->desconectar();
			return $datos;
		}
	}

	function envases($desdex,$hastax,$usuario) {
    	if ($this->con->conectar() == true) {

    		$Sql = " SELECT
						descrip,
						precio,
						sum(cant) as canti,
						(precio *(sum(cant))) as total

				from(
					SELECT
					detallecuenta.detallerDescripC as descrip,
					detallecuenta.detallerPrecio as precio,
					detallecuenta.detallerCant as cant,
					cuentas.cuentarIdE as cuentaid,
					pagos.pagosrFechaF as fecha
					FROM
					pagos
					INNER JOIN usuarios ON pagos.usuario = usuarios.usuCedulaC
					INNER JOIN cuentas ON pagos.pagosrCuentarIdE = cuentas.cuentarIdE
					INNER JOIN detallecuenta ON detallecuenta.detallerCuentarIdE = cuentas.cuentarIdE
					where SUBSTR(pagos.fechahora,1,10) BETWEEN '".$desdex."' and '".$hastax."' 
					and pagos.usuario='".$usuario."'
					and  detallecuenta.detallerDescripC in 
					(SELECT adicionalesDescripC FROM adicionales where adicionalesDescripC LIKE '%ENVASE%')
					GROUP BY cuentas.cuentarIdE,detallecuenta.detallerDescripC) as todas
				GROUP BY descrip
				ORDER BY descrip asc ";

			$res = $this->resultado =  mysql_query($Sql)  or die (mysql_error());

			$nfilas = count($res);
						
			$datos = array();
				if ($nfilas > 0) {
					while($registro= mysql_fetch_assoc($res)) {
						$datos[]=$registro;
					}
				}else{
						$datos[] = '';
				}			
			$this->con->desconectar();
			return $datos;
		}
	}

	function otrosP($desdex,$hastax,$usuario) {
    	if ($this->con->conectar() == true) {

    		$Sql = " SELECT
						descrip,
						precio,
						sum(cant) as canti,
						(precio *(sum(cant))) as total

				from(
					SELECT
					detallecuenta.detallerDescripC as descrip,
					detallecuenta.detallerPrecio as precio,
					detallecuenta.detallerCant as cant,
					cuentas.cuentarIdE as cuentaid,
					pagos.pagosrFechaF as fecha
					FROM
					pagos
					INNER JOIN usuarios ON pagos.usuario = usuarios.usuCedulaC
					INNER JOIN cuentas ON pagos.pagosrCuentarIdE = cuentas.cuentarIdE
					INNER JOIN detallecuenta ON detallecuenta.detallerCuentarIdE = cuentas.cuentarIdE
					where SUBSTR(pagos.fechahora,1,10) BETWEEN '".$desdex."' and '".$hastax."' 
					and pagos.usuario='".$usuario."'
					and  detallecuenta.detallerDescripC in 
					(SELECT otrosDescripC FROM otros_platos)
					GROUP BY cuentas.cuentarIdE,detallecuenta.detallerDescripC) as todas
				GROUP BY descrip
				ORDER BY descrip asc ";

			$res = $this->resultado =  mysql_query($Sql)  or die (mysql_error());

			$nfilas = count($res);
						
			$datos = array();
				if ($nfilas > 0) {
					while($registro= mysql_fetch_assoc($res)) {
						$datos[]=$registro;
					}
				}else{
						$datos[] = '';
				}			
			$this->con->desconectar();
			return $datos;
		}
	}
	function helados($desdex,$hastax,$usuario) {
    	if ($this->con->conectar() == true) {

    		$Sql = " SELECT
						descrip,
						precio,
						sum(cant) as canti,
						(precio *(sum(cant))) as total

				from(
					SELECT
					detallecuenta.detallerDescripC as descrip,
					detallecuenta.detallerPrecio as precio,
					detallecuenta.detallerCant as cant,
					cuentas.cuentarIdE as cuentaid,
					pagos.pagosrFechaF as fecha
					FROM
					pagos
					INNER JOIN usuarios ON pagos.usuario = usuarios.usuCedulaC
					INNER JOIN cuentas ON pagos.pagosrCuentarIdE = cuentas.cuentarIdE
					INNER JOIN detallecuenta ON detallecuenta.detallerCuentarIdE = cuentas.cuentarIdE
					where SUBSTR(pagos.fechahora,1,10) BETWEEN '".$desdex."' and '".$hastax."' 
					and pagos.usuario='".$usuario."'
					and  detallecuenta.detallerDescripC in 
				    (SELECT heladosDescripC FROM helados)
					GROUP BY cuentas.cuentarIdE,detallecuenta.detallerDescripC) as todas
				GROUP BY descrip
				ORDER BY descrip asc ";

			$res = $this->resultado =  mysql_query($Sql)  or die (mysql_error());

			$nfilas = count($res);
						
			$datos = array();
				if ($nfilas > 0) {
					while($registro= mysql_fetch_assoc($res)) {
						$datos[]=$registro;
					}
				}else{
						$datos[] = '';
				}			
			$this->con->desconectar();
			return $datos;
		}
	}

	function merengadas($desdex,$hastax,$usuario) {
    	if ($this->con->conectar() == true) {

    		$Sql = " SELECT
						descrip,
						precio,
						sum(cant) as canti,
						(precio *(sum(cant))) as total

				from(
					SELECT
					detallecuenta.detallerDescripC as descrip,
					detallecuenta.detallerPrecio as precio,
					detallecuenta.detallerCant as cant,
					cuentas.cuentarIdE as cuentaid,
					pagos.pagosrFechaF as fecha
					FROM
					pagos
					INNER JOIN usuarios ON pagos.usuario = usuarios.usuCedulaC
					INNER JOIN cuentas ON pagos.pagosrCuentarIdE = cuentas.cuentarIdE
					INNER JOIN detallecuenta ON detallecuenta.detallerCuentarIdE = cuentas.cuentarIdE
					where SUBSTR(pagos.fechahora,1,10) BETWEEN '".$desdex."' and '".$hastax."' 
					and pagos.usuario='".$usuario."'
					and  detallecuenta.detallerDescripC in 
					(SELECT CONCAT(merengadaDescripC,' ',merengadaTipoE) as descrip FROM merengadas)
					GROUP BY cuentas.cuentarIdE,detallecuenta.detallerDescripC) as todas
				GROUP BY descrip
				ORDER BY descrip asc ";
		
			$res = $this->resultado =  mysql_query($Sql)  or die (mysql_error());

			$nfilas = count($res);
						
			$datos = array();
				if ($nfilas > 0) {
					while($registro= mysql_fetch_assoc($res)) {
						$datos[]=$registro;
					}
				}else{
						$datos[] = '';
				}			
			$this->con->desconectar();
			return $datos;
		}
	}

	function golosinas($desdex,$hastax,$usuario) {
    	if ($this->con->conectar() == true) {

    		$Sql = " SELECT
						descrip,
						precio,
						sum(cant) as canti,
						(precio *(sum(cant))) as total

				from(
					SELECT
					detallecuenta.detallerDescripC as descrip,
					detallecuenta.detallerPrecio as precio,
					detallecuenta.detallerCant as cant,
					cuentas.cuentarIdE as cuentaid,
					pagos.pagosrFechaF as fecha
					FROM
					pagos
					INNER JOIN usuarios ON pagos.usuario = usuarios.usuCedulaC
					INNER JOIN cuentas ON pagos.pagosrCuentarIdE = cuentas.cuentarIdE
					INNER JOIN detallecuenta ON detallecuenta.detallerCuentarIdE = cuentas.cuentarIdE
					where SUBSTR(pagos.fechahora,1,10) BETWEEN '".$desdex."' and '".$hastax."' 
					and pagos.usuario='".$usuario."'
					and  detallecuenta.detallerDescripC in 
					(SELECT descrip FROM golosinas)
					GROUP BY cuentas.cuentarIdE,detallecuenta.detallerDescripC) as todas
				GROUP BY descrip
				ORDER BY descrip asc ";
			
			$res = $this->resultado =  mysql_query($Sql)  or die (mysql_error());

			$nfilas = count($res);
						
			$datos = array();
				if ($nfilas > 0) {
					while($registro= mysql_fetch_assoc($res)) {
						$datos[]=$registro;
					}
				}else{
						$datos[] = '';
				}			
			$this->con->desconectar();
			return $datos;
		}
	}


	function resx($tick) {
    	if ($this->con->conectar() == true) {
		
			
				$Sql = " SELECT
							cuentas.cuentarMontoD as monto1,
							cuentas.cuentarMontoTotalMovimiento as monto2,
							pagos.pagosrMontoFinalD as pagos,
							pagos.resta
							FROM
							tiket
							INNER JOIN pagos ON tiket.tiketrPagoshIdE = pagos.pagosrIdE
							INNER JOIN cuentas ON pagos.pagosrCuentarIdE = cuentas.cuentarIdE
							where tiket.tiketrIdE='".$tick."' ";

				$res = $this->resultado =  mysql_query($Sql)  or die (mysql_error());

			$nfilas = count($res);
						
			$datos = array();
				if ($nfilas > 0) {
					while($registro= mysql_fetch_assoc($res)) {
						$datos[]=$registro;
					}
				}else{
						$datos[] = '';
				}			
			$this->con->desconectar();
			return $datos;	
		}
	}

	


}

?>