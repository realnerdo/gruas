<?php	session_start();
	if(!isset($_SESSION['user']) || $_SESSION['user']['acceso']!='cpanel'):		header("Location:../");		exit();	endif;	include("../scripts/funciones.php");	$url_ref = $_SERVER['HTTP_REFERER'];	if(!empty($_POST["saveChanges"]) && postBlock($_POST['postID'])):
		$fp = fopen("../config.php", "w");
		if($fp):			unset($_POST['postID']);			unset($_POST['saveChanges']);			$string = '<?php'."\n";			foreach( $_POST as $name => $value ):				$string .= "\t$".$name. "='" .$value ."';\n";			endforeach;			$string .= '?>';			$write = fputs($fp, $string);			fclose($fp);			$mensaje = 'La informaci&oacute;n se actualizo con exito.';			$clase = 'exito';		else:			$mensaje = 'La informaci&oacute;n no se pudo actualizar.';			$clase = 'error';		endif;		$_SESSION['resultado'] = array(			"mensaje"=>$mensaje,			"clase"=>$clase		);	endif;
	/*volvemos a la pagina*/	header("location:$url_ref");?>