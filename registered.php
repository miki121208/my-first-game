<?php

	session_start();

	if(!isset($_SESSION['registrationOK']))
	{
		header('Location: index.php');
		exit();
	}
	else
	{
		unset($_SESSION['registrationOK']);
	}
	
	if(isset($_SESSION['s_login'])) unset($_SESSION['s_login']);
	if(isset($_SESSION['s_password1'])) unset($_SESSION['s_password1']);
	if(isset($_SESSION['s_password2'])) unset($_SESSION['s_password2']);
	if(isset($_SESSION['s_email'])) unset($_SESSION['s_email']);
	if(isset($_SESSION['s_rules'])) unset($_SESSION['s_rules']);
	
	if(isset($_SESSION['e_login'])) unset($_SESSION['e_login']);
	if(isset($_SESSION['e_password'])) unset($_SESSION['e_password']);
	if(isset($_SESSION['e_email'])) unset($_SESSION['e_email']);
	if(isset($_SESSION['e_rules'])) unset($_SESSION['e_rules']);
	if(isset($_SESSION['e_recaptcha'])) unset($_SESSION['e_recaptcha']);
	
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IEedge,chrome=1" />
	<link rel="stylesheet" type="text/css" href="style.css" />
	<title>Wojownicy - gra przeglądarkowa</title>
</head>

<body>
	
	Dziekujemy za rejestrację! Możesz się już zalogować na swoje konto!<br /><br />
	
	<a href="index.php">Zaloguj się</a><br /><br />
	
</body>
</html>