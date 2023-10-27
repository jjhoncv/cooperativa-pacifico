<?php
include_once 'infoweb2.php';
include_once 'persona_infoweb.php';
session_start();

$api = new ApiInfoweb();
$persona = new Persona();
    

$func = htmlspecialchars($_REQUEST["func"]);

	if($func==1){
	$dni = htmlspecialchars($_REQUEST["dni"]);
	$api->api_infoweb_1ra_llamada($dni);

	}

	if($func==2){
	$token = htmlspecialchars($_REQUEST["token"]);
	$dni = htmlspecialchars($_REQUEST["dni"]);
	$Scoring = htmlspecialchars($_REQUEST["scoring"]);
	$api->api_infoweb_2da_llamada($token, $dni, $Scoring);

	}
	
	if($func==3){
	$dni = htmlspecialchars($_REQUEST["dni"]);
	$colaborador="";
	
	$res = $persona->consulta_doi($dni);
	$cont=0;
	
	if($res->rowCount())
	{
            $row = $res->fetch(PDO::FETCH_ASSOC);
			$obj2 = json_decode($row['Json']);
			
			for ($j = 0; $j <= 23; $j++){
				
			echo eval ("\$ApiRuc_" . $j . "= (isset(\$obj2->listaRecordLaboral[" . $j . "]->ruc)) ? \$obj2->listaRecordLaboral[" . $j . "]->ruc : '';");
			echo eval ("\$ApiDevengue_" . $j . "= (isset(\$obj2->listaRecordLaboral[" . $j . "]->devengue)) ? \$obj2->listaRecordLaboral[" . $j . "]->devengue : '';");
			echo eval ("\$ApiEmpresa_" . $j . "= (isset(\$obj2->listaRecordLaboral[" . $j . "]->empresa)) ? \$obj2->listaRecordLaboral[" . $j . "]->empresa : '';");
			echo eval ("\$ApiCondicion_" . $j . "= (isset(\$obj2->listaRecordLaboral[" . $j . "]->condicion)) ? \$obj2->listaRecordLaboral[" . $j . "]->condicion : '';");
			echo eval ("\$Apip1_" . $j . "= (isset(\$obj2->listaRecordLaboral[" . $j . "]->p1)) ? \$obj2->listaRecordLaboral[" . $j . "]->p1 : 0;");
		}
		
	
		if($ApiRuc_0!="20111065013" and $ApiRuc_0!="20518941381" and $ApiRuc_0!="20552954689")
		{
				if($ApiRuc_0!="")
				{
				echo "<table class='table table-responsive table-striped text-center'>";
				echo "<thead>";
				echo "<tr>";
				echo "<th colspan='3' class='text-center'><h3>DNI [" . $dni . "] - Ult. actualización: " . $row['Fecha'] . " - <a href='javascript:confirmar(" . $dni . ")'><i class='fas fa-undo'></i></a>&nbsp;<button type='button' class='btn btn-success mb-3' id='crearpdf' onclick='window.print()'>Crear PDF</button> <a class='btn btn-success' href='infoweb'>Otra consulta</a></h3></th>";

				echo "</tr>";
				echo "</thead>";
				echo "</table>";
				
				echo "<input type='hidden' id='dni' name='dni' value='" . $dni . "'>";
				
				echo "<div class='container'>";
				echo "<div class='row'>";
				echo "<div class='col-sm'>"; // Primer div inicio
				
				echo "<table class='table table-responsive'>"; // Inico de tabla 1
				echo "<tr class='bg-secondary'>";
				echo "<th class='text-center'>Periodo</th><th class='text-center'>Ruc</th><th class='text-center'>Empresa</th><th class='text-center'>Condición</th><th class='text-center'>P1</th>";
				echo "</tr>";
				echo "<tr>";
				echo "<td class='text-center'>" . $ApiDevengue_0 . "</td><td class='text-center'>" . $ApiRuc_0 . "</td><td class='text-center'>" . $ApiEmpresa_0 . "</td><td class='text-center'>" . $ApiCondicion_0 . "</td><td class='text-center'>" . $Apip1_0 . "</td>";
				echo "</tr>";
				
				if($ApiDevengue_1!="")
				{	
				echo "<tr>";
				echo "<td class='text-center'>" . $ApiDevengue_1 . "</td><td class='text-center'>" . $ApiRuc_1 . "</td><td class='text-center'>" . $ApiEmpresa_1 . "</td><td class='text-center'>" . $ApiCondicion_1 . "</td><td class='text-center'>" . $Apip1_1 . "</td>";
				echo "</tr>";
				}
				
				if($ApiDevengue_2!="")
				{
				echo "<tr>";
				echo "<td class='text-center'>" . $ApiDevengue_2 . "</td><td class='text-center'>" . $ApiRuc_20 . "</td><td class='text-center'>" . $ApiEmpresa_2 . "</td><td class='text-center'>" . $ApiCondicion_2 . "</td><td class='text-center'>" . $Apip1_2 . "</td>";
				echo "</tr>";
				}
				
				if($ApiDevengue_3!="")
				{
				echo "<tr>";
				echo "<td class='text-center'>" . $ApiDevengue_3 . "</td><td class='text-center'>" . $ApiRuc_3 . "</td><td class='text-center'>" . $ApiEmpresa_3 . "</td><td class='text-center'>" . $ApiCondicion_3 . "</td><td class='text-center'>" . $Apip1_3 . "</td>";
				echo "</tr>";
				}
				
				if($ApiDevengue_4!="")
				{
				echo "<tr>";
				echo "<td class='text-center'>" . $ApiDevengue_4 . "</td><td class='text-center'>" . $ApiRuc_4 . "</td><td class='text-center'>" . $ApiEmpresa_4 . "</td><td class='text-center'>" . $ApiCondicion_4 . "</td><td class='text-center'>" . $Apip1_4 . "</td>";
				echo "</tr>";
				}
				
				if($ApiDevengue_5!="")
				{
				echo "<tr>";
				echo "<td class='text-center'>" . $ApiDevengue_5 . "</td><td class='text-center'>" . $ApiRuc_5 . "</td><td class='text-center'>" . $ApiEmpresa_5 . "</td><td class='text-center'>" . $ApiCondicion_5 . "</td><td class='text-center'>" . $Apip1_5 . "</td>";
				echo "</tr>";
				}
				
				if($ApiDevengue_6!="")
				{
				echo "<tr>";
				echo "<td class='text-center'>" . $ApiDevengue_6 . "</td><td class='text-center'>" . $ApiRuc_6 . "</td><td class='text-center'>" . $ApiEmpresa_6 . "</td><td class='text-center'>" . $ApiCondicion_6 . "</td><td class='text-center'>" . $Apip1_6 . "</td>";
				echo "</tr>";
				}
				
				if($ApiDevengue_7!="")
				{
				echo "<tr>";
				echo "<td class='text-center'>" . $ApiDevengue_7 . "</td><td class='text-center'>" . $ApiRuc_7 . "</td><td class='text-center'>" . $ApiEmpresa_7 . "</td><td class='text-center'>" . $ApiCondicion_7 . "</td><td class='text-center'>" . $Apip1_7 . "</td>";
				echo "</tr>";
				}
				
				if($ApiDevengue_8!="")
				{
				echo "<tr>";
				echo "<td class='text-center'>" . $ApiDevengue_8 . "</td><td class='text-center'>" . $ApiRuc_8 . "</td><td class='text-center'>" . $ApiEmpresa_8 . "</td><td class='text-center'>" . $ApiCondicion_8 . "</td><td class='text-center'>" . $Apip1_8 . "</td>";
				echo "</tr>";
				}
				
				if($ApiDevengue_9!="")
				{
				echo "<tr>";
				echo "<td class='text-center'>" . $ApiDevengue_9 . "</td><td class='text-center'>" . $ApiRuc_9 . "</td><td class='text-center'>" . $ApiEmpresa_9 . "</td><td class='text-center'>" . $ApiCondicion_9 . "</td><td class='text-center'>" . $Apip1_9 . "</td>";
				echo "</tr>";
				}
				
				if($ApiDevengue_10!="")
				{
				echo "<tr>";
				echo "<td class='text-center'>" . $ApiDevengue_10 . "</td><td class='text-center'>" . $ApiRuc_10 . "</td><td class='text-center'>" . $ApiEmpresa_10 . "</td><td class='text-center'>" . $ApiCondicion_10 . "</td><td class='text-center'>" . $Apip1_10 . "</td>";
				echo "</tr>";
				}
				
				if($ApiDevengue_11!="")
				{
				echo "<tr>";
				echo "<td class='text-center'>" . $ApiDevengue_11 . "</td><td class='text-center'>" . $ApiRuc_11 . "</td><td class='text-center'>" . $ApiEmpresa_11 . "</td><td class='text-center'>" . $ApiCondicion_11 . "</td><td class='text-center'>" . $Apip1_11 . "</td>";
				echo "</tr>";
				}
				
				if($ApiDevengue_12!="")
				{
				echo "<tr>";
				echo "<td class='text-center'>" . $ApiDevengue_12 . "</td><td class='text-center'>" . $ApiRuc_12 . "</td><td class='text-center'>" . $ApiEmpresa_12 . "</td><td class='text-center'>" . $ApiCondicion_12 . "</td><td class='text-center'>" . $Apip1_12 . "</td>";
				echo "</tr>";
				}
				
				if($ApiDevengue_13!="")
				{
				echo "<tr>";
				echo "<td class='text-center'>" . $ApiDevengue_13 . "</td><td class='text-center'>" . $ApiRuc_13 . "</td><td class='text-center'>" . $ApiEmpresa_13 . "</td><td class='text-center'>" . $ApiCondicion_13 . "</td><td class='text-center'>" . $Apip1_13 . "</td>";
				echo "</tr>";
				}
				
				if($ApiDevengue_14!="")
				{
				echo "<tr>";
				echo "<td class='text-center'>" . $ApiDevengue_14 . "</td><td class='text-center'>" . $ApiRuc_14 . "</td><td class='text-center'>" . $ApiEmpresa_14 . "</td><td class='text-center'>" . $ApiCondicion_14 . "</td><td class='text-center'>" . $Apip1_14 . "</td>";
				echo "</tr>";
				}
				
				if($ApiDevengue_15!="")
				{
				echo "<tr>";
				echo "<td class='text-center'>" . $ApiDevengue_15 . "</td><td class='text-center'>" . $ApiRuc_15 . "</td><td class='text-center'>" . $ApiEmpresa_15 . "</td><td class='text-center'>" . $ApiCondicion_15 . "</td><td class='text-center'>" . $Apip1_15 . "</td>";
				echo "</tr>";
				}
				
				if($ApiDevengue_16!="")
				{
				echo "<tr>";
				echo "<td class='text-center'>" . $ApiDevengue_16 . "</td><td class='text-center'>" . $ApiRuc_16 . "</td><td class='text-center'>" . $ApiEmpresa_16 . "</td><td class='text-center'>" . $ApiCondicion_16 . "</td><td class='text-center'>" . $Apip1_16 . "</td>";
				echo "</tr>";
				}
				
				if($ApiDevengue_17!="")
				{
				echo "<tr>";
				echo "<td class='text-center'>" . $ApiDevengue_17 . "</td><td class='text-center'>" . $ApiRuc_17 . "</td><td class='text-center'>" . $ApiEmpresa_17 . "</td><td class='text-center'>" . $ApiCondicion_17 . "</td><td class='text-center'>" . $Apip1_17 . "</td>";
				echo "</tr>";
				}
				
				if($ApiDevengue_18!="")
				{
				echo "<tr>";
				echo "<td class='text-center'>" . $ApiDevengue_18 . "</td><td class='text-center'>" . $ApiRuc_18 . "</td><td class='text-center'>" . $ApiEmpresa_18 . "</td><td class='text-center'>" . $ApiCondicion_18 . "</td><td class='text-center'>" . $Apip1_18 . "</td>";
				echo "</tr>";
				}
				
				if($ApiDevengue_19!="")
				{
				echo "<tr>";
				echo "<td class='text-center'>" . $ApiDevengue_19 . "</td><td class='text-center'>" . $ApiRuc_19 . "</td><td class='text-center'>" . $ApiEmpresa_19 . "</td><td class='text-center'>" . $ApiCondicion_19 . "</td><td class='text-center'>" . $Apip1_19 . "</td>";
				echo "</tr>";
				}
				
				if($ApiDevengue_20!="")
				{
				echo "<tr>";
				echo "<td class='text-center'>" . $ApiDevengue_20 . "</td><td class='text-center'>" . $ApiRuc_20 . "</td><td class='text-center'>" . $ApiEmpresa_20 . "</td><td class='text-center'>" . $ApiCondicion_20 . "</td><td class='text-center'>" . $Apip1_20 . "</td>";
				echo "</tr>";
				}
				
				if($ApiDevengue_21!="")
				{
				echo "<tr>";
				echo "<td class='text-center'>" . $ApiDevengue_21 . "</td><td class='text-center'>" . $ApiRuc_21 . "</td><td class='text-center'>" . $ApiEmpresa_21 . "</td><td class='text-center'>" . $ApiCondicion_21 . "</td><td class='text-center'>" . $Apip1_21 . "</td>";
				echo "</tr>";
				}
				
				if($ApiDevengue_22!="")
				{
				echo "<tr>";
				echo "<td class='text-center'>" . $ApiDevengue_22 . "</td><td class='text-center'>" . $ApiRuc_22 . "</td><td class='text-center'>" . $ApiEmpresa_22 . "</td><td class='text-center'>" . $ApiCondicion_22 . "</td><td class='text-center'>" . $Apip1_22 . "</td>";
				echo "</tr>";
				}
				
				if($ApiDevengue_23!="")
				{
				echo "<tr>";
				echo "<td class='text-center'>" . $ApiDevengue_23 . "</td><td class='text-center'>" . $ApiRuc_23 . "</td><td class='text-center'>" . $ApiEmpresa_23 . "</td><td class='text-center'>" . $ApiCondicion_23 . "</td><td class='text-center'>" . $Apip1_23 . "</td>";
				echo "</tr>";
				}
				
				echo "</table>"; // Fin de tabla 1
				
				echo "</div>"; // Fin de primer div
				
				
				echo "</div>";
				echo "</div>";
				
				// Sentinel Inicio
				$res2 = $persona->consulta_doi_sentinel($dni);
				$cont_sentinel=0;
				
				if($res2->rowCount())
				{
					$row2 = $res2->fetch(PDO::FETCH_ASSOC);
					$obj = json_decode($row2['Json']);
					$cont_sentinel=1;
					
					$Nom = $obj->soafulloutput->InfBas->Nom;
					$ApePat = $obj->soafulloutput->InfBas->ApePat;
					$ApeMat = $obj->soafulloutput->InfBas->ApeMat;
					$AnoNac = $obj->soafulloutput->InfBas->FecNac;
					$AnoNac = substr($AnoNac,0,4);
					$AnoNac = intval($AnoNac);
					$AnoAct = $obj->soafulloutput->InfBas->IniAct;
					$AnoAct = substr($AnoAct,0,4);
					$AnoAct	= intval($AnoAct);
					$NomLargo = $ApePat . " " . $ApeMat . ", " . $Nom;
					
					for ($i = 0; $i <= 23; $i++) {
        
					echo eval ("\$Ano_" . $i. "= \$obj->soafulloutput->ConRap->DetSBSMicr[" . $i . "]->ano;");
					echo eval ("\$Mes_" . $i. "= \$obj->soafulloutput->ConRap->DetSBSMicr[" . $i . "]->mes;");
					
					for ($j = 0; $j <= 9; $j++){
						
						echo eval ("\$Deuda_" . $i . "_" . $j . "= (isset(\$obj->soafulloutput->ConRap->DetSBSMicr[" . $i . "]->Detalle[" . $j . "]->SalDeu)) ? \$obj->soafulloutput->ConRap->DetSBSMicr[" . $i . "]->Detalle[" . $j . "]->SalDeu : 0;");
						echo eval ("\$calificacion_" . $i . "_" . $j . " = ((isset(\$obj->soafulloutput->ConRap->DetSBSMicr[" . $i . "]->Detalle[" . $j . "]->Cal))) ? \$obj->soafulloutput->ConRap->DetSBSMicr[" . $i . "]->Detalle[" . $j . "]->Cal : '';");
						
					
						echo eval ("\$calificacion_" . $i . "_" . $j . " = (((\$calificacion_" . $i . "_" . $j . "=='DEF') or (\$calificacion_" . $i . "_" . $j . "=='CPP') or (\$calificacion_" . $i . "_" . $j . "=='DUD') or (\$calificacion_" . $i . "_" . $j . "=='PER')) and (\$obj->soafulloutput->ConRap->DetSBSMicr[" . $i . "]->Detalle[" . $j . "]->SalDeu < 100)) ? 'NOR' : \$calificacion_" . $i . "_" . $j . ";");
						echo eval ("\$NomEnt_" . $i . "_" . $j . "= (isset(\$obj->soafulloutput->ConRap->DetSBSMicr[" . $i . "]->Detalle[" . $j . "]->NomEnt)) ? \$obj->soafulloutput->ConRap->DetSBSMicr[" . $i . "]->Detalle[" . $j . "]->NomEnt .' - S/ ' . number_format(\$obj->soafulloutput->ConRap->DetSBSMicr[" . $i . "]->Detalle[" . $j . "]->SalDeu,2) . ' - ' . \$calificacion_" . $i . "_" . $j . " . ' - Días Venc: ' . \$obj->soafulloutput->ConRap->DetSBSMicr[" . $i . "]->Detalle[" . $j . "]->DiaVen . '<br>' : '';");
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
				
				for ($i = 0; $i <= 11; $i++) { // Primer 1 año (12 meses)
				
						$pos1="";$pos2="";$pos3="";$pos4="";$pos5="";$cal="V";
						
						echo eval("\$pos1 = strpos(\$calificacion_" . $i . ",'PER');");
						echo eval("\$pos2 = strpos(\$calificacion_" . $i . ",'DEF');");
						echo eval("\$pos3 = strpos(\$calificacion_" . $i . ",'DUD');");
						echo eval("\$pos4 = strpos(\$calificacion_" . $i . ",'CPP');");
						echo eval("\$pos5 = strpos(\$calificacion_" . $i . ",'NOR');");
						
						if($pos1!==FALSE and $cal=="V"){
							echo eval("\$calificacion_" . $i . "='<button type=button class=\"btn btn-dark btn-xs\">PER</button>';");
							$cal = "F";
							
						}
						if($pos2!==FALSE and $cal=="V"){
							echo eval("\$calificacion_" . $i . "='<button type=button class=\"btn btn-danger btn-xs\">DEF</button>';");
							$cal = "F";
							
						}
						if($pos3!==FALSE and $cal=="V"){
							echo eval("\$calificacion_" . $i . "='<button type=button class=\"btn btn-danger btn-xs\">DUD</button>';");
							$cal = "F";
							
						}
						if($pos4!==FALSE and $cal=="V"){
							echo eval("\$calificacion_" . $i . "='<button type=button class=\"btn btn-warning btn-xs\">CPP</button>';");
							$cal = "F";
							
						}
						if($pos5!==FALSE and $cal=="V"){
							echo eval("\$calificacion_" . $i . "='<button type=button class=\"btn btn-success btn-xs\">NOR</button>';");
							$cal = "F";
							
						}
						if($cal=="V"){
							echo eval("\$calificacion_" . $i . "='';");
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
							echo eval("\$calificacion_" . $i . "='<button type=button class=\"btn btn-dark btn-xs\">PER</button>';");
							$cal = "F";
							
						}
						if($pos2!==FALSE and $cal=="V"){
							echo eval("\$calificacion_" . $i . "='<button type=button class=\"btn btn-danger btn-xs\">DEF</button>';");
							$cal = "F";
							
						}
						if($pos3!==FALSE and $cal=="V"){
							echo eval("\$calificacion_" . $i . "='<button type=button class=\"btn btn-danger btn-xs\">DUD</button>';");
							$cal = "F";
							
						}
						if($pos4!==FALSE and $cal=="V"){
							echo eval("\$calificacion_" . $i . "='<button type=button class=\"btn btn-warning btn-xs\">CPP</button>';");
							$cal = "F";
							
						}
						if($pos5!==FALSE and $cal=="V"){
							echo eval("\$calificacion_" . $i . "='<button type=button class=\"btn btn-success btn-xs\">NOR</button>';");
							$cal = "F";
							
						}
						if($cal=="V"){
							echo eval("\$calificacion_" . $i . "='';");
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
				
				$Deuda_impaga = (isset($obj->soafulloutput->ConRap->DetVen[0]->VenTot)) ? $obj->soafulloutput->ConRap->DetVen[0]->VenTot : 0;
				
				for ($i = 0; $i <= 8; $i++){
					echo eval ("\$Deuda_Imp" . $i . "= (isset(\$obj->soafulloutput->ConRap->DetVen[0]->DetalleVencidos[" . $i . "]->NomEnt)) ? \$obj->soafulloutput->ConRap->DetVen[0]->DetalleVencidos[" . $i . "]->NomEnt . ' - S/ ' . number_format(\$obj->soafulloutput->ConRap->DetVen[0]->DetalleVencidos[" . $i . "]->MontDeu,2) . ' - Dias Vencidos : ' . \$obj->soafulloutput->ConRap->DetVen[0]->DetalleVencidos[" . $i . "]->DiaVen . '<br>': '';");
				}
				
				$DeuImpTotal = $Deuda_Imp0 . $Deuda_Imp1 . $Deuda_Imp2 . $Deuda_Imp3 . $Deuda_Imp4 . $Deuda_Imp5 . $Deuda_Imp6 . $Deuda_Imp7 . $Deuda_Imp8;
				//echo "<table class='table table-responsive table-striped text-center'>";
				echo "<div class='container'>";
				echo "<div class='row'>";
				echo "<div class='col-sm'>"; // Primer div inicio
				
				echo "<table class='table table-responsive table-striped'>";
				echo "<thead>";
				echo "<tr class='bg-success'>";
                echo "<th colspan='8' class='text-center'>" . $dni . " - [" . $AnoNac . "]  - " . $NomLargo . "</th>";
                echo "</tr>";
				echo "</thead>";
				echo "<tbody>";
				echo "<tr>";
                echo "<td class='bg-primary text-center'>" . substr($Ano_0,2,2) . "-" . $Mes_0 . "</td>";
                echo "<td class='text-center'>" . $calificacion_0 . "</td>";
                echo "<td class='text-center'>" . number_format($Deuda_0,0) . "</td>";
                echo "<td class='text-center'><button type='button' class='btn btn-secondary btn-xs' data-toggle='modal' data-target='#exampleModalCenter0'>" . $entidades_0 . " 🏦</button></td>";
                echo "<td class='bg-primary text-center'>" . substr($Ano_12,2,2) . "-" . $Mes_12 . "</td>";
                echo "<td class='text-center'>" . $calificacion_12 . "</td>";
                echo "<td class='text-center'>" . number_format($Deuda_12,0) . "</td>";
                echo "<td class='text-center'><button type='button' class='btn btn-secondary btn-xs' data-toggle='modal' data-target='#exampleModalCenter12'>" . $entidades_12 . " 🏦</button></td>";
				echo "</tr>";
				echo "<tr>";
                echo "<td class='bg-primary text-center'>" . substr($Ano_1,2,2) . "-" . $Mes_1 . "</td>";
                echo "<td class='text-center'>" . $calificacion_1 . "</td>";
                echo "<td class='text-center'>" . number_format($Deuda_1,0) . "</td>";
                echo "<td class='text-center'><button type='button' class='btn btn-secondary btn-xs' data-toggle='modal' data-target='#exampleModalCenter0'>" . $entidades_1 . " 🏦</button></td>";
                echo "<td class='bg-primary text-center'>" . substr($Ano_13,2,2) . "-" . $Mes_13 . "</td>";
                echo "<td class='text-center'>" . $calificacion_13 . "</td>";
                echo "<td class='text-center'>" . number_format($Deuda_13,0) . "</td>";
                echo "<td class='text-center'><button type='button' class='btn btn-secondary btn-xs' data-toggle='modal' data-target='#exampleModalCenter12'>" . $entidades_13 . " 🏦</button></td>";
				echo "</tr>";
				echo "<tr>";
                echo "<td class='bg-primary text-center'>" . substr($Ano_2,2,2) . "-" . $Mes_2 . "</td>";
                echo "<td class='text-center'>" . $calificacion_2 . "</td>";
                echo "<td class='text-center'>" . number_format($Deuda_2,0) . "</td>";
                echo "<td class='text-center'><button type='button' class='btn btn-secondary btn-xs' data-toggle='modal' data-target='#exampleModalCenter0'>" . $entidades_2 . " 🏦</button></td>";
                echo "<td class='bg-primary text-center'>" . substr($Ano_14,2,2) . "-" . $Mes_14 . "</td>";
                echo "<td class='text-center'>" . $calificacion_14 . "</td>";
                echo "<td class='text-center'>" . number_format($Deuda_14,0) . "</td>";
                echo "<td class='text-center'><button type='button' class='btn btn-secondary btn-xs' data-toggle='modal' data-target='#exampleModalCenter12'>" . $entidades_14 . " 🏦</button></td>";
				echo "</tr>";
				echo "<tr>";
                echo "<td class='bg-primary text-center'>" . substr($Ano_3,2,2) . "-" . $Mes_3 . "</td>";
                echo "<td class='text-center'>" . $calificacion_3 . "</td>";
                echo "<td class='text-center'>" . number_format($Deuda_3,0) . "</td>";
                echo "<td class='text-center'><button type='button' class='btn btn-secondary btn-xs' data-toggle='modal' data-target='#exampleModalCenter0'>" . $entidades_3 . " 🏦</button></td>";
                echo "<td class='bg-primary text-center'>" . substr($Ano_15,2,2) . "-" . $Mes_15 . "</td>";
                echo "<td class='text-center'>" . $calificacion_15 . "</td>";
                echo "<td class='text-center'>" . number_format($Deuda_15,0) . "</td>";
                echo "<td class='text-center'><button type='button' class='btn btn-secondary btn-xs' data-toggle='modal' data-target='#exampleModalCenter12'>" . $entidades_15 . " 🏦</button></td>";
				echo "</tr>";
				echo "<tr>";
                echo "<td class='bg-primary text-center'>" . substr($Ano_4,2,2) . "-" . $Mes_4 . "</td>";
                echo "<td class='text-center'>" . $calificacion_4 . "</td>";
                echo "<td class='text-center'>" . number_format($Deuda_4,0) . "</td>";
                echo "<td class='text-center'><button type='button' class='btn btn-secondary btn-xs' data-toggle='modal' data-target='#exampleModalCenter0'>" . $entidades_4 . " 🏦</button></td>";
                echo "<td class='bg-primary text-center'>" . substr($Ano_16,2,2) . "-" . $Mes_16 . "</td>";
                echo "<td class='text-center'>" . $calificacion_16 . "</td>";
                echo "<td class='text-center'>" . number_format($Deuda_16,0) . "</td>";
                echo "<td class='text-center'><button type='button' class='btn btn-secondary btn-xs' data-toggle='modal' data-target='#exampleModalCenter12'>" . $entidades_16 . " 🏦</button></td>";
				echo "</tr>";
				echo "<tr>";
                echo "<td class='bg-primary text-center'>" . substr($Ano_5,2,2) . "-" . $Mes_5 . "</td>";
                echo "<td class='text-center'>" . $calificacion_5 . "</td>";
                echo "<td class='text-center'>" . number_format($Deuda_5,0) . "</td>";
                echo "<td class='text-center'><button type='button' class='btn btn-secondary btn-xs' data-toggle='modal' data-target='#exampleModalCenter0'>" . $entidades_5 . " 🏦</button></td>";
                echo "<td class='bg-primary text-center'>" . substr($Ano_17,2,2) . "-" . $Mes_17 . "</td>";
                echo "<td class='text-center'>" . $calificacion_17 . "</td>";
                echo "<td class='text-center'>" . number_format($Deuda_17,0) . "</td>";
                echo "<td class='text-center'><button type='button' class='btn btn-secondary btn-xs' data-toggle='modal' data-target='#exampleModalCenter12'>" . $entidades_17 . " 🏦</button></td>";
				echo "</tr>";
				echo "<tr>";
                echo "<td class='bg-primary text-center'>" . substr($Ano_6,2,2) . "-" . $Mes_6 . "</td>";
                echo "<td class='text-center'>" . $calificacion_6 . "</td>";
                echo "<td class='text-center'>" . number_format($Deuda_6,0) . "</td>";
                echo "<td class='text-center'><button type='button' class='btn btn-secondary btn-xs' data-toggle='modal' data-target='#exampleModalCenter0'>" . $entidades_6 . " 🏦</button></td>";
                echo "<td class='bg-primary text-center'>" . substr($Ano_18,2,2) . "-" . $Mes_18 . "</td>";
                echo "<td class='text-center'>" . $calificacion_18. "</td>";
                echo "<td class='text-center'>" . number_format($Deuda_18,0) . "</td>";
                echo "<td class='text-center'><button type='button' class='btn btn-secondary btn-xs' data-toggle='modal' data-target='#exampleModalCenter12'>" . $entidades_18 . " 🏦</button></td>";
				echo "</tr>";
				echo "<tr>";
                echo "<td class='bg-primary text-center'>" . substr($Ano_7,2,2) . "-" . $Mes_7 . "</td>";
                echo "<td class='text-center'>" . $calificacion_7 . "</td>";
                echo "<td class='text-center'>" . number_format($Deuda_7,0) . "</td>";
                echo "<td class='text-center'><button type='button' class='btn btn-secondary btn-xs' data-toggle='modal' data-target='#exampleModalCenter0'>" . $entidades_7 . " 🏦</button></td>";
                echo "<td class='bg-primary text-center'>" . substr($Ano_19,2,2) . "-" . $Mes_19 . "</td>";
                echo "<td class='text-center'>" . $calificacion_19 . "</td>";
                echo "<td class='text-center'>" . number_format($Deuda_19,0) . "</td>";
                echo "<td class='text-center'><button type='button' class='btn btn-secondary btn-xs' data-toggle='modal' data-target='#exampleModalCenter12'>" . $entidades_19 . " 🏦</button></td>";
				echo "</tr>";
				echo "<tr>";
                echo "<td class='bg-primary text-center'>" . substr($Ano_8,2,2) . "-" . $Mes_8 . "</td>";
                echo "<td class='text-center'>" . $calificacion_8 . "</td>";
                echo "<td class='text-center'>" . number_format($Deuda_8,0) . "</td>";
                echo "<td class='text-center'><button type='button' class='btn btn-secondary btn-xs' data-toggle='modal' data-target='#exampleModalCenter0'>" . $entidades_8 . " 🏦</button></td>";
                echo "<td class='bg-primary text-center'>" . substr($Ano_20,2,2) . "-" . $Mes_20 . "</td>";
                echo "<td class='text-center'>" . $calificacion_20 . "</td>";
                echo "<td class='text-center'>" . number_format($Deuda_20,0) . "</td>";
                echo "<td class='text-center'><button type='button' class='btn btn-secondary btn-xs' data-toggle='modal' data-target='#exampleModalCenter12'>" . $entidades_20 . " 🏦</button></td>";
				echo "</tr>";
				echo "<tr>";
                echo "<td class='bg-primary text-center'>" . substr($Ano_9,2,2) . "-" . $Mes_9 . "</td>";
                echo "<td class='text-center'>" . $calificacion_9 . "</td>";
                echo "<td class='text-center'>" . number_format($Deuda_9,0) . "</td>";
                echo "<td class='text-center'><button type='button' class='btn btn-secondary btn-xs' data-toggle='modal' data-target='#exampleModalCenter0'>" . $entidades_9 . " 🏦</button></td>";
                echo "<td class='bg-primary text-center'>" . substr($Ano_21,2,2) . "-" . $Mes_21 . "</td>";
                echo "<td class='text-center'>" . $calificacion_21 . "</td>";
                echo "<td class='text-center'>" . number_format($Deuda_21,0) . "</td>";
                echo "<td class='text-center'><button type='button' class='btn btn-secondary btn-xs' data-toggle='modal' data-target='#exampleModalCenter12'>" . $entidades_21 . " 🏦</button></td>";
				echo "</tr>";
				echo "<tr>";
                echo "<td class='bg-primary text-center'>" . substr($Ano_10,2,2) . "-" . $Mes_10 . "</td>";
                echo "<td class='text-center'>" . $calificacion_10 . "</td>";
                echo "<td class='text-center'>" . number_format($Deuda_10,0) . "</td>";
                echo "<td class='text-center'><button type='button' class='btn btn-secondary btn-xs' data-toggle='modal' data-target='#exampleModalCenter0'>" . $entidades_10 . " 🏦</button></td>";
                echo "<td class='bg-primary text-center'>" . substr($Ano_22,2,2) . "-" . $Mes_22 . "</td>";
                echo "<td class='text-center'>" . $calificacion_22 . "</td>";
                echo "<td class='text-center'>" . number_format($Deuda_22,0) . "</td>";
                echo "<td class='text-center'><button type='button' class='btn btn-secondary btn-xs' data-toggle='modal' data-target='#exampleModalCenter12'>" . $entidades_22 . " 🏦</button></td>";
				echo "</tr>";
				echo "<tr>";
                echo "<td class='bg-primary text-center'>" . substr($Ano_11,2,2) . "-" . $Mes_11 . "</td>";
                echo "<td class='text-center'>" . $calificacion_11 . "</td>";
                echo "<td class='text-center'>" . number_format($Deuda_11,0) . "</td>";
                echo "<td class='text-center'><button type='button' class='btn btn-secondary btn-xs' data-toggle='modal' data-target='#exampleModalCenter0'>" . $entidades_11 . " 🏦</button></td>";
                echo "<td class='bg-primary text-center'>" . substr($Ano_23,2,2) . "-" . $Mes_23 . "</td>";
                echo "<td class='text-center'>" . $calificacion_23 . "</td>";
                echo "<td class='text-center'>" . number_format($Deuda_23,0) . "</td>";
                echo "<td class='text-center'><button type='button' class='btn btn-secondary btn-xs' data-toggle='modal' data-target='#exampleModalCenter12'>" . $entidades_23 . " 🏦</button></td>";
				echo "</tr>";
				
                echo "</tbody>";
				echo "</table>";
				
				echo "</div>"; // Fin de primer div
				
				
				echo "</div>";
				echo "</div>";
				
				}
				
				if($cont_sentinel==0)
				{
					$api->api_sentinel_llamada($dni);
					
				}
				
				
				
				echo "<br>";
				
				// Sentinel Fin
				
				}
				else
				{
					echo "<h3>DNI sin información</h3>" . "<br>";
				}
    
				$colaborador="N";
				
		}else{
			echo "<h3>Restringido - Colaborador Cooperativa Pacifico</h3>" . "<br>";	
			$colaborador="S";
		}
		
		echo "<a class='btn btn-success' href='infoweb'>Volver</a><br><br>";
			
		$cont=1;
		
		$usuario = $_SESSION["acceso_pacinet"];
		$persona->ingresa_repo($dni, $usuario, $colaborador, "N");
	}		
		
	if($cont==0){
		$api->api_infoweb_3ra_llamada($dni);
	}
	}
	
	if($func==4){
	$dni = htmlspecialchars($_REQUEST["dni"]);
	$api->api_infoweb_3ra_llamada($dni);
	}
?>