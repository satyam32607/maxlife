<?php

class Campaigns_model extends CI_Model
{
	function get_candidates($campaign_id)
		{
			$this->db->select('consent_candidates.candidate_id,consent_candidates.applicant_full_name,consent_candidates.email_id,consent_candidates.mobile_no,campaign_logs.campaign_log_id');
			$this->db->from('consent_candidates');
			$this->db->join('campaign_logs', 'campaign_logs.candidate_id = consent_candidates.candidate_id');
			$this->db->where('campaign_logs.campaign_id',$campaign_id);
			$this->db->where('campaign_logs.candidate_status !=', '3');
			$this->db->where('consent_candidates.is_active', '1');
			$this->db->where('campaign_logs.unique_id !=', '');
			$this->db->order_by('campaign_logs.campaign_log_id', 'ASC');
			$query = $this->db->get();
			$result = $query->result();
			//echo $this->db->last_query();
			//echo "<br>";echo "<br>";
			
			return $result;
	
		} //End of View function
		
	 function add()
     {
		$data        = array(
		    'sponser_id'   => '53',
          	'campaign_name'     => $this->input->post("campaign_name"),
			'campaign_type'    => '1',
			'start_date'   => $this->input->post("start_date"),
			'end_date'     => $this->input->post("end_date"),
			'description'     => $this->input->post("description"),
			'created_by'     => $this->session->userdata('user_id'),
			'created_on'      => date('Y-m-d H:i:s'),
        );
        $result   = $this->db->insert('campaigns', $data);
		$campaign_id  = $this->db->insert_id();
		if($result > 0)
		{
			return $campaign_id;
		 }
		else
			return 0;


    } //End of add function
	
	
	function view_campaigns()
		{
			$this->db->select('*');
			$this->db->from('campaigns');
			$this->db->order_by('start_date', 'DESC');
			$query = $this->db->get();
			//echo $this->db->last_query();
			$result = $query->result();
			//Count Company Alias Admin,Users Records
			foreach ($result as $row) {
				
				$row->total_candidates= $this->countcandidates($row->campaign_id);
				}
			/*echo "<pre>";
			print_r($result);
			echo "</pre>";
			*/
			return $result;
	
		} //End of View function
		
		function countcandidates($campaign_id)
		{
			$this->db->where('campaign_id', $campaign_id);
			$this->db->from('campaign_logs');
			$query = $this->db->get();
			return $query->num_rows();
	
		} //End of Count function
		
		
	  function campaign_edit($campaign_id)
		{
			if ($campaign_id == '') {
				redirect(base_url() . "admin/campaigns/view");
			}
			$this->db->select('*');
			$this->db->from('campaigns');
			$this->db->where('campaign_id', $campaign_id);
			$query = $this->db->get();
			return $query->row();
	
		} //End of edit function
	
	
		 function update_campaign($campaign_id)
		 {
			$data = array(
				'campaign_name'     => $this->input->post("campaign_name"),
				'start_date'   => $this->input->post("start_date"),
				'end_date'     => $this->input->post("end_date"),
				'description'     => $this->input->post("description")
			);
			$this->db->where('campaign_id', $campaign_id);
			$result = $this->db->update('campaigns', $data);
			if ($result)
		    return 1;
			else
			return 0;
			
		 } //End of Update function
		 
		 
    function get_sms_email_templates($template_type)
	{
		$this->db->select('*');
		$this->db->from('mail_sms_templates');
		$this->db->where('template_type',$template_type);
		$this->db->where('template_type',$template_type);
		$this->db->where_in('is_active','1');
		$this->db->order_by('template_title', 'ASC');
		$result = $this->db->get();
		$options = array();
		if ($result->num_rows() > 0) {
			$options[''] = 'Select Template';
			foreach ($result->result_array() as $row) {
				 if($template_type=='s')
				 $options[$row['template_id'].'|||'.$row['template_body']] = $row['template_title'];
				 else
				 $options[$row['template_id'].'|||'.$row['template_subject'].'|||'.$row['template_body']] = $row['template_title'];
				 
				
			}
		}
		//print_r($options);
		return $options;
	}
		
