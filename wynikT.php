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
     $tytul = $_POST['tytul'];
      if (!$tytul)
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
	 $szukajT=" CALL `Znajdz_tytul`('".$_POST["tytul"]."')";
	
		 if ($rezultat = @$polaczenie->query($szukajT))
		 {
			 while($ww=$rezultat->fetch_array())
	{
		$_SESSION['idk']=$ww[7];
		$_SESSION['dostep']=$ww[6];
		echo "<p><br>Tytul: ".$ww[1]."</br>";
		echo "<br>Imie i nazwisko autora: ".$ww[2]." ".$ww[3]."</br>";
		echo "<br>Nazwa kategori: ".$ww[4]."</br>";
		echo "<br>Wydawnictwo: ".$ww[5]."</br>";
		echo "<br>Numer egzemplarza: ".$ww[0]."</br></p>";
		echo "Dostepna: ".$ww[6]."</br>";
		
		echo "<a href='wypozycz.php'>[WYPOZYCZ]</a>";
	
	}
		 }
 }
      
     
   
      $polaczenie->close();
    ?> 
  </body>
</html>

