function EsVacio(x) {
    var filter = /^\s*$/
    return filter.test(x);
}

function EsCorreo(x) {
    var filter = /^[A-Za-z][A-Za-z0-9_.-]*@[A-Za-z0-9_-]+\.[A-Za-z0-9_.]+[A-za-z]$/;
    return filter.test(x);
}

function hideMenu(){
	var $body = $("body");	
	$body.removeClass("menu-open");
	$(".mask-menu").remove();
}

function use_tinyscroller() {
	var touchEvents = 'ontouchstart' in document.documentElement;
	if ( !touchEvents ) {
		return true;  /*Non-touch OS*/
	}
	else {
		return false; /*Android based*/
	}
}

function viewport() {
    var e = window, a = 'inner';
    if (!('innerWidth' in window )) {
        a = 'client';
        e = document.documentElement || document.body;
    }
    return { width : e[ a+'Width' ] , height : e[ a+'Height' ] };
}

function set_scroller_height() {
	$_viewport = $(".viewport");
	var windowHeight = $(window).height();
	var viewportOffset = $_viewport.offset().top;
	var viewportPosition = $_viewport.position().top;

	if (window.matchMedia !== "undefined" && window.matchMedia("(min-width: 1000px)").matches) {
		$_viewport.height(windowHeight - viewportPosition);
	} else {
		$_viewport.height(windowHeight - viewportOffset);
	}

	$_viewport.removeAttr('style');
	$_viewport.attr('style', 'overflow:auto');

	$("#scrollbar1 .scrollbar").hide();
}

function validaContactoForm() {
	var msj_resultadoC = $("#resultadoContactoPage");
    var nombre = $("#nombre");
	var empresa = $("#empresa");
	var telefono = $("#telefono");
    var email = $("#email");
	var estado = $("#estado");
	var ciudad = $("#ciudad");
	
	if (EsVacio(nombre.val())) {
        msj_resultadoC.removeClass("hide alerta error exito info").addClass("alerta").html("El campo \"Nombre\" no puede quedar vac&iacute;o");
        nombre.focus();
        return false;
    }
	
	if (EsVacio(empresa.val())) {
        msj_resultadoC.removeClass("hide alerta error exito info").addClass("alerta").html("El campo \"Empresa\" no puede quedar vac&iacute;o");
        empresa.focus();
        return false;
    }
	
	if (EsVacio(telefono.val())) {
        msj_resultadoC.removeClass("hide alerta error exito info").addClass("alerta").html("El campo \"Tel&eacute;fono\" no puede quedar vac&iacute;o");
        telefono.focus();
        return false;
    }
	
	if (!EsCorreo(email.val())) {
        msj_resultadoC.removeClass("hide alerta error exito info").addClass("alerta").html("Ingresa un correo v&aacute;lido");
        email.focus();
        return false;
    }
	
	if (EsVacio(estado.val())) {
        msj_resultadoC.removeClass("hide alerta error exito info").addClass("alerta").html("El campo \"Estado\" no puede quedar vac&iacute;o");
        estado.focus();
        return false;
    }
	
	if (EsVacio(ciudad.val())) {
        msj_resultadoC.removeClass("hide alerta error exito info").addClass("alerta").html("El campo \"Ciudad\" no puede quedar vac&iacute;o");
        ciudad.focus();
        return false;
    }
}

function initializeMap(id, centro, locations){
	var bounds = new google.maps.LatLngBounds();

	myOptions = {
		scrollwheel: false,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};

	var map = new google.maps.Map(document.getElementById(id), myOptions);

	for (i = 0; i < locations.length; i++){
		lat = locations[i][0][0];
		lng = locations[i][0][1];
		title = locations[i][1];
		pathImg = locations[i][2];

		marker = new google.maps.Marker({
			position: new google.maps.LatLng(lat, lng),
			map: map,
			title: title
		});

		bounds.extend(marker.position);
	}
	
	map.fitBounds(bounds);

	var listener = google.maps.event.addListener(map, "idle", function () {
        map.setZoom(6);
        google.maps.event.removeListener(listener);
    });
}

