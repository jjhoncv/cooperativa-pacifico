<?php
include_once 'persona.php';

class ScoreRequest{
    
    function getScore(){
        $persona = new Persona();
        $res = $persona->obtener_Score();
        
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
                $tmpDNI="";
                $tmpDNI = $row['Dni'];
					//$res = $persona->update_Score($tmpDNI);
					echo $tmpDNI . "<br>";
            }
        }
    }
    
}


?>