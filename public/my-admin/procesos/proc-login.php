<?php
	$gump = new GUMP();
	$_GET = $gump->sanitize($_GET);
	if(!empty($_POST['btn_acceder'])):
				$login = str_replace("'", "", str_replace(" ", "", $_POST['login']));
				$query = "SELECT idUser, login, nombre, apellido, empresa, email, nomArchivo, fecha, telefono, ciudad, estado, pais, rol FROM ctlg_usuarios WHERE login='{$login}' AND password='{$pass_sha1}' AND rol <= 2 LIMIT 0,1";
				if($result and mysql_num_rows($result)==1):