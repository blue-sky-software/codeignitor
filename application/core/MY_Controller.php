<?php

class MY_Controller extends CI_Controller {

	const VALUE_DELIMETER = "/";
	const ANSWER_DELIMETER1 = "__";
	const ANSWER_DELIMETER2 = "_";

	function __construct() {
		parent::__construct();

		$this->load->model('question_m');
		$this->load->model('question_detail_m');
		$this->load->model('answer_option_m');
		$this->load->model('answer_temp_m');
		$this->load->model('page_m');
		$this->load->model('survey_m');
	}

	function _make_question_html($qid) {

		$question_record = $this->question_m->get_one_record($qid);
		$questions = $this->question_m->get_questions($question_record['pid']);
		for ($i = 0; $i < count($questions); $i++) {
			if ($questions[$i]['qid'] == $question_record['qid'])
				$seqno = $i + 1;
		}

		$data['question_title'] = $question_record['question'];
		$data['seqno'] = $seqno;
		$data['qid'] = $question_record['qid'];
		$data['qtid'] = $question_record['qtid'];
		

		$html = $this->load->view('preview/question_upper', $data, true);

		$qchtml = $this->_make_question_content_html($qid);
		$html .= $qchtml;

		$html .= $this->load->view('preview/question_lower', $data, true);

		return $html;
	}

	function _make_question_content_html($qid) {
		$question_record = $this->question_m->get_one_record($qid);
		$html = '';

		switch ($question_record['qtid']) {
			case 1:
				// Multiple Choice (Only One Answer)
				$html = $this->_make_multi_choice_one_answer($qid);
				return $html;
			case 2:
				// Multiple Choice (Multiple Answers)
				$html = $this->_make_multi_choice_multi_answer($qid);
				return $html;
			case 3:
				// Comment/Essay Box
				$html = $this->_make_essaybox($qid);
				return $html;
			case 4:
				// Ranking
				$html = $this->_make_ranking($qid);
				return $html;
			case 5:
				// Matrix of Choices (Only One Answer per Row)
				$html = $this->_make_matrix_choice_one_answer($qid);
				return $html;
			case 6:
				// Matrix of Choices (Multiple Answers per Row)
				$html = $this->_make_matrix_choice_multi_answer($qid);
				return $html;
			case 7:
				// Matrix of Textboxes
				$html = $this->_make_matrix_textbox($qid);
				return $html;
			case 8:
				// Matrix of Drop-down Menus
				$html = $this->_make_matrix_dropdown($qid);
				return $html;
			case 9:
				// Single Textbox
				$html = $this->_make_single_textbox($qid);
				return $html;
			case 10:
				// Multiple Textboxes
				$html = $this->_make_multi_textbox($qid);
				return $html;
			case 11:
				return $html;
			case 12:
				// Date/Time Box
				$html = $this->_make_datetime_box($qid);
				return $html;
			default:
				break;
		}
	}

