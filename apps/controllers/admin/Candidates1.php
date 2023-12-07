<?php
error_reporting(-1);
ini_set('display_errors', 1);
defined('BASEPATH') OR exit('No direct script access allowed');
class Candidates extends CI_Controller {


public function __construct()
	{
		parent:: __construct();
		valid_logged_in(FALSE,'A');	
		$this->load->model('admin/candidates_model');
		$this->load->library('csvimport');
		$this->load->library('upload');
		$this->load->helper('string');
		}
	
    
	public function add()
	{
		  $data['title'] = title." | Add Candidate";
		  $data['main_heading'] = "Candidates";
		  $data['heading'] = "Add Candidate";
		  $data['already_msg']="";
		  
		  $this->form_validation->set_rules('campaign_name', 'Campaign name', 'required|trim');
		  $this->form_validation->set_rules('start_date', 'Start date', 'required|trim');
		  $this->form_validation->set_rules('end_date', 'End Date', 'required|trim');
		  $this->form_validation->set_rules('description', 'Description', 'trim');
		  
		if ($this->form_validation->run()) {
		  $feilds = array('campaign_name' =>trim($this->input->post('campaign_name')),'sponser_id' =>'53');
		  $result = check_unique('candidates',$feilds);
		  if($result==1)
		  {
			$data['already_msg']=''.$this->input->post('campaign_name').' already exists, Please try another.';
		  }
		 else
		  {			  
			 $campaign_id =  $this->candidates_model->add();	
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
			   redirect(base_url() . 'admin/candidates/view');				
			}  
			
	    } //end of add  functionality

	   $this->load->view('admin/candidates/add.php', $data);
	}
	
	
	public function view()
	{
		$data=array();
		$data['title'] = title." | View candidates";
		$data['main_heading'] ="candidates";
		$data['heading'] = "View candidates";
			 
			 
		$results = $this->candidates_model->view_candidates();
		  
		$data['results']  = $results;
		$num_rows         = count($results);	
		$data['num_rows'] = $num_rows;		  
		$this->load->view('admin/candidates/view', $data);		
    } //end of view functionality	
	
	
	
	 public function edit($campaign_id){
		
	
		  $data['title'] = title." | Edit Candidate";
		  $data['main_heading'] = "Candidates";
		  $data['heading'] = "Edit Candidate";
          $data['already_msg']="";
			 
		  $this->form_validation->set_rules('campaign_name', 'Campaign name', 'required|trim');
		  $this->form_validation->set_rules('start_date', 'Start date', 'required|trim');
		  $this->form_validation->set_rules('end_date', 'End Date', 'required|trim');
		  $this->form_validation->set_rules('description', 'Description', 'trim');
		
		if ($this->form_validation->run()) {
		  // Update records 
		  $feilds = array('campaign_name' =>trim($this->input->post('campaign_name')),'sponser_id' =>'53');
		  $unique_id = array('campaign_id' =>$campaign_id);
		  $result = check_unique_edit('candidates',$feilds,$unique_id);
		  if($result==1)
		  { $data['already_msg']=''.$this->input->post('campaign_name').' already exists, Please try another.';
		  }
		 else
		  {  
		      $result =  $this->candidates_model->update_campaign($this->input->post('campaign_id'));
		      if($result=='1')
			   $msg = "Campaign record has been updated successfully.";
			  else
			   $msg="There is some error in update record."; 
			   
		      $this->session->set_flashdata('success_message', $msg);
		      redirect(base_url() . "admin/candidates/view/".$this->input->post('campaign_id'));								
			  }
		}
		  
		  $result =  $this->candidates_model->campaign_edit($campaign_id);
		  $data['edit_data'] = $result;
		 
		  $this->load->view('admin/candidates/edit.php', $data);
		 
	}//end of Edit functionality*/
	
