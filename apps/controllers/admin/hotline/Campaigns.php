<?php
ini_set('memory_limit', '1024M');
defined('BASEPATH') OR exit('No direct script access allowed');
class Campaigns extends CI_Controller {


public function __construct()
	{
		parent:: __construct();
	//	valid_logged_in(FALSE,'A');	
		$this->load->model('admin/hotline/campaigns_model');
		$this->load->library('csvimport');
		$this->load->library('upload');
		$this->load->helper('download');
		$this->load->helper('string');
		}
	
    
	public function add()
	{
		  $data['title'] = title." | Add Campaign";
		  $data['main_heading'] = "Campaigns";
		  $data['heading'] = "Add Campaign";
		  $data['already_msg']="";
		  
		  $this->form_validation->set_rules('campaign_name', 'Campaign name', 'required|trim');
		   $this->form_validation->set_rules('total_data', 'Total data', 'required|trim');
		  $this->form_validation->set_rules('duration',' Maximum duration', 'required|trim');
		  $this->form_validation->set_rules('cancel_percentage', 'Cancel Percentage', 'required|trim');
		  $this->form_validation->set_rules('congestion_percentage', 'Congestion Percentage', 'required|trim');
		  $this->form_validation->set_rules('chanunavail_percentage', 'Chanunavail Percentage', 'required|trim');
		  $this->form_validation->set_rules('start_date', 'Start date', 'required|trim');
		  $this->form_validation->set_rules('end_date', 'End Date', 'required|trim');
		  $this->form_validation->set_rules('description', 'Description', 'trim');
		  
		if ($this->form_validation->run()) {
		  $feilds = array('campaign_name' =>trim($this->input->post('campaign_name')),'start_date' =>trim($this->input->post('start_date')),'sponser_id' =>'0');
		  $result = check_unique('hotline_campaigns',$feilds);
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
			   redirect(base_url() . 'admin/hotline/campaigns/view');				
			}  
			
	    } //end of add  functionality

