<?php

include_once 'persona_infoweb.php';
session_start();

class ApiInfoweb{
	
	function api_infoweb_3ra_llamada($dni){
	
	//$sueldo = 2500;
	
	$dni = trim($dni);
	if(strlen($dni)==8)
		$tipo = "D";
	else
		$tipo = "R";
		
	$headers =  array(
	 'Content-Type:application/json',
	 'Content-Length: 0'
	);
	

	$curl = curl_init();

	curl_setopt_array($curl, array(
	  CURLOPT_URL => 'https://servicios.infocore.com.pe/ibi/GetJWTValueBegin?pJWTValue=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZFVzdWFyaW8iOjMzNDIsImlzcyI6ImluZm9jb3JlLmNvbS5wZSIsImlkRW1wcmVzYSI6MTM5fQ.EyCZrFCr77JCyhHc4lHLpanqPv9wPGh-K-RIN2RIVGc&dni=' . $dni,
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => '',
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => 'POST',
	  CURLOPT_HTTPHEADER => $headers,
	));

	$response = curl_exec($curl);

	curl_close($curl);
	
	$obj1 = json_decode($response);
	
	$output = $obj1->resultado;
	
	echo "<input type='hidden' id='token' value='" . $output . "'>";
	echo "<input type='hidden' id='doi' value='" . $dni . "'>";
	echo "<input type='hidden' id='score' value='" . $Scoring . "'>";
	echo "<h3>¿Estás consultando el DNI/CE " . $dni . "?<h3><br>";
	echo "<button type='button' class='btn btn-danger' data-dismiss='modal' onclick='no_segunda();'>No</button>   ";
	echo "<button type='button' class='btn btn-success' data-dismiss='modal' onclick='segunda();'>Si</button>";
	
	
	}
	
	function api_sentinel_llamada2($dni){
			echo "DNI:" . $dni;
	}
	
