<?php
	$opcionesPage = unserialize($rowMeta['opciones']);
?>
<?php include("header.php");?>

<?php
	if($rowMeta['imagen']!=""):
		$src = "archivos/imagenes/".$rowMeta['imagen'];?>

		<figure class="figure-header">
			<img alt="<?php ?>" src="<?php echo $src?>">
		</figure>
<?php
	endif;?>

<div class="block-container block-intro">
	<div class="container">
		<header class="header-template">
			<h2><?php echo $rowMeta['titulo']?></h2>
		</header>

		<div class="content col-md-12">
			<?php echo $rowMeta['contenido']?>
			<div class="clearfix"></div>
		</div>

		<div class="clearfix"></div>
	</div><!--.container-fluid-->
</div><!--.container-block-->

<?php include("footer.php");?>