	public function status($campaign_id,$status)
	{	 // Update status  
		 $result = $this->candidates_model->update_status($campaign_id,$status);
		 if($result=='1')
		 {
		   $this->session->set_flashdata('success_message', 'Status has been updated successfully.');
		 }
		 else
		 {
			 $this->session->set_flashdata('warning_message', 'There is some error in status updation.');
		 }
		  redirect(base_url() . "admin/candidates/view");		
		 
	}//end of Status  functionality*/
	
	
	
	
	
	
	public function view(){	
	
	    $data['title'] = title." | View Candidates";
		$data['main_heading'] = "Candidates";	
		$data['heading'] = "View Candidates";	
		
	   //print_r($_POST);	
	    if($this->input->post('bank_id'))
			 $bank_id = $this->input->post('bank_id');
		 elseif($this->uri->segment('4'))
			 $bank_id=$this->uri->segment('4');
		else
			 $bank_id='0';
		
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
		$config["base_url"] = base_url() . "admin/candidates/candidates/".$campaign_id."/".$candidate_id."/".$application_no."/".$search_by."/".$search_value."/".$status."/".$per_page;
		$config["per_page"] = $per_page;
        $config["uri_segment"] = 11;
		$config["total_rows"] =$this->candidates_model->count_candidates($campaign_id,$candidate_id,$application_no,$search_by,$search_value,$status);
		$this->pagination->initialize($config);
        $page = ($this->uri->segment(11)) ? $this->uri->segment(11) : 0; 
		$data['results'] = $this->candidates_model->view_candidates($campaign_id,$candidate_id,$application_no,$search_by,$search_value,$status,$config['per_page'], $page);
		$data['links']   = $this->pagination->create_links();
		$data['num_rows'] = $config['total_rows'];	
		
		$data['campaign_id'] = $campaign_id;
		$data['candidate_id'] = $candidate_id;
		$data['application_no'] = $application_no;
		$data['status'] = $status;	
		$data['search_by'] = $search_by;	
		$data['search_value'] = $search_value;	
		$data['per_page'] = $per_page;
		  	  
	    $this->load->view('admin/candidates/view_candidates.php', $data);
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
		$this->form_validation->set_rules('bank_id', 'Bank', 'trim');
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
				$already_bank_acc_no='';
				$err='';
				
				/*echo "<pre>";
				print_r($csv_array);
				echo "</pre>";
				die();*/
				$bank_id = $this->input->post('bank_id');
                foreach ($csv_array as  $row) {
					
				//	echo "---------------------->".$row;
					//echo "<br>";
					$x++;
                    if(isset($row['sr_no']))
					{
						if($row['sr_no']=='')
						$err .='Row No ' .$x.' Sr no. column is required.<br>';
					}
                    
					if(isset($row['bank_account_no']))
					{
						$bank_account_no=special_char_remove($row['bank_account_no']);
						if($bank_account_no=='')
						$err .='Row No ' .$x.' Bank account No. required.<br>';
					}
					else
					{	$err ='Invalid Bank account No. Column.<br>';
					}
                    if(isset($row['bank_account_no']))
					{
						if(!is_numeric($row['bank_account_no']))
						$err .='Row No ' .$x.' invalid Bank account No..<br>';
						else if((strlen($row['bank_account_no'])<8)|| (strlen($row['bank_account_no'])>20))
						$err .='Row No ' .$x.' Bank account No. (should be between 8-20 digit long).<br>';
					}
                  	if(isset($row['account_holder_name']))
					{
					}
					else
					{	$err ='Invalid Account Holder name Column.<br>';
					}
					
					if(isset($row['father_name']))
					{
						if($row['father_name']=='')
						$err .='Row No ' .$x.' Father Name required.<br>';
					}
					else
					{	$err ='Invalid Father’s Name Column.<br>';
					}
                    
                    if(isset($row['ifsc_code']))
					{
						$ifsc_code=special_char_remove($row['ifsc_code']);
						if($ifsc_code=='')
						$err .='Row No ' .$x.' IFSC Code required.<br>';
					}
					else
					{	$err ='Invalid FSC Code Column.<br>';
					}
					$err ='Invalid Gender Column.<br>';
					}
					if(isset($row['acc_opening_date']))
					{
						if($row['acc_opening_date']=='')
						$err .='Row No '.$x.' Account Opening date required.<br>';
						$acc_opening_date =$row['acc_opening_date'];
						if($acc_opening_date != '')
						{   $accopeningdate = explode("/", $acc_opening_date);
					     	if($accopeningdate[0]== '' || $accopeningdate[1]== '' || $accopeningdate[2]=='' )
							$err .='Row No ' .$x.' invalid Account Opening date format.  It should be (DD/MM/YYYY).<br>';
							if(!checkdate($accopeningdate[1], $accopeningdate[0], $accopeningdate[2]))
							$err .='Row No ' .$x.' invalid Account Opening date format.  It should be (DD/MM/YYYY).<br>';
						}
					}
					else
					{		$err ='Invalid Account Opening date Column.<br>';
					}
					if(isset($row['bank_branch_name']))
					{
					}
					else
					{	$err ='Invalid Bank Branch Name Column.<br>';
					}
                    if(isset($row['date_of_birth']))
					{
						if($row['date_of_birth']=='')
						$err .='Row No '.$x.' Date of Birth date required.<br>';
						$date_of_birth =$row['date_of_birth'];
						if($date_of_birth != '')
						{   $dateofbirth = explode("/", date_of_birth);
					     	if($dateofbirth[0]== '' || $dateofbirth[1]== '' || $dateofbirth[2]=='' )
							$err .='Row No ' .$x.' invalid Date of Birth date format.  It should be (DD/MM/YYYY).<br>';
							if(!checkdate($dateofbirth[1], $dateofbirth[0], $dateofbirth[2]))
							$err .='Row No ' .$x.' invalid Date of Birth date format.  It should be (DD/MM/YYYY).<br>';
						}
					}
					else
					{		$err ='Invalid Date of Birth date Column.<br>';
					}
					
					if(isset($row['branch_code']))
					{
					}
					else
					{	$err ='Invalid Branch Code Column.<br>';
					}
					if(isset($row['contact_number']))
					{	
						$contact_number=special_char_remove($row['contact_number']);
						if($contact_number!='')
						{
						if(!is_numeric(ltrim($contact_number)))
						$err .='Row No ' .$x.' invalid Contact No.'.ltrim($contact_number).'<br>';
						else if((strlen(ltrim($contact_number))<10)|| (strlen(ltrim($contact_number))>12))
						$err .='Row No ' .$x.' Contact No. (should be between 10-12 digits).<br>';
						}
					}
					else
					{	$err ='Invalid Contact no. Column.<br>';
					}
					
					if(isset($row['mirc_code']))
					{
					}
					else
					{	$err ='Invalid MIRC Code Column.<br>';
					}
					if(isset($row['bank_address']))
					{
					}
					else
					{	$err ='Invalid Bank Address Column.<br>';
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
                        $accopeningdate = explode("/", $row['acc_opening_date']);
						if($accopeningdate!='')
						$acc_opening_date=$accopeningdate[2].'-'.$accopeningdate[1].'-'.$accopeningdate[0];
						else
						$acc_opening_date='0000-00-00';
                    
					    $dateofbirth = explode("/", $row['date_of_birth']);
						if($dateofbirth!='')
						$date_of_birth=$dateofbirth[2].'-'.$dateofbirth[1].'-'.$dateofbirth[0];
						else
						$date_of_birth='0000-00-00';
						
						$bank_account_no= trim($row['bank_account_no']);
						$account_holder_name= trim($row['account_holder_name']);
						$father_name= trim($row['father_name']);
						$ifsc_code= trim($row['ifsc_code']);
						$bank_branch_name= trim($row['bank_branch_name']);
						$date_of_birth= trim($row['date_of_birth']);
						$branch_code= trim($row['branch_code']);
						$contact_number= trim($row['contact_number']);
						$mirc_code= trim($row['mirc_code']);
						$bank_address= trim($row['bank_address']);
						
						if(trim($bank_account_no!=''))
						{
						$this->db->select('candidate_id');
						$this->db->from('candidates');
						$this->db->where('bank_account_no', $bank_account_no);
						$this->db->order_by('candidate_id','ASC');
						$candidatequery = $this->db->get();
						$candidateresult = $candidatequery->result();
						$application_num_rows =  $candidatequery->num_rows();
						}
						else
						{	$bank_acc_no_num_rows='0';
						}
						
						if($bank_acc_no_num_rows==0)
						{
					    $insert_data = array(
							'bank_account_no'=>$bank_account_no,
							'acc_holder_name'=>$acc_holder_name,
							'father_name'     => $father_name,
							'ifsc_code'     => $ifsc_code,
							'bank_id'     => $bank_id,
							'ifsc_code'     => $ifsc_code,
							'acc_opening_date'    => $acc_opening_date,
							'bank_branch_name'     => $bank_branch_name,
							'date_of_birth'    =>$date_of_birth,
							'branch_code'    =>$branch_code,
							'contact_number'    =>$contact_number,
							'mirc_code'   => $mirc_code,
							'bank_address'   => $bank_address,
							'contact_number'     => $contact_number,
							'created_by'     => $this->session->userdata('user_id'),
							'created_by'     => $relationship,
							'created_on'      => date('Y-m-d H:i:s')
						);
						$candidate_id = $this->candidates_model->insert_candidate_data($insert_data);
						if($candidate_id)
						{
						  $done++;	
						  $campaign_log_id = $this->candidates_model->insertCampaignlogs($campaign_id,$candidate_id);
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
							$already_exists_data=trim($row['bank_account_no']);
							
							$already_bank_acc_no .= $already_exists_data.', ';
						}
						
					 }
					
					}	
					
					$data['err']=$err;
					
			
               if($err=='')
			   {  
			       $msg1='';
				   $msg2='';
				   $already_bank_acc_no = substr($already_bank_acc_no,0,-1);
				   if($done>0)
			   		$msg1=  "Total (".$done.") Record's Imported succesfully.<br>";
				   if($already>0)
			   		$msg2=  " (".$already.") records already exists in database.<br>(".$already_bank_acc_no.")";
					
					if($msg1!='')
				    $this->session->set_flashdata('success_message', $msg1);
					
					if($msg2!='')
				    $this->session->set_flashdata('warning_message', $msg2);
					
				  //redirect(base_url().'admin/candidates/upload_bulk_candidates');
			   }
			   
               
            } else 
                $data['error'] = "Error occured";
                
            }
				/*========== File Upload Script end ===========*/
				
			 }
		  //print '<pre>'; print_r($data); die;
		
		if($this->uri->segment('4'))
			 $bank_id=$this->uri->segment('4');
		else
			 $bank_id='0';
			  
		$data['bank_id']=$bank_id;  
		$this->load->view('admin/candidates/upload_bulk_candidates', $data);
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