<?php

include_once 'db.php';

class Persona extends DB{
    
	function abrir_carta($session){
        
        $query = $this->connect()->query("SELECT * FROM Doble WHERE Cod_session='$session' AND Abierto=0 ORDER BY Orden ASC");
		return $query;
    }
	
	function abrir_carta_memoria($session){
        
        $query = $this->connect()->query("SELECT * FROM Memoria WHERE Cod_session='$session' AND Abierto=0 ORDER BY Orden ASC");
		return $query;
    }
	
	function carta_abierta($session, $id){
        
        $query = $this->connect()->query("UPDATE Doble SET Abierto=1 WHERE Cod_session='$session' AND Id='$id'");
		return $query;
    }
	
	function busca_combinacion($valor1, $valor2){
		$query = $this->connect()->query("SELECT * FROM Combinacion WHERE (Uno='$valor1' AND Dos='$valor2') OR (Uno='$valor2' AND Dos='$valor1')");
		return $query;
	}
	
	function lista_elementos($tarjeta1, $tarjeta2){
		
        $query = $this->connect()->query("SELECT DISTINCT(Nombre) FROM Elementos WHERE Tarjeta='$tarjeta1' OR Tarjeta='$tarjeta2' ORDER BY Nombre ASC");
		return $query;
	}
	
	function empezar_otra_vez($session){
        
        $query = $this->connect()->query("UPDATE Doble SET Abierto=0 WHERE Cod_session='$session'");
		return $query;
    }
	
	function borrar_juego($session){
        
        $query = $this->connect()->query("DELETE FROM Doble WHERE Cod_session='$session'");
		return $query;
    }
	
	function borrar_juego_memoria($session){
        
        $query = $this->connect()->query("DELETE FROM Memoria WHERE Cod_session='$session'");
		return $query;
    }	

	function nuevo_juego($session){
        date_default_timezone_set('America/Lima');
        $fecha = date('"Y/m/d H:i:s"');
		
		for ($i = 1; $i <= 8; $i++) {
			$orden_tmp = rand(1, 1000);
			$query = $this->connect()->query("INSERT INTO Doble (Id, Cod_session, Numero, Fecha, Abierto, Orden) VALUES (NULL,'$session','$i',$fecha,'0','$orden_tmp')");
		}
		
		return $query;
	}
	
	function nuevo_juego_memoria($session){
        date_default_timezone_set('America/Lima');
        $fecha = date('"Y/m/d H:i:s"');
		$lista = array("Contactless","Paciyá","MasterCard","Compras","Chip","Débito","Puntos Tsuru","Descuentos", "E-commerce");
		
		for ($i = 0; $i < 9; $i++) {
			$orden_tmp = rand(1, 1000);
			$carta_tmp = $lista[$i];
			$query = $this->connect()->query("INSERT INTO Memoria (Id, Cod_session, Carta, Fecha, Abierto, Orden) VALUES (NULL,'$session','$carta_tmp',$fecha,'0','$orden_tmp')");
		}
		
		return $query;
	}

    function obtener_Ranking(){
		date_default_timezone_set('America/Lima');
        $actual_fecha = date('Y-m');
		
        $query = $this->connect()->query("SELECT * FROM Ranking WHERE (Fecha BETWEEN '$actual_fecha-01 00:00:00' AND '$actual_fecha-31 23:59:59') ORDER BY Tiempo ASC LIMIT 10");
        return $query;
    }
	
	function buscar_marca($tiempo){
		date_default_timezone_set('America/Lima');
        $actual_fecha = date('Y-m');
		
        $query = $this->connect()->query("SELECT COUNT(*) as Total FROM Ranking WHERE (Fecha BETWEEN '$actual_fecha-01 00:00:00' AND '$actual_fecha-31 23:59:59') AND Tiempo < '0000-00-00 $tiempo'");
		return $query;
	}
	
	function insertar_ranking($nombre, $dni, $correo, $tiempo){
		date_default_timezone_set('America/Lima');
        $fecha = date('"Y/m/d H:i:s"');
		
		$query = $this->connect()->query("INSERT INTO Ranking (Id, Nombre, Dni, Fecha, Tiempo, Correo) VALUES (NULL,'$nombre','$dni',$fecha,'0000-00-00 $tiempo','$correo')");
		return $query;
	}

}

?>	