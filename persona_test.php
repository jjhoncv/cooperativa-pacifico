<?php

include_once 'db.php';

class Persona extends DB{
    
    function obtenerPersonas($keyword){
        if($keyword==""){
            $query = $this->connect()->query('SELECT * FROM Persona ORDER BY Fecha DESC LIMIT 500');
            
        }else{
            $query = $this->connect()->query("SELECT * FROM Persona where (Nombres like '%$keyword%') OR (Dni like '%$keyword%') OR (Situacion like '%$keyword%') OR (Nombre_empresa like '%$keyword%') OR (Estado like '%$keyword%') OR (Funcionario like '%$keyword%') ORDER BY Fecha DESC LIMIT 500");
            
        }
        
        return $query;
    }
    
    function obtenerPlantillas(){
        $query = $this->connect()->query('SELECT * FROM template');
        return $query;
    }
    
    function obtener_Score(){
        $query = $this->connect()->query('SELECT * FROM Score WHERE Calificacion = 0');
        return $query;
    }
    
    function update_Score($dni){
        $score=5;
        $query = $this->connect()->query("UPDATE Score SET Calificaion=$score WHERE Dni='$dni'");
        return $query;
    }
	
    function update_funcionario($samantha, $daniel, $dayssy, $gabriela, $cinthia){
		if($samantha=="false")
			$query = $this->connect()->query("UPDATE Funcionarios SET Activo='n' WHERE Nombre='Samantha'");
		else
			$query = $this->connect()->query("UPDATE Funcionarios SET Activo='s' WHERE Nombre='Samantha'");
		
		if($daniel=="false")
			$query = $this->connect()->query("UPDATE Funcionarios SET Activo='n' WHERE Nombre='Daniel'");
		else
			$query = $this->connect()->query("UPDATE Funcionarios SET Activo='s' WHERE Nombre='Daniel'");
		
		if($dayssy=="false")
			$query = $this->connect()->query("UPDATE Funcionarios SET Activo='n' WHERE Nombre='Dayssy'");
		else
			$query = $this->connect()->query("UPDATE Funcionarios SET Activo='s' WHERE Nombre='Dayssy'");
		
		if($gabriela=="false")
			$query = $this->connect()->query("UPDATE Funcionarios SET Activo='n' WHERE Nombre='Gabriela'");
		else
			$query = $this->connect()->query("UPDATE Funcionarios SET Activo='s' WHERE Nombre='Gabriela'");
		
		if($cinthia=="false")
			$query = $this->connect()->query("UPDATE Funcionarios SET Activo='n' WHERE Nombre='Cinthia'");
		else
			$query = $this->connect()->query("UPDATE Funcionarios SET Activo='s' WHERE Nombre='Cinthia'");
		
        return $query;
    }
    
    function update_funcionario_digital($xiomi, $kaori, $johann){
		
		if($xiomi=="false")
			$query = $this->connect()->query("UPDATE Digital SET Activo='n' WHERE Nombre='Xiomi'");
		else
			$query = $this->connect()->query("UPDATE Digital SET Activo='s' WHERE Nombre='Xiomi'");
		
		if($kaori=="false")
			$query = $this->connect()->query("UPDATE Digital SET Activo='n' WHERE Nombre='Kaori'");
		else
			$query = $this->connect()->query("UPDATE Digital SET Activo='s' WHERE Nombre='Kaori'");
		
		if($johann=="false")
			$query = $this->connect()->query("UPDATE Digital SET Activo='n' WHERE Nombre='Johann'");
		else
			$query = $this->connect()->query("UPDATE Digital SET Activo='s' WHERE Nombre='Johann'");
		
		
        return $query;
    }
	
    function update_Paso($id, $paso){
        date_default_timezone_set('America/Lima');
        $actual_fecha = date('Y-m-d H:i:s');
        $query = $this->connect()->query("UPDATE Persona SET Paso='$paso', Fecha_2='$actual_fecha' WHERE Id='$id'");
        return $query;
    }
    
    function update_Paso_kyodai($id, $paso){
        date_default_timezone_set('America/Lima');
        $actual_fecha = date('Y-m-d H:i:s');
        $query = $this->connect()->query("UPDATE Inscripcion SET Paso='$paso', Fecha_2='$actual_fecha' WHERE Id='$id'");
        return $query;
    }
	
    function update_Paso_agencias($id, $paso){
        date_default_timezone_set('America/Lima');
        $actual_fecha = date('Y-m-d H:i:s');
        $query = $this->connect()->query("UPDATE Agencias SET Paso='$paso', Fecha_2='$actual_fecha' WHERE Id='$id'");
        return $query;
    }
	
    function update_Paso_agencias2($id, $paso){
        date_default_timezone_set('America/Lima');
        $actual_fecha = date('Y-m-d H:i:s');
        $query = $this->connect()->query("UPDATE Agencias2 SET Paso='$paso', Fecha_2='$actual_fecha' WHERE Id='$id'");
        return $query;
    }

    function update_Obs($id, $obs, $monto, $paso, $funcionario, $fec_ingreso){
        date_default_timezone_set('America/Lima');
        $actual_fecha = date('Y-m-d H:i:s');
        
		if($fec_ingreso==""){
			$query = $this->connect()->query("UPDATE Persona SET Observaciones='$obs', Monto='$monto', Fecha_2='$actual_fecha', Paso='$paso', Funcionario='$funcionario' WHERE Id='$id'");

		}else{
			$query = $this->connect()->query("UPDATE Persona SET Fecha='$fec_ingreso 08:45:00', Observaciones='$obs', Monto='$monto', Fecha_2='$fec_ingreso 08:45:00', Paso='$paso', Funcionario='$funcionario' WHERE Id='$id'");
		}
		
        return $query;
    }

    function update_Obs_kyodai($id, $obs, $paso, $funcionario, $fec_ingreso){
        date_default_timezone_set('America/Lima');
        $actual_fecha = date('Y-m-d H:i:s');
        
		if($fec_ingreso==""){
			$query = $this->connect()->query("UPDATE Inscripcion SET Observaciones='$obs', Fecha_2='$actual_fecha', Paso='$paso', Funcionario='$funcionario' WHERE Id='$id'");
		}else{
			$query = $this->connect()->query("UPDATE Inscripcion SET Observaciones='$obs', Fecha='$fec_ingreso 08:45:00', Fecha_2='$fec_ingreso 08:45:00', Paso='$paso', Funcionario='$funcionario' WHERE Id='$id'");
			
		}
		
        return $query;
    }
	
	function avance_agencias2($agencia, $accion, $mes, $moneda){
		date_default_timezone_set('America/Lima');
		
		if($mes=="0")
			$actual_fecha = date('Y-m');
		if($mes=="-1")
			$actual_fecha = date('Y-m', strtotime($mes . ' month'));
		if($mes=="-2")
			$actual_fecha = date('Y-m', strtotime($mes . ' month'));
		
		if($moneda=="soles")
			$moneda="1";
		if($moneda=="dolares")
			$moneda="2"; 
		
		if($agencia!="")
			$query = $this->connect()->query("SELECT SUM(Monto) as Total FROM Agencias2 WHERE (Fecha_2 BETWEEN '$actual_fecha-01 00:00:00' AND '$actual_fecha-31 23:59:59') AND Moneda='$moneda' AND Agencia='$agencia' AND Tarea='$accion'");
		else
			$query = $this->connect()->query("SELECT SUM(Monto) as Total FROM Agencias2 WHERE (Fecha_2 BETWEEN '$actual_fecha-01 00:00:00' AND '$actual_fecha-31 23:59:59') AND Moneda='$moneda' AND Tarea='$accion'");
		
		return $query;
	}
	
	function avance_alicia($agencia, $accion, $mes, $moneda){
		date_default_timezone_set('America/Lima');
		
		if($mes=="0")
			$actual_fecha = date('Y-m');
		if($mes=="-1")
			$actual_fecha = date('Y-m', strtotime($mes . ' month'));
		if($mes=="-2")
			$actual_fecha = date('Y-m', strtotime($mes . ' month'));
		
		if($moneda=="soles")
			$moneda="1";
		if($moneda=="dolares")
			$moneda="2"; 
		
		$query = $this->connect()->query("SELECT SUM(Monto) as Total FROM Agencias WHERE (Fecha_2 BETWEEN '$actual_fecha-01 00:00:00' AND '$actual_fecha-31 23:59:59') AND Paso='div6' AND Moneda='$moneda' AND Tarea='$accion'");
		
		return $query;
	}	
	
	function meta_agencias2($agencia, $accion, $mes, $moneda){
		date_default_timezone_set('America/Lima');
		if($mes=="0")
			$actual_fecha = date('Y-m');
		if($mes=="-1")
			$actual_fecha = date('Y-m', strtotime($mes . ' month'));
		if($mes=="-2")
			$actual_fecha = date('Y-m', strtotime($mes . ' month'));
		
		if($moneda=="soles")
			$moneda="1";
		if($moneda=="dolares")
			$moneda="2"; 
		
		$query = $this->connect()->query("SELECT SUM(Monto) as Total FROM Agencias_metas WHERE Agencia='$agencia' AND Moneda='$moneda' AND Tipo='$accion' AND Periodo='$actual_fecha'");
		
		return $query;
	}
	
