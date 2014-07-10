<?php
$galerie_img = array_slice(scandir('Galerie/original'),2);
?>
		<script type='text/javascript'>
		function show_img(img_id) {
                  $('#pop-up_wrapper').fadeIn('slow');
                  $('#pop-up_img').attr('src','');
		              $('#pop-up_img').attr('src','Galerie/original/'+$('#' + img_id + ' img').attr('src').split('/').reverse()[0]);
		              $('#img_big').parent().attr('href','Galerie/original/'+$('#' + img_id + ' img').attr('src').split('/').reverse()[0]);
                  
                  var prev_img = 'img_' + ( parseInt ( img_id.split('_').reverse()[0] ) -1 );
                  if (img_id == 'img_0') {
                  	prev_img = 'img_' + <?php echo count($galerie_img)-1?>;
                  };
                  $('#prev_img').unbind();
                  $('#prev_img').click(function() {show_img(prev_img);});
                  
                  var next_img = 'img_' + ( parseInt ( img_id.split('_').reverse()[0] ) +1 );
   		  if (img_id == 'img_' + <?php echo count($galerie_img)-1 ?>) {
   		  	next_img = 'img_0';
   		  };
   		  $('#next_img').unbind();
                  $('#next_img').click(function() {show_img(next_img);});
		}
		</script>

		<?php for($i=0; $i<count($galerie_img);$i++){ ?>
			<a id="<?php echo 'img_'.$i?>" href="Galerie/original/<?php echo $galerie_img[$i] ?>"><img src="Galerie/img_mini/<?php echo $galerie_img[$i] ?>" border="0"></a>
	    		<script type='text/javascript'>
				$("#<?php echo 'img_'.$i?>").attr("href","#");
       				$("#<?php echo 'img_'.$i?>").click(function() {show_img("<?php echo 'img_'.$i?>");});
    	    		</script>
		<?php } ?>
          
					<div id="pop-up_wrapper">
						<div id="distance"></div>
						<div id="pop-up">
							<div id="close_popup" onclick="$('#pop-up_wrapper').fadeOut('slow');$('#pop-up_img').attr('src','');"></div>
              <div id="pop-up-content">
              <img id="pop-up_img" src="" border="0">
              <div id="galery_navigation">

                  <div id="prev_img"></div>
    							<div id="next_img"></div>
    							<a href=""><div id="img_big"></div></a>

							</div>
              </div>
						</div>
					</div>