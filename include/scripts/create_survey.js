
var Create_Survey = function() {
	var handleValidation_create_survey_form = function() {
		// for more info visit the official plugin documentation: 
		// http://docs.jquery.com/Plugins/Validation

		var form1 = $('#createSurveyForm');
		var error1 = $('.alert-error', form1);

		form1.validate({
			errorElement: 'span', //default input error message container
			errorClass: 'help-inline', // default input error message class
			focusInvalid: false, // do not focus the last invalid input
			ignore: "",
			rules: {
				createSurveyTitle: {
					required: true
				}
			},
			messages: {
				createSurveyTitle: {
					required: "Survey Title is required."
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
				var baseUrl = $('#base_url').val();
				var titleStr = $('#createSurveyTitle').val();
				var langStr = $('#languages_select').val();
				if (titleStr !== '') {
					var url = baseUrl + "index.php/create_survey/create";
					$.post(url, {title: titleStr, lang: langStr}, function(response) {
						window.location.href = baseUrl + "index.php/surveyedit/index/" + response;
					});
				}
			}
		});
	};

	var handleValidation_copy_survey_form = function() {
		// for more info visit the official plugin documentation: 
		// http://docs.jquery.com/Plugins/Validation

		var form1 = $('#copySurveyForm');
		var error1 = $('.alert-error', form1);

		form1.validate({
			errorElement: 'span', //default input error message container
			errorClass: 'help-inline', // default input error message class
			focusInvalid: false, // do not focus the last invalid input
			ignore: "",
			rules: {
				copySurveyTitle: {
					required: true
				},
				survey_select: {
					required: true
				}
			},
			messages: {
				copySurveyTitle: {
					required: "Survey Title is required."
				},
				survey_select: {
					required: "Survey is required."
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
				var baseUrl = $('#base_url').val();
				var surveyStr = $('#survey_select').val();
				var titleStr = $('#copySurveyTitle').val();
				if (titleStr !== '') {
					var url = baseUrl + "index.php/create_survey/copy";
					$.post(url, {title: titleStr, survey: surveyStr}, function(response) {
						window.location.href = baseUrl + "index.php/surveyedit/index/" + response;
					});
				}

			}
		});
	};

	return {
		init: function() {
			handleValidation_create_survey_form();
			handleValidation_copy_survey_form();

			$(".btn_dash").removeClass("active");
			$(".btn_dash > span").removeClass("selected");
			$(".btn_survey").addClass("active");
			$(".btn_survey > span").addClass("selected");

		}
	};
}();
