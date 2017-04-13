<?php

class Launch_Model extends CI_Model 
{
  // Register 
	public function registerEmail($news_email,$deleted=0,	$enabled=1
		) {
		//Save the  details	
		$this->db->insert("launch", 
			array(
				"news_email" => $news_email, 
				"enabled" => $enabled,
				"deleted" => $deleted, 
				"dateadded" => date('Y-m-d') 
				
			)
		);
		
		
	}
	
	
	 // Register Launch Estate
	public function registerLaunchEstate($name,$email,$phone,$agency,$private_seller=0,$deleted=0,$enabled=1
		) {
		//Save the  details	
		$this->db->insert("launch", 
			array(
				"name" => $name, 
				"email" => $email,
				"phone" => $phone,
				"agency" => $agency,
				"private_seller" => $private_seller,
				"deleted" => $deleted, 
				"dateadded" => date('Y-m-d') 
				
			)
		);
		
		
	}
	
	
	
	// Register Private Seller
	public function registerLaunchPrivateSeller($private_name,$private_email,$private_phone,$private_agency="",$private_private_seller=1,$deleted=0,$enabled=1
		) {
		//Save the  details	
		$this->db->insert("launch", 
			array(
				"name" => $private_name, 
				"email" => $private_email,
				"phone" => $private_phone,
				"agency" => $private_agency,
				"private_seller" => $private_private_seller,
				"deleted" => $deleted, 
				"dateadded" => date('Y-m-d') 
				
			)
		);
		
		
	}
	
	

	public function checkEmailIsSubscribed($news_email) 
	{
		$s=$this->db->where("news_email", $news_email)->get("launch");
		if ($s->num_rows() > 0) {
			return false;
		} else {
			return true;
		}
	}
	
	
	
	


}

?>
