<?php $showFeatured = false;?>
<?php include("header.php");?>

<?php
	$querySucursal = "SELECT cs.titulo_$idioma titulo, cs.contenido_$idioma contenido, cs.opciones FROM ctlg_entradas cs WHERE cs.estatus = '1' AND tipo='page-sucursal' ORDER BY titulo";
	$resultSucursal = mysql_query($querySucursal);

	if($resultSucursal and mysql_num_rows($resultSucursal)):
		while($suc = mysql_fetch_array($resultSucursal)):
			$opciones = unserialize($suc['opciones']);
			$coordenadas = $opciones['coordenadas'];
			$sucursal[] = "[[$coordenadas], '" . $suc['titulo'] . "', '', '']";
		endwhile;?>

		<div id="googleMapUbicaciones"></div>
		
<?php
	endif;?>

<div class="block-container block-intro">
	<div class="container">
		<div class="col-md-12">
			<div class="row">
				<header class="header-template">
					<h2><?php echo $rowMeta['titulo']?></h2>
				</header>

				<div class="content">
					<?php echo $rowMeta['contenido']?>
					<div class="clearfix"></div>
				</div>
			</div><!--.row-->
		</div>
	</div><!--.container-fluid-->
</div><!--.container-block-->
	
<div class="block-container">
	<div class="container">
		<form id="formContactoPage" class="form-contacto-page row" data-wow-delay="0.6s" action="procesos/procesa-contacto-page.php" method="post" onsubmit="return validaContactoForm()">
			<div id="resultadoContactoPage" class="infoProceso <?php if(!isset($_SESSION['resultadoContacto'])): echo "hide"; else: echo $_SESSION['resultadoContacto']['clase']; endif;?>">
				<?php
					echo $_SESSION['resultadoContacto']['mensaje'];
					unset($_SESSION['resultadoContacto']);?>
			</div><!--#resultadoContacto-->
	
			<div class="col-md-6">
				<p class="form-item"><input type="text" id="nombre" name="nombre" placeholder="Nombre" required></p>
				<p class="form-item"><input type="text" id="telefono" name="telefono" placeholder="Tel&eacute;fono" required></p>
				<p class="form-item"><input type="text" id="celular" name="celular" placeholder="Celular" required></p>
				<p class="form-item"><input type="text" id="email" name="email" placeholder="Email" required></p>
			</div>

			<div class="col-md-6">
				<p class="form-item"><textarea name="comentario" placeholder="Mensaje"></textarea></p>
				<p class="text-right"><input class="btn-submit" type="submit" name="enviar" value="Enviar"></p>
			</div>

			<div class="clearfix"></div>
		</form>
	</div><!--.container-fluid-->
</div><!--.content-block-->

<?php $scriptFooter = "<script> var locations = [" . implode(',' , $sucursal) . "]; </script>	<script src=\"//maps.google.com/maps/api/js\"></script>";?>

<?php include("footer.php");?>
