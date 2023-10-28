<?php
include_once 'api_doble.php';
$api = new ApiPersonas();

if($_SESSION['$ultima']=="")
	$_SESSION['$ultima']=rand(100, 10000);

?>

<!DOCTYPE HTML>
<html>
<head>
  <title>Doble - Pacifico</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="css/bootstrap.css">
  <script integrity="sha384-xBuQ/xzmlsLoJpyjoggmTEz8OWUFM0/RC5BsqQBDX2v5cMvDHcMakNTNrHIW2I5f" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
function carga(){
	document.getElementById("crono").style.display = "none";
	document.getElementById("btn_abrir").style.display = "none";
	
	
}

function ranking(session, marca){
        var xhttp6 = new XMLHttpRequest();
		xhttp6.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("juego").innerHTML =
			this.responseText;
			}
		};
		xhttp6.open("GET", "ajax_abrir_carta?func=5&session="+session+"&marca="+marca, true);
		xhttp6.send();	
}

function abrir_carta(session)
{
		document.getElementById("abrirboton").disabled = true;
        var xhttp2 = new XMLHttpRequest();
		xhttp2.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("juego").innerHTML =
			this.responseText;
			
			
			
				if(document.getElementById("resp").value!="vacio")
				{
					inicio();
					document.getElementById("btn_abrir").style.display = "none";
				}
				else
				{
					document.getElementById("btn_abrir").style.display = "none";
					document.getElementById("juego").innerHTML = "";
					marca = document.getElementById("Horas").innerHTML + document.getElementById("Minutos").innerHTML + document.getElementById("Segundos").innerHTML + document.getElementById("Centesimas").innerHTML;
					ranking(session, marca);
				}
			
			}
		};
		
		ancho = screen.width;
		alto = screen.height;
		if(ancho>alto)
			equipo = "desktop";
		else
			equipo = "celular";
		
		xhttp2.open("GET", "ajax_abrir_carta?func=1&session="+session+"&equipo="+equipo, true);
		xhttp2.send();
		
}

function abrir_carta_primera(session)
{
		var xhttp2 = new XMLHttpRequest();
		xhttp2.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("juego").innerHTML =
			this.responseText;
			
				if(document.getElementById("resp").value!="vacio")
				{
					inicio();
					document.getElementById("btn_abrir").style.display = "none";
				}
				else
				{
					document.getElementById("btn_abrir").style.display = "none";
					document.getElementById("juego").innerHTML = "";
					marca = document.getElementById("Horas").innerHTML + document.getElementById("Minutos").innerHTML + document.getElementById("Segundos").innerHTML + document.getElementById("Centesimas").innerHTML;
					ranking(session, marca);
				}
			
			}
		};
		
		ancho = screen.width;
		alto = screen.height;
		if(ancho>alto)
			equipo = "desktop";
		else
			equipo = "celular";
		
		xhttp2.open("GET", "ajax_abrir_carta?func=1&session="+session+"&equipo="+equipo, true);
		xhttp2.send();
		
}

function empezar_otra_vez(session)
{
        var xhttp3 = new XMLHttpRequest();
		xhttp3.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("juego").innerHTML =
			this.responseText;
			}
		};
		xhttp3.open("GET", "ajax_abrir_carta?func=2&session="+session, true);
		xhttp3.send();
		
}

function borrar_juego(session)
{
        var xhttp4 = new XMLHttpRequest();
		xhttp4.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("juego").innerHTML =
			this.responseText;
			}
		};
		xhttp4.open("GET", "ajax_abrir_carta?func=3&session="+session, true);
		xhttp4.send();
		
}

function juego_nuevo(session)
{

		
		var xhttp5 = new XMLHttpRequest();
		xhttp5.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("juego").innerHTML =
			this.responseText;
			}
		};
		xhttp5.open("GET", "ajax_abrir_carta?func=4&session="+session, true);
		xhttp5.send();
		
		document.getElementById("crono").style.display = "block";
		document.getElementById("btn_abrir").style.display = "none";
		
		document.getElementById("btn_inicio").style.display = "none";
		document.getElementById("tiempo").style.visibility = "hidden";
		document.getElementById("titulo").style.display = "none";
		
		
		reinicio();
		
		
}

function validar(valor){
	
	resp = document.getElementById("resp").value;
	desc = document.getElementById("desc").value;
	//img = document.getElementById("img").value;
	
	if(valor==resp)
	{	
		parar();
		document.getElementById("juego").innerHTML = "<center><h3>Excelente, acertaste</h3>La respuesta es: <b>" + resp + "</b> " + desc + "<br><img src='images/" + resp + ".png'></center>";
		document.getElementById("btn_abrir").style.display = "block";
		document.getElementById("abrirboton").disabled = false;
	}

	if(valor!=resp)
	{	
		$("#error").modal('show');
	}	
}

var centesimas = 0;
var segundos = 0;
var minutos = 0;
var horas = 0;

