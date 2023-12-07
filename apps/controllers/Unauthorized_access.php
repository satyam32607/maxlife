<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Unauthorized_access extends CI_Controller {

	 
	public function index()
	{
		$data['title'] = title." | Unauthorized attempt";
		$data['main_heading'] = "Unauthorized";
		$data['heading'] = "Unauthorized attempt";
		
	   $this->load->view('unauthorized_access.php', $data);
   }
}


