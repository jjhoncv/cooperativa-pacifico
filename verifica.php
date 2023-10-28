<?php

	$dni = htmlspecialchars($_GET["dni"]);

	$headers =  array(
	 'Content-Type:application/json',
	 'Content-Length: 0'
	);
	

	$curl = curl_init();

	curl_setopt_array($curl, array(
	  CURLOPT_URL => 'https://servicios.infocore.com.pe/verifica/GetJWTValueBegin?dni=' . $dni . '&pJWTValue=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJpbmZvY29yZS5jb20ucGUiLCJpZEVtcHJlc2EiOjEsImlkQ2FtcGFuaWEiOjF9.DA2pnd7xSPZ1dm4xakT6x5hcq88IMRidhRM44AVccq4',
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => '',
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => 'POST',
	  CURLOPT_HTTPHEADER => $headers,
	));

	$response = curl_exec($curl);

	curl_close($curl);
	$obj1 = json_decode($response);
	$nombreCompleto = $obj1->lista->nombreCompleto;
	$token = $obj1->stringAlternativo;
	
	
	$pregunta0 = $obj1->lista->lstPreguntas[0]->descripcion;
	$id_pregunta0 = $obj1->lista->lstPreguntas[0]->idPregunta;
	$pregunta1 = $obj1->lista->lstPreguntas[1]->descripcion;
	$id_pregunta1 = $obj1->lista->lstPreguntas[1]->idPregunta;
	$pregunta2 = $obj1->lista->lstPreguntas[2]->descripcion;
	$id_pregunta2 = $obj1->lista->lstPreguntas[2]->idPregunta;
	$pregunta3 = $obj1->lista->lstPreguntas[3]->descripcion;
	$id_pregunta3 = $obj1->lista->lstPreguntas[3]->idPregunta;
	$pregunta4 = $obj1->lista->lstPreguntas[4]->descripcion;
	$id_pregunta4 = $obj1->lista->lstPreguntas[4]->idPregunta;
		
	$opciones0_1 = $obj1->lista->lstPreguntas[0]->lstOpciones[0]->descripcion;
	$opciones0_2 = $obj1->lista->lstPreguntas[0]->lstOpciones[1]->descripcion;
	$opciones0_3 = $obj1->lista->lstPreguntas[0]->lstOpciones[2]->descripcion;
	$opciones0_4 = $obj1->lista->lstPreguntas[0]->lstOpciones[3]->descripcion;
	$opciones0_5 = $obj1->lista->lstPreguntas[0]->lstOpciones[4]->descripcion;
	
	$opciones1_1 = $obj1->lista->lstPreguntas[1]->lstOpciones[0]->descripcion;
	$opciones1_2 = $obj1->lista->lstPreguntas[1]->lstOpciones[1]->descripcion;
	$opciones1_3 = $obj1->lista->lstPreguntas[1]->lstOpciones[2]->descripcion;
	$opciones1_4 = $obj1->lista->lstPreguntas[1]->lstOpciones[3]->descripcion;
	$opciones1_5 = $obj1->lista->lstPreguntas[1]->lstOpciones[4]->descripcion;
	
	$opciones2_1 = $obj1->lista->lstPreguntas[2]->lstOpciones[0]->descripcion;
	$opciones2_2 = $obj1->lista->lstPreguntas[2]->lstOpciones[1]->descripcion;
	$opciones2_3 = $obj1->lista->lstPreguntas[2]->lstOpciones[2]->descripcion;
	$opciones2_4 = $obj1->lista->lstPreguntas[2]->lstOpciones[3]->descripcion;
	$opciones2_5 = $obj1->lista->lstPreguntas[2]->lstOpciones[4]->descripcion;
	
	$opciones3_1 = $obj1->lista->lstPreguntas[3]->lstOpciones[0]->descripcion;
	$opciones3_2 = $obj1->lista->lstPreguntas[3]->lstOpciones[1]->descripcion;
	$opciones3_3 = $obj1->lista->lstPreguntas[3]->lstOpciones[2]->descripcion;
	$opciones3_4 = $obj1->lista->lstPreguntas[3]->lstOpciones[3]->descripcion;
	$opciones3_5 = $obj1->lista->lstPreguntas[3]->lstOpciones[4]->descripcion;
?>
<!DOCTYPE HTML>
<html>
<head>
  <title>Verifica</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="css/bootstrap.css">
  <script integrity="sha384-xBuQ/xzmlsLoJpyjoggmTEz8OWUFM0/RC5BsqQBDX2v5cMvDHcMakNTNrHIW2I5f" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
