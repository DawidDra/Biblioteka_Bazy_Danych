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
    <title>Wyszukaj po wydawnictwie</title>
    <meta charset="UTF-8" />
	<link rel="stylesheet" href="style.css" type="text/css">
  </head>
  <body>
    <h1>Wyszukaj po wydawnictwie</h1>
	 <form action="wynikW.php" method="post">
     
      <br /><br />
      Podaj nazwę wydawnictwa:
	  </br>
      Wydawnictwo: <input type="text" name="wydawnictwo" />
	  </br>
	
	  
      <input type="submit" name="wyszukaj" />
    </form>
	</br>
<a href="wyszukaj.php">[POWRÓT]	<a href="index.php">[STRONA GLOWNA]</a>
  </body>
</html>

