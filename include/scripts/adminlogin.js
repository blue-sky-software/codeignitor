var Login = function() {

	var handleLogin = function() {
		$('.login-form').validate({
			errorElement: 'label', //default input error message container
			errorClass: 'help-inline', // default input error message class
			focusInvalid: false, // do not focus the last invalid input
			rules: {
				email: {
					required: true,
				},
				password: {
					required: true
				}
			},
			messages: {
				email: {
					required: "Admin Account is required1."
				},
				password: {
					required: "Password is required2."
				}
			},
			invalidHandler: function(event, validator) { //display error alert on form submit   
				$('.alert-error', $('.login-form')).show();
			},
			highlight: function(element) { // hightlight error inputs
				$(element)
						.closest('.control-group').addClass('error'); // set error class to the control group
			},
			success: function(label) {
				label.closest('.control-group').removeClass('error');
				label.remove();
			},
			errorPlacement: function(error, element) {
				error.addClass('help-small no-left-padding').insertAfter(element.closest('.input-icon'));
			},
			submitHandler: function(form) {
				form.submit();
			}
		});

		$('.login-form input').keypress(function(e) {
			if (e.which == 13) {
				if ($('.login-form').validate().form()) {
					$('.login-form').submit();
				}
				return false;
			}
		});

		$('#refreshCaptcha').click(function() {
			var baseUrl = $('#base_url').val();
			$.post(baseUrl + "index.php/auth/j_refresh_captcha", function(img) {
				$('#div_captcha img').remove();
				$('#div_captcha').prepend(img);
			});
			return false;
		});
	}



	return {
		//main function to initiate the module
		init: function() {

			handleLogin();
		}

	};

}();