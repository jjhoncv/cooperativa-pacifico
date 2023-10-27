<?php
include_once 'mini_test.php';

	$dni = $_GET['dni'];
	$sueldo = $_GET['sueldo'];

	$dni = trim($dni);
	$sueldo = $sueldo*0.76;
	
	if(strlen($dni)==8)
		$tipo = "D";
	else
		$tipo = "R";
		
	$new = new CurlRequest();
	
	$resultado0 = $new ->sendPost_sentinel_score($tipo, $dni);
	$obj0 = json_decode($resultado0);

	$Scoring = $obj0->Score;
	
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
		echo eval ("\$NomEnt_" . $i . "_" . $j . "= (isset(\$obj->soafulloutput->ConRap->DetSBSMicr[" . $i . "]->Detalle[" . $j . "]->NomEnt)) ? \$obj->soafulloutput->ConRap->DetSBSMicr[" . $i . "]->Detalle[" . $j . "]->NomEnt .' - S/ ' . number_format(\$obj->soafulloutput->ConRap->DetSBSMicr[" . $i . "]->Detalle[" . $j . "]->SalDeu,2) .' - ' . \$obj->soafulloutput->ConRap->DetSBSMicr[" . $i . "]->Detalle[" . $j . "]->Cal . ' - Días Venc: ' . \$obj->soafulloutput->ConRap->DetSBSMicr[" . $i . "]->Detalle[" . $j . "]->DiaVen . '<br>' : '';");
		}
	}
				
	for ($i = 0; $i <= 23; $i++) {
	
		echo eval ("\$calificacion_" . $i . "=\$calificacion_" . $i . "_0 . \$calificacion_" . $i . "_1 . \$calificacion_" .$i. "_2 . \$calificacion_" .$i. "_3 . \$calificacion_" .$i. "_4 . \$calificacion_" .$i. "_5 . \$calificacion_" .$i. "_6 . \$calificacion_" .$i. "_7 . \$calificacion_" .$i. "_8 . \$calificacion_" .$i. "_9;");
		echo eval ("\$Deuda_" . $i . "=\$Deuda_" . $i . "_0 + \$Deuda_" . $i . "_1 + \$Deuda_" .$i. "_2 + \$Deuda_" .$i. "_3 + \$Deuda_" .$i. "_4 + \$Deuda_" .$i. "_5 + \$Deuda_" .$i. "_6 + \$Deuda_" .$i. "_7 + \$Deuda_" .$i. "_8 + \$Deuda_" .$i. "_9;");
		echo eval ("\$NomEnt_" . $i . "=\$NomEnt_" . $i . "_0 . \$NomEnt_" . $i . "_1 . \$NomEnt_" .$i. "_2 . \$NomEnt_" .$i. "_3 . \$NomEnt_" .$i. "_4 . \$NomEnt_" .$i. "_5 . \$NomEnt_" .$i. "_6 . \$NomEnt_" .$i. "_7 . \$NomEnt_" .$i. "_8 . \$NomEnt_" .$i. "_9;");
					  
	}
				
	for ($i = 0; $i <= 23; $i++) {
		echo eval("\$entidades_" . $i . " = (strlen(\$calificacion_" . $i . ")/3);");
	}
				
	$negativo_ano1=0;

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
			$negativo_ano1++;
		}
		if($pos2!==FALSE and $cal=="V"){
			echo eval("\$calificacion_" . $i . "='DEF';");
			$cal = "F";
			$negativo_ano1++;
		}
		if($pos3!==FALSE and $cal=="V"){
			echo eval("\$calificacion_" . $i . "='DUD';");
			$cal = "F";
			$negativo_ano1++;
		}
		if($pos4!==FALSE and $cal=="V"){
			echo eval("\$calificacion_" . $i . "='CPP';");
			$cal = "F";
			$negativo_ano1++;
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
				
	$negativo_ano2=0;

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
			$negativo_ano2++;
		}
		if($pos2!==FALSE and $cal=="V"){
			echo eval("\$calificacion_" . $i . "='DEF';");
			$cal = "F";
			$negativo_ano2++;
		}
		if($pos3!==FALSE and $cal=="V"){
			echo eval("\$calificacion_" . $i . "='DUD';");
			$cal = "F";
			$negativo_ano2++;
		}
		if($pos4!==FALSE and $cal=="V"){
			echo eval("\$calificacion_" . $i . "='CPP';");
			$cal = "F";
			$negativo_ano2++;
			
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
	
	$LineaNoUtilizada = $LinAprTotal - $LinUtiTotal;
				
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
	$despues_cuotap = $sueldo_x_rci - $cuota_p - (0.06*$LineaNoUtilizada);
	//$despues_cuotap = $sueldo_x_rci - $cuota_p;
	
	$rci_score_desc = number_format(($rci*100),0) . "%";
	
	$tem_pf=(pow((1+$tasa),(1/12)))-1;
	$cuotas_18 = 18;
	$cuotas_24 = 24;
	$cuotas_36 = 36;
	$prestamo_final_18 = $despues_cuotap/(((((pow((1+$tem_pf),$cuotas_18))*$tem_pf)/((pow((1+$tem_pf),$cuotas_18))-1))));
	$prestamo_final_24 = $despues_cuotap/(((((pow((1+$tem_pf),$cuotas_24))*$tem_pf)/((pow((1+$tem_pf),$cuotas_24))-1))));
	$prestamo_final_36 = $despues_cuotap/(((((pow((1+$tem_pf),$cuotas_36))*$tem_pf)/((pow((1+$tem_pf),$cuotas_36))-1))));
	
	$descr_prestamo_scoring="";
	$tasa_desc = number_format($tasa*100, 0) . "%";
	
	if($Scoring>449 and $negativo_ano1==0 and $negativo_ano2==0)
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
		$descr_prestamo_scoring = "NO CALIFICA [SCORING] - Scoring menor a 450 / Mala calificación";
	}
	
	if($entidades_0 > 4 ){
		$descr_prestamo_scoring = "NO CALIFICA [SCORING] - Tiene mas de 4 entidades";
	}
	
	if($despues_cuotap<0){
		$descr_prestamo_scoring = "NO CALIFICA [SCORING] - No tiene oferta";
	}

	echo $NomLargo . " Score [" . $Scoring . "]" . "<br>";
	echo "Deudas en el Sistema S/ " . $Deuda_0 . "<br>";
	echo "Deuda Impagas S/ " . $Deuda_impaga . "<br>";
	echo "Mala Calificacion Año 1 [" . $negativo_ano1 . "] meses" . "<br>";
	echo "Mala Calificacion Año 2 [" . $negativo_ano2 . "] meses" . "<br>";
	echo "Entidades [" . $entidades_0 . "]" . "<br>";
	echo "Linea Total S/ " . $LinAprTotal . " || Linea Utilizada S/ " . $LinUtiTotal . "<br>";
	echo "Lo que queda para pagar S/ " . number_format($despues_cuotap,0) . "<br>";
	//echo $prestamo_final_18 . "<br>";
	//echo $prestamo_final_24 . "<br>";
	//echo $prestamo_final_36 . "<br>";
	echo $descr_prestamo_scoring;
?>