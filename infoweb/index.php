<?php
$msg = "";

$msg = htmlspecialchars($_GET["msg"]);

?>

<!doctype html>
<html lang="es">
   
<head>
	<title>Infoweb - CP</title>
	<meta name="description" content="Infoweb - CP">
  <meta name="author" content="Servicios Digitales">
	<meta charset="utf-8">
	<link rel="icon" type="image/x-icon" href="favicon.png">
	
	
	<link integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
	
	<script integrity="sha384-xBuQ/xzmlsLoJpyjoggmTEz8OWUFM0/RC5BsqQBDX2v5cMvDHcMakNTNrHIW2I5f" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

	<link rel="stylesheet" href="estilos.css">
	<script>
function valida(){
		
	if(document.getElementById('email').value==""){
		alert("Por favor llenar el campo email");
		return false;
	}
	
	if(document.getElementById('password').value==""){
		alert("Por favor llenar el campo clave");
		return false;
	}
	
	document.cuerpo.submit();
		
}

function alta(){
        
		self.location.href="main?accion=alta";
		return false;
}	

function olvido(){
        
		self.location.href="main?accion=olvido";
		return false;
}

function ini(){
	var msg = "<?php echo $msg; ?>";
	
	if(msg!="")
		alert(msg);
	
}	


</script>
</head>
<!--Coded with love by Mutiullah Samim-->
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
					<form action="login_usuario?pagina=infoweb" method="post" name="cuerpo">
						<div class="input-group mb-3">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-envelope"></i></span>
							</div>
							<input type="text" name="email" id="email" class="form-control input_user" value="" placeholder="Correo electrónico">
						</div>
						<div class="input-group mb-2">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-key"></i></span>
							</div>
							<input type="password" name="password" id="password" class="form-control input_pass" value="" placeholder="Clave">
						</div>
						<div class="form-group">
							<div class="custom-control custom-checkbox">
								<input type="checkbox" class="custom-control-input" id="customControlInline">
								<label class="custom-control-label" for="customControlInline">Recuerdame</label>
							</div>
						</div>
							<div class="d-flex justify-content-center mt-3 login_container">
				 	<button type="button" name="button" class="btn login_btn" onclick="valida()">Entrar</button>
				   </div>
					</form>
				</div>
		
				<div class="mt-4">
					<div class="d-flex justify-content-center links">
						¿No tienes una cuenta?&nbsp;&nbsp; 	<a href="Javascript:onclick=alta();">Haz clic aquí</a>
					</div>
					<div class="d-flex justify-content-center links">
						<a href="Javascript:onclick=olvido();">Olvidaste tu clave?</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	


</body>
</html>
