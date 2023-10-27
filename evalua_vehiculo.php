<?php
include_once 'test.php';
include_once 'apipersonas.php';
    
    $api = new ApiPersonas();

    $importe_solicitado = $_POST["importe"];
    $nombre = $_POST["nombre"];
    $dni = $_POST["dni"];
    $celular = $_POST["celular"];
    $correo = $_POST["correo"];
    $sueldo = $_POST["sueldo"];
    $utm_source = $_POST["utm_source"];
	$lima = $_POST["lima"];
	$quintacategoria = $_POST["quintacategoria"];
	$cuota = $_POST["cuota"];

    $tipo = "D";
    /*
    $dni = "72355399";
    $celular = "997855645";
    $correo = "mteruyan@gmail.com";
    $sueldo = 1000;
    */
    $saldo_pagar = 0;
    $encontrado = "V";
    $celular = "51" . $celular;
    
    $new = new CurlRequest();
    $resultado = $new ->sendPost_sentinel($tipo, $dni);
    $obj = json_decode($resultado);
    
    $Nom = $obj->soafulloutput->InfBas->Nom;
    $ApePat = $obj->soafulloutput->InfBas->ApePat;
    $ApeMat = $obj->soafulloutput->InfBas->ApeMat;
    $Sex = $obj->soafulloutput->InfBas->Sex;
    $AnoNac = $obj->soafulloutput->InfBas->FecNac;
    $AnoNac = substr($AnoNac,0,4);
    $nombre_largo = $ApePat . " " . $ApeMat . ", " . $Nom;
    $digito = substr($celular,10,1);
    
    $Deuda_0_0 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[0]->Detalle[0]->SalDeu)) ? $obj->soafulloutput->ConRap->DetSBSMicr[0]->Detalle[0]->SalDeu : 0;
    $Deuda_0_1 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[0]->Detalle[1]->SalDeu)) ? $obj->soafulloutput->ConRap->DetSBSMicr[0]->Detalle[1]->SalDeu : 0;
    $Deuda_0_2 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[0]->Detalle[2]->SalDeu)) ? $obj->soafulloutput->ConRap->DetSBSMicr[0]->Detalle[2]->SalDeu : 0;
    $Deuda_0_3 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[0]->Detalle[3]->SalDeu)) ? $obj->soafulloutput->ConRap->DetSBSMicr[0]->Detalle[3]->SalDeu : 0;
    $Deuda_0_4 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[0]->Detalle[4]->SalDeu)) ? $obj->soafulloutput->ConRap->DetSBSMicr[0]->Detalle[4]->SalDeu : 0;
    $Deuda_0_5 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[0]->Detalle[5]->SalDeu)) ? $obj->soafulloutput->ConRap->DetSBSMicr[0]->Detalle[5]->SalDeu : 0;
    $Deuda_0_6 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[0]->Detalle[6]->SalDeu)) ? $obj->soafulloutput->ConRap->DetSBSMicr[0]->Detalle[6]->SalDeu : 0;
    $Deuda_0_7 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[0]->Detalle[7]->SalDeu)) ? $obj->soafulloutput->ConRap->DetSBSMicr[0]->Detalle[7]->SalDeu : 0;
    $Deuda_0_8 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[0]->Detalle[8]->SalDeu)) ? $obj->soafulloutput->ConRap->DetSBSMicr[0]->Detalle[8]->SalDeu : 0;
    $Deuda_0_9 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[0]->Detalle[9]->SalDeu)) ? $obj->soafulloutput->ConRap->DetSBSMicr[0]->Detalle[9]->SalDeu : 0;
    
    $calificacion_0_0 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[0]->Detalle[0]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[0]->Detalle[0]->Cal : "";
    $calificacion_0_1 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[0]->Detalle[1]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[0]->Detalle[1]->Cal : "";
    $calificacion_0_2 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[0]->Detalle[2]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[0]->Detalle[2]->Cal : "";
    $calificacion_0_3 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[0]->Detalle[3]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[0]->Detalle[3]->Cal : "";
    $calificacion_0_4 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[0]->Detalle[4]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[0]->Detalle[4]->Cal : "";
    $calificacion_0_5 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[0]->Detalle[5]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[0]->Detalle[5]->Cal : "";
    $calificacion_0_6 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[0]->Detalle[6]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[0]->Detalle[6]->Cal : "";
    $calificacion_0_7 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[0]->Detalle[7]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[0]->Detalle[7]->Cal : "";
    $calificacion_0_8 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[0]->Detalle[8]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[0]->Detalle[8]->Cal : "";
    $calificacion_0_9 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[0]->Detalle[9]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[0]->Detalle[9]->Cal : "";
    
    $calificacion_1_0 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[1]->Detalle[0]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[1]->Detalle[0]->Cal : '';
    $calificacion_1_1 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[1]->Detalle[1]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[1]->Detalle[1]->Cal : '';
    $calificacion_1_2 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[1]->Detalle[2]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[1]->Detalle[2]->Cal : '';
    $calificacion_1_3 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[1]->Detalle[3]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[1]->Detalle[3]->Cal : '';
    $calificacion_1_4 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[1]->Detalle[4]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[1]->Detalle[4]->Cal : '';
    $calificacion_1_5 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[1]->Detalle[5]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[1]->Detalle[5]->Cal : '';
    $calificacion_1_6 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[1]->Detalle[6]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[1]->Detalle[6]->Cal : '';
    $calificacion_1_7 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[1]->Detalle[7]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[1]->Detalle[7]->Cal : '';
    $calificacion_1_8 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[1]->Detalle[8]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[1]->Detalle[8]->Cal : '';
    $calificacion_1_9 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[1]->Detalle[9]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[1]->Detalle[9]->Cal : '';
    
    $calificacion_2_0 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[2]->Detalle[0]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[2]->Detalle[0]->Cal : '';
    $calificacion_2_1 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[2]->Detalle[1]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[2]->Detalle[1]->Cal : '';
    $calificacion_2_2 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[2]->Detalle[2]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[2]->Detalle[2]->Cal : '';
    $calificacion_2_3 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[2]->Detalle[3]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[2]->Detalle[3]->Cal : '';
    $calificacion_2_4 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[2]->Detalle[4]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[2]->Detalle[4]->Cal : '';
    $calificacion_2_5 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[2]->Detalle[5]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[2]->Detalle[5]->Cal : '';
    $calificacion_2_6 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[2]->Detalle[6]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[2]->Detalle[6]->Cal : '';
    $calificacion_2_7 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[2]->Detalle[7]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[2]->Detalle[7]->Cal : '';
    $calificacion_2_8 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[2]->Detalle[8]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[2]->Detalle[8]->Cal : '';
    $calificacion_2_9 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[2]->Detalle[9]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[2]->Detalle[9]->Cal : '';
    
    $calificacion_3_0 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[3]->Detalle[0]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[3]->Detalle[0]->Cal : '';
    $calificacion_3_1 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[3]->Detalle[1]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[3]->Detalle[1]->Cal : '';
    $calificacion_3_2 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[3]->Detalle[2]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[3]->Detalle[2]->Cal : '';
    $calificacion_3_3 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[3]->Detalle[3]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[3]->Detalle[3]->Cal : '';
    $calificacion_3_4 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[3]->Detalle[4]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[3]->Detalle[4]->Cal : '';
    $calificacion_3_5 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[3]->Detalle[5]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[3]->Detalle[5]->Cal : '';
    $calificacion_3_6 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[3]->Detalle[6]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[3]->Detalle[6]->Cal : '';
    $calificacion_3_7 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[3]->Detalle[7]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[3]->Detalle[7]->Cal : '';
    $calificacion_3_8 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[3]->Detalle[8]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[3]->Detalle[8]->Cal : '';
    $calificacion_3_9 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[3]->Detalle[9]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[3]->Detalle[9]->Cal : '';
    
    $calificacion_4_0 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[4]->Detalle[0]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[4]->Detalle[0]->Cal : '';
    $calificacion_4_1 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[4]->Detalle[1]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[4]->Detalle[1]->Cal : '';
    $calificacion_4_2 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[4]->Detalle[2]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[4]->Detalle[2]->Cal : '';
    $calificacion_4_3 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[4]->Detalle[3]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[4]->Detalle[3]->Cal : '';
    $calificacion_4_4 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[4]->Detalle[4]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[4]->Detalle[4]->Cal : '';
    $calificacion_4_5 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[4]->Detalle[5]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[4]->Detalle[5]->Cal : '';
    $calificacion_4_6 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[4]->Detalle[6]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[4]->Detalle[6]->Cal : '';
    $calificacion_4_7 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[4]->Detalle[7]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[4]->Detalle[7]->Cal : '';
    $calificacion_4_8 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[4]->Detalle[8]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[4]->Detalle[8]->Cal : '';
    $calificacion_4_9 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[4]->Detalle[9]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[4]->Detalle[9]->Cal : '';
    
    $calificacion_5_0 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[5]->Detalle[0]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[5]->Detalle[0]->Cal : '';
    $calificacion_5_1 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[5]->Detalle[1]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[5]->Detalle[1]->Cal : '';
    $calificacion_5_2 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[5]->Detalle[2]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[5]->Detalle[2]->Cal : '';
    $calificacion_5_3 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[5]->Detalle[3]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[5]->Detalle[3]->Cal : '';
    $calificacion_5_4 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[5]->Detalle[4]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[5]->Detalle[4]->Cal : '';
    $calificacion_5_5 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[5]->Detalle[5]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[5]->Detalle[5]->Cal : '';
    $calificacion_5_6 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[5]->Detalle[6]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[5]->Detalle[6]->Cal : '';
    $calificacion_5_7 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[5]->Detalle[7]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[5]->Detalle[7]->Cal : '';
    $calificacion_5_8 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[5]->Detalle[8]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[5]->Detalle[8]->Cal : '';
    $calificacion_5_9 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[5]->Detalle[9]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[5]->Detalle[9]->Cal : '';
    
    $calificacion_6_0 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[6]->Detalle[0]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[6]->Detalle[0]->Cal : '';
    $calificacion_6_1 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[6]->Detalle[1]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[6]->Detalle[1]->Cal : '';
    $calificacion_6_2 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[6]->Detalle[2]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[6]->Detalle[2]->Cal : '';
    $calificacion_6_3 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[6]->Detalle[3]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[6]->Detalle[3]->Cal : '';
    $calificacion_6_4 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[6]->Detalle[4]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[6]->Detalle[4]->Cal : '';
    $calificacion_6_5 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[6]->Detalle[5]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[6]->Detalle[5]->Cal : '';
    $calificacion_6_6 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[6]->Detalle[6]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[6]->Detalle[6]->Cal : '';
    $calificacion_6_7 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[6]->Detalle[7]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[6]->Detalle[7]->Cal : '';
    $calificacion_6_8 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[6]->Detalle[8]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[6]->Detalle[8]->Cal : '';
    $calificacion_6_9 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[6]->Detalle[9]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[6]->Detalle[9]->Cal : '';
    
    $calificacion_7_0 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[7]->Detalle[0]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[7]->Detalle[0]->Cal : '';
    $calificacion_7_1 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[7]->Detalle[1]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[7]->Detalle[1]->Cal : '';
    $calificacion_7_2 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[7]->Detalle[2]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[7]->Detalle[2]->Cal : '';
    $calificacion_7_3 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[7]->Detalle[3]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[7]->Detalle[3]->Cal : '';
    $calificacion_7_4 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[7]->Detalle[4]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[7]->Detalle[4]->Cal : '';
    $calificacion_7_5 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[7]->Detalle[5]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[7]->Detalle[5]->Cal : '';
    $calificacion_7_6 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[7]->Detalle[6]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[7]->Detalle[6]->Cal : '';
    $calificacion_7_7 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[7]->Detalle[7]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[7]->Detalle[7]->Cal : '';
    $calificacion_7_8 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[7]->Detalle[8]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[7]->Detalle[8]->Cal : '';
    $calificacion_7_9 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[7]->Detalle[9]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[7]->Detalle[9]->Cal : '';
    
    $calificacion_8_0 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[8]->Detalle[0]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[8]->Detalle[0]->Cal : '';
    $calificacion_8_1 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[8]->Detalle[1]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[8]->Detalle[1]->Cal : '';
    $calificacion_8_2 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[8]->Detalle[2]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[8]->Detalle[2]->Cal : '';
    $calificacion_8_3 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[8]->Detalle[3]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[8]->Detalle[3]->Cal : '';
    $calificacion_8_4 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[8]->Detalle[4]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[8]->Detalle[4]->Cal : '';
    $calificacion_8_5 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[8]->Detalle[5]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[8]->Detalle[5]->Cal : '';
    $calificacion_8_6 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[8]->Detalle[6]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[8]->Detalle[6]->Cal : '';
    $calificacion_8_7 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[8]->Detalle[7]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[8]->Detalle[7]->Cal : '';
    $calificacion_8_8 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[8]->Detalle[8]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[8]->Detalle[8]->Cal : '';
    $calificacion_8_9 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[8]->Detalle[9]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[8]->Detalle[9]->Cal : '';
    
    $calificacion_9_0 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[9]->Detalle[0]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[9]->Detalle[0]->Cal : '';
    $calificacion_9_1 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[9]->Detalle[1]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[9]->Detalle[1]->Cal : '';
    $calificacion_9_2 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[9]->Detalle[2]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[9]->Detalle[2]->Cal : '';
    $calificacion_9_3 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[9]->Detalle[3]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[9]->Detalle[3]->Cal : '';
    $calificacion_9_4 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[9]->Detalle[4]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[9]->Detalle[4]->Cal : '';
    $calificacion_9_5 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[9]->Detalle[5]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[9]->Detalle[5]->Cal : '';
    $calificacion_9_6 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[9]->Detalle[6]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[9]->Detalle[6]->Cal : '';
    $calificacion_9_7 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[9]->Detalle[7]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[9]->Detalle[7]->Cal : '';
    $calificacion_9_8 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[9]->Detalle[8]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[9]->Detalle[8]->Cal : '';
    $calificacion_9_9 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[9]->Detalle[9]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[9]->Detalle[9]->Cal : '';
    
    $calificacion_10_0 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[10]->Detalle[0]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[10]->Detalle[0]->Cal : '';
    $calificacion_10_1 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[10]->Detalle[1]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[10]->Detalle[1]->Cal : '';
    $calificacion_10_2 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[10]->Detalle[2]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[10]->Detalle[2]->Cal : '';
    $calificacion_10_3 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[10]->Detalle[3]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[10]->Detalle[3]->Cal : '';
    $calificacion_10_4 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[10]->Detalle[4]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[10]->Detalle[4]->Cal : '';
    $calificacion_10_5 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[10]->Detalle[5]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[10]->Detalle[5]->Cal : '';
    $calificacion_10_6 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[10]->Detalle[6]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[10]->Detalle[6]->Cal : '';
    $calificacion_10_7 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[10]->Detalle[7]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[10]->Detalle[7]->Cal : '';
    $calificacion_10_8 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[10]->Detalle[8]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[10]->Detalle[8]->Cal : '';
    $calificacion_10_9 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[10]->Detalle[9]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[10]->Detalle[9]->Cal : '';
    
    $calificacion_11_0 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[11]->Detalle[0]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[11]->Detalle[0]->Cal : '';
    $calificacion_11_1 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[11]->Detalle[1]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[11]->Detalle[1]->Cal : '';
    $calificacion_11_2 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[11]->Detalle[2]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[11]->Detalle[2]->Cal : '';
    $calificacion_11_3 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[11]->Detalle[3]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[11]->Detalle[3]->Cal : '';
    $calificacion_11_4 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[11]->Detalle[4]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[11]->Detalle[4]->Cal : '';
    $calificacion_11_5 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[11]->Detalle[5]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[11]->Detalle[5]->Cal : '';
    $calificacion_11_6 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[11]->Detalle[6]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[11]->Detalle[6]->Cal : '';
    $calificacion_11_7 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[11]->Detalle[7]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[11]->Detalle[7]->Cal : '';
    $calificacion_11_8 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[11]->Detalle[8]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[11]->Detalle[8]->Cal : '';
    $calificacion_11_9 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[11]->Detalle[9]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[11]->Detalle[9]->Cal : '';

    $calificacion_0 = $calificacion_0_0 . $calificacion_0_1 . $calificacion_0_2 . $calificacion_0_3 . $calificacion_0_4 . $calificacion_0_5 . $calificacion_0_6 . $calificacion_0_7 . $calificacion_0_8 . $calificacion_0_9;
    $calificacion_1 = $calificacion_1_0 . $calificacion_1_1 . $calificacion_1_2 . $calificacion_1_3 . $calificacion_1_4 . $calificacion_1_5 . $calificacion_1_6 . $calificacion_1_7 . $calificacion_1_8 . $calificacion_1_9;
    $calificacion_2 = $calificacion_2_0 . $calificacion_2_1 . $calificacion_2_2 . $calificacion_2_3 . $calificacion_2_4 . $calificacion_2_5 . $calificacion_2_6 . $calificacion_2_7 . $calificacion_2_8 . $calificacion_2_9;
    $calificacion_3 = $calificacion_3_0 . $calificacion_3_1 . $calificacion_3_2 . $calificacion_3_3 . $calificacion_3_4 . $calificacion_3_5 . $calificacion_3_6 . $calificacion_3_7 . $calificacion_3_8 . $calificacion_3_9;
    $calificacion_4 = $calificacion_4_0 . $calificacion_4_1 . $calificacion_4_2 . $calificacion_4_3 . $calificacion_4_4 . $calificacion_4_5 . $calificacion_4_6 . $calificacion_4_7 . $calificacion_4_8 . $calificacion_4_9;
    $calificacion_5 = $calificacion_5_0 . $calificacion_5_1 . $calificacion_5_2 . $calificacion_5_3 . $calificacion_5_4 . $calificacion_5_5 . $calificacion_5_6 . $calificacion_5_7 . $calificacion_5_8 . $calificacion_5_9;    
    $calificacion_6 = $calificacion_6_0 . $calificacion_6_1 . $calificacion_6_2 . $calificacion_6_3 . $calificacion_6_4 . $calificacion_6_5 . $calificacion_6_6 . $calificacion_6_7 . $calificacion_6_8 . $calificacion_6_9;
    $calificacion_7 = $calificacion_7_0 . $calificacion_7_1 . $calificacion_7_2 . $calificacion_7_3 . $calificacion_7_4 . $calificacion_7_5 . $calificacion_7_6 . $calificacion_7_7 . $calificacion_7_8 . $calificacion_7_9;
    $calificacion_8 = $calificacion_8_0 . $calificacion_8_1 . $calificacion_8_2 . $calificacion_8_3 . $calificacion_8_4 . $calificacion_8_5 . $calificacion_8_6 . $calificacion_8_7 . $calificacion_8_8 . $calificacion_8_9;
    $calificacion_9 = $calificacion_9_0 . $calificacion_9_1 . $calificacion_9_2 . $calificacion_9_3 . $calificacion_9_4 . $calificacion_9_5 . $calificacion_9_6 . $calificacion_9_7 . $calificacion_9_8 . $calificacion_9_9;
    $calificacion_10 = $calificacion_10_0 . $calificacion_10_1 . $calificacion_10_2 . $calificacion_10_3 . $calificacion_10_4 . $calificacion_10_5 . $calificacion_10_6 . $calificacion_10_7 . $calificacion_10_8 . $calificacion_10_9;
    $calificacion_11 = $calificacion_11_0 . $calificacion_11_1 . $calificacion_11_2 . $calificacion_11_3 . $calificacion_11_4 . $calificacion_11_5 . $calificacion_11_6 . $calificacion_11_7 . $calificacion_11_8 . $calificacion_11_9;
    
    $calificacion_total = $calificacion_0 . $calificacion_1 . $calificacion_2 . $calificacion_3 . $calificacion_4 . $calificacion_5 . $calificacion_6 . $calificacion_7 . $calificacion_8 . $calificacion_9 . $calificacion_10 . $calificacion_11;
    
    $calificacion_12_0 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[12]->Detalle[0]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[12]->Detalle[0]->Cal : '';
    $calificacion_12_1 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[12]->Detalle[1]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[12]->Detalle[1]->Cal : '';
    $calificacion_12_2 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[12]->Detalle[2]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[12]->Detalle[2]->Cal : '';
    $calificacion_12_3 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[12]->Detalle[3]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[12]->Detalle[3]->Cal : '';
    $calificacion_12_4 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[12]->Detalle[4]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[12]->Detalle[4]->Cal : '';
    $calificacion_12_5 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[12]->Detalle[5]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[12]->Detalle[5]->Cal : '';
    $calificacion_12_6 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[12]->Detalle[6]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[12]->Detalle[6]->Cal : '';
    $calificacion_12_7 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[12]->Detalle[7]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[12]->Detalle[7]->Cal : '';
    $calificacion_12_8 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[12]->Detalle[8]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[12]->Detalle[8]->Cal : '';
    $calificacion_12_9 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[12]->Detalle[9]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[12]->Detalle[9]->Cal : '';
    
    $calificacion_13_0 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[13]->Detalle[0]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[13]->Detalle[0]->Cal : '';
    $calificacion_13_1 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[13]->Detalle[1]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[13]->Detalle[1]->Cal : '';
    $calificacion_13_2 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[13]->Detalle[2]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[13]->Detalle[2]->Cal : '';
    $calificacion_13_3 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[13]->Detalle[3]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[13]->Detalle[3]->Cal : '';
    $calificacion_13_4 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[13]->Detalle[4]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[13]->Detalle[4]->Cal : '';
    $calificacion_13_5 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[13]->Detalle[5]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[13]->Detalle[5]->Cal : '';
    $calificacion_13_6 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[13]->Detalle[6]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[13]->Detalle[6]->Cal : '';
    $calificacion_13_7 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[13]->Detalle[7]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[13]->Detalle[7]->Cal : '';
    $calificacion_13_8 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[13]->Detalle[8]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[13]->Detalle[8]->Cal : '';
    $calificacion_13_9 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[13]->Detalle[9]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[13]->Detalle[9]->Cal : '';
    
    $calificacion_14_0 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[14]->Detalle[0]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[14]->Detalle[0]->Cal : '';
    $calificacion_14_1 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[14]->Detalle[1]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[14]->Detalle[1]->Cal : '';
    $calificacion_14_2 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[14]->Detalle[2]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[14]->Detalle[2]->Cal : '';
    $calificacion_14_3 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[14]->Detalle[3]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[14]->Detalle[3]->Cal : '';
    $calificacion_14_4 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[14]->Detalle[4]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[14]->Detalle[4]->Cal : '';
    $calificacion_14_5 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[14]->Detalle[5]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[14]->Detalle[5]->Cal : '';
    $calificacion_14_6 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[14]->Detalle[6]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[14]->Detalle[6]->Cal : '';
    $calificacion_14_7 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[14]->Detalle[7]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[14]->Detalle[7]->Cal : '';
    $calificacion_14_8 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[14]->Detalle[8]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[14]->Detalle[8]->Cal : '';
    $calificacion_14_9 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[14]->Detalle[9]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[14]->Detalle[9]->Cal : '';
    
    $calificacion_15_0 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[15]->Detalle[0]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[15]->Detalle[0]->Cal : '';
    $calificacion_15_1 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[15]->Detalle[1]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[15]->Detalle[1]->Cal : '';
    $calificacion_15_2 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[15]->Detalle[2]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[15]->Detalle[2]->Cal : '';
    $calificacion_15_3 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[15]->Detalle[3]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[15]->Detalle[3]->Cal : '';
    $calificacion_15_4 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[15]->Detalle[4]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[15]->Detalle[4]->Cal : '';
    $calificacion_15_5 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[15]->Detalle[5]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[15]->Detalle[5]->Cal : '';
    $calificacion_15_6 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[15]->Detalle[6]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[15]->Detalle[6]->Cal : '';
    $calificacion_15_7 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[15]->Detalle[7]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[15]->Detalle[7]->Cal : '';
    $calificacion_15_8 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[15]->Detalle[8]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[15]->Detalle[8]->Cal : '';
    $calificacion_15_9 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[15]->Detalle[9]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[15]->Detalle[9]->Cal : '';
    
    $calificacion_16_0 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[16]->Detalle[0]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[16]->Detalle[0]->Cal : '';
    $calificacion_16_1 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[16]->Detalle[1]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[16]->Detalle[1]->Cal : '';
    $calificacion_16_2 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[16]->Detalle[2]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[16]->Detalle[2]->Cal : '';
    $calificacion_16_3 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[16]->Detalle[3]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[16]->Detalle[3]->Cal : '';
    $calificacion_16_4 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[16]->Detalle[4]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[16]->Detalle[4]->Cal : '';
    $calificacion_16_5 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[16]->Detalle[5]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[16]->Detalle[5]->Cal : '';
    $calificacion_16_6 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[16]->Detalle[6]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[16]->Detalle[6]->Cal : '';
    $calificacion_16_7 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[16]->Detalle[7]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[16]->Detalle[7]->Cal : '';
    $calificacion_16_8 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[16]->Detalle[8]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[16]->Detalle[8]->Cal : '';
    $calificacion_16_9 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[16]->Detalle[9]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[16]->Detalle[9]->Cal : '';
    
    $calificacion_17_0 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[17]->Detalle[0]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[17]->Detalle[0]->Cal : '';
    $calificacion_17_1 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[17]->Detalle[1]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[17]->Detalle[1]->Cal : '';
    $calificacion_17_2 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[17]->Detalle[2]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[17]->Detalle[2]->Cal : '';
    $calificacion_17_3 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[17]->Detalle[3]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[17]->Detalle[3]->Cal : '';
    $calificacion_17_4 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[17]->Detalle[4]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[17]->Detalle[4]->Cal : '';
    $calificacion_17_5 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[17]->Detalle[5]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[17]->Detalle[5]->Cal : '';
    $calificacion_17_6 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[17]->Detalle[6]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[17]->Detalle[6]->Cal : '';
    $calificacion_17_7 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[17]->Detalle[7]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[17]->Detalle[7]->Cal : '';
    $calificacion_17_8 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[17]->Detalle[8]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[17]->Detalle[8]->Cal : '';
    $calificacion_17_9 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[17]->Detalle[9]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[17]->Detalle[9]->Cal : '';
    
    $calificacion_18_0 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[18]->Detalle[0]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[18]->Detalle[0]->Cal : '';
    $calificacion_18_1 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[18]->Detalle[1]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[18]->Detalle[1]->Cal : '';
    $calificacion_18_2 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[18]->Detalle[2]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[18]->Detalle[2]->Cal : '';
    $calificacion_18_3 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[18]->Detalle[3]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[18]->Detalle[3]->Cal : '';
    $calificacion_18_4 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[18]->Detalle[4]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[18]->Detalle[4]->Cal : '';
    $calificacion_18_5 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[18]->Detalle[5]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[18]->Detalle[5]->Cal : '';
    $calificacion_18_6 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[18]->Detalle[6]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[18]->Detalle[6]->Cal : '';
    $calificacion_18_7 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[18]->Detalle[7]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[18]->Detalle[7]->Cal : '';
    $calificacion_18_8 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[18]->Detalle[8]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[18]->Detalle[8]->Cal : '';
    $calificacion_18_9 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[18]->Detalle[9]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[18]->Detalle[9]->Cal : '';
    
    $calificacion_19_0 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[19]->Detalle[0]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[19]->Detalle[0]->Cal : '';
    $calificacion_19_1 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[19]->Detalle[1]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[19]->Detalle[1]->Cal : '';
    $calificacion_19_2 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[19]->Detalle[2]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[19]->Detalle[2]->Cal : '';
    $calificacion_19_3 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[19]->Detalle[3]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[19]->Detalle[3]->Cal : '';
    $calificacion_19_4 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[19]->Detalle[4]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[19]->Detalle[4]->Cal : '';
    $calificacion_19_5 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[19]->Detalle[5]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[19]->Detalle[5]->Cal : '';
    $calificacion_19_6 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[19]->Detalle[6]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[19]->Detalle[6]->Cal : '';
    $calificacion_19_7 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[19]->Detalle[7]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[19]->Detalle[7]->Cal : '';
    $calificacion_19_8 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[19]->Detalle[8]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[19]->Detalle[8]->Cal : '';
    $calificacion_19_9 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[19]->Detalle[9]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[19]->Detalle[9]->Cal : '';
    
    $calificacion_20_0 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[20]->Detalle[0]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[20]->Detalle[0]->Cal : '';
    $calificacion_20_1 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[20]->Detalle[1]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[20]->Detalle[1]->Cal : '';
    $calificacion_20_2 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[20]->Detalle[2]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[20]->Detalle[2]->Cal : '';
    $calificacion_20_3 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[20]->Detalle[3]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[20]->Detalle[3]->Cal : '';
    $calificacion_20_4 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[20]->Detalle[4]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[20]->Detalle[4]->Cal : '';
    $calificacion_20_5 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[20]->Detalle[5]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[20]->Detalle[5]->Cal : '';
    $calificacion_20_6 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[20]->Detalle[6]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[20]->Detalle[6]->Cal : '';
    $calificacion_20_7 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[20]->Detalle[7]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[20]->Detalle[7]->Cal : '';
    $calificacion_20_8 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[20]->Detalle[8]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[20]->Detalle[8]->Cal : '';
    $calificacion_20_9 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[20]->Detalle[9]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[20]->Detalle[9]->Cal : '';
    
    $calificacion_21_0 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[21]->Detalle[0]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[21]->Detalle[0]->Cal : '';
    $calificacion_21_1 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[21]->Detalle[1]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[21]->Detalle[1]->Cal : '';
    $calificacion_21_2 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[21]->Detalle[2]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[21]->Detalle[2]->Cal : '';
    $calificacion_21_3 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[21]->Detalle[3]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[21]->Detalle[3]->Cal : '';
    $calificacion_21_4 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[21]->Detalle[4]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[21]->Detalle[4]->Cal : '';
    $calificacion_21_5 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[21]->Detalle[5]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[21]->Detalle[5]->Cal : '';
    $calificacion_21_6 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[21]->Detalle[6]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[21]->Detalle[6]->Cal : '';
    $calificacion_21_7 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[21]->Detalle[7]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[21]->Detalle[7]->Cal : '';
    $calificacion_21_8 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[21]->Detalle[8]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[21]->Detalle[8]->Cal : '';
    $calificacion_21_9 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[21]->Detalle[9]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[21]->Detalle[9]->Cal : '';
    
    $calificacion_22_0 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[22]->Detalle[0]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[22]->Detalle[0]->Cal : '';
    $calificacion_22_1 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[22]->Detalle[1]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[22]->Detalle[1]->Cal : '';
    $calificacion_22_2 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[22]->Detalle[2]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[22]->Detalle[2]->Cal : '';
    $calificacion_22_3 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[22]->Detalle[3]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[22]->Detalle[3]->Cal : '';
    $calificacion_22_4 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[22]->Detalle[4]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[22]->Detalle[4]->Cal : '';
    $calificacion_22_5 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[22]->Detalle[5]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[22]->Detalle[5]->Cal : '';
    $calificacion_22_6 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[22]->Detalle[6]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[22]->Detalle[6]->Cal : '';
    $calificacion_22_7 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[22]->Detalle[7]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[22]->Detalle[7]->Cal : '';
    $calificacion_22_8 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[22]->Detalle[8]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[22]->Detalle[8]->Cal : '';
    $calificacion_22_9 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[22]->Detalle[9]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[22]->Detalle[9]->Cal : '';
    
    $calificacion_23_0 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[23]->Detalle[0]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[23]->Detalle[0]->Cal : '';
    $calificacion_23_1 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[23]->Detalle[1]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[23]->Detalle[1]->Cal : '';
    $calificacion_23_2 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[23]->Detalle[2]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[23]->Detalle[2]->Cal : '';
    $calificacion_23_3 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[23]->Detalle[3]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[23]->Detalle[3]->Cal : '';
    $calificacion_23_4 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[23]->Detalle[4]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[23]->Detalle[4]->Cal : '';
    $calificacion_23_5 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[23]->Detalle[5]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[23]->Detalle[5]->Cal : '';
    $calificacion_23_6 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[23]->Detalle[6]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[23]->Detalle[6]->Cal : '';
    $calificacion_23_7 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[23]->Detalle[7]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[23]->Detalle[7]->Cal : '';
    $calificacion_23_8 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[23]->Detalle[8]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[23]->Detalle[8]->Cal : '';
    $calificacion_23_9 = (isset($obj->soafulloutput->ConRap->DetSBSMicr[23]->Detalle[9]->Cal)) ? $obj->soafulloutput->ConRap->DetSBSMicr[23]->Detalle[9]->Cal : '';

	$calificacion_12 = $calificacion_12_0 . $calificacion_12_1 . $calificacion_12_2 . $calificacion_12_3 . $calificacion_12_4 . $calificacion_12_5 . $calificacion_12_6 . $calificacion_12_7 . $calificacion_12_8 . $calificacion_12_9;
    $calificacion_13 = $calificacion_13_0 . $calificacion_13_1 . $calificacion_13_2 . $calificacion_13_3 . $calificacion_13_4 . $calificacion_13_5 . $calificacion_13_6 . $calificacion_13_7 . $calificacion_13_8 . $calificacion_13_9;
    $calificacion_14 = $calificacion_14_0 . $calificacion_14_1 . $calificacion_14_2 . $calificacion_14_3 . $calificacion_14_4 . $calificacion_14_5 . $calificacion_14_6 . $calificacion_14_7 . $calificacion_14_8 . $calificacion_14_9;
    $calificacion_15 = $calificacion_15_0 . $calificacion_15_1 . $calificacion_15_2 . $calificacion_15_3 . $calificacion_15_4 . $calificacion_15_5 . $calificacion_15_6 . $calificacion_15_7 . $calificacion_15_8 . $calificacion_15_9;
    $calificacion_16 = $calificacion_16_0 . $calificacion_16_1 . $calificacion_16_2 . $calificacion_16_3 . $calificacion_16_4 . $calificacion_16_5 . $calificacion_16_6 . $calificacion_16_7 . $calificacion_16_8 . $calificacion_16_9;
    $calificacion_17 = $calificacion_17_0 . $calificacion_17_1 . $calificacion_17_2 . $calificacion_17_3 . $calificacion_17_4 . $calificacion_17_5 . $calificacion_17_6 . $calificacion_17_7 . $calificacion_17_8 . $calificacion_17_9;    
    $calificacion_18 = $calificacion_18_0 . $calificacion_18_1 . $calificacion_18_2 . $calificacion_18_3 . $calificacion_18_4 . $calificacion_18_5 . $calificacion_18_6 . $calificacion_18_7 . $calificacion_18_8 . $calificacion_18_9;
    $calificacion_19 = $calificacion_19_0 . $calificacion_19_1 . $calificacion_19_2 . $calificacion_19_3 . $calificacion_19_4 . $calificacion_19_5 . $calificacion_19_6 . $calificacion_19_7 . $calificacion_19_8 . $calificacion_19_9;
    $calificacion_20 = $calificacion_20_0 . $calificacion_20_1 . $calificacion_20_2 . $calificacion_20_3 . $calificacion_20_4 . $calificacion_20_5 . $calificacion_20_6 . $calificacion_20_7 . $calificacion_20_8 . $calificacion_20_9;
    $calificacion_21 = $calificacion_21_0 . $calificacion_21_1 . $calificacion_21_2 . $calificacion_21_3 . $calificacion_21_4 . $calificacion_21_5 . $calificacion_21_6 . $calificacion_21_7 . $calificacion_21_8 . $calificacion_21_9;
    $calificacion_22 = $calificacion_22_0 . $calificacion_22_1 . $calificacion_22_2 . $calificacion_22_3 . $calificacion_22_4 . $calificacion_22_5 . $calificacion_22_6 . $calificacion_22_7 . $calificacion_22_8 . $calificacion_22_9;
    $calificacion_23 = $calificacion_23_0 . $calificacion_23_1 . $calificacion_23_2 . $calificacion_23_3 . $calificacion_23_4 . $calificacion_23_5 . $calificacion_23_6 . $calificacion_23_7 . $calificacion_23_8 . $calificacion_23_9;
    
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
    
    //echo "longitud calificacion total=" . strlen($calificacion_total) . "<br>";
    
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

    $Deuda_total = $Deuda_0_0 + $Deuda_0_1 + $Deuda_0_2 + $Deuda_0_3 + $Deuda_0_4 + $Deuda_0_5 + $Deuda_0_6 + $Deuda_0_7 + $Deuda_0_8 + $Deuda_0_9;
    
    $Deuda_impaga = (isset($obj->soafulloutput->ConRap->DetVen[0]->VenTot)) ? $obj->soafulloutput->ConRap->DetVen[0]->VenTot : 0;
	
	if($cal_tmp=="SC")
	{
		$rci = 0.45;
	}
	else
	{
		$rci = 0.55;
    }
	
	$tem_deuda_total = 0.031447989; // //TEM a 45% TEA
	$cuotas_deuda_total = 24;
	
	$tem_deuda_auto = 0.01388843; // //TEM a 18% TEA
	$cuotas_deuda_auto = 72;
	
	$seguro_auto = 200;
	
	$importe_solicitado = $importe_solicitado*0.8;
	
	$cuo_deuda_tot = ceil((((pow((1+$tem_deuda_total),$cuotas_deuda_total))*$tem_deuda_total)/((pow((1+$tem_deuda_total),$cuotas_deuda_total))-1))*$Deuda_total);
	$cuo_prest_auto = ceil((((pow((1+$tem_deuda_auto),$cuotas_deuda_auto))*$tem_deuda_auto)/((pow((1+$tem_deuda_auto),$cuotas_deuda_auto))-1))*$importe_solicitado); 
	
	$total_deudas = $seguro_auto + $cuo_deuda_tot + $cuo_prest_auto;
	
    $saldo_pagar = $total_deudas/$sueldo;
	
	if($Deuda_impaga<1000 and $calificacion_socio=="OK" and $saldo_pagar<=$rci and $encontrado=="V")
    {
        $oferta = "Importe Solicitado: " . number_format($importe_solicitado, 0, '.',',') . " cuota a pagar " . number_format($cuo_prest_auto, 0, '.',',') . " a 5 años (cuota doble) con TCEA 18% ";
        $encontrado = "F";
    }
    
    $funcionario = "";
    
    if($digito=="1" or $digito=="6" or $digito=="9")
    {
        $funcionario = "KAORI";
    }
    if($digito=="0" or $digito=="2" or $digito=="5" or $digito=="8")
    {
        $funcionario = "XIOMI"; 
    }
    if($digito=="3" or $digito=="4" or $digito=="7")
    {
        $funcionario = "JOHANN";
    }
    
    if($encontrado=="F")
    {
		if($lima=="No" or $quintacategoria=="No" or $Nom=="" or $cuota=="No" or $sueldo<2000)
		{
			$item = array(
                'nombres' => $nombre_largo,
				'dni' => $dni,
				'celular' => $celular,
				'situacion' => $cal_tmp,
				'sueldo_neto' => $sueldo,
				'saldo_pagar_cuota' => $saldo_pagar,
				'dias_atraso' => '0',
				'deudas_impagas' => $Deuda_impaga,
				'deuda_sistema' => $Deuda_total,
				'ruc' => '',
                'nombre_empresa' => $utm_source,
                'estado' => 'VEH NO CAL-LIMA-5TA-M',
                'funcionario' => '---',
            );
            $api->add2($item);
            
            header("Location: https://cp.com.pe/pacifico/credito-vehicular-nc/");
			exit();
		}
		else
		{
		
		$resultado = $new ->sendPost_notificacion_wsp_vehicular($Nom, $celular, number_format($importe_solicitado, 0, '.',','), number_format($cuo_prest_auto, 0, '.',','));
  
        $resultado = $new ->sendPost_email_masivian_vehicular($dni, $nombre_largo, $sueldo, $saldo_pagar, $Deuda_impaga, $Deuda_total, $celular, $funcionario, $oferta, $correo, $cal_tmp);
        
        $item = array(
                'nombres' => $nombre_largo,
				'dni' => $dni,
				'celular' => $celular,
				'situacion' => $cal_tmp,
				'sueldo_neto' => $sueldo,
				'saldo_pagar_cuota' => $saldo_pagar,
				'dias_atraso' => '0',
				'deudas_impagas' => $Deuda_impaga,
				'deuda_sistema' => $Deuda_total,
				'ruc' => '',
                'nombre_empresa' => $utm_source,
                'estado' => 'VEH PRE-APROBADO',
                'funcionario' => $funcionario,
            );
            $api->add2($item);
            
            //echo var_dump($item);
            
           header("Location: https://cp.com.pe/pacifico/credito-vehicular-2/");
           exit();
		}
            
    }
    else
    {
        $item = array(
                'nombres' => $nombre_largo,
				'dni' => $dni,
				'celular' => $celular,
				'situacion' => $cal_tmp,
				'sueldo_neto' => $sueldo,
				'saldo_pagar_cuota' => $saldo_pagar,
				'dias_atraso' => '0',
				'deudas_impagas' => $Deuda_impaga,
				'deuda_sistema' => $Deuda_total,
				'ruc' => '',
                'nombre_empresa' => $utm_source,
                'estado' => 'VEH NO CALIFICA',
                'funcionario' => '---',
            );
            $api->add2($item);
            
            header("Location: https://cp.com.pe/pacifico/credito-vehicular-nc/");
        exit();  
        
    }
    

?>