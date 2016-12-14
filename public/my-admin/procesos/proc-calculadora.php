<?php
	session_start();

	if(!isset($_SESSION['user']) || $_SESSION['user']['acceso']!='cpanel'):
		header("Location:../");
		exit();
	endif;
	
	include("../scripts/funciones.php");
	
	$url_ref = $_SERVER['HTTP_REFERER'];
	
	if(isset($_POST["saveChanges"]) and $_POST["saveChanges"]!="" and postBlock($_POST['postID'])):
		$fp = fopen("../configCalculadora.php", "w");
		if($fp):
			unset($_POST['postID']);
			unset($_POST['saveChanges']);
			
			$_POST['preciosWatt'] = array_values($_POST['preciosWatt']);

			$string = '<?php ';
			$string .= '$configCalc = \'' . serialize($_POST) . '\';';
			$string .= '?>';

			$write = fputs($fp, $string);
			fclose($fp);

			$mensaje = 'La informaci&oacute;n se actualizo con exito.'; $clase = 'exito';
		else:
			$mensaje = 'La informaci&oacute;n no se pudo actualizar.'; $clase = 'error';
		endif;
		$_SESSION['resultado_accion'] = array("mensaje"=>$mensaje,"clase"=>$clase);
	endif;

	/*volvemos a la pagina*/
	header("location:$url_ref");?>