<?php

    include_once 'apipersonas.php';
    
    $api = new ApiPersonas();
    $nombre = '';
    $error = '';
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    
    
        
            $item = array(
                'numero' => $data->numero,
				'canal' => $data->canal,
				'tematico' => $data->tematico,
				'doi' => $data->doi,
				'nombre' => $data->nombre,
				'funcionario' => $data->funcionario,
            );
            $api->add_wsp($item);
  
    
?>	