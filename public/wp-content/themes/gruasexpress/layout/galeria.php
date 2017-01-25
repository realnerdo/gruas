<section id="galeria" class="section">
	<h2 class="section-title animate"><img src="<?php echo get_template_directory_uri() ?>/img/fast.png" class="icon"><?php the_field('galeria_titulo'); ?></h2>
	<!-- /.section-title -->
	<div class="wrapper">
		<div class="row">
			<div class="col-12">
				<section id="lightgallery">
				    <?php $images = get_field('galeria_fotos') ?>
				    <?php foreach ($images as $image): ?>
				        <a href="<?php echo $image['sizes']['large'] ?>" class="link" style="background: url(<?php echo $image['sizes']['large'] ?>); background-size: cover;">
				            <img src="<?php echo $image['sizes']['large'] ?>" class="img">
				        </a>
				    <?php endforeach; ?>
				</section><!-- #lightgallery -->
			</div><!-- /.col-12 -->
		</div><!-- /.row -->
	</div><!-- /.wrapper -->
</section><!-- /#galeria.section -->