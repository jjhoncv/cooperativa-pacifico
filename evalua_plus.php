<?php
	$dni = htmlspecialchars($_POST["dni"]);
	$sueldo = htmlspecialchars($_POST["sueldo"]);
	$quinta = htmlspecialchars($_POST["quinta"]);
	
	if($dni!="")
	{
	
	
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://www2.sentinelperu.com/wsrest/rest/RWS_SenNScore',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
    "Gx_UsuEnc": "0g9HYG3nIpsxW53xRZyPzw==",
    "Gx_PasEnc": "LAVXhSQOifvRu1Jqata0bg==",
    "Gx_Key": "C25DB7222BC7F07B7165674659F6DD85",
    "TipoDoc": "D",
    "NroDoc": "' . $dni . '"
}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    'Cookie: incap_ses_8217_2380410=GVgsHCXD61Rp4JfOyqYIcjzS6GQAAAAAXkRdWucti02wiAUWdA6v7w==; nlbi_2380410=Xa0rclIFNCtLLBlyrCyPggAAAADmnhpsk9HlgykxuKRtuIB0; visid_incap_2380410=nwPUTYSVS7awGygfZ4jIZKLSR2QAAAAAQUIPAAAAAAC33TYKlYQB2elUda1Z8eBX; ASP.NET_SessionId=bp34la1ikrpq4uh3k2uyswsa'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
	$obj1 = json_decode($response);
	$NivelRiesgo = $obj1->NivelRiesgo;
	$Score = $obj1->Score;

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://www2.sentinelperu.com/wsrest/rest/reststandardws',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
    "Gx_UsuEnc": "0g9HYG3nIpsxW53xRZyPzw==",
    "Gx_PasEnc": "LAVXhSQOifvRu1Jqata0bg==",
    "Gx_Key": "C25DB7222BC7F07B7165674659F6DD85",
    "TipoDoc": "D",
    "NroDoc": "' . $dni . '"
}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    'Cookie: incap_ses_8217_2380410=HlesIyuZeH/+zovMyqYIcvR252QAAAAAui3gakrtImDgiBshsfMmvg==; nlbi_2380410=Xa0rclIFNCtLLBlyrCyPggAAAADmnhpsk9HlgykxuKRtuIB0; visid_incap_2380410=nwPUTYSVS7awGygfZ4jIZKLSR2QAAAAAQUIPAAAAAAC33TYKlYQB2elUda1Z8eBX; ASP.NET_SessionId=bp34la1ikrpq4uh3k2uyswsa'
  ),
));

$response = curl_exec($curl);