function envia()
{
	//alert(document.querySelector('input[name="pregunta1"]:checked').value);
	document.cuerpo.submit();
}
</script>
</head>
<body>
	<h1>[<?php echo $dni;?>]  <?php echo $nombreCompleto; ?> </h1><hr>
	<form name="cuerpo" action="verifica2" method="post">
	<?php 
		echo "<h5> - " . $pregunta0 . "</h5>";
		if($id_pregunta0==1)
		{
			echo "<input type='text' name='pregunta0' id='pregunta0' value=''>";
		}
		else
		{
			echo " <input type='radio' name='pregunta0' id='pregunta0' value='" . $opciones0_1 . "'> " . $opciones0_1 . "<br>";
			echo " <input type='radio' name='pregunta0' id='pregunta0' value='" . $opciones0_2 . "'> " . $opciones0_2 . "<br>";
			echo " <input type='radio' name='pregunta0' id='pregunta0' value='" . $opciones0_3 . "'> " . $opciones0_3 . "<br>";
			echo " <input type='radio' name='pregunta0' id='pregunta0' value='" . $opciones0_4 . "'> " . $opciones0_4 . "<br>";
			echo " <input type='radio' name='pregunta0' id='pregunta0' value='" . $opciones0_5 . "'> " . $opciones0_5 . "<br>";
		}
		
	?>
	
	
	<?php 
			if($pregunta1!="")
			{
			echo "<h5> - " . $pregunta1 . "</h5>";
		
			echo " <input type='radio' name='pregunta1' id='pregunta1' value='" . $opciones1_1 . "'> " . $opciones1_1 . "<br>";
			echo " <input type='radio' name='pregunta1' id='pregunta1' value='" . $opciones1_2 . "'> " . $opciones1_2 . "<br>";
			echo " <input type='radio' name='pregunta1' id='pregunta1' value='" . $opciones1_3 . "'> " . $opciones1_3 . "<br>";
			echo " <input type='radio' name='pregunta1' id='ipregunta1' value='" . $opciones1_4 . "'> " . $opciones1_4 . "<br>";
			echo " <input type='radio' name='pregunta1' id='pregunta1' value='" . $opciones1_5 . "'> " . $opciones1_5 . "<br>";
			}
	?>
	
		<?php 
			if($pregunta2!="")
			{
			echo "<h5> - " . $pregunta2 . "</h5>";
		
			echo " <input type='radio' name='pregunta2' id='pregunta2' value='" . $opciones2_1 . "'> " . $opciones2_1 . "<br>";
			echo " <input type='radio' name='pregunta2' id='pregunta2' value='" . $opciones2_2 . "'> " . $opciones2_2 . "<br>";
			echo " <input type='radio' name='pregunta2' id='pregunta2' value='" . $opciones2_3 . "'> " . $opciones2_3 . "<br>";
			echo " <input type='radio' name='pregunta2' id='pregunta2' value='" . $opciones2_4 . "'> " . $opciones2_4 . "<br>";
			echo " <input type='radio' name='pregunta2' id='pregunta2' value='" . $opciones2_5 . "'> " . $opciones2_5 . "<br>";
			}
		?>
	
		<?php 
			if($pregunta3!="")
			{
			echo "<h5> - " . $pregunta3 . "</h5>";
		
			echo " <input type='radio' name='pregunta3' id='pregunta3' value='" . $opciones3_1 . "'> " . $opciones3_1 . "<br>";
			echo " <input type='radio' name='pregunta3' id='pregunta3' value='" . $opciones3_2 . "'> " . $opciones3_2 . "<br>";
			echo " <input type='radio' name='pregunta3' id='pregunta3' value='" . $opciones3_3 . "'> " . $opciones3_3 . "<br>";
			echo " <input type='radio' name='pregunta3' id='pregunta3' value='" . $opciones3_4 . "'> " . $opciones3_4 . "<br>";
			echo " <input type='radio' name='pregunta3' id='pregunta3' value='" . $opciones3_5 . "'> " . $opciones3_5 . "<br>";
			}
	?>
	
		<?php 
			if($pregunta4!="")
			{
			echo "<h5> - " . $pregunta4 . "</h5>";
		
			echo " <input type='radio' name='pregunta4' id='pregunta4' value='" . $opciones4_1 . "'> " . $opciones4_1 . "<br>";
			echo " <input type='radio' name='pregunta4' id='pregunta4' value='" . $opciones4_2 . "'> " . $opciones4_2 . "<br>";
			echo " <input type='radio' name='pregunta4' id='pregunta4' value='" . $opciones4_3 . "'> " . $opciones4_3 . "<br>";
			echo " <input type='radio' name='pregunta4' id='pregunta4' value='" . $opciones4_4 . "'> " . $opciones4_4 . "<br>";
			echo " <input type='radio' name='pregunta4' id='pregunta4' value='" . $opciones4_5 . "'> " . $opciones4_5 . "<br>";
			}
	?>
	<input type="hidden" name="token" value="<?php echo $token;?>">
	<input type="button" onclick="envia()" value="Enviar">
	</form>
</body>
</html>	
	

