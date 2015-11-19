var Login = function() {
	var handleLogin = function() {
		$('.login-form').validate({
			errorElement: 'label', //default input error message container
			errorClass: 'help-inline', // default input error message class
			focusInvalid: false, // do not focus the last invalid input
			rules: {
				email: {
					required: true,
					email: true
				},
				password: {
					required: true
				},
				captcha: {
					required: true
				},
				remember: {
					required: false
				}
			},
			messages: {
				email: {
					required: "Email is required1."
				},
				password: {
					required: "Password is required2."
				},
				captcha: {
					required: "Captcha is required."
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
				var baseUrl = $('#base_url').val();
				captcha = $('.login-form input[name="captcha"]').val();
				jQuery.ajax({
					type: "POST",
					url: baseUrl + "index.php/auth/j_check_captcha",
					data: {
						"captcha": captcha
					},
					success: function(data) {
						data = JSON.parse(data);
						if (data.valid === 'false')
							$('.login-form input[name="captcha"]').parent().parent().append('<label style="color: #b94a48;" for="captcha" class="help-inline help-small no-left-padding">Invalid Captcha.</label>');
						else
							form.submit();
					},
					error: function(data) {
						alert('Problem occured while networking');
					}
				});
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

	var handleForgetPassword = function() {
		$('.forget-form').validate({
			errorElement: 'label', //default input error message container
			errorClass: 'help-inline', // default input error message class
			focusInvalid: false, // do not focus the last invalid input
			ignore: "",
			rules: {
				email: {
					required: true,
					email: true
				},
				captcha: {
					required: true
				}
			},
			messages: {
				email: {
					required: "Email is required."
				},
				captcha: {
					required: "Captcha is requredi"
				}
			},
			invalidHandler: function(event, validator) { //display error alert on form submit   

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
				captcha = $('.forget-form input[name="captcha"]').val();
				var baseUrl = $('#base_url').val();
				jQuery.ajax({
					type: "POST",
					url: baseUrl + "index.php/auth/j_check_captcha",
					data: {
						"captcha": captcha
					},
					success: function(data) {
						data = JSON.parse(data);
						if (data.valid === 'false')
							$('.forget-form input[name="captcha"]').parent().parent().append('<label style="color: #b94a48;" for="captcha" class="help-inline help-small no-left-padding">Invalid Captcha.</label>');
						else
							form.submit();
					},
					error: function(data) {
						alert('Problem occured while networking');
					}
				});
			}
		});

		$('.forget-form input').keypress(function(e) {
			if (e.which == 13) {
				if ($('.forget-form').validate().form()) {
					$('.forget-form').submit();
				}
				return false;
			}
		});

		jQuery('#forget-password').click(function() {
			jQuery('.login-form').hide();
			jQuery('.forget-form').show();
			$('#refreshCaptcha_recover').trigger('click');
		});

		jQuery('#back-btn').click(function() {
			jQuery('.login-form').show();
			jQuery('.forget-form').hide();
			$('#refreshCaptcha').trigger('click');
		});

		$('#refreshCaptcha_recover').click(function() {
			var baseUrl = $('#base_url').val();
			$.post(baseUrl + "index.php/auth/j_refresh_captcha", function(img) {
				$('#div_captcha_recover img').remove();
				$('#div_captcha_recover').prepend(img);
			});
			return false;
		});

	}

	var handleRegister = function() {

		function format(state) {
			if (!state.id)
				return state.text; // optgroup
			return "<img class='flag' src='assets/img/flags/" + state.id.toLowerCase() + ".png'/>&nbsp;&nbsp;" + state.text;
		}


		$("#select2_sample4").select2({
			placeholder: '<i class="icon-map-marker"></i>&nbsp;Select a Country',
			allowClear: true,
			formatResult: format,
			formatSelection: format,
			escapeMarkup: function(m) {
				return m;
			}
		});


		$('#select2_sample4').change(function() {
			$('.register-form').validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input
		});

		$('#register_password').keyup(function() {
			console.log('password is keyup...\n');
			$('#result').html(checkStrength($('#register_password').val()));
		});

		function checkStrength(password)
		{
			//initial strength
			var strength = 0;

			//if the password length is less than 6, return message.
			if (password.length < 6) {
				$('#result').attr("style", "text-align: center; width:25%; background: #b94a48;");
				return 'Low';
			}

			//length is ok, lets continue.

			//if length is 8 characters or more, increase strength value
			if (password.length > 7)
				strength += 1;

			//if password contains both lower and uppercase characters, increase strength value
			if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/))
				strength += 1;

			//if it has numbers and characters, increase strength value
			if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/))
				strength += 1;

			//if it has one special character, increase strength value
			if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/))
				strength += 1;

			//if it has two special characters, increase strength value
			if (password.match(/(.*[!,%,&,@,#,$,^,*,?,_,~].*[!,%,&,@,#,$,^,*,?,_,~])/))
				strength += 1;

			//now we have calculated strength value, we can return messages

			//if value is less than 2
			if (strength <= 2)
			{
				$('#result').attr("style", "text-align: center; width:60%; background: rgb(128, 128, 0);");
				return 'Medium';
			}
			else
			{
				$('#result').attr("style", "text-align: center; width:95%; background: rgb(0, 128, 0);");
				return 'High';
			}
		}

		$('.register-form').validate({
			errorElement: 'label', //default input error message container
			errorClass: 'help-inline', // default input error message class
			focusInvalid: false, // do not focus the last invalid input
			ignore: "",
			rules: {
				fullname: {
					required: true
				},
				email: {
					required: true,
					email: true
				},
				address: {
					required: true
				},
				city: {
					required: true
				},
				country: {
					required: true
				},
				username: {
					required: true
				},
				password: {
					required: true
				},
				rpassword: {
					equalTo: "#register_password"
				},
				tnc: {
					required: true
				}
			},
			messages: {// custom messages for radio buttons and checkboxes
				tnc: {
					required: "Please accept TNC first."
				}
			},
			invalidHandler: function(event, validator) { //display error alert on form submit   

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
				if (element.attr("name") == "tnc") { // insert checkbox errors after the container                  
					error.addClass('help-small no-left-padding').insertAfter($('#register_tnc_error'));
				} else if (element.closest('.input-icon').size() === 1) {
					error.addClass('help-small no-left-padding').insertAfter(element.closest('.input-icon'));
				} else {
					error.addClass('help-small no-left-padding').insertAfter(element);
				}
			},
			submitHandler: function(form) {
				email = $('.register-form input[name="email"]').val();
				captcha = $('.register-form input[name="captcha"]').val();

				var baseUrl = $('#base_url').val();
				jQuery.ajax({
					type: "POST",
					url: baseUrl + "index.php/auth/j_check_email_duplicate",
					data: {
						"email": email
					},
					success: function(data) {
						data = JSON.parse(data);
						if (data.duplicated === 'true')
							$('.register-form input[name="email"]').parent().append('<label for="email" class="help-inline help-small no-left-padding">The email is duplicated.</label>');
						else
						{
							var baseUrl = $('#base_url').val();
							jQuery.ajax({
								type: "POST",
								url: baseUrl + "index.php/auth/j_check_captcha",
								data: {
									"captcha": captcha
								},
								success: function(data) {
									data = JSON.parse(data);
									if (data.valid === 'false')
										$('.register-form input[name="captcha"]').parent().parent().append('<label style="color: #b94a48;" for="captcha" class="help-inline help-small no-left-padding">Invalid Captcha.</label>');
									else
										form.submit();
								},
								error: function(data) {
									alert('Problem occured while networking');
								}
							});
						}
					},
					error: function(data) {
						alert('Problem occured while networking');
					}
				});
			}
		});

		$('.register-form input').keypress(function(e) {
			if (e.which == 13) {
				if ($('.register-form').validate().form()) {
					$('.register-form').submit();
				}
				return false;
			}
		});

		jQuery('#register-btn').click(function() {
			jQuery('.login-form').hide();
			jQuery('.register-form').show();
			$('#refreshCaptcha_register').trigger('click');
		});

		jQuery('#register-back-btn').click(function() {
			jQuery('.login-form').show();
			jQuery('.register-form').hide();
		});

		$('#refreshCaptcha_register').click(function() {
			var baseUrl = $('#base_url').val();
			$.post(baseUrl + "index.php/auth/j_refresh_captcha", function(img) {
				$('#div_captcha_register img').remove();
				$('#div_captcha_register').prepend(img);
			});
			return false;
		});
	}

	return {
		//main function to initiate the module
		init: function() {

			handleLogin();
			handleForgetPassword();
			handleRegister();

		}

	};

}();