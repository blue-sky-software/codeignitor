<?php

class Answer extends MY_Controller {

	const VALUE_DELIMETER = "/";
	const ANSWER_DELIMETER1 = "__";
	const ANSWER_DELIMETER2 = "_";
	const EMPTY_VALUE = "#";

	function __construct() {
		parent::__construct();

		$this->load->model('answer_m');
		$this->load->model('question_m');
		$this->load->model('question_detail_m');
		$this->load->model('page_m');
		$this->config->load('custom_config');
	}

	function receive_answer() {
		$ip = $this->input->ip_address();
		$postdata = $this->input->post();
		$qids = $this->_get_qids($postdata);
		$rid = $postdata['rid'];

		$preview = $this->input->post("preview");
		$previewState = "";
		if ($preview) {
			$is_db_store = false;
			$previewState = "?preview=true";
		} else {
			$is_db_store = true;
		}

		if (count($qids) > 0) {
			$question = $this->question_m->get_one_record($qids[0]);
			$page = $this->page_m->get_one_record($question['pid']);
//			$survey = $this->survey_m->get_one_record($page['sid']);
//			if ($survey['uid'] == get_loginid()) {
//				$is_db_store = false;
//			}
		}

		if ($is_db_store) {
			foreach ($qids as $cur_qid) {
				$cur_qtid = $this->_get_question_type_id($cur_qid);
				$answer_data = array();
				foreach ($postdata as $key => $value) {
					$category = explode(self::ANSWER_DELIMETER1, $key);
					$qid = $category[0];

					if (is_numeric($qid) == false)
						continue;

					if ($qid == $cur_qid) {
						$answer_data[$category[1]] = $value;
					}
				}
				switch ($cur_qtid) {
					case 1: //Multiple Choice (Only One Answer)
						$this->_receive_answer_multi_choice_one_answer($rid, $cur_qid, $ip, $answer_data);
						break;
					case 2: //Multiple Choice (Multiple Answers)
						$this->_receive_answer_multi_choice_multi_answer($rid, $cur_qid, $ip, $answer_data);
						break;
					case 3: // Comment/Essay Box
						$this->_receive_answer_essaybox($rid, $cur_qid, $ip, $answer_data);
						break;
					case 4: // Ranking
						$this->_receive_answer_ranking($rid, $cur_qid, $ip, $answer_data);
						break;
					case 5: // Matrix of Choices (Only One Answer per Row)
						$this->_receive_answer_matrix_one_answer($rid, $cur_qid, $ip, $answer_data);
						break;
					case 6: // Matrix of Choices (Multiple Answers per Row)
						$this->_receive_answer_matrix_multi_answer($rid, $cur_qid, $ip, $answer_data);
						break;
					case 7: // Matrix of Textboxes
						$this->_receive_answer_matrix_textbox($rid, $cur_qid, $ip, $answer_data);
						break;
					case 8: // Matrix of Drop-down Menus
						$this->_receive_answer_matrix_dropdown($rid, $cur_qid, $ip, $answer_data);
						break;
					case 9: // Single Textbox
						$this->_receive_answer_single_textbox($rid, $cur_qid, $ip, $answer_data);
						break;
					case 10: // Multiple Textbox
						$this->_receive_answer_multi_textbox($rid, $cur_qid, $ip, $answer_data);
						break;
					case 11:
						break;
					case 12: // Date/Time Box
						$this->_receive_answer_datetime_box($rid, $cur_qid, $ip, $answer_data);
						break;
				}
			}
		}

		$cur_sid = $this->input->post('sid');

		// find current page'sequence  inside pages that current survey have
		$pages = $this->page_m->get_pages($cur_sid);
		$cur_pid = $this->input->post('pid');
		foreach ($pages as $i => $page) {
			if ($page['pid'] == $cur_pid)
				break;
		}
		$next_seqno = $i + 2;

		if ($cur_pid == $pages[count($pages) - 1]['pid']) {
			// transmit answer data to real answer table
			$this->answer_temp_m->transmit_to_real($rid);
		}

		$this->session->set_flashdata('rid', $rid);
		redirect("/surveyview/s/$cur_sid/$next_seqno".$previewState);
	}

	function _receive_answer_multi_choice_one_answer($rid, $qid, $ip, $answer_data) {
		$answer = '';
		$comment = '';
		if (isset($answer_data['answer'])) {
			if ($answer_data['answer'] != 'other') {
				$answer = $answer_data['answer'];
			} else {
				$answer = $answer_data['answer_othertext'];
			}
		}
		if (isset($answer_data['comment']))
			$comment = $answer_data['comment'];

		$this->answer_temp_m->insert_answer($rid, $qid, $ip, $answer, $comment);
	}

