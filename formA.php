<?php
 
 session_start();
 /*
 if((!isset($_SESSION['zalogowany'])))
 {
	 header('Location: biblioteka.php');
	 exit(); 
 }
*/
  require_once "connect.php";
?>

<!DOCTYPE HTML>
<html>
  <head>
    <title>Wyszukaj po autorze</title>
    <meta charset="UTF-8" />
	<link rel="stylesheet" href="style.css" type="text/css">
  </head>
  <body>
    <h1>Wyszukaj po autorze</h1>
	 <form action="wynikA.php" method="post">
     
      <br /><br />
      Podaj imie i nazwisko autora:
	  </br>
      Imię: <input type="text" name="imieA" />
	  </br>
	  Nazwisko: <input type="text" name="nazwiskoA" />
	  
      <input type="submit" name="wyszukaj" />
    </form>
	
	</br>
<a href="wyszukaj.php">[POWRÓT]	<a href="index.php">[STRONA GLOWNA]</a>
  </body>
</html>

