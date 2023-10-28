<?php

include_once 'test.php';
include_once 'apipersonas.php';

$new = new CurlRequest();
$api = new ApiPersonas();

$mensaje = "";
$celular = htmlspecialchars($_POST['celular']);
$mensaje = htmlspecialchars($_POST['mensaje']);

if(strlen($celular)==9)
	$celular = "51" . $celular;

if($mensaje!="")
{
    $resultado = $new ->sendPost_sms_masivian($celular, $mensaje);
    header("Location: sms?resultado=Mensaje%20Enviado");
}

$resultado = htmlspecialchars($_GET["resultado"]);

?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Envio de SMS</title>
  <meta name="description" content="Envio de SMS">
  <meta name="author" content="SSDD">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script integrity="sha384-xBuQ/xzmlsLoJpyjoggmTEz8OWUFM0/RC5BsqQBDX2v5cMvDHcMakNTNrHIW2I5f" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <form action="sms" method="post" name="cuerpo" autocomplete="off">
            <br>
  <div class="mb-3">
    <label for="celular" class="form-label">Celular</label>
    <input type="text" class="form-control" id="celular" name="celular" aria-describedby="emailHelp">
    <div id="emailHelp" class="form-text">Ingresa el celular Ej. 51997855645</div>
  </div>
  <br>
  <div class="mb-3">
    <label for="mensaje" class="form-label">Mensaje</label>
    <select class="form-select" aria-label="Default select example" name="template" id="template" onchange="myFunction()">
        <option selected>Seleccionar una plantilla</option>
        <?php
            $api->listaPlantillas();
        ?>
    </select>
    <textarea class="form-control" aria-label="With textarea" id="mensaje" name="mensaje"></textarea>
  </div>
  <br>
  <div class="mt-3">
      
  <button type="submit" class="btn btn-primary">Enviar</button>
  </div>
  <br>
  <div class="mt-3">
  
  <?php
    echo $resultado;
    ?>
</div>   
  
</form>       
    </div>
    
<script>
    
    function myFunction()
    {
        document.getElementById("mensaje").innerHTML=document.getElementById('template').options[document.getElementById('template').selectedIndex].value;
    }
</script>

</body>
</html>