	function _receive_answer_essaybox($rid, $qid, $ip, $answer_data) {
		$answer = '';
		$comment = '';
		if (isset($answer_data['answer'])) {
			$answer = $answer_data['answer'];
		}

		$this->answer_temp_m->insert_answer($rid, $qid, $ip, $answer, $comment);
	}

	function _receive_answer_ranking($rid, $qid, $ip, $answer_data) {
		$answer = '';
		$comment = '';
		$eval_data = array();
		/*		 * **		eval_data = array(
		  'C' => '2',
		  'A' => '1',
		  'B' => '3'
		  );
		 * **** */
		$q_config = $this->_get_question_config($qid);
		$q_v0 = $q_config['3']['q_v0'];
		$values = explode(self::VALUE_DELIMETER, $q_v0);
		
		foreach ($answer_data as $key => $value) {
			$category = explode(self::ANSWER_DELIMETER2, $key);
			if ($category[0] == 'answer') {
				$eval_data[$values[$category[1]]] = $value;
			} else if ($category[0] == 'comment') {
				$comment = $value;
			}
		}

		foreach ($values as $value) {
			$eval = $eval_data[$value];
			$answer = $this->_add_value($answer, $eval);
		}
		$this->answer_temp_m->insert_answer($rid, $qid, $ip, $answer, $comment);
	}

	function _add_value($src, $val) {
		if (strlen($src) > 0)
			$src .= self::VALUE_DELIMETER;
		if ($val == null) {
			$src .= self::EMPTY_VALUE;
		} else {
			$src .= $val;
		}

		return $src;
	}

	function _receive_answer_multi_choice_multi_answer($rid, $qid, $ip, $answer_data) {
		$answer_array = array();
		$comment = '';
		foreach ($answer_data as $key => $value) {
			$category = explode(self::ANSWER_DELIMETER2, $key);
			if ($category[0] == 'answer') {
				if ($category[1] == 'other') {
					
				} else if ($category[1] == 'othertext') {
					if (array_key_exists('answer_other', $answer_data))
						$answer_array[] = $value;
				} else {
					$answer_array[] = $value;
				}
			} else if ($category[0] == 'comment') {
				$comment = $value;
			}
		}

		$answer = json_encode($answer_array);
		$this->answer_temp_m->insert_answer($rid, $qid, $ip, $answer, $comment);
	}

	function _receive_answer_matrix_one_answer($rid, $qid, $ip, $answer_data) {
		$comment = '';
		$eval_data = array();

		$q_config = $this->_get_question_config($qid);
		$row_q_v0 = $q_config['8']['q_v0'];
		$values = explode(self::VALUE_DELIMETER, $row_q_v0);
		
		foreach ($answer_data as $key => $value) {
			$category = explode(self::ANSWER_DELIMETER2, $key);
			if ($category[0] == 'answer') {
				$eval_data[$values[$category[1]]] = $value;
			} else if ($category[0] == 'comment') {
				$comment = $value;
			}
		}

		$answer = json_encode($eval_data);
		$this->answer_temp_m->insert_answer($rid, $qid, $ip, $answer, $comment);
	}

	function _receive_answer_matrix_multi_answer($rid, $qid, $ip, $answer_data) {
		$answer = '';
		$comment = '';
		$eval_data = array();
		$EMPTY_VALUE_ARRAY = array('', ' ');

		$q_config = $this->_get_question_config($qid);
		$row_q_v0 = $q_config['8']['q_v0'];
		$col_q_v0 = $q_config['9']['q_v0'];
		$row_values = explode(self::VALUE_DELIMETER, $row_q_v0);
		$col_values = explode(self::VALUE_DELIMETER, $col_q_v0);
		$row_values = array_diff($row_values, $EMPTY_VALUE_ARRAY);
		$col_values = array_diff($col_values, $EMPTY_VALUE_ARRAY);

		foreach ($row_values as $i=>$row_value) {
			foreach ($col_values as $j=>$col_value) {
				$key = 'answer_' . $i . '_' . $j;
				if (array_key_exists($key, $answer_data)) {
					$eval_data[$row_value][$col_value] = 1;
				} else {
					$eval_data[$row_value][$col_value] = 0;
				}
			}
		}
		if (array_key_exists('comment', $answer_data)) {
			$comment = $answer_data['comment'];
		}
		$answer = json_encode($eval_data);
		$this->answer_temp_m->insert_answer($rid, $qid, $ip, $answer, $comment);
	}

