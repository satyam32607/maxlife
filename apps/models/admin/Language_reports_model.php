<?php

class Language_reports_model extends CI_Model
{

    function view_languages()
		{
			$this->dw=$this->load->database('dw_db', TRUE); 
			$this->dw->select('*');
			$this->dw->from('languages');
			$this->dw->where('is_active','1');
			$this->dw->order_by('language_id', 'ASC');
			$query = $this->dw->get();
			$result = $query->result();
			return $result;
	
		} //End of View function
		
	function view_language_date_wise($batch_id,$start_date,$end_date,$search_by,$search_value,$limit, $start)
     {
	    $this->dw=$this->load->database('dw_db', TRUE); 
		$this->dw->select('batches.batch_name,batches.batch_end_date, batches.batch_start_date, batches.batch_start_date, batches.course_id, candidates.candidate_id, candidates.candidate_login_id, candidates.candidate_name, candidates.candidate_mobile, candidates.candidate_email, candidate_registered_on, candidates.course_start_date,candidates.course_complete, candidates.course_finish_date, candidates.application_no, candidates.candidate_date_of_birth');
	    $this->dw->join('sponsers', 'sponsers.sponser_id = batches.sponser_id');
		$this->dw->join('candidates', 'candidates.batch_id = batches.batch_id');
		$this->dw->where('batches.sponser_id','53');
		$this->dw->where('candidates.course_complete','1');
		if($batch_id!='0')
		$this->dw->where('batches.batch_id', $batch_id);
		if($start_date!='0')
		$this->dw->where('batches.batch_start_date >=',$start_date);
		if($end_date!='0')
		$this->dw->where('batches.batch_start_date <=', $end_date);
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
		$this->dw->group_by('candidates.candidate_id'); 
		$this->dw->order_by('candidates.candidate_id','ASC');
		
		if($limit!=null || $start!=null)
		{
			$this->dw->limit($limit,$start);
		}
        $this->dw->from('batches');
        $query = $this->dw->get();
	  //echo "--->".$this->dw->last_query();
	    $result = $query->result();
		
  		 /*echo "<pre>";
		print_r($result);
		echo "</pre>";*/
	    return $result;
		
		/*echo "<pre>";
		print_r($result);
		echo "</pre>";*/
       
      //  return $result;

    } //End of View  function
	

	
	function count_language_date_wise($batch_id,$start_date,$end_date,$search_by,$search_value) {
			
			$this->dw=$this->load->database('dw_db', TRUE); 
			$this->dw->join('sponsers', 'sponsers.sponser_id = batches.sponser_id');
			$this->dw->join('candidates', 'candidates.batch_id = batches.batch_id');
			$this->dw->where('batches.sponser_id','53');
			$this->dw->where('candidates.course_complete','1');
			if($batch_id!='0')
			$this->dw->where('batches.batch_id', $batch_id);
			if($start_date!='0')
			$this->dw->where('batches.batch_start_date >=',$start_date);
			if($end_date!='0')
		 	$this->dw->where('batches.batch_start_date <=', $end_date);
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
			$this->dw->group_by('candidates.candidate_id'); 
			$this->dw->order_by('candidates.candidate_id','ASC'); 
			$query=$this->dw->get('batches');		
			//echo "--------------------->". $this->dw->last_query();	   
			return $query->num_rows();
			
		}     //End of Count function
		

	
	
	function language_report_export_to_excel($batch_id,$start_date,$end_date,$search_by,$search_value)
     {
		$this->dw=$this->load->database('dw_db', TRUE); 
		$this->dw->select('batches.batch_name,batches.batch_end_date, batches.batch_start_date, batches.batch_start_date, batches.course_id, candidates.candidate_id, candidates.candidate_login_id, candidates.candidate_name, candidates.candidate_mobile, candidates.candidate_email, candidate_registered_on, candidates.course_start_date,candidates.course_complete, candidates.course_finish_date, candidates.application_no, candidates.candidate_date_of_birth');
	    $this->dw->join('sponsers', 'sponsers.sponser_id = batches.sponser_id');
		$this->dw->join('candidates', 'candidates.batch_id = batches.batch_id');
		$this->dw->where('batches.sponser_id','53');
		$this->dw->where('candidates.course_complete','1');
		if($batch_id!='0')
		$this->dw->where('batches.batch_id', $batch_id);
		if($start_date!='0')
		$this->dw->where('batches.batch_start_date >=',$start_date);
		if($end_date!='0')
		$this->dw->where('batches.batch_start_date <=', $end_date);
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
		$this->dw->group_by('candidates.candidate_id'); 
		$this->dw->order_by('candidates.candidate_id','ASC');
        $query = $this->dw->get('batches');
	 //  echo "--->".$this->db->last_query();
	    $result = $query->result();
		
  		 /*echo "<pre>";
		print_r($result);
		echo "</pre>";*/
	    return $result;
   
    } //End of View  function
		
	
	
	function chaps_languages($candidate_id, $course_id, $language_id)
	{
		$this->dw=$this->load->database('dw_db', TRUE); 
		
		$this->dw->select('chapter_id');
		$this->dw->from('log_chapter');
		$this->dw->where('candidate_id',$candidate_id);
		$this->dw->where('chapter_complete','1');
		$query = $this->dw->get();
		$chapterdata = $query->result_array();
		if($query->num_rows()>0){
			$chaps = array();
			$count_eng=0;
	        $count_hindi=0;
			foreach($chapterdata as $skey=>$chaprow){
				
				 $count_eng++;
				
				 $this->dw->select('*');
				 $this->dw->from('log_chapter_languages');
				 $this->dw->where('chapter_id',$chaprow['chapter_id']);
				 $this->dw->where('candidate_id',$candidate_id);
				 $this->dw->where('language_id','2');
				 $this->db->group_by('log_chapter_languages.chapter_id'); 
				 $this->db->order_by('log_chapter_languages.language_id','DESC');
				 $query = $this->dw->get();
				// echo $this->dw->last_query();
				 // echo "<br><br>";
				  if($query ->num_rows() > 0)
				   {	
					  $count_hindi++;
					  $count_eng--;
				  }
				  }

			}
		
		return  $count_eng.'|||'.$count_hindi;
	
	}
		


	
}