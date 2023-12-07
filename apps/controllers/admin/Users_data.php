<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Users_data extends CI_Controller {


public function __construct()
	{
		parent:: __construct();
		valid_logged_in(FALSE,'A');	
		$this->load->model('admin/campaigns_model');
		$this->load->library('csvimport');
		$this->load->library('upload');
		$this->load->helper('string');
		}
	
    
	public function add()
	{
		  $data['title'] = title." | Add Campaign";
		  $data['main_heading'] = "Campaigns";
		  $data['heading'] = "Add Campaign";
		  $data['already_msg']="";
		  
		  $this->form_validation->set_rules('campaign_name', 'Campaign name', 'required|trim');
		  $this->form_validation->set_rules('start_date', 'Start date', 'required|trim');
		  $this->form_validation->set_rules('end_date', 'End Date', 'required|trim');
		  $this->form_validation->set_rules('description', 'Description', 'trim');
		  
		if ($this->form_validation->run()) {
		  $feilds = array('campaign_name' =>trim($this->input->post('campaign_name')),'sponser_id' =>'53');
		  $result = check_unique('campaigns',$feilds);
		  if($result==1)
		  {
			$data['already_msg']=''.$this->input->post('campaign_name').' already exists, Please try another.';
		  }
		 else
		  {			  
			 $campaign_id =  $this->campaigns_model->add();	
			  if($campaign_id=='0')
			  {
			   $msg = "There is some error in Save Campaign Record.";
			   $this->session->set_flashdata('warning_message', $msg);	
			  }
			  else  
			  {
			     $msg = "Campaign has been created successfully.";	
			     $this->session->set_flashdata('success_message', $msg);	
			  }
			   redirect(base_url() . 'admin/campaigns/view');				
			}  
			
	    } //end of add  functionality

	   $this->load->view('admin/campaigns/add.php', $data);
	}
	
	
	public function view()
	{
		$data=array();
		$data['title'] = title." | View Campaigns";
		$data['main_heading'] ="Campaigns";
		$data['heading'] = "View Campaigns";
			 
			 
		$results = $this->campaigns_model->view_campaigns();
		  
		$data['results']  = $results;
		$num_rows         = count($results);	
		$data['num_rows'] = $num_rows;		  
		$this->load->view('admin/campaigns/view', $data);		
    } //end of view functionality	
	
	
	
	 public function edit($campaign_id){
		
	
		  $data['title'] = title." | Edit Campaign";
		  $data['main_heading'] = "Campaigns";
		  $data['heading'] = "Edit Campaign";
          $data['already_msg']="";
			 
		  $this->form_validation->set_rules('campaign_name', 'Campaign name', 'required|trim');
		  $this->form_validation->set_rules('start_date', 'Start date', 'required|trim');
		  $this->form_validation->set_rules('end_date', 'End Date', 'required|trim');
		  $this->form_validation->set_rules('description', 'Description', 'trim');
		
		if ($this->form_validation->run()) {
		  // Update records 
		  $feilds = array('campaign_name' =>trim($this->input->post('campaign_name')),'sponser_id' =>'53');
		  $unique_id = array('campaign_id' =>$campaign_id);
		  $result = check_unique_edit('campaigns',$feilds,$unique_id);
		  if($result==1)
		  { $data['already_msg']=''.$this->input->post('campaign_name').' already exists, Please try another.';
		  }
		 else
		  {  
		      $result =  $this->campaigns_model->update_campaign($this->input->post('campaign_id'));
		      if($result=='1')
			   $msg = "Campaign record has been updated successfully.";
			  else
			   $msg="There is some error in update record."; 
			   
		      $this->session->set_flashdata('success_message', $msg);
		      redirect(base_url() . "admin/campaigns/view/".$this->input->post('campaign_id'));								
			  }
		}
		  
		  $result =  $this->campaigns_model->campaign_edit($campaign_id);
		  $data['edit_data'] = $result;
		 
		  $this->load->view('admin/campaigns/edit.php', $data);
		 
	}//end of Edit functionality*/
	
	public function status($campaign_id,$status)
	{	 // Update status  
		 $result = $this->campaigns_model->update_status($campaign_id,$status);
		 if($result=='1')
		 {
		   $this->session->set_flashdata('success_message', 'Status has been updated successfully.');
		 }
		 else
		 {
			 $this->session->set_flashdata('warning_message', 'There is some error in status updation.');
		 }
		  redirect(base_url() . "admin/campaigns/view");		
		 
	}//end of Status  functionality*/
	
	
	public function send_sms(){
		
		$data['title'] = title." | Send SMS";
		$data['main_heading'] = "SMS";
		$data['heading'] = "Send SMS";
		
		if($this->input->post('campaign_id'))
		     $campaign_id = $this->input->post('campaign_id');
	     elseif($this->uri->segment('4'))
			 $campaign_id=$this->uri->segment('4');
		 else
			 $campaign_id='0';
		
		if($campaign_id=='0')
		{	redirect(base_url() . "admin/campaigns/view");
		}
		   $this->form_validation->set_rules('sms_body', 'Sms Text', 'required');
		   $this->form_validation->set_rules('campaign_log_id[]', 'Candidates List', 'required');
		  
			if ($this->form_validation->run()) {
			  $result =  $this->campaigns_model->update_send_sms($campaign_id);
			 //redirect(base_url() . "schools/calendar/view_logs");
			}
		 $data['campaign_id']  = $campaign_id; 	
		 $this->load->view('admin/campaigns/send_sms.php', $data);
		
		 
	}//end of Edit functionality*/
	
	
	public function send_email(){
		
		$data['title'] = title." |  Send Email";
		$data['main_heading'] = "Emails";
		$data['heading'] = "Send Email";
		
		if($this->input->post('campaign_id'))
		     $campaign_id = $this->input->post('campaign_id');
	    elseif($this->uri->segment('4'))
			 $campaign_id=$this->uri->segment('4');
		else
			 $campaign_id='0';
		
		 if($campaign_id=='0')
		 {	redirect(base_url() . "admin/campaigns/view");
		 }
		 $this->form_validation->set_rules('email_subject', 'Email Subject', 'required'); 
	     $this->form_validation->set_rules('email_body', 'Email Body', 'required');
	     $this->form_validation->set_rules('campaign_log_id[]', 'Candidates List', 'required');
	  
		 if ($this->form_validation->run()) {
		  $result =  $this->campaigns_model->update_send_email($campaign_id);
		  //redirect(base_url() . "schools/calendar/view_logs");
		 }
	     $data['campaign_id']  = $campaign_id; 	
		
		 $this->load->view('admin/campaigns/send_email.php', $data);
		 
	}//end of Edit functionality*/
	
	
	public function candidates(){	
	
	    $data['title'] = title." | View Candidates";
		$data['main_heading'] = "Candidates";	
		$data['heading'] = "View Candidates";	
		
	   //print_r($_POST);	
	    if($this->input->post('campaign_id'))
			 $campaign_id = $this->input->post('campaign_id');
		 elseif($this->uri->segment('4'))
			 $campaign_id=$this->uri->segment('4');
		else
			 $campaign_id='0';
		
	  if($this->input->post('candidate_id'))
			$candidate_id = $this->input->post('candidate_id');
		 elseif($this->uri->segment('5'))
			$candidate_id=$this->uri->segment('5');
		else
			$candidate_id='0';
					
	   if($this->input->post('application_no'))
			$application_no = $this->input->post('application_no');
		 elseif($this->uri->segment('6'))
			$application_no=$this->uri->segment('6');
		else
			$application_no='0';
		
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
		$config["base_url"] = base_url() . "admin/campaigns/candidates/".$campaign_id."/".$candidate_id."/".$application_no."/".$search_by."/".$search_value."/".$status."/".$per_page;
		$config["per_page"] = $per_page;
        $config["uri_segment"] = 11;
		$config["total_rows"] =$this->campaigns_model->count_candidates($campaign_id,$candidate_id,$application_no,$search_by,$search_value,$status);
		$this->pagination->initialize($config);
        $page = ($this->uri->segment(11)) ? $this->uri->segment(11) : 0; 
		$data['results'] = $this->campaigns_model->view_candidates($campaign_id,$candidate_id,$application_no,$search_by,$search_value,$status,$config['per_page'], $page);
		$data['links']   = $this->pagination->create_links();
		$data['num_rows'] = $config['total_rows'];	
		
		$data['campaign_id'] = $campaign_id;
		$data['candidate_id'] = $candidate_id;
		$data['application_no'] = $application_no;
		$data['status'] = $status;	
		$data['search_by'] = $search_by;	
		$data['search_value'] = $search_value;	
		$data['per_page'] = $per_page;
		  	  
	    $this->load->view('admin/campaigns/view_candidates.php', $data);
		}
		
		
    /*=========== Upload Bulk candidates =========*/
	public function upload_bulk_candidates() {
		  
	   $data['title'] = title." | Upload candidates";
	   $data['main_heading'] = "Upload candidates";
	   $data['heading'] = "Upload candidates";
	   $data['already_msg']="";
	   $data['error']="";
	   $data['err']="";
	
		//print_r($_FILES); 
		$this->form_validation->set_rules('campaign_id', 'Campaign', 'trim');
		$this->form_validation->set_rules('userfile', 'CSV File', 'trim');
		
		if ($this->form_validation->run()) {
			$data['error'] = '';   
			if($_FILES['userfile']['error'] != 4){		
			  if(isset($_FILES["userfile"]["name"]) && ($_FILES["userfile"]["name"]!=''))
			{	$path_info = pathinfo($_FILES["userfile"]["name"]);
			$fileExtension = $path_info['extension'];
			$file_name = time(true).'.'.$fileExtension ;   
			}
			
			  $this->sdata_path = realpath('assets/static/sdata');
			  $config['upload_path'] = $this->sdata_path;
			  $config['allowed_types'] = '*';
			  $config['max_size']	= '5072';
			  $config['max_width']  = '0';
			  $config['max_height']  = '0';
			  $config['overwrite'] = true;			
			  $config['file_name'] =$file_name;
			  $this->upload->initialize($config);
			  if ( ! $this->upload->do_upload('userfile')){
					$data['error']=$this->upload->display_errors();
					$success = FALSE;
			 }
			 else{
				$data = $this->upload->data('userfile');	
				/*========== File Upload Script ===========*/
				$file_path =  $this->sdata_path.'/'.$file_name;
				
				if ($this->csvimport->get_array($file_path)) {
                $csv_array = $this->csvimport->get_array($file_path);
				$count_csv_column = count($csv_array[0]);
				$x=0;
				$done=0;
				$already=0;
				$already_application_no='';
				$err='';
				
				/*echo "<pre>";
				print_r($csv_array);
				echo "</pre>";
				die();*/
				$campaign_id = $this->input->post('campaign_id');
                foreach ($csv_array as  $row) {
					
				//	echo "---------------------->".$row;
					//echo "<br>";
					$x++;
					if(isset($row['Application No']))
					{
						$application_no=special_char_remove($row['Application No']);
						if($application_no=='')
						$err .='Row No ' .$x.' Application No required.<br>';
					}
					else
					{	$err ='Invalid Application No Column.<br>';
					}
					if(isset($row['Candidate ID']))
					{
						$candidate_id=special_char_remove($row['Candidate ID']);
						if($candidate_id=='')
						$err .='Row No ' .$x.' Candidate ID required.<br>';
					}
					else
					{	$err ='Invalid Candidate ID. Column.<br>';
					}
					if(isset($row['Applicant Full Name']))
					{
					}
					else
					{	$err ='Invalid Applicant Full Name Column.<br>';
					}
					
					if(isset($row['Father Name']))
					{
						if($row['Father Name']=='')
						$err .='Row No ' .$x.' Father Name required.<br>';
					}
					else
					{	$err ='Invalid Father’s Name Column.<br>';
					}
					
					if(isset($row['Gender']))
					{
					}
					else
					{	$err ='Invalid Gender Column.<br>';
					}
					if(isset($row['Date of Birth']))
					{
						if($row['Date of Birth']=='')
						$err .='Row No '.$x.' Date of Birth required.<br>';
						$dateofbirth =$row['Date of Birth'];
						if($dateofbirth != '')
						{   $dateofbirth = explode("/", $dateofbirth);
					     	if($dateofbirth[0]== '' || $dateofbirth[1]== '' || $dateofbirth[2]=='' )
							$err .='Row No ' .$x.' invalid Date of Birth format.  It should be (DD/MM/YYYY).<br>';
							if(!checkdate($dateofbirth[1], $dateofbirth[0], $dateofbirth[2]))
							$err .='Row No ' .$x.' invalid Date of Birth format.  It should be (DD/MM/YYYY).<br>';
						}
					}
					else
					{		$err ='Invalid Date of Birth Column.<br>';
					}
					if(isset($row['Marital Status']))
					{
					}
					else
					{	$err ='Invalid Marital Status Column.<br>';
					}
					
					if(isset($row['Nationality']))
					{
					}
					else
					{	$err ='Invalid Nationality Column.<br>';
					}
					if(isset($row['House No.']))
					{
					}
					else
					{	$err ='Invalid House No. Column.<br>';
					}
					if(isset($row['Street']))
					{
					}
					else
					{	$err ='Invalid Street Column.<br>';
					}
					if(isset($row['City']))
					{
					}
					else
					{	$err ='Invalid City Column.<br>';
					}
					if(isset($row['District']))
					{
					}
					else
					{	$err ='Invalid District Column.<br>';
					}
					if(isset($row['State']))
					{
					}
					else
					{	$err ='Invalid State Column.<br>';
					}
					if(isset($row['Pin code']))
					{
						if(!is_numeric($row['Pin code']))
						$err .='Row No ' .$x.' invalid Pincode.<br>';
						else if((strlen($row['Pin code'])<6)|| (strlen($row['Pin code'])>8))
						$err .='Row No ' .$x.' Pincode (should be between 6-8 digit long).<br>';
							
					}
					else
					{	$err ='Invalid Pin code Column.<br>';
					}
					if(isset($row['Mobile No']))
					{	
						$mobile_no=special_char_remove($row['Mobile No']);
						if($mobile_no!='')
						{
						if(!is_numeric(ltrim($mobile_no)))
						$err .='Row No ' .$x.' invalid Mobile No.'.ltrim($mobile_no).'<br>';
						else if((strlen(ltrim($mobile_no))<10)|| (strlen(ltrim($mobile_no))>12))
						$err .='Row No ' .$x.' Mobile No. (should be between 10-12 digits).<br>';
						}
					}
					else
					{	$err ='Invalid Primary Mobile no. Column.<br>';
					}
					
					if(isset($row['Email ID']))
					{
						if($row['Email ID']=='')
						$err .='Row No ' .$x.' Email ID required.<br>';
						elseif(!valid_email($row['Email ID']))
						$err .='Row No ' .$x.' invalid Email.<br>';
					}
					else
					{	$err ='Invalid Email ID Column.<br>';
					}
					if(isset($row['PAN']))
					{
					}
					else
					{	$err ='Invalid PAN Column.<br>';
					}
					if(isset($row['Board University Name']))
					{
					}
					else
					{	$err ='Invalid Board University Name Column.<br>';
					}
					if(isset($row['Roll No./Seat no/Registration No']))
					{
					}
					else
					{	$err ='Invalid Roll No./Seat no/Registration No Column.<br>';
					}
					if(isset($row['Roll No./Seat no/Registration No']))
					{
					}
					else
					{	$err ='Invalid Roll No./Seat no/Registration No Column.<br>';
					}
					if(isset($row['Year of Passing']))
					{
					}
					else
					{	$err ='Invalid Year of Passing Column.<br>';
					}
					if(isset($row['Educational Qualification']))
					{
					}
					else
					{	$err ='Invalid Educational Qualification Column.<br>';
					}
				
					if(isset($row['Other Qualification']))
					{
					}
					else
					{	$err ='Invalid Other Qualification Column.<br>';
					}
					
					
					if(isset($row['Occupation Primary Profession']))
					{
					}
					else
					{	$err ='Invalid Occupation Primary Profession Column.<br>';
					}
					
					if(isset($row['Bank Account Number']))
					{
					}
					else
					{	$err ='Invalid Bank Account Number Column.<br>';
					}
					if(isset($row['Bank Name']))
					{
					}
					else
					{	$err ='Invalid Bank Name Column.<br>';
					}
					if(isset($row['Bank Branch Name']))
					{
					}
					else
					{	$err ='Invalid Bank Branch Name Column.<br>';
					}
					if(isset($row['IFSC']))
					{
					}
					else
					{	$err ='Invalid IFSC Column.<br>';
					}
					if(isset($row['IFSC']))
					{
					}
					else
					{	$err ='Invalid IFSC Column.<br>';
					}
					if(isset($row['Applicant Name as per Bank Account']))
					{
					}
					else
					{	$err ='Invalid Applicant Name as per Bank Account.<br>';
					}
					if(isset($row['IFSC']))
					{
					}
					else
					{	$err ='Invalid IFSC Column.<br>';
					}
					if(isset($row['Any of your relative Employee']))
					{
					}
					else
					{	$err ='Invalid Any of your relative Employee Column.<br>';
					}
					
					if(isset($row['Name of your relative who is Employee']))
					{
					}
					else
					{	$err ='Invalid Name of your relative who is Employee Column.<br>';
					}
					if(isset($row['Relationship']))
					{
					}
					else
					{	$err ='Invalid Relationship Column.<br>';
					}
				
			}
		
			// echo "---------------------->Yes";
			 	/*   echo "<pre>";
				   print_r($csv_array);
				   echo "</pre>";*/
					//die();
			   foreach ($csv_array as  $row) {
					
			  	if($err=='')
					{
					    $dateofbirth = explode("/", $row['Date of Birth']);
						if($dateofbirth!='')
						$date_of_birth=$dateofbirth[2].'-'.$dateofbirth[1].'-'.$dateofbirth[0];
						else
						$date_of_birth='0000-00-00';
						
						$application_no= trim($row['Application No']);
						$candidateid= trim($row['Candidate ID']);
						$applicant_full_name= trim($row['Applicant Full Name']);
						$father_name= trim($row['Father Name']);
						$gender= trim($row['Gender']);
						$marital_status= trim($row['Marital Status']);
						$nationality= trim($row['Nationality']);
						$house_no= trim($row['House No.']);
						$street= trim($row['Street']);
						$city= trim($row['City']);
						$district= trim($row['District']);
						$state= trim($row['State']);
						$pin_code= trim($row['Pin code']);
						$mobile_no= trim($row['Mobile No']);
						$email_id= trim($row['Email ID']);
						$pan_no= trim($row['PAN']);
						$board_university_name= trim($row['Board University Name']);
						$roll_no_seat_no_registration_no= trim($row['Roll No./Seat no/Registration No']);
						$year_of_passing= trim($row['Year of Passing']);
						$educational_qualification= trim($row['Educational Qualification']);
						$other_qualification= trim($row['Other Qualification']);
						$occupation_primary_profession= trim($row['Occupation Primary Profession']);
						$bank_account_number= trim($row['Bank Account Number']);
						$bank_name= trim($row['Bank Name']);
						$bank_branch_name= trim($row['Bank Branch Name']);
						$ifsc_code= trim($row['IFSC']);
						$applicant_name_as= trim($row['Applicant Name as per Bank Account']);
						$any_of_your_relative_is= trim($row['Any of your relative Employee']);
						$name_of_your_relative= trim($row['Name of your relative who is Employee']);
						$relationship= trim($row['Relationship']);
						
						if(trim($application_no!=''))
						{
						$this->db->select('candidate_id');
						$this->db->from('consent_candidates');
						$this->db->where('application_no', $application_no);
						$this->db->order_by('candidate_id','ASC');
						$candidatequery = $this->db->get();
						$candidateresult = $candidatequery->result();
						$application_num_rows =  $candidatequery->num_rows();
						}
						else
						{	$application_num_rows='0';
						}
						
						if($application_num_rows==0)
						{
					    $insert_data = array(
							'application_no'=>$application_no,
							'candidateid'=>$candidateid,
							'applicant_full_name'     => $applicant_full_name,
							'father_name'     => $father_name,
							'gender'     => $gender,
							'date_of_birth'     => $date_of_birth,
							'marital_status'    => $marital_status,
							'nationality'     => $nationality,
							'house_no'    =>$house_no,
							'street'    =>$street,
							'city'    =>$city,
							'district'   => $district,
							'state'   => $state,
							'pin_code'     => $pin_code,
							'mobile_no'     => $mobile_no,
							'email_id'     => $email_id,
							'pan_no'     => $pan_no,
							'board_university_name'     => $board_university_name,
							'roll_no_seat_no_registration_no'     => $roll_no_seat_no_registration_no,
							'year_of_passing'     => $year_of_passing,
							'educational_qualification'     => $educational_qualification,
							'other_qualification'     => $other_qualification,
							'occupation_primary_profession'     => $occupation_primary_profession,
							'bank_account_number'     => $bank_account_number,
							'bank_name'     => $bank_name,
							'bank_branch_name'     => $bank_branch_name,
							'ifsc_code'     => $ifsc_code,
							'applicant_name_as'     => $applicant_name_as,
							'any_of_your_relative_is'     => $any_of_your_relative_is,
							'name_of_your_relative'     => $name_of_your_relative,
							'relationship'     => $relationship,
							'created_on'      => date('Y-m-d H:i:s')
						);
						$candidate_id = $this->campaigns_model->insert_candidate_data($insert_data);
						if($candidate_id)
						{
						  $done++;	
						  $campaign_log_id = $this->campaigns_model->insertCampaignlogs($campaign_id,$candidate_id);
						}
						/* if($_SERVER['REMOTE_ADDR']=='137.59.212.34')
						 { 
							echo "<pre>";
							print_r($post_data);
							echo "</pre>";
							die();
						 }
						*/
						}
						else
						{
							$already++;
							//if($row['mobile_no1']!='')
							//$already_exists_data=trim($row['mobile_no1']);
							//else
							$already_exists_data=trim($row['Application No']);
							
							$already_application_no .= $already_exists_data.', ';
						}
						
					 }
					
					}	
					
					$data['err']=$err;
					
			
               if($err=='')
			   {  
			       $msg1='';
				   $msg2='';
				   $already_application_no = substr($already_application_no,0,-1);
				   if($done>0)
			   		$msg1=  "Total (".$done.") Record's Imported succesfully.<br>";
				   if($already>0)
			   		$msg2=  " (".$already.") records already exists in database.<br>(".$already_application_no.")";
					
					if($msg1!='')
				    $this->session->set_flashdata('success_message', $msg1);
					
					if($msg2!='')
				    $this->session->set_flashdata('warning_message', $msg2);
					
				  //redirect(base_url().'admin/campaigns/upload_bulk_candidates');
			   }
			   
               
            } else 
                $data['error'] = "Error occured";
                
            }
				/*========== File Upload Script end ===========*/
				
			 }
		}
		  //print '<pre>'; print_r($data); die;
		  
		
		if($this->uri->segment('4'))
			 $campaign_id=$this->uri->segment('4');
		else
			 $campaign_id='0';
			  
		$data['campaign_id']=$campaign_id;  
		$this->load->view('admin/campaigns/upload_bulk_candidates', $data);
	}

	function replaceKeys($oldKey, $newKey, array $input){
		$return = array(); 
		foreach ($input as $key => $value) {
			if ($key===$oldKey)
				$key = $newKey;
	
			if (is_array($value))
				$value = $this->replaceKeys( $oldKey, $newKey, $value);
	
			$return[$key] = $value;
		}
		return $return; 
	}
	
	function multi_rename_key(&$array, $old_keys, $new_keys)
	{
		if(!is_array($array)){
			($array=="") ? $array=array() : false;
			return $array;
		}
		foreach($array as &$arr){
			if (is_array($old_keys))
			{
				foreach($new_keys as $k => $new_key)
				{
					(isset($old_keys[$k])) ? true : $old_keys[$k]=NULL;
					$arr[$new_key] = (isset($arr[$old_keys[$k]]) ? $arr[$old_keys[$k]] : null);
					unset($arr[$old_keys[$k]]);
				}
			}else{
				$arr[$new_keys] = (isset($arr[$old_keys]) ? $arr[$old_keys] : null);
				unset($arr[$old_keys]);
			}
		}
		return $array;
	}


}	
?>