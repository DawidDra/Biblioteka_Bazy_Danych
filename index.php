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
<div id="logo">
Witaj na stronie !
</div>

<div id="menu">
<div class="opcja1"><a href="formularz.php">Logowanie<a/></div>
<div class="opcja1"><a href="wyszukaj.php">Wyszukiwanie</a></div>
<div class="opcja1"><a href="kontakt.html">Kontakt</a></div>
<div style="clear:both;">
</div>
</div>



<div id="content">
	<div id="contentL">
		<img src="zdj.jpg" />
		</div>
	<div id="contentR">

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque ac lorem vulputate, tempus ipsum in, finibus lacus. 
Nam accumsan ultricies nisi non posuere. Donec leo lorem, consectetur quis ultrices et, suscipit non sem. 
Praesent ac sem et velit cursus aliquet. Mauris a facilisis ex. Proin fringilla sodales tellus sit amet fermentum. 
Integer non metus ac dolor commodo aliquam. Pellentesque ac sem fringilla, eleifend libero id, fringilla purus. 
Mauris bibendum tincidunt nibh quis gravida. Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
Morbi feugiat dui sed mi egestas molestie. Cras cursus ligula quam, a fermentum neque interdum vitae. 
Aliquam a ornare enim. Ut tempus massa et elementum dapibus. Nullam nec ex odio. Sed sem metus, placerat semper mi nec, mattis faucibus libero.
</div>
	<div style="clear:both;">
	</div>
</div>




<div id="footer1">
Strona stworzona na potrzeby projektu Bazy Danych
</div>

	
<div id="footer2">	
<div class="opcja1"><a href="regulamin.html">REGULAMIN</a></div>
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