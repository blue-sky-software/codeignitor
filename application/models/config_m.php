<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Config_m extends CI_Model {

	const TABLE = 'survey_config';
	const CID = 'cid';
	const DESCRIPTION = 'description';
	const STR_1 = 'str_value1';
	const STR_2 = 'str_value2';
	const STR_3 = 'str_value3';
	const STR_4 = 'str_value4';
	const STR_5 = 'str_value5';
	const INT_1 = 'int_value1';
	const INT_2 = 'int_value2';
	const INT_3 = 'int_value3';
	const INT_4 = 'int_value4';
	const INT_5 = 'int_value5';
	
	//
	const MAIL_CONFIG_ID = 1;
	const POINT_CONFIG_ID = 2;

	function __construct() {
		parent::__construct();
	}

	function get_mail_config() {
		$sql = "SELECT " . self::STR_1 . " as subject, " . self::STR_2 . " as message FROM " . self::TABLE . " WHERE " . self::CID . "=". self::MAIL_CONFIG_ID;
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result[0];
	}

	function set_mail_config($subject, $message) {
		$this->db->where(self::CID, self::MAIL_CONFIG_ID);
		$this->db->set(self::STR_1, $subject);
		$this->db->set(self::STR_2, $message);
		$this->db->update(self::TABLE);
	}

	function get_point_config() {
		$sql = "SELECT " . self::INT_1 . " as p1, " . self::INT_2 . " as p2 FROM " . self::TABLE . " WHERE " . self::CID . "=". self::POINT_CONFIG_ID;
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result[0];
	}

	function set_point_config($p1, $p2) {
		$this->db->where(self::CID, self::POINT_CONFIG_ID);
		$this->db->set(self::INT_1, $p1);
		$this->db->set(self::INT_2, $p2);
		$this->db->update(self::TABLE);
	}

}
