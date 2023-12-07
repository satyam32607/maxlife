<?php

class Bulk_certificatesmodel extends CI_Model
{
    
	function get_candidate_info($application_no)
		{	
		    $this->db->select('consent_candidates.*,campaign_logs.campaign_log_id');
			$this->db->from('consent_candidates');
			$this->db->join('campaign_logs', 'campaign_logs.candidate_id = consent_candidates.candidate_id');
			$this->db->join('campaigns', 'campaigns.campaign_id = campaign_logs.campaign_id');
			$this->db->where('consent_candidates.application_no',$application_no);
			$this->db->order_by('campaign_logs.campaign_log_id', 'DESC');
			$query = $this->db->get();
			  //echo $this->db->last_query();
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
	
	
}
?>
