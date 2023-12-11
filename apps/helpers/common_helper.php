<?php 



 function is_campaign_logged_in()

	{  $CI= & get_instance();

	   $CI->load->library('session');

		if ($CI->session->userdata('camp_log_id') == "") {

				$CI->session->unset_userdata('common_message');

				$CI->session->set_userdata('common_message', '0');

				redirect(base_url('response'));

			  }	

	} 



 function is_logged_in()

	{  $CI= & get_instance();

	   $CI->load->library('session');

		if ($CI->session->userdata('user_id') == "") {

				redirect(base_url());

			  }	

	} 




  function valid_logged_in($requires_logout=FALSE, $type='')

	{ 

	    $key = get_type($type);

		if(!$requires_logout && !logged_in($type) )	{

			redirect(base_url() . 'unauthorized');

		} 		

	

	} 	



function create_salt($password)

{

	if($password!='') 

	return SHA1($password);

	else

    return SHA1(random_string('alnum', 32));

}





function price_format( $price ) {



   $price = number_format($price,2,".",",");

   $price = '&#8377;'.$price;

   return $price;

}









function get_type($type=''){

		if($type=='A'){

				$key = 'supper_admin_id';			

				if( $type ) {

					$key = "{$type}:{$key}";

				}		

		}

		elseif($type=='C'){

				$key = 'company_id';			

				if( $type ) {

					$key = "{$type}:{$key}";

				}		

		}	

		elseif($type=='V'){

				$key = 'vendor_id';			

				if( $type ) {

					$key = "{$type}:{$key}";

				}		

		}	

		elseif($type=='U'){

				$key = 'staff_id';			

				if( $type ) {

					$key = "{$type}:{$key}";

				}		

		}	

		

		return $key;

	}

	



   function logged_in($type=''){

		$CI= & get_instance();

		if($CI->session->userdata('user_id')!='')

		{

		 $user_result =user_details($CI->session->userdata('user_id'));

		 $user_type = $user_result->user_type;

		}

		if($CI->session->userdata('user_id')==''){

		  redirect(base_url());

		}

		elseif($type== $user_type)

		{	

		   return TRUE;

		}

		 return FALSE;

		

	}





function check_permissions(){

	$CI = &get_instance();

	$request_url=$_SERVER['REQUEST_URI'];

	$CI= & get_instance();

	if($CI->session->userdata('user_type')=='G')

	{

	 $roles=$CI->session->userdata('user_rights');//echo "<pre>";print_r($roles);die;

	}

	elseif($CI->session->userdata('user_type')=='C')

	{

	 $roles=$CI->session->userdata('user_rights');//echo "<pre>";print_r($roles);die;

	}

	else{

	 $rolerow=get_table_info('roles','role_id',$CI->session->userdata('role_id'));

	 $roles=json_decode($rolerow->role_rights,true);

	}

	$show_permissions=array(); 

	//$current_file  = $_SERVER['REQUEST_URI'];			  

	$access_url='';

	if($CI->uri->segment(1)!='')

	$access_url .= trim($CI->uri->segment(1));

	if($CI->uri->segment(2)!='')

	$access_url .= '/'.trim($CI->uri->segment(2));  

	if($CI->uri->segment(3)!='')

	$access_url .= '/'.trim($CI->uri->segment(3));

	$current_file = $access_url;

	//$current_file = $access_url.'/';

	$user_permissions  = $roles;

	if(!empty($user_permissions))

	{

		$user_type=$CI->session->userdata('role_id');

	    $CI->load->database();

	    $CI->db->select('*');

		$CI->db->from('navigation_menus');

		$CI->db->where('menu_link',$current_file);

		$CI->db->where_in('menu_id',$roles);

		$query = $CI->db->get();

	//	print $CI->db->last_query();die;

		if($query -> num_rows() > 0){ 

				return true;

		}else{   

				redirect(base_url() . 'unauthorized');

		}

		return true;

	}

}



function user_details($user_id){

		$CI = &get_instance();

		$CI->load->database();

		$CI->db->select('*');

		$CI->db->where('users.user_id',$user_id);

        $CI->db->from('users');

        $query = $CI->db->get();

        return $result = $query->row();



} //End of View function



function gettableresult($table,$fields,$order=NULL,$group=NULL)

    {

		$CI= & get_instance();

	    $CI->load->database();

        $CI->db->select('*');

		if(is_array($fields)){

	     foreach($fields as $keys => $values) {

			 $CI->db->where($keys, $values);

			 }         

	   }

        $CI->db->from($table);

		if($order!=NULL)

		$CI->db->order_by($order,"asc");

		if($group!=NULL)

		$CI->db->group_by($group);

        $query = $CI->db->get();

		//if($table=='user_timetable')

		//echo "--------------------->". $CI->db->last_query();

        if($query -> num_rows() == 0)

			{		return '0';

			}

			else

			{		return $query->result();

			}



} //End of Get Info Details function





  function timetosec($t)

	{

		if($t!='')

		{

		$time = explode('.', $t);

		if ( !isset($time[0]) )

			$time[0] = 0;

		if ( !isset($time[1]) )

			$time[1] = 0;

		if ( !isset($time[2]) )

			$time[2] = 0;

		return $time[0]*3600 + $time[1]*60 + $time[2];

		}else

		{	return false;

		}

	

	}





	function sectotime($s)

	{

		$hour = floor($s / 3600);



		if ( $hour < 0 )

			$hour = 0;

		$hour = $hour < 10 ? '0' . $hour : $hour;

		$min = floor( ($s % 3600) / 60);

		if ( $min < 0 )

			$min = 0;

		$min = $min < 10 ? '0' . $min : $min;

		$sec = $s % 60;

		if ( $sec < 0 )

			$sec = 0;

		$sec = $sec < 10 ? '0' . $sec : $sec;

		if($hour>0)

		return "$hour.$min.$sec";

		else

		return "$min.$sec";

	 }

		

		

	function time_spent_c($candidate_id)

	{	    

		    $CI= & get_instance();

		    $CI->dw=$CI->load->database('dw_db', TRUE); 

			$CI->dw->select('SUM(TIME_TO_SEC(time_spent)) timespent');

			$CI->dw->from('log_chapter');

			$CI->dw->where('candidate_id',$candidate_id);

			$query = $CI->dw->get();

			$rowtimespent = $query->row();

			$timespent = $rowtimespent->timespent;

			//echo $CI->dw->last_query()

			return $timespent;

	}



    		

	function chaps($candidate_id, $course_id)

	{

		$CI= & get_instance();

		$CI->dw=$CI->load->database('dw_db', TRUE); 

		$chaps = array();

		$CI->dw->select('chapter_id');

		$CI->dw->from('log_chapter');

		$CI->dw->where('candidate_id',$candidate_id);

		$CI->dw->where('chapter_complete','1');

		$query = $CI->dw->get();

		$chapterdata = $query->result_array();

		if($query->num_rows()>0){

			foreach($chapterdata as $skey=>$chaprow){

			   $chaps[] = $chaprow['chapter_id'];

			}

		 //Count Chapters Done time

		 $CI->dw->select('SUM(TIME_TO_SEC(min)) as donetime');

		 $CI->dw->from('chapters_time');

		 $CI->dw->where_in('chapter_id',$chaps);

		 $CI->dw->where('course_id',$course_id);

		 $query = $CI->dw->get();

		  //echo $CI->dw->last_query();

		  //echo "<br>";

	      if($query ->num_rows() > 0)

	       {	

			  $donerow = $query->row();

			  $timedone = $donerow->donetime;

		   }

		  }else

		   {

			   $timedone='0';

		   }

		    //Count Chapters Pending time

		    $CI->dw->select('SUM(TIME_TO_SEC(time_spent)) candtimemore');

			$CI->dw->from('log_chapter');

			$CI->dw->where_in('candidate_id',$candidate_id);

			$CI->dw->where('chapter_complete','0');

			$CI->dw->where('time_spent >','00:00:00');

			$query = $CI->dw->get();

			$rowmoretime = $query->row();

			$timemore = $rowmoretime->candtimemore;

		   // echo $CI->dw->last_query();

			//echo "<br>";

			return sectotime($timedone+$timemore);

	

	}







