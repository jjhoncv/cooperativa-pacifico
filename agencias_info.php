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
  <title>Estadisticas</title>
  <meta name="description" content="Listado de Leads">
  <meta name="author" content="SSDD">
  <link integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="css/bootstrap.css">
<script integrity="sha384-xBuQ/xzmlsLoJpyjoggmTEz8OWUFM0/RC5BsqQBDX2v5cMvDHcMakNTNrHIW2I5f" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>

function activa(){
	
	samantha = document.getElementById("Samantha").checked;
	daniel = document.getElementById("Daniel").checked;
	dayssy = document.getElementById("Dayssy").checked;
	gabriela = document.getElementById("Gabriela").checked;
	cinthia = document.getElementById("Cinthia").checked;
	christian = document.getElementById("Christian").checked;
	
	//document.getElementById("demo").innerHTML = "valor = "+samantha;
	
	var xmlhttp8 = new XMLHttpRequest();
    xmlhttp8.open("GET", "ajax_activa_funcionario?samantha="+samantha+"&daniel="+daniel+"&dayssy="+dayssy+"&gabriela="+gabriela+"&cinthia="+cinthia+"&christian="+christian);
    xmlhttp8.send(); 
    setInterval("location.reload()",1000);
	
}

function setear(id, dni){
	document.getElementById('id').value = id;
	document.getElementById('dni').value = dni;
	document.getElementById("doi").innerHTML = "<b>" + dni + "</b>?";
	document.getElementById("doi2").innerHTML = "<b>" + dni + "</b>?";
	
}

function eliminar(){
	
	if(document.getElementById('clave').value=="alianza")
	{
	id = document.getElementById('id').value;
	var xmlhttp1 = new XMLHttpRequest();
    xmlhttp1.open("GET", "delete?tabla=Agencias&id="+id);
    xmlhttp1.send(); 
    setInterval("location.reload()",1000);
	}
}

function modificar(){
	
	if(document.getElementById('clave').value=="alianza")
	{
	id = document.getElementById('id').value;
	var xmlhttp1 = new XMLHttpRequest();
    xmlhttp1.open("GET", "actualiza?tabla=Agencias&id="+id);
    xmlhttp1.send(); 
    setInterval("location.reload()",1000);
	}
}

</script>
</head>
<body>
<input type='hidden' id='id' name='id'>
<input type='hidden' id='dni' name='dni'>
<h1>UEC Estadisticas</h1>


<table class="table table-responsive table-striped">
    <thead>
        <tr>
            <th>
                <form action="agencias_info" method="get" name="cuerpo" autocomplete="off">
                    <input type="text" name="keyword" id="keyword" aria-describedby="emailHelp" size="15" placeholder="Busca aquí">
                    <button type="submit" class="btn btn-primary">Buscar</button>
					<input type="password" name="clave" id="clave" value="" placeholder="Ingresa clave">
                </form>
                
            </th>
            <th class="text-right">
			
		<button type='button' class='btn btn-warning' data-toggle='modal' data-target='#Pendientes'>work + funnel</button>
		<button type='button' class='btn btn-warning' data-toggle='modal' data-target='#Inactivas'>Inactivas</button>
		<button type='button' class='btn btn-warning' data-toggle='modal' data-target='#Origen'>Origen</button>
		<button type='button' class='btn btn-warning' data-toggle='modal' data-target='#Infocore'>Infocore</button>
		<button type='button' class='btn btn-warning' data-toggle='modal' data-target='#Vamos'>Vamos !!</button>
		<button type='button' class='btn btn-warning' data-toggle='modal' data-target='#Pasado'>Mes anterior</button>
		<a class="btn btn-warning" href="central" role="button">Central</a>
	<a class="btn btn-danger" href="desconectar?pag=agencias_info" role="button">Desconectar</a></th> 
        </td>
    </thead>
 </table>
