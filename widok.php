<?php
 
 session_start();
 
 if((!isset($_SESSION['zalogowany'])))
 {
	 header('Location: biblioteka.php');
	 exit(); 
 }

  require_once "connect.php";
?>


<?php



$polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);
mysqli_set_charset($polaczenie,"utf8");

 if($polaczenie->connect_errno!=0)
 {
	echo "Error: ".$polaczenie->connect_errno." Opis: ".$polaczenie->connect_error; 
 }
 else
 {

$rezwidoku=$polaczenie->query("SELECT * FROM wypozyczenia_usr");
 $_SESSION['zalogowany']=true;
 	unset($_SESSION['blad']);

	while($ww=$rezwidoku->fetch_array())
	{
		echo "<p>Tytul: ".$ww[1]."</p>";
	}
				
				
			
				$rezwidoku->free_result();
				
	echo "<a href='	biblioteka.php'>'POWROT'</a>";
				
			

 $polaczenie->close();
}
?>



