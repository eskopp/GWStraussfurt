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
$img_path = "/img/";
$img = array_slice(scandir($img_path),2);   
for($i=0; $i<count($img);$i++){
unlink($img[$i]);
}

   // graues Bild, schwarze Schrift
   $im = imagecreate(250, 60);
   $grau = imagecolorallocate($im, 192, 192, 192);
   imagefill($im, 0, 0, $grau);
   $schwarz = imagecolorallocate($im, 0, 0, 0);
 
   // ohne verwechselbare Zeichen, Zahlen doppelt
   $allezeichen = "ABCDEFGHIJKLNPQRSTUVXYZ12345781234578";
   $laenge = strlen($allezeichen);
   $text = "";
   
   // 5 Zeichen
   for($i=1; $i<=5; $i++)
   {
	  $index = floor(lcg_value() * $laenge);
      $zeichen = substr($allezeichen, $index, 1);
      $text .= $zeichen;
      // Bildzeiger, Schriftgröße, Winkel, X, Y, Farbe, Schrift, Inhalt
      imagettftext ($im, 30, -35 * $i, 45 * $i - 20, 40 - $i * 6, $schwarz, "Support/arial.ttf", $zeichen);
   }
 
   // Speichern
        $guid = "img/".getGUID().".png";
	imagepng($im, $guid);
	imagedestroy($im);
	$text = trim($text);
	$hash_var = /*hash(sha512,$text)*/ $text;

   echo "<input name='bildtext' type='hidden' value='" .$hash_var. "' />";
   echo "<p><img src='".$guid."' ></p>";
   echo "<p><input name='eingabe' required placeholder='Captcha'>";

?>

