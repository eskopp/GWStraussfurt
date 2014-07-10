<?php

function getGUID(){
    if (function_exists('com_create_guid')){
        return com_create_guid();
    }else{
        mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
        $charid = strtoupper(md5(uniqid(rand(), true)));
        $hyphen = chr(45);// "-"
        $uuid = chr(123)// "{"
            .substr($charid, 0, 8).$hyphen
            .substr($charid, 8, 4).$hyphen
            .substr($charid,12, 4).$hyphen
            .substr($charid,16, 4).$hyphen
            .substr($charid,20,12)
            .chr(125);// "}"
        return $uuid;
    }
}

  header("Content-Type: text/html; charset=utf-8");
  if($_POST){
    include_once("db_connect.php");
    $table = $_POST["type"];
    if($_POST["type"] == "events" or $_POST["type"] == "news"){
        $sqlinsertquery = "INSERT INTO ".$table." SET ";
        foreach($_POST as $key => $value){
          if($key != "type" and $key != "pflichtfelder"){
		//$mysqli_real_escape_string($this->connection, $user);
            $sqlinsertquery .= $key."='".$value."', ";
          }
        }
        $sqlinsertquery = substr($sqlinsertquery, 0, -2);
        mysqli_query($mysqli, $sqlinsertquery);
        
    } elseif($_POST["type"] == "galerie"){
    
      //HIER IST DANN GALERIE
       
      $original_img_path = '/Galerie/original/';
	    $mini_img_path = '/Galerie/img_mini/';   
      $error = "";
       
      for($i=0; $i<count($_FILES["img_file"]["name"]);$i++){
        if ($_FILES["img_file"]["type"][$i] == "image/jpeg" or $_FILES["img_file"]["type"][$i] == "image/png" or $_FILES["img_file"]["type"][$i] == "image/gif") {
          $guid = getGUID();   // set GUID as UUID ;) 
          $new_org_file = $_SERVER['DOCUMENT_ROOT'].$original_img_path.$guid.strrchr($_FILES["img_file"]["name"][$i],".");
          $new_mini_file = $_SERVER['DOCUMENT_ROOT'].$mini_img_path.$guid.strrchr($_FILES["img_file"]["name"][$i],".");
          
          move_uploaded_file($_FILES['img_file']['tmp_name'][$i], $new_org_file);

          list($width_org, $height_org) = getimagesize($new_org_file);
          
          switch ($_FILES["img_file"]["type"][$i]) {
            case "image/jpeg":
              $image_org = imagecreatefromjpeg($new_org_file);                
              break;
            case "image/png":
              $image_org = imagecreatefrompng($new_org_file);
              break;
            case "image/gif":
              $image_org = imagecreatefromgif($new_org_file);
              break;
          }
          
          $image_new = imagecreatetruecolor((50*$width_org)/$height_org,50);
          imagecopyresampled($image_new, $image_org, 0, 0, 0, 0, (50*$width_org)/$height_org, 50, $width_org, $height_org);
  
          switch ($_FILES["img_file"]["type"][$i]) {
            case "image/jpeg":
              imagejpeg($image_new,$new_mini_file,100);                
              break;
            case "image/png":
              imagepng($image_new,$new_mini_file,0);
              break;
            case "image/gif":
              imagegif($image_new,$new_mini_file);
              break;
          }
          
          imagedestroy($image_org);
          imagedestroy($image_new);
            
        //Pfad zum Datenbank-String hinzufügen
        $sqlinsertquery = "INSERT INTO ".$table." SET ";
        $sqlinsertquery .= "pfad_org='".$original_img_path.$guid.strrchr($_FILES["img_file"]["name"][$i],".")."', pfad_mini='".$mini_img_path.$guid.strrchr($_FILES["img_file"]["name"][$i],".")."', bildunterschrift='".htmlentities($_POST["bildunterschrift"][$i])."'"  ;
        $query_result = mysqli_query($mysqli, $sqlinsertquery);
        if(!$query_result){
            printf("Error: %s\n", mysqli_error($mysqli));
        }
            
        } else {
          $error .= "Dateiformat nicht unterst&uuml;tzt. (".$_FILES['img_file']['name'][$i].")<br/>";
        }
      }
      echo($error);
    }
    
    $sqlinsertquery = substr($sqlinsertquery, 0, -2);
    echo $sqlinsertquery;
    
    // BIS HIER GEHT GALERIE
    
    mysqli_close($mysqli);
  }
?>