<?php

class Question extends CI_Controller {

	function __construct() {
		parent::__construct();

		$this->load->model('survey_m');
		$this->load->model('question_m');
		$this->load->model('question_detail_m');
	}

	function get_php_ini() {
		return phpinfo();
	}

	function add_question($pid) {
		if (!is_user_logined())
			redirect('/auth/login');
		$inputKey = $this->input->post("key");
		if ($inputKey) {
			$keylist = json_decode($inputKey, true);
			if ($keylist) {
				$this->db->trans_start();
				$insert_id = $this->question_m->create_question($pid, $keylist['q_type'], $keylist['q_text']);
				foreach ($keylist['answer'] as $key) {
					$this->question_detail_m->create_question_detail($insert_id, $key['aoid'], $key['content']);
				}
				$this->db->trans_complete();
			}
		}
	}

	function insert_question($pid, $qid) {
		if (!is_user_logined())
			redirect('/auth/login');

		$inputKey = $this->input->post("key");
		if ($inputKey) {
			$keylist = json_decode($inputKey, true);
			if ($keylist != null) {
				$this->db->trans_start();
				$insert_id = $this->question_m->insert_question($pid, $qid, $keylist['q_type'], $keylist['q_text']);
				foreach ($keylist['answer'] as $key) {
					$this->question_detail_m->create_question_detail($insert_id, $key['aoid'], $key['content']);
				}
				$this->db->trans_complete();
			}
		}
	}

	function get_question($qid) {
		if (!is_user_logined())
			redirect('/auth/login');

		$jsonStr = "";
		$question = $this->question_m->get_one_record($qid);

		if ($question != null) {
			$keylist = array();
			$keylist['qtid'] = $question['qtid'];
			$keylist['question'] = $question['question'];
			$keylist['answer'] = $this->question_detail_m->get_question_detail_with_aotype($qid);
			$jsonStr = json_encode($keylist);
		}

		echo $jsonStr;
	}

	function save_question($qid) {
		if (!is_user_logined())
			redirect('/auth/login');

		$inputKey = $this->input->post("key");
		if ($inputKey) {
			$keylist = json_decode($inputKey, true);
			if ($keylist != null) {
				$this->db->trans_start();
				$this->question_detail_m->del_physical_question_detail($qid);
				$this->question_m->update_question($qid, $keylist['q_type'], $keylist['q_text']);
				foreach ($keylist['answer'] as $key) {
					$this->question_detail_m->create_question_detail($qid, $key['aoid'], $key['content']);
				}
				$this->db->trans_complete();
			}
		}
	}

	function del_question($sid, $qid) {
		if (!is_user_logined())
			redirect('/auth/login');

		if (!$this->survey_m->is_owned(get_loginid(), $sid))
			redirect('/auth/login');

		$this->db->trans_start();

		$this->question_m->del_one_question($qid);

		$this->db->trans_complete();

		redirect('/surveyedit/index/' . $sid);
	}

	function copy_question($sid, $qid) {
		if (!is_user_logined())
			redirect('/auth/login');

		if (!$this->survey_m->is_owned(get_loginid(), $sid))
			redirect('/auth/login');

		$this->db->trans_start();
		$question = $this->question_m->get_one_record($qid);
		if ($question != null) {
			$insert_id = $this->question_m->insert_question($question['pid'], $qid, $question['qtid'], $question['question']);

			$this->question_detail_m->copy_question_detail($qid, $insert_id);
		}
		$this->db->trans_complete();
		redirect('/surveyedit/index/' . $sid);
	}

	function move_question($direction, $sid, $qid) {
		if (!is_user_logined())
			redirect('/auth/login');

		if (!$this->survey_m->is_owned(get_loginid(), $sid))
			redirect('/auth/login');

		$this->db->trans_start();
		if ($direction == "up") {
			$this->question_m->move_up_question($qid);
		} else {
			$this->question_m->move_down_question($qid);
		}
		$this->db->trans_complete();
		redirect('/surveyedit/index/' . $sid);
	}

}

/* End of file main.php */
/* Location: ./application/controllers/mian.php */