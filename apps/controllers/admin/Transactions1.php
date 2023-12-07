<?php
//error_reporting(-1);
//ini_set('display_errors', 1);
defined('BASEPATH') OR exit('No direct script access allowed');
class Transactions extends CI_Controller {


public function __construct()
	{
		parent:: __construct();
		valid_logged_in(FALSE,'A');	
		$this->load->model('admin/transactions_model');
		$this->load->library('csvimport');
		$this->load->library('upload');
		$this->load->helper('string');
		}
	
    
	public function add()
	{
        
       // $transaction_date='2022-03-02 26:50:56';
       // echo "----------->".$transaction_date_time =   date('H:i',strtotime($transaction_date));
        
       /* $transaction_date='2022-12-06 13:45:28';
        
        echo "------1----------->".$transaction_date;
        echo "<br>";
        
        $rand_sec = rand(0,4);
        $transaction_date1=date("Y-m-d H:i:s",strtotime("+".$rand_sec." seconds",strtotime($transaction_date))); 
        echo "-------2------------->".$transaction_date1;*/
        
      //echo "--------------->". $transaction_id= 'RF'.random_string('alnum', 10);
        
       // echo "---bank_atm_id-------->".$bank_atm_id = rand(1,4);
        
     /*       $acc_opening_date_valid='0';
        
            $accopeningdate='2022-11-17';
            $acc_opening_date = $accopeningdate. '00:00:01';
            $transaction_date='2022-12-08 11:12:45';
        
          // if(strtotime($acc_opening_date) > strtotime($transaction_date))
         if($acc_opening_date > $transaction_date)
            {
              $acc_opening_date_valid='1';
               
            // $data['already_msg']='Transaction date is always greater than Account Opening Date.';   
            }
         echo '----------->'.$acc_opening_date_valid;
          die();*/
		  $data['title'] = title." | Add Transaction";
		  $data['main_heading'] = "Transactions";
		  $data['heading'] = "Add Transaction";
		  $data['already_msg']="";
          $acc_opening_date_valid ='0';
        
           
         if($this->input->post('candidate_id'))
			 $candidate_id = $this->input->post('candidate_id');
		 elseif($this->uri->segment('4'))
			 $candidate_id=$this->uri->segment('4');
		 else
			 $candidate_id='0';
        
		  
		  $this->form_validation->set_rules('candidate_id', 'Candidate', 'required|trim');
          $this->form_validation->set_rules('payment_amount', 'Payment amount', 'required|trim');
		  $this->form_validation->set_rules('payment_status', 'Payment status', 'required|trim');
		  $this->form_validation->set_rules('transaction_date', 'Transaction Date', 'required|trim');
          $this->form_validation->set_rules('payment_mode', 'Payment Mode', 'required|trim');
		 // $this->form_validation->set_rules('description', 'Description', 'trim');
        
      
		if ($this->form_validation->run()) {
		 	
        /*   $candrow=get_table_info('candidates','candidate_id',$this->input->post("candidate_id"));
           $accopeningdate = $candrow->acc_opening_date;
           $acc_opening_date = $accopeningdate. '00:00:01';
          if(strtotime($acc_opening_date) > strtotime($this->input->post("transaction_date")))
            {
             $acc_opening_date_valid='1';
            }*/
            
            $this->db->select('*');
			$this->db->from('bank_transactions');
			$this->db->where('candidate_id', $this->input->post("candidate_id"));
            $this->db->where('payment_status', $this->input->post("payment_status"));
            $this->db->where('payment_amount', $this->input->post("payment_amount"));
            $this->db->where("DATE_FORMAT(transaction_date,'%Y-%m-%d')",substr($this->input->post("transaction_date"),0,10));
         	$query = $this->db->get();
          // echo "--->".$this->db->last_query();
           // die();
            if($query->num_rows() > 0 ){
		        $error_msg='This Transaction is already exists.';
              }
              else{
                
			      $bank_transaction_id =  $this->transactions_model->add();	
                  if($bank_transaction_id=='0')
                  {
                   $msg = "There is some error in Save Transaction Record.";
                   $this->session->set_flashdata('warning_message', $msg);	
                  }
                  else  
                  {
                     $msg = "Transaction has been added successfully.";	
                     $this->session->set_flashdata('success_message', $msg);	
                  }
           }
            redirect(base_url() . "admin/transactions/add/".$candidate_id);		
    			
	    } //end of add  functionality
        
          // echo '--------------->'.$acc_opening_date_valid;
          // echo '--------------->'. $data['already_msg'];
        $data['candidate_id'] = $candidate_id;   
        $data['already_msg'] = $error_msg;    
	   $this->load->view('admin/transactions/add.php', $data);
	}
	

	
	
