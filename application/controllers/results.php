<?php

class Results extends MY_Controller {

	const VALUE_DELIMETER = "/";
	const ANSWER_DELIMETER1 = "__";
	const ANSWER_DELIMETER2 = "_";

	function __construct() {
		parent::__construct();

		$this->load->model('survey_m');
		$this->load->model('page_m');
		$this->load->model('question_m');
		$this->load->model('question_detail_m');
		$this->load->model('answer_m');
		$this->load->model('answer_option_m');
	}

	function index() {
		if (!is_user_logined())
			redirect('/auth/login');
	}

	function s($sid) {
		$this->loadView($sid);
	}

	function toExcel($sid) {
		$time = date("ymdGis", time());
		$filename = "SurveyResult$time";
		header("Content-type: application/octet-stream");
		header("Content-Disposition: attachment; filename=$filename.xls");
		header("Pragma: no-cache");
		header("Expires: 0");

		$pages = $this->page_m->get_pages($sid);
		foreach ($pages as $i => $page) {
			$phtml = $this->_make_section_page_html_forexport($page['pid'], $i + 1);
			echo $phtml;
		}
	}

	function toWord($sid) {
		$time = date("ymdGis", time());
		$filename = "SurveyResult$time";
		header("Content-Type: application/vnd.ms-word");
		header("Expires: 0");
		header("Cache-Control:  must-revalidate, post-check=0, pre-check=0");
		header("Content-disposition: attachment; filename=\"$filename.doc\"");

		$pages = $this->page_m->get_pages($sid);
		foreach ($pages as $i => $page) {
			$phtml = $this->_make_section_page_html_forexport($page['pid'], $i + 1);
			echo $phtml;
		}
	}

	function loadView($sid) {
		$survey = $this->survey_m->get_one_record($sid);
		$pages = $this->page_m->get_pages($sid);

		$templateData = array('name' => 'results');
		$viewData = array(
			'Title' => $survey['title'],
			'SID' => $survey['sid']
		);

		echo $this->load->view('template/beginheader', $templateData, true);
		echo $this->load->view('template/header', '', true);
		echo $this->load->view('results/results_v_upper', $viewData, true);

		echo $this->make_section_basic_report_html($sid);
		echo '<div class="row-fluid" id="page_content">';
		foreach ($pages as $i => $page) {
			$phtml = $this->_make_section_page_html($page['pid'], $i + 1);
			echo $phtml;
		}
		echo '</div>';

		echo $this->load->view('results/results_v_lower', '', true);
		echo $this->load->view('template/footer', '', true);
		echo $this->load->view('template/endfooter', $templateData, true);
	}

	function get_data_forchart($qid) {
		$seqno = 0;
		$this->_make_section_question($qid, $seqno, false, true);
	}

	function make_section_basic_report_html($sid) {
		$survey = $this->survey_m->get_one_record($sid);
		$pages = $this->page_m->get_pages($sid);

		$s_partial = $this->survey_m->get_patial_cnt($sid);
		$s_completed = $this->survey_m->get_respondent_cnt($sid);
		$s_respondents = $s_partial + $s_completed;

		$data['s_created'] = $survey['create_date'];
		$data['s_respondents'] = $s_respondents;
		$data['s_partial'] = $s_partial;
		$data['s_completed'] = $s_completed;
		$data['pages'] = $pages;
		$data['sid'] = $sid;

		$html = $this->load->view('results/section_basic_report', $data, true);

		return $html;
	}

	function get_section_page_html($pid, $seqno) {
		echo $this->_make_section_page_html($pid, $seqno);
	}

	function _make_section_page_html($pid, $seqno) {
		$html = '<div class="row-fluid">' .
				'<h4>' .
				'<div class="span3"><strong>' . $seqno . ' Page ' . $seqno . '</strong></div>' .
				'</h4>' .
				'</div>';
		$html .= '<div class="row-fluid">';
		$questions = $this->question_m->get_questions($pid);

		foreach ($questions as $i => $question) {
			$qhtml = $this->_make_section_question($question['qid'], $i + 1);
			$qhtml .= $this->_make_section_question_chart($question['qid'], $i + 1);
			$html .= $qhtml;
		}
		$html .= '</div>';

		return $html;
	}

