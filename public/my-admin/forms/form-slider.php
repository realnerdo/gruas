<?php
	if($accion=="Editar"):
		$hid = mysql_real_escape_string($_GET['hid']);
		$query_edit = "SELECT cs.idSlider id, cs.titulo, cs.estatus, DAY(cs.fechaPublicacion) dd, MONTH(cs.fechaPublicacion) mm, YEAR(cs.fechaPublicacion) aa, opciones FROM ctlg_sliders cs WHERE cs.idSlider='{$hid}' LIMIT 0,1";
		if($result_edit and mysql_num_rows($result_edit)==1):
		endif;
<div class="formulario">
    <div id="form_addup" class="hide">
			<input type="hidden" name="url_ref" value="<?php echo $_SERVER['HTTP_REFERER']?>" />
            <div class="info-col">
					<div id="cont_imagenes">
											<p><a class="delFile" href="procesos/proc-delete-archivo.php?hid=<?php echo $nid_imagen?>&haccion=eliminar&tipo=image">[Eliminar]</a></p>
							<?php
								<p><label>Imagen: <input id="nomArchivo" name="imageSlide[]" type="file" /></label></p>
								<p><label>Introducci&oacute;n<br>
								<p><label>Posicion: <span class="descripcion">[ ejemplo.: http://www.google.com/]</span>
					<div class="cont-btn-pub">
            <div class="post-entry">