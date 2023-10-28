<?php
include_once 'apipersonas.php';
$api = new ApiPersonas();

$tabla = htmlspecialchars($_GET['tabla']);
$id = htmlspecialchars($_GET['id']);

$api->no_es_urgente_api($tabla, $id);
//$api->borra_registro($tabla, $id);

?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>No es urgente</title>
  <meta name="description" content="No es urgente">
  <meta name="author" content="SSDD">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script integrity="sha384-xBuQ/xzmlsLoJpyjoggmTEz8OWUFM0/RC5BsqQBDX2v5cMvDHcMakNTNrHIW2I5f" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
		<center><h3>Tarjeta modificada a NO es Urgente</h3></center>
	</div>
</body>
</html>