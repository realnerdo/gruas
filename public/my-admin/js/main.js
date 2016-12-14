/* JavaScript Document */
var marker;
var map;

Array.prototype.find = function(searchStr) {
  var returnArray = false;
  for (i=0; i<this.length; i++) {
    if (typeof(searchStr) == 'function') {
      if (searchStr.test(this[i])) {
        if (!returnArray) { returnArray = [] }
        returnArray.push(i);
      }
    } else {
      if (this[i]===searchStr) {
        if (!returnArray) { returnArray = [] }
        returnArray.push(i);
      }
    }
  }
  return returnArray;
}

function parseQuery(qstr){
	var urlParams = {};
	
	var match,
		pl     = /\+/g,  /* Regex for replacing addition symbol with a space */
		search = /([^&=]+)=?([^&]*)/g,
		decode = function (s) { return decodeURIComponent(s.replace(pl, " ")); },
		query  = qstr.split("?");

	while (match = search.exec(query[1])){
	   urlParams[decode(match[1])] = decode(match[2]);
	}
	
	return urlParams;
}

function tipoValido(nom_archivo,extensiones_permitidas){
	archivo = new String(nom_archivo);
	tmp = archivo.split('\\');
	tipo = tmp[tmp.length-1];
	
	if(tipo!=''){
		extension = (tipo.substring(tipo.lastIndexOf("."))).toLowerCase();
    	permitida = false;
	    for(i=0;i<extensiones_permitidas.length;i++){if(extensiones_permitidas[i]==extension){permitida = true; break;}}
	    if(!permitida){return false;}
	}

	return true;
}

function EsVacio(x){
	var filter=/^\s*$/;
	return filter.test(x);
}

function EsCorreo(x){
	var filter=/^[A-Za-z][A-Za-z0-9_.-]*@[A-Za-z0-9_-]+\.[A-Za-z0-9_.]+[A-za-z]$/;
	return filter.test(x);
}

function EsClaveEmail(x){
	var filter=/^([\w-]+(?:\.[\w-]+)*)$/i;
	return filter.test(x);
}

function EsNum(x){
	var filter=/^\d*$/;
	return filter.test(x);
}

function EsDinero(x){
	var filter=/^\d+\.\d{2}$/;
	return filter.test(x);
}

function muestraMsj(elemento, mensaje, clase, autohide){
	$(elemento).removeClass('exito error info alerta').addClass(clase).html(mensaje).show();
	if(autohide){
		ocultaMsj(elemento);
	}
}

function ocultaMsj(elemento){
	setTimeout('$("'+elemento+'").fadeOut("fast");',5000);
}

function escondeForm(){
	$("#form_addup").hide();
}

function muestraForm(){
	$("#form_addup").show();

	if($(".jquery_ckeditor").size()){
		$(".jquery_ckeditor").ckeditor();
	}
	
	if($("#googleMap").size()){
		initialize("googleMap");
	}
}

function msjDel(){
	if(confirm("Seguro que desea eliminar este elemento de la base de datos?")){espera(); return true;}
	return false;
}

function espera(){
	$("#info").removeClass('exito error info alerta').addClass('info').html('Espera un momento mientras se procesa la informaci&oacute;n').show();
}

function setCoordenadas(location){
	
	ubicacion = new String(location);
	ubicacion = ubicacion.replace("(","");
	ubicacion = ubicacion.replace(")","");
	
	$("#coordenadas").val(ubicacion);
}

function placeMarker(location) {
	if( marker ){
    	marker.setPosition(location);
	}else{
		marker = new google.maps.Marker({
			position: location,
			map: map
		});
	}

	setCoordenadas(location);
}

function placeMarkerMap(lat, lng) {

	var location = new google.maps.LatLng(lat, lng);
	marker = new google.maps.Marker({
		position: location,
		map: map
	});
}

function initialize(element){
	
	var destino = new google.maps.LatLng(20.98388007924893, -89.6209716796875);
	var myOptions = {
		zoom: 10,
		center: destino,
		scrollwheel: false,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};

	map = new google.maps.Map(document.getElementById(element), myOptions);
	
	if($("#coordenadas").val() != ""){
		coordenadas = $("#coordenadas").val().split(",");
		ubicacionMarker = new google.maps.LatLng(coordenadas[0], coordenadas[1]);
		map.setCenter(ubicacionMarker);
		placeMarker(ubicacionMarker);
	}
	
	google.maps.event.addListener(map, 'click', function(event) {
		placeMarker(event.latLng);
	});
}