	function _make_multi_choice_one_answer($qid) {
		$html = '';
		$q_config = $this->_get_question_config($qid);
		$EMPTY_VALUE_ARRAY = array('', ' ');
		if (isset($q_config['1'])) // Display Option
			$column_cnt = $q_config['1']['q_v0'];
		else
			$column_cnt = 1;
		if (isset($q_config['3'])) { // Answer Choice
			$qdetail = $q_config['3'];
			$values = explode(self::VALUE_DELIMETER, $qdetail['q_v0']);
			$values = array_diff($values, $EMPTY_VALUE_ARRAY);

			if (isset($q_config['16'])) // Randomise
				shuffle($values);
			$html = '<div class="controls">';
			foreach ($values as $i => $value) {
				if ($i % $column_cnt == 0)
					$html .= '<br>';
				$html .= '<label class="radio">';
				$html .= '<input type="radio" name="' . $qid . self::ANSWER_DELIMETER1 . 'answer" value="' . $value . '">' . $value;
				$html .= '</label>';
			}

			if (isset($q_config['4'])) { // Other Choice
				$qdetail = $q_config['4'];
				$values = explode(self::VALUE_DELIMETER, $qdetail['q_v0']);
				$values = array_diff($values, $EMPTY_VALUE_ARRAY);

				$html .= '<br>';
				$html .= '<label class="radio">';
				$html .= '<input type="radio" name="' . $qid . self::ANSWER_DELIMETER1 . 'answer" value="' . 'other' . '">' . $values[0];
				$html .= '</label>';
				$html .= '<br>';
				if ($values[1] == 1)
					$html .= '<textarea class="m-wrap" rows="5" name="' . $qid . self::ANSWER_DELIMETER1 . 'answer' . self::ANSWER_DELIMETER2 . 'othertext"></textarea>';
				else if ($values[1] == 2)
					$html .= '<input type="text" name="' . $qid . self::ANSWER_DELIMETER1 . 'answer' . self::ANSWER_DELIMETER2 . 'othertext">';
			}
			$html .= '</div>';
		}
		if (isset($q_config['5'])) { // Comment
			$qdetail = $q_config['5'];
			$values = explode(self::VALUE_DELIMETER, $qdetail['q_v0']);
			$values = array_diff($values, $EMPTY_VALUE_ARRAY);

			$html .= '<br>';
			$html .= $values['0'];
			$html .= '<br>';
			if ($values['1'] == 1)
				$html .= '<textarea style="background-color : #ffffff;" class="m-wrap" rows="' . $values['2'] . '" name="' . $qid . self::ANSWER_DELIMETER1 . 'comment"></textarea>';
			else if ($values['1'] == 2)
				$html .= '<input type="text" style="background-color : #ffffff;" name="' . $qid . self::ANSWER_DELIMETER1 . 'comment">';
		}
		if (isset($q_config['15'])) { // Require Answer
			$qdetail = $q_config['15'];
			$html .= '<myinfo error_msg="' . $qdetail['q_v0'] . '"></myinfo>';
		}
		return $html;
	}

	function _make_multi_choice_multi_answer($qid) {
		$html = '';
		$q_config = $this->_get_question_config($qid);
		$EMPTY_VALUE_ARRAY = array('', ' ');
		if (isset($q_config['2'])) // Display Option
			$column_cnt = $q_config['2']['q_v0'];
		else
			$column_cnt = 1;
		if (isset($q_config['3'])) { // Answer Choice
			$qdetail = $q_config['3'];
			$values = explode(self::VALUE_DELIMETER, $qdetail['q_v0']);
			$values = array_diff($values, $EMPTY_VALUE_ARRAY);

			if (isset($q_config['16'])) // Randomise
				shuffle($values);
			$html = '<div class="controls">';
			foreach ($values as $i => $value) {
				if ($i % $column_cnt == 0)
					$html .= '<br>';
				$html .= '<label class="radio">';
				$html .= '<input type="checkbox" name="' . $qid . self::ANSWER_DELIMETER1 . 'answer' . self::ANSWER_DELIMETER2 . $i . '" value="' . $value . '"/>' . $value;
				$html .= '</label>';
			}

			if (isset($q_config['4'])) { // Other Choice
				$qdetail = $q_config['4'];
				$values = explode(self::VALUE_DELIMETER, $qdetail['q_v0']);
				$values = array_diff($values, $EMPTY_VALUE_ARRAY);

				$html .= '<br>';
				$html .= '<label class="radio">';
				$html .= '<input type="checkbox" name="' . $qid . self::ANSWER_DELIMETER1 . 'answer' . self::ANSWER_DELIMETER2 . 'other" value="' . 'other' . '">' . $values[0];
				$html .= '</label>';
				$html .= '<br>';
				if ($values[1] == 1)
					$html .= '<textarea style="background-color : #ffffff;" class="m-wrap" rows="5" name="' . $qid . self::ANSWER_DELIMETER1 . 'answer' . self::ANSWER_DELIMETER2 . 'othertext"></textarea>';
				else if ($values[1] == 2)
					$html .= '<input type="text" style="background-color : #ffffff;" name="' . $qid . self::ANSWER_DELIMETER1 . 'answer' . self::ANSWER_DELIMETER2 . 'othertext">';
			}

			$html .= '</div>';
		}
		if (isset($q_config['5'])) { // Comment
			$qdetail = $q_config['5'];
			$values = explode(self::VALUE_DELIMETER, $qdetail['q_v0']);
			$values = array_diff($values, $EMPTY_VALUE_ARRAY);

			$html .= '<br>';
			$html .= $values['0'];
			$html .= '<br>';
			if ($values['1'] == 1)
				$html .= '<textarea style="background-color : #ffffff;" class="m-wrap" rows="' . $values['2'] . '" name="' . $qid . self::ANSWER_DELIMETER1 . 'comment"></textarea>';
			else if ($values['1'] == 2)
				$html .= '<input type="text" style="background-color : #ffffff;" name="' . $qid . self::ANSWER_DELIMETER1 . 'comment">';
		}
		if (isset($q_config['15'])) { // Require Answer
			$qdetail = $q_config['15'];
			$html .= '<myinfo error_msg="' . $qdetail['q_v0'] . '"></myinfo>';
		}
		return $html;
	}

