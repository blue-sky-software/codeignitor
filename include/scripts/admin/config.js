var MyConfig = function() {


	var handleValidation_config = function() {
		// for more info visit the official plugin documentation: 
		// http://docs.jquery.com/Plugins/Validation

		var form1 = $('#config_form');
		var error1 = $('.alert-error', form1);

		$.validator.addMethod(
				"message_content_check",
				function(value, element) {
					if (value.indexOf("[NAME]") === -1) {
						return false;
					} else {
						return true;
					}
				},
				"[NAME] symbols is required."
				);

		form1.validate({
			errorElement: 'span', //default input error message container
			errorClass: 'help-inline', // default input error message class
			focusInvalid: false, // do not focus the last invalid input
			ignore: "",
			rules: {
				subject: {
					required: true
				},
				message: {
					required: true,
					message_content_check: true
				},
				p1: {
					required: true,
					number: true
				},
				p2: {
					required: true,
					number: true
				}
			},
			invalidHandler: function(event, validator) { //display error alert on form submit              
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
				form.submit();
			}
		});
	};


	return {
		init: function() {

			handleValidation_config();

			$(".btn_usermanage").removeClass("active");
			$(".btn_usermanage > span").removeClass("selected");
			$(".btn_surveymanage").removeClass("active");
			$(".btn_surveymanage > span").removeClass("selected");
			$(".btn_config").addClass("active");
			$(".btn_config > span").addClass("selected");

			refreshSurveys();
		}
	};


	function refreshSurveys() {

	}


}();
