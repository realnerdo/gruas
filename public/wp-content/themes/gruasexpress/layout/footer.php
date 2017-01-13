<footer id="footer">
    <div class="wrapper">
        <div class="row">
            <div class="col-3">
                <div class="logo">
                    <img src="<?php the_field('logo') ?>" class="img">
                </div>
                <!-- /.logo -->
            </div>
            <!-- /.col-3 -->
            <div class="col-3">
                <h4 class="title">Dirección</h4>
                <!-- /.title -->
                <div class="content"><?php the_field('direccion') ?></div>
                <!-- /.content -->
            </div>
            <!-- /.col-3 -->
            <div class="col-3">
                <h4 class="title">Teléfonos</h4>
                <!-- /.title -->
                <div class="content"><?php the_field('telefono') ?></div>
                <!-- /.content -->
            </div>
            <!-- /.col-3 -->
            <div class="col-3">
                <h4 class="title">Correo electrónico</h4>
                <!-- /.title -->
                <div class="content"><?php the_field('correo') ?></div>
                <!-- /.content -->
            </div>
            <!-- /.col-3 -->
            <div class="col-12">
                <div class="copyright">&copy; 2016 Agencia de publicidad: <a href="http://grupoendor.com/"><img src="<?php echo get_template_directory_uri() ?>/img/endor.svg" alt="Grupo Endor" class="endor"></a></div>
                <!-- /.copyright -->
            </div>
            <!-- /.col-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.wrapper -->
</footer>
<!-- /#footer -->
