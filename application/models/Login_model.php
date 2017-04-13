<?php

class Login_Model extends CI_Model 
{

	public function getUser($email, $pass) 
	{
		return $this->db->select("customer_id")
		->where("email", $email)->where("password", $pass)->get("users");
	}

	public function getUserByEmail($email) 
	{
		return $this->db->select("customer_id,password,access_level")
		->where("email", $email)->get("users");
	}

	public function updateUserToken($userid, $token) 
	{
		$this->db->where("customer_id", $userid)
		->update("users", array("token" => $token));
	}
	
	public function updateLastLoginIp($userid) 
	{
		$this->db->where("customer_id", $userid)
		->update("users", array("lastloginip" => $_SERVER['REMOTE_ADDR']));
	}
	
	public function updateLastLoginTime($userid) 
	{
		$this->db->where("customer_id", $userid)
		->update("users", array("lastlogintime" => date('Y-m-d H:i:s')));
	}

	public function addToResetLog($ip) 
	{
		$this->db->insert("reset_log", 
			array(
				"IP" => $ip, 
				"timestamp" => time()
			)
		);
	}

	public function getResetLog($ip) 
	{
		return $this->db->where("IP", $ip)->get("reset_log");
	}

	public function getUserEmail($email) 
	{
		return $this->db->where("email", $email)
		->select("customer_id, username")->get("users");
	}

	public function resetPW($userid, $token) 
	{
		$this->db->insert("password_reset", 
			array(
				"userid" => $userid, 
				"token" => $token, 
				"IP" => $_SERVER['REMOTE_ADDR'], 
				"timestamp" => time()
			)
		);
	}

	public function getResetUser($token, $userid) 
	{
		return $this->db->where("token", $token)
		->where("userid", $userid)->get("password_reset");
	}

	public function updatePassword($userid, $password) 
	{
		$this->db->where("customer_id", $userid)
		->update("users", array("password" => $password));
	}

	public function deleteReset($token) 
	{
		$this->db->where("token", $token)->delete("password_reset");
	}
	
	public function checkUserEmailVerification($email) 
	{
		$u = $this->db->query("SELECT * FROM users WHERE email='$email' and verified = 0 ");
		
		if ($u->num_rows() > 0) {
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
	
	public function getUserVerificationCode($email) 
	{
		
		
		$this->db->select('verification_code')->from('users')->where('email',$email);

     $query = $this->db->get();

     if ($query->num_rows() > 0) {
         return $query->row()->verification_code;
     }
     return false;
	}
	
	public function getUserUsername($email) 
	{
		
		
		$this->db->select('username')->from('users')->where('email',$email);

     $query = $this->db->get();

     if ($query->num_rows() > 0) {
         return $query->row()->username;
     }
     return false;
	}
	

}

?>