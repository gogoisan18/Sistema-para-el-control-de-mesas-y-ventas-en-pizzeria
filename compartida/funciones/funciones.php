<?php 
session_start(); 
$oper = $_POST['oper'];

switch ($oper) {
	
	case 'crear_variable':
		foreach($_POST as $key => $value) {
			if($key!='oper'){
				$_POST[$key] = str_replace("'","",$value);
				$_POST[$key] = str_replace('"','',$value);
				$_SESSION[$key]=$value;
				echo $_SESSION[$key];
			}
		}
	break;
	
	case 'obtener_variable':
		foreach($_POST as $key => $value) {
			if($key!='oper'){
				$_POST[$key] = str_replace("'","",$value);
				$_POST[$key] = str_replace('"','',$value);
				echo $_SESSION[$key];
			}
		}
	break;
	
	case 'destruir_variable':
		foreach($_POST as $key => $value) {
			$_POST[$key] = str_replace("'","",$value);
			$_POST[$key] = str_replace('"','',$value);
			unset($_SESSION[$key]);
		}
	break;
        
	
}

 ?>
