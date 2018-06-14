<?php
 
 session_start();
 /*
 if((!isset($_SESSION['zalogowany'])))
 {
	 header('Location: biblioteka.php');
	 exit(); 
 }

  require_once "connect.php";*/
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
 <h1>Wyszukiwanie książek w bazie </h1>
    <form action="rozdziel.php" method="post">
      Wyszukaj według:
      <select name="metoda">
       <option value="autor" />Autor
       <option value="tytul" />Tytułu
       <option value="kategoria" />Kategoria
	   <option value="wydawnictwo" />Wydawnictwo
      </select>
      <br /><br />
      <input type="submit" name="Wybierz" />
    </form>
  </body>
</html>

