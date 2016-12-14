<?php include("header.php");?>

	<div class="equipos" id="equipos">
		<div class="container">
			<header class="header-template">
				<p><img src="img/grua.png"></p>
				<h2>Equipos</h2>
				<p class="text-center">Actualmente, Grúas Express del Sureste, cuenta con las siguientes unidades para el servicio a sus clientes:</p>
			</header>
			<ul class="list">
				<li class="item">2 grúas tipo A  F350  de 3.5 toneladas (de plataforma y wheel lift)</li>
				<li class="item">1 grúa tipo A Dodge Ram de 3.5 toneladas (de plataforma y wheel lift)</li>
				<li class="item">1 grúa tipo A Dodge Ram de 4.5 toneladas (de plataforma y wheel lift)</li>
				<li class="item">2 grúas tipo B de 4.5 toneladas. (de plataforma y wheel lift)</li>
				<li class="item">2 grúas tipo B de 10 toneladas (de plataforma y wheel lift)</li>
				<li class="item">1 grúa tipo B de 10 toneladas para trasladar simultáneamente tres vehículos</li>
				<li class="item">1 grúa de ancla tipo B, wheel lift y dolly (capacidad de 8 toneladas)</li>
				<li class="item">1 grúa de ancla tipo C con under lift (capacidad de 12 toneladas)</li>
				<li class="item">1 grúa de ancla tipo C con under lift (capacidad de 15 toneladas)</li>
				<li class="item">1 grúa de ancla tipo C, con under lift (capacidad de 20 toneladas)</li>
				<li class="item">1 grúa de ancla tipo D, con under  lift (capacidad de 30 toneladas)</li>
				<li class="item">1 grúa (tipo tracto camión) desmontable tipo D con under lift (capacidad de 30 toneladas)</li>
				<li class="item">1 tracto camión para realizar traslados de cajas secas, low boys, plataformas, etc</li>
				<li class="item">1 madrina con capacidad para trasladar 6 unidades.</li>
				<li class="item">1 remolque tipo low boy con capacidad de carga de 30 toneladas para mover maquinaria pesada y/o vehículos.</li>
			</ul>
			<!-- /.list -->
			<p class="text-center">
				*Todos los equipos cuentan con localizador satelital*
			</p>
			<!-- /.text-center -->
		</div>
	</div>
	<!-- /#equipos.equipos -->

	<div class="valores" id="valores">
		<div class="container">
			<header class="header-template">
				<p><img src="img/grua.png"></p>
				<h2>Valores</h2>
				<p class="text-center">Hemos forjado un personal con el compromiso de brindar la mejor calidad de servicios a través de nuestros valores:</p>
			</header>
			<ul class="list">
				<li class="item">Responsabilidad</li>
				<li class="item">Puntualidad</li>
				<li class="item">Calidad</li>
				<li class="item">Trabajo en equipo</li>
				<li class="item">Comunicación</li>
				<li class="item">Profesionalismo</li>
				<li class="item">Seguridad</li>
				<li class="item">Eficiencia</li>
				<li class="item">Confianza</li>
				<li class="item">Honradez</li>
			</ul>
			<!-- /.list -->
		</div>
	</div>
	<!-- /#valores.valores -->

	<div class="caracteristicas" id="caracteristicas">
		<div class="container">
			<header class="header-template">
				<p><img src="img/grua.png"></p>
				<h2>Catacterísticas de servicios que se ofrece</h2>
			</header>

			<ul class="list">
				<li class="item">
					<h4 class="title">Asistencia víal</h4>
					<!-- /.title -->
					<div class="content">
						<p>Grúas Express brinda el servicio de cambio de llanta, paso de corriente, suministro de gasolina y/o diesel.</p>
					</div>
					<!-- /.content -->
				</li>
				<li class="item">
					<h4 class="title">Traslado</h4>
					<!-- /.title -->
					<div class="content">
						<p>Grúas Express realiza los servicios mediante convenios con aseguradoras y/o de forma particular. Se realizan traslados de vehículo de cualquier capacidad dentro y fuera de la ciudad de Tuxtla Gutiérrez.</p>
					</div>
					<!-- /.content -->
				</li>
				<li class="item">
					<h4 class="title">Maniobra</h4>
					<!-- /.title -->
					<div class="content">
						<p>Se le llama maniobra a cualquier servicio donde la unidad a mover presente dificultades para poder engancharlo. (volcado, cuneteado, etc.)</p>
					</div>
					<!-- /.content -->
				</li>
				<li class="item">
					<h4 class="title">Horario</h4>
					<!-- /.title -->
					<div class="content">
						<p>Grúas Express del Sureste labora las 24 horas del día, los 365 días del año.</p>
					</div>
					<!-- /.content -->
				</li>
			</ul>
			<!-- /.list -->
		</div>
	</div>
	<!-- /.caracteristicas -->

	<div class="seguros" id="seguros">
		<div class="container">
			<header class="header-template">
				<p><img src="img/grua.png"></p>
				<h2>Seguros</h2>
				<p class="text-center">
					Empresas aseguradoras con las que Grúas Express Del Sureste tienen convenio:
				</p>
				<!-- /.text-center -->
			</header>
			<ul class="list">
				<li class="item">AXA Seguros</li>
				<li class="item">Más Asistencia</li>
				<li class="item">Asociación Mexicana Automovilística </li>
				<li class="item">Seguros IKE</li>
				<li class="item">Qualitas Compañía de Seguros</li>
				<li class="item">Seguros México Asistencia</li>
				<li class="item">Inbursa Seguros</li>
				<li class="item">Multiasistencia</li>
				<li class="item">GNP seguros</li>
			</ul>
			<!-- /.list -->
		</div>
	</div>
	<!-- /#seguros.seguros -->

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
							<h2>Contacto</h2>
						</header>

						<div class="content">
							<p>Gracias por visitarnos, esperamos que todas sus dudas fueran resuletas, para más información llene el formulario, o le dejamos los datos de contacto un poco más abajo.</p>
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
