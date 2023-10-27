<?php
session_start();

    
    if (isset($_SESSION["login"]))
    {
        
    include_once 'apipersonas.php';

    $api = new ApiPersonas();
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Messenger</title>
  <meta name="description" content="Experian">
  <meta name="author" content="SSDD">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script>
function setear(id, dni){
	document.getElementById('id').value = id;
	document.getElementById('dni').value = dni;
	document.getElementById("doi").innerHTML = "<b>" + dni + "</b>?";
	
}

function eliminar(){
	
	if(document.getElementById('clave').value=="digital")
	{
	id = document.getElementById('id').value;
	var xmlhttp1 = new XMLHttpRequest();
    xmlhttp1.open("GET", "delete?tabla=WhatsApp&id="+id);
    xmlhttp1.send(); 
    setInterval("location.reload()",1000);
	}
	else
	{
		alert("Clave Equivocada, no se borro el registro");
		return false;
	}
}
</script>
</head>
<body>
<input type='hidden' id='id' name='id'>
<input type='hidden' id='dni' name='dni'>
 <table class="table table-responsive table-striped">
    <thead>
        <tr>
            <th class="text-right">
			<input type="password" name="clave" id="clave" value="" placeholder="Ingresa clave">
			<a class="btn btn-primary" href="csv_wsp.php" role="button">Descargar</a> <a class="btn btn-danger" href="desconectar.php?pag=messenger" role="button">Desconectar</a></th> 
        </td>
    </thead>
 </table>
 <table class="table table-responsive table-striped">
    <thead>
        <tr>
            <th>Fecha / Hora</th>
            <th>Tema</th>
            <th>Canal - Celular</th>
			<th>Alias</th>
        </tr>
    </thead>
    <tbody>
    <?php
    $api->getAll_wsp();
    ?>
    
    
    </tbody>
</table>

<div class='modal fade' id='EliminarTarjeta' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title' id='exampleModalLongTitle'>Eliminar Tarjeta</h5>
            </div>
        <div class='modal-body'>
                ¿Estas seguro que deseas eliminar a <div id='doi'></div>
        </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-danger' data-dismiss='modal' onclick='eliminar()'>Eliminar</button>
				<button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>
            </div>
        </div>
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
  <title>Experian</title>
  <meta name="description" content="Experian">
  <meta name="author" content="SSDD">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-PRSLE2J6GY"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-PRSLE2J6GY');
</script>
</head>
<body>
<br>
<form action="login_universal?ori=messenger" method="post" name="cuerpo" autocomplete="off">
  <div class="container-fluid">
    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ingrese email">
  </div>
  <br>
  <div class="container-fluid">
    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Ingrese Contraseña">
  </div>
  <br>
  <div class="container-fluid text-center">
    <button type="submit" class="btn btn-primary">Ingresar</button>
  </div>
  
</form>

</body>
</html>
<?php
//$_SESSION["login"] = "OK";

}
?>


