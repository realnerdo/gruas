<?php
		$hid = mysql_real_escape_string($_GET['hid']);
		$query_edit = "SELECT ce.idEntrada id, ce.titulo_esp, ce.resumen_esp, ce.contenido_esp, ce.titulo_eng, ce.resumen_eng, ce.contenido_eng, ce.slug, ce.tipo, ce.opciones, ce.orden, DAY(ce.fechaPublicacion) dd, MONTH(ce.fechaPublicacion) mm, YEAR(ce.fechaPublicacion) aa, ce.estatus, ce.mostrarEn, ce.keywords FROM ctlg_entradas ce WHERE ce.idEntrada='$hid' LIMIT 0,1";
		if($result_edit and mysql_num_rows($result_edit)==1):
<div class="formulario">
    <h2><a id="toggleForm" href="#toggleForm"><?php echo $accion?> <?php echo $tituloAccion?></a></h2>  
    <div id="form_addup" class="hide">
			<div class="post-entry">
                    <div class="seccion">
                </div><!--.info-box-->