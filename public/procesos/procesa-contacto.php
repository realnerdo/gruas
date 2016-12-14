<?php

	session_start();

	include("../scripts/funciones.php");



	if(isset($_POST['enviar']) and $_POST['enviar']!=""):

		if(isset($_POST['nombre']) and $_POST['nombre']!='' and isset($_POST['email']) and $_POST['email']!='' and esEmail($_POST['email'])):

			require("../my-admin/config.php");

			require("../scripts/class.phpmailer.php");



			$interesadoEn = $_POST['interesadoEn'];

			$nombre = $_POST['nombre'];

			$email = $_POST['email'];

			$telefono = $_POST['telefono'];

			$nom_sitio = "solarzone.com";

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

								<p><strong>Nombre:</strong> $nombre y esta intresado en $interesadoEn</p>

								<p><strong>E-mail:</strong> $email</p>

								<p><strong>Tel&eacute;fono:</strong> $telefono</p>

							</body>

						</html>";



			$mail->Body = utf8_decode($mensaje);



			$correos = explode(",", $mailContacto);

			$num_correos = count($correos);



			for($i=0;$i<$num_correos;$i++):

				$mail->AddAddress(trim($correos[$i]));

				if($mail->Send()):

					$mensaje = "El mensaje fue enviado con &eacute;xito.";

					$clase = "exito";

				else:

					$mensaje = "Ocurrio un error y el mensaje no fue enviado, por favor intenta m&aacute;s tade. Disculap las molestias.";

					$clase = "error";

				endif;



				$mail->ClearAddresses();

			endfor;

		else:

			$mensaje = "Uno &oacute; m&aacute;s campos obligatorios estan vacios, por favor llena estos campos para poder enviar tu mensaje.";

			$clase = "alerta";

		endif;

	endif;

	

	if(isset($_POST['metodo']) and $_POST['metodo']=="ajax"):

		echo json_encode(array("resultado"=>"true", "mensaje"=>$mensaje, "clase"=>$clase));

	else:

		$_SESSION['resultado'] = array("mensaje"=>$mensaje, "clase"=>$clase);

			$url = $_SERVER['HTTP_REFERER'];?>

			<meta http-equiv="refresh" content="0;url=<?php echo $url?>">

<?php

	endif;?>
