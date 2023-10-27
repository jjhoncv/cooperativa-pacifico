<?php
session_start();
include_once 'persona_doble.php';

class ApiPersonas{
    
	function abrir_carta_api($session, $equipo){
		$persona = new Persona();
        $res = $persona->abrir_carta($session);
		$i=1;$imprime="";$valor1=0;$valor2=0;
		
		if($equipo=="celular")
			$tamano = "50";
		else
			$tamano = "100";
		
		if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
					$id_tmp = $row['Id'];
					
					$imprime = $imprime . "<img src='images/" . $row['Numero'] . ".png' width='160' height='160'>";
					if($valor1==0)
						$valor1 = $row['Numero'];
					else
						$valor2 = $row['Numero'];
					
					$res1 = $persona->carta_abierta($session, $id_tmp);
					$row1 = $res1->fetch(PDO::FETCH_ASSOC);
					
					if($i++==2)
					{
						$res2 = $persona->busca_combinacion($valor1, $valor2);
						$row2 = $res2->fetch(PDO::FETCH_ASSOC);
						echo "<input type='hidden' id='resp' value='" . $row2['Resultado'] . "'>";
						echo "<input type='hidden' id='desc' value='" . $row2['Descripcion'] . "'>";
						echo "<table class='table table-responsive text-center'><tr><td>" . $imprime . "</td></tr></table>";
						echo "<table class='table table-responsive table-primary'>";
						
						$res2 = $persona->lista_elementos($valor1, $valor2);
						$j=1;
						
						if($res2->rowCount()){
							while ($row2 = $res2->fetch(PDO::FETCH_ASSOC)){
								$tmp_elemento = $row2['Nombre'];
							
								if($equipo=="celular")
								{
									if($j==1 or $j==4 or $j==7 or $j==10 or $j==13)
										echo "<tr>";
								
										echo "<td class='text-center'><button type='button' class='btn btn-light btn-xs' onclick='validar(\"" . $tmp_elemento . "\")'><img src='images/" . $tmp_elemento . ".png' width='" . $tamano . "' height='" . $tamano . "'></button></td>";
								
									if($j==3 or $j==6 or $j==9 or $j==12 or $j==15)
										echo "</tr>";
								}else{
									if($j==1 or $j==6 or $j==11)
										echo "<tr>";
								
										echo "<td class='text-center'><button type='button' class='btn btn-light btn-xs' onclick='validar(\"" . $tmp_elemento . "\")'><img src='images/" . $tmp_elemento . ".png' width='" . $tamano . "' height='" . $tamano . "'></button></td>";
								
									if($j==5 or $j==10 or $j==15)
										echo "</tr>";
								}
								
								$j++;
								
							}
						}
						echo "</table>";
						break;
					}
			}
		}
		else
			echo "<input type='hidden' id='resp' value='vacio'>";
	}
	
	function abrir_carta_memoria_api($session, $equipo){
		$persona = new Persona();
        $res = $persona->abrir_carta_memoria($session);
		$i=1;$imprime="";$valor1=0;$valor2=0;
		
		if($equipo=="celular")
			$tamano = "50";
		else
			$tamano = "100";
		
		if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
				echo $row['Carta'] . "<br>";	
			}
		}
		else
			echo "<input type='hidden' id='resp' value='vacio'>";
	}
	
	function empezar_otra_vez_api($session){
		$persona = new Persona();
        $res = $persona->empezar_otra_vez($session);
		echo "Nuevo juego";
	}
	
	function borrar_juego_api($session){
		$persona = new Persona();
        $res = $persona->borrar_juego($session);
		//echo "Juego Borrado";
	}
	
	function borrar_juego_memoria_api($session){
		$persona = new Persona();
        $res = $persona->borrar_juego_memoria($session);
		//echo "Juego Borrado";
	}
	
	function nuevo_juego_api($session){
		$persona = new Persona();
        $res = $persona->nuevo_juego($session);
		echo "<center><h4>Busca las dos figuras iguales, deten el tiempo haciendo un clic en la figura</h4><br><button type='button' class='btn btn-primary' data-dismiss='modal' onclick='abrir_carta_primera(" . $session . ")'>Empezar</button></center>";
	}
	
	function nuevo_juego_memoria_api($session){
		$persona = new Persona();
        $res = $persona->nuevo_juego_memoria($session);
		echo "<center><h4>Memoria</h4><br><button type='button' class='btn btn-primary' data-dismiss='modal' onclick='abrir_carta_primera(" . $session . ")'>Empezar</button></center>";
	}
	
	function ver_ranking($marca){
		$persona = new Persona();
        $res = $persona->obtener_Ranking();
		
		$marca_tmp = substr($marca,0,8) . "." . substr($marca,9);
		$res2 = $persona->buscar_marca($marca_tmp);
		$row2 = $res2->fetch(PDO::FETCH_ASSOC);
		$tmp2 = $row2['Total'];
		
		$i=1;
		if($res->rowCount()){
				echo "<center><table class='table table-responsive table-striped'>";
				echo "<thead>";
				echo "<tr><th colspan='4'>Mejores tiempos del mes</th></tr>";
				echo "<tr><th>Nro</th><th>Nombre/Nick</th><th>Tiempo</th><th>Fecha</th></tr>";
				echo "</thead>";
				echo "<tbody>";
			
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
				
				if($i<10)
					$numero = "0" . $i . ". ";
				
                echo "<tr><td>" . $numero . "</td><td>" . $row['Nombre'] . "</td><td>" . substr($row['Tiempo'],11) . "</td><td>" . $row['Fecha'] . "<td></tr>";
				$i++;
            }
				echo "</tbody>";
				echo "</table></center>";
        }
		
		if($tmp2<10){
			echo "<center><h3>Nueva Marca</h3><button type='button' class='btn btn-primary' data-toggle='modal' data-target='#nueva_marca'>Guarda tu marca</button></center><input type='hidden' id='marca' value='" . $marca_tmp . "'>";
		}else{
			echo "<center><button type='button' class='btn btn-danger' onclick='refrescar()'>Jugar nuevamente!!</button></center>";
		}
		
	}

	function insertar_ranking_api($nombre, $dni, $correo, $tiempo){
		$persona = new Persona();
        $res1 = $persona->insertar_ranking($nombre, $dni, $correo, $tiempo);
		
        $res = $persona->obtener_Ranking();
		
		$i=1;
		if($res->rowCount()){

				echo "<center><table class='table table-responsive table-striped'>";
				echo "<thead>";
				echo "<tr><th colspan='4'>Mejores tiempos del mes</th></tr>";
				echo "<tr><th>Nro</th><th>Nombre/Nick</th><th>Tiempo</th><th>Fecha</th></tr>";
				echo "</thead>";
				
				echo "<tbody>";
			
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
				
				if($i<10)
					$numero = "0" . $i . ". ";
				
                echo "<tr><td>" . $numero . "</td><td>" . $row['Nombre'] . "</td><td>" . substr($row['Tiempo'],11) . "</td><td>" . $row['Fecha'] . "<td></tr>";
				$i++;
            }
				echo "</tbody>";
				echo "</table></center>";

				echo "<center><button type='button' class='btn btn-danger' onclick='refrescar()'>Jugar!!</button></center>";
        }
	}
	
}

?>