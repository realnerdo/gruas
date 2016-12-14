<?php
	session_start();

	if(!empty($_POST['enviar'])):
		include("../scripts/funciones.php");
		include("../my-admin/config.php");
		include("../scripts/class.phpmailer.php");
		
		//if($_SESSION['tmptxt'] == $_POST['tmptxt']):
			if($_POST['nombre']!='' and $_POST['email']!='' and esEmail($_POST['email']) and !esSpam($_POST['comentario'])):

				$nom_sitio = "solarzone.com";
				$nombre = $_POST['nombre'];
				$telefono = $_POST['telefono'];
				$celular = $_POST['celular'];
				$email = $_POST['email'];
				$comentario =  $_POST['comentario'];
				$referer = $_SERVER['HTTP_REFERER'];

				$mail = new PHPMailer();
				$mail->IsMail();
				$mail->Port = 26;
				$mail->IsHTML(true);
				$mail->From = "contacto@$nom_sitio";
				$mail->FromName = "Sistema de Contacto de $nom_sitio";
				$mail->Subject  = "Mensaje de Contacto de $nom_sitio";
				$mail->WordWrap = 50;

				$mensaje = "<html>
								<head>
									<title>Mensaje del Sistema de Contacto de $referer</title>
								</head>
								<body>
									<p>Este es un mensaje de contacto de la p&aacute;gina web $referer<br/></p>
									<p><strong>Nombre:</strong> $nombre</p>
									<p><strong>Tel&eacute;fono:</strong> $telefono</p>
									<p><strong>Celular:</strong> $celular</p>
									<p><strong>E-mail:</strong> $email</p>
									<p><strong>Mensaje:</strong> $comentario</p>
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
				$mensaje = "Uno &oacute; m&aacute;s campos obligatorios estan vacios, por favor llena estos campos para poder enviar tu mensaje.";
				$clase = "alerta";
			endif;
		// else:
			// $mensaje = "Tu mensaje fue catalogado como spam";
			// $clase = "alerta";
		// endif;

		$respuesta = array("resultado"=>"true", "mensaje"=>$mensaje, "clase"=>$clase);

		if(isset($_POST['metodo']) and $_POST['metodo']=="ajax"):
			echo json_encode($respuesta);
		else:
			$_SESSION['resultadoContacto'] = $respuesta;
			$url = $_SERVER['HTTP_REFERER'];?>
			<meta http-equiv="refresh" content="0;url=<?php echo $url?>">
	<?php
		endif;
	endif;
?>
