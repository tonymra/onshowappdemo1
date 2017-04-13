<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {
	
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

  
         $this->load->view('public/view_home',array(
		 
		 'pagetitle' => ' Show Houses On Show South Africa Property'
		
		 
		 )); 
		
	}
	
	
	
	//Contact Us
	public function contact_us()
    {
         $data["pagetitle"] = " Show Houses On Show South Africa Property";
			
		$this->load->view('public/welcome',$data);                        
    }   
	
	
	//Process Contact Us
	public function contact_us_pro()
    {
       
	
		
    $this->load->helper('email');
		
	
    $data = array();
	
   
	
   //Data Fields	
   $name = $this->input->post('name');
   $email = $this->input->post('email');
   $phone = $this->input->post('phone');
   $message = $this->input->post('message');
		
		
		//Validate
		    if (empty($name)) {
				$data["errors"] = 999;
			    $data["contact_error_msg"] =' Your name is required.';
			}else if (empty($phone)) {
				$data["errors"] = 998;
			    $data["contact_error_msg"] =' Please enter your contact phone number';
			}else if (empty($email)) {
				$data["errors"] = 997;
			    $data["contact_error_msg"] =' E-mail address is required.';
			}else if (!valid_email($email)) {
				$data["errors"] = 995;
			    $data["contact_error_msg"] =' Your e-mail address is invalid.';
			}else if (empty($message)) {
				$data["errors"] = 996;
			    $data["contact_error_msg"] =' Please type your message.';
			
			} else {
	
	
	               //Send welcome email
				 
	        $mydata = array(
               'email'  => $email,
               'name'   => $name,
	           'phone'  => $phone,
	           'message' => $message
					 );
				
				    $this->email->from('website@onshowapp.co.za','On Show App Website');
					$this->email->to('support@onshowapp.co.za');
					$this->email->subject('On Show App Website Contact');
					$this->email->message($this->load->view('email/website_contact',$mydata, true));
					$this->email->send();
					
  $data["errors"] = 0; 
}
			
			
		header('Content-type: application/json;');
		echo json_encode($data);
			
		
	 }
	
	
	
       
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */