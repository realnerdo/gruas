<?php
	$query = "
		SELECT ce.idEntrada id, ce.titulo, ce.contenido, ce.slug, DAY(ce.fechaPublicacion) dia, MONTH(ce.fechaPublicacion) mes, YEAR(ce.fechaPublicacion) anio, (SELECT CONCAT(ci.idImagen,'_image_', ci.nomArchivo) nomArchivo FROM ctlg_imagenes ci WHERE ci.idEntrada=ce.idEntrada AND ci.tipo='previewPage' LIMIT 0,1) imagen, CAST(cce.valor AS UNSIGNED) valor
		FROM ctlg_meta_entradas cce
		LEFT JOIN (ctlg_entradas ce) USING (idEntrada)
		WHERE cce.llave='_views'
		AND ce.tipo='entrada-blog'
		AND ce.estatus='1'
		ORDER BY valor DESC LIMIT 0,5";
	$result = mysql_query($query);
	if($result and mysql_num_rows($result)):?>
		<div class="widget widget-featured">
				<div class="flexslider">
					<ul class="slides">
						<?php
							$i == 0;
							while($item = mysql_fetch_array($result)):
								$opciones = unserialize($item['opciones']);
								$href = ($item['tipo'] == "link") ? $opciones['url'] : $item['slug']."/";
								$src = ($item['imagen'] != "") ? "image/?path=archivos/imagenes/".$item['imagen']."&width=300&height=200":"";?>
								<li>
									<?php
										if($src!=""):?>
											<figure class="flex-figure">
												<a href="<?php echo $item['slug']?>/"><img alt="" src="<?php echo $src?>"></a>
											</figure>
									<?php
										else:?>
											<div class="flex-caption">
												<?php echo cortaTexto(strip_tags($item['contenido']), 140);?></p>
											</div>
									<?php
										endif;?>
									<h3><?php echo $item['titulo']?></h3>
									<p class="fecha-entrada"><?php echo $item['dia']?>-<?php echo getNombreMes($item['mes'])?>-<?php echo $item['anio']?></a></p>
								</li>
						<?php
							endwhile;?>
					</ul><!--.slides-->
					<div class="clearfix"></div>
				</div><!--.flexslider-->
		</div>
<?php
	endif;?>
