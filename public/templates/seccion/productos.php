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
				$query = "(SELECT cc.idCat id, cc.titulo_{$idioma} titulo, cc.resumen_{$idioma} resumen, cc.contenido_{$idioma} contenido, cc.tipo, cc.slug, cc.orden, cc.opciones, (SELECT CONCAT(ci.idImagen, '_image_', ci.nomArchivo) FROM ctlg_imagenes ci WHERE ci.tipo='previewSeccion' AND ci.idEntrada=cc.idCat LIMIT 0,1) nomArchivo FROM ctlg_categorias cc WHERE cc.idCatPadre = '{$thisId}' AND cc.estatus = '1' AND cc.idCatPadre!='0') UNION (SELECT ce.idEntrada id, ce.titulo_{$idioma} titulo, ce.resumen_{$idioma} resumen, ce.contenido_{$idioma} contenido, ce.tipo, ce.slug, ce.orden, ce.opciones, (SELECT CONCAT(ci.idImagen, '_image_', ci.nomArchivo) FROM ctlg_imagenes ci WHERE ci.tipo='previewPage' AND ci.idEntrada=ce.idEntrada LIMIT 0,1) nomArchivo FROM ctlg_entradas ce LEFT JOIN ctlg_cats_entradas cce USING (idEntrada) WHERE cce.idCat = '{$thisId}' AND ce.tipo IN ('page', 'link', 'servicio') AND ce.estatus='1' AND ce.fechaPublicacion<=NOW() AND cce.idCat!='0') ORDER BY orden ASC, titulo ASC, id DESC";

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
