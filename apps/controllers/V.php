<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class V extends CI_Controller {

public function __construct()
	{
		parent:: __construct();
		$this->load->model('v_model');
	}

	public function index()
	{
		  $data['title'] = " Campaign Verify";
		  $data['main_heading'] = "Campaign Verify";
		  $data['heading'] = "Campaign Verify";
		
		//echo "--------->".$this->uri->segment('2');
	//	echo "--------->".$this->uri->segment('3');
		// echo "----------------Hello";
		  $string_id = $this->uri->segment('2');
		// echo "-------->".$string_id;
		  // die();
		  if($string_id=='')
		   {
			   echo "File not Found";
			   die();
		   }
		  
		    $verifyresult =  $this->v_model->get_campaign_verify($string_id);
			//die();
		    $this->session->unset_userdata('common_message');
		    if($verifyresult=='0')
			{
			$msg='1';
			$this->session->set_userdata('common_message', $msg);
		    redirect(base_url() . 'response');
			}
			elseif($verifyresult=='1')
			{
			$msg='2';
			$this->session->set_userdata('common_message', $msg);
		    redirect(base_url() . 'response');
			}
		   elseif($verifyresult=='2')
		   {
			$msg='3';
			$this->session->set_userdata('common_message', $msg);
		    redirect(base_url() . 'response');
		   }
			elseif($verifyresult=='3')
			{
			$msg='4';//Validity has been expired.
			$this->session->set_userdata('common_message', $msg);
		    redirect(base_url() . 'response');
			}
			else{	
			   redirect(base_url() . 'hdfclife/candidates/hdfclife_verify');
				// print_r($this->session->all_userdata());
			}
	
	}

}