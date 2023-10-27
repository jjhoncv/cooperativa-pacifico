<?php

$email = htmlspecialchars($_POST["email"]);
$password = htmlspecialchars($_POST["password"]);

$pagina = htmlspecialchars($_GET["pagina"]);

if($pagina!="om_info"){

	if($email=="admin@cp.com.pe" and $password=="coopac01")
	{
		session_start();
		$_SESSION["login"] = "OK";
	}
}
else
{
	if($email=="admin@cp.com.pe" and $password=="tetera01")
	{
		session_start();
		$_SESSION["login"] = "OK";
	}
	
}


  header("Location: $pagina");




?>