	function _make_essaybox($qid) {
		$html = '';
		$q_config = $this->_get_question_config($qid);
		$EMPTY_VALUE_ARRAY = array('', ' ');

		if (isset($q_config['6'])) {
			$qdetail = $q_config['6'];
			$values = explode(self::VALUE_DELIMETER, $qdetail['q_v0']);
			$values = array_diff($values, $EMPTY_VALUE_ARRAY);

			$line_size = $values[0];
			$col_size = $values[1];

			$html = '<div class="control-group">';
			$html .= '<label class="control-label"></label>';
			$html .= '<div class="controls">';
			$html .= '<textarea style="background-color : #ffffff;" class="m-wrap" rows="' . $line_size . '" name="' . $qid . self::ANSWER_DELIMETER1 . 'answer"></textarea>';
			$html .= '</div>';
			$html .= '</div>';
		}
		
		if (isset($q_config['13'])) { // Validate answer format2
			$qdetail = $q_config['13'];
			$values = explode(self::VALUE_DELIMETER, $qdetail['q_v0']);
			$values = array_diff($values, $EMPTY_VALUE_ARRAY);

			switch ($values[0]) {
				case 6: // Email format
					$html .= '<formatinfo format="email" error_msg="' . $values[1] . '"></formatinfo>';
					break;
				case 7: // Number format
					$html .= '<formatinfo format="number" from="' . $values[1] . '" to="' . $values[2] . '" error_msg="' . $values[3] . '"></formatinfo>';
					break;
				case 8: // Text Length Limit
					$html .= '<formatinfo format="textlength" from="' . $values[1] . '" to="' . $values[2] . '" error_msg="' . $values[3] . '"></formatinfo>';
					break;
				case 9: // Word Count Limit
					$html .= '<formatinfo format="wordcount" from="' . $values[1] . '" to="' . $values[2] . '" error_msg="' . $values[3] . '"></formatinfo>';
					break;
				default:
					break;
			}
		}

		if (isset($q_config['15'])) { // Require Answer
			$qdetail = $q_config['15'];
			$html .= '<myinfo error_msg="' . $qdetail['q_v0'] . '"></myinfo>';
		}
		return $html;
	}

	function _make_ranking($qid) {
		$html = '';
		$q_config = $this->_get_question_config($qid);
		$EMPTY_VALUE_ARRAY = array('', ' ');

		if (isset($q_config['3'])) { // Answer Choice
			$qdetail = $q_config['3'];
			$values = explode(self::VALUE_DELIMETER, $qdetail['q_v0']);
			$values = array_diff($values, $EMPTY_VALUE_ARRAY);

			$selector_class_name = "ranking_selector_container_$qid";
			$html = '<div class="controls">';
			foreach ($values as $i => $value) {
				$html .= '<div class=" ' . $selector_class_name . '">';
				$html .= '<select class="small m-wrap" name="' . $qid . self::ANSWER_DELIMETER1 . 'answer' . self::ANSWER_DELIMETER2 . $i . '">';

				$html .= '<option value=""></option>';
				for ($j = 1; $j <= count($values); $j++) {
					$html .= '<option value="' . $j . '">' . $j . '</option>';
				}

				$html .= '</select>';
				$html .= '&nbsp;&nbsp;&nbsp;' . $value;
				$html .= '<br>';
				$html .= '</div>';
			}
			$html .= '</div>';
		}
		if (isset($q_config['5'])) { // Comment
			$qdetail = $q_config['5'];
			$values = explode(self::VALUE_DELIMETER, $qdetail['q_v0']);
			$values = array_diff($values, $EMPTY_VALUE_ARRAY);

			$html .= '<br>';
			$html .= $values['0'];
			$html .= '<br>';
			if ($values['1'] == 1)
				$html .= '<textarea style="background-color : #ffffff;" class="m-wrap" rows="' . $values['2'] . '" name="' . $qid . self::ANSWER_DELIMETER1 . 'comment"></textarea>';
			else if ($values['1'] == 2)
				$html .= '<input type="text" style="background-color : #ffffff;" name="' . $qid . self::ANSWER_DELIMETER1 . 'comment">';
		}
		if (isset($q_config['15'])) { // Require Answer
			$qdetail = $q_config['15'];
			$html .= '<myinfo error_msg="' . $qdetail['q_v0'] . '"></myinfo>';
		}

		// Add javascript
		$data['qid'] = $qid;
		$html .= $this->load->view('/preview/question_ranking', '', true);
		return $html;
	}

