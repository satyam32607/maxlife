<?php
//error_reporting(-1);
//ini_set('display_errors', 1);
defined('BASEPATH') OR exit('No direct script access allowed');
class Candidates extends CI_Controller {

 var $photo_path;
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
	  
		  $this->form_validation->set_rules('Candidate_name', 'Campaign name', 'required|trim');
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
			   redirect(base_url() . 'admin/campaigns/view');				
			}  
			
	    } //end of add  functionality
        
       $data['candidate_id'] = $candidate_id;    
	   $this->load->view('admin/campaigns/add.php', $data);
	}
	
	
	
	 public function edit($candidate_id){
		
	
		  $data['title'] = title." | Edit Candidate";
		  $data['main_heading'] = "Candidates";
		  $data['heading'] = "Edit Candidate";
          $data['already_msg']="";
			 
		  $this->form_validation->set_rules('candidate_id', 'Candidate Id', 'required|trim');
          $this->form_validation->set_rules('opening_balance', 'Opening Balance', 'trim');
		
		
		if ($this->form_validation->run()) {
		  // Update records 
	      $result =  $this->candidates_model->update_candidate($this->input->post('candidate_id'));
          $this->photo_path = realpath('assets/static/photos'); 	
            
            
          if($_FILES['candidate_image']['error'] != 4){							  
			  $config['upload_path'] = $this->photo_path;
			  $config['allowed_types'] = 'jpeg|gif|jpg|png';
			  $config['max_size']	= '55120';
			  $config['max_width']  = '0';
			  $config['max_height']  = '0';
			  $config['overwrite'] = true;			
			  $config['file_name'] =time().$_FILES['candidate_image']['name'];
			  $this->upload->initialize($config);
		  
		  if ( ! $this->upload->do_upload('candidate_image')){
			    $data['already_msg']=$this->upload->display_errors();
				$success = FALSE;
			}
		else{
				$data = $this->upload->data();
				$file_name = $data['file_name'];
												
				$result_document = $this->candidates_model->update_photo($candidate_id,$file_name);
			}
		  }
            
            
          if($result=='1')
           $msg = "Candidate record has been updated successfully.";
          else
           $msg="There is some error in update record."; 

          $this->session->set_flashdata('success_message', $msg);
          redirect(base_url() . "admin/candidates/view/".$this->input->post('candidate_id'));								
          }
		  
		  $result =  $this->candidates_model->candidate_edit($candidate_id);
		  $data['edit_data'] = $result;
		 
		  $this->load->view('admin/candidates/edit.php', $data);
		 
	}//end of Edit functionality*/
	
	public function status($candidate_id,$status)
	{	 // Update status  
		 $result = $this->candidates_model->update_status($candidate_id,$status);
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
	
		if($this->input->post('employer_name'))
			$employer_name = $this->input->post('employer_name');
		 elseif($this->uri->segment('5'))
			 $employer_name=$this->uri->segment('5');
		else
			 $employer_name='0';	 
				 
	   if($this->input->post('candidate_id'))
			$candidate_id = $this->input->post('candidate_id');
		elseif($this->uri->segment('6'))
			$candidate_id=$this->uri->segment('6');
		else
			$candidate_id='0';

		if($this->input->post('per_page'))
			$per_page = $this->input->post('per_page');
		elseif($this->uri->segment('7'))
			$per_page=$this->uri->segment('7');
		else
			$per_page=per_page;	
			
		$config = array();
		$config["base_url"] = base_url() . "admin/candidates/view/".$bank_id."/".$employer_name."/".$candidate_id."/".$per_page;
		$config["per_page"] = $per_page;
        $config["uri_segment"] = 8;
		$config["total_rows"] =$this->candidates_model->count_candidates($bank_id,$employer_name,$candidate_id);
		$this->pagination->initialize($config);
        $page = ($this->uri->segment(8)) ? $this->uri->segment(8) : 0; 
		$data['results'] = $this->candidates_model->view_candidates($bank_id,$employer_name,$candidate_id,$config['per_page'], $page);
		$data['links']   = $this->pagination->create_links();
		$data['num_rows'] = $config['total_rows'];	
		
		$data['bank_id'] = $bank_id;
		$data['employer_name'] = $employer_name;	
		$data['candidate_id'] = $candidate_id;	
		$data['per_page'] = $per_page;
		  	  
	    $this->load->view('admin/candidates/view.php', $data);
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
		$this->form_validation->set_rules('company_id', 'Company', 'trim');
		$this->form_validation->set_rules('userfile', 'CSV File', 'trim');
		
		if ($this->form_validation->run()) {
			$data['error'] = '';   
			if($_FILES['userfile']['error'] != 4){		
			  if(isset($_FILES["userfile"]["name"]) && ($_FILES["userfile"]["name"]!=''))
			{	$path_info = pathinfo($_FILES["userfile"]["name"]);
			$fileExtension = $path_info['extension'];
			$file_name = time().'.'.$fileExtension ;   
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
				$company_id = $this->input->post('company_id');
                foreach ($csv_array as  $row) {
					
				//	echo "---------------------->".$row;
					//echo "<br>";
					$x++;
					 if(isset($row['sr_no']))
					{
						if($row['sr_no']=='')
						$err .='Row No ' .$x.' Sr no. column is required.<br>';
					}
                    if(isset($row['candidate_id']))
					{
						
					}
					else
					{	$err ='Invalid Candidate Id. Column.<br>';
					}
					if(isset($row['batch_id']))
					{
						
					}
					else
					{	$err ='Invalid Batch Id. Column.<br>';
					}
					if(isset($row['employee_number']))
					{
						
					}
					else
					{	$err ='Invalid Employee Number. Column.<br>';
					}
					if(isset($row['ctc']))
					{	
						$ctc=special_char_remove($row['ctc']);
						if($ctc!='')
						{
						if(!is_numeric(ltrim($ctc)))
						$err .='Row No ' .$x.' invalid CTC'.ltrim($ctc).'<br>';
						}
						
					}
					else
					{	$err ='Invalid CTC Column.<br>';
					}
					if(isset($row['function']))
					{
						
					}
					else
					{	$err ='Invalid Function  Column.<br>';
					}
					if(isset($row['department']))
					{
						
					}
					else
					{	$err ='Invalid Department  Column.<br>';
					}
					if(isset($row['designation']))
					{
						
					}
					else
					{	$err ='Invalid Designation Column.<br>';
					}
					if(isset($row['location']))
					{
						
					}
					else
					{	$err ='Invalid Location Column.<br>';
					}
					if(isset($row['esi_no']))
					{
						
					}
					else
					{	$err ='Invalid ESI No Column.<br>';
					}
					
					if(isset($row['date_of_joining']))
					{
						if($row['date_of_joining']=='')
						$err .='Row No '.$x.' Date of Joining date required.<br>';
						$date_of_joining =$row['date_of_joining'];
						if($date_of_joining != '')
						{   $dateofjoining = explode("/",$date_of_joining);
					     	if($dateofjoining[0]== '' || $dateofjoining[1]== '' || $dateofjoining[2]=='' )
							$err .='Row No ' .$x.' invalid Date of Joining date format.  It should be (DD/MM/YYYY).<br>';
							if(!checkdate($dateofjoining[1], $dateofjoining[0], $dateofjoining[2]))
							$err .='Row No ' .$x.' invalid Date of Joining date format.  It should be (DD/MM/YYYY).<br>';
						}
					}
					else
					{		$err ='Invalid Date of Joining date Column.<br>';
					}
					if(isset($row['pf_no']))
					{
						
					}
					else
					{	$err ='Invalid PF NO. Column.<br>';
					}
					if(isset($row['uan_no']))
					{
											}
					else
					{	$err ='Invalid UAN NO NO. Column.<br>';
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
                 
                  	if(isset($row['candidate_name']))
					{
					}
					else
					{	$err ='Invalid Eandidate name Column.<br>';
					}
					                                        
					if(isset($row['father_name']))
					{
						if($row['father_name']=='')
						$err .='Row No ' .$x.' Father Name required.<br>';
					}
					else
					{	$err ='Invalid Father’s Name Column.<br>';
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
                    
                    if(isset($row['state']))
					{
					}
					else
					{	$err ='Invalid State Column.<br>';
					}
                    
                    if(isset($row['city']))
					{
					}
					else
					{	$err ='Invalid City Column.<br>';
					}
                    
                    if(isset($row['pincode']))
					{	
						
					}
					else
					{	$err ='Invalid Pincode Column.<br>';
					}
                    
                   if(isset($row['address']))
					{
					}
					else
					{	$err ='Invalid Address Column.<br>';
					}
					if(isset($row['date_of_birth']))
					{
						if($row['date_of_birth']=='')
						$err .='Row No '.$x.' Date of Birth date required.<br>';
						$date_of_birth =$row['date_of_birth'];
						if($date_of_birth != '')
						{   $dateofbirth = explode("/",$date_of_birth);
					     	if($dateofbirth[0]== '' || $dateofbirth[1]== '' || $dateofbirth[2]=='' )
							$err .='Row No ' .$x.' invalid Date of Birth date format.  It should be (DD/MM/YYYY).<br>';
							//if(!checkdate($dateofbirth[1], $dateofbirth[0], $dateofbirth[2]))
							//$err .='Row No ' .$x.' invalid Date of Birth date format.  It should be (DD/MM/YYYY).<br>';
						}
					}
					else
					{		$err ='Invalid Date of Birth date Column.<br>';
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
					    $dateofjoining = explode("/", $row['date_of_joining']);
						if($dateofjoining!='')
						$date_of_joining=$dateofjoining[2].'-'.$dateofjoining[1].'-'.$dateofjoining[0];
						else
						$date_of_joining='0000-00-00';
                    
					    $dateofbirth = explode("/", $row['date_of_birth']);
						if($dateofbirth!='')
						$date_of_birth=$dateofbirth[2].'-'.$dateofbirth[1].'-'.$dateofbirth[0];
						else
						$date_of_birth='0000-00-00';
						
                        $bankaccountno = explode("-", $row['bank_account_no']);
                    	$bank_account_no = $bankaccountno[1];
                    	$candidateid= trim($row['candidate_id']);
                        $batch_id= trim($row['batch_id']);
						$candidate_name= trim($row['candidate_name']);
						$employee_number= trim($row['employee_number']);
						$ctc= trim($row['ctc']);
						$function= trim($row['function']);
						$department= trim($row['department']);
						$designation= trim($row['designation']);
						$esi_no= trim($row['esi_no']);
                        $father_name= trim($row['father_name']);
						$pf_no= trim($row['pf_no']);
						$uan_no= trim($row['uan_no']);
						$contact_number= trim($row['contact_number']);
                        $state= trim($row['state']);
                        $city= trim($row['city']);
						$location= trim($row['location']);
                        $pincode= trim($row['pincode']);
                        $address= trim($row['address']);
                    
						
						if(trim($candidate_id!=''))
						{
						$this->db->select('candidate_id');
						$this->db->from('candidates');
						$this->db->where('candidateid', $candidateid);
						$this->db->order_by('candidate_id','ASC');
						$candidate_query = $this->db->get();
						$candidate_result = $candidate_query->result();
						$candidateid_num_rows =  $candidate_query->num_rows();
						}
						else
						{	$candidateid_num_rows='0';
						}

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

					
						

						if($bank_acc_no_num_rows==0 &&  $candidateid_num_rows==0)
						{
					    $insert_data = array(
							'bank_account_no'=>$bank_account_no,
							'candidateid'=>$candidateid,
							'batch_id'=>$batch_id,
                            'bank_account_no'=>$bank_account_no,
                            'acc_holder_name'=>$candidate_name,
							'father_name'     => $father_name,
							'employee_number'     => $employee_number,
							'ctc'     => $ctc,
							'function'     => $function,
							'department'     => $department,
							'designation'     => $designation,
							'esi_no'     => $esi_no,
							'pf_no'     => $pf_no,
							'uan_no'     => $uan_no,
                            'state'     => $state,
                            'city'     => $city,
							'location'     => $location,
                            'pincode'     => $pincode,
                            'address'     => $address,
                            'company_id'     => $company_id,
							'bank_id'     => $bank_id,
                          	'date_of_birth'    =>$date_of_birth,
							'date_of_joining'    =>$date_of_joining,
							'contact_number'    =>$contact_number,
							'created_by'     => $this->session->userdata('user_id'),
							'created_on'      => date('Y-m-d H:i:s')
						 );
						$candidate_id = $this->candidates_model->insert_candidate_data($insert_data);
                       /* echo '<pre>';    
                        print_r($insert_data);  
                             echo '</pre>';*/
						if($candidate_id)
						{
						  $done++;	
				         }
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
			   		$msg1=  "Total (".$done.")  Record's Imported succesfully.<br>";
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
		}
		  //print '<pre>'; print_r($data); die;
		  
		
		if($this->uri->segment('4'))
			 $bank_id=$this->uri->segment('4');
		else
			 $bank_id='0';
			  
		$data['bank_id']=$bank_id;  
		$this->load->view('admin/candidates/upload_bulk_candidates', $data);
	}
  

	public function payslip_sample_file_download() {
		//echo "Hello";
		//$data = file_get_contents(base_url()."pay_slip_sample_file.csv"); 
		$data = file_get_contents("../pay_slip_sample_file.csv"); 
		force_download(trim('pay_slip_sample_file.csv'), $data, trim('Candidate(s) Sample File'));  
	   
   }//end of file Download functionality

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