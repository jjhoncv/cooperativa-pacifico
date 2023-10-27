<?php
include_once 'mini_test.php';
$new = new CurlRequest();
	
$email = $_POST["email"];
$password = $_POST["password"];

$pagina = htmlspecialchars($_GET["pagina"]);

	$datos = $new->valida_ususario($email, $password);
	$obj_datos = json_decode($datos);

	$respuesta = $obj_datos->respuesta;
	
	if($respuesta=="ok"){
		session_start();
		$_SESSION["acceso_pacinet"] = "$email";
		header("Location: $pagina");
	}
	else{
		
		header("Location: $pagina?msg=Email%20o%20clave%20incorrectos");	
	}

  




?>