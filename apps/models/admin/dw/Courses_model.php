<?php

class Courses_model extends CI_Model
{
	
	function get_chapters_dropdown($language_id){
		$this->dw=$this->load->database(load_db, TRUE); 
	    $this->dw->select('*');
        $this->dw->from('chapters');
	    $this->dw->order_by('ic38_order', 'ASC');
		//echo $this->dw->last_query();
        $result = $this->dw->get();
        $return = array();
        if ($result->num_rows() > 0) {
            $return[''] = 'Select';
            foreach ($result->result_array() as $row) {
				
				if($language_id>1){
			     $where_cond=array('language_id'=>$language_id,'chapter_id'=>$row['chapter_id']);
				 $chaprow=get_content_translation('chapter_translation','chapter_title',$where_cond,load_db,'dw');
				 if($chaprow!='0'){
					$row['chapter_title']=$chaprow->chapter_title;
				 }
				 unset($chaprow);
			 }
			 
			     $return[$row['chapter_id']] = $row['chapter_title'];
            }
        }
        return $return;
	  }
	  
	  
	  
     function view_courses()
		{
			$this->dw=$this->load->database(load_db, TRUE); 
			$this->dw->select('*');
			$this->dw->from('courses');
			$this->dw->where('is_active','1');
			$this->dw->order_by('short', 'ASC');
			$query = $this->dw->get();
			$result = $query->result();
			foreach ($result as $row) {
				
			 $row->total_chapters= $this->count_chapters($row->course_id);
			}
			return $result;
	
		} //End of View function
		
		
		 function count_chapters($course_id)
   		 {
			$this->dw=$this->load->database(load_db, TRUE); 
			$this->dw->where('course_id', $course_id);
			$this->dw->from('chapters_time');
			$query = $this->dw->get();
			/* echo "--->".$this->dw->last_query();
			echo "<br>";
			echo "<br>";*/
			return $query->num_rows();

  	   } //End of Count function
	   
	   	function view_chapters($course_id,$language_id)
		{
			$this->dw=$this->load->database(load_db, TRUE); 
			$this->dw->select('*');
			$this->dw->from('chapters');
			$this->dw->join('chapters_time', 'chapters_time.chapter_id = chapters.chapter_id');
			if($course_id!='0')
			$this->dw->where('chapters_time.course_id',$course_id);
			$this->dw->group_by('chapters.chapter_id');
			$this->dw->order_by('chapters.ic38_order', 'ASC');
			$query = $this->dw->get();
			//echo $this->dw->last_query();
			$result = $query->result();
			foreach ($result as $row) {
				
			if($language_id>1){
			    $where_cond=array('language_id'=>$language_id,'chapter_id'=>$row->chapter_id);
				$chaprow=get_content_translation('chapter_translation','chapter_title',$where_cond,load_db,'dw');
				if($chaprow!='0'){
					$row->chapter_title=$chaprow->chapter_title;
				}
				unset($chaprow);
			 }
			 
				$row->total_pages= $this->count_chapter_pages($row->chapter_id,$language_id);
			}
			
			/*echo "<pre>";
			print_r($result);
			echo "</pre>";*/
			
			return $result;
	
		} //End of View function
		
	
		 function count_chapter_pages($chapter_id,$language_id)
   		 {
			$this->dw=$this->load->database(load_db, TRUE); 
			if($language_id>1){
			  $this->dw->where('chapter_id', $chapter_id);
			  $this->dw->where('language_id', $language_id);
			  $this->dw->from('pages_translation');
		 	  $query = $this->dw->get();
			
			 return $query->num_rows();
				
			}else
			{
				$this->dw->where('chapter_id', $chapter_id);
				$this->dw->from('pages');
				$query = $this->dw->get();
				
				return $query->num_rows();
			}
			

  	   } //End of Count function
	   
	   
	   
	  function view_pages($language_id,$chapter_id,$page_id,$limit, $start)
      {
		$this->dw=$this->load->database(load_db, TRUE); 
		if($language_id>1){
			
			$this->dw->select('pages_translation.*,pages.page_no');
			$this->dw->join('pages', 'pages.page_id = pages_translation.page_id');
			if($language_id!='0')
			$this->dw->where('pages_translation.language_id', $language_id);
			if($chapter_id!='0')
			$this->dw->where('pages_translation.chapter_id', $chapter_id);
			if($page_id!='0')
			$this->dw->where('pages_translation.page_id', $page_id);
			$this->dw->group_by('pages_translation.page_id'); 
			$this->dw->order_by('pages.page_no','ASC');
			if($limit!=null || $start!=null)
			{
				$this->dw->limit($limit,$start);
			}	
			$this->dw->from('pages_translation');
			$query = $this->dw->get();
		   // echo "--->".$this->dw->last_query();
			$result = $query->result();
		}
		
		else
		{
			$this->dw->select('pages.*,chapters.chapter_title');
			$this->dw->join('chapters', 'chapters.chapter_id = pages.chapter_id');
			if($chapter_id!='0')
			$this->dw->where('pages.chapter_id', $chapter_id);
			if($page_id!='0')
			$this->dw->where('pages.page_id', $page_id);
			$this->dw->group_by('pages.page_id'); 
			$this->dw->order_by('pages.page_no','ASC');
			if($limit!=null || $start!=null)
			{
				$this->dw->limit($limit,$start);
			}	
			$this->dw->from('pages');
			$query = $this->dw->get();
		  // echo "--->".$this->dw->last_query();
			$result = $query->result();
		}
		/*echo "<pre>";
		print_r($result);
		echo "</pre>";*/
       
        return $result;

    } //End of View  function
	

	
	function count_pages($language_id,$chapter_id,$page_id) {
		
		$this->dw=$this->load->database(load_db, TRUE); 
		if($language_id>1){
			$this->dw->join('pages', 'pages.page_id = pages_translation.page_id');
			if($language_id!='0')
			$this->dw->where('pages_translation.language_id', $language_id);
			if($chapter_id!='0')
			$this->dw->where('pages_translation.chapter_id', $chapter_id);
			if($page_id!='0')
			$this->dw->where('pages_translation.page_id', $page_id);
			$this->dw->group_by('pages_translation.page_id'); 
			$this->dw->from('pages_translation');
			$query = $this->dw->get();
		  // echo "--->".$this->dw->last_query();
			return $query->num_rows();
		}
		else
		{
			$this->dw->select('pages.*,chapters.chapter_title');
			$this->dw->join('chapters', 'chapters.chapter_id = pages.chapter_id');
			if($chapter_id!='0')
			$this->dw->where('pages.chapter_id', $chapter_id);
			if($page_id!='0')
			$this->dw->where('pages.page_id', $page_id);
			$this->dw->group_by('pages.page_id');  
			$query=$this->dw->get('pages');		
			//echo "--------------------->". $this->dw->last_query();	   
			return $query->num_rows();
		}
			
		}     //End of Count function
		
	
		
		function update_audio($language_id,$page_id,$file_name)
		{ 
		 $this->dw=$this->load->database(load_db, TRUE); 
		 if($language_id>1)
		  {
			  $data = array(
					'audio_file_name'   => $file_name,
				);
				$this->dw->where('page_translation_id', $page_id);
				$result = $this->dw->update('pages_translation', $data);
		  }
		  else
		   {
				$data = array(
					'audio_file_name'   => $file_name,
				);
				$this->dw->where('page_id', $page_id);
				$result = $this->dw->update('pages', $data);
		   }
			if($result)
			  return 1;
			  else
			 return 0; 
			  
			
		} //End of Update User function

	
}