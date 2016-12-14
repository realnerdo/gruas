<?php

	$query = "SELECT cl.idLogo id, nomArchivo, cl.titulo, cl.url, cl.contenido FROM ctlg_logos cl WHERE tipo='socio' AND estatus='1' ORDER BY orden ASC";

	$result = mysql_query($query);

	if($result and mysql_num_rows($result)):?>

		<div class="featured-marcas-block">

						<div class="marcas-container">

							<?php

								while($marca = mysql_fetch_array($result)):

									$src = ($marca['nomArchivo']!="")?"archivos/imagenes/{$marca['id']}_logo_{$marca['nomArchivo']}":"img/placeholder.jpg";?>

									<div class="preview">

										<image src="<?php echo $src?>" alt="">

									</div>

							<?php

								endwhile;?>

						</div>

		</div><!--.featured-marcas-block-->

<?php

	endif;?>
