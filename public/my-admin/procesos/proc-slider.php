<?php
	$setupUpload = array(
			$query_add = "INSERT INTO ctlg_sliders(titulo, estatus, fechaPublicacion, opciones, tipo) VALUES('{$titulo}', '{$estatus}', '{$fecha}', '{$opciones}', '{$tipo}')";
			if($result_add):
	/*edit*/
			$query_edit = "UPDATE ctlg_sliders SET titulo='{$titulo}', estatus='{$estatus}', fechaPublicacion='{$fecha}', opciones='{$opciones}' WHERE idSlider='{$nid}'";
	/*delete*/
	/*volvemos a la pagina*/