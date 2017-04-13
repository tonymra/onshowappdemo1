<?php

class Newsletter_Model extends CI_Model 
{
  // Register 
	public function registerEmail($news_email,$deleted=0,	$enabled=1
		) {
		//Save the  details	
		$this->db->insert("newsletter", 
			array(
				"news_email" => $news_email, 
				"enabled" => $enabled,
				"deleted" => $deleted, 
				"dateadded" => date('Y-m-d') 
				
			)
		);
		
		
	}

	public function checkEmailIsSubscribed($news_email) 
	{
		$s=$this->db->where("news_email", $news_email)->get("newsletter");
		if ($s->num_rows() > 0) {
			return false;
		} else {
			return true;
		}
	}
	
	
	
	


}

?>
