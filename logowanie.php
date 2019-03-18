<?php
SESSION_START();

if((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
{
	header('Location: panel.php');
	exit();
}

if(isset($_POST['email']))
{
	//Zakladamy ze wszystko jest ok
	$wszystko_ok=true;
	//Sprawdzamy email
	$email=$_POST['email'];
	$emailB = filter_var($email,FILTER_SANITIZE_EMAIL);
	
	if((filter_var($emailB,FILTER_VALIDATE_EMAIL)==false) || ($emailB!=$email))
	{
		$wszystko_ok=false;
		$_SESSION['e_email']='podaj poprawny adres email';
	}
	//Sprawdzenie poprawnosci hasła
	$haslo1=$_POST['haslo1'];
	$haslo2=$_POST['haslo2'];
	
	if((strlen($haslo1)<8) || (strlen($haslo1)>20))
	{
		$wszystko_ok=false;
		$_SESSION['e_haslo']='haslo musi posiadac od 8 do 20 znaków';
	}
	if($haslo1!=$haslo2)
	{
		$wszystko_ok=false;
		$_SESSION['e_haslo']='padane hasła róznią się';
	}
	//hashowanie hasła
	$haslo_hash = password_hash($haslo1,PASSWORD_DEFAULT);
	//Sprawdziamy czy został zaakceptowany regulamin
	if(!isset($_POST['regulamin']))
	{
		$wszystko_ok=false;
		$_SESSION['e_regulamin']='Powtierdź akceptacje regulaminu';
	}
	//Sparawdzanie captchy
	$sekret='6Ld5VYIUAAAAAMRyIX4c9_tseQSF_vYb3thZGTY4';
	
	
	$sprawdz = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$sekret.'&response='.$_POST['g-recaptcha-response']);
	
	$odpowiedz = json_decode($sprawdz);
	
	if($odpowiedz->success==false)
	{
		$wszystko_ok=false;
		$_SESSION['e_captcha']='powtierdź captche';
	}
	
			$imie=$_POST['imie'];
			$nazwisko=$_POST['nazwisko'];
			$ulica=$_POST['ulica'];
			$mieszkanie=$_POST['mieszkanie'];
			$kod=$_POST['kod'];
			$kraj=$_POST['kraj'];
	
	//Zapamiętajmy wpisane dane
	$_SESSION['pamietaj_email']=$email;
	$_SESSION['pamietaj_haslo1']=$haslo1;
	$_SESSION['pamietaj_haslo2']=$haslo2;
	$_SESSION['pamietaj_imie']=$imie;
	$_SESSION['pamietaj_nazwisko']=$nazwisko;
	$_SESSION['pamietaj_ulica']=$ulica;
	$_SESSION['pamietaj_mieszkanie']=$mieszkanie;
	$_SESSION['pamietaj_kod']=$kod;
	$_SESSION['pamietaj_kraj']=$kraj;
	if(isset($_POST['regulamin'])) $_SESSION['pamietaj_regulamin']=true;
	
	require_once "connect.php";
	mysqli_report(MYSQLI_REPORT_STRICT);
	
	try
	{
		$polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);
		
		if($polaczenie->connect_errno!=0)
		{
		throw new Exception(mysqli_connect_errno());
		}
		else
		{
			//Czy email juz istnieje?
			$rezultat = $polaczenie->query("SELECT id FROM uzytkownicy WHERE email='$email'");
			
			if(!$rezultat) throw new Exception($polaczenie->error);
			
			$ile_maili = $rezultat->num_rows;
			
			if($ile_maili>0)
			{
				$wszystko_ok=false;
				$_SESSION['e_email']='Istnieje juz konto o takim adresie email';
			}
			
			if($wszystko_ok==true)
				{
				//Wszystko poszło sprawnie mozemy dodac nowego uzytkownika
				if($polaczenie->query("INSERT INTO uzytkownicy VALUES (NULL,'$email','$haslo_hash','$imie','$nazwisko','$ulica','$mieszkanie','$kod','$kraj')"))
				{
					$_SESSION['udanarejestracja']=true;
					header('Location: witamy.php');
				}
				else
				{
					throw new Exception($polaczenie->error);
				}
				}
			$polaczenie->close();	
			}
			}
			catch(Exception $e)
			{
			echo '<span style="color:red;">Błąd serwera</span>';
			echo '<br>Informacja developrera: '.$e;
			}
		}
?>
<!DOCTYPE html>
<html lang="pl">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, minimum-scale=1.0">
	<title>Logowanie i rejestracja</title>
	<link rel="shortcut icon" href="img/basketball.png" />
	<link rel="stylesheet" href="logowanie.css">
	<link href="https://fonts.googleapis.com/css?family=Bangers|Paytone+One&amp;subset=latin-ext" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
	<script src='https://www.google.com/recaptcha/api.js'></script>
