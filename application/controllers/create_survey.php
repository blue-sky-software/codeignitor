<?php

class Create_Survey extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('survey_m');
		$this->load->model('page_m');
		$this->load->model('question_m');
		$this->load->model('question_detail_m');
	}

	function index() {
		if (!is_user_logined())
			redirect('/auth/login');

		if ($this->session->userdata('auth_code') >= '7') {
			
		}

		$SurveyList = $this->survey_m->get_surveys(get_loginid());

		$templateData = array('name' => 'create_survey');
		$viewData = array(
			'Title' => 'Create New Survey',
			'SurveyList' => $SurveyList
		);
		$this->load->view('template/beginheader', $templateData);
		$this->load->view('template/header');
		$this->load->view('create_survey_v', $viewData);
		$this->load->view('template/footer');
		$this->load->view('template/endfooter', $templateData);
	}

	function create() {
		if (!is_user_logined())
			redirect('/auth/login');

		$title = $this->input->post("title");
		$lang = $this->input->post("lang");
		if ($title) {
			$this->db->trans_start();
			$sid = $this->survey_m->create_survey(get_loginid(), $title, $lang);
			$this->page_m->create_page($sid);
			$this->db->trans_complete();
			echo $sid;
		}
	}

	function copy() {
		if (!is_user_logined())
			redirect('/auth/login');

		$title = $this->input->post("title");
		$sid = $this->input->post("survey");

		if (!$this->survey_m->is_owned(get_loginid(), $sid))
			redirect('/auth/login');

		if ($title) {
			$this->db->trans_start();

			$sid = $this->survey_m->copy_survey(get_loginid(), $sid, $title);

			$this->db->trans_complete();
			echo $sid;
		}
	}

}

/* End of file main.php */
/* Location: ./application/controllers/mian.php */