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
	echo '<a href="logout.php">[Wyloguj się!]</a></p>';
	echo '<p><b>Drewno</b>: '.$_SESSION['drewno'];
	echo '|<b>Kamień</b>: '.$_SESSION['kamien'];
	echo '|<b>Zboże</b>: '.$_SESSION['zboze'];
	echo '<p><b>E-mail</b>: '.$_SESSION['email'];
	echo '<br /><b>Dni premium</b>:'.$_SESSION['dnipremium'].'</p>';
	echo '<a href="gra.php">Wioska '.$_SESSION['user'].'</a><br /> <br />';
	
	echo 'Budynki:<br />';
	echo '<a href="kamieniolom.php">Kamieniolom</a> lvl '.$_SESSION['kamieniolomLvl'];
	if($_SESSION['kamieniolomLvl']<10)
	{
		echo'<form method="POST"><input type="submit" name="kamieniolomUpgrade" value="Ulepsz" /> ';
		if(isset($_POST['kamieniolomUpgrade']))
		{
			if(($_SESSION['drewno']>=($_SESSION['kamieniolomLvl']*100))&&($_SESSION['kamien']>=($_SESSION['kamieniolomLvl']*100)))
			{
				require_once "connect.php";
				
				mysqli_report(MYSQLI_REPORT_STRICT);
				
				try
				{
					$connection = new mysqli($host, $db_user, $db_password, $db_name);
					
					if ($connection->connect_errno!=0)
					{
						throw new Exception(mysqli_connection_errno());
					}
					
					$user_id = $_SESSION['id'];
					$building_id = $_SESSION['kamieniolomID'];
					
					if($connection->query("UPDATE users_buildings SET building_lvl = building_lvl+1 WHERE user_id = '$user_id' AND building_id = '$building_id'"))
					{
						header('Location: login.php');
					}
					else
					{
						throw new Exception($connection->error);
					}
				}
				catch(Exception $e)
				{
					echo '<span class="error">Błąd serwera! Prosimy spróbować później.</span>';
					echo '<br /> Informacja developerska: '.$e;
				}
			}
			else
			{
				echo '<span style="color: red;">Masz za mało surowców</span>';
			}
		}
	}
	echo '</form><br />';
	echo 'Opis';
?>

</body>
</html>