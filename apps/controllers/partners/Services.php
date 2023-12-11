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

	

	public function add_services($id,$service_id)
	{
		
		$data['title'] = title." | Add Documents";

		$data['main_heading'] ="Documents";

		$data['heading'] = "Add Documents";
		$data['documents']		=	$this->services_model->getServices($id);
		$data['partnerId']		=	$this->services_model->getPartnerId($id);
		$data['service']		=	$this->services_model->getServiceObject($service_id);
		$this->load->view('partners/services/add', $data);		
		
	}	

	public function store_services()
	{
		$this->services_model->storeUserServices();
		redirect(base_url()."partners/services/view");	

	}

	



}	

?>