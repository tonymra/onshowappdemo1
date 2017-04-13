<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class User 
{

	var $info=array();
	var $loggedin=false;
	var $u=null;
	var $p=null;

	public function __construct() 
	{
		 $CI =& get_instance();
		 $this->u = $CI->input->cookie("scun", TRUE);
		 $this->p = $CI->input->cookie("sctkn", TRUE);

		 if ($this->u && $this->p) {
			 $user = $CI->db->select(
			 	" users.`customer_id`, users.`username`, users.`email`, users.`access_level`,
			 	 users.`default_ticket_category`, users.`email_notification`, 
			 	 users.`locked_category`, users.`phone`, users.`country_id`, users.`currency_id`, users.`ip_address`, users.`bio_pic`, users.`first_name`, users.`last_name`, users.`gender`, users.`fb_id`, users.`fb_username`, users.`fb_link`, users.`addressline1`, users.`addressline2`, users.`city`, users.`state`, users.`zipcode`, users.`smileypic`, users.`newsletter_sub`, users.`verification_code`, users.`verified`, users.`lastlogintime`, users.`lastloginip`, users.`deleted`, users.`regdatetime`, users.`dateadded`"
			 )
			 ->where("email", $this->u)->where("token", $this->p)
			 ->get("users");

			 if ($user->num_rows() == 0) {
			 	$this->loggedin=false;
			 } else {
			 	$this->loggedin=true;
			 	$this->info = $user->row();
			 	if ($this->info->access_level == -1) {
			 		$CI->load->helper("cookie");
			 		$this->loggedin = false;
			 		$CI->session->set_flashdata("globalmsg", 
			 			"This account has been deactivated and can no longer be used.");
			 		delete_cookie("scun");
					delete_cookie("sctkn");
					redirect(base_url());
			 	} elseif($this->info->access_level == -2) {
			 		$CI->load->helper("cookie");
			 		$this->loggedin = false;
			 		$CI->session->set_flashdata("globalmsg",
			 		"This account has been BANNED and can no longer be used.");
			 		delete_cookie("scun");
					delete_cookie("sctkn");
					redirect(base_url());
			 	}
			 }
		}
	}

	public function getPassword() 
	{
		$CI =& get_instance();
		$user = $CI->db->select("users.`password`")
		->where("customer_id", $this->info->customer_id)->get("users");
		$user = $user->row();
		return $user->password;
	}

}

?>
