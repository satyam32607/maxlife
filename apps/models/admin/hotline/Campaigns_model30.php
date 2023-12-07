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
				$row->total_update_candidates= $this->count_update_candidates($row->campaign_id);
				
				if($row->total_candidates==$row->total_update_candidates)
				{
					 $statusdata =array( 
					   'campaign_stage' =>'1',
					 );	
					 $this->db->where('campaign_id',$row->campaign_id);
					 $updateresult = $this->db->update('hotline_campaigns', $statusdata);
				}
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
		
		
		function count_update_candidates($campaign_id)
		{
			$this->db->where('campaign_id', $campaign_id);
			$this->db->where('candidate_status','1');
			$this->db->from('candidate_call_details');
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
		 
	
	
	   function update_data_new($campaign_id){
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
						
		    //Insert New Slot
			$this->db->select('slot_id');
			$this->db->from('campaign_slots');
			$this->db->where('campaign_id',$campaign_id);
			$this->db->order_by('slot_id', 'ASC');
			$slotcheckquery = $this->db->get();
			if($slotcheckquery->num_rows()==0)
			{
				for($i=1; $i<=$camprow->maximum_calls; $i++)
				{		
					 $slotenddate = date('Y-m-d H:i:s', strtotime($camprow->start_date)+$i);
					 $callduration=rand(1,$duration);
					 /*if($callduration==$i)
					 $slot_status='1';
					 else
					 $slot_status='0';*/
						 
					$slot_data = array(
						'campaign_id'     => $campaign_id,
						'slot_status'   => '0',
						'slot_start_date'   => $camprow->start_date,
						'slot_end_date'   => $slotenddate,
						'duration'   => $callduration,
						'created_on'      => date('Y-m-d H:i:s'),
					);
					$slotresult   = $this->db->insert('campaign_slots', $slot_data);
				}
			}
			//die();
	/*		$this->db->select('candidates.candidate_id,candidate_call_details.cand_call_detail_id');
			$this->db->from('candidates');
			$this->db->join('candidate_call_details', 'candidate_call_details.candidate_id = candidates.candidate_id');
			$this->db->where('candidate_call_details.candidate_status',NULL);
			$this->db->where('candidate_call_details.campaign_id',$campaign_id);
			$this->db->order_by('candidate_call_details.cand_call_detail_id', 'ASC');
			$pendingquery = $this->db->get();
			$totalcampaigndata= $pendingquery->num_rows();
			if($totalcampaigndata>0)
			{
			 $pendingresult = $pendingquery->result();*/
			 
			 //$pending=0;
		    // foreach ($pendingresult as $pendingrow) {
			// $pending++;	 
			 		
			//echo $this->db->last_query();	
			
			
			 //At Same time Max Call Generate Records 
			$this->db->select('slot_id,slot_start_date,slot_end_date,duration');
			$this->db->from('campaign_slots');
			$this->db->where('campaign_id',$campaign_id);
			$this->db->where('slot_status','0');
		    $this->db->order_by('slot_id', 'ASC');
			$query = $this->db->get();
			$slotresults = $query->result();
			$slot_total_records = $query->num_rows();
			/*echo "<pre>";
			print_r($slotresults);
			echo "</pre>";*/
			$slot=0;
			foreach ($slotresults as $slotrow) {
			$slot++;
			
		/*	$this->db->where('campaign_id',$campaign_id);
			$this->db->where('candidate_status','1');
		    $this->db->order_by('cand_call_detail_id', 'ASC');
			$query = $this->db->get('candidate_call_details');
			$total_update_records = $query->num_rows();*/
						
			$this->db->select('candidates.candidate_id,candidate_call_details.cand_call_detail_id');
			$this->db->from('candidates');
			$this->db->join('candidate_call_details', 'candidate_call_details.candidate_id = candidates.candidate_id');
			$this->db->where('candidate_call_details.candidate_status',NULL);
			$this->db->where('candidate_call_details.campaign_id',$campaign_id);
			$this->db->order_by('candidate_call_details.cand_call_detail_id', 'RANDOM');
			//echo "****************************************************************";
			//echo "<br>";
			//echo $this->db->last_query();
			//echo "<br>";
		/*/*	if($total_update_records>1000)	
		    $this->db->limit(1000);
			else*/
			$this->db->limit(10);
			$query = $this->db->get();
			$result = $query->result();
			$total_records = $query->num_rows();
			$balance_percentage = ($total_records*$total_percentage)/100;
			$balance_percentage_data = round($total_records-$balance_percentage);
			
			$total=0;
			$done=0;
			$error=0;
			 foreach ($result as $row) {
				    // $call_duration=rand(1,$duration);
					/* if($call_duration==$duration)
					 $slot_status='1';
					 else
					 $slot_status='0';*/
						$call_duration=rand(1,$duration);
						$slot_start_date = $slotrow->slot_start_date;
						$slot_end_date = date('Y-m-d H:i:s', strtotime($slot_start_date)+$call_duration);
						echo "-----".$slot."-------->".$slot_start_date;
					    echo "------------->".$slot_end_date;
						// echo "-----slot-------->".$slot;
					    echo "-----stot_id-------->".$slotrow->slot_id;
						echo "-----cand-------->".$row->cand_call_detail_id;
					    echo "<br>";
				   if($slot_start_date > $end_date)
				   {
					    $this->session->set_flashdata('warning_message', 'Campaign End DateTime is Over. Kindly check Campaign End date time.');
						redirect(base_url() . 'admin/hotline/campaigns/view');	
						exit();
				   }
					//Update Slot End Date
				    $update_data =array( 
						//'call_duration' => $slotrow->duration,
						'call_duration' => $call_duration,
						'call_status' => '1',//Answer
						'start_datetime' => $slot_start_date,
						'end_datetime' => $slot_end_date,
						'candidate_status' => '1',
					 );	
					/*  echo "<pre>";
					  print_r($update_data);
					  echo "</pre>";
					  echo "<br><br>";*/
					 $this->db->where('cand_call_detail_id', $row->cand_call_detail_id);
					 $result = $this->db->update('candidate_call_details', $update_data);
					
					if($slotrow->duration==$duration)
					$slot_status='1';
					else
					$slot_status='0';
					 
					// if($slot>4)
					 //$sec_diff=rand(3,8);
					// else
					// $sec_diff=rand(10,20);
					 
					 //$min=$slotrow->slot_id;
				 	// $max=($slotrow->slot_id+20);
					 //$sec_diff=rand($min,$max);
					 $sec_diff=rand(10,200);
						 
					 $slot_new_start_date = date('Y-m-d H:i:s', strtotime($slot_end_date)+$sec_diff);
					/* echo "-----slot_end_date----->".$slot_end_date;
					  echo "-----sec_diff----->".$sec_diff;
					 echo "-----slot_new_start_date----->".$slot_new_start_date;
					 echo "<br>";*/
					 $slot_new_end_date = date('Y-m-d H:i:s', strtotime($slot_new_start_date)+$slotrow->duration);
					 $update_data =array( 
					    'slot_start_date' => $slot_new_start_date,
						'slot_end_date' => $slot_new_end_date,
						'slot_status' => '1',
					 );	
				    $this->db->where('slot_id', $slotrow->slot_id);
					$this->db->where('campaign_id', $campaign_id);
					$result = $this->db->update('campaign_slots', $update_data);
					
				   $done++;
				   
				    $this->db->select('slot_id,slot_start_date,slot_end_date,duration');
					$this->db->from('campaign_slots');
					$this->db->where('campaign_id',$campaign_id);
					$this->db->where('slot_status','0');
					$this->db->order_by('slot_id', 'ASC');
					$query = $this->db->get();
					if($query -> num_rows() == 0)
					{
						$update_data =array( 
						 'slot_status' => '0',
					   );	
					   $this->db->where('campaign_id', $campaign_id);
					   $result = $this->db->update('campaign_slots', $update_data);
					}
			    }
			  // }
			 //}
		  }
		     $statusdata =array( 
				'campaign_stage' => '1',
		     );	
			 $this->db->where('campaign_id',$campaign_id);
			 $result = $this->db->update('hotline_campaigns', $statusdata);
			
			}
		  if($done>0)
		  $this->session->set_flashdata('success_message', 'Total\'s ('.$done.') Records\'s updated successfully.');
		  
		  if($error>0)
		  $this->session->set_flashdata('warning_message', 'There is some error in sending Email.');
		  
		return true;
		
	}
	
	
	
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
					//if($done<=$balance_percentage_data)
					///{
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
					//}
			}
			
			/*echo "------cancel_percentage----->".$cancel_percentage;
			echo "-----congestion_percentage----->".$congestion_percentage;
			echo "-----chanunavail_percentage------>".$chanunavail_percentage;
			die();*/
			$total_cancel = ($total_records*$cancel_percentage)/100;
			$total_cancel_percentage = round($total_cancel);
			
			$total_congestion = ($total_records*$congestion_percentage)/100;
			$total_congestion_percentage = round($total_congestion);
			
			$total_chanunavail = ($total_records*$chanunavail_percentage)/100;
			$total_chanunavail_percentage = round($total_chanunavail);
		
			/*echo "------total_records----->".$total_records;
			echo "------cancel_percentage----->".$total_cancel_percentage;
			echo "-----congestion_percentage----->".$total_congestion_percentage;
			echo "-----chanunavail_percentage------>".$total_chanunavail_percentage;
			die();*/
			
			
			//Cancel Update Status
			 $updatedata =array( 
				'call_status' => '2',//Cancel
				'end_datetime' => NULL,
				'call_duration' => NULL,
		     );	
			 $this->db->where('call_status','1');
			 $this->db->where('campaign_id',$campaign_id);
			 $this->db->order_by('cand_call_detail_id', 'RANDOM');
			 $this->db->limit($total_cancel_percentage);
			 $result = $this->db->update('candidate_call_details', $updatedata);
			 
			 //Congestion Update Status
			$updatedata =array( 
				'call_status' => '3',//Cancel
				'end_datetime' => NULL,
				'call_duration' => NULL,
				 );	
			 $this->db->where('call_status','1');
			 $this->db->where('campaign_id',$campaign_id);
			 $this->db->order_by('cand_call_detail_id', 'RANDOM');
			 $this->db->limit($total_congestion_percentage);
			 $result = $this->db->update('candidate_call_details', $updatedata);
			 
			  //Chanunavail Update Status
			$updatedata =array( 
				'call_status' => '4',//Chanunavail
				'end_datetime' => NULL,
				'call_duration' => NULL,
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

	
	
	 function update_call_status($campaign_id)
		{
			$fields = array('campaign_id'=>$campaign_id);
			$camprow = gettableinfo('hotline_campaigns',$fields);
			if($camprow!='0')
			{	
			   $duration = $camprow->duration;
			   $start_date = $camprow->start_date;
			   $end_date = $camprow->end_date; 
			   $campaign_stage = $camprow->campaign_stage; 
			//Fetch all Candidates Data
			$this->db->select('candidates.candidate_id');
			$this->db->from('candidates');
			$this->db->where('update_status','0');
			$this->db->where('campaign_id',$campaign_id);
			$this->db->order_by('candidate_id', 'ASC');
			$this->db->limit(70000);
			$query = $this->db->get();
			$result = $query->result();
			$total=0;
			foreach ($result as $row) {
			$total++;	
			
		    $this->db->select('cand_call_detail_id');
			$this->db->from('candidate_call_details');
			$this->db->where('candidate_status','1');
			$this->db->where('campaign_id',$campaign_id);
			$this->db->order_by('cand_call_detail_id', 'ASC');
			$countquery = $this->db->get();
			$total_update_records = $countquery->num_rows();
			//echo "---------->".$total_update_records;
			//echo "----------->".$camprow->maximum_calls;
			//echo "<br>";
		  if($total_update_records <$camprow->maximum_calls)
		    {
				$call_duration=rand(1,$duration);
				$slot_start_date = $camprow->start_date;
				$slot_end_date = date('Y-m-d H:i:s', strtotime($slot_start_date)+$call_duration);
				//echo "------1------>".$slot_start_date;
				//echo "------1------->".$slot_end_date;
				//echo "<br>";
				//echo "------total-1----->".$total;
				//echo "------duration--1---->".$call_duration;
				//echo "<br>";
			}else
			{
				$call_duration=rand(1,$duration);
				$slot_start_date = $camprow->start_date;
		
				if($campaign_stage>1 && $campaign_stage<=10000)
				{
				 $new_call_duration=rand(50,3600);
				// echo "---------->Stage1";
				}
				elseif($campaign_stage>10000 && $campaign_stage<=20000)
				{
				 $new_call_duration=rand(3620,7000);
				// echo "---------->Stage2";
				}
				elseif($campaign_stage>20000 && $campaign_stage<=30000)
				{
				 $new_call_duration=rand(7200,10500);
				// echo "---------->Stage3";
				}
				elseif($campaign_stage>30000 && $campaign_stage<=40000)
				{
				 $new_call_duration=rand(10600,14300);
				// echo "---------->Stage4";
				}
				elseif($campaign_stage>40000 && $campaign_stage<=50000)
				{
				 $new_call_duration=rand(14500,18000);
				// echo "---------->Stage5";
				}
				elseif($campaign_stage>50000 && $campaign_stage<=60000)
				{
				 $new_call_duration=rand(18100,21600);
				// echo "---------->Stage6";
				}
				elseif($campaign_stage>60000 && $campaign_stage<=60000)
				{
				 $new_call_duration=rand(21800,28600);
				// echo "---------->Stage7";
				}
				elseif($campaign_stage>60000 && $campaign_stage<=70000)
				{
				 $new_call_duration=rand(28800,32750);
				// echo "---------->Stage8";
				}
				elseif($campaign_stage>80000 && $campaign_stage<=90000)
				{
				 $new_call_duration=rand(32860,36000);
				// echo "---------->Stage9";
				}
				elseif($campaign_stage>90000 && $campaign_stage<=100000)
				{
				 $new_call_duration=rand(36100,42000);
				// echo "---------->Stage9";
				}
				
				/*if(($total%5000)==0)//Every 10k records sleep query with 1 min then continue 
				{
					sleep(20);
				}	*/
			  
				//$new_duration = ($new_call_duration+rand(20,50));
				//echo "------total----2-->".$total;
				//echo "------duration--2---->".$new_call_duration;
			//	echo "-------duration2------>".$new_duration;
				//echo "<br>";
				$slot_start_date = date('Y-m-d H:i:s', strtotime($slot_start_date)+$new_call_duration);
				$slot_end_date = date('Y-m-d H:i:s', strtotime($slot_start_date)+$call_duration);
				//echo "------2------>".$slot_start_date;
				//echo "-------2------>".$slot_end_date;
				//echo "<br>";
			}
				$data = array(
				'campaign_id'     => $campaign_id,
				'candidate_id'    => $row->candidate_id,
				'call_duration' => $call_duration,
				'call_status' => '1',//Answer
				'start_datetime' => $slot_start_date,
				'end_datetime' => $slot_end_date,
				'candidate_status' => '1',
				'created_on'      => date('Y-m-d H:i:s'),
        	);
           $insertresult  = $this->db->insert('candidate_call_details', $data);
		   if($insertresult)
		   {
			  $statusdata =array( 
				'update_status' =>'1',
		     );	
			 $this->db->where('candidate_id',$row->candidate_id);
			 $result = $this->db->update('candidates', $statusdata);
		   }
		   $this->db->select('campaign_stage');
		   $this->db->from('hotline_campaigns');
		   $this->db->where('campaign_id', $campaign_id);
		   $this->db->order_by('campaign_id', 'DESC');
		   $this->db->limit(1);
		   $stagequery = $this->db->get();
		   if($stagequery -> num_rows() >0)
		   {    $campstagerow = $stagequery->row();
			    $campaign_stage = ($campstagerow->campaign_stage+1);
		   }else
		   {
			    $campaign_stage = 1;
		   }
			$statusdata =array( 
				'campaign_stage' =>$campaign_stage,
		     );	
			 $this->db->where('campaign_id',$campaign_id);
			 $result = $this->db->update('hotline_campaigns', $statusdata);
		    }
		  
			}
			
			 if($total>0)
		     $this->session->set_flashdata('success_message', 'Total\'s ('.$total.') Records\'s updated successfully.');
			
			if($result)
			  return '1';
			 else 
			 return '0';
	
		} //End of Update status function   
	
	
	 function update_data_status($campaign_id)
		{
			$fields = array('campaign_id'=>$campaign_id);
			$camprow = gettableinfo('hotline_campaigns',$fields);
			if($camprow!='0')
			{	
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
			$this->db->select('cand_call_detail_id');
			$this->db->from('candidate_call_details');
			$this->db->where('campaign_id',$campaign_id);
			$this->db->order_by('cand_call_detail_id', 'ASC');
			$query = $this->db->get();
			$total_records = $query->num_rows();
			
			$total_cancel = ($total_records*$cancel_percentage)/100;
			$total_cancel_percentage = round($total_cancel);
			
			$total_congestion = ($total_records*$congestion_percentage)/100;
			$total_congestion_percentage = round($total_congestion);
			
			$total_chanunavail = ($total_records*$chanunavail_percentage)/100;
			$total_chanunavail_percentage = round($total_chanunavail);
		
			/*echo "------total_records----->".$total_records;
			echo "------cancel_percentage----->".$total_cancel_percentage;
			echo "-----congestion_percentage----->".$total_congestion_percentage;
			echo "-----chanunavail_percentage------>".$total_chanunavail_percentage;
			die();*/
			
			
			//Cancel Update Status
			 $updatedata =array( 
				'call_status' => '2',//Cancel
				'end_datetime' => NULL,
				'call_duration' => NULL,
		     );	
			 $this->db->where('call_status','1');
			 $this->db->where('campaign_id',$campaign_id);
			 $this->db->order_by('cand_call_detail_id', 'RANDOM');
			 $this->db->limit($total_cancel_percentage);
			 $result = $this->db->update('candidate_call_details', $updatedata);
			 
			 //Congestion Update Status
			$updatedata =array( 
				'call_status' => '3',//Cancel
				'end_datetime' => NULL,
				'call_duration' => NULL,
				 );	
			 $this->db->where('call_status','1');
			 $this->db->where('campaign_id',$campaign_id);
			 $this->db->order_by('cand_call_detail_id', 'RANDOM');
			 $this->db->limit($total_congestion_percentage);
			 $result = $this->db->update('candidate_call_details', $updatedata);
			 
			  //Chanunavail Update Status
			$updatedata =array( 
				'call_status' => '4',//Chanunavail
				'end_datetime' => NULL,
				'call_duration' => NULL,
			 );	
			 $this->db->where('call_status','1');
			 $this->db->where('campaign_id',$campaign_id);
			 $this->db->order_by('cand_call_detail_id', 'RANDOM');
			 $this->db->limit($total_chanunavail_percentage);
			 $result = $this->db->update('candidate_call_details', $updatedata);
			 
			 $statusdata =array( 
				'campaign_stage' =>'2',
		     );	
			 $this->db->where('campaign_id',$campaign_id);
			 $result = $this->db->update('hotline_campaigns', $statusdata);
			}
			if($result)
			  return '1';
			 else 
			 return '0';
	
		} //End of Update status function
		
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