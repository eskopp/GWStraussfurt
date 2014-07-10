<?php
    include_once("db_connect.php");
    $img_id = $_POST['id'];
    $mysqli_query = "SELECT `show` FROM `galerie` WHERE `id`='".$img_id."'";
  
    $mysqli_output = mysqli_query($mysqli, $mysqli_query);
    
    $data = mysqli_fetch_assoc($mysqli_output);
    if($data['show'] == 0){
      $mysqli_query = "UPDATE `galerie` SET `show` = '1' WHERE `id`='".$img_id."'";
    }Else{
      $mysqli_query = "UPDATE `galerie` SET `show` = '0' WHERE `id`='".$img_id."'";
    }
    $mysqli_output = mysqli_query($mysqli, $mysqli_query);
    if($mysqli_output){
      echo('Success!');
    }Else{
      echo('fail');
    }
    
    //$mysqli_query = "UPDATE `galerie` SET `show` = '0'";
?>