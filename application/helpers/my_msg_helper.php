<?php

function error_msg($msg)  
{
    $ci =& get_instance(); 
    if($ci->session->userdata('error_msg'))   
        $ci->session->set_userdata('error_msg',$ci->session->userdata('error_msg') . ' <br />' . $msg);
    else
        $ci->session->set_userdata('error_msg',$msg);
}

function success_msg($msg)  
{
    $ci =& get_instance(); 
    if($ci->session->userdata('success_msg'))   
        $ci->session->set_userdata('success_msg',$ci->session->userdata('success_msg') . ' <br />' . $msg);
    else
        $ci->session->set_userdata('success_msg',$msg);
}

function info_msg($msg)  
{
    $ci =& get_instance(); 
    if($ci->session->userdata('info_msg'))   
        $ci->session->set_userdata('info_msg',$ci->session->userdata('info_msg') . ' <br />' . $msg);
    else
        $ci->session->set_userdata('info_msg',$msg);
}

function warning_msg($msg)  
{
    $ci =& get_instance(); 
    if($ci->session->userdata('warning_msg'))   
        $ci->session->set_userdata('warning_msg',$ci->session->userdata('warning_msg') . ' <br />' . $msg);
    else
        $ci->session->set_userdata('warning_msg',$msg);
}
  
function display_messages()
{
    $ci =& get_instance();                   

    if($ci->session->userdata('error_msg') != '')
    {       
        echo '    
        <div class="alert alert-warning alert-white rounded">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<div class="icon"><i class="fa fa-warning"></i></div>
            <strong>' . $ci->lang->line('title_error') . '</strong> ' . $ci->session->userdata('error_msg') .
        '</div>';
        
        $ci->session->unset_userdata('error_msg');
    }        
    if($ci->session->userdata('success_msg'))
    {                    
        echo '    
        <div class="alert alert-success alert-white rounded">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<div class="icon"><i class="fa fa-check"></i></div>
            <strong>' . $ci->lang->line('title_success') . '</strong> ' . $ci->session->userdata('success_msg') .
        '</div>';
        $ci->session->unset_userdata('success_msg');
    }   
    if($ci->session->userdata('info_msg'))
    {                    
        echo '    
        <div class="alert alert-warning alert-white rounded">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<div class="icon"><i class="fa fa-warning"></i></div>
            <strong>' . $ci->lang->line('title_info') . '</strong> ' . $ci->session->userdata('info_msg') .
        '</div>';
        $ci->session->unset_userdata('info_msg');
    }     
    if($ci->session->userdata('warning_msg'))
    {                    
        echo '    
        <div class="alert alert-danger alert-white rounded">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<div class="icon"><i class="fa fa-times-circle"></i></div>
            <strong>' . $ci->lang->line('title_warning')  . '</strong> ' . $ci->session->userdata('warning_msg') .
        '</div>';
        $ci->session->unset_userdata('warning_msg');
    }           
}
  
?>
