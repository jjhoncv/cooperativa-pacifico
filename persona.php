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
	
	function obtenerAgencias2($keyword, $agencia){
		if($keyword==""){
            $query = $this->connect()->query("SELECT * FROM Agencias2 WHERE Agencia='$agencia' ORDER BY Fecha DESC LIMIT 500");
            
        }else{
            $query = $this->connect()->query("SELECT * FROM Agencias2 WHERE Agencia='$agencia'  AND (Nombres like '%$keyword%') OR (Dni like '%$keyword%') OR (Observaciones like '%$keyword%') OR (Funcionario like '%$keyword%') OR (Tarea like '%$keyword%') OR (Canal like '%$keyword%') ORDER BY Fecha DESC LIMIT 500");
            
        }
        
        return $query;
	}
	
    function obtenerPersonas_plazofijo($keyword){
        if($keyword==""){
            $query = $this->connect()->query('SELECT * FROM Plazo_Fijo ORDER BY Fecha DESC LIMIT 500');
            
        }else{
            $query = $this->connect()->query("SELECT * FROM Plazo_Fijo where (Nombres like '%$keyword%') OR (Dni like '%$keyword%') OR (Calificacion like '%$keyword%') OR (Utm like '%$keyword%') ORDER BY Fecha DESC LIMIT 500");
            
        }
        
        return $query;
    }
	
	function obtenerPersonas_infogas($keyword){
        if($keyword==""){
            $query = $this->connect()->query('SELECT * FROM Infogas ORDER BY Fecha DESC LIMIT 500');
            
        }else{
            $query = $this->connect()->query("SELECT * FROM Infogas where (Nombres like '%$keyword%') OR (Dni like '%$keyword%') OR (Situacion like '%$keyword%') OR (Utm like '%$keyword%') OR (Estado like '%$keyword%') OR (Funcionario like '%$keyword%') ORDER BY Fecha DESC LIMIT 500");
            
        }
        
        return $query;
    }
	
	function obtenerPersonas_agencias($keyword){
        if($keyword==""){
            $query = $this->connect()->query('SELECT * FROM Agencias ORDER BY Fecha DESC LIMIT 500');
            
        }else{
            $query = $this->connect()->query("SELECT * FROM Agencias where (Nombres like '%$keyword%') OR (Dni like '%$keyword%') OR (Agencia like '%$keyword%') OR (Origen like '%$keyword%') OR (Funcionario like '%$keyword%') ORDER BY Fecha DESC LIMIT 500");
            
        }
        
        return $query;
    }
	
	function obtenerPersonas_pdp($keyword){
        if($keyword==""){
            $query = $this->connect()->query('SELECT * FROM Pdp ORDER BY Fecha DESC LIMIT 500');
            
        }else{
            $query = $this->connect()->query("SELECT * FROM Pdp where (Nombres like '%$keyword%') OR (Dni like '%$keyword%') OR (Situacion like '%$keyword%') OR (Estado like '%$keyword%') OR (Funcionario like '%$keyword%') ORDER BY Fecha DESC LIMIT 500");
            
        }
        
        return $query;
    }
	
	function obtenerPersonas_om($keyword){
        if($keyword==""){
            $query = $this->connect()->query('SELECT * FROM Om ORDER BY Fecha DESC LIMIT 500');
            
        }else{
            $query = $this->connect()->query("SELECT * FROM Om where (Nombres like '%$keyword%') OR (Dni like '%$keyword%') OR (Situacion like '%$keyword%') OR (Estado like '%$keyword%') OR (Funcionario like '%$keyword%') ORDER BY Fecha DESC LIMIT 500");
            
        }
        
        return $query;
    }
	
	function obtenerPersonas_credimaq($keyword){
        if($keyword==""){
            $query = $this->connect()->query('SELECT * FROM Credimaq ORDER BY Fecha DESC LIMIT 500');
            
        }else{
            $query = $this->connect()->query("SELECT * FROM Credimaq where (Nombres like '%$keyword%') OR (Dni like '%$keyword%') OR (Situacion like '%$keyword%') OR (Estado like '%$keyword%') OR (Funcionario like '%$keyword%') ORDER BY Fecha DESC LIMIT 500");
            
        }
        
        return $query;
    }	

	function obtenerPersonas_abi($keyword){
        if($keyword==""){
            $query = $this->connect()->query('SELECT * FROM Abi ORDER BY Fecha DESC LIMIT 500');
            
        }else{
            $query = $this->connect()->query("SELECT * FROM Abi where (Nombres like '%$keyword%') OR (Dni like '%$keyword%') OR (Situacion like '%$keyword%') OR (Estado like '%$keyword%') OR (Funcionario like '%$keyword%') ORDER BY Fecha DESC LIMIT 500");
            
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
	
    function update_funcionario($samantha, $daniel, $dayssy, $gabriela, $cinthia, $christian){
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
		
		if($christian=="false")
			$query = $this->connect()->query("UPDATE Funcionarios SET Activo='n' WHERE Nombre='Christian'");
		else
			$query = $this->connect()->query("UPDATE Funcionarios SET Activo='s' WHERE Nombre='Christian'");
		
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
	
    function update_funcionario_digital_plazofijo($karina, $karen, $katy){
		
		if($karina=="false")
			$query = $this->connect()->query("UPDATE Digital SET Activo='n' WHERE Nombre='Karina'");
		else
			$query = $this->connect()->query("UPDATE Digital SET Activo='s' WHERE Nombre='Karina'");
		
		if($karen=="false")
			$query = $this->connect()->query("UPDATE Digital SET Activo='n' WHERE Nombre='Karen'");
		else
			$query = $this->connect()->query("UPDATE Digital SET Activo='s' WHERE Nombre='Karen'");
		
		if($katy=="false")
			$query = $this->connect()->query("UPDATE Digital SET Activo='n' WHERE Nombre='Katy'");
		else
			$query = $this->connect()->query("UPDATE Digital SET Activo='s' WHERE Nombre='Katy'");
		
		
        return $query;
    }
	
    function update_funcionario_micro($xiomi, $kaori, $johann){
		
		if($xiomi=="false")
			$query = $this->connect()->query("UPDATE Micro SET Activo='n' WHERE Nombre='Xiomi'");
		else
			$query = $this->connect()->query("UPDATE Micro SET Activo='s' WHERE Nombre='Xiomi'");
		
		if($kaori=="false")
			$query = $this->connect()->query("UPDATE Micro SET Activo='n' WHERE Nombre='Kaori'");
		else
			$query = $this->connect()->query("UPDATE Micro SET Activo='s' WHERE Nombre='Kaori'");
		
		if($johann=="false")
			$query = $this->connect()->query("UPDATE Micro SET Activo='n' WHERE Nombre='Johann'");
		else
			$query = $this->connect()->query("UPDATE Micro SET Activo='s' WHERE Nombre='Johann'");
		
		
        return $query;
    }

    function update_funcionario_pdp($marco, $alina, $carlos){
		
		if($marco=="false")
			$query = $this->connect()->query("UPDATE Pdp_func SET Activo='n' WHERE Nombre='Marco'");
		else
			$query = $this->connect()->query("UPDATE Pdp_func SET Activo='s' WHERE Nombre='Marco'");
		
		if($alina=="false")
			$query = $this->connect()->query("UPDATE Pdp_func SET Activo='n' WHERE Nombre='Alina'");
		else
			$query = $this->connect()->query("UPDATE Pdp_func SET Activo='s' WHERE Nombre='Alina'");
		
		if($carlos=="false")
			$query = $this->connect()->query("UPDATE Pdp_func SET Activo='n' WHERE Nombre='Carlos'");
		else
			$query = $this->connect()->query("UPDATE Pdp_func SET Activo='s' WHERE Nombre='Carlos'");
		
		
        return $query;
    }

	function update_funcionario_om($agente1, $agente2, $agente3){
		
		if($agente1=="false")
			$query = $this->connect()->query("UPDATE Om_func SET Activo='n' WHERE Nombre='Agente1'");
		else
			$query = $this->connect()->query("UPDATE Om_func SET Activo='s' WHERE Nombre='Agente1'");
		
		if($agente2=="false")
			$query = $this->connect()->query("UPDATE Om_func SET Activo='n' WHERE Nombre='Agente2'");
		else
			$query = $this->connect()->query("UPDATE Om_func SET Activo='s' WHERE Nombre='Agente2'");
		
		if($agente3=="false")
			$query = $this->connect()->query("UPDATE Om_func SET Activo='n' WHERE Nombre='Agente3'");
		else
			$query = $this->connect()->query("UPDATE Om_func SET Activo='s' WHERE Nombre='Agente3'");
		
	    return $query;
    }
	
	function update_funcionario_credimaq($agente1, $agente2, $agente3){
		
		if($agente1=="false")
			$query = $this->connect()->query("UPDATE Credimaq_func SET Activo='n' WHERE Nombre='Agente1'");
		else
			$query = $this->connect()->query("UPDATE Credimaq_func SET Activo='s' WHERE Nombre='Agente1'");
		
		if($agente2=="false")
			$query = $this->connect()->query("UPDATE Credimaq_func SET Activo='n' WHERE Nombre='Agente2'");
		else
			$query = $this->connect()->query("UPDATE Credimaq_func SET Activo='s' WHERE Nombre='Agente2'");
		
		if($agente3=="false")
			$query = $this->connect()->query("UPDATE Credimaq_func SET Activo='n' WHERE Nombre='Agente3'");
		else
			$query = $this->connect()->query("UPDATE Credimaq_func SET Activo='s' WHERE Nombre='Agente3'");
		
	    return $query;
    }	

	function update_funcionario_abi($agente1, $agente2, $agente3){
		
		if($agente1=="false")
			$query = $this->connect()->query("UPDATE Abi_func SET Activo='n' WHERE Nombre='Agente1'");
		else
			$query = $this->connect()->query("UPDATE Abi_func SET Activo='s' WHERE Nombre='Agente1'");
		
		if($agente2=="false")
			$query = $this->connect()->query("UPDATE Abi_func SET Activo='n' WHERE Nombre='Agente2'");
		else
			$query = $this->connect()->query("UPDATE Abi_func SET Activo='s' WHERE Nombre='Agente2'");
		
		if($agente3=="false")
			$query = $this->connect()->query("UPDATE Abi_func SET Activo='n' WHERE Nombre='Agente3'");
		else
			$query = $this->connect()->query("UPDATE Abi_func SET Activo='s' WHERE Nombre='Agente3'");
		
	    return $query;
    }	
	
    function update_Paso($id, $paso){
        date_default_timezone_set('America/Lima');
        $actual_fecha = date('Y-m-d H:i:s');
        $query = $this->connect()->query("UPDATE Persona SET Paso='$paso', Fecha_2='$actual_fecha' WHERE Id='$id'");
        return $query;
    }
    function update_Paso_infogas($id, $paso){
        date_default_timezone_set('America/Lima');
        $actual_fecha = date('Y-m-d H:i:s');
        $query = $this->connect()->query("UPDATE Infogas SET Paso='$paso', Fecha_2='$actual_fecha' WHERE Id='$id'");
        return $query;
    }
	
    function update_Paso_plazofijo($id, $paso){
        date_default_timezone_set('America/Lima');
        $actual_fecha = date('Y-m-d H:i:s');
        $query = $this->connect()->query("UPDATE Plazo_Fijo SET Paso='$paso', Fecha_2='$actual_fecha' WHERE Id='$id'");
        return $query;
    }
	
    function update_Paso_camara($id, $paso){
        date_default_timezone_set('America/Lima');
        $actual_fecha = date('Y-m-d H:i:s');
        $query = $this->connect()->query("UPDATE Comercio SET Paso='$paso', Fecha_2='$actual_fecha' WHERE Id='$id'");
        return $query;
    }	
	
    function update_Paso_pdp($id, $paso){
        date_default_timezone_set('America/Lima');
        $actual_fecha = date('Y-m-d H:i:s');
        $query = $this->connect()->query("UPDATE Pdp SET Paso='$paso', Fecha_2='$actual_fecha' WHERE Id='$id'");
        return $query;
    }
	
    function update_Paso_om($id, $paso){
        date_default_timezone_set('America/Lima');
        $actual_fecha = date('Y-m-d H:i:s');
        $query = $this->connect()->query("UPDATE Om SET Paso='$paso', Fecha_2='$actual_fecha' WHERE Id='$id'");
        return $query;
    }
	
    function update_Paso_credimaq($id, $paso){
        date_default_timezone_set('America/Lima');
        $actual_fecha = date('Y-m-d H:i:s');
        $query = $this->connect()->query("UPDATE Credimaq SET Paso='$paso', Fecha_2='$actual_fecha' WHERE Id='$id'");
        return $query;
    }	

    function update_Paso_abi($id, $paso){
        date_default_timezone_set('America/Lima');
        $actual_fecha = date('Y-m-d H:i:s');
        $query = $this->connect()->query("UPDATE Abi SET Paso='$paso', Fecha_2='$actual_fecha' WHERE Id='$id'");
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
    function update_Obs_infogas($id, $obs, $monto, $paso, $funcionario, $fec_ingreso, $placa_estado){
        date_default_timezone_set('America/Lima');
        $actual_fecha = date('Y-m-d H:i:s');
        
		if($fec_ingreso==""){
			$query = $this->connect()->query("UPDATE Infogas SET Observaciones='$obs', Monto='$monto', Fecha_2='$actual_fecha', Paso='$paso', Funcionario='$funcionario', Placa_estado='$placa_estado' WHERE Id='$id'");

		}else{
			$query = $this->connect()->query("UPDATE Infogas SET Fecha='$fec_ingreso 08:45:00', Observaciones='$obs', Monto='$monto', Fecha_2='$fec_ingreso 08:45:00', Paso='$paso', Funcionario='$funcionario', Placa_estado='$placa_estado' WHERE Id='$id'");
		}
		
        return $query;
    }
	
    function update_Obs_plazofijo($id, $obs, $monto, $paso, $fec_ingreso, $monto2, $funcionario){
        date_default_timezone_set('America/Lima');
        $actual_fecha = date('Y-m-d H:i:s');
        
		if($fec_ingreso==""){
			$query = $this->connect()->query("UPDATE Plazo_Fijo SET Observaciones='$obs', Monto='$monto', Monto_2='$monto2', Fecha_2='$actual_fecha', Paso='$paso', Funcionario='$funcionario' WHERE Id='$id'");

		}else{
			$query = $this->connect()->query("UPDATE Plazo_Fijo SET Fecha='$fec_ingreso 08:45:00', Observaciones='$obs', Monto='$monto', Monto_2='$monto2', Fecha_2='$fec_ingreso 08:45:00', Paso='$paso', Funcionario='$funcionario' WHERE Id='$id'");
		}
		
        return $query;
    }

    function update_Obs_camara($id, $obs, $paso, $fec_ingreso, $funcionario, $rechazado){
        date_default_timezone_set('America/Lima');
        $actual_fecha = date('Y-m-d H:i:s');
        
		if($fec_ingreso==""){
			$query = $this->connect()->query("UPDATE Comercio SET Observaciones='$obs', Fecha_2='$actual_fecha', Paso='$paso', Funcionario='$funcionario', Descartado='$rechazado' WHERE Id='$id'");

		}else{
			$query = $this->connect()->query("UPDATE Comercio SET Fecha='$fec_ingreso 08:45:00', Observaciones='$obs', Fecha_2='$fec_ingreso 08:45:00', Paso='div1', Funcionario='$funcionario', Descartado='$rechazado' WHERE Id='$id'");
		}
		
        return $query;
    }	
	
    function update_Obs_cobranza($id, $obs){
        date_default_timezone_set('America/Lima');
        $actual_fecha = date('Y-m-d H:i:s');
        
		$query = $this->connect()->query("UPDATE Prestamos SET Observaciones='$obs', Fecha_2='$actual_fecha' WHERE Solicitud='$id'");

		return $query;
    }	
	
    function update_Obs_pdp($id, $obs, $monto, $paso, $funcionario, $fec_ingreso, $tipo, $convenio){
        date_default_timezone_set('America/Lima');
        $actual_fecha = date('Y-m-d H:i:s');
        
		if($fec_ingreso==""){
			$query = $this->connect()->query("UPDATE Pdp SET Observaciones='$obs', Monto='$monto', Fecha_2='$actual_fecha', Paso='$paso', Funcionario='$funcionario', Tipo='$tipo', Convenio='$convenio' WHERE Id='$id'");

		}else{
			$query = $this->connect()->query("UPDATE Pdp SET Fecha='$fec_ingreso 08:45:00', Observaciones='$obs', Monto='$monto', Fecha_2='$fec_ingreso 08:45:00', Paso='$paso', Funcionario='$funcionario', Tipo='$tipo', Convenio='$convenio WHERE Id='$id'");
		}
		
        return $query;
    }
	
    function update_Obs_om($id, $obs, $monto, $paso, $funcionario, $fec_ingreso, $tipo, $convenio){
        date_default_timezone_set('America/Lima');
        $actual_fecha = date('Y-m-d H:i:s');
        
		if($fec_ingreso==""){
			$query = $this->connect()->query("UPDATE Om SET Observaciones='$obs', Monto='$monto', Fecha_2='$actual_fecha', Paso='$paso', Funcionario='$funcionario', Tipo='$tipo', Convenio='$convenio' WHERE Id='$id'");

		}else{
			$query = $this->connect()->query("UPDATE Om SET Fecha='$fec_ingreso 08:45:00', Observaciones='$obs', Monto='$monto', Fecha_2='$fec_ingreso 08:45:00', Paso='$paso', Funcionario='$funcionario', Tipo='$tipo', Convenio='$convenio' WHERE Id='$id'");
		}
		
        return $query;
    }
	
    function update_Obs_credimaq($id, $obs, $monto, $paso, $funcionario, $fec_ingreso, $tipo, $convenio){
        date_default_timezone_set('America/Lima');
        $actual_fecha = date('Y-m-d H:i:s');
        
		if($fec_ingreso==""){
			$query = $this->connect()->query("UPDATE Credimaq SET Observaciones='$obs', Monto='$monto', Fecha_2='$actual_fecha', Paso='$paso', Funcionario='$funcionario', Tipo='$tipo', Convenio='$convenio' WHERE Id='$id'");

		}else{
			$query = $this->connect()->query("UPDATE Credimaq SET Fecha='$fec_ingreso 08:45:00', Observaciones='$obs', Monto='$monto', Fecha_2='$fec_ingreso 08:45:00', Paso='$paso', Funcionario='$funcionario', Tipo='$tipo', Convenio='$convenio' WHERE Id='$id'");
		}
		
        return $query;
    }	
	
    function update_Obs_abi($id, $obs, $monto, $paso, $funcionario, $fec_ingreso, $tipo, $convenio){
        date_default_timezone_set('America/Lima');
        $actual_fecha = date('Y-m-d H:i:s');
        
		if($fec_ingreso==""){
			$query = $this->connect()->query("UPDATE Abi SET Observaciones='$obs', Monto='$monto', Fecha_2='$actual_fecha', Paso='$paso', Funcionario='$funcionario', Tipo='$tipo', Convenio='$convenio' WHERE Id='$id'");

		}else{
			$query = $this->connect()->query("UPDATE Abi SET Fecha='$fec_ingreso 08:45:00', Observaciones='$obs', Monto='$monto', Fecha_2='$fec_ingreso 08:45:00', Paso='$paso', Funcionario='$funcionario', Tipo='$tipo', Convenio='$convenio' WHERE Id='$id'");
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
			$query = $this->connect()->query("SELECT SUM(Monto) as Total FROM Agencias2 WHERE (Fecha_2 BETWEEN '$actual_fecha-01 00:00:00' AND '$actual_fecha-31 23:59:59') AND Paso='div6' AND Moneda='$moneda' AND Agencia='$agencia' AND Tarea='$accion'");
		else
			$query = $this->connect()->query("SELECT SUM(Monto) as Total FROM Agencias2 WHERE (Fecha_2 BETWEEN '$actual_fecha-01 00:00:00' AND '$actual_fecha-31 23:59:59') AND Paso='div6' AND Moneda='$moneda' AND Tarea='$accion'");
		
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

    function update_Obs_agencias2($id, $obs, $paso, $funcionario, $monto, $tarea, $canal, $moneda, $fec_ingreso, $rechazado){
        date_default_timezone_set('America/Lima');
        $actual_fecha = date('Y-m-d H:i:s');
		
		$monto = str_replace(",",".",$monto);
		
		if($fec_ingreso==""){
			$query = $this->connect()->query("UPDATE Agencias2 SET Moneda='$moneda', Observaciones='$obs', Fecha_2='$actual_fecha', Paso='$paso', Funcionario='$funcionario', Monto='$monto', Tarea='$tarea', Canal='$canal',Rechazo='$rechazado' WHERE Id='$id'");
		}else{
			$query = $this->connect()->query("UPDATE Agencias2 SET Moneda='$moneda', Observaciones='$obs', Fecha='$fec_ingreso 08:45:00', Fecha_2='$actual_fecha', Paso='$paso', Funcionario='$funcionario', Monto='$monto', Tarea='$tarea', Canal='$canal',Rechazo='$rechazado' WHERE Id='$id'");
		}
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
        $query = $this->connect()->query("SELECT * FROM Agencias where (Origen='lsolari@infocore.com.pe' OR Origen='elizabethpatino@gmail.com' OR Origen='infocore@cp' OR Origen='katyapatino@gmail.com') AND ((Fecha BETWEEN '2022-10-27 00:00:00' AND '$actual_fecha 23:59:59') OR (Fecha_2 BETWEEN '$actual_mes-01 00:00:00' AND '$actual_mes-31 23:59:59')) ORDER BY Fecha DESC LIMIT 1000");
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
	
	function nuevoPlazofijo($persona){
		date_default_timezone_set('America/Lima');
        $fecha = date('"Y/m/d H:i:s"');
        $id="div1";
		
		$query = $this->connect()->prepare('INSERT INTO Plazo_Fijo (Id, Nombres, Dni, Celular, Calificacion, Deudas_impagas, Deuda_sistema, Utm, Sexo, Nacimiento, Es_socio, Fecha, Fecha_2, Paso, LineaTC, LineaTCusadda, Correo, Funcionario) VALUES (NULL, :nombres, :dni, :celular, :calificacion, :deudas_impagas, :deuda_sistema, :utm, :sexo, :nacimiento, :es_socio,' . $fecha . ',' . $fecha . ', "' . $id . '", :lineatc, :lineatcusada, :correo, :funcionario)');
        $query->execute(['nombres' => $persona['nombres'], 'dni' => $persona['dni'], 'celular' => $persona['celular'], 'correo' => $persona['correo'], 'calificacion' => $persona['calificacion'], 'deudas_impagas' => str_replace(",",".",$persona['deudas_impagas']), 'deuda_sistema' => str_replace(",",".",$persona['deuda_sistema']), 'utm' => $persona['utm'], 'sexo' => $persona['sexo'], 'nacimiento' => $persona['nacimiento'], 'es_socio' => $persona['es_socio'], 'lineatc' => str_replace(",",".",$persona['lineatc']), 'lineatcusada' => str_replace(",",".",$persona['lineatcusada']), 'funcionario' => $persona['funcionario']]);
        return $query;
		
	}
	
    function nuevaPersona_pdp($persona){
        date_default_timezone_set('America/Lima');
        $fecha = date('"Y/m/d H:i:s"');
        $id="div1";
        
        $query = $this->connect()->prepare('INSERT INTO Pdp (Id, Nombres, Dni, Celular, Situacion, Sueldo_bruto, Deudas_impagas, Deuda_sistema, Fecha, Estado, Funcionario, Sexo, Nacimiento, Correo, Fecha_2, Paso, Linea_credito, Linea_utilizada_porcentaje, Observaciones) VALUES (NULL, :nombres, :dni, :celular, :situacion, :sueldo, :deudas_impagas, :deuda_sistema,' . $fecha . ', :estado, :funcionario, :sexo, :nacimiento, :correo, ' . $fecha . ', "' . $id . '", :linea_credito, :linea_utilizada, :observaciones)');
        $query->execute(['nombres' => $persona['nombres'], 'dni' => $persona['dni'], 'celular' => $persona['celular'], 'situacion' => $persona['situacion'], 'sueldo' => str_replace(",",".",$persona['sueldo']), 'deudas_impagas' => str_replace(",",".",$persona['deudas_impagas']), 'deuda_sistema' => str_replace(",",".",$persona['deuda_sistema']), 'estado' => $persona['estado'], 'funcionario' => $persona['funcionario'], 'sexo' => $persona['sexo'], 'nacimiento' => $persona['nacimiento'], 'correo' => $persona['correo'], 'linea_credito' => str_replace(",",".",$persona['linea_credito']), 'linea_utilizada' => str_replace(",",".",$persona['linea_utilizada']), 'observaciones' => $persona['observaciones']]);
        return $query;
    }

	function nuevaPersona_om($persona){
        date_default_timezone_set('America/Lima');
        $fecha = date('"Y/m/d H:i:s"');
        $id="div1";
        
        $query = $this->connect()->prepare('INSERT INTO Om (Id, Nombres, Dni, Celular, Situacion, Sueldo_bruto, Deudas_impagas, Deuda_sistema, Fecha, Estado, Funcionario, Sexo, Nacimiento, Correo, Fecha_2, Paso, Linea_credito, Linea_utilizada_porcentaje, Observaciones) VALUES (NULL, :nombres, :dni, :celular, :situacion, :sueldo, :deudas_impagas, :deuda_sistema,' . $fecha . ', :estado, :funcionario, :sexo, :nacimiento, :correo, ' . $fecha . ', "' . $id . '", :linea_credito, :linea_utilizada, :observaciones)');
        $query->execute(['nombres' => $persona['nombres'], 'dni' => $persona['dni'], 'celular' => $persona['celular'], 'situacion' => $persona['situacion'], 'sueldo' => str_replace(",",".",$persona['sueldo']), 'deudas_impagas' => str_replace(",",".",$persona['deudas_impagas']), 'deuda_sistema' => str_replace(",",".",$persona['deuda_sistema']), 'estado' => $persona['estado'], 'funcionario' => $persona['funcionario'], 'sexo' => $persona['sexo'], 'nacimiento' => $persona['nacimiento'], 'correo' => $persona['correo'], 'linea_credito' => str_replace(",",".",$persona['linea_credito']), 'linea_utilizada' => str_replace(",",".",$persona['linea_utilizada']), 'observaciones' => $persona['observaciones']]);
        return $query;
    }
	
	function nuevaPersona_credimaq($persona){
        date_default_timezone_set('America/Lima');
        $fecha = date('"Y/m/d H:i:s"');
        $id="div1";
        
        $query = $this->connect()->prepare('INSERT INTO Credimaq (Id, Nombres, Dni, Celular, Situacion, Sueldo_bruto, Deudas_impagas, Deuda_sistema, Fecha, Estado, Funcionario, Sexo, Nacimiento, Correo, Fecha_2, Paso, Linea_credito, Linea_utilizada_porcentaje, Observaciones) VALUES (NULL, :nombres, :dni, :celular, :situacion, :sueldo, :deudas_impagas, :deuda_sistema,' . $fecha . ', :estado, :funcionario, :sexo, :nacimiento, :correo, ' . $fecha . ', "' . $id . '", :linea_credito, :linea_utilizada, :observaciones)');
        $query->execute(['nombres' => $persona['nombres'], 'dni' => $persona['dni'], 'celular' => $persona['celular'], 'situacion' => $persona['situacion'], 'sueldo' => str_replace(",",".",$persona['sueldo']), 'deudas_impagas' => str_replace(",",".",$persona['deudas_impagas']), 'deuda_sistema' => str_replace(",",".",$persona['deuda_sistema']), 'estado' => $persona['estado'], 'funcionario' => $persona['funcionario'], 'sexo' => $persona['sexo'], 'nacimiento' => $persona['nacimiento'], 'correo' => $persona['correo'], 'linea_credito' => str_replace(",",".",$persona['linea_credito']), 'linea_utilizada' => str_replace(",",".",$persona['linea_utilizada']), 'observaciones' => $persona['observaciones']]);
        return $query;
    }	

	function nuevaPersona_abi($persona){
        date_default_timezone_set('America/Lima');
        $fecha = date('"Y/m/d H:i:s"');
        $id="div1";
        
        $query = $this->connect()->prepare('INSERT INTO Abi (Id, Nombres, Dni, Celular, Situacion, Sueldo_bruto, Deudas_impagas, Deuda_sistema, Fecha, Estado, Funcionario, Sexo, Nacimiento, Correo, Fecha_2, Paso, Linea_credito, Linea_utilizada_porcentaje, Observaciones) VALUES (NULL, :nombres, :dni, :celular, :situacion, :sueldo, :deudas_impagas, :deuda_sistema,' . $fecha . ', :estado, :funcionario, :sexo, :nacimiento, :correo, ' . $fecha . ', "' . $id . '", :linea_credito, :linea_utilizada, :observaciones)');
        $query->execute(['nombres' => $persona['nombres'], 'dni' => $persona['dni'], 'celular' => $persona['celular'], 'situacion' => $persona['situacion'], 'sueldo' => str_replace(",",".",$persona['sueldo']), 'deudas_impagas' => str_replace(",",".",$persona['deudas_impagas']), 'deuda_sistema' => str_replace(",",".",$persona['deuda_sistema']), 'estado' => $persona['estado'], 'funcionario' => $persona['funcionario'], 'sexo' => $persona['sexo'], 'nacimiento' => $persona['nacimiento'], 'correo' => $persona['correo'], 'linea_credito' => str_replace(",",".",$persona['linea_credito']), 'linea_utilizada' => str_replace(",",".",$persona['linea_utilizada']), 'observaciones' => $persona['observaciones']]);
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
		
		if($persona['tarea']=="operacion" or $persona['tarea']=="tarjeta")
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
			$month = date('Y-m', strtotime('first day of last month'));
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
			$month = date('Y-m', strtotime('first day of last month'));
		}
        $query = $this->connect()->query("SELECT SUM(Monto) as TotalDesem FROM Agencias WHERE (Fecha_2 BETWEEN '$month-01 00:00:00' AND '$month-31 23:59:59') AND Paso='div6' AND (Origen='lsolari@infocore.com.pe' OR Origen='elizabethpatino@gmail.com' OR Origen='infocore@cp' OR Origen='katyapatino@gmail.com')");
		return $query;
    }
	
    function imp_desembolsados_mpasado(){
        date_default_timezone_set('America/Lima');
        $month_day_last = date('Y-m', strtotime('first day of last month'));
		
        $query = $this->connect()->query("SELECT SUM(Monto) as TotalDesem FROM Persona WHERE (Fecha_2 BETWEEN '$month_day_last-01 00:00:00' AND '$month_day_last-31 23:59:59') AND Paso='div6'");
        return $query;
    }
	
	function imp_desembolsados_mantepasado(){
        date_default_timezone_set('America/Lima');
        $month_day_last = date('Y-m', strtotime('-2 month'));
		
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
	
    function obtListadoDesemb_infogas(){
        date_default_timezone_set('America/Lima');
        $hoy = date('Y-m-d');
        $first_day = date('Y-m');
        
        $query = $this->connect()->query("SELECT * FROM Infogas WHERE (Fecha_2 BETWEEN '$first_day-01 00:00:00' AND '$hoy 23:59:59') AND Paso='div6' ORDER BY Utm");
        return $query;
    }
	
    function obtListadoDesemb_plazofijo($moneda){
        date_default_timezone_set('America/Lima');
        $hoy = date('Y-m-d');
        $first_day = date('Y-m');
		if($moneda=="Soles"){
			$query = $this->connect()->query("SELECT * FROM Plazo_Fijo WHERE (Fecha_2 BETWEEN '$first_day-01 00:00:00' AND '$hoy 23:59:59') AND Paso='div6' AND Monto>0");
        }else{
			$query = $this->connect()->query("SELECT * FROM Plazo_Fijo WHERE (Fecha_2 BETWEEN '$first_day-01 00:00:00' AND '$hoy 23:59:59') AND Paso='div6' AND Monto_2>0");
		}
        return $query;
    }

	function obtListadoDesemb_plazofijo_mpasado($moneda){
		date_default_timezone_set('America/Lima');
		$mes_pasado = date('Y-m', strtotime('first day of last month'));
		
        $hoy = date('Y-m-d');
        $first_day = date('Y-m');
		if($moneda=="Soles"){
			$query = $this->connect()->query("SELECT * FROM Plazo_Fijo WHERE (Fecha_2 BETWEEN '$mes_pasado-01 00:00:00' AND '$mes_pasado-31 23:59:59') AND Paso='div6' AND Monto>0");
        }else{
			$query = $this->connect()->query("SELECT * FROM Plazo_Fijo WHERE (Fecha_2 BETWEEN '$mes_pasado-01 00:00:00' AND '$mes_pasado-31 23:59:59') AND Paso='div6' AND Monto_2>0");
		}
        return $query;
    }

	function obtListadoDesemb_plazofijo_mpasado_atras($moneda, $meses){
		date_default_timezone_set('America/Lima');
		
		$mes_pasado = date('Y-m', strtotime('-' . $meses . ' month'));
		
        $hoy = date('Y-m-d');
        $first_day = date('Y-m');
		if($moneda=="Soles"){
			$query = $this->connect()->query("SELECT * FROM Plazo_Fijo WHERE (Fecha_2 BETWEEN '$mes_pasado-01 00:00:00' AND '$mes_pasado-31 23:59:59') AND Paso='div6' AND Monto>0");
        }else{
			$query = $this->connect()->query("SELECT * FROM Plazo_Fijo WHERE (Fecha_2 BETWEEN '$mes_pasado-01 00:00:00' AND '$mes_pasado-31 23:59:59') AND Paso='div6' AND Monto_2>0");
		}
        return $query;
    }	
	
    function obtListadoDesemb_pdp(){
        date_default_timezone_set('America/Lima');
        $hoy = date('Y-m-d');
        $first_day = date('Y-m');
        
        $query = $this->connect()->query("SELECT * FROM Pdp WHERE (Fecha_2 BETWEEN '$first_day-01 00:00:00' AND '$hoy 23:59:59') AND Paso='div6' ORDER BY Fecha_2");
        return $query;
    }
	
    function obtListadoDesemb_om(){
        date_default_timezone_set('America/Lima');
        $hoy = date('Y-m-d');
        $first_day = date('Y-m');
        
        $query = $this->connect()->query("SELECT * FROM Om WHERE (Fecha_2 BETWEEN '$first_day-01 00:00:00' AND '$hoy 23:59:59') AND Paso='div6' ORDER BY Fecha_2");
        return $query;
    }
	
    function obtListadoDesemb_credimaq(){
        date_default_timezone_set('America/Lima');
        $hoy = date('Y-m-d');
        $first_day = date('Y-m');
        
        $query = $this->connect()->query("SELECT * FROM Credimaq WHERE (Fecha_2 BETWEEN '$first_day-01 00:00:00' AND '$hoy 23:59:59') AND Paso='div6' ORDER BY Fecha_2");
        return $query;
    }	

    function obtListadoDesemb_abi(){
        date_default_timezone_set('America/Lima');
        $hoy = date('Y-m-d');
        $first_day = date('Y-m');
        
        $query = $this->connect()->query("SELECT * FROM Abi WHERE (Fecha_2 BETWEEN '$first_day-01 00:00:00' AND '$hoy 23:59:59') AND Paso='div6' ORDER BY Fecha_2");
        return $query;
    }	
	
	function obtListadoDesemb_exp($mes){
        date_default_timezone_set('America/Lima');
        if($mes=="actual"){
			$month = date('Y-m');
		}
		if($mes=="pasado"){
			$month = date('Y-m', strtotime('first day of last month'));
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
			$month = date('Y-m', strtotime('first day of last month'));
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
        $month_day_last = date('Y-m', strtotime('first day of last month'));
        
        $query = $this->connect()->query("SELECT * FROM Agencias WHERE (Fecha_2 BETWEEN '$month_day_last-01 00:00:00' AND '$month_day_last-31 23:59:59') AND Paso='div6' AND Funcionario LIKE '%$funcionario%'");
        return $query;
    }

    function obtListadoDesemb_mpasado(){
        date_default_timezone_set('America/Lima');
        $month_day_last = date('Y-m', strtotime('first day of last month'));
        
        $query = $this->connect()->query("SELECT * FROM Persona WHERE (Fecha_2 BETWEEN '$month_day_last-01 00:00:00' AND '$month_day_last-31 23:59:59') AND Paso='div6' ORDER BY Nombre_empresa");
        return $query;
    }
	
	function obtListadoDesemb_mantepasado(){
        date_default_timezone_set('America/Lima');
        $month_day_last = date('Y-m', strtotime('-2 month'));
        
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
	
    function imp_desembolsados_infogas($funcionario){
        date_default_timezone_set('America/Lima');
        $hoy = date('Y-m-d');
        $first_day = date('Y-m');
        
        $query = $this->connect()->query("SELECT SUM(Monto) as TotalDesem FROM Infogas WHERE (Fecha_2 BETWEEN '$first_day-01 00:00:00' AND '$hoy 23:59:59') AND Paso='div6' AND Funcionario LIKE '$funcionario%'");
        return $query;
    }
	
    function imp_desembolsados_plazofijo($moneda){
        date_default_timezone_set('America/Lima');
        $hoy = date('Y-m-d');
        $first_day = date('Y-m');
        
		if($moneda=="Soles"){
			$query = $this->connect()->query("SELECT SUM(Monto) as TotalDesem FROM Plazo_Fijo WHERE (Fecha_2 BETWEEN '$first_day-01 00:00:00' AND '$hoy 23:59:59') AND Paso='div6' AND Monto>0");
		}else{
			$query = $this->connect()->query("SELECT SUM(Monto_2) as TotalDesem FROM Plazo_Fijo WHERE (Fecha_2 BETWEEN '$first_day-01 00:00:00' AND '$hoy 23:59:59') AND Paso='div6' AND Monto_2>0");
		}
		
        return $query;
    }
	
    function imp_desembolsados_plazofijo_df($moneda){
        date_default_timezone_set('America/Lima');
        $hoy = date('Y-m-d');
        $first_day = date('Y-m');
        
		if($moneda=="Soles"){
			$query = $this->connect()->query("SELECT SUM(Monto) as TotalDesem FROM Plazo_Fijo WHERE (Fecha_2 BETWEEN '$first_day-01 00:00:00' AND '$hoy 23:59:59') AND Paso='div6' AND Monto>0 AND Es_socio='No'");
		}else{
			$query = $this->connect()->query("SELECT SUM(Monto_2) as TotalDesem FROM Plazo_Fijo WHERE (Fecha_2 BETWEEN '$first_day-01 00:00:00' AND '$hoy 23:59:59') AND Paso='div6' AND Monto_2>0 AND Es_socio='No'");
		}
		
        return $query;
    }	
	
    function imp_desembolsados_plazofijo_mpasado($moneda){
        date_default_timezone_set('America/Lima');
		$mes_pasado = date('Y-m', strtotime('first day of last month'));
        //$hoy = date('Y-m-d');
        //$first_day = date('Y-m');
        
		if($moneda=="Soles"){
			$query = $this->connect()->query("SELECT SUM(Monto) as TotalDesem FROM Plazo_Fijo WHERE (Fecha_2 BETWEEN '$mes_pasado-01 00:00:00' AND '$mes_pasado-31 23:59:59') AND Paso='div6' AND Monto>0");
		}else{
			$query = $this->connect()->query("SELECT SUM(Monto_2) as TotalDesem FROM Plazo_Fijo WHERE (Fecha_2 BETWEEN '$mes_pasado-01 00:00:00' AND '$mes_pasado-31 23:59:59') AND Paso='div6' AND Monto_2>0");
		}
		
        return $query;
    }
	
	function imp_desembolsados_plazofijo_mpasado_atras($moneda, $meses){
        date_default_timezone_set('America/Lima');
		$mes_pasado = date('Y-m', strtotime('-' . $meses . ' month'));
        //$hoy = date('Y-m-d');
        //$first_day = date('Y-m');
        
		if($moneda=="Soles"){
			$query = $this->connect()->query("SELECT SUM(Monto) as TotalDesem FROM Plazo_Fijo WHERE (Fecha_2 BETWEEN '$mes_pasado-01 00:00:00' AND '$mes_pasado-31 23:59:59') AND Paso='div6' AND Monto>0");
		}else{
			$query = $this->connect()->query("SELECT SUM(Monto_2) as TotalDesem FROM Plazo_Fijo WHERE (Fecha_2 BETWEEN '$mes_pasado-01 00:00:00' AND '$mes_pasado-31 23:59:59') AND Paso='div6' AND Monto_2>0");
		}
		
        return $query;
    }	
	
    function imp_desembolsados_pdp($funcionario){
        date_default_timezone_set('America/Lima');
        $hoy = date('Y-m-d');
        $first_day = date('Y-m');
        
        $query = $this->connect()->query("SELECT SUM(Monto) as TotalDesem FROM Pdp WHERE (Fecha_2 BETWEEN '$first_day-01 00:00:00' AND '$hoy 23:59:59') AND Paso='div6' AND Funcionario LIKE '$funcionario%'");
        return $query;
    }
	
    function imp_desembolsados_om($funcionario){
        date_default_timezone_set('America/Lima');
        $hoy = date('Y-m-d');
        $first_day = date('Y-m');
        
        $query = $this->connect()->query("SELECT SUM(Monto) as TotalDesem FROM Om WHERE (Fecha_2 BETWEEN '$first_day-01 00:00:00' AND '$hoy 23:59:59') AND Paso='div6' AND Funcionario LIKE '$funcionario%'");
        return $query;
    }
	
    function imp_desembolsados_credimaq($funcionario){
        date_default_timezone_set('America/Lima');
        $hoy = date('Y-m-d');
        $first_day = date('Y-m');
        
        $query = $this->connect()->query("SELECT SUM(Monto) as TotalDesem FROM Credimaq WHERE (Fecha_2 BETWEEN '$first_day-01 00:00:00' AND '$hoy 23:59:59') AND Paso='div6' AND Funcionario LIKE '$funcionario%'");
        return $query;
    }	

	function imp_desembolsados_abi($funcionario){
        date_default_timezone_set('America/Lima');
        $hoy = date('Y-m-d');
        $first_day = date('Y-m');
        
        $query = $this->connect()->query("SELECT SUM(Monto) as TotalDesem FROM Abi WHERE (Fecha_2 BETWEEN '$first_day-01 00:00:00' AND '$hoy 23:59:59') AND Paso='div6' AND Funcionario LIKE '$funcionario%'");
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
		$month_day_last = date('Y-m', strtotime('first day of last month'));
        
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
		$month_day_last = date('Y-m', strtotime('first day of last month'));
        
        $query = $this->connect()->query("SELECT SUM(Monto) as TotalDesem FROM Agencias WHERE (Fecha_2 BETWEEN '$month_day_last-01 00:00:00' AND '$month_day_last-31 23:59:59') AND Paso='div6' AND Tarea='$tarea' AND Moneda='2' AND Funcionario LIKE '$funcionario%'");
        return $query;
    }

    function imp_desembolsados_persona_mpasado($funcionario){
        date_default_timezone_set('America/Lima');
        $month_day_last = date('Y-m', strtotime('first day of last month'));
        
        $query = $this->connect()->query("SELECT SUM(Monto) as TotalDesem FROM Persona WHERE (Fecha_2 BETWEEN '$month_day_last-01 00:00:00' AND '$month_day_last-31 23:59:59') AND Paso='div6' AND Funcionario LIKE '$funcionario%'");
        return $query;
    }
	
    function imp_desembolsados_persona_mantepasado($funcionario){
        date_default_timezone_set('America/Lima');
        $month_day_last = date('Y-m', strtotime('-2 month'));
        
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
			$month = date('Y-m', strtotime('first day of last month'));
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
			$month = date('Y-m', strtotime('first day of last month'));
		}
        $query = $this->connect()->query("SELECT COUNT(Monto) as TotalDesem FROM Agencias WHERE (Fecha_2 BETWEEN '$month-01 00:00:00' AND '$month-31 23:59:59') AND Paso='div6' AND (Origen='lsolari@infocore.com.pe' OR Origen='elizabethpatino@gmail.com' OR Origen='infocore@cp' OR Origen='katyapatino@gmail.com')");
        return $query;
    }

    function total_desembolsados_mpasado(){
        date_default_timezone_set('America/Lima');
        $month_day_last = date('Y-m', strtotime('first day of last month'));
        
        $query = $this->connect()->query("SELECT COUNT(Monto) as TotalDesem FROM Persona WHERE (Fecha_2 BETWEEN '$month_day_last-01 00:00:00' AND '$month_day_last-31 23:59:59') AND Paso='div6'");
        return $query;
    }
	
	function total_desembolsados_mantepasado(){
        date_default_timezone_set('America/Lima');
        $month_day_last = date('Y-m', strtotime('-2 month'));
        
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
	
    function total_desembolsados_infogas($funcionario){
        date_default_timezone_set('America/Lima');
        $hoy = date('Y-m-d');
        $first_day = date('Y-m');
        
        $query = $this->connect()->query("SELECT COUNT(Monto) as TotalDesem FROM Infogas WHERE (Fecha_2 BETWEEN '$first_day-01 00:00:00' AND '$hoy 23:59:59') AND Paso='div6' AND Funcionario LIKE '$funcionario%'");
        return $query;
    }
	
    function total_desembolsados_plazofijo($moneda){
        date_default_timezone_set('America/Lima');
        $hoy = date('Y-m-d');
        $first_day = date('Y-m');
        
		if($moneda=="Soles"){
			$query = $this->connect()->query("SELECT COUNT(Monto) as TotalDesem FROM Plazo_Fijo WHERE (Fecha_2 BETWEEN '$first_day-01 00:00:00' AND '$hoy 23:59:59') AND Paso='div6' AND Monto>0");
		}else{
			$query = $this->connect()->query("SELECT COUNT(Monto_2) as TotalDesem FROM Plazo_Fijo WHERE (Fecha_2 BETWEEN '$first_day-01 00:00:00' AND '$hoy 23:59:59') AND Paso='div6' AND Monto_2>0");
		}
		
        return $query;
    }

    function total_desembolsados_plazofijo_df($moneda){
        date_default_timezone_set('America/Lima');
        $hoy = date('Y-m-d');
        $first_day = date('Y-m');
        
		if($moneda=="Soles"){
			$query = $this->connect()->query("SELECT COUNT(Monto) as TotalDesem FROM Plazo_Fijo WHERE (Fecha_2 BETWEEN '$first_day-01 00:00:00' AND '$hoy 23:59:59') AND Paso='div6' AND Monto>0 AND Es_socio='No'");
		}else{
			$query = $this->connect()->query("SELECT COUNT(Monto_2) as TotalDesem FROM Plazo_Fijo WHERE (Fecha_2 BETWEEN '$first_day-01 00:00:00' AND '$hoy 23:59:59') AND Paso='div6' AND Monto_2>0 AND Es_socio='No'");
		}
		
        return $query;
    }	
	
    function total_desembolsados_pdp($funcionario){
        date_default_timezone_set('America/Lima');
        $hoy = date('Y-m-d');
        $first_day = date('Y-m');
        
        $query = $this->connect()->query("SELECT COUNT(Monto) as TotalDesem FROM Pdp WHERE (Fecha_2 BETWEEN '$first_day-01 00:00:00' AND '$hoy 23:59:59') AND Paso='div6' AND Funcionario LIKE '$funcionario%'");
        return $query;
    }
	
    function total_desembolsados_om($funcionario){
        date_default_timezone_set('America/Lima');
        $hoy = date('Y-m-d');
        $first_day = date('Y-m');
        
        $query = $this->connect()->query("SELECT COUNT(Monto) as TotalDesem FROM Om WHERE (Fecha_2 BETWEEN '$first_day-01 00:00:00' AND '$hoy 23:59:59') AND Paso='div6' AND Funcionario LIKE '$funcionario%'");
        return $query;
    }
	
    function total_desembolsados_credimaq($funcionario){
        date_default_timezone_set('America/Lima');
        $hoy = date('Y-m-d');
        $first_day = date('Y-m');
        
        $query = $this->connect()->query("SELECT COUNT(Monto) as TotalDesem FROM Credimaq WHERE (Fecha_2 BETWEEN '$first_day-01 00:00:00' AND '$hoy 23:59:59') AND Paso='div6' AND Funcionario LIKE '$funcionario%'");
        return $query;
    }	

    function total_desembolsados_abi($funcionario){
        date_default_timezone_set('America/Lima');
        $hoy = date('Y-m-d');
        $first_day = date('Y-m');
        
        $query = $this->connect()->query("SELECT COUNT(Monto) as TotalDesem FROM Abi WHERE (Fecha_2 BETWEEN '$first_day-01 00:00:00' AND '$hoy 23:59:59') AND Paso='div6' AND Funcionario LIKE '$funcionario%'");
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
		$month_day_last = date('Y-m', strtotime('first day of last month'));
        
        $query = $this->connect()->query("SELECT COUNT(Monto) as TotalDesem FROM Agencias WHERE (Fecha_2 BETWEEN '$month_day_last-01 00:00:00' AND '$month_day_last-31 23:59:59') AND Paso='div6' AND Tarea='$tarea' AND Moneda='1' AND Funcionario LIKE '$funcionario%'");
        return $query;
    }
	
    function total_desembolsados_agencia_mpasado_dol($funcionario, $tarea){
        date_default_timezone_set('America/Lima');
		$month_day_last = date('Y-m', strtotime('first day of last month'));
        
        $query = $this->connect()->query("SELECT COUNT(Monto) as TotalDesem FROM Agencias WHERE (Fecha_2 BETWEEN '$month_day_last-01 00:00:00' AND '$month_day_last-31 23:59:59') AND Paso='div6' AND Tarea='$tarea' AND Moneda='2' AND Funcionario LIKE '$funcionario%'");
        return $query;
    }

	
    function total_desembolsados_persona_mpasado($funcionario){
        date_default_timezone_set('America/Lima');
        $month_day_last = date('Y-m', strtotime('first day of last month'));
        
        $query = $this->connect()->query("SELECT COUNT(Monto) as TotalDesem FROM Persona WHERE (Fecha_2 BETWEEN '$month_day_last-01 00:00:00' AND '$month_day_last-31 23:59:59') AND Paso='div6' AND Funcionario LIKE '$funcionario%'");
        return $query;
    }
	
	function total_desembolsados_persona_mantepasado($funcionario){
        date_default_timezone_set('America/Lima');
        $month_day_last = date('Y-m', strtotime('-2 month'));
        
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
			$orden_tmp = rand_int(1, 1000);
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
	
    function obtenerPasos2_infogas($step, $funcionario){
        date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d');
        $actual_mes = date('Y-m');
        $pasada_fecha = date('Y-m-d', strtotime('-14 day'));
        // igual que obtenerPasos
        $query = $this->connect()->query("SELECT * FROM Infogas WHERE ((Fecha BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59') OR (Fecha_2 BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59')) AND Estado='PRE-APROBADO' AND Paso='$step' AND Funcionario LIKE '$funcionario%'");
        return $query;
    }

    function obtenerPasos2_plazofijo($step, $funcionario){
        date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d');
        $actual_mes = date('Y-m');
		$pasado_mes = date('Y-m', strtotime('first day of last month'));
        $pasada_fecha = date('Y-m-d', strtotime('-30 day'));
        // igual que obtenerPasos
		
		if($step=="div6"){
						
			$query = $this->connect()->query("SELECT * FROM Plazo_Fijo WHERE (Fecha_2 BETWEEN '$actual_mes-01 00:00:00' AND '$actual_mes-31 23:59:59') AND Paso='$step' AND Funcionario LIKE '$funcionario%'");
		}else{
			$query = $this->connect()->query("SELECT * FROM Plazo_Fijo WHERE ((Fecha BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59') OR (Fecha_2 BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59')) AND Paso='$step' AND Funcionario LIKE '$funcionario%'");
		}
		
        return $query;
    }
	
    function obtenerPasos2_camara($step, $funcionario){
        date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d');
        $actual_mes = date('Y-m');
		$pasado_mes = date('Y-m', strtotime('first day of last month'));
        $pasada_fecha = date('Y-m-d', strtotime('-30 day'));
        // igual que obtenerPasos
		
		if($step=="div6"){
						
			$query = $this->connect()->query("SELECT * FROM Comercio WHERE (Fecha_2 BETWEEN '$actual_mes-01 00:00:00' AND '$actual_mes-31 23:59:59') AND Paso='$step' AND Funcionario LIKE '$funcionario%'");
		}else{
			$query = $this->connect()->query("SELECT * FROM Comercio WHERE ((Fecha BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59') OR (Fecha_2 BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59')) AND Paso='$step' AND Funcionario LIKE '$funcionario%'");
		}
		
        return $query;
    }	
	
	function obtenerPasos2_cobranza($step, $grupo){
        date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d');
        $actual_mes = date('Y-m');
        $pasada_fecha = date('Y-m-d', strtotime('-14 day'));
        // igual que obtenerPasos
        $query = $this->connect()->query("SELECT * FROM Prestamos WHERE ((Fecha BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59') OR (Fecha_2 BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59')) AND Situacion='VIGENTE' AND Paso='$step' AND Grupo LIKE '%$grupo%'");
        return $query;
    }
	
	function obtenerPasos2_cobranza_todos($grupo){
        date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d');
        $actual_mes = date('Y-m');
        $pasada_fecha = date('Y-m-d', strtotime('-14 day'));
        // igual que obtenerPasos
        $query = $this->connect()->query("SELECT * FROM Prestamos WHERE ((Fecha BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59') OR (Fecha_2 BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59')) AND Situacion='VIGENTE' AND Grupo LIKE '%$grupo%'");
        return $query;
    }	
	
	function obtenerPasos2_cobranza_cuenta($step, $grupo){
        date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d');
        $actual_mes = date('Y-m');
        $pasada_fecha = date('Y-m-d', strtotime('-14 day'));
        // igual que obtenerPasos
        $query = $this->connect()->query("SELECT COUNT(*) as Total FROM Prestamos WHERE ((Fecha BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59') OR (Fecha_2 BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59')) AND Situacion='VIGENTE' AND Paso='$step' AND Grupo LIKE '%$grupo%'");
        return $query;
    }
	
    function obtenerPasos2_pdp($step, $funcionario){
        date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d');
        $actual_mes = date('Y-m');
        $pasada_fecha = date('Y-m-d', strtotime('-14 day'));
        // igual que obtenerPasos
        $query = $this->connect()->query("SELECT * FROM Pdp WHERE ((Fecha BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59') OR (Fecha_2 BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59')) AND Estado='PRE-APROBADO' AND Paso='$step' AND Funcionario LIKE '$funcionario%'");
        return $query;
    }
	
    function obtenerPasos2_om($step, $funcionario){
        date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d');
        $actual_mes = date('Y-m');
        $pasada_fecha = date('Y-m-d', strtotime('-14 day'));
        // igual que obtenerPasos
        $query = $this->connect()->query("SELECT * FROM Om WHERE ((Fecha BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59') OR (Fecha_2 BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59')) AND Estado='PRE-APROBADO' AND Paso='$step' AND Funcionario LIKE '$funcionario%'");
        return $query;
    }
	
    function obtenerPasos2_credimaq($step, $funcionario){
        date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d');
        $actual_mes = date('Y-m');
        $pasada_fecha = date('Y-m-d', strtotime('-14 day'));
        // igual que obtenerPasos
        $query = $this->connect()->query("SELECT * FROM Credimaq WHERE ((Fecha BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59') OR (Fecha_2 BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59')) AND Estado='PRE-APROBADO' AND Paso='$step' AND Funcionario LIKE '$funcionario%'");
        return $query;
    }	
	
    function obtenerPasos2_abi($step, $funcionario){
        date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d');
        $actual_mes = date('Y-m');
        $pasada_fecha = date('Y-m-d', strtotime('-14 day'));
        // igual que obtenerPasos
        $query = $this->connect()->query("SELECT * FROM Abi WHERE ((Fecha BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59') OR (Fecha_2 BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59')) AND Estado='PRE-APROBADO' AND Paso='$step' AND Funcionario LIKE '$funcionario%'");
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
	
    function obtenerPasos2_descartados_infogas($step, $funcionario){
        date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d');
        $actual_mes = date('Y-m');
        $pasada_fecha = date('Y-m-d', strtotime('-2 day'));
        // igual que obtenerPasos
        $query = $this->connect()->query("SELECT * FROM Infogas WHERE ((Fecha BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59') OR (Fecha_2 BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59')) AND Estado='PRE-APROBADO' AND Paso='$step' AND Funcionario LIKE '$funcionario%'");
        return $query;
    }

    function obtenerPasos2_descartados_plazofijo($step){
        date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d');
        $actual_mes = date('Y-m');
        $pasada_fecha = date('Y-m-d', strtotime('-2 day'));
        // igual que obtenerPasos
        $query = $this->connect()->query("SELECT * FROM Plazo_Fijo WHERE ((Fecha BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59') OR (Fecha_2 BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59')) AND Paso='$step'");
        return $query;
    }
	
    function obtenerPasos2_descartados_pdp($step, $funcionario){
        date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d');
        $actual_mes = date('Y-m');
        $pasada_fecha = date('Y-m-d', strtotime('-2 day'));
        // igual que obtenerPasos
        $query = $this->connect()->query("SELECT * FROM Pdp WHERE ((Fecha BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59') OR (Fecha_2 BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59')) AND Estado='PRE-APROBADO' AND Paso='$step' AND Funcionario LIKE '$funcionario%'");
        return $query;
    }

    function obtenerPasos2_descartados_om($step, $funcionario){
        date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d');
        $actual_mes = date('Y-m');
        $pasada_fecha = date('Y-m-d', strtotime('-2 day'));
        // igual que obtenerPasos
        $query = $this->connect()->query("SELECT * FROM Om WHERE ((Fecha BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59') OR (Fecha_2 BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59')) AND Estado='PRE-APROBADO' AND Paso='$step' AND Funcionario LIKE '$funcionario%'");
        return $query;
    }
	
    function obtenerPasos2_descartados_credimaq($step, $funcionario){
        date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d');
        $actual_mes = date('Y-m');
        $pasada_fecha = date('Y-m-d', strtotime('-2 day'));
        // igual que obtenerPasos
        $query = $this->connect()->query("SELECT * FROM Credimaq WHERE ((Fecha BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59') OR (Fecha_2 BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59')) AND Estado='PRE-APROBADO' AND Paso='$step' AND Funcionario LIKE '$funcionario%'");
        return $query;
    }	

    function obtenerPasos2_descartados_abi($step, $funcionario){
        date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d');
        $actual_mes = date('Y-m');
        $pasada_fecha = date('Y-m-d', strtotime('-2 day'));
        // igual que obtenerPasos
        $query = $this->connect()->query("SELECT * FROM Abi WHERE ((Fecha BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59') OR (Fecha_2 BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59')) AND Estado='PRE-APROBADO' AND Paso='$step' AND Funcionario LIKE '$funcionario%'");
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
	
    function obtenerPasos2_desemb_infogas($step, $funcionario){
        date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d');
        $actual_mes = date('Y-m');
        $pasada_fecha = date('Y-m-d', strtotime('-14 day'));
   
        $query = $this->connect()->query("SELECT * FROM Infogas WHERE (Fecha_2 BETWEEN '$actual_mes-01 00:00:00' AND '$actual_mes-31 23:59:59') AND Estado='PRE-APROBADO' AND Paso='$step' AND Funcionario LIKE '$funcionario%'");
        return $query;
    }
	
    function obtenerPasos2_desemb_plazofijo($step){
        date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d');
        $actual_mes = date('Y-m');
        $pasada_fecha = date('Y-m-d', strtotime('-30 day'));
   
        $query = $this->connect()->query("SELECT * FROM Plazo_Fijo WHERE (Fecha_2 BETWEEN '$actual_mes-01 00:00:00' AND '$actual_mes-31 23:59:59') AND Paso='$step'");
        return $query;
    }
	
    function obtenerPasos2_desemb_pdp($step, $funcionario){
        date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d');
        $actual_mes = date('Y-m');
        $pasada_fecha = date('Y-m-d', strtotime('-14 day'));
   
        $query = $this->connect()->query("SELECT * FROM Pdp WHERE (Fecha_2 BETWEEN '$actual_mes-01 00:00:00' AND '$actual_mes-31 23:59:59') AND Estado='PRE-APROBADO' AND Paso='$step' AND Funcionario LIKE '$funcionario%'");
        return $query;
    }
	
    function obtenerPasos2_desemb_om($step, $funcionario){
        date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d');
        $actual_mes = date('Y-m');
        $pasada_fecha = date('Y-m-d', strtotime('-14 day'));
   
        $query = $this->connect()->query("SELECT * FROM Om WHERE (Fecha_2 BETWEEN '$actual_mes-01 00:00:00' AND '$actual_mes-31 23:59:59') AND Estado='PRE-APROBADO' AND Paso='$step' AND Funcionario LIKE '$funcionario%'");
        return $query;
    }
	
    function obtenerPasos2_desemb_credimaq($step, $funcionario){
        date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d');
        $actual_mes = date('Y-m');
        $pasada_fecha = date('Y-m-d', strtotime('-14 day'));
   
        $query = $this->connect()->query("SELECT * FROM Credimaq WHERE (Fecha_2 BETWEEN '$actual_mes-01 00:00:00' AND '$actual_mes-31 23:59:59') AND Estado='PRE-APROBADO' AND Paso='$step' AND Funcionario LIKE '$funcionario%'");
        return $query;
    }	

    function obtenerPasos2_desemb_abi($step, $funcionario){
        date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d');
        $actual_mes = date('Y-m');
        $pasada_fecha = date('Y-m-d', strtotime('-14 day'));
   
        $query = $this->connect()->query("SELECT * FROM Abi WHERE (Fecha_2 BETWEEN '$actual_mes-01 00:00:00' AND '$actual_mes-31 23:59:59') AND Estado='PRE-APROBADO' AND Paso='$step' AND Funcionario LIKE '$funcionario%'");
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
	
	function tarjetasPendientes_plazofijo($funcionario){
        date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d');
        $actual_mes = date('Y-m');
        $pasada_fecha = date('Y-m-d', strtotime('-14 day'));
        // igual que obtenerPasos
        $query = $this->connect()->query("SELECT COUNT(Id) as Total FROM Plazo_Fijo WHERE ((Fecha BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59') OR (Fecha_2 BETWEEN '$actual_mes-01 00:00:00' AND '$actual_feha 23:59:59')) AND (Paso='div1' OR Paso='div2' OR Paso='div3' OR Paso='div4' OR Paso='div5') AND Funcionario LIKE '$funcionario%'");
        return $query;
    }
	
	function tarjetasPendientes_persona_infogas($funcionario, $paso){
        date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d');
        $actual_mes = date('Y-m');
        $pasada_fecha = date('Y-m-d', strtotime('-14 day'));
        // igual que obtenerPasos
        $query = $this->connect()->query("SELECT COUNT(Monto) as Total FROM Infogas WHERE ((Fecha BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59') OR (Fecha_2 BETWEEN '$actual_mes-01 00:00:00' AND '$actual_feha 23:59:59')) AND Estado='PRE-APROBADO' AND Paso='$paso' AND Funcionario LIKE '$funcionario%'");
        return $query;
    }

	function tarjetasPendientes_persona_pdp($funcionario, $paso){
        date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d');
        $actual_mes = date('Y-m');
        $pasada_fecha = date('Y-m-d', strtotime('-14 day'));
        // igual que obtenerPasos
        $query = $this->connect()->query("SELECT COUNT(Monto) as Total FROM Pdp WHERE ((Fecha BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59') OR (Fecha_2 BETWEEN '$actual_mes-01 00:00:00' AND '$actual_feha 23:59:59')) AND Estado='PRE-APROBADO' AND Paso='$paso' AND Funcionario LIKE '$funcionario%'");
        return $query;
    }
	
	function tarjetasPendientes_persona_om($funcionario, $paso){
        date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d');
        $actual_mes = date('Y-m');
        $pasada_fecha = date('Y-m-d', strtotime('-14 day'));
        // igual que obtenerPasos
        $query = $this->connect()->query("SELECT COUNT(Monto) as Total FROM Om WHERE ((Fecha BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59') OR (Fecha_2 BETWEEN '$actual_mes-01 00:00:00' AND '$actual_feha 23:59:59')) AND Estado='PRE-APROBADO' AND Paso='$paso' AND Funcionario LIKE '$funcionario%'");
        return $query;
    }
	
	function tarjetasPendientes_persona_credimaq($funcionario, $paso){
        date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d');
        $actual_mes = date('Y-m');
        $pasada_fecha = date('Y-m-d', strtotime('-14 day'));
        // igual que obtenerPasos
        $query = $this->connect()->query("SELECT COUNT(Monto) as Total FROM Credimaq WHERE ((Fecha BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59') OR (Fecha_2 BETWEEN '$actual_mes-01 00:00:00' AND '$actual_feha 23:59:59')) AND Estado='PRE-APROBADO' AND Paso='$paso' AND Funcionario LIKE '$funcionario%'");
        return $query;
    }	
	
	function tarjetasPendientes_persona_abi($funcionario, $paso){
        date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d');
        $actual_mes = date('Y-m');
        $pasada_fecha = date('Y-m-d', strtotime('-14 day'));
        // igual que obtenerPasos
        $query = $this->connect()->query("SELECT COUNT(Monto) as Total FROM Abi WHERE ((Fecha BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59') OR (Fecha_2 BETWEEN '$actual_mes-01 00:00:00' AND '$actual_feha 23:59:59')) AND Estado='PRE-APROBADO' AND Paso='$paso' AND Funcionario LIKE '$funcionario%'");
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
    function obtenerModals_infogas($funcionario){
        date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d');
        $actual_mes = date('Y-m');
        $pasada_fecha = date('Y-m-d', strtotime('-14 day'));
        // igual que obtenerPasos
        $query = $this->connect()->query("SELECT * FROM Infogas WHERE ((Fecha BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59') OR (Fecha_2 BETWEEN '$actual_mes-01 00:00:00' AND '$actual_mes-31 23:59:59')) AND Estado='PRE-APROBADO' AND (Paso='div1' OR Paso='div2' OR Paso='div3' OR Paso='div4' OR Paso='div5' OR Paso='div6') AND Funcionario LIKE '$funcionario%'");
        return $query;
    }
	
    function obtenerModals_plazofijo(){
        date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d');
        $actual_mes = date('Y-m');
        $pasada_fecha = date('Y-m-d', strtotime('-45 day'));
        // igual que obtenerPasos
        $query = $this->connect()->query("SELECT * FROM Plazo_Fijo WHERE ((Fecha BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59') OR (Fecha_2 BETWEEN '$actual_mes-01 00:00:00' AND '$actual_mes-31 23:59:59')) AND (Paso='div1' OR Paso='div2' OR Paso='div3' OR Paso='div4' OR Paso='div5' OR Paso='div6')");
        return $query;
    }

    function obtenerModals_camara(){
        date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d');
        $actual_mes = date('Y-m');
        $pasada_fecha = date('Y-m-d', strtotime('-45 day'));
        // igual que obtenerPasos
        $query = $this->connect()->query("SELECT * FROM Comercio WHERE ((Fecha BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59') OR (Fecha_2 BETWEEN '$actual_mes-01 00:00:00' AND '$actual_mes-31 23:59:59')) AND (Paso='div1' OR Paso='div2' OR Paso='div3' OR Paso='div4' OR Paso='div5' OR Paso='div6')");
        return $query;
    }
	
    function obtenerModals_pdp($funcionario){
        date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d');
        $actual_mes = date('Y-m');
        $pasada_fecha = date('Y-m-d', strtotime('-14 day'));
        // igual que obtenerPasos
        $query = $this->connect()->query("SELECT * FROM Pdp WHERE ((Fecha BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59') OR (Fecha_2 BETWEEN '$actual_mes-01 00:00:00' AND '$actual_mes-31 23:59:59')) AND Estado='PRE-APROBADO' AND (Paso='div1' OR Paso='div2' OR Paso='div3' OR Paso='div4' OR Paso='div5' OR Paso='div6') AND Funcionario LIKE '$funcionario%'");
        return $query;
    }

    function obtenerModals_om($funcionario){
        date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d');
        $actual_mes = date('Y-m');
        $pasada_fecha = date('Y-m-d', strtotime('-14 day'));
        // igual que obtenerPasos
        $query = $this->connect()->query("SELECT * FROM Om WHERE ((Fecha BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59') OR (Fecha_2 BETWEEN '$actual_mes-01 00:00:00' AND '$actual_mes-31 23:59:59')) AND Estado='PRE-APROBADO' AND (Paso='div1' OR Paso='div2' OR Paso='div3' OR Paso='div4' OR Paso='div5' OR Paso='div6') AND Funcionario LIKE '$funcionario%'");
        return $query;
    }
	
    function obtenerModals_credimaq($funcionario){
        date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d');
        $actual_mes = date('Y-m');
        $pasada_fecha = date('Y-m-d', strtotime('-14 day'));
        // igual que obtenerPasos
        $query = $this->connect()->query("SELECT * FROM Credimaq WHERE ((Fecha BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59') OR (Fecha_2 BETWEEN '$actual_mes-01 00:00:00' AND '$actual_mes-31 23:59:59')) AND Estado='PRE-APROBADO' AND (Paso='div1' OR Paso='div2' OR Paso='div3' OR Paso='div4' OR Paso='div5' OR Paso='div6') AND Funcionario LIKE '$funcionario%'");
        return $query;
    }	

    function obtenerModals_abi($funcionario){
        date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d');
        $actual_mes = date('Y-m');
        $pasada_fecha = date('Y-m-d', strtotime('-14 day'));
        // igual que obtenerPasos
        $query = $this->connect()->query("SELECT * FROM Abi WHERE ((Fecha BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59') OR (Fecha_2 BETWEEN '$actual_mes-01 00:00:00' AND '$actual_mes-31 23:59:59')) AND Estado='PRE-APROBADO' AND (Paso='div1' OR Paso='div2' OR Paso='div3' OR Paso='div4' OR Paso='div5' OR Paso='div6') AND Funcionario LIKE '$funcionario%'");
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
	
    function obtenerPreAprobados_por_funcionario($num, $funcionario){
        date_default_timezone_set('America/Lima');
		
		$actual_fecha = date('Y-m-d');
		
		if($num==0){
			$pasada_fecha = $actual_fecha;
        }else{
			if($num==1){
				$pasada_fecha = date('Y-m-d', strtotime('-' . $num . ' day'));
				$actual_fecha = $pasada_fecha;
				
			}else{
				$pasada_fecha = date('Y-m-d', strtotime('-' . $num . ' day'));
			}
		}
		
        $query = $this->connect()->query("SELECT COUNT(DISTINCT Dni) as Total FROM Infogas WHERE (Fecha BETWEEN '$pasada_fecha 00:00:00' AND '$actual_fecha 23:59:59') AND Estado='PRE-APROBADO' AND Funcionario LIKE '$funcionario%'");
        return $query;
    }
	
	function obtenerPreAprobados_por_funcionario_pdp($num, $funcionario){
        date_default_timezone_set('America/Lima');
		
		$actual_fecha = date('Y-m-d');
		
		if($num==0){
			$pasada_fecha = $actual_fecha;
        }else{
			if($num==1){
				$pasada_fecha = date('Y-m-d', strtotime('-' . $num . ' day'));
				$actual_fecha = $pasada_fecha;
				
			}else{
				$pasada_fecha = date('Y-m-d', strtotime('-' . $num . ' day'));
			}
		}
		
        $query = $this->connect()->query("SELECT COUNT(DISTINCT Dni) as Total FROM Pdp WHERE (Fecha BETWEEN '$pasada_fecha 00:00:00' AND '$actual_fecha 23:59:59') AND Estado='PRE-APROBADO' AND Funcionario LIKE '$funcionario%'");
        return $query;
    }
	
	function obtenerPreAprobados_por_funcionario_om($num, $funcionario){
        date_default_timezone_set('America/Lima');
		
		$actual_fecha = date('Y-m-d');
		
		if($num==0){
			$pasada_fecha = $actual_fecha;
        }else{
			if($num==1){
				$pasada_fecha = date('Y-m-d', strtotime('-' . $num . ' day'));
				$actual_fecha = $pasada_fecha;
				
			}else{
				$pasada_fecha = date('Y-m-d', strtotime('-' . $num . ' day'));
			}
		}
		
        $query = $this->connect()->query("SELECT COUNT(DISTINCT Dni) as Total FROM Om WHERE (Fecha BETWEEN '$pasada_fecha 00:00:00' AND '$actual_fecha 23:59:59') AND Estado='PRE-APROBADO' AND Funcionario LIKE '$funcionario%'");
        return $query;
    }
	
	function obtenerPreAprobados_por_funcionario_credimaq($num, $funcionario){
        date_default_timezone_set('America/Lima');
		
		$actual_fecha = date('Y-m-d');
		
		if($num==0){
			$pasada_fecha = $actual_fecha;
        }else{
			if($num==1){
				$pasada_fecha = date('Y-m-d', strtotime('-' . $num . ' day'));
				$actual_fecha = $pasada_fecha;
				
			}else{
				$pasada_fecha = date('Y-m-d', strtotime('-' . $num . ' day'));
			}
		}
		
        $query = $this->connect()->query("SELECT COUNT(DISTINCT Dni) as Total FROM Credimaq WHERE (Fecha BETWEEN '$pasada_fecha 00:00:00' AND '$actual_fecha 23:59:59') AND Estado='PRE-APROBADO' AND Funcionario LIKE '$funcionario%'");
        return $query;
    }	

	function obtenerPreAprobados_por_funcionario_abi($num, $funcionario){
        date_default_timezone_set('America/Lima');
		
		$actual_fecha = date('Y-m-d');
		
		if($num==0){
			$pasada_fecha = $actual_fecha;
        }else{
			if($num==1){
				$pasada_fecha = date('Y-m-d', strtotime('-' . $num . ' day'));
				$actual_fecha = $pasada_fecha;
				
			}else{
				$pasada_fecha = date('Y-m-d', strtotime('-' . $num . ' day'));
			}
		}
		
        $query = $this->connect()->query("SELECT COUNT(DISTINCT Dni) as Total FROM Abi WHERE (Fecha BETWEEN '$pasada_fecha 00:00:00' AND '$actual_fecha 23:59:59') AND Estado='PRE-APROBADO' AND Funcionario LIKE '$funcionario%'");
        return $query;
    }	

    function obtenerPreAprobados_por_funcionario_personas($num, $funcionario){
        date_default_timezone_set('America/Lima');
		
		$actual_fecha = date('Y-m-d');
		
		if($num==0){
			$pasada_fecha = $actual_fecha;
        }else{
			if($num==1){
				$pasada_fecha = date('Y-m-d', strtotime('-' . $num . ' day'));
				$actual_fecha = $pasada_fecha;
				
			}else{
				$pasada_fecha = date('Y-m-d', strtotime('-' . $num . ' day'));
			}
		}
		
        $query = $this->connect()->query("SELECT COUNT(DISTINCT Dni) as Total FROM Persona WHERE (Fecha BETWEEN '$pasada_fecha 00:00:00' AND '$actual_fecha 23:59:59') AND Estado='PRE-APROBADO' AND Funcionario LIKE '$funcionario%'");
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
        $pasada_feha = date('Y-m', strtotime('first day of last month'));
        
        $query = $this->connect()->query("SELECT COUNT(DISTINCT Dni) as Total FROM Persona WHERE (Fecha BETWEEN '$pasada_feha-01 00:00:00' AND '$pasada_feha-31 23:59:59') AND Estado='PRE-APROBADO'");
        return $query;
    }
    
    function obtenerTotalLeads2(){
        $pasada_feha = date('Y-m', strtotime('first day of last month'));
        
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
        
        $query = $this->connect()->query("SELECT SUM(Monto) as Total FROM Agencias WHERE ((Fecha BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59') OR (Fecha BETWEEN '$actual_mes-01 00:00:00' AND '$actual_feha 23:59:59')) AND Paso='$paso' AND (Tarea='prestamo' OR Tarea='') AND (Origen='lsolari@infocore.com.pe' OR Origen='elizabethpatino@gmail.com' OR Origen='infocore@cp' OR Origen='katyapatino@gmail.com')");		
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
        
        $query = $this->connect()->query("SELECT COUNT(Monto) as Total FROM Agencias WHERE ((Fecha BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59') OR (Fecha_2 BETWEEN '$actual_mes-01 00:00:00' AND '$actual_feha 23:59:59')) AND Paso='$paso' AND (Tarea='prestamo' OR Tarea='') AND (Origen='lsolari@infocore.com.pe' OR Origen='elizabethpatino@gmail.com' OR Origen='infocore@cp' OR Origen='katyapatino@gmail.com')");		
		return $query;
	}

	function funnel_agencias_infocore_lista($paso){
		date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d');
        $actual_mes = date('Y-m');
        $pasada_fecha = date('Y-m-d', strtotime('-20 day'));
        
        $query = $this->connect()->query("SELECT * FROM Agencias WHERE ((Fecha BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59') OR (Fecha_2 BETWEEN '$actual_mes-01 00:00:00' AND '$actual_mes-31 23:59:59')) AND Paso='$paso' AND (Tarea='prestamo' OR Tarea='') AND (Origen='lsolari@infocore.com.pe' OR Origen='elizabethpatino@gmail.com' OR Origen='infocore@cp' OR Origen='katyapatino@gmail.com')");		
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

		$query = $this->connect()->query("SELECT COUNT(Monto) as Total FROM Agencias WHERE (Fecha_2 BETWEEN '$mes-01 00:00:00' AND '$mes-31 23:59:59') AND Paso='div6' AND (Origen='lsolari@infocore.com.pe' OR Origen='elizabethpatino@gmail.com' OR Origen='infocore@cp' OR Origen='katyapatino@gmail.com')");
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

		$query = $this->connect()->query("SELECT SUM(Monto) as Total FROM Agencias WHERE (Fecha_2 BETWEEN '$mes-01 00:00:00' AND '$mes-31 23:59:59') AND Paso='div6' AND (Origen='lsolari@infocore.com.pe' OR Origen='elizabethpatino@gmail.com' OR Origen='infocore@cp' OR Origen='katyapatino@gmail.com')");
		return $query;
	}
	
	function desembolsado_infocore_listado($mes){
		date_default_timezone_set('America/Lima');
		if($mes=="actual")
			$mes = date('Y-m');
		if($mes=="pasado")
			$mes = date('Y-m', strtotime('first day of last month'));
			
		$query = $this->connect()->query("SELECT * FROM Agencias WHERE (Fecha_2 BETWEEN '$mes-01 00:00:00' AND '$mes-31 23:59:59') AND Paso='div6' AND (Origen='lsolari@infocore.com.pe' OR Origen='elizabethpatino@gmail.com' OR Origen='infocore@cp' OR Origen='katyapatino@gmail.com')");
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
	
	function funnel_digital_importe_plazofijo($paso, $funcionario){
		date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d');
        $actual_mes = date('Y-m');
        $pasada_fecha = date('Y-m-d', strtotime('-14 day'));
        
        $query = $this->connect()->query("SELECT SUM(Monto) as Total FROM Plazo_Fijo WHERE ((Fecha BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59') OR (Fecha_2 BETWEEN '$actual_mes-01 00:00:00' AND '$actual_mes-31 23:59:59')) AND Paso='$paso' AND Funcionario LIKE '%$funcionario%'");		
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
	
	function funnel_digital_cantidad_plazofijo($paso, $funcionario){
		date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d');
        $actual_mes = date('Y-m');
        $pasada_fecha = date('Y-m-d', strtotime('-14 day'));
        
        $query = $this->connect()->query("SELECT COUNT(Id) as Total FROM Plazo_Fijo WHERE ((Fecha BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59') OR (Fecha_2 BETWEEN '$actual_mes-01 00:00:00' AND '$actual_mes-31 23:59:59')) AND Paso='$paso' AND Funcionario LIKE '%$funcionario%'");		
		return $query;
	}	
	
	function funnel_micro_importe($paso, $funcionario){
		date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d');
        $actual_mes = date('Y-m');
        $pasada_fecha = date('Y-m-d', strtotime('-14 day'));
        
        $query = $this->connect()->query("SELECT SUM(Monto) as Total FROM Infogas WHERE ((Fecha BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59') OR (Fecha_2 BETWEEN '$actual_mes-01 00:00:00' AND '$actual_mes-31 23:59:59')) AND Paso='$paso' AND Funcionario LIKE '%$funcionario%'");		
		return $query;
	}

	function funnel_pdp_importe($paso, $funcionario, $tipo){
		date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d');
        $actual_mes = date('Y-m');
        $pasada_fecha = date('Y-m-d', strtotime('-14 day'));
        
        $query = $this->connect()->query("SELECT SUM(Monto) as Total FROM Pdp WHERE ((Fecha BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59') OR (Fecha_2 BETWEEN '$actual_mes-01 00:00:00' AND '$actual_mes-31 23:59:59')) AND Tipo LIKE '%$tipo%' AND Paso LIKE '%$paso%' AND Funcionario LIKE '%$funcionario%'");		
		return $query;
	}
	
	function funnel_tabla_importe($tabla, $tipo){
		date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d');
        $actual_mes = date('Y-m');
        $pasada_fecha = date('Y-m-d', strtotime('-14 day'));
        
        $query = $this->connect()->query("SELECT SUM(Monto) as Total FROM $tabla WHERE ((Fecha BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59') OR (Fecha_2 BETWEEN '$actual_mes-01 00:00:00' AND '$actual_mes-31 23:59:59')) AND Tipo LIKE '%$tipo%' AND (Paso='div3' or Paso='div4' or Paso='div5' or Paso='div6')");		
		return $query;
	}
	
	function update_infogas_persona($dni, $pregunta1, $pregunta2, $pregunta3, $pregunta4, $pregunta5, $pregunta6, $pregunta7, $pregunta8){
		
		$linea = "UPDATE Infogas SET Pregunta_1='$pregunta1',Pregunta_2='$pregunta2',Pregunta_3='$pregunta3',Pregunta_4='$pregunta4',Pregunta_5='$pregunta5',Pregunta_6='$pregunta6',Pregunta_7='$pregunta7',Pregunta_8='$pregunta8' WHERE Dni='$dni'";
		$query = $this->connect()->prepare($linea);
		$query->execute([]);
	}
	
	function funnel_tabla_cantidad($tabla, $tipo){
		date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d');
        $actual_mes = date('Y-m');
        $pasada_fecha = date('Y-m-d', strtotime('-14 day'));
        
        $query = $this->connect()->query("SELECT COUNT(Monto) as Total FROM $tabla WHERE ((Fecha BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59') OR (Fecha_2 BETWEEN '$actual_mes-01 00:00:00' AND '$actual_mes-31 23:59:59')) AND Tipo LIKE '%$tipo%' AND (Paso='div3' or Paso='div4' or Paso='div5' or Paso='div6')");		
		return $query;
	}
	
	function funnel_pdp_importe_prov($paso, $funcionario, $tabla, $tipo){
		date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d');
        $actual_mes = date('Y-m');
        $pasada_fecha = date('Y-m-d', strtotime('-14 day'));
        
        $query = $this->connect()->query("SELECT SUM(Monto) as Total FROM $tabla WHERE ((Fecha BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59') OR (Fecha_2 BETWEEN '$actual_mes-01 00:00:00' AND '$actual_mes-31 23:59:59')) AND Tipo LIKE '%$tipo%' AND Paso LIKE '%$paso%' AND Funcionario LIKE '%$funcionario%'");		
		return $query;
	}	

	function funnel_pdp_importe_om($paso, $funcionario){
		date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d');
        $actual_mes = date('Y-m');
        $pasada_fecha = date('Y-m-d', strtotime('-14 day'));
        
        $query = $this->connect()->query("SELECT SUM(Monto) as Total FROM Om WHERE ((Fecha BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59') OR (Fecha_2 BETWEEN '$actual_mes-01 00:00:00' AND '$actual_mes-31 23:59:59')) AND Paso='$paso' AND Funcionario LIKE '%$funcionario%'");		
		return $query;
	}
	
	function funnel_pdp_importe_credimaq($paso, $funcionario){
		date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d');
        $actual_mes = date('Y-m');
        $pasada_fecha = date('Y-m-d', strtotime('-14 day'));
        
        $query = $this->connect()->query("SELECT SUM(Monto) as Total FROM Credimaq WHERE ((Fecha BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59') OR (Fecha_2 BETWEEN '$actual_mes-01 00:00:00' AND '$actual_mes-31 23:59:59')) AND Paso='$paso' AND Funcionario LIKE '%$funcionario%'");		
		return $query;
	}	

	function funnel_pdp_importe_abi($paso, $funcionario){
		date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d');
        $actual_mes = date('Y-m');
        $pasada_fecha = date('Y-m-d', strtotime('-14 day'));
        
        $query = $this->connect()->query("SELECT SUM(Monto) as Total FROM Abi WHERE ((Fecha BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59') OR (Fecha_2 BETWEEN '$actual_mes-01 00:00:00' AND '$actual_mes-31 23:59:59')) AND Paso='$paso' AND Funcionario LIKE '%$funcionario%'");		
		return $query;
	}	
	
	function funnel_micro_cantidad($paso, $funcionario){
		date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d');
        $actual_mes = date('Y-m');
        $pasada_fecha = date('Y-m-d', strtotime('-14 day'));
        
        $query = $this->connect()->query("SELECT COUNT(Monto) as Total FROM Infogas WHERE ((Fecha BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59') OR (Fecha_2 BETWEEN '$actual_mes-01 00:00:00' AND '$actual_mes-31 23:59:59')) AND Paso='$paso' AND Funcionario LIKE '%$funcionario%'");		
		return $query;
	}
	
	function funnel_pdp_cantidad($paso, $funcionario, $tipo){
		date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d');
        $actual_mes = date('Y-m');
        $pasada_fecha = date('Y-m-d', strtotime('-14 day'));
        
        $query = $this->connect()->query("SELECT COUNT(Monto) as Total FROM Pdp WHERE ((Fecha BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59') OR (Fecha_2 BETWEEN '$actual_mes-01 00:00:00' AND '$actual_mes-31 23:59:59')) AND Tipo LIKE '%$tipo%' AND Paso LIKE '%$paso%' AND Funcionario LIKE '%$funcionario%'");		
		return $query;
	}
	
	function funnel_pdp_cantidad_prov($paso, $funcionario, $tabla, $tipo){
		date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d');
        $actual_mes = date('Y-m');
        $pasada_fecha = date('Y-m-d', strtotime('-14 day'));
        
        $query = $this->connect()->query("SELECT COUNT(Monto) as Total FROM $tabla WHERE ((Fecha BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59') OR (Fecha_2 BETWEEN '$actual_mes-01 00:00:00' AND '$actual_mes-31 23:59:59')) AND Tipo LIKE '%$tipo%' AND Paso LIKE '%$paso%' AND Funcionario LIKE '%$funcionario%'");		
		return $query;
	}	
	
	function funnel_pdp_cantidad_om($paso, $funcionario){
		date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d');
        $actual_mes = date('Y-m');
        $pasada_fecha = date('Y-m-d', strtotime('-14 day'));
        
        $query = $this->connect()->query("SELECT COUNT(Monto) as Total FROM Om WHERE ((Fecha BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59') OR (Fecha_2 BETWEEN '$actual_mes-01 00:00:00' AND '$actual_mes-31 23:59:59')) AND Paso='$paso' AND Funcionario LIKE '%$funcionario%'");		
		return $query;
	}
	
	function funnel_pdp_cantidad_credimaq($paso, $funcionario){
		date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d');
        $actual_mes = date('Y-m');
        $pasada_fecha = date('Y-m-d', strtotime('-14 day'));
        
        $query = $this->connect()->query("SELECT COUNT(Monto) as Total FROM Credimaq WHERE ((Fecha BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59') OR (Fecha_2 BETWEEN '$actual_mes-01 00:00:00' AND '$actual_mes-31 23:59:59')) AND Paso='$paso' AND Funcionario LIKE '%$funcionario%'");		
		return $query;
	}	

	function funnel_pdp_cantidad_abi($paso, $funcionario){
		date_default_timezone_set('America/Lima');
        $actual_feha = date('Y-m-d');
        $actual_mes = date('Y-m');
        $pasada_fecha = date('Y-m-d', strtotime('-14 day'));
        
        $query = $this->connect()->query("SELECT COUNT(Monto) as Total FROM Abi WHERE ((Fecha BETWEEN '$pasada_fecha 00:00:00' AND '$actual_feha 23:59:59') OR (Fecha_2 BETWEEN '$actual_mes-01 00:00:00' AND '$actual_mes-31 23:59:59')) AND Paso='$paso' AND Funcionario LIKE '%$funcionario%'");		
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
	function activo_funcionario_micro($funcionario)
    {
        $query = $this->connect()->query("SELECT Activo as Activo FROM Micro WHERE Nombre LIKE '%$funcionario%'");
		return $query;
    }
	
	function activo_funcionario_pdp($funcionario)
    {
        $query = $this->connect()->query("SELECT Activo as Activo FROM Pdp_func WHERE Nombre LIKE '%$funcionario%'");
		return $query;
    }
	
	function activo_funcionario_om($funcionario)
    {
        $query = $this->connect()->query("SELECT Activo as Activo FROM Om_func WHERE Nombre LIKE '%$funcionario%'");
		return $query;
    }
	
	function activo_funcionario_credimaq($funcionario)
    {
        $query = $this->connect()->query("SELECT Activo as Activo FROM Credimaq_func WHERE Nombre LIKE '%$funcionario%'");
		return $query;
    }	

	function activo_funcionario_abi($funcionario)
    {
        $query = $this->connect()->query("SELECT Activo as Activo FROM Abi_func WHERE Nombre LIKE '%$funcionario%'");
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
	
    function nuevoRegistroCamara($nombres, $ruc, $celular, $utm, $correo, $funcionario, $cts, $desc_pla, $ahorro_flo, $plazo_fijo, $capital_tra, $desc_doc){

		date_default_timezone_set('America/Lima');
        $fecha = date('"Y/m/d H:i:s"');
		$paso = "div1";

		$linea = "INSERT INTO Comercio (Id, Nombres, Ruc, Celular, Utm, Fecha, Fecha_2, Paso, Correo, Funcionario, Cts, Desc_pla, Ahorro_flo, Plazo_fijo, Capital_tra, Desc_doc) VALUES (NULL, '$nombres','$ruc','$celular','$utm', $fecha, $fecha,'$paso','$correo','$funcionario','$cts', '$desc_pla', '$ahorro_flo', '$plazo_fijo', '$capital_tra', '$desc_doc')";
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
	
    function insertaPrestamo($solicitud, $socio, $nombre, $moneda, $amortizacion, $intereses, $mora, $total, $saldo, $saldo_credito, $dv, $dp, $destino_sbs, $tipo, $descuento_planilla, $situacion, $grupo, $sectorista, $celular, $correo){
		
		date_default_timezone_set('America/Lima');
		$fecha = date('"Y/m/d H:i:s"');
		
		$paso="div0";
		
		if($dv>=1 and $dv<=3)
			$paso="div1";
		if($dv>=4 and $dv<=30)
			$paso="div2";
		if($dv>=31 and $dv<=60)
			$paso="div3";
		if($dv>=61 and $dv<=90)
			$paso="div4";
		if($dv>=91 and $dv<=180)
			$paso="div5";
		if($dv>=181 and $dv<=360)
			$paso="div6";
		if($dv>=361)
			$paso="div7";
		
        $linea = "INSERT INTO Prestamos (Solicitud, Socio, Nombre, Moneda, Amortizacion, Intereses, Mora, Total, Saldo, Saldo_credito, DV, DP, Destino_sbs, Tipo, Descuento_planilla, Situacion, Grupo, Sectorista, Celular, Correo, Fecha, Fecha_2, Paso) VALUES ('$solicitud', '$socio','$nombre','$moneda','" . str_replace(",","",$amortizacion) . "','" . str_replace(",","",$intereses) . "','" . str_replace(",","",$mora) . "','" . str_replace(",","",$total) . "','" . str_replace(",","",$saldo) . "','" . str_replace(",","",$saldo_credito) . "','$dv','$dp','$destino_sbs','$tipo','$descuento_planilla','$situacion','$grupo','$sectorista','$celular','$correo'," . $fecha . "," . $fecha . ",'" . $paso . "')";
		$query = $this->connect()->prepare($linea);
		$query->execute([]);
    }	
	
	function valida_usuario_db($un, $pw){
		$query = $this->connect()->query("SELECT * FROM Usuarios WHERE Usuario='$un' AND Password='$pw'");
		return $query;
	}
	
	function existe_usuario_db($un){
		$query = $this->connect()->query("SELECT * FROM Usuarios WHERE Usuario='$un'");
		return $query;
	}
	
	function existe_password_db($token){
		$query = $this->connect()->query("SELECT * FROM Usuarios WHERE Password='$token'");
		return $query;
	}
	
	function borra_password_db($token){
		$query = $this->connect()->query("DELETE FROM Usuarios WHERE Password='$token'");
		return $query;
	}
	
	function update_password_db($correo, $clave1){
		$query = $this->connect()->query("UPDATE Usuarios Set Password='$clave1' WHERE Usuario='$correo'");
		return $query;
	}

	function nuevo_usuario_db($correo, $token){
			$linea = "INSERT INTO Usuarios (Id, Usuario, Password, Activo) VALUES (NULL, '$correo','$token','S')";
		    $query = $this->connect()->prepare($linea);
			$query->execute([]);	
	}
	
	function imprime_log_pacinet($tipo, $doi, $correo){
		date_default_timezone_set('America/Lima');
		$fecha = date('"Y/m/d H:i:s"');
		
		$linea = "INSERT INTO Pacinet (Id, Tipo, Doi, Usuario, Fecha) VALUES (NULL, '$tipo','$doi','$correo', $fecha)";
		$query = $this->connect()->prepare($linea);
		$query->execute([]);
	}
	
	function getListadoPacinet(){
		$query = $this->connect()->query("SELECT * FROM Pacinet ORDER BY Fecha DESC LIMIT 8");
		return $query;
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
	
	
	function actualiza_registro_persona($tabla, $id){
        date_default_timezone_set('America/Lima');
		$fecha = date('Y-m-d H:i:s');
		
        $linea = "UPDATE $tabla SET Fecha='$fecha', Fecha_2='$fecha', Paso='div1' WHERE Id='$id'";
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
	
	function exporta($demanda)
	{
		$query = $this->connect()->query($demanda);
        return $query;
		
	}
	
	function ejecuta($demanda)
	{
		$query = $this->connect()->query($demanda);
		return $query;
	}
	
	function exportalo_csv($tabla)
	{
		$query = $this->connect()->query("SELECT * FROM " . $tabla);
		return $query;
	}
}

?>	