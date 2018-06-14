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
<html lang="pl">
  <head>
    <meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome,opera=1"/>
	<title>Wyniki wyszukiwania książek</title>
	<link rel="stylesheet" href="style.css" type="text/css">
	
  </head>
  <body>
  
  <div id="wyszukiwanie">
  <div id="top">
    Wyniki wyszukiwania książek
	</div>
	<div id="wynik">
    <?php
      $imieA = $_POST['imieA'];
      $nazwiskoA = $_POST['nazwiskoA'];
      if (!$imieA || !$nazwiskoA)
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
	 $szukajT=" CALL `Znajdz_autor`('".$_POST["imieA"]."','".$_POST["nazwiskoA"]."')";
	
		 if ($rezultat = @$polaczenie->query($szukajT))
		 {
			 while($ww=$rezultat->fetch_array())
	{
		$_SESSION['idk']=$ww[6];
		$_SESSION['dostep']=$ww[5];
		echo "<p><br>Tytul: ".$ww[0]."</br>";
		echo "Imie i nazwisko autora: ".$ww[1]." ".$ww[2]."</br>";
		echo "Nazwa kategori: ".$ww[3]."</br>";
		echo "Wydawnictwo: ".$ww[4]."</br>";
		echo "Dostepna: ".$ww[5]."</br>";
		
		echo "<a href='wypozycz.php'>[WYPOZYCZ]</a>";
	}
		 }
 }
      
     
   
      $polaczenie->close();
    ?> 
	</div>
	<div style="clear:both;">
	</div>
	</div>
  </body>
</html>


