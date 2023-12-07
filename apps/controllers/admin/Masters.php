<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Masters extends CI_Controller {
public function __construct()
	{
		parent:: __construct();
		valid_logged_in(FALSE,'A');	
		$this->load->model('admin/master_model');
	}
	
	public function add_country()
	{
		  $data['title'] = title." | Add Country";
		  $data['main_heading'] = "Countries";
		  $data['heading'] = "Add Country";
		  $data['already_exists'] = "";
		 
		 $this->form_validation->set_rules('country_name', 'Country name', 'required|trim|xss_clean'); 

		 if ($this->form_validation->run()) {
		  // Update records 
		  $feilds = array('country_name' =>$this->input->post('country_name'));
		  $result = check_unique('country',$feilds);
		  if($result==1)
		  {
			 $data['already_exists']='Country name already exists, Please try another.';
		  }
		  else
		  {
				$result = $this->master_model->insert_country();
				if($result=='1')
				   $msg = "Country has been added successfully.";
				else
				   $msg="There is some error in country added.";   
				
				  $this->session->set_flashdata('success_message', $msg);
				  redirect(base_url() . 'admin/masters/view_countries');
			} //end of add functionality
	  }
	   $this->load->view('admin/masters/add_country', $data);
	}

	public function view_countries()
	{
		  $data['title'] = title." | View Countries";
		  $data['main_heading'] = "Countries";
		  $data['heading'] = "View Countries";
			 
		  $results = $this->master_model->view_counties();
		  $num_rows = count($results);	
		  $data['results'] = $results;
		  $data['num_rows'] = $num_rows;
		  $this->load->view('admin/masters/view_countries', $data);
		
    } //end of view functionality*/
	
	
	
	public function edit_country($country_id)
	{
		  $data['title'] = title." | Edit Country";
		  $data['main_heading'] = "Countries";
		  $data['heading'] = "Edit Country";
		  $data['already_exists'] = "";
			$this->form_validation->set_rules('country_name', 'Country name', 'required|trim|xss_clean'); 
		  if ($this->form_validation->run()) {
		  // Update records 
		  $feilds = array('country_name' =>$this->input->post('country_name'),'country_id' =>$country_id);
		  $result = check_unique('country',$feilds,'0'); 
		  if($result==1)
		  {
			 $data['already_exists']='Country name already exists, Please try another.';
		  }
		 else
		  {
			  // Update records 
			  $result = $this->master_model->update_country($country_id);	
			  if($result=='1')
				   $msg = "Country record has been updated successfully.";
				else
				   $msg=""; 
				   
			   $this->session->set_flashdata('success_message', $msg);
			   redirect(base_url() . "admin/masters/view_countries/".$country_id."");
		  }
		}
			
		  $result =  $this->master_model->country_edit($country_id);
		  $data['edit_data'] = $result;	
		  $this->load->view('admin/masters/edit_country', $data);
		 
	}//end of Edit functionality
	
	 public function add_state()
	 {
		  $data['title'] = title." | Add State";
		  $data['main_heading'] = "States";
		  $data['heading'] = "Add State";
		  $data['already_exists'] = "";
		 
		 $this->form_validation->set_rules('country_id', 'Country name', 'required|trim|xss_clean'); 
		  $this->form_validation->set_rules('state_name', 'State name', 'required|trim|xss_clean'); 

		 if ($this->form_validation->run()) {
		  // Update records 
		  $feilds = array('state_name' =>$this->input->post('state_name'),'country_id' =>$this->input->post('country_id'));
		  $result = check_unique('state',$feilds);
		  if($result==1)
		  {
			 $data['already_exists']='State name already exists, Please try another.';
		  }
		  else
		  {
				$result = $this->master_model->insert_state();
				if($result=='1')
				   $msg = "State has been added successfully.";
				else
				   $msg="There is some error in state added.";   
				
				  $this->session->set_flashdata('success_message', $msg);
				  redirect(base_url() . 'admin/masters/view_states');
			} //end of add functionality
	  }
	   $this->load->view('admin/masters/add_state', $data);
	}
	
	
	public function view_states()
	{
		
		  $data['title'] = title." | View States";
		  $data['main_heading'] = "States";
		  $data['heading'] = "View States";
		 
		  if($this->input->post('state_id'))
			 $state_id = $this->input->post('state_id');
		  elseif($this->uri->segment('4'))
			 $state_id=$this->uri->segment('4');
		  else
			 $state_id='0';
		
		 
		  if($this->input->post('country_id'))
			 $country_id = $this->input->post('country_id');
		  elseif($this->uri->segment('5'))
			 $country_id=$this->uri->segment('5');
		  else
			 $country_id='0';
		
			 
		  $results = $this->master_model->view_states($state_id,$country_id);
		  $data['results'] = $results;
		  $num_rows = count($results);	
		  $data['num_rows'] = $num_rows;
		  $data['state_id'] = $state_id;
		  $this->load->view('admin/masters/view_states', $data);
		
    } //end of view functionality*/
		
		
	public function edit_state($state_id)
	{
		  $data['title'] = title." | Edit State";
		  $data['main_heading'] = "States";
		  $data['heading'] = "Edit State";
		  $data['already_exists'] = "";
			$this->form_validation->set_rules('country_id', 'Country name', 'required|trim|xss_clean'); 
		  $this->form_validation->set_rules('state_name', 'State name', 'required|trim|xss_clean'); 
		  if ($this->form_validation->run()) {
		  // Update records 
		  $feilds = array('state_name' =>$this->input->post('state_name'),'state_id' =>$state_id);
		  $result = check_unique('state',$feilds,'0');
		  if($result==1)
		  {
			 $data['already_exists']='State name already exists, Please try another.';
		  }
		 else
		  {
			  // Update records 
			  $result = $this->master_model->update_state($state_id);	
			  if($result=='1')
				   $msg = "State record has been updated successfully.";
				else
				   $msg=""; 
				   
			   $this->session->set_flashdata('success_message', $msg);
			   redirect(base_url() . "admin/masters/view_states/".$state_id."");
		  }
		}
			
		  $result =  $this->master_model->state_edit($state_id);
		  $data['edit_data'] = $result;	
		  $this->load->view('admin/masters/edit_state', $data);
		 
	}//end of Edit functionality
	
	

	public function add_city()
	{
		  $data['title'] = title." | Add City";
		  $data['main_heading'] = "Cities";
		  $data['heading'] = "Add City";
		  $data['already_exists'] = "";
		 
		  $this->form_validation->set_rules('state_id', 'State', 'required|trim|xss_clean');
		  $this->form_validation->set_rules('city_name', 'City name', 'required|trim|xss_clean');
		if ($this->form_validation->run()) {
			
		  $feilds = array('state_id' =>$this->input->post('state_id'),'city_name' =>$this->input->post('city_name'));
		  $result = check_unique('city',$feilds);
		  if($result==1)
		  {
			 $data['already_exists']='City name already exists, Please try another.';
		  }
		  else
		  {
        	$result = $this->master_model->insert_city();
			if($result=='1')
			   $msg = "City has been added successfully.";
			else
			   $msg="There is some error in city added.";   
			
			  $this->session->set_flashdata('success_message', $msg);
			  redirect(base_url() . 'admin/masters/view_citys');
	     } //end of add  functionality
		 
		}
	   $this->load->view('admin/masters/add_city', $data);
	}
	
	
	public function view_citys()
	{
		  $data['title'] = title." | View Cities";
		  $data['main_heading'] = "Cities";
		  $data['heading'] = "View Cities";
		  
		  if($this->input->post('state_id'))
			 $state_id = $this->input->post('state_id');
		  elseif($this->uri->segment('4'))
			 $state_id=$this->uri->segment('4');
		  else
			 $state_id='0';
			 
		  if($this->input->post('per_page'))
			$per_page = $this->input->post('per_page');
		  elseif($this->uri->segment('5'))
			$per_page=$this->uri->segment('5');
		  else
			$per_page=per_page;	
			
			$config = array();
			$config["base_url"] = base_url() . "admin/masters/view_citys/".$state_id."/".$per_page;
			$config["per_page"] = 100;
			$config["uri_segment"] = 6;
			$config["total_rows"] =$this->master_model->count_citys($state_id);
			$this->pagination->initialize($config);
			$page = ($this->uri->segment(6)) ? $this->uri->segment(6) : 0; 	 
			 
		   $results = $this->master_model->view_citys($state_id,$config["per_page"],$page);
		   $data['links']   = $this->pagination->create_links();
		   $data['results'] = $results;
		   $num_rows =$config["total_rows"];
		   $data['num_rows'] = $num_rows;
		  
		   $data['state_id'] = $state_id; 
		   $this->load->view('admin/masters/view_citys', $data);
		
    } //end of view functionality
		
		
	public function edit_city($city_id,$s_id)
	{
		  $data['title'] = title." | Edit City";
		  $data['main_heading'] = "Cities";
		  $data['heading'] = "Edit City";
		  $data['already_exists'] = "";

		  $this->form_validation->set_rules('state_id', 'State', 'required|trim|xss_clean');
		  $this->form_validation->set_rules('city_name', 'City name', 'required|trim|xss_clean');
		 
		 if ($this->form_validation->run()) {
		  // Update records 
		  $feilds = array('state_id' =>$this->input->post('state_id'),'city_name' =>$this->input->post('city_name') ,'city_id' =>$city_id);
		  $result = check_unique('city',$feilds,'0');
		  if($result==1)
		  {
			 $data['already_exists']='City name already exists, Please try another.';
		  }
		 else
		  { 
			  // Update records 
			  $result = $this->master_model->update_city($this->input->post('city_id'));	
			  if($result=='1')
				   $msg = "City record has been updated successfully.";
			   else
				   $msg=""; 
				   
			  $this->session->set_flashdata('success_message', $msg);
			  redirect(base_url() . "admin/masters/view_citys/".$s_id);
		  }
		}
			
		  $result =  $this->master_model->city_edit($city_id);
		  $data['edit_data'] = $result;	
		  $this->load->view('admin/masters/edit_city', $data);
		 
		 
	}//end of Edit functionality*/



	
    
	function add_module(){
		$data['title'] = title." | Add Module";
		$data['main_heading'] = "Modules";
		$data['heading'] = "Add Module";
		$data['already_msg'] = "";
		
		 if($this->input->post('user_type'))
			 $user_type = $this->input->post('user_type');
		  elseif($this->uri->segment('4'))
			 $user_type=$this->uri->segment('4');
		  else
			 $user_type='C'; 
		 
		 $this->form_validation->set_rules('user_type', 'User type', 'required|trim'); 
		 $this->form_validation->set_rules('menu_name', 'Module name', 'required|trim'); 
		 if ($this->form_validation->run()) {
		  // Update records 
		  $feilds = array('user_type' =>$this->input->post('user_type'),'menu_name' =>$this->input->post('menu_name'));
		  $result = check_unique('navigation_menus',$feilds);
		  if($result==1)
		  {
			 $data['already_msg']='Module name already exists, Please try another.';
		  }
		  else
		  {
				$result = $this->master_model->add_module();
				if($result=='1')
				   $msg = "Module has been added successfully.";
				else
				   $msg="There is some error in Module added.";   
				
				  $this->session->set_flashdata('success_message', $msg);
				  redirect(base_url() . 'admin/masters/view_modules');
			} //end of add functionality
		}
		
		$data['user_type'] = $user_type;
		$data['module_id'] = isset($_POST['module_id']) ? $_POST['module_id'] : 0;
		$this->load->view('admin/masters/add_module', $data);
	}
	
	/*================ View Modules =================*/
	public function view_modules()
	{
		  $data['title'] = title." | View Modules";
		  $data['main_heading'] = "Modules";
		  $data['heading'] = "View Modules";
		  
		  if($this->input->post('user_type'))
			 $user_type = $this->input->post('user_type');
		  elseif($this->uri->segment('4'))
			 $user_type=$this->uri->segment('4');
		  else
			 $user_type='C'; 
			 
		  $results = $this->master_model->modules_tree($user_type);
		  $data['results'] = $results;
		  $num_rows = count($results);	
		  
		  $data['user_type'] = $user_type;
		  $this->load->view('admin/masters/view_modules', $data);
		
    } //end of view functionality*/
	
	/*============= Edit modules ==================*/
	public function edit_module($menu_id)
	{
		  $data['title'] = title." | Edit Module";
		  $data['main_heading'] = "Modules";
		  $data['heading'] = "Edit Module";
		  $data['already_msg'] = "";

		  $this->form_validation->set_rules('user_type', 'User type', 'required|trim'); 
		  $this->form_validation->set_rules('menu_name', 'Module name', 'required|trim'); 
		  $this->form_validation->set_rules('set_order', 'Set Order', 'required|trim'); 
		
		  if ($this->form_validation->run()) {
		  // Update records 
		  $feilds = array('user_type' =>$this->input->post('user_type'),'menu_name' =>$this->input->post('menu_name'));
		  $unique_id = array('menu_id' =>$menu_id);
		  $result = check_unique_edit('navigation_menus',$feilds,$unique_id);
		  if($result==1)
		  {
			 $data['already_exists']='Module name already exists, Please try another.';
		  }
		 else
		  {
			  // Update records 
			  $result = $this->master_model->update_module($this->input->post('menu_id'));	
			   if($result=='1')
				   $msg = "Module record has been updated successfully.";
				else
				   $msg=""; 
				   
			   $this->session->set_flashdata('success_message', $msg);
			   redirect(base_url() . "admin/masters/view_modules");
		  }
		}
			 
		  $result =  $this->master_model->modules_edit($menu_id);
		  $data['edit_data'] = $result;	
		  $this->load->view('admin/masters/edit_module', $data);
		 
	}//end of Edit functionality
	
	
}	
?>