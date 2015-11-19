<?php

class Surveyview extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('users_m');
		$this->load->library('email');

		$config = array(
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.gmail.com',
			'smtp_port' => 465,
			'smtp_user' => 'pakjsong1986@gmail.com',
			'smtp_pass' => 'skwdbakf',
			'smtp_timeout' => '30',
			'mailtype' => 'text',
			'charset' => 'utf-8',
			'crlf' => "\r\n",
			'newline' => "\r\n"
		);
		$this->email->initialize($config);
	}

	function s($sid, $seqno) {
		$preview = $this->input->get("preview");
		if ($preview != "true") {
			if (!$this->check_survey_status($sid)) {
				$data = array('message' => "Survey is closed.");
				echo $this->load->view('/preview/page_view_404', $data, true);
				return;
			}
//			if (!$this->check_ip($this->input->ip_address(), $sid)) {
//				echo "duplicate ip login error.";
//				return;
//			}
			if (!$this->check_max_response($sid)) {
				$data = array('message' => "Survey is closed. (response count is over than max.)");
				echo $this->load->view('/preview/page_view_404', $data, true);
				return;
			}
			if (!$this->check_cut_offdate($sid)) {
				$data = array('message' => "Survey is closed. (cut off date is over)");
				echo $this->load->view('/preview/page_view_404', $data, true);
				return;
			}
		}

		$pages = $this->page_m->get_pages($sid);

		$total_page_cnt_of_sid = sizeof($pages);

		if (is_numeric($seqno) == false)
			return;
		if ($seqno < 0)
			$seqno = 0;
		if ($seqno == 0) {
			$html = $this->_make_welcome_page($sid);
			echo $html;
			return;
		}
		if ($seqno > $total_page_cnt_of_sid) {
			$html = $this->_make_thankyou_page($sid);
			echo $html;
			//count taken value
			if (is_user_logined()) {
				$this->count_taken($sid);
			}
			return;
		}
		$cur_page = $pages[$seqno - 1];

		echo $this->_make_page_html($cur_page['pid']);
	}

	function count_taken($sid) {
		$uid = get_loginid();
		if (!$this->survey_m->is_owned($uid, $sid)) {
			$this->users_m->increase_taken($uid);
		}
	}

	function contin($rid, $sid, $seqno) {
		$this->session->set_flashdata('rid', $rid);
		redirect("/surveyview/s/$sid/$seqno");
	}

	function save() {
		$email = $this->input->post('email');
		$rid = $this->input->post('rid');
		$sid = $this->input->post('sid');
		$seqno = $this->input->post('seqno');
		$url = BASEURL . "index.php/surveyview/contin/$rid/$sid/$seqno";

		// send email

		$msg = "To continue answering, please visit the following link " . base_url("index.php/surveyview/contin/$rid/$sid/$seqno");
		$this->email->from('survey@proofessor.co.uk', 'Webmaster');
		$this->email->to($email);
		$this->email->subject('Save to Continue');
		$this->email->message($msg);
		try {
			$this->email->send();
		} catch (Exception $e) {
			echo $e->getMessage();
		}
		redirect('/dashboard');
	}

	function check_survey_status($sid) {
		$survey = $this->survey_m->get_one_record($sid);
		if ($survey[Survey_m::STATUS] != Survey_m::ONLINE) {
			return false;
		}
		return true;
	}

	function check_ip($ip, $sid) {
		$survey = $this->survey_m->get_one_record($sid);
		if ($survey[Survey_m::IS_ONE_RESPONSE] != 'on') {
			if ($this->survey_m->is_existed_respondent($sid, $ip)) {
				return false;
			}
		}
		return true;
	}

	function check_max_response($sid) {
		$survey = $this->survey_m->get_one_record($sid);
		if ($survey[Survey_m::MAX_RESPONSE] <= $this->survey_m->get_respondent_cnt($sid)) {
			$this->survey_m->set_one_field($sid, Survey_m::STATUS, Survey_m::CLOSED);
			return false;
		}
		return true;
	}

	function check_cut_offdate($sid) {
		$survey = $this->survey_m->get_one_record($sid);
		$cut_off_date = new DateTime($survey[Survey_m::CUT_OFF_DATE]);
		$cur_date = new DateTime(date("Y-m-d"));

		if ($cut_off_date < $cur_date) {
			$this->survey_m->set_one_field($sid, Survey_m::STATUS, Survey_m::CLOSED);
			return false;
		}
		return true;
	}

	function _make_page_html($pid) {

		$sid = $this->page_m->get_sid($pid);
		$survey = $this->survey_m->get_one_record($sid);
		$page = $this->page_m->get_one_record($pid);

		// get the language of current survey, and load the language file
		$language = $survey['language'];
		if ($language == 1) {
			$language = "english";
		} else if ($language == 2) {
			$language = "chinese";
		} else if ($language == 3) {
			$language = "korean";
		} else if ($language == 4) {
			$language = "japanese";
		} else if ($language == 5) {
			$language = "arabic";
		} else {
			$language = "english";
		}
		$this->lang->load('survey_view', $language);

		$data['survey_title'] = $survey['title'];
		$data['page_title'] = $page['title'];
		$data['sid'] = $survey['sid'];
		$data['pid'] = $page['pid'];
		$data['theme_no'] = $survey['template'];
		if ($survey['is_save_continue'] == 'on') {
			$data['save'] = true;
		}
		if ($survey['is_enable_progressbar'] == 'on') {
			$data['is_enable_progressbar'] = true;
		}

		$pages = $this->page_m->get_pages($sid);
		if ($pages[0]['pid'] == $pid) {
			$max_rid = $this->answer_temp_m->get_max_rid();
			if ($max_rid == null) {
				$data['rid'] = 1;
			} else {
				$data['rid'] = $max_rid + 1;
			}
		} else {
			$data['rid'] = $this->session->flashdata('rid');
		}

		// find current page'sequence  inside pages that current survey have
		foreach ($pages as $i => $pa) {
			if ($pa['pid'] == $pid)
				break;
		}
		$seqno = $i + 1;

		$data['seqno'] = $seqno;

		$questions = $this->question_m->get_questions($pid);

		$data['total_page'] = count($pages);
		$data['page_no'] = $seqno;
		$preview = $this->input->get("preview");
		if ($preview) {
			$data['preview'] = "true";
		} else {
			$data['preview'] = "";
		}

		$html = $this->load->view('/preview/page_view_upper', $data, true);

		foreach ($questions as $question) {
			$qhtml = $this->_make_question_html($question['qid']);
			$html .= $qhtml;
		}
		$html .= $this->load->view('/preview/page_view_lower', $data, true);

		return $html;
	}

	function _make_welcome_page($sid) {
		$survey = $this->survey_m->get_one_record($sid);

		// get the language of current survey, and load the language file
		$language = $survey['language'];
		if ($language == 1) {
			$language = "english";
		} else if ($language == 2) {
			$language = "chinese";
		} else if ($language == 3) {
			$language = "korean";
		} else if ($language == 4) {
			$language = "japanese";
		} else if ($language == 5) {
			$language = "arabic";
		} else {
			$language = "english";
		}
		$this->lang->load('survey_view', $language);

		$preview = $this->input->get("preview");
		if ($preview) {
			$preview = "?preview=true";
		} else {
			$preview = "";
		}

		$data = array(
			'survey' => $survey,
			'preview' => $preview
		);

		$html = $this->load->view('/preview/welcome_v', $data, true);

		return $html;
	}

	function _make_thankyou_page($sid) {
		$survey = $this->survey_m->get_one_record($sid);

		// get the language of current survey, and load the language file
		$language = $survey['language'];
		if ($language == 1) {
			$language = "english";
		} else if ($language == 2) {
			$language = "chinese";
		} else if ($language == 3) {
			$language = "korean";
		} else if ($language == 4) {
			$language = "japanese";
		} else if ($language == 5) {
			$language = "arabic";
		} else {
			$language = "english";
		}
		$this->lang->load('survey_view', $language);

		$data = array(
			'survey' => $survey
		);

		$html = $this->load->view('/preview/thankyou_v', $data, true);

		return $html;
	}

}

?>
