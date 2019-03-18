<?php
SESSION_START();

if(!isset($_SESSION['udanarejestracja']))
{
header('Location: logowanie.php');
exit();
}
else
{
unset($_SESSION['udanarejestracja']);
}

//Usuwamy zmienne pamiętających wartości wpisane do formularza
if(isset($_SESSION['pamietaj_email'])) unset($_SESSION['pamietaj_email']);
if(isset($_SESSION['pamietaj_haslo1'])) unset($_SESSION['pamietaj_haslo1']);
if(isset($_SESSION['pamietaj_haslo2'])) unset($_SESSION['pamietaj_haslo2']);
if(isset($_SESSION['pamietaj_imie'])) unset($_SESSION['pamietaj_imie']);
if(isset($_SESSION['pamietaj_nazwisko'])) unset($_SESSION['pamietaj_nazwisko']);
if(isset($_SESSION['pamietaj_ulica'])) unset($_SESSION['pamietaj_ulica']);
if(isset($_SESSION['pamietaj_mieszkanie'])) unset($_SESSION['pamietaj_mieszkanie']);
if(isset($_SESSION['pamietaj_kod'])) unset($_SESSION['pamietaj_kod']);
if(isset($_SESSION['pamietaj_kraj'])) unset($_SESSION['pamietaj_kraj']);
if(isset($_SESSION['pamietaj_regulamin'])) unset($_SESSION['pamietaj_regulamin']);

//Usuwanie błędów rejestracji
if(isset($_SESSION['e_nick'])) unset($_SESSION['e_nick']);
if(isset($_SESSION['e_email'])) unset($_SESSION['e_email']);
if(isset($_SESSION['e_haslo'])) unset($_SESSION['e_haslo']);
if(isset($_SESSION['e_regulamin'])) unset($_SESSION['e_regulamin']);
if(isset($_SESSION['e_captcha'])) unset($_SESSION['e_captcha']);

?>
<!DOCTYPE html>
<html lang="pl">

<head>
	<meta charset="UTF-8">
	<title>Udana rejestracja</title>
	<link rel="stylesheet" href="witamy.css">
	<meta name="viewport" content="width=device-width, minimum-scale=1.0">
	<link rel="shortcut icon" href="img/basketball.png" />
	<link href="https://fonts.googleapis.com/css?family=Bangers|Paytone+One&amp;subset=latin-ext" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
</head>

<body>
	<div class="ikona"><i class="fas fa-smile"></i></div>
	<h1>Rejestracja przebiegła pomyślnie!</h1>
	<a href="logowanie.php">Zaloguj się</a>

</html>
