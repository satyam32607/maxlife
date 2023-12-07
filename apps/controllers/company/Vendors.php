<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Vendors extends CI_Controller {

 var $original_path;
 var $resized_path;	
public function __construct()
	{
		parent:: __construct();
		valid_logged_in(FALSE,'C');	
		$this->load->model('company/vendors_model');
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
		$this->load->view('company/vendors/view', $data);		
    } //end of view functionality	
	
	
	public function add()
	{
	
	
		//	echo "-------------->".;
		  $data['title'] = title." | Add Vendor";
		  $data['main_heading'] = "Vendors";
		  $data['heading'] = "Add Vendor";
		  $data['already_msg']="";
		  
		  $this->form_validation->set_rules('vendor_name', 'Vendor name', 'required|trim');
		  $this->form_validation->set_rules('email', 'Primary  Email', 'required|valid_email|is_unique[users.email]');
		  $this->form_validation->set_rules('userpass', 'Password', 'required|trim|min_length[3]|matches[compass]');
		  $this->form_validation->set_rules('compass', 'Confirmation Password', 'required|trim');
		  $this->form_validation->set_rules('mobile_no1', 'Primary Mobile no', 'trim|numeric|min_length[10]');
		  
		if ($this->form_validation->run()) {
			  	
		  $emailfeilds = array('email' =>trim($this->input->post('email')));
		  $emailresult = check_unique('users',$emailfeilds);
		  
		 if($emailresult==1)
		  {
			$data['already_msg']=''.$this->input->post('email').' already exists, Please try another.';
		  }
		 else
		  {			  
			 $user_id =  $this->vendors_model->add();	
			 if($user_id!='0'){
			 
			 $this->original_path = realpath('assets/static/'.$this->session->userdata('master_id').'/vendor_photos/original');
			 $this->resized_path = realpath('assets/static/'.$this->session->userdata('master_id').'/vendor_photos/resized'); 	
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
			    redirect(base_url() . 'company/vendors/view');				
			}  
			else{
			   $this->session->set_flashdata('warning_message','There is some error in Save Vendor Record.');
			   }
		  }
	    } //end of add  functionality
		
		  
	   $this->load->view('company/vendors/add.php', $data);
	}
	
	public function edit($user_id){
		
		  
		  $data['title'] = title." | Edit Vendor";
		  $data['main_heading'] = "Vendors";
		  $data['heading'] = "Edit Vendor";
          $data['already_msg']="";
			 
		  $this->form_validation->set_rules('vendor_name', 'Vendor name', 'required|trim');
		  $this->form_validation->set_rules('email', 'Primary  Email', 'required|valid_email');
		  $this->form_validation->set_rules('mobile_no1', 'Primary Mobile no', 'trim|numeric|min_length[10]');
		  
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
		     $result =  $this->vendors_model->update_vendor($this->input->post('user_id'));	
			if($result){
			 $this->original_path = realpath('assets/static/'.$this->session->userdata('master_id').'/vendor_photos/original');
   		      $this->resized_path = realpath('assets/static/'.$this->session->userdata('master_id').'/vendor_photos/resized');
	
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
		      redirect(base_url() . "company/vendors/view/".$this->input->post('user_id'));								
			}
			else{
			   $this->session->set_flashdata('warning_message',$result_info['results']['message']);
			  }	
		  }
		}

		  $result =  $this->vendors_model->vendor_edit($user_id);
		  $data['edit_data'] = $result;
  
		  $this->load->view('company/vendors/edit.php', $data);
		 
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
		  redirect(base_url() . "company/vendors/view");		
		 
	}//end of Status  functionality*/

	
}	
?>