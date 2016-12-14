<?php
	$mes = date('m');
	$dd = date('d');
	$aa = date('Y');
	$opciones = array();
	$resumen_esp = '';
	$contenido_esp = '';
	$resumen_eng = '';
	$contenido_eng = '';

	$templates = array(
		"template-default" => "Default",
		"template-page" => "Pagina"
	);

	if($accion=="Editar"):
		$hid = mysql_real_escape_string($_GET['hid']);

		$query_edit = "SELECT cc.idCat id, cc.titulo_esp, cc.resumen_esp, cc.contenido_esp, cc.titulo_eng, cc.resumen_eng, cc.contenido_eng, cc.idCatPadre, cc.estatus, orden, mostrarEn, opciones, DAY(cc.fechaPublicacion) dd, MONTH(cc.fechaPublicacion) mm, YEAR(cc.fechaPublicacion) aa FROM ctlg_categorias cc WHERE idCat='{$hid}' LIMIT 0,1";
		$result_edit = mysql_query($query_edit);

		if($result_edit and mysql_num_rows($result_edit)==1):
			$row_edit = mysql_fetch_array($result_edit);

			$nid = $row_edit['id'];
			$mes = $row_edit['mm'];
			$dd = $row_edit['dd'];
			$aa = $row_edit['aa'];
			$opciones = unserialize($row_edit['opciones']);
			$resumen_esp = htmlspecialchars(stripslashes($row_edit["resumen_esp"]));
			$contenido_esp = htmlspecialchars(stripslashes($row_edit["contenido_esp"]));
			$resumen_eng = htmlspecialchars(stripslashes($row_edit["resumen_eng"]));
			$contenido_eng = htmlspecialchars(stripslashes($row_edit["contenido_eng"]));
		endif;
	endif;
?>		

<div class="formulario">
	<h2><a id="toggleForm" href="#toggleForm"><?php echo $accion?> Secci&oacute;n</a></h2>    

	<div id="form_addup" class="hide">
		<form action="procesos/proc-categorias.php" enctype="multipart/form-data" method="post">
			<?php startPost(); ?>

			<input type="hidden" name="id" value="<?php echo $row_edit['id']?>" />
			<input type="hidden" name="url_ref" value="<?php echo $_SERVER['HTTP_REFERER']?>" />
			<input type="hidden" name="tipo" value="<?php echo $tipo?>" />

			<div class="info-col">
				<div class="info-col-cont mR300">

					<fieldset>
						<legend>Espa&ntilde;ol</legend>
						<p><label>T&iacute;tulo<br>
						<input class="titulo" type="text" name="titulo_esp" value="<?php echo $row_edit['titulo_esp']?>"></label></p>

						<p><label>Contenido</label></p>
						<p><textarea class="jquery_ckeditor" name="contenido_esp" cols="" rows=""><?php echo $contenido_esp?></textarea></p>
						
						<p><label>Abstract</label></p>
						<p><textarea name="resumen_esp" cols="" rows=""><?php echo $resumen_esp?></textarea></p>
					</fieldset>
					
					<fieldset>
						<legend>Ingl&eacute;s</legend>
						<p><label>T&iacute;tulo<br>
						<input class="titulo" type="text" name="titulo_eng" value="<?php echo $row_edit['titulo_eng']?>"></label></p>
						
						<p><label>Contenido</label></p>
						<p><textarea class="jquery_ckeditor" name="contenido_eng" cols="" rows=""><?php echo $contenido_eng?></textarea></p>
						
						<p><label>Abstract</label></p>
						<p><textarea name="resumen_eng" cols="" rows=""><?php echo $resumen_eng?></textarea></p>
					</fieldset>

					<?php include("widgets/bloques-custom.php");?>

                </div><!--.info-col-cont-->

            </div><!--.info-col-->

            <div class="post-entry">
				<div class="info-box">

					<?php include("widgets/metatags.php")?>

                    <h3>Opciones</h3>                  

                    <div class="seccion">
						<p><label><strong>Secci&oacute;n padre:</strong></label></p>
						<select name="idCatPadre">
							<?php getCats($row_edit['idCatPadre'], "'sitio', 'section', '$tipo', 'menu'",  array('sitio'))?>
						</select>
					</div><!--.seccion-->

					<?php
						if(isset($templates) and count($templates)):?>
							<div class="seccion">
								<p><label><strong>Template:</strong></label></p>
								<select name="opciones[configuracion][template]">
									<?php
										foreach($templates as $key=>$value):
											$selected = ($opciones['configuracion']['template'] == $key)?"selected":"";?>
											<option value="<?php echo $key?>" <?php echo $selected;?>><?php echo $value?></option>
									<?php
										endforeach;?>
								</select>
							</div><!--.seccion-->
					<?php
						endif;?>

					<?php
						$tituloWidgetImagen = "Imagen Destacada:";
						$tipoWidgetImagen = "featSeccion";
						$nomInputWidgetImagen = "featureSeccion";
						include("widgets/imagen.php");
					?>

					<?php
						$tituloWidgetImagen = "Imagen Preview:";
						$tipoWidgetImagen = "previewSeccion";
						$nomInputWidgetImagen = "previewSeccion";
						include("widgets/imagen.php");
					?>

					<?php include("widgets/orden.php")?>
					<?php
						$tituloSlideshow = "Slideshow (Esp)";
						$idiomaSlideshow = "esp";
						include("widgets/sliders.php")
					?>
					<?php
						$tituloSlideshow = "Slideshow (Eng)";
						$idiomaSlideshow = "eng";
						include("widgets/sliders.php")
					?>
					<?php include("widgets/fecha-publicacion.php")?>
					<?php include("widgets/publicacion.php")?>
                    <?php include("widgets/btn-publicacion.php")?>
                </div><!--.info-box-->
            </div><!--.post-entry-->
            <div class="clearfix"></div>
        </form>
    </div><!--#form_addup-->
</div><!--.formulario-->

<?php
	$estadoForm = ($accion=="Editar")?"muestraForm();":"escondeForm();";
	$scriptFooter = "
		<script src=\"js/ckeditor/ckeditor.js\"></script>
		<script src=\"js/ckeditor/adapters/jquery.js\"></script>
		<script src=\"js/ckfinder/ckfinder.js\"></script>
		<script>$(function(){ $estadoForm });</script>";
?>
