<?php
  
function make_path($path) {
    if (is_dir($path) || file_exists($path)) return;
    mkdir($path, 0777, true);
    file_put_contents($path . 'index.php','');
}

function create_sized_image($path,$data,$width,$height)
{
   $ci =& get_instance();        
   $filename = $data['file_name'];
   $fileext = $data['file_ext'];
   $filenameonly = $data['raw_name'];     
      
   $normalwidth = $width;
   $normalheight = $height;
   
   $config['image_library'] = 'gd2';
   
   $config['source_image'] = $path . $filename;
   $config['maintain_ratio'] = TRUE;
   $config['create_thumb'] = FALSE;   
   $config['quality'] = 100;
   
   if($width != 0)         
        $config['width'] = $normalwidth;
   if($height != 0)
        $config['height'] = $normalheight;                
   
   $ci->image_lib->initialize($config);      
   if(!$ci->image_lib->resize())
   {
      error_msg($ci->upload->display_errors());
   }     
   $ci->image_lib->clear();    
}


function handle_image_upload($fieldname,$width,$height)
{    
    if((isset($_FILES[$fieldname])) && (file_exists($_FILES[$fieldname]['tmp_name'])))
    {    
        $path = UPLOADPATH;
        $config['upload_path'] = $path;
        $config['allowed_types'] = 'jpg|png|bmp|gif';
        $config['max_size']   = '5000';
        $config['max_width']  = '4096';
        $config['max_height']  = '3072';   
        $config['encrypt_name'] = true;
          
        $ci =& get_instance(); 
        $ci->load->library('upload', $config);   
        if (!$ci->upload->do_upload($fieldname))
        {
            echo $ci->upload->display_errors();
            exit;
        }
        else
        {                     
            $data = $ci->upload->data();   
            $fileext = $data['file_ext'];
            $filenameonly = $data['raw_name'];                       
            if(($width != 0) || ($height != 0))      
                create_sized_image($path,$data,$width,$height);            
            return $data['file_name'];
        }
    }
    else
        return '';
}

function handle_file_upload($fieldname)
{    
    if((isset($_FILES[$fieldname])) && (file_exists($_FILES[$fieldname]['tmp_name'])))
    {
        $path = UPLOADPATH;
        $config['upload_path'] = $path;
        $config['allowed_types'] = EXTENSIONS1;
        $config['max_size']   = '5000';    
          
        $ci =& get_instance(); 
        $ci->load->library('upload', $config);   
        if (!$ci->upload->do_upload($fieldname))
        {
            echo $ci->upload->display_errors();
            exit;
        }
        else
        {                     
            $data = $ci->upload->data();           
            return $data['file_name'];
        }     
    }
    else
        return '';
}
  
?>
