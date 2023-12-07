<?php

class Skill_model extends CI_Model
{
		function get_alert_candidates_list($type)
		{
			$this->db->select('*');
			$this->db->from('skill_sms_email_data');
			if($type=='sms')
			$this->db->where('sent_status_sms','0');
			if($type=='email')
			$this->db->where('sent_status_email','0');
			$this->db->where('is_active', '1');
			$this->db->group_by('candidate_id');
			$this->db->order_by('candidate_id', 'ASC');
			$query = $this->db->get();
			$result = $query->result();
			//echo $this->db->last_query();
			//echo "<br>";echo "<br>";
			return $result;
	
		} //End of View function
		
	
		 
    function get_sms_email_templates($template_type)
	{
		$this->db->select('*');
		$this->db->from('skill_mail_sms_templates');
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
		
	 function update_send_sms(){
		
		$template_id = $this->input->post("template_id");
		$sms_body = $this->input->post("sms_body");
		$templaterow=get_table_info('skill_mail_sms_templates','template_id',$template_id);
		  
		 $done=0;
		 $error=0;
		 $status='';
		 $message='';
		 if(is_array($this->input->post("candidate_id")))
		 foreach($this->input->post("candidate_id") as $candid){
			
			$this->db->select('*');
			$this->db->from('skill_sms_email_data');
			$this->db->where('candidate_id',$candid);
			$this->db->where('sent_status_sms !=', '1');
			$this->db->where('is_active','1');
			$query = $this->db->get();
			$candrow =  $query->row();
			//print_r($candrow);
			//die();
			//echo $this->db->last_query();
			$candidate_name = strtolower($candrow->candidate_name);
			$candrow->candidate_name = ucwords($candidate_name);
			$mobile_no = $candrow->candidate_mobile_no;
			$shortlist_date = $candrow->shortlist_date;
			$shortlist_time = $candrow->shortlist_time;
			$candidate_id = $candrow->candidate_id;
			if($mobile_no!='')
			{    
			     $replaced_sms_body=templatedata($sms_body,$candrow);
				 $errNo='';
				//echo "----------------->".$replaced_sms_body;
				//die();
				//$mobile_no='7889231912';
				$sendresult =  send_sms_skill($mobile_no,$replaced_sms_body,$templaterow->dlt_temp_id);
				/*echo "<pre>";
				print_r($sendresult);
				echo "</pre>";*/
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
						'sent_status_sms' => '1',
					 );	
					 $this->db->where('candidate_id', $candidate_id);
					 $result = $this->db->update('skill_sms_email_data', $update_data);
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
	
		 if($done>0)
		  $this->session->set_flashdata('success_message', 'Total\'s ('.$done.') message send successfully.');
		  
		  if($error>0)
		  $this->session->set_flashdata('warning_message', 'There is some error Status: ('.$status.')'. ', Message: ('.$message.')');
		  
		return $logresult;
	}
	
	
	   function update_send_email(){
		
		if($this->input->post("candidate_id"))
		 {
			$template_id = $this->input->post("template_id");
			$email_subject = $this->input->post("email_subject");
			$email_body = $this->input->post("email_body");
			$templaterow=get_table_info('skill_mail_sms_templates','template_id',$template_id);
			//echo $this->db->last_query();
		   
		 $done=0;
		 $error=0;
		 if(is_array($this->input->post("candidate_id")))
		 foreach($this->input->post("candidate_id") as $candid){
			 
			$this->db->select('*');
			$this->db->from('skill_sms_email_data');
			$this->db->where('candidate_id',$candid);
			$this->db->where('sent_status_email !=', '1');
			$this->db->where('is_active','1');
			$query = $this->db->get();
			$candrow =  $query->row();
			//die();
			//echo $this->db->last_query();
			$candidate_name = strtolower($candrow->candidate_name);
			$name = ucwords($candidate_name);
			$mobile_no = $candrow->candidate_mobile_no;
			$to_email = strtolower($candrow->candidate_email);
			$roll_no = $candrow->roll_no;
			$time_slot = $candrow->time_slot;
			$candidate_id = $candrow->candidate_id;
			

			if($to_email!='')
			{    
		      $to_email='dreamweaversgroup1@gmail.com';
				//$to_email='ajaykumar1286@gmail.com';
			    $replaced_email_body=templatedata($email_body,$candrow);
				//echo $replaced_email_body;
				//die();
				//$sendresult =  common_mail('ajaykumar1286@gmail.com','thedeveloper33@gmail.com',$email_subject,$replaced_email_body);
				//$email_subject = 'HDFC LIFE: '.$email_subject;
				$email_subject = $email_subject;
				$alternate_email='';
				$sendresult =  common_mail_skill($to_email,$alternate_email,$email_subject,$replaced_email_body);
				//echo "---------Result--->".$sendresult;
				//die();
				/*echo "<pre>";
				print_r($sendresult);
				echo "</pre>";*/
				
				if($sendresult=='1')
				{	 $update_data =array( 
						'sent_status_email' => '1',
					 );	
					 $this->db->where('candidate_id', $candidate_id);
					 $result = $this->db->update('skill_sms_email_data', $update_data);
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
		  
		return $sendresult;
	}
	
	
	
	
}