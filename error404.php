<?php
$info = htmlspecialchars($_SERVER['HTTP_USER_AGENT']);

$nombre_pag = htmlspecialchars($_SERVER["REQUEST_URI"]);
$nombre_pag = substr($nombre_pag,1);

include_once 'apipersonas.php';
$api = new ApiPersonas();
$api->obt_pagina($nombre_pag, $info);

?>