<?php 


$doi = $_GET["doi"];


$response = file_get_contents("json/" . $doi . ".json", true);
$obj_ruc = json_decode($response);

	$TDoc_desc="";$Nom_desc="";

    $TDoc = $obj_ruc->soafulloutput->InfBas->TDoc;
	$NDoc = $obj_ruc->soafulloutput->InfBas->NDoc;
	$RazSoc = $obj_ruc->soafulloutput->InfBas->RazSoc;
	$Nom = $obj_ruc->soafulloutput->InfBas->Nom;
    $ApePat = $obj_ruc->soafulloutput->InfBas->ApePat;
    $ApeMat = $obj_ruc->soafulloutput->InfBas->ApeMat;
    $Sex = $obj_ruc->soafulloutput->InfBas->Sex;
    $AnoNac = $obj_ruc->soafulloutput->InfBas->FecNac;
    $AnoNac = substr($AnoNac,0,4);
	$AnoNac = intval($AnoNac);
	$AnoAct = date('Y');
	$edad = $AnoAct - $AnoNac;
    $nombre_largo = $ApePat . " " . $ApeMat . ", " . $Nom;
	
	$TipCon = $obj_ruc->soafulloutput->InfBas->TipCon;
	$FchInsRRPP = $obj_ruc->soafulloutput->InfBas->FchInsRRPP;
	$EstCon = $obj_ruc->soafulloutput->InfBas->EstCon;
	$EstDom = $obj_ruc->soafulloutput->InfBas->EstDom;
	$NumParReg = $obj_ruc->soafulloutput->InfBas->NumParReg;
	$Fol = $obj_ruc->soafulloutput->InfBas->Fol;
	$Asi = $obj_ruc->soafulloutput->InfBas->Asi;
	
	if($TDoc=="R")
	{
		$TDoc_desc = "RUC";
		$Nom_desc = $RazSoc;
	}
	if($TDoc=="D")
	{
		$TDoc_desc = "DNI";
		$Nom_desc = $ApePat . " " . $ApeMat . ", " . $Nom;
	}
	
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
				
				$contador=0;
				for ($i = 0; $i <= 23; $i++) {
					
					echo eval ("\$DirecRuc_" . $i. "= \$obj_ruc->soafulloutput->InfGen->Direcc[" . $i . "]->Direccion;");
					echo eval ("\$FuenteRuc_" . $i. "= \$obj_ruc->soafulloutput->InfGen->Direcc[" . $i . "]->Fuente;");
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
						
						echo eval("\$pos1 = strpos(\$calificacionRuc_" . $i . ",'PER');");
						echo eval("\$pos2 = strpos(\$calificacionRuc_" . $i . ",'DEF');");
						echo eval("\$pos3 = strpos(\$calificacionRuc_" . $i . ",'DUD');");
						echo eval("\$pos4 = strpos(\$calificacionRuc_" . $i . ",'CPP');");
						echo eval("\$pos5 = strpos(\$calificacionRuc_" . $i . ",'NOR');");
						
						if($pos1!==FALSE and $cal=="V"){
							echo eval("\$calificacionRuc_" . $i . "='<button type=button class=\"btn btn-dark btn-xs\">PER</button>';");
							$cal = "F";
						}
						if($pos2!==FALSE and $cal=="V"){
							echo eval("\$calificacionRuc_" . $i . "='<button type=button class=\"btn btn-danger btn-xs\">DEF</button>';");
							$cal = "F";
						}
						if($pos3!==FALSE and $cal=="V"){
							echo eval("\$calificacionRuc_" . $i . "='<button type=button class=\"btn btn-danger btn-xs\">DUD</button>';");
							$cal = "F";
						}
						if($pos4!==FALSE and $cal=="V"){
							echo eval("\$calificacionRuc_" . $i . "='<button type=button class=\"btn btn-warning btn-xs\">CPP</button>';");
							$cal = "F";
						}
						if($pos5!==FALSE and $cal=="V"){
							echo eval("\$calificacionRuc_" . $i . "='<button type=button class=\"btn btn-success btn-xs\">NOR</button>';");
							$cal = "F";
						}
						if($cal=="V"){
							echo eval("\$calificacionRuc_" . $i . "='<button type=button class=\"btn btn-secondary btn-xs\">SCA</button>';");
							$cal = "F";
						}
						
				}
	
?>

<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Traduce</title>
  <meta name="description" content="Traduce">
  <meta name="author" content="SSDD">
  <link rel="stylesheet" href="css/bootstrap.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>
<div class="container">
    <div class="row">
	
	<table class="table table-sm ">
              <thead>
                <tr class="bg-success">
                  <th colspan="4" class="text-center"><?php echo $TDoc_desc; ?> <?php echo $NDoc; ?> - <?php echo $Nom_desc; ?></th>
                </tr>
              </thead>

    </table>
	
	
	
	<table class="table table-sm ">
              <thead>
                <tr class="bg-info">
                  <th colspan="4" class="text-center">Datos Generales</th>
                </tr>
              </thead>
			  <tbody>
                <tr>
					<td><b>Razón Social</b></td>
					<td><?php echo $RazSoc; ?></td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td><b>Nombre Comercial</b></td>
					<td><?php echo $NomCom; ?></td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td><b>Tipo de Contribuyente</b></td>
					<td><?php echo $TipCon; ?></td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td><b>Estado de Contribuyente</b></td>
					<td><?php echo $EstCon; ?></td>
					<td><b>Condiciones del Contribuyente</b></td>
					<td><?php echo $EstDom; ?></td>
				</tr>
				<tr>
					<td><b>Inicio de Actividades</b></td>
					<td><?php echo $AnoNac_ruc; ?></td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td><b>Actvidad económica principal</b></td>
					<td colspan='3'><?php echo substr($ActEco,0,80); ?></td>
					
				</tr>
				<tr>
					<td><b>Actvidad económica secundaria 1</b></td>
					<td>&nbsp;</td>
					<td><b>Actvidad económica secundaria 2</b></td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td><b>Fecha de Inscripción</b></td>
					<td><?php echo $FchInsRRPP; ?></td>
					<td><b>Número de partida registral</b></td>
					<td><?php echo $NumParReg; ?>&nbsp;</td>
				</tr>
				<tr>
					<td><b>Folio</b></td>
					<td><?php echo $Fol; ?></td>
					<td><b>Asiento</b></td>
					<td><?php echo $Asi; ?></td>
				</tr>
			  </tbody>	
    </table>
	
	<table class="table table-sm ">
              <thead>
                <tr class="bg-info">
                  <th colspan="4" class="text-center">Direcciones registradas</th>
                </tr>
              </thead>
			  <tbody>
                <tr>
					<td><b>Dirección</b></td>
					<td><b>Fuente</b></td>
				</tr>
				<tr>
					<td><?php echo $DirecRuc_0; ?></td>
					<td><?php echo $FuenteRuc_0; ?></td>
				</tr>
			  </tbody>	
    </table>
</div>
</div>
</body>
</html>
