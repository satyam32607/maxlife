<?php

class Participants_model extends CI_Model
{
	
	function view_participants($event_id,$event_participant_id,$limit, $start)
    {
		$this->db->select('events.event_name,events.event_date,event_participants.*');
		$this->db->join('events', 'events.event_id = event_participants.event_id');
		$this->db->where('event_participants.event_id', $event_id);
		if($event_participant_id!='0')
		$this->db->where('event_participants.event_participant_id', $event_participant_id);
		$this->db->group_by('event_participants.event_participant_id'); 
		$this->db->order_by('event_participants.event_participant_id','ASC');
		if($limit!=null || $start!=null)
		{
			$this->db->limit($limit,$start);
		}	
        $this->db->from('event_participants');
        $query = $this->db->get();
	   //echo "--->".$this->db->last_query();
	    $result = $query->result();
	    
        return $result;

    } //End of View  function
	
	
	function count_participants($event_id,$event_participant_id) {
		    $this->db->join('events', 'events.event_id = event_participants.event_id');
			if($event_id!='0')
			$this->db->where('event_participants.event_id', $event_id);
			if($event_participant_id!='0')
			$this->db->where('event_participants.event_participant_id', $event_participant_id);
			$this->db->group_by('event_participants.event_participant_id'); 
			$query=$this->db->get('event_participants');		
			//echo "--------------------->". $this->db->last_query();	   
			return $query->num_rows();
			
		}     //End of Count function


		function delete_event_participant($event_id){
			$this->db->select('event_participant_id');
			$this->db->from('event_participants');
		  	$this->db->where('event_id',$event_id);
		    $query = $this->db->get();
			if($query->num_rows() > 0 ){
			  $this->db->where('event_id',$event_id);
			   $result = $this->db->delete('event_participants');
			   if($result)
				{
				  return '1';
				}
		   }
		   else{
			 return '0';
		   }
		}


		function update_event_participants($event_id){


			$this->db->select('event_id,event_date,batch_id,slot_id');
			$this->db->where('is_active','1');
			$this->db->where('event_id',$event_id);
			$this->db->order_by('event_id','DESC');
			$this->db->limit(1);
			$query = $this->db->get('events');
			$eventrow = $query->row();
			$batch ='Batch '.$eventrow->batch_id;
			$slot = 'Slot-'.$eventrow->slot_id;
			

			$this->db->select('emp_companyname,email_id,contact_no,event_employee_count');
			if($eventrow->event_date!='0')
			$this->db->where('event_start_date >=', date(''.$eventrow->event_date.''));
			if($eventrow->event_date!='0')
			$this->db->where('event_start_date <=', date(''.$eventrow->event_date.''));
			$this->db->where('batch',$batch);
			$this->db->where('slot',$slot);
			$this->db->order_by('user_data_id','ASC');
			//$this->db->limit(1);
			$query = $this->db->get('user_data');
			$result = $query->result();
			//echo $this->db->last_query();
			//echo "<br>";
			//die();
			if($query->num_rows()>0){
			  $done=0;	
			  $already=0;	 
			  /*echo "<pre>";
			  print_r($result);
			  echo "</pre>";*/

			  foreach ($result as $row) {

				$participant_email_id = trim($row->email_id);
				$participant_name = trim($row->emp_companyname);
				
				$this->db->select('event_participant_id');
				$this->db->where('event_id',$event_id);
				$this->db->where('participant_email_id',$participant_email_id);
				$this->db->order_by('event_participant_id','DESC');
				$this->db->limit(1);
				$query = $this->db->get('event_participants');
				//echo $this->db->last_query();
				//echo "<br>";
				if($query->num_rows()==0){
						$logdata = array(
							'event_id'   => $event_id,
							'participant_name'   => $participant_name,
							'participant_email_id'     => $participant_email_id,
							'invite_sent'     => 'Y',
							'joined'     => 'Y',
							'drop_out_session'     => 'No',
							'attended_full_session'     => 'y',
							'created_on'     => date('Y-m-d H:i:s')
						);
						$participantresult   = $this->db->insert('event_participants', $logdata);
						$event_participant_id = $this->db->insert_id();
						$done++;
					}
					else
					{
						$already++;	 
					}
				}
		}
		if($done>0)
		$this->session->set_flashdata('success_message', 'Total\'s ('.$done.') participants added successfully.');
		
		if($already>0)
		$this->session->set_flashdata('warning_message', 'Total\'s ('.$already.') participants already exists in this event.');



	}
		
	
		
	
}