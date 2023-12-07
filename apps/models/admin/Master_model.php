<?php

class Master_model extends CI_Model
{
	
	function insert_country()
	{
		$data  = array(
			'country_name'    => $this->input->post("country_name")
		);
		$result   = $this->db->insert('country', $data);
		$country_id = $this->db->insert_id();
		if($country_id > 0)
		{
			$update_by[] = array('uid' => $this->session->userdata('user_id'), 'dt' => date('Y-m-d H:i:s'));
			$update_by_id = json_encode($update_by);
			$table_name = "country";
			$operation = "Record added";
			createLogFile($operation,$country_id,$update_by_id,$table_name);
		}
		if ($result) {
		   return 1;
		   exit();
		 }
		 else
		 {
		   return 0;
		   exit();
		 }

	} //End of add function

	function country_edit($country_id)
	{
		if ($country_id == '') {
			redirect(base_url() . "admin/masters/view_countries");
		}

		$this->db->select('*');
		$this->db->where('country_id', $country_id);
		$this->db->from('country');
		$query = $this->db->get();

		return $query->row();

	} //End of edit function

	function update_country($country_id)
	{
		$data = array(
			'country_name'    => $this->input->post("country_name")
		);
		$this->db->where('country_id', $country_id);
		$result = $this->db->update('country', $data);
		if ($result) {
			$update_by[] = array('uid' => $this->session->userdata('user_id'), 'dt' => date('Y-m-d H:i:s'));
			$update_by_id = json_encode($update_by);
			$table_name = "country";
			$operation = "Record updated";
			createLogFile($operation,$country_id,$update_by_id,$table_name);	
		   return 1;
		   exit();
		 }
		 else
		 {
		   return 0;
		   exit();
		 }
		
	} //End of Update function

	function view_counties()
	{
		$this->db->select('*');
		$this->db->where('is_active', '1');
		$this->db->from('country');
		$query = $this->db->get();
		$result = $query->result();
		foreach ($result as $row) {
		$row->total_states= $this->count_states($row->country_id);
		}
		return $result;

   } //End of View function
   
   function count_states($country_id)
   {
		$this->db->where('country_id', $country_id);
		$this->db->from('state');
		$query = $this->db->get();
		//$this->db->last_query();
		return $query->num_rows();

   } //End of Count function
		
	function insert_state()
		{
			$data  = array(
				'state_name'    => $this->input->post("state_name"),
				'country_id'    => $this->input->post("country_id")
			);
			$result   = $this->db->insert('state', $data);
			$state_id = $this->db->insert_id();
			if ($result) {
				$update_by[] = array('uid' => $this->session->userdata('user_id'), 'dt' => date('Y-m-d H:i:s'));
				$update_by_id = json_encode($update_by);
				$table_name = "state";
			    $operation = "Record added";
			    createLogFile($operation,$state_id,$update_by_id,$table_name);	
			   return 1;
			   exit();
			 }
			 else
			 {
			   return 0;
			   exit();
			 }
	
		} //End of add function
	
	
		function view_states($state_id,$country_id)
		{
			$this->db->select('*');
			$this->db->from('state');
			$this->db->join('country', 'country.country_id = state.country_id');
			if($state_id!='0')
			$this->db->where('state.state_id', $state_id);
			if($country_id!='0')
			$this->db->where('state.country_id', $country_id);
			$this->db->where('state.is_active', '1');
			$this->db->order_by('state_name', 'ASC');
			$query = $this->db->get();
			$result = $query->result();
			foreach ($result as $row) {
            $row->total_cities= $this->count_cities($row->state_id);
			}
			return $result;
	
	   } //End of View function
	   
	   function count_cities($state_id)
       {
			$this->db->where('state_id', $state_id);
			$this->db->from('city');
			$query = $this->db->get();
			//$this->db->last_query();
			//echo "<br>";
			return $query->num_rows();

       } //End of Count function
		
	
	
