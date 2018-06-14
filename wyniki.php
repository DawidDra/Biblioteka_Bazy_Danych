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
  </head>
  <body>
    <h1>Wyniki wyszukiwania książek</h1>
    <?php
      $metoda = $_POST['metoda'];
      $wyrazenie = $_POST['wyrazenie'];
      $wyrazenie = trim($wyrazenie);
      if (!$metoda || !$wyrazenie)
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
	 $szukajT=" CALL `Znajdz_tytul`('".$_POST["wyrazenie"]."')";
	
		 if ($rezultat = @$polaczenie->query($szukajT))
		 {
			 while($ww=$rezultat->fetch_array())
	{

		echo "<p><br>Tytul: ".$ww[1]."</br>";
		echo "<br>Imie i nazwisko autora: ".$ww[2]." ".$ww[3]."</br>";
		echo "<br>Nazwa kategori: ".$ww[4]."</br>";
		echo "<br>Wydawnictwo: ".$ww[5]."</br>";
		echo "<br>Numer egzemplarza: ".$ww[0]."</br></p>";
	}
		 }
 }
      
     
   
      $polaczenie->close();
    ?> 
  </body>
</html>

