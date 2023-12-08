<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		is_logged_in();  
		$this->load->model('admin/dashboard_model');
	}
	
	
	
	function index()
	{
		$data=array();
		$data['title'] = title." | Dashboard";
		$data['heading'] = title." | Dashboard";
		
		
	    
	   
		$this->load->view('admin/dashboard',$data);
	}

}	
?>