	  function state_edit($state_id)
	  {
		if ($state_id == '') {
			redirect(base_url() . "admin/masters/view_states");
		}

		$this->db->select('*');
		$this->db->where('state_id', $state_id);
		$this->db->from('state');
		$query = $this->db->get();

		return $query->row();

	} //End of edit function


	 function update_state($state_id)
	 {
		$data = array(
			'state_name'    => $this->input->post("state_name")
		);
		$this->db->where('state_id', $state_id);
		$result = $this->db->update('state', $data);
		if ($result) {
			$update_by[] = array('uid' => $this->session->userdata('user_id'), 'dt' => date('Y-m-d H:i:s'));
			$update_by_id = json_encode($update_by);
			$table_name = "state";
			$operation = "Record updated";
			createLogFile($operation,$state_id,$update_by_id,$table_name);	
		   return 1;
		   exit();
		 }
		 else
		 {
		   return 0;
		   exit();
		 }
		
	 } //End of Update function
		 
	 
	 
		function insert_city()
		{
			$data     = array(
				'state_id'     => $this->input->post("state_id"),
				'city_name'     => $this->input->post("city_name")
			);
			$result   = $this->db->insert('city', $data);
			$city_id = $this->db->insert_id();
			if ($result) {
				$update_by[] = array('uid' => $this->session->userdata('user_id'), 'dt' => date('Y-m-d H:i:s'));
				$update_by_id = json_encode($update_by);
				$table_name = "city";
			    $operation = "Record added";
			    createLogFile($operation,$city_id,$update_by_id,$table_name);	
			   return 1;
			   exit();
			 }
			 else
			 {
			   return 0;
			   exit();
			 }
	
	
		} //End of add function
	
	
		function view_citys($state_id,$limit,$start)
		{
			$this->db->select('*');
			$this->db->from('city');
		    $this->db->join('state', 'city.state_id = state.state_id');
			$this->db->where('city.is_active', '1');
			if($state_id!='0')
	   	    $this->db->where('city.state_id',$state_id);
			$this->db->order_by('state.state_name', 'ASC');
			$this->db->order_by('city.city_name', 'ASC');
			$this->db->limit($limit,$start);
			
			$query = $this->db->get();
			//echo $this->db->last_query();
			$result = $query->result();
			return $result;

       } //End of View function
	   
		function count_citys($state_id)
		{
			$this->db->select('*');
			$this->db->from('city');
			$this->db->where('city.is_active', '1');
		    $this->db->join('state', 'city.state_id = state.state_id');
			if($state_id!='0')
	   	    $this->db->where('city.state_id',$state_id);
			$this->db->order_by('state.state_name', 'ASC');
			$this->db->order_by('city.city_name', 'ASC');
			
			$query = $this->db->get();
			//echo $this->db->last_query();
			return $query->num_rows();

       } //End of View function

		 function city_edit($city_id)
		 {
			if ($city_id == '') {
				redirect(base_url() . "admin/masters/view_citys");
			}
		   $this->db->select('*');
			$this->db->where('city_id', $city_id);
			$this->db->from('city');
			$query = $this->db->get();
	
			return $query->row();
	
		} //End of edit function



