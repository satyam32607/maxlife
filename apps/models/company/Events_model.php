<?php

class Events_model extends CI_Model
{
	 function add()
     {
		$taskbarId		=	getFooterTaskBar();
	    $data        = array(
			'event_name'   => $this->input->post("event_name"),
			'event_type'   => $this->input->post("event_type"),
			'event_master_id'   => $this->input->post("event_master_id"),
			'template_id'   => $this->input->post("template_id"),
			'company_id'   => $this->session->userdata('user_id'),
			'batch_id'   => $this->input->post("batch_id"),
			'vendor_id'   => $this->input->post("vendor_id"),
			'event_title'   => $this->input->post("event_title"),
			'event_date'   => $this->input->post("event_date"),
			'event_header_text'   => $this->input->post("event_header_text"),
			'slot_id'   => $this->input->post("slot_id"),
		 	'created_by'   =>$this->session->userdata('user_id'),
			'created_on'      => date('Y-m-d H:i:s'),
			'taskbar_footer'	=>	$taskbarId
        );
		$firstTemplateId	=	$this->getCustomVendorDetails($this->input->post("vendor_id"));
        $result   = $this->db->insert('events', $data);
		$event_id  = $this->db->insert_id();
		if($result > 0)
		{
			if($this->input->post("slot_id"))
			{
			$slot_id = $this->input->post("slot_id");

			$this->db->select('*');
			$this->db->where('is_active', '1');
			$this->db->where('slot_id',$slot_id);
			$this->db->from('event_slots');
			$queryslot = $this->db->get();
		   // echo "--->".$this->db->last_query();
			$resultslot = $queryslot->result();
			$agendas		=	['Welcome note','What is financial underwriting','Understanding of HLV, standard income
			proof, premium paying capacity','Question and Answer','Closing note'];
			foreach ($resultslot as $key=> $row) {

				$this->db->select('event_session_id');
				$this->db->from('event_sessions');
				$this->db->where('start_time',$row->slot_start_time);
				$this->db->where('event_id',$event_id);
				$event_result = $this->db->get();
				if($event_result->num_rows() == 0)
				{  
				//   $session_data =array( 
				// 	'event_id'  =>  $event_id,
				// 	'agenda'    =>  $row->slot_agenda,
				// 	'start_time'    =>  $row->slot_start_time,
				// 	'end_time'    =>  $row->slot_end_time,
				// 	'created_on'      => date('Y-m-d H:i:s')
				//    );	
				  $session_data =array( 
					'event_id'  =>  $event_id,
					'agenda'    =>  $agendas[$key],
					'start_time'    =>  $row->slot_start_time,
					'end_time'    =>  $row->slot_end_time,
					'created_on'      => date('Y-m-d H:i:s')
				   );	
				  $insertresult= $this->db->insert('event_sessions',$session_data);	
			   }

			}
			$this->createEventMailLogs($event_id,$firstTemplateId);
			return	$event_id;
		}


			
		}
		else
		{
			return 0;
		}


    } //End of add function
	
	
	function getEventSessions($event_id)
	{
		$eventSessions	=	$this->db->select("*")->from("event_sessions")->where("event_id",$event_id)->get()->result();
		return $eventSessions;
	}
	
	function view_events($event_id,$template_id,$vendor_id,$batch_id,$limit, $start)
    {
		$this->db->select('events.*,users.name');
		$this->db->where('events.company_id',$this->session->userdata('master_id'));
		$this->db->where('events.is_active','1');
		$this->db->join('users','users.user_id = events.vendor_id');
		// $this->db->join('events_email_logs','events_email_logs.event_id = events.event_id');
		if($event_id!='0')
		$this->db->where('events.event_id', $event_id);
		if($this->input->get('event_master_id'))
		{
			$this->db->join('events_email_logs','events_email_logs.event_id = events.event_id','inner');
			$this->db->where('events_email_logs.event_master_id', $this->input->get('event_master_id'));
		}
		if($template_id!='0')
		$this->db->where('events.template_id', $template_id);
		if($vendor_id!='0')
		$this->db->where('events.vendor_id', $vendor_id);
		if(array_key_exists('event_date',$_GET) && !empty($_GET['event_date']) && $_GET['event_date']!="")
		{
			$rangeDate		=	explode("-",$_GET['event_date']);
			$date1			=	str_replace("/","-",$rangeDate[0]);
			$date2			=	str_replace("/","-",$rangeDate[1]);
			$this->db->where('events.event_date BETWEEN "'. $date1 .'" AND "'. $date2 .'"');
		}
		if($batch_id!='0')
		$this->db->where('events.batch_id', $batch_id);
		$this->db->group_by('events.event_id'); 
		$this->db->order_by('events.event_date','DESC');
		if($limit!=null || $start!=null)
		{
			$this->db->limit($limit,$start);
		}	
        $this->db->from('events');
        $query = $this->db->get();
	//    echo "--->".$this->db->last_query();
	//    die;
	    $result = $query->result();
		foreach ($result as $row) {
				
				$row->total_participants= $this->count_event_participants($row->event_id);

				$row->templates= $this->get_templates($row->event_id);
				
			}
			
		/*echo "<pre>";
		print_r($result);
		echo "</pre>";*/
       
        return $result;

    } //End of View  function
	
	
	function getTemplateDetails($template_id)
	{
		$templateQuery		=	$this->db;
		$templateQuery->from("mail_sms_templates");
		$templateQuery->where('template_id',$template_id);
		$templateQuery->limit(1);
		$templateQuery		=	$templateQuery->get()->row();
		return $templateQuery;
	}

	function getEmailLogDetails($email_log_id)
	{
		$emailLogQuery		=	$this->db;
		$emailLogQuery->from("events_email_logs");
		$emailLogQuery->where('id',$email_log_id);
		$emailLogQuery->limit(1);
		$emailLogQuery		=	$emailLogQuery->get()->row();
		return $emailLogQuery;
	}

	function getPreviousStepDetails($event_id,$event_master_id,$step)
	{
		$previousStepQuery		=	$this->db;
		$previousStepQuery->from("events_email_logs");
		$previousStepQuery->where('event_id',$event_id);
		$previousStepQuery->where('event_master_id',$event_master_id);
		$previousStepQuery->where('step',$step);
		$previousStepQuery->limit(1);
		$previousStepQuery		=	$previousStepQuery->get()->row();
		return $previousStepQuery;
	}

	function getEventDetails($event_id)
	{
		$eventQuery		=	$this->db;
		$eventQuery->from("events");
		$eventQuery->where('event_id',$event_id);
		$eventQuery->limit(1);
		$eventQuery		=	$eventQuery->get()->row();
		return $eventQuery;
	}

	function getEventMasterDetails($event_master_id)
	{
		$eventQuery		=	$this->db;
		$eventQuery->from("event_master");
		$eventQuery->where('id',$event_master_id);
		$eventQuery->limit(1);
		$eventQuery		=	$eventQuery->get()->row();
		return $eventQuery;
	}

	function getVendorDetails($vendor_id)
	{
		$userQuery		=	$this->db;
		$userQuery->from("users");
		$userQuery->where('user_id',$vendor_id);
		$userQuery->limit(1);
		$userQuery		=	$userQuery->get()->row();
		return $userQuery;
	}

	function get_templates($event_id)
	{
		$templatesQuery		=	$this->db;
		$templatesQuery->from("events_email_logs");
		$templatesQuery->where('event_id',$event_id);
		$templatesQuery->order_by('step','ASC');
		$templateQuery		=	$templatesQuery->get();
		return $templateQuery->result();
	}	
	
	function count_events($event_id,$template_id,$vendor_id,$batch_id) {
			
			$this->db->where('events.company_id',$this->session->userdata('master_id'));
			$this->db->where('events.is_active','1');
			$this->db->join('users', 'users.user_id = events.vendor_id');
			if($event_id!='0')
			$this->db->where('events.event_id', $event_id);
			if($this->input->get('event_master_id'))
			{
				$this->db->join('events_email_logs','events_email_logs.event_id = events.event_id','inner');
				$this->db->where('events_email_logs.event_master_id', $this->input->get('event_master_id'));
			}
			if($template_id!='0')
			$this->db->where('events.template_id', $template_id);
			if($vendor_id!='0')
			$this->db->where('events.vendor_id', $vendor_id);
			if($batch_id!='0')
			$this->db->where('events.batch_id', $batch_id);
			$this->db->group_by('events.event_id'); 
			$query=$this->db->get('events');		
			//echo "--------------------->". $this->db->last_query();	   
			return $query->num_rows();
			
		}     //End of Count function
		
	
	function view_event_sessions($event_id)
		{
			$this->db->select('*');
			$this->db->from('event_sessions');
			$this->db->where('event_id',$event_id);
			$this->db->where('is_active','1');
			$this->db->order_by('event_session_id', 'ASC');
			$query = $this->db->get();
			$result = $query->result();
			return $result;
	
		} //End of View function
		
	function count_event_participants($event_id)
		{
		    $this->db->where('event_id', $event_id);
			$this->db->from('event_participants');
			$query = $this->db->get();
			//echo $this->db->last_query();
			return $query->num_rows();
	
		} //End of Count function		


	  function event_edit($event_id)
		{
			if ($event_id == '') {
				redirect(base_url() . "company/events/view");
			}
			$this->db->select('*');
			$this->db->from('events');
			$this->db->where('event_id', $event_id);
			$query = $this->db->get();
			return $query->row();
	
		} //End of edit function
	


		function view_events_master()
		{
			$this->db->select('event_master.*,COUNT(events.event_id) as event_count');
			$this->db->from('event_master');
			$this->db->join('events', 'events.event_master_id = event_master.id', 'left');
			$this->db->group_by('event_master.id');
			$query = $this->db->get();
			//echo $this->db->last_query();
			$result = $query->result();
			/*echo "<pre>";
			print_r($result);
			echo "</pre>";
			*/
			return $result;
	
		} //End of View function

		function get_events_master()
		{

			$this->db->select('*');
			$this->db->from('event_master');
			$query = $this->db->get();
			$results = $query->result();
			$formatted_results = array();
			$formatted_results[null]		=	"Select Event Master";
			foreach ($results as $result) {
				$key = $result->email_from_metlife . '(' . $result->month.")";
				$formatted_results[$result->id] = $key;
			}
			return $formatted_results;
	
		} //End of View function
		
		
		 function update_event($event_id,$GroupLists)
		 {
			$data = array(
				'event_name'   => $this->input->post("event_name"),
				'event_type'   => $this->input->post("event_type"),
				'event_master_id'   => $this->input->post("event_master_id"),
				'template_id'   => $this->input->post("template_id"),
				'batch_id'   => $this->input->post("batch_id"),
				'vendor_id'   => $this->input->post("vendor_id"),
				'event_title'   => $this->input->post("event_title"),
				'event_date'   => $this->input->post("event_date"),
				'event_header_text'   => $this->input->post("event_header_text"),
				'modified_on'      => date('Y-m-d H:i:s')
			);
			$previousVendorID	=	$this->db->where('event_id', $event_id)->from("events")->get()->result()[0]->vendor_id;
			$this->db->where('event_id', $event_id);
			$result = $this->db->update('events', $data);
			// event email logs code
			$eventEmailLogObject	=	$this->db;
			$eventEmailLogObject	=	$eventEmailLogObject->select('*');
			$eventEmailLogObject	=	$eventEmailLogObject->from('events_email_logs');
			$eventEmailLogObject	=	$eventEmailLogObject->where("event_id",$event_id)->order_by("step","asc");
			$eventEmailLogResult	=	$eventEmailLogObject->get();
			$firstTemplateId		=	$this->getCustomVendorDetails($this->input->post("vendor_id"));
			if($eventEmailLogResult->num_rows()==0)
			{
				$this->createEventMailLogs($event_id,$firstTemplateId);
			}			
			else
			{
				if($previousVendorID!=$this->input->post("vendor_id"))
				{
					$firsVendorTemplateID	=	$this->getCustomVendorDetails($this->input->post("vendor_id"));
					if($firsVendorTemplateID)
					{
						$this->db->where("event_id",$event_id)->where("step","1")->update("events_email_logs",['template_id'=>$firsVendorTemplateID]);					
					}
				}
			}	
			if(is_array($GroupLists))
			{
				foreach($GroupLists as $key=> $listrow){
				 if($listrow['agenda']!='') 
				 {	$this->db->select('event_session_id');
					$this->db->from('event_sessions');
					$this->db->where('agenda',$listrow['agenda']);
					$this->db->where('event_id',$event_id);
					$event_result = $this->db->get();
					if($event_result->num_rows() == 0)
					{  
					  $session_data =array( 
						'event_id'  =>  $event_id,
						'agenda'    =>  $listrow['agenda'],
						'start_time'    =>  $listrow['start_time'],
						'end_time'    =>  $listrow['end_time'],
						'created_on'      => date('Y-m-d H:i:s')
					   );	
					  $insertresult= $this->db->insert('event_sessions',$session_data);	
					}
					}
				   }
				 }
			   
			if ($result)
			   return 1;
			 else
			   return 0;
			
		 } //End of Update function
		 
	
	function getCustomVendorDetails($vendorId)
	{
		$vendorObject		=	$this->db->select("*");
		$vendorObject		=	$vendorObject->where("user_id",$vendorId);
		$vendorObject		=	$vendorObject->from("users");
		$vendorObject		=	$vendorObject->get();
		$vendorObject		=	$vendorObject->result();
		$vendorObject		=	$vendorObject[0];
		$vendorName			=	$vendorObject->name;
		$firstTemplateId	=	null;
		if($vendorName=="Indic Express" || $vendorName=="Spectrum" || $vendorName=="Darshika" || $vendorName=="Arize" || $vendorName=="Blue Marketing" || $vendorName=="bigTel" || $vendorName=="dPacific")
		{
			$firstTemplate		=	$this->db->select("*");
			$firstTemplate		=	$firstTemplate->where("company",$vendorName);
			$firstTemplate		=	$firstTemplate->from("mail_sms_templates");
			$firstTemplate		=	$firstTemplate->get();
			$firstTemplate		=	$firstTemplate->result();
			$firstTemplate		=	$firstTemplate[0];
			$firstTemplateId	=	$firstTemplate->template_id;	
		}
		return $firstTemplateId;
	}

	function createEventMailLogs($event_id,$firstTemplateId)
	{
		$eventEmailOrders		=	getEventEmailOrder();
		$eventMasterQuery	    =	$this->db->select('*');
		$eventMasterQuery		=	$eventMasterQuery->from('event_master');
		$eventMasterQuery		=	$eventMasterQuery->where('id', $this->input->post("event_master_id"))->limit(1);
		$eventMasterObject 		= 	$this->db->get()->row();
		$receivedDate			=	null;
		$invoiceDate			=	null;
		$invalidProofDate		=	null;
		$proofReSendDate		=	null;
		foreach($eventEmailOrders as $eventKey => $eventEmailOrder)
		{
			$size			=	[1,1.5,2,2.5,3];
			$randomKey 		= 	array_rand($size);
			$randomSize		=	$size[$randomKey];
			$templateQuery	=	$this->db;
			$templateQuery->select('template_id');
			$templateQuery->from('mail_sms_templates');
			$templateQuery->where('template_type',$eventEmailOrder);
			$templateQuery->order_by('RAND()');
			$templateQuery->limit(1);
			$templateResult 		= $templateQuery->get()->row();
			$template_id			= empty($templateResult->template_id) ? 0 :$templateResult->template_id;
			$templateFooterClass	= null;
			switch ($eventEmailOrder) {
				case 'sent':
					$date		=	$eventMasterObject->email_from_metlife;
					$actionDate = 	strtotime($date);
					$date		=	date('Y-m-d H:i:s', $actionDate+rand(60000,68000));
					$templateFooterClass	=	getFooterMailClass('sender');
					break;
				case 'received':
					$days = rand(1,2);
					$days = $days==2 ? "+".$days." days" : "+".$days." day";

					$date = $eventMasterObject->event_end_date;
					$dateObject = new DateTime($date);
					$dateObject->modify($days);

					// Check if the resulting day is a Sunday
					if ($dateObject->format('w') == 0) { // Sunday has a numeric representation of 0
						$dateObject->modify('+1 day');
					}

					$date 			= $dateObject->format('Y-m-d');
					$actionDate 	= 	strtotime($date);
					$date			=	date('Y-m-d H:i:s', $actionDate+rand(36000,68000));
					$receivedDate	=	$date;
					$templateFooterClass	=	getFooterMailClass('receiver');
					# code...
					break;
				case 'validProof':
					if(count($eventEmailOrders)==6)
					{
						$days = rand(1,2);
						$days = $days==2 ? "+".$days." days" : "+".$days." day";

						$dateTime = $proofReSendDate;
						$datetimeObject = new DateTime($dateTime);
						$datetimeObject->modify($days);

						// Check if the resulting day is a Sunday
						if ($datetimeObject->format('w') == 0) { // Sunday has a numeric representation of 0
							$datetimeObject->modify('+1 day');
						}

						$date 			= $datetimeObject->format('Y-m-d');
						$actionDate 	= 	strtotime($date);
						$date			=	date('Y-m-d H:i:s', $actionDate+rand(36000,68000));
						$invoiceDate	= $date;
					}
					else
					{
						$days = rand(1,2);
						$days = $days==2 ? "+".$days." days" : "+".$days." day";

						$dateTime = $receivedDate;
						$datetimeObject = new DateTime($dateTime);
						$datetimeObject->modify($days);

						// Check if the resulting day is a Sunday
						if ($datetimeObject->format('w') == 0) { // Sunday has a numeric representation of 0
							$datetimeObject->modify('+1 day');
						}

						$date 			= $datetimeObject->format('Y-m-d');
						$actionDate 	= 	strtotime($date);
						$date			=	date('Y-m-d H:i:s', $actionDate+rand(36000,68000));
						$invoiceDate	= $date;
					}
					$templateFooterClass	=	getFooterMailClass('sender');
					break;
				case 'invoice':

						$days = rand(1,2);
						$days = $days==2 ? "+".$days." days" : "+".$days." day";
						
						$dateTime = $invoiceDate;
						$datetimeObject = new DateTime($dateTime);
						$datetimeObject->modify($days);
						
						// Check if the resulting day is a Sunday
						if ($datetimeObject->format('w') == 0) { // Sunday has a numeric representation of 0
							$datetimeObject->modify('+1 day');
						}							
						$date 			= $datetimeObject->format('Y-m-d');
						$actionDate 	= 	strtotime($date);
						$date			=	date('Y-m-d H:i:s', $actionDate+rand(36000,68000));
						$templateFooterClass	=	getFooterMailClass('receiver');
					break;
				case 'invalidProof':
					$days = rand(1,2);
					$days = $days==2 ? "+".$days." days" : "+".$days." day";

					$dateTime = $receivedDate;
					$datetimeObject = new DateTime($dateTime);
					$datetimeObject->modify($days);

					// Check if the resulting day is a Sunday
					if ($datetimeObject->format('w') == 0) { // Sunday has a numeric representation of 0
						$datetimeObject->modify('+1 day');
					}
					$date 				= $datetimeObject->format('Y-m-d');
					$actionDate 		= 	strtotime($date);
					$date				=	date('Y-m-d H:i:s', $actionDate+rand(36000,68000));
					$invalidProofDate	= $date;
					$templateFooterClass	=	getFooterMailClass('sender');
					break;
				case 'proofReSend':
					$days = rand(1,2);
					$days = $days==2 ? "+".$days." days" : "+".$days." day";
					
					$dateTime = $invalidProofDate;
					$datetimeObject = new DateTime($dateTime);
					$datetimeObject->modify($days);
					
					// Check if the resulting day is a Sunday
					if ($datetimeObject->format('w') == 0) { // Sunday has a numeric representation of 0
						$datetimeObject->modify('+1 day');
					}
					
					$date 				= $datetimeObject->format('Y-m-d');
					$actionDate 		= 	strtotime($date);
					$date				=	date('Y-m-d H:i:s', $actionDate+rand(36000,68000));
					$proofReSendDate	= $date;
					$templateFooterClass	=	getFooterMailClass('receiver');
					break;
				
			}
			if($eventKey==1 && $firstTemplateId!=null)
			{
				$template_id	=	$firstTemplateId;
			}
			$data				=	['template_id'=>$template_id,
									 'event_id'=>$event_id,
									 'event_master_id'=>$this->input->post("event_master_id"),
									 'step'=>$eventKey,
									 'date'	=>	$date,
									 'type'	=>	$eventEmailOrder,
									 'template_footer'	=>	$templateFooterClass,
									 'size'	=>	$randomSize
									];


			$this->db->insert("events_email_logs",$data);

		}
	}


    function update_status($event_id, $status)
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
        $this->db->where('event_id', $event_id);
	    $result = $this->db->update('events', $data);
		if($result)
		  return '1';
		 else 
		 return '0';

    } //End of Update status function
	

	
	function delete_event_session($event_session_id,$event_id){
	    $this->db->select('event_session_id');
		$this->db->from('event_sessions');
		$this->db->where('event_session_id', $event_session_id);
		$this->db->where('event_id',$event_id);
   	    $query = $this->db->get();
        if($query->num_rows() > 0 ){
		  $this->db->where('event_session_id', $event_session_id);
		  $this->db->where('event_id',$event_id);
		   $result = $this->db->delete('event_sessions');
		   if($result)
			{
			  return '1';
			}
	   }
	   else{
		 return '0';
	   }
	}
	
	
	 function get_event_details($event_id)
		{
			$this->db->select('*');
			$this->db->from('events');
			$this->db->where('event_id', $event_id);
			$query = $this->db->get();
			return $query->row();
	
		} //End of edit function
		
	
	function get_event_sessions($event_id)
		{
			$this->db->select('*');
			$this->db->from('event_sessions');
			$this->db->where('event_id',$event_id);
			$this->db->where('is_active','1');
			$this->db->order_by('start_time', 'ASC');
			$query = $this->db->get();
			$result = $query->result();
			return $result;
	
		} //End of View function
		
		
			
