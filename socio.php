<?php

include_once 'db.php';

class Socio extends DB{
    
	function nuevo_socio($socio){
        date_default_timezone_set('America/Lima');
        $fecha = date('"Y/m/d H:i:s"');
        $id="div1";
        
        $query = $this->connect()->prepare('INSERT INTO NuevoSocio (Id, Doi, Nombres, ApePat, ApeMat, Paso, Fecha, Fecha_2) VALUES (NULL, :doi, :nombres, :apepat, :apemat, "' . $id . '",' . $fecha . ',' . $fecha . ')');
		$query->execute(['doi' => $socio['doi'], 'nombres' => $socio['nombres'], 'apepat' => $socio['apepat'], 'apemat' => $socio['apemat']]);
        return $query;
    }
	
	function consulta_socio_db($doi){
		$query = $this->connect()->query("SELECT * FROM NuevoSocio where Doi='" . $doi . "'");
		return $query;
	}

}



?>	