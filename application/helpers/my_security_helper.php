<?php

require_once('safesql/SafeSQL.class.php');

function squery($sql,$params)
{
    $sql = str_replace('%s','\'%s\'',$sql);       
    $safesql = new SafeSQL_MySQL();
    $newsql = $safesql->query($sql,$params);  
    $ci =& get_instance();
//    echo $newsql . '<br >';
    return $ci->db->query($newsql);
}
  
function test_sql_injection($value) {
    $retval=false;
    if (!is_array($value)) {    
        $value=urlencode($value);
        if(contains($value,'select * from'))
            return true;
        else if(contains($value,'delete from'))
            return true;
    }
    return $retval;
}

function protect($string) 
 { 
    if (ini_get('magic_quotes_gpc') == 'off') // check if magic_quotes_gpc is on and if not add slashes
    { 
        $string = addslashes($string); 
    }  
    // move html tages from inputs
    $string = htmlentities($string, ENT_QUOTES);
    //removing most known vulnerable words
    $codes = array("script","java","applet","iframe","meta","object","html", "<", ">", ";", "'","%");
    $string = str_replace($codes,"",$string);
    //return clean string
    return $string; 
}

function sget($fieldname,$html = false)
{
    $ci =& get_instance();
    if(isset($_GET[$fieldname]))
    {
        if(test_sql_injection($_GET[$fieldname]))
        {
            echo 'Invalid or suspicious query data detected.';
            exit;
        }
        else
        {
            if($html)
                return $_GET[$fieldname];
            else
                return protect($_GET[$fieldname]);
        }
    }
    else if($ci->input->post($fieldname))
    {
        if(test_sql_injection($ci->input->post($fieldname)))
        {
            echo 'Invalid or suspicious query data detected.';
            exit;
        }
        else        
        {
            if($html)
                return $ci->input->post($fieldname);
            else
                return protect($ci->input->post($fieldname));
        }
    }
    return null;
}

  
?>
