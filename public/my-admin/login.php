<?php
	if(isset($_SESSION['user']) and $_SESSION['user']['rol']<=2 and isset($_SESSION['user']['acceso']) and $_SESSION['user']['acceso']=='cpanel'):
		<div class="login">
			<div class="info-proceso <?php if(!isset($_SESSION['resultado'])): echo "hide"; else: echo $_SESSION['resultado']['clase']. " ocultaMsj "; endif;?>">
			<form action="procesos/proc-login.php" method="post" onsubmit="return valLogin()">