<?php
$articel_content = array(
'Startseite'                     => array('<i class="fa fa-home"></i> Startseite',
                                  '<i class="fa fa-home"></i> Startseite',
                                  '?>Herzlich Willkommen zur Startseite der Abteilung "Schach" des SV Gr&uuml;n Wei&szlig; Strau&szlig;furt
                                  <br>Diese Seite befindet sich in der Entstehung. 
                                  <br>Falls sie Vorschl&auml;ge zum Design oder Inhalt haben, benutzen sie bitte den Support.'
                                ),
'News'                     => array('<i class="fa fa-newspaper-o"></i> News',
                                  '<i class="fa fa-newspaper-o"></i> News',
                                  '?><?php require("News/news.php"); ?> '
                                ),
                                
'Events'                     => array('<i class="fa fa-calendar"></i> Events',
                                  '<i class="fa fa-calendar"></i> Events',
                                  '?><?php require("Events/events.php"); ?>	'
                                ),

'Galerie'                     => array('<i class="fa fa-picture-o"></i> Galerie',
                                  '<i class="fa fa-picture-o"></i> Galerie',
                                  '?>	<?php include("Galerie/galerie_img.php"); ?>'
                                ),
                               
'Aufgaben'                     => array('<i class="fa fa-tasks"></i> Schachaufgaben',
                                  '',
                                  '?>	<div style="width:782px; "><iframe src="http://www.schachonline.eu/game/guest_chess_large" scrolling="no" frameborder="no" align="center" height = "577" width = "782"></iframe> <div style="padding:4px 4px 4px 4px;background:#201d1d;font-family:verdana,arial; font-size:10px;float:right; color:#f2efe0"> <a href="http://www.schachonline.eu/" style="color:#a8966b" >Schach online</a> erstellt von <a href="http://www.schachonline.eu/" style="color:#a8966b" >schachonline.eu</a></div></div> 
                                  	<br><br><iframe width="310" scrolling="no" height="341" frameborder="0" src="http://www.shredderchess.com/online/playshredder/
					gdailytactics.php?mylang=de&mysize=32"></iframe>'
                                ),
'Mitglieder'                     => array('<i class="fa fa-users"></i> Mitglieder',
                                  '<i class="fa fa-users"></i> Mitglieder',
                                  '?>	<?php include("Mitglieder/members.php"); ?>'
                                ),

'Kontakte'                     => array('<i class="fa fa-envelope"></i> Kontakte',
                                  '<i class="fa fa-envelope"></i> Kontakte',
                                  '?><?php include("Support/support_mail.php"); ?>
                                  <br><br>Ansprechpartner: Eckart Lein Tel: 036376/58199'
                                ),
'Impressum'                     => array('<i class="fa fa-copyright"></i> Impressum',
                                  'Impressum',
                                  '?><?php include("impressum/all.php")?>'
                                ),
'Administration'                       => array('<i class="fa fa-cog"></i> Administration',
                                  '<i class="fa fa-cog"></i> Administration',
                                  '?><?php include("admin/main.php"); ?>'
                                ),
'Downloads'                       => array('<i class="fa fa-download"></i> Downloads',
                                  '<i class="fa fa-download"></i> Downloads',
                                  '?><?php include("Downloads/downloads.php"); ?>'
                                )
);
?>