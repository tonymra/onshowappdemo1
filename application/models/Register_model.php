<?php

class Register_Model extends CI_Model 
{
  // Register the user and update the reward pot
	public function registerUser($email, $username, $password, $verification_code,$phone="",$country_id="",$currency_id="",
	$accesslevel=0, $image="", $catid=0, $locked_cat=0,
	$first_name="",	$last_name="",	$gender="",	$fb_id="",	$fb_username="",	$fb_link="",
	$addressline1="",	$addressline2="",	$city="",	$state="",	$zipcode="",
	$smileypic="",	$newsletter_sub=1,	$verified=0,	$lastlogintime="",	$lastloginip="",	$deleted=0,	$potbalance=5.00
		) {
		// 1 . Save the users details	
		$this->db->insert("users", 
			array(
				"email" => $email, 
				"username" => $username, 
				"password" => $password, 
				"phone" => $phone, 
				"country_id" => $country_id,
				"currency_id" => $currency_id,
				"access_level" => $accesslevel, 
				"ip_address" => $_SERVER['REMOTE_ADDR'], 
				"bio_pic" => $image, 
				"default_ticket_category" => $catid,
				"locked_category" => $locked_cat,
				
				"first_name" => $first_name, 
				"last_name" => $last_name, 
				"gender" => $gender, 
				"fb_id" => $fb_id, 
				"fb_username" => $fb_username, 
				"fb_link" => $fb_link, 
				"addressline1" => $addressline1, 
				"addressline2" => $addressline2, 
				"city" => $city, 
				"state" => $state, 
				"zipcode" => $zipcode, 
				"smileypic" => $smileypic, 
				"newsletter_sub" => $newsletter_sub, 
				"verification_code" => $verification_code, 
				"verified" => $verified, 
				"lastlogintime" => $lastlogintime, 
				"lastloginip" => $lastloginip, 
				"deleted" => $deleted, 
				"regdatetime" => date('Y-m-d H:i:s'), 
				"dateadded" => date('Y-m-d') 
				
			)
		);
		
		$last_id = $this->db->insert_id('customer_id'); // Get the last inserted id from the users table
		
		// 2. Add initial reward pot and credit it with $5.00 FREE 
		$this->db->insert("user_rewardpot", 
			array(
				"customer_id" => $last_id, 
				"potbalance" => "5.00", 
				"currency" => "USD",
				"deleted" => $deleted,  
				"dateadded" => date('Y-m-d')
			)
		);
		
		
		//3. Add User Membership record
		$this->db->insert("user_membership", 
			array(
			    
			    "customer_id" => $last_id, 
				"plan_id" => 1,
				"startdate" => date('Y-m-d'),
				"expirydate" => 0000-00-00,
				"enabled" => 1,
				"deleted" => 0, 
				"dateadded" => date('Y-m-d') 
				)
		);

		
		
		
		// 4. Add initial users tokens , 0 FREE 
		$this->db->insert("user_tokens", 
			array(
				"customer_id" => $last_id, 
				"tokenbalance" => 0, 
				"deleted" => $deleted,  
				"dateadded" => date('Y-m-d')
			)
		);
		
		
		// 5. Add initial Wallet Balance , $0.00
		$this->db->insert("user_wallet", 
			array(
				"customer_id" => $last_id, 
				"walletbalance" => "0.00",
				"currency" => "USD",
				"deleted" => $deleted,  
				"dateadded" => date('Y-m-d')
			)
		);
		
		
		
		
		
	}

	public function checkEmailIsFree($email) 
	{
		$s=$this->db->where("email", $email)->get("users");
		if ($s->num_rows() > 0) {
			return false;
		} else {
			return true;
		}
	}
	
	public function checkVerificationCode($verificationcode) 
	{
		$s=$this->db->where("verification_code", $verificationcode)->get("users");
		if ($s->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	public function checkUsernameIsFree($username) 
	{
		$u=$this->db->where("username", $username)->get("users");
		if ($u->num_rows() > 0) {
			return false;
		} else {
			return true;
		}
	}
	
	public function updateVerification($verificationText) 
	{
		/* $this->db->where("verification_code", $verificationText)->update("users", 
			array(
				"verified" => 1
			)
		); */
		$this->db->set('verified', 1)  
                ->where('verification_code', $verificationText)  
                ->update('users');  
            return $this->db->affected_rows();  
	}


}

?>
