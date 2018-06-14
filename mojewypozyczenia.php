<?php
 session_start();
 
 if(!isset($_SESSION['zalogowany']))
 {
	 header('Location: index.php');
	 exit();
 }
 
  require_once "connect.php";
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
<meta charset="utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome,opera=1"/>
<title>Biblioteka</title>

<link rel="stylesheet" href="style.css" type="text/css">

</head>
<body>

<?php

$polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);
 
 if($polaczenie->connect_errno!=0)
 {
	echo "Error: ".$polaczenie->connect_errno." Opis: ".$polaczenie->connect_error; 
 }
 else
 {
	 $mwyp=" CALL `Moje_wypozyczenia`('".$_SESSION['login_usr']."')";
	 
	  if ($rezultat = @$polaczenie->query($mwyp))
		 {
			 
			 echo "<a href='index.php'>[STRONA GLOWNA]</a>";
			 
			 while($ww=$rezultat->fetch_array())
			{
				
				$_SESSION['numer wypozyczenia']=$ww[6];
				$_SESSION['rdz']=$ww[5];
		echo "<p><br>Autor: ".$ww[0]." ".$ww[1]."";
		echo "<br>Tytul: ".$ww[2]."";
		echo "<br>Data wypozyczenia: ".$ww[3]."";
		echo "<br>Przewidywana data zwrotu: ".$ww[4]."";
		echo "<br>Rzeczywista data zwrotu: ".$ww[5]."";
		echo "</br>";
		echo "<a href='oddaj.php'>[Oddaj]</a>";
			}
		 }
	 
 }
  $polaczenie->close();








?>

</body>
</html>