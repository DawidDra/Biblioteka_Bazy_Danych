<?php
 session_start();
 
 if(!isset($_SESSION['zalogowany']))
 {
	 echo "Musisz sie zalogowac by moc wypozyczac ksiazki";
	 echo "<META HTTP-EQUIV='Refresh' CONTENT='3;URL=formularz.php'>";
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

$zgoda="tak";

$polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);
 
 if($polaczenie->connect_errno!=0)
 {
	echo "Error: ".$polaczenie->connect_errno." Opis: ".$polaczenie->connect_error; 
 }
 else
 {
	 $wyp="CALL `wypozycz`('".$_SESSION['idk']."','".$_SESSION['id uzytkownika']."')";
	 
	
	 if($_SESSION['dostep']===$zgoda)
	 {
	  if ($rezultat = @$polaczenie->query($wyp))
		 {
		echo"WYPOZYCZONO! </br>";
		echo "W ciagu 3 sekund nastapi przekierowanie do strony z wypozyczeniami";
		echo"<META HTTP-EQUIV='Refresh' CONTENT='3;URL=mojewypozyczenia.php'>";
		 }else
		 {
			 echo "Coś poszło nie tak";
			 
		 }
	 }else
	 {
		 echo "Ta ksiazka jest niedostepna";
		 echo"<META HTTP-EQUIV='Refresh' CONTENT='3;URL=wyszukaj.php'>";
	 }
 }
  $polaczenie->close();








?>

</body>
</html>