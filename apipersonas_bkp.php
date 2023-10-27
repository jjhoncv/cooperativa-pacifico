<?php
session_start();
include_once 'persona.php';

class ApiPersonas{
    
    function tsurus($doi){
        $persona = new Persona();
        $res = $persona->obtenerTsurus($doi);
        
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
                  $datos = array("puntos"=>$row['puntos'],"nombre"=>$row['nombres'], "fecha"=>$row['fecha']);
                  echo json_encode($datos);    
   
            }
        }
        
        //header("Location: https://cp.com.pe/pacifico/puntos-tsuru/?puntos=" . $puntos . "&nombres=" . $nombres_tsurus . "&fecha=" . $fecha_tsuru);
        
    }
    
    function actualiza_paso($id, $paso){
        $persona = new Persona();
        $res = $persona->update_Paso($id, $paso);
    }
    
    function actualiza_observacion($id, $obs, $monto, $paso, $funcionario){
        $persona = new Persona();
        $res = $persona->update_Obs($id, $obs, $monto, $paso, $funcionario);
        //$res = $persona->update_Obs($id, $obs, $monto, $paso);
    }
    
    function listaPlantillas(){
        $persona = new Persona();
        $res = $persona->obtenerPlantillas();
        
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
                  echo "<option value='" . $row['plantilla'] . "'>" . $row['descripcion'] . "</option>";
            }
        }
        
        
    }
    
    function feriado($fec_actual){
        
        $persona = new Persona();
        $res = $persona->obtenerFeriado($fec_actual);

        if($res->rowCount()){
            //echo "true";
            $_SESSION["miguel_t"] = "true";
        }
        else{
            //echo "false";
            $_SESSION["miguel_t"] = "false";
        }
      
    }
    
    function repetidoDni_api($dni){
        
        $persona = new Persona();
        $res = $persona->repetidoDni($dni);
        $row = $res->fetch(PDO::FETCH_ASSOC);
        $tmp = $row['Total'];
        
        if($tmp>0){
            $_SESSION["repetido"] = "false";
        }else{
            $_SESSION["repetido"] = "true";
        }
    }    
    
    
    
    
    function obt_pagina($pagina, $desc_visita){
        $persona = new Persona();
        $res = $persona->obtenerPagina($pagina);
        $url = "";
        $id_pagina = "";
        
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
                  $url = $row['url'];
                  $id_pagina = $row['id'];
                  }
        }
        
        if($url!="")
        {
            header("Location: " . $url);
            $res = $persona->nuevaRegistroVisita($id_pagina, $desc_visita);
        }
        else
        {
            header("Location: https://www.google.com.pe");
        }
    }

    function getAll(){
        $persona = new Persona();
        $personas = array();
        $personas["items"] = array();

        $res = $persona->obtenerPersonas();

        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
    
                $item=array(
                    "id" => $row['Id'],
                    "nombres" => $row['Nombres'],
                    "dni" => $row['Dni'],
                    "celular" => $row['Celular'],
                    "situacion" => $row['Situacion'],
                    "sueldo_neto" => $row['Sueldo_neto'],
                    "saldo_pagar_cuota" => $row['Saldo_pagar_cuota'],
                    "dias_atraso" => $row['Dias_atraso'],
                    "deudas_impagas" => $row['Deudas_impagas'],
                    "deuda_sistema" => $row['Deuda_sistema'],
                    "ruc" => $row['Ruc'],
                    "nombre_empresa" => $row['Nombre_empresa'],
                    "fecha" => $row['Fecha'],
                    "estado" => $row['Estado'],
                    "funcionario" => $row['Funcionario'],
                );
                array_push($personas["items"], $item);
            }
        
            echo json_encode($personas);
        }else{
            echo json_encode(array('mensaje' => 'No hay elementos'));
        }
    }

    function getAllPagina(){
        $persona = new Persona();
        $res = $persona->obtener_Paginas();
        
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
                echo "<tr>";
                echo "<td><p class='text-primary'><a href='detalle'>" . $row['descripcion'] . "</a></p></td>";
                echo "<td>" . $row['url'] . "</td>";
                echo "</tr>";
            }
        }
    }
    
    function getAll3(){
        $persona = new Persona();
        $res = $persona->obtenerPersonas();
        
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
                echo "<tr>";
                echo "<td><p class='text-primary'>" . $row['Dni'] . " - " . $row['Nombres'] . "</p><p class='text-dark'><b>" . $row['Estado'] . "</b> - " . $row['Situacion'] . " - Sueldo Neto: " . $row['Sueldo_neto'] . " - Saldo para pagar cuota: " . $row['Saldo_pagar_cuota'] . " - Dias Atraso: " . $row['Dias_atraso'] ." - Deudas impagas: " . $row['Deudas_impagas'] ." - Deuda en sistema: " . $row['Deuda_sistema'] . "</p><p class='text-success'>" . $row['Ruc'] . "- " . $row['Nombre_empresa'] . "</p><p class='text-dark'>" . $row['Fecha'] . "</p></td>";
                echo "</tr>";
            }
        }
    }

    function getPasos2($step, $funcionario){
        $persona = new Persona();
        $res = $persona->obtenerPasos2($step, $funcionario);
        
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
                $tmp = "";
                $color = "";
                if($row['Funcionario']=="XIOMI"){
                    $tmp = "XC";
                    $color = "success";
                }
                if($row['Funcionario']=="KAORI"){
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
    
        function getPasos3($step, $funcionario){
        $persona = new Persona();
        $res = $persona->obtenerPasos2($step, $funcionario);
        
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
                $tmp = "";
                $color = "";
                if($row['Funcionario']=="XIOMI"){
                    $tmp = "XC";
                    $color = "success";
                }
                if($row['Funcionario']=="KAORI"){
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
    
    function getModals(){
        $persona = new Persona();
        $res = $persona->obtenerModals();
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
                $sex ="";$cal="";$utm="";
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
                echo "<h5 class='modal-title' id='exampleModalLongTitle'>" . $sex . " [" . $edad . " años] DNI [" . $row['Dni'] . "] - " . $row['Nombres'] . "<br>" . $cal . " Deudas Impagas S/ " . $row['Deudas_impagas'] . " Deuda en el Sistema S/ " . $row['Deuda_sistema'] . " <br>Celular [" . $row['Celular'] . "] - " . $row['Correo'] . "<br>" . $row['Fecha']  . " Origen [" . $utm . "]<br>Ult. Modificación " . $row['Fecha_2'] . "</h5>" . "\n"; 
                echo "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>" . "\n"; 
                echo "<span aria-hidden='true'>&times;</span>" . "\n"; 
                echo "</button>" . "\n";
                echo "</div>". "\n";   
                echo "<div class='modal-body'>" . "\n";  
                echo "<textarea class='form-control' id='text" . $row['Id'] . "'>" . strtoupper($row['Observaciones']) . "</textarea>" . "\n";
                echo "Monto a prestar S/ <input type='text' class='form-control' id='mont" . $row['Id'] ."' value='" . number_format($row['Monto'],0,'.','') . "'>" . "\n";
                echo "<button type='button' class='btn btn-outline-danger btn-xs' onclick=\"sms('" . $row['Celular'] . "','" . $nom_tmp . "','Nocalifica')\">SMS No Califica</button> |". "\n";
                echo "<button type='button' class='btn btn-outline-primary btn-xs' onclick=\"sms('" . $row['Celular'] . "','" . $nom_tmp . "','Preaprobado')\">SMS Preaprobado</button>". "\n";
                //echo "Paso " . $row['Paso']. "\n";
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
				if($row['Funcionario']=="XIOMI"){
                    $funcX="selected ";
                }
                if($row['Funcionario']=="KAORI"){
                    $funcK="selected ";
                }
				if(substr($row['Funcionario'],0,5)=="JOHAN"){
                    $funcJ="selected ";
                }
				
                echo "<select class='form-select-lg' aria-label='Default select example' id='combo" .$row['Id']. "'>" . "\n";
                echo "<option " . $div1. "value='div1'>Por Contactar</option>". "\n";
                echo "<option " . $div2. "value='div2'>En Evaluación</option>". "\n";
                echo "<option " . $div4. "value='div4'>En Verificaciones</option>". "\n";
                echo "<option " . $div3. "value='div3'>En Revisión</option>". "\n";
                echo "<option " . $div5. "value='div5'>Firma de Crédito</option>". "\n";
                echo "<option " . $div6. "value='div6'>Desembolsado</option>". "\n";
                echo "<option " . $div7. "value='div7'>Descartados</option>". "\n";
                echo "</select>";
				echo " ";
                echo "<select class='form-select-lg' aria-label='Default select example' id='func" .$row['Id']. "'>" . "\n";
                echo "<option " . $funcX. "value='XIOMI'>Xiomi</option>". "\n";
                echo "<option " . $funcK. "value='KAORI'>Kaori</option>". "\n";
                echo "<option " . $funcJ. "value='JOHANN WSP'>Johann</option>". "\n";
                echo "</select>";
				
                echo "</div>" . "\n";
                echo "<div class='modal-footer'>" . "\n";
                echo "<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>" . "\n";
                echo "<button type='button' class='btn btn-primary' data-dismiss='modal' onclick='graba(" . $row['Id'] . ")'>Guardar</button>" . "\n";
                echo "</div>" . "\n";
                echo "</div>" . "\n";
                echo "</div>" . "\n";
		        echo "</div>" . "\n\n";
            }
        }
                
                
    }
    
    function getModals_digital($keyword){
        $persona = new Persona();
        $res = $persona->obtenerPersonas($keyword);
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
                $sex ="";$cal="";$utm="";
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
                echo "<h5 class='modal-title' id='exampleModalLongTitle'>" . $sex . " [" . $edad . " años] DNI [" . $row['Dni'] . "] - " . $row['Nombres'] . "<br>" . $cal . " Deudas Impagas S/ " . $row['Deudas_impagas'] . " Deuda en el Sistema S/ " . $row['Deuda_sistema'] . " <br>Celular [" . $row['Celular'] . "] - " . $row['Correo'] . "<br>" . $row['Fecha']  . " Origen [" . $utm . "]<br>Ult. Modificación " . $row['Fecha_2'] . "</h5>" . "\n"; 
                echo "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>" . "\n"; 
                echo "<span aria-hidden='true'>&times;</span>" . "\n"; 
                echo "</button>" . "\n";
                echo "</div>". "\n";   
                echo "<div class='modal-body'>" . "\n";  
                echo "<textarea class='form-control' id='text" . $row['Id'] . "'>" . strtoupper($row['Observaciones']) . "</textarea>" . "\n";
                echo "Monto a prestar S/ <input type='text' class='form-control' id='mont" . $row['Id'] ."' value='" . number_format($row['Monto'],0,'.','') . "'>" . "\n";
                echo "<button type='button' class='btn btn-outline-danger btn-xs' onclick=\"sms('" . $row['Celular'] . "','" . $nom_tmp . "','Nocalifica')\">SMS No Califica</button> |". "\n";
                echo "<button type='button' class='btn btn-outline-primary btn-xs' onclick=\"sms('" . $row['Celular'] . "','" . $nom_tmp . "','Preaprobado')\">SMS Preaprobado</button>". "\n";
                //echo "Paso " . $row['Paso']. "\n";
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
				if($row['Funcionario']=="XIOMI"){
                    $funcX="selected ";
                }
                if($row['Funcionario']=="KAORI"){
                    $funcK="selected ";
                }
				if(substr($row['Funcionario'],0,5)=="JOHAN"){
                    $funcJ="selected ";
                }
				
                echo "<select class='form-select-lg' aria-label='Default select example' id='combo" .$row['Id']. "'>" . "\n";
                echo "<option " . $div1. "value='div1'>Por Contactar</option>". "\n";
                echo "<option " . $div2. "value='div2'>En Evaluación</option>". "\n";
                echo "<option " . $div4. "value='div4'>En Verificaciones</option>". "\n";
                echo "<option " . $div3. "value='div3'>En Revisión</option>". "\n";
                echo "<option " . $div5. "value='div5'>Firma de Crédito</option>". "\n";
                echo "<option " . $div6. "value='div6'>Desembolsado</option>". "\n";
                echo "<option " . $div7. "value='div7'>Descartados</option>". "\n";
                echo "</select>";
				echo " ";
                echo "<select class='form-select-lg' aria-label='Default select example' id='func" .$row['Id']. "'>" . "\n";
                echo "<option " . $funcX. "value='XIOMI'>Xiomi</option>". "\n";
                echo "<option " . $funcK. "value='KAORI'>Kaori</option>". "\n";
                echo "<option " . $funcJ. "value='JOHANN WSP'>Johann</option>". "\n";
                echo "</select>";
				
                echo "</div>" . "\n";
                echo "<div class='modal-footer'>" . "\n";
                echo "<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>" . "\n";
                echo "<button type='button' class='btn btn-primary' data-dismiss='modal' onclick='graba(" . $row['Id'] . ")'>Guardar</button>" . "\n";
                echo "</div>" . "\n";
                echo "</div>" . "\n";
                echo "</div>" . "\n";
		        echo "</div>" . "\n\n";
            }
        }
                
                
    }
    
    function getAll2($keyword){
        $persona = new Persona();
        $res = $persona->obtenerPersonas($keyword);
        
        
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
                $variable_bol=0;
                echo "<tr>";
                echo "<td>" . $row['Dni'] . " / " . $row['Fecha'] . "</td>";
                echo "<td>" . $row['Nombres'] . " - " . $row['Situacion'] . " - " . $row['Nombre_empresa'] . " - S/" . number_format($row['Sueldo_neto'],0) . " - <b>[" . number_format($row['Score'],0) . " ptos]</b> - S/". $row['Deudas_impagas'] . " - Lima [" . $row['Lima'] . "] 5ta [" . $row['Quinta'] . "]</td>";
                if($row['Estado']=="PRE-APROBADO")
                {
                    echo "<td><span style='color:blue'>" . $row['Estado'] . " / " . $row['Funcionario'] . "</span></td>";
                    $variable_bol=1;
                }
                if(substr($row['Estado'],0,3)=="VEH")
                {
                    echo "<td><span style='color:red'>" . $row['Estado'] . " / " . $row['Funcionario'] . "</span></td>";
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
    
    function getAll2_digital($keyword){
        $persona = new Persona();
        $res = $persona->obtenerPersonas($keyword);
        $i=0;
        
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
                $variable_bol=0;
                
                if((fmod($i++,2))==0){
                    $color = "secondary";
                }else{
                    $color = "info";
                }
                
                $tmp = "Mail ✉️";
                echo "<tr>";
                echo "<td>" . $row['Dni'] . " / " . $row['Fecha'] . "</td>";
                echo "<td>" . $row['Nombres'] . "</td>";
                if($row['Estado']=="PRE-APROBADO")
                {
                    echo "<td><span style='color:blue'>" . $row['Funcionario'] . "</span></td>";
                    $variable_bol=1;
                }
                if(substr($row['Estado'],0,3)=="VEH")
                {
                    echo "<td><span style='color:red'>" . $row['Funcionario'] . "</span></td>";
                    $variable_bol=1;
                }
                if($variable_bol==0)
                {
                    echo "<td>SERVICIOS DIGITALES</td>";
                }
                //echo "<td><button type='button' data-toggle='modal' data-target='#Mod" . $row['Id'] . "' class='btn btn-" . $color . " btn-xs'>". $tmp . "</button> " . substr($row['Celular'],-9) . " - " . $row['Correo'] . "</td>";
                echo "<td>" . substr($row['Celular'],-9) . " - " . $row['Correo'] . "</td>";
                echo "</tr>";
            }
        }
    }
    
    function getAll4(){
        $persona = new Persona();
        $res = $persona->obtenerPersonas_exp();
        
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
                if($row['Estado']=="PRE-APROBADO"){
                    $color="";$tmp="";
                    if($row['Paso']=="div7"){
                        $tmp = "X - " . $row['Observaciones'];
                    }else{
                        if($row['Paso']=="div2"){
                            $tmp = "(2/5) ENVIANDO DOCUMENTOS";    
                        }
                        if($row['Paso']=="div4"){
                            $tmp = "(3/5) VERIFICANDO LAB/DOM";    
                        }
                        if($row['Paso']=="div3"){
                            $tmp = "(4/5) FILE EN AGENCIA";    
                        }
                        if($row['Paso']=="div5"){
                            $tmp = "(5/5) FIRMA EN AGENCIA";    
                        }
                        if($row['Paso']=="div6"){
                            $tmp = "DESEMBOLSADO S/ " . number_format($row['Monto'],0) . " [" . $row['Fecha_2'] . "]";    
                        }
                        if($row['Paso']=="div1"){
                            $tmp = "(1/5) EN CONTACTO";    
                        }
                        
                        $color = "blue";
                    }
                }else{
                    $tmp = $row['Estado'];
                    $color = "black";
                }
                
                
                echo "<tr>";
                echo "<td>" . $row['Fecha'] . "</td>";
                echo "<td>" . $row['Nombres'] . " - " . $row['Dni'] . " - " . $row['Situacion'] . "</td>";
                echo "<td><span style='color:" . $color . "'>" . $tmp . "</span></td>";
                echo "<td>" . substr($row['Celular'],-9) . " - " . $row['Correo'] . "</td>";
                echo "</tr>";
            }
        }
    }
    
    function getAllAelu(){
        $persona = new Persona();
        $res = $persona->obtenerPersonas_aelu();
        
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
                echo "<tr>";
                echo "<td>" . $row['Fecha'] . "</td>";
                echo "<td>" . $row['Doi'] .  "</td>";
                echo "<td>" . $row['Resultado'] . "</td>";
                echo "<td>" . substr($row['Celular'],-9) . " / " . $row['Nick'] . "</td>";
                echo "</tr>";
            }
        }
    }
    
    function getAllSuperSorteo(){
        $persona = new Persona();
        $res = $persona->obtenerPersonas_supersorteo();
        
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
                echo "<tr>";
                echo "<td>" . $row['Fecha'] . "</td>";
                echo "<td>" . $row['Doi'] .  "</td>";
                echo "<td>" . $row['Resultado'] . "</td>";
                echo "<td>" . substr($row['Celular'],-9) . " / " . $row['Nick'] . "</td>";
                echo "</tr>";
            }
        }
    }

    function getDataLeads($cant){
        $persona = new Persona();
        $cadena = "";
        
        for ($i = $cant; $i >= 1; $i--) {
            
            $res = $persona->obtenerTotalLeads($i);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            $tmp = $row['Total'];
            
            if($i==$cant)
                $cadena = $cadena . $tmp;
            else
                $cadena =  $cadena . "," . $tmp;
        }
        echo "data: [" . $cadena . "],";

    }
    
    function getDataLeads_t($cant, $utm){
        $persona = new Persona();
        $preaprob = 0;
        
        for ($i = $cant; $i >= 1; $i--) {
            
            $res = $persona->obtenerTotalLeads_t($i, $utm);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            $tmp = $row['Total'];
            
            $preaprob =  $preaprob + $tmp;
        }
        echo "[" . $preaprob . "]";

    }
    
    function getDataLeads_hoy($utm){
        $persona = new Persona();
        
            $res = $persona->obtenerTotalLeads_hoy($utm);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            $tmp = $row['Total'];
            
        echo $tmp;

    }
    
    function getDataLeads_hoy2($utm, $utm1){
        $persona = new Persona();
        
            $res = $persona->obtenerTotalLeads_hoy2($utm, $utm1);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            $tmp = $row['Total'];
            
        echo $tmp;

    }
    
    function getDataLeads_t2($cant, $utm, $utm1){
        $persona = new Persona();
        $preaprob = 0;
        
        for ($i = $cant; $i >= 1; $i--) {
            
            $res = $persona->obtenerTotalLeads_t2($i, $utm, $utm1);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            $tmp = $row['Total'];
            
            $preaprob =  $preaprob + $tmp;
        }
        echo "[" . $preaprob . "]";

    }
    
    function getDataPreaprobados_t2($cant, $utm, $utm1){
        $persona = new Persona();
        $preaprob = 0;
        
        for ($i = $cant; $i >= 1; $i--) {
            
            $res = $persona->obtenerPreAprobados_t2($i, $utm, $utm1);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            $tmp = $row['Total'];
            
            $preaprob =  $preaprob + $tmp;
        }
        echo "[" . $preaprob . "]";

    }
    
    function getTotDesemb(){
        $persona = new Persona();
        
            $res = $persona->total_desembolsados();
            $row = $res->fetch(PDO::FETCH_ASSOC);
            $tmp = $row['TotalDesem'];
            
        echo $tmp;

    }
    
    function tarjetasPendientes($funcionario){
        $persona = new Persona();
        
            $res = $persona->tarjetasPendientes_persona($funcionario);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            
            $res1 = $persona->tarjetasPendientes_persona_div1($funcionario);
            $row1 = $res1->fetch(PDO::FETCH_ASSOC);
            
            $tmp = $row['Total'] + ($row1['Total']/2);
            
        echo $tmp;

    }
    
    function tarjetasPendientes_sandbox($funcionario){
        $persona = new Persona();
        
            $res = $persona->tarjetasPendientes_persona($funcionario);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            
            $tmp = $row['Total'];
            
            $res1 = $persona->tarjetasPendientes_persona_div1($funcionario);
            $row1 = $res1->fetch(PDO::FETCH_ASSOC);
            
            $tmp1 = ($row1['Total']/2);
            
            $_SESSION["$funcionario"] = ($tmp + $tmp1);

    }
    
    function getTotDesemb_persona($funcionario){
        $persona = new Persona();
        
            $res = $persona->total_desembolsados_persona($funcionario);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            $tmp = $row['TotalDesem'];
            
        echo $tmp;

    }
    
    function getImpDesemb(){
        $persona = new Persona();
        
            $res = $persona->imp_desembolsados();
            $row = $res->fetch(PDO::FETCH_ASSOC);
            $tmp = number_format($row['TotalDesem'],0);
            
        echo $tmp;

    }
    
    function getImpDesemb_persona($funcionario){
        $persona = new Persona();
        
            $res = $persona->imp_desembolsados_persona($funcionario);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            $tmp = number_format($row['TotalDesem'],0);
            
        echo $tmp;

    }
    
    function getListadoDesemb(){
        $persona = new Persona();
        $res = $persona->obtListadoDesemb();
        $i=1;
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
                if($row['Funcionario']=="XIOMI"){
                    $tmp = "XC";
                    $color = "success";
                }
                if($row['Funcionario']=="KAORI"){
                    $tmp = "KU";
                    $color = "danger";
                }
                if(substr($row['Funcionario'],0,5)=="JOHAN"){
                    $tmp = "JD";
                    $color = "primary";
                }
                
                echo $i++ . ".- " . substr($row['Nombres'],0,22) . " [" . $row['Dni'] . "] - S/ " .  number_format($row['Monto'],0) . " - " . $row['Nombre_empresa'] . " <button type='button' class='btn btn-" . $color . " btn-xs'>". $tmp . "</button><br>";    
            }
        }
    }
    
    function getDataPreaprobados_t($cant, $utm){
        $persona = new Persona();
        $preaprob = 0;
        
        for ($i = $cant; $i >= 1; $i--) {
            
            $res = $persona->obtenerPreAprobados_t($i, $utm);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            $tmp = $row['Total'];
            
            $preaprob =  $preaprob + $tmp;
        }
        echo "[" . $preaprob . "]";

    }
    
    function getDataPreaprobados_hoy($funcionario){
        $persona = new Persona();
        $preaprob = 0;
        
            $res = $persona->obtenerPreAprobados_hoy($funcionario);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            $preaprob = $row['Total'];
       
        echo "[" . $preaprob . "]";
    }
    
    function getDataPreaprobados_utm_hoy($utm){
        $persona = new Persona();
        $preaprob = 0;
        
            $res = $persona->getDataPreaprobados_utm_hoy($utm);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            $preaprob = $row['Total'];
       
        echo $preaprob;
    }

    function getDataPreaprobados_utm_hoy2($utm, $utm1){
        $persona = new Persona();
        $preaprob = 0;
        
            $res = $persona->getDataPreaprobados_utm_hoy2($utm, $utm1);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            $preaprob = $row['Total'];
       
        echo $preaprob;
    }    
    
    function getDataPreaprobados($cant){
        $persona = new Persona();
        $cadena = "";
        
        for ($i = $cant; $i >= 1; $i--) {
            
            $res = $persona->obtenerPreAprobados($i);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            $tmp = $row['Total'];
            
            if($i==$cant)
                $cadena = $cadena . $tmp;
            else
                $cadena =  $cadena . "," . $tmp;
        }
        echo "data: [" . $cadena . "],";
        
    }
    
    function getDataPreaprobadosXiomi_t($cant){
        $persona = new Persona();
        $preaprob = 0;
        
        for ($i = $cant; $i >= 1; $i--) {
            
            $res = $persona->obtenerPreAprobadosXiomi($i);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            $tmp = $row['Total'];
            
            $preaprob =  $preaprob + $tmp;
        }
        echo "[" . $preaprob . "]";
        
    }
    
    function getDataPreaprobadosKaori_t($cant){
        $persona = new Persona();
        $preaprob = 0;
        
        for ($i = $cant; $i >= 1; $i--) {
            
            $res = $persona->obtenerPreAprobadosKaori($i);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            $tmp = $row['Total'];
            
            $preaprob =  $preaprob + $tmp;
        }
        echo "[" . $preaprob . "]";
        
    }
    
    function getDataPreaprobadosJohann_t($cant){
        $persona = new Persona();
        $preaprob = 0;
        
        for ($i = $cant; $i >= 1; $i--) {
            
            $res = $persona->obtenerPreAprobadosJohann($i);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            $tmp = $row['Total'];
            
            $preaprob =  $preaprob + $tmp;
        }
        echo "[" . $preaprob . "]";
        
    }
    
    function getDataPreaprobadosXiomi($cant){
        $persona = new Persona();
        $cadena = "";
        
        for ($i = $cant; $i >= 1; $i--) {
            
            $res = $persona->obtenerPreAprobadosXiomi($i);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            $tmp = $row['Total'];
            
            if($i==$cant)
                $cadena = $cadena . $tmp;
            else
                $cadena =  $cadena . "," . $tmp;
        }
        echo "data: [" . $cadena . "],";
        
    }
    
    function getDataPreaprobadosKaori($cant){
        $persona = new Persona();
        $cadena = "";
        
        for ($i = $cant; $i >= 1; $i--) {
            
            $res = $persona->obtenerPreAprobadosKaori($i);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            $tmp = $row['Total'];
            
            if($i==$cant)
                $cadena = $cadena . $tmp;
            else
                $cadena =  $cadena . "," . $tmp;
        }
        echo "data: [" . $cadena . "],";
        
    }
    
    function getDataPreaprobadosJohann($cant){
        $persona = new Persona();
        $cadena = "";
        
        for ($i = $cant; $i >= 1; $i--) {
            
            $res = $persona->obtenerPreAprobadosJohann($i);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            $tmp = $row['Total'];
            
            if($i==$cant)
                $cadena = $cadena . $tmp;
            else
                $cadena =  $cadena . "," . $tmp;
        }
        echo "data: [" . $cadena . "],";
        
    }
    
    function getLabels($labels){
        date_default_timezone_set('America/Lima');
        $cadena = "";
        
        for ($i = $labels; $i >= 1; $i--) {
            $lit = date('d-m', strtotime('-' . $i . ' day'));
            $cadena = $cadena . "'" . $lit . "',";
        }
        echo $cadena;
    }

    function exporta_csv_exp(){
        $persona = new Persona();
        $res = $persona->obtenerPersonas_exp();
        
        if($res->rowCount())
        {
            $delimiter = "|";
            $filename = "experian_" . date('Y-m-d') . ".csv";
    
            //create a file pointer
            $f = fopen('php://memory', 'w');
    
            //set column headers
            $fields = array('Fecha','Nombres','Dni','Situacion','Estado','Celular','Correo');
            fputcsv($f, $fields, $delimiter);
    
            //output each row of the data, format line as csv and write to file pointer
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
				if($row['Estado']=="PRE-APROBADO"){
                    $color="";$tmp="";
                    if($row['Paso']=="div7"){
                        $tmp = "X - " . $row['Observaciones'];
                    }else{
                        if($row['Paso']=="div2"){
                            $tmp = "(2/5) ENVIANDO DOCUMENTOS";    
                        }
                        if($row['Paso']=="div4"){
                            $tmp = "(3/5) VERIFICANDO LAB/DOM";    
                        }
                        if($row['Paso']=="div3"){
                            $tmp = "(4/5) FILE EN AGENCIA";    
                        }
                        if($row['Paso']=="div5"){
                            $tmp = "(5/5) FIRMA EN AGENCIA";    
                        }
                        if($row['Paso']=="div6"){
                            $tmp = "DESEMBOLSADO S/ " . number_format($row['Monto'],0);    
                        }
                        if($row['Paso']=="div1"){
                            $tmp = "(1/5) EN CONTACTO";    
                        }
                    }
                }else{
                    $tmp = $row['Estado'];
                }

                $lineData = array($row['Fecha'], $row['Nombres'], $row['Dni'], $row['Situacion'], $tmp, $row['Celular'], $row['Correo']);
                fputcsv($f, $lineData, $delimiter);
            }
    
            //move back to beginning of file
            fseek($f, 0);
    
            //set headers to download file rather than displayed
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="' . $filename . '";');
    
            //output all remaining data on a file pointer
            fpassthru($f);
        }
        exit;
    }
    
    function exporta_csv_lista(){
        $persona = new Persona();
        $res = $persona->obtenerPersonas();
        
        if($res->rowCount())
        {
            $delimiter = "|";
            $filename = "lista_" . date('Y-m-d') . ".csv";
    
            //create a file pointer
            $f = fopen('php://memory', 'w');
    
            //set column headers
            $fields = array('Fecha','Nombres','Dni','Situacion','Estado','Celular');
            fputcsv($f, $fields, $delimiter);
    
            //output each row of the data, format line as csv and write to file pointer
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
                $lineData = array($row['Fecha'], $row['Nombres'], $row['Dni'], $row['Situacion'], $row['Estado'], $row['Celular']);
                fputcsv($f, $lineData, $delimiter);
            }
    
            //move back to beginning of file
            fseek($f, 0);
    
            //set headers to download file rather than displayed
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="' . $filename . '";');
    
            //output all remaining data on a file pointer
            fpassthru($f);
        }
        exit;
        
        
    }
    
    function exporta_csv_aelu(){
        $persona = new Persona();
        $res = $persona->obtenerPersonas_aelu();
        
        if($res->rowCount())
        {
            $delimiter = "|";
            $filename = "aelu_" . date('Y-m-d') . ".csv";
    
            //create a file pointer
            $f = fopen('php://memory', 'w');
    
            //set column headers
            $fields = array('Fecha','Doi','Resultado','Celular','Nick');
            fputcsv($f, $fields, $delimiter);
    
            //output each row of the data, format line as csv and write to file pointer
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
                $lineData = array($row['Fecha'], $row['Doi'], $row['Resultado'], $row['Celular'], $row['Nick']);
                fputcsv($f, $lineData, $delimiter);
            }
    
            //move back to beginning of file
            fseek($f, 0);
    
            //set headers to download file rather than displayed
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="' . $filename . '";');
    
            //output all remaining data on a file pointer
            fpassthru($f);
        }
        exit;
        
        
    }
    
    function exporta_csv_supersorteo(){
        $persona = new Persona();
        $res = $persona->obtenerPersonas_supersorteo();
        
        if($res->rowCount())
        {
            $delimiter = "|";
            $filename = "supersorteo_" . date('Y-m-d') . ".csv";
    
            //create a file pointer
            $f = fopen('php://memory', 'w');
    
            //set column headers
            $fields = array('Fecha','Doi','Resultado','Celular','Nick');
            fputcsv($f, $fields, $delimiter);
    
            //output each row of the data, format line as csv and write to file pointer
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
                $lineData = array($row['Fecha'], $row['Doi'], $row['Resultado'], $row['Celular'], $row['Nick']);
                fputcsv($f, $lineData, $delimiter);
            }
    
            //move back to beginning of file
            fseek($f, 0);
    
            //set headers to download file rather than displayed
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="' . $filename . '";');
    
            //output all remaining data on a file pointer
            fpassthru($f);
        }
        exit;
        
        
    }
    
    
    function preaprobado(){
        $persona = new Persona();
        $res = $persona->obtenerPreAprobados();
        $row = $res->fetch(PDO::FETCH_ASSOC);
        $preaprobados = $row['Total'];
        $fec_act = date('F');
        $fec_act = substr($fec_act,0,3);
        echo "<b>Pre-aprobados:</b> [$fec_act] $preaprobados";
    }
    
    function totalLeads(){
        $persona = new Persona();
        $res = $persona->obtenerTotalLeads();
        $row = $res->fetch(PDO::FETCH_ASSOC);
        $totalLeads = $row['Total'];
        echo "/$totalLeads";
    }
    
    function preaprobado2(){
        $persona = new Persona();
        $res = $persona->obtenerPreAprobados2();
        $row = $res->fetch(PDO::FETCH_ASSOC);
        $preaprobados = $row['Total'];
        $fec_pas = date('F', strtotime('last month'));
        $fec_pas = substr($fec_pas,0,3);
        echo "<b> [$fec_pas] $preaprobados";
    }
    
    function totalLeads2(){
        $persona = new Persona();
        $res = $persona->obtenerTotalLeads2();
        $row = $res->fetch(PDO::FETCH_ASSOC);
        $totalLeads = $row['Total'];
        echo "/$totalLeads";
    }
    
    function add($item){
        $persona = new Persona();

        $res = $persona->nuevaPersona($item);
        $this->exito('Se ingreso el registro de manera correcta');
    }
    
    function add_aelulog($item){
        $persona = new Persona();

        $res = $persona->nuevaRegistroAelu($item);
        $this->exito('Se ingreso el registro de manera correcta Aelu');
    }
    
    function add_supersorteolog($item){
        $persona = new Persona();

        $res = $persona->nuevaRegistroSuperSorteo($item);
        $this->exito('Se ingreso el registro de manera correcta Super Sorteo');
    }
    
    function add2($item){
        $persona = new Persona();

        $res = $persona->nuevaPersona($item);
    }
    
    function error($mensaje){
        echo '<code>' . json_encode(array('mensaje' => $mensaje)) . '</code>'; 
    }

    function exito($mensaje){
        echo '<code>' . json_encode(array('mensaje' => $mensaje)) . '</code>'; 
    }

    function printJSON($array){
        echo '<code>'.json_encode($array).'</code>';
    }
}

?>