	   $this->load->view('admin/hotline/campaigns/add.php', $data);
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
		$this->load->view('admin/hotline/campaigns/view', $data);		
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
		  $feilds = array('campaign_name' =>trim($this->input->post('campaign_name')),'start_date' =>trim($this->input->post('start_date')),'sponser_id' =>'0');
		  $unique_id = array('campaign_id' =>$campaign_id);
		  $result = check_unique_edit('hotline_campaigns',$feilds,$unique_id);
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
		      redirect(base_url() . "admin/hotline/campaigns/view/".$this->input->post('campaign_id'));								
			  }
		}
		  $result =  $this->campaigns_model->campaign_edit($campaign_id);
		  $data['edit_data'] = $result;
		  $districtsresult =  $this->campaigns_model->get_campaign_districts($campaign_id);
		 /* echo "<pre>";
		  print_r($districtsresult);
		  echo "</pre>";*/
		  $data['districtsresult'] = $districtsresult;
		 
		  $this->load->view('admin/hotline/campaigns/edit.php', $data);
		 
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
		  redirect(base_url() . "admin/hotline/campaigns/view");		
		 
	}//end of Status  functionality*/
	
	
	public function update_call_status($campaign_id)
	{	 // Update status  
		 $result = $this->campaigns_model->update_call_status($campaign_id);
		/* if($result=='1')
		 {
		   $this->session->set_flashdata('success_message', 'Data has been updated successfully.');
		 }
		 else
		 {
			 $this->session->set_flashdata('warning_message', 'There is some error in data updation.');
		 }*/
		  redirect(base_url() . "admin/hotline/campaigns/view");		
		 
	}//end of Status  functionality*/
	
	
	public function reset_data_status($campaign_id)
	{	 // Update status  
		 $result = $this->campaigns_model->reset_data_status($campaign_id);
		 if($result=='1')
		 {
		   $this->session->set_flashdata('success_message', 'Data status has been reset successfully.');
		 }
		 else
		 {
			 $this->session->set_flashdata('warning_message', 'There is some error in data reset updation.');
		 }
		  redirect(base_url() . "admin/hotline/campaigns/view");		
		 
	}//end of Status  functionality*/
	
	
	public function refresh_data_status($campaign_id)
	{	 // Update status  
		 $result = $this->campaigns_model->refresh_data_status($campaign_id);
		 if($result=='1')
		 {
		   $this->session->set_flashdata('success_message', 'Data status has been refresh successfully.');
		 }
		 else
		 {
			 $this->session->set_flashdata('warning_message', 'There is some error in data refresh updation.');
		 }
		  redirect(base_url() . "admin/hotline/campaigns/view");		
		 
	}//end of Status  functionality*/
	
	
	public function update_data_status($campaign_id)
	{	 // Update status  
		 $result = $this->campaigns_model->update_data_status($campaign_id);
		 if($result=='1')
		 {
		   $this->session->set_flashdata('success_message', 'Data status has been updated successfully.');
		 }
		 else
		 {
			 $this->session->set_flashdata('warning_message', 'There is some error in data status updation.');
		 }
		  redirect(base_url() . "admin/hotline/campaigns/view");		
		 
	}//end of Status  functionality*/
	
	
	public function process_data($campaign_id)
	{	 // Update status  
		 $result = $this->campaigns_model->process_data($campaign_id);
		 if($result=='1')
		 {
		   $this->session->set_flashdata('success_message', 'Data has  has been updated successfully.');
		 }
		 else
		 {
			 $this->session->set_flashdata('warning_message', 'There is some error in data process updation.');
		 }
		  redirect(base_url() . "admin/hotline/campaigns/view");		
		 
	}//end of Status  functionality*/
	
	
	
	public function candidates(){	
	
	    $data['title'] = title." | View Candidates";
		$data['main_heading'] = "Candidates";	
		$data['heading'] = "View Candidates";	
		
	   //print_r($_POST);	
	    if($this->input->post('campaign_id'))
			 $campaign_id = $this->input->post('campaign_id');
		 elseif($this->uri->segment('5'))
			 $campaign_id=$this->uri->segment('5');
		else
			 $campaign_id='0';
		
	  if($this->input->post('candidate_id'))
			$candidate_id = $this->input->post('candidate_id');
		 elseif($this->uri->segment('6'))
			$candidate_id=$this->uri->segment('6');
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
		$config["base_url"] = base_url() . "admin/hotline/campaigns/candidates/".$campaign_id."/".$candidate_id."/".$application_no."/".$search_by."/".$search_value."/".$status."/".$per_page;
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
		  	  
	    $this->load->view('admin/hotline/campaigns/view_candidates.php', $data);
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
				$already_mobile_no='';
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
					if(isset($row['MobileNo']))
					{	
						$mobile_no=special_char_remove($row['MobileNo']);
						if($mobile_no!='')
						{
						/*if(!is_numeric(ltrim($mobile_no)))
						$err .='Row No ' .$x.' invalid Mobile No.'.ltrim($mobile_no).'<br>';
						else if((strlen(ltrim($mobile_no))<10)|| (strlen(ltrim($mobile_no))>12))
						$err .='Row No ' .$x.' Mobile No. (should be between 10-12 digits).<br>';*/
						}
					}
					else
					{	$err ='Invalid  Mobile no. Column.<br>';
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
					   
						$mobile_no= trim($row['MobileNo']);
						
						if(trim($mobile_no!=''))
						{
						$this->db->select('candidate_id');
						$this->db->from('candidates');
						$this->db->where('mobile_no', $mobile_no);
						$this->db->order_by('candidate_id','ASC');
						$candidatequery = $this->db->get();
						$candidateresult = $candidatequery->result();
						$mobile_no_num_rows =  $candidatequery->num_rows();
						}
						else
						{	$mobile_no_num_rows='0';
						}
						if($mobile_no_num_rows==0)
						{
					    $insert_data = array(
						 	'campaign_id'=>$campaign_id,
							'mobile_no'     => $mobile_no,
							'created_by'     => $this->session->userdata('user_id'),
							'created_on'      => date('Y-m-d H:i:s')
						);
						$candidate_id = $this->campaigns_model->insert_candidate_data($insert_data);
						if($candidate_id)
						{
						  $done++;	
						  $campaign_log_id = $this->campaigns_model->insertCampaignlogs($campaign_id,$candidate_id);
						}
						}
						else
						{
							$already++;
							$already_exists_data=trim($row['MobileNo']);
							
							$already_mobile_no .= $already_exists_data.', ';
						}
					 }
					
					}	
					$data['err']=$err;
					
			
               if($err=='')
			   {  
			       $msg1='';
				   $msg2='';
				   $already_mobile_no = substr($already_mobile_no,0,-1);
				   if($done>0)
			   		$msg1=  "Total (".$done.") Record's Imported succesfully.<br>";
				   if($already>0)
			   		$msg2=  " (".$already.") records already exists in database.<br>(".$already_mobile_no.")";
					
					if($msg1!='')
				    $this->session->set_flashdata('success_message', $msg1);
					
					if($msg2!='')
				    $this->session->set_flashdata('warning_message', $msg2);
					
				 redirect(base_url().'admin/hotline/campaigns/upload_bulk_candidates');
			   }
			   
               
            } else 
                $data['error'] = "Error occured";
                
            }
				/*========== File Upload Script end ===========*/
				
			 }
		}
		  //print '<pre>'; print_r($data); die;
		  
		
		if($this->uri->segment('5'))
			 $campaign_id=$this->uri->segment('5');
		else
			 $campaign_id='0';
			  
		$data['campaign_id']=$campaign_id;  
		$this->load->view('admin/hotline/campaigns/upload_bulk_candidates', $data);
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
	
	
	public function sample_file_download() {
		
			 $tcc_name ='Sample-Data-File';
			 $file_name = 'sample_file.csv';
			 $data = file_get_contents("./".trim($file_name)); 
			 force_download(trim($file_name), $data, $tcc_name);  
		
		
	}//end of file Download functionality
	
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