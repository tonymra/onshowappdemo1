<?php

class Guess_Model extends CI_Model 
{
    
	
	
	// GET Game Info
	public function getGameInfo($page) 
	{
		$today=date('Y-m-d');
		$currentdatetime= date('Y-m-d H:i:s');
		
	  return $this->db
		->select("guess_game_id, compdate, starttime,endtime, startnumber, endnumber,deleted")
		->where("deleted", 0)
		->where("compdate",$today)
		->where('starttime <=',$currentdatetime)
	    ->where('endtime  >=',$currentdatetime)
		
		->limit(1,$page)
		->get("guess_game");
		
	}
	// Count game info
	public function getGameInfoCount() 
	{
		$today=date('Y-m-d');
		$currentdatetime= date('Y-m-d H:i:s');
		$s = $this->db->select("COUNT(*) as num")
		->where("deleted", 0)
		->where("compdate",$today)
		->where('starttime <=',$currentdatetime)
	    ->where('endtime  >=',$currentdatetime)
		
		->get("guess_game");
		$r = $s->row();
		if (!isset($r->num)) {
			return 0;
		}
		return $r->num;
	}
	
	
	
	
	
	// GET Previous Winners Info
	public function getPreviousWinners($page) 
	{
		
		
	  return $this->db
	    ->where("guess_entry_winners.prize_awarded", 1)
		->select("guess_entry_winners.guess_entry_winner_id,guess_entry_winners.guess_entry_id,guess_entry_winners.customer_id, guess_entry_winners.guess_game_id,guess_entry_winners.win_date, guess_entry_winners.prize_descp, guess_entry_winners.prize_awarded, users.username")
		->join("users", "users.customer_id = guess_entry_winners.customer_id")
		->limit(10,$page)
		->get("guess_entry_winners");
		
	}
	// Count Previous Winners  info
	public function getPreviousWinnersCount() 
	{
		
		$s = $this->db->select("COUNT(*) as num")
		->where("prize_awarded", 1)
		->get("guess_entry_winners");
		$r = $s->row();
		if (!isset($r->num)) {
			return 0;
		}
		return $r->num;
	}
	
	
	
    
	// Count guess entries
	public function getEntriesCount($gameid) 
	{
		$s = $this->db->select("COUNT(*) as num")
		->where("guess_game_id",$gameid)
		->get("guess_entries");
		$r = $s->row();
		if (!isset($r->num)) {
			return 0;
		}
		return $r->num;
	}
	
	
	//Save Guess Entry
	
	public function saveGuessEntry($user_id, $guess_game_id,$enter_time,$guessnumber,$winning_number) {
		
		 
		$this->db->insert("guess_entries", 
			array(
				"guess_game_id" => $guess_game_id, 
				"customer_id" => $user_id, 
				"enter_date" => date('Y-m-d') , 
				"enter_time" => $enter_time, 
				"winning_number" => $winning_number, 
				"entry_number" => $guessnumber,
				"ip_address" => $_SERVER['REMOTE_ADDR'], 
				
			)
		);
		
		
		
		
				
		}
		
		//Save  Guess Entry Winners
		public function saveGuessEntryWinner($user_id, $guess_game_id) {
		
		
		//$last_id = $this->db->insert_id('guess_entry_id')->get("guess_entries"); // Get the last inserted id from the guess_entries table
		$query = $this->db->query('SELECT * FROM `guess_entries`');
        $last_id= $query->num_rows(); 
		
		$this->db->insert("guess_entry_winners", 
			array(
				"guess_entry_id" => $last_id, 
				"guess_game_id" => $guess_game_id, 
				"customer_id" => $user_id, 
				"win_date" => date('Y-m-d'),
				"prize_descp" => "3 FREE Tokens",
				"prize_awarded" => 1
			)
		);
		
		
		
				
		}
		
		
		// Update Guess Entry Winner Tokens +5
	public function updateGuessEntryWinnerTokens($user_id,$wintokens) {
		$this->db->where('customer_id', $user_id);
		$this->db->set('tokenbalance', 'tokenbalance+' .$wintokens, FALSE);
		$this->db->update('user_tokens');
		
	}
	
	
	// Update  User Entry  Tokens -1
	public function updateUserEntryToken($user_id,$entrytoken) {
		$this->db->where('customer_id', $user_id);
		$this->db->set('tokenbalance', 'tokenbalance-' .$entrytoken, FALSE);
		$this->db->update('user_tokens');
		
	}
	
	// Check if user has already won
	public function CheckUserWin($today,$user_id) 
	{
	  $today=date('Y-m-d');
		
	  return $this->db
		->select("customer_id,guess_entry_id, guess_game_id,win_date, prize_descp, prize_awarded")
		->where("win_date",$today)
		->where("customer_id",$user_id)
		->get("guess_entry_winners");
		
	}
	
	
	// Check user's token balance
	public function CheckUserTokensBalance($user_id) 
	{
		
		
	  return $this->db
		->select("token_id, customer_id, tokenbalance,deleted")
		->where("deleted", 0)
		->where("customer_id",$user_id)
		->where('tokenbalance <=',0)
		->get("user_tokens");
		
	}

	
}

?>
