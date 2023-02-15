<?php
require_once("../compartida/conexion.class.php");

class retorno {

		var $con;
		var $resultado;
	
		function __construct() {
			$this->con = new DBManager;
		}
       
	function editar($identreartx,$idoartx,$observretornx,$candevueltax,$cantiAdevx,$pordevolverx) {
			
			if ($this->con->conectar() == true) {
                
				
				$fecha = gmdate("Y-m-d H:i:s", time() + 3600*($timezone+date("I")));
				
				if($pordevolverx>$cantiAdevx){
					$ret = $pordevolverx-$cantiAdevx;
				}else if($pordevolverx==$cantiAdevx){
					$ret = 0;
				}
				$Sqlm = "SELECT entregadevuelta FROM entrega_articulos WHERE entregaId = '".$identreartx."'";
				$resultm  = mysql_query($Sqlm)  or die (mysql_error());
				$rowm = mysql_fetch_array ($resultm);
				
				$nueva = $rowm['entregadevuelta']+$cantiAdevx;
				
				/*UPDATE entrega_articulos 
				SET entregacanXdevolver = '0', 
					entregadevuelta = '1', 
					entregaObserva = 'NADA', 
					entregaFechaDev = '2015-08-30 01:43:15' 
				WHERE entregaId = '5'*/
													
				$Sql = "UPDATE entrega_articulos
						SET 
						    entregacanXdevolver = '".$ret."',
							entregadevuelta  = '".$nueva."', 
							entregaObserva = '".$observretornx."',
							entregaFechaDev  = '".$fecha."' 
							
						WHERE entregaId   = '".$identreartx."'";
				$result= mysql_query($Sql)  or die (mysql_error());	
				
				$Sqlmon = "SELECT articuloDisponibilidad FROM articulos WHERE articuloIdE = '".$idoartx."'";
				$resultmon  = mysql_query($Sqlmon)  or die (mysql_error());
				$rowmon = mysql_fetch_array ($resultmon);
				
				
				$nuevadisp = $rowmon['articuloDisponibilidad']+$cantiAdevx;
			
				
				$Sql1 = "UPDATE articulos 
						SET 
							articuloDisponibilidad  = '".$nuevadisp."' 
						WHERE articuloIdE   = '".$idoartx."'";
				$result= mysql_query($Sql1)  or die (mysql_error());
			
				$this->con->desconectar();
				return $result;
				
				//echo $Sql.'--'.$Sql1;
				//echo $Sql;
			}
	}
      

    
}

?>