<?php

class Candidates_model extends CI_Model
{


		
	 function add()
     {
		$data        = array(
		    'sponser_id'   => '53',
          	'campaign_name'     => $this->input->post("campaign_name"),
			'campaign_type'    => '1',
			'start_date'   => $this->input->post("start_date"),
			'end_date'     => $this->input->post("end_date"),
			'description'     => $this->input->post("description"),
			'created_by'     => $this->session->userdata('user_id'),
			'created_on'      => date('Y-m-d H:i:s'),
        );
        $result   = $this->db->insert('campaigns', $data);
		$campaign_id  = $this->db->insert_id();
		if($result > 0)
		{
			return $campaign_id;
		 }
		else
			return 0;


    } //End of add function
	
	
	  function candidate_edit($candidate_id)
		{
			if ($candidate_id == '') {
				redirect(base_url() . "admin/candidates/view");
			}
			$this->db->select('*');
			$this->db->from('candidates');
			$this->db->where('candidate_id', $candidate_id);
			$query = $this->db->get();
			return $query->row();
	
		} //End of edit function
	
	
		 function update_candidate($candidate_id)
		 {
			$data = array(
				'opening_balance'     => $this->input->post("opening_balance"),
			);
			$this->db->where('candidate_id', $candidate_id);
			$result = $this->db->update('candidates', $data);
			if ($result)
		    return 1;
			else
			return 0;
			
		 } //End of Update function
		 
	
	   
	
 function update_status($candidate_id, $status)
    {
		 if($status=='1')
		 {	$data = array(
				'is_active' => $status,
				'deactive_date' =>''
			);
		 }
		 else
		 {
			$data = array(
				'is_active' => $status,
				'deactive_date' => date('Y-m-d H:i:s')
			);
		 }
        $this->db->where('candidate_id', $candidate_id);
	    $result = $this->db->update('candidates', $data);
		if($result)
		  return '1';
		 else 
		 return '0';

    } //End of Update status function
	
	
			
   function view_candidates($bank_id,$employer_name,$candidate_id,$limit, $start)
    {
		$this->db->select('candidates.*,banks.bank_name');
		$this->db->join('banks', 'banks.bank_id = candidates.bank_id');
     	if($bank_id!='0')
		$this->db->where('candidates.bank_id',$bank_id);
        if($candidate_id!='0')
		$this->db->where('candidates.candidate_id',$candidate_id);
		if($employer_name!='0')
		$this->db->like('candidates.employer_name',$employer_name);
     	$this->db->group_by('candidates.candidate_id'); 
		$this->db->order_by('candidates.candidate_id','DESC');
		if($limit!=null || $start!=null)
		{
			$this->db->limit($limit,$start);
		}	
        $this->db->from('candidates');
        $query = $this->db->get();
	 //echo "--->".$this->db->last_query();
	    $result = $query->result();
        foreach ($result as $row) {
			
		$row->total_payslips= $this->countpayslips($row->candidate_id);

         $row->total_transactions= $this->counttransactions($row->candidate_id);
        }
		/*echo "<pre>";
		print_r($result);
		echo "</pre>";*/
        return $result;

    } //End of View  function
	
	
	
	
	function count_candidates($bank_id,$employer_name,$candidate_id) {
			
		$this->db->join('banks', 'banks.bank_id = candidates.bank_id');
     	if($bank_id!='0')
		$this->db->where('candidates.bank_id',$bank_id);
        if($candidate_id!='0')
		$this->db->where('candidates.candidate_id',$candidate_id);
		if($employer_name!='0')
		$this->db->like('candidates.employer_name',$employer_name);
		$this->db->group_by('candidates.candidate_id'); 
		$query=$this->db->get('candidates');		
			//echo "--------------------->". $this->db->last_query();	   
		 return $query->num_rows();
			
		}     //End of Count function
		
	
	function countpayslips($candidate_id)
		{
			$this->db->where('candidate_id', $candidate_id);
			$this->db->from('candidate_payslips');
			$query = $this->db->get();
			return $query->num_rows();
	
		} //End of Count function

    function counttransactions($candidate_id)
		{
			$this->db->where('candidate_id', $candidate_id);
			$this->db->from('bank_transactions');
			$query = $this->db->get();
			return $query->num_rows();
	
		} //End of Count function
    
    
	 function insert_candidate_data($data) {
        $result = $this->db->insert('candidates', $data);
		$candidate_id = $this->db->insert_id();
        // echo "--------------------->". $this->db->last_query();	
         
        /* echo "<br>";
         echo '<pre>';    
         print_r($data);  
         echo '</pre>';*/
         
		if($candidate_id)
		{    return $candidate_id;
		     exit();
		}
		else
		{	 return '0';
			 exit();
		}
		
      }
	  
	
	 
	function update_photo($candidate_id,$file_name)
    {
        $data = array(
			'candidate_photo'   => $file_name,
        );
        $this->db->where('candidate_id', $candidate_id);
	    $result = $this->db->update('candidates', $data);
		if($result)
		{
		  return 1;
		}
        
    } //End of Update User function


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

	
	

	
}