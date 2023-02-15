<?php
class DBManager {
    var $conect;
    var $BaseDatos;
    var $Servidor;
    var $Usuario;
    var $Clave;
	
    function DBManager() {
        //$this->BaseDatos = $this->bd; //Base de Datos	
        $this->Servidor = "localhost"; //Servidor
        $this->Usuario = "root"; //usuario
        $this->Clave = "123"; //Clave
        $this->BaseDatos = "pizzeria";
    }

    function conectar()  {
        if (!($con = @mysql_connect($this->Servidor, $this->Usuario, $this->Clave,$this->BaseDatos))) {
		// if (!($con = @mysql_connect('localhost','root','loader'))) {
		   
		     //die('No pudo conectarse: ' . mysql_error());
	        echo"<h1> [:(] Error al conectar a la base de datos 1</h1>". mysql_error();
            exit();
        }
        if (!@mysql_select_db($this->BaseDatos, $con)) {
            echo "<h1> [:(] Error al seleccionar la base de datos 2</h1>";
            exit();
        }
		mysql_query("SET NAMES 'utf8'");
        $this->conect = $con;
        return true;
    }
	
	function desconectar()  {
			@mysql_close();
			return true;
	}
}
?>
