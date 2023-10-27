<?php
session_start();
include_once 'persona.php';
include_once 'mini_test.php';

class ApiPersonas{
	
    function getAll_plazofijo($keyword){
        $persona = new Persona();
        $res = $persona->obtenerPersonas_plazofijo($keyword);
        
        
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
                $variable_bol=0;$situa="";
				if($row['Calificacion']=="NOR"){
					$situa = "<button type='button' class='btn btn-success btn-xs'>NOR</button>";
				}
				if($row['Calificacion']=="CPP"){
					$situa = "<button type='button' class='btn btn-warning btn-xs'>CPP</button>";
				}
				if($row['Calificacion']=="SC"){
					$situa = "<button type='button' class='btn btn-default btn-xs'>SCA</button>";
				}
				if($row['Calificacion']=="DEF"){
					$situa = "<button type='button' class='btn btn-danger btn-xs'>DEF</button>";
				}
				if($row['Calificacion']=="DUD"){
					$situa = "<button type='button' class='btn btn-danger btn-xs'>DUD</button>";
				}
				if($row['Calificacion']=="PER"){
					$situa = "<button type='button' class='btn btn-dark btn-xs'>PER</button>";
				}
				
				$utm = $row['Utm'];
				
				if($row['Es_socio']=="Si")
					$colorletra = "<span style='color:blue'>";
				else
					$colorletra = "<span style='color:black'>";
				
                echo "<tr>";
                echo "<td>" . $colorletra . $row['Dni'] . " / " . $row['Fecha'] . "</span></td>";
                echo "<td>" . $colorletra . substr($row['Nombres'],0,25) . " - " . $situa . " - " . $utm . " - Impagos [S/". $row['Deudas_impagas'] . "] - Deuda [S/" . number_format($row['Deuda_sistema'],0) . "] Es socio [" . $row['Es_socio']. "] [" . $row['Correo'] . "] - " . $row['Paso'] . "</span></td>";

                echo "<td>" . $colorletra . "TC Linea S/ " . number_format($row['LineaTC'],0) . " / " . number_format($row['LineaTCusadda'],0) . "</span></td>";
                echo "<td>" . $colorletra . substr($row['Celular'],-9) . "</span></td>";
                echo "</tr>";
            }
        }
    }
	
	function getListadoDesemb_plazofijo($moneda){
        $persona = new Persona();
        $res = $persona->obtListadoDesemb_plazofijo($moneda);
        $i=1;
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
				if($moneda=="Soles"){
					echo $i++ . ".- " . substr($row['Nombres'],0,22) . " [" . $row['Dni'] . "] - S/ " .  number_format($row['Monto'],0) . " - " . $row['Utm'] . " Es socio [" . $row['Es_socio']. "]</button><br>";
				}else{
					echo $i++ . ".- " . substr($row['Nombres'],0,22) . " [" . $row['Dni'] . "] - $ " .  number_format($row['Monto_2'],0) . " - " . $row['Utm'] . " Es socio [" . $row['Es_socio']. "]</button><br>";
				}
            }
        }
    }

	function getListadoDesemb_mpasado($moneda){
        $persona = new Persona();
        $res = $persona->obtListadoDesemb_plazofijo_mpasado($moneda);
        $i=1;
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
				if($moneda=="Soles"){
					echo $i++ . ".- " . substr($row['Nombres'],0,22) . " [" . $row['Dni'] . "] - S/ " .  number_format($row['Monto'],0) . " - " . $row['Utm'] . " Es socio [" . $row['Es_socio']. "]</button><br>";
				}else{
					echo $i++ . ".- " . substr($row['Nombres'],0,22) . " [" . $row['Dni'] . "] - $ " .  number_format($row['Monto_2'],0) . " - " . $row['Utm'] . " Es socio [" . $row['Es_socio']. "]</button><br>";
				}
            }
        }
    }	
	
	function getListadoDesemb_mpasado_atras($moneda, $meses){
        $persona = new Persona();
        $res = $persona->obtListadoDesemb_plazofijo_mpasado_atras($moneda, $meses);
        $i=1;
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
				if($moneda=="Soles"){
					echo $i++ . ".- " . substr($row['Nombres'],0,22) . " [" . $row['Dni'] . "] - S/ " .  number_format($row['Monto'],0) . " - " . $row['Utm'] . " Es socio [" . $row['Es_socio']. "]</button><br>";
				}else{
					echo $i++ . ".- " . substr($row['Nombres'],0,22) . " [" . $row['Dni'] . "] - $ " .  number_format($row['Monto_2'],0) . " - " . $row['Utm'] . " Es socio [" . $row['Es_socio']. "]</button><br>";
				}
            }
        }
    }		

	function getImpDesemb_plazofijo($moneda){
        $persona = new Persona();
        
            $res = $persona->imp_desembolsados_plazofijo($moneda);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            $tmp = number_format($row['TotalDesem'],0);
            
        echo $tmp;

    }
	
	function getImpDesemb_plazofijo_df($moneda){
        $persona = new Persona();
        
            $res = $persona->imp_desembolsados_plazofijo_df($moneda);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            $tmp = number_format($row['TotalDesem'],0);
            
        echo $tmp;

    }
	
	function getTotDesemb_mpasado($moneda){
        $persona = new Persona();
        
            $res = $persona->imp_desembolsados_plazofijo_mpasado($moneda);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            $tmp = number_format($row['TotalDesem'],0);
            
        echo $tmp;

    }

	function getTotDesemb_mpasado_atras($moneda, $meses){
        $persona = new Persona();
        
            $res = $persona->imp_desembolsados_plazofijo_mpasado_atras($moneda, $meses);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            $tmp = number_format($row['TotalDesem'],0);
            
        echo $tmp;

    }	

	function getImpDesemb_mpasado($moneda){
        $persona = new Persona();
        
            $res = $persona->imp_desembolsados_plazofijo_mpasado($moneda);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            $tmp = number_format($row['TotalDesem'],0);
            
        echo $tmp;

    }

	function getImpDesemb_mpasado_atras($moneda, $meses){
        $persona = new Persona();
        
            $res = $persona->imp_desembolsados_plazofijo_mpasado_atras($moneda, $meses);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            $tmp = number_format($row['TotalDesem'],0);
            
        echo $tmp;

    }	
	
	function update_infogas($dni, $pregunta1, $pregunta2, $pregunta3, $pregunta4, $pregunta5, $pregunta6, $pregunta7, $pregunta8){
		$persona = new Persona();

        $res = $persona->update_infogas_persona($dni, $pregunta1, $pregunta2, $pregunta3, $pregunta4, $pregunta5, $pregunta6, $pregunta7, $pregunta8);
	}

	function getTotDesemb_plazofijo($moneda){
        $persona = new Persona();
        
            $res = $persona->total_desembolsados_plazofijo($moneda);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            $tmp = $row['TotalDesem'];
            
        echo $tmp;

    }
	
	function getTotDesemb_plazofijo_df($moneda){
        $persona = new Persona();
        
            $res = $persona->total_desembolsados_plazofijo_df($moneda);
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
	
    function tarjetasPendientes($funcionario){
        $persona = new Persona();
        
            $res = $persona->tarjetasPendientes_plazofijo($funcionario);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            
            $tmp = $row['Total'];
            
        echo $tmp;

    }
	
    function actualiza_funcionario_digital_plazofijo($karina, $karen, $katy){
        $persona = new Persona();
        $res = $persona->update_funcionario_digital_plazofijo($karina, $karen, $katy);
    }
	
	function funnel_digital($paso, $funcionario){
		$persona = new Persona();
		
            $res = $persona->funnel_digital_importe_plazofijo($paso, $funcionario);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            
            $res1 = $persona->funnel_digital_cantidad_plazofijo($paso, $funcionario);
            $row1 = $res1->fetch(PDO::FETCH_ASSOC);

            $tmp = number_format($row['Total'],0,'.',',');
            $tmp1 = $row1['Total'];
		
			echo "(" . $tmp1 . ")";
	}	

	function consulta_digital($funcionario){
		$persona = new Persona();
        $res = $persona->activo_funcionario_digital($funcionario);
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

	function getPasos2_plazofijo($step, $funcionario){
        $persona = new Persona();
        $res = $persona->obtenerPasos2_plazofijo($step, $funcionario);
        
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
				$colorcaja="";$era_socio="";$tmp="";$color="";
				
				if($row['Funcionario']=="Karina"){
                    $tmp = "KMO";
                    $color = "success";
                }
                if($row['Funcionario']=="Karen"){
                    $tmp = "KMC";
                    $color = "danger";
                }
                if($row['Funcionario']=="Katy"){
                    $tmp = "KS";
                    $color = "primary";
                }
				
				if($row['Es_socio']=="Si")
					$colorcaja = " bg-warning";
				if($row['Paso']=="div6")
				{	
					$colorcaja = " bg-primary";
					$era_socio="Era socio [" . $row['Es_socio'] . "]";
				}
				
                echo "<div class='card mb-3" . $colorcaja . "' style='max-width: 18rem;' draggable='true' ondragstart='drag(event)'  id='" . $row['Id'] . "'>\n";
                echo "<div class='card-header' ondrop='return false' data-toggle='modal' data-target='#Mod" . $row['Id'] . "'><small><b>" . $row['Dni'] . " - " . $row['Nombres'] . "</b> - " . $row['Fecha'] . " - " . substr($row['Celular'],-9) . " === " .  strtoupper($row['Observaciones']) . " S/ " . number_format($row['Monto'],0) . " $ " . number_format($row['Monto_2'],0) . " </small>" . $era_socio . " <button type='button' class='btn btn-" . $color . " btn-xs'>". $tmp . "</button></div>\n"; 
	            echo "</div>\n\n";
            }
        }
    }
	
	function getPasos3_plazofijo($step){
        $persona = new Persona();
        $res = $persona->obtenerPasos2_desemb_plazofijo($step);
        
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
	
	function getPasos2_descartados_plazofijo($step){
        $persona = new Persona();
        $res = $persona->obtenerPasos2_descartados_plazofijo($step);
        
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
	
	function getModals_plazofijo(){
        $persona = new Persona();
        $res = $persona->obtenerModals_plazofijo();
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
	            
	            if($row['Calificacion']=="NOR"){
	                $cal = "<button type=button class=\"btn btn-success btn-xs\">NOR</button>";
	            }
	            if($row['Calificacion']=="CPP"){
	                $cal = "<button type=button class=\"btn btn-warning btn-xs\">CPP</button>";
	            }
	            if($row['Calificacion']=="DUD"){
	                $cal = "<button type=button class=\"btn btn-danger btn-xs\">DUD</button>";
	            }
	            if($row['Calificacion']=="DEF"){
	                $cal = "<button type=button class=\"btn btn-danger btn-xs\">DEF</button>";
	            }
	            if($row['Calificacion']=="PER"){
	                $cal = "<button type=button class=\"btn btn-dark btn-xs\">PER</button>";
	            }
	            if($row['Calificacion']=="SC"){
	                $cal = "<button type=button class=\"btn btn-secondary btn-xs\">SCA</button>";
	            }
                
                $utm = $row['Utm'];
              
               
                $nom_tmp = ucfirst(strtolower(trim(substr($row['Nombres'],strpos($row['Nombres'],",")+1))));
                
                echo "<div class='modal fade' id='Mod" . $row['Id'] . "' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>" . "\n";
                echo "<div class='modal-dialog modal-dialog-centered' role='document'>" . "\n";
                echo "<div class='modal-content'>" . "\n";
                echo "<div class='modal-header'>". "\n"; 
                echo "<h5 class='modal-title' id='exampleModalLongTitle'>" . $sex . " [" . $edad . " años] DNI [" . $row['Dni'] . "] - " . $row['Nombres'] . "<br>" . $cal . " Deudas Impagas S/ " . $row['Deudas_impagas'] . " Deuda en el Sistema S/ " . $row['Deuda_sistema'] . " <br>Celular [" . $row['Celular'] . "] - Correo [" . $row['Correo'] . "]<br>";
				echo "Es socio [" . $row['Es_socio'] . "] TC Linea S/ " . number_format($row['LineaTC'],0) . " / " . number_format($row['LineaTCusadda'],0);
				echo "<br>" . $row['Fecha']  . " Origen [" . $utm . "]<br>Ult. Modificación " . $row['Fecha_2'] .  "<br>\n";
				echo "<a href='/score?dni=" . $row['Dni'] . "' target='_blank'>Radar Sentinel</a>"."\n";
				echo "</h5>" . "\n";
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

				$funcX="";$funcK="";$funcJ="";
				if($row['Funcionario']=="Karina"){
                    $funcX="selected ";
                }
                if($row['Funcionario']=="Karen"){
                    $funcK="selected ";
                }
				if($row['Funcionario']=="Katy"){
                    $funcJ="selected ";
                }
				
                echo "<textarea class='form-control' id='text" . $row['Id'] . "'>" . strtoupper($row['Observaciones']) . "</textarea>" . "\n";
                echo "Monto a captar S/ <input type='text' class='form-control' id='mont" . $row['Id'] ."' value='" . number_format($row['Monto'],0,'.','') . "'><br>" . "\n";
				echo "Monto a captar $ <input type='text' class='form-control' id='mont2_" . $row['Id'] ."' value='" . number_format($row['Monto_2'],0,'.','') . "'><br>" . "\n";
			
                echo "<select class='form-select-lg' aria-label='Default select example' id='combo" .$row['Id']. "'>" . "\n";
                echo "<option " . $div1. "value='div1'>Por Contactar</option>". "\n";
                echo "<option " . $div2. "value='div2'>Contactado</option>". "\n";
                echo "<option " . $div3. "value='div3'>Requisitos</option>". "\n";
                echo "<option " . $div4. "value='div4'>Por inscribir</option>". "\n";
                echo "<option " . $div5. "value='div5'>Soporte Pacinet</option>". "\n";
                echo "<option " . $div6. "value='div6'>Terminado</option>". "\n";
                echo "<option " . $div7. "value='div7'>Descartados</option>". "\n";
                echo "</select>";
				echo " ";
				
				echo "<select class='form-select-lg' aria-label='Default select example' id='func" .$row['Id']. "'>" . "\n";
                echo "<option " . $funcX. "value='Karina'>Karina</option>". "\n";
                echo "<option " . $funcK. "value='Karen'>Karen</option>". "\n";
                echo "<option " . $funcJ. "value='Katy'>Katy</option>". "\n";
                echo "</select>";

				echo "<br>Posponer <input type='date' value='' aria-label='Default select example' id='fec_ingreso" . $row['Id'] . "'>" . "\n";
				
				echo "<br>". "\n";
		
                echo "</div>" . "\n";
                echo "<div class='modal-footer'>" . "\n";
				if($row['Paso']=="div1")
				{
				echo "<button type='button' data-dismiss='modal' class='btn btn-outline-success btn-xs' onclick=\"wsp('" . $row['Nombres'] . "','" . $row['Celular'] . "')\">Envia wsp</button> |". "\n";
				}
                echo "<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>" . "\n";
                echo "<button type='button' class='btn btn-primary' data-dismiss='modal' onclick='graba(" . $row['Id'] . ")'>Guardar</button>" . "\n";
                echo "</div>" . "\n";
                echo "</div>" . "\n";
                echo "</div>" . "\n";
		        echo "</div>" . "\n\n";
            }
        }
                
                
    }

	
	function actualiza_paso_plazofijo($id, $paso){
        $persona = new Persona();
        $res = $persona->update_Paso_plazofijo($id, $paso);
    }
	
    function actualiza_observacion_plazofijo($id, $obs, $monto, $paso, $fec_ingreso, $monto2, $funcionario){
        $persona = new Persona();
        $res = $persona->update_Obs_plazofijo($id, $obs, $monto, $paso, $fec_ingreso, $monto2, $funcionario);
    }
	
	function sendPost_sms_masivian_api($celular, $mensaje){
		$new = new CurlRequest();
		$resultado = $new ->sendPost_sms_masivian($celular, $mensaje);
	}
	
    function envio_wsp($nombre, $celular){
		
		$pos = strpos($nombre, ",");
		$nombre = ucwords(strtolower(substr($nombre, $pos+1)));

		// This requires the curl extension to be installed
		$ch = curl_init("https://rest.messengerpeople.com/api/v16/chat/notification");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
		  "id" => "$celular",
		  "batch_ids" => "",
		  "user_filter" => "",
		  "notification_template" => "novedades",
		  "notification_body_variables" => "[\n          \"$nombre\"\n        ]",
		  "notification_header_media" => "https://img.wbcsrv.com/uploads/24815/2023/06/19/5707a3f3691c529cc010ed41810a7223.jpg",
		  "notification_header_variable" => "",
		  "notification_button_variable" => "",
		  "notification_language" => "es",
		  "apikey" => "cdc9929a7432bbdc1f3bedd4c67ca9d5_24815_dc4e7fe7d58fad6514cac5706"
		]));
		curl_setopt($ch, CURLOPT_HTTPHEADER, [
		  "Content-Type: application/json"
		]);
		$response = curl_exec($ch);
		curl_close($ch);

	}
}

?>