	 function update_send_sms($tournament_id){
		
		if($this->input->post("campaign_log_id"))
		 {
			$template_id = $this->input->post("template_id");
			$sms_body = $this->input->post("sms_body");
			$templaterow=get_table_info('mail_sms_templates','template_id',$template_id);
		  	
		   $data = array(
				'template_id'     => $template_id,
				'template_title'     => $templaterow->template_title,
				'template_body'     => $sms_body,
				'send_by'     => $this->session->userdata('user_id'),
				'send_date'     => date('Y-m-d H:i:s')
			);
			$templateresult   = $this->db->insert('mail_sms_logs', $data);
			$log_id = $this->db->insert_id();
					 
		 $done=0;
		 $error=0;
		 $status='';
		 $message='';
		 if(is_array($this->input->post("campaign_log_id")))
		 foreach($this->input->post("campaign_log_id") as $camplogid){
			
			$this->db->select('consent_candidates.applicant_full_name,consent_candidates.email_id,consent_candidates.mobile_no,campaign_logs.campaign_log_id,campaign_logs.campaign_log_id,campaign_logs.candidate_id,campaign_logs.unique_id');
			$this->db->from('consent_candidates');
			$this->db->join('campaign_logs', 'campaign_logs.candidate_id = consent_candidates.candidate_id');
			$this->db->where('campaign_logs.candidate_status !=', '3');
			$this->db->where('campaign_logs.campaign_log_id',$camplogid);
			$query = $this->db->get();
			$camplogrow =  $query->row();

			$camplogrow->campaign_link = campaign_link.'/v/'.$camplogrow->unique_id;
			//print_r($camplogrow);
			//die();
			//echo $this->db->last_query();
			$name = $camplogrow->applicant_full_name;
			$mobile_no = $camplogrow->mobile_no;
			$campaign_log_id = $camplogrow->campaign_log_id;
			$candidate_id = $camplogrow->candidate_id;
			if($mobile_no!='')
			{    
			     $replaced_sms_body=templatedata($sms_body,$camplogrow);
				 $errNo='';
				//echo "----------------->".$replaced_sms_body;
				//die();
				//$mobile_no='7889231912';
				$sendresult =  send_sms($mobile_no,$replaced_sms_body);
				/*echo "<pre>";
				print_r($sendresult);
				echo "</pre>";*/
				
				$logdata = array(
					'log_id'   => $log_id,
					'campaign_log_id'   => $campaign_log_id,
					'candidate_id'   => $candidate_id,
					'sent_title'     => $templaterow->template_title,
					'sent_body_text'     => $replaced_sms_body,
					'sent_datetime'     => date('Y-m-d H:i:s')
				);
				$logresult   = $this->db->insert('mail_sms_log_details', $logdata);
				$log_detail_id = $this->db->insert_id();
				/*echo "<pre>";
				print_r($sendresult);
				echo "</pre>";
				$send_result = json_decode($sendresult);
				
		     	echo "<pre>";
				print_r($send_result);
				echo "</pre>";
				die();*/
				
				if($sendresult!='0')
				{	 $update_data =array( 
						'sent_status' => '1',
					 );	
					 $this->db->where('log_detail_id', $log_detail_id);
					 $result = $this->db->update('mail_sms_log_details', $update_data);
					 $done++;
				}
				else
				{
					$status =  $sendresult->status;
					$errors = $send_result->errors[0];
					$message = 'Message not Delivered.';
					$error++;
					
				}
			}
		   }
		 }
		 if($done>0)
		  $this->session->set_flashdata('success_message', 'Total\'s ('.$done.') message send successfully.');
		  
		  if($error>0)
		  $this->session->set_flashdata('warning_message', 'There is some error Status: ('.$status.')'. ', Message: ('.$message.')');
		  
		return $logresult;
	}
	
	
	   function update_send_email($campaign_id){
		
		if($this->input->post("campaign_log_id"))
		 {
			$template_id = $this->input->post("template_id");
			$email_subject = $this->input->post("email_subject");
			$email_body = $this->input->post("email_body");
			$templaterow=get_table_info('mail_sms_templates','template_id',$template_id);
			//echo $this->db->last_query();
		   $data = array(
				'template_id'     => $template_id,
				'template_title'     => $templaterow->template_title,
				'email_subject'     => $email_subject,
				'template_body'     => $email_body,
				'send_by'     => $this->session->userdata('user_id'),
				'send_date'     => date('Y-m-d H:i:s')
			);
			$templateresult   = $this->db->insert('mail_sms_logs', $data);
			$log_id = $this->db->insert_id();
					 
		 $done=0;
		 $error=0;
		 if(is_array($this->input->post("campaign_log_id")))
		 foreach($this->input->post("campaign_log_id") as $camplogid){
			 
			$this->db->select('consent_candidates.applicant_full_name,consent_candidates.email_id,consent_candidates.mobile_no,campaign_logs.campaign_log_id,campaign_logs.campaign_log_id,campaign_logs.candidate_id,campaign_logs.unique_id');
			$this->db->from('consent_candidates');
			$this->db->join('campaign_logs', 'campaign_logs.candidate_id = consent_candidates.candidate_id');
			$this->db->where('campaign_logs.candidate_status !=', '3');
			$this->db->where('campaign_logs.campaign_log_id',$camplogid);
			$query = $this->db->get();
			$camplogrow =  $query->row();

			$camplogrow->campaign_link = campaign_link.'/v/'.$camplogrow->unique_id;
			//print_r($camplogrow);
			//die();
			//echo $this->db->last_query();
			$applicant_full_name = strtolower($camplogrow->applicant_full_name);
			$name = ucwords($applicant_full_name);
			$camplogrow->applicant_name=$name;
			$mobile_no = $camplogrow->mobile_no;
			$to_email = strtolower($camplogrow->email_id);
			$campaign_log_id = $camplogrow->campaign_log_id;
			$candidate_id = $camplogrow->candidate_id;

			if($to_email!='')
			{    
		       // $to_email='dreamweaversgroup1@gmail.com';
				//$to_email='ajaykumar1286@gmail.com';
			    $replaced_email_body=templatedata($email_body,$camplogrow);
				//echo $replaced_email_body;
				//die();
				//$sendresult =  common_mail('ajaykumar1286@gmail.com','thedeveloper33@gmail.com',$email_subject,$replaced_email_body);
				//$email_subject = 'HDFC LIFE: '.$email_subject;
				$email_subject = $email_subject;
				
				$sendresult =  common_mail($to_email,$alternate_email,$email_subject,$replaced_email_body);
				//echo "---------Result--->".$sendresult;
				//die();
				/*echo "<pre>";
				print_r($sendresult);
				echo "</pre>";*/
				
				$logdata = array(
					'log_id'   => $log_id,
					'campaign_log_id'   => $campaign_log_id,
					'candidate_id'   => $candidate_id,
					'sent_title'     => $templaterow->template_title,
					'email_subject'     => $email_subject,
					'sent_body_text'     => $replaced_email_body,
					'sent_datetime'     => date('Y-m-d H:i:s')
				);
				$logresult   = $this->db->insert('mail_sms_log_details', $logdata);
				$log_detail_id = $this->db->insert_id();
			/*	echo "<pre>";
				print_r($send_result);
				echo "</pre>";*/
				if($sendresult=='1')
				{	 $update_data =array( 
						'sent_status' => '1',
					 );	
					 $this->db->where('log_detail_id', $log_detail_id);
					 $result = $this->db->update('mail_sms_log_details', $update_data);
					 $done++;
				}
				else
				{	 $error++;
				}
			  }
		    }
		 }
		  if($done>0)
		  $this->session->set_flashdata('success_message', 'Total\'s ('.$done.') Email\'s send successfully.');
		  
		  if($error>0)
		  $this->session->set_flashdata('warning_message', 'There is some error in sending Email.');
		  
		return $logresult;
	}
	
	   
	
