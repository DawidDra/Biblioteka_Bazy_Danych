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
    <title>Wyszukaj po kategorii</title>
    <meta charset="UTF-8" />
	<link rel="stylesheet" href="style.css" type="text/css">
  </head>
  <body>
    <h1>Wyszukaj po kategorii</h1>
	 <form action="wynikK.php" method="post">
     
      <br /><br />
      Podaj kategorię:
	  </br>
      Nazwa kategorii: <input type="text" name="kategoria" />
	  </br>
	
	  
      <input type="submit" name="wyszukaj" />
    </form>
	</br>
<a href="wyszukaj.php">[POWRÓT]	<a href="index.php">[STRONA GLOWNA]</a>
  </body>
</html>

