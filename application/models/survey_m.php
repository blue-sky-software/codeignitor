<?PHP

class Survey_m extends CI_Model {

	const TABLE = "survey_survey";
	const SID = "sid";
	const UID = "uid";
	const TITLE = "title";
	const LANG = "language";
	const STATUS = "status";
	const IS_DELETED = "is_deleted";
	const CREATE_DATE = "create_date";
	const UPDATE_DATE = "update_date";
	const URL = "redirect_url";
	const TEMPLATE = "template";
	const IS_ONE_RESPONSE = "is_response_one_computer";
	const IS_PROGRESSBAR = "is_enable_progressbar";
	const IS_SAVE_CONTINUE = "is_save_continue";
	const CUT_OFF_DATE = "cut_off_date";
	const MAX_RESPONSE = "max_response";
	const WELCOME_TITLE = "welcome_title";
	const WELCOME_CONTENT = "welcome_content";
	const THANKYOU_TITLE = "thankyou_title";
	const THANKYOU_CONTENT = "thankyou_content";
	const SC_FROM_EMAIL = "sc_from_email";
	const SC_SUBJECT = "sc_subject";
	const SC_MESSAGE = "sc_message";

	// constant
	const ONLINE = "ONLINE";
	const OFFLINE = "OFFLINE";
//	const ALLOWED = "ALLOWED";
	const SUSPENDED = "SUSPENDED";
	const CLOSED = "CLOSED";

	function __construct() {
		parent::__construct();

		$this->load->model('page_m');
	}

	function create_survey($uid, $title = "", $lang = 1) {
		$sql = "INSERT INTO " . self::TABLE . " (" . self::UID . ", " . self::TITLE . ", " . self::LANG . ", " . self::CREATE_DATE . ", " . self::UPDATE_DATE . ", " . self::CUT_OFF_DATE . ") 
				VALUES ('" . $uid . "', '" . addslashes($title) . "', '" . $lang . "', NOW(), NOW(), NOW())";
		$this->db->query($sql);

		//get survey
		$insertid = $this->db->insert_id();
		$survey = $this->get_one_record($insertid);


		// setting default value 
		$this->db->where(self::SID, $insertid);

		// url
		$url = BASEURL . "index.php/surveyview/s/$insertid/0";
		$this->db->set(self::URL, $url);

		// status
		$this->db->set(self::STATUS, self::OFFLINE);

		// max response count
		$this->db->set(self::MAX_RESPONSE, 1000);

		// cut-off date
		$date = DateTime::createFromFormat('Y-m-d', $survey[self::CUT_OFF_DATE]);
		$newdate = new DateTime();
		$newdate->setDate($date->format("Y") + 1, $date->format("m"), $date->format("d"));
		$this->db->set(self::CUT_OFF_DATE, $newdate->format("Y-m-d"));

		// welcome / thankyou message
		$this->db->set(self::WELCOME_TITLE, "Welcome to Professor Survey!");
		$this->db->set(self::WELCOME_CONTENT, "Please click Next to response survey.");
		$this->db->set(self::THANKYOU_TITLE, "You have completed this survey!");
		$this->db->set(self::THANKYOU_CONTENT, "Thank you for taking the time to answer this survey!");

		// save and continue filed 
		$this->db->set(self::SC_FROM_EMAIL, "");
		$this->db->set(self::SC_SUBJECT, "Survey Continue Link");
		$this->db->set(self::SC_MESSAGE, "Dear [NAME],\r\n\r\nYou have requested to save and continue your survey response. Please use the following details to continue when you wish.\r\n\r\nSurvey: [SURVEY_TITLE]\r\n\r\nContinue Link: [SURVEY_LINK]\r\n\r\nRegards,\r\nSmartSurvey Software\r\nhttp://www.professor.co.uk/");

		$this->db->update(self::TABLE);

		return $insertid;
	}

	function copy_survey($uid, $sid, $title = "") {

		$survey = $this->get_one_record($sid);

		$insertid = $this->create_survey($uid, $title, $survey[self::LANG]);

		$this->page_m->copy_page($sid, $insertid);

		return $insertid;
	}

	function getSurveys($uid, $sort, $offset = 0, $limit = NULL, $filter = NULL) {

		$sql = "SELECT S.*, U.email FROM survey_survey AS S LEFT JOIN survey_user AS U ON S.uid=U.uid ";

//		$this->db->where(self::IS_DELETED, '0');
		$sql .= "WHERE S.is_deleted='0' ";

		if ($uid != NULL) {
			$sql .= "AND S.uid='" . $uid . "' ";
		}

		if ($filter != NULL) {
//			$this->db->like(self::TITLE, $filter['title']);
			$sql .= "AND " . self::TITLE . " LIKE '%" . $filter['title'] . "%'	";
		}
		if ($sort === "bytitle") {
//			$this->db->order_by(self::TITLE, "asc");
			$sql .= "ORDER BY " . self::TITLE . " ASC		";
		} else if ($sort === "bycreated") {
//			$this->db->order_by(self::CREATE_DATE, "asc");
			$sql .= "ORDER BY " . self::CREATE_DATE . " ASC		";
		} else {
//			$this->db->order_by(self::SID, "desc");
			$sql .= "ORDER BY " . self::SID . " ASC		";
		}

		if ($limit != NULL) {
//			$query = $this->db->get(self::TABLE, $limit, $offset);
			$sql .= "LIMIT $offset, $limit	";
		} else {
//			$query = $this->db->get(self::TABLE);
		}

		$query = $this->db->query($sql);

		return $query->result_array();
	}