	function _make_matrix_choice_one_answer($qid) {
		$html = '';
		$q_config = $this->_get_question_config($qid);
		$EMPTY_VALUE_ARRAY = array('', ' ');

		if (isset($q_config['8'])) { // Row Choices
			$qdetail = $q_config['8'];
			$values_row = explode(self::VALUE_DELIMETER, $qdetail['q_v0']);
			$values_row = array_diff($values_row, $EMPTY_VALUE_ARRAY);

			if (isset($q_config['9'])) { // Column Choices
				$qdetail = $q_config['9'];
				$values_col = explode(self::VALUE_DELIMETER, $qdetail['q_v0']);
				$values_col = array_diff($values_col, $EMPTY_VALUE_ARRAY);
			}

			if (isset($q_config['16'])) // Randomise
				shuffle($values_row);

			$html .= '<div class="portlet box red">';
			$html .= '<div class="portlet-title"></div>';
			$html .= '<div class="portlet-body">';
			$html .= '<table class="table table-hover">';
			$html .= '<thead>';
			$html .= '<tr>';
			$html .= '<th></th>';
			foreach ($values_col as $value_col) {
				$html .= "<th>$value_col</th>";
			}
			$html .= '</tr>';
			$html .= '</thead>';
			$html .= '<tbody>';

			foreach ($values_row as $i => $value_row) {

				$html .= '<tr>';
				$html .= "<td>$value_row</td>";
				foreach ($values_col as $j => $value_col) {
					$html .= '<td>';

					$html .= '<label class="radio">';
					$html .= '<input type="radio" name="' . $qid . self::ANSWER_DELIMETER1 . 'answer' . self::ANSWER_DELIMETER2 . $i . '" value="' . $value_col . '">';
					$html .= '</label>';

					$html .= '</td>';
				}
				$html .= '</tr>';
			}

			$html .= '</tbody>';
			$html .= '</table>';
			$html .= '</div>';
			$html .= '</div>';
		}
		if (isset($q_config['5'])) { // Comment
			$qdetail = $q_config['5'];
			$values = explode(self::VALUE_DELIMETER, $qdetail['q_v0']);
			$values = array_diff($values, $EMPTY_VALUE_ARRAY);

			$html .= '<br>';
			$html .= $values['0'];
			$html .= '<br>';
			if ($values['1'] == 1)
				$html .= '<textarea style="background-color : #ffffff;" class="m-wrap" rows="' . $values['2'] . '" name="' . $qid . self::ANSWER_DELIMETER1 . 'comment"></textarea>';
			else if ($values['1'] == 2)
				$html .= '<input type="text" style="background-color : #ffffff;" name="' . $qid . self::ANSWER_DELIMETER1 . 'comment">';
		}
		if (isset($q_config['15'])) { // Require Answer
			$qdetail = $q_config['15'];
			$html .= '<myinfo error_msg="' . $qdetail['q_v0'] . '"></myinfo>';
		}

		// Add javascript
		if (isset($q_config['14'])) { // Allow only one response per column
			$html .= '<onlyonepercolumn></onlyonepercolumn>';
//			$data['qid'] = $qid;
//			$html .= $this->load->view('/preview/question_matrix_choice_one_answer', '', true);
		}

		return $html;
	}

