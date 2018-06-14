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
	 $mwyp=" CALL `oddaj`('".$_SESSION['numer wypozyczenia']."')";
	 
	 if($_SESSION['rdz']==NULL)
	 {
	 
	  if ($rezultat = @$polaczenie->query($mwyp))
		 {
		echo"ODDANO! </br>";
		echo "W ciagu 3 sekund nastapi powrot do poprzedniej strony";
		echo"<META HTTP-EQUIV='Refresh' CONTENT='3;URL=mojewypozyczenia.php'>";
		 }
	 }else
	 {
		echo "Ta ksiazka jest juz zwrocona</br>";
		echo "W ciagu 3 sekund nastapi powrot do poprzedniej strony";
		echo"<META HTTP-EQUIV='Refresh' CONTENT='4;URL=mojewypozyczenia.php'>";
		exit();
	 }
 }
  $polaczenie->close();








?>

</body>
</html>