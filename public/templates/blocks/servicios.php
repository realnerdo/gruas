<?php
	$cells = array();
	$query = "SELECT cc.idCat id, cc.slug, cc.titulo, cc.contenido, (SELECT CONCAT(ci.idImagen, '_image_', ci.nomArchivo) FROM ctlg_imagenes ci WHERE ci.tipo='previewSeccion' AND ci.idEntrada=cc.idCat) nomArchivo FROM ctlg_categorias cc WHERE cc.tipo='section-productos' AND cc.estatus='1' AND cc.fechaPublicacion<=NOW() ORDER BY orden";
	$result = mysql_query($query);
	if($result):?>
		<div class="static-block-container">
		<?php
			$i = 0;
			while($row = mysql_fetch_array($result)):
				$class = ($i%2 == 0)?"left-block":"right-block"; ?>

				<div class="cell <?php echo $class?>">
					<a href="<?php echo $row['slug']?>">
						<div class="content">
							<?php
								if($row['nomArchivo']!=""):?>
									<figure>
										<image src="archivos/imagenes/thumbs/<?php echo $row['nomArchivo']?>" alt="">
									</figure>
							<?php
								endif;?>
							<h2 class="text-center"><?php echo $row['titulo']?></h2>
							<?php echo $row['contenido']?>
							<div class="clearfix"></div>
						</div><!--.content-->
					</a>
				</div><!--.cell-->

		<?php
				$i++;
			endwhile;?>
			<div class="clearfix"></div>
		</div><!--.static-block-container-->
<?php
	endif;
?>
