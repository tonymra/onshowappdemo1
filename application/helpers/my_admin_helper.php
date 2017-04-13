<?php
  
function checkadminlogin()
{
    $ci =& get_instance();
    if($ci->session->userdata('admin') == null)
    {
        warning_msg(' Please login to access this page.');
		header('Location: /admin/login');
        exit;   
    }
}


  
function admin()
{
    $ci =& get_instance();   
    return $ci->session->userdata('admin');
}

function user()
{
    $ci =& get_instance();   
    return $ci->session->userdata('user');
}

?>