	function _make_matrix_choice_multi_answer($qid) {
		$html = '';
		$q_config = $this->_get_question_config($qid);
		$EMPTY_VALUE_ARRAY = array('', ' ');

		if (isset($q_config['8'])) { // Row Choices
			$qdetail = $q_config['8'];
			$values_row = explode(self::VALUE_DELIMETER, $qdetail['q_v0']);
			$values_row = array_diff($values_row, $EMPTY_VALUE_ARRAY);

			if (isset($q_config['9'])) { // Column Choices
				$qdetail = $q_config['9'];
				$values_col = explode(self::VALUE_DELIMETER, $qdetail['q_v0']);
				$values_col = array_diff($values_col, $EMPTY_VALUE_ARRAY);
			}

			if (isset($q_config['16'])) // Randomise
				shuffle($values_row);

			$html .= '<div class="portlet box red">';
			$html .= '<div class="portlet-title"></div>';
			$html .= '<div class="portlet-body">';
			$html .= '<table class="table table-hover">';
			$html .= '<thead>';
			$html .= '<tr>';
			$html .= '<th></th>';
			foreach ($values_col as $value_col) {
				$html .= "<th>$value_col</th>";
			}
			$html .= '</tr>';
			$html .= '</thead>';
			$html .= '<tbody>';

			foreach ($values_row as $i => $value_row) {

				$html .= '<tr>';
				$html .= "<td>$value_row</td>";
				foreach ($values_col as $j => $value_col) {
					$html .= '<td>';

					$html .= '<label class="radio">';
					$html .= '<input type="checkbox" name="' . $qid . self::ANSWER_DELIMETER1 . 'answer' . self::ANSWER_DELIMETER2 . $i . self::ANSWER_DELIMETER2 . $j . '" value="' . $value_col . '">';
					$html .= '</label>';

					$html .= '</td>';
				}
				$html .= '</tr>';
			}

			$html .= '</tbody>';
			$html .= '</table>';
			$html .= '</div>';
			$html .= '</div>';
		}
		if (isset($q_config['5'])) { // Comment
			$qdetail = $q_config['5'];
			$values = explode(self::VALUE_DELIMETER, $qdetail['q_v0']);
			$values = array_diff($values, $EMPTY_VALUE_ARRAY);

			$html .= '<br>';
			$html .= $values['0'];
			$html .= '<br>';
			if ($values['1'] == 1)
				$html .= '<textarea style="background-color : #ffffff;" class="m-wrap" rows="' . $values['2'] . '" name="' . $qid . self::ANSWER_DELIMETER1 . 'comment"></textarea>';
			else if ($values['1'] == 2)
				$html .= '<input type="text" style="background-color : #ffffff;" name="' . $qid . self::ANSWER_DELIMETER1 . 'comment">';
		}
		if (isset($q_config['15'])) { // Require Answer
			$qdetail = $q_config['15'];
			$html .= '<myinfo error_msg="' . $qdetail['q_v0'] . '"></myinfo>';
		}

		return $html;
	}

	function _make_matrix_textbox($qid) {
		$html = '';
		$q_config = $this->_get_question_config($qid);
		$EMPTY_VALUE_ARRAY = array('', ' ');

		if (isset($q_config['8'])) { // Row Choices
			$qdetail = $q_config['8'];
			$values_row = explode(self::VALUE_DELIMETER, $qdetail['q_v0']);
			$values_row = array_diff($values_row, $EMPTY_VALUE_ARRAY);

			if (isset($q_config['9'])) { // Column Choices
				$qdetail = $q_config['9'];
				$values_col = explode(self::VALUE_DELIMETER, $qdetail['q_v0']);
				$values_col = array_diff($values_col, $EMPTY_VALUE_ARRAY);
			}

			if (isset($q_config['16'])) // Randomise
				shuffle($values_row);

			$html .= '<div class="portlet box red">';
			$html .= '<div class="portlet-title"></div>';
			$html .= '<div class="portlet-body flip-scroll">';
			$html .= '<table class="table-condensed flip-content">';
			$html .= '<thead>';
			$html .= '<tr>';
			$html .= '<th></th>';
			foreach ($values_col as $value_col) {
				$html .= "<th>$value_col</th>";
			}
			$html .= '</tr>';
			$html .= '</thead>';
			$html .= '<tbody>';

			foreach ($values_row as $i => $value_row) {

				$html .= '<tr>';
				$html .= "<td>$value_row</td>";
				foreach ($values_col as $j => $value_col) {
					$html .= '<td>';

					$html .= '<input type="text" style="background-color : #ffffff;" class="m-wrap small" name="' . $qid . self::ANSWER_DELIMETER1 . 'answer' . self::ANSWER_DELIMETER2 . $i . self::ANSWER_DELIMETER2 . $j . '" value="">';

					$html .= '</td>';
				}
				$html .= '</tr>';
			}

			$html .= '</tbody>';
			$html .= '</table>';
			$html .= '</div>';
			$html .= '</div>';
		}
		if (isset($q_config['5'])) { // Comment
			$qdetail = $q_config['5'];
			$values = explode(self::VALUE_DELIMETER, $qdetail['q_v0']);
			$values = array_diff($values, $EMPTY_VALUE_ARRAY);

			$html .= '<br>';
			$html .= $values['0'];
			$html .= '<br>';
			if ($values['1'] == 1)
				$html .= '<textarea style="background-color : #ffffff;" class="m-wrap" rows="' . $values['2'] . '" name="' . $qid . self::ANSWER_DELIMETER1 . 'comment"></textarea>';
			else if ($values['1'] == 2)
				$html .= '<input type="text" style="background-color : #ffffff;" name="' . $qid . self::ANSWER_DELIMETER1 . 'comment">';
		}
		if (isset($q_config['15'])) { // Require Answer
			$qdetail = $q_config['15'];
			$html .= '<myinfo error_msg="' . $qdetail['q_v0'] . '"></myinfo>';
		}

		return $html;
	}

