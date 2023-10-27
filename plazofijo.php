<?php
session_start();

    
if (isset($_SESSION["login"]))
{
	
    include_once 'apipersonas_plazofijo.php';

    $api = new ApiPersonas();
?>


<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Plazo Fijo Leads</title>
  <meta name="description" content="Plazo Fijo Leads">
  <meta name="author" content="SSDD">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
function activa(){
	
	karina = document.getElementById("Karina").checked;
	karen = document.getElementById("Karen").checked;
	katy = document.getElementById("Katy").checked;

	var xmlhttp8 = new XMLHttpRequest();
    xmlhttp8.open("GET", "ajax_activa_digital_plazofijo?karina="+karina+"&karen="+karen+"&katy="+katy);
    xmlhttp8.send(); 
    setInterval("location.reload()",1000);
	
}
</script>
</head>
<body>
 <table class="table table-responsive table-striped">
    <thead>
        <tr>
            <th>
                <form action="plazofijo" method="get" name="cuerpo" autocomplete="off">
                    <input type="text" name="keyword" id="keyword" aria-describedby="emailHelp" size="15" placeholder="Busca aquí">
                    <button type="submit" class="btn btn-primary">Buscar</button>
					<b>Leads Plazo Fijo</b> 
                </form>
                
            </th>
            <th class="text-right">
			<button type='button' class='btn btn-warning' data-toggle='modal' data-target='#Pendientes'>Trabajando</button>
			<button type='button' class='btn btn-warning' data-toggle='modal' data-target='#Vamos'>Mes(0)</button>
			<button type='button' class='btn btn-warning' data-toggle='modal' data-target='#MPasado'>Mes(-1)</button>
			<button type='button' class='btn btn-warning' data-toggle='modal' data-target='#MPasado_2'>Mes(-2)</button>
			<button type='button' class='btn btn-warning' data-toggle='modal' data-target='#MPasado_3'>Mes(-3)</button>
			<a class="btn btn-danger" href="desconectar?pag=lista" role="button">Desconectar</a></th> 
        </td>
    </thead>
 </table>
 <table class="table table-responsive table-striped">
    <thead>
        <tr>
            <th> DNI / Fecha</th>
            <th>Nombre / Cal / Origen</th>
            <th>Estado / Funcionario</th>
            <th>Celular</th>
        </tr>
    </thead>
    <tbody>
    <?php
    
    $api->getAll_plazofijo(trim($_GET['keyword']));
    ?>
    
    
    </tbody>

</table>

<div class='modal fade' id='Vamos' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h3 class='modal-title' id='exampleModalLongTitle'>
					Aperturas del Mes
					</h3>
            </div>
        <div class='modal-body'>
				
							<?php $api->getListadoDesemb_plazofijo('Soles'); ?>
							<hr>				
				Total S/ <?php $api->getImpDesemb_plazofijo('Soles'); ?> (<?php $api->getTotDesemb_plazofijo('Soles'); ?>)<br>Dinero fresco S/ <?php $api->getImpDesemb_plazofijo_df('Soles'); ?> (<?php $api->getTotDesemb_plazofijo_df('Soles'); ?>)
<hr>
				<?php $api->getListadoDesemb_plazofijo('Dolares'); ?>
							<hr>				
				Total $ <?php $api->getImpDesemb_plazofijo('Dolares'); ?> (<?php $api->getTotDesemb_plazofijo('Dolares'); ?>) <br>Dinero fresco $ <?php $api->getImpDesemb_plazofijo_df('Dolares'); ?> (<?php $api->getTotDesemb_plazofijo_df('Dolares'); ?>)					
            </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                
            </div>
        </div>
    </div>
</div>

<div class='modal fade' id='Pendientes' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title' id='exampleModalLongTitle'>Tarjetas trabajando por Funcionario + Funnel</h5>
            </div>
        <div class='modal-body'>
                Karina [<?php $api->tarjetasPendientes('Karina'); ?>] <?php $api->consulta_digital('Karina'); ?><br>
                Karen [<?php $api->tarjetasPendientes('Karen'); ?>] <?php $api->consulta_digital('Karen'); ?><br>
                Katy [<?php $api->tarjetasPendientes('Katy'); ?>] <?php $api->consulta_digital('Katy'); ?><br><br>
				
				
				<b>Por contactar</b><br>
				<button type='button' class='btn btn-success btn-xs'>KMO</button> <?php $api->funnel_digital('div1','Karina'); ?>
				<button type='button' class='btn btn-danger btn-xs'>KMC</button> <?php $api->funnel_digital('div1','Karen'); ?>
				<button type='button' class='btn btn-primary btn-xs'>KS</button> <?php $api->funnel_digital('div1','Katy'); ?>
				<br>Total <?php $api->funnel_digital('div1',''); ?>
				
				<br><br>
				<b>Requisitos</b><br>
				<button type='button' class='btn btn-success btn-xs'>KMO</button> <?php $api->funnel_digital('div2','Karina'); ?>
				<button type='button' class='btn btn-danger btn-xs'>KMC</button> <?php $api->funnel_digital('div2','Karen'); ?>
				<button type='button' class='btn btn-primary btn-xs'>KS</button> <?php $api->funnel_digital('div2','Katy'); ?>
				<br>Total <?php $api->funnel_digital('div2',''); ?>
				
				<br><br>
				<b>Por inscribir</b><br>
				<button type='button' class='btn btn-success btn-xs'>KMO</button> <?php $api->funnel_digital('div3','Karina'); ?>
				<button type='button' class='btn btn-danger btn-xs'>KMC</button> <?php $api->funnel_digital('div3','Karen'); ?>
				<button type='button' class='btn btn-primary btn-xs'>KS</button> <?php $api->funnel_digital('div3','Katy'); ?>
				<br>Total <?php $api->funnel_digital('div3',''); ?>
				
				<br><br>
				<b>Soporte Pacinet</b><br>
				<button type='button' class='btn btn-success btn-xs'>KMO</button> <?php $api->funnel_digital('div4','Karina'); ?>
				<button type='button' class='btn btn-danger btn-xs'>KMC</button> <?php $api->funnel_digital('div4','Karen'); ?>
				<button type='button' class='btn btn-primary btn-xs'>KS</button> <?php $api->funnel_digital('div4','Katy'); ?>
				<br>Total <?php $api->funnel_digital('div4',''); ?>
				
				<br><br>
				<b>Dinero en AHV</b><br>
				<button type='button' class='btn btn-success btn-xs'>KMO</button> <?php $api->funnel_digital('div5','Karina'); ?>
				<button type='button' class='btn btn-danger btn-xs'>KMC</button> <?php $api->funnel_digital('div5','Karen'); ?>
				<button type='button' class='btn btn-primary btn-xs'>KS</button> <?php $api->funnel_digital('div5','Katy'); ?>
				<br>Total <?php $api->funnel_digital('div5',''); ?>
        </div>
            <div class='modal-footer'>
				<button type='button' class='btn btn-primary' data-dismiss='modal' onclick='activa()'>Guardar</button>
                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                
            </div>
        </div>
    </div>
</div>

<div class='modal fade' id='MPasado' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h3 class='modal-title' id='exampleModalLongTitle'>
					Aperturas del Mes Pasado
					</h3>
            </div>
        <div class='modal-body'>
				
							<?php $api->getListadoDesemb_mpasado('Soles'); ?>
							<hr>				
				Total S/ <?php $api->getImpDesemb_mpasado('Soles'); ?> (<?php $api->getTotDesemb_mpasado('Soles'); ?>)	
							<hr>
				<?php $api->getListadoDesemb_mpasado('Dolares'); ?>
							<hr>				
				Total $ <?php $api->getImpDesemb_mpasado('Dolares'); ?> (<?php $api->getTotDesemb_mpasado('Dolares'); ?>)	
            </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                
            </div>
        </div>
    </div>
</div>

<div class='modal fade' id='MPasado_2' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h3 class='modal-title' id='exampleModalLongTitle'>
					Aperturas de hace 2 meses
					</h3>
            </div>
        <div class='modal-body'>
				
							<?php $api->getListadoDesemb_mpasado_atras('Soles',2); ?>
							<hr>				
				Total S/ <?php $api->getImpDesemb_mpasado_atras('Soles',2); ?> (<?php $api->getTotDesemb_mpasado_atras('Soles',2); ?>)	
							<hr>
				<?php $api->getListadoDesemb_mpasado_atras('Dolares',2); ?>
							<hr>				
				Total $ <?php $api->getImpDesemb_mpasado_atras('Dolares',2); ?> (<?php $api->getTotDesemb_mpasado_atras('Dolares',2); ?>)	
            </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                
            </div>
        </div>
    </div>
</div>

<div class='modal fade' id='MPasado_3' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h3 class='modal-title' id='exampleModalLongTitle'>
					Aperturas de hace 3 meses
					</h3>
            </div>
        <div class='modal-body'>
				
							<?php $api->getListadoDesemb_mpasado_atras('Soles',3); ?>
							<hr>				
				Total S/ <?php $api->getImpDesemb_mpasado_atras('Soles',3); ?> (<?php $api->getTotDesemb_mpasado_atras('Soles',3); ?>)	
							<hr>
				<?php $api->getListadoDesemb_mpasado_atras('Dolares',3); ?>
							<hr>				
				Total $ <?php $api->getImpDesemb_mpasado_atras('Dolares',3); ?> (<?php $api->getTotDesemb_mpasado_atras('Dolares',3); ?>)	
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