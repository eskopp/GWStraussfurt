<?php
    include_once("admin/db_connect.php");
    $mysqli_query = "SELECT * FROM `galerie` WHERE `show`='1'";
    $mysqli_output = mysqli_query($mysqli, $mysqli_query);
    ?>
    <script type='text/javascript'>
        var img_src = new Array();    
    </script>
    <?php
    while($data=mysqli_fetch_assoc($mysqli_output)){ ?>
      <a id="img_<?php echo($data['id']);?>" href="#" onclick="open_popup('<?php echo($data['pfad_org']);?>'); false"><img src="<?php echo($data['pfad_mini']);?>" border="0"></a> 
      <script type='text/javascript'>
        img_src.push("<?php echo($data['pfad_org']);?>");  
      </script>
      <?php
      //echo($data['bildunterschrift'].'|'.$data['id'].'|'.$data['pfad_org'].'|'.$data['pfad_mini'].'<p>');
    }
?>
<script type='text/javascript'>
        function open_popup(src){
          $('#pop-up_wrapper').fadeIn('slow');
          //ajax_img_load(src)
          $('#pop-up_img').attr('src',src);
        }
        
        function close_popup(){
          $('#pop-up_wrapper').fadeOut('slow');
          $('#pop-up_img').attr('src','');
        }
        
        function next_img(){
         if(img_src.length-1 == img_src.indexOf($('#pop-up_img').attr('src'))){
          //ajax_img_load(img_src[0]);
          $('#pop-up_img').attr('src', img_src[0]);
         }else{
          var index = img_src.indexOf($('#pop-up_img').attr('src'));
          //ajax_img_load(img_src[index+1]);
          $('#pop-up_img').attr('src', img_src[index+1]);
         }
        }
        
        function prev_img(){
          if(0 == img_src.indexOf($('#pop-up_img').attr('src'))){
            var length = img_src.length-1;
            //ajax_img_load(img_src[length]);
            $('#pop-up_img').attr('src', img_src[length]);
          }else{
            var index = img_src.indexOf($('#pop-up_img').attr('src'));
            //ajax_img_load(img_src[index-1]);
            $('#pop-up_img').attr('src', img_src[index-1]);
          }
        }
        function ajax_img_load(src){        
          rq = new XMLHttpRequest();
          rq.open("get", src, true);
          rq.responseType = 'arraybuffer';
          rq.onreadystatechange = ajax_img_show; 
          rq.send();
        }
        function ajax_img_show(){
          if(rq.readyState == 4 && rq.status == 200){
             //$("#pop-up_img").attr("src","data:image/jpeg;base64," + rq.responseText);
             $("#pop-up_img").append('<img src="data:image/jpeg;charset=US-ASCII;base64,' + rq.responseText + '" />');
             //$('#pop-up_img').html(rq.responseText);
          }
        }
</script>
<div id="pop-up_wrapper">  
  <div id="distance"></div>  
  <div id="pop-up">  
    <div id="close_popup" onclick="close_popup()"></div>  
    <div id="pop-up-content">  
      <img id="pop-up_img" src="" border="0">  
      <div id="galery_navigation">  
        <div id="prev_img" onclick="prev_img()"></div>  
        <div id="next_img" onclick="next_img()"></div>  
        <a href="">
          <div id="img_big"></div>
        </a>  
      </div>  
    </div>  
  </div>
</div>