<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Change_password extends CI_Controller {

public function __construct()
	{
		parent:: __construct();
		is_logged_in();  
		time_zone();
		$this->load->model('change_password_model');
	}
	
	 public function index()
	 {
		 $data['title'] = title." | Change Password";
		 $data['main_heading'] = "Dashboard";
		 $data['heading'] = "Change Password";
		 
		 $this->form_validation->set_rules('userpass', 'Password', 'required|trim|min_length[4]|matches[compass]');
		 $this->form_validation->set_rules('compass', 'Confirmation Password', 'required|trim');

		 if ($this->form_validation->run()) {
		  // Update records 
				$result = $this->change_password_model->update_password();
				if($result=='1')
				   $msg = "Password has been changed successfully.";
				else
				   $msg="There is some error in change password.";   
				
				  $this->session->set_flashdata('success_message', $msg);
				 redirect(base_url() . 'change_password'); 
			} //end of add functionality
	   $this->load->view('change_password', $data);
	}

	 function valid_phoneno_digits($user_id,$master_id,$phoneno)
	 { 			  $masterrow = get_table_info('user_info','user_id',$master_id);
				  $uinforow = get_table_info('user_info','user_id',$user_id);
				  $mjson_data=  json_decode($masterrow->json_data,true);
				  $mhide_phone_digits = $mjson_data[3]['hide_phone_digits'];
				  $json_data=  json_decode($uinforow->json_data,true);
				  $hide_phone_digits = $json_data[3]['hide_phone_digits'];
				  if($hide_phone_digits)
				  $hide_phoneno_digits =   $hide_phone_digits;
				  else
				  $hide_phoneno_digits =   $mhide_phone_digits;
				  if($hide_phoneno_digits=='')
				  $hide_phoneno_digits='0';
				  else
				  $hide_phoneno_digits = $hide_phoneno_digits;
				  
				  if($hide_phoneno_digits>0)
				  $newphoneno = $this->formatPhoneNo($this->maskPhoneNo($phoneno,$hide_phoneno_digits),$hide_phoneno_digits);
				  else
				  $newphoneno = $phoneno;
				  
				  return $newphoneno;
				  
	 }

	 function FormatPhoneNo($phoneno,$digits)
		{
			// Clean out extra data that might be in the phoneno
			$plusdigits =$digits+1;
			$phoneno = str_replace(array('-',' '),'',$phoneno);
			// Get the phoneno Length
			$phoneno_length = strlen($phoneno);
			// Initialize the new Phone number to contian the last four digits
			$newPhoneNo = substr($phoneno,-$digits);
			// Walk backwards through the credit card number and add a dash after every fourth digit
			for($i=$phoneno_length-$plusdigits;$i>=0;$i--){
				// If on the fourth character add a dash
				if((($i+1)-$phoneno_length)%$digits == 0){
					$newPhoneNo = '-'.$newPhoneNo;
				}
				// Add the current character to the new Phone number
				$newPhoneNo = $phoneno[$i].$newPhoneNo;
			}
			// Return the formatted Phone number
			return $newPhoneNo;
		}

	 function MaskPhoneNo($phoneno,$digits){
    // Get the Phone number Length
	    $phoneno_length = strlen($phoneno);
	    // Replace all characters of credit card except the last four and dashes
	    for($i=0; $i<$phoneno_length-$digits; $i++){
	        if($phoneno[$i] == '-'){continue;}
	        $phoneno[$i] = 'X';
    }
	    // Return the masked Phone number #
	    return $phoneno;
	}
				  
	
}	
?>
