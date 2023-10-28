
<!DOCTYPE HTML>
<html>
<head>
  <title>PDP - Evaluación en línea</title>
  <meta name="description" content="PDP - Evaluación en línea">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <script integrity="sha384-xBuQ/xzmlsLoJpyjoggmTEz8OWUFM0/RC5BsqQBDX2v5cMvDHcMakNTNrHIW2I5f" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

  <script>

function primera(){
	
		dni = document.getElementById("dni").value;
    
		var xhttp8 = new XMLHttpRequest();
		xhttp8.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("juego").innerHTML =
			this.responseText;
			}
		};
		
		xhttp8.open("GET", "ajax_infoweb?func=1&dni="+dni, true);
		xhttp8.send();
		
		document.getElementById("btn_enviar").style.display = "none";
		
		
}

function segunda(){
    
		//document.getElementById("juego").innerHTML = "";
		
		token = document.getElementById("token").value;
		doi = document.getElementById("doi").value;
		scoring = document.getElementById("score").value;
		
		document.getElementById("juego").innerHTML = "<h3>Pensando ...  no cierres la ventana</h3><br><center><img src='images/reloj.gif'></center>";
		
		var xhttp9 = new XMLHttpRequest();
		xhttp9.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("juego").innerHTML =
			this.responseText;
			}
		};
		
		xhttp9.open("GET", "ajax_infoweb?func=2&token="+token+"&dni="+doi+"&scoring="+scoring, true);
		xhttp9.send();
		
		
}

function tercera(){
    
		dni = document.getElementById("dni").value;
		
		if(dni=="" || dni.length!=8)
		{
				alert("Ingresar un DNI válido");
				return false;
		}
		
		document.getElementById("juego").innerHTML = "<h3>Pensando ... </h3>";
		
		var xhttp7 = new XMLHttpRequest();
		xhttp7.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("juego").innerHTML =
			this.responseText;
			}
		};
		
		xhttp7.open("GET", "ajax_infoweb?func=3&dni="+dni, true);
		xhttp7.send();
		
		document.getElementById("btn_enviar").style.display = "none";
		
		
		
}

function no_segunda(){
	top.location.href="pdp"
	
}

</script>
</head>
<body onload="inicio();">

	
	<div id='juego' class="container-fluid text-center"></div>


<div id="btn_enviar">
	<table class="table table-responsive table-striped text-center">
    <thead>
		<tr>
            <th class='text-center' colspan='2'><h3>Evaluación en linea</h3></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td><input type="number" id="dni" name="dni" value="" placeholder='Ingresa DNI'></td>
			<td><button type='button' class='btn btn-success' data-dismiss='modal' onclick='tercera();'>Enviar</button></td>
	</tbody>
	</table>
</div>
</body>
</html>
