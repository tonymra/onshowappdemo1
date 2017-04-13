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
	
	//Get number of photos uploaded
	
	public function getPics($baby_id) 
	{
		return $this->db->select("baby_id")->where("baby_id", $baby_id)
		->get("baby_image");
		
		
	}
	
	
	
	
	
	// Get baby pics for photo upload
	public function getBabyPics($babyid) 
	{
		
		return $this->db->query("SELECT baby_img FROM baby_image WHERE baby_id='$babyid' and primary_img = 0 and enabled=1 and deleted=0 ");
		
	}
	
	
	
	// Get baby pics for profile
	public function getBabyProfilePics($baby_id) 
	{
		
		return $this->db->query("SELECT baby_img FROM baby_image WHERE baby_id='$baby_id'  and enabled=1 and deleted=0 ");
		
	}
	
	// Get baby reward
	public function getBabyReward($baby_id) 
	{
		
		return $this->db->query("SELECT * FROM baby_reward WHERE baby_id='$baby_id'  and enabled=1 and deleted=0 ");
		
	}
	
	
	//Get number of entries for user
	
	public function getEntries($customer_id) 
	{
		return $this->db->select("customer_id")->where("customer_id", $customer_id)
		->get("baby");
		
		
	}
	
	// Upload Baby Photo
	public function uploadPhoto($baby_id,$baby_image, $primary_img=0, $enabled=1,$deleted=0
	) {
		$this->db->insert("baby_image", 
			array(
			    "baby_id" => $baby_id,
				"baby_img" => $baby_image, 
				
				"primary_img" => $primary_img, 
				"enabled" => $enabled,
				"deleted" => $deleted, 
				"dateadded" => date('Y-m-d') 
			)
		);
		
		
	}
	
	
	
	
	
	
	
	
	
	
	//Find if the baby entry has an incomplete campaign
	
	public function getCampaigns($baby_id) 
	{
		return $this->db->query("SELECT * FROM baby_reward WHERE baby_id='$baby_id' and completion_status = 0 ");
		
	}
	
	// Get Display Name 
	public function getDisplayName($baby_id   ) 
	{
	$this->db->select('display_name')->from('baby')->where('baby_id',$baby_id);
    $query = $this->db->get();
     if ($query->num_rows() > 0) {
         return $query->row()->display_name;
     }
     return false;
	}
	
	// Get Baby ID
	public function getBabyDatabaseID($display_name) 
	{
	$this->db->select('baby_id')->from('baby')->where('display_name',$display_name);
    $query = $this->db->get();
     if ($query->num_rows() > 0) {
         return $query->row()->baby_id;
     }
     return false;
	}
	
	// Get User  ID
	public function getUserDatabaseID($baby_id) 
	{
	$this->db->select('customer_id')->from('baby')->where('baby_id',$baby_id);
    $query = $this->db->get();
     if ($query->num_rows() > 0) {
         return $query->row()->customer_id;
     }
     return false;
	}
	
	// Get fullName 
	public function getRelationship($baby_id   ) 
	{
	$this->db->select('relationship')->from('baby')->where('baby_id',$baby_id);
    $query = $this->db->get();
     if ($query->num_rows() > 0) {
         return $query->row()->relationship;
     }
     return false;
	}
	
	// Get Gender
	public function getGender($baby_id   ) 
	{
	$this->db->select('gender')->from('baby')->where('baby_id',$baby_id);
    $query = $this->db->get();
     if ($query->num_rows() > 0) {
         return $query->row()->gender;
     }
     return false;
	}
	
	// Get DOB 
	public function getDob($baby_id   ) 
	{
	$this->db->select('dob')->from('baby')->where('baby_id',$baby_id);
    $query = $this->db->get();
     if ($query->num_rows() > 0) {
         return $query->row()->dob;
     }
     return false;
	}
	
	// Get Baby country
	public function getBabyCountry($baby_id   ) 
	{
	$this->db->select('baby_country')->from('baby')->where('baby_id',$baby_id);
    $query = $this->db->get();
     if ($query->num_rows() > 0) {
         return $query->row()->baby_country;
     }
     return false;
	}
	
	// Get Descp baby
	public function getDescpBaby($baby_id   ) 
	{
	$this->db->select('descp_baby')->from('baby')->where('baby_id',$baby_id);
    $query = $this->db->get();
     if ($query->num_rows() > 0) {
         return $query->row()->descp_baby;
     }
     return false;
	}
	
	
	// Get Decscp vote 
	public function getDescpVote($baby_id   ) 
	{
	$this->db->select('descp_vote')->from('baby')->where('baby_id',$baby_id);
    $query = $this->db->get();
     if ($query->num_rows() > 0) {
         return $query->row()->descp_vote;
     }
     return false;
	}
	
	// Get baby video url 
	public function getBabyVideoUrl($baby_id   ) 
	{
	$this->db->select('video_url_baby')->from('baby_video')->where('baby_id',$baby_id);
    $query = $this->db->get();
     if ($query->num_rows() > 0) {
         return $query->row()->video_url_baby;
     }
     return false;
	}
	
	// Get listing status
	public function getListingStatus($baby_id   ) 
	{
	$this->db->select('listing_status')->from('baby')->where('baby_id',$baby_id);
    $query = $this->db->get();
     if ($query->num_rows() > 0) {
         return $query->row()->listing_status;
     }
     return false;
	}
