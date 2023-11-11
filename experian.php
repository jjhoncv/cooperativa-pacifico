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
  <title>Experian</title>
  <meta name="description" content="Experian">
  <meta name="author" content="SSDD">
  <link integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script integrity="sha384-xBuQ/xzmlsLoJpyjoggmTEz8OWUFM0/RC5BsqQBDX2v5cMvDHcMakNTNrHIW2I5f" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
            <th><a class="btn btn-primary" href="csv.php" role="button">Descargar</a> <button type='button' class='btn btn-warning' data-toggle='modal' data-target='#Experian'>Funnel</button> <button type='button' class='btn btn-warning' data-toggle='modal' data-target='#Desembolsos'>Desembolsos</button> <button type='button' class='btn btn-warning' data-toggle='modal' data-target='#MPasado'>Mes Pasado</button> <button type='button' class='btn btn-warning' data-toggle='modal' data-target='#Leads'>Leads</button></th> 
            <th class="text-right"><a class="btn btn-danger" href="desconectar.php?pag=experian" role="button">Desconectar</a></th> 
        </td>
    </thead>
 </table>
 <table class="table table-responsive table-striped">
    <thead>
        <tr>
            <th> Fecha / Hora</th>
            <th>Nombre / DNI / Calificación</th>
            <th>Estado</th>
            <th>Celular / Correo</th>
        </tr>
    </thead>
    <tbody>
    <?php
    $api->getAll4();
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
				
							<?php $api->getListadoDesemb_exp('actual'); ?>
							<hr>				
				Total S/ <?php $api->getImpDesemb_exp('actual'); ?> (<?php $api->getTotDesemb_exp('actual'); ?>)				
            </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                
            </div>
        </div>
    </div>
</div>

