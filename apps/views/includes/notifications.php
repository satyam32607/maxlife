<div class="portlet-body">
	<?php if ($this->session->flashdata('success_message')): ?>
     <div class="alert alert-success">
        <strong>Success!</strong> <?php echo $this->session->flashdata('success_message'); ?> 
        <button class="close" data-dismiss="alert">x</button>
      </div>
     <?php endif; ?>
        
    <?php if ($this->session->flashdata('warning_message')): ?>    
    <div class="alert alert-warning">
        <strong>Warning!</strong> <?php echo $this->session->flashdata('warning_message'); ?>
         <button class="close" data-dismiss="alert"> ×  </button>
         </div>
     <?php endif; ?>
     
	</div>
    
 