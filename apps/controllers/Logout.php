<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends CI_Controller {

public function __construct()
	{
		parent:: __construct();
		is_logged_in();      
		
		$this->load->model('Logoutmodel');
	}
	
	public function index()
	{
		$result=$this->Logoutmodel->logout();
	}
}