	function _make_section_page_html_forexport($pid, $seqno) {
		$html = '<strong>Page ' . $seqno . '</strong>';

		$questions = $this->question_m->get_questions($pid);

		foreach ($questions as $i => $question) {
			$qhtml = $this->_make_section_question($question['qid'], $i + 1, true);
			$html .= $qhtml;
		}

		return $html;
	}

	function _make_section_question($qid, $seqno, $for_export = false, $for_chart = false) {
		$html = '';
		$question = $this->question_m->get_one_record($qid);

		switch ($question['qtid']) {
			case 1:
				$html = $this->_make_section_question_multi_choice_one_answer($qid, $seqno, $for_export, $for_chart);
				return $html;
			case 2:
				$html = $this->_make_section_question_multi_choice_multi_answer($qid, $seqno, $for_export, $for_chart);
				return $html;
			case 3:
				$html = $this->_make_section_question_essaybox($qid, $seqno, $for_export, $for_chart);
				return $html;
			case 4:
				$html = $this->_make_section_question_ranking($qid, $seqno, $for_export, $for_chart);
				return $html;
			case 5:
				$html = $this->_make_section_question_matrix_one_answer($qid, $seqno, $for_export, $for_chart);
				return $html;
			case 6:
				$html = $this->_make_section_question_matrix_multi_answer($qid, $seqno, $for_export, $for_chart);
				return $html;
			case 7:
				$html = $this->_make_section_question_matrix_textbox($qid, $seqno, $for_export, $for_chart);
				return $html;
			case 8:
				$html = $this->_make_section_question_matrix_dropdown($qid, $seqno, $for_export, $for_chart);
				return $html;
			case 9:
				return $html;
			case 10:
				$html = $this->_make_section_question_multi_textbox($qid, $seqno, $for_export, $for_chart);
				return $html;
			case 11:
				return $html;
			case 12:
				$html = $this->_make_section_question_datetime_box($qid, $seqno, $for_export, $for_chart);
				return $html;
			default:
				break;
		}
	}

	function _make_section_question_chart($qid, $seqno) {
		$html = '<div class="q_result_chart row-fluid" id="q_result_chart' . $qid . '"></div>';
		return $html;
	}

	function print_chart($answer) {
		if ($answer == null) {
			return "false";
		} else {
			$data['html'] = $this->load->view('results/section_question_chart', '', true);
			$data['answer'] = $answer;
			return json_encode($data);
		}
	}

	function _make_section_question_multi_choice_one_answer($qid, $seqno, $for_export, $for_chart = false) {

		$question = $this->question_m->get_one_record($qid);

		$answered_cnt = $this->answer_m->get_answered_cnt($qid);
		$skipped_cnt = $this->answer_m->get_skipped_cnt($qid);
		$answer = array();
		// {Craven,Marlboro}
		$answer_values = $this->_get_qv0_with_aotype_3($qid);
		foreach ($answer_values as $answer_value) {
			$resp_cnt = $this->answer_m->get_respond_cnt_by_value($qid, $answer_value);
			if ($answered_cnt > 0)
				$resp_percent = number_format($resp_cnt / $answered_cnt * 100);
			else
				$resp_percent = 0;
			$answer[$answer_value] = array(
				'resp_cnt' => $resp_cnt,
				'resp_percent' => $resp_percent
			);
		}

		if ($for_chart) {
			foreach ($answer as $key => $value) {
				$data_chart[$key]['data1'] = $value['resp_percent'];
			}
			echo $this->print_chart($data_chart);
			exit();
		}

		$data['question'] = $question;
		$data['answered_cnt'] = $answered_cnt;
		$data['skipped_cnt'] = $skipped_cnt;
		$data['answer'] = $answer;
		$data['seqno'] = $seqno;
		$data['forexport'] = $for_export;
		$html = $this->load->view('results/section_question_multi_choice_one_answer', $data, true);
		return $html;
	}

