<?php

class Auth extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('users_m');
        $this->load->model('config_m');
        $this->load->helper('captcha');
        $this->load->library('email');
        $this->config->load('custom_config');

        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.gmail.com',
            'smtp_port' => 465,
            'smtp_user' => $this->config->item('email_id'),
            'smtp_pass' => $this->config->item('email_pass'),
            'smtp_timeout' => '30',
            'mailtype' => 'text',
            'charset' => 'utf-8'
        );
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
//		$this->email->initialize($config);
    }

    function index() {
        
    }

    function is_valid_password() {
        if (!is_user_logined())
            redirect('/auth/login');

        $old = $this->input->post('data');
        if ($this->users_m->is_valid_password(get_loginid(), $old)) {
            echo 'true';
        } else {
            echo 'false';
        }
    }

    function change_password() {
        if (!is_user_logined())
            redirect('/auth/login');

        $old = $this->input->post('oldPassword');
        $new = $this->input->post('newPassword');
//		$confirm = $this->input->post('confirmPassword');

        $uid = get_loginid();
        if ($this->users_m->is_valid_password($uid, $old)) {
            $info = $this->users_m->get_all_by_id($uid);
            $this->users_m->reset_password($info->email, $new);
        }
        redirect('/dashboard');
    }

    function rand_string( $length ) {
        $str = "";
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $size = strlen( $chars );
        for( $i = 0; $i < $length; $i++ ) {
                $str .= $chars[ rand( 0, $size - 1 ) ];
        }
        return $str;
    }

    function login() {
        
        $data['cap'] = $this->_auth_img();

        $this->load->view('auth/login_v', $data);
    }
    
    function loginDo() {

        $this->_print_log("<<------------------------------Login Module Begin----------------------------------\n");
        
        $timezone = date_default_timezone_get();
        $date = date('Y-m-d H:i:s');
        
        $this->_print_log("The current server timezone is: ".$timezone);
        
        $this->_print_log("The current server time is: ".$date);
        
        $email = $this->input->post('email');
        $passwd = $this->input->post('password');
        
        $this->_print_log("Input EMail : ".$email);
        $this->_print_log("Input Password : ".$passwd);

        if ($email && $passwd) {
            
            $this->_print_log("Is Input EMail & Password Set? Yes");
            
            if (!$this->users_m->is_user_exist($email)) {
                
                $this->_print_log("---****************---Your Email does not exist.");
                
                $data['cap'] = $this->_auth_img();

                $data['email'] = $email;
                $data['passwd'] = $passwd;
                $data['error_msg'] = "Your Email does not exist.";

                $this->_print_log("<<------------------------------Login Module End----------------------------------\n");
                
                $this->load->view('auth/login_v', $data);
                return;
            }

            if (!$this->users_m->is_user_activated($email)) {
                
                $this->_print_log("---****************---Your account is not activated.");
                
                $data['cap'] = $this->_auth_img();

                $data['email'] = $email;
                $data['passwd'] = $passwd;
                $data['error_msg'] = "Your account is not activated.";

                $this->_print_log("<<------------------------------Login Module End----------------------------------\n");
                
                $this->load->view('auth/login_v', $data);
                return;
            }

            if (!$this->users_m->is_user_allowed($email)) {
                
                $this->_print_log("---****************---Your account is not allowed by administrator.");
                
                $data['cap'] = $this->_auth_img();

                $data['email'] = $email;
                $data['passwd'] = $passwd;
                $data['error_msg'] = "Your account is suspended by administrator.";

                $this->_print_log("<<------------------------------Login Module End----------------------------------\n");
                
                $this->load->view('auth/login_v', $data);
                return;
            }

            $this->_print_log("Checking EMail : ".$email);
            $this->_print_log("Checking Password : ".$passwd);
            
            if (!$this->users_m->check_password($email, $passwd)) {
                
                $this->_print_log("Check Password : Fail");
                $this->_print_log("---****************---Your Password is incorrect.");
                
                $data['cap'] = $this->_auth_img();

                $data['email'] = $email;
                $data['passwd'] = $passwd;
                $data['error_msg'] = "Your Password is incorrect.";

                $this->_print_log("<<------------------------------Login Module End----------------------------------\n");
                
                $this->load->view('auth/login_v', $data);
                return;
            }
            else {
                $this->_print_log("Check Password : Success");
            }

            $this->session->set_userdata('IS_LOGINED', 'Y');

            $userid = $this->users_m->get_userid_by_email($email);
            $this->session->set_userdata('LOGINED_USERID', $userid);

            $this->_print_log("<<------------------------------Login Module End----------------------------------\n");
            
            redirect('/dashboard');
        } else {
            
            $this->_print_log("Is Input EMail & Password Set? No");
            
            $data['cap'] = $this->_auth_img();

            $this->load->view('auth/login_v', $data);
            
            $this->_print_log("<<------------------------------Login Module End----------------------------------\n");
        }
    }

    function logout() {
        $this->session->unset_userdata('IS_LOGINED');

        redirect('/auth/login');
    }

    function register() {
        $username = $this->input->post('fullname');
        $email = $this->input->post('email');
        $passwd = $this->input->post('password');

        if ($this->users_m->is_user_exist($email)) {
            redirect('/auth/login');
        }

        $email_activation = $this->config->item('email_activation');

        $this->users_m->create_user($username, $email, $passwd, $email_activation);

        $mail_config = $this->config_m->get_mail_config();

        $msgtmp = str_replace("[NAME]", $username, $mail_config->message);
        $msg = str_replace('survey@proofessor.co.uk', $this->config->item('email_id'), $msgtmp);

        if ($email_activation) {
            $authcode = $this->users_m->get_authcode($email);
            $msg .= "\nTo unlock all the features, please visit the following link " . base_url("index.php/auth/activate_user/$authcode");
        }
//			if ($email_activation) {
//				$authcode = $this->users_m->get_authcode($email);
//				$msg = "Hello " . $username . "
//					You have registered an account with Proofessor Survey System. 
//					To unlock all the features, please visit the following link " . base_url("index.php/auth/activate_user/$authcode") . "  
//					Remember, you can earn rewards by getting responses and/or helping 
//					other people by answering their surveys!
//					If you have any questions, please email us at survey@proofessor.co.uk
//					Here are just a few things you can do with our survey system";
//			} else {
//				$msg = "Hello " . $username . "
//					You have registered an account with Proofessor Survey System. 
//					Remember, you can earn rewards by getting responses and/or helping 
//					other people by answering their surveys!
//					If you have any questions, please email us at survey@proofessor.co.uk
//					Here are just a few things you can do with our survey system";
//			}
        // send register success email

        $this->email->from($this->config->item('email_id'));
        $this->email->to($email);
        $this->email->subject('You have successfully registered.');
        $this->email->message($msg);
        try {
            if (!$this->email->send()) {
                show_error($this->email->print_debugger());
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }

//		$from = 'pakjsong1986@gmail.com';
//		$message = "Line 1\r\nLine 2\r\nLine 3";
//		$message = wordwrap($message, 70, "\r\n");
//		$mail = mail('starforce86714@gmail.com', 'My Subject', $message);
//		require("class.phpmailer.php");
//		$mail = new PHPMailer();
//		$mail->IsSMTP();
//		$mail->Host     = "localhost";
//		$mail->From     = "pakjsong1986@gmail.com";
//		$mail->AddAddress("starforce86714@gmail.com");
//		$mail->Subject  = "First PHPMailer Message";
//		$mail->Body     = "Hi! \n\n This is my first e-mail sent through PHPMailer.";
//		$mail->WordWrap = 50;
//		if(!$mail->Send()) {
//			echo 'Message was not sent.';
//			echo 'Mailer error: ' . $mail->ErrorInfo;
//		}

        if (!$email_activation) {
            if ($this->users_m->is_user_allowed($email)) {
                $this->session->set_userdata('IS_LOGINED', 'Y');

                // save userid for logined user into session
                $userid = $this->users_m->get_userid_by_email($email);
                $this->session->set_userdata('LOGINED_USERID', $userid);

                redirect('/dashboard');
            } else {
                redirect('/auth/login');
            }
        }
        else
            redirect('/auth/login');
    }

    function activate_user($authcode) {
        if ($this->users_m->activate_user($authcode))
            echo 'You are successfully activated!';
        else
            echo 'Fail to activate!';
    }

    function _print_log($stringData) {
        $myFile = "log.txt";
        if(!file_exists($myFile)) {
            $fh = fopen($myFile, 'w');
        }
        else {
            $fh = fopen($myFile, 'a');
        }
        fwrite($fh, $stringData);
        fwrite($fh, "\n");
        fclose($fh);
    }
    
    function reset_password() {
        $logLine = "";
        
        $this->_print_log("<<------------------------------Password Reset Module Begin----------------------------------\n");
        
        $timezone = date_default_timezone_get();
        $date = date('Y-m-d H:i:s');
        
        $this->_print_log("The current server timezone is: ".$timezone);
        
        $this->_print_log("The current server time is: ".$date);
        
        $email = $this->input->post('email');
        
        $this->_print_log("EMail : ".$email);
        
        if(!$email) {
            
            $this->_print_log("---------------*******************------------EMail is empty.");
            $this->_print_log("\n>>------------------------------Password Reset Module End----------------------------------\n\n");
            
            redirect('/auth/login');
        }
        
        if ($this->users_m->is_user_exist($email)) {
            $this->_print_log("Is User Exist? Yes");
//            $newPasswd = rand(123456, 456789);
            $newPasswd = $this->rand_string(6);

            $this->_print_log("Created New Password : ".$newPasswd);

            // send password email
            $msg = "Hello
				Your new password is $newPasswd.";

            $this->email->from($this->config->item('email_id'), 'Webmaster');
            $this->email->to($email);
            $this->email->subject('You have successfully reset your password!');
            $this->email->message($msg);
            
            $this->_print_log("EMail Message : ".$msg);
            
            try {
                if ($this->email->send()) {
                    $this->_print_log("EMail Send : Success");
//                    show_error($this->email->print_debugger());
                }
                else {
                    $this->_print_log("EMail Send : Fail");
                }
            } catch (Exception $e) {
                $this->_print_log("EMail Send : Exception");
                $this->_print_log("EMail Send Exception Message : ".$e->getMessage());
                echo $e->getMessage();
            }

            $this->_print_log("Password Retrieved From DB Before Save : ".$this->users_m->get_passwd_by_email($email));
            
            if($this->users_m->reset_password($email, $newPasswd)) {
                $this->_print_log("Reset Password : Success");
            }
            else {
                $this->_print_log("Reset Password : Fail");
            }
            
            $this->_print_log("Password Retrieved From DB After Save : ".$this->users_m->get_passwd_by_email($email));
            
            if($this->users_m->check_password($email, $newPasswd)) {
                $this->_print_log("Password Check : Success");
            }
            else {
                $this->_print_log("Password Check : Fail");
            }

            $this->_print_log("\n>>------------------------------Password Reset Module End----------------------------------\n\n");
            
            // redirect login page
            redirect('/auth/login');
        } else {
            $this->_print_log("Is User Exist? No");
            
            $data['cap'] = $this->_auth_img();

            $data['error_msg'] = "Your Email does not exist.";

            $this->_print_log("<<------------------------------Password Reset Module End----------------------------------\n");

            $this->load->view('auth/login_v', $data);
            return;
        }
    }

    function j_check_email_duplicate() {
        $email = $this->input->post('email');

        if ($email && $this->users_m->is_user_exist($email))
            $data['duplicated'] = 'true';
        else
            $data['duplicated'] = 'false';

        echo json_encode($data);
    }

    function j_refresh_captcha() {
        $data = $this->_auth_img();
        echo $data['image'];
    }

    function j_check_captcha() {
        $captcha_word = $this->input->post('captcha');

        if ($captcha_word != '') {
            $saved_captcha = $this->session->userdata('captcha_word');
            $data['valid'] = $captcha_word == $this->session->userdata('captcha_word') ? 'true' : 'false';
        } else {
            $data['valid'] = 'false';
        }

        echo json_encode($data);
    }

    function _auth_img() {
        $captcha_word = rand(2367, 9652);
        $config = array(
            'word' => $captcha_word,
            'img_path' => './cap/',
            'img_url' => BASEURL . '/cap/',
            'font_path' => './path/to/fonts/texb.ttf',
            'img_width' => '150',
            'img_height' => 30,
            'expiration' => 30
        );

        $this->session->set_userdata('captcha_word', $captcha_word);

        return create_captcha($config);
    }

}
