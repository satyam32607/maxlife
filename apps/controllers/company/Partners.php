<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Partners extends CI_Controller {


public function __construct()
	{
		parent:: __construct();
		valid_logged_in(FALSE,'C');	
		$this->load->model('company/partners_model');
		}
	
	public function view()
	{
		$data=array();
		$data['title'] = title." | View Partners";
		$data['main_heading'] ="Partners";
		$data['heading'] = "View Partners";

        if($this->input->post('company_id'))
			 $company_id = $this->input->post('company_id');
		 elseif($this->uri->segment('4'))
			 $company_id=$this->uri->segment('4');
		else
			 $company_id='0';

		if($this->input->post('user_id'))
			 $user_id = $this->input->post('user_id');
		elseif($this->uri->segment('5'))
			 $user_id=$this->uri->segment('5');
		else
			 $user_id='0';

		$results = $this->partners_model->view_partners($user_id);
		  
		$data['results']  = $results;
		$num_rows         = count($results);	
		$data['num_rows'] = $num_rows;		  
		$data['total_rows'] = $num_rows;
		$data['company_id']	=	$company_id;	  
		$this->load->view('company/partners/view', $data);		
    } //end of view functionality	
	
	

	
}	
?>