    function update_Obs_agencias($id, $obs, $paso, $funcionario, $monto, $fec_desembolso, $moneda, $cuotas, $rechazado, $tarea, $tipo, $agencia, $fec_ingreso){
        date_default_timezone_set('America/Lima');
        $actual_fecha = date('Y-m-d H:i:s');
		
		$monto = str_replace(",",".",$monto);
        
		if($fec_ingreso==""){
			$query = $this->connect()->query("UPDATE Agencias SET Observaciones='$obs', Fecha_2='$actual_fecha', Paso='$paso', Funcionario='$funcionario', Monto='$monto', Fec_desembolso='$fec_desembolso', Moneda='$moneda', Cuotas='$cuotas', Rechazo='$rechazado', Agencia='$agencia', Tarea='$tarea', Tipo_prestamo='$tipo' WHERE Id='$id'");
		}else{
			$query = $this->connect()->query("UPDATE Agencias SET Observaciones='$obs', Fecha='$fec_ingreso 08:45:00', Fecha_2='$fec_ingreso 08:45:00', Paso='div1', Funcionario='$funcionario', Monto='$monto', Fec_desembolso='$fec_desembolso', Moneda='$moneda', Cuotas='$cuotas', Rechazo='$rechazado', Agencia='$agencia', Tarea='$tarea', Tipo_prestamo='$tipo' WHERE Id='$id'");
		}
        return $query;
    }	

    function update_Obs_agencias2($id, $obs, $paso, $funcionario, $monto, $tarea, $canal, $moneda){
        date_default_timezone_set('America/Lima');
        $actual_fecha = date('Y-m-d H:i:s');
		
		$monto = str_replace(",",".",$monto);
        
        $query = $this->connect()->query("UPDATE Agencias2 SET Moneda='$moneda', Observaciones='$obs', Fecha_2='$actual_fecha', Paso='$paso', Funcionario='$funcionario', Monto='$monto', Tarea='$tarea', Canal='$canal' WHERE Id='$id'");
        return $query;
    }
    
    function obtener_Paginas(){
        $query = $this->connect()->query('SELECT * FROM pagina ORDER BY id DESC');
        return $query;
    }

    function obtener_Documento($dni){
        $query = $this->connect()->query("SELECT * FROM Documento where Dni='$dni' ORDER BY Id DESC");
        return $query;
    }

    function obtener_Historia($dni, $fecha){
        $query = $this->connect()->query("SELECT Fecha, Estado, Funcionario, Observaciones FROM Persona where Dni='$dni' AND Fecha < '$fecha' ORDER BY Id DESC");
        return $query;
    }

    function buscar_EnAgencia($dni){
        $query = $this->connect()->query("SELECT * FROM Agencias where Dni='$dni' ORDER BY Id DESC");
        return $query;
    }
    
    function obtenerTsurus($doi){
        $tmp = $doi['dni'];
        $query = $this->connect()->query("SELECT * FROM Tsuru where doi=" . $tmp);
        return $query;
    }
    
    function obtenerFeriado($fecha_actual){
        $query = $this->connect()->query("SELECT * FROM feriado where fecha='" . $fecha_actual . "'");
        return $query;
    }
    
    function repetidoDni($dni){
        date_default_timezone_set('America/Lima');
        $actual_fecha = date('Y-m-d');
        $query = $this->connect()->query("SELECT COUNT(Dni) as Total FROM Persona WHERE Dni='$dni' AND (Fecha BETWEEN '$actual_fecha 00:00:00' AND '$actual_fecha 23:59:59') AND Estado='PRE-APROBADO'");
        return $query;
    }
	
	function repetidoDni_infogas($dni){
        date_default_timezone_set('America/Lima');
        $actual_fecha = date('Y-m-d');
        $query = $this->connect()->query("SELECT COUNT(Dni) as Total FROM Infogas WHERE Dni='$dni' AND (Fecha BETWEEN '$actual_fecha 00:00:00' AND '$actual_fecha 23:59:59') AND Estado='PRE-APROBADO'");
        return $query;
    }
    
    function obtenerPersonas_exp(){
        date_default_timezone_set('America/Lima');
        $actual_fecha = date('Y-m-d');
        $actual_mes = date('Y-m');
        $query = $this->connect()->query("SELECT * FROM Persona where (Nombre_empresa='exp' or Nombre_empresa='Buscacredito') AND ((Fecha BETWEEN '2022-10-27 00:00:00' AND '$actual_fecha 23:59:59') OR (Fecha_2 BETWEEN '$actual_mes-01 00:00:00' AND '$actual_mes-31 23:59:59')) ORDER BY Fecha DESC LIMIT 1000");
        return $query;
    }
	

    function obtenerPersonas_infocore(){
        date_default_timezone_set('America/Lima');
        $actual_fecha = date('Y-m-d');
        $actual_mes = date('Y-m');
        $query = $this->connect()->query("SELECT * FROM Agencias where (Origen='lsolari@infocore.com.pe' OR Origen='elizabethpatino@gmail.com' OR Origen='infocore@cp') AND ((Fecha BETWEEN '2022-10-27 00:00:00' AND '$actual_fecha 23:59:59') OR (Fecha_2 BETWEEN '$actual_mes-01 00:00:00' AND '$actual_mes-31 23:59:59')) ORDER BY Fecha DESC LIMIT 1000");
        return $query;
    }

    function obtenerWhatsApp(){
        date_default_timezone_set('America/Lima');
        $actual_fecha = date('Y-m-d');
        $actual_mes = date('Y-m');
        $query = $this->connect()->query("SELECT * FROM WhatsApp ORDER BY Fecha DESC LIMIT 500");
        return $query;
    }
    
    function obtenerPersonas_aelu(){
        $query = $this->connect()->query("SELECT * FROM Aelu_log ORDER BY Fecha DESC LIMIT 400");
        return $query;
    }
    
    function obtenerPersonas_supersorteo(){
        $query = $this->connect()->query("SELECT * FROM SuperSorteo_log ORDER BY Fecha DESC LIMIT 400");
        return $query;
    }
    
    function obtenerPagina($pagina){
        $query = $this->connect()->query("SELECT * FROM pagina where descripcion='" . $pagina . "'");
        return $query;
       
    }
	
    function nuevaPersona_Infogas($persona){
        date_default_timezone_set('America/Lima');
        $fecha = date('"Y/m/d H:i:s"');
        $id="div1";
        
        $query = $this->connect()->prepare('INSERT INTO Infogas (Id, Nombres, Dni, Celular, Situacion, Ingreso_diario, prestamo_vigente, Deudas_impagas, Deuda_sistema, Utm, Fecha, Estado, Funcionario, Sexo, Nacimiento, Placa, Es_taxista, Vehiculo_gnv, Score, Fecha_2, Observaciones, Paso) VALUES (NULL, :nombres, :dni, :celular, :situacion, :ingreso_diario, :prestamo_vigente, :deudas_impagas, :deuda_sistema, :utm, ' . $fecha . ', :estado, :funcionario, :sexo, :nacimiento, :placa, :es_taxista, :vehiculo_gnv, :score,' . $fecha . ', :observaciones , "' . $id . '" )');
        $query->execute(['nombres' => $persona['nombres'], 'dni' => $persona['dni'], 'celular' => $persona['celular'], 'situacion' => $persona['situacion'], 'ingreso_diario' => str_replace(",",".",$persona['ingreso_diario']), 'prestamo_vigente' => $persona['prestamo_vigente'], 'deudas_impagas' => str_replace(",",".",$persona['deudas_impagas']), 'deuda_sistema' => str_replace(",",".",$persona['deuda_sistema']), 'utm' => $persona['utm'], 'estado' => $persona['estado'], 'funcionario' => $persona['funcionario'], 'sexo' => $persona['sexo'], 'nacimiento' => $persona['nacimiento'], 'placa' => $persona['placa'], 'es_taxista' => $persona['es_taxista'], 'vehiculo_gnv' => $persona['vehiculo_gnv'], 'score' => $persona['score'], 'observaciones' => $persona['observaciones']]);
        return $query;
    }
	
    
    function nuevaPersona($persona){
        date_default_timezone_set('America/Lima');
        $fecha = date('"Y/m/d H:i:s"');
        $id="div1";
        
        $query = $this->connect()->prepare('INSERT INTO Persona (Id, Nombres, Dni, Celular, Situacion, Sueldo_neto, Saldo_pagar_cuota, Dias_atraso, Deudas_impagas, Deuda_sistema, Ruc, Nombre_empresa, Fecha, Estado, Funcionario, Sexo, Nacimiento, Lima, Quinta, Correo, Score, Fecha_2, Paso) VALUES (NULL, :nombres, :dni, :celular, :situacion, :sueldo_neto, :saldo_pagar_cuota, :dias_atraso, :deudas_impagas, :deuda_sistema, :ruc, :nombre_empresa,' . $fecha . ', :estado, :funcionario, :sexo, :nacimiento, :lima, :quinta, :correo, :score,' . $fecha . ', "' . $id . '" )');
        $query->execute(['nombres' => $persona['nombres'], 'dni' => $persona['dni'], 'celular' => $persona['celular'], 'situacion' => $persona['situacion'], 'sueldo_neto' => str_replace(",",".",$persona['sueldo_neto']), 'saldo_pagar_cuota' => str_replace(",",".",$persona['saldo_pagar_cuota']), 'dias_atraso' => $persona['dias_atraso'], 'deudas_impagas' => str_replace(",",".",$persona['deudas_impagas']), 'deuda_sistema' => str_replace(",",".",$persona['deuda_sistema']), 'ruc' => $persona['ruc'], 'nombre_empresa' => $persona['nombre_empresa'], 'estado' => $persona['estado'], 'funcionario' => $persona['funcionario'], 'sexo' => $persona['sexo'], 'nacimiento' => $persona['nacimiento'], 'lima' => $persona['lima'], 'quinta' => $persona['quinta'], 'correo' => $persona['correo'], 'score' => $persona['score']]);
        return $query;
    }
	