	function _make_matrix_dropdown($qid) {
		$html = '';
		$q_config = $this->_get_question_config($qid);
		$EMPTY_VALUE_ARRAY = array('', ' ');

		if (isset($q_config['8'])) { // Row Choices
			$qdetail = $q_config['8'];
			$values_row = explode(self::VALUE_DELIMETER, $qdetail['q_v0']);
			$values_row = array_diff($values_row, $EMPTY_VALUE_ARRAY);

			if (isset($q_config['9'])) { // Column Choices
				$qdetail = $q_config['9'];
				$values_col = explode(self::VALUE_DELIMETER, $qdetail['q_v0']);
				$values_col = array_diff($values_col, $EMPTY_VALUE_ARRAY);
			}

			if (isset($q_config['10'])) { // Column Choices
				$qdetail = $q_config['10'];
				$values_dropdown = explode(self::VALUE_DELIMETER, $qdetail['q_v0']);
				$values_dropdown = array_diff($values_dropdown, $EMPTY_VALUE_ARRAY);
			}

			if (isset($q_config['16'])) // Randomise
				shuffle($values_row);

			$html .= '<div class="portlet box red">';
			$html .= '<div class="portlet-title"></div>';
			$html .= '<div class="portlet-body flip-scroll">';
			$html .= '<table class="table-condensed flip-content">';
			$html .= '<thead>';
			$html .= '<tr>';
			$html .= '<th></th>';
			foreach ($values_col as $value_col) {
				$html .= "<th>$value_col</th>";
			}
			$html .= '</tr>';
			$html .= '</thead>';
			$html .= '<tbody>';

			foreach ($values_row as $i => $value_row) {

				$html .= '<tr>';
				$html .= "<td>$value_row</td>";
				foreach ($values_col as $j => $value_col) {
					$html .= '<td>';

					$html .= '<select class="span12 m-wrap" name="' . $qid . self::ANSWER_DELIMETER1 . 'answer' . self::ANSWER_DELIMETER2 . $i . self::ANSWER_DELIMETER2 . $j . '">';
					$html .= '<option value=""></option>';
					foreach ($values_dropdown as $value_dropdown) {
						$html .= '<option value="' . $value_dropdown . '">' . $value_dropdown . '</option>';
					}
					$html .= '</select>';

					$html .= '</td>';
				}
				$html .= '</tr>';
			}

			$html .= '</tbody>';
			$html .= '</table>';
			$html .= '</div>';
			$html .= '</div>';
		}
		if (isset($q_config['5'])) { // Comment
			$qdetail = $q_config['5'];
			$values = explode(self::VALUE_DELIMETER, $qdetail['q_v0']);
			$values = array_diff($values, $EMPTY_VALUE_ARRAY);

			$html .= '<br>';
			$html .= $values['0'];
			$html .= '<br>';
			if ($values['1'] == 1)
				$html .= '<textarea style="background-color : #ffffff;" class="m-wrap" rows="' . $values['2'] . '" name="' . $qid . self::ANSWER_DELIMETER1 . 'comment"></textarea>';
			else if ($values['1'] == 2)
				$html .= '<input type="text" style="background-color : #ffffff;" name="' . $qid . self::ANSWER_DELIMETER1 . 'comment">';
		}
		if (isset($q_config['15'])) { // Require Answer
			$qdetail = $q_config['15'];
			$html .= '<myinfo error_msg="' . $qdetail['q_v0'] . '"></myinfo>';
		}

		return $html;
	}

