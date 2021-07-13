<?php
require_once plugin_dir_path(__FILE__) . '/jwt/BeforeValidException.php';
require_once plugin_dir_path(__FILE__) . '/jwt/ExpiredException.php';
require_once plugin_dir_path(__FILE__) . '/jwt/SignatureInvalidException.php';
require_once plugin_dir_path(__FILE__) . '/jwt/JWT.php';


use \Firebase\JWT\JWT;

class Zoom_Api
{
    protected function createUser()
    {       

        $current_user = wp_get_current_user();
        $userID = $current_user->ID;
        $user_stored = get_user_meta($userID, 'zxzzoomactive_'.$userID.'_user');
        $zcrit_user_email = $user_stored[0];
        $request_user_variable = $zcrit_user_email;

        $user_firstname = $current_user->user_firstname;
        $user_lastname = $current_user->user_lastname;
        $current_url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		$request_url = 'https://api.zoom.us/v2/users/';
		            $headers = array(
		        "authorization: Bearer ".$this->generateJWTKey(),
		        'content-type: application/json'
		);
      	$data = '{"action":"create","user_info":{"email":"'.$request_user_variable.'","type":1,"first_name":"'.$user_firstname.'","last_name":"'.$user_lastname.'"}}';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $request_url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        if (!$response) {
                return $err;
        }
        return json_decode($response);
    }
    //GENERATE JWT
    private function generateJWTKey()
    {
        $options = get_option('Zcrit_Zoom_options');
        $z_api_key = $options['api_key'];
        $z_api_secret = $options['api_secret'];
        $key = $z_api_key;
        $secret = $z_api_secret;
        $token = array(
                "iss" => $key,
                "exp" => time() + 3600 // 60 seconds
            );
        return JWT::encode($token, $secret);
    }
  
    public function createAUser($data = array())
    {
        return $this->createUser();
    }
}
$zoom_user = new Zoom_Api();
try {
     $z = $zoom_user->createAUser();
    // print_r($z);
} catch (Exception $ex) {
      echo $ex;
}