		 function update_city($city_id)
		 {
			$data = array(
				'state_id'     => $this->input->post("state_id"),
				'city_name'     => $this->input->post("city_name")
			);
			$this->db->where('city_id', $city_id);
			$result = $this->db->update('city', $data);
			if($result)
			{
				$update_by[] = array('uid' => $this->session->userdata('user_id'), 'dt' => date('Y-m-d H:i:s'));
				$update_by_id = json_encode($update_by);
				$table_name = "city";
				$operation = "Record updated";
				createLogFile($operation,$city_id,$update_by_id,$table_name);	
			   return 1;
			   exit();
			}
			
		} //End of Update function
		
		
		function add_role()
        {
		$role_rights=$this->input->post('role_rights');
		$rolerights = json_encode($role_rights);
		 $data        = array(
            'role_name'   => $this->input->post("role_name"),
            'description'     => $this->input->post("description"),
			'role_rights'     => $rolerights,
			'reg_date'   => date('Y-m-d H:i:s')
        );
        $result   = $this->db->insert('roles', $data);
		$role_id  = $this->db->insert_id();
		if($result)
		{   $update_by[] = array('uid' => $this->session->userdata('user_id'), 'dt' => date('Y-m-d H:i:s'));
			$update_by_id = json_encode($update_by);
			$table_name = "roles";
			$operation = "Record added";
			createLogFile($operation,$role_id,$update_by_id,$table_name);
			
			return 1;
		}
		else
		{
			return 0;
		}


    } //End of add function
	
	
		function view_roles()
		{
			$this->db->select('*');
			$this->db->from('roles');
			$this->db->order_by('role_name', 'ASC');
			$query = $this->db->get();
			$result = $query->result();
			
			return $result;
	
	   } //End of View function
		
		
		
		 function role_edit($role_id)
		 {
			if ($role_id == '') {
				redirect(base_url() . "users/masters/view_roles");
			}
	
			$this->db->select('*');
			$this->db->where('role_id', $role_id);
			$this->db->from('roles');
			$query = $this->db->get();
	
			return $query->row();
	
		} //End of edit function
	
	
		 function update_role($role_id)
		 {
			$role_rights=$this->input->post('role_rights');
			$rolerights = json_encode($role_rights); 
			$data        = array(
				'role_name'   => $this->input->post("role_name"),
				'description'     => $this->input->post("description"),
				'role_rights'     => $rolerights
			);
			$this->db->where('role_id', $role_id);
			$result = $this->db->update('roles', $data);
			if ($result)
			{
				$update_by[] = array('uid' => $this->session->userdata('user_id'), 'dt' => date('Y-m-d H:i:s'));
				$update_by_id = json_encode($update_by);
				$table_name = "roles";
				$operation = "Record updated";
				createLogFile($operation,$role_id,$update_by_id,$table_name);
			   return 1;
			   }
			 else
			 {
			   return 0;
			 }
			
		 } //End of Update function
		 
	
	function navigate_rights($user_type,$default_opt){
		$CI= & get_instance();
		$CI->load->database();
		$CI->db->select('*');
		$CI->db->from('navigation_menus');
		$CI->db->where('user_type',$user_type);
		$CI->db->where('is_parent',0);
		$CI->db->where('is_active',1);
		$CI->db->order_by('set_order', 'ASC');
		$query = $CI->db->get();
		$result = $query->result();
		print "<div class='rolerights'>";
		if($user_type=='U')
		 {
		  $class='all_select';
		  $str_val='user_modules';
		}
		else
		{
		  $class='allselect';
		  $str_val='projects_rights';
		}
		foreach($result as $res){
			$name=strtoupper($res->menu_name);
			$ids=$res->menu_id;
			$links=$res->menu_link;
			if(is_array($default_opt))
			{	$key = array_search($ids,$default_opt);
				if( $key !== false ) {
				   $checked='checked';
				} else {
				   $checked='';
				}
			}else
			{	 $checked='';
			}
			echo "<div class='md-checkbox'><input class='".$class." md-check parent".$ids."' type='checkbox' ".$checked."  name='".$str_val."[]' id='".$str_val."".$ids."' value='".$ids."'><label for='".$str_val."".$ids."'><span></span><span class='check'></span><span class='box'></span>".$name."</label></div>";
			
			
		$getchilds=$this->getchild_checkbox($ids,$default_opt,'parent',$ids);
		}
		print "</div>";
	}
	
