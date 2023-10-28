<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Infoweb - CP</title>
  <meta name="description" content="Desbloqueo de Usuario Pacinet">
  <meta name="author" content="SSDD">
  <link rel="icon" type="image/x-icon" href="favicon.png">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script integrity="sha384-xBuQ/xzmlsLoJpyjoggmTEz8OWUFM0/RC5BsqQBDX2v5cMvDHcMakNTNrHIW2I5f" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">


<?php

session_start();
include_once 'persona_infoweb.php';

$persona = new Persona();

    
if (isset($_SESSION["acceso_pacinet"]))
{
	$nom_tmp = $_SESSION["acceso_pacinet"];
	$pos = strpos($nom_tmp, ".");
	$nom = ucfirst(substr($nom_tmp,0,$pos));
	$datos_mes = $persona->consultas_mes($nom_tmp);
	
	if($nom_tmp=="miguel.teruya@cp.com.pe"){
	echo "<div class='table-responsive'><table class='table' border='0'><tr><td align='left'><h2>Hola " . $nom . "</h2></td><td align='right'><a class='btn btn-success' href='estadisticas' role='button'>&#931; Estadísticas</a><a class='btn btn-danger' href='desconectar?pag=infoweb' role='button'>&#920; Cerrar sesión</a></td></tr></table></div><hr>";}else{
	echo "<div class='table-responsive'><table class='table' border='0'><tr><td align='left'><h2>Hola " . $nom . "</h2></td><td align='right'><a class='btn btn-danger' href='desconectar?pag=infoweb' role='button'>&#920; Cerrar sesión</a></td></tr></table></div><hr>";	
	}
	
}else{
	
	header("Location: index");
}


?>
<script>
function tercera(){
    
		dni = document.getElementById("dni").value;
		
		if(dni=="" || dni.length!=8)
		{
				alert("Ingresar un DNI válido");
				return false;
		}
		
		document.getElementById("juego").innerHTML = "<h3>Pensando ... </h3>";
		
		var xhttp7 = new XMLHttpRequest();
		xhttp7.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("juego").innerHTML =
			this.responseText;
			}
		};
		
		xhttp7.open("GET", "ajax_infoweb2?func=3&dni="+dni, true);
		xhttp7.send();
		
		document.getElementById("btn_enviar").style.display = "none";
		
		
		
}

function cuarta(){
    
		dni = document.getElementById("dni").value;
		
		if(dni=="" || dni.length!=8)
		{
				alert("Ingresar un DNI válido");
				return false;
		}
		
		document.getElementById("juego").innerHTML = "<h3>Pensando ... </h3>";
		
		var xhttp7 = new XMLHttpRequest();
		xhttp7.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("juego").innerHTML =
			this.responseText;
			}
		};
		
		xhttp7.open("GET", "ajax_infoweb2?func=4&dni="+dni, true);
		xhttp7.send();
		
		document.getElementById("btn_enviar").style.display = "none";
		
		
		
}

function segunda(){
    
		//document.getElementById("juego").innerHTML = "";
		
		token = document.getElementById("token").value;
		doi = document.getElementById("doi").value;
		scoring = document.getElementById("score").value;
		
		document.getElementById("juego").innerHTML = "<h3>Pensando ...  no cierres la ventana</h3><br><center><img src='reloj.gif'></center>";
		
		var xhttp9 = new XMLHttpRequest();
		xhttp9.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("juego").innerHTML =
			this.responseText;
			}
		};
		
		xhttp9.open("GET", "ajax_infoweb2?func=2&token="+token+"&dni="+doi+"&scoring="+scoring, true);
		xhttp9.send();
		
		
}

function confirmar(doi) {
  let text = "¿Estás seguro(a) que deseas actualizar la información el DNI "+doi+"?";
  if (confirm(text) == true) {
	  cuarta();
  } else {
    //text = "You canceled!";
  }
  //document.getElementById("juego").innerHTML = text;
}


document.addEventListener("DOMContentLoaded", () => {
    let boton = document.getElementById("crearpdf");
    let container = document.getElementById("contenedor");
 
    boton.addEventListener("click", event => {
        event.preventDefault();
        boton.style.display = "none";
        window.print();
    }, false);
 
    container.addEventListener("click", event => {
        boton.style.display = "initial";
    }, false);
 
}, false);

</script>

</head>
<body>


<div id='juego' class="container-fluid text-center"></div>


<div id="btn_enviar">
<center>
	<table>
    <thead>
		<tr>
            <th class='text-center' colspan='2'><h3>Infoweb</h3></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td colspan='2'>
			<div class="input-group input-group-lg">
			<input class="form-control form-control-lg" size="50" type="number" id="dni" name="dni" value="" placeholder='Ingresa DNI'>
			<div class="input-group-btn">
			<button type='button' class='btn btn-primary btn-lg' data-dismiss='modal' onclick='tercera();'><i class="glyphicon glyphicon-search"></i> Buscar</button>
			</div>
			<div>
			</td>
	</tbody>
	</table>
	<hr>
	<div class="container">
		<div class="row">
			<div class="col">
				<?php $persona->getListadoInfoweb_api($nom_tmp); ?>
			</div>
		</div>
	</div>

</center>
</div>


</body>
</html>