<section id="aseguradoras" class="section">
    <h2 class="section-title"><img src="<?php echo get_template_directory_uri() ?>/img/fast.png" class="icon"><?php the_field('aseguradoras_titulo') ?></h2>
    <!-- /.section-title -->
    <h3 class="section-subtitle"><?php the_field('aseguradoras_subtitulo') ?></h3>
    <!-- /.subtitle -->
    <div class="wrapper">
        <div class="row">
          <marquee class="marquee" behavior="" direction="">
            <?php if( have_rows('aseguradoras') ): ?>
                <?php while ( have_rows('aseguradoras') ) : the_row(); ?>
                    <img src="<?php the_sub_field('aseguradora_logo') ?>" alt="<?php the_sub_field('aseguradora_nombre') ?>" class="img">
                <?php endwhile; ?>
            <?php endif; ?>
          </marquee>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.wrapper -->
</section>
<!-- /#aseguradoras.secion -->
