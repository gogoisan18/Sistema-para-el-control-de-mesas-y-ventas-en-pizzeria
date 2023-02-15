<?php
include_once ("../compartida/funciones/funciones.class.php");

class rptCuentaTCHotel extends funciones {
    //rptCuentaTFHotel

	function consultar_basicos($idtic) {
    	if ($this->con->conectar() == true) {
			$Sql = "SELECT
						cuenta_hotel.cuentahMontoTotalD,
						tiket_hotel.tikethFechaF,
						tiket_hotel.tikethCedulaC
					FROM
					cuenta_hotel
					INNER JOIN registro_hotel ON cuenta_hotel.cuentahRegistroIdE = registro_hotel.registroIdE
					INNER JOIN consumos_hotel ON consumos_hotel.consumoshRegistroIdE = registro_hotel.registroIdE
					INNER JOIN habitacion ON consumos_hotel.consumoshHabitaIdE = habitacion.habitaIdE
					INNER JOIN pagos_hotel ON pagos_hotel.pagoshCuentahIdE = cuenta_hotel.cuentahIdE
					INNER JOIN tiket_hotel ON tiket_hotel.tikethCuentahIdE = pagos_hotel.pagoshCuentahIdE
					where tikethIdE = '".$idtic."'
					GROUP BY cuentahIdE ";

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
			//echo $Sql;
		}
	}
	
	function consultar($idtic) {
    	if ($this->con->conectar() == true) {
			$Sql = "SELECT
						detallecuentahotel.detallehDescripC,
						detallecuentahotel.detallehPrecio,
						detallecuentahotel.detallehCant
					FROM
					cuenta_hotel
					INNER JOIN pagos_hotel ON pagos_hotel.pagoshCuentahIdE = cuenta_hotel.cuentahIdE
					INNER JOIN detallecuentahotel ON detallecuentahotel.detallehCuentahIdE = cuenta_hotel.cuentahIdE
					INNER JOIN tiket_hotel ON tiket_hotel.tikethCuentahIdE = pagos_hotel.pagoshCuentahIdE
					where tikethIdE = '".$idtic."' ";

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
	
	function consultar_RD($idtic) {
    	if ($this->con->conectar() == true) {
			$Sql = "SELECT
						cuenta_hotel.cuentaMontoD,
						cuenta_hotel.cuentaMontoDescuentoD,
						cuenta_hotel.cuentahMontoRecargaD,
						cuenta_hotel.cuentahMontoTotalD
					FROM
					cuenta_hotel
					INNER JOIN pagos_hotel ON pagos_hotel.pagoshCuentahIdE = cuenta_hotel.cuentahIdE
					INNER JOIN tiket_hotel ON tiket_hotel.tikethCuentahIdE = pagos_hotel.pagoshCuentahIdE
					where tikethIdE = '".$idtic."'
					GROUP BY cuentahIdE";

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
			//echo $Sql
		}
	}
	
	function iva() {
    	if ($this->con->conectar() == true) {
			$Sql = "SELECT ivaPorcen FROM iva where ivaEstatus = 'Activo'";

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
			//echo $Sql
		}
	}
	

}
?>