    function nuevaPersona_pdp($persona){
        date_default_timezone_set('America/Lima');
        $fecha = date('"Y/m/d H:i:s"');
        $id="div1";
        
        $query = $this->connect()->prepare('INSERT INTO Pdp (Id, Nombres, Dni, Celular, Situacion, Sueldo_neto, Saldo_pagar_cuota, Dias_atraso, Deudas_impagas, Deuda_sistema, Ruc, Nombre_empresa, Fecha, Estado, Funcionario, Sexo, Nacimiento, Lima, Quinta, Correo, Score, Fecha_2, Paso) VALUES (NULL, :nombres, :dni, :celular, :situacion, :sueldo_neto, :saldo_pagar_cuota, :dias_atraso, :deudas_impagas, :deuda_sistema, :ruc, :nombre_empresa,' . $fecha . ', :estado, :funcionario, :sexo, :nacimiento, :lima, :quinta, :correo, :score,' . $fecha . ', "' . $id . '" )');
        $query->execute(['nombres' => $persona['nombres'], 'dni' => $persona['dni'], 'celular' => $persona['celular'], 'situacion' => $persona['situacion'], 'sueldo_neto' => str_replace(",",".",$persona['sueldo_neto']), 'saldo_pagar_cuota' => str_replace(",",".",$persona['saldo_pagar_cuota']), 'dias_atraso' => $persona['dias_atraso'], 'deudas_impagas' => str_replace(",",".",$persona['deudas_impagas']), 'deuda_sistema' => str_replace(",",".",$persona['deuda_sistema']), 'ruc' => $persona['ruc'], 'nombre_empresa' => $persona['nombre_empresa'], 'estado' => $persona['estado'], 'funcionario' => $persona['funcionario'], 'sexo' => $persona['sexo'], 'nacimiento' => $persona['nacimiento'], 'lima' => $persona['lima'], 'quinta' => $persona['quinta'], 'correo' => $persona['correo'], 'score' => $persona['score']]);
        return $query;
    }	

    function nuevaPersona_wsp($persona){
        date_default_timezone_set('America/Lima');
        $fecha = date('"Y/m/d H:i:s"');
        
        $query = $this->connect()->prepare('INSERT INTO WhatsApp (Id, Fecha, Numero, Canal, Tematico, Fecha_2, Doi, Nombre, Funcionario, Ult_palabra) VALUES (NULL, ' . $fecha . ', :numero, :canal, :tematico, ' . $fecha . ', :doi, :nombre, :funcionario, NULL )');
        $query->execute(['numero' => $persona['numero'], 'canal' => $persona['canal'], 'tematico' => $persona['tematico'], 'doi' => $persona['doi'],  'nombre' => $persona['nombre'], 'funcionario' => $persona['funcionario']]);
        return $query;
    }
    
    function nuevaInscripcion($persona){
        date_default_timezone_set('America/Lima');
        $fecha = date('"Y/m/d H:i:s"');
        $id="div1";
        
        $query = $this->connect()->prepare('INSERT INTO Inscripcion (Id, Ape_pat, Ape_mat, Nombres, Dni, Celular, Correo, Situacion, Deudas_impagas, Deuda_sistema, Fecha, Funcionario, Sexo, Nacimiento, Fecha_2, Paso, Observaciones) VALUES (NULL, :ape_pat, :ape_mat, :nombres, :dni, :celular, :correo, :situacion, :deudas_impagas, :deuda_sistema,' . $fecha . ', :funcionario, :sexo, :nacimiento, ' . $fecha . ', "' . $id . '", :observaciones )');
        $query->execute(['ape_pat' => $persona['ape_pat'], 'ape_mat' => $persona['ape_mat'], 'nombres' => $persona['nombres'], 'dni' => $persona['dni'], 'celular' => $persona['celular'], 'correo' => $persona['correo'], 'situacion' => $persona['situacion'], 'deudas_impagas' => str_replace(",",".",$persona['deudas_impagas']), 'deuda_sistema' => str_replace(",",".",$persona['deuda_sistema']), 'funcionario' => $persona['funcionario'], 'sexo' => $persona['sexo'], 'nacimiento' => $persona['nacimiento'], 'observaciones' => $persona['observaciones']]);
        return $query;
    }

    function nuevaTareaAgencias2($persona){
        date_default_timezone_set('America/Lima');
        $fecha = date('"Y/m/d H:i:s"');
		
		if($persona['tarea']=="operacion")
			$id="div6";
		else
			$id="div1";
        
        $query = $this->connect()->prepare('INSERT INTO Agencias2 (Id, Fecha, Dni, Codigo, Nombres, Correo, Celular, Observaciones, Canal, Agencia, Funcionario, Paso, Tarea, Fecha_2) VALUES (NULL, ' . $fecha . ',:dni, :codigo, :nombres, :correo, :celular, :observaciones, :canal, :agencia, :funcionario, "' . $id . '",:tarea, ' . $fecha . ')');
        $query->execute(['dni' => $persona['dni'], 'nombres' => $persona['nombres'], 'codigo' => $persona['codigo'], 'agencia' => $persona['agencia'], 'correo' => $persona['correo'], 'celular' => $persona['celular'], 'observaciones' =>$persona['observaciones'], 'funcionario' => $persona['funcionario'], 'canal' => $persona['canal'], 'tarea' => $persona['tarea']]);
        return $query;
    }
    
    function nuevaRegistroAelu($persona){
        date_default_timezone_set('America/Lima');
        $fecha = date('"Y/m/d H:i:s"');
        
        $query = $this->connect()->prepare('INSERT INTO Aelu_log (Id, Fecha, Celular, Nick, Doi, Resultado) VALUES (NULL,' . $fecha . ', :Celular, :Nick, :Doi, :Resultado)');
        $query->execute(['Celular' => $persona['Celular'], 'Nick' => $persona['Nick'], 'Doi' => $persona['Doi'], 'Resultado' => $persona['Resultado']]);
        return $query;
    }
    
    function nuevaRegistroSuperSorteo($persona){
        date_default_timezone_set('America/Lima');
        $fecha = date('"Y/m/d H:i:s"');
        
        $query = $this->connect()->prepare('INSERT INTO SuperSorteo_log (Id, Fecha, Celular, Nick, Doi, Resultado) VALUES (NULL,' . $fecha . ', :Celular, :Nick, :Doi, :Resultado)');
        $query->execute(['Celular' => $persona['Celular'], 'Nick' => $persona['Nick'], 'Doi' => $persona['Doi'], 'Resultado' => $persona['Resultado']]);
        return $query;
    }

    function obtenerPreAprobados($num){
        date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d', strtotime('-' . $num . ' day'));
        
        $query = $this->connect()->query("SELECT COUNT(DISTINCT Dni) as Total FROM Persona WHERE (Fecha BETWEEN '$actual_feha 00:00:00' AND '$actual_feha 23:59:59') AND Estado='PRE-APROBADO'");
        return $query;
    }
    
    function imp_desembolsados(){
        date_default_timezone_set('America/Lima');
        $hoy = date('Y-m-d');
        $first_day = date('Y-m');
        
        $query = $this->connect()->query("SELECT SUM(Monto) as TotalDesem FROM Persona WHERE (Fecha_2 BETWEEN '$first_day-01 00:00:00' AND '$hoy 23:59:59') AND Paso='div6'");
        return $query;
    }

    function imp_desembolsados_exp($mes){
        date_default_timezone_set('America/Lima');
        if($mes=="actual"){
			$month = date('Y-m');
		}
		if($mes=="pasado"){
			$month = date('Y-m', strtotime('last month'));
		}
        
        $query = $this->connect()->query("SELECT SUM(Monto) as TotalDesem FROM Persona WHERE (Fecha_2 BETWEEN '$month-01 00:00:00' AND '$month-31 23:59:59') AND Paso='div6' AND (Nombre_empresa='exp' or Nombre_empresa='Buscacredito')");
        return $query;
    }

    function imp_desembolsados_infocore($mes){
        date_default_timezone_set('America/Lima');
        if($mes=="actual"){
			$month = date('Y-m');
		}
		if($mes=="pasado"){
			$month = date('Y-m', strtotime('last month'));
		}
        $query = $this->connect()->query("SELECT SUM(Monto) as TotalDesem FROM Agencias WHERE (Fecha_2 BETWEEN '$month-01 00:00:00' AND '$month-31 23:59:59') AND Paso='div6' AND (Origen='lsolari@infocore.com.pe' OR Origen='elizabethpatino@gmail.com' OR Origen='infocore@cp')");
		return $query;
    }
	
    function imp_desembolsados_mpasado(){
        date_default_timezone_set('America/Lima');
        $month_day_last = date('Y-m', strtotime('last month'));
		
        $query = $this->connect()->query("SELECT SUM(Monto) as TotalDesem FROM Persona WHERE (Fecha_2 BETWEEN '$month_day_last-01 00:00:00' AND '$month_day_last-31 23:59:59') AND Paso='div6'");
        return $query;
    }
	
    function obtListadoDesemb(){
        date_default_timezone_set('America/Lima');
        $hoy = date('Y-m-d');
        $first_day = date('Y-m');
        
        $query = $this->connect()->query("SELECT * FROM Persona WHERE (Fecha_2 BETWEEN '$first_day-01 00:00:00' AND '$hoy 23:59:59') AND Paso='div6' ORDER BY Nombre_empresa");
        return $query;
    }
	
	function obtListadoDesemb_exp($mes){
        date_default_timezone_set('America/Lima');
        if($mes=="actual"){
			$month = date('Y-m');
		}
		if($mes=="pasado"){
			$month = date('Y-m', strtotime('last month'));
		}
        
        $query = $this->connect()->query("SELECT * FROM Persona WHERE (Fecha_2 BETWEEN '$month-01 00:00:00' AND '$month-31 23:59:59') AND Paso='div6' AND (Nombre_empresa='exp' or Nombre_empresa='Buscacredito')");
        return $query;
    }
	
