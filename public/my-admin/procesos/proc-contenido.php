<?php
	$gump = new GUMP();
	$_GET = $gump->sanitize($_GET);
	/*insert*/
			$queryAdd = "INSERT INTO ctlg_entradas(idUser, titulo_esp, contenido_esp, resumen_esp, titulo_eng, contenido_eng, resumen_eng, slug, tipo, opciones, orden, fechaPublicacion, fechaModificacion, fechaFinal, estatus, mostrarEn, keywords) VALUES('{$idUser}', '{$titulo_esp}', '{$contenido_esp}', '{$resumen_esp}', '{$titulo_eng}', '{$contenido_eng}', '{$resumen_eng}', '{$slug}', '{$tipo}', '{$opciones}', '{$orden}', '{$fechaPublicacion}', NOW(), '{$fechaFinal}', '{$estatus}', '{$mostrarEn}', '{$keywords}')";
			$queryEdit = "UPDATE ctlg_entradas SET titulo_esp='{$titulo_esp}', contenido_esp='{$contenido_esp}', resumen_esp='{$resumen_esp}', titulo_eng='{$titulo_eng}', contenido_eng='{$contenido_eng}', resumen_eng='{$resumen_eng}', slug='{$slug}', tipo='{$tipo}', opciones='{$opciones}', orden='{$orden}', fechaPublicacion='{$fechaPublicacion}', fechaModificacion=NOW(), fechaFinal='{$fechaFinal}', estatus='{$estatus}', mostrarEn='{$mostrarEn}', keywords='{$keywords}' WHERE idEntrada='{$nid}'";
				$nameInput = 'nomArchivoGaleria';
		$queryDel = "DELETE FROM ctlg_entradas WHERE idEntrada='{$nid}'";
		else: