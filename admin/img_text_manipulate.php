<?php
  include_once("db_connect.php");
  $id = $_POST['id'];
  $text = $_POST['text'];
  $text = trim($text);
  $mysqli_query = "UPDATE `galerie` SET `bildunterschrift` = '".$text."' WHERE `id`='".$id."'";
  $mysqli_output = mysqli_query($mysqli, $mysqli_query);
  if($mysqli_output){
      echo('Success!');
    }Else{
      echo('fail');
    }
?>