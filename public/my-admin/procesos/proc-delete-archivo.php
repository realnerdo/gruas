<?php
	if(!isset($_SESSION['user']) || $_SESSION['user']['acceso']!='cpanel'):
		$hid = $_GET['hid'];
		if($resultFile && mysql_num_rows($resultFile)):