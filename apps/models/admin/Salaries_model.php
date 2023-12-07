<?php

class Salaries_model extends CI_Model
{
	
	
	 function monthwise_consolidated() {
			
			$sql = "SELECT DATE_FORMAT( `salary_month` , GET_FORMAT( DATE, 'ISO' ) ) AS 
dt , count( * ) AS total,created_by FROM `employee_salaries` where group_id='2'  GROUP BY DATE_FORMAT( `salary_month` , GET_FORMAT( DATE, 'ISO' ) )  order by `salary_month` desc "; 
			$query = $this->db->query($sql);
			//echo $this->db->last_query();
			return $query->result();
			
		}     //End of Count function	
		
	function branchwise_consolidated($date) {
	
 	   $sql = "SELECT DATE_FORMAT( `salary_month` , GET_FORMAT( DATE, 'ISO' ) ) AS 
dt , count( * ) AS total, employee_salaries.master_id,users.name  FROM `users`,employee_salaries where employee_salaries.master_id = users.user_id and users.user_type='C' and  employee_salaries.salary_month='".$date."'   GROUP BY users.user_id  order by `users`.`name` desc"; 
			$query = $this->db->query($sql);
			//echo $this->db->last_query();
			return $query->result();
			
		}     //End of Count function		


	 function branch_employee($salary_month,$branch_id,$search_value) {
		$group_id='2';
		$this->db->select('employee_salaries.*');
		if($salary_month!='0')
		$this->db->where('salary_month >=', date(''.$salary_month.'-01'.''));
		if($salary_month!='0')
		$this->db->where('salary_month <=', date(''.$salary_month.'-01'.''));
		if($branch_id!='0')
		$this->db->where('master_id', $branch_id);
		if($search_value!='0')
		{	$this->db->group_start();
			$this->db->like('employee_code',$search_value);
			$this->db->or_like('emp_name',$search_value);
			$this->db->or_like('function',$search_value);
			$this->db->or_like('designation',$search_value);
			$this->db->or_like('income_tax_number',$search_value);
			$this->db->or_like('place',$search_value);
			$this->db->group_end();
		}else
		{	$this->db->where('group_id',$group_id);
		}
		$this->db->order_by('emp_name','ASC');
		$query = $this->db->get('employee_salaries');
	    //echo $this->db->last_query();
		return $query->result();
		
	}     //End of Count function
	
	
		
	  function insert_employee_payslip_data($data) {
		$result = $this->db->insert('employee_salaries', $data);
		//print '<pre>'; print_R($this->db->last_query());die;
		$emp_salary_id = $this->db->insert_id();
		if($emp_salary_id)
		{    return $emp_salary_id;
		}
		else
		{	 return '0';
		}
      }
	  
	  
	  
   function view_payslip($emp_salary_id)
	 {
		if ($emp_salary_id == '') {
			redirect(base_url() . "admin/salaries/monthwise");
		}
		$this->db->select('employee_salaries.*');
		$this->db->from('employee_salaries');
		$this->db->where('group_id','2');
		$this->db->where('emp_salary_id', $emp_salary_id);
		$query = $this->db->get();

		return $query->row();

	} //End of edit function
	
	function payslipinfo($emp_salary_id,$account_type_id) {
		
		$this->db->select('employee_salary_info.*,accounts_heads.account_name');
		$this->db->from('employee_salary_info');
		$this->db->join('accounts_heads', 'accounts_heads.account_id = employee_salary_info.account_id');
		$this->db->where('employee_salary_info.emp_salary_id', $emp_salary_id);
		$this->db->where('accounts_heads.account_type_id', $account_type_id);
		$this->db->order_by('accounts_heads.weight', 'ASC');
		$query = $this->db->get();
		//echo $this->db->last_query();
		$result = $query->result();
		/*echo "<pre>";
		print_r($result);
		echo "</pre>";
		*/
		return $result;
		
	}     //End of function
	
	
	function update_status($emp_salary_id, $status)
    {
		 if($status=='1')
		 {	$data = array(
				'is_active' => $status,
			);
		 }
		 else
		 {
			$data = array(
				'is_active' => $status,
			);
		 }
        $this->db->where('emp_salary_id', $emp_salary_id);
        $result = $this->db->update('employee_salaries', $data);
		if($result)
		  return '1';
		 else 
		 return '0';

    } //End of Update status function
	
	
}