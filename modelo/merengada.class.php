<?php
require_once("../compartida/conexion.class.php");

class merengada {
		//Constructor Base Datos
		var $con;
		var $resultado;
	
		function __construct() {
			$this->con = new DBManager;
		}
 
		function agregar($precioplatox,$descrix,$tamx){
			if ($this->con->conectar() == true) {
      					
					$Sql = "INSERT INTO merengadas (merengadaDescripC,merengadaPrecioD,merengadaTipoE) 
					VALUES ('".$descrix."','".$precioplatox."','".$tamx."')";
					$result= mysql_query($Sql)  or die (mysql_error());
							
				$this->con->desconectar();
				return $result;
			}
		}

		function editar($idplatox,$precioplatox,$descrix,$tamx) {

			if ($this->con->conectar() == true){ 
				$Sql = "UPDATE merengadas
						SET 
							merengadaDescripC    = '".$descrix."',
							merengadaPrecioD  = '".$precioplatox."',
							merengadaTipoE = '".$tamx."'
			
						WHERE merengadaIdE   = '".$idplatox."'";
				$result= mysql_query($Sql)  or die (mysql_error());	
						
				$this->con->desconectar();
				return $result;
			}
		}
		
		function eliminar($idplatox){
			if ($this->con->conectar() == true) {
				$Sql = "UPDATE merengadas
						SET 
							merengadasEstatusE  = 'No Disponible'
			
						WHERE merengadaIdE   = '".$idplatox."'";
				$result= mysql_query($Sql)  or die (mysql_error());
				$this->con->desconectar();
				return $result;
			}
        } 
}
?>