	function _make_section_question_multi_choice_multi_answer($qid, $seqno, $for_export, $for_chart = false) {
		$question = $this->question_m->get_one_record($qid);

		$answered_cnt = $this->answer_m->get_answered_cnt($qid);
		$skipped_cnt = $this->answer_m->get_skipped_cnt($qid);
		$answer = array();
		// {Craven,Marlboro}
		$answer_values = $this->_get_qv0_with_aotype_3($qid);
		foreach ($answer_values as $answer_value) {
			$resp_cnt = $this->answer_m->get_respond_cnt_by_value($qid, '"'.$answer_value.'"');
			if ($answered_cnt > 0)
				$resp_percent = number_format($resp_cnt / $answered_cnt * 100);
			else
				$resp_percent = 0;
			$answer[$answer_value] = array(
				'resp_cnt' => $resp_cnt,
				'resp_percent' => $resp_percent
			);
		}

		if ($for_chart) {
			foreach ($answer as $key => $value) {
				$data_chart[$key]['data1'] = $value['resp_percent'];
			}
			echo $this->print_chart($data_chart);
			exit();
		}

		$data['question'] = $question;
		$data['answered_cnt'] = $answered_cnt;
		$data['skipped_cnt'] = $skipped_cnt;
		$data['answer'] = $answer;
		$data['seqno'] = $seqno;
		$data['forexport'] = $for_export;
		$html = $this->load->view('results/section_question_multi_choice_multi_answer', $data, true);
		return $html;
	}

	function _make_section_question_essaybox($qid, $seqno, $for_export, $for_chart = false) {
		$question = $this->question_m->get_one_record($qid);

		$data['question'] = $question;
		$data['seqno'] = $seqno;
		$data['forexport'] = $for_export;

		if ($for_chart) {
			echo json_encode(null);
			exit();
		}

		$html = $this->load->view('results/section_question_essaybox', $data, true);
		return $html;
	}

	function _make_section_question_ranking($qid, $seqno, $for_export, $for_chart = false) {
		$question = $this->question_m->get_one_record($qid);

		$answered_cnt = $this->answer_m->get_answered_cnt($qid);
		$skipped_cnt = $this->answer_m->get_skipped_cnt($qid);
		$answer = array();
		// {Craven,Marlboro}
		$answer_values = $this->_get_qv0_with_aotype_3($qid);

		$weight[0] = 0;
		for ($i = 0; $i < count($answer_values); $i++) {
			$weight[] = count($answer_values) - $i;
		}

		$score_array = array();  // for calculating rank

		foreach ($answer_values as $index => $answer_value) {
			$score = 0;

			$answer_records = $this->answer_m->get_answerfield_records($qid);

			foreach ($answer_records as $record) {
				$values = explode(self::VALUE_DELIMETER, $record);
				$num = $values[$index];
				if(is_numeric($num)) {
					$score += $weight[$num];
				}
			}

			$answer[$answer_value] = array(
				'score' => $score
			);
			$score_array[] = $score;
		}

		sort($score_array);
		foreach ($answer as &$item) {
			$rank = array_search($item['score'], $score_array) + 1;
			$item['rank'] = $rank;
		}

		if ($for_chart) {
			foreach ($answer as $key => $value) {
				$data_chart[$key]['data1'] = $value['score'];
			}
			echo $this->print_chart($data_chart);
			exit();
		}

		$data['question'] = $question;
		$data['answered_cnt'] = $answered_cnt;
		$data['skipped_cnt'] = $skipped_cnt;
		$data['answer'] = $answer;
		$data['seqno'] = $seqno;
		$data['forexport'] = $for_export;
		$html = $this->load->view('results/section_question_ranking', $data, true);
		return $html;
	}

