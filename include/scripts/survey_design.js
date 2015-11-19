var SurveyDesign = function() {

	var handleValidation_welcome_dialog = function() {
		// for more info visit the official plugin documentation: 
		// http://docs.jquery.com/Plugins/Validation

		var form1 = $('#welcome_form');
		var error1 = $('.alert-error', form1);

		form1.validate({
			errorElement: 'span', //default input error message container
			errorClass: 'help-inline', // default input error message class
			focusInvalid: false, // do not focus the last invalid input
			ignore: "",
			rules: {
				title: {
					required: true
				}
			},
			messages: {
				title: {
					required: "Heading Text  is required."
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
				var titleStr = $('#welcome_form #title').val();
				var descStr = $('#welcome_form #content').val();
				var url = $('#base_url').val() + "index.php/surveyedit/welcome/" + $('#survey_id').val();
				$.post(
						url,
						{title: titleStr, desc: descStr},
				function(response) {
					selfRedirect();
				}
				);

			}
		});
	};

	var handleValidation_thankyou_dialog = function() {
		// for more info visit the official plugin documentation: 
		// http://docs.jquery.com/Plugins/Validation

		var form1 = $('#thankyou_form');
		var error1 = $('.alert-error', form1);

		form1.validate({
			errorElement: 'span', //default input error message container
			errorClass: 'help-inline', // default input error message class
			focusInvalid: false, // do not focus the last invalid input
			ignore: "",
			rules: {
				title: {
					required: true
				}
			},
			messages: {
				title: {
					required: "Heading Text  is required."
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
				var titleStr = $('#thankyou_form #title').val();
				var descStr = $('#thankyou_form #content').val();
				var url = $('#base_url').val() + "index.php/surveyedit/thankyou/" + $('#survey_id').val();
				$.post(
						url,
						{title: titleStr, desc: descStr},
				function(response) {
					selfRedirect();
				}
				);

			}
		});
	};

	var handleValidation_page_dialog = function() {
		// for more info visit the official plugin documentation: 
		// http://docs.jquery.com/Plugins/Validation

		var form1 = $('#pageDlgForm');
		var error1 = $('.alert-error', form1);

		form1.validate({
			errorElement: 'span', //default input error message container
			errorClass: 'help-inline', // default input error message class
			focusInvalid: false, // do not focus the last invalid input
			ignore: "",
			rules: {
				pageTitle: {
					required: true
				},
				pageDescription: {
					required: false
				}
			},
			messages: {
				pageTitle: {
					required: "Page Title is required."
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
				var titleStr = $('#pageTitle').val();
				var descStr = $('#pageDescription').val();
				var url = $('#savePage_url').val();
				$.post(
						url,
						{title: titleStr, desc: descStr},
				function(response) {
					selfRedirect();
				}
				);

			}
		});
	};

	var handleValidation_question_dialog = function() {
		// for more info visit the official plugin documentation: 
		// http://docs.jquery.com/Plugins/Validation

		var form1 = $('#q_dialog-form');
		var error1 = $('.alert-error', form1);

		$.validator.addMethod(
				"qt_select",
				function(value, element) {
					if (value === '0') {
						return false;
					} else {
						return true;
					}
				},
				"Please Select Question Type."
				);

		form1.validate({
			errorElement: 'span', //default input error message container
			errorClass: 'help-inline', // default input error message class
			focusInvalid: false, // do not focus the last invalid input
			ignore: "",
			rules: {
				q_text: {
					required: true
				},
				qtid: {
					required: true,
					qt_select: true
				},
				answer_choice_text: {
					required: true
				},
				answer_choice_text1: {
					required: true
				},
				answer_choice_text2: {
					required: true
				},
				answer_choice_text3: {
					required: true
				},
				q_comment_label: {
					required: true
				},
				q_require_answer_message: {
					required: true
				},
				q_validate_format_value: {
					required: true,
					number: true
				},
				q_validate_format_value1: {
					required: true,
					number: true
				},
				q_validate_format_value2: {
					required: true,
					number: true
				},
				q_validate_format_msg: {
					required: true
				},
				q_other_choice_label: {
					required: true
				}
			},
			messages: {
				q_text: {
					required: "Question Text is required."
				},
				qtid: {
					required: "Question Type is required."
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

				if (get_q_text_val() !== '') {
					saveQuestion();
				}
				else {

				}
			}
		});
	};


	/*	
	 rules:
	 user_id: {require: true, minlength: 3, remote: {type: "post", url:"check_user_id.php" } },
	 
	 
	 
	 
	 messages:
	 user_id: {
	 required: "Please enter id.",
	 minlength: jQuery.format("id length >  {0}"),
	 remote : jQuery.format("{0} is duplicate.")
	 }, 
	 
	 check_user_id.php
	 <?php
	 require_once $_SERVER['DOCUMENT_ROOT'].'/preset.php';
	 ?>
	 <?php
	 
	 $q = "SELECT * FROM ap_member WHERE id='$user_id'";
	 $result = $mysqli->query( $q);
	 
	 if($result->num_rows==0) {
	 echo 'true';
	 }
	 else {
	 echo 'false';
	 }
	 
	 ?> 
	 
	 */
	var handleValidation_setting = function() {
		// for more info visit the official plugin documentation: 
		// http://docs.jquery.com/Plugins/Validation

		var form1 = $('#settingForm');
		var error1 = $('.alert-error', form1);


		$.validator.addMethod(
				"sc_message_content_check",
				function(value, element) {
					if (value.indexOf("[NAME]") === -1 || value.indexOf("[SURVEY_TITLE]") === -1 || value.indexOf("[SURVEY_LINK]") === -1) {
						return false;
					} else {
						return true;
					}
				},
				"[NAME],  [SURVEY_TITLE], [SURVEY_LINK] symbols is required."
				);


		form1.validate({
			errorElement: 'span', //default input error message container
			errorClass: 'help-inline', // default input error message class
			focusInvalid: false, // do not focus the last invalid input
			ignore: "",
			rules: {
				set_max_response: {
					required: true,
					number: true
				},
				sc_from_email: {
					required: true,
					email: true
				},
				sc_subject: {
					required: true
				},
				sc_message: {
					required: true,
					sc_message_content_check: true
				}
			},
			messages: {
				set_max_response: {
					required: "Max Response is required."
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

	var loadingStart = function() {
		$.fn.modalmanager.defaults.resize = true;
		$.fn.modalmanager.defaults.spinner = '<div class="loading-spinner fade"  data-backdrop="static" style="width: 200px; margin-left: -100px;"><img src="' + $('#base_url').val() + 'include/img/ajax-modal-loading.gif" align="middle">&nbsp;<span style="font-weight:300; color: #eee; font-size: 18px; font-family:Open Sans;">&nbsp;Loading...</span></div>';
		$('body').modalmanager('loading').find('.modal-scrollable').off('click.modalmanager');
	};

	var loadingEnd = function() {
//		setTimeout(function() {
		$('body').modalmanager('loading');
//		}, 6000);
	};

	return {
		init: function() {
			handleValidation_welcome_dialog();
			handleValidation_thankyou_dialog();
			handleValidation_page_dialog();
			handleValidation_question_dialog();
			settingInit();

			var baseUrl = $('#base_url').val();

			$('#select_theme_btn').click(function() {
				var sid = $('#survey_id').val();
				var themeno = $("input[name='theme_radio']:checked").val();
				var indata = {};
				indata.sid = sid;
				indata.themeno = themeno;

				jsonStr = JSON.stringify(indata);
				var url = baseUrl + "index.php/surveyedit/select_theme";
				$.post(url, {"indata": jsonStr}, function(responseText) {
				});
			});

			$('#qtid_select').change(function() {
				var qtid = $('#qtid_select').val();

				$('#qt_img').empty();
				$('#q_content_answer').empty();
				if (qtid > 0) {
					if (qtid === '11')
					{
						if (!is_ckeditor_visible()) {
							visible_ck_editor(true);
						}
					}
					else
					{
						if (is_ckeditor_visible()) {
							visible_ck_editor(false);
						}

						var str = '<img src="' + baseUrl + 'include/img/qt_img' + qtid + '.png" alt="">';
						$('#qt_img').append(str);
					}
					add_q_content_answer(qtid);
				}
			});

			$('.pageDlgRequire').click(function() {
				$('#pageDlgCaption').empty();
				$('#pageDlgCaption').append("Add Page");

				$('#pageTitle').val("");
				$('#pageDescription').val("");
				$('#savePage_url').val($(this).attr('src'));
			});

			$('.pageDlgRequireEdit').click(function() {
				$('#pageDlgCaption').empty();
				$('#pageDlgCaption').append("Edit Page");

				$('#pageTitle').val($(this).next().val());
				$('#pageDescription').val($(this).next().next().val());
				$('#savePage_url').val($(this).attr('src'));
			});

			$('.qDlgRequire').click(function() {
				$('#design_main_body').hide();
				$('#design_q_body').show();

				$('#save_question_url').val($(this).attr('src'));
				$('#design_q_body .questionTitle').empty();
				$('#design_q_body .questionTitle').append("Add Question");

				$('#design_q_body #q_text').val("");
				$('#design_q_body #qtid_select').val("0");
				$('#design_q_body #q_content_answer').empty();

				$('#design_q_body #qtid_select').attr("disabled", false);
			});

			$('.qDlgRequireEdit').click(function() {
				$('#design_main_body').hide();
				$('#design_q_body').show();

				$('#save_question_url').val($(this).attr('src'));
				$('#design_q_body .questionTitle').empty();
				$('#design_q_body .questionTitle').append("Edit Question");
				loadQuestion($(this).next().val());

				$('#design_q_body #qtid_select').attr("disabled", true);
			});

			$('.del_confirm_dlg_require').click(function() {
				$('#del_confirm_dlg #del_action_url').val($(this).attr('src'));
			});

			$('#del_confirm_dlg .delAction').click(function() {
				window.location.href = $('#del_confirm_dlg #del_action_url').val();
			});

			$('#tab_results').click(function() {
				window.location.href = baseUrl + "index.php/results/s/" + $('#survey_id').val();
			});

			$('#tab_surveycollect').click(function() {
				window.location.href = baseUrl + "index.php/surveycollect/index/" + $('#survey_id').val();
			});

			$('#design_q_body .cancel').click(function() {
				window.location.href = baseUrl + "index.php/surveyedit/index/" + $('#survey_id').val();
			});
		}
	};

	function is_ckeditor_visible() {
		if ($('#design_q_body #q_text_parent').attr("ckstate") === "yes") {
			return true;
		}
		return false;
	}

	function get_q_text_val() {
		var str = '';
		if (is_ckeditor_visible()) {
			str = CKEDITOR.instances.q_text.getData();
		}
		else {
			str = $('#design_q_body #q_text').val();
		}
		return str;
	}

	function set_q_text_val(value) {
		if (is_ckeditor_visible()) {
			CKEDITOR.instances.q_text.setData(value);
		}
		else {
			$('#design_q_body #q_text').val(value);
		}
	}

	function visible_ck_editor(flag) {
		if (flag) {
			$('#design_q_body #q_text_parent').attr("ckstate", "yes");
			$('#design_q_body #q_text_parent').empty();
			var str = '<textarea class="ckeditor span12 " id="q_text" name="q_ck_text" rows="4"></textarea>';
			$('#design_q_body #q_text_parent').append(str);
			CKEDITOR.replace('q_text', {
				toolbar: [
					{name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike']},
					{name: 'styles', items: ['Styles', 'Format', 'Font', 'FontSize']},
					{name: 'colors', items: ['TextColor', 'BGColor']},
					{name: 'links', items: ['Link', 'Unlink', 'Anchor']},
//					{name: 'others', items: ['-', 'oEmbed']},
//					{name: 'insert', items: ['Image', 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe']},
					{name: 'insert', items: ['Image', 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe', 'Youtube']},
					{name: 'editing', groups: ['find', 'selection', 'spellchecker'], items: ['Find', 'Replace', '-', 'SelectAll', '-', 'Scayt']}
				]
			});
		}
		else
		{
			$('#design_q_body #q_text_parent').attr("ckstate", "no");
			$('#design_q_body #q_text_parent').empty();
			var str = '<textarea id="q_text" name="q_text" class="span12" rows="4" ></textarea>';
			$('#design_q_body #q_text_parent').append(str);
		}
	}

	function settingInit() {

		handleValidation_setting();

		$('#response_one_computer').toggleButtons({
			width: 100,
			height: 20,
			label: {
				enabled: "Yes",
				disabled: "No"
			}
		});
		$('#enable_progressbar').toggleButtons({
			width: 100,
			height: 20,
			label: {
				enabled: "Yes",
				disabled: "No"
			}
		});
		$('#save_continue').toggleButtons({
			width: 100,
			height: 20,
			label: {
				enabled: "Yes",
				disabled: "No"
			}
		});

		$('#save_continue input').change(function() {
			if ($(this).is(':checked') === true) {
				$('#sc_body').show();
				$('#sc_from_email').attr("name", "sc_from_email");
				$('#sc_subject').attr("name", "sc_subject");
				$('#sc_message').attr("name", "sc_message");
			}
			else
			{
				$('#sc_from_email').attr("name", "sc_from_email1");
				$('#sc_subject').attr("name", "sc_subject1");
				$('#sc_message').attr("name", "sc_message1");
				$('#sc_body').hide();
			}

		});

		if (jQuery().datepicker) {
			$('.date-picker').datepicker({
				rtl: App.isRTL()
			});
		}
	}

	function selfRedirect()
	{
		window.location.href = $('#base_url').val() + "index.php/surveyedit/index/" + $('#survey_id').val();
	}

	function add_q_content_answer(qtid)
	{
		loadingStart();
		var url = $('#base_url').val();
		url += "index.php/answer_option/get_contents/" + qtid;
		$.post(url, {}, function(response) {
			$('#q_content_answer').empty();
			$('#q_content_answer').append(response);
			$('.answer_choice_pre_made').change(function() {
				var printId = $(this).attr("src");
				var tid = $(this).val();
				if (tid !== '') {
					addTemplateChoices(tid, printId);
				}
			});

			App.init();
			loadingEnd();
		});
	}

	function addTemplateChoices(tid, id)
	{
//		loadingStart();
		var url = $('#base_url').val() + "index.php/answer_option/get_pre_made/" + tid;
		$.post(url, {}, function(response) {
			$('#' + id + ' textarea').val(response);
//			loadingEnd();
		});
	}

	function replaceSep(input, rep)
	{
		var ret = input.replace(/\n/g, rep);
		return ret;
	}

	function saveQuestion()
	{
		var url = $('#save_question_url').val();
		var q_text = get_q_text_val();
		var q_type = $('#design_q_body #qtid_select').val();
		var contact = new Object();
		contact.q_text = q_text;
		contact.q_type = q_type;
		var contents = new Array();

		var sepSym = '\/';
		var selector = ".ao_setting";
		var length = $(selector).length;
		for (var i = 0; i < length; i++) {
			var id = $(selector).get(i).id;
			var sel = '#' + id + ' ';
			var obj = new Object();
			obj.aoid = $(sel + " .aoid").val();
			var aotype = $(sel + " .aotype").val();
			switch (aotype) {
				case '1': // Display Option1
				case '2': // Display Option2
					obj.content = $(sel + ' select').val();
					contents.push(obj);
					break;
				case '3': // Answer Choice
					obj.content = replaceSep($(sel + ' textarea').val(), sepSym);
					contents.push(obj);
					break;
				case '4': // Other Choice
					if ($(sel + ' .checkbox input').parent().attr("class") === "checked")
					{
						var tmp = $(sel + ' #q_other_choice_label').val() + sepSym;
						tmp += $(sel + ' #q_other_choice1').val() + sepSym;
						tmp += $(sel + ' #q_other_choice2').val();
						obj.content = tmp;
						contents.push(obj);
					}
					break;
				case '5': // Comment
					if ($(sel + ' .checkbox input').parent().attr("class") === "checked")
					{
						var tmp = $(sel + ' #q_comment_label').val() + sepSym;
						tmp += $(sel + ' #q_comment_line1').val() + sepSym;
						tmp += $(sel + ' #q_comment_line2').val() + sepSym;
						tmp += $(sel + ' #q_comment_line3').val();
						obj.content = tmp;
						contents.push(obj);
					}
					break;
				case '6': // Box Size1
					var tmp = $(sel + ' #q_answer_box_size1').val() + sepSym;
					tmp += $(sel + ' #q_answer_box_size2').val();
					obj.content = tmp;
					contents.push(obj);
					break;
				case '7': //Box Size2
					var tmp = $(sel + ' #q_answer_box_size2').val();
					obj.content = tmp;
					contents.push(obj);
					break;
				case '8': //Row Choices
				case '9': //Column Choices
				case '10': //Drop Down Choices
					obj.content = replaceSep($(sel + ' textarea').val(), sepSym);
					contents.push(obj);
					break;
				case '11': //Date Options
					obj.content = $(sel + ' #date_option_select1').val() + sepSym;
					obj.content += $(sel + ' #date_option_select2').val();
					contents.push(obj);
					break;
				case '12': //Validate Answer Format1
					if ($(sel + ' .checkbox input').parent().attr("class") === "checked")
					{
						var tmp = $(sel + ' .q_validate_type').val();
						if ($(sel + ' #q_validate_value').val()) {
							tmp += sepSym + $(sel + ' #q_validate_value').val();
						}
						tmp += sepSym + $(sel + ' textarea').val();
						obj.content = tmp;
						contents.push(obj);
					}
					break;
				case '13': //Validate Answer Format2
					if ($(sel + ' .checkbox input').parent().attr("class") === "checked")
					{
						var tmp = $(sel + ' .q_validate_type').val();
						if ($(sel + ' #q_validate_value1').val()) {
							tmp += sepSym + $(sel + ' #q_validate_value1').val();
							if ($(sel + ' #q_validate_value2').val()) {
								tmp += sepSym + $(sel + ' #q_validate_value2').val();
							}
						}
						tmp += sepSym + $(sel + ' textarea').val();
						obj.content = tmp;
						contents.push(obj);
					}
					break;
				case '14': //Allow only one response per column
				case '16': // Randomise order
					if ($(sel + ' .checkbox input').parent().attr("class") === "checked")
					{
						contents.push(obj);
					}
					break;
				case '15': // Require answer
					if ($(sel + ' .checkbox input').parent().attr("class") === "checked")
					{
						obj.content = $(sel + ' textarea').val();
						contents.push(obj);
					}
					break;
			}
		}
		contact.answer = contents;

		var json = JSON.stringify(contact);

		loadingStart();
		$.post(url, {"key": json}, function(response) {
			loadingEnd();
			selfRedirect();
		});

//		jQuery.ajax({
//			type: "POST",
//			url: url,
//			cache: false,
//			data: {
//				"key": json
//			},
//			success: function(data) {
//				selfRedirect();
//			},
//			error: function(e) {
//				alert('Problem occured while networking');
//			}
//		});
	}

	function loadQuestion(qid)
	{
		loadingStart();
		var url = $('#base_url').val();
		url += "index.php/question/get_question/" + qid;
		$.post(url, {}, function(response) {
			var obj = JSON.parse(response);
			var qtid = obj.qtid;
			if (qtid > 0) {
				if (qtid === '11') {
					visible_ck_editor(true);
				} else {
					visible_ck_editor(false);
					var str = '<img src="' + baseUrl + 'include/img/qt_img' + qtid + '.png" alt="">';
				}

				set_q_text_val(obj.question);
//				$('#design_q_body #q_text').val(obj.question);
				$('#design_q_body #qtid_select').val(qtid);
				$('#qt_img').append(str);

//				add_q_content_answer(qtid);
				var url = $('#base_url').val() + "index.php/answer_option/get_contents/" + qtid;
				$.post(url, {}, function(response) {
					$('#q_content_answer').empty();
					$('#q_content_answer').append(response);
					$('.answer_choice_pre_made').change(function() {
						var printId = $(this).attr("src");
						var tid = $(this).val();
						if (tid !== '') {
							addTemplateChoices(tid, printId);
						}
					});

					App.init();

					//added.
					load_q_content_answer(obj.answer);

//					setTimeout(function() {
					loadingEnd();
//					}, 2000);

				});
			}
		});
	}

	function replaceSep2(input, rep)
	{
		var ret = input.replace(/\//g, '\n');
		return ret;
	}

	function load_q_content_answer(answer)
	{
		var length = answer.length;
		var sepSym = '\/';
		var selector = ".ao_setting";
		for (var i = 0; i < length; i++) {
			var aoid = answer[i].aoid;
			var aotype = answer[i].aotype;
			var id = $(selector + " .aoid[value='" + aoid + "']").parent().attr("id");
			var sel = '#' + id;
			switch (aotype) {
				case '1': // Display Option1
				case '2': // Display Option2
					$(sel + ' select').val(answer[i].value);
					break;
				case '3': // Answer Choice
					$(sel + ' textarea').val(replaceSep2(answer[i].value));
					break;
				case '4': // Other Choice
					if (!$(sel + ' .checkbox input').is(':checked'))
						$(sel + ' .checkbox input').click();
					var valueArray = answer[i].value.split(sepSym);
					$(sel + ' #q_other_choice_label').val(valueArray[0]);
					$(sel + ' #q_other_choice1').val(valueArray[1]);
					$(sel + ' #q_other_choice2').val(valueArray[2]);
					break;
				case '5': // Comment
					$(sel + ' .checkbox input').click();
					var valueArray = answer[i].value.split(sepSym);
					$(sel + ' #q_comment_label').val(valueArray[0]);
					$(sel + ' #q_comment_line1').val(valueArray[1]);
					$(sel + ' #q_comment_line2').val(valueArray[2]);
					$(sel + ' #q_comment_line3').val(valueArray[2]);
					break;
				case '6': // Box Size1
					var valueArray = answer[i].value.split(sepSym);
					$(sel + ' #q_answer_box_size1').val(valueArray[0]);
					$(sel + ' #q_answer_box_size2').val(valueArray[1]);
					break;
				case '7': //Box Size2
					$(sel + ' #q_answer_box_size2').val(answer[i].value);
					break;
				case '8': //Row Choices
				case '9': //Column Choices
				case '10': //Drop Down Choices
					$(sel + ' textarea').val(replaceSep2(answer[i].value));
					break;
				case '11': //Date Options
					var valueArray = answer[i].value.split(sepSym);
					$(sel + ' #date_option_select1').val(valueArray[0]);
					$(sel + ' #date_option_select2').val(valueArray[1]);
					break;
				case '12': // Validate Format1
				case '13': //Validate answer format2
					if (!$(sel + ' .checkbox input').is(':checked'))
						$(sel + ' .checkbox input').click();
					var valueArray = answer[i].value.split(sepSym);
					$(sel + ' .q_validate_type').val(valueArray[0]);
					select_validate_type(valueArray[0]);
					var valLen = valueArray.length;
					if (valLen > 2)
						$(sel + ' #q_validate_value').val(valueArray[1]);
					if (valLen > 3)
						$(sel + ' #q_validate_value2').val(valueArray[2]);
					$(sel + ' textarea').val(valueArray[valLen - 1]);
					break;
				case '14': //Allow only one response per column
				case '16': // Randomise order
					if (!$(sel + ' .checkbox input').is(':checked'))
						$(sel + ' .checkbox input').click();
					break;
				case '15': // Require answer
					if (!$(sel + ' .checkbox input').is(':checked'))
						$(sel + ' .checkbox input').click();
					$(sel + ' textarea').val(replaceSep2(answer[i].value));
					break;
			}

		}
	}

}();
