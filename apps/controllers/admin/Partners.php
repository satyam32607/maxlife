<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Partners extends CI_Controller {


public function __construct()
	{
		parent:: __construct();
		valid_logged_in(FALSE,'A');	
		$this->load->model('admin/partners_model');
		$this->load->library('upload');
		$this->load->library('image_lib');
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

		$results = $this->partners_model->view_partners($company_id,$user_id);
		  
		$data['results']  = $results;
		$num_rows         = count($results);	
		$data['num_rows'] = $num_rows;		  
		$data['total_rows'] = $num_rows;
		$data['company_id']	=	$company_id;	  
		$this->load->view('admin/partners/view', $data);		
    } //end of view functionality	
	
	
	public function add()
	{
		  $data['title'] = title." | Add Patner";
		  $data['main_heading'] = "Patners";
		  $data['heading'] = "Add Patner";
		  $data['already_msg']="";
		  
		  $this->form_validation->set_rules('company_id', 'Choose Company', 'required|trim');
		  $this->form_validation->set_rules('comp_name', 'Company name', 'required|trim');
		  $this->form_validation->set_rules('email', 'Primary  Email', 'required|valid_email|is_unique[users.email]');
		  $this->form_validation->set_rules('userpass', 'Password', 'required|trim|min_length[3]|matches[compass]');
		  $this->form_validation->set_rules('compass', 'Confirmation Password', 'required|trim');
		  $this->form_validation->set_rules('first_name', 'First name', 'required|trim');
		  $this->form_validation->set_rules('last_name', 'Last name', 'trim');
		  $this->form_validation->set_rules('country_id', 'Country', 'required|trim');
		  $this->form_validation->set_rules('state_id', 'State', 'required');
		  $this->form_validation->set_rules('city_id', 'City', 'required');
		  $this->form_validation->set_rules('pin_code', 'Pin code', 'trim|numeric|min_length[4]');
		  $this->form_validation->set_rules('mobile_no1', 'Primary Mobile no', 'trim|required|numeric|min_length[10]');
		  $this->form_validation->set_rules('mobile_no2', 'Other Mobile no', 'trim|numeric|min_length[10]');
		  $this->form_validation->set_rules('alternate_email', 'Alternate Email', 'valid_email');
          $this->form_validation->set_rules('landline_no', 'Landline no', 'trim|min_length[6]');
		  $this->form_validation->set_rules('address', 'Address', 'trim');
		  $this->form_validation->set_rules('pan_no', 'Pan No', 'required|trim|min_length[10]');
		  $this->form_validation->set_rules('gst_no', 'GST No', 'required|trim|max_length[20]');
		  $this->form_validation->set_rules('company_profile', 'Company profile', 'trim');
				  
		if ($this->form_validation->run()) {

		  	
		  $emailfeilds = array('email' =>trim($this->input->post('email')));
		  $emailresult = check_unique('users',$emailfeilds);
		 
		  if($emailresult==1)
		  {
			$data['already_msg']=''.$this->input->post('email').' already exists, Please try another.';
		  }
		  else
		  {			  
		
             $user_id =  $this->partners_model->add();	

                if($user_id=='0')
                $msg = "There is some error in create Partner Record.";
                else  
                $msg = "Partner account have been created successfully.";	

            $this->session->set_flashdata('success_message', $msg);	
            redirect(base_url() . 'admin/partners/view');				
			   
		  }
			
			
	    } //end of add  functionality
		
		$data['country_id'] = isset($_POST['country_id']) ? $_POST['country_id'] : 101;
		$data['state_id'] = isset($_POST['state_id']) ? $_POST['state_id'] : 0;
		$data['city_id'] = isset($_POST['city_id']) ? $_POST['city_id'] : 0;
		  
	   $this->load->view('admin/partners/add.php', $data);
	}
	
	public function edit($user_id){
		
		
		  $data['title'] = title." | Edit Partner";
		  $data['main_heading'] = "Partners";
		  $data['heading'] = "Edit Partner";
          $data['already_msg']="";
			 
		  $this->form_validation->set_rules('company_id', 'Choose Company', 'required|trim');
          $this->form_validation->set_rules('comp_name', 'Company name', 'required|trim');
		  $this->form_validation->set_rules('first_name', 'First name', 'required|trim');
		  $this->form_validation->set_rules('last_name', 'Last name', 'trim');
		  $this->form_validation->set_rules('country_id', 'Country', 'required|trim');
		  $this->form_validation->set_rules('state_id', 'State', 'required');
		  $this->form_validation->set_rules('city_id', 'City', 'required');
		  $this->form_validation->set_rules('pin_code', 'Pin code', 'trim|numeric|min_length[4]');
		  $this->form_validation->set_rules('mobile_no1', 'Primary Mobile no', 'trim|required|numeric|min_length[10]');
		  $this->form_validation->set_rules('mobile_no2', 'Other Mobile no', 'trim|numeric|min_length[10]');
		  $this->form_validation->set_rules('alternate_email', 'Alternate Email', 'valid_email');
          $this->form_validation->set_rules('landline_no', 'Landline no', 'trim|min_length[6]');
		  $this->form_validation->set_rules('address', 'Address', 'trim');
		  $this->form_validation->set_rules('pan_no', 'Pan No', 'required|trim|min_length[10]');
		  $this->form_validation->set_rules('gst_no', 'GST No', 'required|trim|max_length[20]');
		  $this->form_validation->set_rules('company_profile', 'Company profile', 'trim');
		
		if ($this->form_validation->run()) {
		  // Update records 
		  $email_feild = array('email' =>trim($this->input->post('email')));
		  $unique_id = array('user_id' =>$user_id);
		  $email_result = check_unique_edit('users',$email_feild,$unique_id);
		  
		  if($email_result==1)
		  {
			 $data['already_msg']=''.$this->input->post('email').' already exists, Please try another.';
		  }
		 else
		  {  
		 
  		      $result =  $this->partners_model->update_partner($this->input->post('user_id'),$this->input->post('user_address_id'));		   		     
       
			  if($result=='1')
			   $msg = "Partner record has been updated successfully.";
			  else
			   $msg="There is some error in update record."; 
			   
		      $this->session->set_flashdata('success_message', $msg);
		      redirect(base_url() . "admin/partners/view/".$this->input->post('company_id')."/".$this->input->post('user_id'));								
			
		  }
		}

		  $result =  $this->partners_model->partner_edit($user_id);
		  $data['edit_data'] = $result;
		  
		  $data['country_id'] = isset($result->country_id) ? $result->country_id : 0;
		  $data['state_id'] = isset($result->state_id) ? $result->state_id : 0;
		  $data['city_id'] = isset($result->city_id) ? $result->city_id : 0;
		  
		  $this->load->view('admin/partners/edit.php', $data);
		 
	}//end of Edit functionality*/

	
	public function status($user_id,$status)
	{	 // Update status  
	     $result = $this->partners_model->update_status($user_id,$status);
		 if($result=='1')
		 {
		   $this->session->set_flashdata('success_message', 'Status has been updated successfully.');
		 }
		 else
		 {
			 $this->session->set_flashdata('warning_message', 'There is some error in status updation.');
		 }
		  redirect(base_url() . "admin/partners/view");		
		 
	}//end of Status  functionality*/
	

	
}	
?>