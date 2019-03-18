<?php
SESSION_START();

if(!isset($_SESSION['zalogowany']))
{
header('Location: logowanie.php');
exit();
}
?>

<!DOCTYPE html>
<html lang="pl">

<head>
	<meta charset="UTF-8">
	<title>Panel użytkownika</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link rel="stylesheet" href="panel.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
	<link rel="shortcut icon" href="img/basketball.png" />
	<link href="https://fonts.googleapis.com/css?family=Bangers|Paytone+One&amp;subset=latin-ext" rel="stylesheet">
</head>

<body>
	<div class="container">
		<div class="user1">
			<div class="avatar"><i class="fas fa-user"></i></div>
			<a class="logout" href="logout.php">Wyloguj się</a>
			<a class="home" href=" index.php">Strona główna</a>
		</div>


		<div class="user">
			<?php
			echo "<h1>Witaj w panelu użytkownika </h1>";
			echo "<h2 class=".'dane'.">Twoje dane</h2>";
			echo" <p>Imię: ".$_SESSION['imie']."</p>";
			echo "<p>Nazwisko: ".$_SESSION['nazwisko']."</p>";
			echo "<p>E-mail: ".$_SESSION['email']."</p>";
			echo "<h2 class=".'adres'.">Dane adresowe</h2>";
			echo "<p>Adres: ".$_SESSION['ulica']." / ".$_SESSION['mieszkanie']."</p>";
			echo "<p>Miejscowość: ".$_SESSION['kod']."</p>";
			echo "<p>Kraj: ".$_SESSION['kraj']."</p>";
		?>
		</div>
	</div>
</body>

</html>
