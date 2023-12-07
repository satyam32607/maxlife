<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Campaigns extends CI_Controller {

 var $original_path;
 var $resized_path;	
public function __construct()
	{
		parent:: __construct();
		valid_logged_in(FALSE,'A');	
		$this->load->model('admin/campaigns_model');
		$this->load->library('csvimport');
		$this->load->library('upload');
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
	
	
    /*=========== Upload Bulk candidates =========*/
	public function upload_candidates() {
		  
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
				$already_emp_code='';
				$err='';
				
				/*echo "<pre>";
				print_r($csv_array);
				echo "</pre>";
				die();*/
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
					if(isset($row['Candidate Id']))
					{
						$candidate_id=special_char_remove($row['Candidate Id']);
						if($candidate_id=='')
						$err .='Row No ' .$x.' Candidate Id. required.<br>';
					}
					else
					{	$err ='Invalid Candidate Id. Column.<br>';
					}
					if(isset($row['Applicant Full Name']))
					{
					}
					else
					{	$err ='Invalid Applicant Full Name Column.<br>';
					}
					
					if(isset($row['Father’s Name']))
					{
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
							$err .='Row No ' .$x.' invalid Date of Birth format.  It should be (MM/DD/YYYY).<br>';
							if(!checkdate($dateofbirth[0], $dateofbirth[1], $dateofbirth[2]))
							$err .='Row No ' .$x.' invalid Date of joining format.  It should be (MM/DD/YYYY).<br>';
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
					}
					else
					{	$err ='Invalid Email ID Column.<br>';
					}
					if(isset($row['Pan number']))
					{
					}
					else
					{	$err ='Invalid Pan number Column.<br>';
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
					if(isset($row['Educational Qualication']))
					{
					}
					else
					{	$err ='Invalid Educational Qualication Column.<br>';
					}
					if(isset($row['Other Qualification']))
					{
					}
					else
					{	$err ='Invalid Other Qualification Column.<br>';
					}
					if(isset($row['Occupation /Primary Profession']))
					{
					}
					else
					{	$err ='Invalid Occupation /Primary Profession Column.<br>';
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
					if(isset($row['Applicant Name as
per Bank Account']))
					{
					}
					else
					{	$err ='Invalid Applicant Name as
per Bank Account Column.<br>';
					}
					if(isset($row['IFSC']))
					{
					}
					else
					{	$err ='Invalid IFSC Column.<br>';
					}
					if(isset($row['Any of your relative is
HDFC Life\'s Employee']))
					{
					}
					else
					{	$err ='Invalid Any of your relative is
HDFC Life\'s Employee Column.<br>';
					}
					
					if(isset($row['If Yes, name of your
relative who is HDFC
Life\'s Employee']))
					{
					}
					else
					{	$err ='Invalid If Yes, name of your
relative who is HDFC
Life\'s Employee Column.<br>';
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
					
						if($row['Date of Birth']!='')
						$date_of_birth= date("Y-m-d",strtotime($row['Date of Birth']));
						else
						$date_of_birth='0000-00-00';
						
						$employee_code= trim($row['Employee code']);
						$emp_name= trim($row['Name']);
						$function= trim($row['category']);
						$designation_name= trim($row['sub category']);
						$primary_mobile_no= trim($row['primary_mobile_no']);
						$alternate_mobile_no= trim($row['alternate_mobile_no']);
						$income_tax_number= trim($row['Income Tax Number']);
						$pf_account_number= trim($row['PF Account Number']);
						$esi_number= trim($row['ESI Number']);
						$pr_account_number= trim($row['PR Account Number']);
						$present_days= trim($row['Present Days']);
						$month_days= trim($row['Month Days']);
						$mode_of_payment= trim($row['Mode of Payment']);
						$date= trim($row['date(MM/DD/YYYY)']);
						$place= trim($row['Place']);
						$company_name= trim($row['Company Name']);
						$company_address= trim($row['Company Address']);
					    $salary_month = $this->input->post('salary_month').'-01';
					    $group_id='2';	
						if(trim($employee_code!=''))
						{
						$this->db->select('users.user_id');
						$this->db->from('employee_salaries');
						$this->db->join('users', 'users.user_id = employee_salaries.user_id');
						$this->db->where('users.emp_code', $employee_code);
						$this->db->where('users.group_id', $group_id);
						$this->db->where('employee_salaries.salary_month', $salary_month);
						$this->db->order_by('employee_salaries.emp_salary_id','ASC');
						$employeequery = $this->db->get();
						$employeeresult = $employeequery->result();
						$empcode_num_rows =  $employeequery->num_rows();
						}
						else
						{	$empcode_num_rows='0';
							$row['Employee code']='';
						}
						
						if($empcode_num_rows==0)
						{
						$update_by[] = array('uid' => $this->session->userdata('user_id'), 'dt' => date('Y-m-d H:i:s'));
					    $update_by_id =   json_encode($update_by);
						
						$user_id = $this->AutoEmployeeSave($group_id,$employee_code,$emp_name,$branch_id,$primary_mobile_no,$alternate_mobile_no,$date_of_joining,$designation_name);
						
					    $insert_data = array(
							'group_id'=>$group_id,
							'user_id'=>$user_id,
							'salary_month'     => $salary_month,
							'employee_code'     => $employee_code,
							'emp_name'     => $emp_name,
							'function'     => $function,
							'designation'    => $designation_name,
							'master_id'     => $branch_id,
							'date_of_joining'    =>$date_of_joining,
							'income_tax_number'    =>$income_tax_number,
							'pf_account_no'    =>$pf_account_number,
							'esi_no'   => $esi_number,
							'pr_account_no'   => $pr_account_number,
							'present_days'     => $present_days,
							'month_days'     => $month_days,
							'mode_of_payment'     => $mode_of_payment,
							'salary_date'     => $payslipdate,
							'place'     => $place,
							'company_name'     => $company_name,
							'company_address'     => $company_address,
							'created_by'      => $this->session->userdata('user_id'),
							'created_on'      => date('Y-m-d H:i:s')
						);
						$emp_salary_id = $this->branches_model->insert_employee_payslip_data($insert_data);
						 
						 $post_data = array(); 
						//Form Submit data save
						 $this->db->select('account_id,account_name');
						 $this->db->where('is_active', '1');
						 $this->db->where('group_id',$group_id);
						 $this->db->from('accounts_heads');
						 $this->db->order_by("weight", "asc");
						 $this->db->group_by("account_id");
						 $accountheadquery = $this->db->get();
						 $accountheadresult = $accountheadquery->result();
						//echo "---------->".$this->db->last_query();
						/*echo "<pre>";
						print_r($accountheadresult);
						echo "</pre>";*/
						
						//die();
						
						//die();getformid
						if(is_array($accountheadresult))
						{
						foreach($accountheadresult as $dfields){
						 $field_key	= $dfields->account_name;
						 $account_id	= $dfields->account_id;
						if(isset($row[$field_key]))
						 {
						  /* echo "---".$field_key."---------------->".$account_id;
						   echo "---".$field_key."---------------->".$row[$field_key];
						   $amt = $row[$field_key];
						   echo "<br>";
						   */
						   $amt = $row[$field_key];
						    $payslipdata        = array(
								'emp_salary_id'     => $emp_salary_id,
								'account_id'   => $account_id,
								'amt'     => $amt,
								'acc_name'     => $field_key
							);
							 $salaryinforesult   = $this->db->insert('employee_salary_info', $payslipdata);
		 				   }
							
						  }
						}
						/* if($_SERVER['REMOTE_ADDR']=='137.59.212.34')
						 { 
							echo "<pre>";
							print_r($post_data);
							echo "</pre>";
							die();
						 }
						*/
					   
						if($user_id)
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
							$already_exists_data=trim($row['Employee code']);
							
							$already_emp_code .= $already_exists_data.', ';
						}
						
					 }
					
					}	
					
					$data['err']=$err;
					
			
               if($err=='')
			   {  
			       $msg1='';
				   $msg2='';
				   $already_emp_code = substr($already_emp_code,0,-1);
				   if($done>0)
			   		$msg1=  "Total (".$done.") Record's Imported succesfully.<br>";
				   if($already>0)
			   		$msg2=  " (".$already.") records already exists in database.<br>(".$already_emp_code.")";
					
					if($msg1!='')
				    $this->session->set_flashdata('success_message', $msg1);
					
					if($msg2!='')
				    $this->session->set_flashdata('warning_message', $msg2);
					
				  redirect(base_url().'admin/branches/upload_payslip');
			   }
			   
               
            } else 
                $data['error'] = "Error occured";
                
            }
				/*========== File Upload Script end ===========*/
				
			 }
		}
		  //print '<pre>'; print_r($data); die;
		$this->load->view('admin/branches/upload_payslip', $data);
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

	
	 public function sample_file_download() {
		 
		    
			$this->db->select('*');
			$this->db->where('group_id','2');
			$this->db->where('is_active','1');
			$this->db->order_by('weight','ASC');
			$this->db->from('accounts_heads');
			$result = $this->db->get();
			$return = array();
			$return['srno'] = 'srno';
			$return['emp_code'] = 'Employee code';
			$return['name'] = 'Name';
			$return['category'] = 'category';
			$return['sub_category'] = 'sub category';
			$return['location'] = 'location';
			$return['primary_mobile_no'] = 'primary_mobile_no';
			$return['alternate_mobile_no'] = 'alternate_mobile_no';
			$return['date_of_joining'] = 'doj(MM/DD/YYYY)';
			$return['income_tax_number'] = 'Income Tax Number';
			$return['pf_account_number'] = 'PF Account Number';
			$return['esi_number'] = 'ESI Number';
			$return['pr_account_number'] = 'PR Account Number';
			$return['present_days'] = 'Present Days';
			$return['month_days'] = 'Month Days';
			$return['mode_of_payment'] = 'Mode of Payment';
			$return['date'] = 'date(MM/DD/YYYY)';
			$return['place'] = 'Place';
			$return['company_name'] = 'Company Name';
			$return['company_address'] = 'Company Address';
			 foreach ($result->result_array() as $row) {
			/* echo "<pre>";
			  print_r($row);
			 echo "</pre>";*/
			 
			 $return[] = $row['account_name'];
			 
			 }
			 
			 /* echo "<pre>";
			  print_r($return);
			  echo "</pre>";
			  die();*/
		$data =array(
			$return
			);
			/*echo "<pre>";
				print_r($data);
				echo "</pre>";
				die();*/
		$this->outputCsv('Sample_File.csv', $data);
		
	}//end of file Download functionality
	

	function outputCsv($fileName, $assocDataArray)
	{
		ob_clean();
		header('Pragma: public');
		header('Expires: 0');
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Cache-Control: private', false);
		header('Content-Type: text/csv');
		header('Content-Disposition: attachment;filename=' . $fileName);    
		if(isset($assocDataArray['0'])){
			$fp = fopen('php://output', 'w');
			///fputcsv($fp, array_keys($assocDataArray['0']));
			foreach($assocDataArray AS $values){
				fputcsv($fp, $values);
			}
			fclose($fp);
		}
		ob_flush();
	}


   function AutoEmployeeSave($group_id,$emp_code,$emp_name,$branch_id,$mobile_no1,$mobile_no2,$date_of_joining,$designation_name)
	{
		 $this->db->select('*');
		 $this->db->from('users');
		 $this->db->where('group_id',$group_id);
		 $this->db->where('emp_code',$emp_code);
		 $this->db->order_by('user_id','ASC');
		 $emp_query_result = $this->db->get();
		 if($emp_query_result->num_rows() > 0)
		 {   $emprow = $emp_query_result->row(); 
			 $user_id=$emprow->user_id;
		 }
		 else
		 {   
		   $empname = explode(" ", $emp_name);
		   $firstname = $empname[0];
		   $lastname = $empname[1].' '.$empname[2];
		   
		   $salt = create_salt($password=NULL);
		   $password  = 'abc123';	
           $data        = array(
		    'email'     => '',
			'password'=> SHA1($password.$salt),
			'salt'=>  $salt,
			'user_type'   => 'E',
			'emp_code'   => $emp_code,
			'first_name'     => $firstname,
			'last_name'     => $lastname,
			'mobile_no1'     => $mobile_no1,
			'mobile_no2'     => $mobile_no2,
			'date_of_joining'     => $date_of_joining,
			'designation_name'     => $designation_name,
			'group_id'   => $group_id,
			'post_user_id'   => $this->session->userdata('user_id'),
			'reg_date'      => date('Y-m-d H:i:s'),
        );
         $result   = $this->db->insert('users', $data);
		 $user_id = $this->db->insert_id();
		 
		    $user_address_id = $this->insertUserAddress($user_id);
			$update_data =array( 
				'user_address_id' => $user_address_id,
			 );	
			 $this->db->where('user_id', $user_id);
			 $result = $this->db->update('users', $update_data);
			if($user_id > 0)
			{	$update_by[] = array('uid' => $this->session->userdata('user_id'), 'dt' => date('Y-m-d H:i:s'));
				$update_by_id = json_encode($update_by);
				$table_name = "users";
				$operation = "Record added";
				createLogFile($operation,$user_id,$update_by_id,$table_name);
			}	 
		 }
		if ($user_id) {
		   return $user_id;
		 }
		 else
		 {
		   return 0;
		 }

	} //End of add function
	
	
	 function insertUserAddress($user_id)
 	  {    $country_id='101';
		   $countryrow = get_table_info('country','country_id',$country_id);
		   $address_data =array( 
		        'user_id' => $user_id,
				'country_id' => $country_id,
				'country_code' => $countryrow->country_code,
				'is_primary'=>'1',
				'post_date'      => date('Y-m-d H:i:s')
			 );	
			 $result= $this->db->insert('user_address',$address_data);	
			 $user_address_id  = $this->db->insert_id();
			if($result)
				return $user_address_id;
			else
				return 0;
	   }
	
	
	public function payslip($emp_salary_id)
	{	
	   if($this->uri->segment('4'))
			 $emp_salary_id=$this->uri->segment('4');
		else
			 $emp_salary_id='0';
		 
		 $data['title'] = title." | Pay Slip";
		 $data['main_heading'] = "Pay Slip";	
		 $data['heading'] = "Pay Slip";	
		 
	     $result = $this->salaries_model->view_payslip($emp_salary_id);
		 $data['row'] = $result;
		  
		$this->load->view('admin/salaries/view_payslip', $data);	
		 
	}//end of Status  functionality*/
	

	
}	
?>