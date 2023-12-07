<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajaxrequest extends CI_Controller {

public function __construct()
	{
		parent:: __construct();
		$this->load->model('ajaxrequestmodel');
	}

	function auto_search(){
		if($_GET){
		 $search_text = $_GET['query'];	
		 echo view_auto_search_result($search_text);
		}
	}
		
	/*========== Get States list ============*/
	function get_states($country_id=null){
		$result = $this->ajaxrequestmodel->get_states($country_id);
		 echo $result;
	}
	
	/*=========== Get Cities ==============*/
	public function get_cities($state_id=NULL)
	{
		 $result = $this->ajaxrequestmodel->get_cities($state_id);
		 echo $result;
	} 
	
    /*=========== Get Payment Modes ==============*/
	public function get_payment_mode($payment_status=NULL)
	{
		 $result = $this->ajaxrequestmodel->get_payment_mode($payment_status);
		 echo $result;
    }
	/*=========== Get Roles List ==============*/
	public function get_roles($functional_id=NULL)
	{
		 $result = $this->ajaxrequestmodel->get_roles($functional_id);
		 echo $result;
	} 
	
	/*=========== Get Specializations List ==============*/
	public function get_specializations($specialization_id=NULL)
	{
		 $result = $this->ajaxrequestmodel->get_specializations($specialization_id);
		 echo $result;
	} 
	
	/*=========== Get Modules List ==============*/
	public function get_modules($user_type=NULL)
	{
		 $result = $this->ajaxrequestmodel->get_modules($user_type);
		 echo $result;
	} 
	
	/*=========== Get Modules List ==============*/
	public function get_countrycode($user_type=NULL)
	{
		 $result = $this->ajaxrequestmodel->get_countrycode($user_type);
		 echo $result;
	} 
	public function get_template($email_type=NULL){
		 $result = $this->ajaxrequestmodel->get_template($email_type);
		 echo $result;
	}
	
	public function get_sms_template($sms_template_id=NULL){
		 $result = $this->ajaxrequestmodel->get_sms_template($sms_template_id);
		 echo $result;
	}
	
	/*=========== Get Courses ==============*/
	public function get_courses($stream_id=NULL)
	{
		 $result = $this->ajaxrequestmodel->get_courses($stream_id);
		 echo $result;
	} 
	
	
	public function fields_adjustment(){
		$data=$this->input->post('weightid');
		$form_id=$this->input->post('form_id');
		$weight_update=$this->ajaxrequestmodel->weight_updated($data,$form_id);
		if($weight_update){
			return '1';
		}else{
			return '0';
		}
	}
}

