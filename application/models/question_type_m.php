<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Question_Type_m extends CI_Model {

    const TABLE = 'survey_question_type';
    const QTID = 'qtid';
    const PID = 'pid';
    const NAME = 'name';
    const IMAGEURL = 'image_url';
    const STATUS = 'status';

    function __construct() {
        parent::__construct();
    }

    function create_question_type($qtid, $pid, $name, $url) {
        $sql = "INSERT INTO " . self::TABLE . " (" . self::QTID . ", " . self::PID . ", " . self::NAME . ", " . self::IMAGEURL . ") 
				VALUES ('" . $qtid . "', '" . $pid . "', " . $name . ", " . $url . ")";

        $this->db->query($sql);

        return TRUE;
    }

    function get_list() {
        $query = $this->db->get(self::TABLE);
        if ($query->num_rows() > 0)
            return $query->row();
        else
            return NULL;
    }

}

