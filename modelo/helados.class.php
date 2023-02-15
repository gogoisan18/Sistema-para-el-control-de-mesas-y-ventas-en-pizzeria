<?php
require_once("../compartida/conexion.class.php");

class helados {
		//Constructor Base Datos
		var $con;
		var $resultado;
	
		function __construct() {
			$this->con = new DBManager;
		}
 
		function agregar($precioplatox,$descrix){
			if ($this->con->conectar() == true) {
      					
					$Sql = "INSERT INTO helados (heladosDescripC,heladosPrecioD) 
					VALUES ('".$descrix."','".$precioplatox."')";
					$result= mysql_query($Sql)  or die (mysql_error());
							
				$this->con->desconectar();
				return $result;
			}
		}

		function editar($idplatox,$precioplatox,$descrix) {

			if ($this->con->conectar() == true){ 
				$Sql = "UPDATE helados
						SET 
							heladosDescripC    = '".$descrix."',
							heladosPrecioD  = '".$precioplatox."'
			
						WHERE heladosIdE   = '".$idplatox."'";
				$result= mysql_query($Sql)  or die (mysql_error());	
						
				$this->con->desconectar();
				return $result;
			}
		}
		
		function eliminar($idplatox){
			if ($this->con->conectar() == true) {
				$Sql = "UPDATE helados
						SET 
							heladosEstatusE  = 'No Disponible'
			
						WHERE heladosIdE   = '".$idplatox."'";
				$result= mysql_query($Sql)  or die (mysql_error());
				$this->con->desconectar();
				return $result;
			}
        } 
}
?>