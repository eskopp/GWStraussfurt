<?php
session_start();
include("content/article_content.php"); 
if(isset($_GET['site'])){
	$site = $_GET['site'];
}else{
	$site = 'Startseite';
}
?>
<!DOCTYPE html>
<html lang="de">
	<head>
		<link type="text/css" rel="stylesheet" href="style.css">
		<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
		<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css">
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<title><?php echo($site); ?> | Abteilung Schach</title>
		<script src="/scripts/jquery-1.9.1.js"></script>
		<script src="/scripts/jquery-ui.js"></script>
		<script src='https://www.google.com/recaptcha/api.js'></script>
	</head>

	<body>
		<div id="maindoc">
		<header>
			<div id="title_background">
				<div id="verein">
					<a href="#maindoc">SV G&uuml;n Wei&szlig; Strau&szlig;furt</a>
				</div>
				<div><h1 id="title">Abteilung Schach</h1></div>
			</div>
		</header>	
			<div id="menue">
				<ul>
					<?php foreach($articel_content as $siteid => $sitecontent){ ?>
						<li><a href="<?php echo("?site=".$siteid)?>"><?php echo($sitecontent[0])?></a></li>
					<?php } ?>
				</ul>
			</div>
			<div id="main_area">
				<?php    $site=(isset($_GET["site"]))?$_GET["site"]:$_POST["site"];
			if ($site=="") $site="Startseite" ?>
				<div id="ueberschrift">
					<?php echo($articel_content[$site][1])?>
				</div>
				<div id="text">
					<?php eval($articel_content[$site][2])?>
				</div>
			</div>
 
		</div>
	</body>
</html>
