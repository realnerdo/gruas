<?php
	session_start();

	include("../scripts/funciones.php");

	if(isset($_POST['enviar']) and $_POST['enviar'] != ""):
		if($_POST['opciones'] != '' and ($_POST['comment'])!='' and esEmail($_POST['opciones']['correo']) and !esSpam($_POST['comment'])):
		
			require("../my-admin/conexion.php");

			$nombre =  $_POST['opciones']["UserName"];
			$contenido = $_POST['comment'];
			$fecha = date("Y-m-d H:i:s", time());
			$idEntrada = $_POST['opciones']["IdNoticia"];
			$tipo = 'comentario-blog';
			$website = $_POST['opciones']["sitio"];

			$queryAdd = "INSERT INTO ctlg_comentarios(nombre, contenido, fechaCreacion, idEntrada, tipo, website) VALUES('{$nombre}', '{$contenido}', '{$fecha}', '{$idEntrada}', '{$tipo}', '{$website}')";
			$resultAdd = mysql_query($queryAdd);

			if ($resultAdd):
				$mensaje = 'La informaci&oacute;n se guardo con exito';
				$clase = 'exito';
			else:
				$mensaje = "La informaci&oacute;n no se pudo guardar";
				$clase = 'error';
			endif;

		else:
			$mensaje = "Uno o m&aacute;s campos parecen estar vacios";
			$clase = "alerta";
		endif;

		$response = array("resultado" => "true", "mensaje" => $mensaje, "clase" => $clase);

		if(isset($_POST['metodo']) and $_POST['metodo'] == "ajax"):
			echo json_encode($response);
		else:
			$_SESSION['resultado'] = $response;
			$url = $_SERVER['HTTP_REFERER'];?>
			<meta http-equiv="refresh" content="0;url=<?php echo $url?>">
	<?php
		endif;
	endif;
?>