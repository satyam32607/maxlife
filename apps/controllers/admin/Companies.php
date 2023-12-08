<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Companies extends CI_Controller {

 var $original_path;
 var $resized_path;	
public function __construct()
	{
		parent:: __construct();
		valid_logged_in(FALSE,'A');	
		$this->load->model('admin/company_model');
		$this->load->model('admin/master_model');
		$this->load->library('upload');
		$this->load->library('image_lib');
	}
	
	public function view()
	{
		$data=array();
		$data['title'] = title." | View Companies";
		$data['main_heading'] ="Companies";
		$data['heading'] = "View Companies";
			 
			 
		$results = $this->company_model->view_companys();
		  
		$data['results']  = $results;
		$num_rows         = count($results);	
		$data['num_rows'] = $num_rows;		  
		$this->load->view('admin/company/view', $data);		
    } //end of view functionality	
	
	
	public function add()
	{
	
		  $data['title'] = title." | Add Company";
		  $data['main_heading'] = "Companies";
		  $data['heading'] = "Add Company";
		  $data['already_msg']="";
		  
		  $this->form_validation->set_rules('comp_name', 'Company name', 'required|trim');
		  $this->form_validation->set_rules('email', 'Primary  Email', 'required|valid_email|is_unique[users.email]');
		  $this->form_validation->set_rules('userpass', 'Password', 'required|trim|min_length[3]|matches[compass]');
		  $this->form_validation->set_rules('compass', 'Confirmation Password', 'required|trim');
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
		  $this->form_validation->set_rules('mobile_no1', 'Primary Mobile no', 'trim|required|numeric|min_length[10]|is_unique[users.mobile_no1]');
		  $this->form_validation->set_rules('mobile_no2', 'Other Mobile no', 'trim|numeric|min_length[10]');
		  $this->form_validation->set_rules('address', 'Address', 'required|min_length[3]');
		  $this->form_validation->set_rules('workflow_limit', 'Workflow Limit', 'required');
		  $this->form_validation->set_rules('role_rights[]','Company Modules', 'required');
		  $this->form_validation->set_rules('user_modules[]','Users Modules', 'required');
		  $this->form_validation->set_rules('company_profile', 'Company profile', 'trim');
		  
		  $this->form_validation->set_rules('direct_extension', 'Direct extension', 'trim|numeric|min_length[2]');
		  if($this->input->post('call_priority')=='1')
		  $this->form_validation->set_rules('mobile_no1', 'Primary Mobile no', 'trim|required|numeric|min_length[10]|is_unique[users.mobile_no1]');
		  elseif($this->input->post('call_priority')=='2')
		  $this->form_validation->set_rules('landline_no', 'Landline no', 'trim|numeric|min_length[10]');
		  elseif($this->input->post('call_priority')=='3')
		  $this->form_validation->set_rules('sip_login_id', 'SIP login id', 'trim|required|min_length[6]|max_length[100]|alpha_numeric');
		  
		  
		if ($this->form_validation->run()) {
		  $api_feilds = array('email' =>trim($this->input->post('email')));
		  $api_result = check_unique_api('users',$api_feilds);
		  	
		  $emailfeilds = array('email' =>trim($this->input->post('email')));
		  $emailresult = check_unique('users',$emailfeilds);
		  
		  $mobilefeilds = array('mobile_no1' =>trim($this->input->post('mobile_no1')));
		  $mobileresult = check_unique('users',$mobilefeilds);
		  
		  if($emailresult==1)
		  {
			$data['already_msg']=''.$this->input->post('email').' already exists, Please try another.';
		  }
		  elseif($mobileresult==1)
		  {
			$data['already_msg']=''.$this->input->post('mobile_no1').' already exists, Please try another.';
		  }
		  elseif($api_result==1)
		  {
			$data['already_msg']=''.$this->input->post('email').' already exists, Please try another.';
		  }
		  else
		  {			  
			// Call Hotline Api To Save Company If True Then Continue Otherwise Show Error 
			 $result_info = 	json_decode(save_company_on_hotline('add',NULL),TRUE);
			
			 if($result_info && $result_info['results']['status']==TRUE){
				 $myhotline_master_id =  $result_info['results']['users_id'];
			     $user_id =  $this->company_model->add($myhotline_master_id);	
			     $this->original_path = realpath('assets/static/'.$user_id.'/user_photos/original');
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
					$result_photo = $this->company_model->update_photo($user_id,$file_name);
				}
			 }		  
			     if($user_id=='0')
			       $msg = "There is some error in Save Company Record.";
			     else  
			       $msg = "Company account have been created successfully.";			 
			    $this->session->set_flashdata('success_message', $msg);	
			    redirect(base_url() . 'admin/companies/view');				
			}  
			else{
			   $this->session->set_flashdata('warning_message',$result_info['results']['message']);
			}
			   
		  }
			
			
	    } //end of add  functionality
		
		$data['country_id'] = isset($_POST['country_id']) ? $_POST['country_id'] : 101;
		$data['country_code'] = isset($_POST['country_code']) ? $_POST['country_code'] : '+91';
		$data['state_id'] = isset($_POST['state_id']) ? $_POST['state_id'] : 0;
		$data['city_id'] = isset($_POST['city_id']) ? $_POST['city_id'] : 0;
		  
	   $this->load->view('admin/company/add.php', $data);
	}
	
	public function edit($user_id){
		
		  $result =  $this->company_model->company_edit($user_id);
		  
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
		      $result =  $this->company_model->update_company($this->input->post('user_id'),$this->input->post('user_address_id'));		   		      $this->original_path = realpath('assets/static/'.$user_id.'/user_photos/original');
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
				$result_photo = $this->company_model->update_photo($user_id,$file_name);
			}
		 }
		 
		      if($result=='1')
			   $msg = "Company record has been updated successfully.";
			  else
			   $msg="There is some error in update record."; 
			   
		      $this->session->set_flashdata('success_message', $msg);
		      redirect(base_url() . "admin/companies/view/".$this->input->post('user_id'));								
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
		  $this->load->view('admin/company/edit.php', $data);
		 
	}//end of Edit functionality*/
	
	public function status($user_id,$status)
	{	 // Update status  
	     $result = $this->company_model->update_status($user_id,$status);
		 if($result=='1')
		 {
		   $this->session->set_flashdata('success_message', 'Status has been updated successfully.');
		 }
		 else
		 {
			 $this->session->set_flashdata('warning_message', 'There is some error in status updation.');
		 }
		  redirect(base_url() . "admin/companies/view");		
		 
	}//end of Status  functionality*/
	
	public function view_alias()
	{
		$data=array();
		$data['title'] = title." | View Alias Admin";
		$data['main_heading'] ="Alias";
		$data['heading'] = "View Alias Admin";
		
		 if($this->input->post('company_id'))
			 $company_id = $this->input->post('company_id');
		 elseif($this->uri->segment('4'))
			 $company_id=$this->uri->segment('4');
		else
			 $company_id='0';
			 
		$results = $this->company_model->view_alias($company_id);
		  
		$data['results'] = $results;
		$num_rows = count($results);	
		$data['num_rows'] = $num_rows;
		  
		$this->load->view('admin/company/view_alias', $data);
		
    } //end of view functionality
	
	
	public function users(){	
	
	    $data['title'] = title." | View Users";
		$data['main_heading'] = "Users";	
		$data['heading'] = "View Users";	
		
	   //print_r($_POST);	
	    if($this->input->post('company_id'))
			 $company_id = $this->input->post('company_id');
		 elseif($this->uri->segment('4'))
			 $company_id=$this->uri->segment('4');
		else
			 $company_id='0';
		
	  if($this->input->post('designation_id'))
			$designation_id = $this->input->post('designation_id');
		 elseif($this->uri->segment('5'))
			$designation_id=$this->uri->segment('5');
		else
			$designation_id='0';
					
	   if($this->input->post('role_id'))
			$role_id = $this->input->post('role_id');
		 elseif($this->uri->segment('6'))
			$role_id=$this->uri->segment('6');
		else
			$role_id='0';
		
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
		
		if($this->input->post('status'))
			$status = $this->input->post('status');
		 elseif($this->uri->segment('9'))
			 $status=$this->uri->segment('9');
		else
			 $status='0';	 
		 
			
		if($this->input->post('per_page'))
			$per_page = $this->input->post('per_page');
		elseif($this->uri->segment('10'))
			$per_page=$this->uri->segment('10');
		else
			$per_page=per_page;	
			
		$config = array();
		$config["base_url"] = base_url() . "admin/companies/users/".$company_id."/".$designation_id."/".$role_id."/".$search_by."/".$search_value."/".$status."/".$per_page;
		$config["per_page"] = $per_page;
        $config["uri_segment"] = 11;
		$config["total_rows"] =$this->company_model->count_users($company_id,$designation_id,$role_id,$search_by,$search_value,$status);
		$this->pagination->initialize($config);
        $page = ($this->uri->segment(11)) ? $this->uri->segment(11) : 0; 
		$data['results'] = $this->company_model->view_users($company_id,$designation_id,$role_id,$search_by,$search_value,$status,$config['per_page'], $page);
		$data['links']   = $this->pagination->create_links();
		$data['num_rows'] = $config['total_rows'];	
		
		$data['company_id'] = $company_id;
		$data['designation_id'] = $designation_id;
		$data['role_id'] = $role_id;
		$data['status'] = $status;
		$data['search_by'] = $search_by;	
		$data['search_value'] = $search_value;	
		$data['per_page'] = $per_page;
		  	  
	    $this->load->view('admin/company/view_users.php', $data);
		}
	
		public function view_vendors($id)
	{
		$data['title'] = title." | View Partners";
		$data['main_heading'] = "Partners";	
		$data['heading'] = "View Partners";
		$data["num_rows"] 	=	$this->company_model->count_partners($id);
		$data["results"] 		=	$this->company_model->view_partners($id);
		$data["company_id"] 	=	$id;
		$this->load->view('admin/partners/view.php', $data);
	}
	

	public function add_services($id)
	{	
		$data['title'] 			= 	title." | Add Services";
		$data['main_heading'] 	= 	"Services";	
		$data['heading'] 		=	"Add Services";
		$data['partner_id']		=	$id;
		$data['services']		=	$this->company_model->get_services();
		$this->load->view('admin/services/add.php', $data);
	}

	public function store_services()
	{	
		$company_id	=		$this->company_model->store_services();
		redirect(base_url()."admin/companies/partner_services/".$company_id.'/'.$_POST['partner_id']);
	}

	public function partner_services($id,$partner_id)
	{
		$data['title'] 			= 	title." | User Services";
		$data['main_heading'] 	= 	"Partners";	
		$data['heading'] 		=	"User Services";
		$data['partner_id']		=	$partner_id;
		$data['id']				=	$id;
		$data					=	array_merge($this->company_model->fetch_partner_services($id,$partner_id),$data);

		$this->load->view('admin/services/user_services.php', $data);
	}

	public function partner_service_document($id)
	{
		echo $id;
	}
}	
?>