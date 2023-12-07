<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Participants extends CI_Controller {

public function __construct()
	{
		parent:: __construct();
		valid_logged_in(FALSE,'C');	
		$this->load->model('company/participants_model');
		$this->load->library('csvimport');
		$this->load->library('upload');
	}
	
	public function view(){	
	
	    $data['title'] = title." | View Participants";
		$data['main_heading'] = "Participants";	
		$data['heading'] = "View Participants";	
		
	   //print_r($_POST);	
	    if($this->input->post('event_id'))
			 $event_id = $this->input->post('event_id');
		 elseif($this->uri->segment('4'))
			 $event_id=$this->uri->segment('4');
		 else
			 $event_id='0';
		
	  if($this->input->post('event_participant_id'))
			$event_participant_id = $this->input->post('event_participant_id');
		 elseif($this->uri->segment('5'))
			$event_participant_id=$this->uri->segment('5');
		else
			$event_participant_id='0';

		if($this->input->post('per_page'))
			$per_page = $this->input->post('per_page');
		elseif($this->uri->segment('6'))
			$per_page=$this->uri->segment('6');
		else
			$per_page=per_page;	
			
		$config = array();
		$config["base_url"] = base_url() . "company/participants/view/".$event_id."/".$event_participant_id."/".$per_page;
		$config["per_page"] = $per_page;
        $config["uri_segment"] = 7;
		$config["total_rows"] =$this->participants_model->count_participants($event_id,$event_participant_id);
		$this->pagination->initialize($config);
        $page = ($this->uri->segment(7)) ? $this->uri->segment(7) : 0; 
		$data['results'] = $this->participants_model->view_participants($event_id,$event_participant_id,$config['per_page'], $page);
		$data['links']   = $this->pagination->create_links();
		$data['num_rows'] = $config['total_rows'];	
		
		$data['event_id'] = $event_id;
		$data['event_participant_id'] = $event_participant_id;
		$data['per_page'] = $per_page;
		  	  
	    $this->load->view('company/participants/view.php', $data);
		}


		public function delete_event_participant($event_id)
		{	 // Delete records  
			 $result = $this->participants_model->delete_event_participant($event_id);
			 if($result=='1')
			 {
			   $this->session->set_flashdata('success_message', 'Event Participant record has been deleted successfully.');
			 }
			 else
			 {
				 $this->session->set_flashdata('warning_message', 'There is some error in Record deleted.');
			 }
			  redirect(base_url() . "company/events/view/".$event_id."");		
			 
		}//end of Status  functionality*/
	


	public function update_event_participants($event_id)
	{
		 // Update  event participants  
	     $result = $this->participants_model->update_event_participants($event_id);
		/* if($result=='1')
		 {
		   $this->session->set_flashdata('success_message', 'Event participants has been updated successfully.');
		 }
		 else
		 {
			 $this->session->set_flashdata('warning_message', 'There is some error in Event participants updated.');
		 }*/
		  redirect(base_url() . "company/events/view/".$event_id."");		
	}

	

	
}	
?>