function check_campaign_uniqueid($id){

		$CI= & get_instance();

	    $CI->load->database();

   		$CI->db->select('campaign_log_id,unique_id');

        $CI->db->from('campaign_logs');

		$CI->db->where('unique_id', $id);

		$CI->db->order_by('campaign_log_id','ASC');

		$result = $CI->db->get();

		//echo $CI->db->last_query();

		//echo "<br>";

        $mytree='';

		static $return;

		if ($result->num_rows() > 0) {

            foreach ($result->result_array() as $row) {

				 

		      check_campaign_uniqueid($row['unique_id']);

			 $return[$row['unique_id']] = $row['unique_id'];

				   

            }

        }

		 return $return;

		

    }

	

function generateRandomString($length = 10) {

		$characters = '012345678956789';

		$charactersLength = strlen($characters);

		$randomString = '';

		for ($i = 0; $i < $length; $i++) {

			$randomString .= $characters[rand(0, $charactersLength - 1)];

		}

		return $randomString;

	}

	

	

 function special_char_remove($string){

		if($string==''){

			return '';

		}

		//return trim(preg_replace("/[^(x20-x7F)]*/","",$string));

		// $output = iconv("UTF-8", "ASCII//TRANSLIT//IGNORE", $string);

		

	   //  $output =  preg_replace("/^'|[^A-Za-z0-9\s-\s.]|'$/", '', $output); // lets remove utf-8 special characters except blank spaces

		return trim($string);

		

	}

	

