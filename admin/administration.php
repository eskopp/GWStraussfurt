<?php 
session_start(); 


  $mysqlnewstable = 'news';
  $mysqleventstable = 'events';
  $mysqlgalerietable = 'galerie';
  
  include_once("db_connect.php");
  $mysqli_query = "SELECT * FROM `";
  
  $mysqli_query_galerie = $mysqli_query.$mysqlgalerietable;
  $mysqli_query_galerie .= "`";
  
  $mysqli_output_galerie = mysqli_query($mysqli, $mysqli_query_galerie);
?>

  <script type='text/javascript'>

    function activate_tabContent(active_div){
      $('div#contentHolder > div').removeClass('active');
      active_div.addClass('active');   
    } 
    function save(formid){     
    	var pflichtfelder = $('#' + formid + " #pflichtfelder").val().split(";");
      var req_error = 0;
      var fail_felder = '';
      for( var i=0; i<pflichtfelder.length; i++ ) {
        var field = $('#' + formid + ' #' + pflichtfelder[i]);
        if((field.attr('type') != 'file' && field.val() == '') || (field.attr('type') == 'file' && field[0].files.length == 0 )){ 
          field.css({"border-color": "#FF0000", 
             "border-width":"1px", 
             "border-style":"dashed"});
          req_error = 1;
          fail_felder = fail_felder +  field.attr('id') + '; ';
        }else{
          field.css({"border-color": "#000000", 
             "border-width":"0px", 
             "border-style":"none"});
        }
      }
      if(fail_felder != ''){
      alert('Bitte folgende Felder korrigieren: ' + fail_felder);
      }
      if(req_error == 0) {
        rq = new XMLHttpRequest();
        rq.open("post", "admin/insert_db.php", true);
        var formData = new FormData( document.getElementById(formid) );
        document.getElementById('load_wait').style.display='block';
        rq.onreadystatechange = send; 
        rq.send(formData);    
      }
    }
    function send(){
        if(rq.readyState == 4 && rq.status == 200){
          document.getElementById('load_wait').style.display='none'; 
        }
    }
    
    function LoadImgPreview(input) {
      if (input.files && input.files.length > 0 ) {
        $('input#img_file').prop('disabled', true);
        var length = input.files.length;
        $('#form_img #img_preview').html('');
        for (var i=0 ; i <= length-1 ; i++){
          var reader = new FileReader();
          reader.onload = function (e) {
            $('#form_img #img_preview').html($('#form_img #img_preview').html() + '<img id="img'+i+'" style="width: 90px;" src="' + e.target.result + '" alt="Image Preview" /> <textarea id="image'+i+'" rows="3" name="bildunterschrift[]" cols="50" placeholder="Bildunterschrift"></textarea> <br>');
          }
          reader.readAsDataURL(input.files[i]);
        }
        $('input#img_file').prop('disabled', false);
      }
    }              
  </script>

  
  <div id="admin_tabs">
    <a href="#" onclick="activate_tabContent($('div#galerie_content'))"><div id="galerie_tab">Galerie</div></a>
    <a href="#" onclick="activate_tabContent($('div#news_content'))"><div id="news_tab">News</div></a>
    <a href="#" onclick="activate_tabContent($('div#events_content'))"><div id="events_tab">Events</div></a>
  </div>    
  <div id="tabcontent">
    <div id="contentHolder">
        
      <!------------------------ Tab Galerie -------------------------------->
        <div id="galerie_content">
          <h1>Galerie</h1>
            <div id="accordion">
              <h3>Hochladen</h3>
                <div>
                  <form name="form_img" id="form_img">
                    <input id="pflichtfelder" name="pflichtfelder" type="hidden"  value="img_file">
                    <input type="hidden" name="type" value="galerie">
                    <input id="img_file" name="img_file[]" type="file" value="" multiple=true onchange="LoadImgPreview(this)"><br><br>
      	            <div id="img_preview"></div>
                    <button onclick="save('form_img')" class="pure-button pure-button-primary" id="send1"><i class="fa fa-upload"></i> Upload</button><br><br>
                  </form>              
                  </div>
                <h3>Bearbeiten</h3>
                <div>
                  <?php
                    while($data=mysqli_fetch_assoc($mysqli_output_galerie)){ ?>
                      <div class="manipulate_galerie">
                        <img id="img_<?php echo($data['id']);?>" src="<?php echo($data['pfad_mini']);?>" border="0"> 
                        <?php
                          if($data['show'] == 0){ ?>
                            <div class="img_noshow"><button class="button-secondary pure-button" onclick="toggle_show(<?php echo($data['id']);?>)" id="button_show_<?php echo($data['id']);?>">   Anzeigen   </button></div>
                          <?php
                          }Else{?>
                            <div class="img_noshow"><button class="button-success pure-button" onclick="toggle_show(<?php echo($data['id']);?>)" id="button_show_<?php echo($data['id']);?>">Nicht anzeigen</button></div>
                          <?php }?>
                          <div class="img_text">
                            <button onclick="dialog_img_text(<?php echo($data['id']);?>)" >Bildunterschrift bearbeiten</button>
                            <div class="bildunterschrift_manipulate" id="img_text<?php echo($data['id']);?>" title="Bildunterschrift bearbeiten">
                              <textarea id="img_text_manipulate<?php echo($data['id']);?>" cols="45" rows="5"><?php echo($data['bildunterschrift']);?></textarea>
                            </div>
                          </div>
                          
                      </div>
                  <?php } ?> 
                  <script>
                    function toggle_show(id_l){
                      id = id_l;
                      rq = new XMLHttpRequest();
                      rq.open("post", "admin/toggle_show.php", true);
                      rq.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                      document.getElementById('load_wait').style.display='block';
                      rq.onreadystatechange = toggle_show_success;
                      rq.send('id='+id_l); 
                    }
                    function toggle_show_success(){
console.log(rq.readyState);
console.log(rq.status);
                      if(rq.readyState == 4 && rq.status == 200){
                        document.getElementById('load_wait').style.display='none';
                        var response = rq.responseText;
                        var label = $("button #button_show_"+id).button( "option", "label" );
                        $( "button #button_show_"+id).button( "option", "label", "sucess" );
                        console.log(label);
                        console.log(response);                        
                        if(response == "Success!" && label == "Nicht anzeigen"){
                          $( "button#button_show_"+id ).button( "option", "label", "   Anzeigen   " );
                        }else if(response == "Success!" && label == "   Anzeigen   "){
                          $( "button#button_show_"+id ).button( "option", "label", "Nicht anzeigen" );
                        } 
                      }
                    }
                    function dialog_img_text(id_t){
                      id = id_t;
                      $("#img_text"+id).dialog({
							           autoOpen: true,
                         width: 500,
							           buttons: [
							           {
            								text: "Speichern",
            								click: save_img_text,
							            },
							            {
            								text: "Abbrechen",
            								click: function() {
            									$( this ).dialog( "close" );
            								}
							            }
							            ]
						          });
                    }
                    function save_img_text(){
                      var text = $("#img_text_manipulate"+id).val();
                      rq = new XMLHttpRequest();
                      rq.open("post", "admin/img_text_manipulate.php", true);
                      rq.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                      document.getElementById('load_wait').style.display='block';
                      rq.onreadystatechange = img_text_success;
                      rq.send('id='+id+'&text='+text); 
                    }
                    function img_text_success(){
                      if(rq.readyState == 4 && rq.status == 200){
                        document.getElementById('load_wait').style.display='none';
                        $("#img_text"+id).dialog( "close" );
                      }
                    }
                  </script>
                </div>
            </div>
          </div>
          <script type='text/javascript'>
            $( "#accordion" ).accordion({ heightStyle: "content" });
          </script>
       <!------------------------------------------------------------------>     
       <!------------------------ Tab News -------------------------------->
	<div id="news_content">
		<h1>News</h1>
		<form name="form_news" id="form_news">
			<input id="pflichtfelder" name="pflichtfelder" type="hidden"  value="ueberschrift;inhalt">
			<input type="hidden" name="type" value="news">
			<input id="ueberschrift" name="ueberschrift" type="text" size="75" maxlength="500" value="" placeholder="Title"> <input placeholder="Datum" type="text" class="date" id="news_date"><br>
			<textarea id="inhalt" rows="10" name="inhalt" cols="76" placeholder="Inhalt"></textarea> <br>
			<input type="button" value="Senden" onclick="save('form_news')" id="send2"><br><br>
		</form>
	</div>
       <!-------------------------------------------------------------------->
       <!------------------------ Tab Events -------------------------------->
	<div id="events_content">
		<h1>Events</h1>
		<form name="form_events" id="form_events" class="pure-form">
			<input id="pflichtfelder" name="pflichtfelder" type="hidden"  value="ueberschrift;inhalt">
			<input type="hidden" name="type" value="events">
			<fieldset class="pure-group">
				<input id="ueberschrift" name="ueberschrift" type="text" size="75" maxlength="500" value="" placeholder="Title" class="pure-u-3-4">
				<input placeholder="Datum" type="text" class="date pure-u-1-4" id="events_date">
				<textarea id="inhalt" rows="10" name="inhalt" cols="76" placeholder="Inhalt" class="pure-input-1-2"></textarea>
			</fieldset><br>
			<input type="button" value="Senden" onclick="save('form_events')" id="send3"><br/><br/>
		</form>
	</div> 
    </div>
  </div><br>
  <a class="pure-button pure-button-primary" href="admin/logout.php"><i class="fa fa-sign-out"></i> Logout</a>
 <script>
	$(".date").datepicker({
		showOtherMonths: true,
		selectOtherMonths: true
	});
$(function() {
  $( "#progressbar" ).progressbar({
    value: false
  });
   $( "#progressbar" ).find( ".ui-progressbar-value" ).css({
    "background": '#' + Math.floor( Math.random() * 16777215 ).toString( 16 )
});
});
</script>
  <div id="load_wait">
    <div id="half"></div>
     <div id="help">
        <div id="progressbar"></div>
        <div id="progress-label"><br> Bitte Warten...</div>
     </div>  
  </div>
</body>
</html>