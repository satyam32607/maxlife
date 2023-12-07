<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Registration extends CI_Controller {

 var $original_path;
 var $resized_path;
public function __construct()
	{
		parent:: __construct();
		$this->load->model('registration_model');
		$this->load->library('email');
		$this->load->helper('form');
		$this->load->library('image_lib');
		$this->original_path = realpath('assets/photos/original');
   	    $this->resized_path = realpath('assets/photos/resized');
	}

		
	public function index()
	{
		  $data['title'] = title." | Student Registration";
		  $data['main_heading'] = "Student Registration";
		  $data['heading'] = "REGISTRATION FORM";
		  $data['already_msg']="";
		
	   $this->load->view('registration', $data);
	}
	
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
			$expire_otp =  $this->registration_model->expire_otp($mobile_no);
		}
	}
	public function verfiy_otp(){
		$token_name=$this->security->get_csrf_token_name();
		$security=$_GET[$token_name];
		$mobile_no=$_GET['mobile'];
		$otp=$_GET['otp'];
		if($security==$this->security->get_csrf_hash()){
			$verfiy_mobile_otp =  $this->registration_model->verfiy_mobile_otp($mobile_no,$otp);
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
				
				$sms_msg=urlencode("Kindly use One Time Password-OTP ".$otp." for registration in Myinifd.me. This OTP is valid for 2 mins.");
				//$smsurl="http://sms.proactivesms.in/sendsms.jsp?user=oliveint&password=oliveint&mobiles=".$validate_mobile."&sms=".$sms_msg."&senderid=OXFORD";
				//$smsurl="http://smsapi.drivesu.in:8080/SmsSender/ServiceCheck?userid=30170&password=2T435LZ7&dest=".$validate_mobile."&senderid=MYINFD&accounttype=T&message=".$sms_msg;
				 $smsurl='http://www.smsjust.com/sms/user/urlsms.php?username=DREAMINSURANCE&pass=Fd1w@6Z_&senderid=DRMWVR&dest_mobileno='.$validate_mobile.'&message='.$sms_msg.'&response=Y'; 
				$add_otp =  $this->registration_model->mobile_otp($validate_mobile,$otp);
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
			$add_otp =  $this->registration_model->check_otp($mobile_no,$otp);
			if($add_otp){
				$correct_otp=$add_otp->otp;
				if($correct_otp==$otp)
				echo '1';
				else
				echo '0';
			}else{
				echo '0';
			}
		}else{
			echo 'Something is going wrong.Please try again.';
		}
	}
	
	public function student()
	{
			$obj = json_decode($_POST['result']);
			if($obj->email!='' &&  $obj->userpass!='' &&  $obj->first_name!='' &&  $obj->last_name!='' && $obj->guardian_name!='' &&  $obj->gender!='' &&  $obj->date_of_birth!='' &&  $obj->mobile_no!='' &&  $obj->state_id!='' &&  $obj->city_id!='' &&  $obj->address!='' &&  $obj->pin_code!='' &&  $obj->identity_proof_type!='' &&  $obj->identity_proof_no!='' &&  $obj->centre_id!='' &&  $obj->course_stream!='' &&  $obj->course_id!='')
			{
        	  echo $result =  $this->registration_model->add();
			}
	    } //end of add  functionality
	
}