
<div class="hor-menu">
    <ul class="nav navbar-nav">
    
    <li class="hidden-sm hidden-xs">
        	<span  style="padding:0; margin-right:15px;"><img src="<?php echo base_url(); ?>assets/layouts/layout3/img/logo.png" alt="<?php echo company_name; ?>" title="<?php echo company_name; ?>" class="logo-default"></span>
    </li>
    
  
                                        
    <li aria-haspopup="true">
        <a href="<?php echo base_url(); ?>users/dashboard"> <i class="fa fa-home"></i> Dashboard</a>
    </li>
    
     <li aria-haspopup="true">
        <a href="#"> <i class="fa fa-user"></i> My Profile</a>
    </li>
           
     <li aria-haspopup="true">
        <a href="javascript:void(0);" onClick="trainingaccess();" > <i class="fa fa-certificate"></i> Training</a>
    </li> 
    
     <li aria-haspopup="true">
        <a href="<?php echo base_url(); ?>logout"> <i class="fa fa-user"></i> Logout</a>
    </li>      
	 
    </ul>

</div>

<script type="text/javascript">

function trainingaccess()
{
  window.location = 'https://oliveedu.com/hdfclife/users/training/access';
  return false;
} 
</script>
