<?php
include_once ("../compartida/funciones/funciones.class.php");

class rptPagos extends funciones {

	function consultar($fdesde,$fhasta,$tipo) {
    	if ($this->con->conectar() == true) {
		
			 if($tipo=='HOSPEDAJE'){
			 
				$Sql = "select * from (SELECT
							pagos_hotel.pagoshformaPago as forma,
							pagos_hotel.pagoshMontoFinalD as monto,
							habitacion.habitaNumC as caso,
							pagos_hotel.pagoshDescuentoMon as descue,
							pagos_hotel.pagoshRecargaMon as recarg,
							pagos_hotel.pagoshtipoEmision as emi,
							pagos_hotel.pagoshFechaF as fecha,
							tiket_hotel.tikethCedulaC as ced,
							tiket_hotel.tikethNombreC as nomb
							FROM
							pagos_hotel
							INNER JOIN cuenta_hotel ON pagos_hotel.pagoshCuentahIdE = cuenta_hotel.cuentahIdE
							INNER JOIN registro_hotel ON cuenta_hotel.cuentahRegistroIdE = registro_hotel.registroIdE
							INNER JOIN consumos_hotel ON consumos_hotel.consumoshRegistroIdE = registro_hotel.registroIdE
							INNER JOIN habitacion ON consumos_hotel.consumoshHabitaIdE = habitacion.habitaIdE
							INNER JOIN tiket_hotel ON tiket_hotel.tikethPagoshIdE = pagos_hotel.pagoshIdE
							GROUP BY pagoshIdE

					UNION ALL

							SELECT
							pagos_hotel.pagoshformaPago as forma,
							pagos_hotel.pagoshMontoFinalD as monto,
							habitacion.habitaNumC as caso,
							pagos_hotel.pagoshDescuentoMon as descue,
							pagos_hotel.pagoshRecargaMon as recarg,
							pagos_hotel.pagoshtipoEmision as emi,
							pagos_hotel.pagoshFechaF as fecha,
							facturas_hotel.facturahCedRifC as ced,
							facturas_hotel.facturahNombreC as nomb
				FROM
					pagos_hotel
							INNER JOIN cuenta_hotel ON pagos_hotel.pagoshCuentahIdE = cuenta_hotel.cuentahIdE
							INNER JOIN registro_hotel ON cuenta_hotel.cuentahRegistroIdE = registro_hotel.registroIdE
							INNER JOIN consumos_hotel ON consumos_hotel.consumoshRegistroIdE = registro_hotel.registroIdE
							INNER JOIN habitacion ON consumos_hotel.consumoshHabitaIdE = habitacion.habitaIdE
							INNER JOIN facturas_hotel ON facturas_hotel.facturahPagoshIdE = pagos_hotel.pagoshIdE
							GROUP BY pagoshIdE) as tba
				where fecha >='".$fdesde."' and fecha<= '".$fhasta."'";

				$res = $this->resultado =  mysql_query($Sql)  or die (mysql_error());
				
				
			}else{

				$Sql = "select * from (SELECT
							pagos_restaurante.pagosrformaPago as forma,
							pagos_restaurante.pagosrMontoFinalD as monto,
							registro_restaurante.registrorNumMesas as caso,
							pagos_restaurante.pagosrDescuentoMon as descue,
							pagos_restaurante.pagosrRecargaMon as recarg,
							pagos_restaurante.pagosrtipoEmision as emi,
							pagos_restaurante.pagosrFechaF as fecha,
							tiket_restaurante.tiketrCedulaC as ced,
							tiket_restaurante.tiketrNombreC as nomb
							FROM
							pagos_restaurante
							INNER JOIN cuenta_restaurante ON pagos_restaurante.pagosrCuentarIdE = cuenta_restaurante.cuentarIdE
							INNER JOIN registro_restaurante ON cuenta_restaurante.cuentarRegistrorIdE = registro_restaurante.registrorIdE
							INNER JOIN tiket_restaurante ON tiket_restaurante.tiketrPagoshIdE = pagos_restaurante.pagosrIdE
							GROUP BY pagosrIdE

					UNION ALL
							SELECT
							pagos_restaurante.pagosrformaPago as forma,
							pagos_restaurante.pagosrMontoFinalD as monto,
							registro_restaurante.registrorNumMesas as caso,
							pagos_restaurante.pagosrDescuentoMon as descue,
							pagos_restaurante.pagosrRecargaMon as recarg,
							pagos_restaurante.pagosrtipoEmision as emi,
							pagos_restaurante.pagosrFechaF as fecha,
							facturas_restaurante.facturarCedRifC as ced,
							facturas_restaurante.facturarNombreC as nomb
					FROM
						pagos_restaurante
							INNER JOIN cuenta_restaurante ON pagos_restaurante.pagosrCuentarIdE = cuenta_restaurante.cuentarIdE
							INNER JOIN registro_restaurante ON cuenta_restaurante.cuentarRegistrorIdE = registro_restaurante.registrorIdE
							INNER JOIN facturas_restaurante ON facturas_restaurante.facturarPagosrIdE = pagos_restaurante.pagosrIdE
							GROUP BY pagosrIdE) as tba
					where fecha >='".$fdesde."' and fecha<= '".$fhasta."'";

				$res = $this->resultado =  mysql_query($Sql)  or die (mysql_error());


			}
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