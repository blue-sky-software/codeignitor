<?php

class SurveyCollect extends CI_Controller {

	function __construct() {
		parent::__construct();

		$this->load->model('surveyedit_m');
		$this->load->model('page_m');
		$this->load->model('question_m');
		$this->load->model('question_detail_m');
		$this->load->model('answer_option_m');
		$this->load->model('survey_m');
	}

	function loadView($sid) {
		$survey = $this->surveyedit_m->get_survey($sid);

		$templateData = array('name' => 'surveyedit');
		$viewData = array(
			'Title' => $survey[0]['title'],
			'SID' => $survey[0]['sid'],
			's_url' => $survey[0]['redirect_url'],
			's_status' => $survey[0]['status']
		);

		$this->load->view('template/beginheader', $templateData);
		$this->load->view('template/header');
		$this->load->view('surveycollect_v', $viewData);
		$this->load->view('template/footer');
		$this->load->view('template/endfooter', $templateData);
	}

	function index($sid) {
		if (!is_user_logined())
			redirect('/auth/login');

		if (!$this->survey_m->is_owned(get_loginid(), $sid))
			redirect('/auth/login');

		if ($this->session->userdata('auth_code') >= '7') {
			
		}
		$this->loadView($sid);
	}
	
	function set_survey_status($sid) {

		$key = $this->input->post('key');

		$survey = $this->survey_m->get_one_record($sid);
		if ($survey[Survey_m::STATUS] == Survey_m::OFFLINE || $survey[Survey_m::STATUS] == Survey_m::ONLINE) {
			if ($key =="true") {
				$this->survey_m->set_one_field($sid, Survey_m::STATUS, Survey_m::ONLINE);
			} else {
				$this->survey_m->set_one_field($sid, Survey_m::STATUS, Survey_m::OFFLINE);
			}
		}
	}

}

/* End of file main.php */
/* Location: ./application/controllers/mian.php */