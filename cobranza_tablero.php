<?php
session_start();

    
if (isset($_SESSION["login"]))
{
   include_once 'apipersonas_cobranza.php';
   $api = new ApiPersonas();
?>
<!DOCTYPE HTML>
<html>
<head>
  <title>Cobranza</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<style>
#div1, #div2, #div3, #div4, #div5, #div6, #div7  {
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
    background-color: #ccec17;
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
      xmlhttp.open("GET", "ajax_cobranza?func=1&id="+data+"&paso="+ev.target.id, true);
      xmlhttp.send();
      setInterval("location.reload()",1000);
  }
  
}

function graba(id){
        
		var xmlhttp2 = new XMLHttpRequest();
        xmlhttp2.open("GET", "ajax_cobranza?func=2&id="+id+"&obs="+document.getElementById("text"+id).value, true);
        xmlhttp2.send(); 
        setInterval("location.reload()",1000);
}

function sms(celular, dias, monto, nombre, tipo){
    
        var xmlhttp3 = new XMLHttpRequest();
        xmlhttp3.open("GET", "ajax_cobranza?func=3&celular="+celular+"&dias="+dias+"&monto="+monto+"&nombre="+nombre+"&tipo="+tipo);
        xmlhttp3.send(); 
}

function refrescar(){
    setInterval("location.reload()",1800000);
}


</script>
</head>
<body onload="refrescar();">
<div id="horizontal">

<div id="div1" ondrop="drop(event)" ondragover="allowDrop(event)" class="p-0 custom-scrollbar-css"><div class="card-header bg-secondary text-white">DV 1-3 días <?php $api->getPasos2_cobranza_cuenta('div1', htmlspecialchars($_GET['grupo'])); ?> <button type='button' class='btn btn-warning btn-xs' onclick="location.href='cargaprestamo'">+</button></div>
<?php $api->getPasos2_cobranza('div1', htmlspecialchars($_GET['grupo'])); ?>
</div>

<div id="div2" ondrop="drop(event)" ondragover="allowDrop(event)" class="p-0 custom-scrollbar-css"><div class="card-header bg-secondary text-white">DV 4-30 días <?php $api->getPasos2_cobranza_cuenta('div2', htmlspecialchars($_GET['grupo'])); ?></div>
<?php $api->getPasos2_cobranza('div2', htmlspecialchars($_GET['grupo'])); ?>
</div>

<div id="div4" ondrop="drop(event)" ondragover="allowDrop(event)" class="p-0 custom-scrollbar-css"><div class="card-header bg-secondary text-white">DV 31-60 días <?php $api->getPasos2_cobranza_cuenta('div3', htmlspecialchars($_GET['grupo'])); ?></div>
<?php $api->getPasos2_cobranza('div3', htmlspecialchars($_GET['grupo'])); ?>
</div>

<div id="div3" ondrop="drop(event)" ondragover="allowDrop(event)" class="p-0 custom-scrollbar-css"><div class="card-header bg-secondary text-white">DV 61-90 días <?php $api->getPasos2_cobranza_cuenta('div4', htmlspecialchars($_GET['grupo'])); ?></div>
<?php $api->getPasos2_cobranza('div4', htmlspecialchars($_GET['grupo'])); ?>
</div>

<div id="div5" ondrop="drop(event)" ondragover="allowDrop(event)" class="p-0 custom-scrollbar-css"><div class="card-header bg-secondary text-white">DV 91-180 días <?php $api->getPasos2_cobranza_cuenta('div5', htmlspecialchars($_GET['grupo'])); ?></div>
<?php $api->getPasos2_cobranza('div5', htmlspecialchars($_GET['grupo'])); ?>
</div>

<div id="div6" ondrop="drop(event)" ondragover="allowDrop(event)" class="p-0 custom-scrollbar-css"><div class="card-header bg-secondary text-white">DV 181-360d <?php $api->getPasos2_cobranza_cuenta('div6', htmlspecialchars($_GET['grupo'])); ?></div>
<?php $api->getPasos2_cobranza('div6', htmlspecialchars($_GET['grupo'])); ?>
</div>

<div id="div7" ondrop="drop(event)" ondragover="allowDrop(event)" class="p-0 custom-scrollbar-css"><div class="card-header bg-secondary text-white">DV +361 días <?php $api->getPasos2_cobranza_cuenta('div7', htmlspecialchars($_GET['grupo'])); ?></div>
<?php $api->getPasos2_cobranza('div7', htmlspecialchars($_GET['grupo'])); ?>
</div>

</div>


<?php $api->getModals_cobranza2(htmlspecialchars($_GET['grupo'])); ?>


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
   <title>Cobranza</title>
  <meta name="description" content="cobranza">
  <meta name="author" content="SSDD">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script integrity="sha384-xBuQ/xzmlsLoJpyjoggmTEz8OWUFM0/RC5BsqQBDX2v5cMvDHcMakNTNrHIW2I5f" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>
<br>
<form action="login_agencias2?pagina=cobranza_tablero" method="post" name="cuerpo" autocomplete="off">
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
