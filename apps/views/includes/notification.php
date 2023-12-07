<div class="portlet-body">

 <?php if ($this->session->flashdata('success_message')): ?>
 <div class="alert alert-success alert-dismissible fade show">
     <button type="button" class="close" data-dismiss="alert">&times;</button>
     <strong>Success!</strong>  <?php echo $this->session->flashdata('success_message'); ?> 
  </div>
    <?php endif; ?>  
    
  <?php if ($this->session->flashdata('warning_message')): ?>
  <div class="alert alert-warning alert-dismissible fade show">
     <button type="button" class="close" data-dismiss="alert">&times;</button>
     <strong>Warning!</strong>  <?php echo $this->session->flashdata('warning_message'); ?> 
  </div>
    <?php endif; ?>
    
    
   <?php if ($msg): ?>
  <div class="alert alert-warning alert-dismissible fade show">
     <button type="button" class="close" data-dismiss="alert">&times;</button>
     <strong>Warning!</strong>  <?php echo $msg; ?> 
  </div>
    <?php endif; ?>
    
 </div>
    
 