	function obtListadoDesemb_infocore($mes){
        date_default_timezone_set('America/Lima');
        if($mes=="actual"){
			$month = date('Y-m');
		}
		if($mes=="pasado"){
			$month = date('Y-m', strtotime('last month'));
		}
        
        $query = $this->connect()->query("SELECT * FROM Agencias WHERE (Fecha_2 BETWEEN '$month-01 00:00:00' AND '$month-31 23:59:59') AND Paso='div6' AND (Nombre_empresa='exp' or Nombre_empresa='Buscacredito')");
        return $query;
    }

    function obtListadoDesemb_agencia($funcionario){
        date_default_timezone_set('America/Lima');
        $hoy = date('Y-m-d');
        $first_day = date('Y-m');
        
        $query = $this->connect()->query("SELECT * FROM Agencias WHERE (Fecha_2 BETWEEN '$first_day-01 00:00:00' AND '$hoy 23:59:59') AND Paso='div6' AND Funcionario LIKE '%$funcionario%'");
        return $query;
    }
	
	function obtListadoDesemb_agencia_mpasado($funcionario){
        date_default_timezone_set('America/Lima');
        $month_day_last = date('Y-m', strtotime('last month'));
        
        $query = $this->connect()->query("SELECT * FROM Agencias WHERE (Fecha_2 BETWEEN '$month_day_last-01 00:00:00' AND '$month_day_last-31 23:59:59') AND Paso='div6' AND Funcionario LIKE '%$funcionario%'");
        return $query;
    }

    function obtListadoDesemb_mpasado(){
        date_default_timezone_set('America/Lima');
        $month_day_last = date('Y-m', strtotime('last month'));
        
        $query = $this->connect()->query("SELECT * FROM Persona WHERE (Fecha_2 BETWEEN '$month_day_last-01 00:00:00' AND '$month_day_last-31 23:59:59') AND Paso='div6' ORDER BY Nombre_empresa");
        return $query;
    }
    
    function imp_desembolsados_persona($funcionario){
        date_default_timezone_set('America/Lima');
        $hoy = date('Y-m-d');
        $first_day = date('Y-m');
        
        $query = $this->connect()->query("SELECT SUM(Monto) as TotalDesem FROM Persona WHERE (Fecha_2 BETWEEN '$first_day-01 00:00:00' AND '$hoy 23:59:59') AND Paso='div6' AND Funcionario LIKE '$funcionario%'");
        return $query;
    }

    function imp_desembolsados_agencia($funcionario, $tarea){
        date_default_timezone_set('America/Lima');
        $hoy = date('Y-m-d');
        $first_day = date('Y-m');
        
        $query = $this->connect()->query("SELECT SUM(Monto) as TotalDesem FROM Agencias WHERE (Fecha_2 BETWEEN '$first_day-01 00:00:00' AND '$hoy 23:59:59') AND Paso='div6' AND Tarea='$tarea' AND Moneda='1' AND Funcionario LIKE '$funcionario%'");
        return $query;
    }

    function imp_desembolsados_agencia_dol($funcionario, $tarea){
        date_default_timezone_set('America/Lima');
        $hoy = date('Y-m-d');
        $first_day = date('Y-m');
        
        $query = $this->connect()->query("SELECT SUM(Monto) as TotalDesem FROM Agencias WHERE (Fecha_2 BETWEEN '$first_day-01 00:00:00' AND '$hoy 23:59:59') AND Paso='div6' AND Tarea='$tarea' AND Moneda='2' AND Funcionario LIKE '$funcionario%'");
        return $query;
    }
	

    function imp_desembolsados_agencia_mpasado($funcionario, $tarea){
        date_default_timezone_set('America/Lima');
		$month_day_last = date('Y-m', strtotime('last month'));
        
        $query = $this->connect()->query("SELECT SUM(Monto) as TotalDesem FROM Agencias WHERE (Fecha_2 BETWEEN '$month_day_last-01 00:00:00' AND '$month_day_last-31 23:59:59') AND Paso='div6' AND Tarea='$tarea' AND Moneda='1' AND Funcionario LIKE '$funcionario%'");
        return $query;
    }

    function imp_desembolsados_agencia_ante_pasado_dol($funcionario, $tarea){
        date_default_timezone_set('America/Lima');
		$month_day_last = date('Y-m', strtotime('-2 month'));
        
        $query = $this->connect()->query("SELECT SUM(Monto) as TotalDesem FROM Agencias WHERE (Fecha_2 BETWEEN '$month_day_last-01 00:00:00' AND '$month_day_last-31 23:59:59') AND Paso='div6' AND Tarea='$tarea' AND Moneda='2'");
        return $query;
    }
	
    function imp_desembolsados_agencia_ante_pasado($funcionario, $tarea){
        date_default_timezone_set('America/Lima');
		$month_day_last = date('Y-m', strtotime('-2 month'));
        
        $query = $this->connect()->query("SELECT SUM(Monto) as TotalDesem FROM Agencias WHERE (Fecha_2 BETWEEN '$month_day_last-01 00:00:00' AND '$month_day_last-31 23:59:59') AND Paso='div6' AND Tarea='$tarea' AND Moneda='1'");
        return $query;
    }

    function imp_desembolsados_agencia_mpasado_dol($funcionario, $tarea){
        date_default_timezone_set('America/Lima');
		$month_day_last = date('Y-m', strtotime('last month'));
        
        $query = $this->connect()->query("SELECT SUM(Monto) as TotalDesem FROM Agencias WHERE (Fecha_2 BETWEEN '$month_day_last-01 00:00:00' AND '$month_day_last-31 23:59:59') AND Paso='div6' AND Tarea='$tarea' AND Moneda='2' AND Funcionario LIKE '$funcionario%'");
        return $query;
    }

    function imp_desembolsados_persona_mpasado($funcionario){
        date_default_timezone_set('America/Lima');
        $month_day_last = date('Y-m', strtotime('last month'));
        
        $query = $this->connect()->query("SELECT SUM(Monto) as TotalDesem FROM Persona WHERE (Fecha_2 BETWEEN '$month_day_last-01 00:00:00' AND '$month_day_last-31 23:59:59') AND Paso='div6' AND Funcionario LIKE '$funcionario%'");
        return $query;
    }
    
    function total_desembolsados(){
        date_default_timezone_set('America/Lima');
        $hoy = date('Y-m-d');
        $first_day = date('Y-m');
        
        $query = $this->connect()->query("SELECT COUNT(Monto) as TotalDesem FROM Persona WHERE (Fecha_2 BETWEEN '$first_day-01 00:00:00' AND '$hoy 23:59:59') AND Paso='div6'");
        return $query;
    }

    function total_desembolsados_exp($mes){
        date_default_timezone_set('America/Lima');
        if($mes=="actual"){
			$month = date('Y-m');
		}
		if($mes=="pasado"){
			$month = date('Y-m', strtotime('last month'));
		}
        
        $query = $this->connect()->query("SELECT COUNT(Monto) as TotalDesem FROM Persona WHERE (Fecha_2 BETWEEN '$month-01 00:00:00' AND '$month-31 23:59:59') AND Paso='div6' AND (Nombre_empresa='exp' or Nombre_empresa='Buscacredito')");
        return $query;
    }
	
    function total_desembolsados_infocore($mes){
        date_default_timezone_set('America/Lima');
        if($mes=="actual"){
			$month = date('Y-m');
		}
		if($mes=="pasado"){
			$month = date('Y-m', strtotime('last month'));
		}
        $query = $this->connect()->query("SELECT COUNT(Monto) as TotalDesem FROM Agencias WHERE (Fecha_2 BETWEEN '$month-01 00:00:00' AND '$month-31 23:59:59') AND Paso='div6' AND (Origen='lsolari@infocore.com.pe' OR Origen='elizabethpatino@gmail.com' OR Origen='infocore@cp')");
        return $query;
    }

    function total_desembolsados_mpasado(){
        date_default_timezone_set('America/Lima');
        $month_day_last = date('Y-m', strtotime('last month'));
        
        $query = $this->connect()->query("SELECT COUNT(Monto) as TotalDesem FROM Persona WHERE (Fecha_2 BETWEEN '$month_day_last-01 00:00:00' AND '$month_day_last-31 23:59:59') AND Paso='div6'");
        return $query;
    }
    
    function total_desembolsados_persona($funcionario){
        date_default_timezone_set('America/Lima');
        $hoy = date('Y-m-d');
        $first_day = date('Y-m');
        
        $query = $this->connect()->query("SELECT COUNT(Monto) as TotalDesem FROM Persona WHERE (Fecha_2 BETWEEN '$first_day-01 00:00:00' AND '$hoy 23:59:59') AND Paso='div6' AND Funcionario LIKE '$funcionario%'");
        return $query;
    }

    function total_desembolsados_agencia($funcionario, $tarea){
        date_default_timezone_set('America/Lima');
        $hoy = date('Y-m-d');
        $first_day = date('Y-m');
        
        $query = $this->connect()->query("SELECT COUNT(Monto) as TotalDesem FROM Agencias WHERE (Fecha_2 BETWEEN '$first_day-01 00:00:00' AND '$hoy 23:59:59') AND Paso='div6' AND Tarea='$tarea' AND Moneda='1' AND Funcionario LIKE '$funcionario%'");
        return $query;
    }
	
    function total_desembolsados_agencia_dol($funcionario, $tarea){
        date_default_timezone_set('America/Lima');
        $hoy = date('Y-m-d');
        $first_day = date('Y-m');
        
        $query = $this->connect()->query("SELECT COUNT(Monto) as TotalDesem FROM Agencias WHERE (Fecha_2 BETWEEN '$first_day-01 00:00:00' AND '$hoy 23:59:59') AND Paso='div6' AND Tarea='$tarea' AND Moneda='2' AND Funcionario LIKE '$funcionario%'");
        return $query;
    }

