<?php
require_once plugin_dir_path(__FILE__) . '/jwt/BeforeValidException.php';
require_once plugin_dir_path(__FILE__) . '/jwt/ExpiredException.php';
require_once plugin_dir_path(__FILE__) . '/jwt/SignatureInvalidException.php';
require_once plugin_dir_path(__FILE__) . '/jwt/JWT.php';

use \Firebase\JWT\JWT;

class Zoom_Api
{
    protected function deleteUser()
    {
        $current_user = wp_get_current_user();
        //$request_user_variable = $current_user->user_email;
        $request_user_variable = $zcritzoomuserdelete;
        $current_url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $request_url = 'https://api.zoom.us/v2/users/'.$request_user_variable.'/';
        $headers = array(
		        "authorization: Bearer ".$this->generateJWTKey(),
		        'content-type: application/json',
		);    
        $data = '{"action":"delete"}';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $request_url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
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
  
    public function deleteAUser($data = array())
    {
        return $this->deleteUser();
    }
}
$zoom_user = new Zoom_Api();
try {
      $z = $zoom_user->deleteAUser();
     print_r($z);
} catch (Exception $ex) {
      echo $ex;
}