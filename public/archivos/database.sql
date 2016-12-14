# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.46-0ubuntu0.14.04.2)
# Database: scotchbox
# Generation Time: 2016-12-14 20:44:48 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table ctlg_bitacora
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ctlg_bitacora`;

CREATE TABLE `ctlg_bitacora` (
  `idEntrada` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `idUser` bigint(20) unsigned NOT NULL,
  `operacion` longtext NOT NULL,
  `fecha` datetime NOT NULL,
  PRIMARY KEY (`idEntrada`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table ctlg_categorias
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ctlg_categorias`;

CREATE TABLE `ctlg_categorias` (
  `idCat` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'identificador de la categoria',
  `idCatPadre` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT 'identificador de la categoria padre',
  `titulo_esp` varchar(4096) NOT NULL COMMENT 'nombre de la categoria esp',
  `titulo_eng` varchar(4096) DEFAULT NULL,
  `contenido_esp` longtext,
  `contenido_eng` longtext,
  `resumen_esp` text,
  `resumen_eng` text,
  `slug` varchar(4096) NOT NULL,
  `tipo` varchar(16) NOT NULL DEFAULT '' COMMENT 'tipo de la categoria',
  `orden` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'indica el orden de los elementos',
  `estatus` varchar(1) NOT NULL DEFAULT '0',
  `opciones` longtext,
  `mostrarEn` varchar(45) DEFAULT NULL,
  `keywords` text,
  `fechaPublicacion` datetime NOT NULL,
  `fechaModificacion` datetime NOT NULL,
  `fechaFinal` datetime NOT NULL,
  PRIMARY KEY (`idCat`),
  KEY `slug` (`slug`(255)),
  KEY `idCatPadre` (`idCatPadre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='contiene informacion sobre las categorias';

LOCK TABLES `ctlg_categorias` WRITE;
/*!40000 ALTER TABLE `ctlg_categorias` DISABLE KEYS */;

INSERT INTO `ctlg_categorias` (`idCat`, `idCatPadre`, `titulo_esp`, `titulo_eng`, `contenido_esp`, `contenido_eng`, `resumen_esp`, `resumen_eng`, `slug`, `tipo`, `orden`, `estatus`, `opciones`, `mostrarEn`, `keywords`, `fechaPublicacion`, `fechaModificacion`, `fechaFinal`)
VALUES
	(1,0,'Sin Categoría',NULL,'',NULL,'',NULL,'sin-categoria','section',0,'','','','','0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(2,0,'Menu Principal',NULL,'',NULL,'',NULL,'menu-header','menu',0,'','','','','0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(7,1,'Equipos','Equipos','<p>Actualmente, Gr&uacute;as Express del Sureste, cuenta con las siguientes unidades para el servicio a sus clientes:</p>\r\n','','','','equipos','section-services',0,'1','a:3:{s:13:\"bloque-custom\";a:1:{i:0;s:0:\"\";}s:5:\"metas\";a:2:{s:8:\"keywords\";s:123:\"<br /><b>Notice</b>:  Undefined index: metas in <b>/var/www/public/my-admin/widgets/metatags.php</b> on line <b>5</b><br />\";s:11:\"description\";s:124:\"<br /><b>Notice</b>:  Undefined index: metas in <b>/var/www/public/my-admin/widgets/metatags.php</b> on line <b>10</b><br />\";}s:13:\"configuracion\";a:3:{s:8:\"template\";s:16:\"template-default\";s:13:\"slideshow-esp\";s:1:\"0\";s:13:\"slideshow-eng\";s:1:\"0\";}}','','','2016-12-14 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00');

/*!40000 ALTER TABLE `ctlg_categorias` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table ctlg_cats_entradas
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ctlg_cats_entradas`;

CREATE TABLE `ctlg_cats_entradas` (
  `idCat` bigint(20) unsigned NOT NULL,
  `idEntrada` bigint(20) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `ctlg_cats_entradas` WRITE;
/*!40000 ALTER TABLE `ctlg_cats_entradas` DISABLE KEYS */;

INSERT INTO `ctlg_cats_entradas` (`idCat`, `idEntrada`)
VALUES
	(2,95),
	(2,69),
	(2,96),
	(2,51),
	(1,103),
	(2,104),
	(1,5),
	(3,94),
	(3,99),
	(3,97),
	(3,100),
	(3,101),
	(3,98),
	(2,106),
	(2,108),
	(2,129),
	(2,130),
	(2,131);

/*!40000 ALTER TABLE `ctlg_cats_entradas` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table ctlg_comentarios
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ctlg_comentarios`;

CREATE TABLE `ctlg_comentarios` (
  `idComentario` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `contenido` text,
  `fechaCreacion` datetime DEFAULT NULL,
  `idEntrada` bigint(20) unsigned DEFAULT NULL,
  `tipo` varchar(45) DEFAULT NULL,
  `website` varchar(512) DEFAULT NULL,
  `estatus` varchar(1) DEFAULT '1',
  PRIMARY KEY (`idComentario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table ctlg_entradas
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ctlg_entradas`;

CREATE TABLE `ctlg_entradas` (
  `idEntrada` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'identificador de la entrada',
  `idUser` bigint(20) unsigned NOT NULL,
  `titulo_esp` varchar(4096) NOT NULL COMMENT 'titulo de la entrada esp',
  `titulo_eng` varchar(4096) DEFAULT NULL,
  `contenido_esp` longtext COMMENT 'contenido de la entrada esp',
  `contenido_eng` longtext,
  `resumen_esp` text,
  `resumen_eng` text,
  `slug` varchar(4096) NOT NULL,
  `tipo` varchar(16) NOT NULL DEFAULT '' COMMENT 'tipo de la entrada',
  `orden` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'ndica el orden de los elementos',
  `estatus` varchar(1) NOT NULL DEFAULT '0' COMMENT 'estatus de la entrada. 0:No publicado; 1:publicado',
  `opciones` longtext,
  `mostrarEn` varchar(45) DEFAULT NULL,
  `keywords` text,
  `fechaPublicacion` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'fecha de publicacion',
  `fechaModificacion` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'fecha de la ultima modificacion',
  `fechaFinal` datetime NOT NULL,
  PRIMARY KEY (`idEntrada`),
  KEY `slug` (`slug`(255)),
  KEY `idUser` (`idUser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='informacion de las entradas';

LOCK TABLES `ctlg_entradas` WRITE;
/*!40000 ALTER TABLE `ctlg_entradas` DISABLE KEYS */;

INSERT INTO `ctlg_entradas` (`idEntrada`, `idUser`, `titulo_esp`, `titulo_eng`, `contenido_esp`, `contenido_eng`, `resumen_esp`, `resumen_eng`, `slug`, `tipo`, `orden`, `estatus`, `opciones`, `mostrarEn`, `keywords`, `fechaPublicacion`, `fechaModificacion`, `fechaFinal`)
VALUES
	(5,1,'Inicio','','','','','','inicio','page',1,'1','a:3:{s:13:\"bloque-custom\";a:1:{i:0;s:0:\"\";}s:5:\"metas\";a:2:{s:8:\"keywords\";s:0:\"\";s:11:\"description\";s:0:\"\";}s:13:\"configuracion\";a:3:{s:8:\"template\";s:13:\"template-home\";s:13:\"slideshow-esp\";s:1:\"1\";s:13:\"slideshow-eng\";s:1:\"1\";}}','','','2015-04-20 00:00:00','2016-03-07 22:02:40','0000-00-00 00:00:00'),
	(70,1,'Ubicacion 1','','','','','','ubicacion-1','page-sucursal',0,'1','a:1:{s:11:\"coordenadas\";s:38:\"21.020418764184065, -89.61296796798706\";}','','','2015-12-19 00:00:00','2016-03-15 11:43:41','0000-00-00 00:00:00'),
	(102,1,'¿Qué es un panel solar?','¿Lorem ip sum is dolor is amet?','<p>Un panel solar es un m&oacute;dulo que aprovecha la energ&iacute;a de la radiaci&oacute;n solar. Los paneles fotovoltaicos est&aacute;n formados por numerosas celdas que convierten la luz en electricidad.&nbsp;</p>\r\n','','','','que-es-un-panel-solar','faq',0,'1','N;','','','2016-03-07 00:00:00','2016-03-11 13:37:51','0000-00-00 00:00:00'),
	(105,1,'¿Es rentable? ¿En cuánto tiempo recupero mi inversión?','','<p>La inversi&oacute;n se recupera a mediano plazo, y a largo plazo es rentable ya que el sistema dura hasta 25 a&ntilde;os. El tiempo de recuperaci&oacute;n depende del consumo y la tarifa en la que se encuentre.</p>\r\n','','','','es-rentable-en-cuanto-tiempo-recupero-mi-inversion','faq',0,'1','N;','','','2016-03-07 00:00:00','2016-03-11 13:38:09','0000-00-00 00:00:00'),
	(108,1,'Equipos','','','','','','link-equipos','link',1,'1','a:1:{s:3:\"url\";s:10:\"./#equipos\";}','','','2016-03-07 00:00:00','2016-12-14 20:39:24','0000-00-00 00:00:00'),
	(109,2,'¿Qué necesito para que me hagan un estudio?','','<p>Se necesita un recibo para poder hacerle un estudio y espacio suficiente en el techo para colocar los paneles.</p>\r\n','','','','que-necesito-para-que-me-hagan-un-estudio','faq',0,'1','N;','','','2016-03-11 00:00:00','2016-03-11 13:38:25','0000-00-00 00:00:00'),
	(110,2,'¿Cuánto tiempo de garantía tiene el sistema?','','<p>Los paneles solares tienen garant&iacute;a de 25 a&ntilde;os, los inversores tienen garant&iacute;a entre 5 y 10 a&ntilde;os dependiendo de la marca y la estructura de montaje que maneja SolarZone tiene garant&iacute;a de 20 a&ntilde;os.</p>\r\n','','','','cuanto-tiempo-de-garantia-tiene-el-sistema','faq',0,'1','N;','','','2016-03-11 00:00:00','2016-03-11 13:44:34','0000-00-00 00:00:00'),
	(111,2,'¿Cómo funciona?','','<p>Los paneles producen energ&iacute;a el&eacute;ctrica y al momento de consumir energ&iacute;a en el inmueble se utiliza y toda la energ&iacute;a que sobra se va a la CFE y se registra por medio de un medidor bidireccional y al corte del bimestre se hace un conteo de toda la energ&iacute;a consumida y toda la energ&iacute;a producida y se paga solamente la diferencia. (Consumo &ndash; Producci&oacute;n = Pago)</p>\r\n','','','','como-funciona','faq',0,'1','N;','','','2016-03-11 00:00:00','2016-03-11 13:44:48','0000-00-00 00:00:00'),
	(112,2,'¿Cómo se cuanta energía estoy produciendo?','','<p>Se puede medir la producci&oacute;n d&iacute;a a d&iacute;a con sistema de monitoreo y la CFE instala un medidor bidireccional en el cual se registra el consumo del inmueble y la producci&oacute;n de los paneles.</p>\r\n','','','','como-se-cuanta-energia-estoy-produciendo','faq',0,'1','N;','','','2016-03-11 00:00:00','2016-03-11 13:45:02','0000-00-00 00:00:00'),
	(113,2,'Si se va la luz puedo utilizar la energía de los paneles?','','<p>Si se va la luz el inversor se apaga por protecci&oacute;n, no se puede utilizar la energ&iacute;a de los paneles para tener luz en la casa.</p>\r\n','','','','si-se-va-la-luz-puedo-utilizar-la-energia-de-los-paneles','faq',0,'1','N;','','','2016-03-11 00:00:00','2016-03-11 13:45:14','0000-00-00 00:00:00'),
	(114,2,'¿Es deducible de impuestos?','','<p>Es 100% deducible desde el primer a&ntilde;o.</p>\r\n','','','','es-deducible-de-impuestos','faq',0,'1','N;','','','2016-03-11 00:00:00','2016-03-11 13:45:29','0000-00-00 00:00:00'),
	(115,2,'¿Qué trámites necesito hacer con CFE?','','<p>SolarZone se encarga de hacer todos los tr&aacute;mites necesarios por ti.</p>\r\n','','','','que-tramites-necesito-hacer-con-cfe','faq',0,'1','N;','','','2016-03-11 00:00:00','2016-03-11 13:45:41','0000-00-00 00:00:00'),
	(116,2,'¿Cuánto cuesta el sistema?','','<p>Al enviarnos su recibo de luz le podremos hacer un proyecto dise&ntilde;ado especialmente para usted.</p>\r\n','','','','cuanto-cuesta-el-sistema','faq',0,'1','N;','','','2016-03-11 00:00:00','2016-03-11 13:45:59','0000-00-00 00:00:00'),
	(117,2,'¿Cuál es la diferencia entre los paneles solares y una subestación o sistema de ahorro de voltaje?','','<p>La subestaci&oacute;n le permite instalar un transformador que baje el precio del Kw/h. Este producto a pesar de ser comprado por usted, ser&aacute; propiedad de CFE una vez instalado.<br />\r\nEn cambio, los paneles solares aparte de ser de su propiedad, le permitir&aacute; producir la electricidad necesaria para su casa. Usted podr&aacute; lograr una producci&oacute;n el&eacute;ctrica que le ahorrara entre 90 y 95% de su factura.</p>\r\n','','','','cual-es-la-diferencia-entre-los-paneles-solares-y-una-subestacion-o-sistema-de-ahorro-de-voltaje','faq',0,'1','N;','','','2016-03-11 00:00:00','2016-03-11 13:46:18','0000-00-00 00:00:00'),
	(118,2,'¿Puedo empezar a ahorrar solo 50% de mi factura?','','<p>Nosotros proporcionamos el sistema para ahorrar hasta 95% de su factura, pero se puede ahorrar 10, 20 o 50% en funci&oacute;n de sus necesidades.</p>\r\n','','','','puedo-empezar-a-ahorrar-solo-50%-de-mi-factura','faq',0,'1','N;','','','2016-03-11 00:00:00','2016-03-11 13:46:34','0000-00-00 00:00:00'),
	(119,2,'¿Se puede agregar paneles a mi sistema en el futuro?','','<p>S&iacute;. Esta soluci&oacute;n es ideal si desea lograr su inversi&oacute;n por etapas. Puede empezar con un sistema de 6 paneles y agregar poco a poco m&aacute;s paneles para ahorrar hasta 95% de su factura.</p>\r\n','','','','se-puede-agregar-paneles-a-mi-sistema-en-el-futuro','faq',0,'1','N;','','','2016-03-11 00:00:00','2016-03-11 13:46:47','0000-00-00 00:00:00'),
	(120,2,'¿Solo produciría electricidad en los meses calientes del año?','','<p>No, los paneles solares utilizan la radiaci&oacute;n del sol, lo cual significa que su sistema producir&aacute; energ&iacute;a durante todo el a&ntilde;o, tanto en verano como en invierno, nublado o con sol. Mientras m&aacute;s se aproveche la radiaci&oacute;n solar, m&aacute;s producen.</p>\r\n','','','','solo-produciria-electricidad-en-los-meses-calientes-del-ano','faq',0,'1','N;','','','2016-03-11 00:00:00','2016-03-11 13:47:02','0000-00-00 00:00:00'),
	(121,3,'2 grúas tipo A  F350  de 3.5 toneladas (de plataforma y wheel lift)','Lorem','','','','','<br />\r\n<b>Notice</b>:  Undefined variable: preSlug in <b>/var/www/public/my-admin/forms/form-servicio.php</b> on line <b>7</b><br />\r\n2-gruas-tipo-a-f350-de-3-5-toneladas-(de-plataforma-y-wheel-lift)','servicio',0,'1','N;','','','2016-12-14 00:00:00','2016-12-14 18:50:35','0000-00-00 00:00:00'),
	(122,3,'1 grúa tipo A Dodge Ram de 3.5 toneladas (de plataforma y wheel lift)','1 grúa tipo A Dodge Ram de 3.5 toneladas (de plataforma y wheel lift)','','','','','<br />\r\n<b>Notice</b>:  Undefined variable: preSlug in <b>/var/www/public/my-admin/forms/form-servicio.php</b> on line <b>7</b><br />\r\n1-grua-tipo-a-dodge-ram-de-3-5-toneladas-(de-plataforma-y-wheel-lift)','servicio',0,'1','N;','','','2016-12-14 00:00:00','2016-12-14 18:51:03','0000-00-00 00:00:00'),
	(123,3,'1 grúa tipo A Dodge Ram de 4.5 toneladas (de plataforma y wheel lift)','1 grúa tipo A Dodge Ram de 4.5 toneladas (de plataforma y wheel lift)','','','','','<br />\r\n<b>Notice</b>:  Undefined variable: preSlug in <b>/var/www/public/my-admin/forms/form-servicio.php</b> on line <b>7</b><br />\r\n1-grua-tipo-a-dodge-ram-de-4-5-toneladas-(de-plataforma-y-wheel-lift)','servicio',0,'1','N;','','','2016-12-14 00:00:00','2016-12-14 19:05:11','0000-00-00 00:00:00'),
	(124,3,'2 grúas tipo B de 4.5 toneladas. (de plataforma y wheel lift)','2 grúas tipo B de 4.5 toneladas. (de plataforma y wheel lift)','','','','','<br />\r\n<b>Notice</b>:  Undefined variable: preSlug in <b>/var/www/public/my-admin/forms/form-servicio.php</b> on line <b>7</b><br />\r\n2-gruas-tipo-b-de-4-5-toneladas-(de-plataforma-y-wheel-lift)','servicio',0,'1','N;','','','2016-12-14 00:00:00','2016-12-14 19:13:12','0000-00-00 00:00:00'),
	(125,3,'2 grúas tipo B de 10 toneladas (de plataforma y wheel lift)','2 grúas tipo B de 10 toneladas (de plataforma y wheel lift)','','','','','<br />\r\n<b>Notice</b>:  Undefined variable: preSlug in <b>/var/www/public/my-admin/forms/form-servicio.php</b> on line <b>7</b><br />\r\n2-gruas-tipo-b-de-10-toneladas-(de-plataforma-y-wheel-lift)','servicio',0,'1','N;','','','2016-12-14 00:00:00','2016-12-14 19:15:27','0000-00-00 00:00:00'),
	(126,3,'Historia','Example Block X','<p>Gr&uacute;as Express del Sureste S.A. de C.V. comenz&oacute; las operaciones en Junio del 2006 con solo dos gr&uacute;as de plataforma y tres empleados, dos de ellos como operadores y otro realizando toda la carga administrativa derivada de la operaci&oacute;n.</p>\r\n\r\n<p>Con el paso del tiempo y debido a que esta empresa es moderna, se adapta y crece de acuerdo a la demanda de los clientes, se ha visto obligada a invertir tanto en oficinas, con video-vigilancia y circuito cerrado, as&iacute; como en equipos. Con el paso del tiempo la empresa ha adquirido 16 gr&uacute;as y 2 remolques (tipo madrina y tipo low boy) totalmente funcionales.</p>\r\n\r\n<p>Hoy en d&iacute;a, Gr&uacute;as Express ofrece a los clientes seguridad y rapidez en el servicio, ello se logra mediante la combinaci&oacute;n del elemento humano y la tecnolog&iacute;a de vanguardia en cuanto a las gr&uacute;as, la experiencia del personal que labora hace que Gr&uacute;as Express sea una empresa confiable, de vanguardia y con una excelente actitud y disposici&oacute;n de servicio.</p>\r\n','','','','historia','static-block',0,'','a:1:{s:13:\"mostrarTitulo\";s:1:\"0\";}','','','0000-00-00 00:00:00','2016-12-14 19:55:17','0000-00-00 00:00:00'),
	(127,3,'Misión','Misión','<p>Somos una empresa profesional de gr&uacute;as que brinda servicios de excelente calidad, desde una falla mec&aacute;nica hasta un siniestro. Contando con precios accesibles y equipos actualizados de la mas alta tecnolog&iacute;a, asegurando la satisfacci&oacute;n total de nuestros clientes mediante el desarrollo profesional de nuestra gente.</p>\r\n','','','','mision','static-block',0,'','a:1:{s:13:\"mostrarTitulo\";s:1:\"0\";}','','','0000-00-00 00:00:00','2016-12-14 19:55:47','0000-00-00 00:00:00'),
	(128,3,'Visión','Visión','<p>Ser una empresa l&iacute;der en el servicio de gr&uacute;as, competente, confiable, sustentado en principios &eacute;ticos y en los avances tecnol&oacute;gicos.</p>\r\n','','','','vision','static-block',0,'','a:1:{s:13:\"mostrarTitulo\";s:1:\"0\";}','','','0000-00-00 00:00:00','2016-12-14 19:56:16','0000-00-00 00:00:00'),
	(129,3,'Valores','Valores','','','','','link-valores','link',2,'1','a:1:{s:3:\"url\";s:9:\"/#valores\";}','','','2016-12-14 00:00:00','2016-12-14 20:39:45','0000-00-00 00:00:00'),
	(130,3,'Características','Características','','','','','link-caracteristicas','link',3,'1','a:1:{s:3:\"url\";s:17:\"/#caracteristicas\";}','','','2016-12-14 00:00:00','2016-12-14 20:39:54','0000-00-00 00:00:00'),
	(131,3,'Seguros','Seguros','','','','','link-seguros','link',4,'1','a:1:{s:3:\"url\";s:9:\"/#seguros\";}','','','2016-12-14 00:00:00','2016-12-14 20:40:11','0000-00-00 00:00:00');

/*!40000 ALTER TABLE `ctlg_entradas` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table ctlg_imagenes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ctlg_imagenes`;

CREATE TABLE `ctlg_imagenes` (
  `idImagen` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `idEntrada` bigint(20) unsigned NOT NULL,
  `titulo` varchar(4096) DEFAULT NULL,
  `contenido` longtext,
  `pie_esp` text NOT NULL,
  `pie_eng` text,
  `nomArchivo` varchar(512) NOT NULL,
  `url` text NOT NULL,
  `tipo` varchar(16) NOT NULL DEFAULT '',
  `orden` float NOT NULL,
  `estatus` varchar(1) NOT NULL DEFAULT '0',
  `opciones` longtext NOT NULL,
  PRIMARY KEY (`idImagen`),
  KEY `idEntrada` (`idEntrada`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `ctlg_imagenes` WRITE;
/*!40000 ALTER TABLE `ctlg_imagenes` DISABLE KEYS */;

INSERT INTO `ctlg_imagenes` (`idImagen`, `idEntrada`, `titulo`, `contenido`, `pie_esp`, `pie_eng`, `nomArchivo`, `url`, `tipo`, `orden`, `estatus`, `opciones`)
VALUES
	(4,94,'','','','','sistemas-interconexion.jpg','','previewPage',0,'1','N;'),
	(6,97,'','','','','sistemas-sumergibles.jpg','','previewPage',0,'1','N;'),
	(8,98,'','','','','paneles-solares.jpg','','previewPage',0,'1','N;'),
	(10,99,'','','','','diseno-3d.jpg','','previewPage',0,'1','N;'),
	(12,100,'','','','','tramites.jpg','','previewPage',0,'1','N;'),
	(14,101,'','','','','garantias.jpg','','previewPage',0,'1','N;'),
	(16,94,'','','','','ico-1-p.png','','iconoServicio',0,'1','N;'),
	(17,94,'','','','','ico-1-n.png','','iconoAlternoServ',0,'1','N;'),
	(18,97,'','','','','ico-2-p.png','','iconoServicio',0,'1','N;'),
	(19,97,'','','','','ico-2-n.png','','iconoAlternoServ',0,'1','N;'),
	(20,98,'','','','','ico-3-p.png','','iconoServicio',0,'1','N;'),
	(21,98,'','','','','ico-3-n.png','','iconoAlternoServ',0,'1','N;'),
	(22,99,'','','','','ico-4-p.png','','iconoServicio',0,'1','N;'),
	(23,99,'','','','','ico-4-n.png','','iconoAlternoServ',0,'1','N;'),
	(24,100,'','','','','ico-5-p.png','','iconoServicio',0,'1','N;'),
	(25,100,'','','','','ico-5-n.png','','iconoAlternoServ',0,'1','N;'),
	(26,101,'','','','','ico-6-p.png','','iconoServicio',0,'1','N;'),
	(27,101,'','','','','ico-6-n.png','','iconoAlternoServ',0,'1','N;'),
	(28,1,'Banner 1','','','','stock-photo-loading-broken-car-on-a-tow-truck-on-a-roadside-275048402.jpg','','imageSlide',0,'1','N;');

/*!40000 ALTER TABLE `ctlg_imagenes` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table ctlg_meta_entradas
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ctlg_meta_entradas`;

CREATE TABLE `ctlg_meta_entradas` (
  `idMeta` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `idEntrada` bigint(20) unsigned NOT NULL,
  `llave` varchar(255) NOT NULL,
  `valor` longtext NOT NULL,
  PRIMARY KEY (`idMeta`),
  KEY `idEntrada` (`idEntrada`),
  CONSTRAINT `fk_meta_entrada` FOREIGN KEY (`idEntrada`) REFERENCES `ctlg_entradas` (`idEntrada`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table ctlg_sliders
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ctlg_sliders`;

CREATE TABLE `ctlg_sliders` (
  `idSlider` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id del banner',
  `titulo` varchar(4096) NOT NULL COMMENT 'titulo del banner',
  `tipo` varchar(16) NOT NULL DEFAULT 'banner',
  `estatus` varchar(1) NOT NULL DEFAULT '0' COMMENT 'Indica si es publico, 0:no, 1:si',
  `opciones` longtext NOT NULL COMMENT 'opciones del banner',
  `fechaPublicacion` datetime NOT NULL COMMENT 'fecha de publicacion del banner',
  PRIMARY KEY (`idSlider`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='contiene informacion sobre los banners';

LOCK TABLES `ctlg_sliders` WRITE;
/*!40000 ALTER TABLE `ctlg_sliders` DISABLE KEYS */;

INSERT INTO `ctlg_sliders` (`idSlider`, `titulo`, `tipo`, `estatus`, `opciones`, `fechaPublicacion`)
VALUES
	(1,'Banners Home (Esp)','slider','1','N;','2016-03-02 00:00:00');

/*!40000 ALTER TABLE `ctlg_sliders` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table ctlg_usuarios
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ctlg_usuarios`;

CREATE TABLE `ctlg_usuarios` (
  `idUser` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'identificador del usuario',
  `login` varchar(512) NOT NULL COMMENT 'nombre de pantalla del usuario',
  `password` varchar(255) NOT NULL COMMENT 'password del usuario',
  `rol` varchar(1) NOT NULL DEFAULT '2' COMMENT 'rol del usuario 0:SuperAdmin; 1:Admin; 2: Usuario',
  `nomArchivo` varchar(512) DEFAULT NULL COMMENT 'nombre de la imagen',
  `nombre` varchar(512) NOT NULL COMMENT 'nombre real del usuario',
  `apellido` varchar(512) NOT NULL COMMENT 'apellidos del usuario',
  `email` varchar(512) NOT NULL COMMENT 'correo electronico del usuario',
  `fecha` date NOT NULL COMMENT 'fecha de nacimiento',
  `empresa` varchar(512) DEFAULT NULL COMMENT 'nombre de la emrpesa',
  `telefono` varchar(45) DEFAULT NULL COMMENT 'telefono del usuario',
  `ciudad` varchar(45) DEFAULT NULL COMMENT 'ciudad del usuario',
  `estado` varchar(45) DEFAULT NULL COMMENT 'estado en donde habita el usuario',
  `pais` varchar(45) DEFAULT NULL COMMENT 'pais en donde habita el usuario',
  `direccion` varchar(512) DEFAULT NULL COMMENT 'direccion del usuario',
  `comentarios` text COMMENT 'comentarios acerca del usuario',
  PRIMARY KEY (`idUser`),
  KEY `login` (`login`(255))
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='continene la informacion de los usuarios';

LOCK TABLES `ctlg_usuarios` WRITE;
/*!40000 ALTER TABLE `ctlg_usuarios` DISABLE KEYS */;

INSERT INTO `ctlg_usuarios` (`idUser`, `login`, `password`, `rol`, `nomArchivo`, `nombre`, `apellido`, `email`, `fecha`, `empresa`, `telefono`, `ciudad`, `estado`, `pais`, `direccion`, `comentarios`)
VALUES
	(1,'elros','d033e22ae348aeb5660fc2140aec35850c4da997','1','','Aaron','Lopez','neochronos@gmail.com','0000-00-00','','','','','','',''),
	(2,'erivero','d033e22ae348aeb5660fc2140aec35850c4da997','1','','Erik','Rivero','erivero@grupoendor.com','0000-00-00','','','','','','',''),
	(3,'admin','d033e22ae348aeb5660fc2140aec35850c4da997','1','','Admin','Grúas','asaelx@gmail.com','0000-00-00','','','','','','','');

/*!40000 ALTER TABLE `ctlg_usuarios` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