	function getchild_checkbox($cid,$default_opt,$child_sta,$parentid){//echo $cid.",".$child_sta.",".$parentid;echo "<pre>";print_r($default_opt);
		$CI= & get_instance();
		$CI->load->database();
		$CI->db->select('*');
		$CI->db->from('navigation_menus');
		$CI->db->where('is_parent',$cid);
		$CI->db->where('is_active',1);
		$CI->db->order_by('set_order', 'ASC');
		$query = $CI->db->get();
		$countrows=$query->num_rows();
		if($countrows>0){//echo $CI->db->last_query();
			$result = $query->result();
			print "<ul>";
			foreach($result as $childs){//echo "<pre>";print_r($childs);
				$name_get=strtoupper($childs->menu_name);
				$links=$childs->menu_link;
				$ids=$childs->menu_id;
				$key = array_search($ids,$default_opt);
				if( $key !== false ) {
				   $checked='checked';
				} else {
				   $checked='';
				}
				if($childs->user_type=='U')
				{
				 $class='all_select';
				 $str_val='user_modules';
				}
				else
				{
				 $class='allselect';
				 $str_val='projects_rights';
				}
			
				if($child_sta=='child'){
					$parentget=$parentid;
				}else{
					$parentget=$cid;
				}
				$classname = str_replace(' ', '_', $name_get);//echo $parentget;
				echo  "<div class='md-checkbox'><input class='md-check ".$class." getParentid$cid getAncestorid$parentget' type='checkbox' ".$checked."  name='".$str_val."[]' id='".$str_val."".$ids."' value='".$ids."'><label for='".$str_val."".$ids."'><span></span><span class='check'></span><span class='box'></span>".$name_get."</label></div>";
				$nameof= $this->getchild_checkbox($childs->menu_id,$default_opt,'child',$cid); 
			}
			print "</ul>";
		}else{
			print "";
		}
	}
	
	 /*========== Add module ==============*/
	 
	   function add_module()
        {
		$is_parent=$this->input->post("module_id");
		 if($is_parent){
			    $get_parent = $is_parent;
				 }
				else{
					$get_parent='0';
				}
				
		$display_menu= $this->input->post("display_menu");
			if($display_menu=='1'){
				$display_menu=$display_menu;
			}else{
				$display_menu='0';
			}
			
		 $data        = array(
            'user_type'   => $this->input->post("user_type"),
		    'menu_name'     => $this->input->post("menu_name"),
		    'menu_link'     => $this->input->post("menu_link"),
			'menu_class'     => $this->input->post("menu_class"),
			'set_order'     => $this->input->post("set_order"),
			'display_leftmenu'     => $display_menu,
			'is_parent'     => $get_parent
        );
        $result   = $this->db->insert('navigation_menus', $data);
		$menu_id  = $this->db->insert_id();
		if($result)
		{
			$update_by[] = array('uid' => $this->session->userdata('user_id'), 'dt' => date('Y-m-d H:i:s'));
			$update_by_id = json_encode($update_by);
			$table_name = "navigation_menus";
			$operation = "Record updated";
			createLogFile($operation,$menu_id,$update_by_id,$table_name);
				 
			return 1;
		}
		else
		{	return 0;
		}


    } //End of add function
	
	
		
	   /*=============== Display all menus in modules ===================*/
	   function modules_tree($user_type){
		$this->db->select('*');
		$this->db->from('navigation_menus');
		$this->db->where('is_parent',0);
		$this->db->where('user_type',$user_type);
		$this->db->where('is_active',1);
		$this->db->order_by('set_order', 'ASC');
		$query = $this->db->get();
		$count_results=$query->num_rows();
		$result = $query->result();
		$counter=1;	
		$out='';
		if($count_results>0){
			foreach($result as $res){
				$counter++;
				$name=strtoupper($res->menu_name);
				$ids=$res->menu_id;
				/*$fields = array('user_id'=>$this->session->userdata('user_id'));
				$result_user = gettableinfo('users',$fields);
				$des_id= $result_user->designation_id;*/
				$links=$res->menu_link;
				$menu_class=$res->menu_class;
				if(substr($links,0,1) == '/') {
					$filterlink=substr($links,1);
				}else{
					$filterlink=$links;
				}
				$out .= '<li class="dd-item dd3-item"  data-id="'.$counter.'">
							<div class="dd-handle dd3-handle"> </div>
					   <div class="dd3-content" >'.$name.'<div class="pull-right"><a   style="float:right; cursor:pointer;pointer-events:all;" target="_blank" href='.base_url().'admin/masters/edit_module/'.$ids.'><i class="fa fa-edit"></i></a></div></div>';
				$out .=$this->getchild_module_tree($user_type,$ids,$counter);
			}
			return $out;
		}else{
			return false;
		}
	}
	
