<?php

class Baby_Model extends CI_Model 
{
	
			
	public function registerBaby($customer_id,$display_name, $relationship,$video_url_baby, $gender,  $dob,
			$baby_country, $descp_baby, $descp_vote, $votes_activity,$image="",$votes_amt, $featured=0, $enabled=1,$deleted=0, $primary_img=1,$completion_status=0,$thank_you_msg,$completion_date,$current_votes=0,$noentry="",$token_balance=50,$email,$username
	) {
		$this->db->insert("baby", 
			array(
			    "customer_id" => $customer_id,
				"display_name" => $display_name, 
				"relationship" => $relationship, 
				"gender" => $gender, 
				"dob" => $dob, 
				"baby_country" => $baby_country, 
				"descp_baby" => $descp_baby, 
				"descp_vote" => $descp_vote, 
				"ip_address" => $_SERVER['REMOTE_ADDR'], 
				"featured" => $featured,
				"listing_status" => 0,  
				"enabled" => $enabled,
				"deleted" => $deleted, 
				"regdatetime" => date('Y-m-d H:i:s'), 
				"dateadded" => date('Y-m-d') 
			)
		);
		
		$last_id = $this->db->insert_id('baby_id'); // Get the last inserted id from the baby table
		
		//Save primary image
		$this->db->insert("baby_image", 
			array(
				"baby_id" => $last_id,
				"customer_id" => $customer_id, 
				"baby_img" => $image, 
				"primary_img" => 1, 
				"enabled" => 1, 
				"deleted" => 0, 
				"dateadded" => date('Y-m-d')
			)
		);
		
		//save video url
		$this->db->insert("baby_video", 
			array(
			    "baby_id" => $last_id,
				"customer_id" => $customer_id,
				"video_url_baby" => $video_url_baby,
				"enabled" => $enabled,
				"deleted" => $deleted, 
				"dateadded" => date('Y-m-d') 
			)
		);
		
		//save youtube campaign video url
		$this->db->insert("baby_youtube_campaign", 
			array(
			    "baby_id" => $last_id,
				"customer_id" => $customer_id,
				"video_url_youtube" => $noentry,
				"video_descp" => $noentry,
				"enabled" => $enabled,
				"deleted" => $deleted, 
				"dateadded" => date('Y-m-d') 
			)
		);
		
		//Save baby reward
		if (!empty($votes_activity)&& !empty($votes_amt)) {
				
			
		$this->db->insert("baby_reward", 
			array(
				"baby_id" => $last_id, 
				"customer_id" => $customer_id,
				"votes_amt" => $votes_amt,
				"current_votes" => $current_votes,
				"votes_activity" => $votes_activity,
				"completion_status" => $completion_status,
				"video_url_reward" => $noentry,
				"thank_you_msg" => $thank_you_msg,
				"completion_date" => $completion_date,
				"enabled" => $enabled,
				"deleted" => $deleted,
				"regdatetime" => date('Y-m-d H:i:s'),  
				"dateadded" => date('Y-m-d') 
			)
		);
		
		}
		
		//save baby promo tokens initial  balance
		$this->db->insert("baby_promo_free_tokens", 
			array(
			    
			    "baby_id" => $last_id,
				"customer_id" => $customer_id,
				"token_balance" => $token_balance
				)
		);
		
		
		//save baby promo normal tokens initial  balance
		$this->db->insert("baby_promo_normal_tokens", 
			array(
			    
			    "baby_id" => $last_id,
				"customer_id" => $customer_id,
				"token_balance" => 0
				)
		);
		
		//save baby promo votesinitial  balance
		$this->db->insert("baby_promo_votes", 
			array(
			    
			    "baby_id" => $last_id,
				"customer_id" => $customer_id,
				"vote_balance" => 0
				)
		);
		
		//Initialise baby votes
		$this->db->insert("baby_votes", 
			array(
			    
			    "baby_id" => $last_id,
				"customer_id" => $customer_id,
				"votes_balance" => 0,
				"update_datetimeadded" => date('Y-m-d H:i:s'), 
				"update_dateadded" => date('Y-m-d'), 
				"dateadded" => date('Y-m-d') 
				)
		);
		
		
		//Save user emails and usernames - baby competition
		$this->db->insert("baby_comp_user_emails", 
			array(
			    
			    "user_email" => $email,
				"user_name" => $username,
				"dateadded" => date('Y-m-d') 
				)
		);
		
				
	}
	
	
	
	// Get the logged in users baby id
	public function getBabyId($cust_id) 
	{
		
		
		$this->db->select('baby_id')->from('baby')->where('customer_id',$cust_id);

     $query = $this->db->get();

     if ($query->num_rows() > 0) {
         return $query->row()->baby_id;
     }
     return false;
	}
	
	
}

?>
