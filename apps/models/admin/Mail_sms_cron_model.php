<?php

class Mail_sms_cron_model extends CI_Model
{
	
	function get_active_campaigns()
     {
		$this->db->select('*');
	    $this->db->where('is_active', '1');
		$this->db->where('end_date>=',date('Y-m-d'));
	    $this->db->from('campaigns');
        $query = $this->db->get();
	   // echo "--->".$this->db->last_query();
	    $result = $query->result();
		foreach ($result as $row) {
			
			$row->send_total_sms = $this->check_sms_send_status($row->campaign_id);
			
		}
		
		
       
        return $result;

    } //End of View  function
	
	
	function check_sms_send_status($campaign_id)
     {
		$this->db->select('mail_sms_log_details.*');
		$this->db->from('campaign_logs');
		$this->db->join('mail_sms_log_details', 'mail_sms_log_details.campaign_log_id = campaign_logs.campaign_log_id');
	    $this->db->where('mail_sms_log_details.sent_status', '1');
		$this->db->where('mail_sms_log_details.sent_status',$campaign_id);
	    $this->db->group_by('mail_sms_log_details.candidate_id');
	    $query = $this->db->get();
	 // echo "--->".$this->db->last_query();  
	 // echo "<br>";
	    $result = $query->result();
	    $done=0;
		foreach ($result as $row) {
			
			$this->db->select('*');
			$this->db->where('sent_status','1');
			$this->db->where('candidate_id',$row->candidate_id);
			$this->db->where('campaign_log_id',$row->campaign_log_id);
			$this->db->order_by('log_detail_id','DESC');
			$this->db->limit(1);
			$query = $this->db->get('mail_sms_log_details');
			//echo $this->db->last_query();
			// echo "<br>";
			if($query->num_rows()>0){
				$logdetailrow = $query->row();
				
				$beforetime=date("Y-m-d H:i:s",strtotime("-20 hours",strtotime(date("Y-m-d H:i:s"))));
				$this->db->select('log_detail_id');
				$this->db->where('candidate_id',$logdetailrow->candidate_id);
				$this->db->where('campaign_log_id',$logdetailrow->campaign_log_id);
				$this->db->where('sent_datetime >=',$beforetime);
				$this->db->order_by('log_detail_id','DESC');
				$this->db->limit(1);
				$query = $this->db->get('mail_sms_log_details');
				//echo $this->db->last_query();
				//echo "<br>";
				if($query->num_rows()==0){
					$logrow = get_table_info('mail_sms_logs','log_id',$logdetailrow->log_id);
					$template_id = $logrow->template_id;
					$lastsent_datetime = $logdetailrow->sent_datetime;
					
					 $diff_days = diffdays($lastsent_datetime);
					  echo "----------diff_days--->".$diff_days;
					  echo "<br>";
					 
					 $fields = array('template_id'=>$template_id,'days'=>$diff_days,'is_active'=>'1');
					 $schedulerow = gettableinfo('campaign_scheduler_days',$fields);
					 if($schedulerow!='0')
					 {
						
						$templaterow = get_table_info('mail_sms_templates','template_id',$template_id); 
						$sms_body = $templaterow->template_body;
						
					$this->db->select('consent_candidates.applicant_full_name,consent_candidates.email_id,consent_candidates.mobile_no,campaign_logs.campaign_log_id,campaign_logs.campaign_log_id,campaign_logs.candidate_id,campaign_logs.unique_id');
					$this->db->from('consent_candidates');
					$this->db->join('campaign_logs', 'campaign_logs.candidate_id = consent_candidates.candidate_id');
					$this->db->where('campaign_logs.candidate_status !=', '3');
					$this->db->where('campaign_logs.campaign_log_id',$logdetailrow->campaign_log_id);
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
						$mobile_no='7889231912';
						//$sendresult =  send_sms($mobile_no,$replaced_sms_body);
						/*echo "<pre>";
						print_r($sendresult);
						echo "</pre>";*/
						
						$logdata = array(
							'log_id'   => $logdetailrow->log_id,
							'campaign_log_id'   => $logdetailrow->campaign_log_id,
							'candidate_id'   => $logdetailrow->candidate_id,
							'sent_title'     => $templaterow->template_title,
							'sent_body_text'     => $replaced_sms_body,
							'sent_datetime'     => date('Y-m-d H:i:s')
						);
						$logresult   = $this->db->insert('mail_sms_log_details', $logdata);
						$log_detail_id = $this->db->insert_id();
						
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
							//$status =  $sendresult->status;
							//$errors = $send_result->errors[0];
							$message = 'Message not Delivered.';
							//$error++;
							
						}
					}
					
						 
					 }
				
				}
				
				
			} else {
				return '0';
			}
		
			
			
		}
		
		/*echo "<pre>";
		print_r($result);
		echo "</pre>";*/
       
        return $done;

    } //End of View  function
	

	
	
		
		
		
	function view_consent_candidates_date_wise($start_date,$end_date,$search_by,$search_value,$limit, $start)
     {
		$this->db->select('consent_candidates.candidate_id,consent_candidates.application_no,consent_candidates.candidateid,consent_candidates.gender,	consent_candidates.applicant_full_name,consent_candidates.email_id,consent_candidates.mobile_no,consent_candidates.date_of_birth,consent_candidates.state,consent_candidates.city,consent_candidates.district,campaign_logs.candidate_status,campaign_logs.campaign_log_id,campaign_logs.unique_id,campaign_logs.created_on');
	    $this->db->join('campaign_logs', 'campaign_logs.candidate_id = consent_candidates.candidate_id');
		$this->db->where('consent_candidates.consent_status', '3');
		if($start_date!='0')
		$this->db->where('consent_candidates.consent_update_on >=', date(''.$start_date.' 00:00:00'));
		if($end_date!='0')
		$this->db->where('consent_candidates.consent_update_on <=', date(''.$end_date.' 23:59:59'));
	 if($search_by!='0' && $search_value!='0')
		{
		   if($search_by=='1') 	
		   $this->db->where('consent_candidates.application_no', $search_value);
		   elseif($search_by=='2') 	
		   $this->db->where('consent_candidates.candidateid', $search_value);
		   elseif($search_by=='3') 	
		   $this->db->like('consent_candidates.mobile_no', $search_value);
		   elseif($search_by=='4') 	
		   $this->db->like('consent_candidates.applicant_full_name', $search_value);
		}
		$this->db->group_by('campaign_logs.candidate_id'); 
		$this->db->order_by('campaign_logs.	campaign_log_id','ASC');
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

	
	function count_consent_candidates_date_wise($start_date,$end_date,$search_by,$search_value) {
			
			$this->db->join('campaign_logs', 'campaign_logs.candidate_id = consent_candidates.candidate_id');
			$this->db->where('consent_candidates.consent_status', '3');
			if($start_date!='0')
			$this->db->where('consent_candidates.consent_update_on >=', date(''.$start_date.' 00:00:00'));
			if($end_date!='0')
			$this->db->where('consent_candidates.consent_update_on <=', date(''.$end_date.' 23:59:59'));
			if($search_by!='0' && $search_value!='0')
			{
			   if($search_by=='1') 	
			   $this->db->where('consent_candidates.application_no', $search_value);
			   elseif($search_by=='2') 	
			   $this->db->where('consent_candidates.candidateid', $search_value);
			   elseif($search_by=='3') 	
			   $this->db->like('consent_candidates.mobile_no', $search_value);
			   elseif($search_by=='4') 	
			   $this->db->like('consent_candidates.applicant_full_name', $search_value);
			}
			$this->db->group_by('campaign_logs.candidate_id'); 
			$query=$this->db->get('consent_candidates');		
			//echo "--------------------->". $this->db->last_query();	   
			return $query->num_rows();
			
		}     //End of Count function
		
		
		
	function consent_candidates_report_export_to_excel($start_date,$end_date,$search_by,$search_value)
     {
		$this->db->select('consent_candidates.candidate_id,consent_candidates.application_no,consent_candidates.candidateid,consent_candidates.applicant_full_name,consent_candidates.date_of_birth,consent_candidates.mobile_no,consent_candidates.consent_status,consent_candidates.consent_update_on,campaign_logs.candidate_status,campaign_logs.campaign_log_id,campaign_logs.unique_id,campaign_logs.created_on,campaign_logs.IP_address');
	    $this->db->join('campaign_logs', 'campaign_logs.candidate_id = consent_candidates.candidate_id');
		$this->db->where('consent_candidates.consent_status', '3');
		if($start_date!='0')
		$this->db->where('consent_candidates.consent_update_on >=', date(''.$start_date.' 00:00:00'));
		if($end_date!='0')
		$this->db->where('consent_candidates.consent_update_on <=', date(''.$end_date.' 23:59:59'));
	   if($search_by!='0' && $search_value!='0')
		{
		   if($search_by=='1') 	
		   $this->db->where('consent_candidates.application_no', $search_value);
		   elseif($search_by=='2') 	
		   $this->db->where('consent_candidates.candidateid', $search_value);
		   elseif($search_by=='3') 	
		   $this->db->like('consent_candidates.mobile_no', $search_value);
		   elseif($search_by=='4') 	
		   $this->db->like('consent_candidates.applicant_full_name', $search_value);
		}
		$this->db->group_by('campaign_logs.candidate_id'); 
		$this->db->order_by('campaign_logs.	campaign_log_id','ASC');
	    $this->db->from('consent_candidates');
        $query = $this->db->get();
	    //echo "--->".$this->db->last_query();
	    $result = $query->result();
		/*echo "<pre>";
		print_r($result);
		echo "</pre>";*/
       
        return $result;

    } //End of View  function
	
	
	
	function consent_candidates_posp_report_export_to_excel($start_date,$end_date,$search_by,$search_value)
     {
		$this->db->select('consent_candidates.*,campaign_logs.candidate_status,campaign_logs.campaign_log_id,campaign_logs.unique_id,campaign_logs.created_on,campaign_logs.IP_address');
	    $this->db->join('campaign_logs', 'campaign_logs.candidate_id = consent_candidates.candidate_id');
		$this->db->where('consent_candidates.consent_status', '3');
		if($start_date!='0')
		$this->db->where('consent_candidates.consent_update_on >=', date(''.$start_date.' 00:00:00'));
		if($end_date!='0')
		$this->db->where('consent_candidates.consent_update_on <=', date(''.$end_date.' 23:59:59'));
	   if($search_by!='0' && $search_value!='0')
		{
		   if($search_by=='1') 	
		   $this->db->where('consent_candidates.application_no', $search_value);
		   elseif($search_by=='2') 	
		   $this->db->where('consent_candidates.candidateid', $search_value);
		   elseif($search_by=='3') 	
		   $this->db->like('consent_candidates.mobile_no', $search_value);
		   elseif($search_by=='4') 	
		   $this->db->like('consent_candidates.applicant_full_name', $search_value);
		}
		$this->db->group_by('campaign_logs.candidate_id'); 
		$this->db->order_by('campaign_logs.	campaign_log_id','ASC');
	    $this->db->from('consent_candidates');
        $query = $this->db->get();
	    //echo "--->".$this->db->last_query();
	    $result = $query->result();
		/*echo "<pre>";
		print_r($result);
		echo "</pre>";*/
       
        return $result;

    } //End of View  function
		
	

	
}