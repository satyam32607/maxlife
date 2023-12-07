<?php
error_reporting(-1);
		ini_set('display_errors', 1);
defined('BASEPATH') OR exit('No direct script access allowed');
class Skill extends CI_Controller {

public function __construct()
	{
		parent:: __construct();
		valid_logged_in(FALSE,'A');	
		$this->load->model('admin/skill_model');
		$this->load->library('csvimport');
		$this->load->library('upload');
		$this->load->helper('string');
		}
	
	public function send_sms(){
		
		$data['title'] = title." | Send SMS";
		$data['main_heading'] = "SMS";
		$data['heading'] = "Send SMS";
		
		
	   $this->form_validation->set_rules('sms_body', 'Sms Text', 'required');
	   $this->form_validation->set_rules('candidate_id[]', 'Candidates List', 'required');
	  
		if ($this->form_validation->run()) {
		  $result =  $this->skill_model->update_send_sms();
		 //redirect(base_url() . "schools/calendar/view_logs");
		}
		 $this->load->view('admin/skill/send_sms.php', $data);
		
		 
	}//end of Edit functionality*/
	
	
	public function send_email(){
		
		$data['title'] = title." |  Send Email";
		$data['main_heading'] = "Emails";
		$data['heading'] = "Send Email";
		
		
		 $this->form_validation->set_rules('email_subject', 'Email Subject', 'required'); 
	     $this->form_validation->set_rules('email_body', 'Email Body', 'required');
  
		 if ($this->form_validation->run()) {
		  $result =  $this->skill_model->update_send_email();
		  //redirect(base_url() . "schools/calendar/view_logs");
		 }
	   //  $data['campaign_id']  = $campaign_id; 	
		
		 $this->load->view('admin/skill/send_email.php', $data);
		 
	}//end of Edit functionality*/
	


	function replaceKeys($oldKey, $newKey, array $input){
		$return = array(); 
		foreach ($input as $key => $value) {
			if ($key===$oldKey)
				$key = $newKey;
	
			if (is_array($value))
				$value = $this->replaceKeys( $oldKey, $newKey, $value);
	
			$return[$key] = $value;
		}
		return $return; 
	}
	
	function multi_rename_key(&$array, $old_keys, $new_keys)
	{
		if(!is_array($array)){
			($array=="") ? $array=array() : false;
			return $array;
		}
		foreach($array as &$arr){
			if (is_array($old_keys))
			{
				foreach($new_keys as $k => $new_key)
				{
					(isset($old_keys[$k])) ? true : $old_keys[$k]=NULL;
					$arr[$new_key] = (isset($arr[$old_keys[$k]]) ? $arr[$old_keys[$k]] : null);
					unset($arr[$old_keys[$k]]);
				}
			}else{
				$arr[$new_keys] = (isset($arr[$old_keys]) ? $arr[$old_keys] : null);
				unset($arr[$old_keys]);
			}
		}
		return $array;
	}


}	
?>