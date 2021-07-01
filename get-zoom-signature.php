<?php
define( 'WP_USE_THEMES', false );
require_once( $_SERVER[ 'DOCUMENT_ROOT' ] . '/wp-load.php' ); 
//ZCRIT-ZOOM OPTIONS
$options = get_option('Zcrit_Zoom_options');
$z_api_secret = $options['api_secret'];
$apiSecret 	= $z_api_secret;
//SIGNATURE OPTIONS
$meetingData 	= json_decode(file_get_contents('php://input'), true);
$apiKey 		= isset( $meetingData['meetingData']['apiKey'] ) 		? $meetingData['meetingData']['apiKey'] 		: '';
$meetingNumber 	= isset( $meetingData['meetingData']['meetingNumber'] ) ? $meetingData['meetingData']['meetingNumber'] 	: '';
$role 			= isset( $meetingData['meetingData']['role'] ) 			? $meetingData['meetingData']['role'] 			: '';
print generate_signature( $apiKey, $apiSecret, $meetingNumber, $role);
function generate_signature ( $api_key, $api_secret, $meeting_number, $role){
    date_default_timezone_set("UTC");
	$time = time() * 1000 - 30000;
	$data = base64_encode($api_key . $meeting_number . $time . $role);
	$hash = hash_hmac('sha256', $data, $api_secret, true);
	$_sig = $api_key . "." . $meeting_number . "." . $time . "." . $role . "." . base64_encode($hash);
	return rtrim(strtr(base64_encode($_sig), '+/', '-_'), '=');
}
?>