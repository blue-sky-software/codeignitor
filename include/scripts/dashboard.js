var Dashboard = function() {

	var handleValidation = function() {
		// for more info visit the official plugin documentation: 
		// http://docs.jquery.com/Plugins/Validation

		var form1 = $('#changePasswordForm');
		var error1 = $('.alert-error', form1);
		var success1 = $('.alert-success', form1);

		form1.validate({
			errorElement: 'span', //default input error message container
			errorClass: 'help-inline', // default input error message class
			focusInvalid: false, // do not focus the last invalid input
			ignore: "",
			rules: {
				oldPassword: {
					required: true
				},
				newPassword: {
					required: true
				},
				confirmPassword: {
					equalTo: "#newPassword"
				}
			},
			invalidHandler: function(event, validator) { //display error alert on form submit              
				success1.hide();
				error1.show();
				App.scrollTo(error1, -200);
			},
			highlight: function(element) { // hightlight error inputs
				$(element)
						.closest('.help-inline').removeClass('ok'); // display OK icon
				$(element)
						.closest('.control-group').removeClass('success').addClass('error'); // set error class to the control group
			},
			unhighlight: function(element) { // revert the change done by hightlight
				$(element)
						.closest('.control-group').removeClass('error'); // set error class to the control group
			},
			success: function(label) {
				label
						.addClass('valid').addClass('help-inline ok') // mark the current input as valid and display OK icon
						.closest('.control-group').removeClass('error').addClass('success'); // set success class to the control group
			},
			submitHandler: function(form) {
				var url = $('#base_url').val() + "index.php/auth/is_valid_password";
				var oldPass = $('#oldPassword').val();
				$.post(url, {"data": oldPass}, function(response) {
					if (response === "true") {
						success1.show();
						error1.hide();
						form.submit();
					} 
					else
					{
						error1.show();
						success1.hide();
					}
				});
			}
		});
	};

	return {
		//main function to initiate the module
		init: function() {
			handleValidation();
		}
	};
}();