</head>

<body>
	<a href="index.php"><i class="fas fa-home"></i> Strona główna</a>

	<div class="logowanie">

		<span class="ikona"><i class="fas fa-user-check"></i></span>
		<form class="logowanie" action="zaloguj.php" method="post">
			<h1>Logowanie</h1>
			E-mail: <br>
			<input type="text" name="email"><br>
			Hasło:<br>
			<input type="password" name="haslo"><br>
			<input class="potwierdz" type="submit" value="Zaloguj się"><br>
			<?php
	if(isset($_SESSION['blad']))
	{
	echo $_SESSION['blad'];
	}
	?>
		</form>

	</div>

	<div class="rejestracja">
		<span class="ikona"><i class="fas fa-user-plus"></i></i></span>

		<form class="rejestracja" action="" method="post">
			<h1>Rejestracja</h1>
			E-mail: <br>
			<input type="text" name="email" value="<?php if(isset($_SESSION['pamietaj_email']))
{
	echo $_SESSION['pamietaj_email'];
	unset($_SESSION['pamietaj_email']);
}?>"><br>
			<?php
		if(isset($_SESSION['e_email']))
		{
			echo'<div class="error">'.$_SESSION['e_email'].'</div>';
			unset($_SESSION['e_email']);
		}
		?>
			Hasło:<br>
			<input type="password" name="haslo1" value="<?php
					if(isset($_SESSION['pamietaj_haslo1']))
					{
					echo $_SESSION['pamietaj_haslo1'];
					unset($_SESSION['pamietaj_haslo1']);
					}
					?>"><br>
			<?php
		if(isset($_SESSION['e_haslo']))
		{
			echo'<div class="error">'.$_SESSION['e_haslo'].'</div>';
			unset($_SESSION['e_haslo']);
		}
		?>
			Powtórz hasło: <br>
			<input type="password" name="haslo2" value="<?php if(isset($_SESSION['pamietaj_haslo2'])){echo $_SESSION['pamietaj_haslo2'];unset($_SESSION['pamietaj_haslo2']);}?>"><br>
			Imię: <br>
			<input type="text" name="imie" value="<?php
					if(isset($_SESSION['pamietaj_imie']))
					{
					echo $_SESSION['pamietaj_imie'];
					unset($_SESSION['pamietaj_imie']);
					}
					?>"><br>
			Nazwisko: <br>
			<input type="text" name="nazwisko" value="<?php
					if(isset($_SESSION['pamietaj_nazwisko']))
					{
					echo $_SESSION['pamietaj_nazwisko'];
					unset($_SESSION['pamietaj_nazwisko']);
					}
					?>"><br>
			Ulica: <br>
			<input type="text" name="ulica" value="<?php
					if(isset($_SESSION['pamietaj_ulica']))
					{
					echo $_SESSION['pamietaj_ulica'];
					unset($_SESSION['pamietaj_ulica']);
					}
					?>"><br>
			Nr mieszkania: <br>
			<input type="text" name="mieszkanie" value="<?php
					if(isset($_SESSION['pamietaj_mieszkanie']))
					{
					echo $_SESSION['pamietaj_mieszkanie'];
					unset($_SESSION['pamietaj_mieszkanie']);
					}
					?>"><br>
			Kod pocztowy i miejscowość: <br>
			<input type="text" name="kod" value="<?php
					if(isset($_SESSION['pamietaj_kod']))
					{
					echo $_SESSION['pamietaj_kod'];
					unset($_SESSION['pamietaj_kod']);
					}
					?>"><br>
			Kraj: <br>
			<input type="text" name="kraj" value="<?php
					if(isset($_SESSION['pamietaj_kraj']))
					{
					echo $_SESSION['pamietaj_kraj'];
					unset($_SESSION['pamietaj_kraj']);
					}
					?>"><br>
			<label>
				<input type="checkbox" name="regulamin" <?php if(isset($_SESSION['pamietaj_regulamin'])) { echo "checked" ; unset($_SESSION['pamietaj_regulamin']); } ?>><span class="regulamin">Akceptuje regulamin</span>
			</label>
			<?php
		if(isset($_SESSION['e_regulamin']))
		{
			echo'<div class="error">'.$_SESSION['e_regulamin'].'</div>';
			unset($_SESSION['e_regulamin']);
		}
		?>
			<div class="g-recaptcha" data-sitekey="6Ld5VYIUAAAAAMnOetP4RupNjxxcGaGUB4pH5eCz"></div>
			<?php
		if(isset($_SESSION['e_captcha']))
		{
			echo'<div class="error">'.$_SESSION['e_captcha'].'</div>';
			unset($_SESSION['e_captcha']);
		}
		?>
			<input class="potwierdz" type="submit" value="Zarejestruj się">
		</form>
	</div>


</body>

</html>
