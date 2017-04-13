<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Launch extends CI_Controller {
	
	public function __construct() {	
      parent::__construct();
	  $this->load->model("launch_model");
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
	
	// Launch Estate Agency 
	
	public function estate()
    {
	$this->load->helper('email');
		
	
    $data = array();
	
   
	
   //Data Fields	
   $name = $this->input->post('launchestatename');
   $email = $this->input->post('launchestateemail');
   $phone = $this->input->post('launchestatephone');
   $agency = $this->input->post('launchestateagency');
		
		
		//Validate
		    if (empty($name)) {
				$data["errorslaunchestate"] = 399;
			    $data["launchestate_error_msg"] =' Your name is required.';
			}else if (empty($phone)) {
				$data["errorslaunchestate"] = 398;
			    $data["launchestate_error_msg"] =' Your phone number is required.';
			}else if (empty($email)) {
				$data["errorslaunchestate"] = 397;
			    $data["launchestate_error_msg"] =' E-mail address is required.';
			}else if (!valid_email($email)) {
				$data["errorslaunchestate"] = 395;
			    $data["launchestate_error_msg"] =' Your e-mail address is invalid.';
			}else if (empty($agency)) {
				$data["errorslaunchestate"] = 396;
			    $data["launchestate_error_msg"] =' Real estate agency name is required.';
			
			} else {
				
				//Save to database
	           $this->launch_model->registerLaunchEstate($name,$email,$phone,$agency);
	
	
	          
				 
	    $mydata = array(
               'email'  => $email,
               'name'   => $name,
	           'phone'  => $phone,
	           'agency' => $agency
					 );
					 
				    //Send email to user
				    $this->email->from('website@onshowapp.co.za','On Show App');
					$this->email->to($email);
					$this->email->subject('On Show App Launch');
					$this->email->message($this->load->view('email/launch_estate_user',$mydata, true));
					$this->email->send(); 
					
					
					//Send email to staff
					$this->email->from('website@onshowapp.co.za','On Show App');
					$this->email->to('support@onshowapp.co.za');
					$this->email->subject('On Show App Launch');
					$this->email->message($this->load->view('email/launch_estate_staff',$mydata, true));
					$this->email->send();  
					
  $data["errorslaunchestate"] = 30; 
}
			
			
		header('Content-type: application/json;');
		echo json_encode($data);
			
		
	 }
	 
	 
	 
	 
	 // Launch Private Seller
	
	public function privateseller()
    {
	$this->load->helper('email');
		
	
    $data = array();
	
   
	
   //Data Fields	
   $private_name = $this->input->post('launchprivatename');
   $private_email = $this->input->post('launchprivateemail');
   $private_phone = $this->input->post('launchprivatephone');
   
		
		
		//Validate
		    if (empty($private_name)) {
				$data["errorslaunchprivate"] = 199;
			    $data["launchprivate_error_msg"] =' Please enter your name.';
			}else if (empty($private_phone)) {
				$data["errorslaunchprivate"] = 198;
			    $data["launchprivate_error_msg"] =' Please enter a contact phone number.';
			}else if (empty($private_email)) {
				$data["errorslaunchprivate"] = 197;
			    $data["launchprivate_error_msg"] =' Please enter your e-mail address.';
			}else if (!valid_email($private_email)) {
				$data["errorslaunchprivate"] = 195;
			    $data["launchprivate_error_msg"] =' Your e-mail address is invalid.';
			} else {
				
				//Save to database
	           $this->launch_model->registerLaunchPrivateSeller($private_name,$private_email,$private_phone);
	
	
	          
				 
	 $mydata = array(
               'email'  => $private_email,
               'name'   => $private_name,
	           'phone'  => $private_phone
	          
					 );
					 
				    //Send email to user
				    $this->email->from('website@onshowapp.co.za','On Show App');
					$this->email->to($private_email);
					$this->email->subject('On Show App Launch');
					$this->email->message($this->load->view('email/launch_private_user',$mydata, true));
					$this->email->send(); 
					
					
					//Send email to staff
					$this->email->from('website@onshowapp.co.za','On Show App');
					$this->email->to('support@onshowapp.co.za');
					$this->email->subject('On Show App Launch');
					$this->email->message($this->load->view('email/launch_private_staff',$mydata, true));
					$this->email->send();   
					
  $data["errorslaunchprivate"] = 10; 
}
			
			
		header('Content-type: application/json;');
		echo json_encode($data);
			
		
	 }
	 
	 
	 
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */