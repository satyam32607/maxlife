<?php

class Payslips_model extends CI_Model
{

	
   function view_payslips($candidate_id,$limit, $start)
    {
		$this->db->select('candidate_payslips.*,candidates.candidateid,candidates.batch_id,candidates.company_id,candidates.acc_holder_name,candidates.father_name,candidates.father_name,candidates.employee_number');
		$this->db->join('candidates', 'candidates.candidate_id = candidate_payslips.candidate_id');
     	if($candidate_id!='0')
		$this->db->where('candidate_payslips.candidate_id',$candidate_id);
    	$this->db->order_by('candidate_payslips.from_period','ASC');
		if($limit!=null || $start!=null)
		{
			$this->db->limit($limit,$start);
		}	
        $this->db->from('candidate_payslips');
        $query = $this->db->get();
	   //echo "--->".$this->db->last_query();
	    $result = $query->result();
      	/*echo "<pre>";
		print_r($result);
		echo "</pre>";*/
        return $result;

    } //End of View  function
	
	
	 function count_payslips($candidate_id) {
			
		$this->db->join('candidates', 'candidates.candidate_id = candidate_payslips.candidate_id');
     	if($candidate_id!='0')
		$this->db->where('candidate_payslips.candidate_id',$candidate_id);
    	$query=$this->db->get('candidate_payslips');		
		//echo "--------------------->". $this->db->last_query();	   
		 return $query->num_rows();
			
		}  
	
    
	 function insert_payslip_data($data) {
        $result = $this->db->insert('candidate_payslips', $data);
		$payslip_id = $this->db->insert_id();
        // echo "--------------------->". $this->db->last_query();	
         
        /* echo "<br>";
         echo '<pre>';    
         print_r($data);  
         echo '</pre>';*/
         
		if($payslip_id)
		{    return $payslip_id;
		     exit();
		}
		else
		{	 return '0';
			 exit();
		}
		
      }
	  
	   
	 function insert_payslip_transactions_data($data) {
        $result = $this->db->insert('payslip_transactions', $data);
		$slip_transaction_id = $this->db->insert_id();
        // echo "--------------------->". $this->db->last_query();	
         
        /* echo "<br>";
         echo '<pre>';    
         print_r($data);  
         echo '</pre>';*/
   		if($slip_transaction_id)
		{    return $slip_transaction_id;
		     exit();
		}
		else
		{	 return '0';
			 exit();
		}
		
      }
	  

	function get_employers_name()
	{
		$this->db->select('employer_name,employer_bank_name');
		$this->db->from('candidates');
		$this->db->where_in('is_active','1');
		$this->db->group_by('employer_name');
		$this->db->order_by('employer_name', 'ASC');
		$result = $this->db->get();
		$options = array();
		if ($result->num_rows() > 0) {
			$options[''] = 'Select Employer';
			foreach ($result->result_array() as $row) {
				$options[$row['employer_name']] = $row['employer_name'];
			}
		}
		//print_r($options);
		return $options;
	}
	
			
	 function get_candidate_details($candidate_id)
		{
			$this->db->select('*');
			$this->db->from('candidates');
			$this->db->where('candidate_id',$candidate_id);
			$query = $this->db->get();
			//echo "--->".$this->db->last_query();
			return $query->row();
	
		} //End of edit function
		
	
	 function get_candidate_payslip($payslip_id,$candidate_id)
		{
			$this->db->select('*');
			$this->db->from('candidate_payslips');
			$this->db->where('payslip_id',$payslip_id);
			$this->db->where('candidate_id',$candidate_id);
			$query = $this->db->get();
			//echo "--->".$this->db->last_query();
			return $query->row();
	
		} //End of edit function	
		
		
    function get_payslip_details($payslip_id,$candidate_id,$category_id)
		{
			$this->db->select('*');
			$this->db->join('categories','categories.category_id = payslip_transactions.category_id');
			$this->db->join('candidate_payslips','candidate_payslips.payslip_id = payslip_transactions.payslip_id');
			$this->db->where('candidate_payslips.candidate_id',$candidate_id);
			$this->db->where('payslip_transactions.payslip_id',$payslip_id);
			$this->db->where('categories.parent_id',$category_id);
			$this->db->group_by('payslip_transactions.slip_transaction_id');
			$this->db->order_by('payslip_transactions.short','ASC');
			$this->db->from('payslip_transactions');
			$query = $this->db->get();
		  
			$result = $query->result();
			// echo "--->".$this->db->last_query();
			/*echo "<pre>";
			print_r($result);
			echo "</pre>";*/
			return $result;
	
		} //End of edit function
				
	
    function delete_transaction($payslip_id,$candidate_id){
	   // Check first bank payslip id exists or not if not than no delete 	   
	   $this->db->where('payslip_id',$payslip_id); 
	   $query = $this->db->get('candidate_payslips');
	   if($query->num_rows() > 0 ){
		  $row_trans = $query->row();
		  
		   $this->db->where('payslip_id',$payslip_id); 
           $this->db->where('candidate_id',$candidate_id); 
		   $result = $this->db->delete('candidate_payslips');
		   
		   $this->db->where('payslip_id',$payslip_id); 
           $transresult = $this->db->delete('payslip_transactions');
		   if($result)
			{
			  return '1';
			  exit();
			}
	   }
	   else{
		    return '0';
	        exit();
	   }
	}
    

		

	
}