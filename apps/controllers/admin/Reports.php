<?php
//error_reporting(-1);
//ini_set('display_errors', 1);
defined('BASEPATH') OR exit('No direct script access allowed');
class Reports extends CI_Controller {


public function __construct()
	{
		parent:: __construct();
		valid_logged_in(FALSE,'A');	
		$this->load->model('admin/reports_model');
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
		
	
   public function consent_candidates_export_to_excel($start_date,$end_date,$search_by,$search_value)
	{	
		$arrResult = $this->reports_model->consent_candidates_report_export_to_excel($start_date,$end_date,$search_by,$search_value);
		//echo "<PRE>";print_r($arrResult);die;
		$columns = array(
							"A1" => 'SR NO.',
							"B1" => 'APPLICATIONNO',
							"C1" => 'CANDIDATEID',
							"D1" => 'FULL NAME',
							"E1" => 'DATE_OF_BIRTH',
							"F1" => 'MOBILE_NUMBER',
							"G1" => 'Date when consent message was sent',
							"H1" => 'Consent Received(Y/N)',
							"I1" => 'Date of Consent received',
							"J1" => 'Time of Consent received',
							"K1" => 'IP Address from which consent was received',
						);
	    $colIndex = array('A','B','C','D','E','F','G','H','I','J','K');	
				  
		$arrInfo['result'] = $arrResult;
		$arrInfo['columns'] = $columns;
		$arrInfo['colIndex'] = $colIndex;
		end($columns);
		$lastKey = key($columns);
		reset($columns);
		$firstKey = key($columns);
		$arrInfo['firstKey'] = $firstKey;
		$arrInfo['lastKey'] = $lastKey;
		$arrInfo['file_name'] = 'Consent Candidates Report.xls';
		$arrInfo['title'] = 'Consent Candidates Report';
		if($arrResult != '')
		{			
			$i = 2; 
			$sr_no = 0;	
			$arrData = array();	
			$consent_status_array = consent_status_array();
			
			foreach($arrResult as $row)
			{
				$sr_no += 1;
				if($row->consent_update_on!='0000-00-00 00:00:00' && $row->consent_update_on!=NULL)
				{
				  $timestamp = strtotime($row->consent_update_on);			
				  $consent_update_date =  date('d/M/Y', $timestamp);
				  $consent_update_time =  date('g:i a', $timestamp);
				  
				}
				else
				{
				  $consent_update_date='';
				  $consent_update_time='';
				}
				if($row->consent_status=='3')
				$consent_status='Y';
				else
				$consent_status ='N';
				/*
				$this->$db->select('sent_datetime'); 
				$this->$db->from('mail_sms_log_details');
				$this->$db->where('email_subject','');
				$this->$db->where('candidate_id',$row->candidate_id);
				$this->$db->order_by('log_detail_id', 'DESC');
				$this->$db->limit(1);
				$lastlogquery = $this->$db->get();
				if($lastlogquery->num_rows()>0){
					$lastlogrow = $lastlogquery->row();
					$lastmsgsendon = Dateformat($lastlogrow->sent_datetime);
				}
				else
				{*/
					$lastmsgsendon = Dateformat($row->created_on);
				//}
			
				$arrData["sr_no"] = $sr_no;	
				$arrData["application_no"] = htmlspecialchars($row->application_no);
				$arrData["candidateid"] = $row->candidateid;
				$arrData["applicant_full_name"] =  htmlspecialchars_decode($row->applicant_full_name);
				$arrData["date_of_birth"] =  date('d/M/Y',strtotime($row->date_of_birth));
				$arrData["mobile_no"] = $row->mobile_no;
				$arrData["created_on"] = $lastmsgsendon;
				$arrData["consent_received"] = $consent_status;
				$arrData["consent_update_date"] = $consent_update_date;
				$arrData["consent_update_time"] = $consent_update_time;
				$arrData["ip_address"] = $row->IP_address;
				
				$arr[] = $arrData;
				
			}	
			$arrInfo['arr'] = $arr;
		}
		//echo "<PRE>";print_r($arrInfo['arr']);die;
		exportToExcel($arrInfo);
		
	}	
	
	
    public function consent_candidates_posp_export_to_excel($start_date,$end_date,$search_by,$search_value)
	{	
		$arrResult = $this->reports_model->consent_candidates_posp_report_export_to_excel($start_date,$end_date,$search_by,$search_value);
		//echo "<PRE>";print_r($arrResult);die;
		$columns = array(
							"A1" => 'Gender',
							"B1" => 'URN No',
							"C1" => 'Licence No',
							"D1" => 'Application No',
							"E1" => 'Candidate Name',
							"F1" => 'Father Name',
							"G1" => 'Location',
							"H1" => 'Agent No',
							"I1" => 'Zone',
							"J1" => 'State',
							"K1" => 'Branch Code',
							"L1" => 'UM Name',
							"M1" => 'SM Name',
							"N1" => 'Date of Birth',
							"O1" => 'Email',
							"P1" => 'Mobile No',
							"Q1" => 'CSM Mobile',
							"R1" => 'BE',
							"S1" => 'LoginID',
							"T1" => 'Password',
							"U1" => 'Qualification',
						  );
		$colIndex = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U');	
		$arrInfo['result'] = $arrResult;
		$arrInfo['columns'] = $columns;
		$arrInfo['colIndex'] = $colIndex;
		end($columns);
		$lastKey = key($columns);
		reset($columns);
		$firstKey = key($columns);
		$arrInfo['firstKey'] = $firstKey;
		$arrInfo['lastKey'] = $lastKey;
		$arrInfo['file_name'] = 'Consent Candidates POSP Format.xls';
		$arrInfo['title'] = 'Consent Candidates POSP Format';
		if($arrResult != '')
		{			
			$i = 2; 
			$sr_no = 0;	
			$arrData = array();	
			foreach($arrResult as $row)
			{
				$sr_no += 1;
				
				$arrData["gender"] = $row->gender;	
				$arrData["urn_no"] = htmlspecialchars($row->candidateid);
				$arrData["licence_no"] ='';
				$arrData["application_no"] = htmlspecialchars($row->application_no);
				$arrData["candidate_name"] =  htmlspecialchars_decode($row->applicant_full_name);
				$arrData["father_name"] = htmlspecialchars($row->father_name);
				$arrData["location"] = htmlspecialchars($row->city);
				$arrData["agent_no"] ='';
				$arrData["zone"] ='';
				$arrData["state"] =htmlspecialchars($row->state);
				$arrData["branch_code"] ='';
				$arrData["um_name"] ='';
				$arrData["sm_name"] ='';
				$arrData["date_of_birth"] =  date('d-M-Y',strtotime($row->date_of_birth));
				$arrData["email"] = $row->email_id;
				$arrData["mobile_no"] = $row->mobile_no;
				$arrData["csm_mobile"] ='';
				$arrData["be"] = '';
				$arrData["login_id"] = htmlspecialchars($row->candidateid);
				$arrData["password"] = htmlspecialchars($row->candidateid);
				$arrData["qualification"] = htmlspecialchars($row->educational_qualification);
				
				$arr[] = $arrData;
				
			}	
			$arrInfo['arr'] = $arr;
		}
		//echo "<PRE>";print_r($arrInfo['arr']);die;
		exportToExcel($arrInfo);
		
	}	
	
	
	
	 public function campaign_link_export_to_excel($campaign_id,$start_date,$end_date,$search_by,$search_value)
	 {	
		$arrResult = $this->reports_model->campaign_link_report_export_to_excel($campaign_id,$start_date,$end_date,$search_by,$search_value);
		//echo "<PRE>";print_r($arrResult);die;
		$columns = array(
							"A1" => 'SR NO.',
							"B1" => 'APPLICATIONNO',
							"C1" => 'CANDIDATEID',
							"D1" => 'FULL NAME',
							"E1" => 'DATE_OF_BIRTH',
							"F1" => 'MOBILE_NUMBER',
							"G1" => 'Last consent message was sent',
							"H1" => 'Consent Received(Y/N)'
						);
	    $colIndex = array('A','B','C','D','E','F','G','H');	
				  
		$arrInfo['result'] = $arrResult;
		$arrInfo['columns'] = $columns;
		$arrInfo['colIndex'] = $colIndex;
		end($columns);
		$lastKey = key($columns);
		reset($columns);
		$firstKey = key($columns);
		$arrInfo['firstKey'] = $firstKey;
		$arrInfo['lastKey'] = $lastKey;
		$arrInfo['file_name'] = 'Consent Link Candidates Report.xls';
		$arrInfo['title'] = 'Consent Link Candidates Report';
		if($arrResult != '')
		{			
			$i = 2; 
			$sr_no = 0;	
			$arrData = array();	
			foreach($arrResult as $row)
			{
				$sr_no += 1;
				
				if($row->consent_status=='3')
				$consent_status='Y';
				else
				$consent_status ='N';
			
				$arrData["sr_no"] = $sr_no;	
				$arrData["application_no"] = htmlspecialchars($row->application_no);
				$arrData["candidateid"] = $row->candidateid;
				$arrData["applicant_full_name"] =  htmlspecialchars_decode($row->applicant_full_name);
				$arrData["date_of_birth"] =  date('d/M/Y',strtotime($row->date_of_birth));
				$arrData["mobile_no"] = $row->mobile_no;
				$arrData["last_sent_date"] = Dateformat($row->last_sent_datetime);
				$arrData["consent_received"] = $consent_status;
				
				$arr[] = $arrData;
				
			}	
			$arrInfo['arr'] = $arr;
		}
		//echo "<PRE>";print_r($arrInfo['arr']);die;
		exportToExcel($arrInfo);
		
	}


}	
?>