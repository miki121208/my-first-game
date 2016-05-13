<?php

	session_start();

	if((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
	{
		header('Location: gra.php');
		exit();
	}
	
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

	Tylko martwi ujrzeli koniec wojny - Platon<br /><br />
	<a href="register.php">Rejestracja</a>
	
	<form action="login.php" method="post">

		Login: <br /> <input type="text" name="login" /> <br />
		Hasło: <br /> <input type="password" name="password" /> <br /> <br />
		<input type="submit" value="zaloguj się" />

	</form>
<?php
	if (isset($_SESSION['loginError']))
	echo $_SESSION['loginError'];
?>
</body>
</html>