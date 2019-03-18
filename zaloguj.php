<?php
SESSION_START();

if(!isset($_POST['email']) || (!isset($_POST['haslo'])))
{
	header('Location: logowanie.php');
	exit();
}

require_once "connect.php";
$polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);

if($polaczenie->connect_errno!=0)
{
echo "Error: ".$polaczenie->connect_errno;
}
else
{
	$email = $_POST['email'];
	$haslo = $_POST['haslo'];

	$email = htmlentities($email,ENT_QUOTES,"UTF-8");
	
	$sql = " SELECT * FROM uzytkownicy WHERE email='$email' AND haslo='$haslo' ";
	
	if ($rezultat=@$polaczenie->query(sprintf(" SELECT * FROM uzytkownicy WHERE email='%s'",mysqli_real_escape_string($polaczenie,$email))))
		{
		$ilu_userow=$rezultat->num_rows;
		
		if($ilu_userow>0)
		{
			$wiersz = $rezultat->fetch_assoc();
			if(password_verify($haslo,$wiersz['haslo'])==true)
			{
			$_SESSION['zalogowany']=true;
			
			$_SESSION['id']=$wiersz['id'];
			$_SESSION['email']=$wiersz['email'];
			$_SESSION['imie']=$wiersz['imie'];
			$_SESSION['nazwisko']=$wiersz['nazwisko'];
			$_SESSION['ulica']=$wiersz['ulica'];
			$_SESSION['mieszkanie']=$wiersz['mieszkanie'];
			$_SESSION['kod']=$wiersz['kod'];
			$_SESSION['kraj']=$wiersz['kraj'];
				
			unset($_SESSION['blad']);
			$rezultat->close();
				
			header('Location: panel.php');
			}
			else
		{
			$_SESSION['blad']='<span style="color:red"> Nieprawidłowy login lub hasło!</span>';
			
			header('Location: logowanie.php');
		}
		}
		
		else
		{
			$_SESSION['blad']='<span style="color:red"> Nieprawidłowy login lub hasło!</span>';
			
			header('Location: logowanie.php');
		}
	}
	
	$polaczenie->close();
}

?>
