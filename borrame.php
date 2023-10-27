<?
/*
$email = "MIGUEL.TERUYA@cp.com.pe";

$pos_punto = strpos($email, '.',0);
$nombre = substr($email, 0,$pos_punto); 
$nombre = ucfirst(strtolower($nombre));

$email = substr($email, $pos_punto + 1);
$pos_arroba = strpos($email, '@',0);
$apellido = substr($email, 0, $pos_arroba);
$apellido = ucfirst(strtolower($apellido));

$email = substr($email, $pos_arroba + 1); // cp.com.pe
$email = strtolower($email);
*/
/*
include_once 'test.php';
$new = new CurlRequest();

$Nom = "Diego Maradona";
$celular = "51997855645";
$var1 = "14,000";
$var2 = "28";
$var3 = "587";
$var4 = "24";

$resultado = $new ->sendPost_notificacion_wsp_ofertas($Nom, $celular, $var1, $var2, $var3, $var4);
*/
/*
$AnoNac = "2002";
$AnoNac = intval($AnoNac);
$AnoAct = date('Y');
$edad = $AnoAct - $AnoNac;

// Rango entre 20 y 64

if($edad >= 20 and $edad <= 64){
    echo "[Dentro del rango 20 a 64]" . " Edad =" . $edad;
}else{
    echo "[Fuera del rango 20 a 64]" . " Edad =" . $edad;
}
*/
//$cadena = "google+ verde+ rojo";

$porciones = explode("+", $cadena);
for ($i = 5; $i >= 1; $i--) {
    echo $i;
}
//echo sizeof($porciones);
/*
echo "0->" . $porciones[0] . "<br>";
echo "1->" . $porciones[1] . "<br>";
echo "2->" . $porciones[2] . "<br>";
echo "3->" . $porciones[3] . "<br>";
echo "4->" . $porciones[4] . "<br>";
echo "5->" . $porciones[5] . "<br>";
*/
?>