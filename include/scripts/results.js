var Results = function() {


	function initCharts(initData)
	{
		if (!jQuery.plot) {
			return;
		}

		var data_buf = [];

		for (var k in initData) {
			var obj = new Object();
			obj.key = k;
			var value = initData[k];
			obj.value = value.data1;
			data_buf.push(obj);
		}

		function showTooltip(title, x, y, contentsX, contentsY) {
			$('<div id="tooltip" class="chart-tooltip"><div class="date">' + title + '<\/div><div class="label label-success">Answer: ' + Math.round(contentsX)  + '<\/div><div class="label label-important">Percent: ' + Math.round(contentsY)  + '%<\/div><\/div>').css({
				position: 'absolute',
				display: 'none',
				top: y - 100,
				width: 100,
				left: x - 40,
				border: '0px solid #ccc',
				padding: '2px 6px',
				'background-color': '#fff'
			}).appendTo("body").fadeIn(200);
		}

		function randValue() {
			return (Math.floor(Math.random() * (1 + 50 - 20))) + 10;
		}

		var data = [];
		if ($('#site_statistics').size() !== 0) {

//			$('#site_statistics_loading').hide();
			$('#site_statistics_content').show();

			var series = data_buf.length;

			for (var i = 0; i < series; i++) {
				data[i] = {
					label: data_buf[i].key,
					data: data_buf[i].value
				}
			}

			$.plot($("#site_statistics"), data, {
				series: {
					pie: {
						show: true,
						radius: 1,
						label: {
							show: true,
							radius: 3 / 4,
							formatter: function(label, series) {
								return '<div style="font-size:8pt;text-align:center;padding:2px;color:white;">' + label + '<br/>' + Math.round(series.percent) + '%</div>';
							},
							background: {
								opacity: 0.5
							}
						}
					}
				},
				legend: {
					show: false
				}
			});
		}

		if ($('#site_activities').size() !== 0) {
			//site activities
			var previousPoint2 = null;
			$('#site_activities_loading').hide();
			$('#site_activities_content').show();

			var series = data_buf.length;

			for (var i = 0; i < series; i++) {
				data[i] = [i+1, data_buf[i].value];
			}

			$.plot(
					$("#site_activities"), [{
					data: data,
					color: "rgba(107,207,123, 0.9)",
					shadowSize: 0,
					bars: {
						show: true,
						lineWidth: 0,
						fill: true,
						fillColor: {
							colors: [{
									opacity: 1
								}, {
									opacity: 1
								}
							]
						}
					}
				}
			], {
				series: {
					bars: {
						show: true,
						barWidth: 0.9
					}
				},
				grid: {
					show: false,
					hoverable: true,
					clickable: false,
					autoHighlight: true,
					borderWidth: 0
				},
				yaxis: {
					min: 0,
					max: 100
				}
			});

			$("#site_activities").bind("plothover", function(event, pos, item) {
				$("#x").text(pos.x.toFixed(2));
				$("#y").text(pos.y.toFixed(2));
				if (item) {
					if (previousPoint2 !== item.dataIndex) {
						previousPoint2 = item.dataIndex;
						$("#tooltip").remove();
						var x = item.datapoint[0].toFixed(2),
								y = item.datapoint[1].toFixed(2);
						showTooltip('Bar Chart', item.pageX, item.pageY, x, y);
					}
				}
			});

			$('#site_activities').bind("mouseleave", function() {
				$("#tooltip").remove();
			});
		}
	}



	return {
		init: function() {

			$('.q_result_chart').empty();

			$('.create_chart').click(function() {
				var qid = $(this).attr('qid');
				$.post(baseUrl + "index.php/results/get_data_forchart/" + qid, '', function(response) {
					if (response !== 'false') {
						var obj = JSON.parse(response);
						$('.q_result_chart').empty();
						$('#q_result_chart' + qid).append(obj.html);
						initCharts(obj.answer);
					}
				});
			});

			$('#tab_design').click(function() {
				var sid = $('#tab_design').attr('sid');
				window.location.replace(baseUrl + "index.php/surveyedit/index/" + sid);
			});
			$('#tab_collect').click(function() {
				var sid = $('#tab_collect').attr('sid');
				window.location.replace(baseUrl + "index.php/surveycollect/index/" + sid);
			});
			$('#page_selecter').change(function() {
				var pid = $('#page_selecter').val();
				var seqno = $('#page_selecter option:selected').text();
				if (seqno === "--Listing All Pages--")
					location.reload();
				var page_html;
				var url = baseUrl + "index.php/results/get_section_page_html/" + pid + "/" + seqno;
				$.post(url, {}, function(data) {
					page_html = data;
					$('#page_content').empty();
					$('#page_content').append(page_html);
				});

			});

		}
	};
}();