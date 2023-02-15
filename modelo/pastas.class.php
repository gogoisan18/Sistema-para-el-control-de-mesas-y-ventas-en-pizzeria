<?php
require_once("../compartida/conexion.class.php");

class pastas {
		//Constructor Base Datos
		var $con;
		var $resultado;
	
		function __construct() {
			$this->con = new DBManager;
		}
 
		function agregar($precioplatox,$descrix){
			if ($this->con->conectar() == true) {
      					
					$Sql = "INSERT INTO pastas(pastasDescripC,pastasPrecioD) 
					VALUES ('".$descrix."','".$precioplatox."')";
					$result= mysql_query($Sql)  or die (mysql_error());
							
				$this->con->desconectar();
				return $result;
			}
		}

		function editar($idPastasx,$precioplatox,$descrix) {

			if ($this->con->conectar() == true){ 
				$Sql = "UPDATE pastas
						SET 
							pastasDescripC = '".$descrix."',
							pastasPrecioD = '".$precioplatox."'
			
						WHERE pastasIdE   = '".$idPastasx."'";
				$result= mysql_query($Sql)  or die (mysql_error());	
						
				$this->con->desconectar();
				return $result;
			}
		}
		
		function eliminar($idPastasx){
			if ($this->con->conectar() == true) {
				$result = mysql_query("DELETE FROM pastas WHERE pastasIdE = '" . $idPastasx . "'");
				$this->con->desconectar();
				return $result;
			}
        } 
}
?>