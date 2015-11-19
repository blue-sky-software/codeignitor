<?php

class Manage extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('users_m');
		$this->load->model('survey_m');
		$this->load->model('config_m');
	}

	function index() {
		$this->load->view('admin/login_v');
	}

	function login() {

		$email = $this->input->post('email');
		$passwd = $this->input->post('password');

		if ($email && $passwd) {
			if (!$this->users_m->is_user_exist($email)) {

				$data['email'] = $email;
				$data['passwd'] = $passwd;
				$data['error_msg'] = "Your Username does not exist.";

				$this->load->view('admin/login_v', $data);
				return;
			}

			if (!$this->users_m->check_password($email, $passwd)) {

				$data['email'] = $email;
				$data['passwd'] = $passwd;
				$data['error_msg'] = "Your Password is incorrect.";

				$this->load->view('admin/login_v', $data);
				return;
			}

			$this->session->set_userdata('IS_ADMIN_LOGINED', 'Y');

			$userid = $this->users_m->get_userid_by_email($email);
			$this->session->set_userdata('LOGINED_ADMINID', $userid);

			redirect('/admin/manage/usermanage');
		} else {
			$this->load->view('admin/login_v');
		}
	}

	function logout() {
		$this->session->unset_userdata('IS_ADMIN_LOGINED');

		redirect('/admin/manage/login');
	}

	function check_admin_id() {
		if (!is_admin_logined())
			redirect('/admin/manage/login');

		$postData = $this->input->post();

		if ($this->users_m->is_user_exist($postData['admin_name'])) {
			echo "false";
		} else {
			echo 'true';
		}
	}

	function add_admin() {
		if (!is_admin_logined())
			redirect('/admin/manage/login');

		$postData = $this->input->post();
		
		$this->db->trans_start();
		
		$this->users_m->add_admin($postData['admin_name'], $postData['newPassword']);

		$this->db->trans_complete();

		redirect('/admin/manage/usermanage');
	}

	function save_admin() {
		if (!is_admin_logined())
			redirect('/admin/manage/login');

		$postData = $this->input->post();
		$this->users_m->reset_password($postData['admin_name'], $postData['newPassword']);

		redirect('/admin/manage/usermanage');
	}

	function usermanage() {
		if (!is_admin_logined())
			redirect('/admin/manage/login');

		$templateData = array('name' => 'usermanage');
		$users = array();

		$loginid = get_login_admin_id();
		$admins = $this->users_m->get_admins($loginid);
		$total_admin = $this->users_m->get_one_record($loginid);

		$data = array(
			'Title' => 'User Manage',
			'total_admin' => $total_admin[Users_m::ADMIN_PRIV],
			'admins' => $admins,
			'users' => $users);

		$this->load->view('admin/template/beginheader', $templateData);
		$this->load->view('admin/template/header');
		$this->load->view('admin/usermanage_v', $data);
		$this->load->view('admin/template/footer');
		$this->load->view('admin/template/endfooter', $templateData);
	}

	function get_usertotalcnt() {
		$cnt = $this->users_m->get_usertotalcnt();
		$data['usertotalcnt'] = $cnt;
		echo json_encode($data);
	}

	function get_users() {
		$listsize = $this->input->post('listsize');
		$pageno = $this->input->post('pageno');
		$offset = ($pageno - 1) * $listsize;

		$users = $this->users_m->get_users(NULL, $offset, $listsize);

		$data['users'] = $users;

		echo $this->load->view('admin/usermanage_list', $data);
	}

	function del_user($uid) {
		$this->users_m->del_user($uid);
	}

	function suspend_user($uid) {
		$this->users_m->suspend_user($uid);
	}

	function allow_user($uid) {
		$this->users_m->allow_user($uid);
	}

	function surveymanage() {
		if (!is_admin_logined())
			redirect('/admin/manage/login');

		$templateData = array('name' => 'surveymanage');
		$surveys = array();

		$data = array(
			'Title' => 'Survey Manage',
			'surveys' => $surveys);

		$this->load->view('admin/template/beginheader', $templateData);
		$this->load->view('admin/template/header');
		$this->load->view('admin/surveymanage_v', $data);
		$this->load->view('admin/template/footer');
		$this->load->view('admin/template/endfooter', $templateData);
	}

	function get_surveys() {
		$listsize = $this->input->post('listsize');
		$pageno = $this->input->post('pageno');
		$offset = ($pageno - 1) * $listsize;

		$surveys = $this->survey_m->getSurveys(NULL, NULL, $offset, $listsize);

		$data['surveys'] = $surveys;

		echo $this->load->view('admin/surveymanage_list', $data);
	}

	function get_surveytotalcnt() {
		$cnt = $this->survey_m->get_surveytotalcnt();
		$data['surveytotalcnt'] = $cnt;
		echo json_encode($data);
	}

	function del_survey($sid) {
		$this->db->trans_start();
		$this->survey_m->del_survey($sid);
		$this->db->trans_complete();
	}

	function suspend_survey($sid) {
		$this->survey_m->suspend_survey($sid);
	}

	function allow_survey($sid) {
		$this->survey_m->online_survey($sid);
	}

	function config() {
		if (!is_admin_logined())
			redirect('/admin/manage/login');

		$templateData = array('name' => 'config');
		$mail_config = $this->config_m->get_mail_config();
		$point_config = $this->config_m->get_point_config();

		$data = array(
			'Title' => 'Setting',
			'mail' => $mail_config,
			'point' => $point_config
		);

		$this->load->view('admin/template/beginheader', $templateData);
		$this->load->view('admin/template/header');
		$this->load->view('admin/config_v', $data);
		$this->load->view('admin/template/footer');
		$this->load->view('admin/template/endfooter', $templateData);
	}

	function save_config() {
		if (!is_admin_logined())
			redirect('/admin/manage/login');

		$postData = $this->input->post();

		$this->config_m->set_mail_config($postData['subject'], $postData['message']);
		$this->config_m->set_point_config($postData['p1'], $postData['p2']);

		redirect('/admin/manage/config');
	}

}

?>