	 public function edit($campaign_id){
		
	
		  $data['title'] = title." | Edit Campaign";
		  $data['main_heading'] = "Campaigns";
		  $data['heading'] = "Edit Campaign";
          $data['already_msg']="";
			 
		  $this->form_validation->set_rules('campaign_name', 'Campaign name', 'required|trim');
		  $this->form_validation->set_rules('start_date', 'Start date', 'required|trim');
		  $this->form_validation->set_rules('end_date', 'End Date', 'required|trim');
		  $this->form_validation->set_rules('description', 'Description', 'trim');
		
		if ($this->form_validation->run()) {
		  // Update records 
		  $feilds = array('campaign_name' =>trim($this->input->post('campaign_name')),'sponser_id' =>'53');
		  $unique_id = array('campaign_id' =>$campaign_id);
		  $result = check_unique_edit('campaigns',$feilds,$unique_id);
		  if($result==1)
		  { $data['already_msg']=''.$this->input->post('campaign_name').' already exists, Please try another.';
		  }
		 else
		  {  
		      $result =  $this->transactions_model->update_campaign($this->input->post('campaign_id'));
		      if($result=='1')
			   $msg = "Campaign record has been updated successfully.";
			  else
			   $msg="There is some error in update record."; 
			   
		      $this->session->set_flashdata('success_message', $msg);
		      redirect(base_url() . "admin/campaigns/view/".$this->input->post('campaign_id'));								
			  }
		}
		  
		  $result =  $this->transactions_model->campaign_edit($campaign_id);
		  $data['edit_data'] = $result;
		 
		  $this->load->view('admin/transactions/edit.php', $data);
		 
	}//end of Edit functionality*/
	
	public function status($candidate_id,$status)
	{	 // Update status  
		 $result = $this->transactions_model->update_status($candidate_id,$status);
		 if($result=='1')
		 {
		   $this->session->set_flashdata('success_message', 'Status has been updated successfully.');
		 }
		 else
		 {
			 $this->session->set_flashdata('warning_message', 'There is some error in status updation.');
		 }
		  redirect(base_url() . "admin/transactions/view");		
		 
	}//end of Status  functionality*/
	
	
	
	public function view(){	
	
	    $data['title'] = title." | View Transactions";
		$data['main_heading'] = "Transactions";	
		$data['heading'] = "View Transactions";	
		
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
		$config["base_url"] = base_url() . "admin/transactions/view/".$candidate_id."/".$per_page;
		$config["per_page"] = $per_page;
        $config["uri_segment"] = 6;
		$config["total_rows"] =$this->transactions_model->count_transactions($candidate_id);
		$this->pagination->initialize($config);
        $page = ($this->uri->segment(6)) ? $this->uri->segment(6) : 0; 
		$data['results'] = $this->transactions_model->view_transactions($candidate_id,$config['per_page'], $page);
		$data['links']   = $this->pagination->create_links();
		$data['num_rows'] = $config['total_rows'];	
		
		$data['candidate_id'] = $candidate_id;
		$data['per_page'] = $per_page;
		  	  
	    $this->load->view('admin/transactions/view.php', $data);
		}


