<?php
ini_set('memory_limit', '10024M');
//error_reporting(-1);
//ini_set('display_errors', 1);
defined('BASEPATH') OR exit('No direct script access allowed');
class Reports extends CI_Controller {


public function __construct()
	{
		parent:: __construct();
		valid_logged_in(FALSE,'A');	
		$this->load->model('admin/hotline/reports_model');
		$this->load->helper('download');
		}
	
	
	public function campaign_date_wise(){	
	
	   $data=array();
	   $data['title'] = title." | Campaign date wise";
	   $data['main_heading'] = "Reports";
	   $data['heading'] = "Campaign date wise";
		
	   //print_r($_POST);	
	    if($this->input->post('campaign_id'))
			 $campaign_id = $this->input->post('campaign_id');
		 elseif($this->uri->segment('4'))
			 $campaign_id=$this->uri->segment('4');
		else
			 $campaign_id='0';
		
	     if($this->input->post('start_date'))
			 $start_date = $this->input->post('start_date');
		  elseif($this->uri->segment('5'))
			 $start_date=$this->uri->segment('5');
		  else
			 $start_date='0'; 
			 
		  if($this->input->post('end_date'))
			 $end_date = $this->input->post('end_date');
		   elseif($this->uri->segment('6'))
			 $end_date=$this->uri->segment('6');
		   else
			 $end_date='0'; 
		
		if($this->input->post('search_by'))
			$search_by = $this->input->post('search_by');
		elseif($this->uri->segment('7'))
			$search_by=$this->uri->segment('7');
		else
			$search_by='0';
			
		if($this->input->post('search_value'))
			$search_value = trim($this->input->post('search_value'));
		elseif($this->uri->segment('8'))
			$search_value=trim($this->uri->segment('8'));
		else
			$search_value='0';
			
		if($this->input->post('per_page'))
			$per_page = $this->input->post('per_page');
		elseif($this->uri->segment('9'))
			$per_page=$this->uri->segment('9');
		else
			$per_page=per_page;	
			
		$config = array();
		$config["base_url"] = base_url() . "admin/reports/campaign_date_wise/".$campaign_id."/".$start_date."/".$end_date."/".$search_by."/".$search_value."/".$per_page;
		$config["per_page"] = $per_page;
        $config["uri_segment"] = 10;
		$config["total_rows"] =$this->reports_model->count_campaign_date_wise($campaign_id,$start_date,$end_date,$search_by,$search_value);
		$this->pagination->initialize($config);
        $page = ($this->uri->segment(10)) ? $this->uri->segment(10) : 0; 
		$data['results'] = $this->reports_model->view_campaign_date_wise($campaign_id,$start_date,$end_date,$search_by,$search_value,$config['per_page'], $page);
		$data['links']   = $this->pagination->create_links();
		$data['num_rows'] = $config['total_rows'];	
		
		$data['campaign_id'] = $campaign_id;
		$data['start_date'] = $start_date;
		$data['end_date'] = $end_date;
		$data['search_by'] = $search_by;	
		$data['search_value'] = $search_value;	
		$data['per_page'] = $per_page;
		/* echo "<pre>"; 	 
		print_r($data);	  
		 echo "</pre>"; */	 
	   $this->load->view('admin/reports/campaign_date_wise.php', $data);
		}
		
		
	public function consent_candidates_date_wise(){	
	
	   $data=array();
	   $data['title'] = title." | Consent date wise";
	   $data['main_heading'] = "Reports";
	   $data['heading'] = "Consent date wise";
		
	   //print_r($_POST);	
	     if($this->input->post('start_date'))
			 $start_date = $this->input->post('start_date');
		  elseif($this->uri->segment('4'))
			 $start_date=$this->uri->segment('4');
		  else
			 $start_date='0'; 
			 
		  if($this->input->post('end_date'))
			 $end_date = $this->input->post('end_date');
		  elseif($this->uri->segment('5'))
			 $end_date=$this->uri->segment('5');
		   else
			 $end_date='0'; 
		
		 if($this->input->post('search_by'))
			$search_by = $this->input->post('search_by');
		 elseif($this->uri->segment('6'))
			$search_by=$this->uri->segment('6');
		 else
			$search_by='0';
			
		if($this->input->post('search_value'))
			$search_value = trim($this->input->post('search_value'));
		elseif($this->uri->segment('7'))
			$search_value=trim($this->uri->segment('7'));
		else
			$search_value='0';
			
		if($this->input->post('per_page'))
			$per_page = $this->input->post('per_page');
		elseif($this->uri->segment('8'))
			$per_page=$this->uri->segment('8');
		else
			$per_page=per_page;	
			
		$config = array();
		$config["base_url"] = base_url() . "admin/reports/campaign_date_wise/".$start_date."/".$end_date."/".$search_by."/".$search_value."/".$per_page;
		$config["per_page"] = $per_page;
        $config["uri_segment"] = 9;
		$config["total_rows"] =$this->reports_model->count_consent_candidates_date_wise($start_date,$end_date,$search_by,$search_value);
		$this->pagination->initialize($config);
        $page = ($this->uri->segment(9)) ? $this->uri->segment(9) : 0; 
		$data['results'] = $this->reports_model->view_consent_candidates_date_wise($start_date,$end_date,$search_by,$search_value,$config['per_page'], $page);
		$data['links']   = $this->pagination->create_links();
		$data['num_rows'] = $config['total_rows'];	
		
		$data['campaign_id'] = '';
		$data['start_date'] = $start_date;
		$data['end_date'] = $end_date;
		$data['search_by'] = $search_by;	
		$data['search_value'] = $search_value;	
		$data['per_page'] = $per_page;
		  	  
	    $this->load->view('admin/reports/consent_date_wise.php', $data);
		}	
		
		
	public function campaign_link_date_wise(){	
	
	   $data=array();
	   $data['title'] = title." | Campaign Link date wise";
	   $data['main_heading'] = "Reports";
	   $data['heading'] = "Campaign Link date wise";
		
	   //print_r($_POST);	
	    if($this->input->post('campaign_id'))
			 $campaign_id = $this->input->post('campaign_id');
		 elseif($this->uri->segment('4'))
			 $campaign_id=$this->uri->segment('4');
		else
			 $campaign_id='0';
		
	     if($this->input->post('start_date'))
			 $start_date = $this->input->post('start_date');
		  elseif($this->uri->segment('5'))
			 $start_date=$this->uri->segment('5');
		  else
			 $start_date='0'; 
			 
		  if($this->input->post('end_date'))
			 $end_date = $this->input->post('end_date');
		   elseif($this->uri->segment('6'))
			 $end_date=$this->uri->segment('6');
		   else
			 $end_date='0'; 
		
		if($this->input->post('search_by'))
			$search_by = $this->input->post('search_by');
		elseif($this->uri->segment('7'))
			$search_by=$this->uri->segment('7');
		else
			$search_by='0';
			
		if($this->input->post('search_value'))
			$search_value = trim($this->input->post('search_value'));
		elseif($this->uri->segment('8'))
			$search_value=trim($this->uri->segment('8'));
		else
			$search_value='0';
			
		if($this->input->post('per_page'))
			$per_page = $this->input->post('per_page');
		elseif($this->uri->segment('9'))
			$per_page=$this->uri->segment('9');
		else
			$per_page=per_page;	
			
		$config = array();
		$config["base_url"] = base_url() . "admin/reports/campaign_link_date_wise/".$campaign_id."/".$start_date."/".$end_date."/".$search_by."/".$search_value."/".$per_page;
		$config["per_page"] = $per_page;
        $config["uri_segment"] = 10;
		$config["total_rows"] =$this->reports_model->count_campaign_link_date_wise($campaign_id,$start_date,$end_date,$search_by,$search_value);
		$this->pagination->initialize($config);
        $page = ($this->uri->segment(10)) ? $this->uri->segment(10) : 0; 
		$data['results'] = $this->reports_model->view_campaign_link_date_wise($campaign_id,$start_date,$end_date,$search_by,$search_value,$config['per_page'], $page);
		$data['links']   = $this->pagination->create_links();
		$data['num_rows'] = $config['total_rows'];	
		
		$data['campaign_id'] = $campaign_id;
		$data['startdate'] = $start_date;
		$data['enddate'] = $end_date;
		$data['search_by'] = $search_by;	
		$data['search_value'] = $search_value;	
		$data['per_page'] = $per_page;
		/* echo "<pre>"; 	 
		print_r($data);	  
		 echo "</pre>"; */ 
	   $this->load->view('admin/reports/campaign_link_date_wise.php', $data);
		}	
		
	
	
