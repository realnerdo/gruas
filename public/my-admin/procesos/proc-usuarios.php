<?php
	if(!isset($_SESSION['user']) || $_SESSION['user']['acceso'] != 'cpanel'):
	include("../conexion.php");
			if($result and mysql_num_rows($result)==0):
				$query = "INSERT INTO ctlg_usuarios(login, nombre, apellido, email, nomArchivo, fecha, comentarios, rol, telefono, ciudad, estado, pais, direccion, password) VALUES('{$login}', '{$nombre}', '{$apellido}', '{$email}', '{$nomArchivo}', '{$fecha}', '{$comentarios}', '{$rol}','{$telefono}', '{$ciudad}', '{$estado}', '{$pais}', '{$direccion}', '{$password}')";
				$result = mysql_query($query);
				if($result):
			else:
	/*edit*/
		if($result):