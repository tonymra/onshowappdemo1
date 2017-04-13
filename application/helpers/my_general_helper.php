<?php

function form_post()
{
    $ci =& get_instance();
    if($ci->input->post('formpost') == '1')
        return true;
    else
        return false;
}

function insert_id($table)
{
   $ci =& get_instance();  
   $rs = $ci->db->query('select @@identity as id from ' . $table);
   return $rs->row(0)->id;
} 
  
function cbool($value)
{
    if($value == null)
        return 0;
    else if($value == '')
        return 0;
    else if($value == true)
        return 1;
    else if($value == '1')
        return 1;
}

function nullie($value)
{
    if($value == null)
        return null;
    else if($value == "")
        return null;
    else
        return $value;
}

function emptyifnull($value)
{
    if($value == null)
        return '';
    else    
        return $value;
}

function encuri($data)
{
    $ci =& get_instance(); 
    return base64_encode(urlencode($ci->encrypt->encode($data)));
}

function decuri($data)
{
    $ci =& get_instance(); 
    return $ci->encrypt->decode(urldecode(base64_decode($data)));
}

function val($data, $field, $default = '')
{                           
    $ci =& get_instance(); 
    if($ci->input->post(strtolower($field)) != '')
        return trim($ci->input->post(strtolower($field)));
    else if($data == null) return $default;
    else if($data->num_rows() >= 1)
    {
        foreach($data->result_array() as $row)        
            return trim($row[$field]);
    }
    else
        return trim($default);
}

function showdate($date)
{
    if($date == null)
        return '';
    else if($date == '')
        return '';
    else    
        return date('Y-m-d',strtotime($date));
}

function showdatetime($date)
{
    if($date == null)
        return '';
    else if($date == '')
        return '';
    else    
        return date('Y-m-d H:i',strtotime($date));
}

function contains($string, $value)
{                                        
    if($value == null)
        return false;    
    else if(strtoupper(trim($string)) == strtoupper(trim($value)))
        return true;
    else if(strpos(strtoupper(trim($string)),strtoupper(trim($value))) === false)
        return false;
    else
        return true;
}

function currenturl()
{
    return (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
}

function money($num)
{
    if(($num == null) || ($num == ''))
        return '0.00';
    else
    {
        $str = number_format($num,2);
        $str = str_replace(",","",$str);
        return $str;
    }
}

function moneyns($num)
{
    if(($num == null) || ($num == ''))
        return '0.00';
    else
    {
        $str = number_format($num,2);
        $str = str_replace(",","",$str);
        return $str;
    }
}

function num($num)
{
    if(($num == null) || ($num == ''))
        return '0';
    else
        return $num;
}

function get_file_extension($file_name) {
    return substr(strrchr($file_name,'.'),1);
}
  
function arr2commalist($arr)
{
    $list = '';
    foreach($arr as $val)
    {
        if($list != '')
            $list .= ',';
        $list .= $val;
    }
    return $list;
}

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}
  
?>
