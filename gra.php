<?php

	session_start();
	
	if(!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
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

<?php

	echo '<p><b>Witaj '.$_SESSION['user'].'!</b> <a href="logout.php">[Wyloguj się!]</a></p>';
	echo '<p><b>Drewno</b>: '.$_SESSION['drewno'];
	echo '|<b>Kamień</b>: '.$_SESSION['kamien'];
	echo '|<b>Zboże</b>: '.$_SESSION['zboze'];
	echo '<p><b>E-mail</b>: '.$_SESSION['email'];
	echo '<br /><b>Dni premium</b>:'.$_SESSION['dnipremium'].'</p><br /> <br />';
	
	echo 'Budynki:<br />';
	echo '<a href="ratusz.php">Ratusz lvl '.$_SESSION['ratuszLvl'].'<br />';
	echo '<a href="spichlerz.php">Spichlerz lvl '.$_SESSION['spichlerzLvl'].'<br />';
	echo '<a href="koszary.php">Koszary lvl '.$_SESSION['koszaryLvl'].'<br />';
	echo '<a href="tartak.php">Tartak lvl '.$_SESSION['tartakLvl'].'<br />';
	echo '<a href="kamieniolom.php">Kamieniołom lvl '.$_SESSION['kamieniolomLvl'].'<br />';
	echo '<a href="farma.php">Farma lvl '.$_SESSION['farmaLvl'].'<br />';
	
?>

</body>
</html>