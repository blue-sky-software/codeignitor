var GetAnswer = function() {

	var hasErrors = false;

	var handleValidation = function() {
		$('.errorMsg').remove();

		$('.Question').each(function(index, element) {

			var qid = $(this).attr('qid');
			var seqno = $(this).attr('seqno');
			var qtid = $(this).attr('qtid');
			var id = $(this).attr('id');		// Question76
			var error_msg = $(this).find('myinfo').attr('error_msg');
			if (error_msg) {

				switch (qtid)
				{
					case '1':
						validate_multi_answer_one_answer(id, error_msg);
						break;
					case '2':
						validate_multi_answer_multi_answer(id, error_msg);
						break;
					case '3':
						validate_essaybox(id, error_msg);
						break;
					case '4':
						validate_ranking(id, error_msg);
						break;
					case '5':
						validate_matrix_choice_one_answer(id, error_msg);
						break;
					case '6':
						validate_matrix_choice_multi_answer(id, error_msg);
						break;
					case '7':
						validate_matrix_textbox(id, error_msg);
						break;
					case '8':
						validate_matrix_dropdown(id, error_msg);
						break;
					case '9':
						validate_single_textbox(id, error_msg);
						break;
					case '10':
						validate_multi_textbox(id, error_msg);
						break;
					case '11':
						break;
					case '12':
						validate_datetime_box(id, error_msg);
						break;
				}
			}
		});
	};

	var validate_multi_answer_one_answer = function(id, error_msg) {
		var errorOccured = false;

		var checked_cnt = $('#' + id).find('input:checked').length;
		if (checked_cnt == 0)
			errorOccured = true;

		if (errorOccured === true) {
			hasErrors = true;
			$('#' + id).prepend('<div class="errorMsg" id="">' + error_msg + '</div>');
		}
	};

	var validate_multi_answer_multi_answer = function(id, error_msg) {
		var errorOccured = false;

		var checked_cnt = $('#' + id).find('input:checked').length;
		if (checked_cnt == 0)
			errorOccured = true;

		if (errorOccured === true) {
			hasErrors = true;
			$('#' + id).prepend('<div class="errorMsg">' + error_msg + '</div>');
		}
	};
	
	var validate_essaybox = function(id, error_msg) {

		errorOccured = false;

		var text = $('#' + id + ' textarea').val();

		if (text === '') {
			hasErrors = true;
			$('#' + id).prepend('<div class="errorMsg">' + error_msg + '</div>');
			return;
		}

		var from = $('#' + id + ' formatinfo').attr('from');
		var to = $('#' + id + ' formatinfo').attr('to');

		switch ($('#' + id + ' formatinfo').attr('format')) {
			case 'email' :
				if (!check_email_format(text)) {
					errorOccured = true;
					error_msg = $('#' + id + ' formatinfo').attr('error_msg');
				}
				break;
			case 'number' :
				if (!check_number_format(text, from, to)) {
					errorOccured = true;
					error_msg = $('#' + id + ' formatinfo').attr('error_msg');
				}
				break;
			case 'textlength' :
				if (!check_textlength_format(text, from, to)) {
					errorOccured = true;
					error_msg = $('#' + id + ' formatinfo').attr('error_msg');
				}
				break;
			case 'wordcount' :
				if (!check_wordcount_format(text, from, to)) {
					errorOccured = true;
					error_msg = $('#' + id + ' formatinfo').attr('error_msg');
				}
				break;
			default :
				break;

		}

		if (errorOccured === true) {
			hasErrors = true;
			$('#' + id).prepend('<div class="errorMsg">' + error_msg + '</div>');
		}
	};

	var validate_ranking = function(id, error_msg) {
		var errorOccured = false;

		var firstVal = $('#' + id).find('select').eq(0).val();
		if (!firstVal)
			errorOccured = true;

		if (errorOccured === true) {
			hasErrors = true;
			$('#' + id).prepend('<div class="errorMsg">' + error_msg + '</div>');
		}
	};

	var validate_matrix_choice_one_answer = function(id, error_msg) {
		var errorRequireAnswer = false;
		var errorOnlyOnePerColumn = false;

		var onlyOnePerColumn = ($('#' + id).find('onlyonepercolumn').length > 0) ? true : false;

		if (!onlyOnePerColumn) {	// "Allow only one response per column" UnSetted
			$('#' + id + ' tr').each(function(index) {
				if (index === 0) {
					return;
				}
				if ($(this).find('input:checked').length === 0) {
					errorRequireAnswer = true;
					return false;
				}
			});
		} else {	// "Allow only one response per column" Setted
			var col_cnt = $('#' + id + ' tr').eq(1).find('td').length - 1;
			for (var i = 0; i < col_cnt; i++) {
				if (count_selected_in_column(id, i) !== 1) {
					errorOnlyOnePerColumn = true;
					break;
				}
			}
		}

		if (errorRequireAnswer === true) {
			hasErrors = true;
			$('#' + id).prepend('<div class="errorMsg">' + error_msg + '</div>');
		}
		if (errorOnlyOnePerColumn === true) {
			hasErrors = true;
			$('#' + id).prepend('<div class="errorMsg">' + 'Allowed only one response per column. Please re-select.' + '</div>');
		}

		function count_selected_in_column(id, col_index) {
			var is_exist = false;
			var cnt = 0;
			$('#' + id + ' tr').each(function(index) {
				if (index === 0) {
					return;
				}
				if ($(this).find('td').eq(col_index + 1).find('input:checked').length > 0) {
					cnt++;
				}
			});
			return cnt;
		}
	};

	var validate_matrix_choice_multi_answer = function(id, error_msg) {
		var errorRequireAnswer = false;

		$('#' + id + ' tr').each(function(index) {
			if (index === 0) {
				return;
			}
			if ($(this).find('input:checked').length === 0) {
				errorRequireAnswer = true;
				return false;
			}
		});

		if (errorRequireAnswer === true) {
			hasErrors = true;
			$('#' + id).prepend('<div class="errorMsg">' + error_msg + '</div>');
		}
	};

	var validate_matrix_textbox = function(id, error_msg) {
		var errorRequireAnswer = false;

		$('#' + id + ' tr').each(function(index) {
			if (index === 0) {
				return;
			}
			$(this).find('input').each(function() {
				if ($(this).val() === '') {
					errorRequireAnswer = true;
					return false;
				}
			});
			if (errorRequireAnswer === true) {
				return false;
			}
		});

		if (errorRequireAnswer === true) {
			hasErrors = true;
			$('#' + id).prepend('<div class="errorMsg">' + error_msg + '</div>');
		}
	};

	var validate_matrix_dropdown = function(id, error_msg) {
		var errorRequireAnswer = false;

		$('#' + id + ' tr').each(function(index) {
			if (index === 0) {
				return;
			}
			$(this).find('select').each(function() {
				if ($(this).val() === '') {
					errorRequireAnswer = true;
					return false;
				}
			});
			if (errorRequireAnswer === true) {
				return false;
			}
		});

		if (errorRequireAnswer === true) {
			hasErrors = true;
			$('#' + id).prepend('<div class="errorMsg">' + error_msg + '</div>');
		}
	};

	var validate_single_textbox = function(id, error_msg) {

		errorOccured = false;

		var text = $('#' + id + ' input').val();

		if (text === '') {
			hasErrors = true;
			$('#' + id).prepend('<div class="errorMsg">' + error_msg + '</div>');
			return;
		}

		var from = $('#' + id + ' formatinfo').attr('from');
		var to = $('#' + id + ' formatinfo').attr('to');

		switch ($('#' + id + ' formatinfo').attr('format')) {
			case 'email' :
				if (!check_email_format(text)) {
					errorOccured = true;
					error_msg = $('#' + id + ' formatinfo').attr('error_msg');
				}
				break;
			case 'number' :
				if (!check_number_format(text, from, to)) {
					errorOccured = true;
					error_msg = $('#' + id + ' formatinfo').attr('error_msg');
				}
				break;
			case 'textlength' :
				if (!check_textlength_format(text, from, to)) {
					errorOccured = true;
					error_msg = $('#' + id + ' formatinfo').attr('error_msg');
				}
				break;
			case 'wordcount' :
				if (!check_wordcount_format(text, from, to)) {
					errorOccured = true;
					error_msg = $('#' + id + ' formatinfo').attr('error_msg');
				}
				break;
			default :
				break;

		}

		if (errorOccured === true) {
			hasErrors = true;
			$('#' + id).prepend('<div class="errorMsg">' + error_msg + '</div>');
		}
	};

	var validate_multi_textbox = function(id, error_msg) {

		errorOccured = false;

		$('#' + id + ' input').each(function() {

			var text = $(this).val();

			if (text === '') {
				hasErrors = true;
				$('#' + id).prepend('<div class="errorMsg">' + error_msg + '</div>');
				return false;
			}
		});

		if (hasErrors == true) {
			return;
		}


		var from = $('#' + id + ' formatinfo').attr('from');
		var to = $('#' + id + ' formatinfo').attr('to');

		switch ($('#' + id + ' formatinfo').attr('format')) {
			case 'email' :
				$('#' + id + ' input').each(function() {
					var text = $('#' + id + ' input').val();
					if (!check_email_format(text)) {
						errorOccured = true;
						error_msg = $('#' + id + ' formatinfo').attr('error_msg');
					}
				});

				break;
			case 'number' :
				$('#' + id + ' input').each(function() {
					var text = $('#' + id + ' input').val();
					if (!check_number_format(text, from, to)) {
						errorOccured = true;
						error_msg = $('#' + id + ' formatinfo').attr('error_msg');
					}
				});
				break;
			case 'textlength' :
				$('#' + id + ' input').each(function() {
					var text = $('#' + id + ' input').val();
					if (!check_textlength_format(text, from, to)) {
						errorOccured = true;
						error_msg = $('#' + id + ' formatinfo').attr('error_msg');
					}
				});
				break;
			case 'wordcount' :
				$('#' + id + ' input').each(function() {
					var text = $('#' + id + ' input').val();
					if (!check_wordcount_format(text, from, to)) {
						errorOccured = true;
						error_msg = $('#' + id + ' formatinfo').attr('error_msg');
					}
				});
				break;
			default :
				break;

		}

		if (errorOccured === true) {
			hasErrors = true;
			$('#' + id).prepend('<div class="errorMsg">' + error_msg + '</div>');
		}
	};

	function check_email_format(email) {
		var emailReg = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
		return emailReg.test(email);
	}

	function check_number_format(text, from, to) {
		if ((parseInt(text) >= parseInt(from)) && (parseInt(text) <= parseInt(to)))
			return true;
		else
			return false;
	}

	function check_textlength_format(text, from, to) {
		if ((text.length >= parseInt(from)) && (text.length <= parseInt(to)))
			return true;
		else
			return false;
	}

	function check_wordcount_format(text, from, to) {
		var tmp = text.replace(/(^\s*)|(\s*$)/gi, "");		// trim
		tmp = tmp.replace(/ +(?= )/g, '');				// replace multi-space into one-space
		var tmpA = tmp.split(" ");
		if ((tmpA.length >= from) && (tmpA.length <= to))
			return true;
		else
			return false;
	}

	var validate_datetime_box = function(id, error_msg) {
		var errorRequireAnswer = false;

		$('#' + id + ' tr').each(function(index) {
			if (index === 0) {
				return;
			}
			$(this).find('input').each(function() {
				if ($(this).val() === '') {
					errorRequireAnswer = true;
					return false;
				}
			});
			if (errorRequireAnswer === true) {
				return false;
			}
		});

		if (errorRequireAnswer === true) {
			hasErrors = true;
			$('#' + id).prepend('<div class="errorMsg">' + error_msg + '</div>');
		}
	};

	var handleDatePickers = function() {

		if (jQuery().datepicker) {
			$('.date-picker').datepicker({
				rtl: App.isRTL()
			});
		}
	}

	var handleTimePickers = function() {

		if (jQuery().timepicker) {
			$('.timepicker-default').timepicker();
		}
	}

	var handleValidation_save_continue_dlg = function() {
		// for more info visit the official plugin documentation: 
		// http://docs.jquery.com/Plugins/Validation

		var form1 = $('#save_continue_form');
		var error1 = $('.alert-error', form1);

		form1.validate({
			errorElement: 'span', //default input error message container
			errorClass: 'help-inline', // default input error message class
			focusInvalid: false, // do not focus the last invalid input
			ignore: "",
			rules: {
				email: {
					required: true,
					email: true
				}
			},
			messages: {
				createSurveyTitle: {
					required: "email is required."
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
		//main function to initiate the module
		init: function() {

			$('#nextBtn').click(function() {
				hasErrors = false;

				handleValidation();

				if (hasErrors === false)
					$('#answer_form').submit();
			});

			$('#saveBtn').click(function() {
				//alert();
			});

			handleDatePickers();
			handleTimePickers();
			handleValidation_save_continue_dlg();
			
			var total_page = $('#total_page').val();
			var page_no = $('#page_no').val();
			var percent = page_no / total_page * 100;
			$('#bar .bar').css({
				width: percent + '%'
			});
		}
	};
}();