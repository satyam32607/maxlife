<?php


class Campaigns_model extends CI_Model
{
	
	function get_candidates($campaign_id)
		{
			$this->db->select('consent_candidates.candidate_id,consent_candidates.applicant_full_name,consent_candidates.email_id,consent_candidates.mobile_no,campaign_logs.campaign_log_id');
			$this->db->from('consent_candidates');
			$this->db->join('campaign_logs', 'campaign_logs.candidate_id = consent_candidates.candidate_id');
			$this->db->where('campaign_logs.campaign_id',$campaign_id);
			$this->db->where('campaign_logs.candidate_status !=', '3');
			$this->db->where('consent_candidates.is_active', '1');
			$this->db->where('campaign_logs.unique_id !=', '');
			$this->db->order_by('campaign_logs.campaign_log_id', 'ASC');
			$query = $this->db->get();
			$result = $query->result();
			//echo $this->db->last_query();
			//echo "<br>";
			//echo "<br>";
			
			return $result;
	
		} //End of View function
		
		
		function get_alert_candidates_list($campaign_id)
		{
			/*$candidate_ids=array('CI200240418','CI200239959','CI190206910','CI190210883','CI190214069','CI190212969','CI190215229','CI190223518','CI200235169','CI190215943','CI190220216','CI190220861','CI200242688','CI190220064','CI200243657','CI190196604','CI190216827','CI200234493','CI190204270','CI190225218','CI200241067','CI200242697','CI190210263','CI200243858','CI190218729','CI190216471');*/
			
			/*$candidate_ids=array(
			'CI200227812','CI190203510','CI200237868','CI200229204','CI190203919','CI190201726','CI200229049','CI190208513','CI200240526','CI200229547','CI200239867','CI200232064','CI190226645','CI190219074','CI200232662','CI190199548','CI200237089','CI200232009','CI200232102','CI200242104','CI200242504','CI200226646','CI200238690','CI200227197','CI200235955','CI200235263','CI190203768','CI190201653','CI200234718','CI190209305','CI200233447','CI190201610','CI190208626','CI190215511','CI200243495','CI190224831','CI190205779','CI200243249','CI190203431','CI190221684','CI200227238','CI200237219','CI190222228','CI190224363','CI200244307','CI200229584','CI190226745','CI200240814','CI200000058','CI200000058','CI200233510','CI200238557','CI200228907','CI200234573','CI200227727','CI200236442','CI200236768','CI190209393','CI200240030','CI190222994','CI190222171','CI200242628','CI190213031','CI190219229','CI190222529','CI190219986','CI200230859','CI200241038','CI200226007','CI200241860','CI190193631','CI200236513','CI200240004','CI190218958','CI200241506','CI190205510','CI190225766','CI200238640','CI190205889','CI190220413','CI200224804','CI190225326','CI200238619','CI200229614','CI190221129','CI200244267','CI200000693','CI190226737','CI200234239','CI190212313','CI200232660','CI200225835','CI200240898','CI200231696','CI190210911','CI190219907','CI200240372','CI190220811','CI200230784','CI190209782','CI200239724','CI200231461','CI200239639','CI200224973','CI200241424','CI190204324','CI190203719','CI200227855','CI200225365','CI200237079','CI200240804','CI200225394');
			*/
			
//09 Feb 21	
/*	$candidate_ids=array('CI200228287','CI200241069','CI200234231','CI200232493','CI200226219','CI200227411','CI200000602','CI200233003','CI200242212','CI190211622','CI190224570','CI200241707','CI190205133','CI190200255','CI200239283');*/
			
//10 Feb 21		
/*$candidate_ids=array('CI200242777','CI200243060','CI200243328','CI200237260','CI190208372','CI200241049','CI200240662','CI190209585','CI200241168','CI200240388','CI190213743','CI190210259','CI200237397','CI200233591','CI190206073','CI190204421','CI190204825','CI200241592');*/
			
			//11 Feb 21			
			//$candidate_ids=array('CI190215241','CI200237667','CI190226875','CI190204881','CI200240456','CI190198392','CI190212390','CI190210605','CI190224607','CI200233508','CI200235707','CI200000457','CI190224258');
			//13 Feb 21		
			//$candidate_ids=array('CI200226915','CI200000357','CI200232133','CI200224649','CI200240668','CI200224539','CI200242325','CI200228284','CI190215855','CI190198236');
		//15 Feb 21		
		//$candidate_ids=array('CI190226561','CI200242951','CI200227201','CI190205674','CI200236034','CI200243307','CI200240618');
		
		//$candidate_ids=array('CI200239264','CI200227147','CI200240892','CI190217695');
/*		$candidate_ids=array('CI190209782','CI200240388','CI200239724','CI190224607','CI190208372','CI200241506','CI200227411','CI200235839','CI200000457','CI190202208','CI200244267','CI200226915','CI190220413','CI200232660','CI190225766','CI190215511','CI200241056','CI190222529','CI190204324','CI190215855','CI190212390','CI190209585','CI200224804','CI190204853','CI190204270','CI200234231','CI200226646','CI200243858','CI200232102','CI200243495','CI200243832','CI190205779','CI190201726','CI190203510','CI200240898','CI200238640','CI200240004','CI200240456','CI190213031');*/
		
		//19 Feb 21		
		//$candidate_ids=array('CI200228287','CI200240668','CI200238690','CI190203431','CI200227727','CI200236513','CI190216883','CI190215229','CI190223518','CI190211712','CI200243657','CI190210883','CI190219229');
		
	//	$candidate_ids=array('CI190204825','CI190220884','CI190216702','CI190215453','CI200241405','CI200234215','CI200226107');
	//22 Feb 21		
	//$candidate_ids=array('CI190217743','CI190224831','CI190223046','CI190222228','CI200242538','CI190212969','CI190206910','CI200238557','CI190224809','CI200241067','CI200240340','CI190217653','CI190204550','CI200238841');
	//23 Feb 21
	/*$candidate_ids=array('CI200241424',
	'CI190220216',
	'CI190216875',
	'CI200241038',
	'CI200243307',
	'CI190224533',
	'CI200243060');*/
	
/*	$candidate_ids=array(
'CI200231301',
'CI200237667',
'CI200230712',
'CI200233591',
'CI200239867',
'CI200229547',
'CI200240526');
	*/


//24 Feb 21
/*$candidate_ids=array('CI200240004','CI200239658','CI190222529','CI190204550','CI190211644','CI200243858','CI190209782','CI190223518','CI190210911','CI200240030','CI190210259','CI200239264','CI200239959','CI200238640','CI200242325','CI190215511','CI190203767','CI190203919','CI200237868','CI200244268','CI200240526','CI190219074','CI200237667','CI200227727','CI190223498','CI190215453','CI190209315','CI190203077');*/
//26 Feb 21
/*$candidate_ids=array('CI200228284','CI200235955','CI200235434','CI190204421','CI190226875','CI200239867','CI190220413','CI200000693','CI200235839','CI200241056','CI190204881','CI190211712','CI200241277','CI200240898','CI190224607','CI190212390','CI190203719','CI190218729','CI200234343');*/

//27 Feb 21
/*$candidate_ids=array('CI200232237','CI200234215','CI200233595','CI200229627','CI200225744','CI200243381','CI200236768','CI200232133','CI200227812','CI200227778','CI190203431');*/

	//01 Mar 21
	//$candidate_ids=array('CI190222171','CI200242604','CI190224258','CI200242391','CI200232796');
	
	//03 Mar 21
	//$candidate_ids=array('CI200243249','CI200241401','CI190207715','CI200239981','CI190225326','CI190196996','CI200227238','CI200226646','CI200235839','CI190226737','CI200240662','CI200244267','CI200226915','CI190225326','CI200234376','CI200227727','CI190201286','CI200226646','CI200241632','CI200233591','CI190219074');
	
	
	/*//04 Mar 21
	$candidate_ids=array('CI200227411','CI200235839','CI190225326','CI200235955','CI200237397','CI200227812','CI190210883','CI200239959','CI190211712','CI190207518','CI190212390','CI190211644','CI190208372','CI200242450','CI190214251','CI200241443');*/
	
	//04 Mar 21
	//$candidate_ids=array('CI190207518','CI190212390','CI190211644','CI190208372','CI190215453','CI190222171','CI190223518','CI190203919','CI200228502','CI200224804','CI200244268','CI190204421','CI190207517','CI200230712');
	
	//05 Mar 21
//	$candidate_ids=array('CI190204406','CI200233595','CI200240358','CI190220413','CI200232153','CI200240374','CI190215453');
	//06 Mar 21
	//$candidate_ids=array('CI190204825','CI190224607','CI200239724','CI190212313');
	//09 Mar 21
	//$candidate_ids=array('CI190208372','CI190207518','CI190209828','CI200241632','CI200232237','CI200232677');
   //10 Mar 21	
//	$candidate_ids=array('CI190225802','CI190222171','CI190216446','CI200233447','CI200228284','CI200242591');
	//11 Mar 21	
//	$candidate_ids=array('CI200000693','CI200235839','CI200241424','CI190210633','CI190214251');
	//12 Mar 21	
	//$candidate_ids=array('CI190204406','CI200241443','CI200232057','CI200243749','CI190203510','CI190224363','CI200227727','CI190194531','CI190213886','CI200237326','CI200240337','CI200235214');
	//13 Mar 21	
	//$candidate_ids=array('CI190224533');
	//15 Mar 21	
	//$candidate_ids=array('CI200232666','CI190208969','CI190225921','CI200229204','CI200227727','CI200229204','CI200243832','CI200243166');
			$candidate_ids=array('CIT200242758');

	
	$this->db->select('consent_candidates.candidate_id,consent_candidates.applicant_full_name,consent_candidates.email_id,consent_candidates.mobile_no,campaign_logs.campaign_log_id');
			$this->db->from('consent_candidates');
			$this->db->join('campaign_logs', 'campaign_logs.candidate_id = consent_candidates.candidate_id');
			//$this->db->where('campaign_logs.campaign_id',$campaign_id);
			$this->db->where('campaign_logs.candidate_status !=', '3');
			$this->db->where('consent_candidates.is_active', '1');
			$this->db->where_in('consent_candidates.candidateid',$candidate_ids);
			$this->db->where('campaign_logs.unique_id !=', '');
			$this->db->order_by('campaign_logs.campaign_log_id', 'ASC');
			$query = $this->db->get();
			$result = $query->result();
		//	echo $this->db->last_query();
			//echo "<br>";echo "<br>";
		//	die();
			return $result;
	
		} //End of View function
		
