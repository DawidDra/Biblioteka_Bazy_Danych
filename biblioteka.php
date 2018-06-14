<?php
 session_start();
 
 if(!isset($_SESSION['zalogowany']))
 {
	 header('Location: index.php');
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
<?php
echo '<div id="logo">';
echo "Witaj na stronie !";
echo '</div>';
echo '<div id="menu">';
echo '<div class="opcja1"><a href="logout.php">Wyloguj</a></div>';
echo '<div class="opcja1"><a href="wyszukaj.php">Wyszukiwanie</a></div>';
echo '<div class="opcja1"><a href="kontakt.html">Kontakt</a></div>';
echo '<div class="opcja1"><a href="mojewypozyczenia.php">Moje wypozyczenia</a></div>';
echo '<div id="zalogowany_jako">';
echo "Zalogowany jako ".$_SESSION['login_usr'];
echo '</div>';
echo '<div style="clear:both;">';
echo '</div>';
echo '</div>';

echo '<div id="content2">';
echo '<div id="content">';
echo '<div id="contentL">';
echo '<img src="zdj.jpg" />';
echo '</div>';
echo '<div id="contentR">';

echo "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque ac lorem vulputate, tempus ipsum in, finibus lacus. Nam accumsan ultricies nisi non posuere. Donec leo lorem, consectetur quis ultrices et, suscipit non sem. Praesent ac sem et velit cursus aliquet. Mauris a facilisis ex. Proin fringilla sodales tellus sit amet fermentum. Integer non metus ac dolor commodo aliquam. Pellentesque ac sem fringilla, eleifend libero id, fringilla purus. Mauris bibendum tincidunt nibh quis gravida. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi feugiat dui sed mi egestas molestie. Cras cursus ligula quam, a fermentum neque interdum vitae. Aliquam a ornare enim. Ut tempus massa et elementum dapibus. Nullam nec ex odio. Sed sem metus, placerat semper mi nec, mattis faucibus libero.";
echo '</div>';
echo '<div style="clear:both;">';
echo '</div>';
echo '</div>';

echo '<div id="footer1">';
echo "Strona stworzona na potrzeby projektu Bazy Danych";
echo '</div>';

echo '<div id="footer2">';
echo '<div class="opcja1"><a href="regulamin.html">REGULAMIN</a>';
echo '</div>';



 
 //echo "<a href='widok.php'>.WIDOKI.</a>";

?>


</div>
</body>
</html>
