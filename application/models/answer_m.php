<?php

class Answer_m extends CI_Model {

	const TABLE = 'survey_answer';
	const AID = 'aid';
	const QID = 'qid';
	const RID = 'rid';
	const IPADDR = 'ipaddr';
	const ANSWERDATE = 'answerdate';
	const STATUS = 'status';
	const IS_DELETED = 'is_deleted';
	const ANSWER = 'answer_choice';
	const COMMENT = 'answer_comment';

	function __construct() {
		parent::__construct();
	}

	function get_max_rid() {
		$this->db->select_max(self::RID, 'max_rid');
		$query = $this->db->get(self::TABLE);
		if($query->num_rows() > 0) {
			$res = $query->result_array();
			return $res[0]['max_rid'];
		} else {
			return null;
		}
	}

	function insert_answer($rid, $qid, $ip, $answer, $comment) {
		$this->db->set(self::QID, $qid);
		$this->db->set(self::RID, $rid);
		$this->db->set(self::IPADDR, $ip);
		$curdate = date("y-m-d");
		$this->db->set(self::ANSWERDATE, $curdate);
		$this->db->set(self::ANSWER, $answer);
		$this->db->set(self::COMMENT, $comment);
		$this->db->insert(self::TABLE);
	}

	// count record that selected the value among qid
	function get_respond_cnt_by_value($qid, $value) {
		$this->db->where(self::QID, $qid);
		$this->db->like(self::ANSWER, $value);
		$query = $this->db->get(self::TABLE);
		return $query->num_rows();
	}

	function get_answered_cnt($qid) {
//		$this->db->where(self::QID, $qid);
//		$this->db->where(self::ANSWER.'!=', '');
//		$this->db->where(self::ANSWER.'!=', 'NULL');
		$this->db->where(array('qid' => $qid, 'answer_choice !=' => '', 'answer_choice !=' => 'NULL'));
		$query = $this->db->get(self::TABLE);
		return $query->num_rows();
	}

	function get_skipped_cnt($qid) {
		$this->db->where(self::QID, $qid);
		$this->db->where(self::ANSWER, '');
		$this->db->or_where(self::ANSWER, 'NULL');
		$query = $this->db->get(self::TABLE);
		return $query->num_rows();
	}

	function get_records($qid) {
		$this->db->where(self::QID, $qid);
		$query = $this->db->get(self::TABLE);
		return $query->result_array();
	}

	function get_answerfield_records($qid) {
		$this->db->where(self::QID, $qid);
		$query = $this->db->get(self::TABLE);
		$full_records = $query->result_array();

		$ret_records = array();
		foreach ($full_records as $full_record) {
			$ret_records[] = $full_record['answer_choice'];
		}
		return $ret_records;
	}

	function del_answers($qid) {
		$this->db->where(self::QID, $qid);
		$this->db->set(self::IS_DELETED, '1');
		$this->db->update(self::TABLE);
	}

}

?>
