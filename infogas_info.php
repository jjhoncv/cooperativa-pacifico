<?php
session_start();

    
    if (isset($_SESSION["login"]))
    {
        
    include_once 'apipersonas_infogas.php';

    $api = new ApiPersonas();
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Infogas - Lista de Leads</title>
  <meta name="description" content="Infogas - Listado de Leads">
  <meta name="author" content="SSDD">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap.css">
<script integrity="sha384-xBuQ/xzmlsLoJpyjoggmTEz8OWUFM0/RC5BsqQBDX2v5cMvDHcMakNTNrHIW2I5f" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
function activa(){
	
	xiomi = document.getElementById("Xiomi").checked;
	kaori = document.getElementById("Kaori").checked;
	johann = document.getElementById("Johann").checked;

	var xmlhttp8 = new XMLHttpRequest();
    xmlhttp8.open("GET", "ajax_infogas?func=4&xiomi="+xiomi+"&kaori="+kaori+"&johann="+johann);
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
                <form action="infogas_info" method="get" name="cuerpo" autocomplete="off">
                    <input type="text" name="keyword" id="keyword" aria-describedby="emailHelp" size="15" placeholder="Busca aquí">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </form>
                
            </th>
            <th class="text-right">
			<button type='button' class='btn btn-warning' data-toggle='modal' data-target='#Pendientes'>Trabajando</button>
			<button type='button' class='btn btn-warning' data-toggle='modal' data-target='#Vamos'>Desembolsado</button> <a class="btn btn-danger" href="desconectar?pag=infogas_info" role="button">Desconectar</a></th> 
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
    
    $api->getAll_infogas(trim(htmlspecialchars($_GET['keyword'])));
    ?>
    
    
    </tbody>
</table>



<div class='modal fade' id='Pendientes' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title' id='exampleModalLongTitle'>Tarjetas trabajando por Funcionario + Funnel</h5>
            </div>
        <div class='modal-body'>
                Alvaro [<?php $api->tarjetasPendientes('ALVARO'); ?>] <?php $api->consulta_micro('Alvaro'); ?><br>
                Kaori [<?php $api->tarjetasPendientes('KAORI'); ?>] <?php $api->consulta_micro('Kaori'); ?><br>
                Johann [<?php $api->tarjetasPendientes('JOHANN'); ?>] <?php $api->consulta_micro('Johann'); ?><br><br>
				
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
                  <th scope="row">Alvaro</th>
                  <td class="text-center"><?php $api->getDataPreaprobados_infogas(7,'Alvaro'); ?></td>
                  <td class="text-center"><?php $api->getDataPreaprobados_infogas(1,'Alvaro'); ?></td>
                  <td class="text-center"><?php $api->getDataPreaprobados_infogas(0,'Alvaro'); ?></td>
                </tr>
                <tr>
                  <th scope="row">Kaori</th>
                  <td class="text-center"><?php $api->getDataPreaprobados_infogas(7,'Kaori'); ?></td>
                  <td class="text-center"><?php $api->getDataPreaprobados_infogas(1,'Kaori'); ?></td>
                  <td class="text-center"><?php $api->getDataPreaprobados_infogas(0,'Kaori'); ?></td>
                </tr>
                <tr>
                  <th scope="row">Johann</th>
                  <td class="text-center"><?php $api->getDataPreaprobados_infogas(7,'Johann'); ?></td>
                  <td class="text-center"><?php $api->getDataPreaprobados_infogas(1,'Johann'); ?></td>
                  <td class="text-center"><?php $api->getDataPreaprobados_infogas(0,'Johann'); ?></td>
                </tr>
              </tbody>
            </table>
				
				<b>En verificaciones</b><br>
				<button type='button' class='btn btn-success btn-xs'>XC</button> <?php $api->funnel_micro('div3','Alvaro'); ?>
				<button type='button' class='btn btn-danger btn-xs'>KU</button> <?php $api->funnel_micro('div3','Kaori'); ?>
				<button type='button' class='btn btn-primary btn-xs'>JD</button> <?php $api->funnel_micro('div3','Johann'); ?>
				<br>Total <?php $api->funnel_micro('div3',''); ?>
				
				<br><br>
				<b>En Revision</b><br>
				<button type='button' class='btn btn-success btn-xs'>XC</button> <?php $api->funnel_micro('div4','Alvaro'); ?>
				<button type='button' class='btn btn-danger btn-xs'>KU</button> <?php $api->funnel_micro('div4','Kaori'); ?>
				<button type='button' class='btn btn-primary btn-xs'>JD</button> <?php $api->funnel_micro('div4','Johann'); ?>
				<br>Total <?php $api->funnel_micro('div4',''); ?>
				
				<br><br>
				<b>Firma de credito</b><br>
				<button type='button' class='btn btn-success btn-xs'>XC</button> <?php $api->funnel_micro('div5','Alvaro'); ?>
				<button type='button' class='btn btn-danger btn-xs'>KU</button> <?php $api->funnel_micro('div5','Kaori'); ?>
				<button type='button' class='btn btn-primary btn-xs'>JD</button> <?php $api->funnel_micro('div5','Johann'); ?>
				<br>Total <?php $api->funnel_micro('div5',''); ?>
        </div>
            <div class='modal-footer'>
				<button type='button' class='btn btn-primary' data-dismiss='modal' onclick='activa()'>Guardar</button>
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
					<button type='button' class='btn btn-success btn-xs'>XC</button> S/ <?php $api->getImpDesemb_infogas('ALVARO'); ?> (<?php $api->getTotDesemb_infogas('ALVARO'); ?>)
					
					<button type='button' class='btn btn-danger btn-xs'>KU</button> S/ <?php $api->getImpDesemb_infogas('KAORI'); ?> (<?php $api->getTotDesemb_infogas('KAORI'); ?>)
					<button type='button' class='btn btn-primary btn-xs'>JD</button> S/ <?php $api->getImpDesemb_infogas('JOHANN'); ?> (<?php $api->getTotDesemb_infogas('JOHANN'); ?>)
					</h5>
            </div>
        <div class='modal-body'>
				
							<?php $api->getListadoDesemb_infogas(); ?>
							<hr>				
				Total S/ <?php $api->getImpDesemb_infogas(''); ?> (<?php $api->getTotDesemb_infogas(''); ?>)				
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
  <title>Infogas - Lista de Leads</title>
  <meta name="description" content="Infogas - Listado de Leads">
  <meta name="author" content="SSDD">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script integrity="sha384-xBuQ/xzmlsLoJpyjoggmTEz8OWUFM0/RC5BsqQBDX2v5cMvDHcMakNTNrHIW2I5f" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<br>
<form action="login_infogas" method="post" name="cuerpo" autocomplete="off">
  <div class="container-fluid">
    <input type="email" name="email" value="admin@cp.com.pe" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ingrese email">
  </div>
  <br>
  <div class="container-fluid">
    <input type="password" value="digital01" name="password" class="form-control" id="exampleInputPassword1" placeholder="Ingrese Contraseña">
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


