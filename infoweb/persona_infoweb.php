<?php

include_once 'db.php';

class Persona extends DB{

	function ingresa_json($dni, $json){
		
		date_default_timezone_set('America/Lima');
		$fecha = date('"Y/m/d H:i:s"');

		$linea = "INSERT INTO Infoweb (Id, Doi, Json, Fecha) VALUES (NULL, '$dni', '$json', $fecha)";
		$query = $this->connect()->prepare($linea);
		$query->execute([]);
	}
	
	function update_json($dni, $json){
		
		date_default_timezone_set('America/Lima');
		$fecha = date('"Y/m/d H:i:s"');

		$linea = "UPDATE Infoweb SET Json='$json', Fecha=$fecha WHERE Doi='$dni'";
		$query = $this->connect()->prepare($linea);
		$query->execute([]);
	}
	
	function ingresa_json_sentinel($dni, $json){
		
		date_default_timezone_set('America/Lima');
		$fecha = date('"Y/m/d H:i:s"');

		$linea = "INSERT INTO Sentinel (Id, Doi, Json, Fecha) VALUES (NULL, '$dni', '$json', $fecha)";
		$query = $this->connect()->prepare($linea);
		$query->execute([]);
	}
	
	function update_json_sentinel($dni, $json){
		
		date_default_timezone_set('America/Lima');
		$fecha = date('"Y/m/d H:i:s"');

		$linea = "UPDATE Sentinel SET Json='$json', Fecha=$fecha WHERE Doi='$dni'";
		$query = $this->connect()->prepare($linea);
		$query->execute([]);
	}
	
	function consulta_doi($dni){
		
		$query = $this->connect()->query("SELECT * FROM Infoweb WHERE Doi='$dni'");
        return $query;
	}

	function consulta_doi_sentinel($dni){
		
		$query = $this->connect()->query("SELECT * FROM Sentinel WHERE Doi='$dni'");
        return $query;
	}
	
	function getListadoInfoweb_api($usuario){
		$i=1;$desc_tipo="";$nuevo="";
		
		$query = $this->connect()->query("SELECT * FROM Infoweb_reporte WHERE Usuario LIKE '%$usuario%' ORDER BY Fecha DESC LIMIT 15");
		
		
		if($query->rowCount()){
			echo "<center><table><tr><td><h3>Últimas consultas</h3></td></tr>";
			while ($row = $query->fetch(PDO::FETCH_ASSOC)){
				if($row['Colaborador']=="S")
					$desc_tipo = "<span style='color:red'>Colaborador</span>";
				else
					$desc_tipo = "<span style='color:blue'>Socio</span>";
				
				if($row['Nuevo']=="S")
					$nuevo=" <span class='label label-warning'>nuevo</span>";
				else
					$nuevo=" <span class='label label-primary'>repetido</span>";
				
				if($i<10)
					$i_print = "0" . $i;
				else
					$i_print = $i;
				
				echo "<tr><td>" . $i_print . ".- [" . $row['Fecha'] . "] " . $row['Usuario'] . " " . $desc_tipo . " [" . $row['Doi'] . "]" . $nuevo . "</td></tr>";
				
				$i++;
			}
			
			echo "</table></center>";
		}
		
	}
	
	function total_mes(){
		date_default_timezone_set('America/Lima');
		$fecha = date('"Y/m/d H:i:s"');
		$actual_mes = date('Y-m');
		
		$query = $this->connect()->query("SELECT COUNT(Usuario) as TotalConsulta FROM Infoweb_reporte WHERE (Fecha BETWEEN '$actual_mes-01 00:00:00' AND '$actual_mes-31 23:59:59') AND Nuevo='S'");
		
		$row = $query->fetch(PDO::FETCH_ASSOC);
		$totalConsulta_nuevos = $row['TotalConsulta'];
		
		$query = $this->connect()->query("SELECT COUNT(Usuario) as TotalConsulta FROM Infoweb_reporte WHERE (Fecha BETWEEN '$actual_mes-01 00:00:00' AND '$actual_mes-31 23:59:59') AND Nuevo='N'");
		
		$row = $query->fetch(PDO::FETCH_ASSOC);
		$totalConsulta_repetidos = $row['TotalConsulta'];
		
		echo "<h3>Nuevos [" . $totalConsulta_nuevos . "] Repetidos [" . $totalConsulta_repetidos . "]</h3>";
	}
	
	function ingresa_repo($dni, $usuario, $colaborador, $nuevo){
		
		date_default_timezone_set('America/Lima');
		$fecha = date('"Y/m/d H:i:s"');

		$linea = "INSERT INTO Infoweb_reporte (Id, Doi, Fecha, Usuario, Colaborador, Nuevo) VALUES (NULL, '$dni', $fecha, '$usuario', '$colaborador', '$nuevo')";
		$query = $this->connect()->prepare($linea);
		$query->execute([]);
	}
	
	function consultas_mes($usuario){
		date_default_timezone_set('America/Lima');
		$actual_mes = date('Y-m');
		$mes_letra = strtoupper(strftime("%b"));
		
		
		$query = $this->connect()->query("SELECT * FROM Infoweb_reporte WHERE (Fecha BETWEEN '$actual_mes-01 00:00:00' AND '$actual_mes-31 23:59:59') AND Usuario='$usuario'");
		
		$nuevo=0;$no_nuevo=0;$total=0;
		
		if($query->rowCount()){
			while ($row = $query->fetch(PDO::FETCH_ASSOC)){
				if($row['Nuevo']=="S")
					$nuevo++;
				if($row['Nuevo']=="N")
					$no_nuevo++;
				
				
				$total++;
			}
		}
		
		echo "<p> <span class='label label-warning'>nuevo</span> [" . $nuevo . "] <span class='label label-primary'>repetido</span> [" . $no_nuevo . "] Total " . $mes_letra . ": " . $total . "</p>";
	}
	
	function consultas_mes_pasado(){
		date_default_timezone_set('America/Lima');
		$actual_mes = date('Y-m',strtotime('first day of last month'));
		$mes_letra = strtoupper(strftime("%b",strtotime('first day of last month')));
		
		
		$query = $this->connect()->query("SELECT * FROM Infoweb_reporte WHERE (Fecha BETWEEN '$actual_mes-01 00:00:00' AND '$actual_mes-31 23:59:59')");
		
		$nuevo=0;$no_nuevo=0;$total=0;
		
		if($query->rowCount()){
			while ($row = $query->fetch(PDO::FETCH_ASSOC)){
				if($row['Nuevo']=="S")
					$nuevo++;
				if($row['Nuevo']=="N")
					$no_nuevo++;
				
				
				$total++;
			}
		}
		
		echo "<p> <span class='label label-warning'>nuevo</span> [" . $nuevo . "] <span class='label label-primary'>repetido</span> [" . $no_nuevo . "] Total " . $mes_letra . ": " . $total . "</p>";
	}
	
}

?>