	function _make_section_question_matrix_one_answer($qid, $seqno, $for_export, $for_chart = false) {
		$EMPTY_VALUE_ARRAY = array('', ' ');
		$question = $this->question_m->get_one_record($qid);

		$answered_cnt = $this->answer_m->get_answered_cnt($qid);
		$skipped_cnt = $this->answer_m->get_skipped_cnt($qid);
		$answer = array();

		$q_config = $this->_get_question_config($qid);
		if (isset($q_config['8'])) {
			$row_values = $q_config['8']['q_v0'];
			$row_values = explode(self::VALUE_DELIMETER, $row_values);
			$row_values = array_diff($row_values, $EMPTY_VALUE_ARRAY);
		}
		if (isset($q_config['9'])) {
			$col_values = $q_config['9']['q_v0'];
			$col_values = explode(self::VALUE_DELIMETER, $col_values);
			$col_values = array_diff($col_values, $EMPTY_VALUE_ARRAY);
		}
		foreach ($row_values as $i => $row_value) {

			$answer_records = $this->answer_m->get_answerfield_records($qid);
			$total_resp_cnt = 0;

			foreach ($col_values as $j => $col_value) {

				$cnt = 0;
				foreach ($answer_records as $record) {
					$values = json_decode($record);
					if (isset($values->$row_value) && ($values->$row_value == $col_value)) {
						$cnt++;
					}
				}
				$report_tmp[$col_value]['resp_cnt'] = $cnt;
				$total_resp_cnt += $cnt;
			}
			foreach ($col_values as $col_value) {
				if ($total_resp_cnt > 0) {
					$report_tmp[$col_value]['resp_percent'] = $report_tmp[$col_value]['resp_cnt'] / $total_resp_cnt * 100;
				} else {
					$report_tmp[$col_value]['resp_percent'] = 0;
				}
			}

			$report[$row_value] = $report_tmp;
			$report[$row_value]['resp_total'] = $total_resp_cnt;
		}

		if ($for_chart) {
			foreach ($report as $key => $value) {
				$data_chart[$key]['data1'] = $value['resp_total'];
			}
			echo $this->print_chart($data_chart);
			exit();
		}

		$data['question'] = $question;
		$data['answered_cnt'] = $answered_cnt;
		$data['skipped_cnt'] = $skipped_cnt;
		$data['row_values'] = $row_values;
		$data['col_values'] = $col_values;
		$data['report'] = $report;
		$data['seqno'] = $seqno;
		$data['forexport'] = $for_export;
		$html = $this->load->view('results/section_question_matrix_one_answer', $data, true);
		return $html;
	}

	function _make_section_question_matrix_multi_answer($qid, $seqno, $for_export, $for_chart = false) {
		$EMPTY_VALUE_ARRAY = array('', ' ');
		$question = $this->question_m->get_one_record($qid);

		$answered_cnt = $this->answer_m->get_answered_cnt($qid);
		$skipped_cnt = $this->answer_m->get_skipped_cnt($qid);
		$answer = array();

		$q_config = $this->_get_question_config($qid);
		if (isset($q_config['8'])) {
			$row_values = $q_config['8']['q_v0'];
			$row_values = explode(self::VALUE_DELIMETER, $row_values);
			$row_values = array_diff($row_values, $EMPTY_VALUE_ARRAY);
		}
		if (isset($q_config['9'])) {
			$col_values = $q_config['9']['q_v0'];
			$col_values = explode(self::VALUE_DELIMETER, $col_values);
			$col_values = array_diff($col_values, $EMPTY_VALUE_ARRAY);
		}
		foreach ($row_values as $i => $row_value) {

			$answer_records = $this->answer_m->get_answerfield_records($qid);
			$total_resp_cnt = 0;

			foreach ($col_values as $j => $col_value) {

				$cnt = 0;
				foreach ($answer_records as $record) {
					$record_json = json_decode($record);
					if ($record_json->$row_value->$col_value == 1) {
						$cnt++;
					}
				}
				$report_tmp[$col_value]['resp_cnt'] = $cnt;
				$total_resp_cnt += $cnt;
			}
			foreach ($col_values as $col_value) {
				if ($total_resp_cnt > 0) {
					$report_tmp[$col_value]['resp_percent'] = number_format($report_tmp[$col_value]['resp_cnt'] / $total_resp_cnt * 100, 1);
				} else {
					$report_tmp[$col_value]['resp_percent'] = 0;
				}
			}

			$report[$row_value] = $report_tmp;
			$report[$row_value]['resp_total'] = $total_resp_cnt;
		}
		if ($for_chart) {
			foreach ($report as $key => $value) {
				$data_chart[$key]['data1'] = $value['resp_total'];
			}
			echo $this->print_chart($data_chart);
			exit();
		}

		$data['question'] = $question;
		$data['answered_cnt'] = $answered_cnt;
		$data['skipped_cnt'] = $skipped_cnt;
		$data['row_values'] = $row_values;
		$data['col_values'] = $col_values;
		$data['report'] = $report;
		$data['seqno'] = $seqno;
		$data['forexport'] = $for_export;
		$html = $this->load->view('results/section_question_matrix_one_answer', $data, true);
		return $html;
	}