      public function delete($bank_transaction_id,$candidate_id)
	 {
		 // Update status  
	     $result = $this->transactions_model->delete_transaction($bank_transaction_id,$candidate_id);
		 if($result=='1')
		 {
		   $this->session->set_flashdata('success_message', 'Transaction has been deleted successfully.');
           redirect(base_url() . "admin/transactions/view/".$candidate_id);
		 }
		 else
		 {
			  $this->session->set_flashdata('warning_message', 'Transaction not deleted. Please try again');
              redirect(base_url() . "admin/transactions/view/".$candidate_id);
		 }
		 
	}//end of Status  functionality*/
    
      public function statement($candidate_id=NULL)
	  {	 
           
	    $data['title'] = title." | Bank Statement";
		$data['main_heading'] = "Bank Statement";	
		$data['heading'] = "Bank Statement";	
		
        
         // $postdata = $this->input->post();
         // print_r($postdata);
        if($this->input->post('fs')=='1')
        {
         if($this->input->post('cand_id'))
			 $candidate_id = $this->input->post('cand_id');
         elseif($this->uri->segment('4'))
			 $candidate_id=$this->uri->segment('4');
		 else
			 $candidate_id='0';
            
        }
        else
        {
            
        if($this->input->post('candidate_id'))
			 $candidate_id = $this->input->post('candidate_id');
        elseif($this->uri->segment('4'))
			 $candidate_id=$this->uri->segment('4');
		else
			 $candidate_id='0';
        }
	  
			 
		 if($this->input->post('start_date'))
			 $start_date = $this->input->post('start_date');
		 elseif($this->uri->segment('5'))
			 $start_date=$this->uri->segment('5');
		 else
			 $start_date='2022-01-01';
			 
		 if($this->input->post('end_date'))
			 $end_date = $this->input->post('end_date');
		 elseif($this->uri->segment('6'))
			 $end_date=$this->uri->segment('6');
		 else
			 $end_date=date('Y-m-d');	 
			 	 
	     $candrow = $this->transactions_model->get_candidate_details($candidate_id);
         $bank_id = $candrow->bank_id;  
	
	
		 $results = $this->transactions_model->get_statement($candidate_id,$start_date,$end_date);
          
         $bankrow=get_table_info('banks','bank_id',$candrow->bank_id);
         $json_data = json_decode($bankrow->json_data);
         $firstpagelimit =$json_data->firstpagelimit;
         $secondpagelimit =$json_data->secondpagelimit;
          
         $firstresults = $this->transactions_model->get_statement_withlimit($candidate_id,$start_date,$end_date,'0',$firstpagelimit);
         $pendingresults = $this->transactions_model->get_statement_withlimit($candidate_id,$start_date,$end_date,$firstpagelimit,$secondpagelimit); 
          
          
        /*      
		 echo "<br>";
		 print_r($firstresults);
		 echo "</br>";
		 */
		 $data['candrow'] = $candrow;	
		 $data['results'] = $results;
          
         $data['firstresults'] = $firstresults;
         $data['pendingresults'] = $pendingresults;
          
         $data['start_date'] = $start_date;
         $data['end_date'] = $end_date;
          
         /* echo "<pre>";
          print_r($data);
           echo "</pre>";
          die();*/
         if($candrow->bank_id=='1')
		 $this->load->view('admin/transactions/yesbank_statement.php', $data);	
		 elseif($candrow->bank_id=='2')
		 $this->load->view('admin/transactions/kotak_bank_statement.php', $data);
         elseif($candrow->bank_id=='3')
		 $this->load->view('admin/transactions/union_bank_statement.php', $data);  
		 else
		 $this->load->view('admin/transactions/yesbank_statement.php', $data);	     
              
		 
	 }//end of Status  functionality*/
	

    
}	
?>