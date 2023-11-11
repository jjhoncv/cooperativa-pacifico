<?php
session_start();

if (isset($_SESSION["funcionario"]))
    {
		
		
   include_once 'apipersonas.php';
   $api = new ApiPersonas();
   
   
   $agencia = htmlspecialchars($_GET['agencia']);
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Estadisticas</title>
  <meta name="description" content="Listado de Leads">
  <meta name="author" content="SSDD">
  <link integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="css/bootstrap.css">
<script integrity="sha384-xBuQ/xzmlsLoJpyjoggmTEz8OWUFM0/RC5BsqQBDX2v5cMvDHcMakNTNrHIW2I5f" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<h1>Estadisticas</h1>

<button type='button' class='btn btn-warning' data-toggle='modal' data-target='#Tablero'>Tablero Agencias</button>
<button type='button' class='btn btn-warning' data-toggle='modal' data-target='#Pendientes'>work</button>

<table class="table table-responsive table-striped">
    <thead>
        <tr>
            <th>Doi / Fecha</th>
            <th>Canal / Tarea / Observaciones</th>
            <th>Funcionario</th>
            <th>Estado</th>
        </tr>
    </thead>
    <tbody>
    <?php
    
    $api->getAll_agencias2(trim(htmlspecialchars($_GET['keyword'])), $agencia);
    ?>
    
    
    </tbody>
</table>

<div class='modal fade' id='Pendientes' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title' id='exampleModalLongTitle'>Tarjetas trabajando por Funcionario</h5>
            </div>
        <div class='modal-body'>
		<table class='table table-responsive table-striped'>
		<thead>
			<tr>
				<th>Funcionario</th>
				<th>Carga</th>
			</tr>
		</thead>
		<tbody>
               <?php $api->work_agencias_funcionario_api($agencia); ?>
		</tbody>
		</table>
        </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
            </div>
        </div>
    </div>
</div>

<div class='modal fade' id='Tablero' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title' id='exampleModalLongTitle'>Tablero Agencias</h5>
            </div>
        <div class='modal-body'>
		<table class='table table-responsive table-striped'>
		<thead>
			<tr>
				<th>Agencia</th>
				<th>Captacion</th>
				<th>Colocacion</th>
			</tr>
		</thead>
		<tbody>
               <tr>
					<td>Apj</td>
					<td><?php $api->consulta_agencia2('Apj', 'captacion',0, 'soles'); ?> + <?php $api->consulta_agencia2('Apj', 'captacion',0, 'dolares'); ?></td>
					<td><?php $api->consulta_agencia2('Apj', 'prestamo', 0, 'soles'); ?> + <?php $api->consulta_agencia2('Apj', 'prestamo', 0, 'dolares'); ?></td>
			   </tr>
			   <tr>
					<td>Aelu</td>
					<td><?php $api->consulta_agencia2('Aelu', 'captacion',0, 'soles'); ?> + <?php $api->consulta_agencia2('Aelu', 'captacion',0, 'dolares'); ?></td>
					<td><?php $api->consulta_agencia2('Aelu', 'prestamo', 0, 'soles'); ?> + <?php $api->consulta_agencia2('Aelu', 'prestamo', 0, 'dolares'); ?></td>
			   </tr>
			   <tr>
					<td>Centenario</td>
					<td><?php $api->consulta_agencia2('Centenario', 'captacion',0, 'soles'); ?> + <?php $api->consulta_agencia2('Centenario', 'captacion',0, 'dolares'); ?></td>
					<td><?php $api->consulta_agencia2('Centenario', 'prestamo', 0, 'soles'); ?> + <?php $api->consulta_agencia2('Centenario', 'prestamo', 0, 'dolares'); ?></td>
			   </tr>
			   <tr>
					<td>Chacarilla</td>
					<td><?php $api->consulta_agencia2('Chacarilla', 'captacion',0, 'soles'); ?> + <?php $api->consulta_agencia2('Chacarilla', 'captacion',0, 'dolares'); ?></td>
					<td><?php $api->consulta_agencia2('Chacarilla', 'prestamo', 0, 'soles'); ?> + <?php $api->consulta_agencia2('Chacarilla', 'prestamo', 0, 'dolares'); ?></td>
			   </tr>
			   <tr>
					<td>Circolo</td>
					<td><?php $api->consulta_agencia2('Circolo', 'captacion',0, 'soles'); ?> + <?php $api->consulta_agencia2('Circolo', 'captacion',0, 'dolares'); ?></td>
					<td><?php $api->consulta_agencia2('Circolo', 'prestamo', 0, 'soles'); ?> + <?php $api->consulta_agencia2('Circolo', 'prestamo', 0, 'dolares'); ?></td>
			   </tr>
			   <tr>
					<td>Jockey</td>
					<td><?php $api->consulta_agencia2('Jockey', 'captacion',0, 'soles'); ?> + <?php $api->consulta_agencia2('Jockey', 'captacion',0, 'dolares'); ?></td>
					<td><?php $api->consulta_agencia2('Jockey', 'prestamo', 0, 'soles'); ?> + <?php $api->consulta_agencia2('Jockey', 'prestamo', 0, 'dolares'); ?></td>
			   </tr>
			   <tr>
					<td>Regatas</td>
					<td><?php $api->consulta_agencia2('Regatas', 'captacion',0, 'soles'); ?> + <?php $api->consulta_agencia2('Regatas', 'captacion',0, 'dolares'); ?></td>
					<td><?php $api->consulta_agencia2('Regatas', 'prestamo', 0, 'soles'); ?> + <?php $api->consulta_agencia2('Regatas', 'prestamo', 0, 'dolares'); ?></td>
			   </tr>
			   <tr>
					<td>San Isidro</td>
					<td><?php $api->consulta_agencia2('San Isidro', 'captacion',0, 'soles'); ?> + <?php $api->consulta_agencia2('San Isidro', 'captacion',0, 'dolares'); ?></td>
					<td><?php $api->consulta_agencia2('San Isidro', 'prestamo', 0, 'soles'); ?> + <?php $api->consulta_agencia2('San Isidro', 'prestamo', 0, 'dolares'); ?></td>
			   </tr>
			   <tr>
					<td>Surquillo</td>
					<td><?php $api->consulta_agencia2('Surquillo', 'captacion',0, 'soles'); ?> + <?php $api->consulta_agencia2('Surquillo', 'captacion',0, 'dolares'); ?></td>
					<td><?php $api->consulta_agencia2('Surquillo', 'prestamo', 0, 'soles'); ?> + <?php $api->consulta_agencia2('Surquillo', 'prestamo', 0, 'dolares'); ?></td>
			   </tr>
			   <tr>
					<td>Terrazas</td>
					<td><?php $api->consulta_agencia2('Terrazas', 'captacion',0, 'soles'); ?> + <?php $api->consulta_agencia2('Terrazas', 'captacion',0, 'dolares'); ?></td>
					<td><?php $api->consulta_agencia2('Terrazas', 'prestamo', 0, 'soles'); ?> + <?php $api->consulta_agencia2('Terrazas', 'prestamo', 0, 'dolares'); ?></td>
			   </tr>
			   <tr>
					<td>Total</td>
					<td><b><?php $api->consulta_agencia2('', 'captacion', 0, 'soles'); ?> + <?php $api->consulta_agencia2('', 'captacion', 0, 'dolares'); ?></b></td>
					<td><b><?php $api->consulta_agencia2('', 'prestamo', 0, 'soles'); ?> + <?php $api->consulta_agencia2('', 'prestamo', 0, 'dolares'); ?></b></td>
			   </tr>
		</tbody>
		</table>
        </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
            </div>
        </div>
    </div>
</div>

</body>
<html>

<?php
	}
?>