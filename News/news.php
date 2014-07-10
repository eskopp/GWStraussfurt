<?php
   require('admin/db_connect.php');
   $query = "SELECT * FROM `news`";
   $result = mysqli_query($mysqli, $query);
   if(!mysqli_fetch_assoc($result)){
		echo('<p class="alert alert-info">Leider sind gerade keine News verf&uuml;gbar!</p>');
   }
   while($data = mysqli_fetch_assoc($result)){
      echo('<h3>'.$data['ueberschrift'].'</h3>');
      $inhalt = str_replace("\n","<br>",$inhalt);
      echo($inhalt);
   }
?>