<?php
session_start();

    
if (isset($_SESSION["acceso_pacinet"]))
{

include_once 'test.php';

$new = new CurlRequest();

//1 = código de socio 0 = DNI


$doi = $_POST["doi"];
if(strlen($doi)==8)
    $tipo = 0;
else
    $tipo = "1";

if($doi!="")
{
$resultado = $new ->sendGet_estadoPacinet($tipo, $doi);
$obj = json_decode($resultado);
    
$attemptCounter = $obj->data->attemptCounter;
$pCip = $obj->data->pCip;
$errorCode = $obj->data->errorCode;
$blockDateRequest = $obj->data->blockDateRequest;
$names = $obj->data->names;
$surNames = $obj->data->surNames;
$status = $obj->data->status;
$blockDateAttempt = $obj->data->blockDateAttempt;
$adviserBlock = $obj->data->adviserBlock;

$selec_act="";$selec_blo="";$modal="";

if($attemptCounter!=3 and $status==""){
    $estado = " <button type='button' class='btn btn-success' data-toggle='modal' data-target='#exampleModalCenter25'>👆 Activo</button>";
    $estado_breve = "Activo";
    $selec_act = "selected ";
    $modal = "";
}

if($attemptCounter==3 or $status=="bloqueado"){
    $estado = " <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#exampleModalCenter25'>👆 Bloqueado</button>";
    $estado_breve = "Bloqueado";
    $selec_blo = "selected ";
    $modal = "[" . $attemptCounter . "] intentos fallidos";
    if($blockDateAttempt!=""){
        $modal = $modal . "<br>Fec. Bloqueo por intentos: " . $blockDateAttempt . "<br>";
    }
    if($blockDateRequest!=""){
        $modal = $modal . "<br>Fec. Bloqueo por solicitud: " . $blockDateRequest . "<br>";
    }
    
}

if($errorCode==""){
    $resultado = $pCip . " - " . $surNames . ", " . $names . "<br>" . $estado;
}else{
    $resultado = $doi . " - " . $errorCode;
}


    
}
?>

<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Desbloqueo de Usuario Pacinet</title>
  <meta name="description" content="Desbloqueo de Usuario Pacinet">
  <meta name="author" content="SSDD">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
function graba(doi){
        
    var xmlhttp2 = new XMLHttpRequest();
        xmlhttp2.open("GET", "ajax_pacinet?doi="+doi+"&tipo="+document.getElementById("estado").value+"&correo="+document.getElementById("usuario").value, true);
		xmlhttp2.send();
		setInterval("location.reload()",1000);
}
</script>
</head>
<body>
    <div class="container">
        <form action="pacinet" method="post" name="cuerpo" autocomplete="off">
		<input type="hidden" name="usuario" id="usuario" value="<?php echo $_SESSION["acceso_pacinet"];?>">
            <br>
              <div class="mb-3">
                <h3>Bloqueo y Desbloqueo de Usuarios Pacinet</h3>
                <input type="text" id="doi" name="doi" size="30" placeholder="Código de socio o DNI">
              <button type="submit" class="btn btn-primary btn-xs">Buscar</button>
                
              </div>
        <br>

        </form>    
        
        <div class="mb-3">
            <?php echo $resultado; ?>
        </div>
		<div id="demo"></div>
		<br><br>
		<a href="https://pacinet.cp.com.pe/recoveryPassword">https://pacinet.cp.com.pe/recoveryPassword</a>
		<h3>Últimos eventos</h3>
		<?php $new->getListadoPacinet_api(); ?>
		<hr>
		<a class="btn btn-danger" href="desconectar?pag=pacinet" role="button">&#920; Cerrar sesión</a>

    </div>
    
            <div class="modal fade" id="exampleModalCenter25" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"><?php echo $pCip . " - " . $surNames . ", " . $names; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <?php echo $modal; ?> 
                    
                    <select class='form-select-lg' aria-label='Default select example' id='estado'>
                        <option <?php echo $selec_act; ?>value='unlock'>Activo</option>
                        <option <?php echo $selec_blo; ?>value='lock'>Bloqueado</option>
                    </select>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="graba('<?php echo $pCip; ?>')">Guardar</button>
                  </div>
                </div>
              </div>
            </div>


</body>
</html>



<?php
}else
{
	$msg = $_GET["msg"];
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <title>Desbloqueo de Usuario Pacinet</title>
  <meta name="description" content="Desbloqueo de Usuario Pacinet">
  <meta name="author" content="SSDD">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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

function nuevo(){
        
		var xmlhttp2 = new XMLHttpRequest();
		xmlhttp2.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("juego").innerHTML =
			this.responseText;
			}
		};
        xmlhttp2.open("GET", "ajax_pacinet?func=1&correo="+document.getElementById("correo1").value, true);
        xmlhttp2.send();
        
}	

function olvido(){
        
		var xmlhttp3 = new XMLHttpRequest();
		xmlhttp3.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("juego").innerHTML =
			this.responseText;
			}
		};
        xmlhttp3.open("GET", "ajax_pacinet?func=2&correo="+document.getElementById("correo2").value, true);
        xmlhttp3.send();
        
}	


</script>
</head>
<body>
<br>
<form action="login_usuario?pagina=pacinet" method="post" name="cuerpo" autocomplete="on">
  <div class="container-fluid">
    <input type="email" name="email" id="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ingrese email">
  </div>
  <br>
  <div class="container-fluid">
    <input type="password" name="password" id="password" class="form-control" id="exampleInputPassword1" placeholder="Ingrese Clave">
  </div>
  <br>
  <div class="container-fluid text-center">
    <button type="button" class="btn btn-primary" onclick='valida();'>Ingresar</button><br><br>
	<div id='juego'><?php echo $msg; ?>&nbsp;</div>
  </div>
  <hr>
  <div class="container-fluid text-center">
	<button type='button' data-toggle='modal' data-target='#Crear' class='btn btn-outline-primary btn-xs'>Crear usuario</button> | 
	<button type='button' data-toggle='modal' data-target='#Olvido' class='btn btn-outline-primary btn-xs'>Olvido de clave</button>
  </div>
</form>


<div class='modal fade' id='Crear' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h3 class='modal-title' id='exampleModalLongTitle'>
					Creación de usuario
					</h3>
            </div>
        <div class='modal-body'>
				
							<input type="text" name="correo1" id="correo1" size="45" placeholder="Ingresa tu correo de la Cooperativa Pacífico">
							
							<br><br>
							Se enviará un link para completar el proceso
            </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
				<button type='button' class='btn btn-primary' data-dismiss='modal' onclick='nuevo()'>Guardar</button>
                
            </div>
        </div>
    </div>
</div>


<div class='modal fade' id='Olvido' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h3 class='modal-title' id='exampleModalLongTitle'>
					Olvido de clave
					</h3>
            </div>
        <div class='modal-body'>
				
							<input type="text" name="correo2" id="correo2" size="45" placeholder="Ingresa tu correo de la Cooperativa Pacífico">
							
							<br><br>
							Se enviará un link para completar el proceso
            </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
				<button type='button' class='btn btn-primary' data-dismiss='modal' onclick='olvido()'>Guardar</button>
                
            </div>
        </div>
    </div>
</div>

</body>
</html>
<?php
//$_SESSION["login"] = "OK";

}
?>