	function _make_section_question_matrix_textbox($qid, $seqno, $for_export, $for_chart = false) {
		$EMPTY_VALUE_ARRAY = array('', ' ');
		$question = $this->question_m->get_one_record($qid);

		$answered_cnt = $this->answer_m->get_answered_cnt($qid);
		$skipped_cnt = $this->answer_m->get_skipped_cnt($qid);
		$answer = array();

		$q_config = $this->_get_question_config($qid);
		if (isset($q_config['8'])) {
			$row_values = $q_config['8']['q_v0'];
			$row_values = explode(self::VALUE_DELIMETER, $row_values);
			$row_values = array_diff($row_values, $EMPTY_VALUE_ARRAY);
		}
		if (isset($q_config['9'])) {
			$col_values = $q_config['9']['q_v0'];
			$col_values = explode(self::VALUE_DELIMETER, $col_values);
			$col_values = array_diff($col_values, $EMPTY_VALUE_ARRAY);
		}
		foreach ($row_values as $i => $row_value) {

			$answer_records = $this->answer_m->get_answerfield_records($qid);
			$total_resp_cnt = 0;

			foreach ($col_values as $j => $col_value) {

				$cnt = 0;
				foreach ($answer_records as $record) {
					$record_json = json_decode($record);
					if ($record_json->$row_value->$col_value != '') {
						$cnt++;
					}
				}
				$report_tmp[$col_value]['resp_cnt'] = $cnt;
				$total_resp_cnt += $cnt;
			}
			foreach ($col_values as $col_value) {
				if ($total_resp_cnt > 0) {
					$report_tmp[$col_value]['resp_percent'] = number_format($report_tmp[$col_value]['resp_cnt'] / $total_resp_cnt * 100, 1);
				} else {
					$report_tmp[$col_value]['resp_percent'] = 0;
				}
			}

			$report[$row_value] = $report_tmp;
			$report[$row_value]['resp_total'] = $total_resp_cnt;
		}

		if ($for_chart) {
			foreach ($report as $key => $value) {
				$data_chart[$key]['data1'] = $value['resp_total'];
			}
			echo $this->print_chart($data_chart);
			exit();
		}

		$data['question'] = $question;
		$data['answered_cnt'] = $answered_cnt;
		$data['skipped_cnt'] = $skipped_cnt;
		$data['row_values'] = $row_values;
		$data['col_values'] = $col_values;
		$data['report'] = $report;
		$data['seqno'] = $seqno;
		$data['forexport'] = $for_export;
		$html = $this->load->view('results/section_question_matrix_one_answer', $data, true);
		return $html;
	}

