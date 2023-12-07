<?php
error_reporting(-1);
ini_set('display_errors', 1);
defined('BASEPATH') OR exit('No direct script access allowed');
class Courses extends CI_Controller {

public function __construct()
	{
		parent:: __construct();
		valid_logged_in(FALSE,'A');	
		$this->load->model('admin/posp/courses_model');
		$this->load->library('upload');
		}
	
	
	public function view()
	{
		$data=array();
	    $data['title'] = title." | View Courses";
	    $data['main_heading'] = "Courses";
	    $data['heading'] = " View Courses";
	
		$results = $this->courses_model->view_courses();
		  
		$data['results']  = $results;
		$num_rows         = count($results);	
		$data['num_rows'] = $num_rows;		  
		$this->load->view('admin/posp/courses/view', $data);		
    } //end of view functionality
	
	
	public function view_chapters()
	{
		$data=array();
	    $data['title'] = title." | View Chapters";
	    $data['main_heading'] = "Chapters";
	    $data['heading'] = " View Chapters";
	
	
	    if($this->input->post('course_id'))
			 $course_id = $this->input->post('course_id');
		 elseif($this->uri->segment('5'))
			 $course_id=$this->uri->segment('5');
		else
			 $course_id='0';
			 
		if($this->input->post('language_id'))
			 $language_id = $this->input->post('language_id');
		 elseif($this->uri->segment('6'))
			 $language_id=$this->uri->segment('6');
		else
			 $language_id='1';	 
			 
		$results = $this->courses_model->view_chapters($course_id,$language_id);
		  
		$data['results']  = $results;
		$num_rows         = count($results);	
		$data['num_rows'] = $num_rows;	
		
		$data['course_id'] = $course_id;	
		$data['language_id'] = $language_id;		  
		$this->load->view('admin/posp/courses/view_chapters', $data);		
    } //end of view functionality
	
	
	public function view_pages(){	
	
	   $data=array();
	   $data['title'] = title." | Chapter Pages";
	   $data['main_heading'] = "Pages";
	   $data['heading'] = "Chapter Pages";
		
	   //print_r($_POST);	
	    if($this->input->post('language_id'))
			 $language_id = $this->input->post('language_id');
		 elseif($this->uri->segment('5'))
			 $language_id=$this->uri->segment('5');
		else
			 $language_id='1';
		
	     if($this->input->post('chapter_id'))
			 $chapter_id = $this->input->post('chapter_id');
		  elseif($this->uri->segment('6'))
			 $chapter_id=$this->uri->segment('6');
		  else
			 $chapter_id='0'; 
			 
		  if($this->input->post('page_id'))
			 $page_id = $this->input->post('page_id');
		 elseif($this->uri->segment('7'))
			 $page_id=$this->uri->segment('7');
		 else
			 $page_id='0'; 
		
		
		if($this->input->post('per_page'))
			$per_page = $this->input->post('per_page');
		elseif($this->uri->segment('8'))
			$per_page=$this->uri->segment('8');
		else
			$per_page=1;	
			
		$config = array();
		$config["base_url"] = base_url() . "admin/posp/courses/view_pages/".$language_id."/".$chapter_id."/".$page_id."/".$per_page;
		$config["per_page"] = $per_page;
        $config["uri_segment"] = 9;
		$config["total_rows"] =$this->courses_model->count_pages($language_id,$chapter_id,$page_id);
		$this->pagination->initialize($config);
        $page = ($this->uri->segment(9)) ? $this->uri->segment(9) : 0; 
		$data['results'] = $this->courses_model->view_pages($language_id,$chapter_id,$page_id,$config['per_page'], $page);
		$data['links']   = $this->pagination->create_links();
		$data['num_rows'] = $config['total_rows'];	
		
		$data['language_id'] = $language_id;
		$data['languageid'] = $language_id;
		$data['chapter_id'] = $chapter_id;
		$data['page_id'] = $page_id;
		$data['per_page'] = $per_page;
		
		
		//echo "------------>".$language_id;
		/* echo "<pre>"; 	 
		print_r($data);	  
		 echo "</pre>"; */	 
	    $this->load->view('admin/posp/courses/view_pages.php', $data);
		}
		
		
		public function upload_audio_file() {
		  
	   $data['title'] = title." | Upload Audio File";
	   $data['main_heading'] = "Upload Audio File";
	   $data['heading'] = "Upload Audio File";
	   $data['already_msg']="";
	   $data['error']="";
	   $data['err']="";
		
		//print_r($_FILES); 
		$this->form_validation->set_rules('page_id', 'Page', 'trim');
		$this->form_validation->set_rules('audiofile', 'CSV File', 'trim');
		
		 $page_id = $this->input->post('page_id');
		 
		if ($this->form_validation->run()) {
			$data['error'] = '';   
			if($_FILES['audiofile']['error'] != 4){		
			  if(isset($_FILES["audiofile"]["name"]) && ($_FILES["audiofile"]["name"]!=''))
			{	$path_info = pathinfo($_FILES["audiofile"]["name"]);
			$fileExtension = $path_info['extension'];
			$file_name = time(true).$page_id.'.'.$fileExtension ;   
			}
			
			  $this->sdata_path = realpath('assets/static/pospaudios');
			  $config['upload_path'] = $this->sdata_path;
			  $config['allowed_types'] = '*';
			  $config['max_size']	= '500072';
			  $config['overwrite'] = true;			
			  $config['file_name'] =$file_name;
			  $this->upload->initialize($config);
			  if ( ! $this->upload->do_upload('audiofile')){
					$data['error']=$this->upload->display_errors();
					$success = FALSE;
			 }
			 else{
				$data = $this->upload->data('audiofile');	
				/*========== File Upload Script ===========*/
				$file_path =  $this->sdata_path.'/'.$file_name;
				
				if ($file_name!='') {
					
					 $language_id = $this->input->post('languageid');
					
					 $updateresult =  $this->courses_model->update_audio($language_id,$page_id,$file_name);
					 if($updateresult)
					 {
					  $msg = "Audio File has been updated successfully.";	
			   		  $this->session->set_flashdata('success_message', $msg);	
					 }
					 
					
				} else 
				{
                	 $data['error'] = "Error occured";
					 $msg = "There is some error in Update Audio File.";
			   		$this->session->set_flashdata('warning_message', $msg);	
				}
                
            }
				/*========== File Upload Script end ===========*/
				
			 }
		}
		  //print '<pre>'; print_r($data); die;
		  
		
			
	 	 redirect($_SERVER['HTTP_REFERER']);			
		
	}
	
	
	public function play_audio()
	{
		if($this->uri->segment('5'))
			 $page_id=$this->uri->segment('5');
		else
			 $page_id='0';
			 
			 if($page_id=='123456789')
			 $file_name='1627641892.mp3';
			 else
			 $file_name='';
	
		echo $audioFilePath = base_url()."assets/static/pospaudios/".$file_name;

    } //end of view functionality		
	
	

}	
?>