curl_close($curl);

	$obj = json_decode($response);
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
	
	
    for ($i = 0; $i <= 23; $i++) {
        
        echo eval ("\$Ano_" . $i. "= \$obj->soafulloutput->ConRap->DetSBSMicr[" . $i . "]->ano;");
        echo eval ("\$Mes_" . $i. "= \$obj->soafulloutput->ConRap->DetSBSMicr[" . $i . "]->mes;");
        
        for ($j = 0; $j <= 9; $j++){
            
            echo eval ("\$Deuda_" . $i . "_" . $j . "= (isset(\$obj->soafulloutput->ConRap->DetSBSMicr[" . $i . "]->Detalle[" . $j . "]->SalDeu)) ? \$obj->soafulloutput->ConRap->DetSBSMicr[" . $i . "]->Detalle[" . $j . "]->SalDeu : 0;");
            echo eval ("\$calificacion_" . $i . "_" . $j . " = (isset(\$obj->soafulloutput->ConRap->DetSBSMicr[" . $i . "]->Detalle[" . $j . "]->Cal)) ? \$obj->soafulloutput->ConRap->DetSBSMicr[" . $i . "]->Detalle[" . $j . "]->Cal : '';");
			echo eval ("\$calificacion_" . $i . "_" . $j . " = (((\$calificacion_" . $i . "_" . $j . "=='DEF') or (\$calificacion_" . $i . "_" . $j . "=='CPP') or (\$calificacion_" . $i . "_" . $j . "=='DUD') or (\$calificacion_" . $i . "_" . $j . "=='PER') or (\$calificacion_" . $i . "_" . $j . "=='NOR')) and (\$obj->soafulloutput->ConRap->DetSBSMicr[" . $i . "]->Detalle[" . $j . "]->SalDeu < 100)) ? '' : \$calificacion_" . $i . "_" . $j . ";");
        }
    }
    
    for ($i = 0; $i <= 23; $i++) {
    
           echo eval ("\$calificacion_" . $i . "=\$calificacion_" . $i . "_0 . \$calificacion_" . $i . "_1 . \$calificacion_" .$i. "_2 . \$calificacion_" .$i. "_3 . \$calificacion_" .$i. "_4 . \$calificacion_" .$i. "_5 . \$calificacion_" .$i. "_6 . \$calificacion_" .$i. "_7 . \$calificacion_" .$i. "_8 . \$calificacion_" .$i. "_9;");
           echo eval ("\$Deuda_" . $i . "=\$Deuda_" . $i . "_0 + \$Deuda_" . $i . "_1 + \$Deuda_" .$i. "_2 + \$Deuda_" .$i. "_3 + \$Deuda_" .$i. "_4 + \$Deuda_" .$i. "_5 + \$Deuda_" .$i. "_6 + \$Deuda_" .$i. "_7 + \$Deuda_" .$i. "_8 + \$Deuda_" .$i. "_9;");
    }
	
	for ($i = 0; $i <= 23; $i++) {
		echo eval("\$entidades_" . $i . " = (strlen(\$calificacion_" . $i . ")/3);");
	}
	
	$alerta_cal=0;$cpp_cal=0;$act_nobanca=0;
	
	for ($i = 0; $i <= 23; $i++) { 
	
			$pos1="";$pos2="";$pos3="";$pos4="";$pos5="";$cal="V";
			
			echo eval("\$pos1 = strpos(\$calificacion_" . $i . ",'PER');");
			echo eval("\$pos2 = strpos(\$calificacion_" . $i . ",'DEF');");
			echo eval("\$pos3 = strpos(\$calificacion_" . $i . ",'DUD');");
			echo eval("\$pos4 = strpos(\$calificacion_" . $i . ",'CPP');");
			echo eval("\$pos5 = strpos(\$calificacion_" . $i . ",'NOR');");
			
			if($pos1!==FALSE and $cal=="V"){
				echo eval("\$calificacion_" . $i . "='PER';");
				$cal = "F";
				$alerta_cal++;
			}
			if($pos2!==FALSE and $cal=="V"){
				echo eval("\$calificacion_" . $i . "='DEF';");
				$cal = "F";
				$alerta_cal++;
			}
			if($pos3!==FALSE and $cal=="V"){
				echo eval("\$calificacion_" . $i . "='DUD';");
				$cal = "F";
				$alerta_cal++;
			}
			if($pos4!==FALSE and $cal=="V"){
				echo eval("\$calificacion_" . $i . "='CPP';");
				$cal = "F";
				$cpp_cal++;
				if($i<12){
					$act_nobanca++;	
				}
			}
			if($pos5!==FALSE and $cal=="V"){
				echo eval("\$calificacion_" . $i . "='NOR';");
				$cal = "F";
				if($i<12){
					$act_nobanca++;	
				}
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
	
	$tasa_tea=0.45; //  TEA de 45%
	$cuotas_deuda=24; // 24 cuotas
	$rci = 0.4; // RCI 40%
	//**********************/
	//Convertir TEA a TEM
	$tem=(pow((1+$tasa_tea),(1/12)))-1;
	
	$k = $Deuda_0;
	$cuota_p = ((((pow((1+$tem),$cuotas_deuda))*$tem)/((pow((1+$tem),$cuotas_deuda))-1)))*$k;
	$sueldo_x_rci = $sueldo*$rci;
	$despues_cuotap = ($sueldo_x_rci*0.76) - $cuota_p;
	
	$edad_check=""; // De 20 a 64 años
	if($edad > 19 and $edad < 65){
		$edad_check = "<img src='icon/check-circle-fill.svg' width='16' height='16'>";}
	else{
		$edad_check = "<img src='icon/x-circle-fill.svg' width='16' height='16'>";
	}
	
	$score_check=""; // Mayor a 450 puntos de score
	if($Score > 450){
		$score_check = "<img src='icon/check-circle-fill.svg' width='16' height='16'>";}
	else{
		$score_check = "<img src='icon/x-circle-fill.svg' width='16' height='16'>";
	}
	
	$impaga_check=""; // Maximo 500 soles de impagas
	if($Deuda_impaga < 501){
		$impaga_check = "<img src='icon/check-circle-fill.svg' width='16' height='16'>";}
	else{
		$impaga_check = "<img src='icon/x-circle-fill.svg' width='16' height='16'>";
	}
	
	$entidades_check=""; // Hasta 3 entidades
	if($entidades_0 > 3){
		$entidades_check = "<img src='icon/x-circle-fill.svg' width='16' height='16'>";}
	else{
		$entidades_check = "<img src='icon/check-circle-fill.svg' width='16' height='16'>";
	}
	
	$tc_check=""; // Maximo uso de TC 70%
	if(($LinUtiTotal/$LinAprTotal)>0.7){
		$tc_check = "<img src='icon/x-circle-fill.svg' width='16' height='16'>";}
	else{
		$tc_check = "<img src='icon/check-circle-fill.svg' width='16' height='16'>";
	}
	
	$rci_check=""; // Saldo despues de obligaciones actuales mayor a 200 soles
	if($despues_cuotap<200){
		$rci_check = "<img src='icon/x-circle-fill.svg' width='16' height='16'>";}
	else{
		$rci_check = "<img src='icon/check-circle-fill.svg' width='16' height='16'>";
	}
	
	$sueldo_check=""; // Sueldo neto minimo 1025
	if(($sueldo*0.76)>1024){
		$sueldo_check = "<img src='icon/check-circle-fill.svg' width='16' height='16'>";}
	else{
		$sueldo_check = "<img src='icon/x-circle-fill.svg' width='16' height='16'>";
	}
	
	$act_nobanca_check=""; // Actividad de 6 meses en el ultimo año
	if($act_nobanca<6){
		$act_nobanca_check = "<img src='icon/x-circle-fill.svg' width='16' height='16'>";}
	else{
		$act_nobanca_check = "<img src='icon/check-circle-fill.svg' width='16' height='16'>";
	}
	
	$cal_check=""; // Calificaciones PER, DUD, DEF rechazos inmediatos
	if($alerta_cal > 0){
		$cal_check = "<img src='icon/x-circle-fill.svg' width='16' height='16'>";}
	else{
		if($cpp_cal<3){
			if($calificacion_0=="NOR" or $calificacion_0=="SCA"){
				$cal_check = "<img src='icon/check-circle-fill.svg' width='16' height='16'>";}
			else{
				$cal_check = "<img src='icon/x-circle-fill.svg' width='16' height='16'>";
			}
			
		}else{
			$cal_check = "<img src='icon/x-circle-fill.svg' width='16' height='16'>";
		}
	}
	
	
	
?>
<!DOCTYPE HTML>
<html>
<head>
  <title>Evalua</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <script>

  </script>
</head>
<body>
	
	(<?php echo $Sex; ?>) [<?php echo $dni; ?>] <?php echo $nombre_largo; ?>,  <?php echo $edad;?> años <?php echo $edad_check;?> (Rango 20 a 64 años). Score[<?php echo $Score;?>] <?php echo $score_check;?> (Minimo 450)<br>
	Linea TC S/ <?php echo number_format($LinAprTotal,0); ?> Linea Utilizada TC S/ <?php echo number_format($LinUtiTotal,0);?> <?php echo $tc_check;?>(Hasta 70% de Línea utilizada) <br>
	Deuda Impagas S/ <?php echo number_format($Deuda_impaga,0);?> <?php echo $impaga_check;?> (Máximo S/500) <br>
	Deuda en el sistema S/ <?php echo number_format($Deuda_0,0); ?> en [<?php echo $entidades_0;?>] entidades <?php echo $entidades_check;?> (Máximo 3 entidades)<br>
	Sueldo S/ <?php echo number_format($sueldo,0); ?> || Sueldo Neto S/ <?php echo number_format($sueldo*0.76,0); ?>   <?php echo $sueldo_check;?> (Mínimo S/1025) Quinta Categoria [<?php echo $quinta;?>] <br>
	Calificacion <?php echo $cal_check;?> (No DEF No DUD No PER)<br>
	Despues de obligaciones actuales S/ <?php echo number_format($despues_cuotap,0); ?> <?php echo $rci_check;?> (Debe ser mayor a S/200)<br>
	Actividad en los últimos meses <?php echo $act_nobanca; ?> veces <?php echo $act_nobanca_check; ?> (Mínimo 6 meses en el útimo año)<hr>
	
	[<?php echo $Ano_0;?>-<?php echo $Mes_0;?>] [<?php echo $calificacion_0; ?>] Deuda S/ <?php echo number_format($Deuda_0,0);?> <br>
	[<?php echo $Ano_1;?>-<?php echo $Mes_1;?>] [<?php echo $calificacion_1; ?>] Deuda S/ <?php echo number_format($Deuda_1,0);?> <br>
	[<?php echo $Ano_2;?>-<?php echo $Mes_2;?>] [<?php echo $calificacion_2; ?>] Deuda S/ <?php echo number_format($Deuda_2,0);?> <br>
	[<?php echo $Ano_3;?>-<?php echo $Mes_3;?>] [<?php echo $calificacion_3; ?>] Deuda S/ <?php echo number_format($Deuda_3,0);?> <br>
	[<?php echo $Ano_4;?>-<?php echo $Mes_4;?>] [<?php echo $calificacion_4; ?>] Deuda S/ <?php echo number_format($Deuda_4,0);?> <br>
	[<?php echo $Ano_5;?>-<?php echo $Mes_5;?>] [<?php echo $calificacion_5; ?>] Deuda S/ <?php echo number_format($Deuda_5,0);?> <br>
	[<?php echo $Ano_6;?>-<?php echo $Mes_6;?>] [<?php echo $calificacion_6; ?>] Deuda S/ <?php echo number_format($Deuda_6,0);?> <br>
	[<?php echo $Ano_7;?>-<?php echo $Mes_7;?>] [<?php echo $calificacion_7; ?>] Deuda S/ <?php echo number_format($Deuda_7,0);?> <br>
	[<?php echo $Ano_8;?>-<?php echo $Mes_8;?>] [<?php echo $calificacion_8; ?>] Deuda S/ <?php echo number_format($Deuda_8,0);?> <br>
	[<?php echo $Ano_9;?>-<?php echo $Mes_9;?>] [<?php echo $calificacion_9; ?>] Deuda S/ <?php echo number_format($Deuda_9,0);?> <br>
	[<?php echo $Ano_10;?>-<?php echo $Mes_10;?>] [<?php echo $calificacion_10; ?>] Deuda S/ <?php echo number_format($Deuda_10,0);?> <br>
	[<?php echo $Ano_11;?>-<?php echo $Mes_11;?>] [<?php echo $calificacion_11; ?>] Deuda S/ <?php echo number_format($Deuda_11,0);?> <br>
	[<?php echo $Ano_12;?>-<?php echo $Mes_12;?>] [<?php echo $calificacion_12; ?>] Deuda S/ <?php echo number_format($Deuda_12,0);?> <br>
	[<?php echo $Ano_13;?>-<?php echo $Mes_13;?>] [<?php echo $calificacion_13; ?>] Deuda S/ <?php echo number_format($Deuda_13,0);?> <br>
	[<?php echo $Ano_14;?>-<?php echo $Mes_14;?>] [<?php echo $calificacion_14; ?>] Deuda S/ <?php echo number_format($Deuda_14,0);?> <br>
	[<?php echo $Ano_15;?>-<?php echo $Mes_15;?>] [<?php echo $calificacion_15; ?>] Deuda S/ <?php echo number_format($Deuda_15,0);?> <br>
	[<?php echo $Ano_16;?>-<?php echo $Mes_16;?>] [<?php echo $calificacion_16; ?>] Deuda S/ <?php echo number_format($Deuda_16,0);?> <br>
	[<?php echo $Ano_17;?>-<?php echo $Mes_17;?>] [<?php echo $calificacion_17; ?>] Deuda S/ <?php echo number_format($Deuda_17,0);?> <br>
	[<?php echo $Ano_18;?>-<?php echo $Mes_18;?>] [<?php echo $calificacion_18; ?>] Deuda S/ <?php echo number_format($Deuda_18,0);?> <br>
	[<?php echo $Ano_19;?>-<?php echo $Mes_19;?>] [<?php echo $calificacion_19; ?>] Deuda S/ <?php echo number_format($Deuda_19,0);?> <br>
	[<?php echo $Ano_20;?>-<?php echo $Mes_20;?>] [<?php echo $calificacion_20; ?>] Deuda S/ <?php echo number_format($Deuda_20,0);?> <br>
	[<?php echo $Ano_21;?>-<?php echo $Mes_21;?>] [<?php echo $calificacion_21; ?>] Deuda S/ <?php echo number_format($Deuda_21,0);?> <br>
	[<?php echo $Ano_22;?>-<?php echo $Mes_22;?>] [<?php echo $calificacion_22; ?>] Deuda S/ <?php echo number_format($Deuda_22,0);?> <br>
	[<?php echo $Ano_23;?>-<?php echo $Mes_23;?>] [<?php echo $calificacion_23; ?>] Deuda S/ <?php echo number_format($Deuda_23,0);?> <br>
	
	<a href='evalua_plus'>Volver</a>
	
<?php
	}
	else
	{
?>
<!DOCTYPE HTML>
<html>
<head>
  <title>Evalua</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <script>
  function enviar(){
	  document.cuerpo.envio.disabled=true;
	  document.cuerpo.submit();
  }
  </script>
</head>
<body>
<form name="cuerpo" method="post" action="evalua_plus">
<input type="text" name="dni" value="" placeholder="Ingresa DNI"><br>
<input type="text" name="sueldo" value="" placeholder="Ingresa Sueldo"><br>
<label>Quinta Categoria</label><br>
<input type="radio" name="quinta" value="S"> Si<br>
<input type="radio" name="quinta" value="N"> No<br>

<input type="button" onclick="enviar()" value="Evalua" name="envio" id="envio">
</form>
</body>





<?php
	}
?>