	function _make_section_question_matrix_dropdown($qid, $seqno, $for_export, $for_chart = false) {
		$EMPTY_VALUE_ARRAY = array('', ' ');
		$question = $this->question_m->get_one_record($qid);

		$answered_cnt = $this->answer_m->get_answered_cnt($qid);
		$skipped_cnt = $this->answer_m->get_skipped_cnt($qid);
		$answer = array();

		$q_config = $this->_get_question_config($qid);
		if (isset($q_config['8'])) {
			$row_values = $q_config['8']['q_v0'];
			$row_values = explode(self::VALUE_DELIMETER, $row_values);
			$row_values = array_diff($row_values, $EMPTY_VALUE_ARRAY);
		}
		if (isset($q_config['9'])) {
			$col_values = $q_config['9']['q_v0'];
			$col_values = explode(self::VALUE_DELIMETER, $col_values);
			$col_values = array_diff($col_values, $EMPTY_VALUE_ARRAY);
		}
		if (isset($q_config['10'])) {
			$dropdown_values = $q_config['10']['q_v0'];
			$dropdown_values = explode(self::VALUE_DELIMETER, $dropdown_values);
			$dropdown_values = array_diff($dropdown_values, $EMPTY_VALUE_ARRAY);
		}

		$answer_records = $this->answer_m->get_answerfield_records($qid);

		foreach ($col_values as $i => $col_value) {

			foreach ($row_values as $j => $row_value) {

				$total_resp_cnt = 0;

				foreach ($dropdown_values as $dropdown_value) {

					$cnt = 0;
					foreach ($answer_records as $record) {
						$record_json = json_decode($record);
						if ($record_json->$col_value->$row_value != $dropdown_value) {
							$cnt++;
						}
					}
					$report[$col_value][$row_value][$dropdown_value]['resp_cnt'] = $cnt;
					$total_resp_cnt += $cnt;
				}

				$report[$col_value][$row_value]['resp_total'] = $total_resp_cnt;

				foreach ($dropdown_values as $dropdown_value) {
					if ($total_resp_cnt > 0) {
						$report[$col_value][$row_value][$dropdown_value]['resp_percent'] = number_format($report[$col_value][$row_value][$dropdown_value]['resp_cnt'] / $total_resp_cnt * 100, 1);
					} else {
						$report[$col_value][$row_value][$dropdown_value]['resp_percent'] = 0;
					}
				}
			}
		}
		if ($for_chart) {
			foreach ($report as $rootkey => $val)
				break;
			if (isset($rootkey)) {
				foreach ($report[$rootkey] as $key => $value) {
					$data_chart[$key]['data1'] = $value['resp_total'];
				}
				echo $this->print_chart($data_chart);
			}
			exit();
		}

		$data['question'] = $question;
		$data['answered_cnt'] = $answered_cnt;
		$data['skipped_cnt'] = $skipped_cnt;
		$data['row_values'] = $row_values;
		$data['col_values'] = $col_values;
		$data['dropdown_values'] = $dropdown_values;
		$data['report'] = $report;
		$data['seqno'] = $seqno;
		$data['forexport'] = $for_export;
		$html = $this->load->view('results/section_question_matrix_dropdown', $data, true);
		return $html;
	}

	function _make_section_question_multi_textbox($qid, $seqno, $for_export, $for_chart = false) {
		$EMPTY_VALUE_ARRAY = array('', ' ');
		$question = $this->question_m->get_one_record($qid);

		$answered_cnt = $this->answer_m->get_answered_cnt($qid);
		$skipped_cnt = $this->answer_m->get_skipped_cnt($qid);
		$answer = array();

		$q_config = $this->_get_question_config($qid);
		if (isset($q_config['3'])) {
			$row_values = $q_config['3']['q_v0'];
			$row_values = explode(self::VALUE_DELIMETER, $row_values);
			$row_values = array_diff($row_values, $EMPTY_VALUE_ARRAY);
		}
		foreach ($row_values as $i => $row_value) {

			$answer_records = $this->answer_m->get_answerfield_records($qid);
			$total_resp_cnt = 0;
			$cnt = 0;

			foreach ($answer_records as $record) {
				$record_json = json_decode($record);
				if ($record_json->$row_value != '') {
					$report[$row_value]['resp'][] = $record_json->$row_value;
					$cnt++;
				}
				$total_resp_cnt++;
			}
			$report[$row_value]['resp_cnt'] = $cnt;

			if ($total_resp_cnt > 0) {
				$report[$row_value]['resp_percent'] = number_format($report[$row_value]['resp_cnt'] / $total_resp_cnt * 100, 1);
			} else {
				$report[$row_value]['resp_percent'] = 0;
			}
		}

		if ($for_chart) {
			foreach ($report as $key => $value) {
				$data_chart[$key]['data1'] = $value['resp_percent'];
			}
			echo $this->print_chart($data_chart);
			exit();
		}

		$data['question'] = $question;
		$data['answered_cnt'] = $answered_cnt;
		$data['skipped_cnt'] = $skipped_cnt;
		$data['row_values'] = $row_values;
		$data['report'] = $report;
		$data['seqno'] = $seqno;
		$data['forexport'] = $for_export;
		$html = $this->load->view('results/section_question_multi_textbox', $data, true);
		return $html;
	}

