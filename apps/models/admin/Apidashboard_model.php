<?php

class Apidashboard_model extends CI_Model
{
	
	 function daily_log_consolidated() {
			
			 $this->dw=$this->load->database('dw_db', TRUE); 
			 $sql = "SELECT sponser_id,DATE_FORMAT( `service_call_date` , GET_FORMAT( DATE, 'ISO' ) ) AS 
dt , count( * ) AS total FROM `api_logger` where sponser_id='53' and  service_name='training/registration/create_user_account' GROUP BY DATE_FORMAT( `service_call_date` , GET_FORMAT( DATE, 'ISO' ) )  order by `service_call_date` desc "; 
		    $query = $this->dw->query($sql);
			//echo $this->dw->last_query();
			 $result = $query->result();
			 return $result;
		}     //End of Count function
		
		
		 function posp_daily_log_consolidated() {
			
			 $this->posp=$this->load->database('posp_db', TRUE); 
			 $sql = "SELECT sponser_id,DATE_FORMAT( `service_call_date` , GET_FORMAT( DATE, 'ISO' ) ) AS 
dt , count( * ) AS total FROM `api_logger` GROUP BY DATE_FORMAT( `service_call_date` , GET_FORMAT( DATE, 'ISO' ) )  order by `service_call_date` desc "; 
		    $query = $this->posp->query($sql);
			//echo $this->dw->last_query();
			 $result = $query->result();
			 return $result;
		}     //End of Count function
		
		
		
		
   function view_log_date_wise($sponser_id,$start_date,$end_date,$search_by,$search_value,$limit, $start)
     {
		$this->dw=$this->load->database('dw_db', TRUE); 
		$this->dw->select('sponsers.sponser_name,api_logger.*');
	    $this->dw->join('sponsers', 'sponsers.sponser_id = api_logger.sponser_id');
		$this->dw->where('api_logger.service_name','training/registration/create_user_account');
		if($sponser_id!='0')
		$this->dw->where('api_logger.sponser_id', $sponser_id);
		if($start_date!='0')
		$this->dw->where('api_logger.service_call_date >=', date(''.$start_date.' 00:00:00'));
		if($end_date!='0')
		$this->dw->where('api_logger.service_call_date <=', date(''.$end_date.' 23:59:59'));
	 if($search_by!='0' && $search_value!='0')
		{
		   /*if($search_by=='1') 	
		   $this->dw->where('consent_candidates.application_no', $search_value);
		   elseif($search_by=='2') 	
		   $this->dw->where('consent_candidates.candidateid', $search_value);
		   elseif($search_by=='3') 	
		   $this->dw->like('consent_candidates.mobile_no', $search_value);
		   elseif($search_by=='4') 	
		   $this->dw->like('consent_candidates.applicant_full_name', $search_value);*/
		}
		$this->dw->group_by('api_logger.request_id'); 
		$this->dw->order_by('api_logger.request_id','DESC');
		if($limit!=null || $start!=null)
		{
			$this->dw->limit($limit,$start);
		}	
        $this->dw->from('api_logger');
        $query = $this->dw->get();
	  // echo "--->".$this->dw->last_query();
	    $result = $query->result();
		/*echo "<pre>";
		print_r($result);
		echo "</pre>";*/
       
        return $result;

    } //End of View  function
	

	
	function count_log_date_wise($sponser_id,$start_date,$end_date,$search_by,$search_value) {
			
			$this->dw=$this->load->database('dw_db', TRUE); 
		    $this->dw->join('sponsers', 'sponsers.sponser_id = api_logger.sponser_id');
			if($sponser_id!='0')
			$this->dw->where('api_logger.sponser_id', $sponser_id);
			if($start_date!='0')
			$this->dw->where('api_logger.service_call_date >=', date(''.$start_date.' 00:00:00'));
			if($end_date!='0')
			$this->dw->where('api_logger.service_call_date <=', date(''.$end_date.' 23:59:59'));
			if($search_by!='0' && $search_value!='0')
			{
			   /*if($search_by=='1') 	
			   $this->dw->where('consent_candidates.application_no', $search_value);
			   elseif($search_by=='2') 	
			   $this->dw->where('consent_candidates.candidateid', $search_value);
			   elseif($search_by=='3') 	
			   $this->dw->like('consent_candidates.mobile_no', $search_value);
			   elseif($search_by=='4') 	
			   $this->dw->like('consent_candidates.applicant_full_name', $search_value);*/
			}
			$this->dw->group_by('api_logger.request_id'); 
			$query=$this->dw->get('api_logger');		
			//echo "--------------------->". $this->dw->last_query();	   
			return $query->num_rows();
			
		}     //End of Count function
		
		
		
