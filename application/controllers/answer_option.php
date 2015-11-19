<?php

class Answer_Option extends CI_Controller {

	private static $listDisplayOption1 = array();
	private static $listDisplayOption2 = array();
	private static $listSMLine = array();
	private static $list20Line = array();
	private static $list100CharWide = array();

	function __construct() {
		parent::__construct();

		self::$listDisplayOption1[1] = "Radio Buttons (1 column)";
		self::$listDisplayOption1[2] = "Radio Buttons (2 column)";
		self::$listDisplayOption1[3] = "Radio Buttons (3 column)";
		self::$listDisplayOption1[4] = "Radio Buttons (4 column)";
		self::$listDisplayOption1[5] = "Radio Buttons (Horizontal)";
		self::$listDisplayOption1[6] = "Drop-down Menu";

		self:: $listDisplayOption2[1] = "Checkbox Buttons (1 column)";
		self:: $listDisplayOption2[2] = "Checkbox Buttons (2 column)";
		self:: $listDisplayOption2[3] = "Checkbox Buttons (3 column)";
		self:: $listDisplayOption2[4] = "Checkbox Buttons (4 column)";
		self:: $listDisplayOption2[5] = "Checkbox Buttons (Horizontal)";

		self:: $listSMLine[1] = "Multi Line";
		self:: $listSMLine[2] = "Single Line";

		for ($i = 2; $i <= 20; $i++) {
			self:: $list20Line[$i] = $i . " lines";
		}

		for ($i = 10; $i <= 100; $i+=10) {
			self:: $list100CharWide[$i] = $i . " characters wide";
		}

		$this->load->model('answer_option_m');
		$this->load->model('pre_made_m');
	}

	function get_pre_made($pmid) {
//		if (!is_user_logined())
//			redirect('/auth/login');

		$list = $this->pre_made_m->get_pre_made($pmid);

		$content = $list[0]['content'];
		if ($list[0]['pmid'] == 6) {
			$content = "";
			for ($i = 1940; $i <= date("Y"); $i++) {
				$content .= $i . "\n";
			}
		}
		echo $content;
	}

	function get_pre_made_list() {
		if (!is_user_logined())
			redirect('/auth/login');

		$list = $this->pre_made_m->get_pre_made_list();

		$year_content = "";
		foreach ($list as &$elem) {
			if ($elem['pmid'] == 6) {
				$elem['name'] = str_replace("%CURYEAR%", date("Y"), $elem['name']);
				$year_content = $elem['name'];
			}
		}

		echo $year_content;
	}

	function get_contents($qtid) {
		if (!is_user_logined())
			redirect('/auth/login');

		$aoList = $this->answer_option_m->get_answer_options($qtid);

		$contents = '';
		if(sizeof($aoList) > 0)
			$contents = $this->load->view('answer_option/title', '', true);
		
		foreach ($aoList as $ao) {
			$contents .= $this->get_ao_content($ao['aoid'], $ao['type']);
		}

		echo $contents;
	}

	function get_ao_content($aoid, $type) {

		$data = array();
		$data['aotype'] = $type;
		$data['aoid'] = $aoid;
		switch ($type) {
			case '1': {//Display Options1
					$data['ao_name'] = "Display Options";
					$data['list'] = self::$listDisplayOption1;
					return $this->load->view('answer_option/display_option', $data, true);
				}
			case '2': {//Display Options2
					$data['ao_name'] = "Display Options";
					$data['list'] = self::$listDisplayOption2;
					return $this->load->view('answer_option/display_option', $data, true);
				}
			case '3': {//Answer Choices
					$data['ao_name'] = "Answer Choices";
					$data['ao_index'] = '';
					$data['year'] = date("Y");
					return $this->load->view('answer_option/choice_content', $data, true);
				}
			case '4': {//Add "Other" choice field 
					$data['ao_name'] = "Add \"Other\" choice field ";
					$data['smline'] = self:: $listSMLine;
					$data['line'] = self:: $list20Line;
					$data['line_select'] = "5";
					$data['charwide'] = self::$list100CharWide;
					$data['charwide_select'] = "50";
					return $this->load->view('answer_option/other_choice', $data, true);
				}
			case '5': {//Add "Comment" field 
					$data['ao_name'] = "Add \"Comment\" field ";
					$data['smline'] = self:: $listSMLine;
					$data['line'] = self:: $list20Line;
					$data['line_select'] = "5";
					$data['charwide'] = self::$list100CharWide;
					$data['charwide_select'] = "50";
					return $this->load->view('answer_option/comment', $data, true);
				}
			case '6': {//Box Size1
					$data['ao_name'] = "Box Size";
					$data['line'] = self:: $list20Line;
					$data['line_select'] = "5";
					$data['charwide'] = self::$list100CharWide;
					$data['charwide_select'] = "50";
					$data['simplebox'] = "false";
					return $this->load->view('answer_option/box_size', $data, true);
				}
			case '7': {//Box Size2
					$data['ao_name'] = "Box Size";
					$data['charwide'] = self::$list100CharWide;
					$data['charwide_select'] = "50";
					$data['simplebox'] = "true";
					return $this->load->view('answer_option/box_size', $data, true);
				}
			case '8': {//Row Choices
					$data['ao_name'] = "Row Choices";
					$data['ao_index'] = '1';
					$data['year'] = date("Y");
					return $this->load->view('answer_option/choice_content', $data, true);
				}
			case '9': {//Column Choices
					$data['ao_name'] = "Column Choices";
					$data['ao_index'] = '2';
					$data['year'] = date("Y");
					return $this->load->view('answer_option/choice_content', $data, true);
				}
			case '10': {//Drop Down Choices
					$data['ao_name'] = "Drop Down Choices";
					$data['ao_index'] = '3';
					$data['year'] = date("Y");
					return $this->load->view('answer_option/choice_content', $data, true);
				}
			case '11': {//Date Options
					$data['ao_name'] = "Date Options";
					return $this->load->view('answer_option/date_option', $data, true);
				}
			case '12': {//Validate answer format1
					$data['ao_name'] = "Validate answer format";
					$data['formatKind'] = "1";
					return $this->load->view('answer_option/validate_format', $data, true);
				}
			case '13': {//Validate answer format2
					$data['ao_name'] = "Validate answer format";
					$data['formatKind'] = "2";
					return $this->load->view('answer_option/validate_format', $data, true);
				}
			case '14': {//Allow only one response per column
					$data['ao_name'] = "Allow only one response per column";
					return $this->load->view('answer_option/one_response_column', $data, true);
				}
			case '15': {//Require an answer to this question
					$data['ao_name'] = "Require an answer to this question";
					$data['simplebox'] = "true";
					return $this->load->view('answer_option/require', $data, true);
				}
			case '16': {//Randomise the order of answer choices
					$data['ao_name'] = "Randomise the order of answer choices";
					return $this->load->view('answer_option/randomise_order', $data, true);
				}
		}
	}

}

/* End of file main.php */
/* Location: ./application/controllers/mian.php */