	function _receive_answer_matrix_textbox($rid, $qid, $ip, $answer_data) {
		$answer = '';
		$comment = '';
		$eval_data = array();
		$EMPTY_VALUE_ARRAY = array('', ' ');

		$q_config = $this->_get_question_config($qid);
		$row_q_v0 = $q_config['8']['q_v0'];
		$col_q_v0 = $q_config['9']['q_v0'];
		$row_values = explode(self::VALUE_DELIMETER, $row_q_v0);
		$col_values = explode(self::VALUE_DELIMETER, $col_q_v0);
		$row_values = array_diff($row_values, $EMPTY_VALUE_ARRAY);
		$col_values = array_diff($col_values, $EMPTY_VALUE_ARRAY);

		foreach ($row_values as $i=>$row_value) {
			foreach ($col_values as $j=>$col_value) {
				$key = 'answer_' . $i . '_' . $j;
				$eval_data[$row_value][$col_value] = $answer_data[$key];
			}
		}
		if (array_key_exists('comment', $answer_data)) {
			$comment = $answer_data['comment'];
		}
		$answer = json_encode($eval_data);
		$this->answer_temp_m->insert_answer($rid, $qid, $ip, $answer, $comment);
	}

	function _receive_answer_matrix_dropdown($rid, $qid, $ip, $answer_data) {
		$answer = '';
		$comment = '';
		$eval_data = array();
		$EMPTY_VALUE_ARRAY = array('', ' ');

		$q_config = $this->_get_question_config($qid);
		$row_q_v0 = $q_config['8']['q_v0'];
		$col_q_v0 = $q_config['9']['q_v0'];
		$row_values = explode(self::VALUE_DELIMETER, $row_q_v0);
		$col_values = explode(self::VALUE_DELIMETER, $col_q_v0);
		$row_values = array_diff($row_values, $EMPTY_VALUE_ARRAY);
		$col_values = array_diff($col_values, $EMPTY_VALUE_ARRAY);

		foreach ($row_values as $i=>$row_value) {
			foreach ($col_values as $j=>$col_value) {
				$key = 'answer_' . $i . '_' . $j;
				$eval_data[$col_value][$row_value] = ($answer_data[$key] != null) ? $answer_data[$key] : '';
			}
		}
		if (array_key_exists('comment', $answer_data)) {
			$comment = $answer_data['comment'];
		}
		$answer = json_encode($eval_data);
		$this->answer_temp_m->insert_answer($rid, $qid, $ip, $answer, $comment);
	}

	function _receive_answer_single_textbox($rid, $qid, $ip, $answer_data) {
		$answer = '';
		$comment = '';

		if (array_key_exists('answer', $answer_data)) {
			$answer = $answer_data['answer'];
		}
		$this->answer_temp_m->insert_answer($rid, $qid, $ip, $answer, $comment);
	}

	function _receive_answer_multi_textbox($rid, $qid, $ip, $answer_data) {
		$answer = '';
		$comment = '';
		$EMPTY_VALUE_ARRAY = array('', ' ');

		$q_config = $this->_get_question_config($qid);
		$row_q_v0 = $q_config['3']['q_v0'];
		$row_values = explode(self::VALUE_DELIMETER, $row_q_v0);
		$row_values = array_diff($row_values, $EMPTY_VALUE_ARRAY);

		foreach ($row_values as $i=>$row_value) {
			$key = 'answer_' . $i;
			$eval_data[$row_value] = ($answer_data[$key] != null) ? $answer_data[$key] : '';
		}

		if (array_key_exists('comment', $answer_data)) {
			$comment = $answer_data['comment'];
		}
		$answer = json_encode($eval_data);
		$this->answer_temp_m->insert_answer($rid, $qid, $ip, $answer, $comment);
	}

	function _receive_answer_datetime_box($rid, $qid, $ip, $answer_data) {
		$answer = '';
		$comment = '';
		$eval_data = array();
		$EMPTY_VALUE_ARRAY = array('', ' ');

		$q_config = $this->_get_question_config($qid);
		if (isset($q_config['3'])) {
			$qdetail = $q_config['3'];
			$row_values = explode(self::VALUE_DELIMETER, $qdetail['q_v0']);
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
		foreach ($row_values as $i=>$row_value) {
			foreach ($col_values as $col_value) {
				$key = 'answer_' . $i . '_' . $col_value;
				$eval_data[$row_value][$col_value] = $answer_data[$key];
			}
		}
		if (array_key_exists('comment', $answer_data)) {
			$comment = $answer_data['comment'];
		}
		$answer = json_encode($eval_data);
		$this->answer_temp_m->insert_answer($rid, $qid, $ip, $answer, $comment);
	}

	function _get_qids($postdata) {

		$qids = array();
		foreach ($postdata as $key => $value) {
			$category = explode("_", $key);
			$qid = $category[0];

			if (is_numeric($qid) == false)
				continue;

			if (array_search($qid, $qids) === false)
				$qids[] = $qid;
		}

		return $qids;
	}

	function _get_question_type_id($qid) {
		$qestion = $this->question_m->get_one_record($qid);
		return $qestion['qtid'];
	}

}

?>
