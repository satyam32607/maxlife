<?php

class Language_reports_model extends CI_Model
{
	
	function view_campaign_date_wise($campaign_id,$start_date,$end_date,$search_by,$search_value,$limit, $start)
     {
		$this->db->select('consent_candidates.candidate_id,consent_candidates.application_no,consent_candidates.candidateid,consent_candidates.gender,	consent_candidates.applicant_full_name,consent_candidates.email_id,consent_candidates.mobile_no,consent_candidates.date_of_birth,consent_candidates.state,consent_candidates.city,consent_candidates.district,campaign_logs.candidate_status,campaign_logs.campaign_log_id,campaign_logs.unique_id,campaign_logs.created_on');
	    $this->db->join('campaign_logs', 'campaign_logs.candidate_id = consent_candidates.candidate_id');
		if($campaign_id!='0')
		$this->db->where('campaign_logs.campaign_id', $campaign_id);
		if($start_date!='0')
		$this->db->where('campaign_logs.created_on >=', date(''.$start_date.' 00:00:00'));
		if($end_date!='0')
		$this->db->where('campaign_logs.created_on <=', date(''.$end_date.' 23:59:59'));
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
	   // echo "--->".$this->db->last_query();
	    $result = $query->result();
		/*echo "<pre>";
		print_r($result);
		echo "</pre>";*/
       
        return $result;

    } //End of View  function
	

	
	function count_campaign_date_wise($campaign_id,$start_date,$end_date,$search_by,$search_value) {
			
			$this->db->join('campaign_logs', 'campaign_logs.candidate_id = consent_candidates.candidate_id');
			if($campaign_id!='0')
			$this->db->where('campaign_logs.campaign_id', $campaign_id);
			if($start_date!='0')
			$this->db->where('campaign_logs.created_on >=', date(''.$start_date.' 00:00:00'));
			if($end_date!='0')
			$this->db->where('campaign_logs.created_on <=', date(''.$end_date.' 23:59:59'));
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
		
		
	function view_campaign_link_date_wise($campaign_id,$start_date,$end_date,$search_by,$search_value,$limit, $start)
     {
		$this->db->select('consent_candidates.candidate_id,consent_candidates.application_no,consent_candidates.candidateid,consent_candidates.gender,	consent_candidates.applicant_full_name,consent_candidates.email_id,consent_candidates.mobile_no,consent_candidates.date_of_birth,consent_candidates.state,consent_candidates.city,consent_candidates.district,campaign_logs.candidate_status,campaign_logs.campaign_log_id,campaign_logs.unique_id,campaign_logs.created_on');
	    $this->db->join('campaign_logs', 'campaign_logs.candidate_id = consent_candidates.candidate_id');
		if($campaign_id!='0')
		$this->db->where('campaign_logs.campaign_id', $campaign_id);
		if($start_date!='0')
		$this->db->where('campaign_logs.created_on >=', date(''.$start_date.' 00:00:00'));
		if($end_date!='0')
		$this->db->where('campaign_logs.created_on <=', date(''.$end_date.' 23:59:59'));
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
	   // echo "--->".$this->db->last_query();
	    $result = $query->result();
		/*echo "<pre>";
		print_r($result);
		echo "</pre>";*/
	    foreach ($result as $row) {
		
		 $rowlastalert= $this->get_candidate_last_alert($row->candidate_id);
		 $row->last_sent_datetime= $rowlastalert->sent_datetime;
		}
  		 /*echo "<pre>";
		print_r($result);
		echo "</pre>";*/
	    return $result;

    } //End of View  function
	

	
	function count_campaign_link_date_wise($campaign_id,$start_date,$end_date,$search_by,$search_value) {
			
			$this->db->join('campaign_logs', 'campaign_logs.candidate_id = consent_candidates.candidate_id');
			if($campaign_id!='0')
			$this->db->where('campaign_logs.campaign_id', $campaign_id);
			if($start_date!='0')
			$this->db->where('campaign_logs.created_on >=', date(''.$start_date.' 00:00:00'));
			if($end_date!='0')
			$this->db->where('campaign_logs.created_on <=', date(''.$end_date.' 23:59:59'));
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
	
	
	function get_candidate_last_alert($candidate_id)
		{	
		    $this->db->select('sent_datetime,candidate_id,log_detail_id');
			$this->db->from('mail_sms_log_details');
			$this->db->where('candidate_id',$candidate_id);
			$this->db->where('sent_status ','1');
			$this->db->where('email_subject',NULL);
			$this->db->order_by('sent_datetime', 'DESC');
			$this->db->limit(1);
			$query = $this->db->get();
			//echo $this->db->last_query();
			//echo "<br>";
			// die();
			if($query -> num_rows() == 1)
		    {
			  return $query->row();
		    }
		   else
		    {
			  return '0';
		    }
		
	
		} //End of View function
		
	
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
	
	
	function campaign_link_report_export_to_excel($campaign_id,$start_date,$end_date,$search_by,$search_value)
     {
		$this->db->select('consent_candidates.candidate_id,consent_candidates.application_no,consent_candidates.candidateid,consent_candidates.gender,	consent_candidates.applicant_full_name,consent_candidates.email_id,consent_candidates.mobile_no,consent_candidates.date_of_birth,consent_candidates.state,consent_candidates.city,consent_candidates.district,consent_candidates.consent_status,campaign_logs.candidate_status,campaign_logs.campaign_log_id,campaign_logs.unique_id,campaign_logs.created_on');
	    $this->db->join('campaign_logs', 'campaign_logs.candidate_id = consent_candidates.candidate_id');
		if($campaign_id!='0')
		$this->db->where('campaign_logs.campaign_id', $campaign_id);
		if($start_date!='0')
		$this->db->where('campaign_logs.created_on >=', date(''.$start_date.' 00:00:00'));
		if($end_date!='0')
		$this->db->where('campaign_logs.created_on <=', date(''.$end_date.' 23:59:59'));
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
	 //  echo "--->".$this->db->last_query();
	    $result = $query->result();
		/*echo "<pre>";
		print_r($result);
		echo "</pre>";*/
	    foreach ($result as $row) {
		
		 $rowlastalert= $this->get_candidate_last_alert($row->candidate_id);
		 $row->last_sent_datetime= $rowlastalert->sent_datetime;
		}
  		 /*echo "<pre>";
		print_r($result);
		echo "</pre>";*/
	    return $result;
   
    } //End of View  function
		
	

	
}