
<?php 

	function send_email($to,$subject,$body)
	{
		$CI =& get_instance();
		$config['protocol']='smtp';
		$config['smtp_host']='your host';
		$config['smtp_port']='465';
		$config['smtp_timeout']='30';
		$config['smtp_user']='admin@gig.com';
		$config['smtp_pass']='123456';
		$config['charset']='utf-8';
		$config['newline']="\r\n";
		$config['wordwrap'] = TRUE;
		$config['mailtype'] = 'html';
		$CI->email->initialize($config);

		$CI->email->initialize($config);
		$CI->email->from('admin@gig.com', 'Gigbag');
		$CI->email->to($to);
		//$this->email->cc('another@another-example.com');
	//	$this->email->bcc('them@their-example.com');

		$CI->email->subject($subject);
		$CI->email->message($body);
		if($CI->email->send()==false){
			 $CI->email->print_debugger();
		}
		else
		{
			return true;
		}

		
	}

?>