	function view_posp_log_date_wise($sponser_id,$start_date,$end_date,$search_by,$search_value,$limit, $start)
     {
		$this->posp=$this->load->database('posp_db', TRUE); 
		$this->posp->select('sponsers.sponser_name,api_logger.*');
	    $this->posp->join('sponsers', 'sponsers.sponser_id = api_logger.sponser_id');
		if($sponser_id!='0')
		$this->posp->where('api_logger.sponser_id', $sponser_id);
		if($start_date!='0')
		$this->posp->where('api_logger.service_call_date >=', date(''.$start_date.' 00:00:00'));
		if($end_date!='0')
		$this->posp->where('api_logger.service_call_date <=', date(''.$end_date.' 23:59:59'));
	  if($search_by!='0' && $search_value!='0')
		{
		   /*if($search_by=='1') 	
		   $this->dw->where('consent_candidates.application_no', $search_value);
		   elseif($search_by=='2') 	
		   $this->dw->where('consent_candidates.candidateid', $search_value);
		   elseif($search_by=='3') 	
		   $this->dw->like('consent_candidates.mobile_no', $search_value);
		   elseif($search_by=='4') 	
		   $this->dw->like('consent_candidates.applicant_full_name', $search_value);*/
		}
		$this->posp->group_by('api_logger.request_id'); 
		$this->posp->order_by('api_logger.request_id','DESC');
		if($limit!=null || $start!=null)
		{
			$this->posp->limit($limit,$start);
		}	
        $this->posp->from('api_logger');
        $query = $this->posp->get();
	  // echo "--->".$this->dw->last_query();
	    $result = $query->result();
		/*echo "<pre>";
		print_r($result);
		echo "</pre>";*/
       
        return $result;

    } //End of View  function
	

	
	function count_posp_log_date_wise($sponser_id,$start_date,$end_date,$search_by,$search_value) {
			$this->posp=$this->load->database('posp_db', TRUE); 
		    $this->posp->join('sponsers', 'sponsers.sponser_id = api_logger.sponser_id');
			if($sponser_id!='0')
			$this->posp->where('api_logger.sponser_id', $sponser_id);
			if($start_date!='0')
			$this->posp->where('api_logger.service_call_date >=', date(''.$start_date.' 00:00:00'));
			if($end_date!='0')
			$this->posp->where('api_logger.service_call_date <=', date(''.$end_date.' 23:59:59'));
			if($search_by!='0' && $search_value!='0')
			{
			   /*if($search_by=='1') 	
			   $this->dw->where('consent_candidates.application_no', $search_value);
			   elseif($search_by=='2') 	
			   $this->dw->where('consent_candidates.candidateid', $search_value);
			   elseif($search_by=='3') 	
			   $this->dw->like('consent_candidates.mobile_no', $search_value);
			   elseif($search_by=='4') 	
			   $this->dw->like('consent_candidates.applicant_full_name', $search_value);*/
			}
			$this->posp->group_by('api_logger.request_id'); 
			$query=$this->posp->get('api_logger');		
			//echo "--------------------->". $this->dw->last_query();	   
			return $query->num_rows();
			
		}     //End of Count function


	
}