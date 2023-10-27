<?php
include_once 'persona.php';
$api = new Persona();
date_default_timezone_set('America/Lima');

$directorio = 'archivos/';
$subir_archivo = $directorio.basename($_FILES['subir_archivo']['name']);
$mensaje ="";

if($subir_archivo!="archivos/")
{
    if (move_uploaded_file($_FILES['subir_archivo']['tmp_name'], $subir_archivo)) {
        
        
            $fp = fopen($subir_archivo, "r");
			$i=0;
			
			while (!feof($fp)){
				$linea = fgets($fp);
				$campos = explode(";",$linea);
				
				if($i!=0 and $campos[0]!=""){
				
				$socio="";$nombre="";$solicitud="";$moneda="";$amortizacion="";$intereses="";$mora="";$total="";$saldo="";$saldo_credito="";$dv="";$dp="";$destino_sbs="";$tipo="";$descuento_planilla="";$situacion="";$grupo="";$sectorista="";$celular="";$correo="";
				
				$socio = $campos[0];
				$nombre = $campos[1];
				$solicitud = $campos[2] . $campos[3];
				$moneda = $campos[4];
				$amortizacion = trim($campos[5]);
				$intereses = trim($campos[6]);
				$mora = trim($campos[7]);
				$total = trim($campos[8]);
				$saldo = trim($campos[9]);
				$saldo_credito = trim($campos[10]);
				$dv = $campos[11];
				$dp = $campos[12];
				$destino_sbs = $campos[13];
				$tipo = $campos[14];
				$descuento_planilla = $campos[15];
				$situacion = $campos[17];
				$grupo = $campos[18];
				$sectorista = $campos[16];
				$celular = $campos[19];
				$correo = $campos[23];
				
				if($dp!="")
				{
					$dia = substr($dp, 0, 2);
					$mes = substr($dp, 3, 2);
					$ano = substr($dp, 6, 4);
					$dp = $ano . "-" . $mes . "-" . $dia;
				}
				
				$api->insertaPrestamo($solicitud, $socio, $nombre, $moneda, $amortizacion, $intereses, $mora, $total, $saldo, $saldo_credito, $dv, $dp, $destino_sbs, $tipo, $descuento_planilla, $situacion, $grupo, $sectorista, $celular, $correo);
				
				}
				
				$i++;
				
			
            }
            fclose($fp);
            $mensaje = "Archivo subido. Registros cargados " . $i;
			
			        
    }else{
        $mensaje = "Error ".$_FILES["subir_archivo"]["error"] . " /";
    }
}


?>


<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Carga Archivo</title>

</head>

<body>

<h1>Envio de Archivo de Préstamos</h1>
<ol>
<li>Entrar a Sisgo [Modulo de Cobranzas y Recuperaciones / Consulta de Cobranza Morosidad]</li>
<li>Presionar el boton lila "Actualizar documentos" a continuación el boton con icono de excel "Reporte de Morosidad" para la descarga</li>
<li>En la carpeta "C:\sisgo\tempreport" buscar el archivo excel. Cobranza_Morosidad_DDMMAAAA.xlsx</li>
<li>Abrir excel y eliminar la fila 1 y 2, guardar como el archivo con extensión "csv" CSV (MS-DOS)</li>
<li>Proceder a la subida del archivo</li>
</ol>
<br>
<form enctype="multipart/form-data" action="cargaprestamo" method="POST">
    <input type="hidden" name="MAX_FILE_SIZE" value="4000000" />
   <p> Enviar mi archivo: <input name="subir_archivo" type="file" /></p>
   <p> <input type="submit" value="Enviar Archivo" /></p>
</form>
<?php echo "<h3>" . $mensaje . "</h3>"; ?>
<a href="cobranza_tablero">Volver al tablero</a>
</body>
</html>