function sendContactFooter() {
    var msj_resultadoC = $("#resultadoContacto");
    var interesadoEn = $("#interesadoEn");
    var nombre = $("#nombre");
    var email = $("#email");

    if (EsVacio(interesadoEn.val())) {
        msj_resultadoC.removeClass("hide alerta error exito info").addClass("alerta").html("El campo \"Interesado en...\" no puede quedar vac&iacute;o");
        interesadoEn.focus();
        return false;
    }
    if (EsVacio(nombre.val())) {
        msj_resultadoC.removeClass("hide alerta error exito info").addClass("alerta").html("El campo \"Nombre\" no puede quedar vac&iacute;o");
        nombre.focus();
        return false;
    }

    if (!EsCorreo(email.val())) {
        msj_resultadoC.removeClass("hide alerta error exito info").addClass("alerta").html("Ingresa un correo v&aacute;lido");
        email.focus();
        return false;
    }

    $.ajax({
        type: "POST",
        url: "procesos/procesa-contacto.php",
        data: $("#formContactoFooter").serialize() + "&metodo=ajax&enviar=Enviar",
        crossDomain: true,
        dataType: "json",
        beforeSend: function () {
            msj_resultadoC.removeClass("hide alerta error exito info").addClass("info").html("Enviando...");
        },
        success: function (datos) {
            if (datos.resultado == "true") {
                if (datos.clase == "exito") {
                    $("#formContactoFooter")[0].reset();
                }
                msj_resultadoC.removeClass("hide alerta error exito info").addClass(datos.clase).html(datos.mensaje);
            } else {
                msj_resultadoC.removeClass("hide alerta error exito info").addClass("error").html("No se pudo enviar la informaci&oacute;n.");
            }
        },
        error: function () {
            msj_resultadoC.removeClass("hide alerta error exito info").addClass("error").html("Ocurrio un error y no se pudo enviar el mensaje, por favor intentarlo m&aacute;s tarde, disculpa la molestia.");
        }
    });

    return false;
}

function validaCalculadoraConRecibo(){
	var $tipoTarifa = $("#tipoTarifaConRecibo");
	var $consumoBimestral = $("#consumoBimestralConRecibo");
	var $pagoBimestral = $("#pagoBimestralConRecibo");
	var $ahorro = $("#ahorroConRecibo");

	var msj_resultadoC = $("#msj_resultadoCalculadoraConRecibo");
	
	if(EsVacio($tipoTarifa.val())){
		msj_resultadoC
			.removeClass("hidden alerta error exito info")
			.addClass("alerta")
			.html("Selecciona una \"Tarifa\"");
		$tipoTarifa.focus();
		return false;
	}

	if(EsVacio($consumoBimestral.val())){
		msj_resultadoC
			.removeClass("hidden alerta error exito info")
			.addClass("alerta")
			.html("El campo \"Consumo bimestral\" no puede quedar vac&iacute;o");
		$consumoBimestral.focus();
		return false;
	}

	if(EsVacio($pagoBimestral.val())){
		msj_resultadoC
			.removeClass("hidden alerta error exito info")
			.addClass("alerta")
			.html("El campo \"Pago bimestral\" no puede quedar vac&iacute;o");
		$pagoBimestral.focus();
		return false;
	}

	if(EsVacio($ahorro.val())){
		msj_resultadoC
			.removeClass("hidden alerta error exito info")
			.addClass("alerta")
			.html("Selecciona un porcentaje de \"Ahorro\"");
		$ahorro.focus();
		return false;
	}
	
	$.ajax({
        type: "POST",
        url: "resultado",
        data: $("#calculadoraConRecibo").serialize() + "&metodo=ajax",
        crossDomain: true,
        dataType: "html",
        beforeSend: function () {
            msj_resultadoC.removeClass("hidden alerta error exito info").addClass("info").html("Enviando...");
        },
        success: function (datos) {
            if (datos) {
				$("#container-result-calculadora").html("");
				$("#container-result-calculadora").append(datos);
				msj_resultadoC.removeClass("hidden alerta error exito info").addClass("hidden").html();
            } else {
                msj_resultadoC.removeClass("hidden alerta error exito info").addClass("error").html("No se pudo enviar la informaci&oacute;n.");
            }
        },
        error: function () {
            msj_resultadoC.removeClass("hidden alerta error exito info").addClass("error").html("Ocurrio un error, por favor intentarlo m&aacute;s tarde, disculpa la molestia.");
        }
    });
	
	return false;
}

