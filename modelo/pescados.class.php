<?php
require_once("../compartida/conexion.class.php");

class pescados {
		//Constructor Base Datos
		var $con;
		var $resultado;
	
		function __construct() {
			$this->con = new DBManager;
		}
 
		function agregar($precioplatox,$descrix){
			if ($this->con->conectar() == true) {
      					
					$Sql = "INSERT INTO pescados(pescadosDescripC,pescadosPrecioD) 
					VALUES ('".$descrix."','".$precioplatox."')";
					$result= mysql_query($Sql)  or die (mysql_error());
							
				$this->con->desconectar();
				return $result;
			}
		}

		function editar($idPescadosx,$precioplatox,$descrix) {

			if ($this->con->conectar() == true){ 
				$Sql = "UPDATE pescados
						SET 
							pescadosDescripC = '".$descrix."',
							pescadosPrecioD = '".$precioplatox."'
			
						WHERE pescadosIdE   = '".$idPescadosx."'";
				$result= mysql_query($Sql)  or die (mysql_error());	
						
				$this->con->desconectar();
				return $result;
			}
		}
		
		function eliminar($idPescadosx){
			if ($this->con->conectar() == true) {
				$result = mysql_query("DELETE FROM pescados WHERE pescadosIdE = '" . $idPescadosx . "'");
				$this->con->desconectar();
				return $result;
			}
        } 
}
?>