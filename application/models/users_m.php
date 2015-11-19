<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Users_m extends CI_Model {

	const TABLE = 'survey_user';   // user accounts
	const TABLE_PROFILE = 'user_profiles'; // user profiles
	const USERID = 'uid';
	const USERNAME = 'name';
	const EMAIL = 'email';
	const PASSWORD = 'passwd';
	const ACTIVATED = 'activated';
	const AUTHCODE = 'authcode';
	const IS_DELETED = 'is_deleted';
	const ADMIN_PRIV = 'admin_priv';
	const STATUS = 'status';
	const CREATE_DATE = 'createdate';
	const UPDATE_DATE = 'updatedate';
	const TAKEN = 'taken';

	//
	const SUSPENDED = 'SUSPENDED';
	const ALLOWED = 'ALLOWED';
	const TOTALADMIN = '1';
	const NORMALADMIN = '2';

	function __construct() {
		parent::__construct();
	}

	function create_user($username, $email, $passwd, $email_activation) {
		if ($email_activation)
			$sql = "INSERT INTO " . self::TABLE . " (" . self::USERNAME . ", " . self::EMAIL . ", " . self::PASSWORD . ", " . self::ACTIVATED . ", " . self::AUTHCODE . ", " . self::CREATE_DATE . ", " . self::UPDATE_DATE . ", " . self::STATUS . ") 
				VALUES ('" . $username . "', '" . $email . "', password('" . $passwd . "'), 'N', RIGHT(password('" . $email . "'), 40), NOW(), NOW(), '" . self::ALLOWED . "')";
		else
			$sql = "INSERT INTO " . self::TABLE . " (" . self::USERNAME . ", " . self::EMAIL . ", " . self::PASSWORD . ", " . self::ACTIVATED . ", " . self::CREATE_DATE . ", " . self::UPDATE_DATE . ", " . self::STATUS . ") 
				VALUES ('" . $username . "', '" . $email . "', password('" . $passwd . "'), 'Y', NOW(), NOW(), '" . self::ALLOWED . "')";

		$this->db->query($sql);

		return $this->db->insert_id();
	}

	function get_users($sort, $offset = 0, $limit = NULL, $filter = NULL) {
		$this->db->where(self::IS_DELETED, '0');
		$this->db->where(self::ADMIN_PRIV, '0');
		$this->db->where(self::ACTIVATED, 'Y');

		if ($limit != NULL)
			$query = $this->db->get(self::TABLE, $limit, $offset);
		else
			$query = $this->db->get(self::TABLE);

		return $query->result_array();
	}

	function get_admins($uid) {
		$admin = $this->get_one_record($uid);

		$this->db->where(self::IS_DELETED, '0');
		if ($admin[self::ADMIN_PRIV] == self::TOTALADMIN) {
			$this->db->where(self::ADMIN_PRIV . ' > ', '0');
		} else {
			$this->db->where(self::USERID, $uid);
		}

		$query = $this->db->get(self::TABLE);

		return $query->result_array();
	}

	function add_admin($email, $password) {
		$insert_id = $this->create_user("", $email, $password, false);

		$this->db->where(self::USERID, $insert_id);

		$this->db->set(self::ADMIN_PRIV, self::NORMALADMIN);

		$this->db->update(self::TABLE);
	}

	function get_usertotalcnt() {
		$this->db->where(self::IS_DELETED, '0');
		$this->db->where(self::ADMIN_PRIV, '0');
		$this->db->where(self::ACTIVATED, 'Y');
		$query = $this->db->get(self::TABLE);

		return $query->num_rows();
	}

	function del_user($uid) {
		$this->db->where(self::USERID, $uid);
		$this->db->set(self::IS_DELETED, '1');
		$this->db->update(self::TABLE);
	}

	function suspend_user($uid) {
		$this->db->where(self::USERID, $uid);
		$this->db->where(self::IS_DELETED, '0');
		$this->db->set(self::STATUS, self::SUSPENDED);
		$this->db->update(self::TABLE);
	}

	function allow_user($uid) {
		$this->db->where(self::USERID, $uid);
		$this->db->where(self::IS_DELETED, '0');
		$this->db->set(self::STATUS, self::ALLOWED);
		$this->db->update(self::TABLE);
	}

	function is_user_exist($email) {
		$sql = "SELECT " . self::USERID . " FROM  " . self::TABLE . "  WHERE " . self::EMAIL . " ='" . $email . "' AND " . self::IS_DELETED . "='0'	";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
			return true;
		else
			return false;
	}

	function check_password($email, $passwd) {
		$sql = "SELECT " . self::USERID . " FROM  " . self::TABLE . "  WHERE " . self::EMAIL . " ='" . $email . "' AND " . self::PASSWORD . "=PASSWORD('" . $passwd . "') AND " . self::IS_DELETED . "='0'	";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
			return true;
		else
			return false;
	}

	function is_valid_password($uid, $passwd) {
		$sql = "SELECT " . self::USERID . " FROM  " . self::TABLE . "  WHERE " . self::USERID . " ='" . $uid . "' AND " . self::PASSWORD . "=PASSWORD('" . $passwd . "') AND " . self::IS_DELETED . "='0'	";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
			return true;
		else
			return false;
	}

	function is_user_activated($email) {
		$this->db->where(self::EMAIL, $email);
		$this->db->where(self::ACTIVATED, 'Y');
		$this->db->where(self::IS_DELETED, '0');
		$query = $this->db->get(self::TABLE);
		if ($query->num_rows() > 0)
			return true;
		else
			return false;
	}

	function is_user_allowed($email) {
		$this->db->where(self::EMAIL, $email);
		$this->db->where(self::STATUS, self::ALLOWED);
		$this->db->where(self::IS_DELETED, '0');
		$query = $this->db->get(self::TABLE);
		if ($query->num_rows() > 0)
			return true;
		else
			return false;
	}

	function get_userid_by_email($email) {
		$this->db->where(self::EMAIL, $email);
		$this->db->where(self::IS_DELETED, '0');
		$query = $this->db->get(self::TABLE);
		if ($query->num_rows() > 0)
			return $query->row()->uid;
		else
			return NULL;
	}
        
                  function get_passwd_by_email($email) {
		$this->db->where(self::EMAIL, $email);
		$this->db->where(self::IS_DELETED, '0');
		$query = $this->db->get(self::TABLE);
		if ($query->num_rows() > 0)
			return $query->row()->passwd;
		else
			return NULL;
	}

	function get_all_by_id($userid) {
		$this->db->where(self::USERID, $userid);
		$this->db->where(self::IS_DELETED, '0');
		$query = $this->db->get(self::TABLE);
		if ($query->num_rows() > 0)
			return $query->row();
		else
			return NULL;
	}

	function get_authcode($email) {
		$this->db->where(self::EMAIL, $email);
		$this->db->where(self::IS_DELETED, '0');
		$query = $this->db->get(self::TABLE);
		if ($query->num_rows() > 0)
			return $query->row()->authcode;
		else
			return NULL;
	}

	function activate_user($authcode) {
		$this->db->where(self::AUTHCODE, $authcode);
		$this->db->where(self::IS_DELETED, '0');
		$this->db->set(self::ACTIVATED, 'Y');
		$this->db->update(self::TABLE);
		if ($this->db->affected_rows() > 0)
			return TRUE;
		else
			return FALSE;
	}

	function reset_password($email, $newPasswd) {
		$sql = "UPDATE " . self::TABLE . " SET " . self::PASSWORD . "=PASSWORD('$newPasswd') WHERE " . self::EMAIL . "='$email' AND " . self::IS_DELETED . "='0'	";
		$this->db->query($sql);
		if ($this->db->affected_rows() > 0)
			return true;
		else
			return false;
	}

	function get_one_record($uid) {
		$this->db->where(self::USERID, $uid);
		$this->db->where(self::IS_DELETED, '0');
		$query = $this->db->get(self::TABLE);
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
			return $result[0];
		}
		else
			return null;
	}

	function increase_taken($uid) {
		$user = $this->get_one_record($uid);
		if ($user != null) {
			$this->db->where(self::USERID, $uid);
			$this->db->set(self::TAKEN, $user[self::TAKEN] + 1);
			$this->db->update(self::TABLE);
		}
	}

}
