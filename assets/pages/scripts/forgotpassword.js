var ForgotPassword = function() {

    var handleForgot = function() {

        $('.forget-form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            rules: {
                email: {
                    required: true,
					 email: true
                },
            },

            messages: {
                email: {
                    required: "Email is required."
                }
            },

            invalidHandler: function(event, validator) { //display error alert on form submit   
                $('.alert-danger', $('.forget-form')).show();
            },

            highlight: function(element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            success: function(label) {
                label.closest('.form-group').removeClass('has-error');
                label.remove();
            },

            errorPlacement: function(error, element) {
                error.insertAfter(element.closest('.input-icon'));
            },

            submitHandler: function(form) {
                form.submit(); // form validation success, call ajax form submit
            }
        });

        $('.forget-form input').keypress(function(e) {
            if (e.which == 13) {
                if ($('.forget-form').validate().form()) {
                    $('.forget-form').submit(); //form validation success, call ajax form submit
                }
                return false;
            }
        });

        $('#forget-password').click(function(){
            $('.forget-form').hide();
            $('.forget-form').show();
        });

        $('#back-btn').click(function(){
            $('.forget-form').show();
            $('.forget-form').hide();
        });
    }

 
  

    return {
        //main function to initiate the module
        init: function() {

            handleForgot();

            // init background slide images
            $('.login-bg').backstretch([
                "assets/pages/img/login/bg1.jpg",
                "assets/pages/img/login/bg2.jpg",
                "assets/pages/img/login/bg3.jpg"
                ], {
                  fade: 1000,
                  duration: 8000
                }
            );

            //$('.forget-form').hide();

        }

    };

}();

jQuery(document).ready(function() {
    ForgotPassword.init();
});