	function api_sentinel_llamada($dni){
		
		$dni = trim($dni);
		if(strlen($dni)==8)
			$tipo = "D";
		else
			$tipo = "R";
		
		$headers =  array(
		 'Content-Type:application/json',
		 'Cookie: incap_ses_8217_2380410=6VaFLHS2NQdp11TC2KYIcsjwL2UAAAAAjJWcXCcRXfNa7jaqRsqruQ==; nlbi_2380410=pzazPxYpOjXFMeIYrCyPggAAAABzC2ydFnSLYCHtQcAOs5ZT; visid_incap_2380410=nwPUTYSVS7awGygfZ4jIZKLSR2QAAAAAQUIPAAAAAAC33TYKlYQB2elUda1Z8eBX; ASP.NET_SessionId=att34olkvi2zxshsy33gbjp4'
		);
	

		$curl = curl_init();
		
		
		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'https://www2.sentinelperu.com/wsrest/rest/reststandardws',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS =>'{
			"Gx_UsuEnc": "0g9HYG3nIpsxW53xRZyPzw==",
			"Gx_PasEnc": "LAVXhSQOifvRu1Jqata0bg==",
			"Gx_Key": "C25DB7222BC7F07B7165674659F6DD85",
			"TipoDoc": "' . $tipo . '",
			"NroDoc": "' . $dni . '"
		}',
		  CURLOPT_HTTPHEADER => $headers,
		));

		$response = curl_exec($curl);

		curl_close($curl);
		$obj3 = json_decode($response);
	
		$persona = new Persona();
		$res = $persona->consulta_doi_sentinel($dni);
		if($res->rowCount())
		{
			$persona->update_json_sentinel($dni, $response);
		}else{
			$persona->ingresa_json_sentinel($dni, $response);
		}
		
		$Nom = $obj3->soafulloutput->InfBas->Nom;
		echo "[" . $Nom . "]";
	}
	
	
	function api_infoweb_2da_llamada($token, $dni, $Scoring){

	$colaborador="";
	$usuario = $_SESSION["acceso_pacinet"];
	
	if(strlen($dni)==8)
		$tipo = "D";
	else
		$tipo = "R";

	$headers =  array(
	 'Content-Type:application/json',
	 'Content-Length: 0'
	);

	$curl = curl_init();

	curl_setopt_array($curl, array(
	  CURLOPT_URL => 'https://servicios.infocore.com.pe/ibi/GetIbiDataPerson?pJWTValue=' . $token,
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => '',
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => 'POST',
	  CURLOPT_HTTPHEADER => $headers,
	));

	$response = curl_exec($curl);

	curl_close($curl);
	$obj2 = json_decode($response);
	
	$persona = new Persona();
	$res = $persona->consulta_doi($dni);
	if($res->rowCount())
	{
		$persona->update_json($dni, $response);
	}else{
		$persona->ingresa_json($dni, $response);
	}
	
		for ($j = 0; $j <= 23; $j++){
				
			echo eval ("\$ApiRuc_" . $j . "= (isset(\$obj2->listaRecordLaboral[" . $j . "]->ruc)) ? \$obj2->listaRecordLaboral[" . $j . "]->ruc : '';");
			echo eval ("\$ApiDevengue_" . $j . "= (isset(\$obj2->listaRecordLaboral[" . $j . "]->devengue)) ? \$obj2->listaRecordLaboral[" . $j . "]->devengue : '';");
			echo eval ("\$ApiEmpresa_" . $j . "= (isset(\$obj2->listaRecordLaboral[" . $j . "]->empresa)) ? \$obj2->listaRecordLaboral[" . $j . "]->empresa : '';");
			echo eval ("\$ApiCondicion_" . $j . "= (isset(\$obj2->listaRecordLaboral[" . $j . "]->condicion)) ? \$obj2->listaRecordLaboral[" . $j . "]->condicion : '';");
			echo eval ("\$Apip1_" . $j . "= (isset(\$obj2->listaRecordLaboral[" . $j . "]->p1)) ? \$obj2->listaRecordLaboral[" . $j . "]->p1 : 0;");
		}
		
	
		if($ApiRuc_0!="20111065013" and $ApiRuc_0!="20518941381" and $ApiRuc_0!="20552954689")
		{
				if($ApiRuc_0!="")
				{	
				echo "<div id='contenedor'>";
				echo "<table class='table table-responsive table-striped text-center'>";
				echo "<thead>";
				echo "<tr>";
				echo "<th colspan='3' class='text-center'><h3>DNI [" . $dni . "] <button type='button' class='btn btn-success mb-3' id='crearpdf' onclick='window.print()'>Crear PDF</button> <a class='btn btn-success' href='infoweb'>Otra consulta</a></h3></th>";
				echo "</tr>";
				echo "</thead>";
				echo "</table>";
				
				echo "<div class='container'>";
				echo "<div class='row'>";
				echo "<div class='col-sm'>"; // Primer div inicio
				
				echo "<table class='table table-responsive'>"; // Inico de tabla 1
				echo "<tr class='bg-secondary'>";
				echo "<th class='text-center'>Periodo</th><th class='text-center'>Ruc</th><th class='text-center'>Empresa</th><th class='text-center'>Condición</th><th class='text-center'>P1</th>";
				echo "</tr>";
				echo "<tr>";
				echo "<td class='text-center'>" . $ApiDevengue_0 . "</td><td class='text-center'>" . $ApiRuc_0 . "</td><td class='text-center'>" . $ApiEmpresa_0 . "</td><td class='text-center'>" . $ApiCondicion_0 . "</td><td class='text-center'>" . $Apip1_0 . "</td>";
				echo "</tr>";
				
				if($ApiDevengue_1!="")
				{	
				echo "<tr>";
				echo "<td class='text-center'>" . $ApiDevengue_1 . "</td><td class='text-center'>" . $ApiRuc_1 . "</td><td class='text-center'>" . $ApiEmpresa_1 . "</td><td class='text-center'>" . $ApiCondicion_1 . "</td><td class='text-center'>" . $Apip1_1 . "</td>";
				echo "</tr>";
				}
				
				if($ApiDevengue_2!="")
				{
				echo "<tr>";
				echo "<td class='text-center'>" . $ApiDevengue_2 . "</td><td class='text-center'>" . $ApiRuc_20 . "</td><td class='text-center'>" . $ApiEmpresa_2 . "</td><td class='text-center'>" . $ApiCondicion_2 . "</td><td class='text-center'>" . $Apip1_2 . "</td>";
				echo "</tr>";
				}
				
				if($ApiDevengue_3!="")
				{
				echo "<tr>";
				echo "<td class='text-center'>" . $ApiDevengue_3 . "</td><td class='text-center'>" . $ApiRuc_3 . "</td><td class='text-center'>" . $ApiEmpresa_3 . "</td><td class='text-center'>" . $ApiCondicion_3 . "</td><td class='text-center'>" . $Apip1_3 . "</td>";
				echo "</tr>";
				}
				
				if($ApiDevengue_4!="")
				{
				echo "<tr>";
				echo "<td class='text-center'>" . $ApiDevengue_4 . "</td><td class='text-center'>" . $ApiRuc_4 . "</td><td class='text-center'>" . $ApiEmpresa_4 . "</td><td class='text-center'>" . $ApiCondicion_4 . "</td><td class='text-center'>" . $Apip1_4 . "</td>";
				echo "</tr>";
				}
				
				if($ApiDevengue_5!="")
				{
				echo "<tr>";
				echo "<td class='text-center'>" . $ApiDevengue_5 . "</td><td class='text-center'>" . $ApiRuc_5 . "</td><td class='text-center'>" . $ApiEmpresa_5 . "</td><td class='text-center'>" . $ApiCondicion_5 . "</td><td class='text-center'>" . $Apip1_5 . "</td>";
				echo "</tr>";
				}
				
				if($ApiDevengue_6!="")
				{
				echo "<tr>";
				echo "<td class='text-center'>" . $ApiDevengue_6 . "</td><td class='text-center'>" . $ApiRuc_6 . "</td><td class='text-center'>" . $ApiEmpresa_6 . "</td><td class='text-center'>" . $ApiCondicion_6 . "</td><td class='text-center'>" . $Apip1_6 . "</td>";
				echo "</tr>";
				}
				
				if($ApiDevengue_7!="")
				{
				echo "<tr>";
				echo "<td class='text-center'>" . $ApiDevengue_7 . "</td><td class='text-center'>" . $ApiRuc_7 . "</td><td class='text-center'>" . $ApiEmpresa_7 . "</td><td class='text-center'>" . $ApiCondicion_7 . "</td><td class='text-center'>" . $Apip1_7 . "</td>";
				echo "</tr>";
				}
				
				if($ApiDevengue_8!="")
				{
				echo "<tr>";
				echo "<td class='text-center'>" . $ApiDevengue_8 . "</td><td class='text-center'>" . $ApiRuc_8 . "</td><td class='text-center'>" . $ApiEmpresa_8 . "</td><td class='text-center'>" . $ApiCondicion_8 . "</td><td class='text-center'>" . $Apip1_8 . "</td>";
				echo "</tr>";
				}
				
				if($ApiDevengue_9!="")
				{
				echo "<tr>";
				echo "<td class='text-center'>" . $ApiDevengue_9 . "</td><td class='text-center'>" . $ApiRuc_9 . "</td><td class='text-center'>" . $ApiEmpresa_9 . "</td><td class='text-center'>" . $ApiCondicion_9 . "</td><td class='text-center'>" . $Apip1_9 . "</td>";
				echo "</tr>";
				}
				
				if($ApiDevengue_10!="")
				{
				echo "<tr>";
				echo "<td class='text-center'>" . $ApiDevengue_10 . "</td><td class='text-center'>" . $ApiRuc_10 . "</td><td class='text-center'>" . $ApiEmpresa_10 . "</td><td class='text-center'>" . $ApiCondicion_10 . "</td><td class='text-center'>" . $Apip1_10 . "</td>";
				echo "</tr>";
				}
				
				if($ApiDevengue_11!="")
				{
				echo "<tr>";
				echo "<td class='text-center'>" . $ApiDevengue_11 . "</td><td class='text-center'>" . $ApiRuc_11 . "</td><td class='text-center'>" . $ApiEmpresa_11 . "</td><td class='text-center'>" . $ApiCondicion_11 . "</td><td class='text-center'>" . $Apip1_11 . "</td>";
				echo "</tr>";
				}
				
				if($ApiDevengue_12!="")
				{
				echo "<tr>";
				echo "<td class='text-center'>" . $ApiDevengue_12 . "</td><td class='text-center'>" . $ApiRuc_12 . "</td><td class='text-center'>" . $ApiEmpresa_12 . "</td><td class='text-center'>" . $ApiCondicion_12 . "</td><td class='text-center'>" . $Apip1_12 . "</td>";
				echo "</tr>";
				}
				
				if($ApiDevengue_13!="")
				{
				echo "<tr>";
				echo "<td class='text-center'>" . $ApiDevengue_13 . "</td><td class='text-center'>" . $ApiRuc_13 . "</td><td class='text-center'>" . $ApiEmpresa_13 . "</td><td class='text-center'>" . $ApiCondicion_13 . "</td><td class='text-center'>" . $Apip1_13 . "</td>";
				echo "</tr>";
				}
				
				if($ApiDevengue_14!="")
				{
				echo "<tr>";
				echo "<td class='text-center'>" . $ApiDevengue_14 . "</td><td class='text-center'>" . $ApiRuc_14 . "</td><td class='text-center'>" . $ApiEmpresa_14 . "</td><td class='text-center'>" . $ApiCondicion_14 . "</td><td class='text-center'>" . $Apip1_14 . "</td>";
				echo "</tr>";
				}
				
				if($ApiDevengue_15!="")
				{
				echo "<tr>";
				echo "<td class='text-center'>" . $ApiDevengue_15 . "</td><td class='text-center'>" . $ApiRuc_15 . "</td><td class='text-center'>" . $ApiEmpresa_15 . "</td><td class='text-center'>" . $ApiCondicion_15 . "</td><td class='text-center'>" . $Apip1_15 . "</td>";
				echo "</tr>";
				}
				
				if($ApiDevengue_16!="")
				{
				echo "<tr>";
				echo "<td class='text-center'>" . $ApiDevengue_16 . "</td><td class='text-center'>" . $ApiRuc_16 . "</td><td class='text-center'>" . $ApiEmpresa_16 . "</td><td class='text-center'>" . $ApiCondicion_16 . "</td><td class='text-center'>" . $Apip1_16 . "</td>";
				echo "</tr>";
				}
				
				if($ApiDevengue_17!="")
				{
				echo "<tr>";
				echo "<td class='text-center'>" . $ApiDevengue_17 . "</td><td class='text-center'>" . $ApiRuc_17 . "</td><td class='text-center'>" . $ApiEmpresa_17 . "</td><td class='text-center'>" . $ApiCondicion_17 . "</td><td class='text-center'>" . $Apip1_17 . "</td>";
				echo "</tr>";
				}
				
				if($ApiDevengue_18!="")
				{
				echo "<tr>";
				echo "<td class='text-center'>" . $ApiDevengue_18 . "</td><td class='text-center'>" . $ApiRuc_18 . "</td><td class='text-center'>" . $ApiEmpresa_18 . "</td><td class='text-center'>" . $ApiCondicion_18 . "</td><td class='text-center'>" . $Apip1_18 . "</td>";
				echo "</tr>";
				}
				
				if($ApiDevengue_19!="")
				{
				echo "<tr>";
				echo "<td class='text-center'>" . $ApiDevengue_19 . "</td><td class='text-center'>" . $ApiRuc_19 . "</td><td class='text-center'>" . $ApiEmpresa_19 . "</td><td class='text-center'>" . $ApiCondicion_19 . "</td><td class='text-center'>" . $Apip1_19 . "</td>";
				echo "</tr>";
				}
				
				if($ApiDevengue_20!="")
				{
				echo "<tr>";
				echo "<td class='text-center'>" . $ApiDevengue_20 . "</td><td class='text-center'>" . $ApiRuc_20 . "</td><td class='text-center'>" . $ApiEmpresa_20 . "</td><td class='text-center'>" . $ApiCondicion_20 . "</td><td class='text-center'>" . $Apip1_20 . "</td>";
				echo "</tr>";
				}
				
				if($ApiDevengue_21!="")
				{
				echo "<tr>";
				echo "<td class='text-center'>" . $ApiDevengue_21 . "</td><td class='text-center'>" . $ApiRuc_21 . "</td><td class='text-center'>" . $ApiEmpresa_21 . "</td><td class='text-center'>" . $ApiCondicion_21 . "</td><td class='text-center'>" . $Apip1_21 . "</td>";
				echo "</tr>";
				}
				
				if($ApiDevengue_22!="")
				{
				echo "<tr>";
				echo "<td class='text-center'>" . $ApiDevengue_22 . "</td><td class='text-center'>" . $ApiRuc_22 . "</td><td class='text-center'>" . $ApiEmpresa_22 . "</td><td class='text-center'>" . $ApiCondicion_22 . "</td><td class='text-center'>" . $Apip1_22 . "</td>";
				echo "</tr>";
				}
				
				if($ApiDevengue_23!="")
				{
				echo "<tr>";
				echo "<td class='text-center'>" . $ApiDevengue_23 . "</td><td class='text-center'>" . $ApiRuc_23 . "</td><td class='text-center'>" . $ApiEmpresa_23 . "</td><td class='text-center'>" . $ApiCondicion_23 . "</td><td class='text-center'>" . $Apip1_23 . "</td>";
				echo "</tr>";
				}

				
				echo "</table>"; // Fin de tabla 1
				
				echo "</div>"; // Fin de primer div
				
				
				echo "</div>";
				echo "</div>";
				echo "</div>";
				}
				else
				{
					echo "<h3>DNI sin información</h3>" . "<br>";
				}
			$colaborador="N";
		}else{
			echo "<h3>Restringido - Colaborador Cooperativa Pacifico</h3>" . "<br>";
			$colaborador="S";
		}
		$persona->ingresa_repo($dni, $usuario, $colaborador, "S");
		echo "<a class='btn btn-success' href='infoweb'>Volver</a><br><br>";
	}
	
	function api_infoweb_1ra_llamada($dni){

	$headers =  array(
	 'Content-Type:application/json',
	 'Content-Length: 0'
	);
	

	$curl = curl_init();

	curl_setopt_array($curl, array(
	  CURLOPT_URL => 'https://servicios.infocore.com.pe/ibi/GetJWTValueBegin?pJWTValue=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZFVzdWFyaW8iOjMzNDIsImlzcyI6ImluZm9jb3JlLmNvbS5wZSIsImlkRW1wcmVzYSI6MTM5fQ.EyCZrFCr77JCyhHc4lHLpanqPv9wPGh-K-RIN2RIVGc&dni=' . $dni,
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => '',
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => 'POST',
	  CURLOPT_HTTPHEADER => $headers,
	));

	$response = curl_exec($curl);

	curl_close($curl);
	$obj1 = json_decode($response);
	
	$output = $obj1->resultado;
	echo "<input type='hidden' id='token' value='" . $output . "'>";
	echo "<input type='hidden' id='doi' value='" . $dni . "'>";

	}
	
	



}

?>