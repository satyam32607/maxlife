<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Events extends CI_Controller {

public function __construct()
	{
		parent:: __construct();
		valid_logged_in(FALSE,'C');	
		$this->load->model('company/events_model');
		$this->load->library('csvimport');
		$this->load->library('upload');
	}
	

	public function events_master()
	{
		$data=array();
		$data['title'] = title." | View Events Master";
		$data['main_heading'] ="Events Master";
		$data['heading'] = "View Events Master";
	
		$results = $this->events_model->view_events_master();	  
		$data['results']  = $results;
		$num_rows         = count($results);	
		$data['num_rows'] = $num_rows;		  
		$this->load->view('company/events/eventsMasterView', $data);		
    } //end of view functionality	
		
	public function add($eventMasterId=null)
	{
		  $data['title'] = title." | Add Event";
		  $data['main_heading'] = "Vendors";
		  $data['heading'] = "Add Event";
		  $data['already_msg']="";
		  $data['eventTypes']		=	event_type_array();
		  $data['eventMasters']		=	$this->events_model->get_events_master();
		  $data['eventMasterId']	=	$eventMasterId;	
		  $this->form_validation->set_rules('event_name', 'Event name', 'required|trim');
		  $this->form_validation->set_rules('template_id', 'Template name', 'required|trim');
		  $this->form_validation->set_rules('batch_id', 'Batch name', 'required|trim');
		  $this->form_validation->set_rules('vendor_id', 'Vendor name', 'required|trim');
		//   $this->form_validation->set_rules('event_title', 'Event title', 'required|trim');
		  $this->form_validation->set_rules('event_date', 'Event date', 'required|trim');
		  $this->form_validation->set_rules('slot_id', 'Event Slot', 'required|trim');
		  $this->form_validation->set_rules('event_header_text', 'Event Header text', 'required|trim');
		  
		if ($this->form_validation->run()) {
				  
			 $event_id =  $this->events_model->add();	
			 if($event_id!='0'){
				 
			     if($event_id=='0')
			       $msg = "There is some error in Save Event Record.";
			      else  
			       $msg = "Event account have been created successfully.";			 
			       $this->session->set_flashdata('success_message', $msg);	
			       redirect(base_url() . 'company/events/view');				
			}  
			else{
			   $this->session->set_flashdata('warning_message','There is some error in Save Event Record.');
			   }
		 
	    } //end of add  functionality
		
		  
	   $this->load->view('company/events/add.php', $data);
	}
	
	
	public function view(){	
	
	    $data['title'] = title." | View Events";
		$data['main_heading'] = "Events";	
		$data['heading'] = "View Events";	
		
	   //print_r($_POST);	
	    if($this->input->post('event_id'))
			 $event_id = $this->input->post('event_id');
		 elseif($this->uri->segment('4'))
			 $event_id=$this->uri->segment('4');
		else
			 $event_id='0';
		
	  if($this->input->post('template_id'))
			$template_id = $this->input->post('template_id');
		 elseif($this->uri->segment('5'))
			$template_id=$this->uri->segment('5');
		else
			$template_id='0';
					
	   if($this->input->post('vendor_id'))
			$vendor_id = $this->input->post('vendor_id');
		 elseif($this->uri->segment('6'))
			$vendor_id=$this->uri->segment('6');
		else
			$vendor_id='0';
		
		if($this->input->post('batch_id'))
			$batch_id = $this->input->post('batch_id');
		elseif($this->uri->segment('7'))
			$batch_id=$this->uri->segment('7');
		else
			$batch_id='0';
		
			
		if($this->input->post('per_page'))
			$per_page = $this->input->post('per_page');
		elseif($this->uri->segment('8'))
			$per_page=$this->uri->segment('8');
		else
			$per_page=per_page;	
			
		$config = array();
		$config["base_url"] = base_url() . "company/events/view/".$event_id."/".$template_id."/".$vendor_id."/".$batch_id."/".$per_page;
		$config["per_page"] = $per_page;
        $config["uri_segment"] = 9;
		$config["total_rows"] =$this->events_model->count_events($event_id,$template_id,$vendor_id,$batch_id);
		$this->pagination->initialize($config);
        $page = ($this->uri->segment(9)) ? $this->uri->segment(9) : 0; 
		$data['results'] = $this->events_model->view_events($event_id,$template_id,$vendor_id,$batch_id,$config['per_page'], $page);
		$data['links']   = $this->pagination->create_links();
		$data['num_rows'] = $config['total_rows'];	
		
		$data['event_id'] = $event_id;
		$data['template_id'] = $template_id;
		$data['vendor_id'] = $vendor_id;
		$data['batch_id'] = $batch_id;	
		$data['per_page'] = $per_page;
		  	  
	    $this->load->view('company/events/view.php', $data);
		}
	

	public function edit($event_id){
		  
		  $data['title'] = title." | Edit Event";
		  $data['main_heading'] = "Events";
		  $data['heading'] = "Edit Event";
          $data['already_msg']="";
		  $data['eventTypes']	=	event_type_array();
		  $data['eventMasters']		=	$this->events_model->get_events_master();	
		  $this->form_validation->set_rules('event_name', 'Event name', 'required|trim');
		  $this->form_validation->set_rules('template_id', 'Template name', 'required|trim');
		  $this->form_validation->set_rules('batch_id', 'Batch name', 'required|trim');
		  $this->form_validation->set_rules('vendor_id', 'Vendor name', 'required|trim');
		//   $this->form_validation->set_rules('event_title', 'Event title', 'required|trim');
		  $this->form_validation->set_rules('event_date', 'Event date', 'required|trim');
		  $this->form_validation->set_rules('event_header_text', 'Event Header text', 'required|trim');
		  
		if ($this->form_validation->run()) {
		  // Update records 
		     $result =  $this->events_model->update_event($this->input->post('event_id'),$_POST['group-a']);	
			if($result){
				
		     if($result=='1')
			   $msg = "Event record has been updated successfully.";
			  else
			   $msg="There is some error in update record."; 
			   
		      $this->session->set_flashdata('success_message', $msg);
		      redirect(base_url() . "company/events/view/".$this->input->post('event_id'));								
			}
			else{
			    $this->session->set_flashdata('warning_message','There is some error in update record.');
			    }	
		}

		  $result =  $this->events_model->event_edit($event_id);
		  
		  $resultsessions =  $this->events_model->view_event_sessions($event_id);
		  $data['resultsessions'] = $resultsessions;
		  
		  $data['edit_data'] = $result;
  
		  $this->load->view('company/events/edit.php', $data);
		 
	}//end of Edit functionality*/
	
	
	public function status($event_id,$status)
	{	 // Update status  
	     $result = $this->events_model->update_status($event_id,$status);
		 if($result=='1')
		 {
		   $this->session->set_flashdata('success_message', 'Status has been updated successfully.');
		 }
		 else
		 {
			 $this->session->set_flashdata('warning_message', 'There is some error in status updation.');
		 }
		  redirect(base_url() . "company/events/view");		
		 
	}//end of Status  functionality*/
	
	
	public function delete_event_session($event_session_id,$event_id)
	{	 // Update status  
	     $result = $this->events_model->delete_event_session($event_session_id,$event_id);
		 if($result=='1')
		 {
		   $this->session->set_flashdata('success_message', 'Record has been deleted successfully.');
		 }
		 else
		 {
			 $this->session->set_flashdata('warning_message', 'There is some error in Record deleted.');
		 }
		  redirect(base_url() . "company/events/edit/".$event_id."");		
		 
	}//end of Status  functionality*/
	
	
	 public function print_event($event_id=NULL)
	  {	 
           
	    $data['title'] = title." | Print Event";
		$data['main_heading'] = "Print Event";	
		$data['heading'] = "Print Event";	
	        
        if($this->input->post('event_id'))
			 $event_id = $this->input->post('event_id');
        elseif($this->uri->segment('4'))
			 $event_id=$this->uri->segment('4');
		else
			 $event_id='0';
   			 	 
	     $eventrow = $this->events_model->get_event_details($event_id);
         $sessionsresults = $this->events_model->get_event_sessions($event_id);
		 $participantsresults = $this->events_model->get_event_participants($event_id);

		 $participantsmeetingresults = $this->events_model->get_event_participants_meeting($event_id);
		 $meeting_colors =  $this->events_model->get_meeting_color();
		 
	   /* echo "<br>";
		 print_r($firstresults);
		 echo "</br>";
		 */
		 $data['eventrow'] = $eventrow;	
		 $data['sessionsresults'] = $sessionsresults;
		 $data['pmeetingresults'] = $participantsmeetingresults;
		 $data['pmeeting_colors'] = $meeting_colors;
         $data['participantsresults'] = $participantsresults;
         if($eventrow->template_id=='1')
		 {
		 $this->load->view('company/events/templates/template1_print.php', $data);	
		 }
		 elseif($eventrow->template_id=='2')
		 {

		 $this->load->view('company/events/templates/template2_print.php', $data);
		 }
		 else
		 {
		 $this->load->view('company/events/templates/template3_print.php', $data);	     
		 }
		 
	 }//end of Status  functionality*/
	 
	 
	 public function print_mail($event_log_id=NULL)
	 {
		$data['title'] = title." | Print Mail";
		$data['main_heading'] = "Print Mail";	
		$data['heading'] = "Print Mail";
		$data['title'] = title." | Print Event";
		$data['main_heading'] = "Print Event";	
		$data['heading'] = "Print Event";	
	        
         if(!$event_log_id)
		 $event_log_id = 0;	 	
		 $eventLogObject			= $this->events_model->getEmailLogDetails($event_log_id);
		 $templateObject			= $this->events_model->getTemplateDetails($eventLogObject->template_id);
         $eventObject				= $this->events_model->getEventDetails($eventLogObject->event_id);
         $vendorObject				= $this->events_model->getVendorDetails($eventObject->vendor_id);
         $eventMasterObject			= $this->events_model->getEventMasterDetails($eventObject->event_master_id);
		 if($eventLogObject->type=="invalidProof" || $eventLogObject->type=="proofReSend" || $eventLogObject->type=="received")
		 {
			$previousStepDetails					= $this->events_model->getPreviousStepDetails($eventObject->event_id,$eventObject->event_master_id,$eventLogObject->step-1);
			$data['previousStepDetails']			= $previousStepDetails;
			$previousStepTemplateDetails			= $this->events_model->getTemplateDetails($previousStepDetails->template_id);
			$data['previousMail']			= 'events@dreamweaversindia.com';
		 }
		 $comapnyEmail				= ($templateObject->template_type=="invoice") ? "accounts03@dreamweaversindia.com" : "events@dreamweaversindia.com";
		 $data['emailFrom']			= ($templateObject->template_type=="sent" || $templateObject->template_type=="invalidProof" || $templateObject->template_type=="validProof" || $templateObject->template_type=="invoice") ? $comapnyEmail : $vendorObject->email;
		 $data['emailTo']			= ($data['emailFrom']!=$comapnyEmail) ? $comapnyEmail : $vendorObject->email;
		 $view						= $templateObject->template_type.".php";
		 $data['eventLogObject']	= $eventLogObject;
		 $data['eventMasterObject']	= $eventMasterObject;
		 $data['vendorObject']		= $vendorObject;
		 $data['vendorName']		= $vendorObject->name;
		 $data['eventObject']		= $eventObject;
		 $data['eventName']			= $eventObject->event_name;
		 $data['templateObject']	= $templateObject;
		 $date1 = new DateTime($eventMasterObject->event_start_date);
         $date2 = new DateTime($eventMasterObject->event_end_date);
		 $data['bodyDate1']					= ordinal($date1->format('j')). " " . $date1->format('M');
		 $data['bodyDate2']					= ordinal($date2->format('j')). " " . $date2->format('M') . "'". $date2->format('y');
		 $data['replaced_sms_body']			= templatedata($templateObject->template_body,(object) $data);
		 $data['replaced_sms_footer']		= templatedata($templateObject->template_footer_html,(object) $data);
		 $data['eventSessions']				=$this->events_model->getEventSessions($eventObject->event_id);
		 if(!empty($data['previousStepDetails']))
		 {
			
		 	$data['previous_replaced_sms_body']			= templatedata($previousStepTemplateDetails->template_body,(object) $data);
			$data['previous_replaced_sms_footer']		= templatedata($previousStepTemplateDetails->template_footer_html,(object) $data);
			$data['previousStepTemplateDetails']		= $previousStepTemplateDetails;
		 }
		 $this->load->view("company/events/eventEmails/$view", $data);	

	}


	 /*=========== Upload Bulk participants =========*/
	public function upload_participants() {
		  
	   $data['title'] = title." | Upload Participants";
	   $data['main_heading'] = "Upload Participants";
	   $data['heading'] = "Upload Participants";
	   $data['already_msg']="";
	   $data['error']="";
	   $data['err']="";
	
	   if($this->input->post('event_id'))
			 $event_id = $this->input->post('event_id');
		 elseif($this->uri->segment('4'))
			 $event_id=$this->uri->segment('4');
		else
			 $event_id='0';
			 
		//print_r($_FILES); 
		$this->form_validation->set_rules('event_id', 'Event', 'trim');
		$this->form_validation->set_rules('userfile', 'CSV File', 'trim');
		
		if ($this->form_validation->run()) {
			$data['error'] = '';   
			if($_FILES['userfile']['error'] != 4){		
			  if(isset($_FILES["userfile"]["name"]) && ($_FILES["userfile"]["name"]!=''))
			{	$path_info = pathinfo($_FILES["userfile"]["name"]);
			$fileExtension = $path_info['extension'];
			$file_name = time().'.'.$fileExtension ;   
			}
			
			  $this->sdata_path = realpath('assets/static/sdata');
			  $config['upload_path'] = $this->sdata_path;
			  $config['allowed_types'] = '*';
			  $config['max_size']	= '5072';
			  $config['max_width']  = '0';
			  $config['max_height']  = '0';
			  $config['overwrite'] = true;			
			  $config['file_name'] =$file_name;
			  $this->upload->initialize($config);
			  if ( ! $this->upload->do_upload('userfile')){
					$data['error']=$this->upload->display_errors();
					$success = FALSE;
			 }
			 else{
				$data = $this->upload->data('userfile');	
				/*========== File Upload Script ===========*/
				$file_path =  $this->sdata_path.'/'.$file_name;
				
				if ($this->csvimport->get_array($file_path)) {
                $csv_array = $this->csvimport->get_array($file_path);
				$count_csv_column = count($csv_array[0]);
				$x=0;
				$done=0;
				$already=0;
				$already_email_ids='';
				$err='';
				
				/*echo "<pre>";
				print_r($csv_array);
				echo "</pre>";
				die();*/
				$event_id = $this->input->post('event_id');
                foreach ($csv_array as  $row) {
					
				//	echo "---------------------->".$row;
					//echo "<br>";
					$x++;
					 if(isset($row['sr_no']))
					{
						if($row['sr_no']=='')
						$err .='Row No ' .$x.' Sr no. column is required.<br>';
					}
                    
					if(isset($row['participants']))
					{
						if($row['participants']=='')
						$err .='Row No ' .$x.' Participants required.<br>';
					}
					else
					{	$err ='Invalid participants. Column.<br>';
					}
                  	if(isset($row['invite_sent']))
					{
						if($row['invite_sent']=='')
						$err .='Row No ' .$x.' Invite sent required.<br>';
					}
					else
					{	$err ='Invalid Invite Sent Column.<br>';
					}
					if(isset($row['joined']))
					{
						if($row['joined']=='')
						$err .='Row No ' .$x.' Joined required.<br>';
					}
					else
					{	$err ='Invalid joined Column.<br>';
					}
					if(isset($row['drop_out_session']))
					{
						if($row['drop_out_session']=='')
						$err .='Row No ' .$x.' Drop Out Session required.<br>';
					}
					else
					{	$err ='Invalid Drop Out Session Column.<br>';
					}
					
					if(isset($row['attended_session']))
					{
						if($row['attended_session']=='')
						$err .='Row No ' .$x.' Attended session required.<br>';
					}
					else
					{	$err ='Invalid Attended session Column.<br>';
					}
					if(isset($row['email_id']))
					{
						if($row['email_id']=='')
						$err .='Row No ' .$x.' Email ID required.<br>';
						elseif(!valid_email($row['email_id']))
						$err .='Row No ' .$x.' invalid Email ID.<br>';
					}
					else
					{	$err ='Invalid Email ID Column.<br>';
					}
					
			}
		
			// echo "---------------------->Yes";
			 	/*   echo "<pre>";
				   print_r($csv_array);
				   echo "</pre>";*/
					//die();
			   foreach ($csv_array as  $row) {
					
			  	if($err=='')
					{
			            $participants= trim($row['participants']);
                        $invite_sent= trim($row['invite_sent']);
                        $joined= trim($row['joined']);
						$drop_out_session= trim($row['drop_out_session']);
						$attended_session= trim($row['attended_session']);
						$email_id= trim($row['email_id']);
					
						if(trim($email_id!=''))
						{
						$this->db->select('event_participant_id');
						$this->db->from('event_participants');
						$this->db->where('participant_email_id', $email_id);
						$this->db->where('event_id', $event_id);
						$this->db->order_by('event_participant_id','ASC');
						$participantquery = $this->db->get();
						$participantresult = $participantquery->result();
						$participant_num_rows =  $participantquery->num_rows();
						}
						else
						{	$participant_num_rows='0';
						}
						
						if($participant_num_rows==0)
						{
					    $insert_data = array(
							'event_id'=>$event_id,
                            'participant_name'=>$participants,
                            'participant_email_id'=>$email_id,
                            'invite_sent'=>$invite_sent,
                            'joined'=>$joined,
							'drop_out_session'=> $drop_out_session,
                            'attended_full_session' => $attended_session,
                        	'created_on'      => date('Y-m-d H:i:s')
						 );
						$event_participant_id = $this->events_model->insert_participants_data($insert_data);
                       /* echo '<pre>';    
                        print_r($insert_data);  
                             echo '</pre>';*/
						if($event_participant_id)
						{
						  $done++;	
				         }
						}
						else
						{
							$already++;
							//if($row['mobile_no1']!='')
							//$already_exists_data=trim($row['mobile_no1']);
							//else
							$already_exists_data=trim($row['email_id']);
							
							$already_email_ids .= $already_exists_data.', ';
						}
						
					 }
					
					}	
					
					$data['err']=$err;
					
			
               if($err=='')
			   {  
			       $msg1='';
				   $msg2='';
				   $already_email_ids = substr($already_email_ids,0,-1);
				   if($done>0)
			   		$msg1=  "Total (".$done.") Participants Record's Imported succesfully.<br>";
				   if($already>0)
			   		$msg2=  " (".$already.") records already exists in database.<br>(".$already_email_ids.")";
					
					if($msg1!='')
				    $this->session->set_flashdata('success_message', $msg1);
					
					if($msg2!='')
				    $this->session->set_flashdata('warning_message', $msg2);
					
				  redirect(base_url().'company/events/upload_participants');
			   }
			   
               
            } else 
                $data['error'] = "Error occured";
                
            }
				/*========== File Upload Script end ===========*/
				
			 }
		}
		  //print '<pre>'; print_r($data); die;
	
		$data['event_id']=$event_id;  
		
		$this->load->view('company/events/upload_participants', $data);
	}

	public function updateParticipantSession()
	{
		$event_participant_id	=	$this->input->get('event_participant_id');
		$eventSessionValue		=	$this->input->get('event_session_value');
		switch ($eventSessionValue) {
			case 'Yes':
				$fields	=	['drop_out_session'=>$eventSessionValue,'attended_full_session'=>'n'];
				break;
			case 'No':
				$fields	=	['drop_out_session'=>$eventSessionValue,'attended_full_session'=>'y','invite_sent'=>'Y','joined'=>'Y'];
				break;
			case 'Absent':
				$fields	=	['drop_out_session'=>$eventSessionValue,'attended_full_session'=>'n','joined'=>'N'];
				break;
			
		}

		$this->db->where("event_participant_id",$event_participant_id)->update('event_participants',$fields);
		return true;
	}


}	
?>