<div class='modal fade' id='Leads' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title' id='exampleModalLongTitle'>
					<b>Leads dia x dia</b>
					</h5>
            </div>
        <div class='modal-body'>
		
			
			<table class="table table-bordered">
              <thead>
                <tr>
                  <th scope="col" class="table-success bg-warning">Mes</th>
                  <th scope="col" class="table-success text-center bg-warning">1</th>
                  <th scope="col" class="table-success text-center bg-warning">2</th>
                  <th scope="col" class="table-success text-center bg-warning">3</th>
				  <th scope="col" class="table-success text-center bg-warning">4</th>
				  <th scope="col" class="table-success text-center bg-warning">5</th>
				  <th scope="col" class="table-success text-center bg-warning">6</th>
				  <th scope="col" class="table-success text-center bg-warning">7</th>
				  <th scope="col" class="table-success text-center bg-warning">8</th>
				  <th scope="col" class="table-success text-center bg-warning">9</th>
				  <th scope="col" class="table-success text-center bg-warning">10</th>
				  <th scope="col" class="table-success text-center bg-warning">11</th>
                  <th scope="col" class="table-success text-center bg-warning">12</th>
                  <th scope="col" class="table-success text-center bg-warning">13</th>
				  <th scope="col" class="table-success text-center bg-warning">14</th>
				  <th scope="col" class="table-success text-center bg-warning">15</th>
			    </tr>
              </thead>
              <tbody>	
			  <tr>
                  <th scope="row" class="bg-success"><?php echo $_SESSION["mestot"]; ?></th>
                  <td class="text-center"><?php echo $_SESSION["dia1"]; ?></td>
                  <td class="text-center"><?php echo $_SESSION["dia2"]; ?></td>
                  <td class="text-center"><?php echo $_SESSION["dia3"]; ?></td>
				  <td class="text-center"><?php echo $_SESSION["dia4"]; ?></td>
				  <td class="text-center"><?php echo $_SESSION["dia5"]; ?></td>
				  <td class="text-center"><?php echo $_SESSION["dia6"]; ?></td>
                  <td class="text-center"><?php echo $_SESSION["dia7"]; ?></td>
                  <td class="text-center"><?php echo $_SESSION["dia8"]; ?></td>
				  <td class="text-center"><?php echo $_SESSION["dia9"]; ?></td>
				  <td class="text-center"><?php echo $_SESSION["dia10"]; ?></td>
				  <td class="text-center"><?php echo $_SESSION["dia11"]; ?></td>
                  <td class="text-center"><?php echo $_SESSION["dia12"]; ?></td>
                  <td class="text-center"><?php echo $_SESSION["dia13"]; ?></td>
				  <td class="text-center"><?php echo $_SESSION["dia14"]; ?></td>
				  <td class="text-center"><?php echo $_SESSION["dia15"]; ?></td>
				  
                </tr>
				<tr>
                  <th scope="col" class="table-success text-center bg-warning">16</th>
                  <th scope="col" class="table-success text-center bg-warning">17</th>
                  <th scope="col" class="table-success text-center bg-warning">18</th>
				  <th scope="col" class="table-success text-center bg-warning">19</th>
				  <th scope="col" class="table-success text-center bg-warning">20</th>
				  <th scope="col" class="table-success text-center bg-warning">21</th>
				  <th scope="col" class="table-success text-center bg-warning">22</th>
				  <th scope="col" class="table-success text-center bg-warning">23</th>
				  <th scope="col" class="table-success text-center bg-warning">24</th>
				  <th scope="col" class="table-success text-center bg-warning">25</th>
				  <th scope="col" class="table-success text-center bg-warning">26</th>
                  <th scope="col" class="table-success text-center bg-warning">27</th>
                  <th scope="col" class="table-success text-center bg-warning">28</th>
				  <th scope="col" class="table-success text-center bg-warning">29</th>
				  <th scope="col" class="table-success text-center bg-warning">30</th>
				  <th scope="col" class="table-success text-center bg-warning">31</th>
			    </tr>
				<tr>
                  <td class="text-center"><?php echo $_SESSION["dia16"]; ?></td>
                  <td class="text-center"><?php echo $_SESSION["dia17"]; ?></td>
                  <td class="text-center"><?php echo $_SESSION["dia18"]; ?></td>
                  <td class="text-center"><?php echo $_SESSION["dia19"]; ?></td>
				  <td class="text-center"><?php echo $_SESSION["dia20"]; ?></td>
				  <td class="text-center"><?php echo $_SESSION["dia21"]; ?></td>
				  <td class="text-center"><?php echo $_SESSION["dia22"]; ?></td>
                  <td class="text-center"><?php echo $_SESSION["dia23"]; ?></td>
                  <td class="text-center"><?php echo $_SESSION["dia24"]; ?></td>
				  <td class="text-center"><?php echo $_SESSION["dia25"]; ?></td>
				  <td class="text-center"><?php echo $_SESSION["dia26"]; ?></td>
				  <td class="text-center"><?php echo $_SESSION["dia27"]; ?></td>
                  <td class="text-center"><?php echo $_SESSION["dia28"]; ?></td>
                  <td class="text-center"><?php echo $_SESSION["dia29"]; ?></td>
				  <td class="text-center"><?php echo $_SESSION["dia30"]; ?></td>
				  <td class="text-center"><?php echo $_SESSION["dia31"]; ?></td>
				  
                </tr>
			</tbody>
			</table>
			
			<table class="table table-bordered">
              <thead>
                <tr>
                  <th scope="col" class="table-success bg-warning">Mes</th>
                  <th scope="col" class="table-success text-center bg-warning">1</th>
                  <th scope="col" class="table-success text-center bg-warning">2</th>
                  <th scope="col" class="table-success text-center bg-warning">3</th>
				  <th scope="col" class="table-success text-center bg-warning">4</th>
				  <th scope="col" class="table-success text-center bg-warning">5</th>
				  <th scope="col" class="table-success text-center bg-warning">6</th>
				  <th scope="col" class="table-success text-center bg-warning">7</th>
				  <th scope="col" class="table-success text-center bg-warning">8</th>
				  <th scope="col" class="table-success text-center bg-warning">9</th>
				  <th scope="col" class="table-success text-center bg-warning">10</th>
				  <th scope="col" class="table-success text-center bg-warning">11</th>
                  <th scope="col" class="table-success text-center bg-warning">12</th>
                  <th scope="col" class="table-success text-center bg-warning">13</th>
				  <th scope="col" class="table-success text-center bg-warning">14</th>
				  <th scope="col" class="table-success text-center bg-warning">15</th>
			    </tr>
              </thead>
              <tbody>	
			  <tr>
                  <th scope="row" class="bg-success"><?php echo $_SESSION["mestotx"]; ?></th>
                  <td class="text-center"><?php echo $_SESSION["dia1x"]; ?></td>
                  <td class="text-center"><?php echo $_SESSION["dia2x"]; ?></td>
                  <td class="text-center"><?php echo $_SESSION["dia3x"]; ?></td>
				  <td class="text-center"><?php echo $_SESSION["dia4x"]; ?></td>
				  <td class="text-center"><?php echo $_SESSION["dia5x"]; ?></td>
				  <td class="text-center"><?php echo $_SESSION["dia6x"]; ?></td>
                  <td class="text-center"><?php echo $_SESSION["dia7x"]; ?></td>
                  <td class="text-center"><?php echo $_SESSION["dia8x"]; ?></td>
				  <td class="text-center"><?php echo $_SESSION["dia9x"]; ?></td>
				  <td class="text-center"><?php echo $_SESSION["dia10x"]; ?></td>
				  <td class="text-center"><?php echo $_SESSION["dia11x"]; ?></td>
                  <td class="text-center"><?php echo $_SESSION["dia12x"]; ?></td>
                  <td class="text-center"><?php echo $_SESSION["dia13x"]; ?></td>
				  <td class="text-center"><?php echo $_SESSION["dia14x"]; ?></td>
				  <td class="text-center"><?php echo $_SESSION["dia15x"]; ?></td>
				  
                </tr>
				<tr>
                  <th scope="col" class="table-success text-center bg-warning">16</th>
                  <th scope="col" class="table-success text-center bg-warning">17</th>
                  <th scope="col" class="table-success text-center bg-warning">18</th>
				  <th scope="col" class="table-success text-center bg-warning">19</th>
				  <th scope="col" class="table-success text-center bg-warning">20</th>
				  <th scope="col" class="table-success text-center bg-warning">21</th>
				  <th scope="col" class="table-success text-center bg-warning">22</th>
				  <th scope="col" class="table-success text-center bg-warning">23</th>
				  <th scope="col" class="table-success text-center bg-warning">24</th>
				  <th scope="col" class="table-success text-center bg-warning">25</th>
				  <th scope="col" class="table-success text-center bg-warning">26</th>
                  <th scope="col" class="table-success text-center bg-warning">27</th>
                  <th scope="col" class="table-success text-center bg-warning">28</th>
				  <th scope="col" class="table-success text-center bg-warning">29</th>
				  <th scope="col" class="table-success text-center bg-warning">30</th>
				  <th scope="col" class="table-success text-center bg-warning">31</th>
			    </tr>
				<tr>
                  <td class="text-center"><?php echo $_SESSION["dia16x"]; ?></td>
                  <td class="text-center"><?php echo $_SESSION["dia17x"]; ?></td>
                  <td class="text-center"><?php echo $_SESSION["dia18x"]; ?></td>
                  <td class="text-center"><?php echo $_SESSION["dia19x"]; ?></td>
				  <td class="text-center"><?php echo $_SESSION["dia20x"]; ?></td>
				  <td class="text-center"><?php echo $_SESSION["dia21x"]; ?></td>
				  <td class="text-center"><?php echo $_SESSION["dia22x"]; ?></td>
                  <td class="text-center"><?php echo $_SESSION["dia23x"]; ?></td>
                  <td class="text-center"><?php echo $_SESSION["dia24x"]; ?></td>
				  <td class="text-center"><?php echo $_SESSION["dia25x"]; ?></td>
				  <td class="text-center"><?php echo $_SESSION["dia26x"]; ?></td>
				  <td class="text-center"><?php echo $_SESSION["dia27x"]; ?></td>
                  <td class="text-center"><?php echo $_SESSION["dia28x"]; ?></td>
                  <td class="text-center"><?php echo $_SESSION["dia29x"]; ?></td>
				  <td class="text-center"><?php echo $_SESSION["dia30x"]; ?></td>
				  <td class="text-center"><?php echo $_SESSION["dia31x"]; ?></td>
				  
                </tr>
			</tbody>	
			</table>

			<table class="table table-bordered">
              <thead>
                <tr>
                  <th scope="col" class="table-success bg-warning">Mes</th>
                  <th scope="col" class="table-success text-center bg-warning">1</th>
                  <th scope="col" class="table-success text-center bg-warning">2</th>
                  <th scope="col" class="table-success text-center bg-warning">3</th>
				  <th scope="col" class="table-success text-center bg-warning">4</th>
				  <th scope="col" class="table-success text-center bg-warning">5</th>
				  <th scope="col" class="table-success text-center bg-warning">6</th>
				  <th scope="col" class="table-success text-center bg-warning">7</th>
				  <th scope="col" class="table-success text-center bg-warning">8</th>
				  <th scope="col" class="table-success text-center bg-warning">9</th>
				  <th scope="col" class="table-success text-center bg-warning">10</th>
				  <th scope="col" class="table-success text-center bg-warning">11</th>
                  <th scope="col" class="table-success text-center bg-warning">12</th>
                  <th scope="col" class="table-success text-center bg-warning">13</th>
				  <th scope="col" class="table-success text-center bg-warning">14</th>
				  <th scope="col" class="table-success text-center bg-warning">15</th>
			    </tr>
              </thead>
              <tbody>	
			  <tr>
                  <th scope="row" class="bg-success"><?php echo $_SESSION["mestotxx"]; ?></th>
                  <td class="text-center"><?php echo $_SESSION["dia1xx"]; ?></td>
                  <td class="text-center"><?php echo $_SESSION["dia2xx"]; ?></td>
                  <td class="text-center"><?php echo $_SESSION["dia3xx"]; ?></td>
				  <td class="text-center"><?php echo $_SESSION["dia4xx"]; ?></td>
				  <td class="text-center"><?php echo $_SESSION["dia5xx"]; ?></td>
				  <td class="text-center"><?php echo $_SESSION["dia6xx"]; ?></td>
                  <td class="text-center"><?php echo $_SESSION["dia7xx"]; ?></td>
                  <td class="text-center"><?php echo $_SESSION["dia8xx"]; ?></td>
				  <td class="text-center"><?php echo $_SESSION["dia9xx"]; ?></td>
				  <td class="text-center"><?php echo $_SESSION["dia10xx"]; ?></td>
				  <td class="text-center"><?php echo $_SESSION["dia11xx"]; ?></td>
                  <td class="text-center"><?php echo $_SESSION["dia12xx"]; ?></td>
                  <td class="text-center"><?php echo $_SESSION["dia13xx"]; ?></td>
				  <td class="text-center"><?php echo $_SESSION["dia14xx"]; ?></td>
				  <td class="text-center"><?php echo $_SESSION["dia15xx"]; ?></td>
				  
                </tr>
				<tr>
                  <th scope="col" class="table-success text-center bg-warning">16</th>
                  <th scope="col" class="table-success text-center bg-warning">17</th>
                  <th scope="col" class="table-success text-center bg-warning">18</th>
				  <th scope="col" class="table-success text-center bg-warning">19</th>
				  <th scope="col" class="table-success text-center bg-warning">20</th>
				  <th scope="col" class="table-success text-center bg-warning">21</th>
				  <th scope="col" class="table-success text-center bg-warning">22</th>
				  <th scope="col" class="table-success text-center bg-warning">23</th>
				  <th scope="col" class="table-success text-center bg-warning">24</th>
				  <th scope="col" class="table-success text-center bg-warning">25</th>
				  <th scope="col" class="table-success text-center bg-warning">26</th>
                  <th scope="col" class="table-success text-center bg-warning">27</th>
                  <th scope="col" class="table-success text-center bg-warning">28</th>
				  <th scope="col" class="table-success text-center bg-warning">29</th>
				  <th scope="col" class="table-success text-center bg-warning">30</th>
				  <th scope="col" class="table-success text-center bg-warning">31</th>
			    </tr>
				<tr>
                  <td class="text-center"><?php echo $_SESSION["dia16xx"]; ?></td>
                  <td class="text-center"><?php echo $_SESSION["dia17xx"]; ?></td>
                  <td class="text-center"><?php echo $_SESSION["dia18xx"]; ?></td>
                  <td class="text-center"><?php echo $_SESSION["dia19xx"]; ?></td>
				  <td class="text-center"><?php echo $_SESSION["dia20xx"]; ?></td>
				  <td class="text-center"><?php echo $_SESSION["dia21xx"]; ?></td>
				  <td class="text-center"><?php echo $_SESSION["dia22xx"]; ?></td>
                  <td class="text-center"><?php echo $_SESSION["dia23xx"]; ?></td>
                  <td class="text-center"><?php echo $_SESSION["dia24xx"]; ?></td>
				  <td class="text-center"><?php echo $_SESSION["dia25xx"]; ?></td>
				  <td class="text-center"><?php echo $_SESSION["dia26xx"]; ?></td>
				  <td class="text-center"><?php echo $_SESSION["dia27xx"]; ?></td>
                  <td class="text-center"><?php echo $_SESSION["dia28xx"]; ?></td>
                  <td class="text-center"><?php echo $_SESSION["dia29xx"]; ?></td>
				  <td class="text-center"><?php echo $_SESSION["dia30xx"]; ?></td>
				  <td class="text-center"><?php echo $_SESSION["dia31xx"]; ?></td>
				  
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