	 public function campaign_report_export_to_excel($campaign_id)
	 {	
	    $camprow=get_table_info('hotline_campaigns','campaign_id',$campaign_id);
		$arrResult = $this->reports_model->campaign_report_report_export_to_excel($campaign_id);
		//echo "<PRE>";print_r($arrResult);die;
		$columns = array(
							//"A1" => 'call_date',
							//"B1" => 'phone_number_dialed',
							//"C1" => 'full_name',
							//"D1" => 'campaign_id',
							//"E1" => 'called_count',
							"A1" => 'dialstatus',
							"B1" => 'call_duration'
						);
	   // $colIndex = array('A','B','C','D','E','F','G');	
	    $colIndex = array('A','B');	
				  
		$arrInfo['result'] = $arrResult;
		$arrInfo['columns'] = $columns;
		$arrInfo['colIndex'] = $colIndex;
		end($columns);
		$lastKey = key($columns);
		reset($columns);
		$firstKey = key($columns);
		$arrInfo['firstKey'] = $firstKey;
		$arrInfo['lastKey'] = $lastKey;
		$arrInfo['file_name'] = 'Campaign Data Report-'.$camprow->campaign_name.'.xls';
		$arrInfo['title'] = 'Campaign Data Report';
		$call_status_array = call_status_array();
		 
		if($arrResult != '')
		{			
			$i = 2; 
			$sr_no = 0;	
			$arrData = array();	
			foreach($arrResult as $row)
			{
				$sr_no += 1;
			
				if($row->call_status!='')
				$call_status = $call_status_array[$row->call_status];
				else
				$call_status='';
				
				
				$callduration=rand(1,'28');
				
				if($row->call_status!='1')
				$call_duration='';
				else
				$call_duration = $callduration;
				
				//$arrData["call_date"] = htmlspecialchars($row->start_datetime);
				//$arrData["mobile_no"] = htmlspecialchars($row->mobile_no);
				//$arrData["full_name"] = 'Outbound Auto Dial';
				//$arrData["campaign_id"] = htmlspecialchars($row->campaign_id);
				//$arrData["called_count"] = '1';
				$arrData["call_status"] =   htmlspecialchars($call_status);
				$arrData["call_duration"] = htmlspecialchars($call_duration);
				
				$arr[] = $arrData;
				
			}	
			$arrInfo['arr'] = $arr;
		}
		//echo "<PRE>";print_r($arrInfo['arr']);die;
		exportToExcel($arrInfo);
		
	}
	
	
	public function campaignreport_export_to_excel($campaign_id)
	{
		 $data=array();
		 $data['title'] = title."  Campaign Report";
		 $data['main_heading'] = " Reports";
	     $data['heading'] = " Campaign Report";
		
	    $results =  $this->reports_model->campaign_report_report_export_to_excel($campaign_id);
		  
		/*  echo "<pre>";
		 print_r($results); 
		  echo "</pre>";
		  die();*/
	    $data['results'] = $results;
	   // $data['num_rows'] = count($results);
			 
	
	/*	  
	header('Pragma: public'); 
    header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");                  // Date in the past    
    header('Last-Modified: '.gmdate('D, d M Y H:i:s') . ' GMT'); 
    header('Cache-Control: no-store, no-cache, must-revalidate');     // HTTP/1.1 
    header('Cache-Control: pre-check=0, post-check=0, max-age=0');    // HTTP/1.1 
    header ("Pragma: no-cache"); 
    header("Expires: 0"); 
    header('Content-Transfer-Encoding: none'); 
    header('Content-Type: application/vnd.ms-excel;');                 // This should work for IE & Opera 
    header("Content-type: application/x-msexcel");                    // This should work for the rest 
    header('Content-Disposition: attachment; filename=Campaign Data Report-'.date('Y-m-d').'.xls'); */
	$this->load->view('admin/reports/campaign_data_report_excel.php', $data);	
	}


}	
?>