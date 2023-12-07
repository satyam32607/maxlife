<!-- BEGIN CONTAINER -->
<div class="page-container">
	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
	<!-- BEGIN CONTENT BODY -->

	</div>
	<!-- END CONTENT -->
    
    <?php
	$access_url='';
	if($this->uri->segment(1)!='')
	$access_url .= trim($this->uri->segment(1));
	if($this->uri->segment(2)!='')
	$access_url .= '/'.trim($this->uri->segment(2));  
	if($this->uri->segment(3)!='')
	$access_url .= '/'.trim($this->uri->segment(3));
	$url = $_SERVER['HTTP_HOST'].'/' . $access_url;
	$query_str = $_SERVER['QUERY_STRING'];
			  
	if($query_str)
	$query_str="?".$query_str;
	if(!preg_match("/ajaxrequest/i", $url))
	{	 $hit_url = $url . $query_str;
	
	
		 /*$hit_data =array( 
		        'IPP' => $_SERVER['REMOTE_ADDR'],
				'status' => 'crm',
				'user_id' => $this->session->userdata('user_id'),
				'user_type' => $this->session->userdata('user_type'),
				'page_url' => $_SERVER['PHP_SELF'],
				'module_name' => $module_name,
				'hit_url' => $hit_url,
				'hit_datetime' => date('Y-m-d H:i:s')
			 );	
			 $result= $this->db->insert('site_hits',$hit_data);	*/
	}
	?>
	<!-- BEGIN QUICK SIDEBAR -->
	<a href="javascript:;" class="page-quick-sidebar-toggler">
		<i class="icon-login"></i>
	</a>
	
	
</div>
<!-- END CONTAINER -->
      
<!-- This div will allow the modal to appear on the screen  -->
<div  class="modal1 fade" tabindex="-1" data-width="780"> </div>
<!-- responsive -->
<div class="page-wrapper-row">
                <div class="page-wrapper-bottom">
                    <!-- BEGIN FOOTER -->
                   
                    <!-- BEGIN INNER FOOTER -->
                    <div class="page-footer">
                        <div class="container">
                        	<div class="row">
                            	<div class="col-md-4">
                                	<address>Phone: <span class="font-green-steel">999 999 9999</span> &nbsp; | &nbsp; Email:
                                        <a href="mailto:<?php echo infoemail; ?>" class="font-green-steel"><?php echo infoemail; ?></a>
                                    </address>
                                </div>
                                <div class="col-md-4 btm-social">
                            		<ul class="social-icons">
                                        <li>
                                            <a href="javascript:;" data-original-title="rss" class="rss"></a>
                                        </li>
                                        <li>
                                            <a href="javascript:;" data-original-title="facebook" class="facebook"></a>
                                        </li>
                                        <li>
                                            <a href="javascript:;" data-original-title="twitter" class="twitter"></a>
                                        </li>
                                        <li>
                                            <a href="javascript:;" data-original-title="googleplus" class="googleplus"></a>
                                        </li>
                                        <li>
                                            <a href="javascript:;" data-original-title="linkedin" class="linkedin"></a>
                                        </li>
                                        <li>
                                            <a href="javascript:;" data-original-title="youtube" class="youtube"></a>
                                        </li>
                                        <li>
                                            <a href="javascript:;" data-original-title="vimeo" class="vimeo"></a>
                                        </li>
                                    </ul>
                                </div>
                            	<div class="col-md-4 copyright">
                         			<?php echo date('Y'); ?> &copy; <?php echo company_name; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="scroll-to-top">
                        <i class="icon-arrow-up"></i>
                    </div>
                    <!-- END INNER FOOTER -->
                    <!-- END FOOTER -->
                </div>
            </div>
            