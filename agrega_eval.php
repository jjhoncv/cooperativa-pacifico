<?php
session_start();
include_once 'test.php';
include_once 'apipersonas.php';

	$api = new ApiPersonas();

    //$nombre = $_POST["nombre"];
    $dni = htmlspecialchars($_REQUEST["dni"]);
    $celular = htmlspecialchars($_REQUEST["celular"]);
    $correo = htmlspecialchars($_REQUEST["correo"]);
    $sueldo = htmlspecialchars($_REQUEST["sueldo"]);
    $utm_source = "organico";
	$lima = "Si";
	$quintacategoria = "Si";
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

	$dia = date(w);
	$hor1 = date("H:i");
	$hora_actual = strtotime($hor1);

	$score = 0;
    
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
				$score = 0 + $score;
			}
			if($pos2!==FALSE and $cal=="V"){
				echo eval("\$calificacion_" . $i . "='DEF';");
				$cal = "F";
				$score = 4.95 + $score;
			}
			if($pos3!==FALSE and $cal=="V"){
				echo eval("\$calificacion_" . $i . "='DUD';");
				$cal = "F";
				$score = 9.91 + $score;
			}
			if($pos4!==FALSE and $cal=="V"){
				echo eval("\$calificacion_" . $i . "='CPP';");
				$cal = "F";
				$score = 19.83 + $score;
			}
			if($pos5!==FALSE and $cal=="V"){
				echo eval("\$calificacion_" . $i . "='NOR';");
				$cal = "F";
				$score = 24.79 + $score;
			}
			if($cal=="V"){
				echo eval("\$calificacion_" . $i . "='';");
				$cal = "F";
				$score = 14.87 + $score;
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
				$score = 0 + $score;
			}
			if($pos2!==FALSE and $cal=="V"){
				echo eval("\$calificacion_" . $i . "='DEF';");
				$cal = "F";
				$score = 2.13 + $score;
			}
			if($pos3!==FALSE and $cal=="V"){
				echo eval("\$calificacion_" . $i . "='DUD';");
				$cal = "F";
				$score = 4.25 + $score;
			}
			if($pos4!==FALSE and $cal=="V"){
				echo eval("\$calificacion_" . $i . "='CPP';");
				$cal = "F";
				$score = 8.5 + $score;
			}
			if($pos5!==FALSE and $cal=="V"){
				echo eval("\$calificacion_" . $i . "='NOR';");
				$cal = "F";
				$score = 10.63 + $score;
			}
			if($cal=="V"){
				echo eval("\$calificacion_" . $i . "='';");
				$cal = "F";
				$score = 6.38 + $score;
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
	
	$tc="V";
	
	if(($LinUtiTotal/$LinAprTotal) <= 0.1 and $tc=="V"){
		$score = 255 + $score;
		$tc="F";
	}
	if(($LinUtiTotal/$LinAprTotal) <= 0.3 and $tc=="V"){
		$score = 229.5 + $score;
		$tc="F";
	}
	if(($LinUtiTotal/$LinAprTotal) <= 0.5 and $tc=="V"){
		$score = 204 + $score;
		$tc="F";
	}
	if(($LinUtiTotal/$LinAprTotal) < 0.7 and $tc=="V"){
		$score = 153 + $score;
		$tc="F";
	}
	if(($LinUtiTotal/$LinAprTotal) < 0.85 and $tc=="V"){
		$score = 102 + $score;
		$tc="F";
	}
	if(($LinUtiTotal/$LinAprTotal) < 1 and $tc=="V"){
		$score = 51 + $score;
		$tc="F";
	}
	
	if($LinUtiTotal > 0){
		if(($LinUtiTotal - $Deuda_0)==0){
			$score = 42.5 + $score;
		}
		else{
			$score = 85 + $score;
		}
	}
	else{
		if ($Deuda>0){
			$score = 42.5 + $score;
		}
	}
	
	if($entidades_0 >= $entidades_1){
		$score = 85 + $score;
	}else{
		$score = 42.5 + $score;
	}
	
	$desc_score="";
	$desc="V";
	
	if($score <=579 and $desc=="V"){
		$desc_score="Malo [300-579]";
		$desc="F";
	}
	if($score <=669 and $desc=="V"){
		$desc_score="Razonable [580-669]";
		$desc="F";
	}
	if($score <=739 and $desc=="V"){
		$desc_score="Bueno [670-739]";
		$desc="F";
	}
	if($score <=799 and $desc=="V"){
		$desc_score="Muy Bueno [740-799]";
		$desc="F";
	}
	if($score <=850 and $desc=="V"){
		$desc_score="Excepcional [800-850]";
		$desc="F";
	}
	
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
   
    /* DEFINIMOS CALIFICACION SI ESTA APTO PARA EL CREDITO */
    
    if($calificacion_socio=="NOR" or $calificacion_socio=="CPP")
    {
        $calificacion_socio="OK";
    }
    if($calificacion_socio=="" and ($calificacion_socio1=="" or $calificacion_socio1=="NOR" or $calificacion_socio1=="CPP"))
    {
        $calificacion_socio="OK";
    }
	
	$saldo_pagar = (0.3*$sueldo)-($Deuda_0/18)-10;
    $var1 = "";
    $var2 = "";
    $var3 = "";
    $var4 = "";
	
	if($Deuda_impaga<500 and $calificacion_socio=="OK" and $saldo_pagar>587 and $encontrado=="V" and $entidades_0<5)
    {
        $oferta = "Importe S/ 15,000 | Plazo 36 meses | Cuota mensual aproximada S/ 587.96 | TCEA 24% ";
        $encontrado = "F";
        $var1 = "15,000";
        $var2 = "36";
        $var3 = "587";
        $var4 = 24;
    }
    if($Deuda_impaga<500 and $calificacion_socio=="OK" and $saldo_pagar>549 and $encontrado=="V" and $entidades_0<5)
    {
        $oferta = "Importe S/ 14,000 | Plazo 36 meses | Cuota mensual aproximada S/ 549.43 | TCEA 24% ";
        $encontrado = "F";
        $var1 = "14,000";
        $var2 = "36";
        $var3 = "549";
        $var4 = "24";
    }
    if($Deuda_impaga<500 and $calificacion_socio=="OK" and $saldo_pagar>510 and $encontrado=="V" and $entidades_0<5)
    {
       $oferta = "Importe S/ 13,000 | Plazo 36 meses | Cuota mensual aproximada S/ 510.89 | TCEA 24% ";
       $encontrado = "F";
       $var1 = "13,000";
       $var2 = "36";
       $var3 = "510";
       $var4 = "24";
    }
    if($Deuda_impaga<500 and $calificacion_socio=="OK" and $saldo_pagar>472 and $encontrado=="V" and $entidades_0<5)
    {
        $oferta = "Importe S/ 12,000 | Plazo 36 meses | Cuota mensual aproximada S/ 472.36 | TCEA 24% ";
        $encontrado = "F";
        $var1 = "12,000";
        $var2 = "36";
        $var3 = "472";
        $var4 = 24;
    }
    if($Deuda_impaga<500 and $calificacion_socio=="OK" and $saldo_pagar>428 and $encontrado=="V" and $entidades_0<5)
    {
        $oferta = "Importe S/ 8,000 | Plazo 24 meses | Cuota mensual aproximada S/ 428.67 | TCEA 24% ";
        $encontrado = "F";
        $var1 = "8,000";
        $var2 = "24";
        $var3 = "428";
        $var4 = "24";
    }
    if($Deuda_impaga<500 and $calificacion_socio=="OK" and $saldo_pagar>407 and $encontrado=="V" and $entidades_0<5)
    {
        $oferta = "Importe S/ 6,000 | Plazo 18 meses | Cuota mensual aproximada S/ 407.82 | TCEA 24% ";
        $encontrado = "F";
        $var1 = "6,000";
        $var2 = "18";
        $var3 = "407";
        $var4 = "24";
    }
    if($Deuda_impaga<500 and $calificacion_socio=="OK" and $saldo_pagar>341 and $encontrado=="V" and $entidades_0<5)
    {
        $oferta = "Importe S/ 5,000 | Plazo 18 meses | Cuota mensual aproximada S/ 341.52 | TCEA 24% ";
        $encontrado = "F";
        $var1 = "5,000";
        $var2 = "18";
        $var3 = "341";
        $var4 = "24";
    }
    if($Deuda_impaga<500 and $calificacion_socio=="OK" and $saldo_pagar>275 and $encontrado=="V" and $entidades_0<5)
    {
        $oferta = "Importe S/ 4,000 | Plazo 18 meses | Cuota mensual aproximada S/ 275.22 | TCEA 24% ";
        $encontrado = "F";
        $var1 = "4,000";
        $var2 = "18";
        $var3 = "275";
        $var4 = "24";
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
	
	if(($calificacion_socio=="NOR" or $calificacion_socio=="CPP" or $calificacion_socio=="SC") and ($calificacion_socio1=="" or $calificacion_socio1=="NOR" or $calificacion_socio1=="CPP") and $encontrado=="V" and $Deuda_impaga<500 and $entidades_0<5)
	{
		$saldo_pagar = (8*$sueldo)-$Deuda_0;
		
		if($saldo_pagar >= 15000 and $encontrado=="V")
		{
			$oferta = "Importe S/ 15,000 | Plazo 48 meses | Cuota mensual aproximada S/ 658 | TCEA 50% ";
			$encontrado = "F";
			$var1 = "15,000";
			$var2 = "48";
			$var3 = "658";
			$var4 = "50";
		}
		
		if(($saldo_pagar >= 14000 and $saldo_pagar < 15000) and $encontrado=="V")
		{
			$oferta = "Importe S/ 14,000 | Plazo 48 meses | Cuota mensual aproximada S/ 614 | TCEA 50% ";
			$encontrado = "F";
			$var1 = "14,000";
			$var2 = "48";
			$var3 = "614";
			$var4 = "50";
		}
		
		if(($saldo_pagar >= 13000 and $saldo_pagar < 14000) and $encontrado=="V")
		{
			$oferta = "Importe S/ 13,000 | Plazo 48 meses | Cuota mensual aproximada S/ 570 | TCEA 50% ";
			$encontrado = "F";
			$var1 = "13,000";
			$var2 = "48";
			$var3 = "570";
			$var4 = "50";
		}
				
		if(($saldo_pagar >= 12000 and $saldo_pagar < 13000) and $encontrado=="V")
		{
			$oferta = "Importe S/ 12,000 | Plazo 48 meses | Cuota mensual aproximada S/ 526 | TCEA 50% ";
			$encontrado = "F";
			$var1 = "12,000";
			$var2 = "48";
			$var3 = "526";
			$var4 = "50";
		}
		
		if(($saldo_pagar >= 11000 and $saldo_pagar < 12000) and $encontrado=="V")
		{
			$oferta = "Importe S/ 11,000 | Plazo 48 meses | Cuota mensual aproximada S/ 483 | TCEA 50% ";
			$encontrado = "F";
			$var1 = "11,000";
			$var2 = "48";
			$var3 = "483";
			$var4 = "50";
		}
		
		if(($saldo_pagar >= 10000 and $saldo_pagar < 11000) and $encontrado=="V")
		{
			$oferta = "Importe S/ 10,000 | Plazo 48 meses | Cuota mensual aproximada S/ 439 | TCEA 50% ";
			$encontrado = "F";
			$var1 = "10,000";
			$var2 = "48";
			$var3 = "439";
			$var4 = "50";
		}
		
		if(($saldo_pagar >= 9000 and $saldo_pagar < 10000) and $encontrado=="V")
		{
			$oferta = "Importe S/ 9,000 | Plazo 48 meses | Cuota mensual aproximada S/ 395 | TCEA 50% ";
			$encontrado = "F";
			$var1 = "9,000";
			$var2 = "48";
			$var3 = "395";
			$var4 = "50";
		}
		
		if(($saldo_pagar >= 8000 and $saldo_pagar < 9000) and $encontrado=="V")
		{
			$oferta = "Importe S/ 8,000 | Plazo 48 meses | Cuota mensual aproximada S/ 351 | TCEA 50% ";
			$encontrado = "F";
			$var1 = "8,000";
			$var2 = "48";
			$var3 = "351";
			$var4 = "50";
		}
		
		if(($saldo_pagar >= 7000 and $saldo_pagar < 8000) and $encontrado=="V")
		{
			$oferta = "Importe S/ 7,000 | Plazo 48 meses | Cuota mensual aproximada S/ 307 | TCEA 50% ";
			$encontrado = "F";
			$var1 = "7,000";
			$var2 = "48";
			$var3 = "307";
			$var4 = "50";
		}
		
		if(($saldo_pagar >= 6000 and $saldo_pagar < 7000) and $encontrado=="V")
		{
			$oferta = "Importe S/ 6,000 | Plazo 48 meses | Cuota mensual aproximada S/ 263 | TCEA 50% ";
			$encontrado = "F";
			$var1 = "6,000";
			$var2 = "48";
			$var3 = "263";
			$var4 = "50";
		}
		
		if(($saldo_pagar >= 5000 and $saldo_pagar < 6000) and $encontrado=="V")
		{
			$oferta = "Importe S/ 5,000 | Plazo 48 meses | Cuota mensual aproximada S/ 219 | TCEA 50% ";
			$encontrado = "F";
			$var1 = "5,000";
			$var2 = "48";
			$var3 = "219";
			$var4 = "50";
		}
		
		if(($saldo_pagar >= 4000 and $saldo_pagar < 5000) and $encontrado=="V")
		{
			$oferta = "Importe S/ 4,000 | Plazo 48 meses | Cuota mensual aproximada S/ 175 | TCEA 50% ";
			$encontrado = "F";
			$var1 = "4,000";
			$var2 = "48";
			$var3 = "175";
			$var4 = "50";
		}
	}
	
	if($score > 699 and $Deuda_impaga<500 and $entidades_0<5 and $encontrado=="V"){
	
		$oferta = "** SCORE ** Importe S/ 12,000 | Plazo 36 meses | Cuota mensual aproximada S/ 472.36 | TCEA 24% ";
        $encontrado = "F";
        $var1 = "12,000";
        $var2 = "36";
        $var3 = "472";
        $var4 = 24;
	}

	if(!($edad>=20 and $edad<=64)){
		$encontrado="V";
	}
		
			$item = array(
					'nombres' => $nombre_largo,
					'dni' => $dni,
					'celular' => $celular,
					'situacion' => $cal_tmp,
					'sueldo_neto' => $sueldo,
					'saldo_pagar_cuota' => $saldo_pagar,
					'dias_atraso' => '0',
					'deudas_impagas' => $Deuda_impaga,
					'deuda_sistema' => $Deuda_0,
					'ruc' => '',
					'nombre_empresa' => $utm_source,
					'estado' => 'PRE-APROBADO',
					'funcionario' => $funcionario,
					'sexo' => $Sex,
					'nacimiento' => $AnoNac,
					'lima' => $lima,
					'quinta' => $quintacategoria,
					'correo' => $correo,
					'score' => $score,
				);
				$api->add2($item);
				exit();

?>




