<?php
session_start();
include_once 'apinuevo_socio.php';
include_once 'test.php';
$api = new ApiSocios();

$dni = htmlspecialchars($_GET['dni']);

	if(strlen($dni)==8)
		$tipo = "D";
	if(strlen($dni)==11)
		$tipo = "R";
	if(strlen($dni)==9)
		$tipo = "4";
	
$api->consulta_socio(trim($dni));
$existe_socio = $_SESSION["existe_socio"];
$estado = 1;

if($existe_socio=="false"){
	$new = new CurlRequest();
    $resultado = $new ->sendPost_sentinel($tipo, $dni);
    $obj = json_decode($resultado);
    
    $Nom = $obj->soafulloutput->InfBas->Nom;
    $ApePat = $obj->soafulloutput->InfBas->ApePat;
    $ApeMat = $obj->soafulloutput->InfBas->ApeMat;
    $Sex = $obj->soafulloutput->InfBas->Sex;
	
	if($Nom!="" and $ApePat!="" and $ApeMat!=""){

			$item = array(
            	'doi' => $dni,
				'nombres' => $Nom,
				'apepat' => $ApePat,
				'apemat' => $ApeMat,
			);
            $api->nuevo_socio($item);
	}

	//$nombre_largo = $obj->soafulloutput->InfBas->RazSoc;
	
}

if($estado==1){

?>

<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Nuevo Socio</title>
  <meta name="description" content="Nuevo Socio">
  <meta name="author" content="SSDD">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap.css">
<script integrity="sha384-xBuQ/xzmlsLoJpyjoggmTEz8OWUFM0/RC5BsqQBDX2v5cMvDHcMakNTNrHIW2I5f" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<h1>Inscripcion paso (1/5)</h1>
<?php echo $existe_socio; ?>
</body>

</html>

<?php 
}

if($estado==2){

?>

<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Nuevo Socio</title>
  <meta name="description" content="Nuevo Socio">
  <meta name="author" content="SSDD">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap.css">
<script integrity="sha384-xBuQ/xzmlsLoJpyjoggmTEz8OWUFM0/RC5BsqQBDX2v5cMvDHcMakNTNrHIW2I5f" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<h1>Inscripcion paso (2/5)</h1>
</body>

</html>

<?php 
}

if($estado==3){

?>

<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Nuevo Socio</title>
  <meta name="description" content="Nuevo Socio">
  <meta name="author" content="SSDD">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap.css">
<script integrity="sha384-xBuQ/xzmlsLoJpyjoggmTEz8OWUFM0/RC5BsqQBDX2v5cMvDHcMakNTNrHIW2I5f" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<h1>Inscripcion paso (3/5)</h1>
</body>

</html>

<?php 
}

if($estado==4){

?>

<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Nuevo Socio</title>
  <meta name="description" content="Nuevo Socio">
  <meta name="author" content="SSDD">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap.css">
<script integrity="sha384-xBuQ/xzmlsLoJpyjoggmTEz8OWUFM0/RC5BsqQBDX2v5cMvDHcMakNTNrHIW2I5f" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<h1>Inscripcion paso (4/5)</h1>
</body>

</html>

<?php 
}

if($estado==5){

?>

<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Nuevo Socio</title>
  <meta name="description" content="Nuevo Socio">
  <meta name="author" content="SSDD">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap.css">
<script integrity="sha384-xBuQ/xzmlsLoJpyjoggmTEz8OWUFM0/RC5BsqQBDX2v5cMvDHcMakNTNrHIW2I5f" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<h1>Inscripcion paso (5/5)</h1>
</body>

</html>

<?php 
}

?>