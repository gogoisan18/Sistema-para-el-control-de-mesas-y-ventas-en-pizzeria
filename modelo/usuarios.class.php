<?php
require_once("../compartida/conexion.class.php");
class usuarios {
		//Constructor Base Datos
		var $con;
		var $resultado;
	
		function __construct() {
			$this->con = new DBManager;
		}
 
		function agregar($cedu,$nomb,$apel,$tlf,$tipox,$pass,$estatusx) {
	 
		
			if ($this->con->conectar() == true) {
      					
					$Sql = "INSERT INTO usuarios (usuCedulaC,usuNombreC,usuApellidoC,usuTelfCelC,usuTipoE,usuClaveC,usuEstatusE) 
					VALUES ('".$cedu."','".$nomb."','".$apel."','".$tlf."','".$tipox."','".sha1($pass)."','".$estatusx."')";
					$result= mysql_query($Sql)  or die (mysql_error());
							
				$this->con->desconectar();
				return $result;
			}
		}

		function editar($cedu,$nomb,$apel,$tlf,$tipox,$pass,$estatusx) {

			if ($this->con->conectar() == true) { 
				
				if($pass==''){
				
					$Sql = "UPDATE usuarios
							SET 
								usuNombreC    = '".$nomb."',
								usuApellidoC  = '".$apel."',
								usuTelfCelC   = '".$tlf."',
								usuTipoE      = '".$tipox."',
								usuEstatusE   = '".$estatusx."'
				
							WHERE usuCedulaC   = '".$cedu."'";
					$result= mysql_query($Sql)  or die (mysql_error());	
					
					$claveC='';
				
				}else{
			
				    $Sql = "UPDATE usuarios
							SET 
								usuNombreC    = '".$nomb."',
								usuApellidoC  = '".$apel."',
								usuTelfCelC   = '".$tlf."',
								usuTipoE      = '".$tipox."',
								usuClaveC     = '".SHA1($pass)."',
								usuEstatusE   = '".$estatusx."'
								
							WHERE usuCedulaC   = '".$cedu."'";
					$result= mysql_query($Sql)  or die (mysql_error());	
			
				}
		
			$this->con->desconectar();
			return $result;
			
			}
		}
		
		function eliminar($cedu) {
			if ($this->con->conectar() == true) {
				$result = mysql_query("DELETE FROM usuarios WHERE usuCedulaC = '" . $cedu . "'");
				$this->con->desconectar();
				return $result;
			}
        }  
}
?>