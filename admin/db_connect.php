<?php
    $mysqli = mysqli_connect(' ',' ',' '); 
    if(!$mysqli){
      die('Es war keine Verbindung zur Datenbank m&ouml;glich!');
    }
    $mysqli_db = mysqli_select_db($mysqli,' ');      
    if(!$mysqli_db){
      die('Es war keine Verbindung zur Datenbank m&ouml;glich!');
    }
    
    // HEY LEUTE, HIER STEHT NICHTS MEHR DRIN !!!
?>
