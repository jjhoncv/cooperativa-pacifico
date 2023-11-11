<?php

session_start();

    
if (isset($_SESSION["login"]))
{
   include_once 'apipersonas.php';
   $api = new ApiPersonas();
?>
<!DOCTYPE HTML>
<html>
<head>
  <title>CP Agencias - Préstamos</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<style>
#div1, #div2, #div3, #div4, #div5, #div6, #div7, #div8  {
  float: left;
  width: 195px;
  height: 680px;
  margin: 10px;
  padding: 10px;
  border: 1px solid black;
  overflow-y: scroll;
  background-color: #ffffff;
}



#horizontal {
	overflow-x: scroll;
    width: 1800px;
    height: 710px;
    background-color: #0075B9;
}

.custom-scrollbar-js,
.custom-scrollbar-css {
  height: 200px;
}

.custom-scrollbar-css::-webkit-scrollbar-track {
  background: #eee;
}

.custom-scrollbar-css::-webkit-scrollbar {
  width: 5px;
}

.custom-scrollbar-css::-webkit-scrollbar-track {
  background: #eee;
}

.custom-scrollbar-css::-webkit-scrollbar-thumb {
  border-radius: 1rem;
  background-color: #00d2ff;
  background-image: linear-gradient(to top, #00d2ff 0%, #3a7bd5 100%);
}
</style>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="css/bootstrap.css">
  <script integrity="sha384-xBuQ/xzmlsLoJpyjoggmTEz8OWUFM0/RC5BsqQBDX2v5cMvDHcMakNTNrHIW2I5f" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
function allowDrop(ev) {
  ev.preventDefault();
}

function drag(ev) {
  ev.dataTransfer.setData("text", ev.target.id);
}

function drop(ev) {
  ev.preventDefault();
  var data = ev.dataTransfer.getData("text"); // elemento que se arrastra
  ev.target.appendChild(document.getElementById(data));
  if(ev.target.id!=""){
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.open("GET", "ajax_agencias?id="+data+"&paso="+ev.target.id, true);
      xmlhttp.send();
      setInterval("location.reload()",1000);
  }
  
}

function graba(id){
        
        var xmlhttp2 = new XMLHttpRequest();
		
		obs = document.getElementById("text"+id).value;
		paso = document.getElementById("combo"+id).value;
		funcionario = document.getElementById("func"+id).value;
		monto = document.getElementById("mont"+id).value;
		fec_desembolso = document.getElementById("fec_desemb"+id).value;
		moneda = document.getElementById("moneda"+id).value;
		cuotas = document.getElementById("cuotas"+id).value;
		rechazado = document.getElementById("rechazado"+id).value;
		tarea = document.getElementById("tarea"+id).value;
		tipo = document.getElementById("tipo"+id).value;
		agencia = document.getElementById("agencia"+id).value;
		fec_ingreso = document.getElementById("fec_ingreso"+id).value
		
		xmlhttp2.open("GET", "ajax2_agencias?id="+id+"&obs="+obs+"&paso="+paso+"&funcionario="+funcionario+"&monto="+monto+"&fec_desembolso="+fec_desembolso+"&moneda="+moneda+"&cuotas="+cuotas+"&rechazado="+rechazado+"&tarea="+tarea+"&tipo="+tipo+"&agencia="+agencia+"&fec_ingreso="+fec_ingreso, true);
		
        xmlhttp2.send(); 
        setInterval("location.reload()",1000);
}

function sms(celular, nombre, tipo){
    
        var xmlhttp3 = new XMLHttpRequest();
        xmlhttp3.open("GET", "ajax3?celular="+celular+"&nombre="+nombre+"&tipo="+tipo);
        xmlhttp3.send(); 
}

function agrega(){
    
    dni = document.getElementById("dni").value;
    nombres = document.getElementById("nombres").value;
    monto = document.getElementById("monto").value;
    cuotas = document.getElementById("cuotas").value;
	moneda = document.getElementById("moneda").value;
	fec_desembolso = document.getElementById("fec_desembolso").value;
	observaciones = document.getElementById("observaciones").value;
	origen = document.getElementById("origen").value;
    //origen = "Serv. Digitales";
	
    var xmlhttp4 = new XMLHttpRequest();
    xmlhttp4.open("GET", "agrega_agencias?dni="+dni+"&nombres="+nombres+"&monto="+monto+"&cuotas="+cuotas+"&moneda="+moneda+"&fec_desembolso="+fec_desembolso+"&observaciones="+observaciones+"&origen="+origen);
    xmlhttp4.send(); 
    setInterval("location.reload()",1000);
}

function elimina(id, detalle){
	
	accion = "elimina";

    var xmlhttp7 = new XMLHttpRequest();
    xmlhttp7.open("GET", "ajax_delete?id="+id+"&detalle="+detalle+"&accion="+accion);
    xmlhttp7.send(); 
    setInterval("location.reload()",1000);
}

function urgente(id, detalle){

	accion = "urgente";
	
    var xmlhttp8 = new XMLHttpRequest();
    xmlhttp8.open("GET", "ajax_delete?id="+id+"&detalle="+detalle+"&accion="+accion);
    xmlhttp8.send(); 
    setInterval("location.reload()",1000);
}

function refrescar(){
    setInterval("location.reload()",1800000);
}

function activa(){
	
	samantha = document.getElementById("Samantha").checked;
	daniel = document.getElementById("Daniel").checked;
	dayssy = document.getElementById("Dayssy").checked;
	gabriela = document.getElementById("Gabriela").checked;
	cinthia = document.getElementById("Cinthia").checked;
	christian = document.getElementById("Christian").checked;
	
	//document.getElementById("demo").innerHTML = "valor = "+samantha;
	
	var xmlhttp8 = new XMLHttpRequest();
    xmlhttp8.open("GET", "ajax_activa_funcionario?samantha="+samantha+"&daniel="+daniel+"&dayssy="+dayssy+"&gabriela="+gabriela+"&cinthia="+cinthia+"&christian="+christian);
    xmlhttp8.send(); 
    setInterval("location.reload()",1000);
	
}


</script>
</head>
<body onload="refrescar();">
<div id="horizontal">

<div id="div1" ondrop="drop(event)" ondragover="allowDrop(event)" class="p-0 custom-scrollbar-css"><div class="card-header bg-secondary text-white">Por Contactar <button type='button' class='btn btn-warning btn-xs' onclick="location.href='ingresa'">Agregar +</button></div>
<?php $api->getPasos_agencias('div1', htmlspecialchars($_GET['func'])); ?>
</div>

<div id="div2" ondrop="drop(event)" ondragover="allowDrop(event)" class="p-0 custom-scrollbar-css"><div class="card-header bg-secondary text-white">Pdte Docs  <button type='button' class='btn btn-warning btn-xs' onclick="location.href='agencias_info'">+ Info</button></div>
<?php $api->getPasos_agencias('div2', htmlspecialchars($_GET['func'])); ?>
</div>

<div id="div3" ondrop="drop(event)" ondragover="allowDrop(event)" class="p-0 custom-scrollbar-css"><div class="card-header bg-secondary text-white">En Evaluación</div>
<?php $api->getPasos_agencias('div3', htmlspecialchars($_GET['func'])); ?>
</div>

<div id="div4" ondrop="drop(event)" ondragover="allowDrop(event)" class="p-0 custom-scrollbar-css"><div class="card-header bg-secondary text-white">En Verificaciones</div>
<?php $api->getPasos_agencias('div4', htmlspecialchars($_GET['func'])); ?>
</div>

<div id="div5" ondrop="drop(event)" ondragover="allowDrop(event)" class="p-0 custom-scrollbar-css"><div class="card-header bg-secondary text-white">Listo p/desemb</div>
<?php $api->getPasos_agencias('div5', htmlspecialchars($_GET['func'])); ?>
</div>

<div id="div6" ondrop="drop(event)" ondragover="allowDrop(event)" class="p-0 custom-scrollbar-css"><div class="card-header bg-secondary text-white">Terminado</div>
<?php $api->getPasos3_agencias('div6', htmlspecialchars($_GET['func'])); ?>
</div>

<div id="div7" ondrop="drop(event)" ondragover="allowDrop(event)" class="p-0 custom-scrollbar-css"><div class="card-header bg-secondary text-white">No contesta</div>
<?php $api->getPasos_agencias('div7', htmlspecialchars($_GET['func'])); ?>
</div>

<div id="div8" ondrop="drop(event)" ondragover="allowDrop(event)" class="p-0 custom-scrollbar-css"><div class="card-header bg-secondary text-white">Rechazado</div>
<?php $api->getPasos_agencias('div8', htmlspecialchars($_GET['func'])); ?>
</div>
</div>

<?php $api->getModals_agencias(htmlspecialchars($_GET['func'])); ?>

<div class='modal fade' id='Agrega' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title' id='exampleModalLongTitle'>Ingresar Datos</h5>
            </div>
        <div class='modal-body'>
                    <input type='text' class='form-control' id='nombres' autocomplete='off' placeholder='Apellidos y Nombres' size='80' minlength='15' maxlength='300' required aria-describedby='inputGroup-sizing-sm'><br>
					<input type='text' class='form-control' id='dni' autocomplete='off' placeholder='Dni' size='30' minlength='8' maxlength='8' required pattern='[0-9]+' aria-describedby='inputGroup-sizing-sm'><br>
					<input type='text' class='form-control' id='monto' autocomplete='off' placeholder='Monto' size='30' minlength='4' maxlength='6' required pattern='[0-9]+' aria-describedby='inputGroup-sizing-sm'><br>
					<input type='text' class='form-control' id='cuotas' autocomplete='off' placeholder='Numero de cuotas' size='30' minlength='1' maxlength='2' required pattern='[0-9]+' aria-describedby='inputGroup-sizing-sm'><br>
					<select class='form-select-lg' aria-label='Default select example' id='moneda'>
						<option value='1'>Soles</option>
						<option value='2'>Dolares</option>
					</select>
					<br><br>
					<label for="fec_desembolso">Fecha de Desembolso:</label>
					<input type="date" aria-label='Default select example' id="fec_desembolso" name="fec_desembolso">
					<textarea class='form-control' id='observaciones' placeholder='Comentarios'></textarea><br>
            </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                <button type='button' class='btn btn-primary' data-dismiss='modal' onclick='agrega()'>Guardar</button>
            </div>
        </div>
    </div>
</div>



</body>
</html>


<?php
}else
{
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Lista de Leads</title>
  <meta name="description" content="Listado de Leads">
  <meta name="author" content="SSDD">
  <link integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script integrity="sha384-xBuQ/xzmlsLoJpyjoggmTEz8OWUFM0/RC5BsqQBDX2v5cMvDHcMakNTNrHIW2I5f" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-PRSLE2J6GY"></script>

</head>
<body>
<br>
<form action="login_agencias2?pagina=agencias" method="post" name="cuerpo" autocomplete="off">
  <div class="container-fluid">
    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ingrese email">
  </div>
  <br>
  <div class="container-fluid">
    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Ingrese Contraseña">
  </div>
  <br>
  <div class="container-fluid text-center">
    <button type="submit" class="btn btn-primary">Ingresar</button>
  </div>
  
</form>

</body>
</html>
<?php
//$_SESSION["login"] = "OK";

}
?>

