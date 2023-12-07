<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Response extends CI_Controller {

	 
	public function index()
	{
		$data['title'] = title." | Response";
		$data['main_heading'] = "Response";
		$data['heading'] = "Response";
		
			if ($this->session->userdata('common_message') == "") {
				redirect(base_url('unauthorized_access'));
			  }	
		
	   $this->load->view('response.php', $data);
   }
}


