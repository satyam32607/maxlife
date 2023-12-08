<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//ini_set('display_errors', 'On');
//error_reporting(E_ALL);
class Login extends CI_Controller {	 
	 
	public function index()
	{
		$data['title'] = title." | Login";
		$data['heading'] = title." | Login";
		$data['msg'] = "";

		if($this->session->userdata('user_id'))
		{
			$url = $this->input->post("url");
			if($this->session->userdata('user_type')=='A')
			 {   if($url !=''){
					  redirect($url);  
				   }else{
			      redirect(base_url() . 'admin/dashboard');
				   }
			   }
			   elseif($this->session->userdata('user_type')=='C')
					 {
				   if($url !=''){
					  redirect($url);  
				   }else{
					echo "<script type=\"text/javascript\">
					localStorage.clear();
					 window.location.href ='".base_url()."company/dashboard';
					</script>";
				   }
				   
  		      } 
			   elseif($this->session->userdata('user_type')=='V')
					 {
				   if($url !=''){
					  redirect($url);  
				   }else{
					echo "<script type=\"text/javascript\">
					localStorage.clear();
					 window.location.href ='".base_url()."partners/dashboard';
					</script>";
				   }
				   
  		      } 
		    elseif($this->session->userdata('user_type')=='U')
					 {
				   if($url !=''){
					  redirect($url);  
				   }else{
					echo "<script type=\"text/javascript\">
					localStorage.clear();
					 window.location.href ='".base_url()."users/dashboard';
					</script>";
				   }
  		      }  
		}
		//Validate the credentials
		//$this->load->library('encrypt');
		$this->load->model('Login_model');
		time_zone();
        $this->form_validation->set_rules('username', 'Username','trim|required');
        $this->form_validation->set_rules('password', 'Password','trim|required');
	
		if($this->form_validation->run())
        {
			//print_r($_POST);
			//Fetch the inputs provided by the user
			$url = $this->input->post("url");
			$username = $this->input->post("username");
			$password = $this->input->post("password");
			//Login Model use to check user exists or not
			$result=$this->Login_model->login($username, $password);
			if($result=='0')
			$data['msg'] = "<center>Invalid Username or Password.</center>";
			elseif($result=='1')
			$data['msg'] = "Your login is de-activated. Please contact administrator.";//"Your login is turned off. Please visit later.";
			elseif($result=='2')
			$data['msg'] = "Your login validity has been expired.";
			elseif($result=='3')
			$data['msg'] = "Your working hrs time doesn't match in current time. Please contact administrator.";
			elseif($result=='4')
			$data['msg'] = "Your Access IP doesn't match. Please contact administrator.";
			else{	
				
			   if($this->session->userdata('user_type')=='A'){
				   if($url !=''){
					  redirect($url);  
				   }else{
			      redirect(base_url() . 'admin/dashboard');
				   }
			   }
			    elseif($this->session->userdata('user_type')=='C')
			     {
				   if($url !=''){
					  redirect($url);  
				   }else{
					echo "<script type=\"text/javascript\">
					localStorage.clear();
					 window.location.href ='".base_url()."company/dashboard';
					</script>";
				   }
			   }
			   elseif($this->session->userdata('user_type')=='V')
			     {
				   if($url !=''){
					  redirect($url);  
				   }else{
					echo "<script type=\"text/javascript\">
					localStorage.clear();
					 window.location.href ='".base_url()."partners/dashboard';
					</script>";
				   }
			     }
			     elseif($this->session->userdata('user_type')=='U')
			     	   {
				   if($url !=''){
					  redirect($url);  
				   }else{
					echo "<script type=\"text/javascript\">
					localStorage.clear();
					 window.location.href ='".base_url()."users/dashboard';
					</script>";
				   }
			   }

			   
			  }
			
			}
			/*echo "<pre>";
			print_r($data);
			echo "</pre>";*/
		   $this->load->view('login.php', $data);		 
	}
}