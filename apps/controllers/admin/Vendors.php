<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Vendors extends CI_Controller {

 var $original_path;
 var $resized_path;	
public function __construct()
	{
		parent:: __construct();
		valid_logged_in(FALSE,'A');	
		$this->load->model('admin/vendors_model');
		$this->load->library('upload');
		$this->load->library('image_lib');
	}
	
	public function view()
	{
		$data=array();
		$data['title'] = title." | View Vendors";
		$data['main_heading'] ="Vendors";
		$data['heading'] = "View Vendors";
			 
			 
		$results = $this->vendors_model->view_vendors();
		  
		$data['results']  = $results;
		$num_rows         = count($results);	
		$data['num_rows'] = $num_rows;		  
		$this->load->view('admin/vendors/view', $data);		
    } //end of view functionality	
	
	
	public function add()
	{
	
		  $data['title'] = title." | Add Vendor";
		  $data['main_heading'] = "Vendors";
		  $data['heading'] = "Add Vendor";
		  $data['already_msg']="";
		  
		  $this->form_validation->set_rules('vendor_name', 'Vendor name', 'required|trim');
		  $this->form_validation->set_rules('email', 'Primary  Email', 'required|valid_email|is_unique[users.email]');
		  $this->form_validation->set_rules('userpass', 'Password', 'required|trim|min_length[3]|matches[compass]');
		  $this->form_validation->set_rules('compass', 'Confirmation Password', 'required|trim');
		  $this->form_validation->set_rules('alternate_email', 'Alternate Email', 'valid_email');
	      $this->form_validation->set_rules('time_zone', 'Time zone', 'required|trim');
		  $this->form_validation->set_rules('first_name', 'First name', 'required|trim');
		  $this->form_validation->set_rules('last_name', 'Last name', 'trim');
		  $this->form_validation->set_rules('mobile_no1', 'Primary Mobile no', 'trim|numeric|min_length[10]');
		  $this->form_validation->set_rules('mobile_no2', 'Other Mobile no', 'trim|numeric|min_length[10]');
		  $this->form_validation->set_rules('address', 'Address', 'trim');
		  
		if ($this->form_validation->run()) {
			  	
		  $emailfeilds = array('email' =>trim($this->input->post('email')));
		  $emailresult = check_unique('users',$emailfeilds);
		  
		 if($emailresult==1)
		  {
			$data['already_msg']=''.$this->input->post('email').' already exists, Please try another.';
		  }
		 else
		  {			  
			 $user_id =  $this->vendors_model->add($myhotline_master_id);	
			 if($user_id!='0'){
			 
			 $this->original_path = realpath('assets/static/'.$user_id.'/vendor_photos/original');
			 $this->resized_path = realpath('assets/static/'.$user_id.'/vendor_photos/resized'); 	
			 if($_FILES['user_photo']['error'] != 4){							  
			  $config['upload_path'] = $this->original_path;
			  $config['allowed_types'] = 'jpeg|gif|jpg|png';
			  $config['max_size']	= '5120';
			  $config['max_width']  = '0';
			  $config['max_height']  = '0';
			  $config['overwrite'] = true;			
			  $config['file_name'] =$user_id.'-'.$_FILES['user_photo']['name'];
			  $this->upload->initialize($config);
			  
			  if ( ! $this->upload->do_upload('user_photo')){
					$data['already_msg']=$this->upload->display_errors();
					$success = FALSE;
				}
			else{
					$data = $this->upload->data();
					$file_name = $data['file_name'];
					$original_path = $data['full_path'];
					$image_thumb  =$this->resized_path.'/'.$file_name;
					$config1['image_library']    = 'gd2';
					$config1['source_image']     = $original_path;
					$config1['new_image']        = $image_thumb;
					$config1['maintain_ratio']   = TRUE;
					$config1['height']              = 150;
					$config1['width']              = 150;
					$this->image_lib->initialize( $config1);
					$this->image_lib->resize();
					$this->image_lib->clear();									
					$result_photo = $this->vendors_model->update_photo($user_id,$file_name);
				}
			 }		  
			     if($user_id=='0')
			       $msg = "There is some error in Save Vendor Record.";
			     else  
			       $msg = "Company account have been created successfully.";			 
			    $this->session->set_flashdata('success_message', $msg);	
			    redirect(base_url() . 'admin/companies/view');				
			}  
			else{
			   $this->session->set_flashdata('warning_message','There is some error in Save Vendor Record.');
			}
			   
		  }
			
			
	    } //end of add  functionality
		
		$data['country_id'] = isset($_POST['country_id']) ? $_POST['country_id'] : 101;
		$data['country_code'] = isset($_POST['country_code']) ? $_POST['country_code'] : '+91';
		$data['state_id'] = isset($_POST['state_id']) ? $_POST['state_id'] : 0;
		$data['city_id'] = isset($_POST['city_id']) ? $_POST['city_id'] : 0;
		  
	   $this->load->view('admin/vendors/add.php', $data);
	}
	
	public function edit($user_id){
		
		  $result =  $this->vendors_model->company_edit($user_id);
		  
		  $data['title'] = title." | Edit Company";
		  $data['main_heading'] = "Companies";
		  $data['heading'] = "Edit Company";
          $data['already_msg']="";
			 
		  $this->form_validation->set_rules('comp_name', 'Company name', 'required|trim');
		  $this->form_validation->set_rules('email', 'Primary  Email', 'required|valid_email');
		  $this->form_validation->set_rules('alternate_email', 'Alternate Email', 'valid_email');
	      $this->form_validation->set_rules('time_zone', 'Time zone', 'required|trim');
		  $this->form_validation->set_rules('first_name', 'First name', 'required|trim');
		  $this->form_validation->set_rules('last_name', 'Last name', 'trim');
		  $this->form_validation->set_rules('country_id', 'Country', 'required|trim');
		  $this->form_validation->set_rules('state_id', 'State', 'required');
		  $this->form_validation->set_rules('city_id', 'City', 'required');
		  $this->form_validation->set_rules('pin_code', 'Pin code', 'trim|numeric|min_length[4]');
		  $this->form_validation->set_rules('country_code', 'Country code', 'required|trim');
		  $this->form_validation->set_rules('landline_no', 'Landline no', 'trim|min_length[6]');
		  $this->form_validation->set_rules('mobile_no1', 'Primary Mobile no', 'trim|required|numeric|min_length[10]');
		  $this->form_validation->set_rules('mobile_no2', 'Other Mobile no', 'trim|numeric|min_length[10]');
		  $this->form_validation->set_rules('address', ' Address', 'required|min_length[3]');
		  $this->form_validation->set_rules('workflow_limit', 'Workflow Limit', 'required');
		  $this->form_validation->set_rules('role_rights[]','Company Modules', 'required');
		  $this->form_validation->set_rules('user_modules[]','Users Modules', 'required');
		  $this->form_validation->set_rules('company_profile', 'Company profile', 'trim');
		  
		  $this->form_validation->set_rules('direct_extension', 'Direct extension', 'trim|numeric|min_length[2]');
		  if($this->input->post('call_priority')=='1')
		  $this->form_validation->set_rules('mobile_no1', 'Primary Mobile no', 'trim|required|numeric|min_length[10]');
		  elseif($this->input->post('call_priority')=='2')
		  $this->form_validation->set_rules('landline_no', 'Landline no', 'trim|numeric|min_length[10]');
		  elseif($this->input->post('call_priority')=='3')
		  $this->form_validation->set_rules('sip_login_id', 'SIP login id', 'trim|required|min_length[6]|max_length[100]|alpha_numeric');
		  
		if ($this->form_validation->run()) {
		  // Update records 
		  
		  
		  $api_feilds = array('email' =>trim($this->input->post('email')));
		  $unique_id = array('user_id' =>$user_id);
		  $api_result = check_unique_api_edit('users',$api_feilds,$unique_id);
		  	
		  $email_feild = array('email' =>trim($this->input->post('email')));
		  $unique_id = array('user_id' =>$user_id);
		  $email_result = check_unique_edit('users',$email_feild,$unique_id);
		  
		  $mobile_feild = array('mobile_no1' =>trim($this->input->post('mobile_no1')));
		  $unique_id = array('user_id' =>$user_id);
		  $mobile_result = check_unique_edit('users',$mobile_feild,$unique_id);
		  
		  if($email_result==1)
		  {
			 $data['already_msg']=''.$this->input->post('email').' already exists, Please try another.';
		  }
		  elseif($mobile_result==1)
		  {
			 $data['already_msg']=''.$this->input->post('mobile_no1').' already exists, Please try another.';
		  }
		  elseif($api_result==1)
		  {
			$data['already_msg']=''.$this->input->post('email').' already exists, Please try another.';
		  }
		 else
		  {  
		  $myhotline_user_id = $result->myhotline_master_id;
		
		   // Call Hotline Api To Update Company If True Then Continue Otherwise Show Error 
		 	$result_info = 	json_decode(save_company_on_hotline('edit',$myhotline_user_id),TRUE);
			
  			if($result_info && $result_info['results']['status']==TRUE){
		      $result =  $this->vendors_model->update_company($this->input->post('user_id'),$this->input->post('user_address_id'));		   		      $this->original_path = realpath('assets/static/'.$user_id.'/user_photos/original');
   		      $this->resized_path = realpath('assets/static/'.$user_id.'/user_photos/resized');
	
		      if($_FILES['user_photo']['error'] != 4){							  
		  $config['upload_path'] = $this->original_path;
		  $config['allowed_types'] = 'jpeg|gif|jpg|png';
		  $config['max_size']	= '5120';
		  $config['max_width']  = '0';
		  $config['max_height']  = '0';
		  $config['overwrite'] = true;			
		  $config['file_name'] =$user_id.'-'.$_FILES['user_photo']['name'];
		  $this->upload->initialize($config);
		  
		  if ( ! $this->upload->do_upload('user_photo')){
			    $data['already_msg']=$this->upload->display_errors();
				$success = FALSE;
			}
		else{
				$data = $this->upload->data();
				$file_name = $data['file_name'];
				$original_path = $data['full_path'];
				$image_thumb  =$this->resized_path.'/'.$file_name;
				$config1['image_library']    = 'gd2';
				$config1['source_image']     = $original_path;
				$config1['new_image']        = $image_thumb;
				$config1['maintain_ratio']   = TRUE;
				$config1['height']              = 150;
				$config1['width']              = 150;
				$this->image_lib->initialize( $config1);
				$this->image_lib->resize();
				$this->image_lib->clear();									
				$result_photo = $this->vendors_model->update_photo($user_id,$file_name);
			}
		 }
		 
		      if($result=='1')
			   $msg = "Company record has been updated successfully.";
			  else
			   $msg="There is some error in update record."; 
			   
		      $this->session->set_flashdata('success_message', $msg);
		      redirect(base_url() . "admin/vendors/view/".$this->input->post('user_id'));								
			}
			else{
			   $this->session->set_flashdata('warning_message',$result_info['results']['message']);
			  }	
		  }
		}
		  
		  $inforesult =  get_table_info('user_info','user_id',$user_id);
		  $data['edit_data'] = $result;
		  $data['info_data'] = $inforesult;
		  $data['country_id'] = isset($result->country_id) ? $result->country_id : 0;
		  $data['country_code'] = isset($result->country_code) ? $result->country_code : 0;
		  $data['state_id'] = isset($result->state_id) ? $result->state_id : 0;
		  $data['city_id'] = isset($result->city_id) ? $result->city_id : 0;
		  
		  $listfields = array('user_id'=>$user_id,'list_id'=>'company_total_workflow');
		  $listrow = gettableinfo('list_options',$listfields);
		  $data['workflow_limit'] = isset($listrow->option_id) ? $listrow->option_id : 'ssss';
		  $this->load->view('admin/vendors/edit.php', $data);
		 
	}//end of Edit functionality*/
	
	public function status($user_id,$status)
	{	 // Update status  
	     $result = $this->vendors_model->update_status($user_id,$status);
		 if($result=='1')
		 {
		   $this->session->set_flashdata('success_message', 'Status has been updated successfully.');
		 }
		 else
		 {
			 $this->session->set_flashdata('warning_message', 'There is some error in status updation.');
		 }
		  redirect(base_url() . "admin/vendors/view");		
		 
	}//end of Status  functionality*/


	
}	
?>