$(document).ready(function(){

	$("#toggleForm").on("click", function(){
		(this.tog = !this.tog) ? muestraForm() : escondeForm();
		return false;
	});

	$(".btn-edit").on("click",function(){
		muestraMsj("#info", "Espera un momento mientras se procesa la informaci&oacute;n","info",false);
	});
	
	$(".btn-del").on("click", function(){
		return msjDel();
	});
	
	$(".delFile").on("click", function(){
		if(confirm("Seguro que desea eliminar este elemento de la base de datos?")){
			var cont_padre;
			var href = $(this).attr("href");
			var query = parseQuery(href);
			
			if($(this).parents(".cont_imagen").size()){
				cont_padre = $(this).parents(".cont_imagen");
			}else{
				cont_padre = $(this).parents(".to-delete");
			}

			$.get(
				"procesos/proc-delete-archivo.php",
				{ "hid" : query.hid, "haccion" : query.haccion, "tipo" : query.tipo, "metodo" : "ajax"},
				function(resultado) {
					if(resultado.resultado=="true"){
						cont_padre.remove();
						muestraMsj("#info", resultado.mensaje, resultado.clase);
					}
				},
				"json"
			);
		}
		
		return false;
	});
	
	if($(".ceebox").size()){
		$(".ceebox").ceebox();
	}
});

/******************/
/*  Validaciones  */
/******************/

function valLogin(){
	if(EsVacio($("#user_login").val())){
		muestraMsj("#info", "El campo Nombre de usuario est&aacute; vac&iacute;o.","alerta",false);
		$("#user_login").focus();
		return false;
	}

	if(EsVacio($("#user_pass").val())){
		muestraMsj("#info", "El campo contrase&ntilde;a est&aacute; vac&iacute;o.","alerta",false);
		$("#user_pass").focus(); 
		return false;
	}

	var pass = hex_sha1($("#user_pass").val());

	$("#metodo").val("1");
	$("#user_pass").val(pass);

	return true;
}

function valRecupera(){
	if(EsVacio($("#user_login").val())){
		muestraMsj("#info","Escribe un nombre de usuario o e-mail.","alerta",false);
		$("#user_login").focus();
		return false;
	}

	return true;
}

$(document).ready(function() {
	$("#form-user").validate({
		rules: {
			nom_user: "required",
			nombre: "required",
			apellido: "required",
			correo: {
				required : true,
				email: true
			},
			password: {
				required: false,
				minlength: 5
			},
			password2: {
				required: false,
				minlength: 5,
				equalTo: "#password"
			}
		},
		messages: {
			nom_user: "Por favor, ingresa tu nombre de Usuario.",
			nombre: "Por favor, ingrea tu Nombre.",
			apellido: "Por favor, ingresa tu Apellido.",
			correo: "Por favor, ingresa una cuenta de correo valida.",
			password: "Por favor, porporciona un password de al menos 5 caracteres.",
			password2: "Por favor, repite tu password."
		},
		/* the errorPlacement has to take the table layout into account */
		errorPlacement: function(error, element) {
			error.appendTo( element.parent() );
		},
		/* set this class to error-labels to indicate valid fields */
		success: function(label) {
			/* set &nbsp; as text for IE */
			label.html("&nbsp;").addClass("checked");
		}
	});

	var fecha = $(".fecha");
	
	if(fecha.size()){
		fecha.datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: 'yy-mm-dd',
			yearRange: '1950:'+new Date(),
			maxDate: new Date()
		});
	}

	if($(".ocultaMsj").size()){
		ocultaMsj(".ocultaMsj");
	}

	if($("#password").size()){
		$("#password").passStrength({
            userid: "#nom_user"
        });
	}
	
	/*funciones menu*/
	$(".menu").hide(); /* oculto los menus */
	
	if($.cookie("muestra")!=null){ /* si la cookie no es vacia */
		var muestra = $.cookie("muestra").split(",");
		var numItems = muestra.length;
		
		for(i=0; i<numItems; i++){
			$("#"+muestra[i]).next().show(); /* muestro el menu */
		}
	}
	
	$(".tit_cat").on("click", function(){
		var parentId = $(this).prop("id");
		
		$(this).next().slideToggle("fast", function(){
			var muestra = $.cookie("muestra") || "";
			var temp = muestra.split(",");

			if(!$(this).is(':visible')){ /* si se oculta el menu */
				temp.splice(temp.find(parentId), 1); /* elimino el menu de las cookies */
			}else{
				temp.push(parentId); /* agrego el menu */
			}

			$.cookie("muestra", temp.toString(), {path: '/'}); /* asigno el primer valor */
		});
	});
	
	/* clonacion */
	$(".clone-element").on("click", function(){
		var elem = $(this).attr("data-clone"); /* elemento a clonar */
		var cloneTo = $(this).attr("data-cloneTo"); /* contenedor en donde se clonara */
		var cloneElem = $(elem).clone(true, false); /* clonacion */
		
		/* limpieza de campos */
		
		cloneElem.find(":input, textarea").val('');
		cloneElem.find(':checkbox, :radio').removeAttr('checked');
		cloneElem.find('.cke').remove();

		cloneElem.appendTo(cloneTo); /* colocar el elemento clonado en el contenedor */
		cloneElem.addClass("clone");
		
		if($(".clone .jquery_ckeditor").size()){
			$(".clone .jquery_ckeditor").ckeditor();
		}

		return false;
	});
	
	$(document).on("click", ".delete-clone", function(){
		$(this).parents(".clone").remove();
		return false;
	});
});
