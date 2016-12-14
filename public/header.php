<?php
	$bodyClass = "";
	$bodyClass .= ($isHome)?" is-home " : "";
	$bodyClass .= ($rowMeta['imagen']!="" || !empty($showFeatured))?" hasFeaturedHeader " : "";
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<base href="<?php echo $urlSite;?>">
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<meta name="description" content="<?php echo $metaDescripcion;?>">
		<meta name="keywords" content="<?php echo $metaKeywords;?>">
		<meta property="og:url" content="<?php echo $urlSite.$rowMeta['slug']?>" />
		<meta property="og:title" content="<?php echo $preNomSitio.$nomSitio.$postNomSitio;?>" />
		<meta property="og:type" content="article" />

		<?php
			if($rowMeta['imagen']!=""):
				$urlImagen = $urlSite."archivos/imagenes/".$rowMeta['imagen'];?>
				<meta property="og:image" content="<?php echo $urlImagen?>" />
		<?php
			endif;?>

		<title><?php echo $preNomSitio.$nomSitio.$postNomSitio?></title>
		<link href="favicon.ico" rel="shortcut icon" type="image/x-icon">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
		<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300italic,300,400italic,600,600italic,700,700italic' rel='stylesheet' type='text/css'>
		<link rel='stylesheet' href="css/main.css">

		<!--[if lt IE 9]>
		  <link href="css/ie-main.css" rel="stylesheet">
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>

	<body class="<?php echo $bodyClass ?>">
		<!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
		
		<nav class="menu-offcanvas">
			<div id="scrollbar1">
				<div class="scrollbar"><div class="track"><div class="thumb"><div class="end"></div></div></div></div>
				<div class="viewport">
					 <div class="overview">
						<div class="control-menu">
							<span class="line first"></span>
							<span class="line middle"></span>
							<span class="line last"></span>
						</div><!--.control-menu-->
						<ul class="menu">
							<?php printMenu($menuHeader1)?>
						</ul><!--.overview-->
					</div><!--."viewport-->
				</div><!--.viewport-->
			</div><!--#scrollbar1-->
		</nav><!--.menu-offcanvas-->
		
		<header class="main-header">
			<div class="header-content">
				<div class="container">
					<div class="col-md-12">
						<div class="row">
							<div class="col-sm-3 col-xs-12">
								<h1 class="container-logo"><a href="./"><img src="img/logo.png" alt=""></a></h1>
							</div>
							<div class="col-sm-9">
								<nav class="header-nav hidden-xs">
									<ul class="nivel-0">
										<?php printMenu($menuHeader1)?>
									</ul>
									<div class="clearfix"></div>
								</nav>
								
								<div class="visible-xs-block">
									<div class="control-menu">
										<span class="line first"></span>
										<span class="line middle"></span>
										<span class="line last"></span>
									</div><!--.control-menu-->
								</div>
							</div>
						</div><!--.row-->
					</div>
					<div class="clearfix"></div>
				</div><!--.container-fluid-->
			</div><!--.header-content-->
		</header><!--.main-header-->
	
		<div class="wrapper">			
			<div role="main">
				<?php include("templates/blocks/featured.php");?>