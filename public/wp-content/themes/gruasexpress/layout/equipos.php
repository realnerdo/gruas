<section id="equipos" class="section">
    <h3 class="section-title"><img src="<?php echo get_template_directory_uri() ?>/img/fast.png" class="icon"><?php the_field('equipos_titulo'); ?></h2>
    <!-- /.section-title -->
    <h2 class="section-subtitle"><?php the_field('equipos_subtitulo'); ?></h3>
    <!-- /.subtitle -->
    <div class="wrapper">
        <div class="row">
            <div class="col-12">
                <section id="equipos-slider" class="glide">
                    <!-- <div class="glide__arrows">
                        <button class="glide__arrow prev" data-glide-dir="<">Anterior</button>
                        <button class="glide__arrow next" data-glide-dir=">">Siguiente</button>
                    </div> -->

                    <div class="glide__wrapper">
                        <ul class="glide__track">
                            <?php if( have_rows('equipos_slider') ): ?>
                                <?php while ( have_rows('equipos_slider') ) : the_row(); ?>
                                    <li class="glide__slide">
                                        <img src="<?php the_sub_field('equipo_slider_foto'); ?>" class="img" alt="<?php the_sub_field('equipo_slider_nombre'); ?>">
                                        <div class="content">
                                            <h3 class="headline"><?php the_sub_field('equipo_slider_nombre'); ?></h3>
                                        </div><!-- /content -->
                                    </li>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </ul>
                    </div>

                    <div class="glide__bullets"></div>
                </section>
                <!-- /#equipos-slider.glide -->
            </div>
            <!-- /.col-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.wrapper -->
</section>
<!-- /#equipos.section -->
