<?php
//error_reporting(-1);
//ini_set('display_errors', 1);
defined('BASEPATH') OR exit('No direct script access allowed');
class Payslips extends CI_Controller {


public function __construct()
	{
		parent:: __construct();
		valid_logged_in(FALSE,'A');	
		$this->load->model('admin/payslips_model');
		$this->load->library('csvimport');
		$this->load->library('upload');
		$this->load->helper('string');
		}
	
	
	
	public function view(){	
	
	    $data['title'] = title." | View Payslips Transactions";
		$data['main_heading'] = " Payslips Transactions";	
		$data['heading'] = "View Payslips  Transactions";	
		
	   //print_r($_POST);	
	    if($this->input->post('candidate_id'))
			 $candidate_id = $this->input->post('candidate_id');
		 elseif($this->uri->segment('4'))
			 $candidate_id=$this->uri->segment('4');
		else
			 $candidate_id='0';
	
		if($this->input->post('per_page'))
			$per_page = $this->input->post('per_page');
		elseif($this->uri->segment('5'))
			$per_page=$this->uri->segment('5');
		else
			$per_page=per_page;	
			
		$config = array();
		$config["base_url"] = base_url() . "admin/payslips/view/".$candidate_id."/".$per_page;
		$config["per_page"] = $per_page;
        $config["uri_segment"] = 6;
		$config["total_rows"] =$this->payslips_model->count_payslips($candidate_id);
		$this->pagination->initialize($config);
        $page = ($this->uri->segment(6)) ? $this->uri->segment(6) : 0; 
		$data['results'] = $this->payslips_model->view_payslips($candidate_id,$config['per_page'], $page);
		$data['links']   = $this->pagination->create_links();
		$data['num_rows'] = $config['total_rows'];	
		
		$data['candidate_id'] = $candidate_id;
		$data['per_page'] = $per_page;
		  	  
	    $this->load->view('admin/payslips/view.php', $data);
		}


      public function delete($payslip_id,$candidate_id)
	 {
		 // Update status  
	     $result = $this->payslips_model->delete_transaction($payslip_id,$candidate_id);
		 if($result=='1')
		 {
		   $this->session->set_flashdata('success_message', 'Pay Slip Transaction has been deleted successfully.');
           redirect(base_url() . "admin/payslips/view/".$candidate_id);
		 }
		 else
		 {
			  $this->session->set_flashdata('warning_message', 'Pay Slip Transaction not deleted. Please try again');
              redirect(base_url() . "admin/payslips/view/".$candidate_id);
		 }
		 
	}//end of Status  functionality*/
    
