<?php
	if(!isset($_SESSION['user']) || $_SESSION['user']['acceso']!='cpanel'):
		$fp = fopen("../config.php", "w");
		if($fp):
	/*volvemos a la pagina*/