    function total_desembolsados_agencia_mpasado($funcionario, $tarea){
        date_default_timezone_set('America/Lima');
		$month_day_last = date('Y-m', strtotime('last month'));
        
        $query = $this->connect()->query("SELECT COUNT(Monto) as TotalDesem FROM Agencias WHERE (Fecha_2 BETWEEN '$month_day_last-01 00:00:00' AND '$month_day_last-31 23:59:59') AND Paso='div6' AND Tarea='$tarea' AND Moneda='1' AND Funcionario LIKE '$funcionario%'");
        return $query;
    }
	
    function total_desembolsados_agencia_mpasado_dol($funcionario, $tarea){
        date_default_timezone_set('America/Lima');
		$month_day_last = date('Y-m', strtotime('last month'));
        
        $query = $this->connect()->query("SELECT COUNT(Monto) as TotalDesem FROM Agencias WHERE (Fecha_2 BETWEEN '$month_day_last-01 00:00:00' AND '$month_day_last-31 23:59:59') AND Paso='div6' AND Tarea='$tarea' AND Moneda='2' AND Funcionario LIKE '$funcionario%'");
        return $query;
    }

	
    function total_desembolsados_persona_mpasado($funcionario){
        date_default_timezone_set('America/Lima');
        $month_day_last = date('Y-m', strtotime('last month'));
        
        $query = $this->connect()->query("SELECT COUNT(Monto) as TotalDesem FROM Persona WHERE (Fecha_2 BETWEEN '$month_day_last-01 00:00:00' AND '$month_day_last-31 23:59:59') AND Paso='div6' AND Funcionario LIKE '$funcionario%'");
        return $query;
    }
    
    function obtenerPreAprobados_hoy($funcionario){
        date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d');
        
        $query = $this->connect()->query("SELECT COUNT(DISTINCT Dni) as Total FROM Persona WHERE (Fecha BETWEEN '$actual_feha 00:00:00' AND '$actual_feha 23:59:59') AND Estado='PRE-APROBADO' AND Funcionario LIKE '$funcionario%'");
        return $query;
    }

    function obtenerTotalLeads_hoy($utm){
        date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d');
        
        $query = $this->connect()->query("SELECT COUNT(DISTINCT Dni) as Total FROM Persona WHERE (Fecha BETWEEN '$actual_feha 00:00:00' AND '$actual_feha 23:59:59') AND Nombre_Empresa LIKE '$utm%'");
        return $query;
    }
    
    function obtenerTotalLeads_hoy2($utm, $utm1){
        date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d');
        
        $query = $this->connect()->query("SELECT COUNT(DISTINCT Dni) as Total FROM Persona WHERE (Fecha BETWEEN '$actual_feha 00:00:00' AND '$actual_feha 23:59:59') AND (Nombre_Empresa LIKE '$utm%' or Nombre_Empresa LIKE '$utm1%' or Nombre_Empresa='')");
        return $query;
    }
	
    function listado_utm($fec_inicio, $fec_fin){
        
        $query = $this->connect()->query("SELECT DISTINCT Nombre_Empresa FROM Persona WHERE (Fecha BETWEEN '$fec_inicio 00:00:00' AND '$fec_fin 23:59:59') ORDER BY Nombre_Empresa");
        return $query;
    }
	
	function work_agencias_funcionario($agencia){
		date_default_timezone_set('America/Lima');
		$actual_feha = date('Y-m-d');
		$actual_mes = date('Y-m');
		$pasada_fecha = date('Y-m-d', strtotime('-20 day'));
		
		$query = $this->connect()->query("SELECT DISTINCT Funcionario FROM Agencias2 WHERE ((Fecha BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59') OR (Fecha_2 BETWEEN '$actual_mes-01 00:00:00' AND '$actual_mes-31 23:59:59')) AND Agencia='$agencia' ORDER BY Funcionario");
		return $query;
	}
	
	function work_agencias_funcionario_detalle_peso1($funcionario, $agencia){
		date_default_timezone_set('America/Lima');
		$actual_feha = date('Y-m-d');
		$actual_mes = date('Y-m');
		$pasada_fecha = date('Y-m-d', strtotime('-20 day'));
		
		$query = $this->connect()->query("SELECT COUNT(*) as Total FROM Agencias2 WHERE ((Fecha BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59') OR (Fecha_2 BETWEEN '$actual_mes-01 00:00:00' AND '$actual_mes-31 23:59:59')) AND Agencia='$agencia' AND Funcionario='$funcionario' AND Paso='div3'");
		return $query;
	
	}

	function work_agencias_funcionario_detalle_peso05($funcionario, $agencia){
		date_default_timezone_set('America/Lima');
		$actual_feha = date('Y-m-d');
		$actual_mes = date('Y-m');
		$pasada_fecha = date('Y-m-d', strtotime('-20 day'));
		
		$query = $this->connect()->query("SELECT COUNT(*) as Total FROM Agencias2 WHERE ((Fecha BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59') OR (Fecha_2 BETWEEN '$actual_mes-01 00:00:00' AND '$actual_mes-31 23:59:59')) AND Agencia='$agencia' AND Funcionario='$funcionario' AND (Paso='div1' OR Paso='div4' OR Paso='div5')");
		return $query;
	
	}
	
	function listado_origen($fec_inicio, $fec_fin){
        
        $query = $this->connect()->query("SELECT DISTINCT Origen FROM Agencias WHERE (Fecha BETWEEN '$fec_inicio 00:00:00' AND '$fec_fin 23:59:59') ORDER BY Origen");
        return $query;
    }
	
	function cuenta_origen($fec_inicio, $fec_fin, $origen){
        
        $query = $this->connect()->query("SELECT COUNT(DISTINCT Dni) as Total FROM Agencias WHERE (Fecha BETWEEN '$fec_inicio 00:00:00' AND '$fec_fin 23:59:59') AND Origen LIKE '$origen'");
        return $query;
    }
	
	function cuenta_origen_desemb($fec_inicio, $fec_fin, $origen){
        
        $query = $this->connect()->query("SELECT COUNT(DISTINCT Dni) as Total FROM Agencias WHERE (Fecha BETWEEN '$fec_inicio 00:00:00' AND '$fec_fin 23:59:59') AND Paso='div6' AND Origen LIKE '$origen'");
        return $query;
    }

	function cuenta_origen_tot($fec_inicio, $fec_fin){
        
        $query = $this->connect()->query("SELECT COUNT(DISTINCT Dni) as Total FROM Agencias WHERE (Fecha BETWEEN '$fec_inicio 00:00:00' AND '$fec_fin 23:59:59')");
        return $query;
    }

	function cuenta_origen_tot_desemb($fec_inicio, $fec_fin){
        
        $query = $this->connect()->query("SELECT COUNT(DISTINCT Dni) as Total FROM Agencias WHERE (Fecha BETWEEN '$fec_inicio 00:00:00' AND '$fec_fin 23:59:59') AND Paso='div6'");
        return $query;
    }	

	function conteo_utm_total($fec_inicio, $fec_fin, $utm){
        
        $query = $this->connect()->query("SELECT COUNT(DISTINCT Dni) as Total FROM Persona WHERE(Fecha BETWEEN '$fec_inicio 00:00:00' AND '$fec_fin 23:59:59') AND Nombre_Empresa LIKE '%$utm%'");
        return $query;
    }

	function conteo_utm_preaprobado($fec_inicio, $fec_fin, $utm){
        
        $query = $this->connect()->query("SELECT COUNT(DISTINCT Dni) as Total FROM Persona WHERE(Fecha BETWEEN '$fec_inicio 00:00:00' AND '$fec_fin 23:59:59') AND Nombre_Empresa LIKE '%$utm%' AND Estado='PRE-APROBADO'");
		return $query;
    }

	function abrir_carta($session){
        
        $query = $this->connect()->query("SELECT * FROM Doble WHERE Cod_session='$session' AND Abierto=0 ORDER BY Orden ASC");
		return $query;
    }

	function carta_abierta($session, $id){
        
        $query = $this->connect()->query("UPDATE Doble SET Abierto=1 WHERE Cod_session='$session' AND Id='$id'");
		return $query;
    }

	function empezar_otra_vez($session){
        
        $query = $this->connect()->query("UPDATE Doble SET Abierto=0 WHERE Cod_session='$session'");
		return $query;
    }
	
	function borrar_juego($session){
        
        $query = $this->connect()->query("DELETE FROM Doble WHERE Cod_session='$session'");
		return $query;
    }	
	
	function nuevo_juego($session){
        date_default_timezone_set('America/Lima');
        $fecha = date('"Y/m/d H:i:s"');
		
		for ($i = 1; $i <= 6; $i++) {
			$orden_tmp = rand(1, 1000);
			$query = $this->connect()->query("INSERT INTO Doble (Id, Cod_session, Numero, Fecha, Abierto, Orden) VALUES (NULL,'$session','$i',$fecha,'0','$orden_tmp')");
		}
		
		return $query;
	}
	
	function lista_elementos($tarjeta1, $tarjeta2){
		
        $query = $this->connect()->query("SELECT DISTINCT(Nombre) FROM Elementos WHERE Tarjeta='$tarjeta1' OR Tarjeta='$tarjeta2' ORDER BY Nombre ASC");
		return $query;
	}
	
	function busca_combinacion($valor1, $valor2){
		$query = $this->connect()->query("SELECT Resultado FROM Combinacion WHERE (Uno='$valor1' AND Dos='$valor2') OR (Uno='$valor2' AND Dos='$valor1')");
		return $query;
	}
    
    function getDataPreaprobados_utm_hoy2($utm, $utm1){
        date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d');
        
        $query = $this->connect()->query("SELECT COUNT(DISTINCT Dni) as Total FROM Persona WHERE (Fecha BETWEEN '$actual_feha 00:00:00' AND '$actual_feha 23:59:59') AND Estado='PRE-APROBADO' AND (Nombre_Empresa LIKE '$utm%' or Nombre_Empresa LIKE '$utm1%' or Nombre_Empresa='')");
        return $query;
    }

