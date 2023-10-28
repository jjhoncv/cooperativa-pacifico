<?php
session_start();

    
if (isset($_SESSION["acceso_pacinet"]))
{
        
    include_once 'apipersonas.php';

    $api = new ApiPersonas();
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Lista de Leads</title>
  <meta name="description" content="Listado de Leads">
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
    xmlhttp8.open("GET", "ajax_activa_digital?xiomi="+xiomi+"&kaori="+kaori+"&johann="+johann);
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
                <form action="lista" method="get" name="cuerpo" autocomplete="off">
                    <input type="text" name="keyword" id="keyword" aria-describedby="emailHelp" size="15" placeholder="Busca aquí">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </form>
                
            </th>
            <th class="text-right">
			<button type='button' class='btn btn-warning' data-toggle='modal' data-target='#Pendientes'>Trabajando</button>
			<button type='button' class='btn btn-warning' data-toggle='modal' data-target='#Utm'>UTM</button>
			<button type='button' class='btn btn-warning' data-toggle='modal' data-target='#Vamos'>Mes(0)</button>
			<button type='button' class='btn btn-warning' data-toggle='modal' data-target='#MPasado'>Mes(-1)</button>
			<button type='button' class='btn btn-warning' data-toggle='modal' data-target='#MAntePasado'>Mes(-2)</button>
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
    
    $api->getAll2(trim(htmlspecialchars($_GET['keyword'])));
    ?>
    
    
    </tbody>
</table>


<div class='modal fade' id='Vamos' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title' id='exampleModalLongTitle'>
					<button type='button' class='btn btn-success btn-xs'>XC</button> S/ <?php $api->getImpDesemb_persona('XIOMI'); ?> (<?php $api->getTotDesemb_persona('XIOMI'); ?>)
					
					<button type='button' class='btn btn-danger btn-xs'>KU</button> S/ <?php $api->getImpDesemb_persona('KAORI'); ?> (<?php $api->getTotDesemb_persona('KAORI'); ?>)
					<button type='button' class='btn btn-primary btn-xs'>JD</button> S/ <?php $api->getImpDesemb_persona('JOHANN'); ?> (<?php $api->getTotDesemb_persona('JOHANN'); ?>)
					</h5>
            </div>
        <div class='modal-body'>
				
							<?php $api->getListadoDesemb(); ?>
							<hr>				
				Total S/ <?php $api->getImpDesemb(); ?> (<?php $api->getTotDesemb(); ?>)				
            </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                
            </div>
        </div>
    </div>
</div>

<div class='modal fade' id='MPasado' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title' id='exampleModalLongTitle'>
					<button type='button' class='btn btn-success btn-xs'>XC</button> S/ <?php $api->getImpDesemb_persona_mpasado('XIOMI'); ?> (<?php $api->getTotDesemb_persona_mpasado('XIOMI'); ?>)
					
					<button type='button' class='btn btn-danger btn-xs'>KU</button> S/ <?php $api->getImpDesemb_persona_mpasado('KAORI'); ?> (<?php $api->getTotDesemb_persona_mpasado('KAORI'); ?>)
					<button type='button' class='btn btn-primary btn-xs'>JD</button> S/ <?php $api->getImpDesemb_persona_mpasado('JOHANN'); ?> (<?php $api->getTotDesemb_persona_mpasado('JOHANN'); ?>)
					</h5>
            </div>
        <div class='modal-body'>
				
							<?php $api->getListadoDesemb_mpasado(); ?>
							<hr>				
				Total S/ <?php $api->getImpDesemb_mpasado(); ?> (<?php $api->getTotDesemb_mpasado(); ?>)				
            </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                
            </div>
        </div>
    </div>
</div>

<div class='modal fade' id='MAntePasado' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title' id='exampleModalLongTitle'>
					<button type='button' class='btn btn-success btn-xs'>XC</button> S/ <?php $api->getImpDesemb_persona_mantepasado('XIOMI'); ?> (<?php $api->getTotDesemb_persona_mantepasado('XIOMI'); ?>)
					
					<button type='button' class='btn btn-danger btn-xs'>KU</button> S/ <?php $api->getImpDesemb_persona_mantepasado('KAORI'); ?> (<?php $api->getTotDesemb_persona_mantepasado('KAORI'); ?>)
					<button type='button' class='btn btn-primary btn-xs'>JD</button> S/ <?php $api->getImpDesemb_persona_mantepasado('JOHANN'); ?> (<?php $api->getTotDesemb_persona_mantepasado('JOHANN'); ?>)
					</h5>
            </div>
        <div class='modal-body'>
				
							<?php $api->getListadoDesemb_mantepasado(); ?>
							<hr>				
				Total S/ <?php $api->getImpDesemb_mantepasado(); ?> (<?php $api->getTotDesemb_mantepasado(); ?>)				
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
                Xiomi [<?php $api->tarjetasPendientes('XIOMI'); ?>] <?php $api->consulta_digital('Xiomi'); ?><br>
                Kaori [<?php $api->tarjetasPendientes('KAORI'); ?>] <?php $api->consulta_digital('Kaori'); ?><br>
                Johann [<?php $api->tarjetasPendientes('JOHANN'); ?>] <?php $api->consulta_digital('Johann'); ?><br><br>
				
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
                  <th scope="row">Xiomi</th>
                  <td class="text-center"><?php $api->getDataPreaprobados_personas(7,'Xiomi'); ?></td>
                  <td class="text-center"><?php $api->getDataPreaprobados_personas(1,'Xiomi'); ?></td>
                  <td class="text-center"><?php $api->getDataPreaprobados_personas(0,'Xiomi'); ?></td>
                </tr>
                <tr>
                  <th scope="row">Kaori</th>
                  <td class="text-center"><?php $api->getDataPreaprobados_personas(7,'Kaori'); ?></td>
                  <td class="text-center"><?php $api->getDataPreaprobados_personas(1,'Kaori'); ?></td>
                  <td class="text-center"><?php $api->getDataPreaprobados_personas(0,'Kaori'); ?></td>
                </tr>
                <tr>
                  <th scope="row">Johann</th>
                  <td class="text-center"><?php $api->getDataPreaprobados_personas(7,'Johann'); ?></td>
                  <td class="text-center"><?php $api->getDataPreaprobados_personas(1,'Johann'); ?></td>
                  <td class="text-center"><?php $api->getDataPreaprobados_personas(0,'Johann'); ?></td>
                </tr>
              </tbody>
            </table>
				
				<b>En verificaciones</b><br>
				<button type='button' class='btn btn-success btn-xs'>XC</button> <?php $api->funnel_digital('div4','Xiomi'); ?>
				<button type='button' class='btn btn-danger btn-xs'>KU</button> <?php $api->funnel_digital('div4','Kaori'); ?>
				<button type='button' class='btn btn-primary btn-xs'>JD</button> <?php $api->funnel_digital('div4','Johann'); ?>
				<br>Total <?php $api->funnel_digital('div4',''); ?>
				
				<br><br>
				<b>En Revision</b><br>
				<button type='button' class='btn btn-success btn-xs'>XC</button> <?php $api->funnel_digital('div3','Xiomi'); ?>
				<button type='button' class='btn btn-danger btn-xs'>KU</button> <?php $api->funnel_digital('div3','Kaori'); ?>
				<button type='button' class='btn btn-primary btn-xs'>JD</button> <?php $api->funnel_digital('div3','Johann'); ?>
				<br>Total <?php $api->funnel_digital('div3',''); ?>
				
				<br><br>
				<b>Firma de credito</b><br>
				<button type='button' class='btn btn-success btn-xs'>XC</button> <?php $api->funnel_digital('div5','Xiomi'); ?>
				<button type='button' class='btn btn-danger btn-xs'>KU</button> <?php $api->funnel_digital('div5','Kaori'); ?>
				<button type='button' class='btn btn-primary btn-xs'>JD</button> <?php $api->funnel_digital('div5','Johann'); ?>
				<br>Total <?php $api->funnel_digital('div5',''); ?>
        </div>
            <div class='modal-footer'>
				<button type='button' class='btn btn-primary' data-dismiss='modal' onclick='activa()'>Guardar</button>
                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                
            </div>
        </div>
    </div>
</div>


<div class='modal fade' id='Utm' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title' id='exampleModalLongTitle'>UTM</h5>
            </div>
        <div class='modal-body'>
          <table class="table table-responsive table-striped">
			<thead>
				<tr>
					<th>Mes actual</th>
					<th>TOT</th>
					<th>☑️</th>
					<th>-1</th>
					<th>☑️</th>
					<th>0</th>
					<th>☑️</th>
				</tr>
			</thead>
			<tbody>
			 <?php
			 date_default_timezone_set('America/Lima');
			 $mes_actual = date('Y-m');
			 $fec_inicio = $mes_actual . "-01";
			 $fec_fin = $mes_actual . "-31";
			 $api->get_utm($fec_inicio, $fec_fin); ?>
			</tbody>
		</table>      <br><br>
		<table class="table table-responsive table-striped table-warning">
			<thead>
				<tr>
					<th>Mes anterior</th>
					<th>Total</th>
					<th>Pre-aprobado</th>
				</tr>
			</thead>
			<tbody>
			 <?php
			 date_default_timezone_set('America/Lima');
			 $mes_pasado = date('Y-m', strtotime('first day of last month'));
			 $fec_inicio = $mes_pasado . "-01";
			 $fec_fin = $mes_pasado . "-31";
			 $api->get_utm_past($fec_inicio, $fec_fin); ?>
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
}else
{$msg = htmlspecialchars($_GET["msg"]);
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Lista de Leads</title>
  <meta name="description" content="Listado de Leads">
  <meta name="author" content="SSDD">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script integrity="sha384-xBuQ/xzmlsLoJpyjoggmTEz8OWUFM0/RC5BsqQBDX2v5cMvDHcMakNTNrHIW2I5f" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>

function nuevo(){
        
		var xmlhttp2 = new XMLHttpRequest();
		xmlhttp2.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("juego").innerHTML =
			this.responseText;
			}
		};
        xmlhttp2.open("GET", "ajax_pacinet?func=1&correo="+document.getElementById("correo1").value, true);
        xmlhttp2.send();
        
}	

