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
    <title>Wyniki wyszukiwania książek</title>
    <meta charset="UTF-8" />
	<link rel="stylesheet" href="style.css" type="text/css">
  </head>
  <body>
    <h1>Wyniki wyszukiwania książek</h1>
    <?php
      $kategoria = $_POST['kategoria'];

      if (!$kategoria)
      {
        echo 'Brak parametrów wyszukiwania, wróć do poprzednej strony i spóbuj ponownie!';
        exit;
      }
  


 $polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);

 
 if($polaczenie->connect_errno!=0)
 {
	echo "Error: ".$polaczenie->connect_errno." Opis: ".$polaczenie->connect_error; 
 }
 else
 {
	 $szukajT=" CALL `Znajdz_kategoria`('".$_POST["kategoria"]."')";
	
		 if ($rezultat = @$polaczenie->query($szukajT))
		 {
			 while($ww=$rezultat->fetch_array())
				
	{
		$_SESSION['idk']=$ww[6];
		$_SESSION['dostep']=$ww[5];
		echo "<p><br>Tytul: ".$ww[0]."</br>";
		echo "<br>Imie i nazwisko autora: ".$ww[1]." ".$ww[2]."</br>";
		echo "<br>Nazwa kategori: ".$ww[3]."</br>";
		echo "<br>Wydawnictwo: ".$ww[4]."</br>";
		echo "Dostepna: ".$ww[5]."</br>";
		
		echo "<a href='wypozycz.php'>[WYPOZYCZ]</a>";
	
	}
		 }
 }
      
     
   
      $polaczenie->close();
    ?> 
  </body>
</html>

