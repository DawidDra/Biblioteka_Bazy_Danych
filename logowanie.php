<?php

 session_start();
 
 if((!isset($_POST['login']))||(!isset($_POST['haslo'])))
 {
	 header('Location: index.php');
	 exit();
 }
 
 require_once "connect.php";

 $polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);
 
 if($polaczenie->connect_errno!=0)
 {
	echo "Error: ".$polaczenie->connect_errno." Opis: ".$polaczenie->connect_error; 
 }
 else
 {
 $login=$_POST['login'];
 $haslo=$_POST['haslo'];
 
 $login=htmlentities($login,ENT_QUOTES,"UTF-8");
 $haslo=htmlentities($haslo,ENT_QUOTES,"UTF-8");

 
 if ($rezultat = @$polaczenie->query(
		sprintf("SELECT * FROM uzytkownik WHERE login_usr='%s' AND haslo_usr='%s'",
		mysqli_real_escape_string($polaczenie,$login),
		mysqli_real_escape_string($polaczenie,$haslo))))
		{
	 $ilu_usr = $rezultat->num_rows;
	 if($ilu_usr>0)
	 {
		$_SESSION['zalogowany']=true;
	
		$wiersz = $rezultat->fetch_assoc();
		$_SESSION['id uzytkownika']=$wiersz['id uzytkownika'];
		$_SESSION['login_usr']=$wiersz['login_usr'];
		
		unset($_SESSION['blad']);
		$rezultat->close();
	header('Location: biblioteka.php');

	 }
	 else
	 {
		$_SESSION['blad']='<span style="color:red">Niepoprawne dane logowania!</span>';
		header('Location: formularz.php');
	 }
 }
 
 $polaczenie->close();
 }
 





?>