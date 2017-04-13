<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Babys 
{

	var $info=array();

	var $version = "1.8";

	public function __construct() 
	{
		$CI =& get_instance();
		$site = $CI->db->select(" guest_enable, file_enable, 
		upload_path, upload_path_relative, 
		support_email, disable_captcha, disable_seo,
		 alert_support_staff, register, kb_login")->where("ID", 1)->get("baby_settings");
		
		if($site->num_rows() == 0) {
			$CI->template->error(
				"You are missing the baby settings database row."
			);
		} else {
			$this->info = $site->row();
		}
	}

}

?>
