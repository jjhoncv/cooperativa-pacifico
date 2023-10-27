<?php
include_once 'apipersonas.php';
$api = new ApiPersonas();

$tabla = htmlspecialchars($_GET['tabla']);
$id = htmlspecialchars($_GET['id']);

$api->borra_registro($tabla, $id);

?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Borrar registro</title>
  <meta name="description" content="Borrar registro">
  <meta name="author" content="SSDD">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
		<center><h3>Registro eliminado</h3></center>
	</div>
</body>
</html>