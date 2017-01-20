<section id="banner" class="glide">
    <!-- <div class="glide__arrows">
        <button class="glide__arrow prev" data-glide-dir="<">Anterior</button>
        <button class="glide__arrow next" data-glide-dir=">">Siguiente</button>
    </div> -->

    <div class="glide__wrapper">
        <ul class="glide__track">
            <?php $images = get_field('banner') ?>
            <?php foreach ($images as $image): ?>
                <li class="glide__slide">
                    <div class="img" style="background: url('<?php echo $image['sizes']['large'] ?>') center center no-repeat; background-size: cover;"></div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <div class="glide__bullets"></div>
</section>
<!-- /#banner.glide -->
