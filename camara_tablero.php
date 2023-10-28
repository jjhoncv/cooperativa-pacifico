<?php
session_start();

    
if (isset($_SESSION["login"]))
{
   include_once 'apipersonas_camara.php';
   $api = new ApiPersonas();
   
   $func = htmlspecialchars($_GET['func']);
   
?>
<!DOCTYPE HTML>
<html>
<head>
  <title>Camara Leads</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<style>
#div1, #div2, #div3, #div4, #div5, #div7  {
  float: left;
  width: 195px;
  height: 680px;
  margin: 10px;
  padding: 10px;
  border: 1px solid black;
  overflow-y: scroll;
  background-color: #ffffff;
}

 #div6  {
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
    width: 1600px;
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
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
      xmlhttp.open("GET", "ajax_camara?func=1&id="+data+"&paso="+ev.target.id, true);
      xmlhttp.send();
      setInterval("location.reload()",1000);
  }
  
}

function graba(id){
		
		var xmlhttp2 = new XMLHttpRequest();
        xmlhttp2.open("GET", "ajax_camara?func=2&id="+id+"&obs="+document.getElementById("text"+id).value+"&paso="+document.getElementById("combo"+id).value+"&fec_ingreso="+document.getElementById("fec_ingreso"+id).value+"&funcionario="+document.getElementById("func"+id).value+"&rechazado="+document.getElementById("rechazado"+id).value, true);
        xmlhttp2.send(); 
        setInterval("location.reload()",1000);
}

function wsp(nombre, celular){
    
        var xmlhttp3 = new XMLHttpRequest();
        xmlhttp3.open("GET", "ajax_plazofijo?func=3&celular="+celular+"&nombre="+nombre);
        xmlhttp3.send(); 
}


function refrescar(){
    setInterval("location.reload()",1800000);
}


</script>
</head>
<body onload="refrescar();">
<div id="horizontal">

<div id="div1" ondrop="drop(event)" ondragover="allowDrop(event)" class="p-0 custom-scrollbar-css"><div class="card-header bg-secondary text-white">Por Contactar</div>
<?php $api->getPasos2_camara('div1', $func); ?>
</div>

<div id="div2" ondrop="drop(event)" ondragover="allowDrop(event)" class="p-0 custom-scrollbar-css"><div class="card-header bg-secondary text-white">Contactado <button type='button' class='btn btn-warning btn-xs' onclick="location.href='camara'">+ Info</button></div>
<?php $api->getPasos2_camara('div2', $func); ?>
</div>

<div id="div3" ondrop="drop(event)" ondragover="allowDrop(event)" class="p-0 custom-scrollbar-css"><div class="card-header bg-secondary text-white">En evaluación</div>
<?php $api->getPasos2_camara('div3', $func); ?>
</div>

<div id="div4" ondrop="drop(event)" ondragover="allowDrop(event)" class="p-0 custom-scrollbar-css"><div class="card-header bg-secondary text-white">Inscripción</div>
<?php $api->getPasos2_camara('div4', $func); ?>
</div>

<div id="div5" ondrop="drop(event)" ondragover="allowDrop(event)" class="p-0 custom-scrollbar-css"><div class="card-header bg-secondary text-white">Desemb / Aperturado</div>
<?php $api->getPasos2_camara('div5', $func); ?>
</div>

<div id="div6" ondrop="drop(event)" ondragover="allowDrop(event)" class="p-0 custom-scrollbar-css"><div class="card-header bg-secondary text-white">Descartado</div>
<?php $api->getPasos2_camara('div6', $func); ?>
</div>

<div id="div7" ondrop="drop(event)" ondragover="allowDrop(event)" class="p-0 custom-scrollbar-css"><div class="card-header bg-secondary text-white">No contesta</div>
<?php $api->getPasos2_camara('div7', $func); ?>
</div>

</div>
<?php $api->getModals_camara(); ?>




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
   <title>Camara Leads</title>
   <meta name="author" content="SSDD">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script integrity="sha384-xBuQ/xzmlsLoJpyjoggmTEz8OWUFM0/RC5BsqQBDX2v5cMvDHcMakNTNrHIW2I5f" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>
<br>
<form action="login_agencias2?pagina=camara_tablero" method="post" name="cuerpo" autocomplete="off">
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
