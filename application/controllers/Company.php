<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Company extends CI_Controller {
	
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
		 
		 'pagetitle' => ' Germany Cars Specialists '
		
		 
		 )); 
		
	}
	
	
	
	
	//Contact Us
	public function contact()
    {
        $this->load->view('public/view_contact_us',array('pagetitle' => ' Contact Us'));                          
    }   
	
	
	//Process Contact Us
	public function contact_us_pro()
    {
       
		
		$this->load->helper('email');

		if (isset($_POST['sendmessage'])) {
			$email = $this->input->post("email", true);
			$name = $this->lib_filter->removeHTML(
				$this->input->post("name", true));
			$subject = $this->lib_filter->removeHTML(
				$this->input->post("subject", true));
				$phone = $this->lib_filter->removeHTML(
				$this->input->post("phone", true));
			
			$message = $this->lib_filter->removeHTML(
				$this->input->post("message", true));
			
			

			

			$fail = "";
			
			
			

			

			
			if (strlen($name) > 50) {
				$fail = lang("error_msg_contact_name_long");
			}
			if (strlen($subject) > 255) {
				$fail = lang("error_msg_subject_long");
			}
			if (strlen($email) > 255) {
				$fail = lang("error_msg_email_long");
			}

			if (empty($email)) {
				$fail = lang("error_msg_emptycontactemail");
			}
			
			
			if (empty($name)) {
				$fail = lang("error_msg_emptycontactname");
			}
			
			if (empty($subject)) {
				$fail = lang("error_msg_emptysubject");
			}
			
			if (empty($message)) {
				$fail = lang("error_msg_emptymessage");
			}
			
			

			if (empty($fail)) {
				// Passed all checks 
				
				//Send welcome email
				$mydata = array(
 
               'email'     =>   $email,
               'name'   => $name,
	           'subject'   => $subject,
	           'message'   => $message,
			   'phone'   => $phone
 
);
				
				    $this->email->from('website@keycon.co.za');
					$this->email->to('brian.murwira@keycon.co,brianmurwira@gmail.com,admin@keycon.co.za');
					$this->email->subject('Keycon Website Contact');
					$this->email->message($this->load->view('email/website_contact',$mydata, true));
					
					$this->email->send();
					
				// Redirect to login page	
				$this->session->set_flashdata("globalmsg", lang("flash_data_p25"));
				$this->session->set_userdata('contactmsg','<p style="color:green;">Your message was successfully sent. We will get back to you as soon as we can. Thank you.');
				redirect(base_url("company/contact"));
				
				
			}



		}

		

		if (!empty($fail)) {
			$this->template->loadContent("public/view_contact_us.php", 
				array(
				   'pagetitle' => ' Contact Us',
					"email" => $email,
					"name" => $name, 
					"subject" => $subject,
					"message" => $message, 
					"fail" => $fail
				)
			);
		} 
		
	}
	
	
	
       
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */