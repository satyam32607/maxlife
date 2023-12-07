<?php


class Campaigns_model extends CI_Model
{
		
	 function add()
     {
		 $percentage_json = array(
			array('cancel_percentage'=>$this->input->post('cancel_percentage'), 'congestion_percentage'=>$this->input->post('congestion_percentage'), 'chanunavail_percentage'=>$this->input->post('chanunavail_percentage')),
			);
		 $percentagejson = json_encode($percentage_json);
		 
		$data        = array(
		    'sponser_id'   => '0',
          	'campaign_name'     => $this->input->post("campaign_name"),
			'campaign_type'    => '1',
			'duration'     => $this->input->post("duration"),
			'maximum_calls'   => $this->input->post("maximum_calls"),
			'percentage_json'   => $percentagejson,
			'start_date'   => $this->input->post("start_date"),
			'end_date'     => $this->input->post("end_date"),
			'description'     => $this->input->post("description"),
			'created_by'     => $this->session->userdata('user_id'),
			'created_on'      => date('Y-m-d H:i:s'),
        );
        $result   = $this->db->insert('hotline_campaigns', $data);
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
			$this->db->from('hotline_campaigns');
			$this->db->order_by('start_date', 'DESC');
			$query = $this->db->get();
			//echo $this->db->last_query();
			$result = $query->result();
			foreach ($result as $row) {
				
				$row->total_candidates= $this->countcandidates($row->campaign_id);
			}
		
			return $result;
	
		} //End of View function
		
		function countcandidates($campaign_id)
		{
			$this->db->where('campaign_id', $campaign_id);
			$this->db->from('candidates');
			$query = $this->db->get();
			//echo $this->db->last_query();
			return $query->num_rows();
	
		} //End of Count function
		
		
	  function campaign_edit($campaign_id)
		{
			if ($campaign_id == '') {
				redirect(base_url() . "admin/hotline/campaigns/view");
			}
			$this->db->select('*');
			$this->db->from('hotline_campaigns');
			$this->db->where('campaign_id', $campaign_id);
			$query = $this->db->get();
			return $query->row();
	
		} //End of edit function
	
	
		 function update_campaign($campaign_id)
		 {
			$percentage_json = array(
			array('cancel_percentage'=>$this->input->post('cancel_percentage'), 'congestion_percentage'=>$this->input->post('congestion_percentage'), 'chanunavail_percentage'=>$this->input->post('chanunavail_percentage')),
			);
		 $percentagejson = json_encode($percentage_json);
			$data = array(
				'campaign_name'     => $this->input->post("campaign_name"),
				'duration'     => $this->input->post("duration"),
				'maximum_calls'   => $this->input->post("maximum_calls"),
				'percentage_json'   => $percentagejson,
				'start_date'   => $this->input->post("start_date"),
				'end_date'     => $this->input->post("end_date"),
				'description'     => $this->input->post("description")
			);
			$this->db->where('campaign_id', $campaign_id);
			$result = $this->db->update('hotline_campaigns', $data);
			if ($result)
		    return 1;
			else
			return 0;
			
		 } //End of Update function
		 
	
	
	   function update_data($campaign_id){
		
			$fields = array('campaign_id'=>$campaign_id);
			$camprow = gettableinfo('hotline_campaigns',$fields);
			if($camprow!='0')
			{	
			    $duration = $camprow->duration;
				if($camprow->percentage_json!='')
				{
				 $percentagejson=json_decode($camprow->percentage_json);
				 $cancel_percentage = $percentagejson[0]->cancel_percentage;
				 $congestion_percentage = $percentagejson[0]->congestion_percentage;
				 $chanunavail_percentage = $percentagejson[0]->chanunavail_percentage;
				 
				 $total_percentage = ($cancel_percentage+$congestion_percentage+$chanunavail_percentage);
				}else
				{
				 $cancel_percentage = '';
				 $congestion_percentage = '';
				 $chanunavail_percentage = '';
				}
			$this->db->select('candidates.candidate_id,candidate_call_details.cand_call_detail_id');
			$this->db->from('candidates');
			$this->db->join('candidate_call_details', 'candidate_call_details.candidate_id = candidates.candidate_id');
			$this->db->where('candidate_call_details.candidate_status',NULL);
			$this->db->where('candidate_call_details.campaign_id',$campaign_id);
			$this->db->order_by('candidate_call_details.cand_call_detail_id', 'RANDOM');
			$query = $this->db->get();
			$result = $query->result();
			$total_records = $query->num_rows();
			$balance_percentage = ($total_records*$total_percentage)/100;
			$balance_percentage_data = round($total_records-$balance_percentage);
			
			
		/*	$congestion_balance_percentage = ($total_records*$congestion_percentage)/100;
			$congestion_balance_percentage_data = round($congestion_balance_percentage);
			
			$chanunavail_balance_percentage = ($total_records*$chanunavail_percentage)/100;
			$chanunavail_balance_percentage_data = round($chanunavail_balance_percentage);*/
			
			//echo "------------>".$balance_percentage_data;
			//die();
			$total=0;
			$done=0;
			$error=0;
			foreach ($result as $row) {
					if($total<=$balance_percentage_data)
					{
				     $call_duration=rand(1,$duration);
				     $update_data =array( 
						'call_duration' => $call_duration,
						'call_status' => '1',//Success
						'candidate_status' => '1',
					 );	
					 $this->db->where('cand_call_detail_id', $row->cand_call_detail_id);
					 $result = $this->db->update('candidate_call_details', $update_data);
					 $done++;
					}
					
					
					 $total++;
			   }
			}
		  if($done>0)
		  $this->session->set_flashdata('success_message', 'Total\'s ('.$done.') Records\'s updated successfully.');
		  
		  if($error>0)
		  $this->session->set_flashdata('warning_message', 'There is some error in sending Email.');
		  
		return true;
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
	    $result = $this->db->update('hotline_campaigns', $data);
		if($result)
		  return '1';
		 else 
		 return '0';

    } //End of Update status function
	
	
		
