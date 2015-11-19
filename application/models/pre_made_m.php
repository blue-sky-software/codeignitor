<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Pre_Made_m extends CI_Model {

	const TABLE = 'survey_pre_made';   // 
	const PMID = 'pmid';
	const VALUE = 'value';
	const NAME = 'name';
	const CONTENT = 'content';
	const STATUS = 'status';

	function __construct() {
		parent::__construct();
	}

	function get_pre_made($value) {
		$this->db->where(self::VALUE, $value);

		$query = $this->db->get(self::TABLE);

		return $query->result_array();
	}

	function get_pre_made_list() {

		$query = $this->db->get(self::TABLE);

		return $query->result_array();
	}
}
