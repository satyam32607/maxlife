var FormValidation = function () {

    // basic validation
    var roleValidation = function() {
        // for more info visit the official plugin documentation: 
            // http://docs.jquery.com/Plugins/Validation

            var form1 = $('#role_form');
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
                rules: {
                    role_name: {
                        required: true
                    },
                    role_rights: {
                        required: true,
                        minlength: 1,
                    }
                },

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


    }
	
	 var companyValidation = function() {
        // for more info visit the official plugin documentation: 
            // http://docs.jquery.com/Plugins/Validation

            var form1 = $('#comp_form');
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
                rules: {
                    comp_name: {
                        required: true
                    },
                    email: {
                        required: true,
                        email: true
                    },
					 userpass: {
                        required: true
                    },
					 compass: {
                        required: true
                    },
					 mobile_no: {
                       required: true,
                        number: true,
						minlength: 10,
                        maxlength: 15
                    },
					alternate_email: {
                        email: true
                    },
					 std_code: {
                        number: true,
                        maxlength: 8
                    },
					 time_zone	: {
                        required: true
                    },
					 country_id	: {
                        required: true
                    },
					 state_id	: {
                        required: true
                    },
					 city_id	: {
                        required: true
                    },
					 pincode: {
                       required: true,
                        number: true,
						minlength: 4,
                        maxlength: 8
                    },
					 address: {
                       required: true,
						minlength: 3,
                    },
					 role_rights: {
                        required: true,
                        minlength: 1,
                    }
                },

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


    }

    return {
        //main function to initiate the module
        init: function () {

            roleValidation();
            companyValidation();
           // handleValidation3();

        }

    };

}();

jQuery(document).ready(function() {
    FormValidation.init();
});