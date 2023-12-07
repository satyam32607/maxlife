<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Campaignverify extends CI_Controller {

public function __construct()
	{
		parent:: __construct();
		$this->load->model('campaignverify_model');
	}

	public function index()
	{
		  $data['title'] = " Campaign Verify";
		  $data['main_heading'] = "Campaign Verify";
		  $data['heading'] = "Campaign Verify";
		
		 // echo "--------->".$this->uri->segment('3');
		// echo "----------------Hello";
		  $string_id = $this->uri->segment('3');
		// echo "-------->".$string_id;
		  // die();
		   if($string_id=='')
		   {
			   echo "File not Found";
			   die();
		   }
		  
		    $verifyresult =  $this->campaignverify_model->get_campaign_verify($string_id);
		    if($verifyresult=='0')
			{
			$data['msg'] = "Invalid Campaign ID.";
			echo $data['msg'];
			}
			elseif($verifyresult=='1')
			{
			$data['msg'] = " Candidate Campaign Already updated.";
			echo $data['msg'];
			}
		   elseif($verifyresult=='1')
		   {
			$data['msg'] = "Campaign is de-activated.";
			echo $data['msg'];
		   }
			elseif($verifyresult=='2')
			{
			$data['msg'] = "Campaign validity has been expired.";
			echo $data['msg'];
			}
			else{	
			   redirect(base_url() . 'candidates/verify');
				// print_r($this->session->all_userdata());
				//die();
				//exit();
			}
		  //.echo "-verifyresult------->".$verifyresult;	
		 // print_r($verifyresult);
	}

}