    function getDataPreaprobados_utm_hoy($utm){
        date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d');
        
        $query = $this->connect()->query("SELECT COUNT(DISTINCT Dni) as Total FROM Persona WHERE (Fecha BETWEEN '$actual_feha 00:00:00' AND '$actual_feha 23:59:59') AND Estado='PRE-APROBADO' AND Nombre_Empresa LIKE '$utm%'");
        return $query;
    }
    

    function obtenerPasos2($step, $funcionario){
        date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d');
        $actual_mes = date('Y-m');
        $pasada_fecha = date('Y-m-d', strtotime('-14 day'));
        // igual que obtenerPasos
        $query = $this->connect()->query("SELECT * FROM Persona WHERE ((Fecha BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59') OR (Fecha_2 BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59')) AND Estado='PRE-APROBADO' AND Paso='$step' AND Funcionario LIKE '$funcionario%'");
        return $query;
    }
	
    function obtenerPasos2_descartados($step, $funcionario){
        date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d');
        $actual_mes = date('Y-m');
        $pasada_fecha = date('Y-m-d', strtotime('-2 day'));
        // igual que obtenerPasos
        $query = $this->connect()->query("SELECT * FROM Persona WHERE ((Fecha BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59') OR (Fecha_2 BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59')) AND Estado='PRE-APROBADO' AND Paso='$step' AND Funcionario LIKE '$funcionario%'");
        return $query;
    }


    function obtenerPasos2_desemb($step, $funcionario){
        date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d');
        $actual_mes = date('Y-m');
        $pasada_fecha = date('Y-m-d', strtotime('-14 day'));
   
        $query = $this->connect()->query("SELECT * FROM Persona WHERE (Fecha_2 BETWEEN '$actual_mes-01 00:00:00' AND '$actual_mes-31 23:59:59') AND Estado='PRE-APROBADO' AND Paso='$step' AND Funcionario LIKE '$funcionario%'");
        return $query;
    }
    
    function obtenerPasos_kyodai($step, $funcionario){
        date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d');
        $actual_mes = date('Y-m');
        $pasada_fecha = date('Y-m-d', strtotime('-14 day'));
        // igual que obtenerPasos
        $query = $this->connect()->query("SELECT * FROM Inscripcion WHERE ((Fecha BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59') OR (Fecha_2 BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59')) AND Paso='$step' AND Funcionario LIKE '$funcionario%'");
        return $query;
    }
    function obtenerPasos_agencias($step, $funcionario){
        date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d');
        $actual_mes = date('Y-m');
        $pasada_fecha = date('Y-m-d', strtotime('-20 day'));

        $query = $this->connect()->query("SELECT * FROM Agencias WHERE ((Fecha BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59') OR (Fecha_2 BETWEEN '$actual_mes-01 00:00:00' AND '$actual_feha 23:59:59')) AND Paso='$step' AND Funcionario LIKE '$funcionario%'");
        return $query;
    }

    function obtenerPasos_agencias2($step, $agencia, $funcionario){
        date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d');
        $actual_mes = date('Y-m');
        $pasada_fecha = date('Y-m-d', strtotime('-20 day'));

        $query = $this->connect()->query("SELECT * FROM Agencias2 WHERE (Fecha BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59') AND Paso='$step' AND Agencia LIKE '$agencia%' AND Funcionario LIKE '$funcionario%'");
        return $query;
    }

	function traer_tasa_segmento($Scoring){
		
		$query = $this->connect()->query("SELECT * FROM Tasas WHERE (Min<=$Scoring) AND (Max>$Scoring) ORDER BY Id DESC");
		return $query;
	}
	
	function traer_rci($segmento, $sueldo){
		
		$query = $this->connect()->query("SELECT * FROM Rci WHERE Segmento='$segmento' AND (Min<=$sueldo) AND (Max>$sueldo)");
		return $query;
	}

    function obtenerPasos_agencias_desemb($step, $funcionario){
        date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d');
        $actual_mes = date('Y-m');

        $query = $this->connect()->query("SELECT * FROM Agencias WHERE ((Fecha_2 BETWEEN '$actual_mes-01 00:00:00' AND '$actual_mes-31 23:59:59')) AND Paso='$step' AND Funcionario LIKE '$funcionario%'");
        return $query;
    } 	
    
    function tarjetasPendientes_persona($funcionario){
        date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d');
        $actual_mes = date('Y-m');
        $pasada_fecha = date('Y-m-d', strtotime('-14 day'));
        // igual que obtenerPasos
        $query = $this->connect()->query("SELECT COUNT(Monto) as Total FROM Persona WHERE ((Fecha BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59') OR (Fecha_2 BETWEEN '$actual_mes-01 00:00:00' AND '$actual_feha 23:59:59')) AND Estado='PRE-APROBADO' AND Paso='div2' AND Funcionario LIKE '$funcionario%'");
        return $query;
    }

    function tarjetasPendientes_persona_agencias($funcionario){
        date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d');
        $actual_mes = date('Y-m');
        $pasada_fecha = date('Y-m-d', strtotime('-20 day'));
        // igual que obtenerPasos
        $query = $this->connect()->query("SELECT COUNT(Monto) as Total FROM Agencias WHERE ((Fecha BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59') OR (Fecha_2 BETWEEN '$actual_mes-01 00:00:00' AND '$actual_mes-31 23:59:59')) AND Paso='div3' AND Funcionario LIKE '$funcionario%'");
        return $query;
    }

    function tarjetasPendientes_persona_div1_agencias($funcionario){
        date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d');
        $actual_mes = date('Y-m');
        $pasada_fecha = date('Y-m-d', strtotime('-20 day'));
        // igual que obtenerPasos
        $query = $this->connect()->query("SELECT COUNT(Monto) as Total FROM Agencias WHERE ((Fecha BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59') OR (Fecha_2 BETWEEN '$actual_mes-01 00:00:00' AND '$actual_mes-31 23:59:59')) AND (Paso='div1' or Paso='div4' or Paso='div5') AND Funcionario LIKE '$funcionario%'");
        return $query;
    }		

    
    function tarjetasPendientes_persona_div1($funcionario){
        date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d');
        $actual_mes = date('Y-m');
        $pasada_fecha = date('Y-m-d', strtotime('-14 day'));
        // igual que obtenerPasos
        $query = $this->connect()->query("SELECT COUNT(Monto) as Total FROM Persona WHERE ((Fecha BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59') OR (Fecha_2 BETWEEN '$actual_mes-01 00:00:00' AND '$actual_feha 23:59:59')) AND Estado='PRE-APROBADO' AND Paso='div1' AND Funcionario LIKE '$funcionario%'");
        return $query;
    } 
    
    function obtenerModals($funcionario){
        date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d');
        $actual_mes = date('Y-m');
        $pasada_fecha = date('Y-m-d', strtotime('-14 day'));
        // igual que obtenerPasos
        $query = $this->connect()->query("SELECT * FROM Persona WHERE ((Fecha BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59') OR (Fecha_2 BETWEEN '$actual_mes-01 00:00:00' AND '$actual_mes-31 23:59:59')) AND Estado='PRE-APROBADO' AND (Paso='div1' OR Paso='div2' OR Paso='div3' OR Paso='div4' OR Paso='div5' OR Paso='div6') AND Funcionario LIKE '$funcionario%'");
        return $query;
    }

    function getModals_descartados($funcionario){
        date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d');
        $actual_mes = date('Y-m');
        $pasada_fecha = date('Y-m-d', strtotime('-2 day'));
        // igual que obtenerPasos
        $query = $this->connect()->query("SELECT * FROM Persona WHERE ((Fecha BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59') OR (Fecha_2 BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59')) AND Estado='PRE-APROBADO' AND (Paso='div7') AND Funcionario LIKE '$funcionario%'");
        return $query;
    }
    
    function obtenerModals_kyodai(){
        date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d');
        $actual_mes = date('Y-m');
        $pasada_fecha = date('Y-m-d', strtotime('-14 day'));
        // igual que obtenerPasos
        $query = $this->connect()->query("SELECT * FROM Inscripcion WHERE ((Fecha BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59') OR (Fecha_2 BETWEEN '$actual_mes-01 00:00:00' AND '$actual_mes-31 23:59:59'))");
        return $query;
    }

    function obtenerModals_agencias($funcionario){
        date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d');
        $actual_mes = date('Y-m');
        $pasada_fecha = date('Y-m-d', strtotime('-20 day'));
        // igual que obtenerPasos
        $query = $this->connect()->query("SELECT * FROM Agencias WHERE ((Fecha BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59') OR (Fecha_2 BETWEEN '$actual_mes-01 00:00:00' AND '$actual_mes-31 23:59:59')) AND Funcionario LIKE '$funcionario%'");
        return $query;
    }

    function obtenerModals_agencias2(){
        date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d');
        $actual_mes = date('Y-m');
        $pasada_fecha = date('Y-m-d', strtotime('-20 day'));
        // igual que obtenerPasos
        $query = $this->connect()->query("SELECT * FROM Agencias2 WHERE ((Fecha BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59') OR (Fecha_2 BETWEEN '$actual_mes-01 00:00:00' AND '$actual_mes-31 23:59:59'))");
        return $query;
    }	
	
    function obtenerTotalLeads($num){
        date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d', strtotime('-' . $num . ' day'));
        
        $query = $this->connect()->query("SELECT COUNT(DISTINCT Dni) as Total FROM Persona WHERE (Fecha BETWEEN '$actual_feha 00:00:00' AND '$actual_feha 23:59:59')");
        return $query;
    }
    
    function obtenerTotalLeads_t($num, $utm){
        date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d', strtotime('-' . $num . ' day'));
        
        $query = $this->connect()->query("SELECT COUNT(DISTINCT Dni) as Total FROM Persona WHERE (Fecha BETWEEN '$actual_feha 00:00:00' AND '$actual_feha 23:59:59') AND Nombre_Empresa LIKE '$utm%'");
        return $query;
    }
    
