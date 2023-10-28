<?php

session_start();

    
if (isset($_SESSION["login"]))
{
	
   include_once 'apipersonas.php';
   $api = new ApiPersonas();
   setlocale(LC_ALL,"es_ES");
   
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Central Agencias</title>
  <meta name="description" content="Central Agencias">
  <meta name="author" content="SSDD">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script integrity="sha384-xBuQ/xzmlsLoJpyjoggmTEz8OWUFM0/RC5BsqQBDX2v5cMvDHcMakNTNrHIW2I5f" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-PRSLE2J6GY"></script>
<script>
function refrescar(){
    setInterval("location.reload()",1800000);
}
</script>
</head>
<body onload="refrescar();">
 <table class="table table-responsive table-striped">
    <thead>
        <tr>
            <th class="text-center text-white bg-primary"> &nbsp;</th>
            <th class="text-center text-white bg-primary" colspan="3">Captacion</th>
            <th class="text-center text-white bg-primary" colspan="3">Colocacion</th>
        </tr>
		<tr>
			<th class="text-white bg-primary">Agencias <button type='button' class='btn btn-warning btn-xs' data-toggle='modal' data-target='#Metas1'>Metas</button></th>
			<th class="text-center text-white bg-primary"><?php echo strtoupper(strftime("%b"));?></th>
			<th class="text-center text-white bg-primary"><?php echo strtoupper(strftime("%b", strtotime('last month')));?></th>
			<th class="text-center text-white bg-primary"><?php echo strtoupper(strftime("%b", strtotime('-2 month')));?> </th>
			<th class="text-center text-white bg-primary"><?php echo strtoupper(strftime("%b"));?></th>
			<th class="text-center text-white bg-primary"><?php echo strtoupper(strftime("%b", strtotime('last month')));?></th>
			<th class="text-center text-white bg-primary"><?php echo strtoupper(strftime("%b", strtotime('-2 month')));?> </th>
		</tr>
    </thead>
    <tbody>
		<tr>
			<td><b><a href="44145571">Apj</a></b> <button type='button' class='btn btn-dark btn-xs' data-toggle='modal' data-target='#Apj'>work</button></td>
			<td class="text-center bg-warning"><?php $api->consulta_agencia2('Apj', 'captacion',0, 'soles'); ?> + <?php $api->consulta_agencia2('Apj', 'captacion',0, 'dolares'); ?></td>
			<td class="text-center"><?php $api->consulta_agencia2('Apj', 'captacion', -1, 'soles'); ?> + <?php $api->consulta_agencia2('Apj', 'captacion', -1, 'dolares'); ?></td>
			<td class="text-center"><?php $api->consulta_agencia2('Apj', 'captacion', -2, 'soles'); ?> + <?php $api->consulta_agencia2('Apj', 'captacion', -2, 'dolares'); ?></td>
			<td class="text-center bg-warning"><?php $api->consulta_agencia2('Apj', 'prestamo', 0, 'soles'); ?> + <?php $api->consulta_agencia2('Apj', 'prestamo', 0, 'dolares'); ?></td>
			<td class="text-center"><?php $api->consulta_agencia2('Apj', 'prestamo', -1, 'soles'); ?> + <?php $api->consulta_agencia2('Apj', 'prestamo', -1, 'dolares'); ?></td>
			<td class="text-center"><?php $api->consulta_agencia2('Apj', 'prestamo', -2, 'soles'); ?> + <?php $api->consulta_agencia2('Apj', 'prestamo', -2, 'dolares'); ?></td>
		</tr>
		<tr>
			<td><b><a href="71686955">Aelu</a><b> <button type='button' class='btn btn-dark btn-xs' data-toggle='modal' data-target='#Aelu'>work</button></td>
			<td class="text-center bg-warning"><?php $api->consulta_agencia2('Aelu', 'captacion',0, 'soles'); ?> + <?php $api->consulta_agencia2('Aelu', 'captacion',0, 'dolares'); ?></td>
			<td class="text-center"><?php $api->consulta_agencia2('Aelu', 'captacion', -1, 'soles'); ?> + <?php $api->consulta_agencia2('Aelu', 'captacion', -1, 'dolares'); ?></td>
			<td class="text-center"><?php $api->consulta_agencia2('Aelu', 'captacion', -2, 'soles'); ?> + <?php $api->consulta_agencia2('Aelu', 'captacion', -2, 'dolares'); ?></td>
			<td class="text-center bg-warning"><?php $api->consulta_agencia2('Aelu', 'prestamo', 0, 'soles'); ?> + <?php $api->consulta_agencia2('Aelu', 'prestamo', 0, 'dolares'); ?></td>
			<td class="text-center"><?php $api->consulta_agencia2('Aelu', 'prestamo', -1, 'soles'); ?> + <?php $api->consulta_agencia2('Aelu', 'prestamo', -1, 'dolares'); ?></td>
			<td class="text-center"><?php $api->consulta_agencia2('Aelu', 'prestamo', -2, 'soles'); ?> + <?php $api->consulta_agencia2('Aelu', 'prestamo', -2, 'dolares'); ?></td>
		</tr>
		<tr>
			<td><b><a href="49421069">Centenario</a></b> <button type='button' class='btn btn-dark btn-xs' data-toggle='modal' data-target='#Centenario'>work</button></td>
			<td class="text-center bg-warning"><?php $api->consulta_agencia2('Centenario', 'captacion',0, 'soles'); ?> + <?php $api->consulta_agencia2('Centenario', 'captacion',0, 'dolares'); ?></td>
			<td class="text-center"><?php $api->consulta_agencia2('Centenario', 'captacion', -1, 'soles'); ?> + <?php $api->consulta_agencia2('Centenario', 'captacion', -1, 'dolares'); ?></td>
			<td class="text-center"><?php $api->consulta_agencia2('Centenario', 'captacion', -2, 'soles'); ?> + <?php $api->consulta_agencia2('Centenario', 'captacion', -2, 'dolares'); ?></td>
			<td class="text-center bg-warning"><?php $api->consulta_agencia2('Centenario', 'prestamo', 0, 'soles'); ?> + <?php $api->consulta_agencia2('Centenario', 'prestamo', 0, 'dolares'); ?></td>
			<td class="text-center"><?php $api->consulta_agencia2('Centenario', 'prestamo', -1, 'soles'); ?> + <?php $api->consulta_agencia2('Centenario', 'prestamo', -1, 'dolares'); ?></td>
			<td class="text-center"><?php $api->consulta_agencia2('Centenario', 'prestamo', -2, 'soles'); ?> + <?php $api->consulta_agencia2('Centenario', 'prestamo', -2, 'dolares'); ?></td>
		</tr>
		<tr>
			<td><b><a href="74349471">Chacarilla</a></b> <button type='button' class='btn btn-dark btn-xs' data-toggle='modal' data-target='#Chacarilla'>work</button></td>
			<td class="text-center bg-warning"><?php $api->consulta_agencia2('Chacarilla', 'captacion',0, 'soles'); ?> + <?php $api->consulta_agencia2('Chacarilla', 'captacion',0, 'dolares'); ?></td>
			<td class="text-center"><?php $api->consulta_agencia2('Chacarilla', 'captacion', -1, 'soles'); ?> + <?php $api->consulta_agencia2('Chacarilla', 'captacion', -1, 'dolares'); ?></td>
			<td class="text-center"><?php $api->consulta_agencia2('Chacarilla', 'captacion', -2, 'soles'); ?> + <?php $api->consulta_agencia2('Chacarilla', 'captacion', -2, 'dolares'); ?></td>
			<td class="text-center bg-warning"><?php $api->consulta_agencia2('Chacarilla', 'prestamo', 0, 'soles'); ?> + <?php $api->consulta_agencia2('Chacarilla', 'prestamo', 0, 'dolares'); ?></td>
			<td class="text-center"><?php $api->consulta_agencia2('Chacarilla', 'prestamo', -1, 'soles'); ?> + <?php $api->consulta_agencia2('Chacarilla', 'prestamo', -1, 'dolares'); ?></td>
			<td class="text-center"><?php $api->consulta_agencia2('Chacarilla', 'prestamo', -2, 'soles'); ?> + <?php $api->consulta_agencia2('Chacarilla', 'prestamo', -2, 'dolares'); ?></td>
		</tr>
		<tr>
			<td><b><a href="90738851">Circolo</a></b> <button type='button' class='btn btn-dark btn-xs' data-toggle='modal' data-target='#Circolo'>work</button></td>
			<td class="text-center bg-warning"><?php $api->consulta_agencia2('Circolo', 'captacion',0, 'soles'); ?> + <?php $api->consulta_agencia2('Circolo', 'captacion',0, 'dolares'); ?></td>
			<td class="text-center"><?php $api->consulta_agencia2('Circolo', 'captacion', -1, 'soles'); ?> + <?php $api->consulta_agencia2('Circolo', 'captacion', -1, 'dolares'); ?></td>
			<td class="text-center"><?php $api->consulta_agencia2('Circolo', 'captacion', -2, 'soles'); ?> + <?php $api->consulta_agencia2('Circolo', 'captacion', -2, 'dolares'); ?></td>
			<td class="text-center bg-warning"><?php $api->consulta_agencia2('Circolo', 'prestamo', 0, 'soles'); ?> + <?php $api->consulta_agencia2('Circolo', 'prestamo', 0, 'dolares'); ?></td>
			<td class="text-center"><?php $api->consulta_agencia2('Circolo', 'prestamo', -1, 'soles'); ?> + <?php $api->consulta_agencia2('Circolo', 'prestamo', -1, 'dolares'); ?></td>
			<td class="text-center"><?php $api->consulta_agencia2('Circolo', 'prestamo', -2, 'soles'); ?> + <?php $api->consulta_agencia2('Circolo', 'prestamo', -2, 'dolares'); ?></td>
		</tr>
		<tr>
			<td><b><a href="79734424">Jockey</a></b> <button type='button' class='btn btn-dark btn-xs' data-toggle='modal' data-target='#Jockey'>work</button></td>
			<td class="text-center bg-warning"><?php $api->consulta_agencia2('Jockey', 'captacion',0, 'soles'); ?> + <?php $api->consulta_agencia2('Jockey', 'captacion',0, 'dolares'); ?></td>
			<td class="text-center"><?php $api->consulta_agencia2('Jockey', 'captacion', -1, 'soles'); ?> + <?php $api->consulta_agencia2('Jockey', 'captacion', -1, 'dolares'); ?></td>
			<td class="text-center"><?php $api->consulta_agencia2('Jockey', 'captacion', -2, 'soles'); ?> + <?php $api->consulta_agencia2('Jockey', 'captacion', -2, 'dolares'); ?></td>
			<td class="text-center bg-warning"><?php $api->consulta_agencia2('Jockey', 'prestamo', 0, 'soles'); ?> + <?php $api->consulta_agencia2('Jockey', 'prestamo', 0, 'dolares'); ?></td>
			<td class="text-center"><?php $api->consulta_agencia2('Jockey', 'prestamo', -1, 'soles'); ?> + <?php $api->consulta_agencia2('Jockey', 'prestamo', -1, 'dolares'); ?></td>
			<td class="text-center"><?php $api->consulta_agencia2('Jockey', 'prestamo', -2, 'soles'); ?> + <?php $api->consulta_agencia2('Jockey', 'prestamo', -2, 'dolares'); ?></td>
		</tr>
		<tr>
			<td><b><a href="21388405">Regatas</a></b> <button type='button' class='btn btn-dark btn-xs' data-toggle='modal' data-target='#Regatas'>work</button></td>
			<td class="text-center bg-warning"><?php $api->consulta_agencia2('Regatas', 'captacion',0, 'soles'); ?> + <?php $api->consulta_agencia2('Regatas', 'captacion',0, 'dolares'); ?></td>
			<td class="text-center"><?php $api->consulta_agencia2('Regatas', 'captacion', -1, 'soles'); ?> + <?php $api->consulta_agencia2('Regatas', 'captacion', -1, 'dolares'); ?></td>
			<td class="text-center"><?php $api->consulta_agencia2('Regatas', 'captacion', -2, 'soles'); ?> + <?php $api->consulta_agencia2('Regatas', 'captacion', -2, 'dolares'); ?></td>
			<td class="text-center bg-warning"><?php $api->consulta_agencia2('Regatas', 'prestamo', 0, 'soles'); ?> + <?php $api->consulta_agencia2('Regatas', 'prestamo', 0, 'dolares'); ?></td>
			<td class="text-center"><?php $api->consulta_agencia2('Regatas', 'prestamo', -1, 'soles'); ?> + <?php $api->consulta_agencia2('Regatas', 'prestamo', -1, 'dolares'); ?></td>
			<td class="text-center"><?php $api->consulta_agencia2('Regatas', 'prestamo', -2, 'soles'); ?> + <?php $api->consulta_agencia2('Regatas', 'prestamo', -2, 'dolares'); ?></td>
		</tr>
		<tr>
			<td><b><a href="70210767">San Isidro</a></b> <button type='button' class='btn btn-dark btn-xs' data-toggle='modal' data-target='#SanIsidro'>work</button></td>
			<td class="text-center bg-warning"><?php $api->consulta_agencia2('San Isidro', 'captacion',0, 'soles'); ?> + <?php $api->consulta_agencia2('San Isidro', 'captacion',0, 'dolares'); ?></td>
			<td class="text-center"><?php $api->consulta_agencia2('San Isidro', 'captacion', -1, 'soles'); ?> + <?php $api->consulta_agencia2('San Isidro', 'captacion', -1, 'dolares'); ?></td>
			<td class="text-center"><?php $api->consulta_agencia2('San Isidro', 'captacion', -2, 'soles'); ?> + <?php $api->consulta_agencia2('San Isidro', 'captacion', -2, 'dolares'); ?></td>
			<td class="text-center bg-warning"><?php $api->consulta_agencia2('San Isidro', 'prestamo', 0, 'soles'); ?> + <?php $api->consulta_agencia2('San Isidro', 'prestamo', 0, 'dolares'); ?></td>
			<td class="text-center"><?php $api->consulta_agencia2('San Isidro', 'prestamo', -1, 'soles'); ?> + <?php $api->consulta_agencia2('San Isidro', 'prestamo', -1, 'dolares'); ?></td>
			<td class="text-center"><?php $api->consulta_agencia2('San Isidro', 'prestamo', -2, 'soles'); ?> + <?php $api->consulta_agencia2('San Isidro', 'prestamo', -2, 'dolares'); ?></td>
		</tr>
		<tr>
			<td><b><a href="17684925">Surquillo</a></b> <button type='button' class='btn btn-dark btn-xs' data-toggle='modal' data-target='#Surquillo'>work</button></td>
			<td class="text-center bg-warning"><?php $api->consulta_agencia2('Surquillo', 'captacion',0, 'soles'); ?> + <?php $api->consulta_agencia2('Surquillo', 'captacion',0, 'dolares'); ?></td>
			<td class="text-center"><?php $api->consulta_agencia2('Surquillo', 'captacion', -1, 'soles'); ?> + <?php $api->consulta_agencia2('Surquillo', 'captacion', -1, 'dolares'); ?></td>
			<td class="text-center"><?php $api->consulta_agencia2('Surquillo', 'captacion', -2, 'soles'); ?> + <?php $api->consulta_agencia2('Surquillo', 'captacion', -2, 'dolares'); ?></td>
			<td class="text-center bg-warning"><?php $api->consulta_agencia2('Surquillo', 'prestamo', 0, 'soles'); ?> + <?php $api->consulta_agencia2('Surquillo', 'prestamo', 0, 'dolares'); ?></td>
			<td class="text-center"><?php $api->consulta_agencia2('Surquillo', 'prestamo', -1, 'soles'); ?> + <?php $api->consulta_agencia2('Surquillo', 'prestamo', -1, 'dolares'); ?></td>
			<td class="text-center"><?php $api->consulta_agencia2('Surquillo', 'prestamo', -2, 'soles'); ?> + <?php $api->consulta_agencia2('Surquillo', 'prestamo', -2, 'dolares'); ?></td>
		</tr>
		<tr>
			<td><b><a href="78752254">Terrazas</a></b> <button type='button' class='btn btn-dark btn-xs' data-toggle='modal' data-target='#Terrazas'>work</button></td>
			<td class="text-center bg-warning"><?php $api->consulta_agencia2('Terrazas', 'captacion',0, 'soles'); ?> + <?php $api->consulta_agencia2('Terrazas', 'captacion',0, 'dolares'); ?></td>
			<td class="text-center"><?php $api->consulta_agencia2('Terrazas', 'captacion', -1, 'soles'); ?> + <?php $api->consulta_agencia2('Terrazas', 'captacion', -1, 'dolares'); ?></td>
			<td class="text-center"><?php $api->consulta_agencia2('Terrazas', 'captacion', -2, 'soles'); ?> + <?php $api->consulta_agencia2('Terrazas', 'captacion', -2, 'dolares'); ?></td>
			<td class="text-center bg-warning"><?php $api->consulta_agencia2('Terrazas', 'prestamo', 0, 'soles'); ?> + <?php $api->consulta_agencia2('Terrazas', 'prestamo', 0, 'dolares'); ?></td>
			<td class="text-center"><?php $api->consulta_agencia2('Terrazas', 'prestamo', -1, 'soles'); ?> + <?php $api->consulta_agencia2('Terrazas', 'prestamo', -1, 'dolares'); ?></td>
			<td class="text-center"><?php $api->consulta_agencia2('Terrazas', 'prestamo', -2, 'soles'); ?> + <?php $api->consulta_agencia2('Terrazas', 'prestamo', -2, 'dolares'); ?></td>
		</tr>
		<tr>
			<td class="bg-info"><b>Total Agencias</b></td>
			<td class="text-center bg-info"><b><?php $api->consulta_agencia2('', 'captacion', 0, 'soles'); ?> + <?php $api->consulta_agencia2('', 'captacion', 0, 'dolares'); ?></b></td>
			<td class="text-center bg-info"><b><?php $api->consulta_agencia2('', 'captacion', -1, 'soles'); ?> + <?php $api->consulta_agencia2('', 'captacion', -1, 'dolares'); ?></b></td>
			<td class="text-center bg-info"><b><?php $api->consulta_agencia2('', 'captacion', -2, 'soles'); ?> + <?php $api->consulta_agencia2('', 'captacion', -2, 'dolares'); ?></b></td>
			<td class="text-center bg-info"><b><?php $api->consulta_agencia2('', 'prestamo', 0, 'soles'); ?> + <?php $api->consulta_agencia2('', 'prestamo', 0, 'dolares'); ?></b></td>
			<td class="text-center bg-info"><b><?php $api->consulta_agencia2('', 'prestamo', -1, 'soles'); ?> + <?php $api->consulta_agencia2('', 'prestamo', -1, 'dolares'); ?></b></td>
			<td class="text-center bg-info"><b><?php $api->consulta_agencia2('', 'prestamo', -2, 'soles'); ?> + <?php $api->consulta_agencia2('', 'prestamo', -2, 'dolares'); ?></b></td>
		</tr>
		<tr>
			<td>UEC</td>
			<td class="text-center bg-warning">S/ <?php $api->getImpDesemb_agencia('','captacion'); ?> + $ <?php $api->getImpDesemb_agencia_dol('','captacion'); ?></td>
			<td class="text-center">S/ <?php $api->getImpDesemb_agencia_mpasado('','captacion'); ?> + $ <?php $api->getImpDesemb_agencia_mpasado_dol('','captacion'); ?> </td>
			<td class="text-center">S/ <?php $api->getImpDesemb_agencia_ante_pasado('','captacion'); ?> + $ <?php $api->getImpDesemb_agencia_ante_pasado_dol('','captacion'); ?></td>
			<td class="text-center bg-warning">S/ <?php $api->getImpDesemb_agencia('','prestamo'); ?> + $ <?php $api->getImpDesemb_agencia_dol('','prestamo'); ?></td>
			<td class="text-center">S/ <?php $api->getImpDesemb_agencia_mpasado('','prestamo'); ?> + $ <?php $api->getImpDesemb_agencia_mpasado_dol('','prestamo'); ?></td>
			<td class="text-center">S/ <?php $api->getImpDesemb_agencia_ante_pasado('','prestamo'); ?> + $ <?php $api->getImpDesemb_agencia_ante_pasado_dol('','prestamo'); ?></td>
		</tr>
		<tr>
			<td class="bg-info"><b>Agencias + UEC</b></td>
			<td class="text-center bg-info"><b><?php $api->consulta_agencia2_tot('', 'captacion', 0, 'soles'); ?> + <?php $api->consulta_agencia2_tot('', 'captacion', 0, 'dolares'); ?></b></td>
			<td class="text-center bg-info"><b><?php $api->consulta_agencia2_tot('', 'captacion', -1, 'soles'); ?> + <?php $api->consulta_agencia2_tot('', 'captacion', -1, 'dolares'); ?></b></td>
			<td class="text-center bg-info"><b><?php $api->consulta_agencia2_tot('', 'captacion', -2, 'soles'); ?> + <?php $api->consulta_agencia2_tot('', 'captacion', -2, 'dolares'); ?></b></td>
			<td class="text-center bg-info"><b><?php $api->consulta_agencia2_tot('', 'prestamo', 0, 'soles'); ?> + <?php $api->consulta_agencia2_tot('', 'prestamo', 0, 'dolares'); ?></b></td>
			<td class="text-center bg-info"><b><?php $api->consulta_agencia2_tot('', 'prestamo', -1, 'soles'); ?> + <?php $api->consulta_agencia2_tot('', 'prestamo', -1, 'dolares'); ?></b></td>
			<td class="text-center bg-info"><b><?php $api->consulta_agencia2_tot('', 'prestamo', -2, 'soles'); ?> + <?php $api->consulta_agencia2_tot('', 'prestamo', -2, 'dolares'); ?></b></td>
		</tr>
    </tbody>
</table>

<div class='modal fade' id='Apj' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title' id='exampleModalLongTitle'>Tarjetas trabajando por Funcionario Apj</h5>
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
               <?php $api->work_agencias_funcionario_api('Apj'); ?>
		</tbody>
		</table>
        </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
            </div>
        </div>
    </div>
</div>

<div class='modal fade' id='Aelu' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title' id='exampleModalLongTitle'>Tarjetas trabajando por Funcionario Aelu</h5>
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
               <?php $api->work_agencias_funcionario_api('Aelu'); ?>
		</tbody>
		</table>
        </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
            </div>
        </div>
    </div>
</div>

<div class='modal fade' id='Centenario' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title' id='exampleModalLongTitle'>Tarjetas trabajando por Funcionario Centenario</h5>
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
               <?php $api->work_agencias_funcionario_api('Centenario'); ?>
		</tbody>
		</table>
        </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
            </div>
        </div>
    </div>
</div>

<div class='modal fade' id='Chacarilla' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title' id='exampleModalLongTitle'>Tarjetas trabajando por Funcionario Chacarilla</h5>
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
               <?php $api->work_agencias_funcionario_api('Chacarilla'); ?>
		</tbody>
		</table>
        </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
            </div>
        </div>
    </div>
</div>

<div class='modal fade' id='Circolo' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title' id='exampleModalLongTitle'>Tarjetas trabajando por Funcionario Circolo</h5>
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
               <?php $api->work_agencias_funcionario_api('Circolo'); ?>
		</tbody>
		</table>
        </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
            </div>
        </div>
    </div>
</div>

<div class='modal fade' id='Jockey' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title' id='exampleModalLongTitle'>Tarjetas trabajando por Funcionario Jockey</h5>
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
               <?php $api->work_agencias_funcionario_api('Jockey'); ?>
		</tbody>
		</table>
        </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
            </div>
        </div>
    </div>
</div>

<div class='modal fade' id='Regatas' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title' id='exampleModalLongTitle'>Tarjetas trabajando por Funcionario Regatas</h5>
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
               <?php $api->work_agencias_funcionario_api('Regatas'); ?>
		</tbody>
		</table>
        </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
            </div>
        </div>
    </div>
</div>

<div class='modal fade' id='SanIsidro' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title' id='exampleModalLongTitle'>Tarjetas trabajando por Funcionario San Isidro</h5>
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
               <?php $api->work_agencias_funcionario_api('San Isidro'); ?>
		</tbody>
		</table>
        </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
            </div>
        </div>
    </div>
</div>

<div class='modal fade' id='Surquillo' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title' id='exampleModalLongTitle'>Tarjetas trabajando por Funcionario Surquillo</h5>
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
               <?php $api->work_agencias_funcionario_api('Surquillo'); ?>
		</tbody>
		</table>
        </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
            </div>
        </div>
    </div>
</div>

<div class='modal fade' id='Terrazas' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title' id='exampleModalLongTitle'>Tarjetas trabajando por Funcionario Terrazas</h5>
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
               <?php $api->work_agencias_funcionario_api('Terrazas'); ?>
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
</html>

<?php
}
?>