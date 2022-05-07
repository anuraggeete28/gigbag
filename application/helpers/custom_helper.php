<?php 
function get_time($datetime,$full = false)
{

     $now = new DateTime();
     $ago = new DateTime($datetime);
    
    $diff = $now->diff($ago);
    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;
    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v)
    {
        if ($diff->$k)
        {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        }
        else
        {
            unset($string[$k]);
     }
    }
    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';

}
function send_mail($email_data) {
    $ci=& get_instance();
    
    //Load email library
    try {
        $config = array();
        $config['protocol'] = 'sendmail';
        // $config['smtp_host'] = '';
        // $config['smtp_user'] = '';
        // $config['smtp_pass'] = '';
        // $config['smtp_port'] = '';
        $ci->email->initialize($config);
        $from_email = "email@example.com";
        $to_email = $email_data['email'];
        $ci->email->from($from_email, 'GIGBAG');
        $ci->email->to($to_email);
        $ci->email->subject($email_data['subject']);
        $ci->email->message($email_data['body']);
        //Send mail
        if($ci->email->send())
        {   
            return true;
        }
         echo $ci->email->print_debugger();die;
        return false;
    } catch (Exception $e) {
        return $e->Message;
    }
}  
?>