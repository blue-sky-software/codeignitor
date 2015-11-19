var UserManage = function() {

	var all_page = 1;
	var m_startpage = 1;
	var m_selpage = 1;
	var pageData;
	var maxDigitCnt = 3;
	var m_sort = "none";

	var handleValidation_admin_add_dlg = function() {

		var form1 = $('#admin_user_add_form');
		var error1 = $('.alert-error', form1);
		var baseUrl = $('#base_url').val();

		form1.validate({
			errorElement: 'span', //default input error message container
			errorClass: 'help-inline', // default input error message class
			focusInvalid: false, // do not focus the last invalid input
			ignore: "",
			rules: {
				admin_name: {
					required: true,
					remote: {type: "post", url: baseUrl + "index.php/admin/manage/check_admin_id"}
				},
				newPassword: {
					required: true
				}
			},
			messages: {
				admin_name: {
					required: "Please enter id.",
					remote: $.format("already existed id, Please enter id again.")
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
			submitHandler: function(form) {
				form.submit();
			}
		});
	};

	var handleValidation_admin_edit_dlg = function() {

		var form1 = $('#admin_user_edit_form');
		var error1 = $('.alert-error', form1);
		var baseUrl = $('#base_url').val();

		form1.validate({
			errorElement: 'span', //default input error message container
			errorClass: 'help-inline', // default input error message class
			focusInvalid: false, // do not focus the last invalid input
			ignore: "",
			rules: {
				newPassword: {
					required: true
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
			submitHandler: function(form) {
				form.submit();
			}
		});
	};

	return {
		init: function() {

			handleValidation_admin_add_dlg();
			handleValidation_admin_edit_dlg();

			$("#listsize_sel option:eq(2)").attr("selected", "selected");

			$('#listsize_sel').change(function() {
				m_selpage = 1;
				refreshUsers();
			});

			refreshUsers();
		}
	};

	function refresh() {
		var baseUrl = $('#base_url').val();
		window.location.href = baseUrl + "index.php/admin/manage/usermanage";
	}

	function refreshUsers() {
		pageno = 1;
		listsize = $('#listsize_sel').val();
		var baseUrl = $('#base_url').val();

		jQuery.ajax({
			type: "POST",
			url: baseUrl + "index.php/admin/manage/get_users",
			data: {
				"listsize": listsize,
				"pageno": m_selpage
			},
			success: function(data) {

				$('#userlist').empty();
				$('#userlist').append(data);

				jQuery.ajax({
					type: "POST",
					url: baseUrl + "index.php/admin/manage/get_usertotalcnt",
					data: {
					},
					success: function(data) {
						jsonOutput = JSON.parse(data);

						if (jsonOutput.usertotalcnt === 0)
							all_page = 1;
						else
							all_page = Math.floor((jsonOutput.usertotalcnt - 1) / listsize) + 1;

//					$('#pageinfo').html('Showing ' + ((m_selpage - 1) * listsize + 1) + '-' + (m_selpage * listsize) + ' of ' + jsonOutput.usertotalcnt);

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
		$('.delBtn').click(function() {

			if (confirm("Are you sure ?") === false)
				return;
			var uid = $(this).attr('uid');

			var baseUrl = $('#base_url').val();
			$.get(baseUrl + 'index.php/admin/manage/del_user/' + uid, function() {
				refreshUsers();
			});
		});

		$('.suspendBtn').click(function() {

			if (confirm("Are you sure ?") === false)
				return;
			var uid = $(this).attr('uid');

			var baseUrl = $('#base_url').val();
			$.get(baseUrl + 'index.php/admin/manage/suspend_user/' + uid, function() {
				refreshUsers();
			});
		});

		$('.allowBtn').click(function() {

			if (confirm("Are you sure ?") == false)
				return;
			var uid = $(this).attr('uid');

			var baseUrl = $('#base_url').val();
			$.get(baseUrl + 'index.php/admin/manage/allow_user/' + uid, function() {
				refreshUsers();
			});
		});

		$('.modifyBtn').click(function() {

			var uid = $(this).attr('uid');
			var uname = $(this).attr('uname');

			$('#admin_user_edit_form #admin_name').val(uname);
		});

		$('.adminDelBtn').click(function() {

			if (confirm("Are you sure ?") === false)
				return;
			var uid = $(this).attr('uid');

			var baseUrl = $('#base_url').val();
			$.get(baseUrl + 'index.php/admin/manage/del_user/' + uid, function() {
				refresh();
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

			refreshUsers();
		});

	}
}();
