<?php
session_start();
include_once 'persona.php';
$_SESSION ['func'] = array();

class ApiPersonas{
    
    function tsurus($doi){
        $persona = new Persona();
        $res = $persona->obtenerTsurus($doi);
        
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
                  $datos = array("puntos"=>$row['puntos'],"nombre"=>$row['nombres'], "fecha"=>$row['fecha']);
                  echo json_encode($datos);    
   
            }
        }
        
        //header("Location: https://cp.com.pe/pacifico/puntos-tsuru/?puntos=" . $puntos . "&nombres=" . $nombres_tsurus . "&fecha=" . $fecha_tsuru);
        
    }
    
    function actualiza_paso($id, $paso){
        $persona = new Persona();
        $res = $persona->update_Paso($id, $paso);
    }
	
    function actualiza_funcionario($samantha, $daniel, $dayssy, $gabriela, $cinthia, $christian){
        $persona = new Persona();
        $res = $persona->update_funcionario($samantha, $daniel, $dayssy, $gabriela, $cinthia, $christian);
    }

    function actualiza_funcionario_digital($xiomi, $kaori, $johann){
        $persona = new Persona();
        $res = $persona->update_funcionario_digital($xiomi, $kaori, $johann);
    }

    function actualiza_paso_kyodai($id, $paso){
        $persona = new Persona();
        $res = $persona->update_Paso_kyodai($id, $paso);
    }

    function actualiza_paso_agencias($id, $paso){
        $persona = new Persona();
        $res = $persona->update_Paso_agencias($id, $paso);
    }
	
    function actualiza_paso_agencias2($id, $paso){
        $persona = new Persona();
        $res = $persona->update_Paso_agencias2($id, $paso);
    }
    
    function actualiza_observacion_kyodai($id, $obs, $paso, $funcionario, $fec_ingreso){
        $persona = new Persona();
        $res = $persona->update_Obs_kyodai($id, $obs, $paso, $funcionario, $fec_ingreso);
    }   
	
    function actualiza_observacion_agencias($id, $obs, $paso, $funcionario, $monto, $fec_desembolso, $moneda, $cuotas, $rechazado, $tarea, $tipo, $agencia, $fec_ingreso){
        $persona = new Persona();
        $res = $persona->update_Obs_agencias($id, $obs, $paso, $funcionario, $monto, $fec_desembolso, $moneda, $cuotas, $rechazado, $tarea, $tipo, $agencia, $fec_ingreso);
    }

    function actualiza_observacion_agencias2($id, $obs, $paso, $funcionario, $monto, $tarea, $canal, $moneda, $fec_ingreso, $rechazado){
        $persona = new Persona();
        $res = $persona->update_Obs_agencias2($id, $obs, $paso, $funcionario, $monto, $tarea, $canal, $moneda, $fec_ingreso, $rechazado);
    }
	   
    function actualiza_observacion($id, $obs, $monto, $paso, $funcionario, $fec_ingreso){
        $persona = new Persona();
        $res = $persona->update_Obs($id, $obs, $monto, $paso, $funcionario, $fec_ingreso);
    }
    
    function listaPlantillas(){
        $persona = new Persona();
        $res = $persona->obtenerPlantillas();
        
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
                  echo "<option value='" . $row['plantilla'] . "'>" . $row['descripcion'] . "</option>";
            }
        }
        
        
    }
	
    function listado_origen_api($fec_inicio, $fec_fin){
        $month_day_last = date('Y-m', strtotime('first day of last month'));
		$dos_meses = date('Y-m', strtotime('-2 month'));
		$hoy = date('Y-m-d');
        $first_day = date('Y-m');
	
		$mes_pasado_inicio = $month_day_last . "-01";
		$mes_pasado_fin = $month_day_last . "-31";
		$mes_actual_inicio = $first_day . "-01";
		$mes_actual_fin = $hoy;
		$mes_antepasado_inicio = $dos_meses . "-01";
		$mes_antepasado_fin = $dos_meses . "-31";
        
		$persona = new Persona();
        $res = $persona->listado_origen($mes_pasado_inicio, $mes_actual_fin);
		setlocale(LC_ALL,"es_ES");
		
		echo "<table class='table table-responsive table-striped'>";
		echo "<thead>";
		echo "<tr><th>Origen</th><th class='text-center'>" . strtoupper(strftime("%b")) . "</th><th class='text-center'>" . strtoupper(strftime("%b", strtotime('first day of last month'))) . "</th><th class='text-center'>" . strtoupper(strftime("%b", strtotime('-2 month'))) . "</th><th class='text-center'>TOT</th></tr>";
		echo "</thead>";
		echo "<tbody>";
		
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
				$tmp = $row['Origen'];
				$pos = strpos($tmp,"@");
				$dominio = substr($tmp,$pos + 1);

				if($dominio=="cp.com.pe" or $dominio=="CP.COM.PE")
					$imp_tmp = substr($tmp, 0, $pos);
				else
					$imp_tmp = "<span style='color:red'>" . substr($tmp, 0, $pos) . "<span>";
					
				
				$res1 = $persona->cuenta_origen($mes_actual_inicio, $mes_actual_fin, $tmp);
				$row1 = $res1->fetch(PDO::FETCH_ASSOC);
				
				$res2 = $persona->cuenta_origen($mes_pasado_inicio, $mes_pasado_fin, $tmp);
				$row2 = $res2->fetch(PDO::FETCH_ASSOC);
				
				$res5 = $persona->cuenta_origen($mes_antepasado_inicio, $mes_antepasado_fin, $tmp);
				$row5 = $res5->fetch(PDO::FETCH_ASSOC);
				
				//$res6 = $persona->cuenta_origen($mes_antepasado_inicio, $mes_actual_fin, $tmp);
				//$row6 = $res6->fetch(PDO::FETCH_ASSOC);
				
				$total_origen = $row1['Total'] + $row2['Total'] + $row5['Total'];
				
				$res9 = $persona->cuenta_origen_desemb($mes_actual_inicio, $mes_actual_fin, $tmp);
				$row9 = $res9->fetch(PDO::FETCH_ASSOC);
				
				$res10 = $persona->cuenta_origen_desemb($mes_pasado_inicio, $mes_pasado_fin, $tmp);
				$row10 = $res10->fetch(PDO::FETCH_ASSOC);
				
				$res11 = $persona->cuenta_origen_desemb($mes_antepasado_inicio, $mes_antepasado_fin, $tmp);
				$row11 = $res11->fetch(PDO::FETCH_ASSOC);
				
				//$res12 = $persona->cuenta_origen_desemb($mes_antepasado_inicio, $mes_actual_fin, $tmp);
				//$row12 = $res12->fetch(PDO::FETCH_ASSOC);
				
				$total_desem = $row9['Total'] + $row10['Total'] + $row11['Total'];
                 
				echo "<tr><td>" . $imp_tmp . "</td><td class='text-center'>" . $row1['Total'] . " (" . $row9['Total'] . ")</td><td class='text-center'>" . $row2['Total'] . " (" . $row10['Total'] . ")</td><td class='text-center'>" . $row5['Total'] . " (" . $row11['Total'] . ")</td><td class='text-center'><b>" . $total_origen . " (" . $total_desem . ")</b></td></tr>";
            }
        }
		
		$tmp = "";
		$res3 = $persona->cuenta_origen_tot($mes_actual_inicio, $mes_actual_fin);
		$row3 = $res3->fetch(PDO::FETCH_ASSOC);
				
		$res4 = $persona->cuenta_origen_tot($mes_pasado_inicio, $mes_pasado_fin);
		$row4 = $res4->fetch(PDO::FETCH_ASSOC);
		
		$res7 = $persona->cuenta_origen_tot($mes_antepasado_inicio, $mes_antepasado_fin);
		$row7 = $res7->fetch(PDO::FETCH_ASSOC);

		//$res8 = $persona->cuenta_origen_tot($mes_antepasado_inicio, $mes_actual_fin);
		//$row8 = $res8->fetch(PDO::FETCH_ASSOC);
		
		$total_origen2 = $row3['Total'] + $row4['Total'] + $row7['Total'];
		
		$res13 = $persona->cuenta_origen_tot_desemb($mes_actual_inicio, $mes_actual_fin, $tmp);
		$row13 = $res13->fetch(PDO::FETCH_ASSOC);
		
		$res14 = $persona->cuenta_origen_tot_desemb($mes_pasado_inicio, $mes_pasado_fin, $tmp);
		$row14 = $res14->fetch(PDO::FETCH_ASSOC);
		
		$res15 = $persona->cuenta_origen_tot_desemb($mes_antepasado_inicio, $mes_antepasado_fin, $tmp);
		$row15 = $res15->fetch(PDO::FETCH_ASSOC);
		
		//$res16 = $persona->cuenta_origen_tot_desemb($mes_antepasado_inicio, $mes_actual_fin, $tmp);
		//$row16 = $res16->fetch(PDO::FETCH_ASSOC);
		
		$total_desem2 = $row13['Total'] + $row14['Total'] + $row15['Total'];
		
		echo "<tr><th> Total </th><th class='text-center'>" . $row3['Total'] . " (" . $row13['Total'] . ")</th><th class='text-center'>" . $row4['Total'] .  " (" . $row14['Total'] . ")</th><th class='text-center'>" . $row7['Total'] . " (" . $row15['Total'] . ")</th><th class='text-center'>" . $total_origen2 . " (" . $total_desem2 . ")</th></tr>";
		echo "</tbody>";
        echo "</table>";
    }
    
    function feriado($fec_actual){
        
        $persona = new Persona();
        $res = $persona->obtenerFeriado($fec_actual);

        if($res->rowCount()){
            //echo "true";
            $_SESSION["miguel_t"] = "true";
        }
        else{
            //echo "false";
            $_SESSION["miguel_t"] = "false";
        }
      
    }
	
    function repetidoDni_api($dni){
        
        $persona = new Persona();
        $res = $persona->repetidoDni($dni);
        $row = $res->fetch(PDO::FETCH_ASSOC);
        $tmp = $row['Total'];
        
        if($tmp>0){
            $_SESSION["repetido"] = "false";
        }else{
            $_SESSION["repetido"] = "true";
        }
    } 

    
    function obt_pagina($pagina, $desc_visita){
        $persona = new Persona();
        $res = $persona->obtenerPagina($pagina);
        $url = "";
        $id_pagina = "";
        
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
                  $url = $row['url'];
                  $id_pagina = $row['id'];
                  }
        }
        
        if($url!="")
        {
            header("Location: " . $url);
            $res = $persona->nuevaRegistroVisita($id_pagina, $desc_visita);
        }
        else
        {
            header("Location: https://www.google.com.pe");
        }
    }

    function getAll(){
        $persona = new Persona();
        $personas = array();
        $personas["items"] = array();

        $res = $persona->obtenerPersonas();

        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
    
                $item=array(
                    "id" => $row['Id'],
                    "nombres" => $row['Nombres'],
                    "dni" => $row['Dni'],
                    "celular" => $row['Celular'],
                    "situacion" => $row['Situacion'],
                    "sueldo_neto" => $row['Sueldo_neto'],
                    "saldo_pagar_cuota" => $row['Saldo_pagar_cuota'],
                    "dias_atraso" => $row['Dias_atraso'],
                    "deudas_impagas" => $row['Deudas_impagas'],
                    "deuda_sistema" => $row['Deuda_sistema'],
                    "ruc" => $row['Ruc'],
                    "nombre_empresa" => $row['Nombre_empresa'],
                    "fecha" => $row['Fecha'],
                    "estado" => $row['Estado'],
                    "funcionario" => $row['Funcionario'],
                );
                array_push($personas["items"], $item);
            }
        
            echo json_encode($personas);
        }else{
            echo json_encode(array('mensaje' => 'No hay elementos'));
        }
    }

    function getAllPagina(){
        $persona = new Persona();
        $res = $persona->obtener_Paginas();
        
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
                echo "<tr>";
                echo "<td><p class='text-primary'><a href='detalle'>" . $row['descripcion'] . "</a></p></td>";
                echo "<td>" . $row['url'] . "</td>";
                echo "</tr>";
            }
        }
    }
	
	function work_agencias_funcionario_api($agencia){
		$persona = new Persona();
        $res = $persona->work_agencias_funcionario($agencia);
		
		if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
				
				$tmp = $row['Funcionario'];$tmp1="";$tmp2="";$total="";
				
				$res1 = $persona->work_agencias_funcionario_detalle_peso1($tmp, $agencia);
				$row1 = $res1->fetch(PDO::FETCH_ASSOC);
				$tmp1 = $row1['Total'];
				
	
				$res2 = $persona->work_agencias_funcionario_detalle_peso05($tmp, $agencia);
				$row2 = $res2->fetch(PDO::FETCH_ASSOC);
				$tmp2 = ($row2['Total']/2);
				
				$total = $tmp1 + $tmp2;
				
                echo "<tr>";
				echo "<td>" . $tmp . "</td>";
				echo "<td>" . $total . "</td>";
				echo "</tr>";
			}
        }
	}
	
    function get_utm($fec_inicio, $fec_fin){
        $persona = new Persona();
        $res = $persona->listado_utm($fec_inicio, $fec_fin);
		
		date_default_timezone_set('America/Lima');
		$hoy = date('Y-m-d');
		$ayer = date('Y-m-d', strtotime('yesterday'));
		
		$total1=0;$total2=0;$total3=0;$total4=0;$total5=0;$total6=0;
        
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
				
				$utm_tmp = $row['Nombre_Empresa']; 
				
				$res1 = $persona->conteo_utm_total($fec_inicio, $fec_fin, $utm_tmp);
				$row1 = $res1->fetch(PDO::FETCH_ASSOC);
				
				$res2 = $persona->conteo_utm_preaprobado($fec_inicio, $fec_fin, $utm_tmp);
				$row2 = $res2->fetch(PDO::FETCH_ASSOC);
				
				$res3 = $persona->conteo_utm_total($ayer, $ayer, $utm_tmp);
				$row3 = $res3->fetch(PDO::FETCH_ASSOC);
				
				$res4 = $persona->conteo_utm_preaprobado($ayer, $ayer, $utm_tmp);
				$row4 = $res4->fetch(PDO::FETCH_ASSOC);
				
				$res5 = $persona->conteo_utm_total($hoy, $hoy, $utm_tmp);
				$row5 = $res5->fetch(PDO::FETCH_ASSOC);
				
				$res6 = $persona->conteo_utm_preaprobado($hoy, $hoy, $utm_tmp);
				$row6 = $res6->fetch(PDO::FETCH_ASSOC);

				$tmp1 = $row1['Total'];
				$tmp2 = $row2['Total'];
				$tmp3 = $row3['Total'];
				$tmp4 = $row4['Total'];
				$tmp5 = $row5['Total'];
				$tmp6 = $row6['Total'];
				
				$total1 = $total1 + $tmp1;
				$total2 = $total2 + $tmp2;
				$total3 = $total3 + $tmp3;
				$total4 = $total4 + $tmp4;
				$total5 = $total5 + $tmp5;
				$total6 = $total6 + $tmp6;
			
				echo "<tr>" . "\n";
				echo "<td>" . $utm_tmp . "</td>\n";
				echo "<td>" . $tmp1 . "</td>\n";
				echo "<td>" . $tmp2 . "</td>\n";
				echo "<td>" . $tmp3 . "</td>\n";
				echo "<td>" . $tmp4 . "</td>\n";
				echo "<td>" . $tmp5 . "</td>\n";
				echo "<td>" . $tmp6 . "</td>\n";
                echo "</tr>" . "\n";
                
            }
			
				echo "<tr>" . "\n";
				echo "<td><b>Total</b></td>\n";
				echo "<td><b>" . $total1 . "</b></td>\n";
				echo "<td><b>" . $total2 . "</b></td>\n";
				echo "<td><b>" . $total3 . "</b></td>\n";
				echo "<td><b>" . $total4 . "</b></td>\n";
				echo "<td><b>" . $total5 . "</b></td>\n";
				echo "<td><b>" . $total6 . "</b></td>\n";
                echo "</tr>" . "\n";
        }
    }
	
	function get_utm_past($fec_inicio, $fec_fin){
        $persona = new Persona();
        $res = $persona->listado_utm($fec_inicio, $fec_fin);
		
		$total1=0;$total2=0;
        
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
				
				$utm_tmp = $row['Nombre_Empresa']; 
				
				$res1 = $persona->conteo_utm_total($fec_inicio, $fec_fin, $utm_tmp);
				$row1 = $res1->fetch(PDO::FETCH_ASSOC);
				
				$res2 = $persona->conteo_utm_preaprobado($fec_inicio, $fec_fin, $utm_tmp);
				$row2 = $res2->fetch(PDO::FETCH_ASSOC);
				

				$tmp1 = $row1['Total'];
				$tmp2 = $row2['Total'];
				
				$total1 = $total1 + $tmp1;
				$total2 = $total2 + $tmp2;
			
				echo "<tr>" . "\n";
				echo "<td>" . $utm_tmp . "</td>\n";
				echo "<td>" . $tmp1 . "</td>\n";
				echo "<td>" . $tmp2 . "</td>\n";
                echo "</tr>" . "\n";
                
            }
			
				echo "<tr>" . "\n";
				echo "<td><b>Total</b></td>\n";
				echo "<td><b>" . $total1 . "</b></td>\n";
				echo "<td><b>" . $total2 . "</b></td>\n";
                echo "</tr>" . "\n";
        }
    }

	function abrir_carta_api($session){
		$persona = new Persona();
        $res = $persona->abrir_carta($session);
		$i=1;$imprime="";$valor1=0;$valor2=0;
		if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
					$id_tmp = $row['Id'];
					
					$imprime = $imprime . "<img src='images/" . $row['Numero'] . ".png' width='160' height='160'>";
					if($valor1==0)
						$valor1 = $row['Numero'];
					else
						$valor2 = $row['Numero'];
					
					$res1 = $persona->carta_abierta($session, $id_tmp);
					$row1 = $res1->fetch(PDO::FETCH_ASSOC);
					
					if($i++==2)
					{
						$res2 = $persona->busca_combinacion($valor1, $valor2);
						$row2 = $res2->fetch(PDO::FETCH_ASSOC);
						echo "<input type='hidden' id='resp' value='" . $row2['Resultado'] . "'>";
						echo "<table class='table table-responsive text-center'><tr><td>" . $imprime . "</td></tr></table>";
						echo "<table class='table table-responsive table-primary'>";
						
						$res2 = $persona->lista_elementos($valor1, $valor2);
						//$row2 = $res2->fetch(PDO::FETCH_ASSOC);
						$j=1;
						
						if($res2->rowCount()){
							while ($row2 = $res2->fetch(PDO::FETCH_ASSOC)){
								$tmp_elemento = $row2['Nombre'];
							
								if($j==1 or $j==4 or $j==7 or $j==10 or $j==13)
									echo "<tr>";
								
									echo "<td class='text-center'><button type='button' class='btn btn-light btn-xs' onclick='validar(\"" . $tmp_elemento . "\")'><img src='images/" . $tmp_elemento . ".png'></button></td>";
								
								if($j==3 or $j==6 or $j==9 or $j==12 or $j==15)
									echo "</tr>";
								
								$j++;
								
							}
						}
						echo "</table>";
						break;
					}
			}
		}
		else
			echo "<input type='hidden' id='resp' value='vacio'>";
	}

	function empezar_otra_vez_api($session){
		$persona = new Persona();
        $res = $persona->empezar_otra_vez($session);
		echo "Nuevo juego";
	}

	function borrar_juego_api($session){
		$persona = new Persona();
        $res = $persona->borrar_juego($session);
		//echo "Juego Borrado";
	}

	function nuevo_juego_api($session){
		$persona = new Persona();
        $res = $persona->nuevo_juego($session);
		echo "<center><h2>Cuando estes listo, haz clic en Siguiente</h2></center>";
	}
	
	function getDocumento($dni){
        $persona = new Persona();
        $res = $persona->obtener_Documento($dni);
        
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
                echo "<b>" . $row['Desc_documento'] . "</b>";
            }
        }
    }
    
    function getAll3(){
        $persona = new Persona();
        $res = $persona->obtenerPersonas();
        
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
                echo "<tr>";
                echo "<td><p class='text-primary'>" . $row['Dni'] . " - " . $row['Nombres'] . "</p><p class='text-dark'><b>" . $row['Estado'] . "</b> - " . $row['Situacion'] . " - Sueldo Neto: " . $row['Sueldo_neto'] . " - Saldo para pagar cuota: " . $row['Saldo_pagar_cuota'] . " - Dias Atraso: " . $row['Dias_atraso'] ." - Deudas impagas: " . $row['Deudas_impagas'] ." - Deuda en sistema: " . $row['Deuda_sistema'] . "</p><p class='text-success'>" . $row['Ruc'] . "- " . $row['Nombre_empresa'] . "</p><p class='text-dark'>" . $row['Fecha'] . "</p></td>";
                echo "</tr>";
            }
        }
    }
	
	function consulta_funcionario($funcionario){
		$persona = new Persona();
        $res = $persona->activo_funcionario($funcionario);
		$row = $res->fetch(PDO::FETCH_ASSOC);
		$tmp = $row['Activo'];	
		
		$imprime = "";
		
		if($tmp=="n")
			$imprime = "On/Off <input type='checkbox' id='$funcionario'>" . "\n";
		else
			$imprime = "On/Off <input type='checkbox' id='$funcionario' checked>" . "\n";;
		
			echo "<label class='switch'>" . "\n";
			echo $imprime;
			echo "<span class='slider round'></span>" . "\n";
			echo "</label>" . "\n";
	}
	
	function consulta_digital($funcionario){
		$persona = new Persona();
        $res = $persona->activo_funcionario_digital($funcionario);
		$row = $res->fetch(PDO::FETCH_ASSOC);
		$tmp = $row['Activo'];	
		
		$imprime = "";
		
		if($tmp=="n")
			$imprime = "On/Off <input type='checkbox' id='$funcionario'>" . "\n";
		else
			$imprime = "On/Off <input type='checkbox' id='$funcionario' checked>" . "\n";;
		
			echo "<label class='switch'>" . "\n";
			echo $imprime;
			echo "<span class='slider round'></span>" . "\n";
			echo "</label>" . "\n";
	}
		

    function getPasos2($step, $funcionario){
        $persona = new Persona();
        $res = $persona->obtenerPasos2($step, $funcionario);
        
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
                $tmp = "";
                $color = "";
                if(substr($row['Funcionario'],0,5)=="XIOMI"){
                    $tmp = "XC";
                    $color = "success";
                }
                if(substr($row['Funcionario'],0,5)=="KAORI"){
                    $tmp = "KU";
                    $color = "danger";
                }
                if(substr($row['Funcionario'],0,5)=="JOHAN"){
                    $tmp = "JD";
                    $color = "primary";
                }
                echo "<div class='card mb-3' style='max-width: 18rem;' draggable='true' ondragstart='drag(event)'  id='" . $row['Id'] . "'>\n";
                echo "<div class='card-header' ondrop='return false' data-toggle='modal' data-target='#Mod" . $row['Id'] . "'><small><b>" . $row['Dni'] . " - " . $row['Nombres'] . "</b> - " . $row['Fecha'] . " === " .  strtoupper($row['Observaciones']) . " S/ " . number_format($row['Monto'],0) . " </small><button type='button' class='btn btn-" . $color . " btn-xs'>". $tmp . "</button></div>\n"; 
	            echo "</div>\n\n";
            }
        }
    }
	
    function getPasos2_descartados($step, $funcionario){
        $persona = new Persona();
        $res = $persona->obtenerPasos2_descartados($step, $funcionario);
        
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
                $tmp = "";
                $color = "";
                if(substr($row['Funcionario'],0,5)=="XIOMI"){
                    $tmp = "XC";
                    $color = "success";
                }
                if(substr($row['Funcionario'],0,5)=="KAORI"){
                    $tmp = "KU";
                    $color = "danger";
                }
                if(substr($row['Funcionario'],0,5)=="JOHAN"){
                    $tmp = "JD";
                    $color = "primary";
                }
                echo "<div class='card mb-3' style='max-width: 18rem;' draggable='true' ondragstart='drag(event)'  id='" . $row['Id'] . "'>\n";
                echo "<div class='card-header' ondrop='return false' data-toggle='modal' data-target='#Mod" . $row['Id'] . "'><small><b>" . $row['Dni'] . " - " . $row['Nombres'] . "</b> - " . $row['Fecha'] . " === " .  strtoupper($row['Observaciones']) . " S/ " . number_format($row['Monto'],0) . " </small><button type='button' class='btn btn-" . $color . " btn-xs'>". $tmp . "</button></div>\n"; 
	            echo "</div>\n\n";
            }
        }
    }

    
    function getPasos_kyodai($step, $funcionario){
        $persona = new Persona();
        $res = $persona->obtenerPasos_kyodai($step, $funcionario);
        
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
                $tmp = "";
                $color = "";
                if(substr($row['Funcionario'],0,5)=="PAULO"){
                    $tmp = "PT";
                    $color = "success";
                }
                if(substr($row['Funcionario'],0,5)=="PATTY"){
                    $tmp = "PG";
                    $color = "danger";
                }
                
                echo "<div class='card mb-3' style='max-width: 18rem;' draggable='true' ondragstart='drag(event)'  id='" . $row['Id'] . "'>\n";
                echo "<div class='card-header' ondrop='return false' data-toggle='modal' data-target='#Mod" . $row['Id'] . "'><small><b>" . $row['Dni'] . " - " . $row['Ape_pat'] . " " . $row['Ape_mat'] . ", " . $row['Nombres'] . "</b> - " . $row['Fecha'] . " === " .  strtoupper($row['Observaciones']) . " </small><button type='button' class='btn btn-" . $color . " btn-xs'>". $tmp . "</button></div>\n"; 
	            echo "</div>\n\n";
            }
        }
    }
	
    function getPasos_tablero_agencias($step, $agencia, $funcionario){
        $persona = new Persona();
        $res = $persona->obtenerPasos_agencias2($step, $agencia, $funcionario);
		
		$array = array("primary", "success", "danger", "warning", "info", "primary", "secondary","success");
		
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
                $tmp="";$color="";$color2="";$correo="";$ini="";$fin="";$divisa="";
				
				if($step=="div6")
					$color = " bg-info";
				else
					$color = "";
				
								
				$correo = $row['Funcionario'];
				$correo = substr($correo, 0, strrpos($correo,'@',0));
				$pos = strrpos($correo,'.',0);
				$ini = strtoupper(substr($correo,0,1));
				$fin = strtoupper(substr($correo,$pos+1,1));
				$tmp = $ini . $fin;
				
				
				if(count($_SESSION ['func'])==0){
					array_push($_SESSION ['func'], $tmp);	
				}else{
					$m=0;
					for($j=0;$j<count($_SESSION ['func']);$j++){
							if($_SESSION ['func'][$j]==$tmp)
								$m++;
					}
					if($m==0)
						array_push($_SESSION ['func'], $tmp);
				}
				
				for($j=0;$j<count($_SESSION ['func']);$j++){
						if($_SESSION ['func'][$j]==$tmp)
							$color2 = $array[$j];
				}
				
				if($row['Moneda']==1){
						$divisa=" S/ ";
				}
				if($row['Moneda']==2){
						$divisa=" $ ";
				}	
				
				
                echo "<div class='card mb-3" . $color . "' style='max-width: 18rem;' draggable='true' ondragstart='drag(event)'  id='" . $row['Id'] . "'>\n";
                echo "<div class='card-header' ondrop='return false' data-toggle='modal' data-target='#Mod" . $row['Id'] . "'><small><b>" . $row['Dni'] . " - " . $row['Nombres'] . "</b> - " . $row['Fecha'] . " === " .  strtoupper($row['Observaciones']) . $divisa . number_format($row['Monto'],0) . " </small><button type='button' class='btn btn-" . $color2 . " btn-xs'>". $tmp . "</button></div>\n"; 
	            echo "</div>\n\n";
            }
        }
    }
	
    function getPasos_agencias($step, $funcionario){
        $persona = new Persona();
        $res = $persona->obtenerPasos_agencias($step, $funcionario);
        
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
                $tmp = "";
                $color = "";
                if(substr($row['Funcionario'],0,5)=="Saman"){
                    $tmp = "SPL";
                    $color = "success";
                }
                if(substr($row['Funcionario'],0,5)=="Dayss"){
                    $tmp = "DAP";
                    $color = "danger";
                }
				if(substr($row['Funcionario'],0,5)=="Danie"){
                    $tmp = "DPG";
                    $color = "warning";
                }
				if(substr($row['Funcionario'],0,5)=="Gabri"){
                    $tmp = "GTG";
                    $color = "primary";
                }
				if(substr($row['Funcionario'],0,5)=="Cinth"){
                    $tmp = "CLP";
                    $color = "info";
                }
				if(substr($row['Funcionario'],0,5)=="Chris"){
                    $tmp = "CJV";
                    $color = "dark";
                }
				if(substr($row['Funcionario'],0,5)=="Gianc"){
                    $tmp = "GP";
                    $color = "secondary";
                }
				
				$tarea="";
				if($row['Tarea']=="prestamo"){
                    $tarea = "<span style='color:blue'>[Prestamo]</span>";
                }
				if($row['Tarea']=="captacion"){
                    $tarea = "<span style='color:green'>[Captacion]</span>";
                }
				if($row['Tarea']=="otros"){
                    $tarea = "<span style='color:red'>[Otros]</span>";
                }
				$tmp1=0;$urgente="";$dni="";
				$dni = $row['Dni'];
				
				if($dni!="")
				{
					$res1 = $persona->dniRepetidoAgencias($dni);
					$row1 = $res1->fetch(PDO::FETCH_ASSOC);
					$tmp1 = $row1['Total'];
				}
				
				if($row['Urgente']==1)
					$urgente = " bg-danger text-white";
				else
					$urgente = "";
				
				if($tmp1>1)
					$urgente = " bg-dark text-white";
				else
					$urgente = "";
				
                
                echo "<div class='card mb-3" . $urgente . "' style='max-width: 18rem;' draggable='true' ondragstart='drag(event)'  id='" . $row['Id'] . "'>\n";
                echo "<div class='card-header' ondrop='return false' data-toggle='modal' data-target='#Mod" . $row['Id'] . "'><small><b>" . $dni . " - " . $row['Nombres'] . "</b> - " . $row['Fecha'] . " === " .  strtoupper($row['Observaciones']) . " S/ " . number_format($row['Monto'],0) . " </small><button type='button' class='btn btn-" . $color . " btn-xs'>". $tmp . "</button> " . $tarea . "</div>\n"; 
	            echo "</div>\n\n";
            }
        }
    }
	
	function getPasos_agencias_sandbox($step, $funcionario){
        $persona = new Persona();
        $res = $persona->obtenerPasos_agencias($step, $funcionario);
        
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
                $tmp = "";
                $color = "";
                if(substr($row['Funcionario'],0,5)=="Saman"){
                    $tmp = "SPL";
                    $color = "success";
                }
                if(substr($row['Funcionario'],0,5)=="Dayss"){
                    $tmp = "DAP";
                    $color = "danger";
                }
				if(substr($row['Funcionario'],0,5)=="Danie"){
                    $tmp = "DPG";
                    $color = "warning";
                }
				if(substr($row['Funcionario'],0,5)=="Gabri"){
                    $tmp = "GTG";
                    $color = "primary";
                }
				if(substr($row['Funcionario'],0,5)=="Cinth"){
                    $tmp = "CLP";
                    $color = "info";
                }
				if(substr($row['Funcionario'],0,5)=="Chris"){
                    $tmp = "CJV";
                    $color = "dark";
                }
				if(substr($row['Funcionario'],0,5)=="Gianc"){
                    $tmp = "GP";
                    $color = "secondary";
                }
				
				$tarea="";
				if($row['Tarea']=="prestamo"){
                    $tarea = "<span style='color:blue'>[Prestamo]</span>";
                }
				if($row['Tarea']=="captacion"){
                    $tarea = "<span style='color:green'>[Captacion]</span>";
                }
				if($row['Tarea']=="otros"){
                    $tarea = "<span style='color:red'>[Otros]</span>";
                }
				$tmp1=0;$urgente="";$dni="";
				$dni = $row['Dni'];
				
				$res1 = $persona->dniRepetidoAgencias($dni);
				$row1 = $res1->fetch(PDO::FETCH_ASSOC);
				$tmp1 = $row1['Total'];
				
				if($row['Urgente']==1)
					$urgente = " bg-danger text-white";
				else
					$urgente = "";
				
				if($tmp1>1)
					$urgente = " bg-dark text-white";
				else
					$urgente = "";
				
                
                echo "<div class='card mb-3" . $urgente . "' style='max-width: 18rem;' draggable='true' ondragstart='drag(event)'  id='" . $row['Id'] . "'>\n";
                echo "<div class='card-header' ondrop='return false' data-toggle='modal' data-target='#Mod" . $row['Id'] . "'><small><b>" . $dni . " - " . $row['Nombres'] . "</b> - " . $row['Fecha'] . " === " .  strtoupper($row['Observaciones']) . " S/ " . number_format($row['Monto'],0) . " </small><button type='button' class='btn btn-" . $color . " btn-xs'>". $tmp . "</button> " . $tarea . "</div>\n"; 
	            echo "</div>\n\n";
            }
        }
    }

    function getPasos_agencias_central($step, $funcionario){
        $persona = new Persona();
        $res = $persona->obtenerPasos_agencias($step, $funcionario);
        
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
                $tmp = "";
                $color = "";
                if(substr($row['Funcionario'],0,5)=="Saman"){
                    $tmp = "SPL";
                    $color = "success";
                }
                if(substr($row['Funcionario'],0,5)=="Dayss"){
                    $tmp = "DAP";
                    $color = "danger";
                }
				if(substr($row['Funcionario'],0,5)=="Danie"){
                    $tmp = "DPG";
                    $color = "warning";
                }
				if(substr($row['Funcionario'],0,5)=="Gabri"){
                    $tmp = "GTG";
                    $color = "primary";
                }
				if(substr($row['Funcionario'],0,5)=="Cinth"){
                    $tmp = "CLP";
                    $color = "info";
                }
				if(substr($row['Funcionario'],0,5)=="Chris"){
                    $tmp = "CJV";
                    $color = "dark";
                }
				if(substr($row['Funcionario'],0,5)=="Gianc"){
                    $tmp = "GP";
                    $color = "secondary";
                }
				
				$tarea="";
				if($row['Tarea']=="prestamo"){
                    $tarea = "<span style='color:blue'>[Prestamo]</span>";
                }
				if($row['Tarea']=="captacion"){
                    $tarea = "<span style='color:green'>[Captacion]</span>";
                }
				if($row['Tarea']=="otros"){
                    $tarea = "<span style='color:red'>[Otros]</span>";
                }
				
				if($row['Urgente']==1)
					$urgente = " bg-danger";
				else
					$urgente = "";
                
                echo "<div class='card mb-3" . $urgente . "' style='max-width: 18rem;' draggable='true' ondragstart='drag(event)'  id='" . $row['Id'] . "'>\n";
                echo "<div class='card-header' ondrop='return false' data-toggle='modal' data-target='#Mod" . $row['Id'] . "'><small><b>" . $row['Dni'] . " - " . $row['Nombres'] . "</b> - " . $row['Fecha'] . " === " .  strtoupper($row['Observaciones']) . " S/ " . number_format($row['Monto'],0) . " </small><button type='button' class='btn btn-" . $color . " btn-xs'>". $tmp . "</button> " . $tarea . "</div>\n"; 
	            echo "</div>\n\n";
            }
        }
    }    
        function getPasos3($step, $funcionario){
        $persona = new Persona();
        $res = $persona->obtenerPasos2_desemb($step, $funcionario);
        
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
                $tmp = "";
                $color = "";
                if(substr($row['Funcionario'],0,5)=="XIOMI"){
                    $tmp = "XC";
                    $color = "success";
                }
                if(substr($row['Funcionario'],0,5)=="KAORI"){
                    $tmp = "KU";
                    $color = "danger";
                }
                if(substr($row['Funcionario'],0,5)=="JOHAN"){
                    $tmp = "JD";
                    $color = "primary";
                }
                echo "<div class='card mb-3 bg-info' style='max-width: 18rem;' draggable='true' ondragstart='drag(event)'  id='" . $row['Id'] . "'>\n";
                echo "<div class='card-header' ondrop='return false' data-toggle='modal' data-target='#Mod" . $row['Id'] . "'><small><b>" . $row['Dni'] . " - " . $row['Nombres'] . "</b> - " . $row['Fecha'] . " === " .  strtoupper($row['Observaciones']) . " S/ " . number_format($row['Monto'],0) . " </small><button type='button' class='btn btn-" . $color . " btn-xs'>". $tmp . "</button></div>\n"; 
	            echo "</div>\n\n";
            }
        }
    }
    
    function getPasos3_Kyodai($step, $funcionario){
        $persona = new Persona();
        $res = $persona->obtenerPasos_kyodai($step, $funcionario);
        
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
                $tmp = "";
                $color = "";
                if(substr($row['Funcionario'],0,5)=="PAULO"){
                    $tmp = "PT";
                    $color = "success";
                }
                if(substr($row['Funcionario'],0,5)=="PATTY"){
                    $tmp = "PG";
                    $color = "danger";
                }

                echo "<div class='card mb-3 bg-info' style='max-width: 18rem;' draggable='true' ondragstart='drag(event)'  id='" . $row['Id'] . "'>\n";
                echo "<div class='card-header' ondrop='return false' data-toggle='modal' data-target='#Mod" . $row['Id'] . "'><small><b>" . $row['Dni'] . " - " . $row['Ape_pat'] . " " . $row['Ape_mat'] . ", " . $row['Nombres'] . "</b> - " . $row['Fecha'] . " === " .  strtoupper($row['Observaciones']) . " </small><button type='button' class='btn btn-" . $color . " btn-xs'>". $tmp . "</button></div>\n";  
	            echo "</div>\n\n";
            }
        }
    }
	
    function getPasos3_agencias($step, $funcionario){
        $persona = new Persona();
        $res = $persona->obtenerPasos_agencias_desemb($step, $funcionario);
        
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
                $tmp = "";
                $color = "";
                if(substr($row['Funcionario'],0,5)=="Saman"){
                    $tmp = "SPL";
                    $color = "success";
                }
                if(substr($row['Funcionario'],0,5)=="Dayss"){
                    $tmp = "DAP";
                    $color = "danger";
                }
				if(substr($row['Funcionario'],0,5)=="Danie"){
                    $tmp = "DPG";
                    $color = "warning";
                }
				if(substr($row['Funcionario'],0,5)=="Gabri"){
                    $tmp = "GTG";
                    $color = "primary";
                }
				if(substr($row['Funcionario'],0,5)=="Cinth"){
                    $tmp = "CLP";
                    $color = "info";
                }
				if(substr($row['Funcionario'],0,5)=="Chris"){
                    $tmp = "CJV";
                    $color = "dark";
                }
				if(substr($row['Funcionario'],0,5)=="Gianc"){
                    $tmp = "GP";
                    $color = "secondary";
                }
				
				$tarea="";
				if($row['Tarea']=="prestamo"){
                    $tarea = "<span style='color:blue'>[Prestamo]</span>";
                }
				if($row['Tarea']=="captacion"){
                    $tarea = "<span style='color:green'>[Captacion]</span>";
                }
				if($row['Tarea']=="otros"){
                    $tarea = "<span style='color:red'>[Otros]</span>";
                }

                echo "<div class='card mb-3 bg-info' style='max-width: 18rem;' draggable='true' ondragstart='drag(event)'  id='" . $row['Id'] . "'>\n";
                echo "<div class='card-header' ondrop='return false' data-toggle='modal' data-target='#Mod" . $row['Id'] . "'><small><b>" . $row['Dni'] . " - " . $row['Nombres'] . "</b> - " . $row['Fecha'] . " === " .  strtoupper($row['Observaciones']) . " S/ " . number_format($row['Monto'],0) . " </small><button type='button' class='btn btn-" . $color . " btn-xs'>". $tmp . "</button> " . $tarea . "</div>\n";  
	            echo "</div>\n\n";
            }
        }
    }
    
    function getModals($funcionario){
        $persona = new Persona();
        $res = $persona->obtenerModals($funcionario);
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
                $sex ="";$cal="";$utm="";$obs_agencias="";
                if($row['Sexo']=="MASCULINO"){
                    $sex = "👨";
                }
                if($row['Sexo']=="FEMENINO"){
                    $sex = "👩";
                }
                
                $AnoAct = date('Y');
	            $edad = $AnoAct - $row['Nacimiento'];
	            
	            if($row['Situacion']=="NOR"){
	                $cal = "<button type=button class=\"btn btn-success btn-xs\">NOR</button>";
	            }
	            if($row['Situacion']=="CPP"){
	                $cal = "<button type=button class=\"btn btn-warning btn-xs\">CPP</button>";
	            }
	            if($row['Situacion']=="DUD"){
	                $cal = "<button type=button class=\"btn btn-danger btn-xs\">DUD</button>";
	            }
	            if($row['Situacion']=="DEF"){
	                $cal = "<button type=button class=\"btn btn-danger btn-xs\">DEF</button>";
	            }
	            if($row['Situacion']=="PER"){
	                $cal = "<button type=button class=\"btn btn-dark btn-xs\">PER</button>";
	            }
	            if($row['Situacion']=="SC"){
	                $cal = "<button type=button class=\"btn btn-secondary btn-xs\">SCA</button>";
	            }
                
                if($row['Nombre_empresa']==""){
                    $utm = "Organico";
                }
                else{
                    $utm = $row['Nombre_empresa'];
                }
                
                $nom_tmp = ucfirst(strtolower(trim(substr($row['Nombres'],strpos($row['Nombres'],",")+1))));
                
                echo "<div class='modal fade' id='Mod" . $row['Id'] . "' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>" . "\n";
                echo "<div class='modal-dialog modal-dialog-centered' role='document'>" . "\n";
                echo "<div class='modal-content'>" . "\n";
                echo "<div class='modal-header'>". "\n"; 
                echo "<h5 class='modal-title' id='exampleModalLongTitle'>" . $sex . " [" . $edad . " años] DNI [" . $row['Dni'] . "] - " . $row['Nombres'] . "<br>" . $cal . " Deudas Impagas S/ " . $row['Deudas_impagas'] . " Deuda en el Sistema S/ " . $row['Deuda_sistema'] . " <br>Celular [" . $row['Celular'] . "] - " . $row['Correo'] . "<br>" . $row['Fecha']  . " Origen [" . $utm . "]<br>Ult. Modificación " . $row['Fecha_2'] .  "<br>\n";
				echo "<a href='/score?dni=" . $row['Dni'] . "' target='_blank'>Radar Sentinel</a>"."\n";
				
				$res6 = $persona->buscar_EnAgencia($row['Dni']);
				if($res6->rowCount()){
					while ($row6 = $res6->fetch(PDO::FETCH_ASSOC)){
						$obs_agencias = $row6['Observaciones'];
						echo "<br><span style='color:blue'>En agencias desde: " . $row6['Fecha'] . "</span><br>";
						echo "<span style='color:blue'>Ultima modificación fue: " . $row6['Fecha_2'] . "</span><br>";
						echo "<span style='color:blue'>[Obs Agencia: " . $obs_agencias . "]</span>";
						break;
					}
					echo "<br>";
				}

				echo "</h5>" . "\n";
				
                echo "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>" . "\n"; 
                echo "<span aria-hidden='true'>&times;</span>" . "\n"; 
                echo "</button>" . "\n";
                echo "</div>". "\n";   
                echo "<div class='modal-body'>" . "\n";
				echo "Historia<br>" . "\n";
				$res9 = $persona->obtener_Historia($row['Dni'],$row['Fecha']);
				if($res9->rowCount()){
					while ($row9 = $res9->fetch(PDO::FETCH_ASSOC)){
						$obser="";$datostmp="";
						$datostmp = $row9['Fecha'] . " = " . $row9['Estado'] . "/" . $row9['Funcionario'];
						$obser =  $row9['Observaciones'];
						echo "<span style='color:green'>" . $datostmp . " </span><br>";
						echo "<span style='color:black'>" . $obser . " </span><br>";
					}
					echo "<br>";
				}
				
                $div1="";$div2="";$div3="";$div4="";$div5="";$div6="";$div7="";
                if($row['Paso']=="div1"){
                    $div1="selected ";
                }
                if($row['Paso']=="div2"){
                    $div2="selected ";
                }
                if($row['Paso']=="div3"){
                    $div3="selected ";
                }
                if($row['Paso']=="div4"){
                    $div4="selected ";
                }
                if($row['Paso']=="div5"){
                    $div5="selected ";
                }
                if($row['Paso']=="div6"){
                    $div6="selected ";
                }
                if($row['Paso']=="div7"){
                    $div7="selected ";
                }

                echo "<textarea class='form-control' id='text" . $row['Id'] . "'>" . strtoupper($row['Observaciones']) . "</textarea>" . "\n";
                echo "Monto a prestar S/ <input type='text' class='form-control' id='mont" . $row['Id'] ."' value='" . number_format($row['Monto'],0,'.','') . "'><br>" . "\n";
				
				$funcX="";$funcK="";$funcJ="";$correo_f="";$sms_func="";
				if(substr($row['Funcionario'],0,5)=="XIOMI"){
                    $funcX="selected ";
					$correo_f="xiomi.caycho@cp.com.pe";
					$sms_func = " funcionaria asignada es Xiomi Caycho,";
                }
                if(substr($row['Funcionario'],0,5)=="KAORI"){
                    $funcK="selected ";
					$correo_f="kaori.urbina@cp.com.pe";
					$sms_func = " funcionaria asignada es Kaori Urbina,";
                }
				if(substr($row['Funcionario'],0,5)=="JOHAN"){
                    $funcJ="selected ";
					$correo_f="johann.diaz@cp.com.pe";
					$sms_func = " funcionario asignado es Johann Diaz,";
                }
				
                echo "<select class='form-select-lg' aria-label='Default select example' id='combo" .$row['Id']. "'>" . "\n";
                echo "<option " . $div1. "value='div1'>Por Contactar</option>". "\n";
                echo "<option " . $div2. "value='div2'>En Evaluación</option>". "\n";
                echo "<option " . $div4. "value='div4'>En Verificaciones</option>". "\n";
                echo "<option " . $div3. "value='div3'>En Revisión</option>". "\n";
                echo "<option " . $div5. "value='div5'>Firma de Crédito</option>". "\n";
                echo "<option " . $div6. "value='div6'>Desembolsado</option>". "\n";
                echo "<option " . $div7. "value='div7'>Descartados</option>". "\n";
                echo "</select>";
				echo " ";
                echo "<select class='form-select-lg' aria-label='Default select example' id='func" .$row['Id']. "'>" . "\n";
                echo "<option " . $funcX. "value='XIOMI'>Xiomi</option>". "\n";
                echo "<option " . $funcK. "value='KAORI'>Kaori</option>". "\n";
                echo "<option " . $funcJ. "value='JOHANN'>Johann</option>". "\n";
                echo "</select>";

				echo " Posponer <input type='date' value='' aria-label='Default select example' id='fec_ingreso" . $row['Id'] . "'>" . "\n";
				
				echo "<br>". "\n";
				
				
				$res4 = $persona->obtener_Documento($row['Dni'],);
				if($res4->rowCount()){
					while ($row4 = $res4->fetch(PDO::FETCH_ASSOC)){
						$nombretmp = $row4['Desc_Documento'];
						echo "<span style='color:blue'><u><a href='/archivos/" . $row4['Desc_Documento'] . "'>" . $nombretmp . "</a></u></span><br>";
					}
					echo "<br>";
				}
				
                echo "</div>" . "\n";
                echo "<div class='modal-footer'>" . "\n";
				if($row['Paso']=="div3"){
				echo "<button type='button' data-dismiss='modal' class='btn btn-outline-success btn-xs' onclick=\"mail('" . $row['Dni'] . "','" . $row['Nombres'] . "','" . number_format($row['Monto'],0,'.','') . "','" . $correo_f . "')\">Mail Agen</button> |". "\n";
				}
				echo "<button type='button' class='btn btn-outline-danger btn-xs' onclick=\"sms('" . $row['Celular'] . "','" . $nom_tmp . "','" . $sms_func . "','Nocalifica')\">SMS No Califica</button> |". "\n";
                echo "<button type='button' class='btn btn-outline-primary btn-xs' onclick=\"sms('" . $row['Celular'] . "','" . $nom_tmp . "','" . $sms_func . "','Preaprobado')\">SMS Preaprobado</button>". "\n";
                echo "<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>" . "\n";
                echo "<button type='button' class='btn btn-primary' data-dismiss='modal' onclick='graba(" . $row['Id'] . ")'>Guardar</button>" . "\n";
                echo "</div>" . "\n";
                echo "</div>" . "\n";
                echo "</div>" . "\n";
		        echo "</div>" . "\n\n";
            }
        }
                
                
    }
	
    function getModals_descartados($funcionario){
        $persona = new Persona();
        $res = $persona->getModals_descartados($funcionario);
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
                $sex ="";$cal="";$utm="";
                if($row['Sexo']=="MASCULINO"){
                    $sex = "👨";
                }
                if($row['Sexo']=="FEMENINO"){
                    $sex = "👩";
                }
                
                $AnoAct = date('Y');
	            $edad = $AnoAct - $row['Nacimiento'];
	            
	            if($row['Situacion']=="NOR"){
	                $cal = "<button type=button class=\"btn btn-success btn-xs\">NOR</button>";
	            }
	            if($row['Situacion']=="CPP"){
	                $cal = "<button type=button class=\"btn btn-warning btn-xs\">CPP</button>";
	            }
	            if($row['Situacion']=="DUD"){
	                $cal = "<button type=button class=\"btn btn-danger btn-xs\">DUD</button>";
	            }
	            if($row['Situacion']=="DEF"){
	                $cal = "<button type=button class=\"btn btn-danger btn-xs\">DEF</button>";
	            }
	            if($row['Situacion']=="PER"){
	                $cal = "<button type=button class=\"btn btn-dark btn-xs\">PER</button>";
	            }
	            if($row['Situacion']=="SC"){
	                $cal = "<button type=button class=\"btn btn-secondary btn-xs\">SCA</button>";
	            }
                
                if($row['Nombre_empresa']==""){
                    $utm = "Organico";
                }
                else{
                    $utm = $row['Nombre_empresa'];
                }
                
                $nom_tmp = ucfirst(strtolower(trim(substr($row['Nombres'],strpos($row['Nombres'],",")+1))));
                
                echo "<div class='modal fade' id='Mod" . $row['Id'] . "' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>" . "\n";
                echo "<div class='modal-dialog modal-dialog-centered' role='document'>" . "\n";
                echo "<div class='modal-content'>" . "\n";
                echo "<div class='modal-header'>". "\n"; 
                echo "<h5 class='modal-title' id='exampleModalLongTitle'>" . $sex . " [" . $edad . " años] DNI [" . $row['Dni'] . "] - " . $row['Nombres'] . "<br>" . $cal . " Deudas Impagas S/ " . $row['Deudas_impagas'] . " Deuda en el Sistema S/ " . $row['Deuda_sistema'] . " <br>Celular [" . $row['Celular'] . "] - " . $row['Correo'] . "<br>" . $row['Fecha']  . " Origen [" . $utm . "]<br>Ult. Modificación " . $row['Fecha_2'] .  "\n";
				
				$res6 = $persona->buscar_EnAgencia($row['Dni']);
				if($res6->rowCount()){
					while ($row6 = $res6->fetch(PDO::FETCH_ASSOC)){
						$nombretmp = $row6['Desc_Documento'];
						echo "<br><span style='color:blue'>En agencias desde: " . $row6['Fecha'] . "</span><br>";
						echo "<span style='color:blue'>Ultima modificación fue: " . $row6['Fecha_2'] . "</span>";
						break;
					}
					echo "<br>";
				}

				echo "</h5>" . "\n";
				
                echo "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>" . "\n"; 
                echo "<span aria-hidden='true'>&times;</span>" . "\n"; 
                echo "</button>" . "\n";
                echo "</div>". "\n";   
                echo "<div class='modal-body'>" . "\n";
				echo "Historia<br>" . "\n";
								
				$res9 = $persona->obtener_Historia($row['Dni'],$row['Fecha']);
				if($res9->rowCount()){
					while ($row9 = $res9->fetch(PDO::FETCH_ASSOC)){
						$obser="";$datostmp="";
						$datostmp = $row9['Fecha'] . " = " . $row9['Estado'] . "/" . $row9['Funcionario'];
						$obser =  $row9['Observaciones'];
						echo "<span style='color:green'>" . $datostmp . " </span><br>";
						echo "<span style='color:black'>" . $obser . " </span><br>";
					}
					echo "<br>";
				}
				
                echo "<textarea class='form-control' id='text" . $row['Id'] . "'>" . strtoupper($row['Observaciones']) . "</textarea>" . "\n";
                echo "Monto a prestar S/ <input type='text' class='form-control' id='mont" . $row['Id'] ."' value='" . number_format($row['Monto'],0,'.','') . "'><br>" . "\n";
                 
                $div1="";$div2="";$div3="";$div4="";$div5="";$div6="";$div7="";
                if($row['Paso']=="div1"){
                    $div1="selected ";
                }
                if($row['Paso']=="div2"){
                    $div2="selected ";
                }
                if($row['Paso']=="div3"){
                    $div3="selected ";
                }
                if($row['Paso']=="div4"){
                    $div4="selected ";
                }
                if($row['Paso']=="div5"){
                    $div5="selected ";
                }
                if($row['Paso']=="div6"){
                    $div6="selected ";
                }
                if($row['Paso']=="div7"){
                    $div7="selected ";
                }
				
				$funcX="";$funcK="";$funcJ="";$correo_f="";
				if(substr($row['Funcionario'],0,5)=="XIOMI"){
                    $funcX="selected ";
					$correo_f="xiomi.caycho@cp.com.pe";
                }
                if(substr($row['Funcionario'],0,5)=="KAORI"){
                    $funcK="selected ";
					$correo_f="kaori.urbina@cp.com.pe";
                }
				if(substr($row['Funcionario'],0,5)=="JOHAN"){
                    $funcJ="selected ";
					$correo_f="johann.diaz@cp.com.pe";
                }
				
                echo "<select class='form-select-lg' aria-label='Default select example' id='combo" .$row['Id']. "'>" . "\n";
                echo "<option " . $div1. "value='div1'>Por Contactar</option>". "\n";
                echo "<option " . $div2. "value='div2'>En Evaluación</option>". "\n";
                echo "<option " . $div4. "value='div4'>En Verificaciones</option>". "\n";
                echo "<option " . $div3. "value='div3'>En Revisión</option>". "\n";
                echo "<option " . $div5. "value='div5'>Firma de Crédito</option>". "\n";
                echo "<option " . $div6. "value='div6'>Desembolsado</option>". "\n";
                echo "<option " . $div7. "value='div7'>Descartados</option>". "\n";
                echo "</select>";
				echo " ";
                echo "<select class='form-select-lg' aria-label='Default select example' id='func" .$row['Id']. "'>" . "\n";
                echo "<option " . $funcX. "value='XIOMI'>Xiomi</option>". "\n";
                echo "<option " . $funcK. "value='KAORI'>Kaori</option>". "\n";
                echo "<option " . $funcJ. "value='JOHANN'>Johann</option>". "\n";
                echo "</select>";
				
				echo "<br>". "\n";
				
				
				$res4 = $persona->obtener_Documento($row['Dni']);
				if($res4->rowCount()){
					while ($row4 = $res4->fetch(PDO::FETCH_ASSOC)){
						$nombretmp = $row4['Desc_Documento'];
						echo "<span style='color:blue'><u><a href='/archivos/" . $row4['Desc_Documento'] . "'>" . $nombretmp . "</a></u></span><br>";
					}
					echo "<br>";
				}
				
                echo "</div>" . "\n";
                echo "<div class='modal-footer'>" . "\n";
				if($row['Paso']=="div3"){
				echo "<button type='button' data-dismiss='modal' class='btn btn-outline-success btn-xs' onclick=\"mail('" . $row['Dni'] . "','" . $row['Nombres'] . "','" . number_format($row['Monto'],0,'.','') . "','" . $correo_f . "')\">Mail Agen</button> |". "\n";
				}
				echo "<button type='button' class='btn btn-outline-danger btn-xs' onclick=\"sms('" . $row['Celular'] . "','" . $nom_tmp . "','Nocalifica')\">SMS No Califica</button> |". "\n";
                echo "<button type='button' class='btn btn-outline-primary btn-xs' onclick=\"sms('" . $row['Celular'] . "','" . $nom_tmp . "','Preaprobado')\">SMS Preaprobado</button>". "\n";
                echo "<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>" . "\n";
                echo "<button type='button' class='btn btn-primary' data-dismiss='modal' onclick='graba(" . $row['Id'] . ")'>Guardar</button>" . "\n";
                echo "</div>" . "\n";
                echo "</div>" . "\n";
                echo "</div>" . "\n";
		        echo "</div>" . "\n\n";
            }
        }
                
                
    }

    function getModals_kyodai(){
        $persona = new Persona();
        $res = $persona->obtenerModals_kyodai();
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
                $sex ="";$cal="";$utm="";
                if($row['Sexo']=="MASCULINO"){
                    $sex = "👨";
                }
                if($row['Sexo']=="FEMENINO"){
                    $sex = "👩";
                }
                
                $AnoAct = date('Y');
	            $edad = $AnoAct - $row['Nacimiento'];
	            
	            if($row['Situacion']=="NOR"){
	                $cal = "<button type=button class=\"btn btn-success btn-xs\">NOR</button>";
	            }
	            if($row['Situacion']=="CPP"){
	                $cal = "<button type=button class=\"btn btn-warning btn-xs\">CPP</button>";
	            }
	            if($row['Situacion']=="DUD"){
	                $cal = "<button type=button class=\"btn btn-danger btn-xs\">DUD</button>";
	            }
	            if($row['Situacion']=="DEF"){
	                $cal = "<button type=button class=\"btn btn-danger btn-xs\">DEF</button>";
	            }
	            if($row['Situacion']=="PER"){
	                $cal = "<button type=button class=\"btn btn-dark btn-xs\">PER</button>";
	            }
	            if($row['Situacion']=="SC"){
	                $cal = "<button type=button class=\"btn btn-secondary btn-xs\">SCA</button>";
	            }
                
                if($row['Nombre_empresa']==""){
                    $utm = "Organico";
                }
                else{
                    $utm = $row['Nombre_empresa'];
                }
                
                $nom_tmp = ucfirst(strtolower(trim(substr($row['Nombres'],strpos($row['Nombres'],",")+1))));
                
                echo "<div class='modal fade' id='Mod" . $row['Id'] . "' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>" . "\n";
                echo "<div class='modal-dialog modal-dialog-centered' role='document'>" . "\n";
                echo "<div class='modal-content'>" . "\n";
                echo "<div class='modal-header'>". "\n"; 
                echo "<h5 class='modal-title' id='exampleModalLongTitle'>" . $sex . " [" . $edad . " años] DNI [" . $row['Dni'] . "] - " . $row['Ape_pat'] . " " . $row['Ape_mat'] .", " . $row['Nombres'] . " " . $cal . "<br>Celular [" . $row['Celular'] . "] - " . $row['Correo'] . "<br>Fec. Ingreso Lead " . $row['Fecha']  . "<br>Ult. Modificación " . $row['Fecha_2'] . "</h5>" . "\n"; 
                echo "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>" . "\n"; 
                echo "<span aria-hidden='true'>&times;</span>" . "\n"; 
                echo "</button>" . "\n";
                echo "</div>". "\n";   
                echo "<div class='modal-body'>" . "\n";  
                echo "<textarea class='form-control' id='text" . $row['Id'] . "'>" . strtoupper($row['Observaciones']) . "</textarea>" . "\n";

                $div1="";$div2="";$div3="";$div4="";$div5="";$div6="";$div7="";
                if($row['Paso']=="div1"){
                    $div1="selected ";
                }
                if($row['Paso']=="div2"){
                    $div2="selected ";
                }
                if($row['Paso']=="div3"){
                    $div3="selected ";
                }
                if($row['Paso']=="div4"){
                    $div4="selected ";
                }
                if($row['Paso']=="div5"){
                    $div5="selected ";
                }
                if($row['Paso']=="div6"){
                    $div6="selected ";
                }
                if($row['Paso']=="div7"){
                    $div7="selected ";
                }
				
				$funcX="";$funcK="";$funcJ="";
				if(substr($row['Funcionario'],0,5)=="PAULO"){
                    $funcX="selected ";
                }
                if(substr($row['Funcionario'],0,5)=="PATTY"){
                    $funcK="selected ";
                }
				
                echo "<select class='form-select-lg' aria-label='Default select example' id='combo" .$row['Id']. "'>" . "\n";
                echo "<option " . $div1. "value='div1'>Por Contactar</option>". "\n";
                echo "<option " . $div2. "value='div2'>Formulario</option>". "\n";
                echo "<option " . $div3. "value='div4'>Documentos/Video</option>". "\n";
                echo "<option " . $div4. "value='div3'>Firma Digital</option>". "\n";
                echo "<option " . $div5. "value='div5'>Inscrito en Sisgo</option>". "\n";
                echo "<option " . $div6. "value='div6'>Foliado/Tadashi</option>". "\n";
                echo "<option " . $div7. "value='div7'>Descartados</option>". "\n";
                echo "</select>";
				echo " ";
                echo "<select class='form-select-lg' aria-label='Default select example' id='func" .$row['Id']. "'>" . "\n";
                echo "<option " . $funcX. "value='PAULO'>PAULO</option>". "\n";
                echo "<option " . $funcK. "value='PATTY'>PATTY</option>". "\n";
                echo "</select>";
				
				echo " Posponer <input type='date' value='' aria-label='Default select example' id='fec_ingreso" . $row['Id'] . "'>" . "\n";
				
                echo "</div>" . "\n";
                echo "<div class='modal-footer'>" . "\n";
                echo "<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>" . "\n";
                echo "<button type='button' class='btn btn-primary' data-dismiss='modal' onclick='graba(" . $row['Id'] . ")'>Guardar</button>" . "\n";
                echo "</div>" . "\n";
                echo "</div>" . "\n";
                echo "</div>" . "\n";
		        echo "</div>" . "\n\n";
            }
        }
                
                
    }

	function funnel_agencias($paso){
		$persona = new Persona();
		
            $res = $persona->funnel_agencias_importe($paso);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            
            $res1 = $persona->funnel_agencias_cantidad($paso);
            $row1 = $res1->fetch(PDO::FETCH_ASSOC);
			
			$tmp="";$tmp1="";
            $tmp = number_format($row['Total'],0,'.',',');
            $tmp1 = $row1['Total'];
		
			echo $tmp . " (" . $tmp1 . ")";
	}
	
	function funnel_agencias_lista_api($paso){
		$persona = new Persona();
		
            $res = $persona->funnel_agencias_lista($paso);
			$j=1;
			
			if($res->rowCount()){
				while($row = $res->fetch(PDO::FETCH_ASSOC)){
					$moneda="";
					
					if($row['Moneda']=="1")
						$moneda = " S/ ";
					if($row['Moneda']=="2")
						$moneda = " $ ";
					
						echo $j++ . ".- " . $row['Tipo_prestamo'] . $moneda . number_format($row['Monto'],0) . "<br>";
				}
			}


	}
	
	function funnel_agencias_infocore($paso){
		$persona = new Persona();
		
            $res = $persona->funnel_agencias_infocore_importe($paso);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            
            $res1 = $persona->funnel_agencias_infocore_cantidad($paso);
            $row1 = $res1->fetch(PDO::FETCH_ASSOC);
			
			$tmp="";$tmp1="";
            $tmp = number_format($row['Total'],0,'.',',');
            $tmp1 = $row1['Total'];
		
			echo $tmp . " (" . $tmp1 . ")";
	}
	
	function funnel_experian($paso){
		$persona = new Persona();
		
            $res = $persona->funnel_experian_importe($paso);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            
            $res1 = $persona->funnel_experian_cantidad($paso);
            $row1 = $res1->fetch(PDO::FETCH_ASSOC);
			
			$tmp="";$tmp1="";
            $tmp = number_format($row['Total'],0,'.',',');
            $tmp1 = $row1['Total'];
		
			echo $tmp . " (" . $tmp1 . ")";
	}

	function desembolsado_infocore($mes){
		$persona = new Persona();
		
            $res = $persona->desembolsado_infocore_importe($mes);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            
            $res1 = $persona->desembolsado_infocore_cantidad($mes);
            $row1 = $res1->fetch(PDO::FETCH_ASSOC);
			
			$tmp="";$tmp1="";
            $tmp = number_format($row['Total'],0,'.',',');
            $tmp1 = $row1['Total'];
		
			echo $tmp . " (" . $tmp1 . ")";
	}

	function funnel_digital($paso, $funcionario){
		$persona = new Persona();
		
            $res = $persona->funnel_digital_importe($paso, $funcionario);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            
            $res1 = $persona->funnel_digital_cantidad($paso, $funcionario);
            $row1 = $res1->fetch(PDO::FETCH_ASSOC);

            $tmp = number_format($row['Total'],0,'.',',');
            $tmp1 = $row1['Total'];
		
			echo "S/ " . $tmp . " (" . $tmp1 . ")";
	}

	function consulta_agencia2($agencia, $accion, $mes, $moneda){
		$persona = new Persona();
			$tmp=0;$tmp1=0;$porcentaje=0;$divisa="";
			
			$res = $persona->avance_agencias2($agencia, $accion, $mes, $moneda);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            
            /*
			$res1 = $persona->meta_agencias2($agencia, $accion, $mes, $moneda);
            $row1 = $res1->fetch(PDO::FETCH_ASSOC);
			*/
			if($row['Total']!=null)
				$tmp = number_format($row['Total'],0,'.',',');
			else
				$tmp = 0;
						
			//$porcentaje = round(($row['Total']/$row1['Total'])*100);
			
			if($moneda=="soles")
				$divisa = "S/ ";
			if($moneda=="dolares")
				$divisa = "$ ";
			
			echo $divisa . $tmp;
	}
	
	function consulta_agencia2_tot($agencia, $accion, $mes, $moneda){
		$persona = new Persona();
			$tmp=0;$tmp1=0;$porcentaje=0;$divisa="";
			
			$res = $persona->avance_agencias2($agencia, $accion, $mes, $moneda);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            
            
			$res1 = $persona->avance_alicia($agencia, $accion, $mes, $moneda);
            $row1 = $res1->fetch(PDO::FETCH_ASSOC);
			
			if($row['Total']!=null)
				$tmp = $row['Total'];
			
			if($row1['Total']!=null)
				$tmp1 = $row1['Total'];
			
			$total_imprime = $tmp + $tmp1;
			
			
			$total_imprime = number_format($total_imprime,0,'.',',');			
			
			if($moneda=="soles")
				$divisa = "S/ ";
			if($moneda=="dolares")
				$divisa = "$ ";
			
			echo $divisa . $total_imprime;
	}

    function getModals_agencias($funcionario){
        $persona = new Persona();
        $res = $persona->obtenerModals_agencias($funcionario);
		$res1 = $persona->obtenerFuncionarios();
		$arreglo_func = [];
		$arreglo_rech = [];
		
		if($res1->rowCount()){
            while ($row1 = $res1->fetch(PDO::FETCH_ASSOC)){
					$arreglo_func +=[$row1['Id'] => $row1['Nombre']];
			}
		}
		
		$res2 = $persona->obtenerRechazos();
		
		if($res2->rowCount()){
            while ($row2 = $res2->fetch(PDO::FETCH_ASSOC)){
					$arreglo_rech +=[$row2['Id'] => $row2['Descripcion']];
			}
		}

        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
                
                echo "<div class='modal fade' id='Mod" . $row['Id'] . "' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>" . "\n";
                echo "<div class='modal-dialog modal-dialog-centered' role='document'>" . "\n";
                echo "<div class='modal-content'>" . "\n";
                echo "<div class='modal-header'>". "\n";
				
			    echo "<h5 class='modal-title' id='exampleModalLongTitle'>DNI [" . $row['Dni'] . "] - " . $row['Nombres'] . " " . $cal . "<br>Ingreso (" . $row['Fecha']  . ") <br>Modificado (" . $row['Fecha_2'] . ")<br>" . "\n";
				echo "Origen: " . $row['Origen'];
			
                echo "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>" . "\n"; 
                echo "<span aria-hidden='true'>&times;</span>" . "\n"; 
                echo "</button>" . "\n";
				
                echo "</div>". "\n";   
                echo "<div class='modal-body'>" . "\n";  
                
                $div1="";$div2="";$div3="";$div4="";$div5="";$div6="";$div7="";$div8="";
                if($row['Paso']=="div1"){
                    $div1="selected ";
                }
                if($row['Paso']=="div2"){
                    $div2="selected ";
                }
                if($row['Paso']=="div3"){
                    $div3="selected ";
                }
                if($row['Paso']=="div4"){
                    $div4="selected ";
                }
                if($row['Paso']=="div5"){
                    $div5="selected ";
                }
                if($row['Paso']=="div6"){
                    $div6="selected ";
                }
                if($row['Paso']=="div7"){
                    $div7="selected ";
                }
				if($row['Paso']=="div8"){
                    $div8="selected ";
                }
				
				$moneda1="";$moneda2="";$imprime_divisa="";
				if($row['Moneda']=="1"){
                    $moneda1="selected ";
					$imprime_divisa="S/";
					
                }
				if($row['Moneda']=="2"){
                    $moneda2="selected ";
					$imprime_divisa="$";
                }
			
				echo "Monto " . $imprime_divisa . " <input type='text' class='form-control' id='mont" . $row['Id'] ."' value='" . number_format($row['Monto'],0,'.','') . "'>" . "\n";
				echo "Numero de cuotas o plazo <input type='text' class='form-control' id='cuotas" . $row['Id'] . "' autocomplete='off' placeholder='Numero de cuotas' size='30' minlength='1' maxlength='2' required pattern='[0-9]+' aria-describedby='inputGroup-sizing-sm' value='" . $row['Cuotas'] . "'><br>" . "\n";
				echo "Moneda <select class='form-select-lg' aria-label='Default select example' id='moneda" . $row['Id'] . "'>" . "\n";
				echo "<option " . $moneda1 . "value='1'>Soles</option>" . "\n";
				echo "<option " . $moneda2 . "value='2'>Dolares</option>" . "\n";
				echo "</select>" . "\n";
				
				echo "Fec. de Desemb" . "\n";
				echo "<input type='date' value='" . $row['Fec_desembolso'] . "' aria-label='Default select example' id='fec_desemb" . $row['Id'] . "' name='fec_desembolso'><br><br>". "\n";

				echo "<textarea class='form-control' id='text" . $row['Id'] . "'>" . strtoupper($row['Observaciones']) . "</textarea><br>" . "\n";

				$res4 = $persona->obtener_Documento($row['Dni']);
				$j=1;
				if($res4->rowCount()){
					while ($row4 = $res4->fetch(PDO::FETCH_ASSOC)){
						$nombretmp = $row4['Desc_Documento'];
						echo "<span style='color:blue'><u><a href='/archivos/" . $row4['Desc_Documento'] . "'>" . $nombretmp . "</a></u></span><br>";
					}
					echo "<br>";
				}
				
				echo "Funcionario: <select class='form-select-lg' aria-label='Default select example' id='func" .$row['Id']. "'>" . "\n";
				echo "<option value=''>Escoge uno</option>". "\n";
				for ($i=0;$i<=20;$i++)
				{	
					$tmp=$arreglo_func[$i];
					if($tmp[$i]!="")
					{
						if($tmp==$row['Funcionario'])
							echo "<option selected value='" . $tmp . "'>" . $tmp . "</option>". "\n";
						else
							echo "<option value='" . $tmp . "'>" . $tmp . "</option>". "\n";
					}
				}
				
				echo "</select>";
				echo " ";
				
                echo "Estado: <select class='form-select-lg' aria-label='Default select example' id='combo" .$row['Id']. "'>" . "\n";
                echo "<option " . $div1. "value='div1'>Por Contactar</option>". "\n";
                echo "<option " . $div2. "value='div2'>Pdte Documentos</option>". "\n";
                echo "<option " . $div3. "value='div3'>En Evaluación</option>". "\n";
                echo "<option " . $div4. "value='div4'>En Verificaciones</option>". "\n";
                echo "<option " . $div5. "value='div5'>Listo p/desemb</option>". "\n";
                echo "<option " . $div6. "value='div6'>Desembolsado</option>". "\n";
                echo "<option " . $div7. "value='div7'>No contesta</option>". "\n";
				echo "<option " . $div8. "value='div8'>Rechazado</option>". "\n";
                echo "</select>" . "\n";
				echo " ";
				echo "<br><br>". "\n";
				
				$tarea1 = "";$tarea2 = "";$tarea3 = "";
				if($row['Tarea']=="prestamo"){
                    $tarea1="selected ";
                }
				if($row['Tarea']=="captacion"){
                    $tarea2="selected ";
                }
				if($row['Tarea']=="otros"){
                    $tarea3="selected ";
                }
				
				echo "Tarea: <select class='form-select-lg' aria-label='Default select example' id='tarea" .$row['Id']. "'>" . "\n";
                echo "<option value=''>Escoge uno</option>". "\n";
				echo "<option " . $tarea1. "value='prestamo'>Prestamo</option>". "\n";
                echo "<option " . $tarea2. "value='captacion'>Captacion</option>". "\n";
                echo "<option " . $tarea3. "value='otros'>Otros</option>". "\n";
                echo "</select>" . "\n";
				echo " ";
				
				$tipo1="";$tipo2="";$tipo3="";$tipo4="";$tipo5="";$tipo6="";$tipo7="";
				if($row['Tipo_prestamo']=="pex-agencias"){
                    $tipo1="selected ";
                }
				if($row['Tipo_prestamo']=="psf"){
                    $tipo2="selected ";
                }
				if($row['Tipo_prestamo']=="pdp"){
                    $tipo3="selected ";
                }
				if($row['Tipo_prestamo']=="pfijo"){
                    $tipo5="selected ";
                }
				if($row['Tipo_prestamo']=="cts"){
                    $tipo6="selected ";
                }
				if($row['Tipo_prestamo']=="pex-digital"){
                    $tipo7="selected ";
                }
				
				echo "Tipo: <select class='form-select-lg' aria-label='Default select example' id='tipo" .$row['Id']. "'>" . "\n";
					echo "<option value=''>Escoge uno</option>". "\n";
				if($tarea1=="selected ")
				{
					echo "<option " . $tipo1. "value='pex-agencias'>PEX-Agencias</option>". "\n";
					echo "<option " . $tipo7. "value='pex-digital'>PEX-Digital</option>". "\n";
					echo "<option " . $tipo2. "value='psf'>PSF</option>". "\n";
					echo "<option " . $tipo3. "value='pdp'>PDP</option>". "\n";
				}
				if($tarea2=="selected ")
				{
					echo "<option " . $tipo5. "value='pfijo'>Pfijo</option>". "\n";
					echo "<option " . $tipo6. "value='cts'>CTS</option>". "\n";
				}
				echo "<option " . $tipo6. "value='otros'>Otros</option>". "\n";
                echo "</select>" . "\n";
				echo " ";
				
				$agencia0="";$agencia1="";$agencia2="";$agencia3="";$agencia4="";$agencia5="";$agencia6="";$agencia7="";$agencia8="";$agencia9="";

				if($row['Agencia']=="san isidro"){
                    $agencia0="selected ";
                }
				if($row['Agencia']=="aelu"){
                    $agencia1="selected ";
                }
				if($row['Agencia']=="apj"){
                    $agencia2="selected ";
                }
				if($row['Agencia']=="centenario"){
                    $agencia3="selected ";
                }
				if($row['Agencia']=="circolo"){
                    $agencia4="selected ";
                }
				if($row['Agencia']=="coser"){
                    $agencia5="selected ";
                }
				if($row['Agencia']=="jockey"){
                    $agencia6="selected ";
                }
				if($row['Agencia']=="regatas"){
                    $agencia7="selected ";
                }
				if($row['Agencia']=="surquillo"){
                    $agencia8="selected ";
                }
				if($row['Agencia']=="terrazas"){
                    $agencia9="selected ";
                }
				
				echo "Agencia: <select class='form-select-lg' aria-label='Default select example' id='agencia" .$row['Id']. "'>" . "\n";
                echo "<option value=''>Escoge uno</option>". "\n";
				echo "<option " . $agencia0. "value='san isidro'>San Isidro</option>". "\n";
                echo "<option " . $agencia1. "value='aelu'>Aelu</option>". "\n";
				echo "<option " . $agencia2. "value='apj'>APJ</option>". "\n";
				echo "<option " . $agencia3. "value='centenario'>Centenario</option>". "\n";
				echo "<option " . $agencia4. "value='circolo'>Circolo</option>". "\n";
				echo "<option " . $agencia5. "value='coser'>Coser</option>". "\n";
				echo "<option " . $agencia6. "value='jockey'>Jockey</option>". "\n";
				echo "<option " . $agencia7. "value='regatas'>Regatas</option>". "\n";
                echo "<option " . $agencia8. "value='surquillo'>Surquillo</option>". "\n";
				echo "<option " . $agencia9. "value='terrazas'>Terrazas</option>". "\n";
				echo "</select>" . "\n";
				echo " ";
				
				// si esta en rechazado
				
				if($row['Paso']=="div8"){
                    
				echo "<br><br>Rechazado por: <select class='form-select-lg' aria-label='Default select example' id='rechazado" .$row['Id']. "'>" . "\n";
				echo "<option value=''>Escoge uno</option>". "\n";
				for ($i=0;$i<=20;$i++)
				{	
					$tmp2=$arreglo_rech[$i];
					if($tmp2[$i]!="")
					{
						if($tmp2==$row['Rechazo'])
							echo "<option selected value='" . $tmp2 . "'>" . $tmp2 . "</option>". "\n";
						else
							echo "<option value='" . $tmp2 . "'>" . $tmp2 . "</option>". "\n";
					}
				}
				
				echo "</select>";
                
				}else{
						echo "<input type='hidden' id='rechazado" .$row['Id']. "'>" . "\n";
				}
				
                echo "</div>" . "\n";
                echo "<div class='modal-footer'>" . "\n";
				
				echo " Posponer <input type='date' value='' aria-label='Default select example' id='fec_ingreso" . $row['Id'] . "'>" . "\n";
				
				echo "<button type='button' class='btn btn-outline-danger btn-xs' onclick=\"elimina('" . $row['Id'] . "','" . $row['Nombres'] . "')\">Elimina Tarjeta</button> |". "\n";
				
				echo "<button type='button' class='btn btn-outline-danger btn-xs' onclick=\"urgente('" . $row['Id'] . "','" . $row['Nombres'] . "')\">No es urgente</button>". "\n";
				
                echo "<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>" . "\n";
                echo "<button type='button' class='btn btn-primary' data-dismiss='modal' onclick='graba(" . $row['Id'] . ")'>Guardar</button>" . "\n";
                echo "</div>" . "\n";
                echo "</div>" . "\n";
                echo "</div>" . "\n";
		        echo "</div>" . "\n\n";
            }
        }
                
                
    }

    function getModals_agencias2(){
        $persona = new Persona();
        $res = $persona->obtenerModals_agencias2();
		
		$arreglo_rech = [];
		$res2 = $persona->obtenerRechazos();
		if($res2->rowCount()){
					while ($row2 = $res2->fetch(PDO::FETCH_ASSOC)){
							$arreglo_rech +=[$row2['Id'] => $row2['Descripcion']];
					}
				}
		

        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
                
                echo "<div class='modal fade' id='Mod" . $row['Id'] . "' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>" . "\n";
                echo "<div class='modal-dialog modal-dialog-centered' role='document'>" . "\n";
                echo "<div class='modal-content'>" . "\n";
                echo "<div class='modal-header'>". "\n";
				
			    echo "<h5 class='modal-title' id='exampleModalLongTitle'>DNI [" . $row['Dni'] . "] - " . $row['Nombres'] . "<br>Celular: " . $row['Celular'] . "<br>Correo: " . $row['Correo'] . "<br>Codigo[" . $row['Codigo'] . "]<br>Ingreso (" . $row['Fecha']  . ") <br>Modificado (" . $row['Fecha_2'] . ")<br>" . "\n";
				echo "<b>Agencia: " . $row['Agencia'] . "</b>";
			
                echo "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>" . "\n"; 
                echo "<span aria-hidden='true'>&times;</span>" . "\n"; 
                echo "</button>" . "\n";
				
                echo "</div>". "\n";   
                echo "<div class='modal-body'>" . "\n";  
                
                $div1="";$div2="";$div3="";$div4="";$div5="";$div6="";$div7="";$div8="";$divisa="";
                if($row['Paso']=="div1"){
                    $div1="selected ";
                }
                if($row['Paso']=="div2"){
                    $div2="selected ";
                }
                if($row['Paso']=="div3"){
                    $div3="selected ";
                }
                if($row['Paso']=="div4"){
                    $div4="selected ";
                }
                if($row['Paso']=="div5"){
                    $div5="selected ";
                }
                if($row['Paso']=="div6"){
                    $div6="selected ";
                }
                if($row['Paso']=="div7"){
                    $div7="selected ";
                }
				if($row['Paso']=="div8"){
                    $div8="selected ";
                }
				
				$moneda1="";$moneda2="";
				
				if($row['Moneda']=="1"){
                    $moneda1="selected ";
					$divisa = "S/ ";
                }
				if($row['Moneda']=="2"){
                    $moneda2="selected ";
					$divisa = "$ ";
                }
				
				echo "Monto " . $divisa . "<input type='number' class='form-control' id='mont" . $row['Id'] ."' value='" . number_format($row['Monto'],0,'.','') . "'>" . "\n";
				
				echo "<br>";
				echo "Moneda <select class='form-select-lg' aria-label='Default select example' id='moneda" . $row['Id'] . "'>" . "\n";
				echo "<option value=''>Escoge uno</option>" . "\n";
				echo "<option " . $moneda1 . "value='1'>Soles</option>" . "\n";
				echo "<option " . $moneda2 . "value='2'>Dolares</option>" . "\n";
				echo "</select>" . "\n";
				echo "<br><br>";
				echo "<textarea class='form-control' id='text" . $row['Id'] . "'>" . strtoupper($row['Observaciones']) . "</textarea><br>" . "\n";
				
				echo "Funcionario: <input type='text' class='form-control' aria-label='Default select example' id='func" .$row['Id']. "' value='" . $row[Funcionario] . "'>" . "\n";
				
				echo "<br>";
				
				$res4 = $persona->obtener_Documento($row['Dni'],);
				if($res4->rowCount()){
					while ($row4 = $res4->fetch(PDO::FETCH_ASSOC)){
						$nombretmp = $row4['Desc_Documento'];
						echo "<span style='color:blue'><u><a href='/archivos/" . $row4['Desc_Documento'] . "'>" . $nombretmp . "</a></u></span><br>";
					}
					echo "<br>";
				}
				
                echo "Estado: <select class='form-select-lg' aria-label='Default select example' id='combo" .$row['Id']. "'>" . "\n";
                echo "<option " . $div1. "value='div1'>Por Contactar</option>". "\n";
                echo "<option " . $div2. "value='div2'>Pdte Documentos</option>". "\n";
                echo "<option " . $div3. "value='div3'>En Evaluación</option>". "\n";
                echo "<option " . $div4. "value='div4'>En Verificaciones</option>". "\n";
                echo "<option " . $div5. "value='div5'>Listo p/desemb</option>". "\n";
                echo "<option " . $div6. "value='div6'>Terminado</option>". "\n";
                echo "<option " . $div7. "value='div7'>No contesta</option>". "\n";
				echo "<option " . $div8. "value='div8'>Rechazado</option>". "\n";
                echo "</select>" . "\n";
				echo " ";
				
				$tarea1 = "";$tarea2 = "";$tarea3 = "";$tarea4 = "";$tarea5 = "";$tarea6 = "";$tarea7 = "";
				if($row['Tarea']=="consulta"){
                    $tarea1="selected ";
                }
				if($row['Tarea']=="captacion"){
                    $tarea2="selected ";
                }
				if($row['Tarea']=="prestamo"){
                    $tarea3="selected ";
                }
				if($row['Tarea']=="inscripcion"){
					$tarea4="selected ";
                }
				if($row['Tarea']=="tarjeta"){
                    $tarea5="selected ";
                }
				if($row['Tarea']=="operacion"){
                    $tarea6="selected ";
                }
				if($row['Tarea']=="otros"){
                    $tarea7="selected ";
                }
				
				echo "Tarea: <select class='form-select-lg' aria-label='Default select example' id='tarea" .$row['Id']. "'>" . "\n";
                echo "<option value=''>Escoge uno</option>". "\n";
				echo "<option " . $tarea1. "value='consulta'>Consulta</option>". "\n";
                echo "<option " . $tarea2. "value='captacion'>Captacion</option>". "\n";
				echo "<option " . $tarea3. "value='prestamo'>Prestamo</option>". "\n";
				echo "<option " . $tarea4. "value='inscripcion'>Inscripcion</option>". "\n";
				echo "<option " . $tarea5. "value='tarjeta'>Tarjeta</option>". "\n";
				echo "<option " . $tarea6. "value='operacion'>Operacion</option>". "\n";
                echo "<option " . $tarea7. "value='otros'>Otros</option>". "\n";
                echo "</select>" . "\n";
				echo " ";
				
				$canal1="";$canal2="";$canal3="";
				if($row['Canal']=="Correo"){
                    $canal1="selected ";
                }
				if($row['Canal']=="Presencial"){
                    $canal2="selected ";
                }
				if($row['Canal']=="Telefono"){
                    $canal3="selected ";
                }
				
				echo "<br><br>Canal: <select class='form-select-lg' aria-label='Default select example' id='canal" .$row['Id']. "'>" . "\n";
                echo "<option value=''>Escoge uno</option>". "\n";
				echo "<option " . $canal1. "value='Correo'>Correo</option>". "\n";
                echo "<option " . $canal2. "value='Presencial'>Presencial</option>". "\n";
                echo "<option " . $canal3. "value='Telefono'>Telefono</option>". "\n";
                echo "</select>" . "\n";
				echo " ";
				echo " Posponer <input type='date' value='' aria-label='Default select example' id='fec_ingreso" . $row['Id'] . "'>" . "\n";
				
				// si esta en rechazado
				
				if($row['Paso']=="div8"){
                    
				echo "<br><br>Rechazado por: <select class='form-select-lg' aria-label='Default select example' id='rechazado" .$row['Id']. "'>" . "\n";
				echo "<option value=''>Escoge uno</option>". "\n";
				for ($i=0;$i<=20;$i++)
				{	
					$tmp2=$arreglo_rech[$i];
					if($tmp2[$i]!="")
					{
						if($tmp2==$row['Rechazo'])
							echo "<option selected value='" . $tmp2 . "'>" . $tmp2 . "</option>". "\n";
						else
							echo "<option value='" . $tmp2 . "'>" . $tmp2 . "</option>". "\n";
					}
				}
				
				echo "</select>";
                
				}else{
						echo "<input type='hidden' id='rechazado" .$row['Id']. "'>" . "\n";
				}
				
                echo "</div>" . "\n";
                echo "<div class='modal-footer'>" . "\n";
				
				
				
				if($row['Paso']=="div3" or $row['Paso']=="div4"){
					echo "<button type='button' data-dismiss='modal' class='btn btn-outline-success btn-xs' onclick=\"mail('" . $row['Dni'] . "','" . $row['Nombres'] . "','" . number_format($row['Monto'],0,'.','') . "','" . $row[Funcionario] . "','". strtoupper($row['Observaciones']) . "')\">Mail UEC</button> |". "\n";
				}
				
				echo "<button type='button' class='btn btn-outline-danger btn-xs' onclick=\"elimina('" . $row['Id'] . "','" . $row['Nombres'] . "')\">Elimina Tarjeta</button> |". "\n";
                echo "<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>" . "\n";
                echo "<button type='button' class='btn btn-primary' data-dismiss='modal' onclick='graba(" . $row['Id'] . ")'>Guardar</button>" . "\n";
                echo "</div>" . "\n";
                echo "</div>" . "\n";
                echo "</div>" . "\n";
		        echo "</div>" . "\n\n";
            }
        }
                
                
    }
    
    function getModals_digital($keyword){
        $persona = new Persona();
        $res = $persona->obtenerPersonas($keyword);
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
                $sex ="";$cal="";$utm="";
                if($row['Sexo']=="MASCULINO"){
                    $sex = "👨";
                }
                if($row['Sexo']=="FEMENINO"){
                    $sex = "👩";
                }
                
                $AnoAct = date('Y');
	            $edad = $AnoAct - $row['Nacimiento'];
	            
	            if($row['Situacion']=="NOR"){
	                $cal = "<button type=button class=\"btn btn-success btn-xs\">NOR</button>";
	            }
	            if($row['Situacion']=="CPP"){
	                $cal = "<button type=button class=\"btn btn-warning btn-xs\">CPP</button>";
	            }
	            if($row['Situacion']=="DUD"){
	                $cal = "<button type=button class=\"btn btn-danger btn-xs\">DUD</button>";
	            }
	            if($row['Situacion']=="DEF"){
	                $cal = "<button type=button class=\"btn btn-danger btn-xs\">DEF</button>";
	            }
	            if($row['Situacion']=="PER"){
	                $cal = "<button type=button class=\"btn btn-dark btn-xs\">PER</button>";
	            }
	            if($row['Situacion']=="SC"){
	                $cal = "<button type=button class=\"btn btn-secondary btn-xs\">SCA</button>";
	            }
                
                if($row['Nombre_empresa']==""){
                    $utm = "Organico";
                }
                else{
                    $utm = $row['Nombre_empresa'];
                }
                
                $nom_tmp = ucfirst(strtolower(trim(substr($row['Nombres'],strpos($row['Nombres'],",")+1))));
                
                echo "<div class='modal fade' id='Mod" . $row['Id'] . "' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>" . "\n";
                echo "<div class='modal-dialog modal-dialog-centered' role='document'>" . "\n";
                echo "<div class='modal-content'>" . "\n";
                echo "<div class='modal-header'>". "\n"; 
                echo "<h5 class='modal-title' id='exampleModalLongTitle'>" . $sex . " [" . $edad . " años] DNI [" . $row['Dni'] . "] - " . $row['Nombres'] . "<br>" . $cal . " Deudas Impagas S/ " . $row['Deudas_impagas'] . " Deuda en el Sistema S/ " . $row['Deuda_sistema'] . " <br>Celular [" . $row['Celular'] . "] - " . $row['Correo'] . "<br>" . $row['Fecha']  . " Origen [" . $utm . "]<br>Ult. Modificación " . $row['Fecha_2'] . "</h5>" . "\n"; 
                echo "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>" . "\n"; 
                echo "<span aria-hidden='true'>&times;</span>" . "\n"; 
                echo "</button>" . "\n";
                echo "</div>". "\n";   
                echo "<div class='modal-body'>" . "\n";  
                echo "<textarea class='form-control' id='text" . $row['Id'] . "'>" . strtoupper($row['Observaciones']) . "</textarea>" . "\n";
                echo "Monto a prestar S/ <input type='text' class='form-control' id='mont" . $row['Id'] ."' value='" . number_format($row['Monto'],0,'.','') . "'><br>" . "\n";
                                
                $div1="";$div2="";$div3="";$div4="";$div5="";$div6="";$div7="";
                if($row['Paso']=="div1"){
                    $div1="selected ";
                }
                if($row['Paso']=="div2"){
                    $div2="selected ";
                }
                if($row['Paso']=="div3"){
                    $div3="selected ";
                }
                if($row['Paso']=="div4"){
                    $div4="selected ";
                }
                if($row['Paso']=="div5"){
                    $div5="selected ";
                }
                if($row['Paso']=="div6"){
                    $div6="selected ";
                }
                if($row['Paso']=="div7"){
                    $div7="selected ";
                }
				
				$funcX="";$funcK="";$funcJ="";
				if(substr($row['Funcionario'],0,5)=="XIOMI"){
                    $funcX="selected ";
                }
                if(substr($row['Funcionario'],0,5)=="KAORI"){
                    $funcK="selected ";
                }
				if(substr($row['Funcionario'],0,5)=="JOHAN"){
                    $funcJ="selected ";
                }
				
                echo "<select class='form-select-lg' aria-label='Default select example' id='combo" .$row['Id']. "'>" . "\n";
                echo "<option " . $div1. "value='div1'>Por Contactar</option>". "\n";
                echo "<option " . $div2. "value='div2'>En Evaluación</option>". "\n";
                echo "<option " . $div4. "value='div4'>En Verificaciones</option>". "\n";
                echo "<option " . $div3. "value='div3'>En Revisión</option>". "\n";
                echo "<option " . $div5. "value='div5'>Firma de Crédito</option>". "\n";
                echo "<option " . $div6. "value='div6'>Desembolsado</option>". "\n";
                echo "<option " . $div7. "value='div7'>Descartados</option>". "\n";
                echo "</select>";
				echo " ";
                echo "<select class='form-select-lg' aria-label='Default select example' id='func" .$row['Id']. "'>" . "\n";
                echo "<option " . $funcX. "value='XIOMI'>Xiomi</option>". "\n";
                echo "<option " . $funcK. "value='KAORI'>Kaori</option>". "\n";
                echo "<option " . $funcJ. "value='JOHANN'>Johann</option>". "\n";
                echo "</select>";
				
                echo "</div>" . "\n";
                echo "<div class='modal-footer'>" . "\n";
				echo "<button type='button' class='btn btn-outline-danger btn-xs' onclick=\"sms('" . $row['Celular'] . "','" . $nom_tmp . "','Nocalifica')\">SMS No Califica</button> |". "\n";
                echo "<button type='button' class='btn btn-outline-primary btn-xs' onclick=\"sms('" . $row['Celular'] . "','" . $nom_tmp . "','Preaprobado')\">SMS Preaprobado</button>". "\n";
                echo "<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>" . "\n";
                echo "<button type='button' class='btn btn-primary' data-dismiss='modal' onclick='graba(" . $row['Id'] . ")'>Guardar</button>" . "\n";
                echo "</div>" . "\n";
                echo "</div>" . "\n";
                echo "</div>" . "\n";
		        echo "</div>" . "\n\n";
            }
        }
                
                
    }

	function borra_registro($tabla, $id){
	
		$persona = new Persona();
        $res = $persona->eliminaRegistro($tabla, $id);
    
	}
	
	function actualiza_registro($tabla, $id){
	
		$persona = new Persona();
        $res = $persona->actualiza_registro_persona($tabla, $id);
    
	}	
	
	function no_es_urgente_api($tabla, $id){
	
		$persona = new Persona();
        $res = $persona->no_es_urgente($tabla, $id);
    
	}

	function getAll_agencias($keyword){
        $persona = new Persona();
        $res = $persona->obtenerPersonas_agencias($keyword);
        
        
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
                $variable_bol=0;$moneda="$";$estado="";
				if($row['Moneda']=="1")
					$moneda = "S/";
				if($row['Paso']=="div1")
					$estado = "(1/6) Por contactar";
				if($row['Paso']=="div2")
					$estado = "(2/6) Pdte Docs";
				if($row['Paso']=="div3")
					$estado = "(3/6) En Evaluacion";
				if($row['Paso']=="div4")
					$estado = "(4/6) En Verificaciones";
				if($row['Paso']=="div5")
					$estado = "(5/6) Listo p/ desemb";
				if($row['Paso']=="div6")
					$estado = "<b>Terminado</b>";
				if($row['Paso']=="div7" or $row['Paso']=="div8")
					$estado = "NC/Rechazado";
				
                echo "<tr>";
                echo "<td>" . $row['Dni'] . " / " . $row['Fecha'] . " <button type='button' class='btn btn-danger btn-xs' data-toggle='modal' data-target='#EliminarTarjeta' onclick='setear(\"" . $row['Id'] . "\",\"" . $row['Dni'] . "\")'>X</button> <button type='button' class='btn btn-info btn-xs' data-toggle='modal' data-target='#ModificarTarjeta' onclick='setear(\"" . $row['Id'] . "\",\"" . $row['Dni'] . "\")'>M</button></td>";
                echo "<td>" . substr($row['Nombres'],0,25) . " - Origen [" . $row['Origen'] . "] [" . $row['Tarea'] . "] [" . $row['Tipo_prestamo'] . "]</td>";
                echo "<td>" . $row['Funcionario'] . "</td>";
                echo "<td>" . $moneda . " " . number_format($row['Monto'],0) . " - " . $estado . "</td>";
                echo "</tr>";
            }
        }
    }
	
	function getAll_agencias2($keyword, $agencia){
		$persona = new Persona();
        $res = $persona->obtenerAgencias2($keyword, $agencia);
		if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
				$variable_bol=0;$moneda="$";$estado="";$doi="";$nombre="";$Obs="";$func="";
				if($row['Moneda']=="1")
					$moneda = "S/";
				if($row['Paso']=="div1")
					$estado = "(1/6) Por contactar";
				if($row['Paso']=="div2")
					$estado = "(2/6) Pdte Docs";
				if($row['Paso']=="div3")
					$estado = "(3/6) En Evaluacion";
				if($row['Paso']=="div4")
					$estado = "(4/6) En Verificaciones";
				if($row['Paso']=="div5")
					$estado = "(5/6) Listo p/ desemb";
				if($row['Paso']=="div6")
					$estado = "<b>Terminado</b>";
				if($row['Paso']=="div7" or $row['Paso']=="div8")
					$estado = "NC/Rechazado";
				
				if($row['Dni']=="")
					$doi = $row['Codigo'];
				else
					$doi = $row['Dni'];
				
				if($row['Nombres']=="")
					$nombre = "";
				else
					$nombre = substr($row['Nombres'],0,25) . " - ";
				
				if($row['Observaciones']=="")
					$Obs = "";
				else
					$Obs = substr($row['Observaciones'],0,45);
				
				$tmp = $row['Funcionario'];
				$pos = strpos($tmp,"@");

				$func = "<span style='color:blue'>" . substr($tmp, 0, $pos) . "<span>";
				
				echo "<tr>";
                echo "<td>" . $doi . " / " . $row['Fecha'] . "</td>";
                echo "<td>" . $nombre . "<b>[" . $row['Canal'] . "]</b><b> [" . strtoupper($row['Tarea']) . "]</b> [" . $Obs . "]</td>";
                echo "<td>" . $func . "</td>";
                echo "<td>" . $moneda . " " . number_format($row['Monto'],0) . " - " . $estado . "</td>";
                echo "</tr>";		
			}
		}
	}
	
    function getAll2($keyword){
        $persona = new Persona();
        $res = $persona->obtenerPersonas($keyword);
        
        
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
                $variable_bol=0;$situa="";
				if($row['Situacion']=="NOR"){
					$situa = "<button type='button' class='btn btn-success btn-xs'>NOR</button>";
				}
				if($row['Situacion']=="CPP"){
					$situa = "<button type='button' class='btn btn-warning btn-xs'>CPP</button>";
				}
				if($row['Situacion']=="SC"){
					$situa = "<button type='button' class='btn btn-default btn-xs'>SCA</button>";
				}
				if($row['Situacion']=="DEF"){
					$situa = "<button type='button' class='btn btn-danger btn-xs'>DEF</button>";
				}
				if($row['Situacion']=="DUD"){
					$situa = "<button type='button' class='btn btn-danger btn-xs'>DUD</button>";
				}
				if($row['Situacion']=="PER"){
					$situa = "<button type='button' class='btn btn-dark btn-xs'>PER</button>";
				}
				$utm = "";
				if($row['Nombre_empresa']=="ads_busqueda")
					$utm = substr($row['Nombre_empresa'],0,8);
				else
					$utm = $row['Nombre_empresa'];
				
                echo "<tr>";
                echo "<td>" . $row['Dni'] . "/ " . $row['Fecha'] . "</td>";
                echo "<td>" . substr($row['Nombres'],0,25) . " - " . $situa . " - " . $utm . " - Sueldo [S/" . number_format($row['Sueldo_neto'],0) . "] - Impagos [S/". $row['Deudas_impagas'] . "] - Deuda [S/" . number_format($row['Deuda_sistema'],0) . "] Lima [" . substr($row['Lima'],0,1) . "] 5ta [" . substr($row['Quinta'],0,1) . "] Autoriza [S]</td>";
                if($row['Estado']=="PRE-APROBADO")
                {
                    
					if($row['Paso']=="div6")
					{
						echo "<td style='background-color:yellow'><span style='color:blue'>" . $row['Estado'] . " / " . $row['Funcionario'] . "</span></td>";
                    }else{
						echo "<td><span style='color:blue'>" . $row['Estado'] . " / " . $row['Funcionario'] . "</span></td>";
					}
					$variable_bol=1;
                }
                if(substr($row['Estado'],0,3)=="VEH")
                {
                    echo "<td><span style='color:red'>" . $row['Estado'] . " / " . $row['Funcionario'] . "</span></td>";
                    $variable_bol=1;
                }
                if($variable_bol==0)
                {
                    echo "<td>" . $row['Estado'] . " / " . $row['Funcionario'] . "</td>";
                }
                echo "<td>" . substr($row['Celular'],-9) . "</td>";
                echo "</tr>";
            }
        }
    }
    
    function getAll2_digital($keyword){
        $persona = new Persona();
        $res = $persona->obtenerPersonas($keyword);
        $i=0;
        
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
                $variable_bol=0;
                
                if((fmod($i++,2))==0){
                    $color = "secondary";
                }else{
                    $color = "info";
                }
                
                $tmp = "Mail ✉️";
                echo "<tr>";
                echo "<td>" . $row['Dni'] . " / " . $row['Fecha'] . "</td>";
                echo "<td>" . $row['Nombres'] . "</td>";
                if($row['Estado']=="PRE-APROBADO")
                {
                    echo "<td><span style='color:blue'>" . $row['Funcionario'] . "</span></td>";
                    $variable_bol=1;
                }
                if(substr($row['Estado'],0,3)=="VEH")
                {
                    echo "<td><span style='color:red'>" . $row['Funcionario'] . "</span></td>";
                    $variable_bol=1;
                }
                if($variable_bol==0)
                {
                    echo "<td>SERVICIOS DIGITALES</td>";
                }
                //echo "<td><button type='button' data-toggle='modal' data-target='#Mod" . $row['Id'] . "' class='btn btn-" . $color . " btn-xs'>". $tmp . "</button> " . substr($row['Celular'],-9) . " - " . $row['Correo'] . "</td>";
                echo "<td>" . substr($row['Celular'],-9) . " - " . $row['Correo'] . "</td>";
                echo "</tr>";
            }
        }
    }
    
    function getAll4(){
        $persona = new Persona();
        $res = $persona->obtenerPersonas_exp();
        $mestot=0;$dia1=0;$dia2=0;$dia3=0;$dia4=0;$dia5=0;$dia6=0;$dia7=0;$dia8=0;$dia9=0;$dia10=0;$dia11=0;$dia12=0;$dia13=0;$dia14=0;$dia15=0;$dia16=0;$dia17=0;$dia18=0;$dia19=0;$dia20=0;$dia21=0;$dia22=0;$dia23=0;$dia24=0;$dia25=0;$dia26=0;$dia27=0;$dia28=0;$dia29=0;$dia30=0;$dia31=0;
		
		$mestotx=0;$dia1x=0;$dia2x=0;$dia3x=0;$dia4x=0;$dia5x=0;$dia6x=0;$dia7x=0;$dia8x=0;$dia9x=0;$dia10x=0;$dia11x=0;$dia12x=0;$dia13x=0;$dia14x=0;$dia15x=0;$dia16x=0;$dia17x=0;$dia18x=0;$dia19x=0;$dia20x=0;$dia21x=0;$dia22x=0;$dia23x=0;$dia24x=0;$dia25x=0;$dia26x=0;$dia27x=0;$dia28x=0;$dia29x=0;$dia30x=0;$dia31x=0;
		
		$mestotxx=0;$dia1xx=0;$dia2xx=0;$dia3xx=0;$dia4xx=0;$dia5xx=0;$dia6xx=0;$dia7xx=0;$dia8xx=0;$dia9xx=0;$dia10xx=0;$dia11xx=0;$dia12xx=0;$dia13xx=0;$dia14xx=0;$dia15xx=0;$dia16xx=0;$dia17xx=0;$dia18xx=0;$dia19xx=0;$dia20xx=0;$dia21xx=0;$dia22xx=0;$dia23xx=0;$dia24xx=0;$dia25xx=0;$dia26xx=0;$dia27xx=0;$dia28xx=0;$dia29xx=0;$dia30xx=0;$dia31xx=0;
		
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
                if($row['Estado']=="PRE-APROBADO"){
                    $color="";$tmp="";
                    if($row['Paso']=="div7"){
                        $tmp = "X - " . $row['Observaciones'];
                    }else{
                        if($row['Paso']=="div2"){
                            $tmp = "(2/5) ENVIANDO DOCUMENTOS";    
                        }
                        if($row['Paso']=="div4"){
                            $tmp = "(3/5) VERIFICANDO LAB/DOM";    
                        }
                        if($row['Paso']=="div3"){
                            $tmp = "(4/5) FILE EN AGENCIA";    
                        }
                        if($row['Paso']=="div5"){
                            $tmp = "(5/5) FIRMA EN AGENCIA";    
                        }
                        if($row['Paso']=="div6"){
                            $tmp = "DESEMBOLSADO S/ " . number_format($row['Monto'],0) . " [" . $row['Fecha_2'] . "]";    
                        }
                        if($row['Paso']=="div1"){
                            $tmp = "(1/5) EN CONTACTO";    
                        }
                        
                        $color = "blue";
                    }
                }else{
                    $tmp = $row['Estado'];
                    $color = "black";
                }
                
				$anio="";$tmp2="";
				
				$fechaComoEntero = strtotime($row['Fecha']);
				$mes = date("m", $fechaComoEntero);
				
				$mes_actual = date("m");
				$mes_actual_letra = date("M");
				
				$mes_pasado = date("m",strtotime('first day of last month'));
				$mes_pasado_letra = date("M",strtotime('first day of last month'));
				
				$mes_antepasado = date("m",strtotime('-2 months'));
				$mes_antepasado_letra = date("M",strtotime('-2 months'));
				
				if($mes==$mes_actual)
				{
					$dia = date("d", $fechaComoEntero);
					switch($dia){
							case 1:$dia1++;$mestot++;break;
							case 2:$dia2++;$mestot++;break;
							case 3:$dia3++;$mestot++;break;
							case 4:$dia4++;$mestot++;break;
							case 5:$dia5++;$mestot++;break;
							case 6:$dia6++;$mestot++;break;
							case 7:$dia7++;$mestot++;break;
							case 8:$dia8++;$mestot++;break;
							case 9:$dia9++;$mestot++;break;
							case 10:$dia10++;$mestot++;break;
							case 11:$dia11++;$mestot++;break;
							case 12:$dia12++;$mestot++;break;
							case 13:$dia13++;$mestot++;break;
							case 14:$dia14++;$mestot++;break;
							case 15:$dia15++;$mestot++;break;
							case 16:$dia16++;$mestot++;break;
							case 17:$dia17++;$mestot++;break;
							case 18:$dia18++;$mestot++;break;
							case 19:$dia19++;$mestot++;break;
							case 20:$dia20++;$mestot++;break;
							case 21:$dia21++;$mestot++;break;
							case 22:$dia22++;$mestot++;break;
							case 23:$dia23++;$mestot++;break;
							case 24:$dia24++;$mestot++;break;
							case 25:$dia25++;$mestot++;break;
							case 26:$dia26++;$mestot++;break;
							case 27:$dia27++;$mestot++;break;
							case 28:$dia28++;$mestot++;break;
							case 29:$dia29++;$mestot++;break;
							case 30:$dia30++;$mestot++;break;
							case 31:$dia31++;$mestot++;break;
					}
				}
				
				if($mes==$mes_pasado)
				{
					$dia = date("d", $fechaComoEntero);
					switch($dia){
							case 1:$dia1x++;$mestotx++;break;
							case 2:$dia2x++;$mestotx++;break;
							case 3:$dia3x++;$mestotx++;break;
							case 4:$dia4x++;$mestotx++;break;
							case 5:$dia5x++;$mestotx++;break;
							case 6:$dia6x++;$mestotx++;break;
							case 7:$dia7x++;$mestotx++;break;
							case 8:$dia8x++;$mestotx++;break;
							case 9:$dia9x++;$mestotx++;break;
							case 10:$dia10x++;$mestotx++;break;
							case 11:$dia11x++;$mestotx++;break;
							case 12:$dia12x++;$mestotx++;break;
							case 13:$dia13x++;$mestotx++;break;
							case 14:$dia14x++;$mestotx++;break;
							case 15:$dia15x++;$mestotx++;break;
							case 16:$dia16x++;$mestotx++;break;
							case 17:$dia17x++;$mestotx++;break;
							case 18:$dia18x++;$mestotx++;break;
							case 19:$dia19x++;$mestotx++;break;
							case 20:$dia20x++;$mestotx++;break;
							case 21:$dia21x++;$mestotx++;break;
							case 22:$dia22x++;$mestotx++;break;
							case 23:$dia23x++;$mestotx++;break;
							case 24:$dia24x++;$mestotx++;break;
							case 25:$dia25x++;$mestotx++;break;
							case 26:$dia26x++;$mestotx++;break;
							case 27:$dia27x++;$mestotx++;break;
							case 28:$dia28x++;$mestotx++;break;
							case 29:$dia29x++;$mestotx++;break;
							case 30:$dia30x++;$mestotx++;break;
							case 31:$dia31x++;$mestotx++;break;
					}
				}
				
				if($mes==$mes_antepasado)
				{
					$dia = date("d", $fechaComoEntero);
					switch($dia){
							case 1:$dia1xx++;$mestotxx++;break;
							case 2:$dia2xx++;$mestotxx++;break;
							case 3:$dia3xx++;$mestotxx++;break;
							case 4:$dia4xx++;$mestotxx++;break;
							case 5:$dia5xx++;$mestotxx++;break;
							case 6:$dia6xx++;$mestotxx++;break;
							case 7:$dia7xx++;$mestotxx++;break;
							case 8:$dia8xx++;$mestotxx++;break;
							case 9:$dia9xx++;$mestotxx++;break;
							case 10:$dia10xx++;$mestotxx++;break;
							case 11:$dia11xx++;$mestotxx++;break;
							case 12:$dia12xx++;$mestotxx++;break;
							case 13:$dia13xx++;$mestotxx++;break;
							case 14:$dia14xx++;$mestotxx++;break;
							case 15:$dia15xx++;$mestotxx++;break;
							case 16:$dia16xx++;$mestotxx++;break;
							case 17:$dia17xx++;$mestotxx++;break;
							case 18:$dia18xx++;$mestotxx++;break;
							case 19:$dia19xx++;$mestotxx++;break;
							case 20:$dia20xx++;$mestotxx++;break;
							case 21:$dia21xx++;$mestotxx++;break;
							case 22:$dia22xx++;$mestotxx++;break;
							case 23:$dia23xx++;$mestotxx++;break;
							case 24:$dia24xx++;$mestotxx++;break;
							case 25:$dia25xx++;$mestotxx++;break;
							case 26:$dia26xx++;$mestotxx++;break;
							case 27:$dia27xx++;$mestotxx++;break;
							case 28:$dia28xx++;$mestotxx++;break;
							case 29:$dia29xx++;$mestotxx++;break;
							case 30:$dia30xx++;$mestotxx++;break;
							case 31:$dia31xx++;$mestotxx++;break;
					}
				}
				
				
                
                echo "<tr>";
                echo "<td>" . $row['Fecha'] . "</td>";
                echo "<td>" . $row['Nombres'] . " - " . $row['Dni'] . " - " . $row['Situacion'] . "</td>";
                echo "<td><span style='color:" . $color . "'>" . substr($tmp,0,35) . "</span></td>";
                echo "<td>" . substr($row['Celular'],-9) . " - " . $row['Correo'] . "</td>";
                echo "</tr>";
            }
        }
		$_SESSION["mestot"] = $mes_actual_letra . "(" . $mestot . ")";
		$_SESSION["dia1"] = $dia1;
		$_SESSION["dia2"] = $dia2;
		$_SESSION["dia3"] = $dia3;
		$_SESSION["dia4"] = $dia4;
		$_SESSION["dia5"] = $dia5;
		$_SESSION["dia6"] = $dia6;
		$_SESSION["dia7"] = $dia7;
		$_SESSION["dia8"] = $dia8;
		$_SESSION["dia9"] = $dia9;
		$_SESSION["dia10"] = $dia10;
		$_SESSION["dia11"] = $dia11;
		$_SESSION["dia12"] = $dia12;
		$_SESSION["dia13"] = $dia13;
		$_SESSION["dia14"] = $dia14;
		$_SESSION["dia15"] = $dia15;
		$_SESSION["dia16"] = $dia16;
		$_SESSION["dia17"] = $dia17;
		$_SESSION["dia18"] = $dia18;
		$_SESSION["dia19"] = $dia19;
		$_SESSION["dia20"] = $dia20;
		$_SESSION["dia21"] = $dia21;
		$_SESSION["dia22"] = $dia22;
		$_SESSION["dia23"] = $dia23;
		$_SESSION["dia24"] = $dia24;
		$_SESSION["dia25"] = $dia25;
		$_SESSION["dia26"] = $dia26;
		$_SESSION["dia27"] = $dia27;
		$_SESSION["dia28"] = $dia28;
		$_SESSION["dia29"] = $dia29;
		$_SESSION["dia30"] = $dia30;
		$_SESSION["dia31"] = $dia31;
		
		$_SESSION["mestotx"] = $mes_pasado_letra . "(" . $mestotx . ")";
		$_SESSION["dia1x"] = $dia1x;
		$_SESSION["dia2x"] = $dia2x;
		$_SESSION["dia3x"] = $dia3x;
		$_SESSION["dia4x"] = $dia4x;
		$_SESSION["dia5x"] = $dia5x;
		$_SESSION["dia6x"] = $dia6x;
		$_SESSION["dia7x"] = $dia7x;
		$_SESSION["dia8x"] = $dia8x;
		$_SESSION["dia9x"] = $dia9x;
		$_SESSION["dia10x"] = $dia10x;
		$_SESSION["dia11x"] = $dia11x;
		$_SESSION["dia12x"] = $dia12x;
		$_SESSION["dia13x"] = $dia13x;
		$_SESSION["dia14x"] = $dia14x;
		$_SESSION["dia15x"] = $dia15x;
		$_SESSION["dia16x"] = $dia16x;
		$_SESSION["dia17x"] = $dia17x;
		$_SESSION["dia18x"] = $dia18x;
		$_SESSION["dia19x"] = $dia19x;
		$_SESSION["dia20x"] = $dia20x;
		$_SESSION["dia21x"] = $dia21x;
		$_SESSION["dia22x"] = $dia22x;
		$_SESSION["dia23x"] = $dia23x;
		$_SESSION["dia24x"] = $dia24x;
		$_SESSION["dia25x"] = $dia25x;
		$_SESSION["dia26x"] = $dia26x;
		$_SESSION["dia27x"] = $dia27x;
		$_SESSION["dia28x"] = $dia28x;
		$_SESSION["dia29x"] = $dia29x;
		$_SESSION["dia30x"] = $dia30x;
		$_SESSION["dia31x"] = $dia31x;
		
		$_SESSION["mestotxx"] = $mes_antepasado_letra . "(" . $mestotxx . ")";
		$_SESSION["dia1xx"] = $dia1xx;
		$_SESSION["dia2xx"] = $dia2xx;
		$_SESSION["dia3xx"] = $dia3xx;
		$_SESSION["dia4xx"] = $dia4xx;
		$_SESSION["dia5xx"] = $dia5xx;
		$_SESSION["dia6xx"] = $dia6xx;
		$_SESSION["dia7xx"] = $dia7xx;
		$_SESSION["dia8xx"] = $dia8xx;
		$_SESSION["dia9xx"] = $dia9xx;
		$_SESSION["dia10xx"] = $dia10xx;
		$_SESSION["dia11xx"] = $dia11xx;
		$_SESSION["dia12xx"] = $dia12xx;
		$_SESSION["dia13xx"] = $dia13xx;
		$_SESSION["dia14xx"] = $dia14xx;
		$_SESSION["dia15xx"] = $dia15xx;
		$_SESSION["dia16xx"] = $dia16xx;
		$_SESSION["dia17xx"] = $dia17xx;
		$_SESSION["dia18xx"] = $dia18xx;
		$_SESSION["dia19xx"] = $dia19xx;
		$_SESSION["dia20xx"] = $dia20xx;
		$_SESSION["dia21xx"] = $dia21xx;
		$_SESSION["dia22xx"] = $dia22xx;
		$_SESSION["dia23xx"] = $dia23xx;
		$_SESSION["dia24xx"] = $dia24xx;
		$_SESSION["dia25xx"] = $dia25xx;
		$_SESSION["dia26xx"] = $dia26xx;
		$_SESSION["dia27xx"] = $dia27xx;
		$_SESSION["dia28xx"] = $dia28xx;
		$_SESSION["dia29xx"] = $dia29xx;
		$_SESSION["dia30xx"] = $dia30xx;
		$_SESSION["dia31xx"] = $dia31xx;
    }
	
	function getAll4_infocore(){
        $persona = new Persona();
        $res = $persona->obtenerPersonas_infocore();
        
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
                
                    $color="black";$tmp="";
					
						if($row['Paso']=="div1"){
                            $tmp = "(1/5) Por Contactar - " . substr($row['Observaciones'],0,90);    
                        }
                        if($row['Paso']=="div2"){
                            $tmp = "(2/5) Pdte Documentos - " . substr($row['Observaciones'],0,90);    
                        }
                        if($row['Paso']=="div3"){
                            $tmp = "(3/5) En Evalucion - " . substr($row['Observaciones'],0,90);    
                        }
                        if($row['Paso']=="div4"){
                            $tmp = "(4/5) En Verificaciones - " . substr($row['Observaciones'],0,90);    
                        }
                        if($row['Paso']=="div5"){
                            $tmp = "(5/5) Listo/desemb - " . substr($row['Observaciones'],0,90);    
                        }
                        if($row['Paso']=="div6"){
                            $tmp = "DESEMBOLSADO S/ " . number_format($row['Monto'],0) . " [" . $row['Fecha_2'] . "]";   
							$color = "blue";							
                        }
						if($row['Paso']=="div7"){
                            $tmp = "No contesta - " . substr($row['Observaciones'],0,90);   
							$color = "red";
                        }
						if($row['Paso']=="div8"){
                            $tmp = "Rechazado - " . substr($row['Observaciones'],0,90); 
							$color = "red";							
                        }
                echo "<tr>";
                echo "<td>" . substr($row['Fecha'],0,10) . "</td>";
                echo "<td>" . $row['Dni'] . " - " . substr($row['Nombres'],0,30) . "</td>";
                echo "<td><span style='color:" . $color . "'>" . $tmp . "</span></td>";
                echo "</tr>";
            }
        }
    }
	


	function getAll_wsp(){
        $persona = new Persona();
        $res = $persona->obtenerWhatsApp();
        
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
                

                echo "<tr>";
                echo "<td>" . $row['Fecha'] . " <button type='button' class='btn btn-danger btn-xs' data-toggle='modal' data-target='#EliminarTarjeta' onclick='setear(\"" . $row['Id'] . "\",\"" . $row['Nombre'] . "\")'>X</button></td>";
				echo "<td>" . $row['Tematico'] . "</td>";
				echo "<td>" . $row['Canal'] . " - " . $row['Numero'] . "</td>";
                echo "<td> - " . $row['Nombre'] . "</td>";
                echo "</tr>";
            }
        }
    }
    
    function getAllAelu(){
        $persona = new Persona();
        $res = $persona->obtenerPersonas_aelu();
        
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
                echo "<tr>";
                echo "<td>" . $row['Fecha'] . "</td>";
                echo "<td>" . $row['Doi'] .  "</td>";
                echo "<td>" . $row['Resultado'] . "</td>";
                echo "<td>" . substr($row['Celular'],-9) . " / " . $row['Nick'] . "</td>";
                echo "</tr>";
            }
        }
    }
    
    function getAllSuperSorteo(){
        $persona = new Persona();
        $res = $persona->obtenerPersonas_supersorteo();
        
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
                echo "<tr>";
                echo "<td>" . $row['Fecha'] . "</td>";
                echo "<td>" . $row['Doi'] .  "</td>";
                echo "<td>" . $row['Resultado'] . "</td>";
                echo "<td>" . substr($row['Celular'],-9) . " / " . $row['Nick'] . "</td>";
                echo "</tr>";
            }
        }
    }

    function getDataLeads($cant){
        $persona = new Persona();
        $cadena = "";
        
        for ($i = $cant; $i >= 1; $i--) {
            
            $res = $persona->obtenerTotalLeads($i);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            $tmp = $row['Total'];
            
            if($i==$cant)
                $cadena = $cadena . $tmp;
            else
                $cadena =  $cadena . "," . $tmp;
        }
        echo "data: [" . $cadena . "],";

    }
    
    function getDataLeads_t($cant, $utm){
        $persona = new Persona();
        $preaprob = 0;
        
        for ($i = $cant; $i >= 1; $i--) {
            
            $res = $persona->obtenerTotalLeads_t($i, $utm);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            $tmp = $row['Total'];
            
            $preaprob =  $preaprob + $tmp;
        }
        echo "[" . $preaprob . "]";

    }
    
    function getDataLeads_hoy($utm){
        $persona = new Persona();
        
            $res = $persona->obtenerTotalLeads_hoy($utm);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            $tmp = $row['Total'];
            
        echo $tmp;

    }
    
    function getDataLeads_hoy2($utm, $utm1){
        $persona = new Persona();
        
            $res = $persona->obtenerTotalLeads_hoy2($utm, $utm1);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            $tmp = $row['Total'];
            
        echo $tmp;

    }
    
    function getDataLeads_t2($cant, $utm, $utm1){
        $persona = new Persona();
        $preaprob = 0;
        
        for ($i = $cant; $i >= 1; $i--) {
            
            $res = $persona->obtenerTotalLeads_t2($i, $utm, $utm1);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            $tmp = $row['Total'];
            
            $preaprob =  $preaprob + $tmp;
        }
        echo "[" . $preaprob . "]";

    }
    
    function getDataPreaprobados_t2($cant, $utm, $utm1){
        $persona = new Persona();
        $preaprob = 0;
        
        for ($i = $cant; $i >= 1; $i--) {
            
            $res = $persona->obtenerPreAprobados_t2($i, $utm, $utm1);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            $tmp = $row['Total'];
            
            $preaprob =  $preaprob + $tmp;
        }
        echo "[" . $preaprob . "]";

    }
    
    function getTotDesemb(){
        $persona = new Persona();
        
            $res = $persona->total_desembolsados();
            $row = $res->fetch(PDO::FETCH_ASSOC);
            $tmp = $row['TotalDesem'];
            
        echo $tmp;

    }
	
    function getTotDesemb_exp($mes){
        $persona = new Persona();
        
            $res = $persona->total_desembolsados_exp($mes);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            $tmp = $row['TotalDesem'];
            
        echo $tmp;

    }

    function getTotDesemb_mpasado(){
        $persona = new Persona();
        
            $res = $persona->total_desembolsados_mpasado();
            $row = $res->fetch(PDO::FETCH_ASSOC);
            $tmp = $row['TotalDesem'];
            
        echo $tmp;

    }
	
	function getTotDesemb_mantepasado(){
        $persona = new Persona();
        
            $res = $persona->total_desembolsados_mantepasado();
            $row = $res->fetch(PDO::FETCH_ASSOC);
            $tmp = $row['TotalDesem'];
            
        echo $tmp;

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
    
    function tarjetasPendientes($funcionario){
        $persona = new Persona();
        
            $res = $persona->tarjetasPendientes_persona($funcionario);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            
            $res1 = $persona->tarjetasPendientes_persona_div1($funcionario);
            $row1 = $res1->fetch(PDO::FETCH_ASSOC);
            
            $tmp = $row['Total'] + ($row1['Total']/2);
            
        echo $tmp;

    }
	
    function tarjetasPendientes_agencias($funcionario){
        $persona = new Persona();
        
            $res = $persona->tarjetasPendientes_persona_agencias($funcionario);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            
            $res1 = $persona->tarjetasPendientes_persona_div1_agencias($funcionario);
            $row1 = $res1->fetch(PDO::FETCH_ASSOC);
            
            $tmp = $row['Total'] + ($row1['Total']/2);
            
        echo $tmp;

    }
    
    function tarjetasPendientes_sandbox($funcionario){
        $persona = new Persona();
        
            $res = $persona->tarjetasPendientes_persona($funcionario);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            
            $tmp = $row['Total'];
            
            $res1 = $persona->tarjetasPendientes_persona_div1($funcionario);
            $row1 = $res1->fetch(PDO::FETCH_ASSOC);
			
			$res2 = $persona->activo_funcionario_digital($funcionario);
            $row2 = $res2->fetch(PDO::FETCH_ASSOC);
			
			$tmp1 = ($row1['Total']/2);
			$tmp2 = $row2['Activo'];
			
			if($tmp2=="n")
				$_SESSION["$funcionario"] = 100;
			else          
				$_SESSION["$funcionario"] = ($tmp + $tmp1);

    }
	
	function tarjetasPendientes_sandbox_plazofijo($funcionario){
        $persona = new Persona();
		
			$tmp="";$tmp2="";
        
            $res = $persona->tarjetasPendientes_plazofijo($funcionario);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            
            $tmp = $row['Total'];
            
			$res2 = $persona->activo_funcionario_digital($funcionario);
            $row2 = $res2->fetch(PDO::FETCH_ASSOC);
			
			$tmp2 = $row2['Activo'];
			
			if($tmp2=="n")
				$_SESSION["$funcionario"] = 100;
			else          
				$_SESSION["$funcionario"] = $tmp;

    }
	
    function tarjetasPendientes_sandbox_agencias($funcionario){
        $persona = new Persona();

            $res = $persona->tarjetasPendientes_persona_agencias($funcionario);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            
            $res1 = $persona->tarjetasPendientes_persona_div1_agencias($funcionario);
            $row1 = $res1->fetch(PDO::FETCH_ASSOC);
			
			$res2 = $persona->activo_funcionario($funcionario);
            $row2 = $res2->fetch(PDO::FETCH_ASSOC);
           
            $tmp = $row['Total'];
            $tmp1 = ($row1['Total']/2);
			$tmp2 = $row2['Activo'];
            
			if($tmp2=="n")
				$_SESSION["$funcionario"] = 100;
			else
				$_SESSION["$funcionario"] = ($tmp + $tmp1);

    }
    
    function getTotDesemb_persona($funcionario){
        $persona = new Persona();
        
            $res = $persona->total_desembolsados_persona($funcionario);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            $tmp = $row['TotalDesem'];
            
        echo $tmp;

    }
	
    function getTotDesemb_agencia($funcionario, $tarea){
        $persona = new Persona();
        
            $res = $persona->total_desembolsados_agencia($funcionario, $tarea);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            $tmp = $row['TotalDesem'];
            
        echo $tmp;
    }
	
    function getTotDesemb_agencia_dol($funcionario, $tarea){
        $persona = new Persona();
        
            $res = $persona->total_desembolsados_agencia_dol($funcionario, $tarea);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            $tmp = $row['TotalDesem'];
            
        echo $tmp;
    }
	
    function getTotDesemb_agencia_mpasado($funcionario, $tarea){
        $persona = new Persona();
        
            $res = $persona->total_desembolsados_agencia_mpasado($funcionario, $tarea);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            $tmp = $row['TotalDesem'];
            
        echo $tmp;
    }
	
    function getTotDesemb_agencia_mpasado_dol($funcionario, $tarea){
        $persona = new Persona();
        
            $res = $persona->total_desembolsados_agencia_mpasado_dol($funcionario, $tarea);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            $tmp = $row['TotalDesem'];
            
        echo $tmp;
    }

    function getTotDesemb_persona_mpasado($funcionario){
        $persona = new Persona();
        
            $res = $persona->total_desembolsados_persona_mpasado($funcionario);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            $tmp = $row['TotalDesem'];
            
        echo $tmp;

    }
	
	function getTotDesemb_persona_mantepasado($funcionario){
        $persona = new Persona();
        
            $res = $persona->total_desembolsados_persona_mantepasado($funcionario);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            $tmp = $row['TotalDesem'];
            
        echo $tmp;

    }	
    
    function getImpDesemb(){
        $persona = new Persona();
        
            $res = $persona->imp_desembolsados();
            $row = $res->fetch(PDO::FETCH_ASSOC);
            $tmp = number_format($row['TotalDesem'],0);
            
        echo $tmp;

    }
	
    function getImpDesemb_exp($mes){
        $persona = new Persona();
        
            $res = $persona->imp_desembolsados_exp($mes);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            $tmp = number_format($row['TotalDesem'],0);
            
        echo $tmp;

    }

    function getImpDesemb_mpasado(){
        $persona = new Persona();
        
            $res = $persona->imp_desembolsados_mpasado();
            $row = $res->fetch(PDO::FETCH_ASSOC);
            $tmp = number_format($row['TotalDesem'],0);
            
        echo $tmp;

    }
	
	function getImpDesemb_mantepasado(){
        $persona = new Persona();
        
            $res = $persona->imp_desembolsados_mantepasado();
            $row = $res->fetch(PDO::FETCH_ASSOC);
            $tmp = number_format($row['TotalDesem'],0);
            
        echo $tmp;

    }
    
    function getImpDesemb_persona($funcionario){
        $persona = new Persona();
        
            $res = $persona->imp_desembolsados_persona($funcionario);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            $tmp = number_format($row['TotalDesem'],0);
            
        echo $tmp;

    }

    function getImpDesemb_agencia($funcionario, $tarea){
        $persona = new Persona();
        
            $res = $persona->imp_desembolsados_agencia($funcionario, $tarea);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            $tmp = number_format($row['TotalDesem'],0);
            
        echo $tmp;

    }
	
    function getImpDesemb_agencia_dol($funcionario, $tarea){
        $persona = new Persona();
        
            $res = $persona->imp_desembolsados_agencia_dol($funcionario, $tarea);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            $tmp = number_format($row['TotalDesem'],0);
            
        echo $tmp;

    }
	
    function getImpDesemb_agencia_mpasado($funcionario, $tarea){
        $persona = new Persona();
        
            $res = $persona->imp_desembolsados_agencia_mpasado($funcionario, $tarea);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            $tmp = number_format($row['TotalDesem'],0);
            
        echo $tmp;

    }
	
    function getImpDesemb_agencia_ante_pasado($funcionario, $tarea){
        $persona = new Persona();
        
            $res = $persona->imp_desembolsados_agencia_ante_pasado($funcionario, $tarea);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            $tmp = number_format($row['TotalDesem'],0);
            
        echo $tmp;

    }
	
    function getImpDesemb_agencia_mpasado_dol($funcionario, $tarea){
        $persona = new Persona();
        
            $res = $persona->imp_desembolsados_agencia_mpasado_dol($funcionario, $tarea);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            $tmp = number_format($row['TotalDesem'],0);
            
        echo $tmp;

    }
	
    function getImpDesemb_agencia_ante_pasado_dol($funcionario, $tarea){
        $persona = new Persona();
        
            $res = $persona->imp_desembolsados_agencia_ante_pasado_dol($funcionario, $tarea);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            $tmp = number_format($row['TotalDesem'],0);
            
        echo $tmp;

    }

    function getImpDesemb_persona_mpasado($funcionario){
        $persona = new Persona();
        
            $res = $persona->imp_desembolsados_persona_mpasado($funcionario);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            $tmp = number_format($row['TotalDesem'],0);
            
        echo $tmp;

    }
	
	function getImpDesemb_persona_mantepasado($funcionario){
        $persona = new Persona();
        
            $res = $persona->imp_desembolsados_persona_mantepasado($funcionario);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            $tmp = number_format($row['TotalDesem'],0);
            
        echo $tmp;

    }
    
    function getListadoDesemb(){
        $persona = new Persona();
        $res = $persona->obtListadoDesemb();
        $i=1;
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
                if(substr($row['Funcionario'],0,5)=="XIOMI"){
                    $tmp = "XC";
                    $color = "success";
                }
                if(substr($row['Funcionario'],0,5)=="KAORI"){
                    $tmp = "KU";
                    $color = "danger";
                }
                if(substr($row['Funcionario'],0,5)=="JOHAN"){
                    $tmp = "JD";
                    $color = "primary";
                }
                
                echo $i++ . ".- " . substr($row['Nombres'],0,22) . " [" . $row['Dni'] . "] - S/ " .  number_format($row['Monto'],0) . " - " . $row['Nombre_empresa'] . " <button type='button' class='btn btn-" . $color . " btn-xs'>". $tmp . "</button><br>";    
            }
        }
    }
		
    function getListadoDesemb_exp($mes){
        $persona = new Persona();
        $res = $persona->obtListadoDesemb_exp($mes);
        $i=1;
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
                echo $i++ . ".- " . substr($row['Nombres'],0,22) . " [" . $row['Dni'] . "] - S/ " .  number_format($row['Monto'],0) . "<br>";    
            }
        }
    }
	
    function getListadoDesemb_infocore($mes){
        $persona = new Persona();
        $res = $persona->desembolsado_infocore_listado($mes);
        $i=1;
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
                echo $i++ . ".- " . substr($row['Nombres'],0,22) . " [" . $row['Dni'] . "] - S/ " .  number_format($row['Monto'],0) . "<br>";    
            }
        }
    }
	
    function getTotDesemb_infocore($mes){
        $persona = new Persona();
        
            $res = $persona->total_desembolsados_infocore($mes);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            $tmp = $row['TotalDesem'];
            
        echo $tmp;

    }
	
    function getImpDesemb_infocore($mes){
        $persona = new Persona();
        
            $res = $persona->imp_desembolsados_infocore($mes);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            $tmp = number_format($row['TotalDesem'],0);
            
        echo $tmp;

    }
	
    function funnel_experian_lista_api($paso){
        $persona = new Persona();
        $res = $persona->funnel_experian_lista($paso);
        $i=1;
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
                echo $i++ . ".- " . substr($row['Nombres'],0,22) . " [" . $row['Dni'] . "] - S/ " .  number_format($row['Monto'],0) . "<br>";    
            }
        }
    }

    function funnel_agencias_infocore_lista_api($paso){
        $persona = new Persona();
        $res = $persona->funnel_agencias_infocore_lista($paso);
        $i=1;
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
				$desemb = "";
				$desemb = $row['Fec_desembolso'];
				if($desemb=="0000-00-00")
					$desemb = "";
				else
					$desemb = " - " . $row['Fec_desembolso'];
				
                echo $i++ . ".- " . substr($row['Nombres'],0,22) . " [" . $row['Dni'] . "] - S/ " .  number_format($row['Monto'],0) . $desemb . "<br>";    
            }
        }
    }

    function listado_tarjetas_no_actualizadas_api($dias){
        $persona = new Persona();
        $res = $persona->listado_tarjetas_no_actualizadas($dias);
        $i=1;
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
				$tmp1="";
				if($row['Paso']=="div1")
					$tmp1="Por contactar";
				if($row['Paso']=="div2")
					$tmp1="Pdte Docs";
				if($row['Paso']=="div3")
					$tmp1="En evaluacion";
				if($row['Paso']=="div4")
					$tmp1="En verificaciones";
				if($row['Paso']=="div5")
					$tmp1="Listo p/desemb";
				
				$tmp="";$color="";
                if(substr($row['Funcionario'],0,5)=="Dayss"){
                    $tmp = "DAP";
                    $color = "danger";
                }
                if(substr($row['Funcionario'],0,5)=="Saman"){
                    $tmp = "SPL";
                    $color = "success";
                }
                if(substr($row['Funcionario'],0,5)=="Danie"){
                    $tmp = "DPG";
                    $color = "warning";
                }
				if(substr($row['Funcionario'],0,5)=="Gabri"){
                    $tmp = "GTG";
                    $color = "primary";
                }
				if(substr($row['Funcionario'],0,5)=="Cinth"){
                    $tmp = "CLP";
                    $color = "info";
                }
				if(substr($row['Funcionario'],0,5)=="Chris"){
                    $tmp = "CJV";
                    $color = "dark";
                }
				if(substr($row['Funcionario'],0,5)=="Gianc"){
                    $tmp = "GP";
                    $color = "secondary";
                }
				
                echo "<b>" . $i++ . ".- " . substr($row['Nombres'],0,22) . " [" . $row['Dni'] . "]</b> Obs = " .  $row['Observaciones'] . "<br>Ult Mod = " . $row['Fecha_2'] . " - " . $tmp1 . " <button type='button' class='btn btn-" . $color . " btn-xs'>" . $tmp . "</button><br>";   
				
            }
        }
    }
	
    function getListadoDesemb_agencia($funcionario){
        $persona = new Persona();
        $res = $persona->obtListadoDesemb_agencia($funcionario);
        $i=1;
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
				$tmp="";$color="";
                if(substr($row['Funcionario'],0,5)=="Dayss"){
                    $tmp = "DAP";
                    $color = "danger";
                }
                if(substr($row['Funcionario'],0,5)=="Saman"){
                    $tmp = "SPL";
                    $color = "success";
                }
                if(substr($row['Funcionario'],0,5)=="Danie"){
                    $tmp = "DPG";
                    $color = "warning";
                }
				if(substr($row['Funcionario'],0,5)=="Gabri"){
                    $tmp = "GTG";
                    $color = "primary";
                }
				if(substr($row['Funcionario'],0,5)=="Cinth"){
                    $tmp = "CLP";
                    $color = "info";
                }
				if(substr($row['Funcionario'],0,5)=="Chris"){
                    $tmp = "CJV";
                    $color = "dark";
                }
				if(substr($row['Funcionario'],0,5)=="Gianc"){
                    $tmp = "GP";
                    $color = "secondary";
                }
				
				$moneda="";$short="";
				
				if($row['Moneda']=="1")
					$moneda = "S/ ";
				if($row['Moneda']=="2")
					$moneda = "$ ";
				
				$short = $row['Tipo_prestamo'];
                
                echo $i++ . ".- " . substr($row['Nombres'],0,18) . " [" . $row['Dni'] . "] - " . $moneda . number_format($row['Monto'],0) . " ". $short . " <button type='button' class='btn btn-" . $color . " btn-xs'>". $tmp . "</button><br>";    
            }
        }
    }
	
	function getListadoDesemb_agencia_mpasado($funcionario){
        $persona = new Persona();
        $res = $persona->obtListadoDesemb_agencia_mpasado($funcionario);
        $i=1;
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
				$tmp="";$color="";
                if(substr($row['Funcionario'],0,5)=="Dayss"){
                    $tmp = "DAP";
                    $color = "danger";
                }
                if(substr($row['Funcionario'],0,5)=="Saman"){
                    $tmp = "SPL";
                    $color = "success";
                }
                if(substr($row['Funcionario'],0,5)=="Danie"){
                    $tmp = "DPG";
                    $color = "warning";
                }
				if(substr($row['Funcionario'],0,5)=="Gabri"){
                    $tmp = "GTG";
                    $color = "primary";
                }
				if(substr($row['Funcionario'],0,5)=="Cinth"){
                    $tmp = "CLP";
                    $color = "info";
                }
				if(substr($row['Funcionario'],0,5)=="Chris"){
                    $tmp = "CJV";
                    $color = "dark";
                }
				if(substr($row['Funcionario'],0,5)=="Gianc"){
                    $tmp = "GP";
                    $color = "secondary";
                }
				
				$short="";$moneda="";
				$short = $row['Tipo_prestamo'];
				
				if($row['Moneda']=="1")
					$moneda = "S/ ";
				if($row['Moneda']=="2")
					$moneda = "$ ";
                
                echo $i++ . ".- " . substr($row['Nombres'],0,18) . " [" . $row['Dni'] . "] - " . $moneda . number_format($row['Monto'],0) . " ". $short . " <button type='button' class='btn btn-" . $color . " btn-xs'>". $tmp . "</button><br>";    
            }
        }
    }

    function getListadoDesemb_mpasado(){
        $persona = new Persona();
        $res = $persona->obtListadoDesemb_mpasado();
        $i=1;
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
                if(substr($row['Funcionario'],0,5)=="XIOMI"){
                    $tmp = "XC";
                    $color = "success";
                }
                if(substr($row['Funcionario'],0,5)=="KAORI"){
                    $tmp = "KU";
                    $color = "danger";
                }
                if(substr($row['Funcionario'],0,5)=="JOHAN"){
                    $tmp = "JD";
                    $color = "primary";
                }
                
                echo $i++ . ".- " . substr($row['Nombres'],0,22) . " [" . $row['Dni'] . "] - S/ " .  number_format($row['Monto'],0) . " - " . $tmp . " - " . $row['Nombre_empresa'] . "<br>";    
            }
        }
    }
	
	function getListadoDesemb_mantepasado(){
        $persona = new Persona();
        $res = $persona->obtListadoDesemb_mantepasado();
        $i=1;
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
                if(substr($row['Funcionario'],0,5)=="XIOMI"){
                    $tmp = "XC";
                    $color = "success";
                }
                if(substr($row['Funcionario'],0,5)=="KAORI"){
                    $tmp = "KU";
                    $color = "danger";
                }
                if(substr($row['Funcionario'],0,5)=="JOHAN"){
                    $tmp = "JD";
                    $color = "primary";
                }
                
                echo $i++ . ".- " . substr($row['Nombres'],0,22) . " [" . $row['Dni'] . "] - S/ " .  number_format($row['Monto'],0) . " - " . $tmp . " - " . $row['Nombre_empresa'] . "<br>";    
            }
        }
    }
    
    function getDataPreaprobados_t($cant, $utm){
        $persona = new Persona();
        $preaprob = 0;
        
        for ($i = $cant; $i >= 1; $i--) {
            
            $res = $persona->obtenerPreAprobados_t($i, $utm);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            $tmp = $row['Total'];
            
            $preaprob =  $preaprob + $tmp;
        }
        echo "[" . $preaprob . "]";

    }
    
    function getDataPreaprobados_hoy($funcionario){
        $persona = new Persona();
        $preaprob = 0;
        
            $res = $persona->obtenerPreAprobados_hoy($funcionario);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            $preaprob = $row['Total'];
       
        echo "[" . $preaprob . "]";
    }
    
    function getDataPreaprobados_utm_hoy($utm){
        $persona = new Persona();
        $preaprob = 0;
        
            $res = $persona->getDataPreaprobados_utm_hoy($utm);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            $preaprob = $row['Total'];
       
        echo $preaprob;
    }

    function getDataPreaprobados_utm_hoy2($utm, $utm1){
        $persona = new Persona();
        $preaprob = 0;
        
            $res = $persona->getDataPreaprobados_utm_hoy2($utm, $utm1);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            $preaprob = $row['Total'];
       
        echo $preaprob;
    }    
    
    function getDataPreaprobados($cant){
        $persona = new Persona();
        $cadena = "";
        
        for ($i = $cant; $i >= 1; $i--) {
            
            $res = $persona->obtenerPreAprobados($i);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            $tmp = $row['Total'];
            
            if($i==$cant)
                $cadena = $cadena . $tmp;
            else
                $cadena =  $cadena . "," . $tmp;
        }
        echo "data: [" . $cadena . "],";
        
    }
	
    function getDataPreaprobados_personas($cant, $funcionario){
        $persona = new Persona();
        $preaprob = 0;
        
                  
            $res = $persona->obtenerPreAprobados_por_funcionario_personas($cant, $funcionario);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            $tmp = $row['Total'];
            
            $preaprob =  $preaprob + $tmp;
        
		echo "[" . $preaprob . "]";
        
    }
    
    function getDataPreaprobadosXiomi_t($cant){
        $persona = new Persona();
        $preaprob = 0;
        
        for ($i = $cant; $i >= 1; $i--) {
            
            $res = $persona->obtenerPreAprobadosXiomi($i);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            $tmp = $row['Total'];
            
            $preaprob =  $preaprob + $tmp;
        }
        echo "[" . $preaprob . "]";
        
    }
    
    function getDataPreaprobadosKaori_t($cant){
        $persona = new Persona();
        $preaprob = 0;
        
        for ($i = $cant; $i >= 1; $i--) {
            
            $res = $persona->obtenerPreAprobadosKaori($i);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            $tmp = $row['Total'];
            
            $preaprob =  $preaprob + $tmp;
        }
        echo "[" . $preaprob . "]";
        
    }
    
    function getDataPreaprobadosJohann_t($cant){
        $persona = new Persona();
        $preaprob = 0;
        
        for ($i = $cant; $i >= 1; $i--) {
            
            $res = $persona->obtenerPreAprobadosJohann($i);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            $tmp = $row['Total'];
            
            $preaprob =  $preaprob + $tmp;
        }
        echo "[" . $preaprob . "]";
        
    }
    
    function getDataPreaprobadosXiomi($cant){
        $persona = new Persona();
        $cadena = "";
        
        for ($i = $cant; $i >= 1; $i--) {
            
            $res = $persona->obtenerPreAprobadosXiomi($i);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            $tmp = $row['Total'];
            
            if($i==$cant)
                $cadena = $cadena . $tmp;
            else
                $cadena =  $cadena . "," . $tmp;
        }
        echo "data: [" . $cadena . "],";
        
    }
    
    function getDataPreaprobadosKaori($cant){
        $persona = new Persona();
        $cadena = "";
        
        for ($i = $cant; $i >= 1; $i--) {
            
            $res = $persona->obtenerPreAprobadosKaori($i);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            $tmp = $row['Total'];
            
            if($i==$cant)
                $cadena = $cadena . $tmp;
            else
                $cadena =  $cadena . "," . $tmp;
        }
        echo "data: [" . $cadena . "],";
        
    }
    
    function getDataPreaprobadosJohann($cant){
        $persona = new Persona();
        $cadena = "";
        
        for ($i = $cant; $i >= 1; $i--) {
            
            $res = $persona->obtenerPreAprobadosJohann($i);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            $tmp = $row['Total'];
            
            if($i==$cant)
                $cadena = $cadena . $tmp;
            else
                $cadena =  $cadena . "," . $tmp;
        }
        echo "data: [" . $cadena . "],";
        
    }
    
    function getLabels($labels){
        date_default_timezone_set('America/Lima');
        $cadena = "";
        
        for ($i = $labels; $i >= 1; $i--) {
            $lit = date('d-m', strtotime('-' . $i . ' day'));
            $cadena = $cadena . "'" . $lit . "',";
        }
        echo $cadena;
    }

    function exporta_csv_wsp(){
        $persona = new Persona();
        $res = $persona->obtenerWhatsApp();
        
        if($res->rowCount())
        {
            $delimiter = "|";
            $filename = "whatsapp_" . date('Y-m-d') . ".csv";
    
            //create a file pointer
            $f = fopen('php://memory', 'w');
    
            //set column headers
            $fields = array('Fecha','Tema','Canal-Celular','Alias');
            fputcsv($f, $fields, $delimiter);
    
            //output each row of the data, format line as csv and write to file pointer
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
				
				$tmp = "";
				$tmp = $row['Canal'] . " - " . $row['Numero'];

                $lineData = array($row['Fecha'], $row['Tematico'], $tmp, $row['Nombre']);
                fputcsv($f, $lineData, $delimiter);
            }
    
            //move back to beginning of file
            fseek($f, 0);
    
            //set headers to download file rather than displayed
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="' . $filename . '";');
    
            //output all remaining data on a file pointer
            fpassthru($f);
        }
        exit;
    }

    function exporta_csv_exp(){
        $persona = new Persona();
        $res = $persona->obtenerPersonas_exp();
        
        if($res->rowCount())
        {
            $delimiter = "|";
            $filename = "experian_" . date('Y-m-d') . ".csv";
    
            //create a file pointer
            $f = fopen('php://memory', 'w');
    
            //set column headers
            $fields = array('Fecha','Nombres','Dni','Situacion','Estado','Celular','Correo');
            fputcsv($f, $fields, $delimiter);
    
            //output each row of the data, format line as csv and write to file pointer
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
				if($row['Estado']=="PRE-APROBADO"){
                    $color="";$tmp="";
                    if($row['Paso']=="div7"){
                        $tmp = "X - " . $row['Observaciones'];
                    }else{
                        if($row['Paso']=="div2"){
                            $tmp = "(2/5) ENVIANDO DOCUMENTOS";    
                        }
                        if($row['Paso']=="div4"){
                            $tmp = "(3/5) VERIFICANDO LAB/DOM";    
                        }
                        if($row['Paso']=="div3"){
                            $tmp = "(4/5) FILE EN AGENCIA";    
                        }
                        if($row['Paso']=="div5"){
                            $tmp = "(5/5) FIRMA EN AGENCIA";    
                        }
                        if($row['Paso']=="div6"){
                            $tmp = "DESEMBOLSADO S/ " . number_format($row['Monto'],0);    
                        }
                        if($row['Paso']=="div1"){
                            $tmp = "(1/5) EN CONTACTO";    
                        }
                    }
                }else{
                    $tmp = $row['Estado'];
                }

                $lineData = array($row['Fecha'], $row['Nombres'], $row['Dni'], $row['Situacion'], $tmp, $row['Celular'], $row['Correo']);
                fputcsv($f, $lineData, $delimiter);
            }
    
            //move back to beginning of file
            fseek($f, 0);
    
            //set headers to download file rather than displayed
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="' . $filename . '";');
    
            //output all remaining data on a file pointer
            fpassthru($f);
        }
        exit;
    }

    function exporta_csv_infocore(){
        $persona = new Persona();
        $res = $persona->obtenerPersonas_infocore();
        
        if($res->rowCount())
        {
            $delimiter = "|";
            $filename = "infocore_" . date('Y-m-d') . ".csv";
    
            //create a file pointer
            $f = fopen('php://memory', 'w');
    
            //set column headers
            $fields = array('Fecha','Dni','Nombres','Estado','Observaciones');
            fputcsv($f, $fields, $delimiter);
    
            //output each row of the data, format line as csv and write to file pointer
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
					
                    $color="";$tmp="";
						if($row['Paso']=="div1"){
                            $tmp = "(1/5) Por Contactar";    
                        }
                        if($row['Paso']=="div2"){
                            $tmp = "(2/5) Pdte Documentos";    
                        }
                        if($row['Paso']=="div3"){
                            $tmp = "(3/5) En Evalucion";    
                        }
                        if($row['Paso']=="div4"){
                            $tmp = "(4/5) En Verificaciones";    
                        }
                        if($row['Paso']=="div5"){
                            $tmp = "(5/5) Listo/desemb";    
                        }
                        if($row['Paso']=="div6"){
                            $tmp = "DESEMBOLSADO S/ " . number_format($row['Monto'],0) . " [" . $row['Fecha_2'] . "]";   
                        }
						if($row['Paso']=="div7"){
                            $tmp = "No contesta";   
                        }
						if($row['Paso']=="div8"){
                            $tmp = "Rechazado"; 
                        }

                $lineData = array(substr($row['Fecha'],0,10), $row['Dni'], $row['Nombres'], $tmp, $row['Observaciones']);
                fputcsv($f, $lineData, $delimiter);
    
			}
            //move back to beginning of file
            fseek($f, 0);
    
            //set headers to download file rather than displayed
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="' . $filename . '";');
    
            //output all remaining data on a file pointer
            fpassthru($f);
        }
        exit;
    }

    
    function exporta_csv_lista(){
        $persona = new Persona();
        $res = $persona->obtenerPersonas();
        
        if($res->rowCount())
        {
            $delimiter = "|";
            $filename = "lista_" . date('Y-m-d') . ".csv";
    
            //create a file pointer
            $f = fopen('php://memory', 'w');
    
            //set column headers
            $fields = array('Fecha','Nombres','Dni','Situacion','Estado','Celular');
            fputcsv($f, $fields, $delimiter);
    
            //output each row of the data, format line as csv and write to file pointer
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
                $lineData = array($row['Fecha'], $row['Nombres'], $row['Dni'], $row['Situacion'], $row['Estado'], $row['Celular']);
                fputcsv($f, $lineData, $delimiter);
            }
    
            //move back to beginning of file
            fseek($f, 0);
    
            //set headers to download file rather than displayed
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="' . $filename . '";');
    
            //output all remaining data on a file pointer
            fpassthru($f);
        }
        exit;
        
        
    }
    
    function exporta_csv_aelu(){
        $persona = new Persona();
        $res = $persona->obtenerPersonas_aelu();
        
        if($res->rowCount())
        {
            $delimiter = "|";
            $filename = "aelu_" . date('Y-m-d') . ".csv";
    
            //create a file pointer
            $f = fopen('php://memory', 'w');
    
            //set column headers
            $fields = array('Fecha','Doi','Resultado','Celular','Nick');
            fputcsv($f, $fields, $delimiter);
    
            //output each row of the data, format line as csv and write to file pointer
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
                $lineData = array($row['Fecha'], $row['Doi'], $row['Resultado'], $row['Celular'], $row['Nick']);
                fputcsv($f, $lineData, $delimiter);
            }
    
            //move back to beginning of file
            fseek($f, 0);
    
            //set headers to download file rather than displayed
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="' . $filename . '";');
    
            //output all remaining data on a file pointer
            fpassthru($f);
        }
        exit;
        
        
    }
    
    function exporta_csv_supersorteo(){
        $persona = new Persona();
        $res = $persona->obtenerPersonas_supersorteo();
        
        if($res->rowCount())
        {
            $delimiter = "|";
            $filename = "supersorteo_" . date('Y-m-d') . ".csv";
    
            //create a file pointer
            $f = fopen('php://memory', 'w');
    
            //set column headers
            $fields = array('Fecha','Doi','Resultado','Celular','Nick');
            fputcsv($f, $fields, $delimiter);
    
            //output each row of the data, format line as csv and write to file pointer
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
                $lineData = array($row['Fecha'], $row['Doi'], $row['Resultado'], $row['Celular'], $row['Nick']);
                fputcsv($f, $lineData, $delimiter);
            }
    
            //move back to beginning of file
            fseek($f, 0);
    
            //set headers to download file rather than displayed
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="' . $filename . '";');
    
            //output all remaining data on a file pointer
            fpassthru($f);
        }
        exit;
        
        
    }
    
    
    function preaprobado(){
        $persona = new Persona();
        $res = $persona->obtenerPreAprobados();
        $row = $res->fetch(PDO::FETCH_ASSOC);
        $preaprobados = $row['Total'];
        $fec_act = date('F');
        $fec_act = substr($fec_act,0,3);
        echo "<b>Pre-aprobados:</b> [$fec_act] $preaprobados";
    }
    
    function totalLeads(){
        $persona = new Persona();
        $res = $persona->obtenerTotalLeads();
        $row = $res->fetch(PDO::FETCH_ASSOC);
        $totalLeads = $row['Total'];
        echo "/$totalLeads";
    }
    
    function preaprobado2(){
        $persona = new Persona();
        $res = $persona->obtenerPreAprobados2();
        $row = $res->fetch(PDO::FETCH_ASSOC);
        $preaprobados = $row['Total'];
        $fec_pas = date('F', strtotime('last month'));
        $fec_pas = substr($fec_pas,0,3);
        echo "<b> [$fec_pas] $preaprobados";
    }
    
    function totalLeads2(){
        $persona = new Persona();
        $res = $persona->obtenerTotalLeads2();
        $row = $res->fetch(PDO::FETCH_ASSOC);
        $totalLeads = $row['Total'];
        echo "/$totalLeads";
    }
    
    function add($item){
        $persona = new Persona();

        $res = $persona->nuevaPersona($item);
        $this->exito('Se ingreso el registro de manera correcta');
    }
	
    function add_plazofijo($item){
        $persona = new Persona();

        $res = $persona->nuevoPlazofijo($item);
        $this->exito('Se ingreso el registro de manera correcta');
		//echo json_decode($item);
    }	
	
    function add_pdp($item){
        $persona = new Persona();

        $res = $persona->nuevaPersona_pdp($item);
        $this->exito('Se ingreso el registro de manera correcta');
    }

    function add_wsp($item){
        $persona = new Persona();

        $res = $persona->nuevaPersona_wsp($item);
        $this->exito('Se ingreso el registro de manera correcta');
    }
    
    function add_aelulog($item){
        $persona = new Persona();

        $res = $persona->nuevaRegistroAelu($item);
        $this->exito('Se ingreso el registro de manera correcta Aelu');
    }
    
    function add_supersorteolog($item){
        $persona = new Persona();

        $res = $persona->nuevaRegistroSuperSorteo($item);
        $this->exito('Se ingreso el registro de manera correcta Super Sorteo');
    }
    
    function add2($item){
        $persona = new Persona();

        $res = $persona->nuevaPersona($item);
    }
    
    function add_Inscripcion($item){
        $persona = new Persona();
        $res = $persona->nuevaInscripcion($item);
    }
	
	function add_Agencias($item){
        $persona = new Persona();
        $res = $persona->nuevaAgencia($item);
    }
	
	function add_Agencias2($item){
        $persona = new Persona();
        $res = $persona->nuevaTareaAgencias2($item);
    }
    
    function error($mensaje){
        echo '<code>' . json_encode(array('mensaje' => $mensaje)) . '</code>'; 
    }

    function exito($mensaje){
        echo '<code>' . json_encode(array('mensaje' => $mensaje)) . '</code>'; 
    }

    function printJSON($array){
        echo '<code>'.json_encode($array).'</code>';
    }
	
	function ejecuta_api($demanda){
		$persona = new Persona();
        $res = $persona->ejecuta($demanda);
		
		if ($res->rowCount()) {
				echo "<b>" . $demanda  . "</b><br/>";
			while ($row = $res->fetch(PDO::FETCH_ASSOC)){
				$key = "";
				if($row["Key"]!="")
					$key = "[Key] ";
				
				echo $key . $row["Field"] .  " - " . $row["Type"] . "<br/>";
			}
		}else{
			echo "ok";
		}
	}
	
	function muesta_tablas($bd){
		$demanda = "SHOW TABLES";
		$persona = new Persona();
        $res = $persona->ejecuta($demanda);
		if ($res->rowCount()) {
			while ($row = $res->fetch(PDO::FETCH_ASSOC)){
				echo $row[$bd] . "<br/>";
			}
		}
			
		
	}
	
	function exportalo_csv_api($tabla){
		$persona = new Persona();
        $res = $persona->exportalo_csv($tabla);
		
		if($res->rowCount())
        {
			$delimiter = ";";$contador=0;
            $filename = $tabla . "_" . date('Y-m-d') . ".csv";
			$f = fopen('php://memory', 'w');
			
			//set column headers
            $fields = array();
			unset($fields[0]);
			
			$line_commanda = "SHOW COLUMNS FROM " . $tabla;
			$res2 = $persona->ejecuta($line_commanda);
			if ($res2->rowCount()) {
				while ($row2 = $res2->fetch(PDO::FETCH_ASSOC)){
					$fields[] = $row2["Field"];
					$contador++;
					}
			}
			
			fputcsv($f, trim($fields), $delimiter);
			
			while ($row = $res->fetch(PDO::FETCH_ASSOC)){
				$lineData = array();
				for($i=0;$i<$contador;$i++){
					$lineData[] = $row[$fields[$i]];
				}
                fputcsv($f, $lineData, $delimiter);
            }
			
            //move back to beginning of file
            fseek($f, 0);
    
            //set headers to download file rather than displayed
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="' . $filename . '";');
    
            //output all remaining data on a file pointer
            fpassthru($f);
		}
        exit;
		
	}
	
			
	}

?>