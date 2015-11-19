<?PHP

class SurveyEdit_m extends CI_Model {

	function __construct() {
		parent::__construct();
	}
	
	function get_survey($sid) {
		$this->db->where('sid', $sid);
		$query = $this->db->get('survey_survey');
		return $query->result_array();
	}
	

	function get_questions($sid) {
		$this->db->where('sid', $sid);
		$query = $this->db->get('survey_question');
		return $query->result_array();
	}
	
	function get_question($qid) {
		$this->db->where('qid', $qid);
		$query = $this->db->get('survey_question');
		return $query->result_array();
	}
}

?>