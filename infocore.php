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
  <title>Infocore</title>
  <meta name="description" content="Infocore">
  <meta name="author" content="SSDD">
  <link integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script integrity="sha384-xBuQ/xzmlsLoJpyjoggmTEz8OWUFM0/RC5BsqQBDX2v5cMvDHcMakNTNrHIW2I5f" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>
 <table class="table table-responsive table-striped">
    <thead>
        <tr>
            <th><a class="btn btn-primary" href="csv_infocore.php" role="button">Descargar</a> <button type='button' class='btn btn-warning' data-toggle='modal' data-target='#Infocore'>Funnel</button> <button type='button' class='btn btn-warning' data-toggle='modal' data-target='#Desembolsos'>Desembolsos</button> <!--button type='button' class='btn btn-warning' data-toggle='modal' data-target='#MPasado'>Mes Pasado</button//--></th> 
            <th class="text-right"><a class="btn btn-danger" href="desconectar.php?pag=infocore" role="button">Desconectar</a></th> 
        </td>
    </thead>
 </table>
 <table class="table table-responsive table-striped">
    <thead>
        <tr>
            <th> Fecha / Hora</th>
            <th>DNI / Nombres</th>
			<th>Estado / Observaciones</th>
        </tr>
    </thead>
    <tbody>
    <?php
    $api->getAll4_infocore();
    ?>
    
    
    </tbody>
</table>


<div class='modal fade' id='Desembolsos' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title' id='exampleModalLongTitle'>
					<b>Total Desembolsados Mes Actual</b>
					</h5>
            </div>
        <div class='modal-body'>
				
							<?php $api->getListadoDesemb_infocore('actual'); ?>
							<hr>				
				Total S/ <?php $api->getImpDesemb_infocore('actual'); ?> (<?php $api->getTotDesemb_infocore('actual'); ?>)				
            </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                
            </div>
        </div>
    </div>
</div>

<!--div class='modal fade' id='MPasado' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title' id='exampleModalLongTitle'>
					<b>Total Desembolsados Mes Pasado</b>
					</h5>
            </div>
        <div class='modal-body'>
				
							<?php $api->getListadoDesemb_infocore('pasado'); ?>
							<hr>				
				Total S/ <?php $api->getImpDesemb_infocore('pasado'); ?> (<?php $api->getTotDesemb_infocore('pasado'); ?>)				
            </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                
            </div>
        </div>
    </div>
</div//-->

<div class='modal fade' id='Infocore' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title' id='exampleModalLongTitle'><b>Funel - Mes Actual</b></h5>
            </div>
        <div class='modal-body'>
				<b><u>Por contactar S/ <?php $api->funnel_agencias_infocore('div1'); ?></u></b> <br>
				<b><u>Pdte Documentos S/ <?php $api->funnel_agencias_infocore('div2'); ?></u></b><br>
				<?php $api->funnel_agencias_infocore_lista_api('div2'); ?><br>
				<b><u>En Evaluacion S/ <?php $api->funnel_agencias_infocore('div3'); ?></u></b><br>
				<?php $api->funnel_agencias_infocore_lista_api('div3'); ?><br>
				<b><u>En verificaciones S/ <?php $api->funnel_agencias_infocore('div4'); ?></u></b><br>
				<?php $api->funnel_agencias_infocore_lista_api('div4'); ?><br>
				<b><u>Listo p/desemb S/ <?php $api->funnel_agencias_infocore('div5'); ?></u></b><br>
				<?php $api->funnel_agencias_infocore_lista_api('div5'); ?><br>


        </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
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
  <title>Infocore</title>
  <meta name="description" content="Infocore">
  <meta name="author" content="SSDD">
  <link integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script integrity="sha384-xBuQ/xzmlsLoJpyjoggmTEz8OWUFM0/RC5BsqQBDX2v5cMvDHcMakNTNrHIW2I5f" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<br>
<form action="login_infocore" method="post" name="cuerpo" autocomplete="off">
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


