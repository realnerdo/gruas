<div class="menu-admin">

	<?php

		$categorias = array(

			array(

				"id" => "inicio",

				"nombre" => "Inicio",

				"paginas" => array(

					array("titulo" => "Inicio", "link" => "index.php")

				),
				"permisos" => "1"

			),



			array(

				"id" => "contenido",

				"nombre" => "Contenido",

				"paginas" => array(

					array("titulo" => "Secciones", "link" => "pageSecciones.php"),

					array("titulo" => "Paginas", "link" => "pagePaginas.php"),

					array("titulo" => "Enlaces", "link" => "pageLinks.php"),

					array("titulo" => "Banners", "link" => "pageSliders.php"),

					array("titulo" => "Bloques custom", "link" => "pageBloqueEstatico.php"),

					array("titulo" => "Ubicaciones", "link" => "pageUbicaciones.php")

				),



				"permisos" => "1"

			),



			array(

				"id" => "servicios",

				"nombre" => "Servicios",

				"paginas" => array(

					array("titulo" => "Secciones", "link" => "pageSeccionesServicios.php"),

					array("titulo" => "Contenido", "link" => "pageServicios.php")

				),



				"permisos" => "1"

			),


			array(

				"id" => "faqs",

				"nombre" => "Preguntas Frecuentes",

				"paginas" => array(

					array("titulo" => "Contenido", "link" => "pagePreguntasFrecuentes.php")

				),



				"permisos" => "1"

			),



			array(

				"id" => "usuarios",

				"nombre" => "Usuarios",

				"paginas" => array(

					array("titulo" => "Usuarios","link" => "pageUsuarios.php")

				),
				"permisos" => "1"

			),



			array(

				"id" => "configuracion",

				"nombre" => "Configuraci&oacute;n",

				"paginas" => array(

					array("titulo" => "Configuraci&oacute;n General","link" => "pageConfigura.php")

				),



				"permisos" => "1"

			)

		);

		printMenu($categorias, $_SESSION['user']);

	?>

</div><!--fin #menu-admin-->
