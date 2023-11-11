<?php
session_start();

    
    if (isset($_SESSION["login"]))
    {
        
    include_once 'apipersonas_pdp.php';

    $api = new ApiPersonas();
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Pdp - Lista de Leads</title>
  <meta name="description" content="Pdp - Listado de Leads">
  <meta name="author" content="SSDD">
  <link integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap.css">
<script integrity="sha384-xBuQ/xzmlsLoJpyjoggmTEz8OWUFM0/RC5BsqQBDX2v5cMvDHcMakNTNrHIW2I5f" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
function activa(){
	
	marco = document.getElementById("Marco").checked;
	alina = document.getElementById("Alina").checked;
	carlos = document.getElementById("Carlos").checked;

	var xmlhttp8 = new XMLHttpRequest();
    xmlhttp8.open("GET", "ajax_pdp?func=4&marco="+marco+"&alina="+alina+"&carlos="+carlos);
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
    xmlhttp1.open("GET", "delete?tabla=Pdp&id="+id);
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
                <form action="pdp_info" method="get" name="cuerpo" autocomplete="off">
                    <input type="text" name="keyword" id="keyword" aria-describedby="emailHelp" size="15" placeholder="Busca aquí">
                    <button type="submit" class="btn btn-primary">Buscar</button>
					<input type="password" name="clave" id="clave" value="" placeholder="Ingresa clave">
                </form>
                
            </th>
            <th class="text-right">
			<button type='button' class='btn btn-success' data-toggle='modal' data-target='#TotalPLD'>PLD Funnel</button>
			<button type='button' class='btn btn-success' data-toggle='modal' data-target='#TotalPDP'>PDP Funnel</button>
			<button type='button' class='btn btn-warning' data-toggle='modal' data-target='#Vamos'>Desembolsado CP</button> <a class="btn btn-danger" href="desconectar?pag=pdp_info" role="button">Desconectar</a></th> 
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

<div class='modal fade' id='TotalPLD' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h3 class='modal-title' id='exampleModalLongTitle'>PLD Funnel</h3>
            </div>
        <div class='modal-body'>
       		<table class="table table-bordered">
              <thead>
                <tr>
                  <th scope="col" class="table-success bg-warning">FFVV</th>
                  <th scope="col" class="table-success text-center bg-warning">Verif</th>
                  <th scope="col" class="table-success text-center bg-warning">UEC</th>
                  <th scope="col" class="table-success text-center bg-warning">Aprob</th>
				  <th scope="col" class="table-success text-center bg-warning">Desemb</th>
				  <th scope="col" class="table-success text-center bg-danger">Total x canal</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row" class="bg-success">CP</th>
                  <td class="text-center"><?php $api->funnel_pdp('div3','','PLD'); ?></td>
                  <td class="text-center"><?php $api->funnel_pdp('div4','','PLD'); ?></td>
                  <td class="text-center"><?php $api->funnel_pdp('div5','','PLD'); ?></td>
				  <td class="text-center bg-primary"><b><?php $api->funnel_pdp('div6','','PLD'); ?></b></td>
				  <td class="text-center"><?php $api->funnel_pdp_tot('Pdp','PLD'); ?></td>
                </tr>
				<tr>
                  <th scope="row" class="bg-success">O&M</th>
                  <td class="text-center"><?php $api->funnel_pdp_prov('div3','','Om','PLD'); ?></td>
                  <td class="text-center"><?php $api->funnel_pdp_prov('div4','','Om','PLD'); ?></td>
                  <td class="text-center"><?php $api->funnel_pdp_prov('div5','','Om','PLD'); ?></td>
				  <td class="text-center bg-primary"><b><?php $api->funnel_pdp_prov('div6','','Om','PLD'); ?></b></td>
				  <td class="text-center"><?php $api->funnel_pdp_tot('Om','PLD'); ?></td>
                </tr>
				<tr>
                  <th scope="row" class="bg-success">Lego</th>
                  <td class="text-center"><?php $api->funnel_pdp_prov('div3','','Abi','PLD'); ?></td>
                  <td class="text-center"><?php $api->funnel_pdp_prov('div4','','Abi','PLD'); ?></td>
                  <td class="text-center"><?php $api->funnel_pdp_prov('div5','','Abi','PLD'); ?></td>
				  <td class="text-center bg-primary"><b><?php $api->funnel_pdp_prov('div6','','Abi','PLD'); ?></b></td>
				  <td class="text-center"><?php $api->funnel_pdp_tot('Abi','PLD'); ?></td>
                </tr>
				<tr>
                  <th scope="row" class="bg-success">Odisec</th>
                  <td class="text-center"><?php $api->funnel_pdp_prov('div3','','Credimaq','PLD'); ?></td>
                  <td class="text-center"><?php $api->funnel_pdp_prov('div4','','Credimaq','PLD'); ?></td>
                  <td class="text-center"><?php $api->funnel_pdp_prov('div5','','Credimaq','PLD'); ?></td>
				  <td class="text-center bg-primary"><b><?php $api->funnel_pdp_prov('div6','','Credimaq','PLD'); ?></b></td>
				  <td class="text-center"><?php $api->funnel_pdp_tot('Credimaq','PLD'); ?></td>
                </tr>
				<tr>
                  <th scope="row" class="bg-success">Total</th>
                  <td class="text-center"><b><?php $api->funnel_pdp_total('div3','PLD'); ?></b></td>
                  <td class="text-center"><b><?php $api->funnel_pdp_total('div4','PLD'); ?></b></td>
                  <td class="text-center"><b><?php $api->funnel_pdp_total('div5','PLD'); ?></b></td>
				  <td class="text-center bg-primary"><b><?php $api->funnel_pdp_total('div6','PLD'); ?></b></td>
				  <td class="text-center bg-warning"><?php $api->funnel_pdp_total2('PLD'); ?></td>
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


<div class='modal fade' id='TotalPDP' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h3 class='modal-title' id='exampleModalLongTitle'>PDP Funnel</h3>
            </div>
        <div class='modal-body'>
       		<table class="table table-bordered">
              <thead>
                <tr>
                  <th scope="col" class="table-success bg-warning">FFVV</th>
                  <th scope="col" class="table-success text-center bg-warning">Verif</th>
                  <th scope="col" class="table-success text-center bg-warning">UEC</th>
                  <th scope="col" class="table-success text-center bg-warning">Aprob</th>
				  <th scope="col" class="table-success text-center bg-warning">Desemb</th>
				  <th scope="col" class="table-success text-center bg-danger">Total x canal</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row" class="bg-success">CP</th>
                  <td class="text-center"><?php $api->funnel_pdp('div3','','PDP'); ?></td>
                  <td class="text-center"><?php $api->funnel_pdp('div4','','PDP'); ?></td>
                  <td class="text-center"><?php $api->funnel_pdp('div5','','PDP'); ?></td>
				  <td class="text-center bg-primary"><b><?php $api->funnel_pdp('div6','','PDP'); ?></b></td>
				  <td class="text-center"><?php $api->funnel_pdp_tot('Pdp','PDP'); ?></td>
                </tr>
				<tr>
                  <th scope="row" class="bg-success">O&M</th>
                  <td class="text-center"><?php $api->funnel_pdp_prov('div3','','Om','PDP'); ?></td>
                  <td class="text-center"><?php $api->funnel_pdp_prov('div4','','Om','PDP'); ?></td>
                  <td class="text-center"><?php $api->funnel_pdp_prov('div5','','Om','PDP'); ?></td>
				  <td class="text-center bg-primary"><b><?php $api->funnel_pdp_prov('div6','','Om','PDP'); ?></b></td>
				  <td class="text-center"><?php $api->funnel_pdp_tot('Om','PDP'); ?></td>
                </tr>
				<tr>
                  <th scope="row" class="bg-success">Lego</th>
                  <td class="text-center"><?php $api->funnel_pdp_prov('div3','','Abi','PDP'); ?></td>
                  <td class="text-center"><?php $api->funnel_pdp_prov('div4','','Abi','PDP'); ?></td>
                  <td class="text-center"><?php $api->funnel_pdp_prov('div5','','Abi','PDP'); ?></td>
				  <td class="text-center bg-primary"><b><?php $api->funnel_pdp_prov('div6','','Abi','PDP'); ?></b></td>
				  <td class="text-center"><?php $api->funnel_pdp_tot('Abi','PDP'); ?></td>
                </tr>
				<tr>
                  <th scope="row" class="bg-success">Odisec</th>
                  <td class="text-center"><?php $api->funnel_pdp_prov('div3','','Credimaq','PDP'); ?></td>
                  <td class="text-center"><?php $api->funnel_pdp_prov('div4','','Credimaq','PDP'); ?></td>
                  <td class="text-center"><?php $api->funnel_pdp_prov('div5','','Credimaq','PDP'); ?></td>
				  <td class="text-center bg-primary"><b><?php $api->funnel_pdp_prov('div6','','Credimaq','PDP'); ?></b></td>
				  <td class="text-center"><?php $api->funnel_pdp_tot('Credimaq','PDP'); ?></td>
                </tr>
				<tr>
                  <th scope="row" class="bg-success">Total</th>
                  <td class="text-center"><b><?php $api->funnel_pdp_total('div3','PDP'); ?></b></td>
                  <td class="text-center"><b><?php $api->funnel_pdp_total('div4','PDP'); ?></b></td>
                  <td class="text-center"><b><?php $api->funnel_pdp_total('div5','PDP'); ?></b></td>
				  <td class="text-center bg-primary"><b><?php $api->funnel_pdp_total('div6','PDP'); ?></b></td>
				  <td class="text-center bg-warning"><?php $api->funnel_pdp_total2('PDP'); ?></td>
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


<div class='modal fade' id='Vamos' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title' id='exampleModalLongTitle'>
					<button type='button' class='btn btn-success btn-xs'>MS</button> S/ <?php $api->getImpDesemb_pdp('Marco'); ?> (<?php $api->getTotDesemb_pdp('Marco'); ?>)
					
					<button type='button' class='btn btn-danger btn-xs'>AJ</button> S/ <?php $api->getImpDesemb_pdp('Alina'); ?> (<?php $api->getTotDesemb_pdp('Alina'); ?>)
					<button type='button' class='btn btn-primary btn-xs'>CZ</button> S/ <?php $api->getImpDesemb_pdp('Carlos'); ?> (<?php $api->getTotDesemb_pdp('Carlos'); ?>)
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
  <title>Pdp - Lista de Leads</title>
  <meta name="description" content="Pdp - Listado de Leads">
  <meta name="author" content="SSDD">
  <link integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script integrity="sha384-xBuQ/xzmlsLoJpyjoggmTEz8OWUFM0/RC5BsqQBDX2v5cMvDHcMakNTNrHIW2I5f" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<br>
<form action="login_pdp" method="post" name="cuerpo" autocomplete="off">
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


