<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Services extends CI_Controller {


public function __construct()
	{
		parent:: __construct();
		valid_logged_in(FALSE,'V');	
		$this->load->model('partners/services_model');
		$this->load->library('csvimport');
		$this->load->library('upload');
		$this->load->helper('string');
		}
	
    
	public function view()
	{
		$data=array();
		$data['title'] = title." | View Services";
		$data['main_heading'] ="Services";
		$data['heading'] = "View Services";
			 
			 
		$results = $this->services_model->view_services();
		  
		$data['results']  = $results;
		$num_rows         = count($results);	
		$data['num_rows'] = $num_rows;		  
		$this->load->view('partners/services/view', $data);		
    } //end of view functionality	
	
	
	
	

}	
?>