<?php
//error_reporting(-1);
//ini_set('display_errors', 1);
defined('BASEPATH') OR exit('No direct script access allowed');
class Trainingpushreports extends CI_Controller {


public function __construct()
	{
		parent:: __construct();
		valid_logged_in(FALSE,'A');	
		$this->load->model('admin/trainingpushreports_model');
		$this->load->helper('download');
		}
	
	
	public function push_report(){	
	
	   $data=array();
	   $data['title'] = title." | Push Reports";
	   $data['main_heading'] = "Reports";
	   $data['heading'] = "Push Reports";
		
	   //print_r($_POST);	
	    if($this->input->post('batch_id'))
			 $batch_id = $this->input->post('batch_id');
		 elseif($this->uri->segment('4'))
			 $batch_id=$this->uri->segment('4');
		else
			 $batch_id='0';
		
	     if($this->input->post('start_date'))
			 $start_date = $this->input->post('start_date');
		  elseif($this->uri->segment('5'))
			 $start_date=$this->uri->segment('5');
		  else
			 $start_date=date("Y-m-d",strtotime("-3 days",strtotime(date("Y-m-d")))); 
			 
		  if($this->input->post('end_date'))
			 $end_date = $this->input->post('end_date');
		   elseif($this->uri->segment('6'))
			 $end_date=$this->uri->segment('6');
		   else
			 $end_date=date('Y-m-d'); 
		
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
		$config["base_url"] = base_url() . "admin/trainingpushreports/push_report/".$batch_id."/".$start_date."/".$end_date."/".$search_by."/".$search_value."/".$per_page;
		$config["per_page"] = $per_page;
        $config["uri_segment"] = 10;
		$config["total_rows"] =$this->trainingpushreports_model->count_push_report($batch_id,$start_date,$end_date,$search_by,$search_value);
		$this->pagination->initialize($config);
        $page = ($this->uri->segment(10)) ? $this->uri->segment(10) : 0; 
		$data['results'] = $this->trainingpushreports_model->view_push_report($batch_id,$start_date,$end_date,$search_by,$search_value,$config['per_page'], $page);
		$data['links']   = $this->pagination->create_links();
		$data['num_rows'] = $config['total_rows'];	
		
		$data['batch_id'] = $batch_id;
		$data['start_date'] = $start_date;
		$data['end_date'] = $end_date;
		$data['search_by'] = $search_by;	
		$data['search_value'] = $search_value;	
		$data['per_page'] = $per_page;
		/* echo "<pre>"; 	 
		print_r($data);	  
		 echo "</pre>"; */	 
	   $this->load->view('admin/trainingpushreports/push_report.php', $data);
		}
		
		
	public function push_report_date_wise(){	
	
	   $data=array();
	   $data['title'] = title." | Push Report date wise";
	   $data['main_heading'] = "Reports";
	   $data['heading'] = "Push Report date wise";
		
	     //print_r($_POST);	
		  if($this->input->post('candidate_id'))
			 $candidate_id = $this->input->post('candidate_id');
		  elseif($this->uri->segment('4'))
			 $candidate_id=$this->uri->segment('4');
		  else
			 $candidate_id='0'; 
			 
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
		elseif($this->uri->segment('0'))
			$per_page=$this->uri->segment('0');
		else
			$per_page=per_page;	
			
		$config = array();
		$config["base_url"] = base_url() . "admin/trainingpushreports/push_report_date_wise/".$candidate_id."/".$end_date."/".$search_by."/".$search_value."/".$per_page;
		$config["per_page"] = $per_page;
        $config["uri_segment"] = 10;
		$config["total_rows"] =$this->trainingpushreports_model->count_push_report_date_wise($candidate_id,$start_date,$end_date,$search_by,$search_value);
		$this->pagination->initialize($config);
        $page = ($this->uri->segment(10)) ? $this->uri->segment(10) : 0; 
		$data['results'] = $this->trainingpushreports_model->view_push_report_date_wise($candidate_id,$start_date,$end_date,$search_by,$search_value,$config['per_page'], $page);
		$data['links']   = $this->pagination->create_links();
		$data['num_rows'] = $config['total_rows'];	
		
		$data['candidate_id'] = $candidate_id;
		$data['start_date'] = $start_date;
		$data['end_date'] = $end_date;
		$data['search_by'] = $search_by;	
		$data['search_value'] = $search_value;	
		$data['per_page'] = $per_page;
		  	  
	    $this->load->view('admin/trainingpushreports/push_report_date_wise.php', $data);
		}
		
		
		