function validaCalculadoraSinRecibo(){
	var $tipoTarifa = $("#tipoTarifaSinRecibo");
	var $pagoBimestral = $("#pagoBimestralSinRecibo");
	var $ahorro = $("#ahorroSinRecibo");

	var msj_resultadoC = $("#msj_resultadoCalculadoraSinRecibo");
	
	if(EsVacio($tipoTarifa.val())){
		msj_resultadoC
			.removeClass("hidden alerta error exito info")
			.addClass("alerta")
			.html("Selecciona una \"Tarifa\"");
		$tipoTarifa.focus();
		return false;
	}

	if(EsVacio($pagoBimestral.val())){
		msj_resultadoC
			.removeClass("hidden alerta error exito info")
			.addClass("alerta")
			.html("El campo \"Pago bimestral\" no puede quedar vac&iacute;o");
		$pagoBimestral.focus();
		return false;
	}

	if(EsVacio($ahorro.val())){
		msj_resultadoC
			.removeClass("hidden alerta error exito info")
			.addClass("alerta")
			.html("Selecciona un porcentaje de \"Ahorro\"");
		$ahorro.focus();
		return false;
	}

	$.ajax({
        type: "POST",
        url: "resultado",
        data: $("#calculadoraSinRecibo").serialize() + "&metodo=ajax",
        crossDomain: true,
        dataType: "html",
        beforeSend: function () {
			console.log($("#calculadoraSinRecibo").serialize());
            msj_resultadoC.removeClass("hidden alerta error exito info").addClass("info").html("Enviando...");
        },
        success: function (datos) {
            if (datos) {
				$("#container-result-calculadora").html("");
				$("#container-result-calculadora").append(datos);
				msj_resultadoC.removeClass("hidden alerta error exito info").addClass("hidden").html();
            } else {
                msj_resultadoC.removeClass("hidden alerta error exito info").addClass("error").html("No se pudo enviar la informaci&oacute;n.");
            }
        },
        error: function () {
            msj_resultadoC.removeClass("hidden alerta error exito info").addClass("error").html("Ocurrio un error, por favor intentarlo m&aacute;s tarde, disculpa la molestia.");
        }
    });
	
	return false;
}

$(document).ready(function() {
    $('#secundary-featured .flexslider').flexslider({
		directionNav: false,
		pauseOnHover: true,
		controlNav: false
	});
		
	$('#main-featured .flexslider').flexslider({
		directionNav: false,
		pauseOnHover: true,
		manualControls: "#customControl li",
		sync: "#secundary-featured .flexslider"
	});

	var wow = new WOW({
		offset: 0,
		mobile: false
	});

	wow.init();
	
	$(".toggle-panel").on("click", function(){
		var target = $(this).attr("data-toggle");
		$(target).slideToggle();
		return false;
	});
	
	$(".control-menu").on("click", function(){
		var $body = $("body");

		if($body.hasClass("menu-open")){
			hideMenu();
		}else{
			$body.addClass("menu-open");
			$body.append("<div class='mask-menu'></div>");
		}

		return false;
	});

	$(document).on("click", ".mask-menu", function(){
		hideMenu();
	});

	var $fancybox = $(".fancybox");

    if ($fancybox.size()) {
        $fancybox.fancybox();
    }
	
	if($("#googleMapUbicaciones").size()){
		
		initializeMap(
			"googleMapUbicaciones",
			[20.96711,-89.623708],
			locations
		);
	}
	
	if ( use_tinyscroller() ) {
		$('#scrollbar1').tinyscrollbar({invertscroll: true});
	}else {
		set_scroller_height();
	}
});