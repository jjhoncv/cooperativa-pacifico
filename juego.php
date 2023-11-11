<?php

include_once 'db.php';


class Juego extends DB{

    function consultaSesion($sesion, $num){
        
        date_default_timezone_set('America/Lima');
        $actual_fecha = date('Y-m-d H:i:s');
        //$query = $this->connect()->query("UPDATE Persona SET Paso='$paso', Fecha_2='$actual_fecha' WHERE Id='$id'");
        
        
        $linea = "SELECT count(id) as total FROM Doble WHERE Cod_session=$session";
        $query = $this->connect()->prepare($linea);
		$query->execute();
		
		$fila = $query->fetch(PDO::FETCH_ASSOC);
		$insertar = rand_int(1, $num);
		
		if(intval($fila['total'])!=0) 
		{
		    $linea = "INSERT INTO Doble (id, Cod_session, Numero, Fecha) VALUES (NULL, '$sesion','$insertar','$actual_fecha')";
		    $query = $this->connect()->prepare($linea);
			$query->execute([]);	
		}
		else
		{
            $bucle = true;
            
            while($bucle)
            {
                
                $linea = "SELECT count(id) as total2 FROM Doble WHERE Cod_session=$session AND Numero =$insertar";
                $query = $this->connect()->prepare($linea);
        		$query->execute();
        		
        		$fila2 = $query->fetch(PDO::FETCH_ASSOC);
        		if( $fila2['total2']==0 ){
        		    $linea = "INSERT INTO Doble (id, Cod_session, Numero, Fecha) VALUES (NULL, $sesion, $insertar,'$actual_fecha')";
        		    $query = $this->connect()->prepare($linea);
        			$query->execute([]);
        			$bucle = false;
        		}
        		else{
        		   $insertar = rand_int(1, $num); 
        		}
            }
		}
    }

    
    

}

?>