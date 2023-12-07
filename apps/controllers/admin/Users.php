<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Users extends CI_Controller {

 var $original_path;
 var $resized_path;	
public function __construct()
	{
		parent:: __construct();
		valid_logged_in(FALSE,'A');	
		$this->load->model('admin/users_model');
		$this->load->library('upload');
		$this->load->library('image_lib');
	}
	
	
	public function add()
	{
	
		  $data['title'] = title." | Add User";
		  $data['main_heading'] = "Users";
		  $data['heading'] = "Add User";
		  $data['already_msg']="";
		  $msg="";
		  
		  $this->form_validation->set_rules('email', 'Primary  Email', 'required|valid_email|is_unique[users.email]');
		  $this->form_validation->set_rules('compass', 'Urn No.', 'required|numeric|is_unique[users.urn_no]');
		  $this->form_validation->set_rules('userpass', 'Password', 'required|trim|min_length[4]|matches[compass]');
		  $this->form_validation->set_rules('compass', 'Confirmation Password', 'required|trim');
		  $this->form_validation->set_rules('first_name', 'First name', 'required|trim');
		  $this->form_validation->set_rules('last_name', 'Last name', 'trim');
		  $this->form_validation->set_rules('date_of_birth', 'Date of Birth', 'required|trim');
		  $this->form_validation->set_rules('gender', 'Gender', 'required');
		  $this->form_validation->set_rules('location_name', 'Locaton name', 'required|trim');
		  $this->form_validation->set_rules('zone_name', 'Zone', 'trim');
		  $this->form_validation->set_rules('state_name', 'State', 'required|trim');
		  $this->form_validation->set_rules('mobile_no1', 'Primary Mobile no', 'trim|required|numeric|min_length[10]');
		
		if ($this->form_validation->run()) {
		  $emailfeilds = array('email' =>trim($this->input->post('email')));
		  $emailresult = check_unique('users',$emailfeilds);
		  if($emailresult==1)
		  {
			$data['already_msg']=''.$this->input->post('email').' already exists, Please try another.';
		  }
		 else
		  {			  
			 $user_id =  $this->users_model->add();	
			 if($user_id!='0')
			   $msg = "User account have been created successfully.";
			 else  
			   $msg = "There is some error in Save User Record";	
			
			 $this->session->set_flashdata('success_message', $msg);	
			 redirect(base_url() . 'admin/users/view');
			}  
			
	    } //end of add  functionality
	   $this->load->view('admin/users/add.php', $data);
	}
	
	
	public function view()
	{
		$data=array();
		$data['title'] = title." | View Users";
		$data['main_heading'] ="Users";
		$data['heading'] = "View Users";
			 
		$results = $this->users_model->view_users();
		  
		$data['results']  = $results;
		$num_rows         = count($results);	
		$data['num_rows'] = $num_rows;		  
		$this->load->view('admin/users/view', $data);		
    } //end of view functionality	
	
	
	
	public function status($user_id,$status)
	{	 // Update status  
	     $result = $this->users_model->update_status($user_id,$status);
		 if($result=='1')
		 {
		   $this->session->set_flashdata('success_message', 'Status has been updated successfully.');
		 }
		 else
		 {
			 $this->session->set_flashdata('warning_message', 'There is some error in status updation.');
		 }
		  redirect(base_url() . "admin/users/view");		
		 
	}//end of Status  functionality*/
	
}	
?>