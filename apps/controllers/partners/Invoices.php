<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Invoices extends CI_Controller {



	

public function __construct()

	{

		parent:: __construct();

		valid_logged_in(FALSE,'V');	

		$this->load->model('partners/invoices_model');

		$this->load->library('upload');

		$this->load->library('image_lib');

	}

	



	public function view()

	{

		$data=array();

		$data['title'] = title." | View Invoices";

		$data['main_heading'] ="Invoices";

		$data['heading'] = "View Invoices";

	

		$results = $this->invoices_model->view_invoices();

		  

		$data['results']  = $results;

		$num_rows         = count($results);	

		$data['num_rows'] = $num_rows;		  

		$this->load->view('partners/invoices/view', $data);		

    } //end of view functionality	

	

	

	public function add()

	{

	      $data['title'] = title." | Add Invoice";

		  $data['main_heading'] = "Invoices";

		  $data['heading'] = "Add Invoice";

		  $data['already_msg']="";

		  $results="";

		  $total_results="";

		  

		 /* echo "<pre>";

		  print_r($_POST);

		  echo "</pre>";*/

		   

		   

		  if($this->input->post('form_type')=='1')

		  {

			$this->form_validation->set_rules('choose_invoice_month', 'Choose Invoice Month', 'required|trim');  

		   $results = $this->invoices_model->get_services($this->input->post('choose_invoice_month'));

		   $total_results = count($results);

		   // die();

		  }

		 

		 

	  if($this->input->post('form_type')=='2')

	  {

		  $this->form_validation->set_rules('invoice_date', 'Invoice Date', 'required|trim');

		  $this->form_validation->set_rules('user_remarks', 'User Remarks', 'trim');

			   

		if ($this->form_validation->run()) {

			  	

			$invoice_date = substr($this->input->post('invoice_date'),0,7);	

		    $this->db->select('*');

		    $this->db->from('invoices');

		    $this->db->where('company_id',$this->session->userdata('master_id'));

		    $this->db->where('user_id',$this->session->userdata('user_id'));

		   // $this->db->where('MONTH(invoice_date)',$this->input->post('choose_invoice_month'));

  		    $this->db->where("DATE_FORMAT(invoice_date,'%Y-%m')",$invoice_date);

		    $query = $this -> db -> get();

		   // echo $this->db->last_query();

			//echo "<br><br>";

		   	//die();

		   if($query->num_rows() > 0)

		   {

		    $data['already_msg']=' This Month Invoice '.$this->input->post('invoice_date').' is already exists, Please try another.';

		  }

		 else

		  {			  

			 $invoice_id =  $this->invoices_model->add();	

			 if($invoice_id!='0'){

			 	  

			     if($invoice_id=='0')

			       $msg = "There is some error in Save Invoice Record.";

			     else  

			       $msg = "Invoice has been created successfully.";

				   			 

			    $this->session->set_flashdata('success_message', $msg);	

			    redirect(base_url() . 'partners/invoices/view');				

			}  

		  }

	    } //end of add  functionality

	  }

		

		$data['results'] =$results;

		$data['total_results'] =$total_results;

		

	   $data['choose_invoice_month']= $this->input->post('choose_invoice_month');

	   $this->load->view('partners/invoices/add.php', $data);

	}

	

	public function edit($user_id){

		

		  

		  $data['title'] = title." | Edit Trainer";

		  $data['main_heading'] = "Trainers";

		  $data['heading'] = "Edit Trainer";

          $data['already_msg']="";

			 

		  $this->form_validation->set_rules('trainer_name', 'Trainer name', 'required|trim');

		  $this->form_validation->set_rules('email', 'Primary  Email', 'required|valid_email');

		  $this->form_validation->set_rules('mobile_no1', 'Primary Mobile no', 'trim|numeric|min_length[10]');

		  

		if ($this->form_validation->run()) {

		  // Update records 

		  $email_feild = array('email' =>trim($this->input->post('email')));

		  $unique_id = array('user_id' =>$user_id);

		  $email_result = check_unique_edit('users',$email_feild,$unique_id);

		 if($email_result==1)

		  {

			 $data['already_msg']=''.$this->input->post('email').' already exists, Please try another.';

		  }

		 else

		  {  

		     $result =  $this->invoices_model->update_vendor($this->input->post('user_id'));	

			if($result){

			 $this->original_path = realpath('assets/static/'.$this->session->userdata('master_id').'/trainer_photos/original');

   		      $this->resized_path = realpath('assets/static/'.$this->session->userdata('master_id').'/trainer_photos/resized');

	

			if($_FILES['user_photo']['error'] != 4){							  

			  $config['upload_path'] = $this->original_path;

			  $config['allowed_types'] = 'jpeg|gif|jpg|png';

			  $config['max_size']	= '5120';

			  $config['max_width']  = '0';

			  $config['max_height']  = '0';

			  $config['overwrite'] = true;			

			  $config['file_name'] =$user_id.'-'.$_FILES['user_photo']['name'];

			  $this->upload->initialize($config);

			  

			  if ( ! $this->upload->do_upload('user_photo')){

					$data['already_msg']=$this->upload->display_errors();

					$success = FALSE;

				}

			else{

					$data = $this->upload->data();

					$file_name = $data['file_name'];

					$original_path = $data['full_path'];

					$image_thumb  =$this->resized_path.'/'.$file_name;

					$config1['image_library']    = 'gd2';

					$config1['source_image']     = $original_path;

					$config1['new_image']        = $image_thumb;

					$config1['maintain_ratio']   = TRUE;

					$config1['height']              = 150;

					$config1['width']              = 150;

					$this->image_lib->initialize( $config1);

					$this->image_lib->resize();

					$this->image_lib->clear();									

					$result_photo = $this->invoices_model->update_photo($user_id,$file_name);

				}

			 }

		      if($result=='1')

			   $msg = "Trainer record has been updated successfully.";

			  else

			   $msg="There is some error in update record."; 

			   

		      $this->session->set_flashdata('success_message', $msg);

		      redirect(base_url() . "partners/trainers/view/".$this->input->post('user_id'));								

			}

			else{

			   $this->session->set_flashdata('warning_message',$result_info['results']['message']);

			  }	

		  }

		}



		  $result =  $this->invoices_model->trainer_edit($user_id);

		  $data['edit_data'] = $result;

  

		  $this->load->view('partners/trainers/edit.php', $data);

		 

	}//end of Edit functionality*/

	

	

	

	public function details($invoice_id)

	{	

	  $data=array();

		$data['title'] = title." | View Invoices";

		$data['main_heading'] ="Invoices";

		$data['heading'] = "View Invoices";

	

	   if($this->input->post('invoice_id'))

		 $invoice_id = $this->input->post('invoice_id');

	   elseif($this->uri->segment('4'))

		 $invoice_id=$this->uri->segment('4');

		else

		 $invoice_id='0';

		

		$rowuser = $this->invoices_model->get_user_details();	 

		$rowinvoice = $this->invoices_model->get_invoice_details($invoice_id);

		$results = $this->invoices_model->get_invoice_services($invoice_id);

		

		$data['rowuser']  = $rowuser;   

		$data['rowinvoice']  = $rowinvoice;  

		$data['results']  = $results;

		$num_rows         = count($results);	

		$data['num_rows'] = $num_rows;		  

		

		$this->load->view('partners/invoices/details.php', $data);

		 

	}//end of Status  functionality*/



	

	

	public function status($user_id,$status)

	{	 // Update status  

	     $result = $this->invoices_model->update_status($user_id,$status);

		 if($result=='1')

		 {

		   $this->session->set_flashdata('success_message', 'Status has been updated successfully.');

		 }

		 else

		 {

			 $this->session->set_flashdata('warning_message', 'There is some error in status updation.');

		 }

		  redirect(base_url() . "partners/trainers/view");		

		 

	}//end of Status  functionality*/



	

}	

?>