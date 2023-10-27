<?php
session_start();
include_once 'persona.php';
include_once 'mini_test.php';

class ApiPersonas{
	
    function getListadoDesemb_pdp(){
        $persona = new Persona();
        $res = $persona->obtListadoDesemb_abi();
        $i=1;
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
                if($row['Funcionario']=="Agente1"){
                    $tmp = "A1";
                    $color = "success";
                }
                if($row['Funcionario']=="Agente2"){
                    $tmp = "A2";
                    $color = "danger";
                }
                if($row['Funcionario']=="Agente3"){
                    $tmp = "A3";
                    $color = "primary";
                }
				if($row['Funcionario']=="Agente4"){
                    $tmp = "A4";
                    $color = "success";
                }
                if($row['Funcionario']=="Agente5"){
                    $tmp = "A5";
                    $color = "danger";
                }
                if($row['Funcionario']=="Agente6"){
                    $tmp = "A6";
                    $color = "primary";
                }
				if($row['Funcionario']=="Agente7"){
                    $tmp = "A7";
                    $color = "success";
                }
                if($row['Funcionario']=="Agente8"){
                    $tmp = "A8";
                    $color = "danger";
                }
                if($row['Funcionario']=="Agente9"){
                    $tmp = "A9";
                    $color = "primary";
                }
                
                echo $i++ . ".- " . substr($row['Nombres'],0,22) . " [" . $row['Dni'] . "] - S/ " .  number_format($row['Monto'],0) . " - " . $row['Tipo'] . " - " . $row['Convenio'] . " <button type='button' class='btn btn-" . $color . " btn-xs'>". $tmp . "</button><br>";    
            }
        }
    }

	function getImpDesemb_pdp($funcionario){
        $persona = new Persona();
        
            $res = $persona->imp_desembolsados_abi($funcionario);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            $tmp = number_format($row['TotalDesem'],0);
            
        echo $tmp;

    }

	function getTotDesemb_pdp($funcionario){
        $persona = new Persona();
        
            $res = $persona->total_desembolsados_abi($funcionario);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            $tmp = $row['TotalDesem'];
            
        echo $tmp;

    }
	
	function funnel_pdp($paso, $funcionario){
		$persona = new Persona();
		
            $res = $persona->funnel_pdp_importe_abi($paso, $funcionario);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            
            $res1 = $persona->funnel_pdp_cantidad_abi($paso, $funcionario);
            $row1 = $res1->fetch(PDO::FETCH_ASSOC);

            $tmp = number_format($row['Total'],0,'.',',');
            $tmp1 = $row1['Total'];
		
			echo "S/ " . $tmp . " (" . $tmp1 . ")";
	}
	
	function actualiza_funcionario_pdp($agente1, $agente2, $agente3){
        $persona = new Persona();
        $res = $persona->update_funcionario_abi($agente1, $agente2, $agente3);
    }
	
    function getDataPreaprobados_pdp($cant, $funcionario){
        $persona = new Persona();
        $preaprob = 0;
        
                  
            $res = $persona->obtenerPreAprobados_por_funcionario_abi($cant, $funcionario);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            $tmp = $row['Total'];
            
            $preaprob =  $preaprob + $tmp;
        
		echo "[" . $preaprob . "]";
        
    }
	
	function consulta_pdp($funcionario){
		$persona = new Persona();
        $res = $persona->activo_funcionario_abi($funcionario);
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
        
            $res = $persona->tarjetasPendientes_persona_abi($funcionario, "div1");
            $row = $res->fetch(PDO::FETCH_ASSOC);
			
			$res1 = $persona->tarjetasPendientes_persona_abi($funcionario, "div2");
            $row1 = $res1->fetch(PDO::FETCH_ASSOC);
            
            $tmp = $row1['Total'] + ($row['Total']/2);
            
        echo $tmp;

    }
	
	function tarjetasPendientes_sandbox($funcionario){
        $persona = new Persona();
        
            $res = $persona->tarjetasPendientes_persona_pdp($funcionario, "div1");
            $row = $res->fetch(PDO::FETCH_ASSOC);
            
            $tmp = ($row['Total']/2);
			
			$res1 = $persona->tarjetasPendientes_persona_pdp($funcionario, "div2");
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
	
	function repetidoDni_api_pdp($dni){
        
        $persona = new Persona();
        $res = $persona->repetidoDni_pdp($dni);
        $row = $res->fetch(PDO::FETCH_ASSOC);
        $tmp = $row['Total'];
        
        if($tmp>0){
            $_SESSION["repetido_pdp"] = "false";
        }else{
            $_SESSION["repetido_pdp"] = "true";
        }
    }

    function add_pdp($item){
        $persona = new Persona();

        $res = $persona->nuevaPersona_abi($item);
        //$this->exito('Se ingreso el registro de manera correcta');
    }

	function getAll_pdp($keyword){
        $persona = new Persona();
        $res = $persona->obtenerPersonas_abi($keyword);
        
        
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
                echo "<td>" . $row['Dni'] . " / " . $row['Fecha'] . " <button type='button' class='btn btn-danger btn-xs' data-toggle='modal' data-target='#EliminarTarjeta' onclick='setear(\"" . $row['Id'] . "\",\"" . $row['Dni'] . "\")'>X</button></td>";
                echo "<td>" . substr($row['Nombres'],0,25) . " - " . $situa . " - Sueldo [S/" . number_format($row['Sueldo_bruto'],0) . "] - Impagos [S/". number_format($row['Deudas_impagas'],0) . "] Deuda [S/" . number_format($row['Deuda_sistema'],0) . "]</td>";
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

	function getPasos2_pdp($step, $funcionario){
        $persona = new Persona();
        $res = $persona->obtenerPasos2_abi($step, $funcionario);
        
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
                $tmp = "";
                $color = "";
                if($row['Funcionario']=="Agente1"){
                    $tmp = "A1";
                    $color = "success";
                }
                if($row['Funcionario']=="Agente2"){
                    $tmp = "A2";
                    $color = "danger";
                }
                if($row['Funcionario']=="Agente3"){
                    $tmp = "A3";
                    $color = "primary";
                }
				if($row['Funcionario']=="Agente4"){
                    $tmp = "A4";
                    $color = "success";
                }
                if($row['Funcionario']=="Agente5"){
                    $tmp = "A5";
                    $color = "danger";
                }
                if($row['Funcionario']=="Agente6"){
                    $tmp = "A6";
                    $color = "primary";
                }
				if($row['Funcionario']=="Agente7"){
                    $tmp = "A7";
                    $color = "success";
                }
                if($row['Funcionario']=="Agente8"){
                    $tmp = "A8";
                    $color = "danger";
                }
                if($row['Funcionario']=="Agente9"){
                    $tmp = "A9";
                    $color = "primary";
                }
				$pos = strpos(strtoupper($row['Observaciones']), "OBS");
				
				if($pos===false)
					$urgente = "";
				else
					$urgente = " bg-danger text-white";	
				
                echo "<div class='card mb-3" . $urgente . "' style='max-width: 18rem;' draggable='true' ondragstart='drag(event)'  id='" . $row['Id'] . "'>\n";
                echo "<div class='card-header' ondrop='return false' data-toggle='modal' data-target='#Mod" . $row['Id'] . "'><small><b>" . $row['Dni'] . " - " . $row['Nombres'] . "</b> " . $pos . "- " . $row['Fecha'] . " === " .  strtoupper($row['Observaciones']) . " S/ " . number_format($row['Monto'],0) . " </small><button type='button' class='btn btn-" . $color . " btn-xs'>". $tmp . "</button></div>\n"; 
	            echo "</div>\n\n";
            }
        }
    }
	
	function getPasos3_pdp($step, $funcionario){
        $persona = new Persona();
        $res = $persona->obtenerPasos2_desemb_abi($step, $funcionario);
        
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
                $tmp = "";
                $color = "";
                if($row['Funcionario']=="Agente1"){
                    $tmp = "A1";
                    $color = "success";
                }
                if($row['Funcionario']=="Agente2"){
                    $tmp = "A2";
                    $color = "danger";
                }
                if($row['Funcionario']=="Agente3"){
                    $tmp = "A3";
                    $color = "primary";
                }
				if($row['Funcionario']=="Agente4"){
                    $tmp = "A4";
                    $color = "success";
                }
                if($row['Funcionario']=="Agente5"){
                    $tmp = "A5";
                    $color = "danger";
                }
                if($row['Funcionario']=="Agente6"){
                    $tmp = "A6";
                    $color = "primary";
                }
				if($row['Funcionario']=="Agente7"){
                    $tmp = "A7";
                    $color = "success";
                }
                if($row['Funcionario']=="Agente8"){
                    $tmp = "A8";
                    $color = "danger";
                }
                if($row['Funcionario']=="Agente9"){
                    $tmp = "A9";
                    $color = "primary";
                }
				
                echo "<div class='card mb-3 bg-info' style='max-width: 18rem;' draggable='true' ondragstart='drag(event)'  id='" . $row['Id'] . "'>\n";
                echo "<div class='card-header' ondrop='return false' data-toggle='modal' data-target='#Mod" . $row['Id'] . "'><small><b>" . $row['Dni'] . " - " . $row['Nombres'] . "</b> - " . $row['Fecha'] . " === " .  strtoupper($row['Observaciones']) . " S/ " . number_format($row['Monto'],0) . " </small><button type='button' class='btn btn-" . $color . " btn-xs'>". $tmp . "</button></div>\n"; 
	            echo "</div>\n\n";
            }
        }
    }
	
	function getPasos2_descartados_pdp($step, $funcionario){
        $persona = new Persona();
        $res = $persona->obtenerPasos2_descartados_abi($step, $funcionario);
        
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
                $tmp = "";
                $color = "";
                if($row['Funcionario']=="Agente1"){
                    $tmp = "A1";
                    $color = "success";
                }
                if($row['Funcionario']=="Agente2"){
                    $tmp = "A2";
                    $color = "danger";
                }
                if($row['Funcionario']=="Agente3"){
                    $tmp = "A3";
                    $color = "primary";
                }
				if($row['Funcionario']=="Agente4"){
                    $tmp = "A4";
                    $color = "success";
                }
                if($row['Funcionario']=="Agente5"){
                    $tmp = "A5";
                    $color = "danger";
                }
                if($row['Funcionario']=="Agente6"){
                    $tmp = "A6";
                    $color = "primary";
                }
				if($row['Funcionario']=="Agente7"){
                    $tmp = "A7";
                    $color = "success";
                }
                if($row['Funcionario']=="Agente8"){
                    $tmp = "A8";
                    $color = "danger";
                }
                if($row['Funcionario']=="Agente9"){
                    $tmp = "A9";
                    $color = "primary";
                }
				
                echo "<div class='card mb-3' style='max-width: 18rem;' draggable='true' ondragstart='drag(event)'  id='" . $row['Id'] . "'>\n";
                echo "<div class='card-header' ondrop='return false' data-toggle='modal' data-target='#Mod" . $row['Id'] . "'><small><b>" . $row['Dni'] . " - " . $row['Nombres'] . "</b> - " . $row['Fecha'] . " === " .  strtoupper($row['Observaciones']) . " S/ " . number_format($row['Monto'],0) . " </small><button type='button' class='btn btn-" . $color . " btn-xs'>". $tmp . "</button></div>\n"; 
	            echo "</div>\n\n";
            }
        }
    }
	
	function getModals_pdp($funcionario){
        $persona = new Persona();
        $res = $persona->obtenerModals_abi($funcionario);
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
                $sex ="";$cal="";$utm="";$obs_agencias="";
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
                
                $nom_tmp = ucfirst(strtolower(trim(substr($row['Nombres'],strpos($row['Nombres'],",")+1))));
                
                echo "<div class='modal fade' id='Mod" . $row['Id'] . "' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>" . "\n";
                echo "<div class='modal-dialog modal-dialog-centered' role='document'>" . "\n";
                echo "<div class='modal-content'>" . "\n";
                echo "<div class='modal-header'>". "\n"; 
                echo "<h5 class='modal-title' id='exampleModalLongTitle'>" . $sex . " [" . $edad . " años] DNI [" . $row['Dni'] . "] - " . $row['Nombres'] . "<br>" . $cal . " Deudas Impagas S/ " . $row['Deudas_impagas'] . " Deuda en el Sistema S/ " . $row['Deuda_sistema'] . " <br>Celular [" . $row['Celular'] . "]<br>" . $row['Fecha']  . " Origen [" . $utm . "]<br>Ult. Modificación " . $row['Fecha_2'] .  "<br>\n";
				echo "<a href='/score?dni=" . $row['Dni'] . "' target='_blank'>Radar Sentinel</a>"."\n";
				$res6 = $persona->buscar_EnAgencia($row['Dni']);
				if($res6->rowCount()){
					while ($row6 = $res6->fetch(PDO::FETCH_ASSOC)){
						$obs_agencias = $row6['Observaciones'];
						echo "<br><span style='color:blue'>En agencias desde: " . $row6['Fecha'] . "</span><br>";
						echo "<span style='color:blue'>Ultima modificación fue: " . $row6['Fecha_2'] . "</span><br>";
						echo "<span style='color:blue'>[Obs Agencia: " . $obs_agencias . "]</span>";
						break;
					}
					echo "<br>";
				}
				echo "</h5>" . "\n";
				
                echo "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>" . "\n"; 
                echo "<span aria-hidden='true'>&times;</span>" . "\n"; 
                echo "</button>" . "\n";
                echo "</div>". "\n";   
                echo "<div class='modal-body'>" . "\n";
				
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

                echo "<textarea class='form-control' id='text" . $row['Id'] . "'>" . strtoupper($row['Observaciones']) . "</textarea>" . "\n";
                echo "Monto a prestar S/ <input type='text' class='form-control' id='mont" . $row['Id'] ."' value='" . number_format($row['Monto'],0,'.','') . "'><br>" . "\n";
				
				$funcX="";$funcK="";$funcJ="";$correo_f="";$sms_func="";$funcL="";$funcM="";$funcN="";$funcO="";$funcP="";$funcQ="";
				if($row['Funcionario']=="Agente1"){
                    $funcX="selected ";
					$correo_f="marco.silva@cp.com.pe";
					$sms_func = " funcionario asignado es XXXXX XXXX,";
                }
                if($row['Funcionario']=="Agente2"){
                    $funcK="selected ";
					$correo_f="alina.jimenez@cp.com.pe";
					$sms_func = " funcionaria asignada es XXXXX XXXX,";
                }
				if($row['Funcionario']=="Agente3"){
                    $funcJ="selected ";
					$correo_f="carlos.zevallos@cp.com.pe";
					$sms_func = " funcionario asignado es XXXXX XXXX,";
                }
				if($row['Funcionario']=="Agente4"){
                    $funcL="selected ";
					$correo_f="marco.silva@cp.com.pe";
					$sms_func = " funcionario asignado es XXXXX XXXX,";
                }
                if($row['Funcionario']=="Agente5"){
                    $funcM="selected ";
					$correo_f="alina.jimenez@cp.com.pe";
					$sms_func = " funcionaria asignada es XXXXX XXXX,";
                }
				if($row['Funcionario']=="Agente6"){
                    $funcN="selected ";
					$correo_f="carlos.zevallos@cp.com.pe";
					$sms_func = " funcionario asignado es XXXXX XXXX,";
                }
				if($row['Funcionario']=="Agente7"){
                    $funcO="selected ";
					$correo_f="marco.silva@cp.com.pe";
					$sms_func = " funcionario asignado es XXXXX XXXX,";
                }
                if($row['Funcionario']=="Agente8"){
                    $funcP="selected ";
					$correo_f="alina.jimenez@cp.com.pe";
					$sms_func = " funcionaria asignada es XXXXX XXXX,";
                }
				if($row['Funcionario']=="Agente9"){
                    $funcQ="selected ";
					$correo_f="carlos.zevallos@cp.com.pe";
					$sms_func = " funcionario asignado es XXXXX XXXX,";
                }
				
                echo "<select class='form-select-lg' aria-label='Default select example' id='combo" .$row['Id']. "'>" . "\n";
                echo "<option " . $div1. "value='div1'>Prospecto</option>". "\n";
                echo "<option " . $div2. "value='div2'>Envio Docs</option>". "\n";
                echo "<option " . $div3. "value='div3'>En Verificaciones</option>". "\n";
                echo "<option " . $div4. "value='div4'>UEC</option>". "\n";
                echo "<option " . $div5. "value='div5'>Aprobado</option>". "\n";
                echo "<option " . $div6. "value='div6'>Desembolsado</option>". "\n";
                echo "<option " . $div7. "value='div7'>Descartados</option>". "\n";
                echo "</select>";
				echo " ";
                echo "<select class='form-select-lg' aria-label='Default select example' id='func" .$row['Id']. "'>" . "\n";
                echo "<option " . $funcX. "value='Agente1'>[1] Agente</option>". "\n";
                echo "<option " . $funcK. "value='Agente2'>[2] Agente</option>". "\n";
                echo "<option " . $funcJ. "value='Agente3'>[3] Agente</option>". "\n";
				echo "<option " . $funcL. "value='Agente4'>[4] Agente</option>". "\n";
                echo "<option " . $funcM. "value='Agente5'>[5] Agente</option>". "\n";
                echo "<option " . $funcN. "value='Agente6'>[6] Agente</option>". "\n";
				echo "<option " . $funcO. "value='Agente7'>[7] Agente</option>". "\n";
                echo "<option " . $funcP. "value='Agente8'>[8] Agente</option>". "\n";
                echo "<option " . $funcQ. "value='Agente9'>[9] Agente</option>". "\n";
                echo "</select>";

				echo " Posponer <input type='date' value='' aria-label='Default select example' id='fec_ingreso" . $row['Id'] . "'>" . "\n";
				
				echo "<br>". "\n";
				echo "<br>". "\n";
				
				$tipo1="";$tipo2="";
                if($row['Tipo']==""){
                    $tipo0="selected ";
                }
				if($row['Tipo']=="PLD"){
                    $tipo1="selected ";
                }
                if($row['Tipo']=="PDP"){
                    $tipo2="selected ";
                }
				
				echo "<select class='form-select-lg' aria-label='Default select example' id='tipo" .$row['Id']. "'>" . "\n";
                echo "<option " . $tipo0. "value=''>Escoge uno</option>". "\n";
				echo "<option " . $tipo1. "value='PLD'>PLD</option>". "\n";
                echo "<option " . $tipo2. "value='PDP'>PDP</option>". "\n";
                echo "</select>";
				
				$convenio0="";$convenio1="";$convenio2="";$convenio3="";$convenio4="";$convenio5="";
				if($row['Convenio']==""){
                    $convenio0="selected ";
                }
				if($row['Convenio']=="Convenio1"){
                    $convenio1="selected ";
                }
                if($row['Convenio']=="Convenio2"){
                    $convenio2="selected ";
                }
				if($row['Convenio']=="Convenio3"){
                    $convenio3="selected ";
                }
                if($row['Convenio']=="Convenio4"){
                    $convenio4="selected ";
                }
				if($row['Convenio']=="Convenio5"){
                    $convenio5="selected ";
                }
				
				echo "  <select class='form-select-lg' aria-label='Default select example' id='convenio" .$row['Id']. "'>" . "\n";
                echo "<option " . $convenio0. "value=''>Escoge uno</option>". "\n";
				echo "<option " . $convenio1. "value='Convenio1'>Convenio1</option>". "\n";
                echo "<option " . $convenio2. "value='Convenio2'>Convenio2</option>". "\n";
				echo "<option " . $convenio3. "value='Convenio3'>Convenio3</option>". "\n";
				echo "<option " . $convenio4. "value='Convenio4'>Convenio4</option>". "\n";
				echo "<option " . $convenio5. "value='Convenio5'>Convenio5</option>". "\n";
                echo "</select>";
				
				echo "<br>". "\n";
				
				$res4 = $persona->obtener_Documento($row['Dni'],);
				if($res4->rowCount()){
					while ($row4 = $res4->fetch(PDO::FETCH_ASSOC)){
						$nombretmp = $row4['Desc_Documento'];
						echo "<span style='color:blue'><u><a href='/archivos/" . $row4['Desc_Documento'] . "'>" . $nombretmp . "</a></u></span><br>";
					}
					echo "<br>";
				}
		
                echo "</div>" . "\n";
                echo "<div class='modal-footer'>" . "\n";
				if($row['Paso']=="div3"){
				echo "<button type='button' data-dismiss='modal' class='btn btn-outline-success btn-xs' onclick=\"mail('" . $row['Dni'] . "','" . $row['Nombres'] . "','" . number_format($row['Monto'],0,'.','') . "','" . $correo_f . "')\">Mail Agen</button> |". "\n";
				}
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
	
	function actualiza_paso_pdp($id, $paso){
        $persona = new Persona();
        $res = $persona->update_Paso_abi($id, $paso);
    }
	
    function actualiza_observacion_pdp($id, $obs, $monto, $paso, $funcionario, $fec_ingreso, $tipo, $convenio){
        $persona = new Persona();
        $res = $persona->update_Obs_abi($id, $obs, $monto, $paso, $funcionario, $fec_ingreso, $tipo, $convenio);
    }
	
	function sendPost_sms_masivian_api($celular, $mensaje){
		$new = new CurlRequest();
		$resultado = $new ->sendPost_sms_masivian($celular, $mensaje);
	}
	
    
}

?>