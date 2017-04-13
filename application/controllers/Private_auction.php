<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Private_auction extends CI_Controller {
	
	public function __construct() {	
      parent::__construct();
	  $this->load->model("welcome_model");
	  $this->no_cache();	
				
	}
	
	private function no_cache(){
       
        $this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
		$this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		
		header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		header('Cache-Control: no-store, no-cache, must-revalidate');
		header('Cache-Control: post-check=0, pre-check=0',false);
		header('Pragma: no-cache');
        
    }
	
	public function index()
	{

	
         $this->load->view('public/view_private_auction',array(
		 
		 'pagetitle' => ' Private Auction'
		
		 
		 )); 
		
	}
	
	
	
	
	
	
       
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */