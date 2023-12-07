<?php

class Trainingmail_sms_cron_model extends CI_Model
{

    function get_pending_register_candidates()
     {
	    $this->dw=$this->load->database('dw_db', TRUE); 
		$this->dw->select('batches.batch_id,batches.batch_start_date,batches.course_id, candidates.candidate_id,UPPER(candidates.candidate_login_id), candidates.candidate_name, candidates.candidate_registered_on, candidates.course_start_date'); 
		$this->dw->from('candidates');
		$this->dw->join('batches', 'batches.batch_id = candidates.batch_id');
		$this->dw->where('batches.sponser_id','149');
		$this->dw->where('batches.batch_id','61613');
		$this->dw->where('batches.course_id','43');
	    $this->dw->where('candidates.alert_type_status',NULL);
		//$this->dw->where('candidates.course_start_date',NULL);
	    $this->dw->order_by('candidates.candidate_registered_on', 'ASC');
		$this->dw->limit('20');
	    $query = $this->dw->get();
		$result = $query->result();
		//echo $this->dw->last_query();
		//echo "<br>";
	  // die();
		foreach ($result as $row) {
			$row->send_total_email_alert = $this->check_register_alert_email($row->candidate_id);
		}
      
        return $result;

    } //End of View  function
	
	
	function check_register_alert_email($candidate_id)
     {
	    $this->dw=$this->load->database('dw_db', TRUE); 
		$this->dw->select('candidates.candidate_id,candidates.candidate_name,candidates.candidate_login_id,UPPER(candidates.candidate_login_id) as candidate_login_id, candidates.candidate_registered_on, candidates.course_start_date,candidates.candidate_email');
		$this->dw->from('candidates');
	    $this->dw->where('candidates.alert_type_status',NULL);
		//$this->dw->where('candidates.course_start_date',NULL);
		$this->dw->where('candidates.candidate_id',$candidate_id);
	    $query = $this->dw->get();
	  // echo $this->dw->last_query();
		//echo "<br>";
	   //  die();
	     if($query->num_rows()>0){
			 $candrow = $query->row();
			     $candidate_id = $candrow->candidate_id;
				 $candidate_name = ucwords(strtolower($candrow->candidate_name));
				 $candidate_login_id = strtolower($candrow->candidate_login_id);
				 $candidate_password = strtolower($candrow->candidate_login_id);
				 $candidate_registered_on =$candrow->candidate_registered_on;
				 $to_email = $candrow->candidate_email;
				 
				 $candrow->name=$candidate_name;
				 $candrow->candidate_password=$candidate_password;
				
					$beforetime=date("Y-m-d H:i:s",strtotime("-20 hours",strtotime(date("Y-m-d H:i:s"))));
					//$beforetime=date("Y-m-d H:i:s",strtotime("-2 minutes",strtotime(date("Y-m-d H:i:s"))));
					$this->dw->select('log_detail_id');
					$this->dw->where('candidate_id',$candrow->candidate_id);
					$this->dw->where('sent_datetime >=',$beforetime);
					$this->dw->order_by('log_detail_id','DESC');
					$this->dw->limit(1);
					$query = $this->dw->get('mail_sms_log_details');
					//echo $this->dw->last_query();
					//echo "<br>";
					if($query->num_rows()==0){
					 $this->dw->select('*');
					 $this->dw->where('template_id',register_alert_type);
					 $this->dw->where('is_active','1');
					 $this->dw->order_by('template_id','DESC');
					 $templatesquery = $this->dw->get('mail_sms_templates');
					 if($templatesquery->num_rows()>0){
						$templaterow = $templatesquery->row();
						$template_id = $templaterow->template_id;
						$email_subject = $templaterow->template_subject;
						$email_body = $templaterow->template_body;
						
						if($to_email!='')
						{    
						//$to_email='shamsher.singh@dreamweaversindia.com';
						//$to_email='dreamweaversgroup1@gmail.com';
						$replaced_email_body=templatedata($email_body,$candrow);
						//echo $replaced_email_body;
						//die();
						$email_subject = $email_subject;
						$alternate_email='';
						$sendresult =  common_mail($to_email,'',$email_subject,$replaced_email_body);
						//echo "---------Result--->".$sendresult;
					//die();
						/*echo "<pre>";
						print_r($sendresult);
						echo "</pre>";*/
						
						$logdata = array(
						'template_id'   => $template_id,
						'candidate_id'   => $candidate_id,
						'sent_title'     => $templaterow->template_title,
						'email_subject'     => $email_subject,
						'sent_body_text'     => $replaced_email_body,
						'sent_datetime'     => date('Y-m-d H:i:s')
						);
						$logresult   = $this->dw->insert('mail_sms_log_details', $logdata);
						$log_detail_id = $this->dw->insert_id();
						/*	echo "<pre>";
						print_r($send_result);
						echo "</pre>";*/
						if($sendresult=='1')
						{	 $update_data =array( 
						'sent_status' => '1',
						);	
						$this->dw->where('log_detail_id', $log_detail_id);
						$result = $this->dw->update('mail_sms_log_details', $update_data);
						
						 $updatedata =array( 
					  	  'alert_type_status' => '1',
						  );	
						$this->dw->where('candidate_id', $candidate_id);
						$result = $this->dw->update('candidates', $updatedata);
						
						$done++;
						}
						else
						{	 $error++;
						}
						}
				       }
						
				}
		  }
				
			/*echo "<pre>";
		print_r($result);
		echo "</pre>";*/
       
        return $done.'|||'.$error;

    } //End of View  function
    
   
    

function pending_training_candidates()
     {
		 $batch_id=array('61613','61592');
	    $this->dw=$this->load->database('dw_db', TRUE); 
		$this->dw->select('batches.batch_id,batches.batch_start_date,batches.course_id, candidates.candidate_id,UPPER(candidates.candidate_login_id), candidates.candidate_name, candidates.candidate_registered_on, candidates.course_start_date'); 
		$this->dw->from('candidates');
		$this->dw->join('batches','batches.batch_id = candidates.batch_id');
		$this->dw->where('batches.sponser_id','149');
		$this->dw->where('batches.course_id','43');
		$this->dw->where_in('batches.batch_id',$batch_id);
	    $this->dw->where('candidates.alert_type_status !=','2');
	  	$this->dw->where('candidates.course_complete',NULL);
	    $this->dw->order_by('candidates.candidate_registered_on', 'ASC');
		$this->dw->limit('10');
	    $query = $this->dw->get();
		$result = $query->result();
		echo $this->dw->last_query();
		//echo "<br>";
	  	die();
		foreach ($result as $row) {
			
			$row->send_total_email = $this->check_training_pending_email($row->candidate_id);
			
		}
		
       
        return $result;

    } //End of View  function
	
	
	function check_training_pending_email($candidate_id)
     {
	    $this->dw=$this->load->database('dw_db', TRUE); 
		$this->dw->select('candidates.candidate_id,candidates.candidate_name,candidates.candidate_login_id,UPPER(candidates.candidate_login_id) as candidate_login_id, candidates.candidate_registered_on, candidates.course_start_date,candidates.candidate_email');
		$this->dw->from('candidates');
	    $this->dw->where('candidates.alert_type_status !=','2');
		$this->dw->where('candidates.course_complete','0');
		$this->dw->where('candidates.candidate_id',$candidate_id);
	    $query = $this->dw->get();
	  // echo $this->dw->last_query();
		//echo "<br>";
	   //  die();
	     if($query->num_rows()>0){
			 $candrow = $query->row();
			     $candidate_id = $candrow->candidate_id;
				 $candidate_name = ucwords(strtolower($candrow->candidate_name));
				 $candidate_login_id = strtolower($candrow->candidate_login_id);
				 $candidate_password = strtolower($candrow->candidate_login_id);
				 $candidate_registered_on =$candrow->candidate_registered_on;
				 $to_email = trim($candrow->candidate_email);
				 
				 $candrow->name=$candidate_name;
				 $candrow->candidate_password=$candidate_password;
				
					$beforetime=date("Y-m-d H:i:s",strtotime("-20 hours",strtotime(date("Y-m-d H:i:s"))));
					//$beforetime=date("Y-m-d H:i:s",strtotime("-1 minutes",strtotime(date("Y-m-d H:i:s"))));
					$this->dw->select('log_detail_id');
					$this->dw->where('candidate_id',$candrow->candidate_id);
					$this->dw->where('sent_datetime >=',$beforetime);
					$this->dw->order_by('log_detail_id','DESC');
					$this->dw->limit(1);
					$query = $this->dw->get('mail_sms_log_details');
				//	echo $this->dw->last_query();
					//die();
					if($query->num_rows()==0){
					 $this->dw->select('*');
					 $this->dw->where('template_id',training_alert_type);
					 $this->dw->where('is_active','1');
					 $this->dw->order_by('template_id','DESC');
					 $templatesquery = $this->dw->get('mail_sms_templates');
					 if($templatesquery->num_rows()>0){
						$templaterow = $templatesquery->row();
						$template_id = $templaterow->template_id;
						$email_subject = $templaterow->template_subject;
						$email_body = $templaterow->template_body;
						
						if($to_email!='')
						{    
                        //$to_email='shamsher.singh@dreamweaversindia.com';
						//$to_email='dreamweaversgroup1@gmail.com';
						$replaced_email_body=templatedata($email_body,$candrow);
						//echo $replaced_email_body;
						//die();
						$email_subject = $email_subject;
						$alternate_email='';
						$sendresult =  common_mail($to_email,'',$email_subject,$replaced_email_body);
					   // echo "---------Result--->".$sendresult;
				   
						/*echo "<pre>";
						print_r($sendresult);
						echo "</pre>";*/
						$logdata = array(
							'template_id'   => $template_id,
							'candidate_id'   => $candidate_id,
							'sent_title'     => $templaterow->template_title,
							'email_subject'     => $email_subject,
							'sent_body_text'     => $replaced_email_body,
							'sent_datetime'     => date('Y-m-d H:i:s')
						);
						$logresult   = $this->dw->insert('mail_sms_log_details', $logdata);
						$log_detail_id = $this->dw->insert_id();
						/*	echo "<pre>";
						print_r($send_result);
						echo "</pre>";*/
						if($sendresult=='1')
						{	 $update_data =array( 
						'sent_status' => '1',
						);	
						$this->dw->where('log_detail_id', $log_detail_id);
						$result = $this->dw->update('mail_sms_log_details', $update_data);
						
						 $updatedata =array( 
					  	  'alert_type_status' => '2',
						  );	
						$this->dw->where('candidate_id', $candidate_id);
						$result = $this->dw->update('candidates', $updatedata);
						
						$done++;
						}
						else
						{	 $error++;
						}
						}
				       }
						
				}
		  }
				
			/*echo "<pre>";
		print_r($result);
		echo "</pre>";*/
       
        return $done.'|||'.$error;

    } //End of View  function
    
    
	
	
	
		
	

	
}