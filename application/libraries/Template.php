<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Template
{

	var $cssincludes;

	public function loadContent($view,$data=array(),$die=0)
	{
		$CI =& get_instance();
		$site = array();
		$site['cssincludes'] = $this->cssincludes;
		$site['content'] = $CI->load->view($view,$data,true);
		$CI->load->view("layout/layout.php", $site);
		if($die) die($CI->output->get_output());
	}

	public function loadAjax($view,$data=array(),$die=0) 
	{
		$CI =& get_instance();
		$site = array();
		$site['cssincludes'] = $this->cssincludes;
		$CI->load->view($view,$data);
		if($die) die($CI->output->get_output());
	}

	public function loadExternal($code) 
	{
		$this->cssincludes = $code;
	}

	public function error($message) 
	{
		$this->loadContent("public/login/index.php",array(
		'pagetitle' => ' Error !',
		"message" => $message),1);
	}
	
	

	public function errori($msg) 
	{
		echo "ERROR: " . $msg;
		exit();
	}
	
	public function loadHelpCentreContent($view,$data=array(),$die=0)
	{
		$CI =& get_instance();
		$site = array();
		$site['cssincludes'] = $this->cssincludes;
		$site['content'] = $CI->load->view($view,$data,true);
		$CI->load->view("public/view_help_centre.php", $site);
		if($die) die($CI->output->get_output());
	}
	
	public function baby_error($message) 
	{
		$this->loadContent("vote/baby/view_baby_error.php",array(
		'pagetitle' => ' Error !',
		"message" => $message),1);
	}
	
	public function uploaderror($message) 
	{
		$this->loadContent("vote/baby/view_register.php",array(
		'pagetitle' => ' Upload Error !',
		"message" => $message),1);
	}
	
	
	public function incompleteprofileerror($message,$tokens_count,$rewardpot_balance,$wallet_balance) 
	{
		
		
		
		$this->loadContent("home/view_home.php",array(
		'pagetitle' => ' Welcome : The Life of a Millionaire',
		 "tokens_count" => $tokens_count,
		"rewardpot_balance" => $rewardpot_balance,
		"wallet_balance" => $wallet_balance,
		"message" => $message),1);
	}


}

?>
