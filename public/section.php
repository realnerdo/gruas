<?php
	switch($opcionesTemplate['configuracion']['template']):;
		case "template-page":
			$includeTemplate = "templates/page/default.php";
		break;
		case "template-default":
		default:
			$includeTemplate = "templates/seccion/default.php";
		break;
	endswitch;
?>
<?php include($includeTemplate);?>
