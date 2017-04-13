<?php

class Dashboard_Model extends CI_Model 
{

	public function checkPassword($pass, $userid) 
	{
		$s = $this->db->where("customer_id", $userid)->select("password")->get("users");
		if($s->num_rows() == 0) return false;
		$r =$s->row();
		if($r->password != $pass) return false;
		return true;
	}
    
	
	//PROFILE SETTINGS UPDATE
	public function updateUser($userid, $username, $email, $first_name,$last_name,$gender,$country_id,$currency_id) 
	{
		$this->db->where("customer_id", $userid)->update("users", 
			array(
				"username" => $username, 
				"email" => $email, 
				"first_name" => $first_name, 
				"last_name" => $last_name, 
				"gender" => $gender, 
				"country_id" => $country_id, 
				"currency_id" => $currency_id 
				
			)
		);
	}
	
	//CONTACT DETAILS UPDATE
	public function updateContactDetails($userid, $addressline1,$addressline2,$city,$state,$zipcode,$phone) 
	{
		$this->db->where("customer_id", $userid)->update("users", 
			array(
				    "addressline1" => $addressline1,
					"addressline2" => $addressline2,
					"city" => $city,
					"state" => $state,
					"zipcode" => $zipcode,
					"phone" => $phone
				
			)
		);
	}
	
	//SUBSCRIPTIONS UPDATE
	public function updateSubscriptions($userid, $email_notification,$newsletter_sub) 
	{
		$this->db->where("customer_id", $userid)->update("users", 
			array(
				"email_notification" => $email_notification, 
				"newsletter_sub" => $newsletter_sub 
				
				
			)
		);
	}
	
	//************************************** PAYPAL TOKEN PRICES ***************************************************
	
	// GET PayPal TOKEN PRICES
	public function getPaypalTokenPrices($page) 
	{
		return $this->db
		->select("token_descp, token_qty, price_usd, curr_usd, token_price_id")
		->order_by("token_price_id", "ASC")
		->limit(10,$page)
		->get("user_token_prices");
	}
	// COUNT 
	public function getPaypalTokenCount() 
	{
		$s = $this->db->select("COUNT(*) as num")->get("user_token_prices");
		$r = $s->row();
		if (!isset($r->num)) {
			return 0;
		}
		return $r->num;
	}
	
	//************************************** END PAYPAL TOKEN PRICES ***************************************************
	
	// Total Tokens - User Dashboard
	public function getTotalTokens($user_id) 
	{
	$this->db->select('tokenbalance')->from('user_tokens')->where('customer_id',$user_id);
    $query = $this->db->get();
     if ($query->num_rows() > 0) {
         return $query->row()->tokenbalance;
     }
     return false;
	}
	
	
	// Reward Pot Balance - User Dashboard
	public function getRewardPotBalance($user_id) 
	{
	$this->db->select('potbalance')->from('user_rewardpot')->where('customer_id',$user_id);
    $query = $this->db->get();
     if ($query->num_rows() > 0) {
         return $query->row()->potbalance;
     }
     return false;
	}
	
	
	// Wallet Balance - User Dashboard
	public function getWalletBalance($user_id) 
	{
	$this->db->select('walletbalance')->from('user_wallet')->where('customer_id',$user_id);
    $query = $this->db->get();
     if ($query->num_rows() > 0) {
         return $query->row()->walletbalance;
     }
     return false;
	}
	
	//Get Token Data
	public function getToken($tk_id) 
	{
		return $this->db->where("token_price_id", $tk_id)
		->select("token_descp, token_qty, price_usd,curr_usd")->get("user_token_prices");
	}
	
	
}

?>
