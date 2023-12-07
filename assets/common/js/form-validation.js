var get_fields=allfields;
var myarray = []; 
var function_name=form_id+'_validation';
var FormValidation1 = function () {
	 function function_name(){
        // for more info visit the official plugin documentation: 
            // http://docs.jquery.com/Plugins/Validation
            var form1 = $('#'+form_id);
            var error1 = $('.alert-danger', form1);
            var success1 = $('.alert-success', form1);
            form1.validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore: "",  // validate all fields including form hidden input
                messages: {
                    select_multi: {
                        maxlength: jQuery.validator.format("Max {0} items allowed for selection"),
                        minlength: jQuery.validator.format("At least {0} items must be selected")
                    }
                },
				
				/* rules: {
				jQuery.each( get_fields, function( i, val ) {
					var fieldtype=val.field_type;
					var fieldname=val.form_key;
					if(val.required){
						var required=true;
					}else{
						var required=false;
					}
					if(fieldtype=='email'){
						fieldname: {
							required: required,
							email: true
						},
					}
					if(fieldtype=='radio'){
						alert
						fieldname: {
							required: required,
							email: true
						},
					}
				}); 
				},  */
               
                invalidHandler: function (event, validator) { //display error alert on form submit              
                    success1.hide();
                    error1.show();
                    App.scrollTo(error1, -200);
                },

                errorPlacement: function (error, element) { // render error placement for each input type
                    var cont = $(element).parent('.input-group');
                    if (cont.size() > 0) {
                        cont.after(error);
                    } else {
                        element.after(error);
                    }
                },

                highlight: function (element) { // hightlight error inputs

                    $(element)
                        .closest('.form-group').addClass('has-error'); // set error class to the control group
                },

                unhighlight: function (element) { // revert the change done by hightlight
                    $(element)
                        .closest('.form-group').removeClass('has-error'); // set error class to the control group
                },

                success: function (label) {
                    label
                        .closest('.form-group').removeClass('has-error'); // set success class to the control group
                },

                submitHandler: function (form) {
                    success1.show();
                    error1.hide();
					$("#submit_btn").hide();
					page_loader();
					form[0].submit();
                }
            });
			jQuery.each( get_fields, function( i, val ) {
					var minlength_val='3';
					var maxlength_val='100';
					var fieldtype=val.field_type;
					var fieldname=val.form_key;
					if(val.minlength){
						var minlength_val=val.minlength;
						var maxlength_val=val.maxlength;
					}
					if(val.required){
						var required_field=true;
					}else{
						var required_field=false;
					}
					if(fieldtype=='email'){
						$('#'+fieldname).rules('add', {
							required: required_field, email: true
						});
					}
					 if(fieldtype=='number'){
						$('#'+fieldname).rules('add', {
							required: required_field, digits: true,minlength:minlength_val,maxlength:maxlength_val,
						
						});
					}
					 if(fieldtype=='radios'){
						$('.'+fieldname).rules('add', {
							required: required_field
						});
					}
					if(fieldtype=='checkboxes'){
						$('.'+fieldname).rules('add', {
							required: required_field
						});
					}
					if(fieldtype=='input'){
						$('#'+fieldname).rules('add', {
							minlength: minlength_val,
							maxlength: maxlength_val,
						});
					}
			});  
			 

    }
	return {
        //main function to initiate the module
        init: function () {
            function_name();
        }
	}
}();
jQuery(document).ready(function(){
	FormValidation1.init();
}); 