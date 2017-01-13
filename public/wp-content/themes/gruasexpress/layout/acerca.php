<section id="acerca" class="section">
    <h1 class="section-title"><img src="<?php echo get_template_directory_uri() ?>/img/fast.png" class="icon"><?php the_field('acerca_titulo') ?></h1>
    <!-- /.section-title -->
    <div class="wrapper">
        <div class="row">
            <div class="col-12">
                <section class="text">
                    <h3 class="title"><?php the_field('historia_titulo') ?></h3>
                    <!-- /.title -->
                    <div class="content">
                        <?php the_field('historia_texto') ?>
                    </div>
                    <!-- /.content -->
                </section>
                <!-- /.text -->
            </div>
            <!-- /.col-12 -->
            <div class="col-6">
                <section class="text">
                    <h3 class="title"><?php the_field('mision_titulo') ?></h3>
                    <!-- /.title -->
                    <div class="content">
                        <?php the_field('mision_texto') ?>
                    </div>
                    <!-- /.content -->
                </section>
                <!-- /.text -->
            </div>
            <!-- /.col-6 -->
            <div class="col-6">
                <section class="text">
                    <h3 class="title"><?php the_field('vision_titulo') ?></h3>
                    <!-- /.title -->
                    <div class="content">
                        <?php the_field('vision_texto') ?>
                    </div>
                    <!-- /.content -->
                </section>
                <!-- /.text -->
            </div>
            <!-- /.col-6 -->
            <div class="row">
                <div class="col-12">
                    <section class="text">
                        <h3 class="title"><?php the_field('valores_titulo') ?></h3>
                        <!-- /.title -->
                        <div class="row">
                            <div class="col-12">
                                <ul class="list">
                                    <?php if( have_rows('valores') ): ?>
                                        <?php while ( have_rows('valores') ) : the_row(); ?>
                                            <li class="item"><?php the_sub_field('valor') ?></li>
                                            <!-- /.item -->
                                        <?php endwhile; ?>
                                    <?php endif; ?>
                                </ul>
                                <!-- /.list -->
                            </div>
                            <!-- /.col-12 -->
                        </div>
                        <!-- /.row -->
                        <!-- /.content -->
                    </section>
                    <!-- /.text -->
                </div>
                <!-- /.col-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.wrapper -->
</section>
<!-- /#acerca.section -->
