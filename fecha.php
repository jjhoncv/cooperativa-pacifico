<?php

session_start();
include_once 'apipersonas.php';
include_once 'test.php';
$api = new ApiPersonas();
$new = new CurlRequest();

date_default_timezone_set('America/Lima');
$des1 = "09:00";
$has1 = "18:00";
$desde = strtotime($des1);
$hasta = strtotime($has1);
//$fecha = date('"Y/m/d H:i:s"');
$fecha = date('Y-m-d');

$dia = date(w);
$hor1 = date("H:i");
$hora_actual = strtotime($hor1);

echo "Desde " . $desde . " - " . $des1 . "<br>";
echo "Hasta " . $hasta . " - " . $has1 . "<br>";
echo "Fecha " . $fecha . "<br>";
echo "Hora actual " . $hora_actual . " - " . $hor1 . "<br>";

$Nom = "SUSANA PATRICIA";
$_SESSION["miguel_t"] = "vacio";

//echo ucfirst(strtolower($Nom)) . "<br>"; 

if ($desde < $hora_actual and $hasta > $hora_actual) 
{    
    $api->feriado($fecha);
    echo $_SESSION["miguel_t"];
    
    //$resultado = $new ->sendPost_sms_personalizado("51997855645","Susana");
    if($dia==1 or $dia==2 or $dia==3 or $dia==4 or $dia==5)
        echo "Atendiendo";
    else
        echo "No Atendiendo - No es L-V";
}
else
{
    echo "No Atiendo";
}

?>