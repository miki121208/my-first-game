<?php

	session_start();	
	
	if(((!isset($_POST['login'])) || (!isset($_POST['password'])))&&(!isset($_SESSION['user'])))
	{
		header('Location: index.php');
		exit();
	}
	
	require_once "connect.php";
	
	mysqli_report(MYSQLI_REPORT_STRICT);
	
	try
	{
		$connection = new mysqli($host, $db_user, $db_password, $db_name);
		
		if ($connection->connect_errno!=0)
		{
			throw new Exception(mysqli_connection_errno());
		}
		else
		{
			if((isset($_POST['login'])) || (isset($_POST['password'])))
			{
				$_SESSION['login'] = $_POST['login'];
				$_SESSION['password'] = $_POST['password'];
				$_SESSION['login'] = htmlentities($_SESSION['login'], ENT_QUOTES, "UTF-8");
			}
		
			$result = $connection->query(sprintf("SELECT * FROM users WHERE user='%s'",
			mysqli_real_escape_string($connection,$_SESSION['login'])));
			
			if(!$result) throw new Exception ($connection->error);
			
			$users_count = $result->num_rows;
			if($users_count>0)
			{
				$usersTab = $result->fetch_assoc();
				
				$id = $usersTab['id'];
				
				for($i=0;$i<6;$i++)
				{
					$results[$i] = $connection->query("SELECT * FROM users_buildings WHERE user_id = $id AND building_id = $i+1");
			
					if(!$results[$i]) throw new Exception ($connection->error);
					
					$buildingsTab[$i] = $results[$i]->fetch_assoc();
				}
				if(password_verify($_SESSION['password'], $usersTab['pass']))
				{
					$_SESSION['zalogowany'] = true;
					$_SESSION['id'] = $usersTab['id'];
					$_SESSION['user'] = $usersTab['user'];
					$_SESSION['drewno'] = $usersTab['drewno'];
					$_SESSION['kamien'] = $usersTab['kamien'];
					$_SESSION['zboze'] = $usersTab['zboze'];
					$_SESSION['email'] = $usersTab['email'];
					$_SESSION['dnipremium'] = $usersTab['dnipremium'];
					
					$_SESSION['ratuszID'] = $buildingsTab[0]['building_id'];
					$_SESSION['ratuszLvl']= $buildingsTab[0]['building_lvl'];
					$_SESSION['spichlerzID']= $buildingsTab[1]['building_id'];
					$_SESSION['spichlerzLvl']= $buildingsTab[1]['building_lvl'];
					$_SESSION['koszaryID']= $buildingsTab[2]['building_id'];
					$_SESSION['koszaryLvl']= $buildingsTab[2]['building_lvl'];
					$_SESSION['tartakID']= $buildingsTab[3]['building_id'];
					$_SESSION['tartakLvl']= $buildingsTab[3]['building_lvl'];
					$_SESSION['kamieniolomID']= $buildingsTab[4]['building_id'];
					$_SESSION['kamieniolomLvl']= $buildingsTab[4]['building_lvl'];
					$_SESSION['farmaID']= $buildingsTab[5]['building_id'];
					$_SESSION['farmaLvl']= $buildingsTab[5]['building_lvl'];
					
					unset($_SESSION['loginError']);
					$result->free_result();
					for($i=0;$i<6;$i++)
						$results[$i]->free_result();
					header('Location: gra.php');
				}
				else
				{
					$_SESSION['loginError'] = '<span style="color: red;">Nieprawidłowy login lub hasło!</span>';
					header('Location: index.php');
				}
			}
			else
			{
				$_SESSION['loginError'] = '<span style="color: red;">Nieprawidłowy login lub hasło!</span>';
				header('Location: index.php');
			}
		}
		$connection->close();
	}
	catch(Exception $e)
	{
		echo '<span class="error">Błąd serwera! Prosimy spróbować później.</span>';
		echo '<br /> Informacja developerska: '.$e;
	}
?>