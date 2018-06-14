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
     
     
      if (!$metoda)
      {
        echo 'Brak parametrów wyszukiwania, wróć do poprzednej strony i spóbuj ponownie!';
        exit;
      }else
	  {
		  if($metoda==autor)
		  {
			  header('Location: formA.php');
		  }
		  
		  if($metoda==tytul)
		  {
			  header('Location: formT.php');
		  }
		 
		    if($metoda==kategoria)
		  {
			  header('Location: formK.php');
		  }
		  
		    if($metoda==wydawnictwo)
		  {
			  header('Location: formW.php');
		  }
		  
	  }
  


    ?> 
  </body>
</html>

