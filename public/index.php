<?php

	session_start();



	require("scripts/funciones.php");

	require("scripts/PHPPaging.lib.php");

	require("scripts/gump.class.php");

	require("scripts/class.mobiledetect.php");

	require("my-admin/conexion.php");

	require("my-admin/config.php");

	

	if(!isset($_SESSION['idioma'])){

		$_SESSION['idioma'] = "esp";

	}

	

	$idioma = $_SESSION['idioma'];



	$gump = new GUMP();

	$_GET = $gump->sanitize($_GET);

	

	$preNomSitio = $postNomSitio = $scriptFooter = "";



	$loadModule = isset($_GET['load-module'])?$_GET['load-module']:"";



	$detect = new Mobile_Detect;

	$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'telefono') : 'desktop');



	$urlSite = setBaseURL();

	

	$thisPage = "";



	if($loadModule!=""){

		$url_data = getURLData($loadModule);

		$thisPage = $url_data[0];

	}



	$paginas = array(

		"home" => "templates/page/home.php",

		"home-default" => "templates/page/home.php",

		"image" => "scripts/image.php",

		"gracias" => "templates/page/gracias.php",

		"resultado" => "templates/page/resultadoCalculadora.php",

		"404" => "404.html",

	);



	$templates = array(

		"page" => "page.php",

		"servicio" => "page.php",

		"producto" => "page.php",

		"section" => "section.php",

		"section-services" => "section.php",

	);



	/*menu header*/

	$menuHeader1 = array();

	$menuFooter1 = array();

	$path = array();

	

	$menuHeader1 =  getMenu_(2, true, 4, $menuHeader1, $path);

	$menuFooter1 =  getMenu_(2, true, 1, $menuFooter1, $path);



	$isHome = false;



	if($thisPage==""):

		$isHome = true;

		if($paginaEntrada == "home-default" or $paginaEntrada == ""):

			$require = $paginas["home-default"];

		else:

			$rowMeta = getMetaPage($paginaEntrada);

		endif;

	elseif(array_key_exists($thisPage, $paginas)):

		$require = $paginas[$thisPage];

	else:

		$rowMeta = getMetaInfo($thisPage);

	endif;



	if($rowMeta):

		$thisId = $rowMeta['id'];

		$thisIdCatPadre = isset($rowMeta['idCatPadre'])?$rowMeta['idCatPadre']:null;

		

		if(!$isHome):

			$preNomSitio = $rowMeta['titulo']." - ";

		endif;

		

		

		$tipoTemplate = $rowMeta['tipo'];

		$opcionesTemplate = unserialize($rowMeta['opciones']);

		$infoPadres = getInfoPadres($thisIdCatPadre);



		$metaDescripcion = ($opcionesTemplate['metas']['description']!="")?$opcionesTemplate['metas']['description']:$descripcionCorta;

		$metaKeywords = ($opcionesTemplate['metas']['keywords']!="")?$opcionesTemplate['metas']['keywords']:$keywords;

		$showFeatured = ($opcionesTemplate['configuracion']['slideshow-'.$idioma]!="")?$opcionesTemplate['configuracion']['slideshow-'.$idioma]:NULL;



		$numPadres = count($infoPadres);



		$path = array();



		for($k = 0; $k < $numPadres; $k++):

			$path[] = array("id" => $infoPadres[$k]['idCat'], "tipo" =>$infoPadres[$k]['tipo']);

		endfor;



		$thisMeta = array("id" => $thisId, "tipo" => $tipoTemplate);



		$path[] = $thisMeta;

		

		if(array_key_exists($tipoTemplate, $templates)):

			$require = $templates[$tipoTemplate];

		endif;



	elseif($require == ""):

		$require = "404.html";

	endif;



	if(file_exists($require)):

		include($require);

	else:

		include("404.html");

	endif;

	

	mysql_close($conexion);

?>

