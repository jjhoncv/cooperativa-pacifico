<?php
include_once 'apipersonas.php';
$api = new ApiPersonas();

$label = $_POST["rango"];

if ($label==null)
    $label=8;

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
<form name="cuerpo" action="grafico" method="post" onChange="this.submit()">
<div class="container">
    <div class="row">
        <div class="col-8">
            <canvas id="myChart"></canvas>
        </div>  
        <div class="col-4">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th scope="col" class="table-success">Funcionario</th>
                  <th scope="col" class="table-success">PRE-OK</th>
                  <th scope="col" class="table-success">Ayer</th>
                  <th scope="col" class="table-success">Hoy</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row">Xiomi</th>
                  <td><?php $api->getDataPreaprobadosXiomi_t($label); ?></td>
                  <td><?php $api->getDataPreaprobadosXiomi_t(1); ?></td>
                  <td><?php $api->getDataPreaprobados_hoy('Xiomi'); ?></td>
                </tr>
                <tr>
                  <th scope="row">Kaori</th>
                  <td><?php $api->getDataPreaprobadosKaori_t($label); ?></td>
                  <td><?php $api->getDataPreaprobadosKaori_t(1); ?></td>
                  <td><?php $api->getDataPreaprobados_hoy('Kaori'); ?></td>
                </tr>
                <tr>
                  <th scope="row">Johann</th>
                  <td><?php $api->getDataPreaprobadosJohann_t($label); ?></td>
                  <td><?php $api->getDataPreaprobadosJohann_t(1); ?></td>
                  <td><?php $api->getDataPreaprobados_hoy('Johann'); ?></td>
                </tr>
              </tbody>
            </table>
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th scope="col" class="table-primary">UTM</th>
                  <th scope="col" class="table-primary">Últimos <?php echo $label; ?> días</th>
                  <th scope="col" class="table-primary">Ayer</th>
                  <th scope="col" class="table-primary">Hoy</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row">Google</th>
                  <td class="text-center"><?php $api->getDataLeads_t($label, 'ads_smart'); ?>/<?php $api->getDataPreaprobados_t($label, 'ads_smart'); ?></td>
                  <td><?php $api->getDataLeads_t(1, 'ads_smart'); ?>/<?php $api->getDataPreaprobados_t(1, 'ads_smart'); ?></td>
                  <td>[<?php $api->getDataLeads_hoy('ads_smart'); ?>/<?php $api->getDataPreaprobados_utm_hoy('ads_smart'); ?>]</td>
                </tr>
                <tr>
                  <th scope="row">Comparabien</th>
                  <td class="text-center"><?php $api->getDataLeads_t($label, 'cb'); ?>/<?php $api->getDataPreaprobados_t($label, 'cb'); ?></td>
                  <td><?php $api->getDataLeads_t(1, 'cb'); ?>/<?php $api->getDataPreaprobados_t(1, 'cb'); ?></td>
                  <td>[<?php $api->getDataLeads_hoy('cb'); ?>/<?php $api->getDataPreaprobados_utm_hoy('cb'); ?>]</td>
                </tr>
                <tr>
                  <th scope="row">Experian</th>
                  <td class="text-center"><?php $api->getDataLeads_t($label, 'exp'); ?>/<?php $api->getDataPreaprobados_t($label, 'exp'); ?></td>
                  <td><?php $api->getDataLeads_t(1, 'exp'); ?>/<?php $api->getDataPreaprobados_t(1, 'exp'); ?></td>
                  <td>[<?php $api->getDataLeads_hoy('exp'); ?>/<?php $api->getDataPreaprobados_utm_hoy('exp'); ?>]</td>
                </tr>
                <tr>
                  <th scope="row">Wsp</th>
                  <td class="text-center"><?php $api->getDataLeads_t($label, 'wsp'); ?>/<?php $api->getDataPreaprobados_t($label, 'wsp'); ?></td>
                  <td><?php $api->getDataLeads_t(1, 'wsp'); ?>/<?php $api->getDataPreaprobados_t(1, 'wsp'); ?></td>
                  <td>[<?php $api->getDataLeads_hoy('wsp'); ?>/<?php $api->getDataPreaprobados_utm_hoy('wsp'); ?>]</td>
                </tr>
                <tr>
                  <th scope="row">Organico</th>
                  <td class="text-center"><?php $api->getDataLeads_t2($label, 'buscador', 'organico'); ?>/<?php $api->getDataPreaprobados_t2($label, 'buscador', 'organico'); ?></td>
                  <td><?php $api->getDataLeads_t2(1, 'buscador', 'organico'); ?>/<?php $api->getDataPreaprobados_t2(1, 'buscador', 'organico'); ?></td>
                  <td>[<?php $api->getDataLeads_hoy2('buscador','organico'); ?>/<?php $api->getDataPreaprobados_utm_hoy2('buscador','organico'); ?>]</td>
                </tr>
                <tr>
                  <th scope="row">Instagram</th>
                  <td class="text-center"><?php $api->getDataLeads_t($label, 'ig_organico'); ?>/<?php $api->getDataPreaprobados_t($label, 'ig_organico'); ?></td>
                  <td><?php $api->getDataLeads_t(1, 'ig_organico'); ?>/<?php $api->getDataPreaprobados_t(1, 'ig_organico'); ?></td>
                  <td>[<?php $api->getDataLeads_hoy('ig_organico'); ?>/<?php $api->getDataPreaprobados_utm_hoy('ig_organico'); ?>]</td>
                </tr>
                <tr>
                  <th scope="row">Google 2</th>
                  <td class="text-center"><?php $api->getDataLeads_t($label, 'ads_digital'); ?>/<?php $api->getDataPreaprobados_t($label, 'ads_digital'); ?></td>
                  <td><?php $api->getDataLeads_t(1, 'ads_digital'); ?>/<?php $api->getDataPreaprobados_t(1, 'ads_digital'); ?></td>
                  <td>[<?php $api->getDataLeads_hoy('ads_digital'); ?>/<?php $api->getDataPreaprobados_utm_hoy('ads_digital'); ?>]</td>
                </tr>
				<tr>
                  <th scope="row">SMS Nov</th>
                  <td class="text-center"><?php $api->getDataLeads_t($label, 'sms_nov'); ?>/<?php $api->getDataPreaprobados_t($label, 'sms_nov'); ?></td>
                  <td><?php $api->getDataLeads_t(1, 'sms_nov'); ?>/<?php $api->getDataPreaprobados_t(1, 'sms_nov'); ?></td>
                  <td>[<?php $api->getDataLeads_hoy('sms_nov'); ?>/<?php $api->getDataPreaprobados_utm_hoy('sms_nov'); ?>]</td>
                </tr>
				<tr>
                  <th scope="row">SMS Dic</th>
                  <td class="text-center"><?php $api->getDataLeads_t($label, 'sms_dic'); ?>/<?php $api->getDataPreaprobados_t($label, 'sms_dic'); ?></td>
                  <td><?php $api->getDataLeads_t(1, 'sms_dic'); ?>/<?php $api->getDataPreaprobados_t(1, 'sms_dic'); ?></td>
                  <td>[<?php $api->getDataLeads_hoy('sms_dic'); ?>/<?php $api->getDataPreaprobados_utm_hoy('sms_dic'); ?>]</td>
                </tr>				
              </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col">
             <select class="form-control" id="rango" name="rango">
                    <option>Escoge uno</option>
                    <option value="7">Últimos 7 días</option>
                    <option value="14">Últimos 14 días</option>
                    <option value="30">Últimos 30 días</option>
                    <option value="60">Últimos 60 días</option>
                    <option value="180">Últimos 180 días</option>
                    <option value="2">Ultimos 2 días</option>
            </select>
        </div>
        <div class="col">
            <a class="btn btn-success" href="lista" role="button">Volver</a>
        </div>
     </div>