<table class="table table-responsive table-striped">
    <thead>
        <tr>
            <th> DNI / Fecha</th>
            <th>Nombre / Origen / Tipo</th>
            <th>Funcionario</th>
            <th>Estado</th>
        </tr>
    </thead>
    <tbody>
    <?php
    
    $api->getAll_agencias(trim(htmlspecialchars($_GET['keyword'])));
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
                <button type='button' class='btn btn-danger btn-xs'>DAP</button> Dayssy [<?php $api->tarjetasPendientes_agencias('DAYSSY'); ?>] = <?php $api->consulta_funcionario('Dayssy'); ?><br>
                <button type='button' class='btn btn-success btn-xs'>SPL</button> Samantha [<?php $api->tarjetasPendientes_agencias('SAMANTHA'); ?>] = <?php $api->consulta_funcionario('Samantha'); ?><br>
                <button type='button' class='btn btn-warning btn-xs'>DPG</button> Daniel [<?php $api->tarjetasPendientes_agencias('DANIEL'); ?>] = <?php $api->consulta_funcionario('Daniel'); ?><br>
				<button type='button' class='btn btn-primary btn-xs'>GTG</button> Gabriela [<?php $api->tarjetasPendientes_agencias('GABRIELA'); ?>] = <?php $api->consulta_funcionario('Gabriela'); ?><br>
				<button type='button' class='btn btn-info btn-xs'>CLP</button> Cinthia [<?php $api->tarjetasPendientes_agencias('CINTHIA'); ?>] = <?php $api->consulta_funcionario('Cinthia'); ?><br>
				<button type='button' class='btn btn-dark btn-xs'>CJV</button> Christian [<?php $api->tarjetasPendientes_agencias('CHRISTIAN'); ?>] = <?php $api->consulta_funcionario('Christian'); ?><br>
				<button type='button' class='btn btn-secondary btn-xs'>GP</button> Giancarlo [<?php $api->tarjetasPendientes_agencias('GIANCARLO'); ?>] = <?php $api->consulta_funcionario('GIANCARLO'); ?><br><br>
				
				Por contactar S/ <?php $api->funnel_agencias('div1'); ?> <br>
				Pdte Documentos S/ <?php $api->funnel_agencias('div2'); ?><br>
				En Evaluacion S/ <?php $api->funnel_agencias('div3'); ?><br>
				En verificaciones S/ <?php $api->funnel_agencias('div4'); ?><br>
				<b><u>Listo p/desemb S/ <?php $api->funnel_agencias('div5'); ?></u></b><br>
				<?php $api->funnel_agencias_lista_api('div5'); ?><br>
        </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-primary' data-dismiss='modal' onclick='activa()'>Guardar</button>
				<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
            </div>
        </div>
    </div>
</div>

<div class='modal fade' id='Inactivas' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title' id='exampleModalLongTitle'>Tarjetas NO actualizadas hace 7 días</h5>
            </div>
        <div class='modal-body'>
                <?php $api->listado_tarjetas_no_actualizadas_api(7); ?>
        </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
            </div>
        </div>
    </div>
</div>

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

<div class='modal fade' id='ModificarTarjeta' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title' id='exampleModalLongTitle'>Modificar Tarjeta</h5>
            </div>
        <div class='modal-body'>
                ¿Estas seguro de modificar DNI: <div id='doi2'></div>
        </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-danger' data-dismiss='modal' onclick='modificar()'>Modificar</button>
				<button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>
            </div>
        </div>
    </div>
</div>

<div class='modal fade' id='Origen' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title' id='exampleModalLongTitle'>Origen - Ingreso de Tarjetas</h5>
            </div>
        <div class='modal-body'>
                <?php $api->listado_origen_api('2023-01-01','2023-01-16'); ?> <br>
        </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
            </div>
        </div>
    </div>
</div>

