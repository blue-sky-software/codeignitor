var SurveyCollect = function() {

	return {
		init: function() {

			var baseUrl = $('#base_url').val();

			$('#tab_results').click(function() {
				window.location.href = baseUrl + "index.php/results/s/" + $('#survey_id').val();
			});

			$('#tab_design').click(function() {
				window.location.href = baseUrl + "index.php/surveyedit/index/" + $('#survey_id').val();
			});

			$('#toggleStatus').toggleButtons({
				width: 200,
				height: 50,
				label: {
					enabled: "Online",
					disabled: "Offline"
				}
			});
			$('#toggleStatus input').change(function() {
				var sid = $('#survey_id').val();
				var url = baseUrl + "index.php/surveycollect/set_survey_status/" + sid;
				var value = $(this).is(':checked');
				$.post(url, {"key": value}, function(response) {
					window.location.href = baseUrl + "index.php/surveycollect/index/" + sid;
				});
			});
		}
	};
}();