<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		is_logged_in();  
		$this->load->model('admin/dashboard_model');
	}
	
	function timetosec($t)
	{
		if($t!='')
		{
			$time = explode(':', $t);
			if ( !isset($time[0]) )
				$time[0] = 0;
			if ( !isset($time[1]) )
				$time[1] = 0;
			if ( !isset($time[2]) )
				$time[2] = 0;
		return $time[0]*3600 + $time[1]*60 + $time[2];
		}else
		{	return false;
		}
	
	}


	function sectotime($s)
	{
		$hour = floor($s / 3600);
		if ( $hour < 0 )
			$hour = 0;
		$hour = $hour < 10 ? '0' . $hour : $hour;
		$min = floor( ($s % 3600) / 60);
		if ( $min < 0 )
			$min = 0;
		$min = $min < 10 ? '0' . $min : $min;
		$sec = $s % 60;
		if ( $sec < 0 )
			$sec = 0;
		$sec = $sec < 10 ? '0' . $sec : $sec;
		return "$hour:$min:$sec";
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
	    $campaigns_results = $this->dashboard_model->campaigns_consolidated();
	    $data['campaigns_results'] = $campaigns_results;
	    $data['total_campaigns_results'] = count($campaigns_results);
	  
	    //All Consent Candidates date wise Results
	    $cand_consent_results = $this->dashboard_model->candidates_consent_consolidated();
	    $data['cand_consent_results'] = $cand_consent_results;
	    $data['total_consent_candidates'] = count($cand_consent_results);
	   
		$this->load->view('admin/dashboard',$data);
	}

}	
?>