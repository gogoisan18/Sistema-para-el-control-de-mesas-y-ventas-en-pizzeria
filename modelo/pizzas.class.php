<?php
require_once("../compartida/conexion.class.php");

class pizzas {
		//Constructor Base Datos
		var $con;
		var $resultado;
	
		function __construct() {
			$this->con = new DBManager;
		}
 
		function agregar($precioplatox,$descrix,$tamx){
			if ($this->con->conectar() == true) {

					        if($tamx=='Mini'){	$nuevtam='Min';}
					else if($tamx=='Pequeña'){	$nuevtam='Peq'; }
					else if($tamx=='Mediana'){	$nuevtam='Med'; }
					else if($tamx=='Familiar'){	$nuevtam='Fam'; }
      					
					$Sql = "INSERT INTO pizzas(pizzasTipoE,pizzasDescripC,pizzasPrecioD,tipo) 
					VALUES ('".$tamx."','".$descrix."','".$precioplatox."','".$nuevtam."')";
					$result= mysql_query($Sql)  or die (mysql_error());
							
				$this->con->desconectar();
				return $result;
			}
		}

		function editar($idpizzax,$precioplatox,$descrix,$tamx) {

			if ($this->con->conectar() == true){ 

				if($tamx=='Mini'){	$nuevtam='Min';}
					else if($tamx=='Pequeña'){	$nuevtam='Peq'; }
					else if($tamx=='Mediana'){	$nuevtam='Med'; }
					else if($tamx=='Familiar'){	$nuevtam='Fam'; }

				$Sql = "UPDATE pizzas
						SET 
						    pizzasTipoE = '".$tamx."',
							pizzasDescripC = '".$descrix."',
							pizzasPrecioD = '".$precioplatox."',
							tipo = '".$nuevtam."'
			
						WHERE pizzasIdE   = '".$idpizzax."'";
				$result= mysql_query($Sql)  or die (mysql_error());	
						
				$this->con->desconectar();
				return $result;
			}
		}
		
		function eliminar($idpizzax){
			if ($this->con->conectar() == true) {
				$Sql = "UPDATE pizzas
						SET 
							pizzasEstatusE = 'No Disponible'			
						WHERE pizzasIdE   = '".$idpizzax."'";
				$result= mysql_query($Sql)  or die (mysql_error());	
				$this->con->desconectar();
				return $result;
			}
        } 
}
?>