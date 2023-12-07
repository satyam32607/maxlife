<?php
error_reporting(-1);
ini_set('display_errors', 1);
defined('BASEPATH') OR exit('No direct script access allowed');
class Apidashboard extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		is_logged_in();  
		$this->load->model('admin/apidashboard_model');
	}
	

	function index()
	{
		$data=array();
		$data['title'] = title." | Dashboard";
		$data['heading'] = title." | Dashboard";
	
	   //All date wise Results
	    $consolidated_results = $this->apidashboard_model->daily_log_consolidated();
	    $data['consolidated_results'] = $consolidated_results;
	    $data['total_consolidated_results'] = count($consolidated_results);
	     
		$this->load->view('admin/apidashboard',$data);
	}
	
	 public function log_date_wise(){	
	
	   $data=array();
	   $data['title'] = title." | API Log date wise";
	   $data['main_heading'] = "Reports";
	   $data['heading'] = "API Log date wise";
		
	   //print_r($_POST);	
	    if($this->input->post('sponser_id'))
			 $sponser_id = $this->input->post('sponser_id');
		 elseif($this->uri->segment('4'))
			 $sponser_id=$this->uri->segment('4');
		else
			 $sponser_id='0';
		
	     if($this->input->post('start_date'))
			 $start_date = $this->input->post('start_date');
		  elseif($this->uri->segment('5'))
			 $start_date=$this->uri->segment('5');
		  else
			 $start_date='0'; 
			 
		  if($this->input->post('end_date'))
			 $end_date = $this->input->post('end_date');
		   elseif($this->uri->segment('6'))
			 $end_date=$this->uri->segment('6');
		   else
			 $end_date='0'; 
		
		if($this->input->post('search_by'))
			$search_by = $this->input->post('search_by');
		elseif($this->uri->segment('7'))
			$search_by=$this->uri->segment('7');
		else
			$search_by='0';
			
		if($this->input->post('search_value'))
			$search_value = trim($this->input->post('search_value'));
		elseif($this->uri->segment('8'))
			$search_value=trim($this->uri->segment('8'));
		else
			$search_value='0';
			
		if($this->input->post('per_page'))
			$per_page = $this->input->post('per_page');
		elseif($this->uri->segment('9'))
			$per_page=$this->uri->segment('9');
		else
			$per_page=500;	
			
		$config = array();
		$config["base_url"] = base_url() . "admin/apidashboard/log_date_wise/".$sponser_id."/".$start_date."/".$end_date."/".$search_by."/".$search_value."/".$per_page;
		$config["per_page"] = $per_page;
        $config["uri_segment"] = 10;
		$config["total_rows"] =$this->apidashboard_model->count_log_date_wise($sponser_id,$start_date,$end_date,$search_by,$search_value);
		$this->pagination->initialize($config);
        $page = ($this->uri->segment(10)) ? $this->uri->segment(10) : 0; 
		$data['results'] = $this->apidashboard_model->view_log_date_wise($sponser_id,$start_date,$end_date,$search_by,$search_value,$config['per_page'], $page);
		$data['links']   = $this->pagination->create_links();
		$data['num_rows'] = $config['total_rows'];	
		
		$data['sponser_id'] = $sponser_id;
		$data['start_date'] = $start_date;
		$data['end_date'] = $end_date;
		$data['search_by'] = $search_by;	
		$data['search_value'] = $search_value;	
		$data['per_page'] = $per_page;
		/* echo "<pre>"; 	 
		print_r($data);	  
		 echo "</pre>"; */	 
	   $this->load->view('admin/api_log_date_wise.php', $data);
		}
		
	
	function posp()
	{
		$data=array();
		$data['title'] = title." | Dashboard";
		$data['heading'] = title." | Dashboard";
	
	   //All  date wise Results
	    $consolidated_results = $this->apidashboard_model->posp_daily_log_consolidated();
	    $data['consolidated_results'] = $consolidated_results;
	    $data['total_consolidated_results'] = count($consolidated_results);
	     
		$this->load->view('admin/pospapidashboard',$data);
	}


   public function posp_log_date_wise(){	
	
	   $data=array();
	   $data['title'] = title." | API Log date wise";
	   $data['main_heading'] = "Reports";
	   $data['heading'] = "API Log date wise";
		
	   //print_r($_POST);	
	    if($this->input->post('sponser_id'))
			 $sponser_id = $this->input->post('sponser_id');
		 elseif($this->uri->segment('4'))
			 $sponser_id=$this->uri->segment('4');
		else
			 $sponser_id='0';
		
	     if($this->input->post('start_date'))
			 $start_date = $this->input->post('start_date');
		  elseif($this->uri->segment('5'))
			 $start_date=$this->uri->segment('5');
		  else
			 $start_date='0'; 
			 
		  if($this->input->post('end_date'))
			 $end_date = $this->input->post('end_date');
		   elseif($this->uri->segment('6'))
			 $end_date=$this->uri->segment('6');
		   else
			 $end_date='0'; 
		
		if($this->input->post('search_by'))
			$search_by = $this->input->post('search_by');
		elseif($this->uri->segment('7'))
			$search_by=$this->uri->segment('7');
		else
			$search_by='0';
			
		if($this->input->post('search_value'))
			$search_value = trim($this->input->post('search_value'));
		elseif($this->uri->segment('8'))
			$search_value=trim($this->uri->segment('8'));
		else
			$search_value='0';
			
		if($this->input->post('per_page'))
			$per_page = $this->input->post('per_page');
		elseif($this->uri->segment('9'))
			$per_page=$this->uri->segment('9');
		else
			$per_page=500;	
			
		$config = array();
		$config["base_url"] = base_url() . "admin/apidashboard/log_date_wise/".$sponser_id."/".$start_date."/".$end_date."/".$search_by."/".$search_value."/".$per_page;
		$config["per_page"] = $per_page;
        $config["uri_segment"] = 10;
		$config["total_rows"] =$this->apidashboard_model->count_posp_log_date_wise($sponser_id,$start_date,$end_date,$search_by,$search_value);
		$this->pagination->initialize($config);
        $page = ($this->uri->segment(10)) ? $this->uri->segment(10) : 0; 
		$data['results'] = $this->apidashboard_model->view_posp_log_date_wise($sponser_id,$start_date,$end_date,$search_by,$search_value,$config['per_page'], $page);
		$data['links']   = $this->pagination->create_links();
		$data['num_rows'] = $config['total_rows'];	
		
		$data['sponser_id'] = $sponser_id;
		$data['start_date'] = $start_date;
		$data['end_date'] = $end_date;
		$data['search_by'] = $search_by;	
		$data['search_value'] = $search_value;	
		$data['per_page'] = $per_page;
		/* echo "<pre>"; 	 
		print_r($data);	  
		 echo "</pre>"; */	 
	   $this->load->view('admin/posp_api_log_date_wise.php', $data);
		}
		
}	
?>