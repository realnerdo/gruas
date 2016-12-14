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
		
		<?php
			$query = "SELECT idEntrada id, titulo_{$idioma} titulo, resumen_{$idioma} resumen, contenido_{$idioma} contenido, opciones
			FROM ctlg_entradas ce
			WHERE ce.tipo='faq'
			AND ce.estatus='1'
			AND ce.fechaPublicacion<=NOW()
			ORDER BY ce.orden ASC";
			$paging = new PHPPaging;
			$paging->agregarConsulta($query);
			$paging->mostrarActual("<span class=\"navthis\"> {n} </span>");
			$paging->linkEstructura("$url_data[0]/?p={n}");

			if($paging->ejecutar() and $paging->numTotalRegistros()):
				$i = 0;
					
				while($item = $paging->fetchResultado()):
					if($i%2==0):
						$itemsCol1[] = $item;
					else:
						$itemsCol2[] = $item;
					endif;
					$i++;
				endwhile;?>

				<div class="col-md-6">
					<?php
						foreach($itemsCol1 as $item):?>
							<div class="container-faq review-faqs">
								<h2 class="titulo collapsed" role="button" data-toggle="collapse" href="#faq_<?php echo $item['id']?>"><?php echo $item['titulo']?></h2>
								<div class="contenido collapse" id="faq_<?php echo $item['id']?>">
									<?php echo $item['contenido']?>
									<div class="clearfix"></div>
								</div><!--.contenido-->
							</div><!--.container-faq-->
					<?php
						endforeach;?>

					<div class="clearfix"></div>
				</div>
				
				<div class="col-md-6">
					<?php
						foreach($itemsCol2 as $item):?>
							<div class="container-faq review-faqs">
								<h2 class="titulo collapsed" role="button" data-toggle="collapse" href="#faq_<?php echo $item['id']?>"><?php echo $item['titulo']?></h2>
								<div class="contenido collapse" id="faq_<?php echo $item['id']?>">
									<?php echo $item['contenido']?>
									<div class="clearfix"></div>
								</div><!--.contenido-->
							</div><!--.container-faq-->
					<?php
						endforeach;?>
						
					<div class="clearfix"></div>
				</div>
				
				<div class="clearfix"></div>

				<?php
					if($paging->numTotalPaginas()>1):?>
						<div class="paginacion">
							<?php echo $paging->fetchNavegacion();?>
						</div><!--.paginacion-->
				<?php
					endif;?>
		<?php
			endif;?>

	</div><!--.container-fluid-->
</div><!--.container-block-->

<?php include("footer.php");?>