	public function push_report_export_to_excel($batch_id,$start_date,$end_date,$search_by,$search_value)
	{	
	  /* $start_date='2021-01-01';
	   $end_date='2022-05-25';*/
	  	$arrResult = $this->trainingpushreports_model->push_report_export_to_excel($batch_id,$start_date,$end_date,$search_by,$search_value);
		//echo "<PRE>";print_r($arrResult);die;
		$columns = array(
						"A1" => 'SR No.',
						"B1" => 'Candidate ID',
						"C1" => 'Candidate Name',
						"D1" => 'Hours Allocated',
						"E1" => 'Location',
						"F1" => 'IRDA URN',
						"G1" => 'Batch Id',
						"H1" => 'Login Id',
						"I1" => 'Password',
						"J1" => 'Issue Date',
						"K1" => 'Expiry Date',
						"L1" => 'StartDate',
						"M1" => 'EndDate',
						"N1" => 'Last Login Date',
						"O1" => 'Comp Hrs',
						"P1" => 'Left Hrs',
						"Q1" => 'Status',
						"R1" => 'TSP',
						"S1" => 'Training Completed End date'
						);
		$colIndex = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S');	
				  
		$arrInfo['result'] = $arrResult;
		$arrInfo['columns'] = $columns;
		$arrInfo['colIndex'] = $colIndex;
		end($columns);
		$lastKey = key($columns);
		reset($columns);
		$firstKey = key($columns);
		$arrInfo['firstKey'] = $firstKey;
		$arrInfo['lastKey'] = $lastKey;
		
		$arrInfo['file_name'] = ' '.$start_date.' - '.$end_date.' PUSH_training_monitoring.xls';
		$arrInfo['title'] = ' '.$start_date.' - '.$end_date.' PUSH_training_monitoring';
		$arrInfo['total_col_name'] = 'S';
		if($arrResult != '')
		{			
			$i = 2; 
			$sr_no = 0;	
			$arrData = array();	
			
			foreach($arrResult as $row)
			{
			    $payload = json_decode($row->last_data->push_data);
				
				$registration_date = $payload->data->registrationDate;
				$regyear =  substr($registration_date,0,4);
				$regmonth =  substr($registration_date,4,2);
				$regday =  substr($registration_date,6,8);
				$issue_date = $regyear.'-'.$regmonth.'-'.$regday;
				
				if(isset($payload->data->startDate))
				{
					$startdate = $payload->data->startDate;
					$startdtyear =  substr($startdate,0,4);
					$startdtmonth =  substr($startdate,4,2);
					$startdtday =  substr($startdate,6,8);
					$start_date = $startdtyear.'-'.$startdtmonth.'-'.$startdtday;
				}
				else
				{
					$start_date='';
				}
				if(isset($payload->data->endDate))
				{
					$enddate = $payload->data->endDate;
					$enddtyear =  substr($enddate,0,4);
					$enddtmonth =  substr($enddate,4,2);
					$enddtday =  substr($enddate,6,8);
					$end_date = $enddtyear.'-'.$enddtmonth.'-'.$enddtday;
				}else
				{
					$end_date='';
				}
				if(isset($payload->data->lastLoginDate))
				{
					$lastlogindate = $payload->data->lastLoginDate;
					$logindtyear =  substr($lastlogindate,0,4);
					$logindtmonth =  substr($lastlogindate,4,2);
					$logindtday =  substr($lastlogindate,6,8);
					$last_login_date = $logindtyear.'-'.$logindtmonth.'-'.$logindtday;
				}
				else
				{
					$last_login_date='';
				}
				
				if(isset($payload->data->trainingCompletedDate))
				{
					$trngcompdate = $payload->data->trainingCompletedDate;
					$trngdtyear =  substr($trngcompdate,0,4);
					$trngdtmonth =  substr($trngcompdate,4,2);
					$trngdtday =  substr($trngcompdate,6,8);
					$training_completed_date = $trngdtyear.'-'.$trngdtmonth.'-'.$trngdtday;
				}
				else
				{
					$training_completed_date='';
				}
			
				$sr_no += 1;
				$arrData["sr_no"] = $sr_no;	
				$arrData["candidate_id"] = htmlspecialchars($row->candidate_login_id);
				$arrData["candidate_name"] = htmlspecialchars($row->candidate_name);
				$arrData["hours_allocated"] = 25;
				$arrData["location"] = '';
				$arrData["irda_urn"] = htmlspecialchars($row->candidate_login_id);
				$arrData["batch_id"] ='-';
				$arrData["login_id"] = htmlspecialchars($row->candidate_login_id);
				$arrData["password"] = '';
				$arrData["issue_date"] = htmlspecialchars($issue_date);
				$arrData["expiry_date"] =date('d-m-Y',strtotime($row->batch_end_date));
				$arrData["start_date"] = htmlspecialchars($start_date);
				$arrData["end_date"] = htmlspecialchars($end_date);
				$arrData["lastlogindate"] =  htmlspecialchars($last_login_date);
				$arrData["comp_hrs"] = htmlspecialchars($payload->data->completedHrs);
				$arrData["left_hrs"] = htmlspecialchars($payload->data->leftHrs);
				$arrData["status"] = htmlspecialchars($payload->data->status);
				$arrData["tsp"] = htmlspecialchars('DW');
				$arrData["training_completed_date"] = htmlspecialchars($training_completed_date);
					
				
				$arr[] = $arrData;
			}
			$arrInfo['info'] = ' '.$start_date.' - '.$end_date.' - PUSH_training_monitoring';
			$arrInfo['arr'] = $arr;
		}
		//echo "<PRE>";print_r($arrInfo);die;
		exportToExcel($arrInfo);
		
	}	


}	
?>