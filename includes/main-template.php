<?php
$current_user = wp_get_current_user();
$userID = $current_user->ID; 
$havemeta = get_user_meta($userID, 'ZOOM_ACTIVE', true);
$user_stored = get_user_meta($userID, 'zxzzoomactive_'.$userID.'_user');
$the_email = $user_stored[0];
$refreshbutton = '<svg class="icon iconrefresh" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="m23.8995816 10.3992354c0 .1000066-.1004184.1000066-.1004184.2000132 0 0 0 .1000066-.1004184.1000066-.1004184.1000066-.2008369.2000132-.3012553.2000132-.1004184.1000066-.3012552.1000066-.4016736.1000066h-6.0251046c-.6025105 0-1.0041841-.4000264-1.0041841-1.00006592 0-.60003954.4016736-1.00006591 1.0041841-1.00006591h3.5146443l-2.8117154-2.60017136c-.9037657-.90005932-1.9079498-1.50009886-3.0125523-1.90012523-2.0083682-.70004614-4.2175733-.60003954-6.12552305.30001977-2.0083682.90005932-3.41422594 2.50016478-4.11715481 4.5002966-.20083682.50003295-.80334728.80005275-1.30543933.60003954-.50209205-.10000659-.80334728-.70004613-.60251046-1.20007909.90376569-2.60017136 2.71129707-4.60030318 5.12133891-5.70037568 2.41004184-1.20007909 5.12133894-1.30008569 7.63179914-.40002637 1.4058578.50003296 2.7112971 1.30008569 3.7154812 2.40015819l3.0125523 2.70017795v-3.70024386c0-.60003955.4016736-1.00006591 1.0041841-1.00006591s1.0041841.40002636 1.0041841 1.00006591v6.00039545.10000662c0 .1000066 0 .2000132-.1004184.3000197zm-3.1129707 3.7002439c-.5020921-.2000132-1.1046025.1000066-1.3054394.6000396-.4016736 1.1000725-1.0041841 2.200145-1.9079497 3.0001977-1.4058578 1.5000989-3.5146444 2.3001516-5.623431 2.3001516-2.10878662 0-4.11715482-.8000527-5.72384938-2.4001582l-2.81171548-2.6001714h3.51464435c.60251046 0 1.0041841-.4000263 1.0041841-1.0000659 0-.6000395-.40167364-1.0000659-1.0041841-1.0000659h-6.0251046c-.10041841 0-.10041841 0-.20083682 0s-.10041841 0-.20083682 0c0 0-.10041841 0-.10041841.1000066-.10041841 0-.20083682.1000066-.20083682.2000132s0 .1000066-.10041841.1000066c0 .1000066-.10041841.1000066-.10041841.2000132v.2000131.1000066 6.0003955c0 .6000395.40167364 1.0000659 1.0041841 1.0000659s1.0041841-.4000264 1.0041841-1.0000659v-3.7002439l2.91213389 2.8001846c1.80753138 2.0001318 4.31799163 3.0001977 7.02928871 3.0001977 2.7112971 0 5.2217573-1.0000659 7.1297071-2.9001911 1.0041841-1.0000659 1.9079498-2.3001516 2.4100418-3.7002439.1004185-.6000395-.2008368-1.2000791-.7029288-1.3000857z" transform=""></path></svg>';
$base_64_image = "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";
//ZCRIT-ZOOM OPTIONS
$options = get_option('Zcrit_Zoom_options');
$z_meetings_url = $options['meetings_url'];
$z_sdk = $options['sdk_build']; 
echo '<div id="meetingstartid" class="meetings_zoom">';
if ( is_user_logged_in() AND $havemeta ) {
    echo "<span tooltip='Host a meeting' flow='right' id='button_zoom' class='button_zoom postvariables'><img src='data:image/image/png;base64,".$base_64_image."' alt='Zcrit-Zoom Call'/></span>";
    echo "<span tooltip='Open meeting in new window' flow='right' style='display:none;' id='button_zoom2' class='button_zoom postvariables'><img src='data:image/image/png;base64,".$base_64_image."' alt='Zcrit-Zoom Call'/></span>";
    echo '<span tooltip="Host a new meeting" flow="right" style="display:none; color:black;" id="resetzoom">'.$refreshbutton.'</span>';
    echo "<span style='display:none;' id='zoom_join_link'></span>";
}else{
    echo '<script type="module" src="https://unpkg.com/x-frame-bypass"></script>';
    echo "<span tooltip='Host a meeting' flow='right' style='display:none;' id='button_zoom' class='button_zoom postvariables'><img src='data:image/image/png;base64,".$base_64_image."' alt='Zcrit-Zoom Call'/></span>";
    echo "<span tooltip='Open meeting in new window' flow='right' style='display:none;' id='button_zoom2' class='button_zoom postvariables'><img src='data:image/image/png;base64,".$base_64_image."' alt='Zcrit-Zoom Call'/></span>";
    echo '<span tooltip="Host a new meeting" flow="right" style="display:none; color:black;" id="resetzoom">'.$refreshbutton.'</span>';
    echo "<span onClick='window.location.reload();' style='display:none; background:black; padding: 5px 10px;' id='activation_fail' class='activation_fail'>error, try again!</span>";
    echo "<span id='button_user' class='button_zoom activationbutton'>Click to Activate Zoom<div id='loader' class='loader'></div></span>";
    echo "<span style='display:none;' id='zoom_join_link'></span>";
}
echo '</div>';
?>
<script>
(function($) {
jQuery(function( $ ) {
    $('#resetzoom').on('click', function () {
        document.getElementById("button_zoom").style.display = "block";
        document.getElementById("button_zoom2").style.display = "none";
        document.getElementById("resetzoom").style.display = "none";
    });
});
})( jQuery );  
</script>
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
           // document.getElementById("zoom_join_link").innerHTML = join;
            if(typeof zoom_join_link_set === "function"){
              zoom_join_link_set(join);
            }
            document.getElementById("button_zoom").style.display = "none";
            document.getElementById("button_zoom2").style.display = "block";
            document.getElementById("resetzoom").style.display = "block";
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
           // document.getElementById("zoom_join_link").innerHTML = join;
            if(typeof zoom_join_link_set === "function"){
              zoom_join_link_set(join);
            }
            document.getElementById("button_zoom").style.display = "none";
            document.getElementById("button_zoom2").style.display = "block";
            document.getElementById("button_zoom2").innerHTML = '<a target="_blank" href='+hosturl+'><img src="data:image/image/png;base64,<?php echo $base_64_image; ?>" alt="Zcrit-Zoom Call"/></a>';
            window.open(hosturl, '_blank');     
        });
    });
});
})( jQuery );
</script>
<?php } ?>