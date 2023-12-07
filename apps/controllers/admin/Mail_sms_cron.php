<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mail_sms_cron extends CI_Controller {


public function __construct()
	{
		parent:: __construct();
		valid_logged_in(FALSE,'A');	
		$this->load->model('admin/mail_sms_cron_model');
		$this->load->helper('download');
		}
	
	
	public function get_dw_fresh_candidates(){	
	
	   $data=array();
	   $data['title'] = title." | Campaign date wise";
	   $data['main_heading'] = "Reports";

		/*$lastsent_datetime='2021-01-10 23:29:43';
 		$diff_days = diffdays($lastsent_datetime);
		echo "--------------->Diff Days--->".$diff_days;
		die();*/
 
		$results = $this->mail_sms_cron_model->get_dw_fresh_candidates();
		
		echo "<pre>";
		print_r($results);
		echo "</pre>";
	 
	  
		}
	

}	
?>