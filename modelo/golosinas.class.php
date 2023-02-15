<?php
require_once("../compartida/conexion.class.php");

class golosinas {
		//Constructor Base Datos
		var $con;
		var $resultado;
	
		function __construct() {
			$this->con = new DBManager;
		}
 
		function agregar($precioplatox,$descrix){
			if ($this->con->conectar() == true) {
      					
					$Sql = "INSERT INTO golosinas (descrip,precio) 
					VALUES ('".$descrix."','".$precioplatox."')";
					$result= mysql_query($Sql)  or die (mysql_error());
							
				$this->con->desconectar();
				return $result;
			}
		}

		function editar($idplatox,$precioplatox,$descrix) {

			if ($this->con->conectar() == true){ 
				$Sql = "UPDATE golosinas
						SET 
							descrip    = '".$descrix."',
							precio  = '".$precioplatox."'
			
						WHERE id   = '".$idplatox."'";
				$result= mysql_query($Sql)  or die (mysql_error());	
						
				$this->con->desconectar();
				return $result;
			}
		}
		
		function eliminar($idplatox){
			if ($this->con->conectar() == true) {
				$Sql = "UPDATE golosinas
						SET 
							estatus  = 'No Disponible'
			
						WHERE id   = '".$idplatox."'";
				$result= mysql_query($Sql)  or die (mysql_error());
				$this->con->desconectar();
				return $result;
			}
        } 
}
?>