<?php

function get_lookup_value($lookupid)
{
    $ci =& get_instance();
    $rs = $ci->db->query('select * from lookup where lookupid = ?',array($lookupid));
    if($rs->num_rows() == 1)
        return $rs->row(0)->lookupvalue;
    else
        return '';
}

function get_lookup_options($lookupname,$selected)
{
    $ci =& get_instance(); 
    $rs = $ci->db->query('select * from lookup where lookuptype = ? order by lookupvalue',array($lookupname));
    foreach($rs->result() as $row)
    {        
        if($row->lookupid == $selected)
            echo '<option value="' . $row->lookupid . '" selected="selected">' . $row->lookupvalue . '</option>';  
        else
            echo '<option value="' . $row->lookupid . '">' . $row->lookupvalue . '</option>';  
    }
} 

// Get the currency id and name, save currency id
function get_currency($selected)
{
    $ci =& get_instance(); 
    $rs = $ci->db->query('select * from currency  order by currency_id',array());
    foreach($rs->result() as $row)
    {        
        if($row->id == $selected)
            echo '<option value="' . $row->currency_id . '" selected="selected">' . $row->currency_name . '</option>';  
        else
            echo '<option value="' . $row->currency_id . '">' . $row->currency_name . '</option>';  
    }
}

// Get the country id and name, save country id
function get_country($selected)
{
    $ci =& get_instance(); 
    $rs = $ci->db->query('select * from countries  order by country_name',array());
    foreach($rs->result() as $row)
    {        
        if($row->id == $selected)
            echo '<option value="' . $row->country_id . '" selected="selected">' . $row->country_name . '</option>';  
        else
            echo '<option value="' . $row->country_id . '">' . $row->country_name . '</option>';  
    }
}


// Get the country id and name, save country name
function get_country_name($selected)
{
    $ci =& get_instance(); 
    $rs = $ci->db->query('select * from countries order by country_name',array());
    foreach($rs->result() as $row)
    {        
        if($row->id == $selected)
            echo '<option value="' . $row->country_name . '" selected="selected">' . $row->country_name . '</option>';  
        else
            echo '<option value="' . $row->country_name . '">' . $row->country_name . '</option>';  
    }
}



function get_page($pageid)
{
    $ci =& get_instance();
    $rs = $ci->db->query('select * from page where pageid = ?',array($pageid));    
    return $rs->row(0);
}

function isbusinessowner()
{
    if ((user()->userroleid == '3') || (user()->userroleid == '18'))
        return true;
    else
        return false;
}

function sendwelcomepacks($userroleid,$firstname,$email)
{
    if($userroleid == '3') // student  and business owner
    {
        $attachments = array();
        $attachments[] = ROOTPATH . '//assets//Skye_Welcome_Letter_Student.pdf';
        $attachments[] = ROOTPATH . '//assets//Skye_Debit_ Order_ Form_Student.docx';
        $attachments[] = ROOTPATH . '//assets//StarterPack.zip';
        $msg = '<p>Dear ' . $firstname . ',</p>
                <p>Welcome to the Skye Business Development Network.</p>
                <p>Please find your welcome letter and starter pack attached to this email.</p>
                <p>To view our presentation please click on the link below:</p>
                <p><a href="' . base_url('/assets/Skye%20Business%20Development%20Network%20-%20Presentation.pptx') . '">' . base_url('/assets/Skye%20Business%20Development%20Network%20-%20Presentation.pptx') . '</a></p>
                <p>Regards,<br />Skye Business Development Team</p>
                ';
        sendemail($email,'Welcome to Skye Business Development Network',$msg,$attachments);
        
        $attachments = array();        
        $attachments[] = ROOTPATH . '//assets//Skye_Welcome_Letter_Business_Owner.pdf';
        $attachments[] = ROOTPATH . '//assets//Skye_Debit_Order_Form_Business_Owner.docx';                        
        $attachments[] = ROOTPATH . '//assets//StarterPack.zip';
        $msg = '<p>Dear ' . $firstname . ',</p>
                <p>Welcome to the Skye Business Development Network.</p>
                <p>Please find your welcome letter and starter pack attached to this email.</p>
                <p>To view our presentation please click on the link below:</p>
                <p><a href="' . base_url('/assets/Skye%20Business%20Development%20Network%20-%20Presentation.pptx') . '">' . base_url('/assets/Skye%20Business%20Development%20Network%20-%20Presentation.pptx') . '</a></p>                                
                <p>Regards,<br />Skye Business Development Team</p>
                ';
        sendemail($email,'Welcome to Skye Business Development Network',$msg,$attachments); 
    }
    else if($userroleid == '4') // student
    {
        $attachments = array();
        $attachments[] = ROOTPATH . '//assets//Skye_Welcome_Letter_Student.pdf';
        $attachments[] = ROOTPATH . '//assets//Skye_Debit_ Order_ Form_Student.docx';
        $attachments[] = ROOTPATH . '//assets//StarterPack.zip';
        $msg = '<p>Dear ' . $firstname . ',</p>
                <p>Welcome to the Skye Business Development Network.</p>
                <p>Please find your welcome letter and starter pack attached to this email.</p>
                <p>To view our presentation please click on the link below:</p>
                <p><a href="' . base_url('/assets/Skye%20Business%20Development%20Network%20-%20Presentation.pptx') . '">' . base_url('/assets/Skye%20Business%20Development%20Network%20-%20Presentation.pptx') . '</a></p>
                <p>Regards,<br />Skye Business Development Team</p>
                ';
        sendemail($email,'Welcome to Skye Business Development Network',$msg,$attachments);
    }
    else                
    {
        $attachments = array();
        $attachments[] = ROOTPATH . '//assets//Skye_Welcome_Letter_Business_Owner.pdf';
        $attachments[] = ROOTPATH . '//assets//Skye_Debit_Order_Form_Business_Owner.docx';                        
        $attachments[] = ROOTPATH . '//assets//StarterPack.zip';
        $msg = '<p>Dear ' . $firstname . ',</p>
                <p>Welcome to the Skye Business Development Network.</p>
                <p>Please find your welcome letter and starter pack attached to this email.</p>
                <p>Regards,<br />Skye Business Development Team</p>
                ';
        sendemail($email,'Welcome to Skye Business Development Network',$msg,$attachments);                        
    }
    
}

?>
