$(function(){
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
            console.log('here');
            menu.toggleClass('active');
            return false;
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
