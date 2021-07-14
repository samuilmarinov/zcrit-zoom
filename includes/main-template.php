<?php
$current_user = wp_get_current_user();
$userID = $current_user->ID; 
$havemeta = get_user_meta($userID, 'ZOOM_ACTIVE', true);
$user_stored = get_user_meta($userID, 'zxzzoomactive_'.$userID.'_user');
$the_email = $user_stored[0];
$base_64_image = "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";
//ZCRIT-ZOOM OPTIONS
$options = get_option('Zcrit_Zoom_options');
$z_meetings_url = $options['meetings_url'];
$z_sdk = $options['sdk_build']; 
echo '<div id="meetingstartid" class="meetings_zoom">';
if ( is_user_logged_in() AND $havemeta ) {
    echo "<span id='button_zoom' class='button_zoom postvariables'><img src='data:image/image/png;base64,".$base_64_image."' alt='Zcrit-Zoom Call'/></span>";
    echo "<span style='display:none;' id='button_zoom2' class='button_zoom postvariables'><img src='data:image/image/png;base64,".$base_64_image."' alt='Zcrit-Zoom Call'/></span>";
    echo "<span style='display:none;' id='zoom_join_link'></span>";
}else{
    echo '<script type="module" src="https://unpkg.com/x-frame-bypass"></script>';
    echo "<span style='display:none;' id='button_zoom' class='button_zoom postvariables'><img src='data:image/image/png;base64,".$base_64_image."' alt='Zcrit-Zoom Call'/></span>";
    echo "<span style='display:none;' id='button_zoom2' class='button_zoom postvariables'><img src='data:image/image/png;base64,".$base_64_image."' alt='Zcrit-Zoom Call'/></span>";
    echo "<span onClick='window.location.reload();' style='display:none; background:black; padding: 5px 10px;' id='activation_fail' class='activation_fail'>error, try again!</span>";
    echo "<span id='button_user' class='button_zoom activationbutton'>Click to Activate Zoom<div id='loader' class='loader'></div></span>";
    echo "<span style='display:none;' id='zoom_join_link'></span>";
}
echo '</div>';
?>
<script>
//AJAX CALL - DELETE USER
(function($) {
jQuery(function( $ ) {
    $('#button_user_delete').on('click', function () {
        var data = {
            action: 'zcrit_zoom_user_delete_action',
            zcritzoomuserdelete: ''
        };
        jQuery.post(ajaxurl, data, function(response) {
          //alert('response from the server: ' + response);
          location.reload();
        });
    });
});
})( jQuery );
</script>
<script>
//AJAX CALL - CREATE USER
(function($) {
jQuery(function( $ ) {
    $('#button_user').on('click', function () {
        var data = {
            action: 'zcrit_zoom_user_action',
            zcritzoomuser: ''
        };
        document.getElementById("loader").style.display = "block";
        document.getElementById("button_user").style.paddingLeft = "7px";
        jQuery.post(ajaxurl, data, function(response) {
          //alert('response from the server: ' + response);
          var urlopen = response;
          var islink = urlopen.includes("https");
          if(urlopen != 'FAIL' && urlopen != '' && islink === true){
            console.log('GOT IT');
          $('<iframe id="iframe_hk" is="x-frame-bypass" src="'+urlopen+'" style="opacity:0; border:0px #ffffff none;" name="myiFrame" scrolling="no" frameborder="1" marginheight="0px" marginwidth="0px" height="50px" width="50px" allowfullscreen></iframe>').insertAfter("#content");
              setTimeout(function () {       
                 $('#button_zoom').show();
                 $('#loader').hide();
                 $('#button_user').hide(); 
                 $('#iframe_hk').remove();               
              }, 10000);  
            }else{
              $('#activation_fail').show();
              $('#button_user').hide();
              console.log('ERROR');
              var data = {
                  action: 'zcrit_zoom_user_delete_action',
                  zcritzoomuserdelete: ''
              };
              jQuery.post(ajaxurl, data, function(response) {
                //alert('response from the server: ' + response);
                //location.reload();
              });
            }
        });
    });
});
})( jQuery );
</script>
<?php if($z_sdk != 0){ ?>
<script>
//AJAX CALL - SDK
(function($) {
jQuery(function( $ ) {
    $('#button_zoom').on('click', function () {
        var data = {
            action: 'zcrit_zoom_action',
            zcritzoom: ''
        };
        jQuery.post(ajaxurl, data, function(response) {
        //alert('response from the server: ' + response);
            var res = response;
            var settings = res.split(',');
            var hosturl = settings[0];
            var joinurl = settings[1];
            var meeting = settings[2];
            var password = settings[3];
            var email = settings[4];
            var root = '<?php echo $z_meetings_url;?>?meeting='+ meeting +'&password='+ password +'&email='+ email +'&host=yes';
            var join = '<?php echo $z_meetings_url;?>?meeting='+ meeting +'&password='+ password +'&atendee=yes';
            document.getElementById("zoom_join_link").innerHTML = join;
            document.getElementById("button_zoom").style.display = "none";
            document.getElementById("button_zoom2").style.display = "block";
            document.getElementById("button_zoom2").innerHTML = '<a target="_blank" href='+root+'><img src="data:image/image/png;base64,<?php echo $base_64_image; ?>" alt="Zcrit-Zoom Call"/></a>';
            window.open(root, '_blank');      
        });
    });
});
})( jQuery );
</script>
<?php } ?>
<?php if($z_sdk == 0){ ?>
<script>
//AJAX CALL - NO SDK
(function($) {
jQuery(function( $ ) {
    $('#button_zoom').on('click', function () {
        var data = {
            action: 'zcrit_zoom_action',
            zcritzoom: ''
        };
        jQuery.post(ajaxurl, data, function(response) {
        //alert('response from the server: ' + response);
            var res = response;
            var settings = res.split(',');
            var hosturl = settings[0];
            var joinurl = settings[1];
            var meeting = settings[2];
            var password = settings[3];
            var email = settings[4];
            var root = '<?php echo $z_meetings_url;?>?meeting='+ meeting +'&password='+ password +'&email='+ email +'&host=yes';
            var join = '<?php echo $z_meetings_url;?>?meeting='+ meeting +'&password='+ password +'&atendee=yes';
            document.getElementById("zoom_join_link").innerHTML = join;
            document.getElementById("button_zoom").style.display = "none";
            document.getElementById("button_zoom2").style.display = "block";
            document.getElementById("button_zoom2").innerHTML = '<a target="_blank" href='+hosturl+'>Start Meeting</a>';
            window.open(hosturl, '_blank'); 
            window.open(hosturl, '_blank');      
        });
    });
});
})( jQuery );
</script>
<?php } ?>