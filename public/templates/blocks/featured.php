<?php
	$customControl = array();

	if(isset($showFeatured) and $showFeatured):
		$query = "SELECT idImagen id, nomArchivo, titulo, contenido, url, pie_{$idioma} pie FROM ctlg_imagenes WHERE idEntrada='{$showFeatured}' AND tipo='imageSlide'";
		$result = mysql_query($query);
		if($result and mysql_num_rows($result)):?>
			<div id="main-featured" class="featured">
				<div class="flexslider">
					<ul class="slides">
						<?php
							while($slide = mysql_fetch_array($result)):
								$customControl[] = $slide;?>
								<li>
									<figure class="flex-figure">
										<?php
											if($slide['url']!=""):?>
												<a href="<?php echo $slide['url']?>">
										<?php
											endif;?>
										
										<img src="archivos/imagenes/<?php echo $slide['id']?>_image_<?php echo $slide['nomArchivo']?>">

										<?php
											if($slide['url']!=""):?>
												</a>
											<?php
											endif;?>
									</figure>
								</li>
						<?php
							endwhile;?>
					</ul>
					<div class="clearfix"></div>
				</div><!--.flexslider-->
				
				<div id="customControl">
					<ul>
						<?php
							foreach($customControl as $control):?>
								<li>
									<div class="selector"></div>
								</li>
						<?php
							endforeach;?>
					</ul>
				</div>
			</div><!--.featured-->
	<?php
		endif;
	endif;
?>
