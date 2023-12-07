<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
use Dompdf\Dompdf;
use Dompdf\Options;
class Candidates extends CI_Controller {

var $pdf_path;
public function __construct()
	{
		parent:: __construct();
		is_campaign_logged_in();
		$this->load->model('hdfclife/candidates_model');
		$this->load->helper('download');
		
		$this->pdf_path = realpath('assets/static/applicant_pdf/');
	}

	public function hdfclife_verify()
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
			$data['msg']='Your have already give the consent.';
		  }
		 else
		  {			  
			 $candrow =  $this->candidates_model->verify_candidate_dob();	
			 if($candrow!='0')
			 {
				$resultstatus = $this->candidates_model->update_status('2');
			    $msg = "You have successfully verified the Date of Birth.";
				$this->session->set_flashdata('success_message', $msg);
			    redirect(base_url() . 'hdfclife/candidates/hdfclife_application_consent');
				exit();
			 }
			 else  
			 {
			   $msg = "Your Date of Birth verification failed. Please try again.";	
			 }
				
			}  
			
	    } //end of add  functionality
		
	    $row =  $this->candidates_model->get_candidate_info();
		if($row!='0')
		$resultstatus = $this->candidates_model->update_status('1');	
		
	    $data['row'] = $row;
	    $data['msg'] = $msg;
	   $this->load->view('hdfclife/candidates/candidates_verify.php', $data);
	}
	
	
	public function hdfclife_application_consent()
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
			  redirect(base_url() . 'hdfclife/candidates/hdfclife_verify');
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
		$data['steps'] = 'Step 1) Download & accept the terms & conditions.<br>Step 2) Verify your mobile number with OTP.';
		
	   $this->load->view('hdfclife/candidates/hdfclife_application_consent.php', $data);
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
	
	
	public function send_otp(){
		$token_name=$this->security->get_csrf_token_name();
		$security=$_GET[$token_name];
		$mobile_no=$_GET['mobile'];
		if($security==$this->security->get_csrf_hash()){
			
			$validate_mobile=substr($mobile_no,-10);
			$rowcand =  $this->candidates_model->get_candidate_info();
			$totalverfiylimit =  $this->candidates_model->check_otp_verfiy_limit($validate_mobile);
			$candidate_mobile = substr($rowcand->mobile_no,-10);
			if($candidate_mobile!=$validate_mobile)
			{
				echo "0";
				exit();
			}
			elseif($totalverfiylimit>=5)
			{
				echo "6";
				exit();
			}else
			{
			
			$otp=$this->generateOTP();
			
			if((strlen($validate_mobile)==10) && is_numeric($validate_mobile)){
				
				$dlttempid='1007893359459651444';
				$sms_msg=urlencode("Your One Time Password-OTP is ".$otp." to give consent for HDFC Life. This OTP is valid for 2 mins.");

$smsurl='http://www.smsjust.com/sms/user/urlsms.php?username=HDFCLI&pass=hdfclife@1234&senderid=HDFCLF&dest_mobileno='.$validate_mobile.'&message='.$sms_msg.'&response=Y&dlttempid='.$dlttempid.''; 
   
		//	$smsurl='http://www.smsjust.com/sms/user/urlsms.php?username=DREAMINSURANCE&pass=Fd1w@6Z_&senderid=DRMWVR&dest_mobileno='.$validate_mobile.'&message='.$sms_msg.'&response=Y'; 
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
			if(strlen($otp)>=4)
			{
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
					if($result)
					{ 	$resultpdf = $this->generate_application_form_pdf($this->session->userdata('camp_log_id'),$this->session->userdata('cand_id'));
						if($resultpdf=='1')
						{
							$this->candidates_model->update_action_status('pdf');
							$resultemail = $this->send_candidates_email($this->session->userdata('camp_log_id'),$this->session->userdata('cand_id'));
							if($resultemail=='1')
							{
							 $this->candidates_model->update_action_status('email');
							 //echo "------------->".$resultemail;
							}
						}
					}
					 
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
				 echo '2';
				}
			}else{
				echo '0';
			}
			}
			
			
		}else{
			echo 'Something is going wrong. Please try again.';
		}
	}
	
	
	public function generate_application_form_pdf($camp_log_id,$cand_id)
	{
		 $cand_row =  $this->candidates_model->get_candidate_info();
		//echo "---application_no---------->".$cand_row->application_no;
		 $application_no = trim($cand_row->application_no);
		 $data['row'] = $cand_row;
       //  $this->load->view('hdfclife/candidates/hdfclife_application_form_pdf', $data);
	   
		 $candidate_pdf_path=$this->pdf_path.$application_no.'.pdf';
         $this->recursiveRemoveDirectory($candidate_pdf_path);
	  
		 $html = $this->load->view('hdfclife/candidates/hdfclife_application_form_pdf', $data, TRUE);
	 
		  require_once("assets/dompdf/autoload.inc.php");
		  $dompdf = new Dompdf();
		 
			$dompdf->load_html($html);
			$paper_size='a3';
			$orientation='portrait';
			$dompdf->set_paper($paper_size, $orientation);
			//$dompdf->set_option('enable_html5_parser', TRUE);
			$options = $dompdf->getOptions();
			//$options->setDefaultFont('times-roman');
			$dompdf->setOptions($options);
			
			$dompdf->render();
			$output = $dompdf->output();
			
			//print $output;die;	
			$file_name =$application_no;
			$pdfroot = 'assets/static/applicant_pdf/'.$file_name.".pdf";
			 
			$result_tcc  = file_put_contents($pdfroot, $output);
			
			if($result_tcc)
			{   return '1';
			}else
			{	return '0';
			}
		
    } //end of view Details functionality
	
	
	public function send_candidates_email($candidate_id,$camplogid)
	{
			$this->db->select('consent_candidates.application_no,consent_candidates.applicant_full_name,consent_candidates.email_id,consent_candidates.mobile_no,campaign_logs.campaign_log_id,campaign_logs.campaign_log_id,campaign_logs.candidate_id,campaign_logs.unique_id');
			$this->db->from('consent_candidates');
			$this->db->join('campaign_logs', 'campaign_logs.candidate_id = consent_candidates.candidate_id');
			$this->db->where('consent_candidates.consent_status', '3');
			$this->db->where('campaign_logs.campaign_log_id',$camplogid);
			$this->db->where('campaign_logs.candidate_id',$candidate_id);
			$query = $this->db->get();
			$camplogrow =  $query->row();

			//$camplogrow->campaign_link = campaign_link.'/v/'.$camplogrow->unique_id;
			//print_r($camplogrow);
			//die();
			//echo $this->db->last_query();
			$applicant_full_name = strtolower($camplogrow->applicant_full_name);
			$name = ucwords($applicant_full_name);
			$application_no = trim($camplogrow->application_no);
			$camplogrow->applicant_name=$name;
			$mobile_no = $camplogrow->mobile_no;
			$to_email = strtolower($camplogrow->email_id);
			$campaign_log_id = $camplogrow->campaign_log_id;
			$candidate_id = $camplogrow->candidate_id;
						
			$file_name='';	
			$file_name = $application_no.".pdf";
			
			$applicant_pdf_path='';
			$applicant_pdf_path = $_SERVER['DOCUMENT_ROOT'].'/assets/static/applicant_pdf/'.$file_name;
			
			$templaterow=get_table_info('mail_sms_templates','template_id','3');
			
			$email_subject = $templaterow->template_subject;
			$email_body = $templaterow->template_body;
			//echo "-email_body--------------->".$email_body;
			$replaced_email_body=templatedata($email_body,$camplogrow);
			
		    //$to_email='dreamweaversgroup1@gmail.com';
			//$to_email='ajaykumar1286@gmail.com';
			$alternate_email='';
		    $terms_file_name = 'POSP T&C Annexure.pdf';
			$attachment1=$applicant_pdf_path;
			$attachment2=$_SERVER['DOCUMENT_ROOT'].'/assets/img/'.$terms_file_name;
			
			//echo $replaced_email_body;
			//echo "----------->".$attachment1;
			//echo "----------->".$attachment2;
			//die();
			$sendresult =  common_mail($to_email,$alternate_email,$email_subject,$replaced_email_body,$attachment1,$attachment2);
			if ($sendresult) {
			  return $sendresult;
			
		}
			
		
		
    } //end of view Details functionality
	
	

   function recursiveRemoveDirectory($dir)
	{
		foreach(glob("{$dir}/*") as $file)
		{
			if(is_dir($file)) { 
				$this->recursiveRemoveDirectory($file);
			} else {
				unlink($file);
			}
		}
	}
	

}