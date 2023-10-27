<?php
include_once 'api_doble.php';
$api = new ApiPersonas();

$session = htmlspecialchars($_REQUEST["session"]);
$func = htmlspecialchars($_REQUEST["func"]);


if($session!="" and $func==1){ // utilizado
   $equipo = htmlspecialchars($_REQUEST["equipo"]);
   $api->abrir_carta_memoria_api($session, $equipo);
}

if($session!="" and $func==2){
   $api->empezar_otra_vez_api($session);
}

if($session!="" and $func==3){
   $api->borrar_juego_api($session);
}

if($session!="" and $func==4){ // utilizado
   $api->borrar_juego_memoria_api($session);
   $api->nuevo_juego_memoria_api($session);
}

if($session!="" and $func==5){

   $marca = htmlspecialchars($_REQUEST["marca"]);
   $api->ver_ranking($marca);
}

if($func==6){

   $marca = htmlspecialchars($_REQUEST["marca"]);
   $nombre = htmlspecialchars($_REQUEST["nombre"]);
   $dni = htmlspecialchars($_REQUEST["dni"]);
   $correo = htmlspecialchars($_REQUEST["correo"]);
   
   $api->insertar_ranking_api($nombre, $dni, $correo, $marca);
}

?>