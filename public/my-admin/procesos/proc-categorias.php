<?php
	$gump = new GUMP();
	$_GET = $gump->sanitize($_GET);
	/*insert*/
			if($resultAdd):
		escribeBitacora($idUser, "[edit] tabla: ctlg_categorias, id: {$nid}, titulo: {$titulo}, tipo: {$tipo}");
		$_SESSION['resultado'] = array(
		$query_del = "DELETE FROM ctlg_categorias WHERE idCat='{$nid}'";
		if($result_del):
	/*volvemos a la pagina*/