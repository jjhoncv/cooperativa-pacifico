<?php

include_once 'persona.php';

    class CurlRequest
    {
        public function sendPost($url)
        {
            //datos a enviar
          	//url contra la que atacamos
            //$ch = curl_init("https://api-sms.masivapp.com/smsv3/sms/messages");
            $ch = curl_init($url);
            //a true, obtendremos una respuesta de la url, en otro caso, 
            //true si es correcto, false si no lo es
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            //establecemos el verbo http que queremos utilizar para la petici贸n
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			// enviamos el header
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
					'Content-Length: 0',
					'Content-Type: application/json'));
            //enviamos el array data
            //curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($data));
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
        
        public function sendPost_notificacion_wsp($template, $celular)
        {
            //$nombre = "\$profile_name\$";
            //datos a enviar
            $data = array(
					"id" => "$celular",
					"batch_ids" => "",
					"user_filter" => "",
					"notification_template" => "$template",
					//"notification_body_variables" => "[\"*$nombre*\", \"Sab铆as que tienes *descuentos exclusivos* en diferentes establecimientos 馃ぉ馃挸\", \"Aprovecha comprando con tu Tarjeta de d茅bito en restaurantes 馃崝馃崟馃崡, markets 馃洅 y mucho m谩s.\",\"https://bit.ly/3nkWOix\"]",
					//"notification_header_media" => "https://img.wbcsrv.com/uploads/24815/2022/03/28/35eb73339159d70e8403debbf19bb95a.jpg",
					"notification_body_variables" => "",
					"notification_header_media" => "",
					"notification_header_variable" => "",
					"notification_button_variable" => "",
					"notification_language" => "es",
					"apikey" => "cdc9929a7432bbdc1f3bedd4c67ca9d5_24815_dc4e7fe7d58fad6514cac5706"
			);
          	//url contra la que atacamos
            $ch = curl_init("https://rest.messengerpeople.com/api/v15/chat/notification");
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
        
        function wsp_send_messages()
        {
            $ch = curl_init("https://rest.messengerpeople.com/api/v16/chat");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
              "id" => "51997855645",
              "message" => "hola m",
              "attachment" => "",
              "filename" => "",
              "buttons" => "",
              "meta" => "",
              "batch_ids" => "",
              "user_filter" => "",
              "apikey" => "cdc9929a7432bbdc1f3bedd4c67ca9d5_24815_dc4e7fe7d58fad6514cac5706"
            ]));
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
              "Content-Type: application/json",
              "Content-Length: 200"
            ]);
            $response = curl_exec($ch);
            curl_close($ch);
        }
        
        function wsp_chat_messages()
        {
            // This requires the curl extension to be installed
            $ch = curl_init("https://rest.messengerpeople.com/api/v16/chat?id=51997855645&limit=3&showstartstop=0&apikey=cdc9929a7432bbdc1f3bedd4c67ca9d5_24815_dc4e7fe7d58fad6514cac5706");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
              "Content-Type: application/json"
            ]);
            $response = curl_exec($ch);
            curl_close($ch);
            
            if(!$response) {
                return false;
            }else{
                return $response;
            }
        
        }
        
        public function sendPost_notificacion_wsp_cobranzas($Nom, $celular)
        {
            //$nombre = "\$profile_name\$";
            //datos a enviar
            $data = array(
					"id" => "$celular",
					"batch_ids" => "",
					"user_filter" => "",
					"notification_template" => "prestamo2",
					"notification_body_variables" => "[\"$Nom\"]",
					"notification_header_media" => "https://img.wbcsrv.com/uploads/24815/2022/02/02/2e1b662f2b8678c6ecf7216a50cc449f.jpeg",
					"notification_header_variable" => "",
					"notification_button_variable" => "",
					"notification_language" => "es",
					"apikey" => "cdc9929a7432bbdc1f3bedd4c67ca9d5_24815_dc4e7fe7d58fad6514cac5706"
			);
          	//url contra la que atacamos
            $ch = curl_init("https://rest.messengerpeople.com/api/v15/chat/notification");
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
        
        public function sendPost_notificacion_wsp_ofertas($Nom, $celular, $var1, $var2, $var3, $var4)
        {
            //$nombre = "\$profile_name\$";
            //datos a enviar
            $data = array(
					"id" => "$celular",
					"batch_ids" => "",
					"user_filter" => "",
					"notification_template" => "ofertaxxk",
					"notification_body_variables" => "[\"$var1\", \"$var2\", \"$var3\", \"$var4\"]",
					"notification_header_media" => "",
					"notification_header_variable" => "$Nom",
					"notification_button_variable" => "",
					"notification_language" => "es",
					"apikey" => "cdc9929a7432bbdc1f3bedd4c67ca9d5_24815_dc4e7fe7d58fad6514cac5706"
			);
          	//url contra la que atacamos
            $ch = curl_init("https://rest.messengerpeople.com/api/v15/chat/notification");
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
        
        public function sendPost_notificacion_wsp_ofertas_kaori($Nom, $celular, $var1, $var2, $var3, $var4)
        {
            //$nombre = "\$profile_name\$";
            //datos a enviar
            $data = array(
					"id" => "$celular",
					"batch_ids" => "",
					"user_filter" => "",
					"notification_template" => "ofertaxxk_k",
					"notification_body_variables" => "[\"$var1\", \"$var2\", \"$var3\", \"$var4\"]",
					"notification_header_media" => "",
					"notification_header_variable" => "$Nom",
					"notification_button_variable" => "",
					"notification_language" => "es",
					"apikey" => "cdc9929a7432bbdc1f3bedd4c67ca9d5_24815_dc4e7fe7d58fad6514cac5706"
			);
          	//url contra la que atacamos
            $ch = curl_init("https://rest.messengerpeople.com/api/v15/chat/notification");
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
        
        public function sendPost_notificacion_wsp_ofertas_johann($Nom, $celular, $var1, $var2, $var3, $var4)
        {
            //$nombre = "\$profile_name\$";
            //datos a enviar
            $data = array(
					"id" => "$celular",
					"batch_ids" => "",
					"user_filter" => "",
					"notification_template" => "ofertaxxk_j",
					"notification_body_variables" => "[\"$var1\", \"$var2\", \"$var3\", \"$var4\"]",
					"notification_header_media" => "",
					"notification_header_variable" => "$Nom",
					"notification_button_variable" => "",
					"notification_language" => "es",
					"apikey" => "cdc9929a7432bbdc1f3bedd4c67ca9d5_24815_dc4e7fe7d58fad6514cac5706"
			);
          	//url contra la que atacamos
            $ch = curl_init("https://rest.messengerpeople.com/api/v15/chat/notification");
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
        
        public function sendPost_notificacion_wsp_vehicular($Nom, $celular, $importe_prestamo, $cuota_aprox)
        {
            //$nombre = "\$profile_name\$";
            //datos a enviar
            $data = array(
					"id" => "$celular",
					"batch_ids" => "",
					"user_filter" => "",
					"notification_template" => "vehicular",
					"notification_body_variables" => "[\"$Nom\", \"$importe_prestamo\", \"$cuota_aprox\"]",
					"notification_header_media" => "https://img.wbcsrv.com/uploads/24815/2022/06/08/ffcc0ca55c4a6858761d273e163c82dd.jpg",
					"notification_header_variable" => "",
					"notification_button_variable" => "",
					"notification_language" => "es",
					"apikey" => "cdc9929a7432bbdc1f3bedd4c67ca9d5_24815_dc4e7fe7d58fad6514cac5706"
			);
          	//url contra la que atacamos
            $ch = curl_init("https://rest.messengerpeople.com/api/v15/chat/notification");
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
        
        public function sendPost_email_masivian_vehicular($dni, $nombre_temp, $sueldo_neto, $saldo_pagar, $deudas_impaga, $deuda_sistema, $celular, $funcionario, $oferta, $correo, $cal_tmp)
        {
          
            $saldo_pagar = round($saldo_pagar*100,0);
            
            $data = array(
					"Subject" => "VEHICULAR PREAPROBADO $dni - $nombre_temp",
					"From" => "VEHICULAR <mobile@cp.com.pe>",
					"Template" => array(
					    "Type"=>"text/html",
					    "Value"=>"<div align='left'>*** VEHICULAR *** RESUMEN<br>
					    Nombre=$nombre_temp<br>
					    DNI=$dni<br>
					    Calificación=$cal_tmp<br>
                        Sueldo neto=S/ $sueldo_neto<br>
                        RCI= $saldo_pagar %<br>
                        Deudas Impagas=$deudas_impaga<br>
                        Deuda en el Sistema=S/ $deuda_sistema<br>
                        Celular=$celular<br>
                        Correo=$correo<br>
                        Funcionario=$funcionario<br>
                        ============================<br>
                        Oferta<br>$oferta</div>"
                        ),
                        "ReplyTo" => "VEHICULAR <mobile@cp.com.pe>",
					"Recipients" => [ 
					    array(
					    //"To"=>"miguel.teruya@cp.com.pe")]
					    "To"=>"miguel.teruya@cp.com.pe"),
					    array(
					    "To"=>"xiomi.caycho@cp.com.pe"),
					    array(
					    "To"=>"kaori.urbina@cp.com.pe"),
					    array(
					    "To"=>"johann.diaz@cp.com.pe")]
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
					'Authorization: Basic bWlndWVsLnRlcnV5YTpMaW1hbGltYSoyMDIy'));
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
		
		
		public function sendPost_email_universal($correo, $nombre, $url, $titulo, $detalle)
        {
          
            $data = array(
					"Subject" => "🚨 $titulo",
					"From" => "Tablero Agencias <mobile@cp.com.pe>",
					"Template" => array(
					    "Type"=>"text/html",
					    "Value"=>"<!doctype html>
						<html lang='es'>
						<head>
						  <meta charset='utf-8'>
						  <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
						  <title>Borrar registro</title>
						  <meta name='description' content='Borrar registro'>
						  <meta name='author' content='SSDD'>
						  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
						<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
						<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
						</head>
						<body>
							<div class='container text-center'>
								<div class='container-md'>
									<h2>Eliminar tarjeta en tablero</h2><hr>
									<h3>Hola $nombre</h3>
										<br>
										<h4>La tarjeta de $detalle se desea eliminar. </h4>
										<h4>En caso estes de acuerdo por favor confirmar presionando el botón</h4>
										<br>
										<a class='btn btn-danger' href='$url' role='button'>Eliminar tarjeta</a>
									<hr>
								</div>
							</div>	
						</body>
						</html>"
                        ),
                        "ReplyTo" => "No contestar <mobile@cp.com.pe>",
					"Recipients" => [ 
					    array(
					    "To"=>"$correo")]
					    /*"To"=>"miguel.teruya@cp.com.pe"),
					    array(
					    "To"=>"xiomi.caycho@cp.com.pe"),
					    array(
					    "To"=>"kaori.urbina@cp.com.pe"),
					    array(
					    "To"=>"johann.diaz@cp.com.pe")]*/
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
					'Authorization: Basic bWlndWVsLnRlcnV5YTpMaW1hbGltYSoyMDIy'));
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
		
		public function sendPost_email_kyodai($correo, $nombre, $url, $titulo, $detalle)
        {
          
            $data = array(
					"Subject" => "🚨 $titulo",
					"From" => "Tablero Kyodai <mobile@cp.com.pe>",
					"Template" => array(
					    "Type"=>"text/html",
					    "Value"=>"<!doctype html>
						<html lang='es'>
						<head>
						  <meta charset='utf-8'>
						  <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
						  <title>No es urgente</title>
						  <meta name='description' content='Nuevo prospectos'>
						  <meta name='author' content='SSDD'>
						  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
						<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
						<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
						</head>
						<body>
							<div class='container text-center'>
								<div class='container-md'>
									<h2>Hay un nuevo prospecto en el tablero</h2><hr>
									<h3>Hola $nombre</h3>
										<br>
										<h4>La tarjeta de $detalle se ha ingresado en el tablero para su atención. </h4>
										
										<br>
										<a class='btn btn-danger' href='$url' role='button'>Tarjeta Kyodai</a>
									<hr>
								</div>
							</div>	
						</body>
						</html>"
                        ),
                        "ReplyTo" => "No contestar <mobile@cp.com.pe>",
					"Recipients" => [ 
					    array(
					    "To"=>"paulo.tsukazan@cp.com.pe"),
					    array(
					    "To"=>"patricia.galvez@cp.com.pe")]
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
					'Authorization: Basic bWlndWVsLnRlcnV5YTpMaW1hbGltYSoyMDIy'));
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
	
		
		public function sendPost_email_urgente($correo, $nombre, $url, $titulo, $detalle)
        {
          
            $data = array(
					"Subject" => "🚨 $titulo",
					"From" => "Tablero Agencias <mobile@cp.com.pe>",
					"Template" => array(
					    "Type"=>"text/html",
					    "Value"=>"<!doctype html>
						<html lang='es'>
						<head>
						  <meta charset='utf-8'>
						  <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
						  <title>No es urgente</title>
						  <meta name='description' content='No es urgente'>
						  <meta name='author' content='SSDD'>
						  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
						<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
						<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
						</head>
						<body>
							<div class='container text-center'>
								<div class='container-md'>
									<h2>Modificar tarjeta a NO es Urgente</h2><hr>
									<h3>Hola $nombre</h3>
										<br>
										<h4>La tarjeta de $detalle se desea modificar a NO urgente. </h4>
										<h4>En caso estes de acuerdo por favor confirmar presionando el botón</h4>
										<br>
										<a class='btn btn-danger' href='$url' role='button'>Tarjeta no es urgente</a>
									<hr>
								</div>
							</div>	
						</body>
						</html>"
                        ),
                        "ReplyTo" => "No contestar <mobile@cp.com.pe>",
					"Recipients" => [ 
					    array(
					    "To"=>"$correo")]
					    /*"To"=>"miguel.teruya@cp.com.pe"),
					    array(
					    "To"=>"xiomi.caycho@cp.com.pe"),
					    array(
					    "To"=>"kaori.urbina@cp.com.pe"),
					    array(
					    "To"=>"johann.diaz@cp.com.pe")]*/
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
					'Authorization: Basic bWlndWVsLnRlcnV5YTpMaW1hbGltYSoyMDIy'));
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
		

		public function sendPost_email_agencias($dni, $nombres, $monto, $cuotas, $dia_pago, $fec_desembolso, $observaciones, $funcionario, $origen, $correo)
        {
          
            $data = array(
					"Subject" => "NUEVO PRESTAMO  $dni - $nombres",
					"From" => "Mobile <mobile@cp.com.pe>",
					"Template" => array(
					    "Type"=>"text/html",
					    "Value"=>"<div align='left'>*** Nuevo Préstamo *** <br>
					    Nombre=$nombres<br>
					    DNI=$dni<br>
					    Monto Prestamo=$monto<br>
                        Cuotas= $cuotas<br>
                        Dia de Pago= $dia_pago<br>
                        Fecha desembolso=$fec_desembolso<br>
                        Origen= $origen<br>
						Funcionario= $funcionario <br>
                        ============================<br>"
                        ),
                        "ReplyTo" => "$origen",
					"Recipients" => [ 
					    array(
					    //"To"=>"alicia.teruya@cp.com.pe")]
					    "To"=>"alicia.teruya@cp.com.pe"),
					    array(
					    "To"=>"$origen"),
					    //array(
					    //"To"=>"kaori.urbina@cp.com.pe"),
					    array(
					    "To"=>"$correo")]
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
					'Authorization: Basic bWlndWVsLnRlcnV5YTpMaW1hbGltYSoyMDIy'));
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
		
		public function sendPost_email_plazofijo($dni, $nombres, $socio, $celular, $correo)
        {
          
            $data = array(
					"Subject" => "PLAZO FIJO -  $dni - $nombres",
					"From" => "Mobile <mobile@cp.com.pe>",
					"Template" => array(
					    "Type"=>"text/html",
					    "Value"=>"<div align='left'>*** Plazo Fijo / Inscripcion *** <br>
					    Nombre=$nombres<br>
					    DNI=$dni<br>
					    Es socio=$socio<br>
                        Celular= $celular<br>
                        Correo= $correo<br>
                        ============================<br>"
                        ),
						"ReplyTo" => "PLAZO FIJO <mobile@cp.com.pe>",
						"Recipients" => [ 
					    array(
					    //"To"=>"miguel.teruya@cp.com.pe")]
					    "To"=>"miguel.teruya@cp.com.pe"),
					    array(
					    "To"=>"karina.murakami@cp.com.pe"),
					    array(
					    "To"=>"katy.sanchez@cp.com.pe"),
					    array(
					    "To"=>"karen.mucha@cp.com.pe")]
					
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
					'Authorization: Basic bWlndWVsLnRlcnV5YTpMaW1hbGltYSoyMDIy'));
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
        
        public function sendPost_email_masivian($dni, $nombre_temp, $sueldo_neto, $saldo_pagar, $deudas_impaga, $deuda_sistema, $celular, $funcionario, $oferta, $correo)
        {
          
            $data = array(
					"Subject" => "PREAPROBADO $dni - $nombre_temp",
					"From" => "Mobile <mobile@cp.com.pe>",
					"Template" => array(
					    "Type"=>"text/html",
					    "Value"=>"<div align='left'>RESUMEN<br>
					    Nombre=$nombre_temp<br>
					    DNI=$dni<br>
					    Situación Laboral=Por confirmar<br>
                        Sueldo neto=S/ $sueldo_neto<br>
                        Saldo para pagar cuota (30%)=S/ $saldo_pagar<br>
                        Deudas Impagas=$deudas_impaga<br>
                        Deuda en el Sistema=S/ $deuda_sistema<br>
                        Celular=$celular<br>
                        Correo=$correo<br>
                        Funcionario=$funcionario<br>
                        ============================<br>
                        Oferta<br>$oferta</div>"
                        ),
                        "ReplyTo" => "Mobile <mobile@cp.com.pe>",
					"Recipients" => [ 
					    array(
					    "To"=>"miguel.teruya@cp.com.pe"),
					    array(
					    "To"=>"xiomi.caycho@cp.com.pe"),
					    array(
					    "To"=>"kaori.urbina@cp.com.pe"),
					    array(
					    "To"=>"johann.diaz@cp.com.pe")]
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
					'Authorization: Basic bWlndWVsLnRlcnV5YTpMaW1hbGltYSoyMDIy'));
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
		
		function imprime_log_pacinet_api($tipo, $doi, $correo){
			$persona = new Persona();
			$res = $persona->imprime_log_pacinet($tipo, $doi, $correo);
		}
        
        public function sendPatch_Pacinet($tipo, $doi)
        {

			//url contra la que atacamos
			if($tipo=="unlock")
			    $ch = curl_init("https://hhp18menk8.execute-api.us-east-1.amazonaws.com/prod/configurations/partners/unlock");
			if($tipo=="lock")
                $ch = curl_init("https://hhp18menk8.execute-api.us-east-1.amazonaws.com/prod/configurations/partners/lock");
            
            $data = array(
					"partnerCode" => "$doi"
			);
			
			//$ch = curl_init($url);
            //a true, obtendremos una respuesta de la url, en otro caso, 
            //true si es correcto, false si no lo es
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            //establecemos el verbo http que queremos utilizar para la petición
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PATCH");
			// enviamos el header
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
					"x-api-key: ZEzB6Aw9WK4HuXzUawabw4DEXS3K6dQh7KCqQ3K8",
					"user: spolar",
					"password: 12cfc6227dc9d0217ba6b47604d2115e",
					"Content-Type: application/json",
					"Accept: application/json"));
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
        
        
        public function sendGet_estadoPacinet($tipo, $doi)
        {

			//url contra la que atacamos
            $ch = curl_init("https://hhp18menk8.execute-api.us-east-1.amazonaws.com/prod/configurations/partners");
            //$ch = curl_init($url);
            //a true, obtendremos una respuesta de la url, en otro caso, 
            //true si es correcto, false si no lo es
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            //establecemos el verbo http que queremos utilizar para la petición
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
			// enviamos el header
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
					"x-api-key: ZEzB6Aw9WK4HuXzUawabw4DEXS3K6dQh7KCqQ3K8",
					"partnerCode: $doi",
					"documentType: $tipo",
					"user: spolar",
					"password: 12cfc6227dc9d0217ba6b47604d2115e",
					"Accept: application/json"));
            //enviamos el array data
            //curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($data));
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
        
        public function sendPost_sms_personalizado($celular, $mensaje)
        {
            //datos a enviar
            $data = array(
					"To" => "$celular",
					"text" => "Coop. Pacífico: Hola " . ucfirst($mensaje) . ", un funcionario se comunicara a la brevedad via SMS o WhatsApp.",
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
		
		public function sendPost_infocore_token($dni)
        {

            $ch = curl_init("https://servicios.infocore.com.pe/ibi/GetJWTValueBegin?pJWTValue=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZFVzdWFyaW8iOjMzNDIsImlzcyI6ImluZm9jb3JlLmNvbS5wZSIsImlkRW1wcmVzYSI6MTM5fQ.EyCZrFCr77JCyhHc4lHLpanqPv9wPGh-K-RIN2RIVGc&dni=$dni");
            //a true, obtendremos una respuesta de la url, en otro caso, 
            //true si es correcto, false si no lo es
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            //establecemos el verbo http que queremos utilizar para la petici贸n
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0); 
			curl_setopt($ch, CURLOPT_TIMEOUT, 300); //timeout in seconds
			// enviamos el header
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
					'Content-Type: application/json',
					'Connection: Keep-Alive',
					'Keep-Alive: 300'));
            //enviamos el array data
            //curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($data));
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

	
		public function sendPost_infocore_obtener_datos($resultado)
        {
			//url contra la que atacamos
            //$ch = curl_init("https://api-sms.masivapp.com/smsv3/sms/messages");
            $ch = curl_init("https://servicios.infocore.com.pe/ibi/GetIbiDataPerson?pJWTValue=$resultado");
            //a true, obtendremos una respuesta de la url, en otro caso, 
            //true si es correcto, false si no lo es
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            //establecemos el verbo http que queremos utilizar para la petici贸n
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			// enviamos el header
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
					'Content-Length: 0',
					'Connection: Keep-Alive',
					'Keep-Alive: 300'));
            //enviamos el array data
            //curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($data));
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

        public function sendPut()
        {
            //datos a enviar
            $data = array("a" => "a");
            //url contra la que atacamos
            $ch = curl_init("http://localhost/WebService/API_Rest/api.php");
            //a true, obtendremos una respuesta de la url, en otro caso, 
            //true si es correcto, false si no lo es
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            //establecemos el verbo http que queremos utilizar para la petici贸n
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
            //enviamos el array data
            curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($data));
            //obtenemos la respuesta
            $response = curl_exec($ch);
            // Se cierra el recurso CURL y se liberan los recursos del sistema
            curl_close($ch);
            if(!$response) {
                return false;
            }else{
                var_dump($response);
            }
        }

        public function sendGet()
        {
            //datos a enviar
            $data = array("a" => "a");
            //url contra la que atacamos
            $ch = curl_init("https://singhalese-fuels.000webhostapp.com/");
            //a true, obtendremos una respuesta de la url, en otro caso, 
            //true si es correcto, false si no lo es
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            //establecemos el verbo http que queremos utilizar para la petici贸n
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            //enviamos el array data
            curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($data));
            //obtenemos la respuesta
            $response = curl_exec($ch);
            // Se cierra el recurso CURL y se liberan los recursos del sistema
            curl_close($ch);
            if(!$response) {
                return false;
            }else{
                var_dump($response);
            }
        }

        public function sendDelete()
        {
            //datos a enviar
            $data = array("a" => "a");
            //url contra la que atacamos
            $ch = curl_init("http://localhost/WebService/API_Rest/api.php");
            //a true, obtendremos una respuesta de la url, en otro caso, 
            //true si es correcto, false si no lo es
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            //establecemos el verbo http que queremos utilizar para la petici贸n
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
            //enviamos el array data
            curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($data));
            //obtenemos la respuesta
            $response = curl_exec($ch);
            // Se cierra el recurso CURL y se liberan los recursos del sistema
            curl_close($ch);
            if(!$response) {
                return false;
            }else{
                var_dump($response);
            }
        }
		
	function existe_usuario_db_api($correo){
		$persona = new Persona();
		$res = $persona->existe_usuario_db($correo);
		
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
	
	function existe_password_db_api($token){
		$persona = new Persona();
		$res = $persona->existe_password_db($token);
		
		
		if($res->rowCount()){
			$row = $res->fetch(PDO::FETCH_ASSOC);
			$correo = $row['Usuario'];
			$array = [
			"respuesta" => "ok",
			"correo_db" => "$correo",
			];
			return json_encode($array);
		}else{
			$array = [
			"respuesta" => "nook",
			];
			return json_encode($array);
		}
	}

	function update_password_db_api($correo, $clave1){
		$persona = new Persona();
		$res = $persona->update_password_db($correo, $clave1);
	}
	
	function borra_password_db_api($token){
		$persona = new Persona();
		$res = $persona->borra_password_db($token);
	}
	
	function nuevo_usuario_db_api($correo, $token){
		$persona = new Persona();
		$res = $persona->nuevo_usuario_db($correo, $token);
	}
	
	function getListadoPacinet_api(){
		$i=1;$desc_tipo="";
        $persona = new Persona();
        $res = $persona->getListadoPacinet();
		if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
				if($row['Tipo']=="lock")
					$desc_tipo = "<span style='color:red'>Bloqueó</span>";
				else
					$desc_tipo = "<span style='color:blue'>Desbloqueó</span>";
				
				echo $i++ . ".- [" . $row['Fecha'] . "] " . $row['Usuario'] . " " . $desc_tipo . " [" . $row['Doi'] . "]<br>";
			}
		}
	}	
	
	function sendPost_email_pacinet_bloqueo($correo, $token)
    {
          
            $data = array(
					"Subject" => "🚨 Termina tu alta",
					"From" => "Servicios digitales <mobile@cp.com.pe>",
					"Template" => array(
					    "Type"=>"text/html",
					    "Value"=>"<!doctype html>
						<html lang='es'>
						<head>
						  <meta charset='utf-8'>
						  <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
						  <title>Bloqueo de usuarios Pacinet</title>
						  <meta name='description' content='Bloqueo de usuarios'>
						  <meta name='author' content='SSDD'>
						  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
						<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
						<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
						</head>
						<body>
							<div class='container text-center'>
								<div class='container-md'>
									<h2>Alta de usuarios</h2><hr>
									<h3>Hola</h3>
										<h4>Para continuar el proceso haz clic en</h4>
										<a class='btn btn-danger' href='https://cooperativapacifico.online/alta?token=$token' role='button'>Alta de usuario</a>
										
										<h4>En caso que no hayas solicitado el alta haz clic en</h4>
										<a class='btn btn-danger' href='https://cooperativapacifico.online/borra?token=$token' role='button'>Anular proceso</a>
										<br>
									<hr>
								</div>
							</div>	
						</body>
						</html>"
                        ),
                        "ReplyTo" => "No contestar <mobile@cp.com.pe>",
					"Recipients" => [ 
					    array(
					    "To"=>"$correo")]
					    /*"To"=>"miguel.teruya@cp.com.pe"),
					    array(
					    "To"=>"talia.serna@cp.com.pe"),
					    array(
					    "To"=>"angel.sanchez@cp.com.pe"),
					    array(
					    "To"=>"alvaro.ingaruca@cp.com.pe")]*/
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
					'Authorization: Basic bWlndWVsLnRlcnV5YTpMaW1hbGltYSoyMDIy'));
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
	
	function sendPost_email_pacinet_olvido($correo, $token)
    {
          
            $data = array(
					"Subject" => "🚨 Recupera tu clave",
					"From" => "Servicios digitales <mobile@cp.com.pe>",
					"Template" => array(
					    "Type"=>"text/html",
					    "Value"=>"<!doctype html>
						<html lang='es'>
						<head>
						  <meta charset='utf-8'>
						  <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
						  <title>Recupera tu clave</title>
						  <meta name='description' content='Recupera tu clave'>
						  <meta name='author' content='SSDD'>
						  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
						<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
						<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
						</head>
						<body>
							<div class='container text-center'>
								<div class='container-md'>
									<h2>Recupera la clave de $correo</h2><hr>
									<h3>Hola</h3>
										<h4>Para continuar el proceso haz clic en</h4>
										<a class='btn btn-danger' href='https://cooperativapacifico.online/olvido?token=$token' role='button'>Recupera tu cuenta</a>
										
									<hr>
								</div>
							</div>	
						</body>
						</html>"
                        ),
                        "ReplyTo" => "No contestar <mobile@cp.com.pe>",
					"Recipients" => [ 
					    array(
					    "To"=>"$correo")]
					    /*"To"=>"miguel.teruya@cp.com.pe"),
					    array(
					    "To"=>"talia.serna@cp.com.pe"),
					    array(
					    "To"=>"angel.sanchez@cp.com.pe"),
					    array(
					    "To"=>"alvaro.ingaruca@cp.com.pe")]*/
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
					'Authorization: Basic bWlndWVsLnRlcnV5YTpMaW1hbGltYSoyMDIy'));
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