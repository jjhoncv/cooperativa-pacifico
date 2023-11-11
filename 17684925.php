<?php
session_start();
$agencia = "Surquillo";
$pagina_web = "17684925";

	if (isset($_SESSION["funcionario"]))
    {
        
    include_once 'apipersonas.php';
    $api = new ApiPersonas();

	
?>
<!DOCTYPE HTML>
<html>
<head>
  <title><?php echo $agencia; ?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<style>
#div1, #div2, #div3, #div4, #div5, #div6, #div7, #div8  {
  float: left;
  width: 195px;
  height: 620px;
  margin: 10px;
  padding: 10px;
  border: 1px solid black;
  overflow-y: scroll;
  background-color: #ffffff;
}



#horizontal {
	overflow-x: scroll;
    width: 1750px;
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
      xmlhttp.open("GET", "ajax_agencias2?id="+data+"&paso="+ev.target.id, true);
      xmlhttp.send();
      setInterval("location.reload()",1000);
  }
  
}

function agrega(){
    
    dni = document.getElementById("dni").value;
    nombres = document.getElementById("nombres").value;
    codigo = document.getElementById("codigo").value;
	observaciones = document.getElementById("observaciones").value;
	agencia = "<?php echo $agencia; ?>";
	correo = document.getElementById("correo").value;
	celular = document.getElementById("celular").value;
	funcionario = document.getElementById("funcionario").value;	
	canal = document.getElementById("canal").value;
	tarea = document.getElementById("tarea").value;
	
	
    var xmlhttp4 = new XMLHttpRequest();
    xmlhttp4.open("GET", "agrega_agencias2?dni="+dni+"&nombres="+nombres+"&codigo="+codigo+"&agencia="+agencia+"&correo="+correo+"&celular="+celular+"&observaciones="+observaciones+"&funcionario="+funcionario+"&canal="+canal+"&tarea="+tarea,true);
    xmlhttp4.send(); 
    setInterval("location.reload()",1000);

}


function graba(id){
        
        var xmlhttp2 = new XMLHttpRequest();
		
		obs = document.getElementById("text"+id).value;
		paso = document.getElementById("combo"+id).value;
		funcionario = document.getElementById("func"+id).value;
		monto = document.getElementById("mont"+id).value;
		tarea = document.getElementById("tarea"+id).value;
		canal = document.getElementById("canal"+id).value;
		moneda = document.getElementById("moneda"+id).value;
		fec_ingreso = document.getElementById("fec_ingreso"+id).value;
		rechazado = document.getElementById("rechazado"+id).value;
		
		xmlhttp2.open("POST", "ajax2_agencias2?id="+id+"&obs="+obs+"&paso="+paso+"&funcionario="+funcionario+"&monto="+monto+"&tarea="+tarea+"&canal="+canal+"&moneda="+moneda+"&fec_ingreso="+fec_ingreso+"&rechazado="+rechazado, true);
		
        xmlhttp2.send(); 
        setInterval("location.reload()",1000);
}

function refrescar(){
    setInterval("location.reload()",1800000);
}

function elimina(id, detalle){
	
	accion = "elimina";
	detalle = "Agencias2";

    var xmlhttp7 = new XMLHttpRequest();
    xmlhttp7.open("GET", "ajax_delete_agencias2?id="+id+"&tabla="+detalle+"&accion="+accion);
    xmlhttp7.send(); 
    setInterval("location.reload()",1000);
}

function mail(dni, nombres, monto, origen, observaciones){

    cuotas = "";
	moneda = "1";
	fec_desembolso = "";
	//observaciones = "";
	
	var xmlhttp5 = new XMLHttpRequest();
    xmlhttp5.open("GET", "agrega_agencias?dni="+dni+"&nombres="+nombres+"&monto="+monto+"&cuotas="+cuotas+"&moneda="+moneda+"&fec_desembolso="+fec_desembolso+"&observaciones="+observaciones+"&origen="+origen+"&tipo=prestamo&urgente=0");
    xmlhttp5.send(); 
}


</script>
</head>
<body onload="refrescar();">
<div id="horizontal">
<div id="div1" ondrop="drop(event)" ondragover="allowDrop(event)" class="p-0 custom-scrollbar-css"><div class="card-header bg-secondary text-white">Por contactar <button type='button' class='btn btn-warning btn-xs' data-toggle='modal' data-target='#Agrega'>Agregar +</button></div>
<?php $api->getPasos_tablero_agencias('div1', $agencia, htmlspecialchars($_GET['func'])); ?>
</div>

<div id="div2" ondrop="drop(event)" ondragover="allowDrop(event)" class="p-0 custom-scrollbar-css"><div class="card-header bg-secondary text-white">Pdte Docs</div>
<?php $api->getPasos_tablero_agencias('div2', $agencia, htmlspecialchars($_GET['func'])); ?>
</div>

<div id="div3" ondrop="drop(event)" ondragover="allowDrop(event)" class="p-0 custom-scrollbar-css"><div class="card-header bg-secondary text-white">En Evaluación <button type='button' class='btn btn-warning btn-xs' onclick="location.href='agencias2_info?agencia=<?php echo $agencia; ?>'">+ Info</button></div>
<?php $api->getPasos_tablero_agencias('div3', $agencia, htmlspecialchars($_GET['func'])); ?>
</div>

