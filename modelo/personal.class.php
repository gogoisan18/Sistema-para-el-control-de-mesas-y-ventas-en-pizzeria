<?php
require_once("../compartida/conexion.class.php");
class personal {
		//Constructor Base Datos
		var $con;
		var $resultado;
	
		function __construct() {
			$this->con = new DBManager;
		}
 
		function agregar($cedup,$nombp,$apellp,$tipo,$tlf1p,$tlf2p,$fechanX,$idxprro,$edocivx,$direcc,$estatusx) {
	 
		
			if ($this->con->conectar() == true) {
      
					
					$Sql = "INSERT INTO personal (perCedulaC,perNombreC,perApellidoC,perFechaNacF,perEdoCivilE,
							perTelf1CelC,perTelf2CelC,perParrIdE,perDireccC,perTipoE,perEstatusE) 
					VALUES ('".$cedup."','".$nombp."','".$apellp."','".$fechanX."','".$edocivx."',
							'".$tlf1p."','".$tlf2p."','".$idxprro."','".$direcc."','".$tipo."','".$estatusx."')";
					$result= mysql_query($Sql)  or die (mysql_error());
			
				$this->con->desconectar();
				return $result;
			}
		}

		function editar($cedup,$nombp,$apellp,$tipo,$tlf1p,$tlf2p,$fechanX,$idxprro,$edocivx,$direcc,$estatusx) {

			
			if ($this->con->conectar() == true) { 
				
					$Sql = "UPDATE personal
							SET 
							    perCedulaC    = '".$cedup."',
								perNombreC    = '".$nombp."',
								perApellidoC  = '".$apellp."',
								perFechaNacF  = '".$fechanX."',
								perEdoCivilE  = '".$edocivx."',
								perTelf1CelC  = '".$tlf1p."',
								perTelf2CelC  = '".$tlf2p."',
								perParrIdE    = '".$idxprro."',
								perDireccC    = '".$direcc."',
								perTipoE      = '".$tipo."',
								perEstatusE   = '".$estatusx."'
				
							WHERE perCedulaC   = '".$cedup."'";
					
					$result= mysql_query($Sql)  or die (mysql_error());	
		
				$this->con->desconectar();
				return $result;
			
			}
		}
		
	function eliminar($id) {
        if ($this->con->conectar() == true) {
            $result = mysql_query("DELETE FROM personal WHERE perCedulaC = '" . $id . "'");
            $this->con->desconectar();
			return $result;
        }
    }
		
}
?>