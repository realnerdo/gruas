<?php include("header.php");?>

<div class="container">
	<div class="col-md-12">
		<header class="header-template">
			<h2><?php echo $rowMeta['titulo']?></h2>
		</header>

		<div class="content">
			<?php echo $rowMeta['contenido']?>
			<div class="clearfix"></div>
		</div>
	</div>
</div><!--.container-->
		
<div class="container">
	<div class="col-md-12">
		<div class="preview-items-seccion">
			<?php
				$query = "SELECT idEntrada id, titulo_{$idioma} titulo, resumen_{$idioma} resumen, contenido_{$idioma} contenido, slug, opciones, (SELECT CONCAT(ci.idImagen, '_image_', ci.nomArchivo) FROM ctlg_imagenes ci WHERE ci.tipo='previewPage' AND ci.idEntrada=ce.idEntrada LIMIT 0,1) nomArchivo
				FROM ctlg_entradas ce
				WHERE ce.tipo='producto'
				AND ce.estatus='1'
				AND ce.fechaPublicacion<=NOW()
				ORDER BY ce.orden ASC";
				
				echo $query;

				$paging = new PHPPaging;
				$paging->agregarConsulta($query);
				$paging->mostrarActual("<span class=\"navthis\"> {n} </span>");
				$paging->linkEstructura("$url_data[0]/?p={n}");

				if($paging->ejecutar() and $paging->numTotalRegistros()):
					while($row = $paging->fetchResultado()):
						$src = "img/placeholder.png";

						if($row['nomArchivo'] !=""):
							$src = "image/?path=archivos/imagenes/".$row['nomArchivo']."&width=150&height=150";
						endif;
						
						$href = ($row['tipo'] == 'link') ? $row['url'] : $row['slug'].'/';?>
						
						<article class="wow">
							<figure class="col-md-2 col-sm-2">
								<a href="<?php echo $href?>"><img src="<?php echo $src?>" /></a>
							</figure>
							<div class="col-md-10 col-sm-10 preview-content">
								<h2><a href="<?php echo $href?>"><?php echo $row['titulo']?></a></h2>
								<div class="contenido">
									<p><?php echo cortaTexto(strip_tags($row['resumen']), 140);?></p>
								</div><!--.contenido-->

								<p class="ver-mas"><a class="btn btn-info" href="<?php echo $href?>">Ver m&aacute;s</a></p>
							</div>
							<div class="clearfix"></div>
						</article><!--.preview-contenido-->
				<?php
					endwhile;?>
				<?php
					if($paging->numTotalPaginas()>1):?>
						<div class="paginacion">
							<?php echo $paging->fetchNavegacion();?>
						</div><!--.paginacion-->
				<?php
					endif;
				endif;?>
			<div class="clearfix"></div>
		</div><!--.preview-items-seccion-->
	</div>
	<div class="clearfix"></div>
</div>

<?php include("footer.php");?>