</div>  
    
</form>
    
<script>
  const labels = [
    <?php $api->getLabels($label); ?>
  ];

  const data = {
    labels: labels,
    datasets: [{
      label: 'Leads',
      backgroundColor: 'rgb(255, 99, 132)',
      borderColor: 'rgb(255, 99, 132)',
       <?php $api->getDataLeads($label); ?>
    }, 
	{
      label: 'Preaprobados',
      backgroundColor: 'rgb(99, 255, 132)',
      borderColor: 'rgb(99, 255, 132)',
      <?php $api->getDataPreaprobados($label); ?>
    },
    {
      label: 'Xiomi',
      backgroundColor: 'rgb(248, 251, 104)',
      borderColor: 'rgb(248, 251, 104)',
      <?php $api->getDataPreaprobadosXiomi($label); ?>
    },
    {
      label: 'Kaori',
      backgroundColor: 'rgb(184, 115, 240)',
      borderColor: 'rgb(184, 115, 240)',
      <?php $api->getDataPreaprobadosKaori($label); ?>
    },
    {
      label: 'Johann',
      backgroundColor: 'rgb(122, 113, 242)',
      borderColor: 'rgb(122, 113, 242)',
      <?php $api->getDataPreaprobadosJohann($label); ?>
    }
	]
  };

  const config = {
  type: 'line',
  data: data,
  options: {
    responsive: true,
    plugins: {
      legend: {
        position: 'top',
      },
      title: {
        display: true,
        text: 'Leads vs Preaprobados - Últimos <?php echo "[" . $label . "] días"; ?>'
      }
    }
  },
};
</script>
<script>
  const myChart = new Chart(
    document.getElementById('myChart'),
    config
  );
</script>
</body>
</html>