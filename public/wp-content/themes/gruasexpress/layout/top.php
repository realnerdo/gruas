<header id="header">
    <div class="wrapper">
        <div class="row">
            <div class="col-3">
                <div id="logo">
                    <a href="<?php echo home_url(); ?>" class="link">
                        <img src="<?php the_field('logo') ?>" alt="<?php bloginfo('name'); ?>" class="img">
                    </a>
                </div>
                <!-- /#logo -->
            </div>
            <!-- /.col-3 -->
            <div class="col-9">
                <nav id="main-menu" class="responsive">
                    <?php wp_nav_menu(['theme_location' => 'primary']); ?>
                </nav>
                <!-- /#main-menu.responsive -->
                <button class="toggle-menu"><img src="<?php echo get_template_directory_uri() ?>/img/menu.png" alt="Menu" class="icon"></button>
            </div>
            <!-- /.col-9 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.wrapper -->
</header>
<!-- /#header -->
