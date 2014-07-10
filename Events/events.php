<?php
   require('admin/db_connect.php');
   $query = "SELECT * FROM `events`";
   $result = mysqli_query($mysqli, $query);
   if(!mysqli_fetch_assoc($result)){
		echo('<p class="alert alert-info">Leider sind gerade keine Events verf&uuml;gbar!</p>');
   }
   while($data = mysqli_fetch_assoc($result)){
      echo('<h3>'.$data['ueberschrift'].'</h3>');
      $inhalt = $data['inhalt'];
      $inhalt = str_replace("\n","<br>",$inhalt);
      echo($inhalt);
   }
?>