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
				$end_date = $camprow->end_date;
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
		   // $this->db->limit(10000);
			$query = $this->db->get();
			$result = $query->result();
			$total_records = $query->num_rows();
			$balance_percentage = ($total_records*$total_percentage)/100;
			$balance_percentage_data = round($total_records-$balance_percentage);
		
		    //Insert New Slot
			$this->db->select('slot_id');
			$this->db->from('campaign_slots');
			$this->db->where('campaign_id',$campaign_id);
			$this->db->order_by('slot_id', 'ASC');
			$slotcheckquery = $this->db->get();
			if($slotcheckquery->num_rows()==0)
			{
				for($i=1; $i<=$duration; $i++)
				{		
					 $slotenddate = date('Y-m-d H:i:s', strtotime($camprow->start_date)+$i);
					 $callduration=rand(1,$duration);
					 if($callduration==$i)
					 $slot_status='1';
					 else
					 $slot_status='0';
						 
					$slot_data = array(
						'campaign_id'     => $campaign_id,
						'slot_status'   => '0',
						'slot_start_date'   => $camprow->start_date,
						'slot_end_date'   => $slotenddate,
						'duration'   => $i,
						'created_on'      => date('Y-m-d H:i:s'),
					);
					/*echo "<pre>";
					print_r($slot_data);
					echo "</pre>";*/
					$slotresult   = $this->db->insert('campaign_slots', $slot_data);
				}
			}
			
			//die();
			$total=0;
			$done=0;
			$error=0;
			foreach ($result as $row) {
					if($total_records<=$balance_percentage_data)
					{
				     $call_duration=rand(1,$duration);
					 if($call_duration==$duration)
					 $slot_status='1';
					 else
					 $slot_status='0';
					 
					$this->db->select('slot_log_id');
					$this->db->from('campaign_slot_logs');
					$this->db->where('campaign_id',$campaign_id);
					$this->db->order_by('slot_log_id', 'ASC');
					$query = $this->db->get();
					$total_records = $query->num_rows();
				   if($total_records >=$camprow->maximum_calls)
				   {
					    $this->db->select('*');
						$this->db->from('campaign_slots');
						$this->db->where('campaign_id',$campaign_id);
						//$this->db->where('duration',$call_duration);
						$this->db->order_by('slot_end_date','ASC');
						$slotlogquery = $this->db->get();
						$slotlogrow = $slotlogquery->row();	
						$slot_start_date = $slotlogrow->slot_end_date;
						
						$sec_diff=rand(1,4);
						$slot_start_date = date('Y-m-d H:i:s', strtotime($slotlogrow->slot_end_date)+$sec_diff);
						$slot_end_date = date('Y-m-d H:i:s', strtotime($slot_start_date)+$call_duration);
						//echo "----2--------->".$slot_start_date;
						//echo "----2--------->".$slot_end_date;
					   // echo "<br>";
				   }
				   else
				   {
						$this->db->select('*');
						$this->db->from('campaign_slots');
						$this->db->where('campaign_id',$campaign_id);
						$this->db->where('duration',$call_duration);
						$this->db->where('slot_status','0');
						$this->db->order_by('slot_start_date','ASC');
						$query = $this->db->get();
						$slot_start_date = $camprow->start_date;
						$slot_end_date = date('Y-m-d H:i:s', strtotime($slot_start_date)+$call_duration);
						//echo "-----1-------->".$slot_start_date;
					    //echo "-----1-------->".$slot_end_date;
					   // echo "<br>";
				   }
				   
				   if($slot_start_date > $end_date)
				   {
					    $this->session->set_flashdata('warning_message', 'Campaign End DateTime is Over. Kindly check Campaign End date time.');
						redirect(base_url() . 'admin/hotline/campaigns/view');	
						exit();
				   }
					//Update Slot End Date
					 $update_data =array( 
						'slot_end_date' => $slot_end_date,
					 );	
				    $this->db->where('slot_id', $call_duration);
					$this->db->where('campaign_id', $campaign_id);
					$result = $this->db->update('campaign_slots', $update_data);
					}
					 $slot_log_data = array(
						'campaign_id'     => $campaign_id,
						'slot_id'     => $call_duration,
						'slot_duration'    => $call_duration,
						'slot_start_date'     => $slot_start_date,
						'slot_end_date'   => $slot_end_date,
						'slot_status'   => $slot_status,
						'created_on'      => date('Y-m-d H:i:s'),
					);
					$slotresult   = $this->db->insert('campaign_slot_logs', $slot_log_data);
			
				    $update_data =array( 
						'call_duration' => $call_duration,
						'call_status' => '1',//Answer
						'start_datetime' => $slot_start_date,
						'end_datetime' => $slot_end_date,
						'candidate_status' => '1',
					 );	
					 $this->db->where('cand_call_detail_id', $row->cand_call_detail_id);
					 $result = $this->db->update('candidate_call_details', $update_data);
					 $done++;
					}
					
						
			/*//Update Cancel records Status
			$cancel_percentage = $percentagejson[0]->cancel_percentage;
			$congestion_percentage = $percentagejson[0]->congestion_percentage;
			$chanunavail_percentage = $percentagejson[0]->chanunavail_percentage;*/
			$this->db->select('candidates.candidate_id,candidate_call_details.cand_call_detail_id');
			$this->db->from('candidates');
			$this->db->join('candidate_call_details', 'candidate_call_details.candidate_id = candidates.candidate_id');
			$this->db->where('candidate_call_details.call_status',NULL);
			$this->db->where('candidate_call_details.campaign_id',$campaign_id);
			$this->db->order_by('candidate_call_details.cand_call_detail_id', 'RANDOM');
			$candquery = $this->db->get();
			$candresult = $candquery->result();
			//echo "--->".$this->db->last_query();
			$cand_total_records = $candquery->num_rows();
			$cancelpercentages = ($cand_total_records*$cancel_percentage)/100;
			$total_cancel_percentage = round($cand_total_records-$cancelpercentages);
			
			$congestionpercentages = ($cand_total_records*$congestion_percentage)/100;
			$total_congestion_percentage = round($cand_total_records-$congestionpercentages);
			
			$chanunavailpercentages = ($cand_total_records*$chanunavail_percentage)/100;
			$total_chanunavail_percentage = round($cand_total_records-$chanunavailpercentages);
		
			/*echo "------cancel_percentage----->".$cancel_percentage;
			echo "-----congestion_percentage----->".$congestion_percentage;
			echo "-----chanunavail_percentage------>".$chanunavail_percentage;*/
			
			//Cancel Update Status
			$updatedata =array( 
				'call_status' => '2',//Cancel
				'start_datetime' => NULL,
				'end_datetime' => NULL,
				'call_duration' => NULL,
				'candidate_status' => NULL
			 );	
			 $this->db->where('call_status','1');
			 $this->db->where('campaign_id',$campaign_id);
			 $this->db->order_by('cand_call_detail_id', 'RANDOM');
			 $this->db->limit($total_cancel_percentage);
			 $result = $this->db->update('candidate_call_details', $updatedata);
			 
			 //Congestion Update Status
			$updatedata =array( 
				'call_status' => '3',//Cancel
				'start_datetime' => NULL,
				'end_datetime' => NULL,
				'call_duration' => NULL,
				'candidate_status' => NULL
			 );	
			 $this->db->where('call_status','1');
			 $this->db->where('campaign_id',$campaign_id);
			 $this->db->order_by('cand_call_detail_id', 'RANDOM');
			 $this->db->limit($total_congestion_percentage);
			 $result = $this->db->update('candidate_call_details', $updatedata);
			 
			 //Chanunavail Update Status
			$updatedata =array( 
				'call_status' => '4',//Chanunavail
				'start_datetime' => NULL,
				'end_datetime' => NULL,
				'call_duration' => NULL,
				'candidate_status' => NULL
			 );	
			 $this->db->where('call_status','1');
			 $this->db->where('campaign_id',$campaign_id);
			 $this->db->order_by('cand_call_detail_id', 'RANDOM');
			 $this->db->limit($total_chanunavail_percentage);
			 $result = $this->db->update('candidate_call_details', $updatedata);
					
					
			$total++;
			}
		  if($done>0)
		  $this->session->set_flashdata('success_message', 'Total\'s ('.$done.') Records\'s updated successfully.');
		  
		  if($error>0)
		  $this->session->set_flashdata('warning_message', 'There is some error in sending Email.');
		  
		return true;
		
	}
	
	
	
	 function update_slot_status($slot_id, $campaign_id)
		{
			$this->db->select('*');
			$this->db->from('campaign_slot_logs');
			$this->db->where('campaign_id',$campaign_id);
			$this->db->where('slot_id',$slot_id);
			$this->db->where('slot_status','0');
			$this->db->order_by('slot_duration','ASC');
			$slotquery = $this->db->get();
			echo "--------2------->". $this->db->last_query();
			if($slotquery->num_rows()==0)
			{
			   $slotrow = $slotquery->row();	
			   $slot_start_date = $slotrow->slot_end_date;
			 
			   $slot_end_date = date('Y-m-d H:i:s', strtotime($slot_start_date)+$call_duration);
			}
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