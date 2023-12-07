<?php
//error_reporting(-1);
//ini_set('display_errors', 1);
defined('BASEPATH') OR exit('No direct script access allowed');
class Auto extends CI_Controller {

 var $original_path;
 var $resized_path;	
public function __construct()
	{
		parent:: __construct();
		valid_logged_in(FALSE,'A');	
		$this->load->model('admin/campaigns_model');
		$this->load->library('csvimport');
		$this->load->library('upload');
		$this->load->helper('string');
		}
	
  
   public function candidate_data_validate_auto()
	{   
	
	       // $sp_certificate_numbers=array('SP0256125296','SP0256125297','SP0256125298');
		    $this->db->select('*');
			$this->db->from('candidate_data_validate');
			$this->db->where('validate_status', '0');
			//$this->db->where_in('sp_certificate_number',$sp_certificate_numbers);
			$this->db->limit(100);
			$this->db->order_by('candidate_id', 'ASC');
			$query = $this->db->get();
			//echo $this->db->last_query();
			$result = $query->result();
			$x=0;
			foreach ($result as $row) {
			      $candidate_id = $row->candidate_id;
				  $sp_certificate_number = $row->sp_certificate_number;
				
				   $file_name = $sp_certificate_number.'.pdf';
				  if($file_name!=''){
						 $candidate_certificate= base_url().'assets/static/pnb/'.$file_name;
					}else
					{
						$candidate_certificate='';
					}
					$fileexist = $this->check_filexists($candidate_certificate);
					if(($fileexist=='') || ($fileexist==null)){
						$certificate_status='';
					}
					else
					{	$certificate_status='Yes';
					}
			
			// echo "--------certificate_status---------------->".$certificate_status;
			 
				    $update_data =array( 
					 'validate_status' => '1',
					 'tcc_given' => $certificate_status,
				   );	
				  $this->db->where('candidate_id', $candidate_id);
				  $result = $this->db->update('candidate_data_validate', $update_data);
				echo $this->db->last_query();
				 $x++;
					
			 echo "<br><br>";
		  }
		  echo "------------------------>".$x;

    	}
		
		
   public function candidate_data_verify_update()
	{   
		    $this->posdb=$this->load->database('pos_db', TRUE); 
			$this->posdb->select('candidate_id,candidate_login_id');
			$this->posdb->from('candidates');
			$this->posdb->where('candidate_name', '');
			$this->posdb->where('batch_id', '1728');
			//$this -> db -> limit(1);
			$this->posdb->order_by('candidate_id', 'ASC');
			$query = $this->posdb->get();
			echo $this->posdb->last_query();
			$result = $query->result();
			$x=0;
			foreach ($result as $row) {
			      $candidate_id = $row->candidate_id;
				  $candidate_login_id = $row->candidate_login_id;
				 
				$this->posdb->select('*');
				$this->posdb->from('temp_candidates');
				$this->posdb->where('candidate_login_id', $candidate_login_id);
				$this->posdb->order_by('cand_id', 'ASC');
				$query = $this->posdb->get();
				 if($query->num_rows()>0){
			       $candrow = $query->row();
			
			     $update_data =array( 
					'candidate_name' => $candrow->candidate_name,
				 );	
				/* echo "<pre>";
				 print_r($update_data);
				 echo "</pre>";*/
				 $this->posdb->where('candidate_id', $candidate_id);
				 $result = $this->posdb->update('candidates', $update_data);
				 echo "<br><br>";
				 echo $this->posdb->last_query();
				 }
			 
				$x++;
					
			       echo "<br><br>";
		  }
		    echo "------------------------>".$x;

    	}
	
	
	public function candidate_course_finish_date_update()
	{   
		    $this->dw=$this->load->database('dw_db', TRUE); 
			$this->dw->select('candidates.batch_id, candidates.candidate_id,candidates.cand_id, candidates.candidate_login_id, candidates.candidate_name,candidates.course_complete,candidates.course_finish_date');
			$this->dw->join('batches', 'batches.batch_id = candidates.batch_id');
			$this->dw->join('sponsers', 'sponsers.sponser_id = batches.sponser_id');
			$this->dw->where('sponsers.sponser_id','53');
			$this->dw->where('candidates.course_complete','1');
			$this->dw->where('candidates.alert_type_status',NULL);
			$this->dw->where('batches.batch_start_date >=','2021-01-01');
			$this->dw->where('candidates.course_finish_date <=','2021-12-31 23:59:59');
			$this->dw->like('candidates.candidate_login_id','CIIN');
			$this->dw->order_by('candidate_id', 'DESC');
			$this->dw->limit(10000);
			$query = $this->dw->get('candidates');
			echo $this->dw->last_query();
			echo "<br>";
			die();
			$result = $query->result();
			$x=0;
			foreach ($result as $row) {
			      $candidate_id = $row->candidate_id;
				  $candidate_login_id = $row->candidate_login_id;
				  $course_finish_date = substr($row->course_finish_date,0,10);
				
				  $row->last_data= $this->get_last_push_details($candidate_id);
				  
				  $payload = json_decode($row->last_data->push_data);
				 /* echo "<pre>";
				  print_r($payload->data);
				  echo "</pre>";*/
				  if(isset($payload->data->trainingCompletedDate))
					{
						$trngcompdate = $payload->data->trainingCompletedDate;
						$trngdtyear =  substr($trngcompdate,0,4);
						$trngdtmonth =  substr($trngcompdate,4,2);
						$trngdtday =  substr($trngcompdate,6,8);
						$training_completed_date = $trngdtyear.'-'.$trngdtmonth.'-'.$trngdtday;
						// echo "--finish_date--->".$course_finish_date;
					}
					else
					{
						$training_completed_date='';
					}
				  	/*echo "----candidate_login_id--------->".$candidate_login_id;
				    echo "------course_finish_date--------------->".$course_finish_date;
				   echo "------trainingCompletedDate--------------->".$payload->data->trainingCompletedDate;
				   echo "<br>";*/
					
				//echo "----course_finish_date--------->".$course_finish_date;
				if($training_completed_date!='')
				{
				if($course_finish_date!=$training_completed_date)
				{
					echo "----login_id-->".$candidate_login_id;
					echo "----Normal----->".$course_finish_date;
					echo "----Auto------>".$training_completed_date;
					
					$this->dw->select('logout_time');
					$this->dw->where('candidate_id',$candidate_id);
					$this->dw->where('logout_time >=', date(''.$training_completed_date.' 00:00:00'));
					$this->dw->where('logout_time <=', date(''.$training_completed_date.' 23:59:59'));
					$this->dw->order_by('logout_time','DESC');
					$this->dw->limit(1);
					$logquery = $this->dw->get('log_session');
					$lastrow = $logquery->row();
					if($logquery->num_rows()>0){
						$coursefinishdate = date('Y-m-d H:i:s', strtotime($lastrow->logout_time)-rand(10,50));
					}else
					{
						$coursefinishdate = date('Y-m-d H:i:s', strtotime($training_completed_date)+rand(30,180));
					}
					echo "-------------------->".$coursefinishdate;
					echo "<br>";
			    $update_data =array( 
					'course_finish_date' => $coursefinishdate,
					'alert_type_status' => '8',
				 );	
				/* echo "<pre>";
				 print_r($update_data);
				 echo "</pre>";*/
				// $this->dw->where('candidate_id', $candidate_id);
				// $result = $this->dw->update('candidates', $update_data);
				 //echo "<br><br>";
				// echo $this->dw->last_query();
				 
				 $x++;
				 
				}
				}
		
					
			      // echo "<br><br>";
		  }
		  
		  /* echo "<pre>";
		   print_r($row);
		   echo "</pre>";
		    echo "------------------------>".$x;*/
			
			echo "------------------------>".$x;
			

    	}
		
		
		function get_last_push_details($candidate_id)
		{
			$this->dw=$this->load->database('dw_db', TRUE); 
			$this->dw->select('push_data,push_datetime,response_data,mode');
			$this->dw->where('candidate_id', $candidate_id);
			$this->dw->order_by('push_log_id', 'DESC');
			$this->dw->limit(1);
			$query = $this->dw->get('training_push_logs');
			$pushrow = $query->row(); 
			//echo $this->dw->last_query();
			//die();
		     $push_data = ($pushrow->push_data);
			 
			 $pushdata= json_decode($push_data);
				
				
			/*  echo "<pre>";
			  print_r($pushdata->payload);
			  echo "</pre>";*/
			//echo  "------------>".$push_data['payload'];
			$pushrow->push_data=$this->encryptdecrypt('decrypt',$pushdata->payload);
			
			return $pushrow;
			
		}
		
		

  function encryptdecrypt($action, $string)
	 {	
	  $output = false;
	  $algorithm='aes-256-ctr';
	  $sKey='A7BC2AB0DB64581220A66F74E9377553';
	  $iv='dd78ad7b4e6b034e';
	  if ( $action == 'encrypt' ) {
  	 // Encrypt
      $output = bin2hex(openssl_encrypt($string, $algorithm, $sKey, OPENSSL_RAW_DATA, $iv));
     // echo "Encrypted: ".$encrypted_data;
	  }
	  else if ( $action == 'decrypt' ) {
  	 // Decrypt
      $output = openssl_decrypt(pack('H*', $string), $algorithm, $sKey, OPENSSL_RAW_DATA, $iv);
    //echo "<br>Decrypted: ".$decrypted_data;
	  }
	  return $output;
 
	}
	
	

	
}	
?>