    function obtenerPreAprobados_t($num, $utm){
        date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d', strtotime('-' . $num . ' day'));
        
        $query = $this->connect()->query("SELECT COUNT(DISTINCT Dni) as Total FROM Persona WHERE (Fecha BETWEEN '$actual_feha 00:00:00' AND '$actual_feha 23:59:59') AND Estado='PRE-APROBADO' AND Nombre_Empresa LIKE '$utm%'");
        return $query;
    }
    
    function obtenerTotalLeads_t2($num, $utm, $utm1){
        date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d', strtotime('-' . $num . ' day'));
        
        $query = $this->connect()->query("SELECT COUNT(DISTINCT Dni) as Total FROM Persona WHERE (Fecha BETWEEN '$actual_feha 00:00:00' AND '$actual_feha 23:59:59') AND (Nombre_Empresa LIKE '$utm%' or Nombre_Empresa LIKE '$utm1%' or Nombre_Empresa='')");
        return $query;
    }
    
    function obtenerPreAprobados_t2($num, $utm, $utm1){
        date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d', strtotime('-' . $num . ' day'));
        
        $query = $this->connect()->query("SELECT COUNT(DISTINCT Dni) as Total FROM Persona WHERE (Fecha BETWEEN '$actual_feha 00:00:00' AND '$actual_feha 23:59:59') AND Estado='PRE-APROBADO' AND (Nombre_Empresa LIKE '$utm%' or Nombre_Empresa LIKE '$utm1%' or Nombre_Empresa='')");
        return $query;
    }
    
    function obtenerPreAprobadosXiomi($num){
        date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d', strtotime('-' . $num . ' day'));
        
        $query = $this->connect()->query("SELECT COUNT(DISTINCT Dni) as Total FROM Persona WHERE (Fecha BETWEEN '$actual_feha 00:00:00' AND '$actual_feha 23:59:59') AND Estado='PRE-APROBADO' AND Funcionario LIKE 'XIOMI%'");
        return $query;
    }
    
    function obtenerPreAprobadosKaori($num){
        date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d', strtotime('-' . $num . ' day'));
        
        $query = $this->connect()->query("SELECT COUNT(DISTINCT Dni) as Total FROM Persona WHERE (Fecha BETWEEN '$actual_feha 00:00:00' AND '$actual_feha 23:59:59') AND Estado='PRE-APROBADO' AND Funcionario LIKE 'KAORI%'");
        return $query;
    }
    
    function obtenerPreAprobadosJohann($num){
        date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d', strtotime('-' . $num . ' day'));
        
        $query = $this->connect()->query("SELECT COUNT(DISTINCT Dni) as Total FROM Persona WHERE (Fecha BETWEEN '$actual_feha 00:00:00' AND '$actual_feha 23:59:59') AND Estado='PRE-APROBADO' AND Funcionario LIKE 'JOHANN%'");
        return $query;
    }
    
    function obtenerPreAprobados2(){
        $pasada_feha = date('Y-m', strtotime('last month'));
        
        $query = $this->connect()->query("SELECT COUNT(DISTINCT Dni) as Total FROM Persona WHERE (Fecha BETWEEN '$pasada_feha-01 00:00:00' AND '$pasada_feha-31 23:59:59') AND Estado='PRE-APROBADO'");
        return $query;
    }
    
    function obtenerTotalLeads2(){
        $pasada_feha = date('Y-m', strtotime('last month'));
        
        $query = $this->connect()->query("SELECT COUNT(DISTINCT Dni) as Total FROM Persona WHERE (Fecha BETWEEN '$pasada_feha-01 00:00:00' AND '$pasada_feha-31 23:59:59')");
        return $query;
    }
    
    function obtenerToken()
    {
        $query = $this->connect()->query('SELECT * FROM tbl_tokens');
        return $query;
    }
	
    function obtenerFuncionarios()
    {
        $query = $this->connect()->query('SELECT * FROM Funcionarios');
        return $query;
    }
	
	function funnel_agencias_importe($paso){
		date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d');
        $actual_mes = date('Y-m');
        $pasada_fecha = date('Y-m-d', strtotime('-20 day'));
        
        $query = $this->connect()->query("SELECT SUM(Monto) as Total FROM Agencias WHERE ((Fecha BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59') OR (Fecha BETWEEN '$actual_mes-01 00:00:00' AND '$actual_mes-31 23:59:59')) AND Paso='$paso' AND (Tarea='prestamo' OR Tarea='')");		
		return $query;
		
	}
	
	function funnel_agencias_lista($paso){
		date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d');
        $actual_mes = date('Y-m');
        $pasada_fecha = date('Y-m-d', strtotime('-20 day'));
        
        $query = $this->connect()->query("SELECT * FROM Agencias WHERE ((Fecha BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59') OR (Fecha BETWEEN '$actual_mes-01 00:00:00' AND '$actual_mes-31 23:59:59')) AND Paso='$paso' AND (Tarea='prestamo' OR Tarea='')");		
		return $query;
		
	}

	function funnel_agencias_cantidad($paso){
		date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d');
        $actual_mes = date('Y-m');
        $pasada_fecha = date('Y-m-d', strtotime('-20 day'));
        
        $query = $this->connect()->query("SELECT COUNT(Monto) as Total FROM Agencias WHERE ((Fecha BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59') OR (Fecha_2 BETWEEN '$actual_mes-01 00:00:00' AND '$actual_mes-31 23:59:59')) AND Paso='$paso' AND (Tarea='prestamo' OR Tarea='')");		
		return $query;
	}
	
	function funnel_agencias_infocore_importe($paso){
		date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d');
        $actual_mes = date('Y-m');
        $pasada_fecha = date('Y-m-d', strtotime('-20 day'));
        
        $query = $this->connect()->query("SELECT SUM(Monto) as Total FROM Agencias WHERE ((Fecha BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59') OR (Fecha BETWEEN '$actual_mes-01 00:00:00' AND '$actual_feha 23:59:59')) AND Paso='$paso' AND (Tarea='prestamo' OR Tarea='') AND (Origen='lsolari@infocore.com.pe' OR Origen='elizabethpatino@gmail.com' OR Origen='infocore@cp')");		
		return $query;
		
	}
	
	function funnel_experian_importe($paso){
		date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d');
        $actual_mes = date('Y-m');
        $pasada_fecha = date('Y-m-d', strtotime('-14 day'));
        
        $query = $this->connect()->query("SELECT SUM(Monto) as Total FROM Persona WHERE ((Fecha BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59') OR (Fecha BETWEEN '$actual_mes-01 00:00:00' AND '$actual_mes-31 23:59:59')) AND Paso='$paso' AND (Nombre_empresa='exp' or Nombre_empresa='Buscacredito')");		
		return $query;
		
	}
	
	function funnel_infocore_importe($paso){
		date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d');
        $actual_mes = date('Y-m');
        $pasada_fecha = date('Y-m-d', strtotime('-14 day'));
        
        $query = $this->connect()->query("SELECT SUM(Monto) as Total FROM Agencias WHERE ((Fecha BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59') OR (Fecha BETWEEN '$actual_mes-01 00:00:00' AND '$actual_mes-31 23:59:59')) AND Paso='$paso' AND (Nombre_empresa='exp' or Nombre_empresa='Buscacredito')");		
		return $query;
		
	}

	function funnel_experian_cantidad($paso){
		date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d');
        $actual_mes = date('Y-m');
        $pasada_fecha = date('Y-m-d', strtotime('-14 day'));
        
        $query = $this->connect()->query("SELECT COUNT(Monto) as Total FROM Persona WHERE ((Fecha BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59') OR (Fecha_2 BETWEEN '$actual_mes-01 00:00:00' AND '$actual_mes-31 23:59:59')) AND Paso='$paso' AND (Nombre_empresa='exp' or Nombre_empresa='Buscacredito') AND Estado='PRE-APROBADO'");		
		return $query;
	}
	

	function funnel_infocore_cantidad($paso){
		date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d');
        $actual_mes = date('Y-m');
        $pasada_fecha = date('Y-m-d', strtotime('-14 day'));
        
        $query = $this->connect()->query("SELECT COUNT(Monto) as Total FROM Agencias WHERE ((Fecha BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59') OR (Fecha_2 BETWEEN '$actual_mes-01 00:00:00' AND '$actual_mes-31 23:59:59')) AND Paso='$paso' AND (Nombre_empresa='exp' or Nombre_empresa='Buscacredito') AND Estado='PRE-APROBADO'");		
		return $query;
	}

	function funnel_agencias_infocore_cantidad($paso){
		date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d');
        $actual_mes = date('Y-m');
        $pasada_fecha = date('Y-m-d', strtotime('-20 day'));
        
        $query = $this->connect()->query("SELECT COUNT(Monto) as Total FROM Agencias WHERE ((Fecha BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59') OR (Fecha_2 BETWEEN '$actual_mes-01 00:00:00' AND '$actual_feha 23:59:59')) AND Paso='$paso' AND (Tarea='prestamo' OR Tarea='') AND (Origen='lsolari@infocore.com.pe' OR Origen='elizabethpatino@gmail.com' OR Origen='infocore@cp')");		
		return $query;
	}

	function funnel_agencias_infocore_lista($paso){
		date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d');
        $actual_mes = date('Y-m');
        $pasada_fecha = date('Y-m-d', strtotime('-20 day'));
        
        $query = $this->connect()->query("SELECT * FROM Agencias WHERE ((Fecha BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59') OR (Fecha_2 BETWEEN '$actual_mes-01 00:00:00' AND '$actual_mes-31 23:59:59')) AND Paso='$paso' AND (Tarea='prestamo' OR Tarea='') AND (Origen='lsolari@infocore.com.pe' OR Origen='elizabethpatino@gmail.com' OR Origen='infocore@cp')");		
		return $query;
	}
	
