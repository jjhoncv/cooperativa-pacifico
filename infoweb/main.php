<?php

include_once '../test.php';

$new = new CurlRequest();

	$accion = htmlspecialchars($_GET["accion"]);
	$func = htmlspecialchars($_POST["func"]);
	
	$msg = "";
	
	
	if($accion=="alta")
	{
		$etiqueta = "Alta de usuario";
		$func_web = "1";
	}else{
		$etiqueta = "Olvido de clave";
		$func_web = "2";
	}
	
if($func==1){

	$correo1 = htmlspecialchars($_POST["correo"]);
	$pos = strpos($correo1, "@");
	$dominio = strtolower(substr($correo1, $pos+1));
	$etiqueta = "Alta de usuario";
	$func_web = "1";

	if($dominio=="cp.com.pe")
	{
		$datos = $new->existe_usuario_db_api($correo1);
		$obj_datos = json_decode($datos);

		$respuesta = $obj_datos->respuesta;
		$token = $obj_datos->token;
		
		if($respuesta=="ok"){
			$msg = "El correo ingresado ya existe, intenta en olvido de Clave";
		}
		else{
			$token = rand_int(100000,999999); 
			$new->nuevo_usuario_db_api($correo1, $token);
			$new->sendPost_email_pacinet_bloqueo($correo1, $token);
			$msg = "Se ha enviado un correo para que continues el proceso";
		}
	}
	else
	{
		$msg = "Correo no válido, solo @cp.com.pe";
	}
	//exit();
}

if($func==2){
	
	$correo1 = htmlspecialchars($_POST["correo"]);
	$pos = strpos($correo1, "@");
	$dominio = strtolower(substr($correo1, $pos+1));
	$etiqueta = "Olvido de clave";
	$func_web = "2";

	if($dominio=="cp.com.pe")
	{
		$datos = $new->existe_usuario_db_api($correo1);
		$obj_datos = json_decode($datos);

		$respuesta = $obj_datos->respuesta;
		$token = $obj_datos->token;
		
		if($respuesta=="ok"){
			$token = rand_int(100000,999999); 
			$new->sendPost_email_pacinet_olvido($correo1, $token);
			$new->update_password_db_api($correo1, $token);
			$msg = "Se ha enviado un correo para que continues el proceso";
		}
		else{
			$msg = "El correo ingresado no existe, intenta de nuevo";
		}
	}
	else
	{
		$msg = "Correo no válido, solo @cp.com.pe";
	}
	//exit();
    
}
?>
<!doctype html>
<html lang="es">
   
<head>
<title>Infoweb - CP</title>
<meta name="description" content="Infoweb - CP">
<meta name="author" content="Servicios Digitales">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">

<link rel="icon" type="image/x-icon" href="favicon.png">
<link rel="stylesheet" href="estilos.css">
<script>
function ini(){
	var msg = "<?php echo $msg; ?>";
	
	if(msg!="")
		alert(msg);
	
}

function enviar(){
	
	if(document.getElementById('correo').value==""){
		alert("Por favor completar el campo correo electrónico.");
		return false;
	}
	
	document.cuerpo.submit();
}
</script>

</head>
<body onload="ini();">
<div class="container h-100">
		<div class="d-flex justify-content-center h-100">
			<div class="user_card">
				<div class="d-flex justify-content-center">
					<div class="brand_logo_container">
						<img src="PERFIL.jpg" class="brand_logo" alt="Logo" height="110">
					</div>
				</div>
				
				<div class="d-flex justify-content-center form_container">
				
					<form action="main" method="post" name="cuerpo">
					<input type="hidden" name="func" id="func" value="<?php echo $func_web; ?>">
						<div>
	
							<center><h3><?php echo $etiqueta; ?></h3></center>
							<br>
						</div>
					
					
						<div class="input-group mb-3">
	
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-envelope"></i></span>
							</div>
							<input type="text" name="correo" id="correo" class="form-control input_user" value="" placeholder="Correo electrónico">
						
						</div>
					
							<div class="d-flex justify-content-center">
							<br>
				 	<button type="button" name="button" class="btn login_btn" onclick="enviar()">Enviar</button>
				   </div>
					</form>
				</div>
		
				<div class="mt-4">
					<div class="d-flex justify-content-center links">
						<ol>
							<li value="1">Ingresa tu correo electrónico con dominio (@cp.com.pe)</li>
							<li value="2">Abre el correo enviado y sigue los pasos.</li>
						</ol> 
					</div>
					
				</div>
				<div>
					<center><a href="index"><i class="fas fa-undo"></i> Regresar a login</a></center>
				</div>
			</div>
			
			
					</div>
		
				
	</div>
	
	
</body>
</html>