//*******************************************************************************************************************************	
	// Get Primary image
	public function getBabyPrimaryImage($baby_id   ) 
	{
	$this->db->select('baby_img')->from('baby_image')->where('baby_id',$baby_id);
    $query = $this->db->get();
     if ($query->num_rows() > 0) {
         return $query->row()->baby_img;
     }
     return false;
	}
	
//*******************************************************************************************************************************	
	// Get Votes amount
	public function getVotesAmt($baby_id   ) 
	{
	$this->db->select('votes_amt')->from('baby_reward')->where('baby_id',$baby_id);
    $query = $this->db->get();
     if ($query->num_rows() > 0) {
         return $query->row()->votes_amt;
     }
     return false;
	}
	
	// Get Current votes
	public function getCurrentVotes($baby_id   ) 
	{
	$this->db->select('current_votes')->from('baby_reward')->where('baby_id',$baby_id);
    $query = $this->db->get();
     if ($query->num_rows() > 0) {
         return $query->row()->current_votes;
     }
     return false;
	}
	
	// Get Completion Status
	public function getCompletionStatus($baby_id   ) 
	{
	$this->db->select('completion_status')->from('baby_reward')->where('baby_id',$baby_id);
    $query = $this->db->get();
     if ($query->num_rows() > 0) {
         return $query->row()->completion_status;
     }
     return false;
	}
	
	// Get Reward video url
	public function getRewardVideoUrl($baby_id   ) 
	{
	$this->db->select('video_url_reward')->from('baby_reward')->where('baby_id',$baby_id);
    $query = $this->db->get();
     if ($query->num_rows() > 0) {
         return $query->row()->video_url_reward;
     }
     return false;
	}
	
	// Get thank you message
	public function getThankYouMsg($baby_id   ) 
	{
	$this->db->select('thank_you_msg')->from('baby_reward')->where('baby_id',$baby_id);
    $query = $this->db->get();
     if ($query->num_rows() > 0) {
         return $query->row()->thank_you_msg;
     }
     return false;
	}
	
	// Get Completion Date
	public function getCompletionDate($baby_id   ) 
	{
	$this->db->select('completion_date')->from('baby_reward')->where('baby_id',$baby_id);
    $query = $this->db->get();
     if ($query->num_rows() > 0) {
         return $query->row()->completion_date;
     }
     return false;
	}
	
	// Get Votes activity
	public function getVotesActivity($baby_id   ) 
	{
	$this->db->select('votes_activity')->from('baby_reward')->where('baby_id',$baby_id);
    $query = $this->db->get();
     if ($query->num_rows() > 0) {
         return $query->row()->votes_activity;
     }
     return false;
	}
	
	// Get Reward Regdatetime
	public function getRewardRegDateTime($baby_id   ) 
	{
	$this->db->select('regdatetime')->from('baby_reward')->where('baby_id',$baby_id);
    $query = $this->db->get();
     if ($query->num_rows() > 0) {
         return $query->row()->regdatetime;
     }
     return false;
	}
	
	
	// Get Baby  You Tube campaign video url 
	public function getBabyYouTubeCampaignVideoUrl($baby_id   ) 
	{
	$this->db->select('video_url_youtube')->from('baby_youtube_campaign')->where('baby_id',$baby_id);
    $query = $this->db->get();
     if ($query->num_rows() > 0) {
         return $query->row()->video_url_youtube;
     }
     return false;
	}
	
	// Get Baby  You Tube campaign video descp
	public function getBabyYouTubeCampaignVideoDescp($baby_id   ) 
	{
	$this->db->select('video_descp')->from('baby_youtube_campaign')->where('baby_id',$baby_id);
    $query = $this->db->get();
     if ($query->num_rows() > 0) {
         return $query->row()->video_descp;
     }
     return false;
	}
	
	
	// Get Reward c urrent Votes
	public function getRewardCurrentVotes($baby_id) 
	{
	$this->db->select('current_votes')->from('baby_reward')->where('baby_id',$baby_id);
    $query = $this->db->get();
     if ($query->num_rows() > 0) {
         return $query->row()->current_votes;
     }
     return false;
	}
	
	
	//Verify Display name is valid  for logged in user 
	public function verifyDisplayName($display_name,$cust_id) 
	{
		
		$s=$this->db->query("SELECT * FROM baby WHERE display_name='$display_name' and customer_id = '$cust_id' ");
		if ($s->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	
	//Get current campaign data 
	public function getCurrentRewardsCampaign($baby_id) 
	{
		

$this->db->select('votes_amt,current_votes,votes_activity,completion_status,video_url_reward,thank_you_msg,completion_date,enabled,deleted,regdatetime,dateadded')->from('baby_reward')->where('baby_id',$baby_id)->where('completion_status',0)->where('enabled',1)->where('deleted',0);
    $query = $this->db->get();
     if ($query->num_rows() > 0) {
         return $query->row();
     }
     return false;
		
		

	}
	
	
	//Get completed rewards campaigns
	public function getCompletedRewardsCampaign($baby_id) 
	{
		
/* 
$this->db->select('votes_amt,current_votes,votes_activity,completion_status,video_url,thank_you_msg,completion_date,enabled,deleted,regdatetime,dateadded')->from('baby_reward')->where('baby_id',$baby_id)->where('completion_status',1)->where('enabled',1)->where('deleted',0);
    $query = $this->db->get();
     if ($query->num_rows() > 0) {
         return $query->row();
     }
     return false; */
		
		
return $this->db->query("SELECT baby_reward_id,baby_id,votes_amt,current_votes,votes_activity,completion_status,video_url_reward,thank_you_msg,completion_date,enabled,deleted,regdatetime,dateadded FROM baby_reward WHERE baby_id='$baby_id'  and enabled=1 and deleted=0 and completion_status=1 ");
	}
	
	//check for incomplete campaigns
	public function checkIncompleteCampaign($babyid) 
	{
		


$s=$this->db->query("SELECT * FROM baby_reward WHERE baby_id='$babyid' and completion_status = '0' and enabled=1 and deleted=0 ");
		if ($s->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
		
		

	}
	
	// check for complete rewards campaign
	public function getCompleteRewardsCampaign($id) 
	{
		return $this->db->where("baby_reward_id", $id)->where("completion_status", 1)->where("enabled", 1)->where("deleted", 0)
		->select("baby_reward_id,baby_id,votes_amt,current_votes,votes_activity,completion_status,video_url_reward,thank_you_msg,completion_date,enabled,deleted,regdatetime,dateadded")
		
		->get("baby_reward");
	}
	
	
//********************************************************************************************************************************	
// BABY DETAILS UPDATE **********************************************************************************************************************************


// Verify users  baby id
	public function verifyUserBabyId($user_id,$babyid) 
	{
		
	
	$s=$this->db->query("SELECT * FROM baby WHERE baby_id='$babyid' and customer_id = '$user_id' and enabled=1 and deleted=0 ");
		if ($s->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	
//Get Babies - Edit
public function getBabies($babyid) 
	{
	return $this->db->where("baby_id = '$babyid'")
		->select("baby_id,display_name,relationship,dob,gender,baby_country,descp_baby,descp_vote")->get("baby");

	}	
	
	//get baby
	public function getBaby($bid) 
	{
		return $this->db->where("baby_id", $bid)->
		where("deleted =0")->get("baby");
		
		
	}
	
	// Update Baby Details
	public function updateBabyDetails($bid, $relationship, $dob, $gender, $baby_country, $descp_baby, $descp_vote
	) {
		$this->db->where("baby_id", $bid)->update("baby", 
			array(
				
				"relationship" => $relationship,
				"dob" => $dob,
				"gender" => $gender,
				"baby_country" => $baby_country,
				"descp_baby" => $descp_baby,
				"descp_vote" => $descp_vote
			)
		);
	}
//****************************************************************************************************************************
//******************************************************************************************************************************



//********************************************************************************************************************************	
// BABY PROFILE VIDEO UPDATE **********************************************************************************************************************************



	
//Get Babies - Edit
public function getVid($babyid) 
	{
	return $this->db->where("baby_id = '$babyid'")
		->select("baby_id,video_url_baby")->get("baby_video");

	}	
	
	
	
	// Update Baby Details
	public function updateProfileVideo($bid, $video_url_baby
	) {
		$this->db->where("baby_id", $bid)->update("baby_video", 
			array(
				
				"video_url_baby" => $video_url_baby,
				
			)
		);
	}
//****************************************************************************************************************************
//******************************************************************************************************************************






//********************************************************************************************************************************	
// BABY youtube campaign VIDEO UPDATE **********************************************************************************************************************************



	
//Get Babies - Edit
public function getYouTubeVid($babyid) 
	{
	return $this->db->where("baby_id = '$babyid'")
		->select("baby_id,video_url_youtube,video_descp")->get("baby_youtube_campaign");

	}	
	
	
	
	// Update Baby Details
	public function updateYouTubeCampaignVideo($bid, $video_url_youtube,$video_descp
	) {
		$this->db->where("baby_id", $bid)->update("baby_youtube_campaign", 
			array(
				
				"video_url_youtube" => $video_url_youtube,
				"video_descp" => $video_descp,
				
				
			)
		);
	}
//****************************************************************************************************************************
//******************************************************************************************************************************



//********************************************************************************************************************************	
// BABY REWARDS CAMPAIGN **********************************************************************************************************************************



	
//Get Babies - Edit
public function getCampaign($babyid) 
	{
	return $this->db->where("baby_id = '$babyid'")
		->select("baby_id,votes_amt,votes_activity")->get("baby_reward");

	}	
	
	
	
	// save Rewards Campaign
	public function saveCampaign($bid,$user_id, $votes_amt,$votes_activity
	) {
		$this->db->insert("baby_reward", 
			array(
				"baby_id" => $bid, 
				"customer_id" => $user_id, 
				"votes_amt" => $votes_amt,
				"current_votes" => 0,
				"votes_activity" => $votes_activity,
				"completion_status" => 0,
				"video_url_reward" => "",
				"thank_you_msg" => "",
				"completion_date" => "",
				"enabled" => 1,
				"deleted" => 0,
				"regdatetime" => date('Y-m-d H:i:s'),  
				"dateadded" => date('Y-m-d') 
			)
		);
	}
//****************************************************************************************************************************
//******************************************************************************************************************************



//********************************************************************************************************************************	
// BABY PHOTOS **********************************************************************************************************************************



	
//Get Babies - Edit
public function getPhotos($babyid) 
	{
	return $this->db->where("baby_id = '$babyid'")
		->select("baby_id,video_url")->get("baby_video");

	}	
	
	
	
	// Update Baby Details
	public function updatePhotos($bid, $video_url
	) {
		$this->db->where("baby_id", $bid)->update("baby_video", 
			array(
				
				"video_url_baby" => $video_url,
				
			)
		);
	}
	
	public function getTotalBabyPics($bid) 
	{
		$s = $this->db->where("baby_id", $bid)->where("enabled", 1)->where("deleted", 0)
		->select("COUNT(*) as num")->get("baby_image");
		$r = $s->row();
		if (!isset($r->num)) {
			return 0;
		}
		return $r->num;
	}
//****************************************************************************************************************************
//******************************************************************************************************************************



// ADD BABY PHOTOS ***********************************************************************************************************
//***************************************************************************************************************************

public function addBabyPhotos($bid, $file) 
	{
		$this->db->insert("baby_image", 
			array(
				"baby_id" => $bid, 
				"baby_img" => $file['file_name'], 
				"primary_img" => 0, 
				"enabled" => 1, 
				"deleted" => 0, 
				"dateadded" => date('Y-m-d') 
			)
		);
	}
	
//********************************************************************************************************************************


// Update completed rewards campaign
	public function saveCompletedRewardsCampaign($id, $video_url, $thank_you_msg
	) {
		$this->db->where("baby_reward_id", $id)->update("baby_reward", 
			array(
				
				"video_url_reward" => $video_url_reward,
				"thank_you_msg" => $thank_you_msg,
				
			)
		);
	}
//****************************************************************************************************************************	
	
	//Get vote price for first contribution
	
	public function getVotePrice() 
	{
		
		
	return $this->db->where("vote_price_id = '3'")
		->select("item_number,item_descp,item_qty,price_usd,price_euro,usd_currencycode,euro_currencycode")->get("baby_vote_prizes");

	
	}
	
//*****************************************************88*****************************************************************
//**************************************************************************************************************************
//LIST BABIES MAIN PAGE


//list registered babies
	
	public function listBabies() 
	{
		
		
	return $this->db
	    ->where("baby.listing_status = '1'")
	    ->where("baby.enabled = '1'")
		->where("baby.deleted = '0'")
		
		->select("baby.display_name,baby.dob,baby.gender,baby.baby_country,baby.descp_baby,baby.descp_vote,baby_image.baby_img")
		->join("baby_image", "baby_image.baby_id = baby.baby_id","baby_image.primary_image='1'")
		
		->get("baby");

	
	}
	
}

?>
