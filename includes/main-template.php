<?php
$current_user = wp_get_current_user();
$userID = $current_user->ID; 
$havemeta = get_user_meta($userID, 'ZOOM_ACTIVE', true);
$user_stored = get_user_meta($userID, 'zxzzoomactive_'.$userID.'_user');
$the_email = $user_stored[0];
$errorpage = '<!DOCTYPE html> <html> <head> <title>Zoom Activation Error</title> <style> body { margin: 0; padding: 0; background: #FFFFFF; text-align: center; } .button_close_zoom{ cursor:pointer; padding: 15px; background: red; color: white; font-size: 1.6rem; border-radius: 30px; } #page-wrap { width: 90%; margin: 0 auto; } #loader-wrap { width: 30%; height: 140px; min-width: 300px; max-width: 600px; margin: 50px auto; } #logo-wrap { display: block; width: 150px; height: 150px; background: white; border-radius: 50%; box-shadow: 3px 3px 0px 1px rgba(0, 0, 0, 0.1); margin: 0 auto; } #logo { padding-top:29%; transform:scale(0.8); width: 150px; height: 50px; margin: 5px; border-radius: 50%; opacity: 1; } #spinner { width: 147px; height: 147px; position: relative; top: -150px; margin: 0 auto; border-top: 4px solid rgba(229, 0, 0, 1); border-right: 4px solid rgba(0, 0, 0, 0); border-left: 4px solid rgba(0, 0, 0, 0); border-radius: 50%; animation: spin-bot 1s ease-in-out infinite; } h1 { font: 32px Open Sans; color: #4A4949; } @keyframes spin-bot { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } } @keyframes cursor-flash { 0% { opacity: 1; } 48% { opacity: 1; } 50% { opacity: 0; } 80% { opacity: 1; } 100% { opacity: 1; } } </style> </head> <body> <div id="page-wrap"> <section id="loader-wrap"> <div id="logo-wrap"></div> <div id="spinner"></div> </section> </section> </div> <h1 class="button_close_zoom_x"><b class="button_close_zoom">activation error please try again</b></h1> </body> </html>';
$loadingpage = '<!DOCTYPE html> <html> <head><title>Zcrit - Zoom Activation</title> <style> body { margin: 0; padding: 0; background: #FFFFFF; text-align: center; } #page-wrap { width: 90%; margin: 0 auto; } #loader-wrap { width: 30%; height: 140px; min-width: 300px; max-width: 600px; margin: 50px auto; } #logo-wrap { display: block; width: 150px; height: 150px; background: white; border-radius: 50%; box-shadow: 3px 3px 0px 1px rgba(0, 0, 0, 0.1); margin: 0 auto; } #logo { padding-top:29%; transform:scale(0.8); width: 150px; height: 50px; margin: 5px; border-radius: 50%; opacity: 1; } #spinner { width: 147px; height: 147px; position: relative; top: -150px; margin: 0 auto; border-top: 4px solid rgba(229, 0, 0, 1); border-right: 4px solid rgba(0, 0, 0, 0); border-left: 4px solid rgba(0, 0, 0, 0); border-radius: 50%; animation: spin-bot 1s ease-in-out infinite; } h1 { font: 32px Open Sans; color: #4A4949; } @keyframes spin-bot { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } } @keyframes cursor-flash { 0% { opacity: 1; } 48% { opacity: 1; } 50% { opacity: 0; } 80% { opacity: 1; } 100% { opacity: 1; } } </style> </head> <body> <div id="page-wrap"> <section id="loader-wrap"> <div id="logo-wrap"></div> <div id="spinner"></div> </section> </section> </div> <h1><b>please wait for initial zoom activation</b></h1> </body> </html>';
$refreshbutton = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"><rect id="backgroundrect" width="100%" height="100%" x="0" y="0" fill="none" stroke="none"/><g class="currentLayer" style=""><title>Layer 1</title><path d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm4.5 17.311l-1.76-3.397-1.032.505c-1.12.543-3.4-3.91-2.305-4.497l1.042-.513-1.747-3.409-1.053.52c-3.601 1.877 2.117 12.991 5.8 11.308l1.055-.517z" id="svg_1" class="selected" fill="#6767e7" fill-opacity="1"/></g></svg>';
$base_64_image = "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";
//ZCRIT-ZOOM OPTIONS
$options = get_option('Zcrit_Zoom_options');
$z_meetings_url = $options['meetings_url'];
$z_sdk = $options['sdk_build'];
echo '<div class="modal" id="modal-loading" data-backdrop="static"> <div class="modal-dialog modal-sm"> <div class="modal-content modzoom"> <div class="modal-body text-center center-center"> <div class="loading-spinner mb-2"></div> <div>please wait for initial zoom activation <span onClick="window.location.reload();" style="color:white; display:none; background:black; padding: 5px 10px;" id="activation_fail" class="activation_fail">error, try again!</span></div> </div> </div> </div> </div>'; 
echo '<div id="meetingstartid" class="meetings_zoom">';
if ( is_user_logged_in() AND $havemeta ) {
    echo "<span tooltip='Host a meeting' flow='right' id='button_zoom' class='button_zoom postvariables'><img src='data:image/image/png;base64,".$base_64_image."' alt='Zcrit-Zoom Call'/></span>";
    echo "<span tooltip='Open meeting in new window' flow='right' style='display:none;' id='button_zoom2' class='button_zoom postvariables'><img src='data:image/image/png;base64,".$base_64_image."' alt='Zcrit-Zoom Call'/></span>";
    echo '<span class="call-animation" tooltip="In meeting ..." flow="right" style="display:none; color:black;" id="resetzoom">'.$refreshbutton.'</span>';
}else{
    echo '<script type="module" src="https://unpkg.com/x-frame-bypass"></script>';
    echo "<span tooltip='Host a meeting' flow='right' style='display:none;' id='button_zoom' class='button_zoom postvariables'><img src='data:image/image/png;base64,".$base_64_image."' alt='Zcrit-Zoom Call'/></span>";
    echo "<span tooltip='Open meeting in new window' flow='right' style='display:none;' id='button_zoom2' class='button_zoom postvariables'><img src='data:image/image/png;base64,".$base_64_image."' alt='Zcrit-Zoom Call'/></span>";
    echo '<span class="call-animation" tooltip="In meeting ..." flow="right" style="display:none; color:black;" id="resetzoom">'.$refreshbutton.'</span>';
    echo "<span tooltip='Initial activation pending, click to proceed' flow='right' id='button_user' class='button_zoom postvariables'><img src='data:image/image/png;base64,".$base_64_image."' alt='Zcrit-Zoom Call'/></span>";
}
echo '</div>';
?>
<script>
(function($) {
jQuery(function( $ ) {
    $('#resetzoom').on('click', function () {
        // document.getElementById("button_zoom").style.display = "block";
        // document.getElementById("button_zoom2").style.display = "none";
        // document.getElementById("resetzoom").style.display = "none";
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
        document.getElementById("button_zoom").style.display = "none";
        document.getElementById("button_user").style.display = "none";
        let sdkwin = window.open('', 'ZoomSdk');
        sdkwin.document.body.innerHTML = '<?php echo $loadingpage ?>';
        sdkwin.blur();
        window.focus();
        var data = {
            action: 'zcrit_zoom_user_action',
            zcritzoomuser: ''
        };
        $('#modal-loading').show();
        jQuery.post(ajaxurl, data, function(response) {
          //alert('response from the server: ' + response);
          var urlopen = response;
          var islink = urlopen.includes("https");
          if(urlopen != 'FAIL' && urlopen != '' && islink === true){
            console.log('GOT IT');
          $('<iframe id="iframe_hk" is="x-frame-bypass" src="'+urlopen+'" style="opacity:0; border:0px #ffffff none;" name="myiFrame" scrolling="no" frameborder="1" marginheight="0px" marginwidth="0px" height="50px" width="50px" allowfullscreen></iframe>').insertAfter("#content");
              setTimeout(function () {        
                 $('#button_zoom').show();
                 $('#modal-loading').hide();
                 $('#button_user').hide(); 
                 $('#iframe_hk').remove();
                 document.getElementById('button_zoom').click();
              }, 10000);  
            }else{
              $('#activation_fail').show();
              $('#button_user').hide();
              console.log('ERROR');
              var root = '';
              if(typeof zoom_host_link_close === "function"){
                  zoom_host_link_close(root, sdkwin);
              }
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
        document.getElementById("button_zoom").style.display = "none";
        let sdkwin = window.open('', 'ZoomSdk');
        sdkwin.blur();
        window.focus();
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
            if(typeof zoom_join_link_set === "function"){
              zoom_join_link_set(join);
            }
            document.getElementById("button_zoom").style.display = "none";
            document.getElementById("resetzoom").style.display = "block";
            document.getElementById("button_zoom2").innerHTML = '<a target="_blank" href='+root+'><img src="data:image/image/png;base64,<?php echo $base_64_image; ?>" alt="Zcrit-Zoom Call"/></a>';
            if(typeof zoom_host_link_set === "function"){
              zoom_host_link_set(root, sdkwin);
            }
                  
        });
        var intervalcheck = window.setInterval(function() {
           if(sdkwin.closed == true){
            document.getElementById("button_zoom").style.display = "block";
            document.getElementById("button_zoom2").style.display = "none";
            document.getElementById("resetzoom").style.display = "none";
            clearInterval(intervalcheck);
           }else if(sdkwin.closed == false){
              document.getElementById("button_zoom").style.display = "none";
           }
           console.log(sdkwin.closed);
        }, 1000);



    });

});
})( jQuery );
</script>
<script>
var isTriggered = false;  
function zoom_host_link_set(root, sdkwin){
    if(!isTriggered){
              sdkwin.location = root;
             //sdkwin.opener = null;
              sdkwin.blur();
              window.focus(); 
    } 
}
</script>
<script>
var isTriggeredClose = false;
function zoom_host_link_close(root, sdkwin){
    if(!isTriggeredClose){
              sdkwin.document.body.innerHTML = '<?php echo $errorpage ?>';
              //sdkwin.location = root;
              //sdkwin.opener = null;
              setTimeout(function(){ sdkwin.close(); },2000);
    }
}
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
            if(typeof zoom_join_link_set === "function"){
              zoom_join_link_set(join);
            }
            document.getElementById("button_zoom").style.display = "none";
            document.getElementById("resetzoom").style.display = "block";
            document.getElementById("button_zoom2").innerHTML = '<a target="_blank" href='+hosturl+'><img src="data:image/image/png;base64,<?php echo $base_64_image; ?>" alt="Zcrit-Zoom Call"/></a>';
            var newWin = window.open(root, '_blank');             
            if(!newWin || newWin.closed || typeof newWin.closed=='undefined') 
            { 
               document.getElementById("button_zoom2").style.display = "block";
            }    
        });
    });
});
})( jQuery );
</script>
<?php } ?>