		function get_alert_candidates_list_old($campaign_id)
		{
			$today =date('Y-m-d');
			$this->db->select('candidate_id');
			$this->db->from('mail_sms_log_details');
			$this->db->where('email_subject',NULL);
			$this->db->where('sent_datetime >=', date(''.$today.' 00:00:00'));
			$this->db->where('sent_datetime <=', date(''.$today.' 23:59:59'));
			$this->db->order_by('log_detail_id', 'ASC');
			$result = $this->db->get();
			//echo $this->db->last_query();
			//echo "<br>";echo "<br>";
			$school_ids= array();
			if ($result->num_rows() > 0) {
				foreach ($result->result_array() as $row) {
					$candidate_ids[$row['candidate_id']] = $row['candidate_id'];
				}
			}else
			{
				$candidate_ids['0'] = '';
		    }
		
			$this->db->select('consent_candidates.candidate_id,consent_candidates.applicant_full_name,consent_candidates.email_id,consent_candidates.mobile_no,campaign_logs.campaign_log_id');
			$this->db->from('consent_candidates');
			$this->db->join('campaign_logs', 'campaign_logs.candidate_id = consent_candidates.candidate_id');
			$this->db->where('campaign_logs.campaign_id',$campaign_id);
			$this->db->where('campaign_logs.candidate_status !=', '3');
			$this->db->where('consent_candidates.is_active', '1');
			$this->db->where_not_in('consent_candidates.candidate_id',$candidate_ids);
			$this->db->where('campaign_logs.unique_id !=', '');
			$this->db->order_by('campaign_logs.campaign_log_id', 'ASC');
			$query = $this->db->get();
			$result = $query->result();
			//echo $this->db->last_query();
			//echo "<br>";echo "<br>";
		//	die();
			return $result;
	
		} //End of View function
		
