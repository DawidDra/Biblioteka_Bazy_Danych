<?php
 
 session_start();
 
 if((isset($_SESSION['zalogowany']))&&($_SESSION['zalogowany']==true))
 {
	 header('Location: biblioteka.php');
	 exit(); 
 }

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


<div id="container">


<div id="menu_form">

<div class="opcja_form"><a href="index.php">STRONA GŁÓWNA</a></div>

</div>

<div id="formularz">

	<form action="logowanie.php" method="post">
		Login: <br /><input type="text" name="login"/><br />
		Hasło: <br /><input type="password" name="haslo"/><br />
		<input type="submit" value="Zaloguj"/>

	</form>
	</br>
	Jesli nie posiadasz konta skontaktuj sie z administracja:</br>
	
	<a href="mailto:drapiewski.dawid@gmailc.om">drapiewski.dawid@gmail.com</a> </br>
	<a href="mailto:robert.jezewski96@gmail.com">robert.jezewski96@gmail.com</a>
	


<br></br>
</div>



<?php

	
	if(isset($_SESSION['blad'])) 
	{
		echo $_SESSION['blad'];
	}
?>


</div>
</body>
</html>