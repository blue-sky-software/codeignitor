<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Question_m extends CI_Model {

	const TABLE = 'survey_question';   // user accounts
	const QID = 'qid';
	const PID = 'pid';
	const QTID = 'qtid';
	const QUESTION = 'question';
	const STATUS = 'status';
	const IS_DELETED = 'is_deleted';
	const CREATE_DATE = 'createdate';
	const UPDATE_DATE = 'updatedate';
	const Q_ORDER = 'q_order';

	function __construct() {
		parent::__construct();

		$this->load->model('question_detail_m');
		$this->load->model('answer_m');
	}

	function create_question($pid, $qtid, $question = "") {
		$sql = "INSERT INTO " . self::TABLE . " (" . self::PID . ", " . self::QTID . ", " . self::QUESTION . ", " . self::CREATE_DATE . ", " . self::UPDATE_DATE . ") 
				VALUES ('" . $pid . "', '" . $qtid . "', '" . addslashes($question) . "', NOW(), NOW())";

		$this->db->query($sql);
		$insert_id = $this->db->insert_id();
		$this->db->where(self::QID, $insert_id);
		$this->db->set(self::Q_ORDER, $insert_id);
		$this->db->update(self::TABLE);

		return $insert_id;
	}

	function get_questions($pid) {
		$this->db->where(self::PID, $pid);
		$this->db->where(self::IS_DELETED, '0');
		$this->db->order_by(self::Q_ORDER);
		$query = $this->db->get(self::TABLE);
		return $query->result_array();
	}

	function get_one_record($qid) {
		$this->db->where(self::QID, $qid);
		$this->db->where(self::IS_DELETED, '0');
		$query = $this->db->get(self::TABLE);

		if ($query->num_rows() > 0) {
			$res_ary = $query->result_array();
			return $res_ary[0];
		}
		else
			return null;
	}

	function del_one_question($qid) {
		$this->db->where(self::QID, $qid);
		$this->db->set(self::IS_DELETED, '1');
		$this->db->update(self::TABLE);

		$this->question_detail_m->del_question_detail($qid);
		
		$this->answer_m->del_answers($qid);
	}

	function insert_question($pid, $qid, $qtid, $question = "") {
		$this->db->where(self::QID, $qid);
		$query = $this->db->get(self::TABLE);
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
			$order = $result[0][self::Q_ORDER];

			// get all question list
			$questions = $this->get_questions($pid);

			$insert_id = $this->create_question($pid, $qtid, $question);
			$this->db->where(self::QID, $insert_id);
			$this->db->set(self::Q_ORDER, $order);
			$this->db->update(self::TABLE);
			foreach ($questions as $question) {
				if ($question[self::Q_ORDER] >= $order) {
					$this->db->where(self::QID, $question[self::QID]);
					$this->db->set(self::Q_ORDER, $question[self::Q_ORDER] + 1);
					$this->db->update(self::TABLE);
				}
			}
		}

		return $insert_id;
	}

	function update_question($qid, $qtid, $question = "") {
		$this->db->where(self::QID, $qid);
		$this->db->set(self::QTID, $qtid);
		$this->db->set(self::QUESTION, $question);
		$this->db->update(self::TABLE);
	}

	function move_up_question($qid) {
		$cur = $this->get_one_record($qid);
		$class = $this->get_questions($cur[self::PID]);

		$target = 0;
		foreach ($class as $question) {
			if ($question[self::Q_ORDER] < $cur[self::Q_ORDER])
				$target++;
		}
		if ($target > 0) {
			$target--;

			$target_order = $class[$target][self::Q_ORDER];
			$target_qid = $class[$target][self::QID];

			$this->set_order_question($target_qid, $cur[self::Q_ORDER]);
			$this->set_order_question($qid, $target_order);
		}
	}

	function move_down_question($qid) {
		$cur = $this->get_one_record($qid);
		$class = $this->get_questions($cur[self::PID]);

		$target = 0;
		foreach ($class as $question) {
			$target++;
			if ($question[self::Q_ORDER] == $cur[self::Q_ORDER])
				break;
		}
		if ($target < sizeof($class)) {
			$target_order = $class[$target][self::Q_ORDER];
			$target_qid = $class[$target][self::QID];

			$this->set_order_question($target_qid, $cur[self::Q_ORDER]);
			$this->set_order_question($qid, $target_order);
		}
	}

	function set_order_question($qid, $order_no) {
		$this->db->where(self::QID, $qid);
		$this->db->set(self::Q_ORDER, $order_no);
		$this->db->update(self::TABLE);
	}

	function copy_question($src_pid, $tgt_pid) {
		$questions = $this->get_questions($src_pid);

		foreach ($questions as $question) {

			$tgt_qid = $this->create_question($tgt_pid, $question[self::QTID], $question[self::QUESTION]);

			$this->question_detail_m->copy_question_detail($question[self::QID], $tgt_qid);
		}
	}

	function del_questions($pid) {
		$questions = $this->get_questions($pid);

		foreach ($questions as $question) {

			$this->del_one_question($question[self::QID]);
		}
	}

}