      public function print_payslip($candidate_id=NULL)
	  {	 
           
	    $data['title'] = title." | Print Payslip";
		$data['main_heading'] = "Print Payslip";	
		$data['heading'] = "Print Payslip";	
	    
	
       if($this->input->post('payslip_id'))
			 $payslip_id = $this->input->post('payslip_id');
        elseif($this->uri->segment('4'))
			 $payslip_id=$this->uri->segment('4');
		else
			 $payslip_id='0';
      		 
		 if($this->input->post('candidate_id'))
			 $candidate_id = $this->input->post('candidate_id');
		 elseif($this->uri->segment('5'))
			 $candidate_id=$this->uri->segment('5');
		 else
			 $candidate_id='0';
			 
		/*	 
		 echo "--------------->".$payslip_id;
 		 echo "--------------->".$candidate_id;	 
		 die();*/
			 	 
	     $candrow = $this->payslips_model->get_candidate_details($candidate_id);
		 
		 $paysliprow = $this->payslips_model->get_candidate_payslip($payslip_id,$candidate_id);
     
		// $results = $this->payslips_model->get_payslip_details($payslip_id,$candidate_id);
         
           
	    /*  echo "<pre>";
		  print_r($paysliprow);
		  echo "</pre>";*/
		 //die();
		    
		
		 
		 $data['candrow'] = $candrow;	
		 $data['paysliprow'] = $paysliprow;	
		 $data['results'] = $results;
            
         $data['payslip_id'] = $payslip_id;
		 $data['candidate_id'] = $candidate_id;
          
         /* echo "<pre>";
          print_r($data);
           echo "</pre>";
          die();*/
         if($candrow->company_id=='1')
		 $this->load->view('admin/payslips/yesbank_statement.php', $data);	
		 elseif($candrow->company_id=='2')
		 $this->load->view('admin/payslips/kotak_bank_statement.php', $data);
         elseif($candrow->company_id=='3')
		 $this->load->view('admin/payslips/union_bank_statement.php', $data);  
         elseif($candrow->company_id=='4')
		 $this->load->view('admin/payslips/scm_payslip.php', $data);  
         elseif($candrow->company_id=='5')
		 $this->load->view('admin/payslips/icici_bank_statement.php', $data);    
		 else
		 $this->load->view('admin/payslips/yesbank_statement.php', $data);	     
              
		 
	 }//end of Status  functionality*/
	
	
	 /*=========== Bulk Generate Pay Slips  =========*/
	public function generate() {
		  
	   $data['title'] = title." | Upload Pay Slips";
	   $data['main_heading'] = "Upload Pay Slips";
	   $data['heading'] = "Upload Pay Slips";
	   $data['already_msg']="";
	   $data['error']="";
	   $data['err']="";
	
		//print_r($_FILES); 
		$this->form_validation->set_rules('company_id', 'Company', 'trim|required');
		$this->form_validation->set_rules('from_period', 'From Period', 'trim|required');
		$this->form_validation->set_rules('to_period', 'To Period', 'trim|required');
		$this->form_validation->set_rules('userfile', 'CSV File', 'trim');
		
		if ($this->form_validation->run()) {
			$data['error'] = '';   
			if($_FILES['userfile']['error'] != 4){		
			  if(isset($_FILES["userfile"]["name"]) && ($_FILES["userfile"]["name"]!=''))
			{	$path_info = pathinfo($_FILES["userfile"]["name"]);
			$fileExtension = $path_info['extension'];
			$file_name = time().'.'.$fileExtension ;   
			}
			
			  $this->sdata_path = realpath('assets/static/sdata');
			  $config['upload_path'] = $this->sdata_path;
			  $config['allowed_types'] = '*';
			  $config['max_size']	= '5072';
			  $config['max_width']  = '0';
			  $config['max_height']  = '0';
			  $config['overwrite'] = true;			
			  $config['file_name'] =$file_name;
			  $this->upload->initialize($config);
			  if ( ! $this->upload->do_upload('userfile')){
					$data['error']=$this->upload->display_errors();
					$success = FALSE;
			 }
			 else{
				$data = $this->upload->data('userfile');	
				/*========== File Upload Script ===========*/
				$file_path =  $this->sdata_path.'/'.$file_name;
				
				if ($this->csvimport->get_array($file_path)) {
                $csv_array = $this->csvimport->get_array($file_path);
				$count_csv_column = count($csv_array[0]);
				$x=0;
				$done=0;
				$already=0;
				$already_payslip_candidate_id='';
				$err='';
				
				/*echo "<pre>";
				print_r($csv_array);
				echo "</pre>";
				die();*/
				
                foreach ($csv_array as  $row) {
					
				//	echo "---------------------->".$row;
					//echo "<br>";
					$x++;
					if(isset($row['sr_no']))
					{
						if($row['sr_no']=='')
						$err .='Row No ' .$x.' Sr no. column is required.<br>';
					}
                    if(isset($row['candidate_id']))
					{
						
					}
					else
					{	$err ='Invalid Candidate Id. Column.<br>';
					}
					if(isset($row['working_days']))
					{	
						$working_days=special_char_remove($row['working_days']);
						if($working_days!='')
						{
						if(!is_numeric(ltrim($working_days)))
						$err .='Row No ' .$x.' invalid Working Days'.ltrim($working_days).'<br>';
						}
					}
					else
					{	$err ='Invalid Working Days Column.<br>';
					}
					if(isset($row['ot_mins']))
					{	
						$ot_mins=special_char_remove($row['ot_mins']);
						if($ot_mins!='')
						{
						if(!is_numeric(ltrim($ot_mins)))
						$err .='Row No ' .$x.' invalid Contact No.'.ltrim($ot_mins).'<br>';
						}
					}
					else
					{	$err ='Invalid OT Mins. Column.<br>';
					}
				
			}
		
			// echo "---------------------->Yes";
			 	/*   echo "<pre>";
				   print_r($csv_array);
				   echo "</pre>";*/
					//die();
			
			$company_id = $this->input->post('company_id');
			$from_period = $this->input->post('from_period');
			$to_period = $this->input->post('to_period');
				
			$this->db->select('ctc,mess,ot_rate');
			$this->db->from('companies');
			$this->db->where('is_active','1');
			$this->db->where('company_id',$company_id);
			$this->db->order_by('company_id', 'ASC');
			$resultcomp = $this->db->get();
			 //echo "--------------------->". $this->db->last_query();	
			// die();
			if ($resultcomp->num_rows() > 0) {
				$comprow =  $resultcomp->row();
				$comp_ctc = $comprow->ctc;
				$comp_mess = $comprow->mess;
				$comp_ot_rate = $comprow->ot_rate;
						
					
			  foreach ($csv_array as  $row) {
			   	if($err=='')
					{
						$candidate_id= trim($row['candidate_id']);
						
						
						$this->db->select('candidate_id,ctc');
						$this->db->from('candidates');
						$this->db->where('is_active','1');
						$this->db->where('candidateid',$candidate_id);
						$this->db->order_by('candidate_id', 'ASC');
						$resultcand= $this->db->get();
						if ($resultcand->num_rows() > 0) {
						 $rowcand =  $resultcand->row();
						 $cand_id = $rowcand->candidate_id;
						 
						$this->db->select('payslip_id');
						$this->db->from('candidate_payslips');
						$this->db->where('is_active','1');
						$this->db->where('candidate_id',$cand_id);
						$this->db->order_by('payslip_id', 'ASC');
						$resultpayslcand= $this->db->get();
						if ($resultpayslcand->num_rows() > 0) {
							
						   $candidate_ctc = $comp_ctc;
						}
						else
						{
							$candidate_ctc = $rowcand->ctc;
						}
						  
				        $working_days= trim($row['working_days']);
						$ot_mins= trim($row['ot_mins']);
						
						if(trim($cand_id!=''))
						{
						$this->db->select('payslip_id');
						$this->db->from('candidate_payslips');
						$this->db->where('candidate_id', $cand_id);
						$this->db->where('from_period', $from_period);
						$this->db->order_by('payslip_id','ASC');
						$payslip_query = $this->db->get();
						$payslip_result = $payslip_query->result();
						//echo "--------------------->". $this->db->last_query();	
						// die();
						$payslip_num_rows =  $payslip_query->num_rows();
						}
						else
						{	$payslip_num_rows='0';
						}
						
						}
		
						if($payslip_num_rows==0)
						{
					    $insert_data = array(
							'candidate_id'=>$cand_id,
							'from_period'=>$from_period,
							'to_period'=>$to_period,
							'candidate_ctc'=>$candidate_ctc,
							'working_days'=>$working_days,
							'mess'=>$comp_mess,
							'ot_mins'=>$ot_mins,
							'ot_rate'=>$comp_ot_rate,
                     		'created_by'     => $this->session->userdata('user_id'),
							'created_on'      => date('Y-m-d H:i:s')
						 );
						$payslip_id = $this->payslips_model->insert_payslip_data($insert_data);
                       /* echo '<pre>';    
                        print_r($insert_data);  
                        echo '</pre>';
						die();*/
						$this->db->select('category_id,category_name,category_type_id,parent_id,weight');
						$this->db->from('categories');
						$this->db->where('company_id',$company_id);
						$this->db->where('is_active','1');
						$this->db->order_by('weight', 'ASC');
						$querycat = $this->db->get();
						//echo $this->db->last_query();
						//die();
						//echo "<br><br>";
						$resultcat = $querycat->result();
						foreach ($resultcat as $rowcat) {
					 
					      $inserttrans_data = array(
							'payslip_id'=>$payslip_id,
							'category_id'=>$rowcat->category_id,
							'head_amount'=>'0',
                     		'short'      => $rowcat->weight,
						 );
						 /* echo "<pre>";
						 print_r($inserttrans_data);
						  echo "</pre>";
						  echo "<br><br>";*/
						$slip_transaction_id = $this->payslips_model->insert_payslip_transactions_data($inserttrans_data);
						}
						if($slip_transaction_id)
						{
						  $done++;	
				         }
						}
						else
						{
							$already++;
							$already_exists_data=trim($row['candidate_id']);
							$already_payslip_candidate_id .= $already_exists_data.', ';
						}
					 }
					}	
					
					}
					$data['err']=$err;
					
			
               if($err=='')
			   {  
			       $msg1='';
				   $msg2='';
				   $already_payslip_candidate_id = substr($already_payslip_candidate_id,0,-1);
				   if($done>0)
			   		$msg1=  "Total (".$done.") Payslips is generated succesfully.<br>";
				   if($already>0)
			   		$msg2=  " (".$already.") payslips already exists in database.<br>(".$already_payslip_candidate_id.")";
					
					if($msg1!='')
				    $this->session->set_flashdata('success_message', $msg1);
					
					if($msg2!='')
				    $this->session->set_flashdata('warning_message', $msg2);
					
				  //redirect(base_url().'admin/candidates/upload_bulk_candidates');
			   }
			   
               
            } else 
                $data['error'] = "Error occured";
                
            }
				/*========== File Upload Script end ===========*/
				
			 }
		}
		  //print '<pre>'; print_r($data); die;
		  
		
		if($this->uri->segment('4'))
			 $bank_id=$this->uri->segment('4');
		else
			 $bank_id='0';
			  
		$data['bank_id']=$bank_id;  
		$this->load->view('admin/payslips/generate_payslips', $data);
	}
    

	public function payslip_generate_sample_file_download() {
		$data = file_get_contents("./pay_slip_transaction_sample_file.csv"); 
		force_download(trim('pay_slip_transaction_sample_file.csv'), $data, trim('Pay Slips Transaction(s) Sample File'));  
	   
   }//end of file Download functionality

    
}	
?>