<section id="servicios" class="section">
    <h1 class="section-title animate"><img src="<?php echo get_template_directory_uri() ?>/img/fast-yellow.png" class="icon"><?php the_field('servicios_titulo') ?></h1>
    <!-- /.section-title -->
    <div class="wrapper">
        <div class="row">
            <?php if( have_rows('servicios') ): ?>
                <?php while ( have_rows('servicios') ) : the_row(); ?>
                    <div class="col-3">
                        <div class="service animate">
                            <div class="cover"><img src="<?php the_sub_field('servicio_foto') ?>" alt="" class="img"></div>
                            <!-- /.cover -->
                            <h3 class="title"><?php the_sub_field('servicio_titulo') ?></h3>
                            <!-- /.title -->
                            <div class="content">
                                <?php the_sub_field('servicio_texto') ?>
                            </div>
                            <!-- /.content -->
                        </div>
                        <!-- /.service -->
                    </div>
                    <!-- /.col-3 -->
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.wrapper -->
</section>
<!-- /#servicios.section -->