<div class='modal fade' id='MPasado' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title' id='exampleModalLongTitle'>
					<b>Total Desembolsados Mes Pasado</b>
					</h5>
            </div>
        <div class='modal-body'>
				
							<?php $api->getListadoDesemb_exp('pasado'); ?>
							<hr>				
				Total S/ <?php $api->getImpDesemb_exp('pasado'); ?> (<?php $api->getTotDesemb_exp('pasado'); ?>)				
            </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                
            </div>
        </div>
    </div>
</div>

<div class='modal fade' id='Experian' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title' id='exampleModalLongTitle'><b>Funel</b></h5>
            </div>
        <div class='modal-body'>
 				<b><u>Por contactar S/ <?php $api->funnel_experian('div1'); ?></u></b> <br>
				<b><u>Enviando documentos S/ <?php $api->funnel_experian('div2'); ?></u></b><br>
				<?php $api->funnel_experian_lista_api('div2'); ?><br>
				<b><u>Verificaciones S/ <?php $api->funnel_experian('div4'); ?></u></b><br>
				<?php $api->funnel_experian_lista_api('div4'); ?><br>
				<b><u>File en Agencia S/ <?php $api->funnel_experian('div3'); ?></u></b><br>
				<?php $api->funnel_experian_lista_api('div3'); ?><br>
				<b><u>Programado para Firma S/ <?php $api->funnel_experian('div5'); ?></u></b><br>
				<?php $api->funnel_experian_lista_api('div5'); ?><br>

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
  <title>Experian</title>
  <meta name="description" content="Experian">
  <meta name="author" content="SSDD">
  <link integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script integrity="sha384-xBuQ/xzmlsLoJpyjoggmTEz8OWUFM0/RC5BsqQBDX2v5cMvDHcMakNTNrHIW2I5f" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<br>
<form action="login" method="post" name="cuerpo" autocomplete="off">
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
//$_SESSION["login"] = "OK";

}
?>


