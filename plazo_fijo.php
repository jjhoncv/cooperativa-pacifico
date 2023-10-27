<?php
session_start();
include_once 'test.php';
include_once 'apipersonas.php';

	$api = new ApiPersonas();

    $dni = htmlspecialchars($_POST["dni"]);
    $celular = htmlspecialchars($_POST["celular"]);
    $correo = htmlspecialchars($_POST["correo"]);
	$socio = htmlspecialchars($_POST["socio"]);
	$utm = htmlspecialchars($_POST["utm_source"]);

    $saldo_pagar = 0;
    $encontrado = "V";
    $celular = "51" . $celular;

	    
    $new = new CurlRequest();
    $resultado = $new ->sendPost_sentinel("D", $dni);
    $obj = json_decode($resultado);
    
    $Nom = $obj->soafulloutput->InfBas->Nom;
    $ApePat = $obj->soafulloutput->InfBas->ApePat;
    $ApeMat = $obj->soafulloutput->InfBas->ApeMat;
    $Sex = $obj->soafulloutput->InfBas->Sex;
    $AnoNac = $obj->soafulloutput->InfBas->FecNac;
    $AnoNac = substr($AnoNac,0,4);
	$AnoNac = intval($AnoNac);
	$AnoAct = date('Y');
	$edad = $AnoAct - $AnoNac;
    $nombre_largo = $ApePat . " " . $ApeMat . ", " . $Nom;
	
	date_default_timezone_set('America/Lima');
    
    for ($i = 0; $i <= 23; $i++) {
        
        echo eval ("\$Ano_" . $i. "= \$obj->soafulloutput->ConRap->DetSBSMicr[" . $i . "]->ano;");
        echo eval ("\$Mes_" . $i. "= \$obj->soafulloutput->ConRap->DetSBSMicr[" . $i . "]->mes;");
        
        for ($j = 0; $j <= 9; $j++){
            
            echo eval ("\$Deuda_" . $i . "_" . $j . "= (isset(\$obj->soafulloutput->ConRap->DetSBSMicr[" . $i . "]->Detalle[" . $j . "]->SalDeu)) ? \$obj->soafulloutput->ConRap->DetSBSMicr[" . $i . "]->Detalle[" . $j . "]->SalDeu : 0;");
            echo eval ("\$calificacion_" . $i . "_" . $j . " = (isset(\$obj->soafulloutput->ConRap->DetSBSMicr[" . $i . "]->Detalle[" . $j . "]->Cal)) ? \$obj->soafulloutput->ConRap->DetSBSMicr[" . $i . "]->Detalle[" . $j . "]->Cal : '';");
			echo eval ("\$calificacion_" . $i . "_" . $j . " = (((\$calificacion_" . $i . "_" . $j . "=='DEF') or (\$calificacion_" . $i . "_" . $j . "=='CPP') or (\$calificacion_" . $i . "_" . $j . "=='DUD') or (\$calificacion_" . $i . "_" . $j . "=='PER')) and (\$obj->soafulloutput->ConRap->DetSBSMicr[" . $i . "]->Detalle[" . $j . "]->SalDeu < 100)) ? 'NOR' : \$calificacion_" . $i . "_" . $j . ";");
        }
    }
    
    for ($i = 0; $i <= 23; $i++) {
    
           echo eval ("\$calificacion_" . $i . "=\$calificacion_" . $i . "_0 . \$calificacion_" . $i . "_1 . \$calificacion_" .$i. "_2 . \$calificacion_" .$i. "_3 . \$calificacion_" .$i. "_4 . \$calificacion_" .$i. "_5 . \$calificacion_" .$i. "_6 . \$calificacion_" .$i. "_7 . \$calificacion_" .$i. "_8 . \$calificacion_" .$i. "_9;");
           echo eval ("\$Deuda_" . $i . "=\$Deuda_" . $i . "_0 + \$Deuda_" . $i . "_1 + \$Deuda_" .$i. "_2 + \$Deuda_" .$i. "_3 + \$Deuda_" .$i. "_4 + \$Deuda_" .$i. "_5 + \$Deuda_" .$i. "_6 + \$Deuda_" .$i. "_7 + \$Deuda_" .$i. "_8 + \$Deuda_" .$i. "_9;");
    }
	
	for ($i = 0; $i <= 23; $i++) {
		echo eval("\$entidades_" . $i . " = (strlen(\$calificacion_" . $i . ")/3);");
	}
	
	for ($i = 0; $i <= 11; $i++) { // Primer 1 año (12 meses)
	
			$pos1="";$pos2="";$pos3="";$pos4="";$pos5="";$cal="V";
			
			echo eval("\$pos1 = strpos(\$calificacion_" . $i . ",'PER');");
			echo eval("\$pos2 = strpos(\$calificacion_" . $i . ",'DEF');");
			echo eval("\$pos3 = strpos(\$calificacion_" . $i . ",'DUD');");
			echo eval("\$pos4 = strpos(\$calificacion_" . $i . ",'CPP');");
			echo eval("\$pos5 = strpos(\$calificacion_" . $i . ",'NOR');");
			
			if($pos1!==FALSE and $cal=="V"){
				echo eval("\$calificacion_" . $i . "='PER';");
				$cal = "F";
			}
			if($pos2!==FALSE and $cal=="V"){
				echo eval("\$calificacion_" . $i . "='DEF';");
				$cal = "F";
			}
			if($pos3!==FALSE and $cal=="V"){
				echo eval("\$calificacion_" . $i . "='DUD';");
				$cal = "F";
			}
			if($pos4!==FALSE and $cal=="V"){
				echo eval("\$calificacion_" . $i . "='CPP';");
				$cal = "F";
			}
			if($pos5!==FALSE and $cal=="V"){
				echo eval("\$calificacion_" . $i . "='NOR';");
				$cal = "F";
			}
			if($cal=="V"){
				echo eval("\$calificacion_" . $i . "='SCA';");
				$cal = "F";
			}
			
	}
	
	for ($i = 12; $i <= 23; $i++) { // Segundo 2 año (12 meses)
	
			$pos1="";$pos2="";$pos3="";$pos4="";$pos5="";$cal="V";
			
			echo eval("\$pos1 = strpos(\$calificacion_" . $i . ",'PER');");
			echo eval("\$pos2 = strpos(\$calificacion_" . $i . ",'DEF');");
			echo eval("\$pos3 = strpos(\$calificacion_" . $i . ",'DUD');");
			echo eval("\$pos4 = strpos(\$calificacion_" . $i . ",'CPP');");
			echo eval("\$pos5 = strpos(\$calificacion_" . $i . ",'NOR');");
			
			if($pos1!==FALSE and $cal=="V"){
				echo eval("\$calificacion_" . $i . "='PER';");
				$cal = "F";
			}
			if($pos2!==FALSE and $cal=="V"){
				echo eval("\$calificacion_" . $i . "='DEF';");
				$cal = "F";
			}
			if($pos3!==FALSE and $cal=="V"){
				echo eval("\$calificacion_" . $i . "='DUD';");
				$cal = "F";
			}
			if($pos4!==FALSE and $cal=="V"){
				echo eval("\$calificacion_" . $i . "='CPP';");
				$cal = "F";
			}
			if($pos5!==FALSE and $cal=="V"){
				echo eval("\$calificacion_" . $i . "='NOR';");
				$cal = "F";
			}
			if($cal=="V"){
				echo eval("\$calificacion_" . $i . "='SCA';");
				$cal = "F";
			}
			
	}
    
    $LinApr1 = (isset($obj->soafulloutput->ConRap->UtiLinCre[0]->LinApr)) ? $obj->soafulloutput->ConRap->UtiLinCre[0]->LinApr : 0;
    $LinApr2 = (isset($obj->soafulloutput->ConRap->UtiLinCre[1]->LinApr)) ? $obj->soafulloutput->ConRap->UtiLinCre[1]->LinApr : 0;
    $LinApr3 = (isset($obj->soafulloutput->ConRap->UtiLinCre[2]->LinApr)) ? $obj->soafulloutput->ConRap->UtiLinCre[2]->LinApr : 0;
    $LinApr4 = (isset($obj->soafulloutput->ConRap->UtiLinCre[3]->LinApr)) ? $obj->soafulloutput->ConRap->UtiLinCre[3]->LinApr : 0;
    $LinApr5 = (isset($obj->soafulloutput->ConRap->UtiLinCre[4]->LinApr)) ? $obj->soafulloutput->ConRap->UtiLinCre[4]->LinApr : 0;
    $LinApr6 = (isset($obj->soafulloutput->ConRap->UtiLinCre[5]->LinApr)) ? $obj->soafulloutput->ConRap->UtiLinCre[5]->LinApr : 0;
    $LinApr7 = (isset($obj->soafulloutput->ConRap->UtiLinCre[6]->LinApr)) ? $obj->soafulloutput->ConRap->UtiLinCre[6]->LinApr : 0;
    $LinApr8 = (isset($obj->soafulloutput->ConRap->UtiLinCre[7]->LinApr)) ? $obj->soafulloutput->ConRap->UtiLinCre[7]->LinApr : 0;
    $LinApr9 = (isset($obj->soafulloutput->ConRap->UtiLinCre[8]->LinApr)) ? $obj->soafulloutput->ConRap->UtiLinCre[8]->LinApr : 0;
    
    $LinAprTotal = $LinApr1 + $LinApr2 + $LinApr3 + $LinApr4 + $LinApr5 + $LinApr6 + $LinApr7 + $LinApr8 + $LinApr9;
    
    $LinUti1 = (isset($obj->soafulloutput->ConRap->UtiLinCre[0]->LinUti)) ? $obj->soafulloutput->ConRap->UtiLinCre[0]->LinUti : 0;
    $LinUti2 = (isset($obj->soafulloutput->ConRap->UtiLinCre[1]->LinUti)) ? $obj->soafulloutput->ConRap->UtiLinCre[1]->LinUti : 0;
    $LinUti3 = (isset($obj->soafulloutput->ConRap->UtiLinCre[2]->LinUti)) ? $obj->soafulloutput->ConRap->UtiLinCre[2]->LinUti : 0;
    $LinUti4 = (isset($obj->soafulloutput->ConRap->UtiLinCre[3]->LinUti)) ? $obj->soafulloutput->ConRap->UtiLinCre[3]->LinUti : 0;
    $LinUti5 = (isset($obj->soafulloutput->ConRap->UtiLinCre[4]->LinUti)) ? $obj->soafulloutput->ConRap->UtiLinCre[4]->LinUti : 0;
    $LinUti6 = (isset($obj->soafulloutput->ConRap->UtiLinCre[5]->LinUti)) ? $obj->soafulloutput->ConRap->UtiLinCre[5]->LinUti : 0;
    $LinUti7 = (isset($obj->soafulloutput->ConRap->UtiLinCre[6]->LinUti)) ? $obj->soafulloutput->ConRap->UtiLinCre[6]->LinUti : 0;
    $LinUti8 = (isset($obj->soafulloutput->ConRap->UtiLinCre[7]->LinUti)) ? $obj->soafulloutput->ConRap->UtiLinCre[7]->LinUti : 0;
    $LinUti9 = (isset($obj->soafulloutput->ConRap->UtiLinCre[8]->LinUti)) ? $obj->soafulloutput->ConRap->UtiLinCre[8]->LinUti : 0;
    
    $LinUtiTotal = $LinUti1 + $LinUti2 + $LinUti3 + $LinUti4 + $LinUti5 + $LinUti6 + $LinUti7 + $LinUti8 + $LinUti9;
    $Deuda_impaga = (isset($obj->soafulloutput->ConRap->DetVen[0]->VenTot)) ? $obj->soafulloutput->ConRap->DetVen[0]->VenTot : 0;
	


	$pos1="";$pos2="";$pos3="";$pos4="";$pos5="";$pos11="";$pos12="";$pos13="";$pos14="";$pos15="";
	
	$calificacion_total = $calificacion_0 . $calificacion_1 . $calificacion_2 . $calificacion_3 . $calificacion_4 . $calificacion_5 . $calificacion_6 . $calificacion_7 . $calificacion_8 . $calificacion_9 . $calificacion_10 . $calificacion_11;
	
	$calificacion_total_2 = $calificacion_12 . $calificacion_13 . $calificacion_14 . $calificacion_15 . $calificacion_16 . $calificacion_17 . $calificacion_18 . $calificacion_19 . $calificacion_20 . $calificacion_21 . $calificacion_22 . $calificacion_23;
	
	$pos1 = strpos($calificacion_total, "PER");
    $pos2 = strpos($calificacion_total, "DEF");
    $pos3 = strpos($calificacion_total, "DUD");
    $pos4 = strpos($calificacion_total, "CPP");
    $pos5 = strpos($calificacion_total, "NOR");

    $cal = "V";
    $calificacion_socio = "";
    
    $pos11 = strpos($calificacion_total_2, "PER");
    $pos12 = strpos($calificacion_total_2, "DEF");
    $pos13 = strpos($calificacion_total_2, "DUD");
    $pos14 = strpos($calificacion_total_2, "CPP");
    $pos15 = strpos($calificacion_total_2, "NOR");
    $cal1 = "V";
    $calificacion_socio1 = "";
  
    /* CALIFICACION INICIO AÑO 1 */
    
    if($pos1!==FALSE and $cal=="V")
    {
        $calificacion_socio="PER";
        $cal = "F";
    }
    if($pos2!==FALSE and $cal=="V")
    {
        $calificacion_socio="DEF";
        $cal = "F";
    }
    if($pos3!==FALSE and $cal=="V")
    {
        $calificacion_socio="DUD";
        $cal = "F";
    }
    if($pos4!==FALSE and $cal=="V")
    {
        $calificacion_socio="CPP";
        $cal = "F";
    }
    if($pos5!==FALSE and $cal=="V")
    {
        $calificacion_socio="NOR";
        $cal = "F";
    }
    
    $cal_tmp = ($calificacion_socio=="") ? "SCA" : $calificacion_socio;
    
    /* CALIFICACION INICIO AÑO 2 */
    
    
    if($pos11!==FALSE and $cal1=="V")
    {
        $calificacion_socio1="PER";
        $cal1 = "F";
    }
    if($pos12!==FALSE and $cal1=="V")
    {
        $calificacion_socio1="DEF";
        $cal1 = "F";
    }
    if($pos13!==FALSE and $cal1=="V")
    {
        $calificacion_socio1="DUD";
        $cal1 = "F";
    }
    if($pos14!==FALSE and $cal1=="V")
    {
        $calificacion_socio1="CPP";
        $cal1 = "F";
    }
    if($pos15!==FALSE and $cal1=="V")
    {
        $calificacion_socio1="NOR";
        $cal1 = "F";
    }
   
 
	
	$calificacion_socio = "";
	$calificacion_socio1 = "";
	$cal = "V";
	$cal1 = "V";
	
	/* CALIFICACION INICIO AÑO 1 */
    
    if($pos1!==FALSE and $cal=="V")
    {
        $calificacion_socio="PER";
        $cal = "F";
    }
    if($pos2!==FALSE and $cal=="V")
    {
        $calificacion_socio="DEF";
        $cal = "F";
    }
    if($pos3!==FALSE and $cal=="V")
    {
        $calificacion_socio="DUD";
        $cal = "F";
    }
    if($pos4!==FALSE and $cal=="V")
    {
        $calificacion_socio="CPP";
        $cal = "F";
    }
    if($pos5!==FALSE and $cal=="V")
    {
        $calificacion_socio="NOR";
        $cal = "F";
    }
    
    $cal_tmp = ($calificacion_socio=="") ? "SC" : $calificacion_socio;
    
    /* CALIFICACION INICIO AÑO 2 */
    
    
    if($pos11!==FALSE and $cal1=="V")
    {
        $calificacion_socio1="PER";
        $cal1 = "F";
    }
    if($pos12!==FALSE and $cal1=="V")
    {
        $calificacion_socio1="DEF";
        $cal1 = "F";
    }
    if($pos13!==FALSE and $cal1=="V")
    {
        $calificacion_socio1="DUD";
        $cal1 = "F";
    }
    if($pos14!==FALSE and $cal1=="V")
    {
        $calificacion_socio1="CPP";
        $cal1 = "F";
    }
    if($pos15!==FALSE and $cal1=="V")
    {
        $calificacion_socio1="NOR";
        $cal1 = "F";
    }
	
	$mensaje = "";
	
	$api->tarjetasPendientes_sandbox_plazofijo('Karina');
	$karina = $_SESSION["Karina"];
	//$karina = 100;

	$api->tarjetasPendientes_sandbox_plazofijo('Karen');
	$karen = $_SESSION["Karen"];
	//$karen = 100;

	$api->tarjetasPendientes_sandbox_plazofijo('Katy');
	$katy = $_SESSION["Katy"];
    //$katy = 100;
	
	$menor = 15000;
	$funcionario = "";
	
	if($menor>$karen){
		$menor = $karen;
		$funcionario = "Karen";
	}
	if($menor>$karina){
		$menor = $karina;
		$funcionario = "Karina";
	}
	if($menor>$katy){
		$menor = $katy;
		$funcionario = "Katy";
	}
	
	$item = array(
                'nombres' => $nombre_largo,
				'dni' => $dni,
				'celular' => $celular,
				'correo' => $correo,
				'calificacion' => $cal_tmp,
				'deudas_impagas' => $Deuda_impaga,
				'deuda_sistema' => $Deuda_0,
				'utm' => $utm,
				'sexo' => $Sex,
				'nacimiento' => $AnoNac,
                'es_socio' => $socio,
                'lineatc' => $LinAprTotal,
                'lineatcusada' => $LinUtiTotal,
				'funcionario'  => $funcionario,
            );
            $api->add_plazofijo($item);
			
			if($socio=="Si")
			{
				header("Location: https://pacinet.cp.com.pe/login");
				$mensaje = "Coop. Pacifico: " . ucwords(strtolower($Nom)) . ", no dejes pasar esta super tasa del plazo fijo digital, abrela por aqui bit.ly/3klw1Wx";
				$new->sendPost_sms_masivian($celular, $mensaje);
				
				
			}else{
				header("Location: https://cp.com.pe/pacifico/hazte-socio-online/");
				$mensaje = "Coop. Pacifico: " . ucwords(strtolower($Nom)) . ", no dejes pasar esta super tasa del plazo fijo digital, antes hazte socio aqui bit.ly/3IwcAD6";
				$new->sendPost_sms_masivian($celular, $mensaje);
				
			}
			
			$new->sendPost_email_plazofijo($dni, $nombre_largo, $socio, $celular, $correo);
	
?>
