<?php

    include_once 'apipersonas.php';
    
    $api = new ApiPersonas();
    $nombre = '';
    $error = '';
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    
    
        
            $item = array(
                'Celular' => $data->Celular,
				'Nick' => $data->Nick,
				'Doi' => $data->Doi,
				'Resultado' => $data->Resultado,
				);
            $api->add_aelulog($item);
  
    
?>	