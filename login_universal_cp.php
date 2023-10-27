<?php

$email = trim($_POST["email"]);
$password = trim($_POST["password"]);
$pagina = htmlspecialchars($_GET["ori"]);

if($email==$password)
{
    if($email=="kenji.okuhama@cp.com.pe" or $email=="milagros.sarmiento@cp.com.pe" or $email=="kenji.kokuhama@cp.com.pe" or $email=="donna.landeo@cp.com.pe" or $email=="edith.zamora@cp.com.pe" or $email=="sandra.gomez@cp.com.pe")
	{
		header("Location: $pagina?msg=Error%20en%20Acceso");
	}else{
		
		session_start();
		$_SESSION["funcionario"] = $email;
		header("Location: $pagina");
	}
}
else
{

  header("Location: $pagina?msg=Error%20en%20Acceso");
}



?>