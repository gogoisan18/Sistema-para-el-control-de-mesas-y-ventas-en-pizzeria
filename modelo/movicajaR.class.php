<?php
require_once("../compartida/conexion.class.php");
class movicajaR {
		//Constructor Base Datos
		var $con;
		var $resultado;
	
		function __construct() {
			$this->con = new DBManager;
		}
 
		function agregar($idegre,$fechaEgre,$montoegre,$obseregres,$desegreso) {
			if ($this->con->conectar() == true) {
      
					
			    $Sql = "INSERT INTO movimiento_caja (movimcajarFechaF,movimcajarEgresoIdE,movimcajarDescEgres,movimcajarMontoD,movimcajarObserC) 
					VALUES ('".$fechaEgre."','".$idegre."','".$desegreso."','".$montoegre."','".$obseregres."')";
				$result= mysql_query($Sql)  or die (mysql_error());
			
				$this->con->desconectar();
				return $result;
				//echo $Sql;
			}
		}


		function editar($idmovi,$idegre,$fechaEgre,$montoegre,$obseregres,$desegreso) {
			if ($this->con->conectar() == true) { 
								
					$Sql = "UPDATE movimiento_caja
							SET 
								movimcajarFechaF  = '".$fechaEgre."',
								movimcajarEgresoIdE   = '".$idegre."',
								movimcajarDescEgres   = '".$desegreso."',
								movimcajarMontoD  = '".$montoegre."',
								movimcajarObserC  = '".$obseregres."'
								
							WHERE movimcajarIdE   = '".$idmovi."'";
					$result= mysql_query($Sql)  or die (mysql_error());	
			}
			$this->con->desconectar();
			return $result;
			
		}
			
}
?>