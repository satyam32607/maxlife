<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Services extends CI_Controller {


public function __construct()
	{
		parent:: __construct();
		valid_logged_in(FALSE,'A');	
		$this->load->model('admin/services_model');
		$this->load->library('csvimport');
		$this->load->library('upload');
		$this->load->helper('string');
		}
	
    
	public function add()
	{
		  $data['title'] = title." | Add Service";
		  $data['main_heading'] = "Services";
		  $data['heading'] = "Add Service";
		  $data['already_msg']="";
		  
		  $this->form_validation->set_rules('company_id', 'Company', 'required|trim');
		  $this->form_validation->set_rules('category_id', 'Category', 'required|trim');
		  $this->form_validation->set_rules('service_name', 'Service name', 'required|trim');
		  $this->form_validation->set_rules('service_code', 'Service code', 'required|trim');
		  $this->form_validation->set_rules('service_short_name', 'Service short name', 'trim');
		  $this->form_validation->set_rules('hsn_code', 'HSN/SAC', 'required|trim|min_length[3]|alpha_numeric');
		  $this->form_validation->set_rules('service_price', 'Service Price', 'required|trim');
		  $this->form_validation->set_rules('gst_rate', 'GST Rate', 'required|trim');
		  $this->form_validation->set_rules('description', 'Description', 'trim');
		  
		if ($this->form_validation->run()) {
		  $feilds = array('company_id' =>$this->input->post('company_id'),'category_id' =>$this->input->post('category_id'),'service_name' =>trim($this->input->post('service_name')),'hsn_code' =>trim($this->input->post('hsn_code')));
		  $result = check_unique('services',$feilds);
		  if($result==1)
		  {
			$data['already_msg']=''.$this->input->post('service_name').' already exists, Please try another.';
		  }
		 else
		  {			  
			 $campaign_id =  $this->services_model->add();	
			  if($campaign_id=='0')
			  {
			   $msg = "There is some error in Save Service Record.";
			   $this->session->set_flashdata('warning_message', $msg);	
			  }
			  else  
			  {
			     $msg = "Service has been created successfully.";	
			     $this->session->set_flashdata('success_message', $msg);	
			  }
			   redirect(base_url() . 'admin/services/view');				
			}  
			
	    } //end of add  functionality

	   $this->load->view('admin/services/create.php', $data);
	}
	
	
	public function view()
	{
		$data=array();
		$data['title'] = title." | View Services";
		$data['main_heading'] ="Services";
		$data['heading'] = "View Services";
			 
			 
		$results = $this->services_model->view_services(2);
		  
		$data['results']  = $results;
		$num_rows         = count($results);	
		$data['num_rows'] = $num_rows;		  
		$this->load->view('admin/services/view', $data);		
    } //end of view functionality	
	
	
	
	 public function edit($service_id){
		
	
		  $data['title'] = title." | Edit Service";
		  $data['main_heading'] = "Services";
		  $data['heading'] = "Edit Service";
          $data['already_msg']="";
			 
		  $this->form_validation->set_rules('company_id', 'Company', 'required|trim');
		  $this->form_validation->set_rules('category_id', 'Category', 'required|trim');
		  $this->form_validation->set_rules('service_name', 'Service name', 'required|trim');
		  $this->form_validation->set_rules('service_code', 'Service code', 'required|trim');
		  $this->form_validation->set_rules('service_short_name', 'Service short name', 'trim');
		  $this->form_validation->set_rules('hsn_code', 'HSN/SAC', 'required|trim|min_length[3]|alpha_numeric');
		  $this->form_validation->set_rules('service_price', 'Service Price', 'required|trim');
		  $this->form_validation->set_rules('gst_rate', 'GST Rate', 'required|trim');
		  $this->form_validation->set_rules('description', 'Description', 'trim');
		
		if ($this->form_validation->run()) {
		  // Update records 
		  $feilds = array('company_id' =>$this->input->post('company_id'),'category_id' =>$this->input->post('category_id'),'service_name' =>trim($this->input->post('service_name')),'hsn_code' =>trim($this->input->post('hsn_code')));
		  $unique_id = array('service_id' =>$service_id);
		  $result = check_unique_edit('services',$feilds,$unique_id);
		  if($result==1)
		  { $data['already_msg']=''.$this->input->post('service_name').' already exists, Please try another.';
		  }
		 else
		  {  
		      $result =  $this->services_model->update_service($this->input->post('service_id'));
		      if($result=='1')
			   $msg = "Service record has been updated successfully.";
			  else
			   $msg="There is some error in update record."; 
			   
		      $this->session->set_flashdata('success_message', $msg);
		      redirect(base_url() . "admin/services/view/".$this->input->post('service_id'));								
			  }
		}
		  
		  $result =  $this->services_model->service_edit($service_id);
		  $data['edit_data'] = $result;
		 
		  $this->load->view('admin/services/edit.php', $data);
		 
	}//end of Edit functionality*/
	
	public function status($service_id,$status)
	{	 // Update status  
		 $result = $this->services_model->update_status($service_id,$status);
		 if($result=='1')
		 {
		   $this->session->set_flashdata('success_message', 'Status has been updated successfully.');
		 }
		 else
		 {
			 $this->session->set_flashdata('warning_message', 'There is some error in status updation.');
		 }
		  redirect(base_url() . "admin/services/view");		
		 
	}//end of Status  functionality*/
	

}	
?>