	function getchild_module_tree($user_type,$cid,$counter){
	$this->db->select('*');
	$this->db->from('navigation_menus');
	$this->db->where('user_type',$user_type);
	$this->db->where('is_parent',$cid);
	$this->db->order_by('set_order', 'ASC');
	$query = $this->db->get();
	$countrows=$query->num_rows();
	$output='';
	if($countrows>0){
		$result = $query->result();
		$output .= "<ol class='dd-list'>";
		foreach($result as $childs){
			$mod_id=$childs->menu_id;
			$name_get=strtoupper($childs->menu_name);
			$links=$childs->menu_link;
			$output .= '<li class="dd-item dd3-item" data-id="'.$counter.'">
						<div class="dd-handle dd3-handle"> </div>
					   <div class="dd3-content">'.$name_get.'<div class="pull-right action-buttons"><a  href='.base_url().'admin/masters/edit_module/'.$mod_id.' target="_blank"><i class="fa fa-edit"></i></a></div></div></li>';
			$output .= $this->getchild_module_tree($user_type,$mod_id,$counter); 
		}
		$output .= "</ol>";
	}else{
		$output .= "</li>";
	}
	return $output;
}
		
	/*============ get the Module name separately ============*/
	 function modules_edit($menu_id)
	   {
		if ($menu_id == '') {
			redirect(base_url() . "admin/masters/view_modules");
		}

		$this->db->select('*');
		$this->db->where('menu_id', $menu_id);
		$this->db->from('navigation_menus');
		$query = $this->db->get();

		return $query->row();

	} //End of edit function
	



	   /*============= Update Module ==========*/
	    function update_module($menu_id){
			$is_parent=$this->input->post("menu_link");
		 if($is_parent){
			 $get_parent=$this->input->post("module_id");
		 }else{
				$mname=$this->input->post("module_id");
				if($mname!=0){
					$get_parent=$mname;
				}else{
					$get_parent=0;
				}
		 }
		$display_menu= $this->input->post("display_menu");
			if($display_menu==1){
				$display_menu=$display_menu;
			}else{
				$display_menu='0';
			}
			$data  = array(
				'user_type'   => $this->input->post("user_type"),
				'menu_name'     => $this->input->post("menu_name"),
				'menu_link'     => $this->input->post("menu_link"),
				'menu_class'     => $this->input->post("menu_class"),
				'set_order'     => $this->input->post("set_order"),
				'display_leftmenu'     => $display_menu,
				'is_parent'     => $get_parent,
			);
		//print "<pre>"; print_r($data); die;
		$this->db->where('menu_id', $menu_id);
		$result = $this->db->update('navigation_menus', $data);
		if ($result) {
			    $update_by[] = array('uid' => $this->session->userdata('user_id'), 'dt' => date('Y-m-d H:i:s'));
				$update_by_id = json_encode($update_by);
				$table_name = "navigation_menus";
				$operation = "Record updated";
				createLogFile($operation,$menu_id,$update_by_id,$table_name);
				
			    return 1;
		 }
		 else
		 {
		   return 0;
		 }
		
	 } //End of Update function
	 
	 
	
	
}