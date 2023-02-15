<?php
require_once("../compartida/conexion.class.php");

class otrosplatos {
		//Constructor Base Datos
		var $con;
		var $resultado;
	
		function __construct() {
			$this->con = new DBManager;
		}
 
		function agregar($precioplatox,$descrix){
			if ($this->con->conectar() == true) {
      					
					$Sql = "INSERT INTO otros_platos(otrosDescripC,otrosPrecioD) 
					VALUES ('".$descrix."','".$precioplatox."')";
					$result= mysql_query($Sql)  or die (mysql_error());
							
				$this->con->desconectar();
				return $result;
			}
		}

		function editar($idotrosplax,$precioplatox,$descrix) {

			if ($this->con->conectar() == true){ 
				$Sql = "UPDATE otros_platos
						SET 
							otrosDescripC = '".$descrix."',
							otrosPrecioD = '".$precioplatox."'
			
						WHERE otrosIdE   = '".$idotrosplax."'";
				$result= mysql_query($Sql)  or die (mysql_error());	
						
				$this->con->desconectar();
				return $result;
			}
		}
		
		function eliminar($idotrosplax){
			if ($this->con->conectar() == true) {
				$Sql = "UPDATE otros_platos
						SET 
							otrosEstatusE = 'No Disponible'
			
						WHERE otrosIdE   = '".$idotrosplax."'";
				$result= mysql_query($Sql)  or die (mysql_error());	
				$this->con->desconectar();
				return $result;
			}
        } 
}
?>