<?php
	session_start();
	include('db_connect.php');

	function login($username, $password, $mysqli){
		$user = mysqli_real_escape_string($mysqli, $username);
		$pw = mysqli_real_escape_string($mysqli, $password);
		$pw = hash(sha512, $pw);
		$query = "SELECT * FROM `login` WHERE username = '".$user."' AND passwort = '".$pw."'";
		$result = mysqli_query($mysqli, $query);
		if($data = mysqli_fetch_assoc($result)) {
			return true;
		}else {
			return false;
		}
	}
	if( isset($_SESSION['user']) && !empty($_SESSION['user']) || 1 == 1  ){
		include('administration.php');
	}elseif ( isset($_GET['action']) && $_GET['action'] == 'login'){
		$username = $_POST['username'];
		$password = $_POST['password'];
		$result = login($username, $password, $mysqli);
		if( $result ){
			echo('<p class="alert alert-success">Login erfolgreich!</p>');
			include('administration.php');
		}else{
			echo('<p class="alert alert-error">Falsche Eingabe!</p>');
			include('login.php');
		}
	}else{
		echo('<p class="alert alert-info">Bitte erst einloggen!</p>');
		include('login.php');
	}
?>