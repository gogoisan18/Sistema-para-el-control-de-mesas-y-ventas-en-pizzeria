<?php
require_once("../compartida/conexion.class.php");

class mesas {
		//Constructor Base Datos
		var $con;
		var $resultado;
	
		function __construct() {
			$this->con = new DBManager;
		}
 
		function agregar($xnumesa,$xnomesa,$xestamesa) {
	 
		
			if ($this->con->conectar() == true) {
      					
					$Sql = "INSERT INTO mesas (mesasNum,mesasDescripC,mesasEstatusE) 
					VALUES ('".$xnumesa."','".$xnomesa."','".$xestamesa."')";
					$result= mysql_query($Sql)  or die (mysql_error());
							
				$this->con->desconectar();
				return $result;
			}
		}

		function editar($xidxmesa,$xnumesa,$xnomesa,$xestamesa) {

			if ($this->con->conectar() == true) { 
				
			
					$Sql = "UPDATE mesas
							SET 
								mesasNum    = '".$xnumesa."',
								mesasDescripC  = '".$xnomesa."',
								mesasEstatusE   = '".$xestamesa."'
				
							WHERE mesasIdE   = '".$xidxmesa."'";
					$result= mysql_query($Sql)  or die (mysql_error());	
				
		
			$this->con->desconectar();
			return $result;
			
			}
		}
		  
}
?>