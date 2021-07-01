<?php
$current_user = wp_get_current_user();
$userID = $current_user->ID; 
$havemeta = get_user_meta($userID, 'ZOOM_ACTIVE', true);
echo '<div class="meetings_zoom">';
if ( is_user_logged_in() AND $havemeta ) {
    //ZCRIT-ZOOM OPTIONS
    $options = get_option('Zcrit_Zoom_options');
    $z_meetings_url = $options['meetings_url'];
    $z_sdk = $options['sdk_build']; 
    echo "<span id='button_zoom' class='button_zoom postvariables'>Host Meeting</span>";
    echo "<span style='display:none;' id='button_zoom2' class='button_zoom postvariables'>Host Meeting</span>";
}else{
    echo "<span class='paragraph_zoom'>Activate your zoom account with Zcrit to use this feature. </br> Please hit the 'Activate Zoom' button to rpoceed.</span>";
    echo "<span id='button_user' class='button_zoom'>Activate Zoom</span>";
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
        jQuery.post(ajaxurl, data, function(response) {
          //alert('response from the server: ' + response);
          location.reload();
            
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
            $('</br><span>' + join + '</span>').insertAfter('#button_zoom');
            document.getElementById("button_zoom").style.display = "none";
            document.getElementById("button_zoom2").style.display = "block";
            document.getElementById("button_zoom2").innerHTML = '<a target="_blank" href='+root+'>Start Meeting</a>';
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
            $('</br><span>' + joinurl + '</span>').insertAfter('#button_zoom');
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