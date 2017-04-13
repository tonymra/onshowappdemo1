<?php

class welcome_model extends CI_Model 
{		

	
	// Get Total members
	public function getTotalMembers() 
	{
		$query = $this->db->query('SELECT * FROM users where deleted = 0');
		return $query->num_rows(); 
	}

}
?>