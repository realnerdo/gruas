<?php	$mes = date('m');	$dd = date('d');	$aa = date('Y');	$contenido = '';	$opciones = array();	$contenido_esp = '';	$contenido_eng = '';	
	if($accion=="Editar"):
		$hid = mysql_real_escape_string($_GET['hid']);
		$query_edit = "SELECT ce.idEntrada id, ce.titulo_esp, ce.resumen_esp, ce.contenido_esp, ce.titulo_eng, ce.resumen_eng, ce.contenido_eng, DAY(ce.fechaPublicacion) dd, MONTH(ce.fechaPublicacion) mm, YEAR(ce.fechaPublicacion) aa, ce.estatus, ce.orden, ce.opciones FROM ctlg_entradas ce WHERE ce.idEntrada='{$hid}' LIMIT 0,1";		$result_edit = mysql_query($query_edit);
		if($result_edit and mysql_num_rows($result_edit)==1):			$row_edit = mysql_fetch_array($result_edit);
			$nid = $row_edit['id'];			$mes = $row_edit['mm'];			$dd = $row_edit['dd'];			$aa = $row_edit['aa'];			$opciones = unserialize($row_edit['opciones']);			$contenido_esp = htmlspecialchars(stripslashes($row_edit["contenido_esp"]));			$contenido_eng = htmlspecialchars(stripslashes($row_edit["contenido_eng"]));
		endif;	endif;?>
<div class="formulario">	<h2><a id="toggleForm" href="#toggleForm"><?php echo $accion?> <?php echo $tituloAccion?></a></h2>
    <div id="form_addup" class="hide">        <form id="form-entradas" action="procesos/proc-contenido.php" method="post" enctype="multipart/form-data">            <?php startPost(); ?>            <input type="hidden" name="id" value="<?php echo $row_edit['id']?>" />            <input type="hidden" name="url_ref" value="<?php echo $_SERVER['HTTP_REFERER']?>" />            <input type="hidden" name="tipo" value="<?php echo $tipo?>">			<input type="hidden" name="opciones[coordenadas]" value="<?php echo $opciones['coordenadas'];?>" id="coordenadas">            <div class="info-col">                <div id="" class="info-col-cont mR300">					<fieldset>						<legend>Espa&ntilde;ol</legend>						<p><label>T&iacute;tulo<br>						<input class="titulo" type="text" name="titulo_esp" value="<?php echo $row_edit['titulo_esp']?>"></label></p>
						<p><label>Contenido</label></p>						<p><textarea class="jquery_ckeditor" name="contenido_esp" cols="" rows=""><?php echo $contenido_esp?></textarea></p>					</fieldset>										<fieldset>						<legend>Ingl&eacute;s</legend>						<p><label>T&iacute;tulo<br>						<input class="titulo" type="text" name="titulo_eng" value="<?php echo $row_edit['titulo_eng']?>"></label></p>												<p><label>Contenido</label></p>						<p><textarea class="jquery_ckeditor" name="contenido_eng" cols="" rows=""><?php echo $contenido_eng?></textarea></p>					</fieldset>					<p><label>Ubicaci&oacute;n</label></p>					<div id="googleMap" class="googleMap"></div><!--#googleMap-->					                </div><!--#info-col-cont-->            </div><!--#info-col-->            <div class="post-entry">                <div class="info-box">                    <h3>Opciones</h3>                    <?php include("widgets/orden.php")?>					<?php include("widgets/fecha-publicacion.php")?>					<?php include("widgets/publicacion.php")?>                    <?php include("widgets/btn-publicacion.php")?>				</div><!--fin .info-box-->            </div><!--fin #post-entry-->            <div class="clearfix"></div>        </form>    </div><!--fin form_addup--></div><!--fin formulario--><?php	$estadoForm = ($accion=="Editar")?"muestraForm();":"escondeForm();";	$scriptFooter = "		<script src=\"//maps.google.com/maps/api/js\"></script>		<script src=\"js/ckeditor/ckeditor.js\"></script>		<script src=\"js/ckeditor/adapters/jquery.js\"></script>		<script src=\"js/ckfinder/ckfinder.js\"></script>		<script>$(function(){ $estadoForm });</script>";?>