   function view_candidates($campaign_id,$candidate_id,$application_no,$search_by,$search_value,$status,$limit, $start)
    {
		$this->db->select('candidates.*,candidate_call_details.cand_call_detail_id,candidate_call_details.campaign_id,candidate_call_details.candidate_status');
		$this->db->where('candidate_call_details.campaign_id',$campaign_id);
		$this->db->join('candidate_call_details', 'candidates.candidate_id = candidate_call_details.candidate_id');
		if($candidate_id!='0')
		$this->db->where('candidates.candidate_id', $candidate_id);
		if($application_no!='0')
		$this->db->where('candidates.application_no', $application_no);
		if($search_by!='0' && $search_value!='0')
		{  if($search_by=='1') 	
		   $this->db->like('candidates.candidateid', $search_value);
		   elseif($search_by=='2') 	
		   $this->db->like('candidates.mobile_no', $search_value);
		   elseif($search_by=='3') 	
		   $this->db->like('candidates.candidate_name', $search_value);
		}
		if($status!='0')
		{	if($status == 'a')
			{	$status = '1';
			}
			else
			{	$status = '0';
			}
			$this->db->where('candidate_call_details.is_active',$status);
		}	
		$this->db->group_by('candidates.candidate_id'); 
		$this->db->order_by('candidates.candidate_name','ASC');
		if($limit!=null || $start!=null)
		{
			$this->db->limit($limit,$start);
		}	
        $this->db->from('candidates');
        $query = $this->db->get();
	   //echo "--->".$this->db->last_query();
	    $result = $query->result();
		/*echo "<pre>";
		print_r($result);
		echo "</pre>";*/
       
        return $result;

    } //End of View  function
	
	
	
	
	function count_candidates($campaign_id,$candidate_id,$application_no,$search_by,$search_value,$status) {
			
			$this->db->where('candidate_call_details.campaign_id',$campaign_id);
			$this->db->join('candidate_call_details', 'candidates.candidate_id = candidate_call_details.candidate_id');
			if($candidate_id!='0')
			$this->db->where('candidates.candidate_id', $candidate_id);
			if($application_no!='0')
			$this->db->where('candidates.application_no', $application_no);
			if($search_by!='0' && $search_value!='0')
			{  if($search_by=='1') 	
			   $this->db->like('candidates.candidateid', $search_value);
			   elseif($search_by=='2') 	
			   $this->db->like('candidates.mobile_no', $search_value);
			   elseif($search_by=='3') 	
			   $this->db->like('candidates.candidate_name', $search_value);
			}
			if($status!='0')
			{	if($status == 'a')
				{	$status = '1';
				}
				else
				{	$status = '0';
				}
				$this->db->where('candidate_call_details.is_active',$status);
			}	
			$this->db->group_by('candidates.candidate_id'); 
			$query=$this->db->get('candidates');		
			//echo "--------------------->". $this->db->last_query();	   
			return $query->num_rows();
			
		}     //End of Count function
		
		
	 function insert_candidate_data($data) {
        $result = $this->db->insert('candidates', $data);
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
		$campfields = array('candidate_id'=>$candidate_id);
		$camprow = gettableinfo('candidate_call_details',$campfields);
		if($camprow=='0')
		{	
			$data =array(
			  	'campaign_id'=>$campaign_id,
				'candidate_id'=>$candidate_id,
				'created_on'=>date('Y-m-d H:i:s')
			);
			$result = $this->db->insert('candidate_call_details',$data);
		}
		if($result)
		{	return true;
		}
		else
		{	return false;
		}
									
	}
		
	
	

	
}