<section id="aseguradoras" class="section">
    <h2 class="section-title"><img src="<?php echo get_template_directory_uri() ?>/img/fast.png" class="icon"><?php the_field('aseguradoras_titulo') ?></h2>
    <!-- /.section-title -->
    <h3 class="section-subtitle"><?php the_field('aseguradoras_subtitulo') ?></h3>
    <!-- /.subtitle -->
    <div class="wrapper">
        <div class="row">
          <div class="glide">
            <div class="glide__wrapper">
              <ul class="glide__track">
                  <?php if( have_rows('aseguradoras') ): ?>
                      <?php while ( have_rows('aseguradoras') ) : the_row(); ?>
                          <li class="glide__slide">
                            <img src="<?php the_sub_field('aseguradora_logo') ?>" alt="<?php the_sub_field('aseguradora_nombre') ?>" class="img">
                          </li>
                          <!-- /.glide__slide -->
                      <?php endwhile; ?>
                  <?php endif; ?>
              </ul>
              <!-- /.glide__track -->
            </div><!-- /.glide__wrapper -->
          </div><!-- /.glide -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.wrapper -->
</section>
<!-- /#aseguradoras.secion -->
