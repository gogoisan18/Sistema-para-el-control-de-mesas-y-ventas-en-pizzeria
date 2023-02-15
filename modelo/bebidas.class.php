<?php
require_once("../compartida/conexion.class.php");
class bebidas {
		//Constructor Base Datos
		var $con;
		var $resultado;
	
		function __construct() {
			$this->con = new DBManager;
		}
 
		function agregar($preciobebidax,$descrix){
			if ($this->con->conectar() == true) {
      					
					$Sql = "INSERT INTO bebidas (bebidasDescripC,bebidasPrecioD) 
					VALUES ('".$descrix."','".$preciobebidax."')";
					$result= mysql_query($Sql)  or die (mysql_error());
							
				$this->con->desconectar();
				return $result;
			}
		}

		function editar($idbebidax,$preciobebidax,$descrix) {

			if ($this->con->conectar() == true){ 
				$Sql = "UPDATE bebidas
						SET 
							bebidasDescripC    = '".$descrix."',
							bebidasPrecioD  = '".$preciobebidax."'
			
						WHERE bebidasIdE   = '".$idbebidax."'";
				$result= mysql_query($Sql)  or die (mysql_error());	
						
				$this->con->desconectar();
				return $result;
			}
		}
		
		function eliminar($idbebidax){
			if ($this->con->conectar() == true) {
				$Sql = "UPDATE bebidas
						SET 
							bebidasEstatusE  = 'No Disponible'
			
						WHERE bebidasIdE   = '".$idbebidax."'";
				$result= mysql_query($Sql)  or die (mysql_error());	

				
				$this->con->desconectar();
				return $result;
			}
        } 
}
?>