<?php

class Sms
{    
    function SendSMS($mobile, $msg)
    {
        $mobile = '27836564309';        
        if(substr($mobile,0,1) == '0')
        {
            $mobile = substr($mobile,1);
            $mobile = '27' . $mobile;
        }
        $url = 'http://api.clickatell.com/http/sendmsg?api_id=3429130&user=erhardsmit&password=NFTOEQBBHDHgIR&to=' . $mobile . '&text=' . urlencode($msg);
        
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
            CURLOPT_USERAGENT => 'ScoBridge Interface'
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        
        //$response = file_get_contents($url);            
        return $response;
    }
}
  
?>