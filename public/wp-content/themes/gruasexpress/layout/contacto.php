<section id="contacto" class="section">
    <div class="wrapper">
        <div class="row">
            <h2 class="section-title"><img src="<?php echo get_template_directory_uri() ?>/img/fast.png" class="icon"><?php the_field('contacto_titulo') ?></h2>
            <!-- /.section-title -->
            <h3 class="section-subtitle"><?php the_field('contacto_subtitulo') ?></h3>
            <!-- /.subtitle -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-6">
                <form action="" class="contact-form">
                    <div class="form-group">
                        <input type="text" class="input" name="name" placeholder="Nombre">
                    </div>
                    <!-- /.form-group -->
                    <div class="form-group">
                        <input type="text" class="input" name="phone" placeholder="Teléfono">
                    </div>
                    <!-- /.form-group -->
                    <div class="form-group">
                        <input type="email" class="input" name="email" placeholder="Correo electrónico">
                    </div>
                    <!-- /.form-group -->
                    <div class="form-group">
                        <textarea name="message" rows="8" cols="80" class="input" placeholder="Mensaje"></textarea>
                    </div>
                    <!-- /.form-group -->
                    <div class="form-group">
                        <input type="submit" class="btn btn-yellow" value="Enviar">
                    </div>
                    <!-- /.form-group -->
                </form>
                <!-- /.contact-form -->
            </div>
            <!-- /.col-6 -->
            <div class="col-6">
                <?php $map = get_field('map'); ?>
                <div class="map" data-lat="<?php echo $map['lat']; ?>" data-lng="<?php echo $map['lng']; ?>"></div>
                <!-- /.map -->
            </div>
            <!-- /.col-6 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.wrapper -->
</section>
<!-- /#contacto.secion -->
