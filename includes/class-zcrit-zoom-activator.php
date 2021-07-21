<?php

/**
 * Fired during plugin activation
 *
 * @link       Zcrit
 * @since      1.0.0
 *
 * @package    Zcrit_Zoom
 * @subpackage Zcrit_Zoom/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Zcrit_Zoom
 * @subpackage Zcrit_Zoom/includes
 * @author     Zcrit <Zcrit-Zoom@Zcrit.com>
 */
class Zcrit_Zoom_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {

		$sdk_template = "<?php\n"
        . "/*\n"
        . "* Template Name: ZoomSdk\n"
		. "*\n"
		. "* @package WordPress\n"
        . "*/\n"
		. "\$meeting = \$_REQUEST['meeting'];\n"
		. "\$password = \$_REQUEST['password'];\n"
		. "\$host = \$_REQUEST['host'];\n"
		. "\$current_user = wp_get_current_user();\n"
		. "\$userID = \$current_user->ID;\n"
		. "\$user_stored = get_user_meta(\$userID, 'zxzzoomactive_'.\$userID.'_user');\n"
		. "\$zcrit_user_email = \$user_stored[0];\n"
        . "\$email = \$zcrit_user_email;\n"
		. "\$user = \$current_user->display_name;\n"
		. "\$button = 'Join';\n"
		. "if(\$host){\n"
		. "\$button = 'Start';\n"
		. "}\n"
		. "\$options = get_option('Zcrit_Zoom_options');\n"
		. "\$z_api_key = \$options['api_key'];\n"
		. "\$z_leave_url = \$options['leave_url'];\n"
        . "?>\n"
        . "<!DOCTYPE html>\n"
. "<head>\n"
. "    <title>Zcrit-Zoom Call</title>\n"
. "    <meta charset='utf-8' />\n"
. "    <link type='text/css' rel='stylesheet' href='/wp-content/plugins/zcrit-zoom/public/css/1.9.5/bootstrap.css' />\n"
. "    <link type='text/css' rel='stylesheet' href='/wp-content/plugins/zcrit-zoom/public/css/1.9.5/react-select.css' />\n"
. "    <link type='text/css' rel='stylesheet' href='/wp-content/plugins/zcrit-zoom/public/css/zcrit-zoom-public.css' />\n"
. "    <meta name='format-detection' content='telephone=no'>\n"
. "    <meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no'>\n"
. "</head>\n"
. "<body>\n"
. "    <nav style='display:none;' id='nav-tool' class='navbar navbar-inverse navbar-fixed-top'>\n"
. "        <div class='container'>\n"
. "            <div class='navbar-header'>\n"
. "                <a class='navbar-brand' href='#'>Zcrit-Zoom</a>\n"
. "            </div>\n"
. "            <div id='navbar' class='websdktest'>\n"
. "                <form class='navbar-form navbar-right' id='meeting_form'>\n"
. "                    <div class='form-group'>\n"
. "                        <input readonly type='text' name='meetingNumber' id='meetingNumber' style='visibility:hidden;' value='<?php echo \$meeting; ?>' maxLength='200' style='width:150px' placeholder='Meeting Number' class='form-control' required>\n"
. "                    </div>\n"
. "                    <div class='form-group'>\n"
. "                        <input readonly type='text' name='meetingPassword' id='meetingPassword' style='visibility:hidden;' value='<?php echo \$password; ?>' style='width:150px' maxLength='32' placeholder='Meeting Password' class='form-control'>\n"
. "                    </div>\n"
. "                    <div class='form-group'>\n"
. "                        <input type='text' name='userName' id='userName' value='<?php echo \$user; ?>' maxLength='100' placeholder='Name' class='form-control' required>\n"
. "                    </div>\n"
. "                    <div class='form-group'>\n"
. "                        <input type='text' name='userEmail' id='userEmail' value='<?php echo \$email; ?>' style='width:150px' maxLength='32' placeholder='Email option' class='form-control'>\n"
. "                    </div>\n"
. "                    <div class='form-group'>\n"
. "                        <select id='meetingRole' class='sdk-select'>\n"
. "                           <?php if(\$host){ ?>\n"
. "                           <option value=1>Host</option>\n"
. "                           <?php }else{ ?> \n"
. "                           <option value=0>Attendee</option>\n"
. "                            <?php } ?> \n" 
. "                        </select>\n"
. "                    </div>  \n"
. "                    <input type='hidden' id='meeting_lang' value='en-US' />\n"
. "                    <input type='hidden' id='meeting_china' value='0' />\n"
. "                    <input type='hidden' value='' id='copy_link_value' />\n"
. "                    <button type='submit' class='btn btn-primary' id='join_meeting'><?php echo \$button; ?></button> \n"
. "                </form>\n"
. "            </div>\n"
. "        </div>\n"
. "    </nav>\n"
. "    <script src='/wp-content/plugins/zcrit-zoom/public/js/1.9.5/react.min.js'></script>\n"
. "    <script src='/wp-content/plugins/zcrit-zoom/public/js/1.9.5/react-dom.min.js'></script>\n"
. "    <script src='/wp-content/plugins/zcrit-zoom/public/js/1.9.5/redux.min.js'></script>\n"
. "    <script src='/wp-content/plugins/zcrit-zoom/public/js/1.9.5/redux-thunk.min.js'></script>\n"
. "    <script src='/wp-content/plugins/zcrit-zoom/public/js/1.9.5/lodash.min.js'></script>\n"
. "    <script src='/wp-content/plugins/zcrit-zoom/public/js/1.9.5/zoom-meeting-1.9.5.min.js'></script>\n"
. "    <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>\n"
. "   <script>\n"
. "   window.addEventListener('DOMContentLoaded', function(event) {\n"
. "    console.log('DOM fully loaded and parsed');\n"
. "    websdkready();\n"
. "    if(\$('#join_meeting').length){ \$('#join_meeting').trigger('click'); }\n"
. "    });\n"
. "    function websdkready() {\n"
. "        ZoomMtg.preLoadWasm();\n"
. "        ZoomMtg.prepareWebSDK();\n"
. "        // click join meeting button\n"
. "        document\n"
. "             .getElementById('join_meeting')\n"
. "             .addEventListener('click', function (e) {\n"
. "                e.preventDefault();\n"
. "                const meetConfig = {\n"
. "                    apiKey: '<?php echo \$z_api_key; ?>',\n"
. "                    signatureEndpoint: '/wp-content/plugins/zcrit-zoom/get-zoom-signature.php',\n"
. "                    meetingNumber: document.getElementById('meetingNumber').value.replace(/ /g, ''),\n"
. "                    leaveUrl: '<?php echo \$z_leave_url; ?>',\n"
. "                    userName: document.getElementById('userName').value,\n"
. "                    userEmail: document.getElementById('userEmail').value,\n"
. "                    passWord: document.getElementById('meetingPassword').value,\n"
. "                    role: document.getElementById('meetingRole').value // 1 for host; 0 for attendee\n"
. "                };\n"
. "                //console.log({meetConfig});\n"
. "                if (!meetConfig.meetingNumber || !meetConfig.userName) {\n"
. "                    alert('Meeting number or username is empty');\n"
. "                    return false;\n"
. "                }\n"
. "                fetch( meetConfig.signatureEndpoint, {\n"
. "                    method: 'POST',\n"
. "                    body: JSON.stringify({ meetingData: meetConfig })\n"
. "                })       \n"
. "                .then(result => result.text())\n"
. "                .then(response => {         \n"
. "                    ZoomMtg.init({\n"
. "                        leaveUrl: meetConfig.leaveUrl,\n"
. "                        isSupportAV: true,\n"
. "                        success: function (res) {\n"
. "                            ZoomMtg.join({\n"
. "                                    signature: response,\n"
. "                                    meetingNumber: meetConfig.meetingNumber,\n"
. "                                    userName: meetConfig.userName,\n"
. "                                    apiKey: meetConfig.apiKey,\n"
. "                                    //userEmail: 'user@gmail.com',\n"
. "                                    passWord: meetConfig.passWord,\n"
. "                                    success: function(res){\n"
. "                                        console.log('join meeting success');\n"
. "                                        document.getElementById('nav-tool').style.display = 'none';                                 \n"
. "                                        //var joinUrl = 'meeting.html?' + testTool.serialize(meetConfig);\n"
. "                                        //window.open(joinUrl, '_blank');\n"
. "                                    },\n"
. "                                    error: function(res) {\n"
. "                                        console.log(res);\n"
. "                                    }\n"
. "                            })\n"
. "                        }\n"
. "                    })\n"
. "                    \n"
. "                })\n"
. "            });\n"
. "    }\n"
. "   </script>\n"
. "   <script>window.addEventListener('unload', ()=> { window.close(); });</script>\n"
. "</body>\n"
. "</html>\n";
		
		$handle = fopen( get_stylesheet_directory() . '/zoomsdk.php', 'w' );
		fwrite( $handle, $sdk_template );
		fclose( $handle );

	}

}