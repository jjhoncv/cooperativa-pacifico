<?php
session_start();
include_once 'socio.php';

class ApiSocios{
	
    function consulta_socio($dni){
        
        $socio = new Socio();
        $res = $socio->consulta_socio_db($dni);

        if($res->rowCount()){
            $_SESSION["existe_socio"] = "true";
        }
        else{
            $_SESSION["existe_socio"] = "false";
        }
      
    }
	
	function nuevo_socio($item){
        $socio = new Socio();

        $res = $socio->nuevo_socio($item);
        //$this->exito('Se ingreso el registro de manera correcta');
    }
	
    
}

?>