<?php
session_start();
include_once 'persona.php';
include_once 'mini_test.php';

class ApiPersonas{
	
    function getListadoDesemb_infogas(){
        $persona = new Persona();
        $res = $persona->obtListadoDesemb_infogas();
        $i=1;
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
                if(substr($row['Funcionario'],0,5)=="ALVAR"){
                    $tmp = "AI";
                    $color = "success";
                }
                if(substr($row['Funcionario'],0,5)=="KAORI"){
                    $tmp = "KU";
                    $color = "danger";
                }
                if(substr($row['Funcionario'],0,5)=="JOHAN"){
                    $tmp = "JD";
                    $color = "primary";
                }
                
                echo $i++ . ".- " . substr($row['Nombres'],0,22) . " [" . $row['Dni'] . "] - S/ " .  number_format($row['Monto'],0) . " - " . $row['Utm'] . " <button type='button' class='btn btn-" . $color . " btn-xs'>". $tmp . "</button><br>";    
            }
        }
    }

	function getImpDesemb_infogas($funcionario){
        $persona = new Persona();
        
            $res = $persona->imp_desembolsados_infogas($funcionario);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            $tmp = number_format($row['TotalDesem'],0);
            
        echo $tmp;

    }
	
	function update_infogas($dni, $pregunta1, $pregunta2, $pregunta3, $pregunta4, $pregunta5, $pregunta6, $pregunta7, $pregunta8){
		$persona = new Persona();

        $res = $persona->update_infogas_persona($dni, $pregunta1, $pregunta2, $pregunta3, $pregunta4, $pregunta5, $pregunta6, $pregunta7, $pregunta8);
	}

	function getTotDesemb_infogas($funcionario){
        $persona = new Persona();
        
            $res = $persona->total_desembolsados_infogas($funcionario);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            $tmp = $row['TotalDesem'];
            
        echo $tmp;

    }
	
	function funnel_micro($paso, $funcionario){
		$persona = new Persona();
		
            $res = $persona->funnel_micro_importe($paso, $funcionario);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            
            $res1 = $persona->funnel_micro_cantidad($paso, $funcionario);
            $row1 = $res1->fetch(PDO::FETCH_ASSOC);

            $tmp = number_format($row['Total'],0,'.',',');
            $tmp1 = $row1['Total'];
		
			echo "S/ " . $tmp . " (" . $tmp1 . ")";
	}
	
	function actualiza_funcionario_micro($xiomi, $kaori, $johann){
        $persona = new Persona();
        $res = $persona->update_funcionario_micro($xiomi, $kaori, $johann);
    }
	
    function getDataPreaprobados_infogas($cant, $funcionario){
        $persona = new Persona();
        $preaprob = 0;
        
                  
            $res = $persona->obtenerPreAprobados_por_funcionario($cant, $funcionario);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            $tmp = $row['Total'];
            
            $preaprob =  $preaprob + $tmp;
        
		echo "[" . $preaprob . "]";
        
    }
	
	function consulta_micro($funcionario){
		$persona = new Persona();
        $res = $persona->activo_funcionario_micro($funcionario);
		$row = $res->fetch(PDO::FETCH_ASSOC);
		$tmp = $row['Activo'];	
		
		$imprime = "";
		
		if($tmp=="n")
			$imprime = "On/Off <input type='checkbox' id='$funcionario'>" . "\n";
		else
			$imprime = "On/Off <input type='checkbox' id='$funcionario' checked>" . "\n";;
		
			echo "<label class='switch'>" . "\n";
			echo $imprime;
			echo "<span class='slider round'></span>" . "\n";
			echo "</label>" . "\n";
	}	
	
    function tarjetasPendientes($funcionario){
        $persona = new Persona();
        
            $res = $persona->tarjetasPendientes_persona_infogas($funcionario, "div1");
            $row = $res->fetch(PDO::FETCH_ASSOC);
			
			$res1 = $persona->tarjetasPendientes_persona_infogas($funcionario, "div2");
            $row1 = $res1->fetch(PDO::FETCH_ASSOC);
            
            $tmp = $row1['Total'] + ($row['Total']/2);
            
        echo $tmp;

    }
	
	function tarjetasPendientes_sandbox($funcionario){
        $persona = new Persona();
        
            $res = $persona->tarjetasPendientes_persona_infogas($funcionario, "div1");
            $row = $res->fetch(PDO::FETCH_ASSOC);
            
            $tmp = ($row['Total']/2);
			
			$res1 = $persona->tarjetasPendientes_persona_infogas($funcionario, "div2");
            $row1 = $res1->fetch(PDO::FETCH_ASSOC);
            
            $tmp1 = row1['Total'];
            
			
			$res9 = $persona->activo_funcionario_micro($funcionario);
            $row9 = $res9->fetch(PDO::FETCH_ASSOC);
			

			$tmp9 = $row9['Activo'];
			
			if($tmp9=="n")
				$_SESSION["$funcionario"] = 100;
			else          
				$_SESSION["$funcionario"] = ($tmp + $tmp1);

    }
	
	function repetidoDni_api_infogas($dni){
        
        $persona = new Persona();
        $res = $persona->repetidoDni_infogas($dni);
        $row = $res->fetch(PDO::FETCH_ASSOC);
        $tmp = $row['Total'];
        
        if($tmp>0){
            $_SESSION["repetido_infogas"] = "false";
        }else{
            $_SESSION["repetido_infogas"] = "true";
        }
    }

    function add_infogas($item){
        $persona = new Persona();

        $res = $persona->nuevaPersona_Infogas($item);
        //$this->exito('Se ingreso el registro de manera correcta');
    }

	function getAll_infogas($keyword){
        $persona = new Persona();
        $res = $persona->obtenerPersonas_infogas($keyword);
        
        
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
                $variable_bol=0;$situa="";
				if($row['Situacion']=="NOR"){
					$situa = "<button type='button' class='btn btn-success btn-xs'>NOR</button>";
				}
				if($row['Situacion']=="CPP"){
					$situa = "<button type='button' class='btn btn-warning btn-xs'>CPP</button>";
				}
				if($row['Situacion']=="SC"){
					$situa = "<button type='button' class='btn btn-default btn-xs'>SCA</button>";
				}
				if($row['Situacion']=="DEF"){
					$situa = "<button type='button' class='btn btn-danger btn-xs'>DEF</button>";
				}
				if($row['Situacion']=="DUD"){
					$situa = "<button type='button' class='btn btn-danger btn-xs'>DUD</button>";
				}
				if($row['Situacion']=="PER"){
					$situa = "<button type='button' class='btn btn-dark btn-xs'>PER</button>";
				}
                echo "<tr>";
                echo "<td>" . $row['Dni'] . " / " . $row['Fecha'] . "</td>";
                echo "<td>" . substr($row['Nombres'],0,25) . " - " . $situa . " - " . $row['Utm'] . " Diario [S/" . number_format($row['Ingreso_diario'],0) . "] - Impagos [S/". number_format($row['Deudas_impagas'],0) . "] Deuda [S/" . number_format($row['Deuda_sistema'],0) . "] Taxi [" . $row['Es_taxista'] . "] GNV [" . $row['Vehiculo_gnv'] . "] Placa [" . $row['Placa'] . "]</td>";
                if($row['Estado']=="PRE-APROBADO")
                {
                    echo "<td><span style='color:blue'>" . $row['Estado'] . " / " . $row['Funcionario'] . "</span></td>";
                    $variable_bol=1;
                }
                if($row['Estado']=="NO CALIFICA")
                {
                    echo "<td><span> ❌ / " . $row['Observaciones'] . "</span></td>";
                    $variable_bol=1;
                }
                if($variable_bol==0)
                {
                    echo "<td>" . $row['Estado'] . " / " . $row['Funcionario'] . "</td>";
                }
                echo "<td>" . substr($row['Celular'],-9) . "</td>";
                echo "</tr>";
            }
        }
    }

	function getPasos2_infogas($step, $funcionario){
        $persona = new Persona();
        $res = $persona->obtenerPasos2_infogas($step, $funcionario);
        
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
                $tmp = "";
                $color = "";
                if(substr($row['Funcionario'],0,5)=="ALVAR"){
                    $tmp = "AI";
                    $color = "success";
                }
                if(substr($row['Funcionario'],0,5)=="KAORI"){
                    $tmp = "KU";
                    $color = "danger";
                }
                if(substr($row['Funcionario'],0,5)=="JOHAN"){
                    $tmp = "JD";
                    $color = "primary";
                }
				
				$check = "";
				if($row['Placa_estado']=="sin_pre"){
                    $check = " 🚗✅";
                }
				
				
				$botoncompletado="";
				if($row['Pregunta_1']!="")
					$botoncompletado = " <button type='button' class='btn btn-warning btn-xs'>Completo 2°Paso</button>";
					
                echo "<div class='card mb-3" . $colorcaja . "' style='max-width: 18rem;' draggable='true' ondragstart='drag(event)'  id='" . $row['Id'] . "'>\n";
                echo "<div class='card-header' ondrop='return false' data-toggle='modal' data-target='#Mod" . $row['Id'] . "'><small><b>" . $row['Dni'] . " - " . $row['Nombres'] . "</b> - " . $row['Fecha'] . " === " .  strtoupper($row['Observaciones']) . " S/ " . number_format($row['Monto'],0) . " </small><button type='button' class='btn btn-" . $color . " btn-xs'>". $tmp . "</button>" . $botoncompletado . $check . "</div>\n"; 
	            echo "</div>\n\n";
            }
        }
    }
	
	function getPasos3_infogas($step, $funcionario){
        $persona = new Persona();
        $res = $persona->obtenerPasos2_desemb_infogas($step, $funcionario);
        
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
                $tmp = "";
                $color = "";
                if(substr($row['Funcionario'],0,5)=="ALVAR"){
                    $tmp = "AI";
                    $color = "success";
                }
                if(substr($row['Funcionario'],0,5)=="KAORI"){
                    $tmp = "KU";
                    $color = "danger";
                }
                if(substr($row['Funcionario'],0,5)=="JOHAN"){
                    $tmp = "JD";
                    $color = "primary";
                }
                echo "<div class='card mb-3 bg-info' style='max-width: 18rem;' draggable='true' ondragstart='drag(event)'  id='" . $row['Id'] . "'>\n";
                echo "<div class='card-header' ondrop='return false' data-toggle='modal' data-target='#Mod" . $row['Id'] . "'><small><b>" . $row['Dni'] . " - " . $row['Nombres'] . "</b> - " . $row['Fecha'] . " === " .  strtoupper($row['Observaciones']) . " S/ " . number_format($row['Monto'],0) . " </small><button type='button' class='btn btn-" . $color . " btn-xs'>". $tmp . "</button></div>\n"; 
	            echo "</div>\n\n";
            }
        }
    }
	
	function getPasos2_descartados_infogas($step, $funcionario){
        $persona = new Persona();
        $res = $persona->obtenerPasos2_descartados_infogas($step, $funcionario);
        
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
                $tmp = "";
                $color = "";
                if(substr($row['Funcionario'],0,5)=="ALVAR"){
                    $tmp = "AI";
                    $color = "success";
                }
                if(substr($row['Funcionario'],0,5)=="KAORI"){
                    $tmp = "KU";
                    $color = "danger";
                }
                if(substr($row['Funcionario'],0,5)=="JOHAN"){
                    $tmp = "JD";
                    $color = "primary";
                }
                echo "<div class='card mb-3' style='max-width: 18rem;' draggable='true' ondragstart='drag(event)'  id='" . $row['Id'] . "'>\n";
                echo "<div class='card-header' ondrop='return false' data-toggle='modal' data-target='#Mod" . $row['Id'] . "'><small><b>" . $row['Dni'] . " - " . $row['Nombres'] . "</b> - " . $row['Fecha'] . " === " .  strtoupper($row['Observaciones']) . " S/ " . number_format($row['Monto'],0) . " </small><button type='button' class='btn btn-" . $color . " btn-xs'>". $tmp . "</button></div>\n"; 
	            echo "</div>\n\n";
            }
        }
    }
	
	function getModals_infogas($funcionario){
        $persona = new Persona();
        $res = $persona->obtenerModals_infogas($funcionario);
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
                $sex ="";$cal="";$utm="";$obs_agencias="";$check="";
                if($row['Sexo']=="MASCULINO"){
                    $sex = "👨";
                }
                if($row['Sexo']=="FEMENINO"){
                    $sex = "👩";
                }
                
                $AnoAct = date('Y');
	            $edad = $AnoAct - $row['Nacimiento'];
	            
	            if($row['Situacion']=="NOR"){
	                $cal = "<button type=button class=\"btn btn-success btn-xs\">NOR</button>";
	            }
	            if($row['Situacion']=="CPP"){
	                $cal = "<button type=button class=\"btn btn-warning btn-xs\">CPP</button>";
	            }
	            if($row['Situacion']=="DUD"){
	                $cal = "<button type=button class=\"btn btn-danger btn-xs\">DUD</button>";
	            }
	            if($row['Situacion']=="DEF"){
	                $cal = "<button type=button class=\"btn btn-danger btn-xs\">DEF</button>";
	            }
	            if($row['Situacion']=="PER"){
	                $cal = "<button type=button class=\"btn btn-dark btn-xs\">PER</button>";
	            }
	            if($row['Situacion']=="SC"){
	                $cal = "<button type=button class=\"btn btn-secondary btn-xs\">SCA</button>";
	            }
                
                if($row['Nombre_empresa']==""){
                    $utm = "Organico";
                }
                else{
                    $utm = $row['Nombre_empresa'];
                }
				
				if($row['Placa_estado']=="sin_pre"){
                    $check = " 🚗✅";
                }
				if($row['Placa_estado']!="sin_pre"){
                    $check = " ❌";
                }
                
                $nom_tmp = ucfirst(strtolower(trim(substr($row['Nombres'],strpos($row['Nombres'],",")+1))));
                
                echo "<div class='modal fade' id='Mod" . $row['Id'] . "' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>" . "\n";
                echo "<div class='modal-dialog modal-dialog-centered' role='document'>" . "\n";
                echo "<div class='modal-content'>" . "\n";
                echo "<div class='modal-header'>". "\n"; 
                echo "<h5 class='modal-title' id='exampleModalLongTitle'>" . $sex . " [" . $edad . " años] DNI [" . $row['Dni'] . "] - " . $row['Nombres'] . "<br>" . $cal . " Deudas Impagas S/ " . $row['Deudas_impagas'] . " Deuda en el Sistema S/ " . $row['Deuda_sistema'] . " <br>Celular [" . $row['Celular'] . "]<br>Placa [" . strtoupper($row['Placa']) . "]" . $check . "<br>" . $row['Fecha']  . " Origen [" . $utm . "]<br>Ult. Modificación " . $row['Fecha_2'] .  "<br>\n";
				echo "<a href='/score?dni=" . $row['Dni'] . "' target='_blank'>Radar Sentinel</a><br><br>"."\n";
				
				echo "¿Cuánto abastece en promedio de GNV? Rpta <b>" . $row['Pregunta_1'] . "</b><br>"."\n";
				echo "¿Cuántos kilómetros recorre diariamente? Rpta <b>" . $row['Pregunta_2'] . "</b><br>"."\n";
				echo "¿Cuántos son sus ingresos diarios? Rpta <b>" . $row['Pregunta_3'] . "</b><br>"."\n";
				echo "¿Cuántas horas maneja diariamente? Rpta <b>" . $row['Pregunta_4'] . "</b><br>"."\n";
				echo "Indicar cuanto gasta en alimenación al mes Rpta <b>" . $row['Pregunta_5'] . "</b><br>"."\n";
				echo "Indicar el número de familiares que tiene a su cargo Rpta <b>" . $row['Pregunta_6'] . "</b><br>"."\n";
				echo "¿Cuánto gasta en servicios básicos? Rpta <b>" . $row['Pregunta_7'] . "</b><br>"."\n";
				echo "¿Cuánto gasta en alquiler? Rpta <b>" . $row['Pregunta_8'] . "</b><br>"."\n";
				echo "</h5>" . "\n";
                echo "</div>". "\n";   
                echo "<div class='modal-body'>" . "\n";
				
				$respuesta1=0;$respuesta2=0;$respuesta3=0;

				$respuesta1 = ($row['Pregunta_1']*100)/16.6*23*0.95;
				$respuesta2 = ($row['Pregunta_2']*0.95)*23;
				$respuesta3 = ($row['Pregunta_3']*23);
				
				echo "<table class='table table-responsive table-striped'>";
				echo "<thead>";
				echo "<tr><th>Pregunta 1</th><th>Pregunta 2</th><th>Pregunta 3</th></tr>";
				echo "</thead><tbody>";
				echo "<tr><td>S/ " . number_format($respuesta1,0,'.',',') . "</td><td>S/ " . number_format($respuesta2,0,'.',',') . "</td><td>S/ ". number_format($respuesta3,0,'.',',') ."</td></tr>";
				echo "</tbody></table>";
				
				echo "<table class='table table-responsive table-striped'>";
				echo "<tr><th>Ingreso</th><td>" . min($respuesta1, $respuesta2, $respuesta3) . "</td></tr>";
				echo "<tr><th>Costo GNV</th><td>xxxx</td></tr>";
				echo "<tr><th>Mantenimiento auto</th><td>xxxx</td></tr>";
				echo "<tr><th>UTILIDAD BRUTA</th><td>xxxx</td></tr>";
				echo "<tr><th>Alimentación</th><td>xxxx</td></tr>";
				echo "<tr><th>Gastos Servicios</th><td>xxxx</td></tr>";
				echo "<tr><th>Gastos vivienda</th><td>xxxx</td></tr>";
				echo "<tr><th>Gastos financiero</th><td>xxxx</td></tr>";
				echo "<tr><th>Excedente</th><td>xxxx</td></tr>";
				echo "<tr><th>Cuota Coopac</th><td>xxxx</td></tr>";
				echo "</tbody></table>";

				
                $div1="";$div2="";$div3="";$div4="";$div5="";$div6="";$div7="";
                if($row['Paso']=="div1"){
                    $div1="selected ";
                }
                if($row['Paso']=="div2"){
                    $div2="selected ";
                }
                if($row['Paso']=="div3"){
                    $div3="selected ";
                }
                if($row['Paso']=="div4"){
                    $div4="selected ";
                }
                if($row['Paso']=="div5"){
                    $div5="selected ";
                }
                if($row['Paso']=="div6"){
                    $div6="selected ";
                }
                if($row['Paso']=="div7"){
                    $div7="selected ";
                }
				$placa_est1="";$placa_est2="";$placa_est3="";
				if($row['Placa_estado']=="sin_eva"){
                    $placa_est1="selected ";
                }
				if($row['Placa_estado']=="con_pre"){
                    $placa_est2="selected ";
                }
				if($row['Placa_estado']=="sin_pre"){
                    $placa_est3="selected ";
                }
				
                echo "<textarea class='form-control' id='text" . $row['Id'] . "'>" . strtoupper($row['Observaciones']) . "</textarea>" . "\n";
                echo "Monto a prestar S/ <input type='text' class='form-control' id='mont" . $row['Id'] ."' value='" . number_format($row['Monto'],0,'.','') . "'><br>" . "\n";
				
				$funcX="";$funcK="";$funcJ="";$correo_f="";$sms_func="";
				if(substr($row['Funcionario'],0,5)=="ALVAR"){
                    $funcX="selected ";
					$correo_f="alvaro.ingaruca@cp.com.pe";
					$sms_func = " funcionario asignado es Alvaro Ingaruca,";
                }
                if(substr($row['Funcionario'],0,5)=="KAORI"){
                    $funcK="selected ";
					$correo_f="kaori.urbina@cp.com.pe";
					$sms_func = " funcionaria asignada es Kaori Urbina,";
                }
				if(substr($row['Funcionario'],0,5)=="JOHAN"){
                    $funcJ="selected ";
					$correo_f="johann.diaz@cp.com.pe";
					$sms_func = " funcionario asignado es Johann Diaz,";
                }
				
                echo "<select class='form-select-lg' aria-label='Default select example' id='combo" .$row['Id']. "'>" . "\n";
                echo "<option " . $div1. "value='div1'>Por Contactar</option>". "\n";
                echo "<option " . $div2. "value='div2'>En Evaluación</option>". "\n";
                echo "<option " . $div3. "value='div3'>En Verificaciones</option>". "\n";
                echo "<option " . $div4. "value='div4'>En Revisión</option>". "\n";
                echo "<option " . $div5. "value='div5'>Firma de Crédito</option>". "\n";
                echo "<option " . $div6. "value='div6'>Desembolsado</option>". "\n";
                echo "<option " . $div7. "value='div7'>Descartados</option>". "\n";
                echo "</select>";
				echo " ";
				echo "Placa <select class='form-select-lg' aria-label='Default select example' id='placa" .$row['Id']. "'>" . "\n";
                echo "<option " . $placa_est1. "value='sin_eva'>Sin evaluar</option>". "\n";
                echo "<option " . $placa_est2. "value='con_pre'>Con préstamo GNV</option>". "\n";
                echo "<option " . $placa_est3. "value='sin_pre'>Sin préstamo GNV</option>". "\n";
				echo "</select>";
				echo " ";
                echo "<select class='form-select-lg' aria-label='Default select example' id='func" .$row['Id']. "'>" . "\n";
                echo "<option " . $funcX. "value='ALVARO'>Alvaro</option>". "\n";
                echo "<option " . $funcK. "value='KAORI'>Kaori</option>". "\n";
                echo "<option " . $funcJ. "value='JOHANN'>Johann</option>". "\n";
                echo "</select>";

				echo "<br>Posponer <input type='date' value='' aria-label='Default select example' id='fec_ingreso" . $row['Id'] . "'>" . "\n";
				
				echo "<br>". "\n";
		
                echo "</div>" . "\n";
                echo "<div class='modal-footer'>" . "\n";
				if($row['Paso']=="div3"){
				echo "<button type='button' data-dismiss='modal' class='btn btn-outline-success btn-xs' onclick=\"mail('" . $row['Dni'] . "','" . $row['Nombres'] . "','" . number_format($row['Monto'],0,'.','') . "','" . $correo_f . "')\">Mail Agen</button> |". "\n";
				}
				echo "<button type='button' class='btn btn-outline-success btn-xs' onclick=\"sms('" . $row['Celular'] . "','" . $nom_tmp . "','" . $sms_func . "','2doForm')\">2do Form</button> |". "\n";
				
				echo "<button type='button' class='btn btn-outline-danger btn-xs' onclick=\"sms('" . $row['Celular'] . "','" . $nom_tmp . "','" . $sms_func . "','Nocalifica')\">SMS No Califica</button> |". "\n";
                echo "<button type='button' class='btn btn-outline-primary btn-xs' onclick=\"sms('" . $row['Celular'] . "','" . $nom_tmp . "','" . $sms_func . "','Preaprobado')\">SMS Preaprobado</button>". "\n";
                echo "<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>" . "\n";
                echo "<button type='button' class='btn btn-primary' data-dismiss='modal' onclick='graba(" . $row['Id'] . ")'>Guardar</button>" . "\n";
                echo "</div>" . "\n";
                echo "</div>" . "\n";
                echo "</div>" . "\n";
		        echo "</div>" . "\n\n";
            }
        }
                
                
    }
	
	function actualiza_paso_infogas($id, $paso){
        $persona = new Persona();
        $res = $persona->update_Paso_infogas($id, $paso);
    }
	
    function actualiza_observacion_infogas($id, $obs, $monto, $paso, $funcionario, $fec_ingreso, $placa_estado){
        $persona = new Persona();
        $res = $persona->update_Obs_infogas($id, $obs, $monto, $paso, $funcionario, $fec_ingreso, $placa_estado);
    }
	
	function sendPost_sms_masivian_api($celular, $mensaje){
		$new = new CurlRequest();
		$resultado = $new ->sendPost_sms_masivian($celular, $mensaje);
	}
	
    
}

?>