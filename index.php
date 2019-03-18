<?php
SESSION_START();
?>
<!DOCTYPE html>
<html lang="pl">

<head>
	<title>We Love Basketball !</title>
	<meta charset=" UTF-8">
	<meta name="viewport" content="width=device-width, minimum-scale=1.0">
	<link href="https://fonts.googleapis.com/css?family=Bangers|Paytone+One&amp;subset=latin-ext" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<script type="text/javascript" src="jquery.scrollTo.min.js"></script>
	<script>
		jQuery(function($) {
			//zresetuj scrolla
			$.scrollTo(0);

			$('.scrollup').click(function() {
				$.scrollTo($('body'), 1000);
			});
		});
		//pokaż podczas przewijania
		$(window).scroll(function() {
			if ($(this).scrollTop() > 300) $('.scrollup').fadeIn();
			else $('.scrollup').fadeOut();
		});

	</script>
	<script type="text/javascript" src="timer.js"></script>
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
	<link rel="shortcut icon" href="img/basketball.png" />
	<link rel="stylesheet" href="home.css">
	<link rel="stylesheet" href="kontakt.css">
	<link rel="stylesheet" href="onas.css">
</head>

<body onload="odliczanie();">
	<a href="#" class="scrollup" title="Przewiń do góry">
		<img src="img/arrow_up.png" alt="">
	</a>
	<a href="https://www.facebook.com/mkonatkowski" class="fb_button" target="_blank"><i class="fab fa-facebook"></i> <span class="button_text">Odwiedź nas !</span></a>
	<a href="https://www.youtube.com/" class="yt_button" target="_blank"><i class="fab fa-youtube"></i> <span class="button_text">Łączy nas muzyka !</span></a>
	<a href="index.php?go=10" class="photo_button"><i class="fas fa-images"></i> <span class="button_text">Przejrzyj galerię</span></a>
	<header>
		<img class="user" src="img/user.png" alt="ikona uzytkownika">
		<a href="logowanie.php">
			<button>
				<?php
			if(isset($_SESSION['zalogowany']) || isset($_SESSSION['zalogowany'])==true)
			{
				echo "Panel klienta";
			}
				else
				{
					echo "Logowanie";
				}
			?>
			</button>
		</a>
		<h1>We <span class="heart">&hearts;</span> Basketball</h1>
	</header>
	<nav class="clearfix">
		<div><a href="index.php?go=1"><i class="fas fa-home"></i> Home</a></div>
		<div><a href="#"><i class="fas fa-bars"></i> Ubrania</a>
			<ul>
				<li><a href="index.php?go=2"><i class="fas fa-tshirt"></i> Koszulki</a></li>
				<li><a href="index.php?go=3"><i class="fas fa-running"></i> Spodenki</a></li>
				<li><a href="index.php?go=4"><i class="fas fa-hat-wizard"></i> Czapki</a></li>
			</ul>
		</div>
		<div><a href="#"><i class="fas fa-bars"></i> Akcesoria</a>
			<ul>
				<li><a href="index.php?go=5"><i class="fas fa-hand-rock"></i> Frotki / Opaski</a></li>
				<li><a href="index.php?go=6"><i class="fas fa-basketball-ball"></i> Piłki</a></li>
				<li><a href="index.php?go=7"><i class="fas fa-briefcase"></i> Torby / Plecaki</a></li>
			</ul>
		</div>
		<div><a href="index.php?go=8"><i class="fas fa-shoe-prints"></i> Obuwie</a></div>
		<div><a href="index.php?go=9"><i class="fas fa-envelope"></i> Kontakt</a></div>
		<div><a href="index.php?go=10"><i class="fas fa-basketball-ball"></i> O nas</a></div>
	</nav>
	<?php
	if(!isset($_GET['go'])) {
		include 'home.html';
}
	else
switch ($_GET['go'])
{ 
   case 1: 
      include("home.html"); 
      break; 
   case 2: 
      include("koszulki.html"); 
      break; 
   case 3: 
      include("spodenki.html");
      break; 
   case 4:  
		  include("czapki.html");
      break; 
	case 5:
		  include("opaski.html");
      break;
	case 6:
			include("pilki.html");
      break;
	case 7:
			include("torby.html");
      break;
	case 8:
			include("buty.html");
      break;
	case 9:
			include("kontakt.php");
      break;
	case 10:
			include("onas.html");
      break;
} 
?>
	<footer>
		<div id="zegar"></div>
		<a class="contact" href="index.php?go=9">
			<i class="fas fa-envelope-square"></i> Kontakt
		</a>
		<div class="socials">
			<a href="https://www.facebook.com/mkonatkowski" class="fb" target="_blank"><i class="fab fa-facebook-square"></i></a>
			<a href="https://www.youtube.com/" class="yt" target="_blank"><i class="fab fa-youtube"></i></a>
		</div>
		<h2 class="copy">
			<span class="mandalorian"> <i class="fab fa-mandalorian"></i> </span> Copyright &copy; 2019 Wszystkie prawa zastrzeżone <i class="fas fa-basketball-ball"></i></h2>
	</footer>


</body>

</html>
