<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Newsletter extends CI_Controller {
	
	public function __construct() {	
      parent::__construct();
	  $this->load->model("newsletter_model");
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

   
	
        
         $this->load->view('public/welcome',array(
		 
		 'pagetitle' => ' Download ',
		
		 
		 )); 
		
	}
	
	// Newsletter subscribe 
	
	public function subscribe()
    {
	$this->load->helper('email');	
    
	
    $data = array();
	
   
	
   //Data Fields	
   $news_email = $this->input->post('newsletterEmail');
		
		
		//Validate
		    if (empty($news_email)) {
				$data["error"] = 499;
			    $data["error_msg"] =' E-mail address is required.';
			}else if (!valid_email($news_email)) {
				 $data["error"] = 498;
			     $data["error_msg"] =' Invalid e-mail address.';
				
			}else if (!$this->newsletter_model->checkEmailIsSubscribed($news_email)) {
				
				$data["error"] = 497;
			    $data["error_msg"] =' E-mail is already subscribed.';
			}else{
	
	      //Save to database
	       $this->newsletter_model->registerEmail($news_email);
				
	               //Send welcome email
				 
	        $mydata = array(
                    'news_email'     =>   $news_email
					 );
				
				    $this->email->from(NEWSLETTEREMAIL);
					$this->email->to($news_email);
					$this->email->subject('Thank you for your interest in On Show App !');
					$this->email->message($this->load->view('email/newsletter_email',$mydata, true));
					$this->email->send();    
					
             $data["error"] = 40; 
}
			
			
			header('Content-type: application/json;');
		    echo json_encode($data);
			
		
	 }
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */