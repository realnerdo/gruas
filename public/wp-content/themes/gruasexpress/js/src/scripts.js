$(function(){
    var $body = $('body');
    var $window = $(window);

    // Animate when visible
    var animate = $('.animate');
    if(animate.length){
        function isVisible($el) {
            var winTop = $window.scrollTop();
            var winBottom = winTop + $window.height();
            var elTop = $el.offset().top;
            var elBottom = elTop + $el.height();
            return (elTop<= winBottom);
        }
        $window.scroll(function(){
            animate.each(function(){
                var $this = $(this);
                if (isVisible($this)){
                    $this.addClass("visible");
                }
            })
        });
    }

    // Slider
    $('.glide').glide({
        type: 'carousel',
        autoplay: 4000
    });

    // Menu
    var menu = $('#main-menu');
    if(menu.length){
        var toggle_menu = $('.toggle-menu');
        toggle_menu.click(function(){
            menu.toggleClass('active');
            return false;
        });
        $('a[href*="#"]:not([href="#"])').click(function() {
            if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
                if (target.length) {
                    $('html, body').animate({
                        scrollTop: target.offset().top
                    }, 1000);
                    menu.toggleClass('active');
                    return false;
                }
            }
        });
    }

    // Maps
    var contact_map_div = $('.map');
    if(contact_map_div.length){
        var contact_map = new GMaps({
            div: '.map',
            lat: contact_map_div.data('lat'),
            lng: contact_map_div.data('lng'),
            zoom: 14
        });

        contact_map.addMarker({
            lat: contact_map_div.data('lat'),
            lng: contact_map_div.data('lng'),
            title: 'Contacto'
        });
    }
});
