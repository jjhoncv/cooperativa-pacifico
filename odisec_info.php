<?php
session_start();

    
    if (isset($_SESSION["login"]))
    {
        
    include_once 'apipersonas_credimaq.php';

    $api = new ApiPersonas();
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Odisec - Lista de Leads</title>
  <meta name="description" content="Pdp - Listado de Leads">
  <meta name="author" content="SSDD">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
function activa(){
	
	agente1 = document.getElementById("Agente1").checked;
	agente2 = document.getElementById("Agente2").checked;
	agente3 = document.getElementById("Agente3").checked;

	var xmlhttp8 = new XMLHttpRequest();
    xmlhttp8.open("GET", "ajax_credimaq?func=4&agente1="+agente1+"&agente2="+agente2+"&agente3="+agente3);
    xmlhttp8.send(); 
    setInterval("location.reload()",1000);
	
}

function setear(id, dni){
	document.getElementById('id').value = id;
	document.getElementById('dni').value = dni;
	document.getElementById("doi").innerHTML = "<b>" + dni + "</b>?";
	
}

function eliminar(){
	
	if(document.getElementById('clave').value=="prestamo")
	{
	id = document.getElementById('id').value;
	var xmlhttp1 = new XMLHttpRequest();
    xmlhttp1.open("GET", "delete?tabla=Credimaq&id="+id);
    xmlhttp1.send(); 
    setInterval("location.reload()",1000);
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
            <th>
                <form action="odisec_info" method="get" name="cuerpo" autocomplete="off">
                    <input type="text" name="keyword" id="keyword" aria-describedby="emailHelp" size="15" placeholder="Busca aquí">
                    <button type="submit" class="btn btn-primary">Buscar</button>
					<input type="password" name="clave" id="clave" value="" placeholder="Ingresa clave">
                </form>
                
            </th>
            <th class="text-right">
			<button type='button' class='btn btn-warning' data-toggle='modal' data-target='#Pendientes'>Trabajando</button>
			<button type='button' class='btn btn-warning' data-toggle='modal' data-target='#Vamos'>Desembolsado</button> <a class="btn btn-danger" href="desconectar?pag=odisec_info" role="button">Desconectar</a></th> 
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
    
    $api->getAll_pdp(trim(htmlspecialchars($_GET['keyword'])));
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

<div class='modal fade' id='Pendientes' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title' id='exampleModalLongTitle'>Tarjetas trabajando por Funcionario + Funnel</h5>
            </div>
        <div class='modal-body'>
		<!--
                Agente 1 [<?php $api->tarjetasPendientes('Agente1'); ?>] <?php $api->consulta_pdp('Agente1'); ?><br>
                Agente 2 [<?php $api->tarjetasPendientes('Agente2'); ?>] <?php $api->consulta_pdp('Agente2'); ?><br>
                Agente 3 [<?php $api->tarjetasPendientes('Agente3'); ?>] <?php $api->consulta_pdp('Agente3'); ?><br><br>
			//-->
				<table class="table table-bordered">
              <thead>
                <tr>
                  <th scope="col" class="table-success">Pre-aprobados</th>
                  <th scope="col" class="table-success text-center">1 Semana</th>
                  <th scope="col" class="table-success text-center">Ayer</th>
                  <th scope="col" class="table-success text-center">Hoy</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row">Agente 1</th>
                  <td class="text-center"><?php $api->getDataPreaprobados_pdp(7,'Agente1'); ?></td>
                  <td class="text-center"><?php $api->getDataPreaprobados_pdp(1,'Agente1'); ?></td>
                  <td class="text-center"><?php $api->getDataPreaprobados_pdp(0,'Agente1'); ?></td>
                </tr>
                <tr>
                  <th scope="row">Agente 2</th>
                  <td class="text-center"><?php $api->getDataPreaprobados_pdp(7,'Agente1'); ?></td>
                  <td class="text-center"><?php $api->getDataPreaprobados_pdp(1,'Agente2'); ?></td>
                  <td class="text-center"><?php $api->getDataPreaprobados_pdp(0,'Agente2'); ?></td>
                </tr>
                <tr>
                  <th scope="row">Agente 3</th>
                  <td class="text-center"><?php $api->getDataPreaprobados_pdp(7,'Agente3'); ?></td>
                  <td class="text-center"><?php $api->getDataPreaprobados_pdp(1,'Agente3'); ?></td>
                  <td class="text-center"><?php $api->getDataPreaprobados_pdp(0,'Agente3'); ?></td>
                </tr>
              </tbody>
            </table>
				
				<b>En verificaciones</b><br>
				<button type='button' class='btn btn-success btn-xs'>A1</button> <?php $api->funnel_pdp('div4','Agente1'); ?>
				<button type='button' class='btn btn-danger btn-xs'>A2</button> <?php $api->funnel_pdp('div4','Agente2'); ?>
				<button type='button' class='btn btn-primary btn-xs'>A3</button> <?php $api->funnel_pdp('div4','Agente3'); ?>
				<br>Total <?php $api->funnel_pdp('div4',''); ?>
				
				<br><br>
				<b>En UEC</b><br>
				<button type='button' class='btn btn-success btn-xs'>A1</button> <?php $api->funnel_pdp('div3','Agente1'); ?>
				<button type='button' class='btn btn-danger btn-xs'>A2</button> <?php $api->funnel_pdp('div3','Agente2'); ?>
				<button type='button' class='btn btn-primary btn-xs'>A3</button> <?php $api->funnel_pdp('div3','Agente3'); ?>
				<br>Total <?php $api->funnel_pdp('div3',''); ?>
				
				<br><br>
				<b>Aprobado</b><br>
				<button type='button' class='btn btn-success btn-xs'>A1</button> <?php $api->funnel_pdp('div5','Agente1'); ?>
				<button type='button' class='btn btn-danger btn-xs'>A2</button> <?php $api->funnel_pdp('div5','Agente2'); ?>
				<button type='button' class='btn btn-primary btn-xs'>A3</button> <?php $api->funnel_pdp('div5','Agente3'); ?>
				<br>Total <?php $api->funnel_pdp('div5',''); ?>
        </div>
            <div class='modal-footer'>
				<!--<button type='button' class='btn btn-primary' data-dismiss='modal' onclick='activa()'>Guardar</button>//-->
                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                
            </div>
        </div>
    </div>
</div>


<div class='modal fade' id='Vamos' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title' id='exampleModalLongTitle'>
					<button type='button' class='btn btn-success btn-xs'>A1</button> S/ <?php $api->getImpDesemb_pdp('Agente1'); ?> (<?php $api->getTotDesemb_pdp('Agente1'); ?>)
					
					<button type='button' class='btn btn-danger btn-xs'>A2</button> S/ <?php $api->getImpDesemb_pdp('Agente2'); ?> (<?php $api->getTotDesemb_pdp('Agente2'); ?>)
					<button type='button' class='btn btn-primary btn-xs'>A3</button> S/ <?php $api->getImpDesemb_pdp('Agente3'); ?> (<?php $api->getTotDesemb_pdp('Agente3'); ?>)
					</h5>
            </div>
        <div class='modal-body'>
				
							<?php $api->getListadoDesemb_pdp(); ?>
							<hr>				
				Total S/ <?php $api->getImpDesemb_pdp(''); ?> (<?php $api->getTotDesemb_pdp(''); ?>)				
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
  <title>Odisec - Lista de Leads</title>
  <meta name="description" content="Pdp - Listado de Leads">
  <meta name="author" content="SSDD">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<br>
<form action="login_pdp2?pagina=odisec_info" method="post" name="cuerpo" autocomplete="off">
  <div class="container-fluid">
    <input type="email" name="email" value="" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ingrese email">
  </div>
  <br>
  <div class="container-fluid">
    <input type="password" value="" name="password" class="form-control" id="exampleInputPassword1" placeholder="Ingrese Contraseña">
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


