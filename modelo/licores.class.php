<?php
require_once("../compartida/conexion.class.php");
class licores {
		//Constructor Base Datos
		var $con;
		var $resultado;
	
		function __construct() {
			$this->con = new DBManager;
		}
 
		function agregar($precioplatox,$descrix){
			if ($this->con->conectar() == true) {
      					
					$Sql = "INSERT INTO licores(licoresDescripC,licoresPrecioD) 
					VALUES ('".$descrix."','".$precioplatox."')";
					$result= mysql_query($Sql)  or die (mysql_error());
							
				$this->con->desconectar();
				return $result;
			}
		}

		function editar($idLicoresx,$precioplatox,$descrix) {

			if ($this->con->conectar() == true){ 
				$Sql = "UPDATE licores
						SET 
							licoresDescripC = '".$descrix."',
							licoresPrecioD = '".$precioplatox."'
			
						WHERE licoresIdE   = '".$idLicoresx."'";
				$result= mysql_query($Sql)  or die (mysql_error());	
						
				$this->con->desconectar();
				return $result;
			}
		}
		
		function eliminar($idLicoresx){
			if ($this->con->conectar() == true) {
				$Sql = "UPDATE licores
						SET 
						
							licoresEstatusE = 'No Disponible'
			
						WHERE licoresIdE   = '".$idLicoresx."'";
				$result= mysql_query($Sql)  or die (mysql_error());	
				$this->con->desconectar();
				return $result;
			}
        } 
}
?>