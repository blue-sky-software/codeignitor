var MySurvey = function() {



	var all_page = 1;
	var m_startpage = 1;
	var m_selpage = 1;
	var maxDigitCnt = 3;
	var m_sort = "none";

	var handleValidation_copy = function() {
		// for more info visit the official plugin documentation: 
		// http://docs.jquery.com/Plugins/Validation

		var form1 = $('#copy_confirm_form');
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

				var surveyStr = $('#copy_confirm_dlg .copy_sid').val();
				var titleStr = $('#copy_confirm_dlg #createSurveyTitle').val()
				if (titleStr !== '') {
					var url = baseUrl + "index.php/create_survey/copy";
					$.post(url, {title: titleStr, survey: surveyStr}, function(response) {
						window.location.href = baseUrl + "index.php/mysurvey/index";
					});
				}
			}
		});
	};


	return {
		init: function() {

			handleValidation_copy();

			$(".btn_dash").removeClass("active");
			$(".btn_dash > span").removeClass("selected");
			$(".btn_survey").addClass("active");
			$(".btn_survey > span").addClass("selected");

			$("#listsize_sel option:eq(2)").attr("selected", "selected");

			$('#listsize_sel').change(function() {
				m_selpage = 1;
				refreshSurveys();
			});

			$('#search').click(function() {
				refreshSurveys();
			});

			$('#sortbytitle').click(function() {
				m_sort = "bytitle";
				refreshSurveys();
			});

			$('#sortbycreated').click(function() {
				m_sort = "bycreated";
				refreshSurveys();
			});

			refreshSurveys();
		}
	};


	function refreshSurveys() {
		pageno = 1;
		listsize = $('#listsize_sel').val();
		searchkey = $('#searchkey').val();

		var baseUrl = $('#base_url').val();
		jQuery.ajax({
			type: "POST",
			url: baseUrl + "index.php/mysurvey/get_surveys",
			data: {
				"listsize": listsize,
				"pageno": m_selpage,
				"searchkey": searchkey,
				"sort": m_sort
			},
			success: function(data) {

				$('#surveylist').empty();
				$('#surveylist').append(data);

				jQuery.ajax({
					type: "POST",
					url: baseUrl + "index.php/mysurvey/j_get_totalcount",
					data: {
						"listsize": listsize,
						"pageno": m_selpage,
						"searchkey": searchkey
					},
					success: function(data) {
						jsonOutput = JSON.parse(data);

						if (jsonOutput.total_count === 0)
							all_page = 1;
						else
							all_page = Math.floor((jsonOutput.total_count - 1) / listsize) + 1;

						$('#pageinfo').html('Showing ' + ((m_selpage - 1) * listsize + 1) + '-' + (m_selpage * listsize) + ' of ' + jsonOutput.total_count);

						make_pagination();

						init();
					},
					error: function(data) {
						alert('Problem occured while networking');
					}
				});
			},
			error: function(data) {
				alert('Problem occured while networking');
			}
		});
	}

	function init() {

		var baseUrl = $('#base_url').val();

		$('.copyBtn').click(function() {
//			$('#copy_confirm_dlg #createSurveyTitle').focus();
			$('#copy_confirm_dlg .copy_sid').val($(this).attr('sid'));
		});

		$('.clearBtn').click(function() {
			$('#clear_confirm_dlg .clear_sid').val($(this).attr('sid'));
		});

		$('.delBtn').click(function() {
			$('#del_confirm_dlg .del_sid').val($(this).attr('sid'));
		});

		$('#clear_confirm_dlg .action').click(function() {

			var sid = $('#clear_confirm_dlg .clear_sid').val();

			$.get(baseUrl + "index.php/mysurvey/clear_survey/" + sid, function() {
				refreshSurveys();
			});
		});

		$('#del_confirm_dlg .action').click(function() {

			var sid = $('#del_confirm_dlg .del_sid').val();

			$.get(baseUrl + "index.php/mysurvey/del_survey/" + sid, function() {
				refreshSurveys();
			});
		});
	}

	function make_pagination() {

		$("#pagination_ul").empty();

		var digitCnt;

		if (all_page <= maxDigitCnt) {
			digitCnt = all_page;
		}
		else {
			digitCnt = maxDigitCnt;
		}

		var startno = m_selpage - digitCnt / 2;
		startno = Math.round(startno);
		if (startno < 1)
			startno = 1;
		if (startno > 1)
			$("#pagination_ul").append('<li><a href="#">«</a></li>');
		for (var i = 0; i < digitCnt; i++) {
			if (i + startno <= all_page)
				$("#pagination_ul").append('<li><a href="#">' + (i + startno).toString() + '</a></li>');
		}
		if (startno + digitCnt - 1 < all_page)
			$("#pagination_ul").append('<li><a href="#">»</a></li>');

		$('#pagination_ul a').each(function(index) {
			if ($(this).html() === m_selpage) {
				$(this).addClass('disabled');
			}
		});

		$('#pagination_ul a').click(function(index) {
			var selText = $(this).html();
			if (selText === "«")
				m_selpage = parseInt(m_selpage) - 1;
			else if (selText === "»")
				m_selpage = parseInt(m_selpage) + 1;
			else
				m_selpage = selText;

			if (m_selpage > all_page)
				m_selpage = all_page;
			if (m_selpage < 1)
				m_selpage = 1;

			refreshSurveys();
		});

	}



}();
