<?php
include_once 'apipersonas.php';
$api = new ApiPersonas();

$fec_inicio = htmlspecialchars($_GET['fec_inicio']);
$fec_fin = htmlspecialchars($_GET['fec_fin']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Total vs Preaprobados</title>
    <!-- Importar chart.js -->
    <!--script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script//-->
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.rtl.min.css" integrity="sha384-OXTEbYDqaX2ZY/BOaZV/yFGChYHtrXH2nyXJ372n2Y8abBhrqacCEe+3qhSHtLjy" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	
	<style type="text/css">
	#myChart{
    max-width: 800px;
	max-height: 600px;
        }
	</style>

</head>
<body>

<table class="table table-responsive table-striped">
    <thead>
        <tr>
            <th>UTM</th>
            <th>Total</th>
            <th>Pre-aprobado</th>
        </tr>
    </thead>
    <tbody>
	 <?php $api->get_utm($fec_inicio, $fec_fin); ?>
	</tbody>
</table>

</body>
</html>