 function update_status($campaign_id, $status)
    {
		 if($status=='1')
		 {	$data = array(
				'is_active' => $status,
				'deactive_date' =>''
			);
		 }
		 else
		 {
			$data = array(
				'is_active' => $status,
				'deactive_date' => date('Y-m-d H:i:s')
			);
		 }
        $this->db->where('campaign_id', $campaign_id);
	    $result = $this->db->update('campaigns', $data);
		if($result)
		  return '1';
		 else 
		 return '0';

    } //End of Update status function
	
	
		
   function view_candidates($campaign_id,$candidate_id,$application_no,$search_by,$search_value,$status,$limit, $start)
    {
		$this->db->select('consent_candidates.*,campaign_logs.campaign_log_id,campaign_logs.campaign_id,campaign_logs.unique_id,campaign_logs.candidate_status');
		$this->db->where('campaign_logs.campaign_id',$campaign_id);
		$this->db->join('campaign_logs', 'consent_candidates.candidate_id = campaign_logs.candidate_id');
		if($candidate_id!='0')
		$this->db->where('consent_candidates.candidate_id', $candidate_id);
		if($application_no!='0')
		$this->db->where('consent_candidates.application_no', $application_no);
		if($search_by!='0' && $search_value!='0')
		{  if($search_by=='1') 	
		   $this->db->like('consent_candidates.candidateid', $search_value);
		   elseif($search_by=='2') 	
		   $this->db->like('consent_candidates.mobile_no', $search_value);
		   elseif($search_by=='3') 	
		   $this->db->like('consent_candidates.applicant_full_name', $search_value);
		}
		if($status!='0')
		{	if($status == 'a')
			{	$status = '1';
			}
			else
			{	$status = '0';
			}
			$this->db->where('campaign_logs.is_active',$status);
		}	
		$this->db->group_by('consent_candidates.candidate_id'); 
		$this->db->order_by('consent_candidates.applicant_full_name','ASC');
		if($limit!=null || $start!=null)
		{
			$this->db->limit($limit,$start);
		}	
        $this->db->from('consent_candidates');
        $query = $this->db->get();
	   //echo "--->".$this->db->last_query();
	    $result = $query->result();
		/*echo "<pre>";
		print_r($result);
		echo "</pre>";*/
       
        return $result;

    } //End of View  function
	
	
	
	
	function count_candidates($campaign_id,$candidate_id,$application_no,$search_by,$search_value,$status) {
			
			$this->db->where('campaign_logs.campaign_id',$campaign_id);
			$this->db->join('campaign_logs', 'consent_candidates.candidate_id = campaign_logs.candidate_id');
			if($candidate_id!='0')
			$this->db->where('consent_candidates.candidate_id', $candidate_id);
			if($application_no!='0')
			$this->db->where('consent_candidates.application_no', $application_no);
			if($search_by!='0' && $search_value!='0')
			{  if($search_by=='1') 	
			   $this->db->like('consent_candidates.candidateid', $search_value);
			   elseif($search_by=='2') 	
			   $this->db->like('consent_candidates.mobile_no', $search_value);
			   elseif($search_by=='3') 	
			   $this->db->like('consent_candidates.applicant_full_name', $search_value);
			}
			if($status!='0')
			{	if($status == 'a')
				{	$status = '1';
				}
				else
				{	$status = '0';
				}
				$this->db->where('campaign_logs.is_active',$status);
			}	
			$this->db->group_by('consent_candidates.candidate_id'); 
			$query=$this->db->get('consent_candidates');		
			//echo "--------------------->". $this->db->last_query();	   
			return $query->num_rows();
			
		}     //End of Count function
		
		
	 function insert_candidate_data($data) {
        $result = $this->db->insert('consent_candidates', $data);
		$candidate_id = $this->db->insert_id();
		if($candidate_id)
		{    return $candidate_id;
		     exit();
		}
		else
		{	 return '0';
			 exit();
		}
		
      }
	  
	
	function insertCampaignlogs($campaign_id,$candidate_id)
	{
		$uniqueid =  random_string('alnum',8);
		$campfields = array('unique_id'=>$uniqueid);
		$camprow = gettableinfo('campaign_logs',$campfields);
		if($camprow=='0')
		{	
			$data =array('campaign_id'=>$campaign_id,
				'candidate_id'=>$candidate_id,
				'unique_id'=>$uniqueid,
				'created_on'=>date('Y-m-d H:i:s')
			);
			$result = $this->db->insert('campaign_logs',$data);
		}
		else
		{
			$unique_id =  random_string('alnum',8);
		    $fields = array('unique_id'=>$unique_id);
			$camp_row = gettableinfo('campaign_logs',$fields);
			if($camprow!='0')
			{	$unique_id =  random_string('alnum',8);
			}
			$data =array('campaign_id'=>$campaign_id,
				'candidate_id'=>$candidate_id,
				'unique_id'=>$unique_id,
				'created_on'=>date('Y-m-d H:i:s')
			);
			$result = $this->db->insert('campaign_logs',$data);
		}
		$campaign_log_id = $this->db->insert_id();
		if($campaign_log_id)
		{	return $campaign_log_id;
		}
		else
		{	return 0;
		}							
	}
		
	
	

	
}