	 function add()
     {
		$data        = array(
		    'sponser_id'   => '53',
          	'campaign_name'     => $this->input->post("campaign_name"),
			'campaign_type'    => '1',
			'start_date'   => $this->input->post("start_date"),
			'end_date'     => $this->input->post("end_date"),
			'description'     => $this->input->post("description"),
			'created_by'     => $this->session->userdata('user_id'),
			'created_on'      => date('Y-m-d H:i:s'),
        );
        $result   = $this->db->insert('campaigns', $data);
		$campaign_id  = $this->db->insert_id();
		if($result > 0)
		{
			return $campaign_id;
		 }
		else
			return 0;


    } //End of add function
	
	
	function view_campaigns()
		{
			$this->db->select('*');
			$this->db->from('campaigns');
			$this->db->order_by('start_date', 'DESC');
			$query = $this->db->get();
			//echo $this->db->last_query();
			$result = $query->result();
			//Count Company Alias Admin,Users Records
			foreach ($result as $row) {
				
				$row->total_candidates= $this->countcandidates($row->campaign_id);
				}
			/*echo "<pre>";
			print_r($result);
			echo "</pre>";
			*/
			return $result;
	
		} //End of View function
		
		function countcandidates($campaign_id)
		{
			$this->db->where('campaign_id', $campaign_id);
			$this->db->from('campaign_logs');
			$query = $this->db->get();
			return $query->num_rows();
	
		} //End of Count function
		
		
	  function campaign_edit($campaign_id)
		{
			if ($campaign_id == '') {
				redirect(base_url() . "admin/campaigns/view");
			}
			$this->db->select('*');
			$this->db->from('campaigns');
			$this->db->where('campaign_id', $campaign_id);
			$query = $this->db->get();
			return $query->row();
	
		} //End of edit function
	
	
		 function update_campaign($campaign_id)
		 {
			$data = array(
				'campaign_name'     => $this->input->post("campaign_name"),
				'start_date'   => $this->input->post("start_date"),
				'end_date'     => $this->input->post("end_date"),
				'description'     => $this->input->post("description")
			);
			$this->db->where('campaign_id', $campaign_id);
			$result = $this->db->update('campaigns', $data);
			if ($result)
		    return 1;
			else
			return 0;
			
		 } //End of Update function
		 
		 
    function get_sms_email_templates($template_type)
	{
		$this->db->select('*');
		$this->db->from('mail_sms_templates');
		$this->db->where('template_type',$template_type);
		$this->db->where('template_type',$template_type);
		$this->db->where_in('is_active','1');
		$this->db->order_by('template_title', 'ASC');
		$result = $this->db->get();
		$options = array();
		if ($result->num_rows() > 0) {
			$options[''] = 'Select Template';
			foreach ($result->result_array() as $row) {
				 if($template_type=='s')
				 $options[$row['template_id'].'|||'.$row['template_body']] = $row['template_title'];
				 else
				 $options[$row['template_id'].'|||'.$row['template_subject'].'|||'.$row['template_body']] = $row['template_title'];
				 
				
			}
		}
		//print_r($options);
		return $options;
	}
		
