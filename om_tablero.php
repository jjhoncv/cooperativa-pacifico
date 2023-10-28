<?php
session_start();

    
if (isset($_SESSION["login"]))
{
   include_once 'apipersonas_om.php';
   $api = new ApiPersonas();
?>
<!DOCTYPE HTML>
<html>
<head>
  <title>O&M - Colocaciones</title>
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
      xmlhttp.open("GET", "ajax_om?func=1&id="+data+"&paso="+ev.target.id, true);
      xmlhttp.send();
      setInterval("location.reload()",1000);
  }
  
}

function graba(id){
        
		var xmlhttp2 = new XMLHttpRequest();
        xmlhttp2.open("GET", "ajax_om?func=2&id="+id+"&obs="+document.getElementById("text"+id).value+"&monto="+document.getElementById("mont"+id).value+"&paso="+document.getElementById("combo"+id).value+"&funcionario="+document.getElementById("func"+id).value+"&fec_ingreso="+document.getElementById("fec_ingreso"+id).value+"&tipo="+document.getElementById("tipo"+id).value+"&convenio="+document.getElementById("convenio"+id).value, true);
        xmlhttp2.send(); 
        setInterval("location.reload()",1000);
}

function sms(celular, nombre, funcionario, tipo){
    
        var xmlhttp3 = new XMLHttpRequest();
        xmlhttp3.open("GET", "ajax_om?func=3&celular="+celular+"&nombre="+nombre+"&tipo="+tipo+"&funcionario="+funcionario);
        xmlhttp3.send(); 
}

function mail(dni, nombres, monto, origen){

    cuotas = "";
	moneda = "1";
	fec_desembolso = "";
	observaciones = "";
	
	var xmlhttp5 = new XMLHttpRequest();
    xmlhttp5.open("GET", "agrega_agencias?dni="+dni+"&nombres="+nombres+"&monto="+monto+"&cuotas="+cuotas+"&moneda="+moneda+"&fec_desembolso="+fec_desembolso+"&observaciones="+observaciones+"&origen="+origen+"&tipo=prestamo&urgente=0");
    xmlhttp5.send(); 
}

function agrega(){
    
    dni = document.getElementById("dni").value;
    celular = document.getElementById("celular").value;
    correo = document.getElementById("correo").value;
    sueldo = document.getElementById("sueldo").value;
    funcionario = document.getElementById("funcionario").value;
	
    var xmlhttp4 = new XMLHttpRequest();
    xmlhttp4.open("GET", "agrega_eval_om?dni="+dni+"&celular="+celular+"&correo="+correo+"&sueldo="+sueldo+"&funcionario="+funcionario);
    xmlhttp4.send(); 
    setInterval("location.reload()",1000);
}

function refrescar(){
    setInterval("location.reload()",1800000);
}


</script>
</head>
<body onload="refrescar();">
<div id="horizontal">

<div id="div1" ondrop="drop(event)" ondragover="allowDrop(event)" class="p-0 custom-scrollbar-css"><div class="card-header bg-secondary text-white">Prospecto <button type='button' class='btn btn-warning btn-xs' btn-xs' data-toggle='modal' data-target='#Agrega'>Agregar +</button></div>
<?php $api->getPasos2_pdp('div1', htmlspecialchars($_GET['func'])); ?>
</div>

<div id="div2" ondrop="drop(event)" ondragover="allowDrop(event)" class="p-0 custom-scrollbar-css"><div class="card-header bg-secondary text-white">Envio Docs <button type='button' class='btn btn-warning btn-xs' onclick="location.href='om_info'">+ Info</button></div>
<?php $api->getPasos2_pdp('div2', htmlspecialchars($_GET['func'])); ?>
</div>

<div id="div4" ondrop="drop(event)" ondragover="allowDrop(event)" class="p-0 custom-scrollbar-css"><div class="card-header bg-secondary text-white">En Verificaciones</div>
<?php $api->getPasos2_pdp('div3', htmlspecialchars($_GET['func'])); ?>
</div>

<div id="div3" ondrop="drop(event)" ondragover="allowDrop(event)" class="p-0 custom-scrollbar-css"><div class="card-header bg-secondary text-white">UEC <button type='button' class='btn btn-warning btn-xs' onclick="location.href='sube_file'">Sube file</button></div>
<?php $api->getPasos2_pdp('div4', htmlspecialchars($_GET['func'])); ?>
</div>

<div id="div5" ondrop="drop(event)" ondragover="allowDrop(event)" class="p-0 custom-scrollbar-css"><div class="card-header bg-secondary text-white">Aprobado</div>
<?php $api->getPasos2_pdp('div5', htmlspecialchars($_GET['func'])); ?>
</div>

<div id="div6" ondrop="drop(event)" ondragover="allowDrop(event)" class="p-0 custom-scrollbar-css"><div class="card-header bg-secondary text-white">Desembolsado</div>
<?php $api->getPasos3_pdp('div6', htmlspecialchars($_GET['func'])); ?>
</div>

<div id="div7" ondrop="drop(event)" ondragover="allowDrop(event)" class="p-0 custom-scrollbar-css"><div class="card-header bg-secondary text-white">Descartados</div>
<?php $api->getPasos2_descartados_pdp('div7', htmlspecialchars($_GET['func'])); ?>
</div>

</div>
<?php $api->getModals_pdp(htmlspecialchars($_GET['func'])); ?>


<div class='modal fade' id='Agrega' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title' id='exampleModalLongTitle'>Ingresar Datos</h5>
            </div>
        <div class='modal-body'>
                    <input type='text' class='form-control' id='dni' autocomplete='off' placeholder='Dni' size='30' minlength='8' maxlength='9' required pattern='[0-9]+' aria-describedby='inputGroup-sizing-sm'><br>
                    <input type='text' class='form-control' id='celular' autocomplete='off' placeholder='Celular' size='30' minlength='9' maxlength='9' required pattern='[0-9]+'><br>
                    <input type='text' class='form-control' id='correo' autocomplete='off' placeholder='Correo' size='30' minlength='8' maxlength='80' required pattern='[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$'><br>
                    <input type='text' class='form-control' id='sueldo' autocomplete='off' placeholder='Sueldo' size='30' minlength='5' maxlength='5' required pattern='[0-9]+'><br>
                    <select class='form-select-lg' aria-label='.form-select-sm example' id='funcionario'>
                        <option value='Agente1'>[1] Agente</option>
                        <option value='Agente2'>[2] Agente</option>
                        <option value='Agente3'>[3] Agente</option>
						<option value='Agente4'>[4] Agente</option>
						<option value='Agente5'>[5] Agente</option>
						<option value='Agente6'>[6] Agente</option>
						<option value='Agente7'>[7] Agente</option>
						<option value='Agente8'>[8] Agente</option>
				    </select>
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
   <title>O&M - Colocaciones</title>
  <meta name="description" content="Pdp Colocaciones">
  <meta name="author" content="SSDD">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script integrity="sha384-xBuQ/xzmlsLoJpyjoggmTEz8OWUFM0/RC5BsqQBDX2v5cMvDHcMakNTNrHIW2I5f" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>
<br>
<form action="login_pdp2?pagina=om_tablero" method="post" name="cuerpo" autocomplete="off">
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