<div id="div4" ondrop="drop(event)" ondragover="allowDrop(event)" class="p-0 custom-scrollbar-css"><div class="card-header bg-secondary text-white">En Verificaciones <button type='button' class='btn btn-warning btn-xs' onclick="location.href='sube_file'">Up file</button></div>
<?php $api->getPasos_tablero_agencias('div4', $agencia, htmlspecialchars($_GET['func'])); ?>
</div>

<div id="div5" ondrop="drop(event)" ondragover="allowDrop(event)" class="p-0 custom-scrollbar-css"><div class="card-header bg-secondary text-white">Listo p/desemb</div>
<?php $api->getPasos_tablero_agencias('div5', $agencia, htmlspecialchars($_GET['func'])); ?>
</div>

<div id="div6" ondrop="drop(event)" ondragover="allowDrop(event)" class="p-0 custom-scrollbar-css"><div class="card-header bg-secondary text-white">Terminado</div>
<?php $api->getPasos_tablero_agencias('div6', $agencia, htmlspecialchars($_GET['func'])); ?>
</div>

<div id="div7" ondrop="drop(event)" ondragover="allowDrop(event)" class="p-0 custom-scrollbar-css"><div class="card-header bg-secondary text-white">No contesta</div>
<?php $api->getPasos_tablero_agencias('div7', $agencia, htmlspecialchars($_GET['func'])); ?>
</div>

<div id="div8" ondrop="drop(event)" ondragover="allowDrop(event)" class="p-0 custom-scrollbar-css"><div class="card-header bg-secondary text-white">Rechazado</div>
<?php $api->getPasos_tablero_agencias('div8', $agencia, htmlspecialchars($_GET['func'])); ?>
</div>
<h3 class="text-white"><?php echo $agencia; ?> - <?php echo $_SESSION["funcionario"]; ?> <a class="btn btn-danger" href="desconectar?pag=<?php echo $pagina_web; ?>" role="button">Desconectar</a></h3>
</div>

<div>

</div>

<?php $api->getModals_agencias2($agencia); ?>


<div class='modal fade' id='Agrega' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title' id='exampleModalLongTitle'>Ingresar Datos</h5>
            </div>
        <div class='modal-body'>
                    <input type='number' class='form-control' id='dni' autocomplete='off' placeholder='Dni' size='30' minlength='8' maxlength='8' required pattern='[0-9]+' aria-describedby='inputGroup-sizing-sm'><br>
					<input type='number' class='form-control' id='codigo' autocomplete='off' placeholder='Codigo' size='30' minlength='7' maxlength='7' required pattern='[0-9]+' aria-describedby='inputGroup-sizing-sm'><br>
					<input type='text' class='form-control' id='nombres' autocomplete='off' placeholder='Nombres' size='30'><br>
                    <input type='number' class='form-control' id='celular' autocomplete='off' placeholder='Celular' size='30' minlength='9' maxlength='9' required pattern='[0-9]+'><br>
                    <input type='email' class='form-control' id='correo' autocomplete='off' placeholder='Correo' size='30' minlength='8' maxlength='80' required pattern='[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$'><br>
                    <textarea class='form-control' id='observaciones'></textarea><br>
                    Tarea <select class='form-select-lg' aria-label='.form-select-sm example' id='tarea'>
                        <option value='consulta'>Escoge una</option>
						<option value='consulta'>Consulta</option>
                        <option value='captacion'>Captacion</option>
						<option value='prestamo'>Prestamo</option>
						<option value='inscripcion'>Inscripcion</option>
						<option value='tarjeta'>Tarjeta debito</option>
						<option value='operacion'>Operacion</option>
                        <option value='otros'>Otros</option>
                    </select>
					Canal <select class='form-select-lg' aria-label='.form-select-sm example' id='canal'>
                        <option value='Presencial'>Escoge una</option>
						<option value='Correo'>Correo</option>
                        <option value='Presencial'>Presencial</option>
                        <option value='Telefono'>Telefono</option>
                    </select>
					
            </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                <button type='button' class='btn btn-primary' data-dismiss='modal' onclick='agrega()'>Guardar</button>
            </div>
        </div>
    </div>
</div>

<input type="hidden" id="funcionario" value="<?php echo $_SESSION["funcionario"]; ?>">

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
  <title><?php echo $agencia; ?></title>
  <link integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script integrity="sha384-xBuQ/xzmlsLoJpyjoggmTEz8OWUFM0/RC5BsqQBDX2v5cMvDHcMakNTNrHIW2I5f" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
function valida()
{
	email = document.getElementById("email").value;
	password = document.getElementById("password").value;
	
	if(email=="")
	{
			alert("Por favor ingresar un correo válido");
			return false;
	}
	
	if(password=="")
	{
			alert("Por favor ingresar un password válido");
			return false;
	}
	
	document.cuerpo.submit();
	
}
</script>

</head>
<body>
<div class='container'>
        <div class='row'>
		<h2><?php echo $agencia;?></h2>
<br>
<form action="login_universal_cp?ori=<?php echo $pagina_web;?>" method="post" name="cuerpo" autocomplete="off">
  <div class="container-fluid">
    <input type="email" name="email" id="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ingrese email">
  </div>
  <br>
  <div class="container-fluid">
    <input type="password" name="password" id="password" class="form-control" id="exampleInputPassword1" placeholder="Ingrese Contraseña">
  </div>
  <br>
  <div class="container-fluid text-center">
    <button type="button" class="btn btn-primary" onclick="valida();">Ingresar</button>	
  </div>
  
</form>
<?php echo htmlspecialchars(htmlspecialchars($_GET['msg'])); ?>

	</div>
</div>
</body>
</html>
<?php

}
?>

