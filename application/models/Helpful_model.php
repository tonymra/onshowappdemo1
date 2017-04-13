<?php

class Helpful_Model extends CI_Model 
{
  // Register the page helpful 
	public function registerHelp($helpyes, $helpno,	$help_page,	$help_ip=""
		) {
		//Save the data	
		$this->db->insert("helpful", 
			array(
				"help_yes" => $helpyes, 
				"help_no" => $helpno, 
				"help_page" => $help_page,
				"help_ip" => $_SERVER['REMOTE_ADDR'],
				"help_datetime" => date('Y-m-d H:i:s'), 
				"dateadded" => date('Y-m-d') 
				
			)
		);
		
		
		
		
	}

	

}

?>
