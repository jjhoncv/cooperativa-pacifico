<?php

include_once 'persona.php';

class CurlRequest
{

	public function sendPost_sentinel_score($tipo, $dni)
    {
            //datos a enviar
            $data = array(
					"Gx_UsuEnc" => "0g9HYG3nIpsxW53xRZyPzw==",
					"Gx_PasEnc" => "LAVXhSQOifvRu1Jqata0bg==",
					"Gx_Key" => "C25DB7222BC7F07B7165674659F6DD85",
					"TipoDoc" => "$tipo",
					"NroDoc" => "$dni"
			);
			//url contra la que atacamos
            //$ch = curl_init("https://api-sms.masivapp.com/smsv3/sms/messages");
            $ch = curl_init("https://www2.sentinelperu.com/wsrest/rest/RWS_SenNScore");
            //a true, obtendremos una respuesta de la url, en otro caso, 
            //true si es correcto, false si no lo es
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            //establecemos el verbo http que queremos utilizar para la petici贸n
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			// enviamos el header
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
					'Content-Type: application/json'));
            //enviamos el array data
            curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($data));
            //obtenemos la respuesta
            $response = curl_exec($ch);
            // Se cierra el recurso CURL y se liberan los recursos del sistema
            curl_close($ch);
            if(!$response) {
                return false;
            }else{
                return $response;
            }
    }
	
	public function sendPost_sentinel($tipo, $dni)
    {
            //datos a enviar
            $data = array(
					"Gx_UsuEnc" => "0g9HYG3nIpsxW53xRZyPzw==",
					"Gx_PasEnc" => "LAVXhSQOifvRu1Jqata0bg==",
					"Gx_Key" => "C25DB7222BC7F07B7165674659F6DD85",
					"TipoDoc" => "$tipo",
					"NroDoc" => "$dni"
			);
			//url contra la que atacamos
            //$ch = curl_init("https://api-sms.masivapp.com/smsv3/sms/messages");
            $ch = curl_init("https://www2.sentinelperu.com/wsrest/rest/reststandardws");
            //a true, obtendremos una respuesta de la url, en otro caso, 
            //true si es correcto, false si no lo es
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            //establecemos el verbo http que queremos utilizar para la petici贸n
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			// enviamos el header
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
					'Content-Type: application/json'));
            //enviamos el array data
            curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($data));
            //obtenemos la respuesta
            $response = curl_exec($ch);
            // Se cierra el recurso CURL y se liberan los recursos del sistema
            curl_close($ch);
            if(!$response) {
                return false;
            }else{
                return $response;
            }
    }
	
	function traerTasa($Scoring, $sueldo){
	$persona = new Persona();
	
	$tmp="";$tmp1="";$tmp2="";$tasa="";$segmento="";$rci="";

	$res = $persona->traer_tasa_segmento($Scoring); // tabla Tasas, devuelve segmento y tea
	
	if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
				$tmp = $row['Tea'];
				$tmp1 = $row['Segmento'];
				break;
			}
    }
	
	$tasa = $tmp; 
	$segmento = $tmp1;
	
	$res1 = $persona->traer_rci($segmento, $sueldo); // tabla Rci, devuelve rci
	$row1 = $res1->fetch(PDO::FETCH_ASSOC);
    $rci = $row1['Rci'];
	
	
		$array = [
			"tasa" => $tasa,
			"segmento" => $segmento,
			"rci" => $rci
		];
		
		return json_encode($array);
	}
	
	public function sendPost_sms_infogas($celular, $mensaje)
    {
            //datos a enviar
            $data = array(
					"To" => "$celular",
					"text" => "Coop. Pacífico: Hola " . $mensaje . ", se ha recibido tu solicitud de préstamo. Un funcionario se comunicara a la brevedad desde el 719-2100.",
					"CustomData" => "CUST_ID_0125",
					"IsPremium" => "False",
					"IsFlash" => "False",
					"Longmessage" => "False"
			);
			//url contra la que atacamos
            $ch = curl_init("https://api-sms.masivapp.com/smsv3/sms/messages");
            //$ch = curl_init($url);
            //a true, obtendremos una respuesta de la url, en otro caso, 
            //true si es correcto, false si no lo es
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            //establecemos el verbo http que queremos utilizar para la petici贸n
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			// enviamos el header
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
					'Content-Type: application/json',
					'Authorization: Basic UGVydV9Db29wYWNQYWNpZmljb19hcHBfOC04OC06UExjeTckZzJyLg=='));
            //enviamos el array data
            curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($data));
            //obtenemos la respuesta
            $response = curl_exec($ch);
            // Se cierra el recurso CURL y se liberan los recursos del sistema
            curl_close($ch);
            if(!$response) {
                return false;
            }else{
                return $response;
            }
    }
	
	function valida_ususario($usu, $pwd){
		$persona = new Persona();
		$res = $persona->valida_usuario_db($usu, $pwd);
		
		if($res->rowCount()){
			$array = [
			"respuesta" => "ok",
			];
			return json_encode($array);
		}else{
			$array = [
			"respuesta" => "nook",
			];
			return json_encode($array);
		}
	}
	
	public function sendPost_email_infogas($correo, $url, $titulo)
    {
          
            $data = array(
					"Subject" => "🚨 $titulo",
					"From" => "Tablero Infogas <mobile@cp.com.pe>",
					"Template" => array(
					    "Type"=>"text/html",
					    "Value"=>"<!doctype html>
						<html lang='es'>
						<head>
						  <meta charset='utf-8'>
						  <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
						  <title>No es urgente</title>
						  <meta name='description' content='Tablero Infogas'>
						  <meta name='author' content='SSDD'>
						  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
						<script integrity='sha384-xBuQ/xzmlsLoJpyjoggmTEz8OWUFM0/RC5BsqQBDX2v5cMvDHcMakNTNrHIW2I5f' src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
						<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
						</head>
						<body>
							<div class='container text-center'>
								<div class='container-md'>
									<h2>Nuevo prospecto en el tablero</h2><hr>
									<h3>Hola</h3>
										<br>
										<h4>La tarjeta de $titulo ha ingresado </h4>
										<h4>Se requiere de tu apoyo para que sea atendido.</h4>
										<br>
										<a class='btn btn-danger' href='$url' role='button'>Ver tarjeta</a>
									<hr>
								</div>
							</div>	
						</body>
						</html>"
                        ),
                        "ReplyTo" => "No contestar <mobile@cp.com.pe>",
					"Recipients" => [ 
					    array(
					    //"To"=>"$correo")]
					    "To"=>"miguel.teruya@cp.com.pe"),
					    array(
					    "To"=>"talia.serna@cp.com.pe"),
					    array(
					    "To"=>"angel.sanchez@cp.com.pe"),
					    array(
					    "To"=>"alvaro.ingaruca@cp.com.pe")]
			);
            //datos a enviar
            $ch = curl_init("https://api.masiv.masivian.com/email/v1/delivery");
            //$ch = curl_init($url);
            //a true, obtendremos una respuesta de la url, en otro caso, 
            //true si es correcto, false si no lo es
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            //establecemos el verbo http que queremos utilizar para la petici贸n
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			// enviamos el header
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
					'Content-Type: application/json',
					'Authorization: Basic bWlndWVsLnRlcnV5YTpsaW1hMjAyMQ=='));
            //enviamos el array data
            curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($data));
            //obtenemos la respuesta
            $response = curl_exec($ch);
            // Se cierra el recurso CURL y se liberan los recursos del sistema
            curl_close($ch);
            if(!$response) {
                return false;
            }else{
                return $response;
            }
    }
	
	public function sendPost_sms_masivian($celular, $mensaje)
        {
            //datos a enviar
            $data = array(
					"To" => "$celular",
					"text" => "$mensaje",
					"CustomData" => "CUST_ID_0125",
					"IsPremium" => "False",
					"IsFlash" => "False",
					"Longmessage" => "False"
			);
			//url contra la que atacamos
            $ch = curl_init("https://api-sms.masivapp.com/smsv3/sms/messages");
            //$ch = curl_init($url);
            //a true, obtendremos una respuesta de la url, en otro caso, 
            //true si es correcto, false si no lo es
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            //establecemos el verbo http que queremos utilizar para la petici贸n
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			// enviamos el header
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
					'Content-Type: application/json',
					'Authorization: Basic UGVydV9Db29wYWNQYWNpZmljb19hcHBfOC04OC06UExjeTckZzJyLg=='));
            //enviamos el array data
            curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($data));
            //obtenemos la respuesta
            $response = curl_exec($ch);
            // Se cierra el recurso CURL y se liberan los recursos del sistema
            curl_close($ch);
            if(!$response) {
                return false;
            }else{
                return $response;
            }
        }
		
}
	
?>