	function get_surveytotalcnt() {
		$this->db->where(self::IS_DELETED, '0');
		$query = $this->db->get(self::TABLE);

		return $query->num_rows();
	}

	function suspend_survey($sid) {
		$this->db->where(self::SID, $sid);
		$this->db->set(self::STATUS, self::SUSPENDED);
		$this->db->update(self::TABLE);
	}

	function del_survey($sid) {
		$this->page_m->del_page($sid);

		$this->db->where(self::SID, $sid);
		$this->db->set(self::IS_DELETED, '1');
		$this->db->update(self::TABLE);
	}

	function clear_survey($sid) {
		$this->page_m->del_page($sid);
	}

	function online_survey($sid) {
		$this->db->where(self::SID, $sid);
		$this->db->set(self::STATUS, self::ONLINE);
		$this->db->update(self::TABLE);
	}

	function get_one_record($sid) {
		$this->db->where(self::SID, $sid);
		$this->db->where(self::IS_DELETED, '0');
		$query = $this->db->get(self::TABLE);
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
			return $result[0];
		}
		else
			return null;
	}

	function set_one_field($sid, $field, $value) {
		$this->db->where(self::SID, $sid);
		$this->db->set($field, $value);
		$this->db->update(self::TABLE);
	}

	function set_themeno($sid, $themeno) {
		$this->db->where(self::SID, $sid);
		$this->db->set(self::TEMPLATE, $themeno);
		$this->db->update(self::TABLE);
	}

	function set_setting($sid, $setting) {
		$this->db->where(self::SID, $sid);
		$this->db->set(self::IS_ONE_RESPONSE, $setting['response_one_computer']);
		$this->db->set(self::IS_PROGRESSBAR, $setting['enable_progressbar']);
		$this->db->set(self::IS_SAVE_CONTINUE, $setting['save_continue']);
		$date = DateTime::createFromFormat('m/d/Y', $setting['set_cut_off_date']);
		$this->db->set(self::CUT_OFF_DATE, $date->format('Y-m-d'));
		$this->db->set(self::MAX_RESPONSE, $setting['set_max_response']);

		if ($setting['save_continue'] == "on") {
			$this->db->set(self::SC_FROM_EMAIL, $setting[self::SC_FROM_EMAIL]);
			$this->db->set(self::SC_SUBJECT, $setting[self::SC_SUBJECT]);
			$this->db->set(self::SC_MESSAGE, $setting[self::SC_MESSAGE]);
		}

		$this->db->update(self::TABLE);
	}

	function get_respondent_cnt_by_uid($uid) {
		$sql = "SELECT COUNT(DISTINCT A.rid) AS numrows FROM survey_answer AS A		" .
				"INNER JOIN survey_question AS Q	" .
				"ON A.qid=Q.qid		" .
				"INNER JOIN survey_page AS P	" .
				"ON Q.pid=P.pid		" .
				"INNER JOIN survey_survey AS S	" .
				"ON S.sid=P.sid		" .
				"WHERE S.uid='" . $uid . "'		";

		$query = $this->db->query($sql);
		if ($query->num_rows() == 0)
			return '0';

		$row = $query->row();
		return $row->numrows;
	}

	function get_respondent_cnt($sid) {
		$sql = "SELECT COUNT(DISTINCT A.rid) AS numrows FROM survey_answer AS A		" .
				"INNER JOIN survey_question AS Q	" .
				"ON A.qid=Q.qid		" .
				"INNER JOIN survey_page AS P	" .
				"ON Q.pid=P.pid		" .
				"WHERE P.sid='" . $sid . "'		";

		$query = $this->db->query($sql);
		if ($query->num_rows() == 0)
			return '0';

		$row = $query->row();
		return $row->numrows;
	}
	
	function get_patial_cnt($sid) {
		$sql = "SELECT COUNT(DISTINCT A.rid) AS numrows FROM survey_answer_temp AS A		" .
				"INNER JOIN survey_question AS Q	" .
				"ON A.qid=Q.qid		" .
				"INNER JOIN survey_page AS P	" .
				"ON Q.pid=P.pid		" .
				"WHERE P.sid='" . $sid . "'		";

		$query = $this->db->query($sql);
		if ($query->num_rows() == 0)
			return '0';

		$row = $query->row();
		return $row->numrows;
	}

	function is_existed_respondent($sid, $ip) {
		$sql = "SELECT COUNT( DISTINCT A.rid) AS numrows FROM survey_answer AS A		" .
				"INNER JOIN survey_question AS Q	" .
				"ON A.qid=Q.qid		" .
				"INNER JOIN survey_page AS P	" .
				"ON Q.pid=P.pid		" .
				"WHERE P.sid='" . $sid . "' AND A.ipaddr='" . $ip . "'	";

		$query = $this->db->query($sql);
		if ($query->num_rows() == 0)
			return false;

		return true;
	}

	function get_surveys($uid) {
		$this->db->where(self::UID, $uid);
		$this->db->where(self::IS_DELETED, '0');
		$query = $this->db->get(self::TABLE);
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
			return $result;
		}
		else
			return null;
	}

	function is_owned($uid, $sid) {
		$this->db->where(self::UID, $uid);
		$this->db->where(self::SID, $sid);
		$this->db->where(self::IS_DELETED, '0');
		$query = $this->db->get(self::TABLE);
		if ($query->num_rows() > 0)
			return true;
		else
			return false;
	}

}

?>