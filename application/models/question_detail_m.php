<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Question_Detail_m extends CI_Model {

	const TABLE = 'survey_question_detail';   // 
	const AOTABLE = 'survey_answer_option';   // 
	const QDID = 'qdid';
	const QID = 'qid';
	const AOID = 'aoid';
	const V0 = 'q_v0';
	const V1 = 'q_v1';
	const V2 = 'q_v2';
	const V3 = 'q_v3';
	const V4 = 'q_v4';
	const V5 = 'q_v5';
	const V6 = 'q_v6';
	const V7 = 'q_v7';
	const V8 = 'q_v8';
	const V9 = 'q_v9';
	const STATUS = 'status';
	const IS_DELETED = 'is_deleted';

	function __construct() {
		parent::__construct();
	}

	function create_question_detail($qid, $aoid, $value) {
		$sql = "INSERT INTO " . self::TABLE . " (" . self::QID . ", " . self::AOID . ", " . self::V0 . ") 
				VALUES ('" . $qid . "', '" . $aoid . "', '" . addslashes($value) . "')";

		$this->db->query($sql);

		return TRUE;
	}

	function get_question_detail($qid) {
		$this->db->where(self::QID, $qid);
		$this->db->where(self::IS_DELETED, '0');
		$query = $this->db->get(self::TABLE);
		return $query->result_array();
	}

	function get_question_detail_with_aotype($qid) {
		$sql = "SELECT A.qid as qid, A.aoid as aoid, A.q_v0 as value, B.qtid as qtid, B.type as aotype FROM " . self::TABLE . " as A LEFT JOIN  " . self::AOTABLE . " as B ON A.aoid = B.aoid WHERE A.qid = ? ";
		$query = $this->db->query($sql, array($qid));

//		$this->db->select('survey_question_detail.aoid as aoid, survey_question_detail.q_v0 as value, survey_answer_option.qtid as qtid');
//		$this->db->from(self::TABLE);
//		$this->db->join('survey_answer_option', 'survey_question_detail.aoid = survey_answer_option.aoid', "inner");
//		$this->db->where(self::QID, $qid);
//		$query = $this->db->get();
		return $query->result_array();
	}

	function del_question_detail($qid) {
		$this->db->where(self::QID, $qid);
		$this->db->set(self::IS_DELETED, '1');
		$this->db->update(self::TABLE);
	}

	function del_physical_question_detail($qid) {
		$this->db->where(self::QID, $qid);
		$this->db->delete(self::TABLE);
	}

	function copy_question_detail($src_qid, $tgt_qid) {
		$keylist = $this->get_question_detail($src_qid);
		foreach ($keylist as $key) {
			$this->create_question_detail($tgt_qid, $key[self::AOID], $key[self::V0]);
		}
	}

}

