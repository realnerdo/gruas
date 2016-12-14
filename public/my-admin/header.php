<?php
	session_start();

	ini_set("memory_limit","250M");

	if(!isset($_SESSION['user']) or $_SESSION['user']['acceso']!='cpanel'):
		header("Location:login.php");
	endif;

	include("config.php");
	include("conexion.php");
	include("scripts/funciones.php");
	include("scripts/PHPPaging.lib.php");
	include("ubica_carpetas.php");
?>
<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="es"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="es"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="es"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="es"> <!--<![endif]-->

<head>
	<meta charset="utf-8">
    <title><?php echo $preNomSitio.$nomSitio.$postNomSitio;?></title>
    <!--<link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">-->
	<link rel="stylesheet" href="css/main.css">	
	<script src="js/vendor/modernizr-2.6.2.min.js"></script>
</head>

<body>
	<div class="main-wrapper">
		<div class="wrp-contenido">
			<div class="main-header">
				<img class="img-logo" alt="<?php echo $nomSitio;?>" src="../img/logo.png" height="41" />
				<h1 class="sitio-logo"><a href="../"><?php echo $nomSitio;?></a></h1>

				<div class="sesion-info">
					<p>Bienvenido <?php echo $_SESSION['user']['nombre'].' '.$_SESSION['user']['apellido']?> | <a href="logout.php">Cerrar sesi&oacute;n</a></p>
				</div><!--.sesion-info-->


				<div class="clearfix"></div>
			</div><!--.main-header-->


			<div class="body">

				<?php include("menu-admin.php")?>


				<div class="body-contenido">
					<div class="contenido">

						<div id="info" class="info-proceso <?php echo (!isset($_SESSION['resultado'])) ? "hide" : $_SESSION['resultado']['clase']. " ocultaMsj ";?>">
							<?php echo $_SESSION['resultado']['mensaje']; unset($_SESSION['resultado']);?>
						</div><!--.info.proceso-->