function olvido(){
        
		var xmlhttp3 = new XMLHttpRequest();
		xmlhttp3.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("juego").innerHTML =
			this.responseText;
			}
		};
        xmlhttp3.open("GET", "ajax_pacinet?func=2&correo="+document.getElementById("correo2").value, true);
        xmlhttp3.send();
        
}	

</script>
</head>
<body>
<br>
<form action="login_usuario?pagina=lista" method="post" name="cuerpo" autocomplete="off">
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
	<div id='juego'><?php echo $msg; ?>&nbsp;</div>
  </div>
  <div class="container-fluid text-center">
	<button type='button' data-toggle='modal' data-target='#Crear' class='btn btn-outline-primary btn-xs'>Crear usuario</button> | 
	<button type='button' data-toggle='modal' data-target='#Olvido' class='btn btn-outline-primary btn-xs'>Olvido de clave</button>
  </div>
</form>


<div class='modal fade' id='Olvido' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h3 class='modal-title' id='exampleModalLongTitle'>
					Olvido de clave
					</h3>
            </div>
        <div class='modal-body'>
				
							<input type="text" name="correo2" id="correo2" size="45" placeholder="Ingresa tu correo de la Cooperativa Pacífico">
							
							<br><br>
							Se enviará un link para completar el proceso
            </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
				<button type='button' class='btn btn-primary' data-dismiss='modal' onclick='olvido()'>Guardar</button>
                
            </div>
        </div>
    </div>
</div>


</body>
</html>
<?php

}
?>


