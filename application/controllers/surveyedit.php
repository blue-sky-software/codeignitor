<?php

class SurveyEdit extends MY_Controller {

	const CAT_DESIGN = 0;
	const CAT_THEME = 1;
	const CAT_SETTING = 2;
	const COUNT_THEME = 5;

	function __construct() {
		parent::__construct();

		$this->load->model('surveyedit_m');
		$this->load->model('page_m');
		$this->load->model('question_m');
		$this->load->model('question_detail_m');
		$this->load->model('answer_option_m');
		$this->load->model('survey_m');
	}

	function loadView($sid, $cat = self::CAT_DESIGN) {
		$survey = $this->surveyedit_m->get_survey($sid);
		$pages = $this->page_m->get_pages($sid);

		foreach ($pages as &$page) {
			$questions = $this->question_m->get_questions($page['pid']);
			foreach ($questions as &$question) {
				$question['question_html'] = $this->_make_question_content_html($question['qid']);
			}
			$page['questions'] = $questions;
		}

		$templateData = array('name' => 'surveyedit');
		$viewData = array(
			'Title' => $survey[0]['title'],
			'SID' => $survey[0]['sid'],
			's_url' => $survey[0]['redirect_url'],
			's_status' => $survey[0]['status'],
			Survey_m::WELCOME_TITLE => $survey[0][Survey_m::WELCOME_TITLE],
			Survey_m::WELCOME_CONTENT => $survey[0][Survey_m::WELCOME_CONTENT],
			Survey_m::THANKYOU_TITLE => $survey[0][Survey_m::THANKYOU_TITLE],
			Survey_m::THANKYOU_CONTENT => $survey[0][Survey_m::THANKYOU_CONTENT],
			'Pages' => $pages,
			'category' => $cat
		);

		if ($cat == self::CAT_THEME) {
			$viewData['theme_cnt'] = self::COUNT_THEME;
		}

		if ($cat == self::CAT_SETTING) {
			$viewData['theme_cnt'] = self::COUNT_THEME;
			$viewData['is_response_one_computer'] = $survey[0]['is_response_one_computer'];
			$viewData['is_enable_progressbar'] = $survey[0]['is_enable_progressbar'];
			$viewData['is_save_continue'] = $survey[0]['is_save_continue'];
			$viewData['max_response'] = $survey[0]['max_response'];

			$date = DateTime::createFromFormat('Y-m-d', $survey[0][Survey_m::CUT_OFF_DATE]);
			$viewData[Survey_m::CUT_OFF_DATE] = $date->format('m/d/Y');
			$viewData[Survey_m::SC_FROM_EMAIL] = $survey[0][Survey_m::SC_FROM_EMAIL];
			$viewData[Survey_m::SC_SUBJECT] = $survey[0][Survey_m::SC_SUBJECT];
			$viewData[Survey_m::SC_MESSAGE] = $survey[0][Survey_m::SC_MESSAGE];
		}

		$this->load->view('template/beginheader', $templateData);
		$this->load->view('template/header');
		$this->load->view('surveyedit_v', $viewData);
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

	function theme($sid) {
		if (!is_user_logined())
			redirect('/auth/login');

		if (!$this->survey_m->is_owned(get_loginid(), $sid))
			redirect('/auth/login');

		if ($this->session->userdata('auth_code') >= '7') {
			
		}
		$this->loadView($sid, self::CAT_THEME);
	}

	function select_theme() {
		$jsonStr = $this->input->post('indata');
		$jsonObj = json_decode($jsonStr, true);
		$sid = $jsonObj['sid'];
		$themeno = $jsonObj['themeno'];

		$this->survey_m->set_themeno($sid, $themeno);
		$msg = $this->get_message_script("Successfully selected.");
		echo $msg;
	}

	function get_message_script($msg) {
		$str = '<script type="text/javascript">alert("' . $msg . '");</script>';
		return $str;
	}

	function setting($sid) {
		if (!is_user_logined())
			redirect('/auth/login');

		if (!$this->survey_m->is_owned(get_loginid(), $sid))
			redirect('/auth/login');

		$this->loadView($sid, self::CAT_SETTING);
	}

	function save_setting($sid) {
		if (!is_user_logined())
			redirect('/auth/login');

		if (!$this->survey_m->is_owned(get_loginid(), $sid))
			redirect('/auth/login');

		$postdata = $this->input->post();

		$this->survey_m->set_setting($sid, $postdata);

		redirect('/surveyedit/setting/' . $sid);
	}

	function get_q_content($qid) {
		$data['qid'] = $qid;
		$qs = $this->surveyedit_m->get_question($qid);
		$data['question'] = $qs[0]['question'];
		$answer_content = $this->load->view('survey_design_q_content_answer', '', true);

		$arr = array('qid' => $qid, 'q_text' => $qs[0]['question'], 'a_content' => $answer_content);
		echo json_encode($arr);
	}

	function get_q_content_answer($qid) {
		$data['qid'] = $qid;
		$qs = $this->surveyedit_m->get_question($qid);
		$data['question'] = $qs[0];
		echo $this->load->view('survey_design_q_content_answer', $data);
	}

	function addpage($sid) {
		if (!is_user_logined())
			redirect('/auth/login');

		if (!$this->survey_m->is_owned(get_loginid(), $sid))
			redirect('/auth/login');

		$title = $this->input->post("title");
		$desc = $this->input->post("desc");
		if ($title) {
			$this->db->trans_start();
			$this->page_m->create_page($sid, $title, $desc);
			$this->db->trans_complete();
			redirect('/surveyedit/index/' . $sid);
		}
	}

	function insertpage($sid, $pid) {
		if (!is_user_logined())
			redirect('/auth/login');

		if (!$this->survey_m->is_owned(get_loginid(), $sid))
			redirect('/auth/login');

		$title = $this->input->post("title");
		$desc = $this->input->post("desc");
		if ($title) {
			$this->db->trans_start();
			$this->page_m->insert_page($sid, $pid, $title, $desc);
			$this->db->trans_complete();
			redirect('/surveyedit/index/' . $sid);
		}
	}

	function editpage($sid, $pid) {
		if (!is_user_logined())
			redirect('/auth/login');

		if (!$this->survey_m->is_owned(get_loginid(), $sid))
			redirect('/auth/login');

		$title = $this->input->post("title");
		$desc = $this->input->post("desc");
		if ($title) {
			$sid = $this->page_m->get_sid($pid);
			if ($sid != null) {
				$this->page_m->edit_page($pid, $title, $desc);
				redirect('/surveyedit/index/' . $sid);
			}
		}
	}

	function welcome($sid) {
		if (!is_user_logined())
			redirect('/auth/login');

		if (!$this->survey_m->is_owned(get_loginid(), $sid))
			redirect('/auth/login');

		$title = $this->input->post("title");
		$desc = $this->input->post("desc");
		if ($title) {
			$this->survey_m->set_one_field($sid, Survey_m::WELCOME_TITLE, $title);
			$this->survey_m->set_one_field($sid, Survey_m::WELCOME_CONTENT, $desc);
		}
	}

	function thankyou($sid) {
		if (!is_user_logined())
			redirect('/auth/login');

		if (!$this->survey_m->is_owned(get_loginid(), $sid))
			redirect('/auth/login');

		$title = $this->input->post("title");
		$desc = $this->input->post("desc");
		if ($title) {
			$this->survey_m->set_one_field($sid, Survey_m::THANKYOU_TITLE, $title);
			$this->survey_m->set_one_field($sid, Survey_m::THANKYOU_CONTENT, $desc);
		}
	}

	function delpage($sid, $pid) {
		if (!is_user_logined())
			redirect('/auth/login');

		if (!$this->survey_m->is_owned(get_loginid(), $sid))
			redirect('/auth/login');

		$sid = $this->page_m->get_sid($pid);
		if ($sid != null) {
			$this->page_m->del_one_page($pid);
			redirect('/surveyedit/index/' . $sid);
		}
	}

}

/* End of file main.php */
/* Location: ./application/controllers/mian.php */