	function _make_single_textbox($qid) {
		$html = '';
		$q_config = $this->_get_question_config($qid);
		$EMPTY_VALUE_ARRAY = array('', ' ');

		if (isset($q_config['7'])) {
			$col_size = $q_config['7']['q_v0'];
		} else {
			$col_size = 5;
		}

		$html = '<div class="control-group">';
		$html .= '<label class="control-label"></label>';
		$html .= '<div class="controls">';
		$html .= '<input type="text" style="background-color : #ffffff;" class="m-wrap" rows="5" name="' . $qid . self::ANSWER_DELIMETER1 . 'answer"></input>';
		$html .= '</div>';
		$html .= '</div>';

		if (isset($q_config['13'])) { // Validate answer format2
			$qdetail = $q_config['13'];
			$values = explode(self::VALUE_DELIMETER, $qdetail['q_v0']);
			$values = array_diff($values, $EMPTY_VALUE_ARRAY);

			switch ($values[0]) {
				case 6: // Email format
					$html .= '<formatinfo format="email" error_msg="' . $values[1] . '"></formatinfo>';
					break;
				case 7: // Number format
					$html .= '<formatinfo format="number" from="' . $values[1] . '" to="' . $values[2] . '" error_msg="' . $values[3] . '"></formatinfo>';
					break;
				case 8: // Text Length Limit
					$html .= '<formatinfo format="textlength" from="' . $values[1] . '" to="' . $values[2] . '" error_msg="' . $values[3] . '"></formatinfo>';
					break;
				case 9: // Word Count Limit
					$html .= '<formatinfo format="wordcount" from="' . $values[1] . '" to="' . $values[2] . '" error_msg="' . $values[3] . '"></formatinfo>';
					break;
				default:
					break;
			}
		}

		if (isset($q_config['15'])) { // Require Answer
			$qdetail = $q_config['15'];
			$html .= '<myinfo error_msg="' . $qdetail['q_v0'] . '"></myinfo>';
		}

		return $html;
	}

	function _make_multi_textbox($qid) {
		$html = '';
		$q_config = $this->_get_question_config($qid);
		$EMPTY_VALUE_ARRAY = array('', ' ');

		if (isset($q_config['7'])) {
			$col_size = $q_config['7']['q_v0'];
		} else {
			$col_size = 5;
		}

		if (isset($q_config['3'])) {
			$qdetail = $q_config['3'];
			$values_row = explode(self::VALUE_DELIMETER, $qdetail['q_v0']);
			$values_row = array_diff($values_row, $EMPTY_VALUE_ARRAY);
		}

		$html = '<div class="control-group">';
		foreach ($values_row as $i=>$value_row) {
			$html .= '<label class="control-label">' . $value_row . '</label>';
			$html .= '<div class="controls">';
			$html .= '<input type="text" style="background-color : #ffffff;" class="m-wrap" name="' . $qid . self::ANSWER_DELIMETER1 . 'answer' . self::ANSWER_DELIMETER2 . $i . '"></input>';
			$html .= '</div>';
		}
		$html .= '</div>';

		if (isset($q_config['13'])) { // Validate answer format2
			$qdetail = $q_config['13'];
			$values = explode(self::VALUE_DELIMETER, $qdetail['q_v0']);
			$values = array_diff($values, $EMPTY_VALUE_ARRAY);

			switch ($values[0]) {
				case 6: // Email format
					$html .= '<formatinfo format="email" error_msg="' . $values[1] . '"></formatinfo>';
					break;
				case 7: // Number format
					$html .= '<formatinfo format="number" from="' . $values[1] . '" to="' . $values[2] . '" error_msg="' . $values[3] . '"></formatinfo>';
					break;
				case 8: // Text Length Limit
					$html .= '<formatinfo format="textlength" from="' . $values[1] . '" to="' . $values[2] . '" error_msg="' . $values[3] . '"></formatinfo>';
					break;
				case 9: // Word Count Limit
					$html .= '<formatinfo format="wordcount" from="' . $values[1] . '" to="' . $values[2] . '" error_msg="' . $values[3] . '"></formatinfo>';
					break;
				default:
					break;
			}
		}

		if (isset($q_config['5'])) { // Comment
			$qdetail = $q_config['5'];
			$values = explode(self::VALUE_DELIMETER, $qdetail['q_v0']);
			$values = array_diff($values, $EMPTY_VALUE_ARRAY);

			$html .= '<br>';
			$html .= $values['0'];
			$html .= '<br>';
			if ($values['1'] == 1)
				$html .= '<textarea style="background-color : #ffffff;" class="m-wrap" rows="' . $values['2'] . '" name="' . $qid . self::ANSWER_DELIMETER1 . 'comment"></textarea>';
			else if ($values['1'] == 2)
				$html .= '<input type="text" style="background-color : #ffffff;" name="' . $qid . self::ANSWER_DELIMETER1 . 'comment">';
		}

		if (isset($q_config['15'])) { // Require Answer
			$qdetail = $q_config['15'];
			$html .= '<myinfo error_msg="' . $qdetail['q_v0'] . '"></myinfo>';
		}

		return $html;
	}

