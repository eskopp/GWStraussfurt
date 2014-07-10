<?php
     session_start();
     include("db_connect.php");
     $mysqli_query = "INSERT INTO `logout` SET `User` = '".$_SESSION["username"]."'";
     mysqli_query($mysqli, $mysqli_query);
     $_SESSION = array();
     session_destroy();
     $hostname = $_SERVER['HTTP_HOST'];
     $path = dirname($_SERVER['PHP_SELF']);
     if(isset($_COOKIE["Loginabtschach"])){
       $inhalt = $_COOKIE["Loginabtschach"];
       $time = time();
       $time = $time-86400;
       setcookie('Loginabtschach',$inhalt,$time,"/",".".$hostname);
     }

     header('Location: http://'.$hostname.($path == '/' ? '' : $path).'/../?site=Administration');
?>