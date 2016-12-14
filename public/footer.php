				<?php

					if(isset($opcionesTemplate['bloque-custom']) and count($opcionesTemplate['bloque-custom'])):

						foreach($opcionesTemplate['bloque-custom'] as $bloqueId):

							$query = "SELECT idEntrada id, titulo, contenido, opciones FROM ctlg_entradas WHERE tipo='static-block' AND idEntrada='{$bloqueId}' LIMIT 0,1";

							$result = mysql_query($query);

							if($result and mysql_num_rows($result)):

								while($item = mysql_fetch_array($result)):

									$opcionesItem = unserialize($item['opciones']);?>

									<div class="block-container">

										<div class="container">

											<div class="col-md-12">

												<?php

													if($opcionesItem['mostrarTitulo']=='1'):?>

														<header class="header-widget">

															<h2><?php echo $item['titulo']?></h2>

														</header>

												<?php

													endif;?>

												<div class="row content">

													<?php echo $item['contenido'];?>

													<div class="clearfix"></div>

												</div><!--.content-->

											</div>

										</div><!--.container-fluid-->

									</div><!--.block-container-->

					<?php

								endwhile;

							endif;

						endforeach;

					endif;?>

				

				<div class="clearfix"></div>

			</div><!--.[role="main"]-->

				

			<footer class="main-footer">

				<div class="container">

					<div class="col-md-2">

						<p><img src="img/logo-footer.png"></p>

					</div>

					

					<div class="col-md-4">

						<h4>Direcci&oacute;n</h4>

						<p>

						<?php if(!empty($direccionContacto)):?><?php echo $direccionContacto?><?php endif;?>

						</p>

					</div>

					

					<div class="col-md-1">

						<p class="text-center"><img src="img/separador-footer.png"></p>

					</div>

					

					<div class="col-md-2">

						<h4>Teléfonos</h4>

						<p>

						<?php if(!empty($telefonoContacto)):?>Tel: <?php echo $telefonoContacto?><?php endif;?><br>

						<?php if(!empty($celularContacto)):?>Cel: <?php echo $celularContacto?><?php endif;?>

						</p>

					</div>

					

					<div class="col-md-1">

						<p class="text-center"><img src="img/separador-footer.png"></p>

					</div>

					

					<div class="col-md-2">

						<h4>Mail</h4>

						<p>

						<?php if(!empty($mailContacto)):?><?php echo $mailContacto?><?php endif;?>

						</p>

					</div>

					

					<div class="clearfix"></div>

					

					<p class="text-center derechos">&copy; <?php echo date("Y");?> Agencia de publicidad: <a href="http://www.grupoendor.com"> <img src="http://www.grupoendor.com/img/logo.svg" alt="Agencia de publicidad en M&eacute;rida &eacute;ndor" width="55"  style="vertical-align: text-top;"/></a> </p>

				</div><!--.container-fluid-->

			</footer><!--.main-footer-->

		</div><!--.wrapper-->



	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

	<script src="js/vendor/jquery-migrate.min.js"></script>

	<script src="js/plugins.js"></script>

	<?php echo $scriptFooter;?>

	<script src="js/main.js"></script>

</body>

</html>