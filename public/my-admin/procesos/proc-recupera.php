<?php
	if(!empty($_POST['btn_acceder'])):
			$login = str_replace("'", "", str_replace(" ", "", $_POST['login']));
			if($result && mysql_num_rows($result)==1):
				$mail = new PHPMailer();
				<html>
				$mail->Body = $body;
				if($mail->Send()):