	 function update_send_sms($tournament_id){
		
		if($this->input->post("campaign_log_id"))
		 {
			$template_id = $this->input->post("template_id");
			$sms_body = $this->input->post("sms_body");
			$templaterow=get_table_info('mail_sms_templates','template_id',$template_id);
		  	
		   $data = array(
				'template_id'     => $template_id,
				'template_title'     => $templaterow->template_title,
				'template_body'     => $sms_body,
				'send_by'     => $this->session->userdata('user_id'),
				'send_date'     => date('Y-m-d H:i:s')
			);
			$templateresult   = $this->db->insert('mail_sms_logs', $data);
			$log_id = $this->db->insert_id();
					 
		 $done=0;
		 $error=0;
		 $status='';
		 $message='';
		 if(is_array($this->input->post("campaign_log_id")))
		 foreach($this->input->post("campaign_log_id") as $camplogid){
			
			$this->db->select('consent_candidates.applicant_full_name,consent_candidates.email_id,consent_candidates.mobile_no,campaign_logs.campaign_log_id,campaign_logs.campaign_log_id,campaign_logs.candidate_id,campaign_logs.unique_id');
			$this->db->from('consent_candidates');
			$this->db->join('campaign_logs', 'campaign_logs.candidate_id = consent_candidates.candidate_id');
			$this->db->where('campaign_logs.candidate_status !=', '3');
			$this->db->where('campaign_logs.campaign_log_id',$camplogid);
			$query = $this->db->get();
			$camplogrow =  $query->row();

			$camplogrow->campaign_link = campaign_link.'/v/'.$camplogrow->unique_id;
			//print_r($camplogrow);
			//die();
			//echo $this->db->last_query();
			$name = $camplogrow->applicant_full_name;
			$mobile_no = $camplogrow->mobile_no;
			$campaign_log_id = $camplogrow->campaign_log_id;
			$candidate_id = $camplogrow->candidate_id;
			if($mobile_no!='')
			{    
			     $replaced_sms_body=templatedata($sms_body,$camplogrow);
				 $errNo='';
				//echo "----------------->".$replaced_sms_body;
				//die();
				//$mobile_no='7889231912';
				$sendresult =  send_sms($mobile_no,$replaced_sms_body,$templaterow->dlt_temp_id);
				/*echo "<pre>";
				print_r($sendresult);
				echo "</pre>";*/
				
				$logdata = array(
					'log_id'   => $log_id,
					'campaign_log_id'   => $campaign_log_id,
					'candidate_id'   => $candidate_id,
					'sent_title'     => $templaterow->template_title,
					'sent_body_text'     => $replaced_sms_body,
					'sent_datetime'     => date('Y-m-d H:i:s')
				);
				$logresult   = $this->db->insert('mail_sms_log_details', $logdata);
				$log_detail_id = $this->db->insert_id();
				/*echo "<pre>";
				print_r($sendresult);
				echo "</pre>";
				$send_result = json_decode($sendresult);
				
		     	echo "<pre>";
				print_r($send_result);
				echo "</pre>";
				die();*/
				
				if($sendresult!='0')
				{	 $update_data =array( 
						'sent_status' => '1',
					 );	
					 $this->db->where('log_detail_id', $log_detail_id);
					 $result = $this->db->update('mail_sms_log_details', $update_data);
					 $done++;
				}
				else
				{
					$status =  $sendresult->status;
					$errors = $send_result->errors[0];
					$message = 'Message not Delivered.';
					$error++;
					
				}
			}
		   }
		 }
		 if($done>0)
		  $this->session->set_flashdata('success_message', 'Total\'s ('.$done.') message send successfully.');
		  
		  if($error>0)
		  $this->session->set_flashdata('warning_message', 'There is some error Status: ('.$status.')'. ', Message: ('.$message.')');
		  
		return $logresult;
	}
	
	
	   function update_send_email($campaign_id){
		
		if($this->input->post("campaign_log_id"))
		 {
			$template_id = $this->input->post("template_id");
			$email_subject = $this->input->post("email_subject");
			$email_body = $this->input->post("email_body");
			$templaterow=get_table_info('mail_sms_templates','template_id',$template_id);
			//echo $this->db->last_query();
		   $data = array(
				'template_id'     => $template_id,
				'template_title'     => $templaterow->template_title,
				'email_subject'     => $email_subject,
				'template_body'     => $email_body,
				'send_by'     => $this->session->userdata('user_id'),
				'send_date'     => date('Y-m-d H:i:s')
			);
			$templateresult   = $this->db->insert('mail_sms_logs', $data);
			$log_id = $this->db->insert_id();
					 
		 $done=0;
		 $error=0;
		 if(is_array($this->input->post("campaign_log_id")))
		 foreach($this->input->post("campaign_log_id") as $camplogid){
			 
			$this->db->select('consent_candidates.applicant_full_name,consent_candidates.email_id,consent_candidates.mobile_no,campaign_logs.campaign_log_id,campaign_logs.campaign_log_id,campaign_logs.candidate_id,campaign_logs.unique_id');
			$this->db->from('consent_candidates');
			$this->db->join('campaign_logs', 'campaign_logs.candidate_id = consent_candidates.candidate_id');
			$this->db->where('campaign_logs.candidate_status !=', '3');
			$this->db->where('campaign_logs.campaign_log_id',$camplogid);
			$query = $this->db->get();
			$camplogrow =  $query->row();

			$camplogrow->campaign_link = campaign_link.'/v/'.$camplogrow->unique_id;
			//print_r($camplogrow);
			//die();
			//echo $this->db->last_query();
			$applicant_full_name = strtolower($camplogrow->applicant_full_name);
			$name = ucwords($applicant_full_name);
			$camplogrow->applicant_name=$name;
			$mobile_no = $camplogrow->mobile_no;
			$to_email = strtolower($camplogrow->email_id);
			$campaign_log_id = $camplogrow->campaign_log_id;
			$candidate_id = $camplogrow->candidate_id;

			if($to_email!='')
			{    
		       // $to_email='dreamweaversgroup1@gmail.com';
				//$to_email='ajaykumar1286@gmail.com';
			    $replaced_email_body=templatedata($email_body,$camplogrow);
				//echo $replaced_email_body;
				//die();
				//$sendresult =  common_mail('ajaykumar1286@gmail.com','thedeveloper33@gmail.com',$email_subject,$replaced_email_body);
				//$email_subject = 'HDFC LIFE: '.$email_subject;
				$email_subject = $email_subject;
				$alternate_email='';
				$sendresult =  common_mail($to_email,$alternate_email,$email_subject,$replaced_email_body);
				//echo "---------Result--->".$sendresult;
				//die();
				/*echo "<pre>";
				print_r($sendresult);
				echo "</pre>";*/
				
				$logdata = array(
					'log_id'   => $log_id,
					'campaign_log_id'   => $campaign_log_id,
					'candidate_id'   => $candidate_id,
					'sent_title'     => $templaterow->template_title,
					'email_subject'     => $email_subject,
					'sent_body_text'     => $replaced_email_body,
					'sent_datetime'     => date('Y-m-d H:i:s')
				);
				$logresult   = $this->db->insert('mail_sms_log_details', $logdata);
				$log_detail_id = $this->db->insert_id();
			/*	echo "<pre>";
				print_r($send_result);
				echo "</pre>";*/
				if($sendresult=='1')
				{	 $update_data =array( 
						'sent_status' => '1',
					 );	
					 $this->db->where('log_detail_id', $log_detail_id);
					 $result = $this->db->update('mail_sms_log_details', $update_data);
					 $done++;
				}
				else
				{	 $error++;
				}
			  }
		    }
		 }
		  if($done>0)
		  $this->session->set_flashdata('success_message', 'Total\'s ('.$done.') Email\'s send successfully.');
		  
		  if($error>0)
		  $this->session->set_flashdata('warning_message', 'There is some error in sending Email.');
		  
		return $logresult;
	}
	
	   
	
