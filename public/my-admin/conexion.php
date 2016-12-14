<?php
	$host = "localhost";

	$db = "scotchbox";
	$user = "root";
	$pass = "root";

	try{
		@$conexion = mysql_connect($host,$user,$pass);

		if($conexion === false):
			throw new Exception("Por favor intenta m&aacute;s tarde.");
		endif;

		mysql_select_db($db, $conexion);
		mysql_query("SET NAMES 'utf8'");
		mysql_query("SET lc_time_names = 'es_MX'");

	}catch(Exception $e){
		$error = die("<div align=\"center\"><h2>" . $e->getMessage() . ''."</h2></div>\n");
		echo $error;
	}
?>
