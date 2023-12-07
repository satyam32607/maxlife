<?php
//error_reporting(-1);
	//	ini_set('display_errors', 1);
defined('BASEPATH') OR exit('No direct script access allowed');
class Trainingmail_sms_cron extends CI_Controller {


public function __construct()
	{
		parent:: __construct();
		//valid_logged_in(FALSE,'A');	
		$this->load->model('admin/trainingmail_sms_cron_model');
		}
	

   	
	public function get_pending_register_candidates(){	
	
	    $data=array();
	    $data['title'] = title." | Register Candidates Email";
	    $data['main_heading'] = "Register Candidates Email";
	   
		$results = $this->trainingmail_sms_cron_model->get_pending_register_candidates();
		
		echo "<pre>";
		print_r($results);
		echo "</pre>";
	 
		}
		
	
	public function get_pending_training_candidates(){	
	
	   $data=array();
	   $data['title'] = title." | Pending Training Email";
	   $data['main_heading'] = "Pending Training Email";

	
		$results = $this->trainingmail_sms_cron_model->pending_training_candidates();
		echo "<pre>";
		print_r($results);
		echo "</pre>";
	 
		}
		
		
		


}	
?>