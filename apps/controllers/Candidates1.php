<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Candidates extends CI_Controller {

public function __construct()
	{
		parent:: __construct();
		is_campaign_logged_in();
		$this->load->model('candidates_model');
		
	}

	public function verify()
	{
		  $data['title'] = "Verification ";
		  $data['main_heading'] = "Verification";
		  $data['heading'] = "Verification";
		  $msg='';
		  
		// print_r($this->session->all_userdata());
		// die();
		  $this->form_validation->set_rules('date_of_birth', 'Date of Birth', 'required|trim');
		 if ($this->form_validation->run()) {
		  $feilds = array('campaign_log_id' =>$this->session->userdata('camp_log_id'),'candidate_status' =>'2');
		  $result = check_unique('campaign_logs',$feilds);
		  //echo "----result---->".$result;
		  if($result=='0')
		  {    $msg='Your Date of birth verification is pending.';
			   $this->session->set_flashdata('warning_message', $msg);
			   redirect(base_url() . 'candidates/verify');
		  }
		 else
		  {			  
			 $candrow =  $this->candidates_model->verify_candidate_dob();	
			 if($candrow!='0')
			 {
			   $msg = "Your Date of birth verification successfully.";
			    redirect(base_url() . 'candidates/application_consent');
				exit();
			 }
			 else  
			 {
			   $msg = "Your Date of birth verification failed.";	
			 }
				
			}  
			
	    } //end of add  functionality
		
	    $row =  $this->candidates_model->get_candidate_info();	
		
	    $data['row'] = $row;
	    $data['msg'] = $msg;
	   $this->load->view('candidates_verify.php', $data);
	}
	
	
	public function application_consent()
	{
		  $data['title'] =" Application Consent Form";
		  $data['main_heading'] = "Application Consent Form";
		  $data['heading'] = "Application Consent Form";
		  $msg='';
		  
		  $feilds = array('campaign_log_id' =>$this->session->userdata('camp_log_id'),'candidate_status' =>'2');
		  $result = check_unique('campaign_logs',$feilds);
		  if($result==1)
		  {
			$data['msg']='Your Candidate consent already updated.';
		  }
		  
		  $this->form_validation->set_rules('mobile_no', 'Mobile no.', 'required|trim');
		  if($this->form_validation->run()) {
		  $feilds = array('campaign_log_id' =>$this->session->userdata('camp_log_id'),'candidate_status' =>'3');
		  $result = check_unique('campaign_logs',$feilds);
		  if($result==1)
		  {
			$data['msg']='Your Candidate consent already updated.';
		  }
		 else
		  {			  
				
		  }  
			
	    } //end of add  functionality
	
		$candrow =  $this->candidates_model->get_candidate_info();	
		/*echo "<pre>";
		print_r($candrow);
		echo "</pre>";*/
    	$data['msg'] = $msg;
		$data['row'] = $candrow;
	   $this->load->view('application_consent.php', $data);
	}
	

}