<?php
require_once("../compartida/conexion.class.php");
class adicional {
		//Constructor Base Datos
		var $con;
		var $resultado;
	
		function __construct() {
			$this->con = new DBManager;
		}
 
		function agregar($precioplatox,$descrix){
			if ($this->con->conectar() == true) {
      					
					$Sql = "INSERT INTO adicionales (adicionalesDescripC,adicionalesPrecioD) 
					VALUES ('".$descrix."','".$precioplatox."')";
					$result= mysql_query($Sql)  or die (mysql_error());
							
				$this->con->desconectar();
				return $result;
			}
		}

		function editar($idplx,$precioplatox,$descrix) {

			if ($this->con->conectar() == true){ 
				$Sql = "UPDATE adicionales
						SET 
							adicionalesDescripC    = '".$descrix."',
							adicionalesPrecioD  = '".$precioplatox."'
			
						WHERE adicionalesIdE   = '".$idplx."'";
				$result= mysql_query($Sql)  or die (mysql_error());	
						
				$this->con->desconectar();
				return $result;
			}
		}
		
		function eliminar($idplx){
			if ($this->con->conectar() == true) {
				$Sql = "UPDATE adicionales
						SET 
						
							adicionalesEstatusE  = 'No Disponible'
			
						WHERE adicionalesIdE   = '".$idplx."'";
				$result= mysql_query($Sql)  or die (mysql_error());	
				$this->con->desconectar();
				return $result;
			}
        } 
}
?>