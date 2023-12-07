<?php
error_reporting(-1);
ini_set('display_errors', 1);
defined('BASEPATH') OR exit('No direct script access allowed');
class Dwchapters extends CI_Controller {


public function __construct()
	{
		parent:: __construct();
		valid_logged_in(FALSE,'A');	
		$this->load->model('admin/trainingpushreports_model');
		$this->load->helper('download');
		}
	
	
	public function push_report(){	
	
	   $data=array();
	   $data['title'] = title." | Push Reports";
	   $data['main_heading'] = "Reports";
	   $data['heading'] = "Push Reports";
		
	   //print_r($_POST);	
	    if($this->input->post('batch_id'))
			 $batch_id = $this->input->post('batch_id');
		 elseif($this->uri->segment('4'))
			 $batch_id=$this->uri->segment('4');
		else
			 $batch_id='0';
		
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
			$per_page=per_page;	
			
		$config = array();
		$config["base_url"] = base_url() . "admin/trainingpushreports/push_report/".$batch_id."/".$start_date."/".$end_date."/".$search_by."/".$search_value."/".$per_page;
		$config["per_page"] = $per_page;
        $config["uri_segment"] = 10;
		$config["total_rows"] =$this->trainingpushreports_model->count_push_report($batch_id,$start_date,$end_date,$search_by,$search_value);
		$this->pagination->initialize($config);
        $page = ($this->uri->segment(10)) ? $this->uri->segment(10) : 0; 
		$data['results'] = $this->trainingpushreports_model->view_push_report($batch_id,$start_date,$end_date,$search_by,$search_value,$config['per_page'], $page);
		$data['links']   = $this->pagination->create_links();
		$data['num_rows'] = $config['total_rows'];	
		
		$data['batch_id'] = $batch_id;
		$data['start_date'] = $start_date;
		$data['end_date'] = $end_date;
		$data['search_by'] = $search_by;	
		$data['search_value'] = $search_value;	
		$data['per_page'] = $per_page;
		/* echo "<pre>"; 	 
		print_r($data);	  
		 echo "</pre>"; */	 
	   $this->load->view('admin/trainingpushreports/push_report.php', $data);
		}
		
		
	public function push_report_date_wise(){	
	
	   $data=array();
	   $data['title'] = title." | Push Report date wise";
	   $data['main_heading'] = "Reports";
	   $data['heading'] = "Push Report date wise";
		
	     //print_r($_POST);	
		  if($this->input->post('candidate_id'))
			 $candidate_id = $this->input->post('candidate_id');
		  elseif($this->uri->segment('4'))
			 $candidate_id=$this->uri->segment('4');
		  else
			 $candidate_id='0'; 
			 
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
		elseif($this->uri->segment('0'))
			$per_page=$this->uri->segment('0');
		else
			$per_page=per_page;	
			
		$config = array();
		$config["base_url"] = base_url() . "admin/trainingpushreports/push_report_date_wise/".$candidate_id."/".$end_date."/".$search_by."/".$search_value."/".$per_page;
		$config["per_page"] = $per_page;
        $config["uri_segment"] = 10;
		$config["total_rows"] =$this->trainingpushreports_model->count_push_report_date_wise($candidate_id,$start_date,$end_date,$search_by,$search_value);
		$this->pagination->initialize($config);
        $page = ($this->uri->segment(10)) ? $this->uri->segment(10) : 0; 
		$data['results'] = $this->trainingpushreports_model->view_push_report_date_wise($candidate_id,$start_date,$end_date,$search_by,$search_value,$config['per_page'], $page);
		$data['links']   = $this->pagination->create_links();
		$data['num_rows'] = $config['total_rows'];	
		
		$data['candidate_id'] = $candidate_id;
		$data['start_date'] = $start_date;
		$data['end_date'] = $end_date;
		$data['search_by'] = $search_by;	
		$data['search_value'] = $search_value;	
		$data['per_page'] = $per_page;
		  	  
	    $this->load->view('admin/trainingpushreports/push_report_date_wise.php', $data);
		}	


}	
?>