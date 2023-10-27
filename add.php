<?php

    include_once 'apipersonas.php';
    
    $api = new ApiPersonas();
    $nombre = '';
    $error = '';
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    
    
        
            $item = array(
                'nombres' => $data->nombres,
				'dni' => $data->dni,
				'celular' => $data->celular,
				'situacion' => $data->situacion,
				'sueldo_neto' => $data->sueldo_neto,
				'saldo_pagar_cuota' => $data->saldo_pagar_cuota,
				'dias_atraso' => $data->dias_atraso,
				'deudas_impagas' => $data->deudas_impagas,
				'deuda_sistema' => $data->deuda_sistema,
				'ruc' => $data->ruc,
                'nombre_empresa' => $data->nombre_empresa,
                'estado' => $data->estado,
                'funcionario' => $data->funcionario,
            );
            $api->add($item);
  
    
?>	