	function _make_section_question_datetime_box($qid, $seqno, $for_export, $for_chart = false) {
		$EMPTY_VALUE_ARRAY = array('', ' ');
		$question = $this->question_m->get_one_record($qid);

		$answered_cnt = $this->answer_m->get_answered_cnt($qid);
		$skipped_cnt = $this->answer_m->get_skipped_cnt($qid);
		$answer = array();

		$q_config = $this->_get_question_config($qid);
		if (isset($q_config['3'])) {
			$row_values = $q_config['3']['q_v0'];
			$row_values = explode(self::VALUE_DELIMETER, $row_values);
			$row_values = array_diff($row_values, $EMPTY_VALUE_ARRAY);
		}

		$col_values = array();

		if (isset($q_config['11'])) {
			$qdetail = $q_config['11'];
			$options = explode(self::VALUE_DELIMETER, $qdetail['q_v0']);
			$options = array_diff($options, $EMPTY_VALUE_ARRAY);
		}

		if (isset($options[0])) {
			$kind = $options[0];
		} else {
			$kind = 3;
		}
		if (isset($options[1])) {
			$date_display_format = $options[1];
		} else {
			$date_display_format = 1;
		}

		if ($kind == 1 || $kind == 3) {
			$col_values[] = 'date';
		}
		if ($kind == 2 || $kind == 3) {
			$col_values[] = 'time';
		}
		foreach ($row_values as $i => $row_value) {

			$answer_records = $this->answer_m->get_answerfield_records($qid);
			$total_resp_cnt = 0;

			foreach ($col_values as $j => $col_value) {

				$cnt = 0;
				foreach ($answer_records as $record) {
					$record_json = json_decode($record);
					if ($record_json->$row_value->$col_value != '') {
						$cnt++;
					}
				}
				$report_tmp[$col_value]['resp_cnt'] = $cnt;
				$total_resp_cnt += $cnt;
			}
			foreach ($col_values as $col_value) {
				if ($total_resp_cnt > 0) {
					$report_tmp[$col_value]['resp_percent'] = number_format($report_tmp[$col_value]['resp_cnt'] / $total_resp_cnt * 100, 1);
				} else {
					$report_tmp[$col_value]['resp_percent'] = 0;
				}
			}

			$report[$row_value] = $report_tmp;
			$report[$row_value]['resp_total'] = $total_resp_cnt;
		}

		if ($for_chart) {
			foreach ($report as $key => $value) {
				$data_chart[$key]['data1'] = $value['resp_total'];
			}
			echo $this->print_chart($data_chart);
			exit();
		}

		$data['question'] = $question;
		$data['answered_cnt'] = $answered_cnt;
		$data['skipped_cnt'] = $skipped_cnt;
		$data['row_values'] = $row_values;
		$data['col_values'] = $col_values;
		$data['report'] = $report;
		$data['seqno'] = $seqno;
		$data['forexport'] = $for_export;
		$html = $this->load->view('results/section_question_datetime_box', $data, true);
		return $html;
	}

	function _get_qv0_with_aotype_3($qid) {
		$question = $this->question_m->get_one_record($qid);
		$qdetails = $this->question_detail_m->get_question_detail($qid);
		$question['qdetails'] = $qdetails;
		foreach ($question['qdetails'] as $qdetail) {

			$answer_option = $this->answer_option_m->get_answer_option($qdetail['aoid']);
			$aotype = $answer_option[0]['type'];
			if ($aotype == 3) {
				$values = explode("/", $qdetail['q_v0']);
				$values = array_diff($values, array(''));
				return $values;
			}
		}
	}

}

?>
