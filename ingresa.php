<?php
session_start();

    
    if (isset($_SESSION["correo"]))
    {
        

?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="css/bootstrap.css">
<meta charset="utf-8">
<title>Ingresa Prestamo</title>
  <meta name="description" content="Ingreso Prestamo">
  <meta name="author" content="SSDD">
<script>

function agrega(){
    
    dni = document.getElementById("dni").value;
    nombres = document.getElementById("nombres").value;
    monto = document.getElementById("monto").value;
    cuotas = document.getElementById("cuotas").value;
	moneda = document.getElementById("moneda").value;
	fec_desembolso = document.getElementById("fec_desembolso").value;
	observaciones = document.getElementById("observaciones").value;
	origen = document.getElementById("origen").value;
	tipo = document.getElementById("tipo").value;
	
	check = document.getElementById("urgente");
	
	if(check.checked == true)
		check1 = "1";
	else
		check1 = "0";
    
    var xmlhttp4 = new XMLHttpRequest();
    xmlhttp4.open("GET", "agrega_agencias?dni="+dni+"&nombres="+nombres+"&monto="+monto+"&cuotas="+cuotas+"&moneda="+moneda+"&fec_desembolso="+fec_desembolso+"&observaciones="+observaciones+"&origen="+origen+"&tipo="+tipo+"&urgente="+check1);
    xmlhttp4.send(); 
    //setInterval("location.reload()",1000);
	document.getElementById("demo").innerHTML = "<a href='sube_file?dniT="+dni+"'>Subir File</a>";
	document.getElementById("mensaje").innerHTML = "Registro ingresado";
	
	document.getElementById("dni").value = "";
	document.getElementById("nombres").value = "";
	document.getElementById("monto").value = "";
	document.getElementById("cuotas").value = "";
	document.getElementById("fec_desembolso").value = "";
	document.getElementById("observaciones").value = "";
	document.getElementById("tipo").value = "";
	
}

</script>

</head>

<body>

<div class="container">
    <div class="row">
	 
	<table class="table table-sm ">
              <thead>
				<tr>
					<td><h5><?php echo $_SESSION["correo"]; ?></h5></td>
					<td align="right"><button type="button" class="btn btn-danger" onclick="location.href='desconectar?pag=ingresa'">Desconectar</button></td>
				</tr>
				<tr>
					<td><h3>Ingresa Datos</h3></td>
					<td>Urgente <input type="checkbox" id="urgente" name="urgente"></td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td colspan="2">
						<input type='text' class='form-control' id='dni' autocomplete='off' placeholder='Dni' size='30' minlength='8' maxlength='8' required pattern='[0-9]+' aria-describedby='inputGroup-sizing-sm'>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<input type='text' class='form-control' id='nombres' autocomplete='off' placeholder='Apellidos y Nombres' size='80' minlength='15' maxlength='300' required aria-describedby='inputGroup-sizing-sm'>
					</td>
				</tr>

				<tr>
					<td colspan="2">
						<input type='text' class='form-control' id='monto' autocomplete='off' placeholder='Monto' size='30' minlength='4' maxlength='6' required pattern='[0-9]+' aria-describedby='inputGroup-sizing-sm'>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<input type='text' class='form-control' id='cuotas' autocomplete='off' placeholder='Numero de cuotas o plazo' size='30' minlength='1' maxlength='2' required pattern='[0-9]+' aria-describedby='inputGroup-sizing-sm'>
					</td>
				</tr>
				<tr>
					<td>
						<select class='form-select-lg' aria-label='Default select example' id='moneda'>
						<option value='1'>Soles</option>
						<option value='2'>Dolares</option>
					</select>
					</td>
					<td>
						<select class='form-select-lg' aria-label='Default select example' id='tipo'>
							<option value='prestamo'>Prestamo</option>
							<option value='captacion'>Captacion</option>
							<option value='otros'>Otros</option>
						</select>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						Fecha de Desembolso <input type="date" aria-label='Default select example' id="fec_desembolso" name="fec_desembolso">
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<textarea class='form-control' id='observaciones' placeholder='Comentarios'></textarea>
					</td>
				</tr>				
				<tr>
					<td colspan="2"><button type='button' class='btn btn-primary' data-dismiss='modal' onclick='agrega()'>Guardar</button></td>
				</tr>
				<tr>
					<td colspan="2"><div id="demo"></div></td>
				</tr>
			
				<tr>
					<td colspan="2"><div id="mensaje"></div></td>
				</tr>
			</tbody>
		</table>
  <input type="hidden" name="origen" id="origen" value="<?php echo $_SESSION["correo"] ?>"> 

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
  <title>Ingresa Prestamo</title>
  <meta name="description" content="Ingreso Prestamo">
  <meta name="author" content="SSDD">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="css/bootstrap.css">
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
<br>
<form action="login_agencias" method="post" name="cuerpo">

 <div class="container">
    <div class="row">
  <table class="table table-sm ">
	<tr>
		<td>
		<input autocomplete="on" type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Ingrese email">	
		</td>
	</tr>
	<tr>
		<td><input type="text" name="password" class="form-control" id="password" placeholder="Confirma email">		
		</td>
	</tr>
	<tr>
		<td><button type="button" class="btn btn-primary" onclick="valida();">Ingresar</button>		
		</td>
	</tr>
  
  </table>
    

    

    
  
</form>

</body>
</html>
<?php

}
?>