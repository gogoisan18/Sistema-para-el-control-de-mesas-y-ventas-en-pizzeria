<?php
include_once("../compartida/conexion.class.php"); 

class funciones {
		
		var $con;
		var $resultado;
		function funciones() {
			$this->con = new DBManager;

		}

		function totalPagina($cant,$limite) {
			if ($cant > 0) {
				if ($limite == 0) {
					$total_pag = $cant;
				} else {
					$total_pag = ceil($cant / $limite);
				}
			} else {
				$total_pag = 0;
			}
			return $total_pag;
		}

		function inicioPagina($pag,$total_pag,$limite) {
		
			if ($pag > $total_pag)
				$pag = $total_pag;
			if (0 ==$total_pag)
			  $inicio = 1;
			else
			 $inicio =$limite * $pag - $limite; 
			return $inicio;
		}

			function cantidadReg($entidad,$where='') {
				if ($this->con->conectar() == true) {
				  $resultado=mysql_query("SELECT COUNT(*) as cant FROM $entidad $where" ) or die (mysql_error());
				  $cant=mysql_fetch_array($resultado);
				  $this->con->desconectar();
				  return $cant['cant'];
				}
			}

		function consultaGeneral($entidad,$where='',$ord='1',$dir="ASC",$inicio='',$limite='',$campos=' * ',$grupo='') {
			if ($this->con->conectar() == true) {
				  if ($limite=='' and $inicio =='')
					$limiteX = " ";
				  else
				   	$limiteX = " LIMIT $inicio,$limite";
				  if($grupo!='')
					$grupo=" GROUP BY ".$grupo;
					
				$res = $this->resultado = mysql_query("SELECT $campos FROM $entidad $where $grupo ORDER BY $ord $dir $limiteX" ) or die ("SELECT $campos FROM $entidad $where $grupo ORDER BY $ord $dir $limiteX".mysql_error($this->con->conect));
			    $datos = array();
                while ($registro= mysql_fetch_assoc($res)){
                    $datos[]=$registro;
                }
                $this->con->desconectar();
              return $datos;
			}
		}
		
		

	//****** Fin Total Pagina
	function consultaGeneral1($entidad,$where,$group,$ord,$dir,$inicio,$limite) {
			if ($this->con->conectar() == true) {
				  if ($limite=='' and $inicio =='')
					$limiteX = " ";
				  else
				   	$limiteX = " LIMIT $inicio,$limite";
				$this->resultado = mysql_query("SELECT * FROM $entidad $where GROUP BY $group ORDER BY $ord $dir $limiteX" ) or die (mysql_error());
			    $this->con->desconectar(); 
				return true;
			}
		}
	
	function ejecutarcomando($csql) {
			if ($this->con->conectar() == true) {
				
				$res = $this->resultado = mysql_query($csql) or die (mysql_error());
			    $datos = array();
                while ($registro= mysql_fetch_assoc($res)){
                    $datos[]=$registro;
                }
                $this->con->desconectar();
              return $datos;
			}
	}
	function ejecutar($csql) {
		if ($this->con->conectar() == true) {
				
			$res = $this->resultado = mysql_query($csql) or die (mysql_error());
			$this->con->desconectar();
            return $res;
		}
	}
	
	//*****Obtener Fecha y Hora actual
	function ObtenerFecha(){
		$fecha = gmdate("Y-m-d");
		return $fecha;
	}
	
	function ObtenerHora(){
		$timezone = -4.5;
		$hora    = gmdate("H:i:s", time() + 3600*($timezone+date("I")));
		return $hora;
	}
	
	function ObtenerFechaHora(){
		$timezone = -5.5;
		$fecha    = gmdate("d-m-Y H:i:s", time() + 3600*($timezone+date("I")));
		return $fecha;
	}
	
	function convertirFecha($fecha) {
		if($fecha=='00-00-0000' || $fecha=='0000-00-00' || $fecha==''){
			$fecha='';
		}else{
			$data = explode("-",$fecha,3);
			$fecha = $data[2].'-'.$data[1].'-'.$data[0];
		}
		return $fecha;
	}

	function getEdad($fecha) {
		$dias = explode('-', $fecha, 3);
		$dias = mktime(0,0,0,$dias[1],$dias[2],$dias[0]);
		$edad = (int)((time()-$dias)/31556926 );
		return $edad;
	}	
		
	function ObtenerIP(){
		   if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"),"unknown"))
				   $ip = getenv("HTTP_CLIENT_IP");
		   else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown"))
				   $ip = getenv("HTTP_X_FORWARDED_FOR");
		   else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
				   $ip = getenv("REMOTE_ADDR");
		   else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
				   $ip = $_SERVER['REMOTE_ADDR'];
		   else
				   $ip = "IP desconocida";
		   return($ip);
	}

	
	function chequearRango($fechaInicio, $fechaFinal, $fechaEvaluar) {
		$start_ts = strtotime($fechaInicio);
		$end_ts = strtotime($fechaFinal);
		$user_ts = strtotime($fechaEvaluar);
		return (($user_ts >= $start_ts) && ($user_ts <= $end_ts));
   }
   
   function dias_transcurridos($fecha_i,$fecha_f){
		$dias	= (strtotime($fecha_i)-strtotime($fecha_f))/86400;
		$dias 	= abs($dias); $dias = floor($dias);		
		return $dias;
	}
}
?>