<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Candidates extends CI_Controller {

public function __construct()
	{
		parent:: __construct();
		is_campaign_logged_in();
		$this->load->model('candidates_model');
		$this->load->helper('download');
		
	}

	public function verify()
	{
		  $data['title'] = "Verification ";
		  $data['main_heading'] = "Verification";
		  $data['heading'] = "Verification";
		  $msg='';

		  $this->form_validation->set_rules('date_of_birth', 'Date of Birth', 'required|trim');
		 if ($this->form_validation->run()) {
		  $feilds = array('campaign_log_id' =>$this->session->userdata('camp_log_id'),'candidate_status' =>'3');
		  $result = check_unique('campaign_logs',$feilds);
		  if($result==1)
		  {
			$data['msg']='Candidate consent already updated.';
		  }
		 else
		  {			  
			 $candrow =  $this->candidates_model->verify_candidate_dob();	
			 if($candrow!='0')
			 {
			    $msg = "You have successfully verified the Date of Birth.";
				$this->session->set_flashdata('success_message', $msg);
			    redirect(base_url() . 'candidates/application_consent');
				exit();
			 }
			 else  
			 {
			   $msg = "Your Date of Birth verification is failed. Please try again.";	
			 }
				
			}  
			
	    } //end of add  functionality
		
	    $row =  $this->candidates_model->get_candidate_info();	
		
	    $data['row'] = $row;
	    $data['msg'] = $msg;
	   $this->load->view('candidates_verify.php', $data);
	}
	
	
	public function application_consent()
	{
		  $data['title'] =" Application Consent Form";
		  $data['main_heading'] = "Application Consent Form";
		  $data['heading'] = "Application Consent Form";
		  $msg='';
		  $steps='';
		  
		  $feilds = array('campaign_log_id' =>$this->session->userdata('camp_log_id'),'candidate_status' =>'2');
		  $result = check_unique('campaign_logs',$feilds);
		  if($result==0)
		  {
			  $msg='Your Date of Birth verification is pending.';
			  $this->session->set_flashdata('warning_message', $msg);
			  redirect(base_url() . 'candidates/verify');
		  }
		  
		  $this->form_validation->set_rules('mobile_no', 'Mobile no.', 'required|trim');
		  if($this->form_validation->run()) {
		  $feilds = array('campaign_log_id' =>$this->session->userdata('camp_log_id'),'candidate_status' =>'3');
		  $result = check_unique('campaign_logs',$feilds);
		  if($result==1)
		  {
			$data['msg']='Candidate consent already updated.';
		  }
		 else
		  {			  
				
		  }  
			
	    } //end of add  functionality
	
		$candrow =  $this->candidates_model->get_candidate_info();	
		/*echo "<pre>";
		print_r($candrow);
		echo "</pre>";*/
    	$data['msg'] = $msg;
		$data['row'] = $candrow;
		$data['steps'] = 'Step 1) Download & accept  the terms & conditions.<br>Step 2) Verify your mobile number with otp.';
		
	   $this->load->view('application_consent.php', $data);
	}
	
	
	public function download_terms() {
		
	    
		if($this->session->userdata('camp_log_id'))
		{	 
			 $file_name = 'POSP T&C Annexure.pdf';
			 $data = file_get_contents("./assets/img/".trim($file_name));
			 $tcc_name ='POSP T&C Annexure'; 
			 force_download(trim($file_name), $data, $tcc_name);  
		}
		else
		{	 redirect(base_url() . 'unauthorized');
			 die();
		}
		
	}//end of file Download functionality
	
	
	 function generateOTP($length =6, $chars = '1234567890')  
      {  
         $chars_length = (strlen($chars) - 1);  
         $string = $chars{rand(0, $chars_length)};  
         for ($i = 1; $i < $length; $i = strlen($string))  
         {  
            $r = $chars{rand(0, $chars_length)};  
            if ($r != $string{$i - 1}) $string .= $r;  
         }  
         return $string;
	}  

	public function expire_otp(){
		$token_name=$this->security->get_csrf_token_name();
		$security=$_GET[$token_name];
		$mobile_no=$_GET['mobile'];
		if($security==$this->security->get_csrf_hash()){
			$expire_otp =  $this->candidates_model->expire_otp($mobile_no);
		}
	}
	public function verfiy_otp(){
		$token_name=$this->security->get_csrf_token_name();
		$security=$_GET[$token_name];
		$mobile_no=$_GET['mobile'];
		$otp=$_GET['otp'];
		if($security==$this->security->get_csrf_hash()){
			$verfiy_mobile_otp =  $this->candidates_model->verfiy_mobile_otp($mobile_no,$otp);
			if($verfiy_mobile_otp){
				echo '1';
			}else{
				echo '0';
			}
		}
	}
	
	  function send_sms($mobile,$body)
	 {
	 // $url='http://www.smsjust.com/sms/user/urlsms.php?username=DREAMINSURANCE&pass=Fd1w@6Z_&senderid=DRMWVR&msgtype=UNI&dest_mobileno='.$mobile.'&message='.$body.'&response=Y'; 
	    $url='http://www.smsjust.com/sms/user/urlsms.php?username=DREAMINSURANCE&pass=Fd1w@6Z_&senderid=DRMWVR&dest_mobileno='.$mobile.'&message='.$body.'&response=Y'; 
	  
		$curl = curl_init();
		curl_setopt_array($curl, array(
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_URL => $url,
		CURLOPT_USERAGENT => 'Codular Sample cURL Request'
		));
		$lines = curl_exec($curl);
		curl_close($curl);
		
		//dumper($lines);die;
		
		if($lines)
		return $url;
		else
		return "no";
	 }
	 
	public function send_otp(){
		$token_name=$this->security->get_csrf_token_name();
		$security=$_GET[$token_name];
		$mobile_no=$_GET['mobile'];
		if($security==$this->security->get_csrf_hash()){
			$otp=$this->generateOTP();
			$validate_mobile=substr($mobile_no,-10);
			if((strlen($validate_mobile)==10) && is_numeric($validate_mobile)){
				
				$sms_msg=urlencode("Kindly use One Time Password-OTP ".$otp." for consent in HDFC Life. This OTP is valid for 2 mins.");

  // $smsurl='http://www.smsjust.com/sms/user/urlsms.php?username=HDFCLI&pass=hdfclife@1234&senderid=HDFCLF&dest_mobileno='.$validate_mobile.'&message='.$sms_msg.'&response=Y'; 
   
				 $smsurl='http://www.smsjust.com/sms/user/urlsms.php?username=DREAMINSURANCE&pass=Fd1w@6Z_&senderid=DRMWVR&dest_mobileno='.$validate_mobile.'&message='.$sms_msg.'&response=Y'; 
				$add_otp =  $this->candidates_model->mobile_otp($validate_mobile,$otp);
				if($add_otp=="1"){
					
					$send_message=$this->send_otp_script($smsurl);
				}elseif($add_otp=="2"){
					echo "2";
				}else{
					echo "3";
				}
				//echo $smsurl;
			}else{
				echo '4';
			}
		}else{
			echo '5';
		}
	}
	
	public function send_otp_script($url){
		 ob_clean();
        ob_start();
		file_get_contents($url);
	}
	
	public function validate_otp(){
		$token_name=$this->security->get_csrf_token_name();
		$security=$_GET[$token_name];
		$mobile_no=$_GET['mobile'];
		$otp=$_GET['otp'];
		if($security==$this->security->get_csrf_hash()){
			$add_otp =  $this->candidates_model->check_otp($mobile_no,$otp);
			if($add_otp){
				$correct_otp=$add_otp->otp;
				if($correct_otp==$otp)
				{	
				  $data = array(
						'consent_status' => '3',
						'consent_update_on' =>date('Y-m-d H:i:s')
					);
					$this->db->where('candidate_id',$this->session->userdata('cand_id'));
					$candidatesresult = $this->db->update('consent_candidates', $data);
					
					
					$this->load->library('user_agent');
					if ($this->agent->is_browser())
					{		$agent = $this->agent->browser().' '.$this->agent->version();
					}
					elseif ($this->agent->is_robot())
					{		$agent = $this->agent->robot();
					}
					elseif ($this->agent->is_mobile())
					{		$agent = $this->agent->mobile();
					}
					else
					{		$agent = 'Unidentified User Agent';
					}
				
				    $campdata = array(
						'IP_address'=>$_SERVER['REMOTE_ADDR'],
					    'user_agent'=>$agent,		
						'candidate_status' =>'3',
						'modified_on' =>date('Y-m-d H:i:s')
					);
					$this->db->where('campaign_log_id',$this->session->userdata('camp_log_id'));
					$this->db->where('candidate_id',$this->session->userdata('cand_id'));
					$result = $this->db->update('campaign_logs', $campdata);
				
					 $this->session->unset_userdata('common_message');
					 $this->session->set_userdata('common_message', '5');
					 
					 //unset session values
					 $this->session->unset_userdata('camp_log_id');
					 $this->session->unset_userdata('camp_id');
					 $this->session->unset_userdata('cand_id');
					 $this->session->unset_userdata('sponser_id');
					 $this->session->unset_userdata('campaign_type');
				
		  			 echo '1';
				}
				else
				{
				 echo '0';
				}
			}else{
				echo '0';
			}
		}else{
			echo 'Something is going wrong. Please try again.';
		}
	}
	

}