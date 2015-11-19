var all_page = 1;
var m_startpage = 1;
var m_selpage = 1;
var pageData;
var maxDigitCnt = 3;
var m_sort = "none";

jQuery(document).ready(function() {
	App.init();

	$(".btn_usermanage").removeClass("active");
	$(".btn_usermanage > span").removeClass("selected");
	$(".btn_config").removeClass("active");
	$(".btn_config > span").removeClass("selected");
	$(".btn_surveymanage").addClass("active");
	$(".btn_surveymanage > span").addClass("selected");
	
	$("#listsize_sel option:eq(2)").attr("selected", "selected");
	
	$('#listsize_sel').change(function() {
		m_selpage = 1;
		refreshSurveys();
	});

	refreshSurveys();
});

function refreshSurveys() {
	pageno = 1;
	listsize = $('#listsize_sel').val();
	
	var baseUrl = $('#base_url').val();

	jQuery.ajax({
		type: "POST",
		url: baseUrl + "index.php/admin/manage/get_surveys",
		data: {
			"listsize": listsize,
			"pageno": m_selpage
		},
		success: function(data) {

			$('#surveylist').empty();
			$('#surveylist').append(data);

			jQuery.ajax({
				type: "POST",
				url: baseUrl + "index.php/admin/manage/get_surveytotalcnt",
				data: {
				},
				success: function(data) {
					jsonOutput = JSON.parse(data);

					if (jsonOutput.surveytotalcnt === 0)
						all_page = 1;
					else
						all_page = Math.floor((jsonOutput.surveytotalcnt - 1) / listsize) + 1;

//					$('#pageinfo').html('Showing ' + ((m_selpage - 1) * listsize + 1) + '-' + (m_selpage * listsize) + ' of ' + jsonOutput.surveytotalcnt);

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

		if (confirm("Are you sure ?") == false)
			return;
		var sid = $(this).attr('sid');
		var baseUrl = $('#base_url').val();

		$.get(baseUrl + 'index.php/admin/manage/del_survey/' + sid, function() {
			refreshSurveys();
		});
	});

	$('.suspendBtn').click(function() {

		if (confirm("Are you sure ?") == false)
			return;
		var sid = $(this).attr('sid');

		var baseUrl = $('#base_url').val();
		$.get(baseUrl + 'index.php/admin/manage/suspend_survey/' + sid, function() {
			refreshSurveys();
		});
	});

	$('.allowBtn').click(function() {

		if (confirm("Are you sure ?") == false)
			return;
		var sid = $(this).attr('sid');

		var baseUrl = $('#base_url').val();
		$.get(baseUrl + 'index.php/admin/manage/allow_survey/' + sid, function() {
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