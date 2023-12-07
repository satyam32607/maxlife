<?php
ini_set('memory_limit', '90024M');
ini_set('max_execution_time', 3600);
//error_reporting(-1);
//ini_set('display_errors', 1);
defined('BASEPATH') OR exit('No direct script access allowed');
class Language_reports extends CI_Controller {


public function __construct()
	{
		parent:: __construct();
		valid_logged_in(FALSE,'A');	
		$this->load->model('admin/language_reports_model');
		$this->load->helper('download');
		}
	
	
	public function report_date_wise(){	
	
	   $data=array();
	   $data['title'] = title." | Language Reports";
	   $data['main_heading'] = "Reports";
	   $data['heading'] = "Language Reports";
		
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
			 $start_date='2021-06-01'; 
			 
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
		$config["base_url"] = base_url() . "admin/language_reports/report_date_wise/".$batch_id."/".$start_date."/".$end_date."/".$search_by."/".$search_value."/".$per_page;
		$config["per_page"] = $per_page;
        $config["uri_segment"] = 10;
		$config["total_rows"] =$this->language_reports_model->count_language_date_wise($batch_id,$start_date,$end_date,$search_by,$search_value);
		$this->pagination->initialize($config);
        $page = ($this->uri->segment(10)) ? $this->uri->segment(10) : 0; 
		$data['results'] = $this->language_reports_model->view_language_date_wise($batch_id,$start_date,$end_date,$search_by,$search_value,$config['per_page'], $page);
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
	   $this->load->view('admin/reports/language_report_date_wise.php', $data);
		}
		

	
	 public function language_report_export_to_excel($batch_id,$start_date,$end_date,$search_by,$search_value)
	 {	
		$arrResult = $this->language_reports_model->language_report_export_to_excel($batch_id,$start_date,$end_date,$search_by,$search_value);
		//echo "<PRE>";print_r($arrResult);die;
		$columns = array(
							"A1" => 'SR NO.',
							"B1" => 'CANDIDATE ID',
							"C1" => 'APPLICATION NO',
							"D1" => 'FULL NAME',
							"E1" => 'DATE_OF_BIRTH',
							"F1" => 'MOBILE NUMBER',
							"G1" => 'REGISTERED DATE',
							"H1" => 'ENGLISH',
							"I1" => 'HINDI'
						);
	    $colIndex = array('A','B','C','D','E','F','G','H','I');	
				  
		$arrInfo['result'] = $arrResult;
		$arrInfo['columns'] = $columns;
		$arrInfo['colIndex'] = $colIndex;
		end($columns);
		$lastKey = key($columns);
		reset($columns);
		$firstKey = key($columns);
		$arrInfo['firstKey'] = $firstKey;
		$arrInfo['lastKey'] = $lastKey;
		$arrInfo['file_name'] = 'Candidates Language  Report-'.date('Y-m-d').'.xls';
		$arrInfo['title'] = 'Candidates Language  Report';
		if($arrResult != '')
		{			
			$i = 2; 
			$sr_no = 0;	
			$arrData = array();	
			foreach($arrResult as $row)
			{
				$sr_no += 1;
				
				
			   if($row->candidate_date_of_birth=='0000-00-00')
			   $candidate_date_of_birth='';
			   else
			   $candidate_date_of_birth = date("M d, Y",strtotime($row->candidate_date_of_birth));
			   
				$langchapter=  $this->language_reports_model->chaps_languages($row->candidate_id, $row->course_id,'2');
				$langavgresult =explode("|||",$langchapter);
				$langavg_eng= ($langavgresult[0]/27)*100;
				$langavg_hi= ($langavgresult[1]/27)*100;
				
				if($langavg_eng>0) 
				$langavgeng = round($langavg_eng,2).'%';
				else
				$langavgeng='';
				
				if($langavg_hi>0)
				$langavghi = round($langavg_hi,2).'%';
				else
				$langavghi='';
										  
			
				$arrData["sr_no"] = $sr_no;	
				$arrData["candidate_login_id"] = htmlspecialchars($row->candidate_login_id);
				$arrData["application_no"] = $row->application_no;
				$arrData["candidate_name"] =  htmlspecialchars_decode($row->candidate_name);
				$arrData["date_of_birth"] =  $candidate_date_of_birth;
				$arrData["candidate_mobile"] = $row->candidate_mobile;
				$arrData["candidate_registered_on"] =date("M d, Y",strtotime($row->candidate_registered_on));
				$arrData["english"] = $langavgeng;
				$arrData["hindi"] = $langavghi;
				
				$arr[] = $arrData;
				
			}	
			$arrInfo['arr'] = $arr;
		}
		//echo "<PRE>";print_r($arrInfo['arr']);die;
		exportToExcel($arrInfo);
		
	}


}	
?>