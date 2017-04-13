<?php
  
function sendemail($from,$to,$subject,$msg,$attachments)
{        
    $ci =& get_instance();   

    $config['protocol'] = 'mail';
    $config['charset'] = 'iso-8859-1';    
    $config['mailtype'] = 'html';
    
    /*$config['smtp_host'] = 'mail.ernic.co.za';
    $config['smtp_user'] = 'erhard@ernic.co.za';
    $config['smtp_pass'] = 'Verb@tim2';
    $config['smtp_port'] = '25';     */
    $ci->email->initialize($config);

    if($attachments != null)
    {
        foreach($attachments as $attachment)
        {
            $ci->email->attach($attachment);
        }
    }
    
    $ci->email->from($from);
    $ci->email->to($to);
	$ci->email->cc('tony27500@gmail.com'); 
    $ci->email->subject($subject);
    $ci->email->message($msg);
    $ci->email->send();     
}
  
?>