	function funnel_experian_lista($paso){
		date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d');
        $actual_mes = date('Y-m');
        $pasada_fecha = date('Y-m-d', strtotime('-14 day'));
        
        $query = $this->connect()->query("SELECT * FROM Persona WHERE ((Fecha BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59') OR (Fecha_2 BETWEEN '$actual_mes-01 00:00:00' AND '$actual_mes-31 23:59:59')) AND Paso='$paso' AND (Nombre_empresa='exp' or Nombre_empresa='Buscacredito')");		
		return $query;
	}
	
	function funnel_infocore_lista($paso){
		date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d');
        $actual_mes = date('Y-m');
        $pasada_fecha = date('Y-m-d', strtotime('-14 day'));
        
        $query = $this->connect()->query("SELECT * FROM Agencias WHERE ((Fecha BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59') OR (Fecha_2 BETWEEN '$actual_mes-01 00:00:00' AND '$actual_mes-31 23:59:59')) AND Paso='$paso' AND (Nombre_empresa='exp' or Nombre_empresa='Buscacredito')");		
		return $query;
	}	
	
	function listado_tarjetas_no_actualizadas($dias){
		date_default_timezone_set('America/Lima');

		$rango = "-" . $dias . " day";
        $pasada_fecha = date('Y-m-d', strtotime($rango));
        
        $query = $this->connect()->query("SELECT * FROM Agencias WHERE (Fecha_2<'$pasada_fecha 00:00:00' AND Fecha<'$pasada_fecha 00:00:00') AND (Paso='div1' OR Paso='div2' OR Paso='div3' OR Paso='div4' OR Paso='div5')");		
		return $query;
	}

	function desembolsado_infocore_cantidad($mes){

		$query = $this->connect()->query("SELECT COUNT(Monto) as Total FROM Agencias WHERE (Fecha_2 BETWEEN '$mes-01 00:00:00' AND '$mes-31 23:59:59') AND Paso='div6' AND (Origen='lsolari@infocore.com.pe' OR Origen='elizabethpatino@gmail.com' OR Origen='infocore@cp')");
		return $query;
	}

    function nuevaAgencia($persona){
        date_default_timezone_set('America/Lima');
        $fecha = date('"Y/m/d H:i:s"');
        $id="div1";
        
        $query = $this->connect()->prepare('INSERT INTO Agencias (Id, Nombres, Dni, Monto, Cuotas, Moneda, Fec_desembolso, Fecha, Fecha_2, Observaciones, Paso, Origen, Funcionario, Ruta, Tarea, Urgente) VALUES (NULL, :nombres, :dni, :monto, :cuotas, :moneda, :fec_desembolso,' . $fecha . ',' . $fecha . ', :observaciones, "' . $id . '", :origen, :funcionario, :ruta, :tipo, :urgente)');
        $query->execute(['dni' => $persona['dni'], 'nombres' => $persona['nombres'], 'monto' => str_replace(",",".",$persona['monto']), 'cuotas' => $persona['cuotas'], 'moneda' => $persona['moneda'], 'fec_desembolso' => $persona['fec_desembolso'], 'observaciones' => $persona['observaciones'], 'origen' =>$persona['origen'], 'funcionario' => $persona['funcionario'], 'ruta' => $persona['ruta'], 'tipo' => $persona['tipo'], 'urgente' => $persona['urgente']]);
        return $query;
    }

	function dniRepetidoAgencias($dni){
		date_default_timezone_set('America/Lima');
		$actual_feha = date('Y-m-d');
        $actual_mes = date('Y-m');
        $pasada_fecha = date('Y-m-d', strtotime('-20 day'));
	
		$query = $this->connect()->query("SELECT COUNT(Dni) as Total FROM Agencias WHERE ((Fecha BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59') OR (Fecha_2 BETWEEN '$actual_mes-01 00:00:00' AND '$actual_mes-31 23:59:59')) AND Dni='$dni'");
		return $query;
	}
	
	function desembolsado_infocore_importe($mes){

		$query = $this->connect()->query("SELECT SUM(Monto) as Total FROM Agencias WHERE (Fecha_2 BETWEEN '$mes-01 00:00:00' AND '$mes-31 23:59:59') AND Paso='div6' AND (Origen='lsolari@infocore.com.pe' OR Origen='elizabethpatino@gmail.com' OR Origen='infocore@cp')");
		return $query;
	}
	
	function desembolsado_infocore_listado($mes){
		date_default_timezone_set('America/Lima');
		if($mes=="actual")
			$mes = date('Y-m');
		if($mes=="pasado")
			$mes = date('Y-m', strtotime('last month'));
			
		$query = $this->connect()->query("SELECT * FROM Agencias WHERE (Fecha_2 BETWEEN '$mes-01 00:00:00' AND '$mes-31 23:59:59') AND Paso='div6' AND (Origen='lsolari@infocore.com.pe' OR Origen='elizabethpatino@gmail.com' OR Origen='infocore@cp')");
		return $query;
	}

	function funnel_digital_importe($paso, $funcionario){
		date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d');
        $actual_mes = date('Y-m');
        $pasada_fecha = date('Y-m-d', strtotime('-14 day'));
        
        $query = $this->connect()->query("SELECT SUM(Monto) as Total FROM Persona WHERE ((Fecha BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59') OR (Fecha_2 BETWEEN '$actual_mes-01 00:00:00' AND '$actual_mes-31 23:59:59')) AND Paso='$paso' AND Funcionario LIKE '%$funcionario%'");		
		return $query;
	}
	
	function funnel_digital_cantidad($paso, $funcionario){
		date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d');
        $actual_mes = date('Y-m');
        $pasada_fecha = date('Y-m-d', strtotime('-14 day'));
        
        $query = $this->connect()->query("SELECT COUNT(Monto) as Total FROM Persona WHERE ((Fecha BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59') OR (Fecha_2 BETWEEN '$actual_mes-01 00:00:00' AND '$actual_mes-31 23:59:59')) AND Paso='$paso' AND Funcionario LIKE '%$funcionario%'");		
		return $query;
	}
	
    function activo_funcionario($funcionario)
    {
        $query = $this->connect()->query("SELECT Activo as Activo FROM Funcionarios WHERE Nombre LIKE '%$funcionario%'");
		return $query;
    }

	function activo_funcionario_digital($funcionario)
    {
        $query = $this->connect()->query("SELECT Activo as Activo FROM Digital WHERE Nombre LIKE '%$funcionario%'");
		return $query;
    }
    
	function obtenerRechazos()
    {
        $query = $this->connect()->query('SELECT * FROM Rechazo');
        return $query;
    }    
	
    function nuevaRegistroVisita($id_pagina, $desc_visita){

		date_default_timezone_set('America/Lima');
        $fecha = date('"Y/m/d H:i:s"');

		$linea = "INSERT INTO visita (id, id_pagina, fecha, descripcion) VALUES (NULL, '$id_pagina',$fecha,'$desc_visita')";
		$query = $this->connect()->prepare($linea);
		$query->execute([]);
		
    }
	
	function nuevoDocumento($dni, $desc_documento){

		$linea = "INSERT INTO Documento (Id, Desc_Documento, Dni) VALUES (NULL, '$desc_documento','$dni')";
		$query = $this->connect()->prepare($linea);
		$query->execute([]);
		
    }
    
    function insertaTsuru($doi, $puntos, $nombres, $fecha){
        
        $linea = "INSERT INTO Tsuru (doi, puntos, nombres, fecha) VALUES ('$doi', '$puntos','$nombres','$fecha')";
		$query = $this->connect()->prepare($linea);
		$query->execute([]);
    }
    
    function backupTsuru(){
        
        $texto = "";
        $arch = date('YmdgGis') . ".csv";
        $fh = fopen("archivos/backup" . $arch, 'w') or die("Se produjo un error al crear el archivo");
        $query = $this->connect()->query("SELECT * FROM Tsuru");
            while ($row = $query->fetch(PDO::FETCH_ASSOC)){
                $texto = $texto . $row['doi'] . ";" . $row['puntos'] . ";" . $row['nombres'] . ";" . $row['fecha'] . "\n";
                
            }
          fwrite($fh, $texto) or die("No se pudo escribir en el archivo");
  
        fclose($fh);
        return $arch;
    }
    
    function eliminarTsuru(){
        
        $linea = "DELETE FROM Tsuru";
		$query = $this->connect()->prepare($linea);
		$query->execute([]);
    }
	
	function eliminaRegistro($tabla, $id){
        
        $linea = "DELETE FROM $tabla WHERE Id='$id'";
		$query = $this->connect()->prepare($linea);
		$query->execute([]);
    }
	
	function no_es_urgente($tabla, $id){
        
        $linea = "UPDATE $tabla SET Urgente='0' WHERE Id='$id'";
		$query = $this->connect()->prepare($linea);
		$query->execute([]);
    }
    
    
    function nuevoToken($tx_token, $tx_correo_celular)
    {

        $linea = "SELECT count(id) as total FROM tbl_tokens WHERE tx_correo_celular = '$tx_correo_celular'";
        $query = $this->connect()->prepare($linea);
		$query->execute();
		
		$fila = $query->fetch(PDO::FETCH_ASSOC);
		
		if( $fila['total']==0 ) 
		{
		    $linea = "INSERT INTO tbl_tokens (id, tx_token, tx_correo_celular) VALUES (NULL, '$tx_token','$tx_correo_celular')";
		    $query = $this->connect()->prepare($linea);
			$query->execute([]);	
		}
		else
		{
		    $linea = "UPDATE tbl_tokens SET tx_token ='$tx_token' WHERE tx_correo_celular='$tx_correo_celular'";
		    $query = $this->connect()->prepare($linea);
			$query->execute([]);
		}
  
    }

}

?>	