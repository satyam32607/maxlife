<?php

class Reports_model extends CI_Model
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
		
		
	
	
	function campaign_report_report_export_to_excel($campaign_id)
     {
		$this->db->select('candidate_call_details.call_status,call_status_types.call_status_name');
	    $this->db->join('candidate_call_details', 'candidate_call_details.candidate_id = candidates.candidate_id');
		$this->db->join('call_status_types', 'call_status_types.call_status_id = candidate_call_details.call_status');
		$this->db->where('candidate_call_details.candidate_status', '1');
		if($campaign_id!='0')
		$this->db->where('candidate_call_details.campaign_id', $campaign_id);
	 	$this->db->group_by('candidate_call_details.candidate_id'); 
		$this->db->order_by('candidate_call_details.cand_call_detail_id','RANDOM');
		$this->db->limit('500000','0');
	    $this->db->from('candidates');
        $query = $this->db->get();
	   // echo "--->".$this->db->last_query();
		//die();
	    $result = $query->result();
		/*echo "<pre>";
		print_r($result);
		echo "</pre>";*/
	     return $result;
   
    } //End of View  function
		
	

	
}