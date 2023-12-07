<?php
class Ajaxrequestmodel extends CI_Model
{
		  /*=========== Get states ===========*/
		 function get_states($country_id){ 
				$this->db->where('country_id',$country_id);
				$this->db->where('is_active','1');
				$query = $this->db->get('state');	  	
				$result=$query->result(); 
				//echo $this->db->last_query();die;	
				return json_encode($result);
		 }
		 
		 /*=========== Get city list ===========*/
		 function get_cities($state_id){ 
				$this->db->where('state_id',$state_id);
				$this->db->where('is_active','1');
				$query = $this->db->get('city');	  	
				$result=$query->result(); 
				//echo $this->db->last_query();die;	
				return json_encode($result);
		 }
    
         /*=========== Get city list ===========*/
		 function get_payment_mode($payment_status){ 
                 $this->db->select('list_id,option_id,title');
  				$this->db->where('list_id',$payment_status);
				$this->db->where('is_active','1');
				$query = $this->db->get('list_options');	
                $this->db->order_by('seq','ASC');
				$result=$query->result(); 
				//echo $this->db->last_query();die;	
				return json_encode($result);
		 }
		 /*=========== Get Role list ===========*/
		 function get_roles($functional_id){ 
				$this->db->where('functional_id',$functional_id);
				$this->db->order_by('role_name','ASC');
				$query = $this->db->get('role_area');	  	
				$result=$query->result(); 
				//echo $this->db->last_query();die;	
				return json_encode($result);
		 }
		 
		  /*=========== Get Specializations list ===========*/
		 function get_specializations($qualification_id){ 
				$this->db->where('qualification_id',$qualification_id);
				$this->db->order_by('specialization_name','ASC');
				$query = $this->db->get('specialization');	  	
				$result=$query->result(); 
				//echo $this->db->last_query();die;	
				return json_encode($result);
		 }
		 
		 
		  /*=========== Get Modules list ===========*/
		 function get_modules($user_type){ 
				$this->db->where('user_type',$user_type);
				$this->db->where('is_active','1');
				$this->db->where('is_parent','0');
				$this->db->order_by('set_order','ASC');
				$query = $this->db->get('navigation_menus');	  	
				$result=$query->result(); 
				//echo $this->db->last_query();die;	
				return json_encode($result);
		 }
		 
		   /*=========== Get Country Code list ===========*/
		 function get_countrycode($country_id){ 
				$this->db->where('country_id',$country_id);
				$this->db->where('is_active','1');
				$this->db->order_by('country_code','ASC');
				$query = $this->db->get('country');	  	
				$result=$query->result(); 
				//echo $this->db->last_query();die;	
				return json_encode($result);
		 }
		  /*=========== Get templates ===========*/
		 function get_template($email_type){ 
		       $this->db->select('*');
				$this->db->where('email_type',$email_type);
				$this->db->where('company_id',$this->session->userdata('master_id'));
				$this->db->where('is_active','1');
				$query = $this->db->get('email_templates');	  	
				$result=$query->result(); 
				//echo $this->db->last_query();
				return json_encode($result);
		 }
		 
		 function get_sms_template($sms_template_id){ 
		       $this->db->select('*');
				$this->db->where('sms_template_id',$sms_template_id);
				$this->db->where('company_id',$this->session->userdata('master_id'));
				$this->db->where('is_active','1');
				$query = $this->db->get('sms_templates');	  	
				$result=$query->result(); 
				//echo $this->db->last_query();
				return json_encode($result);
		 }
		
		/*=========== Get Course list ===========*/
		 function get_courses($stream_id){ 
			$this->db->select('options_categories.option_category_id,options_groups.option_group_name,options_categories.option_category_name');
			$this->db->where('options_categories.company_id',$this->session->userdata('master_id'));
			$this->db->where('options_groups.option_group_name','Courses');
			$this->db->join('options_groups', 'options_groups.option_group_id = options_categories.option_group_id');
			if($stream_id!='0')
			$this->db->where('options_categories.parent_id',$stream_id);
			$this->db->group_by('options_categories.option_category_id'); 
			$this->db->order_by('options_categories.weight');
			$this->db->from('options_categories');
			$query = $this->db->get();
			$result = $query->result();
			//echo $this->db->last_query();die;	
			
			return json_encode($result);
		 }
		 
		  
		public function weight_updated($data,$form_id){
			$i=0;
			foreach($data as $field_id){
				$data1=array('weight'=>$i);
				$this->db->where('form_id',$form_id);
				$this->db->where('form_field_sel_id',$field_id);
				$this->db->update('form_field_selection',$data1);
				$i++;
			}
			return true; 
		}
}