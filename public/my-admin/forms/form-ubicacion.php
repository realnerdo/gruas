<?php
	if($accion=="Editar"):
		$hid = mysql_real_escape_string($_GET['hid']);
		$query_edit = "SELECT ce.idEntrada id, ce.titulo_esp, ce.resumen_esp, ce.contenido_esp, ce.titulo_eng, ce.resumen_eng, ce.contenido_eng, DAY(ce.fechaPublicacion) dd, MONTH(ce.fechaPublicacion) mm, YEAR(ce.fechaPublicacion) aa, ce.estatus, ce.orden, ce.opciones FROM ctlg_entradas ce WHERE ce.idEntrada='{$hid}' LIMIT 0,1";
		if($result_edit and mysql_num_rows($result_edit)==1):
			$nid = $row_edit['id'];
		endif;
<div class="formulario">
    <div id="form_addup" class="hide">
						<p><label>Contenido</label></p>