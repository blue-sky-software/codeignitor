<?php

class Main extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('main_m');
	}

	function index()
	{
		$data['notice'] = '<div>asdfasd;fka;skdfj;aksdjf;laksd</div>';


		//코멘트, 포럼 개발자 최근리스트 표시 by emc
		if($this->session->userdata('auth_code') >= '7')
		{
//			$data['ci'] = $this->main_m->main_list('포럼개발자', 'ci');
//			$data['su'] = $this->main_m->main_list('운영자게시판', 'su');
		}

		$this->load->view('top_v');
		$this->load->view('main_v', $data);
		$this->load->view('bottom_v');
	}

}

/* End of file main.php */
/* Location: ./application/controllers/mian.php */