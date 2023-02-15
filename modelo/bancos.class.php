<?php
require_once("../compartida/conexion.class.php");

class bancos {
		//Constructor Base Datos
		var $con;
		var $resultado;
	
		function __construct() {
			$this->con = new DBManager;
		}
 
		function agregar($xbanco) {	 
		
			if ($this->con->conectar() == true) {
      					
					$Sql = "INSERT INTO bancos (bancoDescripC) VALUES ('".$xbanco."')";
					$result= mysql_query($Sql)  or die (mysql_error());
							
				$this->con->desconectar();
				return $result;
			}
		}

		function editar($id,$xbanco) {

			if ($this->con->conectar() == true) {				
			
					$Sql = "UPDATE bancos SET  bancoDescripC   = '".$xbanco."'
				
							WHERE bancoIdE   = '".$id."'";
					$result= mysql_query($Sql)  or die (mysql_error());				
		
			$this->con->desconectar();
			return $result;
			
			}
		}
		  
}
?>