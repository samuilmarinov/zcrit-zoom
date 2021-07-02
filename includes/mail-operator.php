<?php 
require_once plugin_dir_path(__FILE__) . '/EmailReader.php';
        sleep(45);  
        $email = new EmailReader();
        $emailz = $email->inbox();
        foreach($emailz as $inboxemail){
            $hour_ago = strtotime('-5 minutes');
            $dateemail = $inboxemail['header']->udate;
            if($dateemail > $hour_ago ){
                $message = $inboxemail;
                $body = $message['body'];
                $dom = new DomDocument();
                $dom->loadHTML($body);
                $links = $dom->getElementsByTagName('a');
                $activation_link_text = $links[2]->textContent;
                $pattern = "/=\s/i";
                $string = preg_replace($pattern, '', $activation_link_text);
                $string2 = str_replace(' ', '', $string);  
                $string3 = str_replace('3D', '', $string2);
                $activation_link = str_replace('activate_help?', 'activate?', $string3); 
                $subject = $message['header']->subject;
                if($activation_link != '' && $subject == 'Zoom account invitation'){
                
                    print_r($activation_link);
     
                    break; 
                }          
            }	
        }
      
?>

