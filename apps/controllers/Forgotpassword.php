<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Forgotpassword extends CI_Controller {

public function __construct()
	{
		parent:: __construct();
		time_zone();
		$this->load->model('forgotpasswordmodel');
		$this->load->library('email');
	}
	
	public function index()
	{
		$data['title'] = title." | Forgot password";
		$data['heading'] = title." | Forgot password";
		$data['msg'] = "";
		$data['success_msg'] = "";
		
		//Validate the credentials
		$this->form_validation->set_rules('email', 'E-mail','trim|required');
	   if($this->form_validation->run())
        {
			//Forgot Password Model use to check user exists or not
			$result=$this->forgotpasswordmodel->forgot(trim($this->input->post("email")));
			if($result=='0')
			{
			   $data['msg'] = "We don't have any account created with the given E-mail.";
			}
			elseif($result=='1')
			{
			   $data['success_msg'] = "An email has been sent to you. Please click on the link provided in the mail to reset your password.";
			}
			elseif($result=='2')
			{
			   $data['msg'] = "Sorry, There is some error in E-mail sending. Please try again later.";
			}
			else
			{
			   $data['msg'] = "We don't have any account created with the given E-mail.";
			}
	   }
	   $this->load->view('forgotpassword.php', $data);
   }
	
	
}	
?>