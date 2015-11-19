<?php

class Dashboard extends CI_Controller {

	function __construct() {
		parent::__construct();

		$this->load->model('users_m');
		$this->load->model('survey_m');
	}

	function index() {
//	
//		// 설정
//		$config['mailtype'] = "html";
//		$config['charset'] = "euc-kr";
//		$config['protocol'] = "smtp";
//		$config['smtp_host'] = "ssl://smtp.googlemail.com";
//		$config['smtp_port'] = 465;
//		$config['smtp_user'] = "pakjsong1986@gmail.com";
//		$config['smtp_pass'] = "skwdbakf";
//		$config['smtp_timeout'] = 10;
//
//
//		$this->load->library('email', $config);
//		$this->email->set_newline("\r\n");
//		$this->email->clear();
//		$this->email->from("manya@tested.kr", "관리자");
//		$this->email->to("guangri1025@gmail.com");
//		$this->email->subject("회원가입을 축하드립니다.");
//		$this->email->message('XXXXXXXXXXXXXXXXXXX');
//
//
//		if (!$this->email->send())
//			echo "실패";
//		else
//			echo "성공";
//




		if (!is_user_logined())
			redirect('/auth/login');

		$loginid = get_loginid();
		if ($this->session->userdata('auth_code') >= '7') {
			
		}
		$data = $this->users_m->get_all_by_id($loginid);
		$response = $this->survey_m->get_respondent_cnt_by_uid($loginid);

		$templateData = array(
			'name' => 'dashboard',
			'fullName' => $data->name,
			'email' => $data->email,
			'response' => $response,
			'taken' => $data->taken
		);

		$viewData = array('Title' => 'Dashboard', 'userName' => $data->name, 'eMail' => $data->email, 'Number' => $loginid);
		$this->load->view('template/beginheader', $templateData);
		$this->load->view('template/header');
		$this->load->view('dashboard_v', $viewData);
		$this->load->view('template/footer');
		$this->load->view('template/endfooter', $templateData);
	}

}

/* End of file main.php */
/* Location: ./application/controllers/mian.php */