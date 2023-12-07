<?php 
class V_model extends CI_Model
{
	 
	function get_campaign_verify($unique_id)
		 {
		   $this->db->select('campaigns.*,campaign_logs.campaign_log_id,campaign_logs.candidate_id,campaign_logs.candidate_status');
		   $this->db->from('campaigns');
		   $this->db->join('campaign_logs', 'campaign_logs.campaign_id = campaigns.campaign_id');
		   $this->db->where('campaign_logs.unique_id', $unique_id);
		   $this->db->order_by('campaign_logs.campaign_log_id', 'DESC');
		   $this->db->limit(1);
		   $query = $this->db->get();
		   //echo $this->db->last_query();
		  // die();
		  if($query -> num_rows() == 1)
		   {    $row = $query->row();	
				//print_r($row);
			 	//die();
			  	$this->load->library('user_agent');
				if ($this->agent->is_browser())
				{		$agent = $this->agent->browser().' '.$this->agent->version();
				}
				elseif ($this->agent->is_robot())
				{		$agent = $this->agent->robot();
				}
				elseif ($this->agent->is_mobile())
				{		$agent = $this->agent->mobile();
				}
				else
				{		$agent = 'Unidentified User Agent';
				}
			  if($row->candidate_status=='3')
			  {
				  return '1'; //Candidate Campaign Already updated.
			  }	
			  elseif($row->is_active=='0')
			  {
				  return '2';
			  }
		     elseif($row->end_date !='0000-00-00' && $row->end_date <= date('Y-m-d'))
			  { 
			  	 return '3';  //Campaign Validity has been expired.
		 	  }
		    else
			 { 
			    // print_r($row);
				// print_r($query->row());
				 
				 //unset session values
			    $this->session->unset_userdata('camp_log_id');
				$this->session->unset_userdata('camp_id');
				$this->session->unset_userdata('cand_id');
				$this->session->unset_userdata('sponser_id');
				$this->session->unset_userdata('campaign_type');
				$this->session->unset_userdata('common_message');
				//Set the basic values into the session
				$this->session->set_userdata('camp_log_id', $row->campaign_log_id);
				$this->session->set_userdata('camp_id', $row->campaign_id);
				$this->session->set_userdata('cand_id', $row->candidate_id);
				$this->session->set_userdata('sponser_id', $row->sponser_id);
				
				//Insert Campaign Log sessions
				 $data = array(
				 'session_id'=>session_id(),
				 'candidate_id'=>$this->session->userdata('cand_id'),
				 'login_time'=>date('Y-m-d H:i:s'),
				 'logout_time'=>date('Y-m-d H:i:s'),
				 'IP_address'=>$_SERVER['REMOTE_ADDR'],
				 'user_agent'=>$agent,				 
				 );
				 $result = $this->db->insert('campaign_log_sessions',$data);
				
				 return $query->row();//Campaign verify successfully.
			 }
			}
		   else
		   {
			 return '0'; //Invalid Campaign ID
		   }
		 }  //End of Campaign function
		 
}
?>
