<?php
require_once plugin_dir_path(__FILE__) . '/jwt/BeforeValidException.php';
require_once plugin_dir_path(__FILE__) . '/jwt/ExpiredException.php';
require_once plugin_dir_path(__FILE__) . '/jwt/SignatureInvalidException.php';
require_once plugin_dir_path(__FILE__) . '/jwt/JWT.php';

use \Firebase\JWT\JWT;

class Zoom_Api
{    
    protected function sendRequest($data)
    {
        $current_user = wp_get_current_user();
        $userID = $current_user->ID;
        $user_stored = get_user_meta($userID, 'zxzzoomactive_'.$userID.'_user');
        $zcrit_user_email = $user_stored[0];
        $request_user_variable = $zcrit_user_email;
        $current_url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        if ($request_user_variable) {
            $request_url = 'https://api.zoom.us/v2/users/'.$request_user_variable.'/meetings';
            $headers = array(
        "authorization: Bearer ".$this->generateJWTKey(),
        'content-type: application/json'
      );
            $postFields = json_encode($data);
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_URL, $request_url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $response = curl_exec($ch);
            $err = curl_error($ch);
            curl_close($ch);
            if (!$response) {
                return $err;
            }
            return json_decode($response);
        }
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
    //CREATE MEETING
    public function createAMeeting($data = array())
    {
        $post_time  = $data['start_date'];
        $start_time = gmdate("Y-m-d\TH:i:s", strtotime($post_time));
        $createAMeetingArray = array();
        if (! empty($data['alternative_host_ids'])) {
            if (count($data['alternative_host_ids']) > 1) {
                $alternative_host_ids = implode(",", $data['alternative_host_ids']);
            } else {
                $alternative_host_ids = $data['alternative_host_ids'][0];
            }
        }
        $createAMeetingArray['topic']      = $data['meetingTopic'];
        $createAMeetingArray['agenda']     = ! empty($data['agenda']) ? $data['agenda'] : "";
        $createAMeetingArray['type']       = ! empty($data['type']) ? $data['type'] : 2; //Scheduled
        $createAMeetingArray['start_time'] = $start_time;
        $createAMeetingArray['timezone']   = $data['timezone'];
        $createAMeetingArray['password']   = ! empty($data['password']) ? $data['password'] : "";
        $createAMeetingArray['duration']   = ! empty($data['duration']) ? $data['duration'] : 60;
        $createAMeetingArray['settings']   = array(
                'join_before_host'  => ! empty($data['join_before_host']) ? true : false,
                'waiting_room'      => ! empty($data['waiting_room']) ? true : false,
                'host_video'        => ! empty($data['option_host_video']) ? true : false,
                'participant_video' => ! empty($data['option_participants_video']) ? true : false,
                'mute_upon_entry'   => ! empty($data['option_mute_participants']) ? true : false,
                'enforce_login'     => ! empty($data['option_enforce_login']) ? true : false,
                'auto_recording'    => ! empty($data['option_auto_recording']) ? $data['option_auto_recording'] : "none",
                'alternative_hosts' => isset($alternative_host_ids) ? $alternative_host_ids : ""
            );
        return $this->sendRequest($createAMeetingArray);
    }
}
//EXECUTE OUTPUT
$zoom_meeting = new Zoom_Api();
try {
      $z = $zoom_meeting->createAMeeting(
          array(
      'start_date'=>date("Y-m-d h:i:s", strtotime('now')),
      'meetingTopic'=>'ZcritZoom',
      'timezone'=>'Europe/Plovdiv',
      "type" => 2,
      "duration" => "30",
      "password" => "123456",
      "waiting_room" => false,
      "join_before_host" => true
     )
      );
      echo $z->start_url;
      echo ',';
      echo $z->join_url;
      echo ',';
      echo $z->id;
      echo ',';
      echo $z->password;
      echo ',';
      echo $z->host_email;  
  } catch (Exception $ex) {
      echo $ex;
}