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
			'total_data'     => $this->input->post("total_data"),
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
		$districresult = $this->add_campaign_district($this->input->post('group-a'),$campaign_id);
		if($result > 0)
		{
			return $campaign_id;
		 }
		else
			return 0;


    } //End of add function
	
	
		  
		   
	 function add_campaign_district($group_district,$campaign_id){
		 
		foreach($group_district as $rowdist){
			$district_id=$rowdist['district_id'];
			$data_limit=$rowdist['data_limit'];
			if($district_id!='' && $data_limit!='')
			{
				 $this->db->select('campaign_district_id');
				 $this->db->from('campaign_districts');
				 $this->db->where('district_id',$district_id);
				 $checkresult = $this->db->get();
				  if($checkresult->num_rows()==0){
					{
					 $data =array( 
					    'campaign_id'=>$campaign_id,
						'district_id' => $district_id,
						'data_limit '=>$data_limit ,
						'created_on'=>date('Y-m-d H:i:s'),
					 );	
					 $result= $this->db->insert('campaign_districts',$data);	
					}
				  }
				}
			}
	    }
		
		
	function update_campaign_district($group_district,$campaign_id){
		
	    //$this->db->where('campaign_id',$campaign_id); 
	    //$result = $this->db->delete('campaign_districts');
		if($group_district)
		{
	    	foreach($group_district as $rowdist){
			$district_id=$rowdist['district_id'];
			$data_limit=$rowdist['data_limit'];
			if($district_id!='' && $data_limit!='')
			{
				 $this->db->select('campaign_district_id');
				 $this->db->from('campaign_districts');
				 $this->db->where('district_id',$district_id);
				 $checkresult = $this->db->get();
				  if($checkresult->num_rows()==0){
					{
					 $data =array( 
					    'campaign_id'=>$campaign_id,
						'district_id' => $district_id,
						'data_limit '=>$data_limit ,
						'created_on'=>date('Y-m-d H:i:s'),
					 );	
					 $result= $this->db->insert('campaign_districts',$data);	
					}
				  }
				}
			}
	    }
	}
	
	
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
		
		
			
	function get_campaign_districts($campaign_id)
		{
			$this->db->select('district_id,data_limit');
			$this->db->from('campaign_districts');
			$this->db->where('campaign_id',$campaign_id);
			$this->db->where('is_active','1');
			$this->db->order_by('campaign_district_id', 'ASC');
			$query = $this->db->get();
			$result = $query->result();
			//echo $this->db->last_query();
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
				'total_data'     => $this->input->post("total_data"),
				'duration'     => $this->input->post("duration"),
				'maximum_calls'   => $this->input->post("maximum_calls"),
				'percentage_json'   => $percentagejson,
				'start_date'   => $this->input->post("start_date"),
				'end_date'     => $this->input->post("end_date"),
				'description'     => $this->input->post("description")
			);
			$this->db->where('campaign_id', $campaign_id);
			$result = $this->db->update('hotline_campaigns', $data);
			
			$districresult = $this->update_campaign_district($this->input->post('group-a'),$campaign_id);
			if ($result)
		    return 1;
			else
			return 0;
			
		 } //End of Update function
		 
	
	
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
		
				if($campaign_stage>1 && $campaign_stage<=100000)
				{
				 $new_call_duration=rand(50,3600);
				// echo "---------->Stage1";
				}
				elseif($campaign_stage>100000 && $campaign_stage<=200000)
				{
				 $new_call_duration=rand(3620,10500);
				// echo "---------->Stage2";
				}
				elseif($campaign_stage>200000 && $campaign_stage<=300000)
				{
				 $new_call_duration=rand(10600,14300);
				// echo "---------->Stage3";
				}
				elseif($campaign_stage>300000 && $campaign_stage<=400000)
				{
				 $new_call_duration=rand(14500,18000);
				// echo "---------->Stage4";
				}
				elseif($campaign_stage>400000 && $campaign_stage<=500000)
				{
				 $new_call_duration=rand(18100,21600);
				// echo "---------->Stage5";
				}
				elseif($campaign_stage>500000 && $campaign_stage<=600000)
				{
				 $new_call_duration=rand(21800,28600);
				// echo "---------->Stage6";
				}
				elseif($campaign_stage>600000 && $campaign_stage<=700000)
				{
				 $new_call_duration=rand(28800,32750);
				// echo "---------->Stage7";
				}
				elseif($campaign_stage>700000 && $campaign_stage<=800000)
				{
				 $new_call_duration=rand(32860,36000);
				// echo "---------->Stage8";
				}
				elseif($campaign_stage>800000 && $campaign_stage<=900000)
				{
				 $new_call_duration=rand(36100,43000);
				// echo "---------->Stage9";
				}
				/*elseif($campaign_stage>900000 && $campaign_stage<=1000000)
				{
				 $new_call_duration=rand(36100,43000);
				// echo "---------->Stage9";
				}*/
			 
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
	
	
	function reset_data_status($campaign_id)
		{
			$fields = array('campaign_id'=>$campaign_id);
			$camprow = gettableinfo('hotline_campaigns',$fields);
			if($camprow!='0')
			{	
			    $updatesstdata =array( 
				  'candidate_status' => '0',
			     );	
			    $this->db->where('campaign_id',$campaign_id);
			    $updateresult = $this->db->update('candidate_call_details', $updatesstdata);
			}
			if($updateresult)
			  return '1';
			 else 
			 return '0';
	
		} //End of Update status function
		
	
	 function refresh_data_status($campaign_id)
		{
			$fields = array('campaign_id'=>$campaign_id);
			$camprow = gettableinfo('hotline_campaigns',$fields);
			if($camprow!='0')
			{	
			    $updatesstdata =array( 
				  'call_status' => '1',//Answer
				  'candidate_status' => '1',
			     );	
			    $this->db->where('campaign_id',$campaign_id);
				$this->db->where('candidate_status','0');
			    $updateresult = $this->db->update('candidate_call_details', $updatesstdata);
			}
			if($updateresult)
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
			$this->db->where('candidate_status','1');
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
				//'end_datetime' => NULL,
				//'call_duration' => NULL,
		     );	
			 $this->db->where('call_status','1');
			 $this->db->where('campaign_id',$campaign_id);
			 $this->db->order_by('cand_call_detail_id', 'RANDOM');
			 $this->db->limit($total_cancel_percentage);
			 $result = $this->db->update('candidate_call_details', $updatedata);
			 
			 //Congestion Update Status
			$updatedata =array( 
				'call_status' => '3',//Cancel
				//'end_datetime' => NULL,
				//'call_duration' => NULL,
				 );	
			 $this->db->where('call_status','1');
			 $this->db->where('campaign_id',$campaign_id);
			 $this->db->order_by('cand_call_detail_id', 'RANDOM');
			 $this->db->limit($total_congestion_percentage);
			 $result = $this->db->update('candidate_call_details', $updatedata);
			 
			  //Chanunavail Update Status
			$updatedata =array( 
				'call_status' => '4',//Chanunavail
				//'end_datetime' => NULL,
				//'call_duration' => NULL,
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
		
		
		
	 function process_data($campaign_id)
		{
			$fields = array('campaign_id'=>$campaign_id);
			$camprow = gettableinfo('hotline_campaigns',$fields);
			if($camprow!='0')
			{	
			  $total_data = $camprow->total_data;
			//Fetch all Candidates Data
			$this->db->select('campaign_districts.campaign_district_id,campaign_districts.district_id,campaign_districts.data_limit,districts.district_name');
			$this->db->from('campaign_districts');
			$this->db->join('districts','districts.district_id = campaign_districts.district_id');
			$this->db->where('campaign_districts.is_active','1');
			$this->db->where('campaign_districts.update_status','0');
			$this->db->where('campaign_districts.campaign_id',$campaign_id);
			$this->db->order_by('campaign_districts.campaign_district_id', 'ASC');
			$query = $this->db->get();
			//echo $this->db->last_query();
			//die();
			$result = $query->result();
			foreach ($result as $row) {
			
			$district_id = $row->district_id;
			$district_name = $row->district_name;
			$district_data_limit  = $row->data_limit;
				
			$this->db->select('pin_code');
			$this->db->from('pin_codes');
			$this->db->where('district',$district_name);
			$this->db->group_by('pin_code');
			$this->db->order_by('pin_code', 'ASC');
			$result = $this->db->get();
			//echo $this->db->last_query();
			if ($result->num_rows() > 0) {
				$pin_code_ids = array();
				foreach ($result->result_array() as $row) {
					$pin_code_ids[$row['pin_code']] = $row['pin_code'];
				}
			}else
			{
				$pin_code_ids = array();
			}
		    $this->db->select('mobile_data_id,number');
			$this->db->from('mobiledata');
			$this->db->where('update_status','0');
			if(count($pin_code_ids)>0)
			{
			  $this->db->where_in('pincode', $pin_code_ids);
			}
			$this->db->order_by('mobile_data_id', 'ASC');
		    $this->db->limit($district_data_limit);
			$mobiledataquery = $this->db->get();
			$resultmobileddata = $mobiledataquery->result();
			foreach ($resultmobileddata as $mobrow) {
					
			if(strlen($mobrow->number>=10))
			{
			  $data = array(
					'campaign_id'     => $campaign_id,
					'district_id'     => $district_id,
					'mobile_no' => $mobrow->number,
					'created_by' => '0',
					'created_on'      => date('Y-m-d H:i:s'),
				);
			   $insertresult  = $this->db->insert('candidates', $data);
			   if($insertresult)
			   {
				  $statusdata =array( 
					'update_status' =>'1',
					'district' =>$district_name,
				 );	
				 $this->db->where('mobile_data_id',$row->mobile_data_id);
				 $result = $this->db->update('mobiledata', $statusdata);
			   }
			}
	     }
		     //Update campaign districts Column
		 	  $status_data =array( 
				'update_status' =>'1',
			 );	
			 $this->db->where('campaign_district_id',$row->campaign_district_id);
			 $result = $this->db->update('campaign_districts', $status_data);
	    }
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