<?php
session_start();
include_once 'apipersonas.php';
include_once 'test.php';

	$api = new ApiPersonas();
	$new = new CurlRequest();
 
    $dni = $_REQUEST["dni"];
    $nombres = $_REQUEST["nombres"];
	$nombres = strtoupper($nombres);
    $monto = $_REQUEST["monto"];
	$cuotas = $_REQUEST["cuotas"];
    $moneda = $_REQUEST["moneda"];
	$fec_desembolso = $_REQUEST["fec_desembolso"];
	$observaciones = $_REQUEST["observaciones"];
	$origen = $_REQUEST["origen"];
	$tipo = $_REQUEST["tipo"];
	$urgente = $_REQUEST["urgente"];
	
	$api->tarjetasPendientes_sandbox_agencias('Gabriela'); 
	$gabriela = $_SESSION["Gabriela"];
	
	$api->tarjetasPendientes_sandbox_agencias('Cinthia');
	$cinthia = $_SESSION["Cinthia"];
	
	$api->tarjetasPendientes_sandbox_agencias('Dayssy');
	$dayssy = $_SESSION["Dayssy"];

	$api->tarjetasPendientes_sandbox_agencias('Samantha');
	$samantha = $_SESSION["Samantha"];

	$api->tarjetasPendientes_sandbox_agencias('Daniel');
	$daniel = $_SESSION["Daniel"];
	
	$api->tarjetasPendientes_sandbox_agencias('Christian');
	$christian = $_SESSION["Christian"];
	
	$api->tarjetasPendientes_sandbox_agencias('Giancarlo');
	$giancarlo = $_SESSION["Giancarlo"];
	
	$menor = 15000;
	$funcionario = "";
	
	if($origen=='lsolari@infocore.com.pe' OR $origen=='elizabethpatino@gmail.com' OR $origen=='infocore@cp' OR $origen=='katyapatino@gmail.com')
	{
		if($menor>$gabriela){
			$menor = $gabriela;
			$funcionario = "Gabriela";
			$correo = "gabriela.toyosato@cp.com.pe";
		}
		if($menor>$cinthia){
			$menor = $cinthia;
			$funcionario = "Cinthia";
			$correo = "cinthia.llanos@cp.com.pe";
		}
	
	}else{
		
		if($origen=='giancarlo.paredes@cp.com.pe')
		{
			if($menor>$giancarlo){
			$menor = $giancarlo;
			$funcionario = "Giancarlo";
			$correo = "giancarlo.paredes@cp.com.pe";
			}
			
		}
		else
		{
		
		
			if($menor>$dayssy){
				$menor = $dayssy;
				$funcionario = "Dayssy";
				$correo = "dayssy.arias@cp.com.pe";
			}
			if($menor>$samantha){
				$menor = $samantha;
				$funcionario = "Samantha";
				$correo = "samantha.portilla@cp.com.pe";
			}
			if($menor>$daniel){
				$menor = $daniel;
				$funcionario = "Daniel";
				$correo = "daniel.porras@cp.com.pe";
			}
			if($menor>$christian){
				$menor = $christian;
				$funcionario = "Christian";
				$correo = "christian.jaimes@cp.com.pe";
			}
			if($menor>$gabriela){
				$menor = $gabriela;
				$funcionario = "Gabriela";
				$correo = "gabriela.toyosato@cp.com.pe";
			}
			if($menor>$cinthia){
				$menor = $cinthia;
				$funcionario = "Cinthia";
				$correo = "cinthia.llanos@cp.com.pe";
			}
		}
	}	

	
	$ruta = "---";

			$item = array(
					'dni' => $dni,
					'nombres' => $nombres,
					'monto' => $monto,
					'cuotas' => $cuotas,
					'moneda' => $moneda,
					'fec_desembolso' => $fec_desembolso,
					'observaciones' => $observaciones,
					'origen' => $origen,
					'funcionario' => $funcionario,
					'ruta' => $ruta,
					'tipo' => $tipo,
					'urgente' => $urgente,
				);
				$api->add_Agencias($item);

	$resultado = $new ->sendPost_email_agencias($dni, $nombres, $monto, $cuotas, $moneda, $fec_desembolso, $observaciones, $funcionario, $origen, $correo);
	
				exit();	

?>




