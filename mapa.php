//na razie tworzy jedynie pustą mapę
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
		$W = 100;
		$S = 100;
	
		echo '
		<table class="map">';
			for($i=0;$i<$W;$i++)
			{

				echo '
			<tr>';
				if($i%2)
				{
					for($j=0;$j<$S;$j++)
						echo '
				<td class="mapF">
				</td>
					';
				
				}
				else
					for($j=0;$j<$S;$j++)
						echo '
				<td class="mapF">
				</td>
					';			
					echo '
			</tr>';
			}
			echo '
		</table>';
	?>

</body>
</html>