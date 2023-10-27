<?php
include_once 'persona.php';
$api = new Persona();

// subir archivo
$directorio = 'archivos/';
$subir_archivo = $directorio.basename($_FILES['subir_archivo']['name']);
$mensaje ="";


$pos = strpos($subir_archivo, "/");
$nom_arch = substr($subir_archivo, $pos+1);
$dni = $_POST['dni'];

if($subir_archivo!="archivos/")
{
    if (move_uploaded_file($_FILES['subir_archivo']['tmp_name'], $subir_archivo)) {
        
            $mensaje = "<p>Archivo subido [" . $nom_arch . "] [" . $dni . "] </p><button type='button' class='btn btn-warning' btn-xs' onclick='ir()'>Volver</button>";
			    $api ->nuevoDocumento($dni, $nom_arch);
    		
    }else{
        $mensaje = "Error";
    }
}

$dniT = htmlspecialchars($_GET['dniT']);

// eliminar base
// cantidad de registros cargados
// test automatico primero y ultimo registro
?>

<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="css/bootstrap.css">
<meta charset="utf-8">
<title>Sube el file del prestamos</title>

<script>
function valida(){
	
	//alert("Completa correctamente el DNI");
	//alert(document.getElementById("dni").value.length);
	var resultado = true;
	
	
	if(document.getElementById("dni").value==""){
		alert("Completa correctamente el DNI");
		resultado = false;
	}
	if((document.getElementById("dni").value.length!=8) && resultado){
		alert("DNI debe de tener 8 digitos");
		resultado = false;
	}
	
	if(resultado){
		document.getElementById("envia").disabled=true;
		document.getElementById("cuerpo").submit();
	}
	
}

function ir(){
	location.href ="http://cooperativapacifico.online/ingresa";
}



</script>

</head>

<body>
<form enctype="multipart/form-data" action="sube_file" method="POST" name="cuerpo" id="cuerpo">
    <input type="hidden" name="MAX_FILE_SIZE" value="51200000" />
<div class="container">
    <div class="row">
	
	<table class="table table-sm ">
              <thead>
				<tr>
					<td colspan="2"><h3>Enviar un Archivo (todos los documentos deben estar comprimidos en zip/rar)</h3></td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Ingresa DNI</td>
					<td><input type="text" id="dni" name="dni" autocomplete="off" placeholder="Ingresa aquí el DNI" value="<?php echo $dniT; ?>"></td>
				</tr>
				<tr>
					<td>Sube file</td>
					<td><input name="subir_archivo" type="file" /></td>
				</tr>
				<tr>
					<td colspan="2"><input type="button" onclick="valida()" value="Enviar Archivo" id="envia" /></td>
				</tr>
			</tbody>
		</table>


	

   
</form>
<?php echo $mensaje; ?>
</div>
</div>
</body>
</html>	