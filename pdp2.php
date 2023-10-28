<?php
include_once 'test.php';
setlocale(LC_ALL,"es_ES");

$dni = trim(htmlspecialchars($_POST["dni"]));
$sueldo = trim(htmlspecialchars($_POST["sueldo"]));
$equipo = htmlspecialchars($_POST["equipo"]);

if($dni=="")
	$dni = trim(htmlspecialchars($_GET["dni"]));

if($dni!=""){

$tipo = (strlen($dni)==11) ? "R" : "D";

$new = new CurlRequest();
$resultado0 = $new ->sendPost_sentinel_score($tipo, $dni);
$obj0 = json_decode($resultado0);

	$Bancarizado = $obj0->Bancarizado;
	$Score = $obj0->Score;
	$NivelRiesgo = $obj0->NivelRiesgo;
	$FlagB12M = $obj0->FlagB12M;
	$CodigoWS = $obj0->CodigoWS;


$resultado = $new ->sendPost_sentinel($tipo, $dni);
$obj = json_decode($resultado);

    $Nom = $obj->soafulloutput->InfBas->Nom;
    $ApePat = $obj->soafulloutput->InfBas->ApePat;
    $ApeMat = $obj->soafulloutput->InfBas->ApeMat;
    $AnoNac = $obj->soafulloutput->InfBas->FecNac;
    $AnoNac = substr($AnoNac,0,4);
	$AnoNac = intval($AnoNac);
	$AnoAct = $obj->soafulloutput->InfBas->IniAct;
    $AnoAct = substr($AnoAct,0,4);
	$AnoAct	= intval($AnoAct);
	$score = 0;
	
	$NomLargo = $ApePat . " " . $ApeMat . ", " . $Nom;
	
	if($tipo=="R"){
		
		$AnoNac = $AnoAct;
		$ActEco = $obj->soafulloutput->InfBas->ActEco;
		$NomLargo = $obj->soafulloutput->InfBas->RazSoc . " (" . $ActEco . ")";
		
	}
	
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
	
	$contador_ano1=0;
	$contador_sca_ano1=0;

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
				$score = 0 + $score;
			}
			if($pos2!==FALSE and $cal=="V"){
				echo eval("\$calificacion_" . $i . "='<button type=button class=\"btn btn-danger btn-xs\">DEF</button>';");
				$cal = "F";
				$score = 4.95 + $score;
			}
			if($pos3!==FALSE and $cal=="V"){
				echo eval("\$calificacion_" . $i . "='<button type=button class=\"btn btn-danger btn-xs\">DUD</button>';");
				$cal = "F";
				$score = 9.91 + $score;
			}
			if($pos4!==FALSE and $cal=="V"){
				echo eval("\$calificacion_" . $i . "='<button type=button class=\"btn btn-warning btn-xs\">CPP</button>';");
				$cal = "F";
				$score = 19.83 + $score;
				$contador_ano1=$contador_ano1 + 0.5;
			}
			if($pos5!==FALSE and $cal=="V"){
				echo eval("\$calificacion_" . $i . "='<button type=button class=\"btn btn-success btn-xs\">NOR</button>';");
				$cal = "F";
				$score = 24.79 + $score;
				$contador_ano1++;
			}
			if($cal=="V"){
				echo eval("\$calificacion_" . $i . "='';");
				$cal = "F";
				$score = 14.87 + $score;
				$contador_ano1++;
				$contador_sca_ano1++;
			}
			
	}
	
	$contador_ano2=0;
	$contador_sca_ano2=0;
	
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
				$score = 0 + $score;
			}
			if($pos2!==FALSE and $cal=="V"){
				echo eval("\$calificacion_" . $i . "='<button type=button class=\"btn btn-danger btn-xs\">DEF</button>';");
				$cal = "F";
				$score = 2.13 + $score;
			}
			if($pos3!==FALSE and $cal=="V"){
				echo eval("\$calificacion_" . $i . "='<button type=button class=\"btn btn-danger btn-xs\">DUD</button>';");
				$cal = "F";
				$score = 4.25 + $score;
			}
			if($pos4!==FALSE and $cal=="V"){
				echo eval("\$calificacion_" . $i . "='<button type=button class=\"btn btn-warning btn-xs\">CPP</button>';");
				$cal = "F";
				$score = 8.5 + $score;
				$contador_ano2=$contador_ano2 + 0.5;
			}
			if($pos5!==FALSE and $cal=="V"){
				echo eval("\$calificacion_" . $i . "='<button type=button class=\"btn btn-success btn-xs\">NOR</button>';");
				$cal = "F";
				$score = 10.63 + $score;
				$contador_ano2++;
			}
			if($cal=="V"){
				echo eval("\$calificacion_" . $i . "='';");
				$cal = "F";
				$score = 6.38 + $score;
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
	
	$resultado_cal="";
	$encontrado = "V";
	$cuota = (0.3*$sueldo)-($Deuda_0/18)-10;
	$saldo_pagar = (8*$sueldo)-$Deuda_0;
	
	if(($contador_ano1==12 and $contador_sca_ano1==0) or ($contador_ano1>11 and $contador_ano2>11)){
		if($Deuda_impaga>500){
			$resultado_cal="NO CALIFICA - Deuda Impaga mayor a S/ 500";}
		if($entidades_0>4){
			$resultado_cal="NO CALIFICA - 5 Entidades";}
		if($cuota < 275){
			$resultado_cal="NO CALIFICA - PEX - RCI, cuota menor a 275";}
		if($saldo_pagar<4000){
			$resultado_cal="NO CALIFICA - EXPRESS - RCI";}
		
	
		if($Deuda_impaga<500 and $cuota>587 and $encontrado=="V" and $entidades_0<5)
		{
			$resultado_cal = "PRE-APROBADO - Importe S/ 15,000 | Plazo 36 meses | Cuota mensual aproximada S/ 587.96 | TCEA 24% ";
			$encontrado = "F";
		}
		if($Deuda_impaga<500 and $cuota>549 and $encontrado=="V" and $entidades_0<5)
		{
			$resultado_cal = "PRE-APROBADO - Importe S/ 14,000 | Plazo 36 meses | Cuota mensual aproximada S/ 549.43 | TCEA 24% ";
			$encontrado = "F";
		}
		if($Deuda_impaga<500 and $cuota>510 and $encontrado=="V" and $entidades_0<5)
		{
		   $resultado_cal = "PRE-APROBADO - Importe S/ 13,000 | Plazo 36 meses | Cuota mensual aproximada S/ 510.89 | TCEA 24% ";
		   $encontrado = "F";
		}
		if($Deuda_impaga<500 and $cuota>472 and $encontrado=="V" and $entidades_0<5)
		{
			$resultado_cal = "PRE-APROBADO - Importe S/ 12,000 | Plazo 36 meses | Cuota mensual aproximada S/ 472.36 | TCEA 24% ";
			$encontrado = "F";
		}
		if($Deuda_impaga<500 and $cuota>428 and $encontrado=="V" and $entidades_0<5)
		{
			$resultado_cal = "PRE-APROBADO - Importe S/ 8,000 | Plazo 24 meses | Cuota mensual aproximada S/ 428.67 | TCEA 24% ";
			$encontrado = "F";
		}
		if($Deuda_impaga<500 and $cuota>407 and $encontrado=="V" and $entidades_0<5)
		{
			$resultado_cal = "PRE-APROBADO - Importe S/ 6,000 | Plazo 18 meses | Cuota mensual aproximada S/ 407.82 | TCEA 24% ";
			$encontrado = "F";
		}
		if($Deuda_impaga<500 and $cuota>341 and $encontrado=="V" and $entidades_0<5)
		{
			$resultado_cal = "PRE-APROBADO - Importe S/ 5,000 | Plazo 18 meses | Cuota mensual aproximada S/ 341.52 | TCEA 24% ";
			$encontrado = "F";
		}
		if($Deuda_impaga<500 and $cuota>275 and $encontrado=="V" and $entidades_0<5)
		{
			$resultado_cal = "PRE-APROBADO - Importe S/ 4,000 | Plazo 18 meses | Cuota mensual aproximada S/ 275.22 | TCEA 24% ";
			$encontrado = "F";
		}
	
	}else{
		$resultado_cal="NO CALIFICA - Por calificacion";
	}
	


?>

<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Cooperativa Pacifico - PDP</title>
  <meta name="description" content="PDP">
  <meta name="author" content="SSDD">
  <link rel="stylesheet" href="css/bootstrap.css">
<script integrity="sha384-xBuQ/xzmlsLoJpyjoggmTEz8OWUFM0/RC5BsqQBDX2v5cMvDHcMakNTNrHIW2I5f" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <div class="row">

<table class="table table-sm ">
              <thead>
                <tr class="bg-success">
                  <th colspan="6" class="text-center"><?php echo $NomLargo; ?> - [<?php echo $dni; ?>] (<?php echo $AnoNac; ?>)</th>
                </tr>
              </thead>
              <tbody>
			<?php
				//echo eval("\$entidades_" . $i . " = (strlen(\$calificacion_" . $i . ")/3);");
				for($m=0;$m<12;$m++)
				{
				  $cal_1="";$fec_1="";$enti_1="";
				  echo eval("\$cal_1 = \$calificacion_" . $m . ";");
				  echo eval("\$fec_1 = \$Ano_0-\$Mes_" . $m . ";");
				  echo eval("\$enti_1 = \$entidades_" . $m . ";");
				  
				  echo "<tr>" . "\n";
				  
				  echo "<td class='bg-primary text-center'>" . strtoupper(strftime('%b', strtotime($fec_1))) . "</td>" . "\n";
                  echo "<td class='text-center'>" . $cal_1 . "</td>" . "\n";
				  echo "<td class='text-center'><button type='button' class='btn btn-secondary btn-xs' data-toggle='modal' data-target='#exampleModalCenter" . $m ."'>" . $enti_1 . " 🏦</button></td>" . "\n";

				  echo "</tr>" . "\n";	
               }
			
			?>
                
                
                <tr class="bg-warning">
                  <th scope="row" class="text-center" colspan="6"><button type="button" class="btn btn-secondary btn-xs" data-toggle="modal" data-target="#exampleModalCenter26">Impagos</button>
                 S/ <?php echo number_format($Deuda_impaga,0); ?> <button type="button" class="btn btn-secondary btn-xs" data-toggle="modal" data-target="#exampleModalCenter24">TC</button> S/ <?php echo number_format($LinAprTotal,0); ?> <button type="button" class="btn btn-secondary btn-xs" data-toggle="modal" data-target="#exampleModalCenter25">Uso TC</button> S/ <?php echo number_format($LinUtiTotal,0); ?> Uso <?php echo number_format(($LinUtiTotal/$LinAprTotal)*100, 2); ?>%</th>
                </tr>
	        </tbody>
            </table>
			
			Bancarizado: <?php echo $Bancarizado; ?><br>
			Score: <?php echo $Score; ?><br>
			NivelRiesgo: <?php echo $NivelRiesgo; ?><br>
			FlagB12M: <?php echo $FlagB12M; ?><br>
			CodigoWS: <?php echo $CodigoWS; ?><br>
			Equipo <?php echo $equipo; ?><br>
			
			<form action="pdp" method="post" name="cuerpo" autocomplete="off">
			<input type="hidden" id="dni" value="">
			  <div class="container-fluid text-center">
				    <table class="table table-sm">
						<tr>
							<td><button type="submit" class="btn btn-primary">Nueva consulta</button></td>
						</tr>
					</table>
			  </div>	
			
			</form>
			
            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter0" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">[<?php echo $Ano_0; ?>-<?php echo $Mes_0; ?>] Total Mes S/ <?php echo number_format($Deuda_0,2); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <?php echo $NomEnt_0; ?>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">[<?php echo $Ano_1; ?>-<?php echo $Mes_1; ?>] Total Mes S/ <?php echo number_format($Deuda_1,2); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <?php echo $NomEnt_1; ?> 
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">[<?php echo $Ano_2 ?>-<?php echo $Mes_2; ?>] Total Mes S/ <?php echo number_format($Deuda_2,2); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <?php echo $NomEnt_2; ?>    
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter3" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">[<?php echo $Ano_3; ?>-<?php echo $Mes_3; ?>] Total Mes S/ <?php echo number_format($Deuda_3,2); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <?php echo $NomEnt_3; ?>    
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter4" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">[<?php echo $Ano_4; ?>-<?php echo $Mes_4; ?>] Total Mes S/ <?php echo number_format($Deuda_4,2); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <?php echo $NomEnt_4; ?>    
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter5" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">[<?php echo $Ano_5; ?>-<?php echo $Mes_5; ?>] Total Mes S/ <?php echo number_format($Deuda_5,2); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <?php echo $NomEnt_5; ?>    
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter6" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">[<?php echo $Ano_6; ?>-<?php echo $Mes_6; ?>] Total Mes S/ <?php echo number_format($Deuda_6,2); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <?php echo $NomEnt_6; ?>    
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter7" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">[<?php echo $Ano_7; ?>-<?php echo $Mes_7; ?>] Total Mes S/ <?php echo number_format($Deuda_7,2); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <?php echo $NomEnt_7; ?>    
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter8" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">[<?php echo $Ano_8; ?>-<?php echo $Mes_8; ?>] Total Mes S/ <?php echo number_format($Deuda_8,2); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <?php echo $NomEnt_8; ?>    
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter9" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">[<?php echo $Ano_9; ?>-<?php echo $Mes_9; ?>] Total Mes S/ <?php echo number_format($Deuda_9,2); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <?php echo $NomEnt_9; ?>    
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter10" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">[<?php echo $Ano_10; ?>-<?php echo $Mes_10; ?>] Total Mes S/ <?php echo number_format($Deuda_10,2); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <?php echo $NomEnt_10; ?>    
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter11" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">[<?php echo $Ano_11; ?>-<?php echo $Mes_11; ?>] Total Mes S/ <?php echo number_format($Deuda_11,2); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <?php echo $NomEnt_11; ?>    
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter12" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">[<?php echo $Ano_12; ?>-<?php echo $Mes_12; ?>] Total Mes S/ <?php echo number_format($Deuda_12,2); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <?php echo $NomEnt_12; ?>    
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter13" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">[<?php echo $Ano_13; ?>-<?php echo $Mes_13; ?>] Total Mes S/ <?php echo number_format($Deuda_13,2); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <?php echo $NomEnt_13; ?>    
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter14" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">[<?php echo $Ano_14; ?>-<?php echo $Mes_14; ?>] Total Mes S/ <?php echo number_format($Deuda_14,2); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <?php echo $NomEnt_14; ?>    
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter15" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">[<?php echo $Ano_15; ?>-<?php echo $Mes_15; ?>] Total Mes S/ <?php echo number_format($Deuda_15,2); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <?php echo $NomEnt_15; ?>    
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter16" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">[<?php echo $Ano_16; ?>-<?php echo $Mes_16; ?>] Total Mes S/ <?php echo number_format($Deuda_16,2); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <?php echo $NomEnt_16; ?>    
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter17" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">[<?php echo $Ano_17; ?>-<?php echo $Mes_17; ?>] Total Mes S/ <?php echo number_format($Deuda_17,2); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <?php echo $NomEnt_17; ?>    
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter18" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">[<?php echo $Ano_18; ?>-<?php echo $Mes_18; ?>] Total Mes S/ <?php echo number_format($Deuda_18,2); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <?php echo $NomEnt_18; ?>    
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter19" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">[<?php echo $Ano_19; ?>-<?php echo $Mes_19; ?>] Total Mes S/ <?php echo number_format($Deuda_19,2); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <?php echo $NomEnt_19; ?>    
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter20" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">[<?php echo $Ano_20; ?>-<?php echo $Mes_20; ?>] Total Mes S/ <?php echo number_format($Deuda_20,2); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <?php echo $NomEnt_20; ?>    
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter21" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">[<?php echo $Ano_21; ?>-<?php echo $Mes_21; ?>] Total Mes S/ <?php echo number_format($Deuda_21,2); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <?php echo $NomEnt_21; ?>    
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter22" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">[<?php echo $Ano_22; ?>-<?php echo $Mes_22; ?>] Total Mes S/ <?php echo number_format($Deuda_22,2); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <?php echo $NomEnt_22; ?>    
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter23" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">[<?php echo $Ano_23; ?>-<?php echo $Mes_23; ?>] Total Mes S/ <?php echo number_format($Deuda_23,2); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <?php echo $NomEnt_23; ?>    
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
			
			<!-- Modal -->
            <div class="modal fade" id="exampleModalCenter24" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">[Tarjetas de Crédito] Línea Total S/ <?php echo number_format($LinAprTotal,2); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <?php echo $EntTarTotal; ?>    
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
			
			<!-- Modal -->
            <div class="modal fade" id="exampleModalCenter25" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">[Tarjetas de Crédito] Línea Utilizada S/ <?php echo number_format($LinUtiTotal,2); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <?php echo $EntUtiTotal; ?>    
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
			
			<!-- Modal -->
            <div class="modal fade" id="exampleModalCenter26" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">[Deudas Impagas] Detalle S/ <?php echo number_format($Deuda_impaga,2); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <?php echo $DeuImpTotal; ?>    
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>

</div>
</div>
</body>
</html>



<?php
} else {
    

?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Cooperativa Pacifico - PDP</title>
  <meta name="description" content="PDP">
  <meta name="author" content="SSDD">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script integrity="sha384-xBuQ/xzmlsLoJpyjoggmTEz8OWUFM0/RC5BsqQBDX2v5cMvDHcMakNTNrHIW2I5f" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>

function carga(){
		ancho = screen.width;
		alto = screen.height;
		if(ancho>alto)
			equipo = "desktop";
		else
			equipo = "celular";
		
		document.getElementById("equipo").value=equipo;
}
</script>

</head>
<body onload="carga();">

<div class="container">
    <div class="row">
<form action="pdp" method="post" name="cuerpo" autocomplete="off">
<input type="hidden" name="equipo" id="equipo"> 
    <div class="container-fluid text-center">
    <table class="table table-sm">
        <tr>
            <td><input type="number" name="dni" class="form-control" id="dni" placeholder="Ingrese DNI"></td>
        </tr>
	    <!--tr>
            <td><input type="number" name="celular" class="form-control" id="celular" placeholder="Ingrese Celular"></td>
        </tr>
		<tr>
            <td><input type="mail" name="correo" class="form-control" id="correo" placeholder="Ingrese Correo"></td>
        </tr//-->
		<tr>
            <td><input type="number" name="sueldo" class="form-control" id="sueldo" placeholder="Ingrese sueldo bruto"></td>
        </tr>
        <tr>
			<td><button type="submit" class="btn btn-primary">Ingresar</button></td>
		</tr>
    </table>
  </div>
  
</form>
	</div>
</div>
</body>
</html>

<?php
}
?>