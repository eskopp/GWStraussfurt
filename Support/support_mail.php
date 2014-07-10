<?php

//header("location: http://abteilung-schach.tk/?site=kontakte");

	if(!empty($_POST) && !empty($_GET) && $_GET['action']='mail_send'){
		if (! isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$client_ip = $_SERVER['REMOTE_ADDR'];
		} else {
			$client_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify?secret=6Lc5EQITAAAAAAibPjx2DCuEiS****************&response='.$_POST['g-recaptcha-response'].'&remoteip='.$client_ip); //hier muss der secret-key ersetzt werden @Jonathan
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
		$result = curl_exec($ch);
		curl_close($ch);
		if(strstr($result,'"success": true')){
			$nachricht  = $_POST[nachricht];
			 if($nachricht != ""){
				$betreff    = "Schach Support -- ".$_POST[email]."---".$_POST[betreff];
				$headers = 'From: '.$_POST[email]. "\r\n" .
					'Date: ' . date("r") . "\r\n" .
					'Message-Id: <' . str_replace(".","_",uniqid('', true)) . '@' . getenv("SERVER_NAME") . '>';
				$empfaenger = "schach@matthias-detsch.de, jonathan.skopp@gmail.com";
				$ergebnis   = mail($empfaenger, $betreff, $nachricht, $headers);
				if($ergebnis) {
					echo "Die Nachricht wurde f&uuml;r den Versand akzeptiert.";
				} else {
					echo "Die Nachricht wurde nicht f&uuml;r den Versand akzeptiert.";
				}
			} else {
				  echo "Bitte keine leere Nachricht schreiben.";
			}
		}
die;
	}
?>

<form action="?site=Kontakte&action=mail_send" method="post" class="pure-form" id="formSupport">
	<fieldset class="pure-group">
		<input class="pure-input-1-2" type="text" size="100" maxlength="100" name="betreff" placeholder="Betreff">
		<input class="pure-input-1-2" type="email" size="100" maxlength="100" name="email" placeholder="Deine E-Mail Adresse" required> 
		<textarea id="nachricht" class="pure-input-1-2" rows="10" name="nachricht" cols="76" placeholder="Ihre Nachricht" required></textarea><br>
	</fieldset>
	<div class="g-recaptcha" data-sitekey="6Lc5EQITAAAAADS-hPX8IrMX4s3xivhBWq6vcNej"></div><br>
	<button type="submit" class="pure-button pure-button-primary"><i class="fa fa-paper-plane"></i> Senden</button>
</form>
