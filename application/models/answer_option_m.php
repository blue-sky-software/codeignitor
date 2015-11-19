<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Answer_Option_m extends CI_Model {

	const TABLE = 'survey_answer_option';
	const AOID = 'aoid';
	const QTID = 'qtid';
	const NAME = 'name';
	const AOTID = 'aotid';
	const STATUS = 'status';
	const ORDER = 'ao_order';

	function __construct() {
		parent::__construct();
	}

	function create_answer_option($aoid, $qtid, $name, $aotid) {
		$sql = "INSERT INTO " . self::TABLE . " (" . self::AOID . ", " . self::QTID . ", " . self::NAME . ", " . self::AOTID . ") 
				VALUES ('" . $aoid . "', '" . $qtid . "', " . addslashes($name) . ", " . $aotid . ")";

		$this->db->query($sql);

		return TRUE;
	}

	function get_answer_option($aoid) {
		$this->db->where(self::AOID, $aoid);
		$query = $this->db->get(self::TABLE);
		return $query->result_array();
	}

	function get_answer_options($qtid) {
		$this->db->where(self::QTID, $qtid);
		$this->db->order_by(self::ORDER);
		$query = $this->db->get(self::TABLE);
		return $query->result_array();
	}

}

