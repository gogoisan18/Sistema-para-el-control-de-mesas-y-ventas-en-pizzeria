<?php
require_once("../compartida/conexion.class.php");
class carnes {
		//Constructor Base Datos
		var $con;
		var $resultado;
	
		function __construct() {
			$this->con = new DBManager;
		}
 
		function agregar($precioplatox,$descrix,$tamx){
			if ($this->con->conectar() == true) {
      					
					$Sql = "INSERT INTO carnes (carnesDescripC,carnesPrecioD,carnesTipoE) 
					VALUES ('".$descrix."','".$precioplatox."','".$tamx."')";
					$result= mysql_query($Sql)  or die (mysql_error());
							
				$this->con->desconectar();
				return $result;
			}
		}

		function editar($idplatox,$precioplatox,$descrix,$tamx) {

			if ($this->con->conectar() == true){ 
				$Sql = "UPDATE carnes
						SET 
							carnesDescripC    = '".$descrix."',
							carnesPrecioD  = '".$precioplatox."',
							carnesTipoE  = '".$tamx."'
			
						WHERE carnesIdE   = '".$idplatox."'";
				$result= mysql_query($Sql)  or die (mysql_error());	
						
				$this->con->desconectar();
				return $result;
			}
		}
		
		function eliminar($idplatox){
			if ($this->con->conectar() == true) {
				$Sql = "UPDATE carnes
						SET 
							carnesEstatusE    = 'No Disponible'
			
						WHERE carnesIdE   = '".$idplatox."'";
				$result= mysql_query($Sql)  or die (mysql_error());	
				$this->con->desconectar();
				return $result;
			}
        } 
}
?>