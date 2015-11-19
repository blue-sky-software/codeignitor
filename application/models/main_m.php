<?PHP
class Main_m extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

	function main_list($table_name, $table)
	{
		// 2011-09-30 불필요 쿼리 정리. group by, join 삭제 1.5초에서 0.001초대로 by 웅파
		$this->db->cache_on();
		$tables = "board_".$table;
		$this->db->order_by($tables.'.no', 'desc');
		$this->db->limit(7);
  		$this->db->where(array("is_delete" => 'N', 'original_no' => '0'));
		$query = $this->db->get($tables);
		$this->db->cache_off();
		$return_val = '
		<div class="q_latest">

		<ol class="q_latest_ol">
			<li>
				<h4><a href="/'.$table.'/lists/page/1">'.$table_name.'</a></h4>
			</li>
			<ul>';
			foreach ($query->result_array() as $list)
			{

			$return_val .= '
				<li>
					<div style="float:left;">
						<img src="/images/main/arrow.gif"> <a href="/'.$table.'/view/'.$list['no'].'/page/1"> '.strcut_utf8(strip_tags($list['subject']), 21).' </a>';

						if ($list['reply_count'] > 0) {
							$return_val .= '&nbsp;<span class="comment">'.$list['reply_count'].'</span>';
						}
					$return_val .= '
					</div>
					<div style="float:right;">'.substr($list['reg_date'], 0, 10).'</div>
					<div class="q_latest_line"></div>
				</li>';
			 }
			$return_val .= '
			</ul>
		</ol>';

		if ($query->num_rows() == 0)
		{
			$return_val .= '
			<div><br>&nbsp; 게시물이 없습니다.
			</div>';
		}

		$return_val .= '</div><br>';
		return $return_val;
	}

	/**
	* 코멘트 최근리스트 표시 by emc
	*
	* 2012.04.02 자유게시판 이하 게시판들 추가 by 웅파
   	*
   	* @access private : 접근형태
    * @return String $return_val : 문자렬
    */
	function comment_list()
	{
		// 2011-09-30 order by limit 추가 6초대에서 0.03초대로..  by 웅파
		$this->db->cache_on();

		$sql  = "SELECT b.nickname, a.table, a.tbn, a.no, a.original_no, a.contents, a.user_name, a.user_id, a.reg_date from ( ";
		$sql .= "(SELECT 'CI 묻고 답하기' as 'table', 'qna' as 'tbn', no, original_no, contents, user_name, user_id, reg_date FROM board_qna  WHERE  is_delete = 'N' and original_no != '0' order by no desc limit 7 ) UNION ";
		$sql .= "(SELECT 'TIP게시판'      as 'table', 'tip' as 'tbn', no, original_no, contents, user_name, user_id, reg_date FROM board_tip  WHERE  is_delete = 'N' and original_no != '0' order by no desc limit 7 ) UNION ";
		$sql .= "(SELECT '강좌게시판' as 'table', 'lecture' as 'tbn', no, original_no, contents, user_name, user_id, reg_date FROM board_lecture  WHERE  is_delete = 'N' and original_no != '0' order by no desc limit 7 ) UNION ";
		$sql .= "(SELECT 'CI 코드'     as 'table', 'source' as 'tbn', no, original_no, contents, user_name, user_id, reg_date FROM board_source  WHERE  is_delete = 'N' and original_no != '0' order by no desc limit 7 ) UNION ";
		$sql .= "(SELECT 'CI 뉴스'       as 'table', 'news' as 'tbn', no, original_no, contents, user_name, user_id, reg_date FROM board_news  WHERE  is_delete = 'N' and original_no != '0' order by no desc limit 7 ) UNION ";
		$sql .= "(SELECT '공지사항'    as 'table', 'notice' as 'tbn', no, original_no, contents, user_name, user_id, reg_date FROM board_notice  WHERE  is_delete = 'N' and original_no != '0' order by no desc limit 7 ) UNION ";
		$sql .= "(SELECT '자유게시판'    as 'table', 'free' as 'tbn', no, original_no, contents, user_name, user_id, reg_date FROM board_free  WHERE  is_delete = 'N' and original_no != '0' order by no desc limit 7 ) UNION ";
		$sql .= "(SELECT 'CI외 질문게시판'    as 'table', 'etc_qna' as 'tbn', no, original_no, contents, user_name, user_id, reg_date FROM board_etc_qna  WHERE  is_delete = 'N' and original_no != '0' order by no desc limit 7 ) UNION ";
		$sql .= "(SELECT 'CI 사이트 소개'    as 'table', 'ci_make' as 'tbn', no, original_no, contents, user_name, user_id, reg_date FROM board_ci_make  WHERE  is_delete = 'N' and original_no != '0' order by no desc limit 7 )  UNION  ";
		$sql .= "(SELECT '구인구직'    as 'table', 'job' as 'tbn', no, original_no, contents, user_name, user_id, reg_date FROM board_job  WHERE  is_delete = 'N' and original_no != '0' order by no desc limit 7 )  UNION ";
		$sql .= "(SELECT '광고 홍보'    as 'table', 'ad' as 'tbn', no, original_no, contents, user_name, user_id, reg_date FROM board_ad  WHERE  is_delete = 'N' and original_no != '0' order by no desc limit 7 ) ";

		if($this->session->userdata('auth_code') >= '7')
		{
			$sql .= " UNION (SELECT '개발자게시판'    as 'table', 'ci' as 'tbn', no, original_no, contents, user_name, user_id, reg_date FROM board_ci  WHERE  is_delete = 'N' and original_no != '0' order by no desc limit 7 ) ";
		}

		$sql .= ") as a, users b where a.user_id=b.userid order by reg_date desc limit 7";

		$rs = $this->db->query($sql);

		$this->db->cache_off();

		$return_val = '
		<div class="q_latest">

		<ol class="q_latest_ol">
			<li>
				<h4><a href="/search/recent_comment">최근 코멘트</a></h4>
			</li>
			<ul>';
			foreach ($rs->result_array() as $list)
			{
				if($list['nickname'])
				{
					$name= $list['nickname'];
				}
				else
				{
					$name= $list['user_name'];
				}
			$return_val .= '
				<li>
					<div style="float:left;">
						<img src="/images/main/arrow.gif"> <a href="/'.$list['tbn'].'/view/'.$list['original_no'].'/page/1#row_num_'.$list['no'].'"> '.strcut_utf8(strip_tags($list['contents']), 21).' </a>';

					$return_val .= '
					</div>
					<div style="float:right;">'.substr($list['reg_date'], 0, 10).'</div>
					<div class="q_latest_line"></div>
				</li>';
			 }
		$return_val .= '
			</ul>
		</ol>';

		if ($rs->num_rows() == 0)
		{
		$return_val .= '
		<div><br>&nbsp; 게시물이 없습니다.
		</div>';
		}

		$return_val .= '</div><br>';
		return $return_val;
	}

	/**
	* 코멘트 최근리스트 표시 by 웅파
   	*
	* 2012.04.02 자유게시판 이하 게시판들 추가 by 웅파
	*
   	* @access private : 접근형태
    * @return String $return_val : 문자렬
    */
	function comment_list_full()
	{

		$sql  = "SELECT b.nickname, a.table, a.tbn, a.no, a.original_no, a.contents, a.user_name, a.user_id, a.reg_date, a.subject, a.hit, a.voted_count, a.reply_count from ( ";
		$sql .= "(SELECT 'CI 묻고 답하기' as 'table', 'qna' as 'tbn', no, original_no, contents, user_name, user_id, reg_date, subject, hit, voted_count, reply_count FROM board_qna  WHERE  is_delete = 'N' and original_no != '0' ) UNION ";
		$sql .= "(SELECT 'TIP게시판'      as 'table', 'tip' as 'tbn', no, original_no, contents, user_name, user_id, reg_date, subject, hit, voted_count, reply_count FROM board_tip  WHERE  is_delete = 'N' and original_no != '0' ) UNION ";
		$sql .= "(SELECT '강좌게시판' as 'table', 'lecture' as 'tbn', no, original_no, contents, user_name, user_id, reg_date, subject, hit, voted_count, reply_count FROM board_lecture  WHERE  is_delete = 'N' and original_no != '0' ) UNION ";
		$sql .= "(SELECT 'CI 코드'     as 'table', 'source' as 'tbn', no, original_no, contents, user_name, user_id, reg_date, subject, hit, voted_count, reply_count FROM board_source  WHERE  is_delete = 'N' and original_no != '0' ) UNION ";
		$sql .= "(SELECT 'CI 뉴스'       as 'table', 'news' as 'tbn', no, original_no, contents, user_name, user_id, reg_date, subject, hit, voted_count, reply_count FROM board_news  WHERE  is_delete = 'N' and original_no != '0' ) UNION ";
		$sql .= "(SELECT '공지사항'    as 'table', 'notice' as 'tbn', no, original_no, contents, user_name, user_id, reg_date, subject, hit, voted_count, reply_count FROM board_notice  WHERE  is_delete = 'N' and original_no != '0' ) UNION ";
		$sql .= "(SELECT '자유게시판'    as 'table', 'free' as 'tbn', no, original_no, contents, user_name, user_id, reg_date, subject, hit, voted_count, reply_count FROM board_free  WHERE  is_delete = 'N' and original_no != '0' )  UNION ";
		$sql .= "(SELECT 'CI외 질문게시판'    as 'table', 'etc_qna' as 'tbn',no, original_no, contents, user_name, user_id, reg_date, subject, hit, voted_count, reply_count FROM board_etc_qna  WHERE  is_delete = 'N' and original_no != '0' order by no desc limit 7 ) UNION ";
		$sql .= "(SELECT 'CI 사이트 소개'    as 'table', 'ci_make' as 'tbn', no, original_no, contents, user_name, user_id, reg_date, subject, hit, voted_count, reply_count FROM board_ci_make  WHERE  is_delete = 'N' and original_no != '0' order by no desc limit 7 )  UNION ";
		$sql .= "(SELECT '구인구직'    as 'table', 'job' as 'tbn', no, original_no, contents, user_name, user_id, reg_date, subject, hit, voted_count, reply_count FROM board_job  WHERE  is_delete = 'N' and original_no != '0' order by no desc limit 7 )  UNION ";
		$sql .= "(SELECT '광고 홍보'    as 'table', 'ad' as 'tbn', no, original_no, contents, user_name, user_id, reg_date, subject, hit, voted_count, reply_count FROM board_ad  WHERE  is_delete = 'N' and original_no != '0' order by no desc limit 7 ) ";

		if($this->session->userdata('auth_code') >= '7')
		{
			$sql .= " UNION (SELECT '개발자게시판'    as 'table', 'ci' as 'tbn', no, original_no, contents, user_name, user_id, reg_date, subject, hit, voted_count, reply_count FROM board_ci  WHERE  is_delete = 'N' and original_no != '0' ) ";
		}
		$sql .= ") as a, users b where a.user_id=b.userid and a.reg_date like '".date("Y-m-d")."%' order by no desc";

		$rs = $this->db->query($sql);

		return $rs->result_array();
	}

}
?>