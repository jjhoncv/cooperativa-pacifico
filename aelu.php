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
  <title>AELU Cooperativa Pacifico</title>
  <meta name="description" content="AELU Cooperativa Pacifico">
  <meta name="author" content="SSDD">
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script integrity="sha384-xBuQ/xzmlsLoJpyjoggmTEz8OWUFM0/RC5BsqQBDX2v5cMvDHcMakNTNrHIW2I5f" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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
 <table class="table table-responsive table-striped">
    <thead>
        <tr>
            <th><a class="btn btn-primary" href="csv_aelu" role="button">Descargar</a></th> 
            <th class="text-right"><a class="btn btn-danger" href="desconectar.php?pag=aelu" role="button">Desconectar</a></th> 
        </td>
    </thead>
 </table>
 <table class="table table-responsive table-striped">
    <thead>
        <tr>
            <th>Fecha</th>
            <th>Doi</th>
            <th>Resultado</th>
            <th>Celular / Nick</th>
        </tr>
    </thead>
    <tbody>
    <?php
    $api->getAllAelu();
    ?>
    
    
    </tbody>
</table>
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
  <title>AELU Cooperativa Pacifico</title>
  <meta name="description" content="AELU Cooperativa Pacifico">
  <meta name="author" content="SSDD">
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script integrity="sha384-xBuQ/xzmlsLoJpyjoggmTEz8OWUFM0/RC5BsqQBDX2v5cMvDHcMakNTNrHIW2I5f" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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
<form action="login_aelu" method="post" name="cuerpo" autocomplete="off">
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


}
?>


