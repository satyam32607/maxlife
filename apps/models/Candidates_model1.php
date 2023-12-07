<?php

class Candidates_model extends CI_Model
{
	
	function verify_candidate_dob()
		{	
		    $date_of_birth = $this->input->post("date_of_birth");
		    $dateofbirth = explode("/", $date_of_birth);
			$dob = $dateofbirth[2].'-'.$dateofbirth[1].'-'.$dateofbirth[0];
			$this->db->select('consent_candidates.*,campaign_logs.campaign_log_id');
			$this->db->from('consent_candidates');
			$this->db->join('campaign_logs', 'campaign_logs.candidate_id = consent_candidates.candidate_id');
			$this->db->join('campaigns', 'campaigns.campaign_id = campaign_logs.campaign_id');
			$this->db->where('campaign_logs.campaign_log_id',$this->session->userdata('camp_log_id'));
			$this->db->where('consent_candidates.candidate_id',$this->session->userdata('cand_id'));
			$this->db->where('consent_candidates.date_of_birth',$dob);
			$this->db->order_by('campaign_logs.campaign_log_id', 'DESC');
			$query = $this->db->get();
			//echo $this->db->last_query();
			 //die();
			if($query -> num_rows() == 1)
		    {
			  $resultstatus = $this->update_status('2');
			 return $query->row();
		    }
		   else
		    {
			 return '0';
		    }
		
	
		} //End of View function
		
	  function get_candidate_info()
		{	
		    $this->db->select('consent_candidates.*,campaign_logs.campaign_log_id');
			$this->db->from('consent_candidates');
			$this->db->join('campaign_logs', 'campaign_logs.candidate_id = consent_candidates.candidate_id');
			$this->db->join('campaigns', 'campaigns.campaign_id = campaign_logs.campaign_id');
			$this->db->where('campaign_logs.campaign_log_id',$this->session->userdata('camp_log_id'));
			$this->db->where('consent_candidates.candidate_id',$this->session->userdata('cand_id'));
			$this->db->order_by('campaign_logs.campaign_log_id', 'DESC');
			$query = $this->db->get();
			  //echo $this->db->last_query();
			// die();
			if($query -> num_rows() == 1)
		    {
			  $resultstatus = $this->update_status('1');
			 return $query->row();
		    }
		   else
		    {
			 return '0';
		    }
		
	
		} //End of View function
		
		
		
	 function update_status($candidate_status)
      {
		$data = array(
				'candidate_status' => $candidate_status,
				'modified_on' =>date('Y-m-d H:i:s')
			);
		 
      	$this->db->where('campaign_log_id',$this->session->userdata('camp_log_id'));
		$this->db->where('candidate_id',$this->session->userdata('cand_id'));
        $result = $this->db->update('campaign_logs', $data);
		if($result)
		  return '1';
		 else 
		 return '0';

     } //End of Update status function
	 
	 
	 function mobile_otp($mobile,$otp){
		$this->db->where('consent_status','3');
		$this->db->where('mobile_no',$mobile);
		$query = $this->db->get('consent_candidates');
		$count=$query->num_rows();
		if($count==0){
			$data_update=array('use_status'=>'1');
			$this->db->where('mobile_no',$mobile);
			$this->db->update('mobile_otp',$data_update);
			 $data        = array(
				'mobile_no'         => $mobile,
				'otp'     => $otp,
				'post_date'      => date('Y-m-d H:i:s'), 
			);
			$result   = $this->db->insert('mobile_otp', $data);
			if($result){
				return '1';
			}else{
				return '0';
			}
		}else{
			return '2';
		}
	}
	
	function check_otp($mobile,$otp){
		 $this->db->where('mobile_no',$mobile);
		 $this->db->where('use_status','0');
		 $this->db->order_by('mob_otp_id','DESC');
		 $this->db->limit('1');
		 $query = $this->db->get('mobile_otp');	
		 $result=$query->num_rows();
		 if($result>0){
			 return $query->row();
		 }else{
			 return false;
		 }
	}
	
	function expire_otp($mobile){
		$data_update=array('use_status'=>'1');
		$this->db->where('mobile_no',$mobile);
		$this->db->update('mobile_otp',$data_update);
	}
	
	function verfiy_mobile_otp($mobile_no,$otp){
		 $this->db->where('mobile_no',$mobile);
		 $this->db->where('otp',$otp);
		 $this->db->where('use_status','0');
		 $this->db->limit('1');
		 $this->db->order_by('mob_otp_id','DESC');
		 $query = $this->db->get('mobile_otp');	
		 $result=$query->num_rows();
		 if($result>0){
			 return true;
		 }else{
			 return false;
		 }
	}
	
	
	
}