 function update_status($campaign_id, $status)
    {
		 if($status=='1')
		 {	$data = array(
				'is_active' => $status,
				'deactive_date' =>''
			);
		 }
		 else
		 {
			$data = array(
				'is_active' => $status,
				'deactive_date' => date('Y-m-d H:i:s')
			);
		 }
        $this->db->where('campaign_id', $campaign_id);
	    $result = $this->db->update('campaigns', $data);
		if($result)
		  return '1';
		 else 
		 return '0';

    } //End of Update status function
	
	
		
   function view_candidates($campaign_id,$candidate_id,$application_no,$search_by,$search_value,$status,$limit, $start)
    {
		$this->db->select('consent_candidates.*,campaign_logs.campaign_log_id,campaign_logs.campaign_id,campaign_logs.unique_id,campaign_logs.candidate_status');
		$this->db->where('campaign_logs.campaign_id',$campaign_id);
		$this->db->join('campaign_logs', 'consent_candidates.candidate_id = campaign_logs.candidate_id');
		if($candidate_id!='0')
		$this->db->where('consent_candidates.candidate_id', $candidate_id);
		if($application_no!='0')
		$this->db->where('consent_candidates.application_no', $application_no);
		if($search_by!='0' && $search_value!='0')
		{  if($search_by=='1') 	
		   $this->db->like('consent_candidates.candidateid', $search_value);
		   elseif($search_by=='2') 	
		   $this->db->like('consent_candidates.mobile_no', $search_value);
		   elseif($search_by=='3') 	
		   $this->db->like('consent_candidates.applicant_full_name', $search_value);
		}
		if($status!='0')
		{	if($status == 'a')
			{	$status = '1';
			}
			else
			{	$status = '0';
			}
			$this->db->where('campaign_logs.is_active',$status);
		}	
		$this->db->group_by('consent_candidates.candidate_id'); 
		$this->db->order_by('consent_candidates.applicant_full_name','ASC');
		if($limit!=null || $start!=null)
		{
			$this->db->limit($limit,$start);
		}	
        $this->db->from('consent_candidates');
        $query = $this->db->get();
	   //echo "--->".$this->db->last_query();
	    $result = $query->result();
		/*echo "<pre>";
		print_r($result);
		echo "</pre>";*/
       
        return $result;

    } //End of View  function
	
	
	
	
	function count_candidates($campaign_id,$candidate_id,$application_no,$search_by,$search_value,$status) {
			
			$this->db->where('campaign_logs.campaign_id',$campaign_id);
			$this->db->join('campaign_logs', 'consent_candidates.candidate_id = campaign_logs.candidate_id');
			if($candidate_id!='0')
			$this->db->where('consent_candidates.candidate_id', $candidate_id);
			if($application_no!='0')
			$this->db->where('consent_candidates.application_no', $application_no);
			if($search_by!='0' && $search_value!='0')
			{  if($search_by=='1') 	
			   $this->db->like('consent_candidates.candidateid', $search_value);
			   elseif($search_by=='2') 	
			   $this->db->like('consent_candidates.mobile_no', $search_value);
			   elseif($search_by=='3') 	
			   $this->db->like('consent_candidates.applicant_full_name', $search_value);
			}
			if($status!='0')
			{	if($status == 'a')
				{	$status = '1';
				}
				else
				{	$status = '0';
				}
				$this->db->where('campaign_logs.is_active',$status);
			}	
			$this->db->group_by('consent_candidates.candidate_id'); 
			$query=$this->db->get('consent_candidates');		
			//echo "--------------------->". $this->db->last_query();	   
			return $query->num_rows();
			
		}     //End of Count function
		
		
	 function insert_candidate_data($data) {
        $result = $this->db->insert('consent_candidates', $data);
		$candidate_id = $this->db->insert_id();
		if($candidate_id)
		{    return $candidate_id;
		     exit();
		}
		else
		{	 return '0';
			 exit();
		}
		
      }
	  
	
	function insertCampaignlogs($campaign_id,$candidate_id)
	{
		$uniqueid =  random_string('alnum',8);
		$campfields = array('unique_id'=>$uniqueid);
		$camprow = gettableinfo('campaign_logs',$campfields);
		if($camprow=='0')
		{	
			$data =array('campaign_id'=>$campaign_id,
				'candidate_id'=>$candidate_id,
				'unique_id'=>$uniqueid,
				'created_on'=>date('Y-m-d H:i:s')
			);
			$result = $this->db->insert('campaign_logs',$data);
		}
		else
		{
			$unique_id =  random_string('alnum',8);
		    $fields = array('unique_id'=>$unique_id);
			$camp_row = gettableinfo('campaign_logs',$fields);
			if($camprow!='0')
			{	$unique_id =  random_string('alnum',8);
			}
			$data =array('campaign_id'=>$campaign_id,
				'candidate_id'=>$candidate_id,
				'unique_id'=>$unique_id,
				'created_on'=>date('Y-m-d H:i:s')
			);
			$result = $this->db->insert('campaign_logs',$data);
		}
		$campaign_log_id = $this->db->insert_id();
		if($campaign_log_id)
		{	return $campaign_log_id;
		}
		else
		{	return 0;
		}							
	}
		
	
	

	
}