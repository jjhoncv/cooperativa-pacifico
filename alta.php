<?php

include_once 'test.php';
$new = new CurlRequest();

$token = $_GET["token"];
$correo = $_POST["correo"];
$clave1 = $_POST["clave1"];

if($token!=""){
		
		$datos = $new->existe_password_db_api($token);
		$obj_datos = json_decode($datos);

		$respuesta = $obj_datos->respuesta;
		$correo_db = $obj_datos->correo_db;
		
		if($respuesta=="ok"){
			//echo "El correo ingresado ya existe, intenta en olvido de Clave";
		}
		else{
			header("Location: pacinet");
		}
}else{
	
	$new->update_password_db_api($correo, $clave1);
	//header("Location: pacinet?msg=Se%20actualizo%20la%20clave%20de%20manera%20satisfactoria");
	$msg = "Se actualizo la clave de manera satisfactoria";
	
}

?>

<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <title>Alta de Usuario</title>
  <meta name="description" content="Desbloqueo de Usuario Pacinet - Cambio de clave">
  <meta name="author" content="SSDD">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
function valida(){
	
	if(document.getElementById('clave1').value=="" || document.getElementById('clave1').value.length<8)
	{
		alert("Ingresar una clave válida, minimo 8 caracteres");
		document.getElementById('clave1').focus();
		return false;
	}
	
	if(document.getElementById('clave2').value=="" || document.getElementById('clave2').value.length<8)
	{
		alert("Ingresar una clave válida, minimo 8 caracteres");
		document.getElementById('clave2').focus();
		return false;
	}
	
	if(document.getElementById('clave1').value!=document.getElementById('clave2').value)
	{
		alert("No coinciden las claves");
		document.getElementById('clave2').focus();
		return false;
	}
	
	document.cuerpo.submit();
}
</script>
</head>
<body>
<br>
<form action="alta?pagina=pacinet" method="post" name="cuerpo" autocomplete="off">
<input type="hidden" id="correo" name="correo" value="<?php echo $correo_db; ?>">
  <div class="container-fluid">
    <h3>Genera tu clave de acceso</h3>
  </div>
  <br>
  <div class="container-fluid">
    <input type="password" name="clave1" id="clave1" class="form-control" id="exampleInputPassword1" placeholder="Ingrese Clave">
  </div>
  <br>
  <div class="container-fluid">
    <input type="password" name="clave2" id="clave2" class="form-control" id="exampleInputPassword1" placeholder="Confirmar Clave">
  </div>
  <br>
  <div class="container-fluid text-center">
    <button type="button" class="btn btn-primary" onclick='valida();'>Ingresar</button><br><br>
	<div id='juego'><?php echo $msg; ?></div>
  </div>