<div class='modal fade' id='Vamos' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
				<table class="table table-responsive table-striped">
				<thead>
					<tr>
						<th>F</th>
						<th><button type='button' class='btn btn-danger btn-xs'>DAP</button></th>
						<th><button type='button' class='btn btn-success btn-xs'>SPL</button></th>
						<th><button type='button' class='btn btn-warning btn-xs'>DPG</button></th>
						<th><button type='button' class='btn btn-primary btn-xs'>GTG</button></th>
						<th><button type='button' class='btn btn-info btn-xs'>CLP</button></th>
						<th><button type='button' class='btn btn-dark btn-xs'>CJV</button></th>
						<th><button type='button' class='btn btn-secondary btn-xs'>GP</button></th>
						<th>Total</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<th>D</th>
						<td>S/ <?php $api->getImpDesemb_agencia('DAYSSY','prestamo'); ?> (<?php $api->getTotDesemb_agencia('DAYSSY','prestamo'); ?>)</td>
						<td>S/ <?php $api->getImpDesemb_agencia('SAMANTHA','prestamo'); ?> (<?php $api->getTotDesemb_agencia('SAMANTHA','prestamo'); ?>)</td>
						<td>S/ <?php $api->getImpDesemb_agencia('DANIEL','prestamo'); ?> (<?php $api->getTotDesemb_agencia('DANIEL','prestamo'); ?>)</td>
						<td>S/ <?php $api->getImpDesemb_agencia('GABRIELA','prestamo'); ?> (<?php $api->getTotDesemb_agencia('GABRIELA','prestamo'); ?>)</td>
						<td>S/ <?php $api->getImpDesemb_agencia('CINTHIA','prestamo'); ?> (<?php $api->getTotDesemb_agencia('CINTHIA','prestamo'); ?>)</td>
						<td>S/ <?php $api->getImpDesemb_agencia('CHRISTIAN','prestamo'); ?> (<?php $api->getTotDesemb_agencia('CHRISTIAN','prestamo'); ?>)</td>
						<td>S/ <?php $api->getImpDesemb_agencia('GIANCARLO','prestamo'); ?> (<?php $api->getTotDesemb_agencia('GIANCARLO','prestamo'); ?>)</td>
						<td>S/ <?php $api->getImpDesemb_agencia('','prestamo'); ?> (<?php $api->getTotDesemb_agencia('','prestamo'); ?>)</td>
					</tr>
					<tr>
						<th>C</th>
						<td>S/ <?php $api->getImpDesemb_agencia('DAYSSY','captacion'); ?> (<?php $api->getTotDesemb_agencia('DAYSSY','captacion'); ?>)</td>
						<td>S/ <?php $api->getImpDesemb_agencia('SAMANTHA','captacion'); ?> (<?php $api->getTotDesemb_agencia('SAMANTHA','captacion'); ?>)</td>
						<td>S/ <?php $api->getImpDesemb_agencia('DANIEL','captacion'); ?> (<?php $api->getTotDesemb_agencia('DANIEL','captacion'); ?>)</td>
						<td>S/ <?php $api->getImpDesemb_agencia('GABRIELA','captacion'); ?> (<?php $api->getTotDesemb_agencia('GABRIELA','captacion'); ?>)</td>
						<td>S/ <?php $api->getImpDesemb_agencia('CINTHIA','captacion'); ?> (<?php $api->getTotDesemb_agencia('CINTHIA','captacion'); ?>)</td>
						<td>S/ <?php $api->getImpDesemb_agencia('CHRISTIAN','captacion'); ?> (<?php $api->getTotDesemb_agencia('CHRISTIAN','captacion'); ?>)</td>
						<td>S/ <?php $api->getImpDesemb_agencia('GIANCARLO','captacion'); ?> (<?php $api->getTotDesemb_agencia('GIANCARLO','captacion'); ?>)</td>
						<td>S/ <?php $api->getImpDesemb_agencia('','captacion'); ?> (<?php $api->getTotDesemb_agencia('','captacion'); ?>)</td>
					</tr>
					<tr>
						<th>O</th>
						<td>S/ <?php $api->getImpDesemb_agencia('DAYSSY','otros'); ?> (<?php $api->getTotDesemb_agencia('DAYSSY','otros'); ?>)</td>
						<td>S/ <?php $api->getImpDesemb_agencia('SAMANTHA','otros'); ?> (<?php $api->getTotDesemb_agencia('SAMANTHA','otros'); ?>)</td>
						<td>S/ <?php $api->getImpDesemb_agencia('DANIEL','otros'); ?> (<?php $api->getTotDesemb_agencia('DANIEL','otros'); ?>)</td>
						<td>S/ <?php $api->getImpDesemb_agencia('GABRIELA','otros'); ?> (<?php $api->getTotDesemb_agencia('GABRIELA','otros'); ?>)</td>
						<td>S/ <?php $api->getImpDesemb_agencia('CINTHIA','otros'); ?> (<?php $api->getTotDesemb_agencia('CINTHIA','otros'); ?>)</td>
						<td>S/ <?php $api->getImpDesemb_agencia('CHRISTIAN','otros'); ?> (<?php $api->getTotDesemb_agencia('CHRISTIAN','otros'); ?>
						<td>S/ <?php $api->getImpDesemb_agencia('GIANCARLO','otros'); ?> (<?php $api->getTotDesemb_agencia('GIANCARLO','otros'); ?>)</td>
						<td>S/ <?php $api->getImpDesemb_agencia('','otros'); ?> (<?php $api->getTotDesemb_agencia('','otros'); ?>)</td>
					</tr>
					
					
					<tr class="table-warning">
						<th>D</th>
						<td>$ <?php $api->getImpDesemb_agencia_dol('DAYSSY','prestamo'); ?> (<?php $api->getTotDesemb_agencia_dol('DAYSSY','prestamo'); ?>)</td>
						<td>$ <?php $api->getImpDesemb_agencia_dol('SAMANTHA','prestamo'); ?> (<?php $api->getTotDesemb_agencia_dol('SAMANTHA','prestamo'); ?>)</td>
						<td>$ <?php $api->getImpDesemb_agencia_dol('DANIEL','prestamo'); ?> (<?php $api->getTotDesemb_agencia_dol('DANIEL','prestamo'); ?>)</td>
						<td>$ <?php $api->getImpDesemb_agencia_dol('GABRIELA','prestamo'); ?> (<?php $api->getTotDesemb_agencia_dol('GABRIELA','prestamo'); ?>)</td>
						<td>$ <?php $api->getImpDesemb_agencia_dol('CINTHIA','prestamo'); ?> (<?php $api->getTotDesemb_agencia_dol('CINTHIA','prestamo'); ?>)</td>
						<td>$ <?php $api->getImpDesemb_agencia_dol('CHRISTIAN','prestamo'); ?> (<?php $api->getTotDesemb_agencia_dol('CHRISTIAN','prestamo'); ?>)</td>
						<td>$ <?php $api->getImpDesemb_agencia_dol('GIANCARLO','prestamo'); ?> (<?php $api->getTotDesemb_agencia_dol('GIANCARLO','prestamo'); ?>)</td>
						<td>$ <?php $api->getImpDesemb_agencia_dol('','prestamo'); ?> (<?php $api->getTotDesemb_agencia_dol('','prestamo'); ?>)</td>
					</tr>
					<tr class="table-warning">
						<th>C</th>
						<td>$ <?php $api->getImpDesemb_agencia_dol('DAYSSY','captacion'); ?> (<?php $api->getTotDesemb_agencia_dol('DAYSSY','captacion'); ?>)</td>
						<td>$ <?php $api->getImpDesemb_agencia_dol('SAMANTHA','captacion'); ?> (<?php $api->getTotDesemb_agencia_dol('SAMANTHA','captacion'); ?>)</td>
						<td>$ <?php $api->getImpDesemb_agencia_dol('DANIEL','captacion'); ?> (<?php $api->getTotDesemb_agencia_dol('DANIEL','captacion'); ?>)</td>
						<td>$ <?php $api->getImpDesemb_agencia_dol('GABRIELA','captacion'); ?> (<?php $api->getTotDesemb_agencia_dol('GABRIELA','captacion'); ?>)</td>
						<td>$ <?php $api->getImpDesemb_agencia_dol('CINTHIA','captacion'); ?> (<?php $api->getTotDesemb_agencia_dol('CINTHIA','captacion'); ?>)</td>
						<td>$ <?php $api->getImpDesemb_agencia_dol('CHRISTIAN','captacion'); ?> (<?php $api->getTotDesemb_agencia_dol('CHRISTIAN','captacion'); ?>)</td>
						<td>$ <?php $api->getImpDesemb_agencia_dol('GIANCARLO','captacion'); ?> (<?php $api->getTotDesemb_agencia_dol('GIANCARLO','captacion'); ?>)</td>
						<td>$ <?php $api->getImpDesemb_agencia_dol('','captacion'); ?> (<?php $api->getTotDesemb_agencia_dol('','captacion'); ?>)</td>
					</tr>
					<tr class="table-warning">
						<th>O</th>
						<td>$ <?php $api->getImpDesemb_agencia_dol('DAYSSY','otros'); ?> (<?php $api->getTotDesemb_agencia_dol('DAYSSY','otros'); ?>)</td>
						<td>$ <?php $api->getImpDesemb_agencia_dol('SAMANTHA','otros'); ?> (<?php $api->getTotDesemb_agencia_dol('SAMANTHA','otros'); ?>)</td>
						<td>$ <?php $api->getImpDesemb_agencia_dol('DANIEL','otros'); ?> (<?php $api->getTotDesemb_agencia_dol('DANIEL','otros'); ?>)</td>
						<td>$ <?php $api->getImpDesemb_agencia_dol('GABRIELA','otros'); ?> (<?php $api->getTotDesemb_agencia_dol('GABRIELA','otros'); ?>)</td>
						<td>$ <?php $api->getImpDesemb_agencia_dol('CINTHIA','otros'); ?> (<?php $api->getTotDesemb_agencia_dol('CINTHIA','otros'); ?>)</td>
						<td>$ <?php $api->getImpDesemb_agencia_dol('CHRISTIAN','otros'); ?> (<?php $api->getTotDesemb_agencia_dol('CHRISTIAN','otros'); ?>)</td>
						<td>$ <?php $api->getImpDesemb_agencia_dol('GIANCARLO','otros'); ?> (<?php $api->getTotDesemb_agencia_dol('GIANCARLO','otros'); ?>)</td>
						<td>$ <?php $api->getImpDesemb_agencia_dol('','otros'); ?> (<?php $api->getTotDesemb_agencia_dol('','otros'); ?>)</td>
					</tr>
				</tbody>
				</table>
			</div>
        <div class='modal-body'>
					<?php $api->getListadoDesemb_agencia('DAYSSY'); ?><br>
					<?php $api->getListadoDesemb_agencia('SAMANTHA'); ?><br>
					<?php $api->getListadoDesemb_agencia('DANIEL'); ?><br>
					<?php $api->getListadoDesemb_agencia('GABRIELA'); ?><br>
					<?php $api->getListadoDesemb_agencia('CINTHIA'); ?><br>	
					<?php $api->getListadoDesemb_agencia('CHRISTIAN'); ?><br>
					<?php $api->getListadoDesemb_agencia('GIANCARLO'); ?><br>					
            </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                
            </div>
        </div>
    </div>
</div>

<div class='modal fade' id='Infocore' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title' id='exampleModalLongTitle'><b>Funel INFOCORE</b></h5>
            </div>
        <div class='modal-body'>
				<?php
				$month_day_last = date('Y-m', strtotime('first day of last month'));
				$dos_meses = date('Y-m', strtotime('-2 month'));
				$hoy = date('Y-m-d');
				$first_day = date('Y-m');
			
				$mes_pasado_inicio = $month_day_last . "-01";
				$mes_pasado_fin = $month_day_last . "-31";
				$mes_actual_inicio = $first_day . "-01";
				$mes_actual_fin = $hoy;
				$mes_antepasado_inicio = $dos_meses . "-01";
				$mes_antepasado_fin = $dos_meses . "-31";
				
				echo "<table class='table table-responsive table-striped'>";
				echo "<thead>";
				echo "<tr><th>Origen</th><th class='text-center'>" . strtoupper(strftime("%b")) . "</th><th class='text-center'>" . strtoupper(strftime("%b", strtotime('first day of last month'))) . "</th><th class='text-center'>" . strtoupper(strftime("%b", strtotime('-2 month'))) . "</th><th class='text-center'>TOT</th></tr>";
				echo "</thead>";
				echo "<tbody>";
				echo "</tbody>";
				echo "</table>";
				?>
		
 				<b><u>Porx contactar S/ <?php $api->funnel_agencias_infocore('div1'); ?></u></b> <br>
				<b><u>Pdte Documentos S/ <?php $api->funnel_agencias_infocore('div2'); ?></u></b><br>
				<?php $api->funnel_agencias_infocore_lista_api('div2'); ?><br>
				<b><u>En Evaluacion S/ <?php $api->funnel_agencias_infocore('div3'); ?></u></b><br>
				<?php $api->funnel_agencias_infocore_lista_api('div3'); ?><br>
				<b><u>En verificaciones S/ <?php $api->funnel_agencias_infocore('div4'); ?></u></b><br>
				<?php $api->funnel_agencias_infocore_lista_api('div4'); ?><br>
				<b><u>Listo p/desemb S/ <?php $api->funnel_agencias_infocore('div5'); ?></u></b><br>
				<?php $api->funnel_agencias_infocore_lista_api('div5'); ?><br>
				<b><u>Mes Actual Desembolsado S/ <?php 

				date_default_timezone_set('America/Lima');
				$mes_actual = date('Y-m');
				$mes_pasado = date('Y-m', strtotime('first day of last month'));
				
				$api->desembolsado_infocore($mes_actual); 
				?></u></b> <br>
				<?php $api->getListadoDesemb_infocore($mes_actual); ?>
				<br>
				<b><u>Mes Anterior Desembolsado S/ <?php $api->desembolsado_infocore($mes_pasado); ?></u></b><br>
				<?php $api->getListadoDesemb_infocore($mes_pasado); ?>
        </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
            </div>
        </div>
    </div>
</div>


<div class='modal fade' id='Pasado' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
				<table class="table table-responsive table-striped">
				<thead>
					<tr>
						<th>F</th>
						<th><button type='button' class='btn btn-danger btn-xs'>DAP</button></th>
						<th><button type='button' class='btn btn-success btn-xs'>SPL</button></th>
						<th><button type='button' class='btn btn-warning btn-xs'>DPG</button></th>
						<th><button type='button' class='btn btn-primary btn-xs'>GTG</button></th>
						<th><button type='button' class='btn btn-info btn-xs'>CLP</button></th>
						<th><button type='button' class='btn btn-dark btn-xs'>CJV</button></th>
						<th><button type='button' class='btn btn-secondary btn-xs'>GP</button></th>
						<th>Total</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<th>D</th>
						<td>S/ <?php $api->getImpDesemb_agencia_mpasado('DAYSSY','prestamo'); ?> (<?php $api->getTotDesemb_agencia_mpasado('DAYSSY','prestamo'); ?>)</td>
						<td>S/ <?php $api->getImpDesemb_agencia_mpasado('SAMANTHA','prestamo'); ?> (<?php $api->getTotDesemb_agencia_mpasado('SAMANTHA','prestamo'); ?>)</td>
						<td>S/ <?php $api->getImpDesemb_agencia_mpasado('DANIEL','prestamo'); ?> (<?php $api->getTotDesemb_agencia_mpasado('DANIEL','prestamo'); ?>)</td>
						<td>S/ <?php $api->getImpDesemb_agencia_mpasado('GABRIELA','prestamo'); ?> (<?php $api->getTotDesemb_agencia_mpasado('GABRIELA','prestamo'); ?>)</td>
						<td>S/ <?php $api->getImpDesemb_agencia_mpasado('CINTHIA','prestamo'); ?> (<?php $api->getTotDesemb_agencia_mpasado('CINTHIA','prestamo'); ?>)</td>
						<td>S/ <?php $api->getImpDesemb_agencia_mpasado('CHRISTIAN','prestamo'); ?> (<?php $api->getTotDesemb_agencia_mpasado('CHRISTIAN','prestamo'); ?>)</td>
						<td>S/ <?php $api->getImpDesemb_agencia_mpasado('GIANCARLO','prestamo'); ?> (<?php $api->getTotDesemb_agencia_mpasado('GIANCARLO','prestamo'); ?>)</td>
						<td>S/ <?php $api->getImpDesemb_agencia_mpasado('','prestamo'); ?> (<?php $api->getTotDesemb_agencia_mpasado('','prestamo'); ?>)</td>
					</tr>
					<tr>
						<th>C</th>
						<td>S/ <?php $api->getImpDesemb_agencia_mpasado('DAYSSY','captacion'); ?> (<?php $api->getTotDesemb_agencia_mpasado('DAYSSY','captacion'); ?>)</td>
						<td>S/ <?php $api->getImpDesemb_agencia_mpasado('SAMANTHA','captacion'); ?> (<?php $api->getTotDesemb_agencia_mpasado('SAMANTHA','captacion'); ?>)</td>
						<td>S/ <?php $api->getImpDesemb_agencia_mpasado('DANIEL','captacion'); ?> (<?php $api->getTotDesemb_agencia_mpasado('DANIEL','captacion'); ?>)</td>
						<td>S/ <?php $api->getImpDesemb_agencia_mpasado('GABRIELA','captacion'); ?> (<?php $api->getTotDesemb_agencia_mpasado('GABRIELA','captacion'); ?>)</td>
						<td>S/ <?php $api->getImpDesemb_agencia_mpasado('CINTHIA','captacion'); ?> (<?php $api->getTotDesemb_agencia_mpasado('CINTHIA','captacion'); ?>)</td>
						<td>S/ <?php $api->getImpDesemb_agencia_mpasado('CHRISTIAN','captacion'); ?> (<?php $api->getTotDesemb_agencia_mpasado('CHRISTIAN','captacion'); ?>)</td>
						<td>S/ <?php $api->getImpDesemb_agencia_mpasado('GIANCARLO','captacion'); ?> (<?php $api->getTotDesemb_agencia_mpasado('GIANCARLO','captacion'); ?>)</td>
						<td>S/ <?php $api->getImpDesemb_agencia_mpasado('','captacion'); ?> (<?php $api->getTotDesemb_agencia_mpasado('','captacion'); ?>)</td>
					</tr>
					<tr>
						<th>O</th>
						<td>S/ <?php $api->getImpDesemb_agencia_mpasado('DAYSSY','otros'); ?> (<?php $api->getTotDesemb_agencia_mpasado('DAYSSY','otros'); ?>)</td>
						<td>S/ <?php $api->getImpDesemb_agencia_mpasado('SAMANTHA','otros'); ?> (<?php $api->getTotDesemb_agencia_mpasado('SAMANTHA','otros'); ?>)</td>
						<td>S/ <?php $api->getImpDesemb_agencia_mpasado('DANIEL','otros'); ?> (<?php $api->getTotDesemb_agencia_mpasado('DANIEL','otros'); ?>)</td>
						<td>S/ <?php $api->getImpDesemb_agencia_mpasado('GABRIELA','otros'); ?> (<?php $api->getTotDesemb_agencia_mpasado('GABRIELA','otros'); ?>)</td>
						<td>S/ <?php $api->getImpDesemb_agencia_mpasado('CINTHIA','otros'); ?> (<?php $api->getTotDesemb_agencia_mpasado('CINTHIA','otros'); ?>)</td>
						<td>S/ <?php $api->getImpDesemb_agencia_mpasado('CHRISTIAN','otros'); ?> (<?php $api->getTotDesemb_agencia_mpasado('CHRISTIAN','otros'); ?>)</td>
						<td>S/ <?php $api->getImpDesemb_agencia_mpasado('GIANCARLO','otros'); ?> (<?php $api->getTotDesemb_agencia_mpasado('GIANCARLO','otros'); ?>)</td>
						<td>S/ <?php $api->getImpDesemb_agencia_mpasado('','otros'); ?> (<?php $api->getTotDesemb_agencia_mpasado('','otros'); ?>)</td>
					</tr>
					
					<tr class="table-warning">
						<th>D</th>
						<td>$ <?php $api->getImpDesemb_agencia_mpasado_dol('DAYSSY','prestamo'); ?> (<?php $api->getTotDesemb_agencia_mpasado_dol('DAYSSY','prestamo'); ?>)</td>
						<td>$ <?php $api->getImpDesemb_agencia_mpasado_dol('SAMANTHA','prestamo'); ?> (<?php $api->getTotDesemb_agencia_mpasado_dol('SAMANTHA','prestamo'); ?>)</td>
						<td>$ <?php $api->getImpDesemb_agencia_mpasado_dol('DANIEL','prestamo'); ?> (<?php $api->getTotDesemb_agencia_mpasado_dol('DANIEL','prestamo'); ?>)</td>
						<td>$ <?php $api->getImpDesemb_agencia_mpasado_dol('GABRIELA','prestamo'); ?> (<?php $api->getTotDesemb_agencia_mpasado_dol('GABRIELA','prestamo'); ?>)</td>
						<td>$ <?php $api->getImpDesemb_agencia_mpasado_dol('CINTHIA','prestamo'); ?> (<?php $api->getTotDesemb_agencia_mpasado_dol('CINTHIA','prestamo'); ?>)</td>
						<td>$ <?php $api->getImpDesemb_agencia_mpasado_dol('CHRISTIAN','prestamo'); ?> (<?php $api->getTotDesemb_agencia_mpasado_dol('CHRISTIAN','prestamo'); ?>)</td>
						<td>$ <?php $api->getImpDesemb_agencia_mpasado_dol('GIANCARLO','prestamo'); ?> (<?php $api->getTotDesemb_agencia_mpasado_dol('GIANCARLO','prestamo'); ?>)</td>
						<td>$ <?php $api->getImpDesemb_agencia_mpasado_dol('','prestamo'); ?> (<?php $api->getTotDesemb_agencia_mpasado_dol('','prestamo'); ?>)</td>
					</tr>
					<tr class="table-warning">
						<th>C</th>
						<td>$ <?php $api->getImpDesemb_agencia_mpasado_dol('DAYSSY','captacion'); ?> (<?php $api->getTotDesemb_agencia_mpasado_dol('DAYSSY','captacion'); ?>)</td>
						<td>$ <?php $api->getImpDesemb_agencia_mpasado_dol('SAMANTHA','captacion'); ?> (<?php $api->getTotDesemb_agencia_mpasado_dol('SAMANTHA','captacion'); ?>)</td>
						<td>$ <?php $api->getImpDesemb_agencia_mpasado_dol('DANIEL','captacion'); ?> (<?php $api->getTotDesemb_agencia_mpasado_dol('DANIEL','captacion'); ?>)</td>
						<td>$ <?php $api->getImpDesemb_agencia_mpasado_dol('GABRIELA','captacion'); ?> (<?php $api->getTotDesemb_agencia_mpasado_dol('GABRIELA','captacion'); ?>)</td>
						<td>$ <?php $api->getImpDesemb_agencia_mpasado_dol('CINTHIA','captacion'); ?> (<?php $api->getTotDesemb_agencia_mpasado_dol('CINTHIA','captacion'); ?>)</td>
						<td>$ <?php $api->getImpDesemb_agencia_mpasado_dol('CHRISTIAN','captacion'); ?> (<?php $api->getTotDesemb_agencia_mpasado_dol('CHRISTIAN','captacion'); ?>)</td>
						<td>$ <?php $api->getImpDesemb_agencia_mpasado_dol('GIANCARLO','captacion'); ?> (<?php $api->getTotDesemb_agencia_mpasado_dol('GIANCARLO','captacion'); ?>)</td>
						<td>$ <?php $api->getImpDesemb_agencia_mpasado_dol('','captacion'); ?> (<?php $api->getTotDesemb_agencia_mpasado_dol('','captacion'); ?>)</td>
					</tr>
					<tr class="table-warning">
						<th>O</th>
						<td>$ <?php $api->getImpDesemb_agencia_mpasado_dol('DAYSSY','otros'); ?> (<?php $api->getTotDesemb_agencia_mpasado_dol('DAYSSY','otros'); ?>)</td>
						<td>$ <?php $api->getImpDesemb_agencia_mpasado_dol('SAMANTHA','otros'); ?> (<?php $api->getTotDesemb_agencia_mpasado_dol('SAMANTHA','otros'); ?>)</td>
						<td>$ <?php $api->getImpDesemb_agencia_mpasado_dol('DANIEL','otros'); ?> (<?php $api->getTotDesemb_agencia_mpasado_dol('DANIEL','otros'); ?>)</td>
						<td>$ <?php $api->getImpDesemb_agencia_mpasado_dol('GABRIELA','otros'); ?> (<?php $api->getTotDesemb_agencia_mpasado_dol('GABRIELA','otros'); ?>)</td>
						<td>$ <?php $api->getImpDesemb_agencia_mpasado_dol('CINTHIA','otros'); ?> (<?php $api->getTotDesemb_agencia_mpasado_dol('CINTHIA','otros'); ?>)</td>
						<td>$ <?php $api->getImpDesemb_agencia_mpasado_dol('CHRISTIAN','otros'); ?> (<?php $api->getTotDesemb_agencia_mpasado_dol('CHRISTIAN','otros'); ?>)</td>
						<td>$ <?php $api->getImpDesemb_agencia_mpasado_dol('GIANCARLO','otros'); ?> (<?php $api->getTotDesemb_agencia_mpasado_dol('GIANCARLO','otros'); ?>)</td>
						<td>$ <?php $api->getImpDesemb_agencia_mpasado_dol('','otros'); ?> (<?php $api->getTotDesemb_agencia_mpasado_dol('','otros'); ?>)</td>
					</tr>
				</tbody>
				</table>
			</div>
        <div class='modal-body'>
					<?php $api->getListadoDesemb_agencia_mpasado('DAYSSY'); ?><br>
					<?php $api->getListadoDesemb_agencia_mpasado('SAMANTHA'); ?><br>
					<?php $api->getListadoDesemb_agencia_mpasado('DANIEL'); ?><br>
					<?php $api->getListadoDesemb_agencia_mpasado('GABRIELA'); ?><br>
					<?php $api->getListadoDesemb_agencia_mpasado('CINTHIA'); ?><br>
					<?php $api->getListadoDesemb_agencia_mpasado('CHRISTIAN'); ?><br>
					<?php $api->getListadoDesemb_agencia_mpasado('GIANCARLO'); ?><br>					
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