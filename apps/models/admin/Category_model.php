<?php

class Category_model extends CI_Model
{
	
	   // $count: just a counter, call it as 0 in your function call and forget about it
		function get_categories_list($parent_id,$is_active, $count, $lastname='') {
		static $option_results;
		$option_results[''] = '- None - ';
		$indent_flag='';
		// if there is no current navigation id set, start off at the top level (zero)
		if (!isset($parent_id)) {
			$parent_id=1;
		}
		// increment the counter by 1
		$count = $count+1;
	
		// query the database for the sub-categories of whatever the parent navigation is
		$this->db->select('categories.*,companies.company_name');
		$this->db->from('categories');
		$this->db->join('category_types', 'category_types.category_type_id = categories.category_type_id');
		$this->db->join('companies', 'companies.company_id = categories.company_id');
		if($is_active!='all')
		$this->db->where('categories.is_active', $is_active);
		$this->db->where('categories.parent_id', $parent_id);
		$this->db->order_by('companies.company_name','ASC');
		$this->db->order_by('categories.category_name','ASC');
		  $result = $this->db->get();
		//echo 	 $this->db->last_query();
		//echo "<br>";
		   $return = array();
		   if ($result->num_rows() > 0) {
			
			foreach ($result->result_array() as $rowcat) {
		
			if ($parent_id!=0) {
				$indent_flag =  $lastname . '--';
					$indent_flag .=  '>';
			}
				$rowcat['category_name'] = $indent_flag.$rowcat['category_name'];
				$option_results[$rowcat['category_id']] = $rowcat['company_name'].'-'.$rowcat['category_name'];
				// now call the function again, to recurse through the child Navigation
				$this->category_model->get_categories_list($rowcat['category_id'],$is_active, $count, $rowcat['category_name']);
			}
		}
	
    return $option_results;
}
		

	   function insert_category($GroupLists)
 	   {
		
		$insertresult=false;
		if(is_array($GroupLists))
		{
		$done=0; 	
		$already=0; 	
		foreach($GroupLists as $key=> $listrow){
			 		if($listrow['category_name']!='') 
					{	$this->db->select('category_id');
						$this->db->from('categories');
						$this->db->where('category_name',$listrow['category_name']);
						$this->db->where('category_type_id',$listrow['category_type_id']);
						$this->db->where('company_id',$listrow['company_id']);
						$this->db->where('parent_id',$listrow['parent_id']);
						$category_result = $this->db->get();
						if($category_result->num_rows() == 0)
						{  
						  $weightfields = array('category_type_id'=>$listrow['category_type_id'],'company_id'=>$listrow['company_id'],'is_active'=>'1');
					      $maxweight=get_max_values('categories','weight',$weightfields);
																		   
						  $data_type =array( 
						    'company_id'    =>  $listrow['company_id'],
						    'category_type_id'    =>  $listrow['category_type_id'],
							'category_name'    =>  $listrow['category_name'],
							'parent_id'    =>  $listrow['parent_id'],
							'weight'   =>  $maxweight,
							'created_by'   => $this->session->userdata('user_id'),
							'created_on'      => date('Y-m-d H:i:s')
						   );	
						  $insertresult= $this->db->insert('categories',$data_type);	
						  $category_id  = $this->db->insert_id();
						  $done++;
						  $update_by[] = array('uid' => $this->session->userdata('user_id'), 'dt' => date('Y-m-d H:i:s'));
						  $update_by_id = json_encode($update_by);
						  $table_name = "categories";
						  $operation = "Record added";
						  createLogFile($operation,$category_id,$update_by_id,$table_name);
				
						}else
						{	  $already++;
						}
					}
			   }
		    }
			if($insertresult)
			return 1;
			else
			return 0;	
	}
	
	
	    function view_categories($company_id)
		{	$this->db->select('categories.*,category_types.category_type_id,category_types.category_type_name,companies.company_name');
			$this->db->from('category_types');
			$this->db->join('categories', 'categories.category_type_id = category_types.category_type_id');
			$this->db->join('companies', 'companies.company_id = categories.company_id');
			if($company_id!='0')
			$this->db->where('categories.company_id', $company_id);
			$this->db->order_by('categories.category_type_id', 'ASC');
			$this->db->order_by('companies.company_name', 'ASC');
			$this->db->order_by('categories.category_name', 'ASC');
			$query = $this->db->get();
			//echo $this->db->last_query();
			$result = $query->result();
			return $result;
			
	
		} //End of View function
		
		
		
	
		 function category_edit($category_id)
		 {
			if ($category_id == '') {
				redirect(base_url() . "admin/categories/view");
			}
			$this->db->where('category_id', $category_id);
			$this->db->from('categories');
			$query = $this->db->get();
	
			return $query->row();
	
		} //End of edit function
	
	
		 function update_category($category_id)
		 {
			$data = array(
			'company_id'   => $this->input->post("company_id"),
			'parent_id'   => $this->input->post("parent_id"),
			'category_name'   => $this->input->post("category_name"),
			'weight'     => $this->input->post("weight")
			);
			$this->db->where('category_id', $category_id);
			$result = $this->db->update('categories', $data);
			if($result > 0)
   		    {	$update_by[] = array('uid' => $this->session->userdata('user_id'), 'dt' => date('Y-m-d H:i:s'));
				$update_by_id = json_encode($update_by);
				$table_name = "categories";
				$operation = "Record updated";
				createLogFile($operation,$category_id,$update_by_id,$table_name);
		    }
			if ($result)
			   return 1;
			 else
			   return 0;
			
		 } //End of Update function
		 
		 
		function update_status($category_id, $status)
		{
			 $data = array(
					'is_active' => $status,
				);
			$this->db->where('category_id', $category_id);
			$result = $this->db->update('categories', $data);
			if($result)
			  return '1';
			 else 
			 return '0';
	
		} //End of Update status function
	 
	 
	
	
}