	function get_event_participants_meeting($event_id)
		{
			$this->db->select('*');
			$this->db->from('event_participants');
			$this->db->where('event_id',$event_id);
			$this->db->where('joined','Y');
			$this->db->order_by('event_participant_id', 'RANDOM');
			$this->db->limit(9);
			$query = $this->db->get();
			$result = $query->result();
			//echo "----------->".$this->db->last_query();
			return $result;
	
		} //End of View function


		function get_meeting_color()
		{
			$this->db->select('option_id,title');
			$this->db->from('list_options');
			$this->db->where('list_id ','meeting_color');
			$this->db->where('is_active','1');
			$this->db->order_by('option_id', 'RANDOM');
			$query = $this->db->get();
			$results = $query->result();
			//echo "----------->".$this->db->last_query();
			return $results;
	
		} //End of View function


		function get_event_participants($event_id)
		{
			$this->db->select('*');
			$this->db->from('event_participants');
			$this->db->where('event_id',$event_id);
			$this->db->order_by('event_participant_id', 'ASC');
			$query = $this->db->get();
			$result = $query->result();
			return $result;
	
		} //End of View function	
			
			
	 function insert_participants_data($data) {
        $result = $this->db->insert('event_participants', $data);
		$event_participant_id = $this->db->insert_id();
		if($event_participant_id)
		{    return $event_participant_id;
		     exit();
		}
		else
		{	 return '0';
			 exit();
		}
		
      }
		
	
}