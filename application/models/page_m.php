<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Page_m extends CI_Model {

	const TABLE = 'survey_page';   // user accounts
	const PID = 'pid';
	const SID = 'sid';
	const TITLE = 'title';
	const DESC = 'description';
	const STATUS = 'status';
	const ORDER = 'p_order';
	const IS_DELETED = 'is_deleted';
	const CREATE_DATE = 'createdate';
	const UPDATE_DATE = 'updatedate';

	function __construct() {
		parent::__construct();

		$this->load->model('question_m');
	}

	function create_page($sid, $title = "Page1", $desc = "") {

		$sql = "INSERT INTO " . self::TABLE . " (" . self::SID . ", " . self::TITLE . ", " . self::DESC . ", " . self::ORDER . ", " . self::CREATE_DATE . ", " . self::UPDATE_DATE . ") 
				VALUES ('" . $sid . "', '" . addslashes($title) . "', '" . addslashes($desc) . "', '" . self::PID . "', NOW(), NOW())";

		$this->db->query($sql);
		$insert_id = $this->db->insert_id();
		$this->db->where(self::PID, $insert_id);
		$this->db->set(self::ORDER, $insert_id);
		$this->db->update(self::TABLE);
		return $insert_id;
	}

	function insert_page($sid, $pid, $title = "Page1", $desc = "") {
		$this->db->where(self::PID, $pid);
		$query = $this->db->get(self::TABLE);
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
			$order = $result[0][self::ORDER];

			// get all page list
			$pages = $this->get_pages($sid);

			$this->db->trans_start();
			$insert_id = $this->create_page($sid, $title, $desc);
			$this->db->where(self::PID, $insert_id);
			$this->db->set(self::ORDER, $order);
			$this->db->update(self::TABLE);
			foreach ($pages as $page) {
				if ($page[self::ORDER] >= $order) {
					$this->db->where(self::PID, $page[self::PID]);
					$this->db->set(self::ORDER, $page[self::ORDER] + 1);
					$this->db->update(self::TABLE);
				}
			}
			$this->db->trans_complete();
		}

		return $insert_id;
	}

	function edit_page($pid, $title = "Page1", $desc = "") {
		$this->db->trans_start();
		$this->db->where(self::PID, $pid);
		$this->db->set(self::TITLE, $title);
		$this->db->set(self::DESC, $desc);
		$this->db->update(self::TABLE);
		$this->db->trans_complete();
	}

	function get_pages($sid) {
		$this->db->where(self::SID, $sid);
		$this->db->where(self::IS_DELETED, '0');
		$this->db->order_by(self::ORDER);
		$query = $this->db->get(self::TABLE);
		return $query->result_array();
	}

	function get_sid($pid) {
		$this->db->where(self::PID, $pid);
		$query = $this->db->get(self::TABLE);
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
			return $result[0][self::SID];
		}
		else
			return null;
	}

	function del_one_page($pid) {
		$this->db->where(self::PID, $pid);
		$this->db->set(self::IS_DELETED, '1');
		$this->db->update(self::TABLE);

		$this->question_m->del_questions($pid);
	}

	function get_one_record($pid) {
		$this->db->where(self::PID, $pid);
		$query = $this->db->get(self::TABLE);
		if ($query->num_rows > 0) {
			$result = $query->result_array();
			return $result[0];
		}
		else
			return null;
	}

	function copy_page($src_sid, $tgt_sid) {

		$pages = $this->get_pages($src_sid);

		foreach ($pages as $page) {
			$tgt_pid = $this->create_page($tgt_sid, $page[self::TITLE], $page[self::DESC]);

			$this->question_m->copy_question($page[self::PID], $tgt_pid);
		}
	}

	function del_page($sid) {
		$pages = $this->get_pages($sid);

		foreach ($pages as $page) {
			$this->del_one_page($page[self::PID]);
		}
	}

}
