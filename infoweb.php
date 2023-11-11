<?php

include_once 'mini_test.php';


class ApiInfoweb{
	
	function api_infoweb_3ra_llamada($dni){
	
	//$sueldo = 2500;
	
	$dni = trim($dni);
	if(strlen($dni)==8)
		$tipo = "D";
	else
		$tipo = "R";
		
	$new = new CurlRequest();
	
	$resultado0 = $new ->sendPost_sentinel_score($tipo, $dni);
	$obj0 = json_decode($resultado0);

	$Bancarizado = $obj0->Bancarizado;
	$Scoring = $obj0->Score;
	$NivelRiesgo = $obj0->NivelRiesgo;
	$FlagB12M = $obj0->FlagB12M;
	$CodigoWS = $obj0->CodigoWS;
	
	/*
	if($Scoring>590){
	*/
	$headers =  array(
	 'Content-Type:application/json',
	 'Content-Length: 0'
	);
	

	$curl = curl_init();

	curl_setopt_array($curl, array(
	  CURLOPT_URL => 'https://servicios.infocore.com.pe/ibi/GetJWTValueBegin?pJWTValue=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZFVzdWFyaW8iOjMzNDIsImlzcyI6ImluZm9jb3JlLmNvbS5wZSIsImlkRW1wcmVzYSI6MTM5fQ.EyCZrFCr77JCyhHc4lHLpanqPv9wPGh-K-RIN2RIVGc&dni=' . $dni,
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => '',
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => 'POST',
	  CURLOPT_HTTPHEADER => $headers,
	));

	$response = curl_exec($curl);

	curl_close($curl);
	$obj1 = json_decode($response);
	
	$output = $obj1->resultado;
	
	echo "<input type='hidden' id='token' value='" . $output . "'>";
	echo "<input type='hidden' id='doi' value='" . $dni . "'>";
	echo "<input type='hidden' id='score' value='" . $Scoring . "'>";
	echo "<h3>¿Vive en Lima Metropolitana?" . "<h3><br>";
	echo "<button type='button' class='btn btn-danger' data-dismiss='modal' onclick='no_segunda();'>No</button>   ";
	echo "<button type='button' class='btn btn-success' data-dismiss='modal' onclick='segunda();'>Si</button>";
	
	/*	
	}else{
		
		$resultado_cal="NO CALIFICA - Por score";
		echo "<h3 class='text-danger'>" . $resultado_cal . "</h3>";
		echo "<h3>" . $dni . " Score: " . $Scoring . "<br>(Tiene que se mayor a 590)</h3><br>";
		echo "<a class='btn btn-success' href='pdp'>Volver</a>";
	}
	*/
	
	
	}
	
	
	function api_infoweb_2da_llamada($token, $dni, $Scoring){
		
	if(strlen($dni)==8)
		$tipo = "D";
	else
		$tipo = "R";

	$headers =  array(
	 'Content-Type:application/json',
	 'Content-Length: 0'
	);

	$curl = curl_init();

	curl_setopt_array($curl, array(
	  CURLOPT_URL => 'https://servicios.infocore.com.pe/ibi/GetIbiDataPerson?pJWTValue=' . $token,
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => '',
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => 'POST',
	  CURLOPT_HTTPHEADER => $headers,
	));

	$response = curl_exec($curl);

	curl_close($curl);
	$obj2 = json_decode($response);
	$dosmeses = date('Ym', strtotime('-2 month')); // 202301
	$tresmeses = date('Ym', strtotime('-3 month')); //202212
	
		for ($j = 0; $j <= 23; $j++){
				
			echo eval ("\$ApiRuc_" . $j . "= (isset(\$obj2->listaRecordLaboral[" . $j . "]->ruc)) ? \$obj2->listaRecordLaboral[" . $j . "]->ruc : '';");
			echo eval ("\$ApiDevengue_" . $j . "= (isset(\$obj2->listaRecordLaboral[" . $j . "]->devengue)) ? \$obj2->listaRecordLaboral[" . $j . "]->devengue : '';");
			echo eval ("\$ApiEmpresa_" . $j . "= (isset(\$obj2->listaRecordLaboral[" . $j . "]->empresa)) ? \$obj2->listaRecordLaboral[" . $j . "]->empresa : '';");
			echo eval ("\$ApiCondicion_" . $j . "= (isset(\$obj2->listaRecordLaboral[" . $j . "]->condicion)) ? \$obj2->listaRecordLaboral[" . $j . "]->condicion : '';");
			echo eval ("\$Apip1_" . $j . "= (isset(\$obj2->listaRecordLaboral[" . $j . "]->p1)) ? \$obj2->listaRecordLaboral[" . $j . "]->p1 : 0;");
		}
		
		$continuidad06meses = $ApiCondicion_0 . $ApiCondicion_1 . $ApiCondicion_2 . $ApiCondicion_3;
		$continuidad12meses = $continuidad06meses . $ApiCondicion_4 . $ApiCondicion_5 . $ApiCondicion_6 . $ApiCondicion_7 . $ApiCondicion_8 . $ApiCondicion_9;
		$continuidad24meses = $continuidad12meses . $ApiCondicion_10 . $ApiCondicion_11 . $ApiCondicion_12 . $ApiCondicion_13 . $ApiCondicion_14 . $ApiCondicion_15 . $ApiCondicion_16 . $ApiCondicion_17 . $ApiCondicion_18 . $ApiCondicion_19 . $ApiCondicion_20 . $ApiCondicion_21;
		
		//echo $dni . "<br>";
	
		if($ApiRuc_0!="20111065013")
		{
			$new = new CurlRequest();
			$tipo_ruc = "R";
			$resultado_ruc = $new ->sendPost_sentinel($tipo_ruc, $ApiRuc_0);
			$obj_ruc = json_decode($resultado_ruc);
			
				
			$AnoNac_ruc = $obj_ruc->soafulloutput->InfBas->IniAct;
			$AnoNac_ruc = substr($AnoNac_ruc,0,4);
			$ActEco = $obj_ruc->soafulloutput->InfBas->ActEco;
			$NomLargo_ruc = $obj_ruc->soafulloutput->InfBas->RazSoc . " (" . $ActEco . ")";
			$NomCom = $obj_ruc->soafulloutput->InfBas->NomCom;
			
			if($NomCom=="-")
				$NomCom = $NomLargo_ruc;
			
				for ($i = 0; $i <= 23; $i++) {
					
					echo eval ("\$AnoRuc_" . $i. "= \$obj_ruc->soafulloutput->ConRap->DetSBSMicr[" . $i . "]->ano;");
					echo eval ("\$MesRuc_" . $i. "= \$obj_ruc->soafulloutput->ConRap->DetSBSMicr[" . $i . "]->mes;");
					
					for ($j = 0; $j <= 9; $j++){
						
						echo eval ("\$calificacionRuc_" . $i . "_" . $j . " = (isset(\$obj_ruc->soafulloutput->ConRap->DetSBSMicr[" . $i . "]->Detalle[" . $j . "]->Cal)) ? \$obj_ruc->soafulloutput->ConRap->DetSBSMicr[" . $i . "]->Detalle[" . $j . "]->Cal : '';");
					}
				}
				
				for ($i = 0; $i <= 23; $i++) {
				
					   echo eval ("\$calificacionRuc_" . $i . "=\$calificacionRuc_" . $i . "_0 . \$calificacionRuc_" . $i . "_1 . \$calificacionRuc_" .$i. "_2 . \$calificacionRuc_" .$i. "_3 . \$calificacionRuc_" .$i. "_4 . \$calificacionRuc_" .$i. "_5 . \$calificacionRuc_" .$i. "_6 . \$calificacionRuc_" .$i. "_7 . \$calificacionRuc_" .$i. "_8 . \$calificacionRuc_" .$i. "_9;");
				}
				
				for ($i = 0; $i <= 8; $i++){ // Deudas Impagas de la empresa
					echo eval ("\$DeudaRuc_Imp" . $i . "= (isset(\$obj_ruc->soafulloutput->ConRap->DetVen[0]->DetalleVencidos[" . $i . "]->NomEnt)) ? \$obj_ruc->soafulloutput->ConRap->DetVen[0]->DetalleVencidos[" . $i . "]->NomEnt . ' - S/ ' . number_format(\$obj_ruc->soafulloutput->ConRap->DetVen[0]->DetalleVencidos[" . $i . "]->MontDeu,2) . ' - Dias Vencidos : ' . \$obj_ruc->soafulloutput->ConRap->DetVen[0]->DetalleVencidos[" . $i . "]->DiaVen . '<br>': '';");
				}
				
				$DeuRucImpTotal = $DeudaRuc_Imp0 . $DeudaRuc_Imp1 . $DeudaRuc_Imp2 . $DeudaRuc_Imp3 . $DeudaRuc_Imp4 . $DeudaRuc_Imp5 . $DeudaRuc_Imp6 . $DeudaRuc_Imp7 . $DeudaRuc_Imp8;
				
				
				for ($i = 0; $i <= 8; $i++){ // Deudas Tributarias
					echo eval ("\$DeudaRuc_Trib" . $i . "= (isset(\$obj_ruc->soafulloutput->ConRap->DetVen[1]->DetalleVencidos[" . $i . "]->NomEnt)) ? \$obj_ruc->soafulloutput->ConRap->DetVen[1]->DetalleVencidos[" . $i . "]->NomEnt . ' - S/ ' . number_format(\$obj_ruc->soafulloutput->ConRap->DetVen[1]->DetalleVencidos[" . $i . "]->MontDeu,2) . ' - Dias Vencidos : ' . \$obj_ruc->soafulloutput->ConRap->DetVen[1]->DetalleVencidos[" . $i . "]->DiaVen . '<br>': '';");
				}
				
				$DeuRucTribTotal = $DeudaRuc_Trib0 . $DeudaRuc_Trib1 . $DeudaRuc_Trib2 . $DeudaRuc_Trib3 . $DeudaRuc_Trib4 . $DeudaRuc_Trib5 . $DeudaRuc_Trib6 . $DeudaRuc_Trib7 . $DeudaRuc_Trib8;
				
				
				for ($i = 0; $i <= 8; $i++){ // Deudas Laborales
					echo eval ("\$DeudaRuc_Lab" . $i . "= (isset(\$obj_ruc->soafulloutput->ConRap->DetVen[2]->DetalleVencidos[" . $i . "]->NomEnt)) ? \$obj_ruc->soafulloutput->ConRap->DetVen[2]->DetalleVencidos[" . $i . "]->NomEnt . ' - S/ ' . number_format(\$obj_ruc->soafulloutput->ConRap->DetVen[2]->DetalleVencidos[" . $i . "]->MontDeu,2) . ' - Dias Vencidos : ' . \$obj_ruc->soafulloutput->ConRap->DetVen[2]->DetalleVencidos[" . $i . "]->DiaVen . '<br>': '';");
				}
				
				$DeuRucLaboTotal = $DeudaRuc_Lab0 . $DeudaRuc_Lab1 . $DeudaRuc_Lab2 . $DeudaRuc_Lab3 . $DeudaRuc_Lab4 . $DeudaRuc_Lab5 . $DeudaRuc_Lab6 . $DeudaRuc_Lab7 . $DeudaRuc_Lab8;
				
				for ($i = 0; $i <= 23; $i++) { // 24 meses
				
						$pos1="";$pos2="";$pos3="";$pos4="";$pos5="";$cal="V";
						
						echo eval(htmlspecialchars("\$pos1 = strpos(\$calificacionRuc_" . $i . ",'PER');"));
						echo eval(htmlspecialchars("\$pos2 = strpos(\$calificacionRuc_" . $i . ",'DEF');"));
						echo eval(htmlspecialchars("\$pos3 = strpos(\$calificacionRuc_" . $i . ",'DUD');"));
						echo eval(htmlspecialchars("\$pos4 = strpos(\$calificacionRuc_" . $i . ",'CPP');"));
						echo eval(htmlspecialchars("\$pos5 = strpos(\$calificacionRuc_" . $i . ",'NOR');"));
						
						if($pos1!==FALSE and $cal=="V"){
							echo eval(htmlspecialchars("\$calificacionRuc_" . $i . "='<button type=button class=\"btn btn-dark btn-xs\">PER</button>';"));
							$cal = "F";
						}
						if($pos2!==FALSE and $cal=="V"){
							echo eval(htmlspecialchars("\$calificacionRuc_" . $i . "='<button type=button class=\"btn btn-danger btn-xs\">DEF</button>';"));
							$cal = "F";
						}
						if($pos3!==FALSE and $cal=="V"){
							echo eval(htmlspecialchars("\$calificacionRuc_" . $i . "='<button type=button class=\"btn btn-danger btn-xs\">DUD</button>';"));
							$cal = "F";
						}
						if($pos4!==FALSE and $cal=="V"){
							echo eval(htmlspecialchars("\$calificacionRuc_" . $i . "='<button type=button class=\"btn btn-warning btn-xs\">CPP</button>';"));
							$cal = "F";
						}
						if($pos5!==FALSE and $cal=="V"){
							echo eval(htmlspecialchars("\$calificacionRuc_" . $i . "='<button type=button class=\"btn btn-success btn-xs\">NOR</button>';"));
							$cal = "F";
						}
						if($cal=="V"){
							echo eval(htmlspecialchars("\$calificacionRuc_" . $i . "='<button type=button class=\"btn btn-secondary btn-xs\">SCA</button>';"));
							$cal = "F";
						}
						
				}
			
			
			
			if($ApiRuc_0=="" or $ApiCondicion_0=="C")
			{
				echo "<h3>(Infocore) No presenta información / No labora actualmente en 5ta categoría</h3>" . "<br>";
				
			}
			else
			{
				$descr_trabajo = "";
				
				if($ApiDevengue_0==$dosmeses or $ApiDevengue_0==$tresmeses)
				{
					$descr_trabajo = "Trabaja actualmente<br>";
					
					if($continuidad06meses=="AAAA"){
						$descr_trabajo = "Antigüedad Laboral 6 meses" . "<br>";
					}
					if($continuidad12meses=="AAAAAAAAAA"){
						$descr_trabajo =  "Antigüedad Laboral 12 meses" . "<br>";
					}
					if($continuidad24meses=="AAAAAAAAAAAAAAAAAAAAAA"){
						$descr_trabajo = "Antigüedad Laboral 24 meses<br>";
					}
					
				}
				else
				{
					$descr_trabajo = "No registra trabajo en los últimos meses [" . $ApiDevengue_0 . "]<br>";
				}
				
				$sueldo = ($Apip1_0 * 55 * 0.76);
				
				$datos = $new->traerTasa($Scoring, $sueldo);
				$obj_datos = json_decode($datos);

				$tasa = $obj_datos->tasa;
				$segmento = $obj_datos->segmento;
				$rci = $obj_datos->rci;	
				
				
				$resultado = $new ->sendPost_sentinel($tipo, $dni);
				$obj = json_decode($resultado);

				$Nom = $obj->soafulloutput->InfBas->Nom;
				$ApePat = $obj->soafulloutput->InfBas->ApePat;
				$ApeMat = $obj->soafulloutput->InfBas->ApeMat;
				$AnoNac = $obj->soafulloutput->InfBas->FecNac;
				$AnoNac = substr($AnoNac,0,4);
				$AnoNac = intval($AnoNac);
				$AnoAct = date('Y');
				$AnoAct	= intval($AnoAct);
				$Edad =  $AnoAct - $AnoNac;
				$Sex = $obj->soafulloutput->InfBas->Sex;
				$Sex = substr($Sex, 0, 1);
		
				$NomLargo = $ApePat . " " . $ApeMat . ", " . $Nom;
				

				
				for ($i = 0; $i <= 23; $i++) {
					
					echo eval ("\$Ano_" . $i. "= \$obj->soafulloutput->ConRap->DetSBSMicr[" . $i . "]->ano;");
					echo eval ("\$Mes_" . $i. "= \$obj->soafulloutput->ConRap->DetSBSMicr[" . $i . "]->mes;");
					
					for ($j = 0; $j <= 9; $j++){
						
						echo eval ("\$Deuda_" . $i . "_" . $j . "= (isset(\$obj->soafulloutput->ConRap->DetSBSMicr[" . $i . "]->Detalle[" . $j . "]->SalDeu)) ? \$obj->soafulloutput->ConRap->DetSBSMicr[" . $i . "]->Detalle[" . $j . "]->SalDeu : 0;");
						echo eval ("\$calificacion_" . $i . "_" . $j . " = (isset(\$obj->soafulloutput->ConRap->DetSBSMicr[" . $i . "]->Detalle[" . $j . "]->Cal)) ? \$obj->soafulloutput->ConRap->DetSBSMicr[" . $i . "]->Detalle[" . $j . "]->Cal : '';");
						
						echo eval ("\$calificacion_" . $i . "_" . $j . " = (((\$calificacion_" . $i . "_" . $j . "=='DEF') or (\$calificacion_" . $i . "_" . $j . "=='CPP') or (\$calificacion_" . $i . "_" . $j . "=='DUD') or (\$calificacion_" . $i . "_" . $j . "=='PER')) and (\$obj->soafulloutput->ConRap->DetSBSMicr[" . $i . "]->Detalle[" . $j . "]->SalDeu < 100)) ? 'NOR' : \$calificacion_" . $i . "_" . $j . ";");
						
						echo eval ("\$NomEnt_" . $i . "_" . $j . "= (isset(\$obj->soafulloutput->ConRap->DetSBSMicr[" . $i . "]->Detalle[" . $j . "]->NomEnt)) ? \$obj->soafulloutput->ConRap->DetSBSMicr[" . $i . "]->Detalle[" . $j . "]->NomEnt .' - S/ ' . number_format(\$obj->soafulloutput->ConRap->DetSBSMicr[" . $i . "]->Detalle[" . $j . "]->SalDeu,2) .' - ' . \$obj->soafulloutput->ConRap->DetSBSMicr[" . $i . "]->Detalle[" . $j . "]->Cal . ' - Días Venc: ' . \$obj->soafulloutput->ConRap->DetSBSMicr[" . $i . "]->Detalle[" . $j . "]->DiaVen . '<br>' : '';");
					}
				}
				
				for ($i = 0; $i <= 23; $i++) {
				
					   echo eval ("\$calificacion_" . $i . "=\$calificacion_" . $i . "_0 . \$calificacion_" . $i . "_1 . \$calificacion_" .$i. "_2 . \$calificacion_" .$i. "_3 . \$calificacion_" .$i. "_4 . \$calificacion_" .$i. "_5 . \$calificacion_" .$i. "_6 . \$calificacion_" .$i. "_7 . \$calificacion_" .$i. "_8 . \$calificacion_" .$i. "_9;");
					   echo eval ("\$Deuda_" . $i . "=\$Deuda_" . $i . "_0 + \$Deuda_" . $i . "_1 + \$Deuda_" .$i. "_2 + \$Deuda_" .$i. "_3 + \$Deuda_" .$i. "_4 + \$Deuda_" .$i. "_5 + \$Deuda_" .$i. "_6 + \$Deuda_" .$i. "_7 + \$Deuda_" .$i. "_8 + \$Deuda_" .$i. "_9;");
					   echo eval ("\$NomEnt_" . $i . "=\$NomEnt_" . $i . "_0 . \$NomEnt_" . $i . "_1 . \$NomEnt_" .$i. "_2 . \$NomEnt_" .$i. "_3 . \$NomEnt_" .$i. "_4 . \$NomEnt_" .$i. "_5 . \$NomEnt_" .$i. "_6 . \$NomEnt_" .$i. "_7 . \$NomEnt_" .$i. "_8 . \$NomEnt_" .$i. "_9;");
					  
				}
				
				for ($i = 0; $i <= 23; $i++) {
					echo eval(htmlspecialchars("\$entidades_" . $i . " = (strlen(\$calificacion_" . $i . ")/3);"));
				}
				
				
				$contador_ano1=0;
				$contador_sca_ano1=0;

				for ($i = 0; $i <= 11; $i++) { // Primer 1 año (12 meses)
				
						$pos1="";$pos2="";$pos3="";$pos4="";$pos5="";$cal="V";
						
						echo eval(htmlspecialchars("\$pos1 = strpos(\$calificacion_" . $i . ",'PER');"));
						echo eval(htmlspecialchars("\$pos2 = strpos(\$calificacion_" . $i . ",'DEF');"));
						echo eval(htmlspecialchars("\$pos3 = strpos(\$calificacion_" . $i . ",'DUD');"));
						echo eval(htmlspecialchars("\$pos4 = strpos(\$calificacion_" . $i . ",'CPP');"));
						echo eval(htmlspecialchars("\$pos5 = strpos(\$calificacion_" . $i . ",'NOR');"));
						
						if($pos1!==FALSE and $cal=="V"){
							echo eval(htmlspecialchars("\$calificacion_" . $i . "='<button type=button class=\"btn btn-dark btn-xs\">PER</button>';"));
							$cal = "F";
						}
						if($pos2!==FALSE and $cal=="V"){
							echo eval(htmlspecialchars("\$calificacion_" . $i . "='<button type=button class=\"btn btn-danger btn-xs\">DEF</button>';"));
							$cal = "F";
						}
						if($pos3!==FALSE and $cal=="V"){
							echo eval(htmlspecialchars("\$calificacion_" . $i . "='<button type=button class=\"btn btn-danger btn-xs\">DUD</button>';"));
							$cal = "F";
						}
						if($pos4!==FALSE and $cal=="V"){
							echo eval(htmlspecialchars("\$calificacion_" . $i . "='<button type=button class=\"btn btn-warning btn-xs\">CPP</button>';"));
							$cal = "F";
							$contador_ano1=$contador_ano1 + 0.5;
						}
						if($pos5!==FALSE and $cal=="V"){
							echo eval(htmlspecialchars("\$calificacion_" . $i . "='<button type=button class=\"btn btn-success btn-xs\">NOR</button>';"));
							$cal = "F";
							$contador_ano1++;
						}
						if($cal=="V"){
							echo eval(htmlspecialchars("\$calificacion_" . $i . "='<button type=button class=\"btn btn-secondary btn-xs\">SCA</button>';"));
							$cal = "F";
							$contador_ano1++;
							$contador_sca_ano1++;
						}
						
				}
				
				$contador_ano2=0;
				$contador_sca_ano2=0;
				
				for ($i = 12; $i <= 23; $i++) { // Segundo 2 año (12 meses)
				
						$pos1="";$pos2="";$pos3="";$pos4="";$pos5="";$cal="V";
						
						echo eval(htmlspecialchars("\$pos1 = strpos(\$calificacion_" . $i . ",'PER');"));
						echo eval(htmlspecialchars("\$pos2 = strpos(\$calificacion_" . $i . ",'DEF');"));
						echo eval(htmlspecialchars("\$pos3 = strpos(\$calificacion_" . $i . ",'DUD');"));
						echo eval(htmlspecialchars("\$pos4 = strpos(\$calificacion_" . $i . ",'CPP');"));
						echo eval(htmlspecialchars("\$pos5 = strpos(\$calificacion_" . $i . ",'NOR');"));
						
						if($pos1!==FALSE and $cal=="V"){
							echo eval(htmlspecialchars("\$calificacion_" . $i . "='<button type=button class=\"btn btn-dark btn-xs\">PER</button>';"));
							$cal = "F";
						}
						if($pos2!==FALSE and $cal=="V"){
							echo eval(htmlspecialchars("\$calificacion_" . $i . "='<button type=button class=\"btn btn-danger btn-xs\">DEF</button>';"));
							$cal = "F";
						}
						if($pos3!==FALSE and $cal=="V"){
							echo eval(htmlspecialchars("\$calificacion_" . $i . "='<button type=button class=\"btn btn-danger btn-xs\">DUD</button>';"));
							$cal = "F";
						}
						if($pos4!==FALSE and $cal=="V"){
							echo eval(htmlspecialchars("\$calificacion_" . $i . "='<button type=button class=\"btn btn-warning btn-xs\">CPP</button>';"));
							$cal = "F";
							$contador_ano2=$contador_ano2 + 0.5;
						}
						if($pos5!==FALSE and $cal=="V"){
							echo eval(htmlspecialchars("\$calificacion_" . $i . "='<button type=button class=\"btn btn-success btn-xs\">NOR</button>';"));
							$cal = "F";
							$contador_ano2++;
						}
						if($cal=="V"){
							echo eval(htmlspecialchars("\$calificacion_" . $i . "='<button type=button class=\"btn btn-secondary btn-xs\">SCA</button>';"));
							$cal = "F";
							$contador_ano2++;
							$contador_sca_ano2++;
						}
						
				}
				
				
				for ($i = 0; $i <= 8; $i++){
					
						echo eval ("\$LinApr" . $i . "= (isset(\$obj->soafulloutput->ConRap->UtiLinCre[" . $i . "]->LinApr)) ? \$obj->soafulloutput->ConRap->UtiLinCre[" . $i . "]->LinApr : 0;");
						echo eval ("\$LinUti" . $i . "= (isset(\$obj->soafulloutput->ConRap->UtiLinCre[" . $i . "]->LinUti)) ? \$obj->soafulloutput->ConRap->UtiLinCre[" . $i . "]->LinUti : 0;");
						echo eval ("\$EntTar" . $i . "= (isset(\$obj->soafulloutput->ConRap->UtiLinCre[" . $i . "]->inst)) ? \$obj->soafulloutput->ConRap->UtiLinCre[" . $i . "]->inst . ' - S/ ' . number_format(\$obj->soafulloutput->ConRap->UtiLinCre[" . $i . "]->LinApr,2) . '<br>': '';");
						echo eval ("\$EntUti" . $i . "= (isset(\$obj->soafulloutput->ConRap->UtiLinCre[" . $i . "]->inst)) ? \$obj->soafulloutput->ConRap->UtiLinCre[" . $i . "]->inst . ' - S/ ' . number_format(\$obj->soafulloutput->ConRap->UtiLinCre[" . $i . "]->LinUti,2) . '<br>': '';");
				}
					
				$LinAprTotal = $LinApr0 + $LinApr1 + $LinApr2 + $LinApr3 + $LinApr4 + $LinApr5 + $LinApr6 + $LinApr7 + $LinApr8;
				$LinUtiTotal = $LinUti0 + $LinUti1 + $LinUti2 + $LinUti3 + $LinUti4 + $LinUti5 + $LinUti6 + $LinUti7 + $LinUti8;
				$EntTarTotal = $EntTar0 . $EntTar1 . $EntTar2 . $EntTar3 . $EntTar4 . $EntTar5 . $EntTar6 . $EntTar7 . $EntTar8;
				$EntUtiTotal = $EntUti0 . $EntUti1 . $EntUti2 . $EntUti3 . $EntUti4 . $EntUti5 . $EntUti6 . $EntUti7 . $EntUti8;
				
				$Deuda_impaga = (isset($obj->soafulloutput->ConRap->DetVen[0]->VenTot)) ? $obj->soafulloutput->ConRap->DetVen[0]->VenTot : 0;
				
				for ($i = 0; $i <= 8; $i++){
					echo eval ("\$Deuda_Imp" . $i . "= (isset(\$obj->soafulloutput->ConRap->DetVen[0]->DetalleVencidos[" . $i . "]->NomEnt)) ? \$obj->soafulloutput->ConRap->DetVen[0]->DetalleVencidos[" . $i . "]->NomEnt . ' - S/ ' . number_format(\$obj->soafulloutput->ConRap->DetVen[0]->DetalleVencidos[" . $i . "]->MontDeu,2) . ' - Dias Vencidos : ' . \$obj->soafulloutput->ConRap->DetVen[0]->DetalleVencidos[" . $i . "]->DiaVen . '<br>': '';");
				}
				
				$DeuImpTotal = $Deuda_Imp0 . $Deuda_Imp1 . $Deuda_Imp2 . $Deuda_Imp3 . $Deuda_Imp4 . $Deuda_Imp5 . $Deuda_Imp6 . $Deuda_Imp7 . $Deuda_Imp8;
				
				$tasa_tea=0.45; // TEA
				$cuotas_deuda=24; // cuotas
				//**********************/
				//Convertir tea a temp
				$tem=(pow((1+$tasa_tea),(1/12)))-1;
				
				$k = $Deuda_0;
				$cuota_p = ((((pow((1+$tem),$cuotas_deuda))*$tem)/((pow((1+$tem),$cuotas_deuda))-1)))*$k;
				$sueldo_x_rci = $sueldo*$rci;
				$despues_cuotap = $sueldo_x_rci - $cuota_p;
				
				$rci_score_desc = number_format(($rci*100),0) . "%";
				
				// Cambiar el RCI del PEX //
				$rci_pex = 0.3;
				// Cambiar el RCI del PEX //
				
				$rci_desc = number_format((0.3*100),0) . "%";
				$resultado_cal="NO CALIFICA [PEX] - ";
				$encontrado = "V";
				$cuota = (0.3*$sueldo)-$cuota_p-10;
				$saldo_pagar = (8*$sueldo)-$Deuda_0;
				
				if(($contador_ano1==12 and $contador_sca_ano1==0) or ($contador_ano1>11 and $contador_ano2>11)){
					if($Deuda_impaga>500){
						$resultado_cal=$resultado_cal . "Deuda Impaga mayor a S/ 500 | ";}
					if($entidades_0>4){
						$resultado_cal=$resultado_cal . "5 Entidades | ";}
					if($cuota < 275){
						$resultado_cal=$resultado_cal . "Cuota S/ " . number_format($cuota, 0) . " (menor a S/ 275)";}
					
					
					
				
					if($Deuda_impaga<500 and $cuota>587 and $encontrado=="V" and $entidades_0<5)
					{
						$resultado_cal = "PRE-APROBADO [PLD] - Importe S/ 15,000 | Plazo 36 meses | Cuota mensual aproximada S/ 587.96 | TCEA 24% | RCI " . $rci_desc;
						$encontrado = "F";
					}
					if($Deuda_impaga<500 and $cuota>549 and $encontrado=="V" and $entidades_0<5)
					{
						$resultado_cal = "PRE-APROBADO [PLD] - Importe S/ 14,000 | Plazo 36 meses | Cuota mensual aproximada S/ 549.43 | TCEA 24% | RCI " . $rci_desc;
						$encontrado = "F";
					}
					if($Deuda_impaga<500 and $cuota>510 and $encontrado=="V" and $entidades_0<5)
					{
					   $resultado_cal = "PRE-APROBADO [PLD] - Importe S/ 13,000 | Plazo 36 meses | Cuota mensual aproximada S/ 510.89 | TCEA 24% | RCI " . $rci_desc;
					   $encontrado = "F";
					}
					if($Deuda_impaga<500 and $cuota>472 and $encontrado=="V" and $entidades_0<5)
					{
						$resultado_cal = "PRE-APROBADO [PLD] - Importe S/ 12,000 | Plazo 36 meses | Cuota mensual aproximada S/ 472.36 | TCEA 24% | RCI " . $rci_desc;
						$encontrado = "F";
					}
					if($Deuda_impaga<500 and $cuota>428 and $encontrado=="V" and $entidades_0<5)
					{
						$resultado_cal = "PRE-APROBADO [PLD] - Importe S/ 8,000 | Plazo 24 meses | Cuota mensual aproximada S/ 428.67 | TCEA 24% | RCI " . $rci_desc;
						$encontrado = "F";
					}
					if($Deuda_impaga<500 and $cuota>407 and $encontrado=="V" and $entidades_0<5)
					{
						$resultado_cal = "PRE-APROBADO [PLD] - Importe S/ 6,000 | Plazo 18 meses | Cuota mensual aproximada S/ 407.82 | TCEA 24% | RCI " . $rci_desc;
						$encontrado = "F";
					}
					if($Deuda_impaga<500 and $cuota>341 and $encontrado=="V" and $entidades_0<5)
					{
						$resultado_cal = "PRE-APROBADO [PLD] - Importe S/ 5,000 | Plazo 18 meses | Cuota mensual aproximada S/ 341.52 | TCEA 24% | RCI " . $rci_desc;
						$encontrado = "F";
					}
					if($Deuda_impaga<500 and $cuota>275 and $encontrado=="V" and $entidades_0<5)
					{
						$resultado_cal = "PRE-APROBADO [PLD] - Importe S/ 4,000 | Plazo 18 meses | Cuota mensual aproximada S/ 275.22 | TCEA 24% | RCI " . $rci_desc;
						$encontrado = "F";
					}
				
				}else{
					$resultado_cal="NO CALIFICA [PEX] - Mala calificacion";
				}
				
				
				$resultado_cal_exp="";
				$encontrado_exp = "V";
				
				
				if($saldo_pagar >= 15000 and $encontrado_exp=="V")
				{
					$resultado_cal_exp = "PRE-APROBADO [EXPRESS] - Importe S/ 15,000 | Plazo 48 meses | Cuota mensual aproximada S/ 658 | TCEA 50% ";
					$encontrado_exp = "F";

				}
				
				if(($saldo_pagar >= 14000 and $saldo_pagar < 15000) and $encontrado_exp=="V")
				{
					$resultado_cal_exp = "PRE-APROBADO [EXPRESS] - Importe S/ 14,000 | Plazo 48 meses | Cuota mensual aproximada S/ 614 | TCEA 50% ";
					$encontrado_exp = "F";

				}
				
				if(($saldo_pagar >= 13000 and $saldo_pagar < 14000) and $encontrado_exp=="V")
				{
					$resultado_cal_exp = "PRE-APROBADO [EXPRESS] - Importe S/ 13,000 | Plazo 48 meses | Cuota mensual aproximada S/ 570 | TCEA 50% ";
					$encontrado_exp = "F";

				}
						
				if(($saldo_pagar >= 12000 and $saldo_pagar < 13000) and $encontrado_exp=="V")
				{
					$resultado_cal_exp = "PRE-APROBADO [EXPRESS] - Importe S/ 12,000 | Plazo 48 meses | Cuota mensual aproximada S/ 526 | TCEA 50% ";
					$encontrado_exp = "F";
				}
				
				if(($saldo_pagar >= 11000 and $saldo_pagar < 12000) and $encontrado_exp=="V")
				{
					$resultado_cal_exp = "PRE-APROBADO [EXPRESS] - Importe S/ 11,000 | Plazo 48 meses | Cuota mensual aproximada S/ 483 | TCEA 50% ";
					$encontrado_exp = "F";
				}
				
				if(($saldo_pagar >= 10000 and $saldo_pagar < 11000) and $encontrado_exp=="V")
				{
					$resultado_cal_exp = "PRE-APROBADO [EXPRESS] - Importe S/ 10,000 | Plazo 48 meses | Cuota mensual aproximada S/ 439 | TCEA 50% ";
					$encontrado_exp = "F";
				}
				
				if(($saldo_pagar >= 9000 and $saldo_pagar < 10000) and $encontrado_exp=="V")
				{
					$resultado_cal_exp = "PRE-APROBADO [EXPRESS] - Importe S/ 9,000 | Plazo 48 meses | Cuota mensual aproximada S/ 395 | TCEA 50% ";
					$encontrado_exp = "F";
				}
				
				if(($saldo_pagar >= 8000 and $saldo_pagar < 9000) and $encontrado_exp=="V")
				{
					$resultado_cal_exp = "PRE-APROBADO [EXPRESS] - Importe S/ 8,000 | Plazo 48 meses | Cuota mensual aproximada S/ 351 | TCEA 50% ";
					$encontrado_exp = "F";

				}
				
				if(($saldo_pagar >= 7000 and $saldo_pagar < 8000) and $encontrado_exp=="V")
				{
					$resultado_cal_exp = "PRE-APROBADO [EXPRESS] - Importe S/ 7,000 | Plazo 48 meses | Cuota mensual aproximada S/ 307 | TCEA 50% ";
					$encontrado_exp = "F";

				}
				
				if(($saldo_pagar >= 6000 and $saldo_pagar < 7000) and $encontrado_exp=="V")
				{
					$resultado_cal_exp = "PRE-APROBADO [EXPRESS] - Importe S/ 6,000 | Plazo 48 meses | Cuota mensual aproximada S/ 263 | TCEA 50% ";
					$encontrado_exp = "F";

				}
				
				if(($saldo_pagar >= 5000 and $saldo_pagar < 6000) and $encontrado_exp=="V")
				{
					$resultado_cal_exp = "PRE-APROBADO [EXPRESS] - Importe S/ 5,000 | Plazo 48 meses | Cuota mensual aproximada S/ 219 | TCEA 50% ";
					$encontrado_exp = "F";

				}
				
				if(($saldo_pagar >= 4000 and $saldo_pagar < 5000) and $encontrado_exp=="V")
				{
					$resultado_cal_exp = "PRE-APROBADO [EXPRESS] - Importe S/ 4,000 | Plazo 48 meses | Cuota mensual aproximada S/ 175 | TCEA 50% ";
					$encontrado_exp = "F";

				}
				
				if($encontrado_exp=="V" or $Deuda_impaga>499 or $entidades_0>5)
				{
					$resultado_cal_exp = "NO CALIFICA [EXPRESS]";
				}
				
				$descr_prestamo_scoring = "";
				//Convertir tea a temp
				$tem_pf=(pow((1+$tasa),(1/12)))-1;
				$cuotas_18 = 18;
				$cuotas_24 = 24;
				$cuotas_36 = 36;
				$prestamo_final_18 = $despues_cuotap/(((((pow((1+$tem_pf),$cuotas_18))*$tem_pf)/((pow((1+$tem_pf),$cuotas_18))-1))));
				$prestamo_final_24 = $despues_cuotap/(((((pow((1+$tem_pf),$cuotas_24))*$tem_pf)/((pow((1+$tem_pf),$cuotas_24))-1))));
				$prestamo_final_36 = $despues_cuotap/(((((pow((1+$tem_pf),$cuotas_36))*$tem_pf)/((pow((1+$tem_pf),$cuotas_36))-1))));
				
				$tasa_desc = number_format($tasa*100, 0) . "%";
				
				if($Scoring>449)
				{
					if($prestamo_final_18>0)
						$descr_prestamo_scoring = "PRE-APROBADO [SCORING] - Importe S/ " . number_format($prestamo_final_18,0) . " | Plazo 18 meses | Cuota mensual aproximada: S/ " . number_format($despues_cuotap, 2) . " | TCEA " . $tasa_desc . " | RCI " . $rci_score_desc;
					if($prestamo_final_24>0)
						$descr_prestamo_scoring = "PRE-APROBADO [SCORING] - Importe S/ " . number_format($prestamo_final_24,0) . " | Plazo 24 meses | Cuota mensual aproximada: S/ " . number_format($despues_cuotap, 2) . " | TCEA " . $tasa_desc . " | RCI " . $rci_score_desc;
					if($prestamo_final_36>0)
						$descr_prestamo_scoring = "PRE-APROBADO [SCORING] - Importe S/ " . number_format($prestamo_final_36, 0) . " | Plazo 36 meses | Cuota mensual aproximada: S/ " . number_format($despues_cuotap, 2) . " | TCEA " . $tasa_desc . " | RCI " . $rci_score_desc;
				}
				else
				{
						$descr_prestamo_scoring = "NO CALIFICA [SCORING] - Scoring menor a 450";
				}
				
				
				echo "<table class='table table-responsive table-striped text-center'>";
				echo "<thead>";
				echo "<tr>";
				echo "<th colspan='3' class='text-center'><h3>[" . $dni . "] - (" . $Sex . ") " . $NomLargo . " (" . $Edad . " años) Score: " . $Scoring . " " . $calificacion_0 . "</h3></th>";
				echo "</tr>";
				echo "</thead>";
				echo "</table>";
				
				echo "<div class='container'>";
				echo "<div class='row'>";
				echo "<div class='col-sm'>"; // Primer div inicio
				
				echo "<table class='table table-responsive'>"; // Inico de tabla 1
				echo "<tr class='bg-secondary'>";
				echo "<th class='text-center'>6m</th><th class='text-center'>12m</th><th class='text-center'>18m</th><th class='text-center'>24m</th>";
				echo "</tr>";
				echo "<tr>";
				echo "<td>" . $calificacion_0 . "</td><td>" . $calificacion_6 . "</td><td>" . $calificacion_12 . "</td><td>" . $calificacion_18 . "</td>";
				echo "</tr>";
				
				echo "<tr>";
				echo "<td>" . $calificacion_1 . "</td><td>" . $calificacion_7 . "</td><td>" . $calificacion_13 . "</td><td>" . $calificacion_19 . "</td>";
				echo "</tr>";
				
				echo "<tr>";
				echo "<td>" . $calificacion_2 . "</td><td>" . $calificacion_8 . "</td><td>" . $calificacion_14 . "</td><td>" . $calificacion_20 . "</td>";
				echo "</tr>";
				
				echo "<tr>";
				echo "<td>" . $calificacion_3 . "</td><td>" . $calificacion_9 . "</td><td>" . $calificacion_15 . "</td><td>" . $calificacion_21 . "</td>";
				echo "</tr>";
				
				echo "<tr>";
				echo "<td>" . $calificacion_4 . "</td><td>" . $calificacion_10 . "</td><td>" . $calificacion_16 . "</td><td>" . $calificacion_22 . "</td>";
				echo "</tr>";
				
				echo "<tr>";
				echo "<td>" . $calificacion_5 . "</td><td>" . $calificacion_11 . "</td><td>" . $calificacion_17 . "</td><td>" . $calificacion_23 . "</td>";
				echo "</tr>";
				
				echo "</table>"; // Fin de tabla 1
				
				echo "</div>"; // Fin de primer div
				
				echo "<div class='col-sm'>"; // Inicio de segundo div
				
				echo "<table class='table table-responsive'>"; // Inico de tabla 2
				echo "<tr class='bg-secondary'>";
				echo "<th class='text-center 'colspan='4' rowspan='7'><h4><b>Sueldo Neto S/ " . number_format($sueldo, 0) . " - trabaja en: " . $NomCom . " - " . $descr_trabajo . "</b><br><b>Deuda en el sistema: S/ " . number_format($Deuda_0, 0) . " Cuota castigada (TEA 45% / Plazo 24m) => S/ " . number_format($cuota_p, 0) . " - Entidades (" . $entidades_0 . ")</b><br>" . $NomEnt_0 . "<br>";
				echo "<b>Tarjetas de crédito Línea Total : S/ " . number_format($LinAprTotal, 0) . "</b><br>";
				echo $EntTarTotal . "<br>";
				echo "<b>Tarjetas de crédito Línea Utilizada S/ " . number_format($LinUtiTotal, 0) . "</b><br>";
				echo $EntUtiTotal . "<br>";

				echo "<b>Deudas Impagas: S/ " . number_format($Deuda_impaga, 0) . "</b>";
				echo "<br>" . $DeuImpTotal . "</h4></ th>";
				echo "</tr>";
				echo "</table>"; // Fin de tabla 2
				
				echo "</div>"; // Fin de segundi div
				
				echo "<div class='col-sm'>"; // Inicio de tercer div
				
				echo "<table class='table table-responsive'>"; // Inico de tabla 3
				echo "<tr class='bg-secondary'>";
				echo "<th class='text-center' colspan='4'>[" . $ApiRuc_0 . "] - " . $NomLargo_ruc . " (" . $AnoNac_ruc . ")</th>";
				echo "</tr>";
				
				echo "<tr class='bg-secondary'>";
				echo "<th class='text-center text-danger' colspan='4'>" . $DeuRucImpTotal . "<br>" . $DeuRucTribTotal . "<br>" . $DeuRucLaboTotal . "</th>";
				echo "</tr>";
				
				echo "<tr class='bg-secondary'>";
				echo "<th class='text-center'>6m</th><th class='text-center'>12m</th><th class='text-center'>18m</th><th class='text-center'>24m</th>";
				echo "</tr>";
				
				echo "<tr>";
				echo "<td>" . $calificacionRuc_0 . "</td><td>" . $calificacionRuc_6 . "</td><td>" . $calificacionRuc_12 . "</td><td>" . $calificacionRuc_18 . "</td>";
				echo "</tr>";
				
				echo "<tr>";
				echo "<td>" . $calificacionRuc_1 . "</td><td>" . $calificacionRuc_7 . "</td><td>" . $calificacionRuc_13 . "</td><td>" . $calificacionRuc_19 . "</td>";
				echo "</tr>";
				
				echo "<tr>";
				echo "<td>" . $calificacionRuc_2 . "</td><td>" . $calificacionRuc_8 . "</td><td>" . $calificacionRuc_14 . "</td><td>" . $calificacionRuc_20 . "</td>";
				echo "</tr>";
				
				echo "<tr>";
				echo "<td>" . $calificacionRuc_3 . "</td><td>" . $calificacionRuc_9 . "</td><td>" . $calificacionRuc_15 . "</td><td>" . $calificacionRuc_21 . "</td>";
				echo "</tr>";
				
				echo "<tr>";
				echo "<td>" . $calificacionRuc_4 . "</td><td>" . $calificacionRuc_10 . "</td><td>" . $calificacionRuc_16 . "</td><td>" . $calificacionRuc_22 . "</td>";
				echo "</tr>";
				
				echo "<tr>";
				echo "<td>" . $calificacionRuc_5 . "</td><td>" . $calificacionRuc_11 . "</td><td>" . $calificacionRuc_17 . "</td><td>" . $calificacionRuc_23 . "</td>";
				echo "</tr>";
				
				echo "</table>"; // Fin de tabla 3
				
				echo "</div>"; // Fini de tercer div
				echo "</div>";
				echo "</div>";
    
				echo "<div class='container'>";
				echo "<div class='row'>";
				
				echo "<div class='col-sm' border='1'>";
				echo "<h4>" . $resultado_cal . "</h4>";
				echo "</div>";
			    echo "<div class='col-sm'>";
				echo "<h4>" . $resultado_cal_exp . "</h4>";
				echo "</div>";
			    echo "<div class='col-sm'>";
				echo "<h4>" . $descr_prestamo_scoring . "</h4>";
				echo "</div>";
				
				echo "</div>";
				echo "</div>";
		}
	
	
		
		}else{
			echo "Restringido - Colaborador Cooperativa Pacifico" . "<br>";	
		}
		
		echo "<a class='btn btn-success' href='pdp'>Volver</a><br>";
	}
	
	function api_infoweb_1ra_llamada($dni){

	$headers =  array(
	 'Content-Type:application/json',
	 'Content-Length: 0'
	);
	

	$curl = curl_init();

	curl_setopt_array($curl, array(
	  CURLOPT_URL => 'https://servicios.infocore.com.pe/ibi/GetJWTValueBegin?pJWTValue=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZFVzdWFyaW8iOjMzNDIsImlzcyI6ImluZm9jb3JlLmNvbS5wZSIsImlkRW1wcmVzYSI6MTM5fQ.EyCZrFCr77JCyhHc4lHLpanqPv9wPGh-K-RIN2RIVGc&dni=' . $dni,
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => '',
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => 'POST',
	  CURLOPT_HTTPHEADER => $headers,
	));

	$response = curl_exec($curl);

	curl_close($curl);
	$obj1 = json_decode($response);
	
	$output = $obj1->resultado;
	echo "<input type='hidden' id='token' value='" . $output . "'>";
	echo "<input type='hidden' id='doi' value='" . $dni . "'>";

	}
	
	



}

?>