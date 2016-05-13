<?php
	session_start();
	
	if(isset($_POST['login']))
	{
		
		$OK = true;
		
		$login = $_POST['login'];
		
		if((strlen($login)<3) || (strlen($login)>20))
		{
			$OK = false;
			$_SESSION['e_login'] = "Login musi mieć od 3 do 20 znaków";
		}
		
		if(!ctype_alnum($login))
		{
			$OK=false;
			$_SESSION['e_login'] = "Login musi składać się tylko z cyfr i liter (bez polskich znaków)";
		}
		
		$password1 = $_POST['password1'];
		$password2 = $_POST['password2'];
		
		if((strlen($password1)<8) || (strlen($password1)>20))
		{
			$OK=false;
			$_SESSION['e_password'] = "Hasło musi mieć od 8 do 20 znaków";
		}
		
		if($password1!=$password2)
		{
			$OK=false;
			$_SESSION['e_password'] = "Podane hasła nie są identyczne";
		}
		
		$password_hash = password_hash($password1, PASSWORD_DEFAULT);
		
		$email = $_POST['email'];
		$emailS = filter_var($email, FILTER_SANITIZE_EMAIL);
		
		if((!filter_var($emailS, FILTER_VALIDATE_EMAIL)) || ($emailS!=$email))
		{
			$OK=false;
			$_SESSION['e_email'] = "Podaj poprawny adres e-mail";
		}
		
		if(!isset($_POST['rules']))
		{
			$OK=false;
			$_SESSION['e_rules'] = "Zaakceptuj regulamin";
		}
		
		$secret = "6LdPwx4TAAAAAMT-9cTcLQwXdIs-KII-yFmAWVuJ";
		
		$secretCheck = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
		
		$secretResponse = json_decode($secretCheck);
		
		if(!($secretResponse->success))
		{
			$OK=false;
			$_SESSION['e_recaptcha'] = "Potwierdź, że nie jesteś botem";
		}
		
		$_SESSION['s_login'] = $login;
		$_SESSION['s_email'] = $email;
		$_SESSION['s_password1'] = $password1;
		$_SESSION['s_password2'] = $password2;
		if(isset($_POST['rules'])) $_SESSION['s_rules'] = true;
		
		require_once "connect.php";
		
		mysqli_report(MYSQLI_REPORT_STRICT);
		
		try
		{
			$connection = new mysqli($host, $db_user, $db_password, $db_name);
			if ($connection->connect_errno!=0)
			{
				throw new Exception(mysqli_connect_errno());
			}
			else
			{
				$result = $connection->query("SELECT id FROM users WHERE user = '$login'");
				
				if(!$result) throw new Exception ($connection->error);
				
				$login_count = $result->num_rows;
				if($login_count>0)
				{
					$OK=false;
					$_SESSION['e_login'] = "Istnieje już konto z tym loginem";
				}
				
				$result = $connection->query("SELECT id FROM users WHERE email = '$email'");
				
				if(!$result) throw new Exception ($connection->error);
				
				$email_count = $result->num_rows;
				if($email_count>0)
				{
					$OK=false;
					$_SESSION['e_email'] = "Istnieje już konto z tym adresem e-mail";
				}
				
				if($OK)
				{
					if($connection->query("INSERT INTO users VALUES (NULL, '$login', '$password_hash', '$email', 100, 100, 100, 7)"))
					{
						$result = $connection->query("SELECT id FROM users WHERE user = '$login'");
						
						if(!$result) throw new Exception ($connection->error);
						
						$id = $result->fetch_assoc();
						$max_id = $id['id'];
						for($i=1;$i<=6;$i++) if($connection->query("INSERT INTO users_buildings VALUES ($max_id, $i, 1)"))
						{
								$_SESSION['registrationOK'] = true;
								$result->free_result();
								header('Location: registered.php');
						}
						else
						{
							throw new Exception($connection->error);
						}
					}
					else
					{
						throw new Exception($connection->error);
					}
				}
				
				$connection->close();
			}
		}
		catch(Exception $e)
		{
			echo '<span class="error">Błąd serwera! Prosimy spróbować później.</span>';
			echo '<br /> Informacja developerska: '.$e;
		}
	}
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IEedge,chrome=1" />
	<link rel="stylesheet" type="text/css" href="style.css" />
	<title>Wojownicy - gra przeglądarkowa</title>
	<script src='https://www.google.com/recaptcha/api.js'></script>
</head>

<body>

	Tylko martwi ujrzeli koniec wojny - Platon<br /><br />
	<a href="index.php">Logowanie</a>
	
	<form method="post">

		Login: <br /> <input type="text" value="<?php
			if(isset($_SESSION['s_login']))
			{
				echo $_SESSION['s_login'];
				unset($_SESSION['s_login']);
			}
		?>" name="login" /> <br />
		
		<?php
			if(isset($_SESSION['e_login']))
			{
				echo '<div class="error">'.$_SESSION['e_login'].'</div>';
				unset($_SESSION['e_login']);
			}
		?>
		
		Hasło: <br /> <input type="password" value="<?php
			if(isset($_SESSION['s_password1']))
			{
				echo $_SESSION['s_password1'];
				unset($_SESSION['s_password1']);
			}
		?>" name="password1" /> <br />
		
		<?php
			if(isset($_SESSION['e_password']))
			{
				echo '<div class="error">'.$_SESSION['e_password'].'</div>';
				unset($_SESSION['e_password']);
			}
		?>
		
		Powtórz hasło: <br /> <input type="password" value="<?php
			if(isset($_SESSION['s_password2']))
			{
				echo $_SESSION['s_password2'];
				unset($_SESSION['s_password2']);
			}
		?>" name="password2" /> <br />
		E-mail: <br /> <input type="text" value="<?php
			if(isset($_SESSION['s_email']))
			{
				echo $_SESSION['s_email'];
				unset($_SESSION['s_email']);
			}
		?>" name="email" /><br />
		
		<?php
			if(isset($_SESSION['e_email']))
			{
				echo '<div class="error">'.$_SESSION['e_email'].'</div>';
				unset($_SESSION['e_email']);
			}
		?>
		
		<label>
			<input type="checkbox" name="rules" <?php
			if(isset($_SESSION['s_rules']))
			{
				echo "checked";
				unset($_SESSION['s_rules']);
			}
			?>/> Akceptuję regulamin <br />
		</label>
		
		<?php
			if(isset($_SESSION['e_rules']))
			{
				echo '<div class="error">'.$_SESSION['e_rules'].'</div>';
				unset($_SESSION['e_rules']);
			}
		?>
		
		<div class="g-recaptcha" data-sitekey="6LdPwx4TAAAAAPakZx0UaWleoBna5CVFtp6xQ5DZ"></div>
		
		<?php
			if(isset($_SESSION['e_recaptcha']))
			{
				echo '<div class="error">'.$_SESSION['e_recaptcha'].'</div>';
				unset($_SESSION['e_recaptcha']);
			}
		?>
		
		<input type="submit" value="zarejestruj się" />
		
	</form>
</body>
</html>