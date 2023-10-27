<?php

include_once 'apipersonas.php';
$api = new ApiPersonas();

$json = file_get_contents('php://input');
$data = json_decode($json);


            $item = array(
                'dni' => $data->dni,
            );
            
               header('Content-Type: application/json'); 
               $api->tsurus($item);

?>