/* Valid Email */

   function valid_email($str)

	{

		return ( ! preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? FALSE : TRUE;

	}

	

	

	function valid_contactno($str)

	{

		return ( ! preg_match("/^[0-9]+[0-9,\ -]*[0-9]$/", $str)) ? FALSE : TRUE;

	}





	

//Function Date and HRS Time Difference of Two dates.

function days_difference($date1,$date2)

{

	$diff = strtotime($date2) - strtotime($date1);

	$diff_days = floor($diff/(3600*24));

	if($diff_days > 0)

	$timediff=$diff_days;

	else 

	$timediff=0;



	return $timediff;



}

	

//Function Date and HRS Time Difference of Two dates.

function diffdays($date)

{

	$current = date('Y-m-d H:i:s');

	$diff = strtotime($current) - strtotime($date);

	$diff_days = floor($diff/(3600*24));

	if($diff_days > 0)

	$timediff=$diff_days;

	else 

	$timediff=0;



	return $timediff;



}





  function dateDifference($entry_time, $today)

	{

	$date1 = new DateTime($entry_time);

	$date2 = new DateTime($today);

	$interval = $date1->diff($date2);

	if ($interval->y > 0) $post_time = $interval->y . " years ago";

	elseif ($interval->m > 0) $post_time = $interval->m . " months ago";

	elseif ($interval->d > 0) $post_time = $interval->d . " days ago";

	elseif ($interval->h > 0) $post_time = $interval->h . " hours ago";

	elseif ($interval->i > 0) $post_time = $interval->i . " minutes ago";

	elseif ($interval->s > 0) $post_time = $interval->s . " seconds ago";

	  else $post_time = "just now";

	return $post_time;

	}





function check_unique_api($table,$fields,$likeornot=''){

		 $set_values='';

	     if(is_array($fields)){

			$CI= & get_instance();

			$CI->load->database();

			$CI->db->select('*');

			foreach($fields as $keys => $values) {

				$CI->db->where($keys, $values);

			} 

			$CI->db->from($table);	

			$query = $CI->db->get();//echo "<pre>";print_r($CI->db->last_query());die;

			return $query->num_rows();

		}

		return false;  

}



function check_unique_api_edit($table,$fields,$prim_fields){

		 $set_values='';

	     if(is_array($fields)){

			$CI= & get_instance();

			$CI->load->database();

			$CI->db->select('*');

			foreach($fields as $keys => $values) {

				$CI->db->where($keys, $values);

			} 

			foreach($prim_fields as $pkeys => $pvalues) {

				$CI->db->where("$pkeys !=", $pvalues);

			} 

			$CI->db->from($table);	

			$query = $CI->db->get();

			return $query->num_rows();

		}

		return false;  

}





function check_unique($table,$fields,$likeornot=''){

		 $set_values='';

	     if(is_array($fields)){ //echo "<pre>";print_r($fields);

			$CI= & get_instance();

			$CI->load->database();

			$CI->db->select('*');

			foreach($fields as $keys => $values) {

				$CI->db->where($keys, $values);

			} 

			$CI->db->from($table);	

			$query = $CI->db->get();//echo "<pre>";print_r($CI->db->last_query());die;

			return $query->num_rows();

		}

		return false;  

}



function check_unique_edit($table,$fields,$prim_fields){

		 $set_values='';

	     if(is_array($fields)){

			$CI= & get_instance();

			$CI->load->database();

			$CI->db->select('*');

			foreach($fields as $keys => $values) {

				$CI->db->where($keys, $values);

			} 

			foreach($prim_fields as $pkeys => $pvalues) {

				$CI->db->where("$pkeys !=", $pvalues);

			} 

			$CI->db->from($table);	

			$query = $CI->db->get();

			//echo $CI->db->last_query();die;	

			return $query->num_rows();

			

		}

		return false;  

}



function get_table_info($table,$feild,$uniqueid){

		$CI= & get_instance();

	    $CI->load->database();

        $CI->db->select('*');

        $CI->db->where($feild, $uniqueid);

        $CI->db->from($table);

		//echo "--------------------->". $CI->db->last_query();

        $query = $CI->db->get();

        if($query -> num_rows() == 0)

			{		return '0';

			}

			else

			{		return $query->row();

			}



    } //End of Get Info Details function

	



function getEventEmailOrder($stepsLength=null)

{



	$arrayOne		=	['1'=>'sent','2'=>'received','3'=>'validProof','4'=>'invoice'];

	$arrayTwo		=	['1'=>'sent','2'=>'received','3'=>'invalidProof','4'=>'proofReSend','5'=>'validProof','6'=>'invoice'];

	if($stepsLength)

	{

		if(count($arrayTwo)==$stepsLength)

		{

			return $arrayTwo;

		}

		else

		{

			return $arrayOne;

		}

	}

	$randomNumber	=	rand(1,10);

	if(in_array($randomNumber,[1,2,3]))

	{

		return $arrayTwo;

	}

	else

	{

		return $arrayOne;

	}

}





function getFooterMailClass($type)

{



	$array1		=	['footer-sender-1','footer-sender-2'];

	$array2		=	['footer-receiver-1','footer-receiver-2','footer-receiver-3','footer-receiver-4','footer-receiver-5','footer-receiver-6','footer-receiver-7','footer-receiver-8','footer-receiver-9','footer-receiver-10'];

	if($type=="sender")

	{

		return $array1[rand(0,1)];

	}

	else

	{

		return $array2[rand(0,9)];

	}

}



function getFooterTaskBar()

{

	$array1		=	['taskbar-1','taskbar-2','taskbar-3','taskbar-4','taskbar-5'];

	return $array1[rand(0,4)];

}



function ordinal($number) {

    $ends = ['th','st','nd','rd','th','th','th','th','th','th'];

    if ((($number % 100) >= 11) && (($number % 100) <= 13))

        return $number . 'th';

    else

        return $number . $ends[$number % 10];

}







 function gettableinfo($table,$fields)

    {

		$CI= & get_instance();

	    $CI->load->database();

        $CI->db->select('*');

		if(is_array($fields)){

	     foreach($fields as $keys => $values) {

			 $CI->db->where($keys, $values);

			 }         

	   }

        $CI->db->from($table);

        $query = $CI->db->get();

		/* if($table=='user_timetable')

		echo "--------------------->". $CI->db->last_query(); die; */

        if($query -> num_rows() == 0)

			{		return '0';

			}

			else

			{		return $query->row();

			}



    } //End of Get Info Details function

	



function get_count_table($table,$fields=NULL)

	{

		$CI= & get_instance();

		$CI->load->database();

		$CI->db->select('*');

		if(is_array($fields)){

		 foreach($fields as $keys => $values) {

			 $CI->db->where($keys, $values);

			 }         

	   }

	   $CI->db->from($table);

	   $query = $CI->db->get();

	   //echo $CI->db->last_query(); 

	   return $query -> num_rows();

	} //End of Get Info Details function





function get_languages_dropdown(){

		$CI= & get_instance();

	    $CI->dw=$CI->load->database('dwdev_db', TRUE); 

	    $CI->dw->select('*');

        $CI->dw->from('languages');

		$CI->dw->where('is_active', '1');

        $CI->dw->order_by('language_id');

		//echo $CI->dw->last_query();

        $result = $CI->dw->get();

        $return = array();

        if ($result->num_rows() > 0) {

            $return[''] = 'Select';

            foreach ($result->result_array() as $row) {

			     $return[$row['language_id']] = $row['language_name'];

            }

        }

        return $return;

	  }

	



function get_candidates_dropdown($bank_id)

    {

		$CI= & get_instance();

	    $CI->load->database();

	    $CI->db->select('candidate_id,bank_account_no,acc_holder_name,contact_number,candidateid');

        $CI->db->from('candidates');

		if($bank_id!='0')

		$CI->db->where('bank_id',$bank_id);

		$CI->db->where('is_active','1');

		$CI->db->order_by('acc_holder_name','ASC');

		$CI->db->order_by('contact_number','ASC');

		$CI->db->order_by('bank_account_no','ASC');

		//echo $CI->db->last_query();

		$result = $CI->db->get();

	    $return = array();

		if ($result->num_rows() > 0) {

            $return[''] = 'Select';

            foreach ($result->result_array() as $row) {

				

				  if($row['candidateid']!='')

				  $candidateid = ' - '.$row['candidateid'];

				  else

				  $candidateid='';

				

				  $return[$row['candidate_id']] = $row['acc_holder_name'].' -  '.$row['contact_number'].' - '.$row['bank_account_no'].$candidateid;

            }

        }

        return $return;

		//print_r($return);

    }

	





 function get_content_translation($table,$needed_fields,$where,$dbname,$db){

	    $CI= & get_instance();

	    $CI->$db=$CI->load->database($dbname, TRUE); 

        $CI->$db->select($needed_fields);

        if(is_array($where)){ 

	        foreach($where as $keys => $values) {

			    $CI->$db->where($keys, $values);

			 }         

	    } 

        $CI->$db->from($table);

        $query = $CI->$db->get();

       if($query->num_rows() == 0){		

            return '0';

        }

        else{		

            return $query->row();

        }

    }	

		

function time_zone()

{

	$CI= & get_instance();

    $CI->load->database();

	$timezone="";

	$logged_user_type = $CI->session->userdata('user_type');

	$time_zone_array = time_zone_array();

	if($logged_user_type==SUPERADMIN)

	{

		$userrow = get_table_info('users','user_id',$CI->session->userdata('user_id'));

		if(!empty($userrow->time_zone))

		$timezone=$time_zone_array[$userrow->time_zone];

		else

		$timezone='Asia/Kolkata';

		

	}else if($logged_user_type==COMPANY)

	{

		$userrow = get_table_info('users','user_id',$CI->session->userdata('master_id'));

		if(!empty($userrow->time_zone))

		$timezone=$time_zone_array[$userrow->time_zone];

		else

			$timezone='Asia/Kolkata';

	}

	else if(($logged_user_type==COMPANY_USER) || ($logged_user_type==CLIENT))

	{

		$userrow = get_table_info('users','user_id',$CI->session->userdata('master_id'));

		if(!empty($userrow->time_zone))

		$timezone=$time_zone_array[$userrow->time_zone];

		else

			$timezone='Asia/Kolkata';

	}else

	{

			$timezone='Asia/Kolkata';

	}

	

	return date_default_timezone_set($timezone);

}





	

function user_type_array()

	{  $user_type_array = array();

	   $user_type_array['']=' Select User Type ';

 	   $user_type_array['A'] ='Admin';

	   $user_type_array['E'] ='Customers';

	   return $user_type_array;

	} 



function gender_array()

	{  $gender_array = array();

	   $gender_array['m'] ='Male';

	   $gender_array['f'] ='Female';

	   return $gender_array;

	} 	

	

	function event_type_array()

	{  

		$event_type_array = array();

		$event_type_array[null] ='Select';

		$event_type_array['high'] ='High';

	   	$event_type_array['normal'] ='Normal';

	   	return $event_type_array;

	} 	

	



function consent_status_array()

	{   $consent_status_array = array();

	    $consent_status_array['']=' Select ';

		$consent_status_array['0'] ='Pending';

		$consent_status_array['1'] ='View';

		$consent_status_array['2'] ='Date of birth verified';	

		$consent_status_array['3'] ='Completed';		

	   return $consent_status_array;

	} 	

		

function search_by_array()

	{  

		$search_by_array= array();

		$search_by_array['']='Select Search By';

		$search_by_array[1]='Application NO.';

		$search_by_array[2]='Candidate ID.';

		$search_by_array[3]='Mobile NO.';

		$search_by_array[4]='Candidate Name';

		

		return $search_by_array;

	}	



function userstatusarray()

	{  $user_status_array = array();

	   $user_status_array[''] = "Select Status";

	   $user_status_array['a'] = "Active";

	   $user_status_array['d'] = "De-Active";

	   return $user_status_array;

	}



function per_page_records()

	{   $per_page_records = array();

		$per_page_records[100] ='100';

		$per_page_records[150] ='150';

		$per_page_records[200] ='200';

		$per_page_records[500] ='500';

		$per_page_records[1000] ='1000';

	    return $per_page_records;

	}	



function payment_status_array()

	{  $payment_status_array = array();

	   $payment_status_array[''] = "Select";

	   $payment_status_array['cr'] = "CREDIT";

	   $payment_status_array['dr'] = "DEBIT";

	

	   return $payment_status_array;

	}





function payment_mode_array()

	{  $payment_mode_array = array();

	   $payment_mode_array[''] = "Select";

	   $payment_mode_array['cash'] = "CASH";

	   $payment_mode_array['transfer'] = "ONLINE TRANSFER";

       $payment_mode_array['neft'] = "NEFT";

       $payment_mode_array['inw'] = "INW";

       $payment_mode_array['upi'] = "UPI";

	   $payment_mode_array['atm'] = "ATM";

     

      return $payment_mode_array;

	}





function data_percentage_array(){

		$data_percentage_array = array();

		$data_percentage_array[''] = "Select";

		for($i=1; $i<20; $i++){

			$data_percentage_array[$i] = $i."%"; 

		}

		return $data_percentage_array;	

}



function duration_array(){

		$duration_array = array();

		$duration_array[''] = "Select";

		for($i=1; $i<50; $i++){

			$duration_array[$i] = $i." seconds"; 

		}

		

		return $duration_array;	

}



function data_records_array(){

		$data_records_array = array();

		$data_records_array[''] = "Select";

		for($i=1; $i<15; $i++){

			$data_records_array[$i] = $i." lakh"; 

		}

		

		return $data_records_array;	

}

							

function time_zone_array()

	{  		$timezone=array (

				    '' => 'Select Timezone',

					'(UTC-11:00) Midway Island' => 'Pacific/Midway',

					'(UTC-11:00) Samoa' => 'Pacific/Samoa',

					'(UTC-10:00) Hawaii' => 'Pacific/Honolulu',

					'(UTC-09:00) Alaska' => 'US/Alaska',

					'(UTC-08:00) Pacific Time (US &amp; Canada)' => 'America/Los_Angeles',

					'(UTC-08:00) Tijuana' => 'America/Tijuana',

					'(UTC-07:00) Arizona' => 'US/Arizona',

					'(UTC-07:00) Chihuahua' => 'America/Chihuahua',

					'(UTC-07:00) La Paz' => 'America/Chihuahua',

					'(UTC-07:00) Mazatlan' => 'America/Mazatlan',

					'(UTC-07:00) Mountain Time (US &amp; Canada)' => 'US/Mountain',

					'(UTC-06:00) Central America' => 'America/Managua',

					'(UTC-06:00) Central Time (US &amp; Canada)' => 'US/Central',

					'(UTC-06:00) Guadalajara' => 'America/Mexico_City',

					'(UTC-06:00) Mexico City' => 'America/Mexico_City',

					'(UTC-06:00) Monterrey' => 'America/Monterrey',

					'(UTC-06:00) Saskatchewan' => 'Canada/Saskatchewan',

					'(UTC-05:00) Bogota' => 'America/Bogota',

					'(UTC-05:00) Eastern Time (US &amp; Canada)' => 'US/Eastern',

					'(UTC-05:00) Indiana (East)' => 'US/East-Indiana',

					'(UTC-05:00) Lima' => 'America/Lima',

					'(UTC-05:00) Quito' => 'America/Bogota',

					'(UTC-04:00) Atlantic Time (Canada)' => 'Canada/Atlantic',

					'(UTC-04:30) Caracas' => 'America/Caracas',

					'(UTC-04:00) La Paz' => 'America/La_Paz',

					'(UTC-04:00) Santiago' => 'America/Santiago',

					'(UTC-03:30) Newfoundland' => 'Canada/Newfoundland',

					'(UTC-03:00) Brasilia' => 'America/Sao_Paulo',

					'(UTC-03:00) Buenos Aires' => 'America/Argentina/Buenos_Aires',

					'(UTC-03:00) Georgetown' => 'America/Argentina/Buenos_Aires',

					'(UTC-03:00) Greenland' => 'America/Godthab',

					'(UTC-02:00) Mid-Atlantic' => 'America/Noronha',

					'(UTC-01:00) Azores' => 'Atlantic/Azores',

					'(UTC-01:00) Cape Verde Is.' => 'Atlantic/Cape_Verde',

					'(UTC+00:00) Casablanca' => 'Africa/Casablanca',

					'(UTC+00:00) Edinburgh' => 'Europe/London',

					'(UTC+00:00) Greenwich Mean Time : Dublin' => 'Etc/Greenwich',

					'(UTC+00:00) Lisbon' => 'Europe/Lisbon',

					'(UTC+00:00) London' => 'Europe/London',

					'(UTC+00:00) Monrovia' => 'Africa/Monrovia',

					'(UTC+00:00) UTC' => 'UTC',

					'(UTC+01:00) Amsterdam' => 'Europe/Amsterdam',

					'(UTC+01:00) Belgrade' => 'Europe/Belgrade',

					'(UTC+01:00) Berlin' => 'Europe/Berlin',

					'(UTC+01:00) Bern' => 'Europe/Berlin',

					'(UTC+01:00) Bratislava' => 'Europe/Bratislava',

					'(UTC+01:00) Brussels' => 'Europe/Brussels',

					'(UTC+01:00) Budapest' => 'Europe/Budapest',

					'(UTC+01:00) Copenhagen' => 'Europe/Copenhagen',

					'(UTC+01:00) Ljubljana' => 'Europe/Ljubljana',

					'(UTC+01:00) Madrid' => 'Europe/Madrid',

					'(UTC+01:00) Paris' => 'Europe/Paris',

					'(UTC+01:00) Prague' => 'Europe/Prague',

					'(UTC+01:00) Rome' => 'Europe/Rome',

					'(UTC+01:00) Sarajevo' => 'Europe/Sarajevo',

					'(UTC+01:00) Skopje' => 'Europe/Skopje',

					'(UTC+01:00) Stockholm' => 'Europe/Stockholm',

					'(UTC+01:00) Vienna' => 'Europe/Vienna',

					'(UTC+01:00) Warsaw' => 'Europe/Warsaw',

					'(UTC+01:00) West Central Africa' => 'Africa/Lagos',

					'(UTC+01:00) Zagreb' => 'Europe/Zagreb',

					'(UTC+02:00) Athens' => 'Europe/Athens',

					'(UTC+02:00) Bucharest' => 'Europe/Bucharest',

					'(UTC+02:00) Cairo' => 'Africa/Cairo',

					'(UTC+02:00) Harare' => 'Africa/Harare',

					'(UTC+02:00) Helsinki' => 'Europe/Helsinki',

					'(UTC+02:00) Istanbul' => 'Europe/Istanbul',

					'(UTC+02:00) Jerusalem' => 'Asia/Jerusalem',

					'(UTC+02:00) Kyiv' => 'Europe/Helsinki',

					'(UTC+02:00) Pretoria' => 'Africa/Johannesburg',

					'(UTC+02:00) Riga' => 'Europe/Riga',

					'(UTC+02:00) Sofia' => 'Europe/Sofia',

					'(UTC+02:00) Tallinn' => 'Europe/Tallinn',

					'(UTC+02:00) Vilnius' => 'Europe/Vilnius',

					'(UTC+03:00) Baghdad' => 'Asia/Baghdad',

					'(UTC+03:00) Kuwait' => 'Asia/Kuwait',

					'(UTC+03:00) Minsk' => 'Europe/Minsk',

					'(UTC+03:00) Nairobi' => 'Africa/Nairobi',

					'(UTC+03:00) Riyadh' => 'Asia/Riyadh',

					'(UTC+03:00) Volgograd' => 'Europe/Volgograd',

					'(UTC+03:30) Tehran' => 'Asia/Tehran',

					'(UTC+04:00) Abu Dhabi' => 'Asia/Muscat',

					'(UTC+04:00) Baku' => 'Asia/Baku',

					'(UTC+04:00) Moscow' => 'Europe/Moscow',

					'(UTC+04:00) Muscat' => 'Asia/Muscat',

					'(UTC+04:00) St. Petersburg' => 'Europe/Moscow',

					'(UTC+04:00) Tbilisi' => 'Asia/Tbilisi',

					'(UTC+04:00) Yerevan' => 'Asia/Yerevan',

					'(UTC+04:30) Kabul' => 'Asia/Kabul',

					'(UTC+05:00) Islamabad' => 'Asia/Karachi',

					'(UTC+05:00) Karachi' => 'Asia/Karachi',

					'(UTC+05:00) Tashkent' => 'Asia/Tashkent',

					'(UTC+05:30) Chennai' => 'Asia/Calcutta',

					'(UTC+05:30) Kolkata' => 'Asia/Kolkata',

					'(UTC+05:30) Mumbai' => 'Asia/Calcutta',

					'(UTC+05:30) New Delhi' => 'Asia/Calcutta',

					'(UTC+05:30) Sri Jayawardenepura' => 'Asia/Calcutta',

					'(UTC+05:45) Kathmandu' => 'Asia/Katmandu',

					'(UTC+06:00) Almaty' => 'Asia/Almaty',

					'(UTC+06:00) Astana' => 'Asia/Dhaka',

					'(UTC+06:00) Dhaka' => 'Asia/Dhaka',

					'(UTC+06:00) Ekaterinburg' => 'Asia/Yekaterinburg',

					'(UTC+06:30) Rangoon' => 'Asia/Rangoon',

					'(UTC+07:00) Bangkok' => 'Asia/Bangkok',

					'(UTC+07:00) Hanoi' => 'Asia/Bangkok',

					'(UTC+07:00) Jakarta' => 'Asia/Jakarta',

					'(UTC+07:00) Novosibirsk' => 'Asia/Novosibirsk',

					'(UTC+08:00) Beijing' => 'Asia/Hong_Kong',

					'(UTC+08:00) Chongqing' => 'Asia/Chongqing',

					'(UTC+08:00) Hong Kong' => 'Asia/Hong_Kong',

					'(UTC+08:00) Krasnoyarsk' => 'Asia/Krasnoyarsk',

					'(UTC+08:00) Kuala Lumpur' => 'Asia/Kuala_Lumpur',

					'(UTC+08:00) Perth' => 'Australia/Perth',

					'(UTC+08:00) Singapore' => 'Asia/Singapore',

					'(UTC+08:00) Taipei' => 'Asia/Taipei',

					'(UTC+08:00) Ulaan Bataar' => 'Asia/Ulan_Bator',

					'(UTC+08:00) Urumqi' => 'Asia/Urumqi',

					'(UTC+09:00) Irkutsk' => 'Asia/Irkutsk',

					'(UTC+09:00) Osaka' => 'Asia/Tokyo',

					'(UTC+09:00) Sapporo' => 'Asia/Tokyo',

					'(UTC+09:00) Seoul' => 'Asia/Seoul',

					'(UTC+09:00) Tokyo' => 'Asia/Tokyo',

					'(UTC+09:30) Adelaide' => 'Australia/Adelaide',

					'(UTC+09:30) Darwin' => 'Australia/Darwin',

					'(UTC+10:00) Brisbane' => 'Australia/Brisbane',

					'(UTC+10:00) Canberra' => 'Australia/Canberra',

					'(UTC+10:00) Guam' => 'Pacific/Guam',

					'(UTC+10:00) Hobart' => 'Australia/Hobart',

					'(UTC+10:00) Melbourne' => 'Australia/Melbourne',

					'(UTC+10:00) Port Moresby' => 'Pacific/Port_Moresby',

					'(UTC+10:00) Sydney' => 'Australia/Sydney',

					'(UTC+10:00) Yakutsk' => 'Asia/Yakutsk',

					'(UTC+11:00) Vladivostok' => 'Asia/Vladivostok',

					'(UTC+12:00) Auckland' => 'Pacific/Auckland',

					'(UTC+12:00) Fiji' => 'Pacific/Fiji',

					'(UTC+12:00) International Date Line West' => 'Pacific/Kwajalein',

					'(UTC+12:00) Kamchatka' => 'Asia/Kamchatka',

					'(UTC+12:00) Magadan' => 'Asia/Magadan',

					'(UTC+12:00) Marshall Is.' => 'Pacific/Fiji',

					'(UTC+12:00) New Caledonia' => 'Asia/Magadan',

					'(UTC+12:00) Solomon Is.' => 'Asia/Magadan',

					'(UTC+12:00) Wellington' => 'Pacific/Auckland',

					'(UTC+13:00) Nuku\'alofa' => 'Pacific/Tongatapu'

				);



	   return $timezone;

	}	

	

 function formatUrl($str, $sep='-')

    {

            $res = strtolower($str);

            $res = preg_replace('/[^[:alnum:]]/', ' ', $res);

            $res = preg_replace('/[[:space:]]+/', $sep, $res);

            return trim($res, $sep);

    }



function Dateformat($date, $timestamp=0)

{

	if($timestamp==0)

		$timestamp = strtotime($date);

	return date('d M, Y', $timestamp);

}	

function dir_is_empty($path)

{

	$empty = true;

	$dir = opendir($path); 

	while($file = readdir($dir)) 

	{

		if($file != '.' && $file != '..')

		{

			$empty = false;

			break;

		}

	}

	closedir($dir);

	return $empty;

}

			



function getErrorMessageForCode($errNo)

{

	global $arrAllError;

	$bResult = array_key_exists($errNo  , $arrAllError );

	if($bResult)

		return $arrAllError[$errNo];

	else

		return 'Error message not set for Error code '.$errNo;

}





  function send_sms($mobile,$body,$dlttempid)

	 {

		  $numbers=urlencode($mobile);

		  $sms_msg=urlencode($body);

		

	 $url='http://www.smsjust.com/sms/user/urlsms.php?username=HDFCLI&pass=hdfclife@1234&senderid=HDFCLF&dest_mobileno='.$numbers.'&message='.$sms_msg.'&response=Y&dlttempid='.$dlttempid.''; 

	 // echo $url;

	  ///echo "<br><br>";

		$curl = curl_init();

		curl_setopt_array($curl, array(

		CURLOPT_RETURNTRANSFER => 1,

		CURLOPT_URL => $url,

		CURLOPT_USERAGENT => 'Codular Sample cURL Request'

		));

		$lines = curl_exec($curl);

		curl_close($curl);

		/*print_r($lines);

		die;*/

		if($lines)

		return $url;

		else

		return "0";

	 }





 function send_sms_skill($mobile,$body,$dlttempid)

	 {

		  $numbers=urlencode($mobile);

		  $sms_msg=urlencode($body);

		

	 $url='http://www.smsjust.com/sms/user/urlsms.php?username=DREAMINSURANCE&pass=Fd1w@6Z_&senderid=DRMWVR&dest_mobileno='.$numbers.'&message='.$sms_msg.'&response=Y&dlttempid='.$dlttempid.''; 

	 // echo $url;

	  ///echo "<br><br>";

		$curl = curl_init();

		curl_setopt_array($curl, array(

		CURLOPT_RETURNTRANSFER => 1,

		CURLOPT_URL => $url,

		CURLOPT_USERAGENT => 'Codular Sample cURL Request'

		));

		$lines = curl_exec($curl);

		curl_close($curl);

		/*print_r($lines);

		die;*/

		if($lines)

		return $url;

		else

		return "0";

	 }

	 



 //require('mailer/PHPMailerAutoload.php');	 

 function common_mail($to_email,$alternate_email,$email_subject=NULL,$email_body=NULL,$attachment1=NULL,$attachment2=NULL){

	$from_email = noreply;

	//require('mailer/PHPMailerAutoload.php');

	//error_reporting(-1);

	//require('mailer/class.phpmailer.php');

	//require('mailer/class.smtp.php');

	//require 'class.phpmailer.php';

    //require 'class.smtp.php';

   // echo "----from_email---------->".$from_email;

	// echo "---to_email----------->".$to_email;

	//Create a new PHPMailer instance

	$mail = new PHPMailer;

	//$mail->SMTPDebug = 0;        

	//Set who the message is to be sent from

	$mail->setFrom($from_email, 'Raheja QBE');

	//Set an alternative reply-to address

	$mail->addReplyTo($from_email, 'Raheja QBE');

	//Set who the message is to be sent to

	$mail->addAddress($to_email, 'Raheja QBE');

	

	if($alternate_email!='')

	$mail->AddCC  =($alternate_email);

	

	//Set the subject line

	$mail->Subject = $email_subject;

	//Read an HTML message body from an external file, convert referenced images to embedded,

	//convert HTML into a basic plain-text alternative body

	$mail->msgHTML($email_body);

	//Replace the plain text body with one created manually

	$mail->AltBody = 'Mandatory Training Online Raheja QBE.';

	//Attach an image file

	if($attachment1!=NULL)

	$mail->addAttachment($attachment1);   // I took this from the phpmailer example on github but I'm not sure if I have it right.  

	if($attachment2!=NULL)    

	$mail->addAttachment($attachment2);



	//send the message, check for errors

	if (!$mail->send()) {

		//echo "Mailer Error: " . $mail->ErrorInfo;

		//die();

	    $val=0;

	} else {

		$val=1;

	}

	

	return $val;

}





 function common_mail_skill($to_email,$alternate_email,$email_subject=NULL,$email_body=NULL,$attachment1=NULL,$attachment2=NULL){

	$from_email = noreply;

	//require('mailer/PHPMailerAutoload.php');

	//error_reporting(-1);

	//require('mailer/class.phpmailer.php');

	//require('mailer/class.smtp.php');

	//require 'class.phpmailer.php';

    //require 'class.smtp.php';

   // echo "----from_email---------->".$from_email;

	// echo "---to_email----------->".$to_email;

	//Create a new PHPMailer instance

	$mail = new PHPMailer;

	//$mail->SMTPDebug = 0;        

	//Set who the message is to be sent from

	$mail->setFrom($from_email, 'Dreamweavers');

	//Set an alternative reply-to address

	$mail->addReplyTo($from_email, 'Dreamweavers');

	//Set who the message is to be sent to

	$mail->addAddress($to_email, 'Dreamweavers');

	

	if($alternate_email!='')

	$mail->AddCC  =($alternate_email);

	

	//Set the subject line

	$mail->Subject = $email_subject;

	//Read an HTML message body from an external file, convert referenced images to embedded,

	//convert HTML into a basic plain-text alternative body

	$mail->msgHTML($email_body);

	//Replace the plain text body with one created manually

	$mail->AltBody = 'Regarding Vocational Trainer (IT/ITes) Examination.';

	//Attach an image file

	if($attachment1!=NULL)

	$mail->addAttachment($attachment1);   // I took this from the phpmailer example on github but I'm not sure if I have it right.  

	if($attachment2!=NULL)    

	$mail->addAttachment($attachment2);



	//send the message, check for errors

	if (!$mail->send()) {

		//echo "Mailer Error: " . $mail->ErrorInfo;

		//die();

	    $val=0;

	} else {

		$val=1;

	}

	

	return $val;

}





function templatedata($template_message="",$records=array())

	{

	//	print_R($records);die;

		$object=array();

		$afterStr=array();

		if(!empty($template_message) && !empty($records))

		{

		$record=$records;

		//print_R($record);die;

				$text = $template_message;

				$test= str_replace(']','}',$text);

				$test= str_replace('[','{',$test);

				preg_match_all('/{(\w+)}/', $test, $matches);

				$datatest[]=$matches;

				foreach ($datatest as $indexed=>$var_name) 

				{	

					foreach($var_name as $index => $varname)

					{

						if(count($varname)==0)

						{

							continue;

						}

						if($varname[$index]!=$varname[0])

						{

							$object[]=$varname;

						}

					}

				}

				foreach($object as  $objects)

				{	

					foreach($objects as $index => $varname)

					{

						$afterStr[$varname]= $record->{$varname};

					}

				}

	

				$SMS_Body   = $template_message;

				foreach($afterStr as $key=>$data)

				{    

					if($data=="")

					{

						$data=" ";

					}

					$SMS_Body   = str_replace("{".$key."}", $data, $SMS_Body);	

				}

		return $SMS_Body; 

		}		

	}







	

function get_slot_array()

{

	$CI= & get_instance();

	$CI->load->database();

	$CI->db->select('*');

	$CI->db->from('event_slots');

	$CI->db->where('is_active','1');

	$CI->db->group_by('slot_id'); 

	$CI->db->order_by('slot_start_time','ASC');

	$result = $CI->db->get();

	$return = array();

	//echo "--------------------->". $CI->db->last_query();

	if ($result->num_rows() > 0) {

	   $return[''] = 'Select';

		foreach ($result->result_array() as $row) {

			

			$slot_start_time = date("g:i A",strtotime($row['slot_start_time']));

			$slot_end_time = date("g:i A",strtotime($row['slot_end_time']));

				

			$return[$row['slot_id']] = $slot_start_time.' - '.$slot_end_time.' - '.$row['slot_id'];

		}

   }

	return $return;

	//print_r($return);

}





function get_list_options($list_id,$order)

    {

		$CI= & get_instance();

	    $CI->load->database();

		$CI->db->select('*');

		$CI->db->from('list_options');

		if($list_id!='')

		$CI->db->where('list_id', $list_id);

		$CI->db->where("(user_id='".$CI->session->userdata('master_id')."' OR user_id='0')", NULL, FALSE);

		$CI->db->order_by('seq', $order);

		$result = $CI->db->get();

	    $return = array();

        if ($result->num_rows() > 0) {

		   $return[''] = 'Select';

		    foreach ($result->result_array() as $row) {

				

			    $title = $row['title']; 

					

                $return[$row['option_id']] = $title;

            }

	   }

        return $return;

		//print_r($return);

    }



 function gettabledropdown($table,$fields,$unique_id,$view_feild,$orderval=NULL,$order=NULL)

    {

		$CI= & get_instance();

	    $CI->load->database();

        $CI->db->select('*');

		if(is_array($fields)){

	     foreach($fields as $keys => $values) {

			 if(is_array($values))

			 $CI->db->where_in($keys, $values);

			 else

			 $CI->db->where($keys, $values);

			 }         

	   }

        $CI->db->from($table);

		if($orderval!=NULL)

		$CI->db->order_by($orderval,$order);

		$result = $CI->db->get();

		$return = array();

		//if($table=='designation')

		//echo "--------------------->". $CI->db->last_query();

        

        if ($result->num_rows() > 0) {

			//if($table!='fee_concession_users')

            $return[''] = 'Select';

            foreach ($result->result_array() as $row) {

                $return[$row[$unique_id]] = $row[$view_feild];

            }

        }

		 return $return;



    } //End of Get Info Details function

			



function get_max_values($TB,$max_field,$fields=NULL)

    {

		$CI= & get_instance();

	    $CI->load->database();

		$CI->db->select_max($max_field,$max_field);

		if(is_array($fields)){

	     foreach($fields as $keys => $val) {

			 $CI->db->where($keys, $val);

			 }         

	   }

		$result = $CI->db->get($TB);  

		// $CI->db->order_by($feild, 'ASC');

		//echo $CI->db->last_query();

        $order_result = $result->row();

		if($result->num_rows() > 0 && !is_null($order_result->$max_field))

		{

			$max_value =$order_result->$max_field+1;

		}

		else

		{

			$max_value ='1';

		}

		 return $max_value;

    }



				

	function createLogFile($operation,$id,$update_by_id,$table_name)	

	{

		$CI= & get_instance();

		$CI->load->database();

		if (!is_dir('global/logs')) {

			mkdir('./global/logs', 0777, TRUE);

	    }			

		$info = array();

		$info['update_by'] = $update_by_id;

		$info['id'] = $id;

		$info['table_name'] = $table_name;

		$info['operation'] = $operation;

		$json = json_encode($info);

		$my_file = "log_".date('Y-m').".txt"; 

		$file = "./global/logs/".$my_file;

		//using the FILE_APPEND flag to append the content.

		file_put_contents ($file, $json.",", FILE_APPEND);	

		

	}

	

		

	function exportToExcel($arrInfo,$heading='')

	{	



	$CI =& get_instance();

	$CI->load->library('PHPExcel');

	

	// Starting the PHPExcel library

	$objPHPExcel = new PHPExcel();

	// Set document properties

	$objPHPExcel->getProperties()->setCreator("DWE")

								 ->setLastModifiedBy("Ajay Kumar")

								 ->setTitle("Office 2007 XLSX Test Document")

								 ->setSubject("Office 2007 XLSX Test Document")

								 ->setDescription("Test document for Office 2007 XLSX, generated by PHP classes.")

								 ->setKeywords("office 2007 openxml php")

								 ->setCategory("Test result file");

	if($heading != '')

	{

		$objPHPExcel->getActiveSheet()->getStyle('A1:B1')->getFont()->setBold(true);

										 

		$objPHPExcel->getActiveSheet()->getStyle('A1:B1')->getFont()->setSize(15);

		$objPHPExcel->setActiveSheetIndex(0)

					->setCellValue("A1", "$heading");

	}

	

	$objPHPExcel->getActiveSheet()->getStyle($arrInfo['firstKey'].":".$arrInfo['lastKey'])->getFont()->setBold(true);

										 

	$objPHPExcel->getActiveSheet()->getStyle($arrInfo['firstKey'].":".$arrInfo['lastKey'])->getFont()->setSize(13);

	

	foreach($arrInfo['columns'] as $key=>$row)

	{		

		$objPHPExcel->setActiveSheetIndex(0)

					->setCellValue("$key", "$row");

	}	

	

	if($arrInfo['arr'] != '')

	{	

		$i =($heading!='') ? 4 : 2;

		foreach($arrInfo['arr'] as $result)

		{  

			$j=0;

			

			foreach($result as $key=>$row)

			{  

				$objPHPExcel->setActiveSheetIndex(0)

							->setCellValue($arrInfo['colIndex'][$j].$i,$row);	

				$j +=1;	

			}

			$i += 1;	

		}

		

		$j = $i;

		if(isset($arrInfo['total_col_name']))

		{

			$objPHPExcel->getActiveSheet()->getStyle('A'.$j.':E'.$arrInfo['total_col_name'].$j)->getFont()->setBold(true);

											 

			$objPHPExcel->getActiveSheet()->getStyle('A'.$j.':E'.$arrInfo['total_col_name'].$j)->getFont()->setSize(13);

			

			$objPHPExcel->setActiveSheetIndex(0)

							->setCellValue('A'.$j, 'Total')

							->setCellValue($arrInfo['total_col_name'].$j, htmlspecialchars(price_format($arrInfo['total'])));

		}				

	}	

	else

	{		

		$objPHPExcel->setActiveSheetIndex(0)

					->setCellValue('A'.$i, 'No record Exists');		

	}	

	

	// Rename worksheet (worksheet, not filename)

	$objPHPExcel->getActiveSheet()->setTitle($arrInfo['title']);

	// Set active sheet index to the first sheet, so Excel opens this as the first sheet

	$objPHPExcel->setActiveSheetIndex(0);

	 

	// Redirect output to a client’s web browser (Excel2007)

	//clean the output buffer

	//ob_end_clean();

	 

	//this is the header given from PHPExcel examples. but the output seems somewhat corrupted in some cases.

	//header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

	//so, we use this header instead.

	

	$filename=mt_rand(1,100000).'.xls';

	$filename=$arrInfo['file_name'];

	

	header('Content-type: application/vnd.ms-excel');

	header('Content-Disposition: attachment;filename="'.$filename.'"');

	header('Cache-Control: max-age=0');

	

	$excel = 'Excel5';	

	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, $excel);

	$objWriter->save('php://output');

	}

	



	



?>