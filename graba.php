<?php
include_once 'apipersonas.php';

	$api = new ApiPersonas();
	$dni = $_POST["dni"];
	
	
	if($dni!="")
	{
 
	$nombres = $_POST["nombres"];
	$codigo = $_POST["codigo"];
	$observaciones = $_POST["observaciones"];
	$agencia = "Aelu";
	$correo = $_POST["correo"];
	$celular = $_POST["celular"];
	$funcionario = "lizbet.cardenas@cp.com.pe";
	$canal = $_POST["canal"];
	$tarea = $_POST["tarea"];

	$item = array(
					'dni' => $dni,
					'nombres' => $nombres,
					'codigo' => $codigo,
					'agencia' => $agencia,
					'correo' => $correo,
					'celular' => $celular,
					'observaciones' => $observaciones,
					'funcionario' => $funcionario,
					'canal' => $canal,
					'tarea' => $tarea,
				);
				$api->add_Agencias2($item);

				//exit();	

	header("Location: graba?msg=Conforme");
	

	}
?>

<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Traduce</title>
  <meta name="description" content="Traduce">
  <meta name="author" content="SSDD">
  <link rel="stylesheet" href="css/bootstrap.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>
<?php echo htmlspecialchars($_GET['msg']); ?>
<br>
<form name="cuerpo" method="post" action="graba">
<input type='number' class='form-control' name='dni' id='dni' autocomplete='off' placeholder='Dni' size='30' minlength='8' maxlength='8' required pattern='[0-9]+' aria-describedby='inputGroup-sizing-sm'><br>
<input type='number' class='form-control' name='codigo' id='codigo' autocomplete='off' placeholder='Codigo' size='30' minlength='7' maxlength='7' required pattern='[0-9]+' aria-describedby='inputGroup-sizing-sm'><br>	

<input type='text' class='form-control' name='nombres' id='nombres' autocomplete='off' placeholder='Nombres' size='30'><br>
                    <input type='number' class='form-control' name='celular' id='celular' autocomplete='off' placeholder='Celular' size='30' minlength='9' maxlength='9' required pattern='[0-9]+'><br>
                    <input type='email' class='form-control' name='correo' id='correo' autocomplete='off' placeholder='Correo' size='30' minlength='8' maxlength='80' required pattern='[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$'><br>
                    <textarea class='form-control' id='observaciones' name='observaciones'></textarea><br>
                    Tarea <select class='form-select-lg' aria-label='.form-select-sm example' id='tarea' name='tarea'>
                        <option value='consulta'>Escoge una</option>
						<option value='consulta'>Consulta</option>
                        <option value='captacion'>Captacion</option>
						<option value='prestamo'>Prestamo</option>
						<option value='inscripcion'>Inscripcion</option>
						<option value='tarjeta'>Tarjeta debito</option>
						<option value='operacion'>Operacion</option>
                        <option value='otros'>Otros</option>
                    </select>
					Canal <select class='form-select-lg' aria-label='.form-select-sm example' id='canal' name='canal'>
                        <option value='Presencial'>Escoge una</option>
						<option value='Correo'>Correo</option>
                        <option value='Presencial'>Presencial</option>
                        <option value='Telefono'>Telefono</option>
                    </select>				
					
	<input type="submit" value="Enviar">
</form>
</body>
</html>
