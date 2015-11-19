<?php

class MySurvey extends CI_Controller {

	function __construct() {
		parent::__construct();

		$this->load->model('survey_m');
		$this->load->model('config_m');
	}

	function index() {
		if (!is_user_logined())
			redirect('/auth/login');

		if ($this->session->userdata('auth_code') >= '7') {
			
		}

		$sort = "none";
		$surveys = $this->survey_m->getSurveys(get_loginid(), $sort);

		$templateData = array('name' => 'mysurvey');
		$data = array(
			'Title' => 'My Surveys',
			'surveys' => $surveys);
		$this->load->view('template/beginheader', $templateData);
		$this->load->view('template/header');
		$this->load->view('mysurvey_v', $data);
		$this->load->view('template/footer');
		$this->load->view('template/endfooter', $templateData);
	}

	function get_surveys() {
		$listsize = $this->input->post('listsize');
		$pageno = $this->input->post('pageno');
		$searchkey = $this->input->post('searchkey');
		$sort = $this->input->post('sort');
		$offset = ($pageno - 1) * $listsize;

		$filter = array();
		if ($searchkey != '' && $searchkey != NULL)
			$filter['title'] = $searchkey;

		$point_config = $this->config_m->get_point_config();
		$surveys = $this->survey_m->getSurveys(get_loginid(), $sort, $offset, $listsize, $filter);
		foreach ($surveys as &$survey) {
			$response = $this->survey_m->get_respondent_cnt($survey['sid']);
			
			$s = $this->survey_m->get_one_record($survey['sid']);
			
			$point = $point_config->p2 * $response / 2;
			if($s[Survey_m::STATUS] == Survey_m::ONLINE)
				$point += $point_config->p1;
			$survey['point'] = $point;
		}
		$data['surveys'] = $surveys;

		echo $this->load->view('mysurvey_list', $data);
	}

	function j_get_totalcount() {
		$searchkey = $this->input->post('searchkey');

		$filter = array();
		if ($searchkey != '' && $searchkey != NULL)
			$filter['title'] = $searchkey;

		$data['total_count'] = count($this->survey_m->getSurveys(get_loginid(), 0, NULL, NULL, $filter));

		echo json_encode($data);
	}

	function del_survey($sid) {
		$this->db->trans_start();
		$this->survey_m->del_survey($sid);
		$this->db->trans_complete();
	}

	function clear_survey($sid) {
		$this->db->trans_start();
		$this->survey_m->clear_survey($sid);
		$this->db->trans_complete();
	}
}

/* End of file main.php */
/* Location: ./application/controllers/mian.php */