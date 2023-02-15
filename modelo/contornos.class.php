<?php
require_once("../compartida/conexion.class.php");
class contornos {
		//Constructor Base Datos
		var $con;
		var $resultado;
	
		function __construct() {
			$this->con = new DBManager;
		}
 
		function agregar($precioplatox,$descrix){
			if ($this->con->conectar() == true) {
      					
					$Sql = "INSERT INTO contornos (contornosDescripC,contornosPrecioD) 
					VALUES ('".$descrix."','".$precioplatox."')";
					$result= mysql_query($Sql)  or die (mysql_error());
							
				$this->con->desconectar();
				return $result;
			}
		}

		function editar($idplatox,$precioplatox,$descrix) {

			if ($this->con->conectar() == true){ 
				$Sql = "UPDATE contornos
						SET 
							contornosDescripC    = '".$descrix."',
							contornosPrecioD  = '".$precioplatox."'
			
						WHERE contornosIdE   = '".$idplatox."'";
				$result= mysql_query($Sql)  or die (mysql_error());	
						
				$this->con->desconectar();
				return $result;
			}
		}
		
		function eliminar($idplatox){
			if ($this->con->conectar() == true) {
				$result = mysql_query("DELETE FROM contornos WHERE contornosIdE = '" . $idplatox . "'");
				$this->con->desconectar();
				return $result;
			}
        } 
}
?>