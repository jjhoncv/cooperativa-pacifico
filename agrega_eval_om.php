<?php
session_start();
include_once 'mini_test.php';
include_once 'apipersonas_om.php';

	$api = new ApiPersonas();

    $dni = htmlspecialchars($_REQUEST["dni"]);
    $celular = htmlspecialchars($_REQUEST["celular"]);
    $sueldo = htmlspecialchars($_REQUEST["sueldo"]);
    $correo = htmlspecialchars($_REQUEST["correo"]);
	
    $utm_source = "organico";
	
	$funcionario = htmlspecialchars($_REQUEST["funcionario"]);

    $saldo_pagar = 0;
    $encontrado = "V";
    $celular = "51" . $celular;
	
	$dni = trim($dni);
	if(strlen($dni)==8)
		$tipo = "D";
	if(strlen($dni)==11)
		$tipo = "R";
	if(strlen($dni)==9)
		$tipo = "4";
	
    $new = new CurlRequest();
    $resultado = $new ->sendPost_sentinel($tipo, $dni);
    $obj = json_decode($resultado);
    
	if($tipo!=4)
	{
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
    }
	else
	{
		$nombre_largo = $obj->soafulloutput->InfBas->RazSoc;
		$Sex = "MASCULINO";
		$AnoNac = "2023";
		
	}
	$digito = substr($celular,10,1);
	
	date_default_timezone_set('America/Lima');
	$des1 = "09:00";
	$has1 = "18:00";
	$desde = strtotime($des1);
	$hasta = strtotime($has1);
	$fecha = date('Y-m-d');

	$dia = date("w")
	$hor1 = date("H:i");
	$hora_actual = strtotime($hor1);

	$Scoring = 0;

	for ($i = 0; $i <= 23; $i++) {
        
        echo eval ("\$Ano_" . $i. "= \$obj->soafulloutput->ConRap->DetSBSMicr[" . $i . "]->ano;");
        echo eval ("\$Mes_" . $i. "= \$obj->soafulloutput->ConRap->DetSBSMicr[" . $i . "]->mes;");
        
        for ($j = 0; $j <= 9; $j++){
            
            echo eval ("\$Deuda_" . $i . "_" . $j . "= (isset(\$obj->soafulloutput->ConRap->DetSBSMicr[" . $i . "]->Detalle[" . $j . "]->SalDeu)) ? \$obj->soafulloutput->ConRap->DetSBSMicr[" . $i . "]->Detalle[" . $j . "]->SalDeu : 0;");
            echo eval ("\$calificacion_" . $i . "_" . $j . " = (isset(\$obj->soafulloutput->ConRap->DetSBSMicr[" . $i . "]->Detalle[" . $j . "]->Cal)) ? \$obj->soafulloutput->ConRap->DetSBSMicr[" . $i . "]->Detalle[" . $j . "]->Cal : '';");
        }
    }
    
    for ($i = 0; $i <= 23; $i++) {
    
           echo eval ("\$calificacion_" . $i . "=\$calificacion_" . $i . "_0 . \$calificacion_" . $i . "_1 . \$calificacion_" .$i. "_2 . \$calificacion_" .$i. "_3 . \$calificacion_" .$i. "_4 . \$calificacion_" .$i. "_5 . \$calificacion_" .$i. "_6 . \$calificacion_" .$i. "_7 . \$calificacion_" .$i. "_8 . \$calificacion_" .$i. "_9;");
           echo eval ("\$Deuda_" . $i . "=\$Deuda_" . $i . "_0 + \$Deuda_" . $i . "_1 + \$Deuda_" .$i. "_2 + \$Deuda_" .$i. "_3 + \$Deuda_" .$i. "_4 + \$Deuda_" .$i. "_5 + \$Deuda_" .$i. "_6 + \$Deuda_" .$i. "_7 + \$Deuda_" .$i. "_8 + \$Deuda_" .$i. "_9;");
    }
	
	for ($i = 0; $i <= 23; $i++) {
		echo eval(htmlspecialchars("\$entidades_" . $i . " = (strlen(\$calificacion_" . $i . ")/3);"));
	}
	
	for ($i = 0; $i <= 11; $i++) { // Primer 1 año (12 meses)
	
			$pos1="";$pos2="";$pos3="";$pos4="";$pos5="";$cal="V";
			
			echo eval(htmlspecialchars("\$pos1 = strpos(\$calificacion_" . $i . ",'PER');"));
			echo eval(htmlspecialchars("\$pos2 = strpos(\$calificacion_" . $i . ",'DEF');"));
			echo eval(htmlspecialchars("\$pos3 = strpos(\$calificacion_" . $i . ",'DUD');"));
			echo eval(htmlspecialchars("\$pos4 = strpos(\$calificacion_" . $i . ",'CPP');"));
			echo eval(htmlspecialchars("\$pos5 = strpos(\$calificacion_" . $i . ",'NOR');"));
			
			if($pos1!==FALSE and $cal=="V"){
				echo eval(htmlspecialchars("\$calificacion_" . $i . "='PER';"));
				$cal = "F";
			}
			if($pos2!==FALSE and $cal=="V"){
				echo eval(htmlspecialchars("\$calificacion_" . $i . "='DEF';"));
				$cal = "F";
			}
			if($pos3!==FALSE and $cal=="V"){
				echo eval(htmlspecialchars("\$calificacion_" . $i . "='DUD';"));
				$cal = "F";
			}
			if($pos4!==FALSE and $cal=="V"){
				echo eval(htmlspecialchars("\$calificacion_" . $i . "='CPP';"));
				$cal = "F";
			}
			if($pos5!==FALSE and $cal=="V"){
				echo eval(htmlspecialchars("\$calificacion_" . $i . "='NOR';"));
				$cal = "F";
			}
			if($cal=="V"){
				echo eval(htmlspecialchars("\$calificacion_" . $i . "='';"));
				$cal = "F";
			}
			
	}
	
	for ($i = 12; $i <= 23; $i++) { // Segundo 2 año (12 meses)
	
			$pos1="";$pos2="";$pos3="";$pos4="";$pos5="";$cal="V";
			
			echo eval(htmlspecialchars("\$pos1 = strpos(\$calificacion_" . $i . ",'PER');"));
			echo eval(htmlspecialchars("\$pos2 = strpos(\$calificacion_" . $i . ",'DEF');"));
			echo eval(htmlspecialchars("\$pos3 = strpos(\$calificacion_" . $i . ",'DUD');"));
			echo eval(htmlspecialchars("\$pos4 = strpos(\$calificacion_" . $i . ",'CPP');"));
			echo eval(htmlspecialchars("\$pos5 = strpos(\$calificacion_" . $i . ",'NOR');"));
			
			if($pos1!==FALSE and $cal=="V"){
				echo eval(htmlspecialchars("\$calificacion_" . $i . "='PER';"));
				$cal = "F";
			}
			if($pos2!==FALSE and $cal=="V"){
				echo eval(htmlspecialchars("\$calificacion_" . $i . "='DEF';"));
				$cal = "F";
			}
			if($pos3!==FALSE and $cal=="V"){
				echo eval(htmlspecialchars("\$calificacion_" . $i . "='DUD';"));
				$cal = "F";
			}
			if($pos4!==FALSE and $cal=="V"){
				echo eval(htmlspecialchars("\$calificacion_" . $i . "='CPP';"));
				$cal = "F";
			}
			if($pos5!==FALSE and $cal=="V"){
				echo eval(htmlspecialchars("\$calificacion_" . $i . "='NOR';"));
				$cal = "F";
			}
			if($cal=="V"){
				echo eval(htmlspecialchars("\$calificacion_" . $i . "='';"));
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
	
	$observaciones = "";
	
	
	
	if($encontrado=="V" and ($cal_tmp=="PER" or $cal_tmp=="DEF" or $cal_tmp=="DUD")){
		$estado = "NO CALIFICA";
		$observaciones = "Mala calificacion [" . $cal_tmp . "]";
		$encontrado = "F";
	}
	
	if($encontrado=="V" and ($Deuda_impaga>700)){
		$estado = "NO CALIFICA";
		$observaciones = "Deudas impagas S/ [" . $Deuda_impaga . "]";
		$encontrado = "F";
	}
	
	if($encontrado=="V"){
		$estado = "PRE-APROBADO";
		$observaciones = "Deuda en el sistema [" . $Deuda_0 . "]";
	}
	
	
	$item = array(
                'nombres' => $nombre_largo,
				'dni' => $dni,
				'celular' => $celular,
				'situacion' => $cal_tmp,
				'sueldo' => $sueldo,
				'deudas_impagas' => $Deuda_impaga,
				'deuda_sistema' => $Deuda_0,
                'estado' => $estado,
                'funcionario' => $funcionario, 
				'sexo' => $Sex,
				'nacimiento' => $AnoNac,
				'correo' => $correo,
				'linea_credito' => $LinAprTotal,
				'linea_utilizada' => $LinUtiTotal,
				'observaciones' => $observaciones,
            );
            $api->add_pdp($item);

?>