function inicio () {
	control = setInterval(cronometro,10);
}
function parar () {
	clearInterval(control);
	
}
function reinicio () {
	clearInterval(control);
	centesimas = 0;
	segundos = 0;
	minutos = 0;
	horas = 0;
	Centesimas.innerHTML = ":00";
	Segundos.innerHTML = ":00";
	Minutos.innerHTML = ":00";
	Horas.innerHTML = "00";

}
function cronometro () {
	if (centesimas < 99) {
		centesimas++;
		if (centesimas < 10) { centesimas = "0"+centesimas }
		Centesimas.innerHTML = ":"+centesimas;
	}
	if (centesimas == 99) {
		centesimas = -1;
	}
	if (centesimas == 0) {
		segundos ++;
		if (segundos < 10) { segundos = "0"+segundos }
		Segundos.innerHTML = ":"+segundos;
	}
	if (segundos == 59) {
		segundos = -1;
	}
	if ( (centesimas == 0)&&(segundos == 0) ) {
		minutos++;
		if (minutos < 10) { minutos = "0"+minutos }
		Minutos.innerHTML = ":"+minutos;
	}
	if (minutos == 59) {
		minutos = -1;
	}
	if ( (centesimas == 0)&&(segundos == 0)&&(minutos == 0) ) {
		horas ++;
		if (horas < 10) { horas = "0"+horas }
		Horas.innerHTML = horas;
	}
}

function guardar(){
        
		var xhttp9 = new XMLHttpRequest();
		xhttp9.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("juego").innerHTML =
			this.responseText;
			}
		};
		
		marca = document.getElementById("marca").value;
		nombre = document.getElementById("nombre").value;
		dni = document.getElementById("dni").value;
		correo = document.getElementById("correo").value;
		
		xhttp9.open("GET", "ajax_abrir_carta?func=6&marca="+marca+"&nombre="+nombre+"&dni="+dni+"&correo="+correo, true);
		xhttp9.send();

}

function refrescar(){
		location.reload();
}

 </script>
<style type="text/css">
  *{
	margin: 0;
	padding: 0;
}
#contenedor{
	margin: 10px auto;
	width: 540px;
	height: 115px;
}
.reloj{
	float: left;
	font-size: 20px;
	font-family: Courier,sans-serif;
	color: #363431;
}
.boton{
	outline: none;
	border: 1px solid #363431;
	color: white;
	width: 128px;
	height: 30px;
	text-shadow: 0px -1px 1px black;
	font-size: 20px;
	border-radius: 5px;
	font-family: Helvetica;
	cursor: pointer;
	background-image: linear-gradient(#3aad02,#2c6f05);
}
.boton:active{
	background-image: linear-gradient(#2c6f05,#3aad02);
}
.boton:hover{
	box-shadow: 0px 0px 14px #3aad02;
}
  </style>
</head>
<body onload="carga()">
    <div class='container'>
        <div class='row'>
			<table class='table table-responsive text-center'>
			<tr>
				<td><div id="btn_inicio"><button type='button' class='btn btn-danger' data-dismiss='modal' onclick="juego_nuevo('<?php echo $_SESSION['$ultima']; ?>')">Jugar</button></div></td>
				<td class='text-center'><div id="titulo"><h4><b>🌊 Doble Pacífico 🌊</b></h4></div></td>
				<td>
					<div id="crono">
						<div class="reloj" id="Horas">00</div>
						<div class="reloj" id="Minutos">:00</div>
						<div class="reloj" id="Segundos">:00</div>
						<div class="reloj" id="Centesimas">:00</div>
					</div>
				</td>
				<td><div id="btn_abrir"><button type='button' class='btn btn-primary' id='abrirboton' data-dismiss='modal' onclick="abrir_carta('<?php echo $_SESSION['$ultima']; ?>')">Siguiente</button></div></td>
			</tr>
			</table>
			<div id='juego'></div>
		</div>

    </div>
	<div id='tiempo' align='center'><img src="images/Demo.png"></div>
	
	<!-- Modal Error -->
    <div class="modal fade" id="error" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLongTitle">Sigue buscando</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    Tienes que encontrar la imagen que se repite !!   
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
    </div>
	
	<!-- Nueva marca -->
    <div class="modal fade" id="nueva_marca" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLongTitle">Guarda tu marca</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
					<input type='text' class='form-control' id='nombre' autocomplete='off' placeholder='Nombre o nickname' size='30' minlength='8' maxlength='100' required aria-describedby='inputGroup-sizing-sm'><br>
                    <input type='text' class='form-control' id='dni' autocomplete='off' placeholder='Dni' size='30' minlength='8' maxlength='8' required pattern='[0-9]+' aria-describedby='inputGroup-sizing-sm'><br>
					<input type='email' class='form-control' id='correo' autocomplete='off' placeholder='Correo' size='30' minlength='8' maxlength='80' required pattern='[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$'>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal" onclick='guardar()'>Guardar</button>
                  </div>
                </div>
              </div>
    </div>
	
</body>
</html>
