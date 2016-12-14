<?php
	session_start();
	
	$campos = array(
		"nombre" => array(
			"label" => "Nombre",
			"required" => true
		),
		"apellido"=> array(
			"label" => "Apellido",
			"required" => true
		),
		"puesto"=> array(
			"label" => "Puesto",
			"required" => true
		),
		"email"=> array(
			"label" => "Email",
			"required" => true
		),
		"empresa"=> array(
			"label" => "Nombre de la empresa",
			"required" => true
		),
		"direccion_empresa"=> array(
			"label" => "Dirección de la empresa",
			"required" => false
		),
		"ciudad"=> array(
			"label" => "Ciudad",
			"required" => true
		),
		"estado"=> array(
			"label" => "Estado",
			"required" => true
		),
		"cp"=> array(
			"label" => "Código Postal",
			"required" => false
		),
		"como_se_entero"=> array(
			"label" => "¿Cómo se entero de nosotros?",
			"required" => false
		),
		"intereses"=> array(
			"label" => "Esta interesado en",
			"required" => false
		),
		"num_usuarios"=> array(
			"label" => "¿Cúantos usuarios tendría?",
			"required" => true
		),
		"otra_pregunta"=> array(
			"label" => "¿Alguna otra pregunta?",
			"required" => false
		)
	);
	
	function validaCamposNoVacios($campos, $post){
		$errores = "";
		
		foreach($campos as $key=>$value):
			if(isset($value['required']) and $value['required'] == true and isset($value['tipo']) and $value['tipo']!="file"):
				if($post[$key] == ""):
					$errores .= "<p>El campo '{$value[label]}' esta vacío. Por favor llena este campo para poder enviar tu mensaje.</p>";
				endif;
			endif;
		endforeach;

		$result = ($errores == "")?true:false;
			
		return array("result" => $result, "errores" => $errores);
	}
	
	if($_SESSION['tmptxt'] == $_POST['tmptxt']):
		if(isset($_POST['enviar']) and $_POST['enviar']!=""):
			
			include("../scripts/funciones.php");
			include("../my-admin/config.php");
			include("../scripts/class.phpmailer.php");
			
			$validaCampos = validaCamposNoVacios($campos, $_POST);
			
			if($validaCampos['result']):
				
				$nom_sitio = "lared.com";
				$referer = $_SERVER['HTTP_REFERER'];

				$mail = new PHPMailer();
				$mail->IsMail();
				$mail->Port = 26;
				$mail->IsHTML(true);
				$mail->From = "contacto@$nom_sitio";
				$mail->FromName = "Sistema de Contacto de $nom_sitio";
				$mail->Subject  = "Mensaje de Contacto de $nom_sitio";
				$mail->WordWrap = 50;
				
				$mensaje = "";

				$mensaje .= "<html>
								<head>
									<title>Mensaje del Sistema de Contacto de $referer</title>
								</head>
								<body>
									<p>Este es un mensaje de contacto de la p&aacute;gina web $referer<br/></p>";
				
				$values = array();

				foreach($campos as $key=>$value):
					$mensaje .= "<p>{$value['label']}: ";
					
					if(isset($value['tipo']) and $value['tipo']=="file"):
					
						if($_FILES[$key]['name'][0]!=""):
							$prefix = uniqid('doc', true);
							$result = subirArchivo($key, "../".$directorioArchivos, $prefix, 0);
							if($result):
								$values[] = $baseUrl.$directorioArchivos.$prefix.quitarAcentosArchivos($_FILES[$key]['name'][0]);
							else:
								$values[] = "";
							endif;
						endif;
					else:
						if(isset($_POST[$key]) and is_array($_POST[$key])):
							foreach($_POST[$key] as $item):
								$mensaje .= $item . "<br>";
							endforeach;

							$values[] = implode(",", $_POST[$key]);
						else:
							
							$mensaje .= isset($_POST[$key])?$_POST[$key]:"";
							$values[] = isset($_POST[$key])?$_POST[$key]:"";
						endif;
					endif;
					
					$mensaje .= "</p>";
					
				endforeach;

				$mensaje .="
								</body>
							</html>";

				$mail->Body = utf8_decode($mensaje);

				$correos = explode(",", $mailContacto);
				$num_correos = count($correos);
				
				for($i=0; $i<$num_correos; $i++):
					$mail->AddAddress(trim($correos[$i]));
					if($mail->Send()):
						$mensaje = "El mensaje fue enviado con &eacute;xito.";
						$clase = "exito";
					else:
						$mensaje = "Ocurrio un error y el mensaje no fue enviado, por favor intenta m&aacute;s tarde. Disculpa las molestias.";
						$clase = "alerta";
					endif;
					
					$mail->ClearAddresses();
				endfor;
			else:
				$mensaje = $validaCampos['errores'];
				$clase = "alerta";
			endif;
		endif;
	else:
		$mensaje = "Tu mensaje fue catalogado como spam";
		$clase = "alerta";
	endif;
	
	$respuesta = array("resultado"=>"true", "mensaje"=>$mensaje, "clase"=>$clase);
	
	if(isset($_POST['metodo']) and $_POST['metodo']=="ajax"):
		echo json_encode($respuesta);
	else:
		$_SESSION['resultadoContacto'] = $respuesta;
		$url = $_SERVER['HTTP_REFERER'];?>
		<meta http-equiv="refresh" content="0;url=<?php echo $url?>">
<?php
	endif;?>
