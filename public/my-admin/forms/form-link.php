<?php
	if($accion=="Editar"):
		$hid = mysql_real_escape_string($_GET['hid']);
		$query_edit = "SELECT ce.idEntrada id, ce.titulo_esp, ce.titulo_eng, ce.slug, ce.tipo, ce.opciones, ce.orden, DAY(ce.fechaPublicacion) dd, MONTH(ce.fechaPublicacion) mm, YEAR(ce.fechaPublicacion) aa, ce.estatus, ce.mostrarEn, ce.keywords FROM ctlg_entradas ce WHERE ce.idEntrada='$hid' LIMIT 0,1";
		if($result_edit and mysql_num_rows($result_edit)==1):
<div class="formulario">
		<form action="procesos/proc-contenido.php" enctype="multipart/form-data" method="post">
			<?php startPost(); ?>
            <input type="hidden" name="id" value="<?php echo $row_edit['id']?>" />
			<div class="info-col">
					<p><label>URL:<br>
					<?php
<?php