	function _make_datetime_box($qid) {
		$html = '';
		$q_config = $this->_get_question_config($qid);
		$EMPTY_VALUE_ARRAY = array('', ' ');

		if (isset($q_config['3'])) {
			$qdetail = $q_config['3'];
			$values_row = explode(self::VALUE_DELIMETER, $qdetail['q_v0']);
			$values_row = array_diff($values_row, $EMPTY_VALUE_ARRAY);
		}

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

		$html .= '<div class="portlet box red">';
		$html .= '<div class="portlet-title"></div>';
		$html .= '<div class="portlet-body flip-scroll">';
		$html .= '<table class="table-condensed flip-content">';
		$html .= '<thead>';
		$html .= '<tr>';
		$html .= '<td></td>';
		if ($kind == 1 || $kind == 3) {
			$html .= '<td>Date</td>';
		}
		if ($kind == 2 || $kind == 3) {
			$html .= '<td>Time</td>';
		}
		$html .= '</tr>';
		$html .= '</thead>';
		$html .= '<tbody>';

		foreach ($values_row as $i=>$value_row) {
			$html .= '<tr>';
			$html .= "<td>$value_row</td>";

			if ($kind == 1 || $kind == 3) {
				$html .= '<td><input name="' . $qid . self::ANSWER_DELIMETER1 . 'answer' . self::ANSWER_DELIMETER2 . $i . self::ANSWER_DELIMETER2 . 'date" style="background-color : #ffffff;" class="m-wrap m-ctrl-medium date-picker" size="16" type="text" value="" /></td>';
			}
			if ($kind == 2 || $kind == 3) {
				$html .= '<td><div class="input-append bootstrap-timepicker-component">';
				$html .= '<input name="' . $qid . self::ANSWER_DELIMETER1 . 'answer' . self::ANSWER_DELIMETER2 . $i . self::ANSWER_DELIMETER2 . 'time" style="background-color : #ffffff;" class="m-wrap m-ctrl-small timepicker-default" type="text" />';
				$html .= '<span class="add-on"><i class="icon-time"></i></span>';
				$html .= '</div></td>';
			}

			$html .= '</tr>';
		}

		$html .= '</tbody>';
		$html .= '</table>';
		$html .= '</div>';
		$html .= '</div>';

		if (isset($q_config['5'])) { // Comment
			$qdetail = $q_config['5'];
			$values = explode(self::VALUE_DELIMETER, $qdetail['q_v0']);
			$values = array_diff($values, $EMPTY_VALUE_ARRAY);

			$html .= '<br>';
			$html .= $values['0'];
			$html .= '<br>';
			if ($values['1'] == 1)
				$html .= '<textarea style="background-color : #ffffff;" class="m-wrap" rows="' . $values['2'] . '" name="' . $qid . self::ANSWER_DELIMETER1 . 'comment"></textarea>';
			else if ($values['1'] == 2)
				$html .= '<input type="text" style="background-color : #ffffff;" name="' . $qid . self::ANSWER_DELIMETER1 . 'comment">';
		}

		if (isset($q_config['15'])) { // Require Answer
			$qdetail = $q_config['15'];
			$html .= '<myinfo error_msg="' . $qdetail['q_v0'] . '"></myinfo>';
		}

		return $html;
	}

	function _get_question_config($qid) {
		$qdetails = $this->question_detail_m->get_question_detail($qid);
		foreach ($qdetails as $qdetail) {
			$an_op = $this->answer_option_m->get_answer_option($qdetail['aoid']);
			if (count($an_op) == 0)
				continue;
			$type = $an_op[0]['type'];
			$config[$type] = $qdetail;
		}
		return $config;
	}

}

?>
