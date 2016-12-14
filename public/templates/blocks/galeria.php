<?php $galeria = getFeaturesImage($thisId, "galeriaPage");?>

<?php
	if(count($galeria)):?>
		<div class="block-container gallery-container">
			<div class="container">
				<div class="col-md-12">
					<h2 class="title text-center">Galer&iacute;a</h2>
					
					<div class="gallery row">
						<?php
							foreach($galeria as $item):?>
								<div class="col-md-4">
									<a href="archivos/imagenes/<?php echo $item['nomArchivo']?>" class="fancybox" rel="gallery">
										<div class="preview-work">
											<figure>
												<img src="archivos/imagenes/thumbs/<?php echo $item['nomArchivo']?>" alt="">
											</figure>

											<div class="preview-overlay">
												<div class="content table">
													<div class="row">
														<h2><?php echo $item['titulo']?></h2>
													</div><!--.row-->
												</div><!--.table-->
											</div><!--.preview-overlay-->
										</div><!--.preview-->
									</a>
								</div>
					<?php
							endforeach;?>
					</div><!--.gallery-->
				</div>
			</div><!--.container-fluid-->
		</div><!--.gallery-container-->
<?php
	endif;?>
