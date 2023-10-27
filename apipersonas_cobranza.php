<?php
session_start();
include_once 'persona.php';
include_once 'mini_test.php';

class ApiPersonas{
	
    function getPasos2_cobranza($step, $funcionario){
        $persona = new Persona();
        $res = $persona->obtenerPasos2_cobranza($step, $funcionario);
        
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
                
                
                echo "<div class='card mb-3' style='max-width: 18rem;' draggable='true' ondragstart='drag(event)'  id='" . $row['Solicitud'] . "'>\n";
                echo "<div class='card-header' ondrop='return false' data-toggle='modal' data-target='#Mod" . $row['Solicitud'] . "'><small><b>" . $row['Socio'] . " - " . $row['Nombre'] . "</b> - " . $row['DP'] . " === " .  strtoupper($row['Observaciones']) . " S/ " . number_format($row['Saldo_credito'],0) . " </small></div>\n"; 
	            echo "</div>\n\n";
            }
        }
    }
	
	function sendPost_sms_masivian_api($celular, $mensaje){
		$new = new CurlRequest();
		$resultado = $new ->sendPost_sms_masivian($celular, $mensaje);
	}

	function getPasos2_cobranza_cuenta($step, $grupo){
        $persona = new Persona();
        $res = $persona->obtenerPasos2_cobranza_cuenta($step, $grupo);
		$row = $res->fetch(PDO::FETCH_ASSOC);
			
		$tmp = $row['Total'];
        
        echo "[" . $tmp . " cards]";
    }	
	
	function getModals_cobranza2($grupo){
        $persona = new Persona();
        $res = $persona->obtenerPasos2_cobranza_todos($grupo);
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
                
               echo "<div class='modal fade' id='Mod" . $row['Solicitud'] . "' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>" . "\n";
                echo "<div class='modal-dialog modal-dialog-centered' role='document'>" . "\n";
                echo "<div class='modal-content'>" . "\n";
                echo "<div class='modal-header'>". "\n"; 
                echo "<h5 class='modal-title' id='exampleModalLongTitle'> Cod [" . $row['Socio'] . "] - " . $row['Nombre'] . "<br>Solicitud [" . $row['Solicitud'] . "]<br>Intereses: " . $row['Moneda'] . " " . $row['Intereses'] . " - Mora: " . $row['Moneda'] . " " . $row['Mora'] . "  - Total: " . $row['Moneda'] . " " . $row['Total'] . "<br>Saldo: " . $row['Moneda'] . " " . $row['Saldo'] . " - Saldo credito: " . $row['Moneda'] . " " . $row['Saldo_credito'] . "<br>DP: " . $row['DP'] . " - DV: " . $row['DV'] . " dias<br>Tipo: " . $row['Tipo'] . " - Grupo: " . $row['Grupo'] . "<br>Celular [" . $row['Celular'] . "] - Correo: [" . $row['Correo'] . "]<br>Carga: " . $row['Fecha']  . "<br>Ult. Modificación: " . $row['Fecha_2'] .  "<br>\n";
				
				echo "</h5>" . "\n";
				
                echo "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>" . "\n"; 
                echo "<span aria-hidden='true'>&times;</span>" . "\n"; 
                echo "</button>" . "\n";
                echo "</div>". "\n";   
                echo "<div class='modal-body'>" . "\n";
				echo "Observaciones:<br>";
                echo "<textarea class='form-control' id='text" . $row['Solicitud'] . "'>" . strtoupper($row['Observaciones']) . "</textarea>" . "\n";
             
				echo "<br>". "\n";

		
                echo "</div>" . "\n";
                echo "<div class='modal-footer'>" . "\n";
				if($row['Paso']=="div2"){
				$pedazos = explode(" ", $row['Nombre']);
				$Nom_corto = $pedazos[0] . " (Cod: " . $row['Socio'] . ")";
				$Monto_sms = $row['Moneda'] . " " . number_format($row['Total'],0,'.','');
				$tipo=1;
				
				echo "<button type='button' data-dismiss='modal' class='btn btn-outline-success btn-xs' onclick=\"sms('" . $row['Celular'] . "','" . $row['DV'] . "','" . $Monto_sms . "','" . $Nom_corto . "','" . $tipo . "')\">SMS (4-30)</button> |". "\n";
				}
				
                echo "<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>" . "\n";
                echo "<button type='button' class='btn btn-primary' data-dismiss='modal' onclick='graba(" . $row['Solicitud'] . ")'>Guardar</button>" . "\n";
                echo "</div>" . "\n";
                echo "</div>" . "\n";
                echo "</div>" . "\n";
		        echo "</div>" . "\n\n";
                
            }
        }
    }
	
	function actualiza_observacion_cobranza($id, $obs){
        $persona = new Persona();
        $res = $persona->update_Obs_cobranza($id, $obs);
    }
	

    
}

?>