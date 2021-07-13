<?php
$current_user = wp_get_current_user();
$userID = $current_user->ID; 
$havemeta = get_user_meta($userID, 'ZOOM_ACTIVE', true);    
if ( is_user_logged_in() AND $havemeta ) {
    echo "<span id='button_user_delete' class='button_zoom button_zoom_delete'>Deactivate Zoom</span>";
}
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