<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		is_logged_in();  
		$this->load->model('admin/dashboard_model');
	}
	
	
	
	function index()
	{
		$data=array();
		$data['title'] = title." | Dashboard";
		$data['heading'] = title." | Dashboard";
		
		//$completion_ratio_min='85';	
       // $completion_ratio_max='92';	
       // echo  "------------------->".$completion_ratio=rand($completion_ratio_min,$completion_ratio_max);
        
      
	    //All Campaigns date wise Results
	   /* $campaigns_results = $this->dashboard_model->campaigns_consolidated();
	    $data['campaigns_results'] = $campaigns_results;
	    $data['total_campaigns_results'] = count($campaigns_results);
	  
	    //All Consent Candidates date wise Results
	    $cand_consent_results = $this->dashboard_model->candidates_consent_consolidated();
	    $data['cand_consent_results'] = $cand_consent_results;
	    $data['total_consent_candidates'] = count($cand_consent_results);*/
	   
		$this->load->view('admin/dashboard',$data);
	}

}	
?>