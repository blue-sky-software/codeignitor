<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * HTTP의 URL을 "/"를 Delimiter로 사용하여 배렬로 바꾸어 리턴한다.
 *
 * @param	string	대상이 되는 문자렬
 * @return	string[]
 */

function is_user_logined()
{
	$CI =& get_instance();
	
	if('Y' === $CI->session->userdata('IS_LOGINED'))
		return true;
	else
		return false;
}

function get_loginid()
{
	$CI =& get_instance();
	
	return $CI->session->userdata('LOGINED_USERID');
}

function is_admin_logined()
{
	$CI =& get_instance();
	
	if('Y' === $CI->session->userdata('IS_ADMIN_LOGINED'))
		return true;
	else
		return false;
}

function get_login_admin_id()
{
	$CI =& get_instance();
	
	return $CI->session->userdata('LOGINED_ADMINID');
}

function segment_explode($seg)
{
	//세크먼트 앞뒤 '/' 제거후 uri를 배렬로 반환
	$len = strlen($seg);
	if(substr($seg, 0, 1) == '/')
	{
		$seg = substr($seg, 1, $len);
	}
	$len = strlen($seg);

	if(substr($seg, -1) == '/')
	{
		$seg = substr($seg, 0, $len-1);
	}
	$seg_exp = explode("/", $seg);

	return $seg_exp;
}

/**
 * url중 키값을 구분하여 값을 가져오도록.
 *
 * @param Array $url : segment_explode 한 url값
 * @param String $key : 가져오려는 값의 key
 * @return String $url[$k] : 리턴값
 */
function url_explode($url, $key)
{
	$cnt = count($url);
	for($i=0; $cnt>$i; $i++ )
	{
		if($url[$i] ==$key)
		{
			$k = $i+1;
			return $url[$k];
		}
	}
}


function pagination($link, $paging_data)
{
	$links = "";

	// The first page
	$links .= anchor($link . '/' . $paging_data['first'], 'First', array('title' => 'Go to the first page', 'class' => 'first_page'));
	$links .= "\n";
	// The previous page
	$links .= anchor($link . '/' . $paging_data['prev'], '<', array('title' => 'Go to the previous page', 'class' => 'prev_page'));
	$links .= "\n";

	// The other pages
	for ($i = $paging_data['start']; $i <= $paging_data['end']; $i++)
	{
		if ($i == $paging_data['page'])
			$current = '_current';
		else
			$current = "";

		$links .= anchor($link . '/' . $i, $i, array('title' => 'Go to page ' . $i, 'class' => 'page' . $current));
		$links .= "\n";
	}

	// The next page
	$links .= anchor($link . '/' . $paging_data['next'], '>', array('title' => 'Go to the next page', 'class' => 'next_page'));
	$links .= "\n";
	// The last page
	$links .= anchor($link . '/' . $paging_data['last'], 'Last', array('title' => 'Go to the last page', 'class' => 'last_page'));
	$links .= "\n";

	return $links;
}

function paging($page,$rp,$total,$limit)
{
	$limit -= 1;

	$mid = floor($limit/2);

	if ($total>$rp)
		$numpages = ceil($total/$rp);
	else
		$numpages = 1;

	if ($page>$numpages) $page = $numpages;

		$npage = $page;

	while (($npage-1)>0&&$npage>($page-$mid)&&($npage>0))
		$npage -= 1;

	$lastpage = $npage + $limit;

	if ($lastpage>$numpages)
		{
		$npage = $numpages - $limit + 1;
		if ($npage<0) $npage = 1;
		$lastpage = $npage + $limit;
		if ($lastpage>$numpages) $lastpage = $numpages;
		}

	while (($lastpage-$npage)<$limit) $npage -= 1;

	if ($npage<1) $npage = 1;

	//echo $npage; exit;

	$paging['first'] = 1;
	if ($page>1) $paging['prev'] = $page - 1; else $paging['prev'] = 1;
	$paging['start'] = $npage;
	$paging['end'] = $lastpage;
	$paging['page'] = $page;
	if (($page+1)<$numpages) $paging['next'] = $page + 1; else $paging['next'] = $numpages;
	$paging['last'] = $numpages;
	$paging['total'] = $total;
	$paging['iend'] = $page * $rp;
	$paging['istart'] = ($page * $rp) - $rp + 1;

	if (($page * $rp)>$total) $paging['iend'] = $total;

	return $paging;
}

function url_delete($url_arr, $del_param)
{
	$arr_s = array_search($del_param, $url_arr);

	if($arr_s != '')
	{
		array_splice($url_arr, $arr_s, 2);
	}

	return $url_arr;
}
/**
* 내용중에서 이미지명 추출후 DB 입력, 파일갯수 리턴. fckeditor용
*/
function strip_image_tags_fck($str, $no, $type, $table, $table_no)
{
	$CI =& get_instance();
	$file_table="files";
	preg_match_all("<img [^<>]*>", $str, $out, PREG_PATTERN_ORDER);
	$strs = $out[0];
	//$arr=array();
	$cnt = count($strs);
	for ($i=0;$i<$cnt;$i++)
	{
		$arr = preg_replace("#img\s+.*?src\s*=\s*[\"']\s*\/data/images/\s*(.+?)[\"'].*?\/#", "\\1", $strs[$i]);
		$data = array(
					'module_id'=> $table_no,
					'module_name'=> $table,
					'module_no'=>$no,
					'module_type'=>$type,
					'file_name'=>$arr,
					'reg_date'=>date("Y-m-d H:i:s")
					);
		if ( count($arr) <= 25 )
		{
			$CI->db->insert($file_table, $data);
		}

	}
	return $cnt;
}

function trim_text($str,$len,$tail="..")
{
	if(strlen($str)<$len)
	{

		return $str; //자를길이보다 문자렬이 작으면 그냥 리턴

	}
	else
	{
		$result_str='';
		for($i=0;$i<$len;$i++)
		{
			if((Ord($str[$i])<=127)&&(Ord($str[$i])>=0)){$result_str .=$str[$i];}
			else if((Ord($str[$i])<=223)&&(Ord($str[$i])>=194)){$result_str .=$str[$i].$str[$i+1];$i+1;}
			else if((Ord($str[$i])<=239)&&(Ord($str[$i])>=224)){$result_str .=$str[$i].$str[$i+1].$str[$i+2];$i+2;}
			else if((Ord($str[$i])<=244)&&(Ord($str[$i])>=240)){$result_str .=$str[$i].$str[$i+1].$str[$i+2].$str[$i+3];$i+3;}
		}

		return $result_str.$tail;
	}
}

/**
* checkmb=true, len=10
* 한글과 Eng (한글=2*3 + 공백=1*1 + 영문=1*1 => 10)
* checkmb=false, len=10
* 한글과 English (모두 합쳐 10자)
*/
function strcut_utf8($str, $len, $checkmb=false, $tail='..')
{
	preg_match_all('/[\xEA-\xED][\x80-\xFF]{2}|./', $str, $match);

	$m = $match[0];
	$slen = strlen($str); // length of source string
	$tlen = strlen($tail); // length of tail string
	$mlen = count($m); // length of matched characters

	if ($slen <= $len) return $str;
	if (!$checkmb && $mlen <= $len) return $str;

	$ret = array();
	$count = 0;

	for ($i=0; $i < $len; $i++)
	{
		$count += ($checkmb && strlen($m[$i]) > 1)?2:1;

		if ($count + $tlen > $len) break;
		$ret[] = $m[$i];
	}

	return join('', $ret).$tail;
}

//로그인 처리용 주소 인코딩, 디코딩
function url_code($url, $type='e')
{
	if($type == 'e')
	{
		//encode
		return strtr(base64_encode(addslashes(gzcompress(serialize($url), 9))), '+/=', '-_.');
	}
	else
	{
		//decode
		return unserialize(gzuncompress(stripslashes(base64_decode(strtr($url, '-_.', '+/=')))));
	}
}

//게시판 모델에서 이동. 게시물내 오토링크
function auto_link2($str)
{
	// 속도 향상 031011
	$str = preg_replace("/&lt;/", "\t_lt_\t", $str);
	$str = preg_replace("/&gt;/", "\t_gt_\t", $str);
	$str = preg_replace("/&amp;/", "&", $str);
	$str = preg_replace("/&quot;/", "\"", $str);
	$str = preg_replace("/&nbsp;/", "\t_nbsp_\t", $str);
	$str = preg_replace("/([^(http:\/\/)]|\(|^)(www\.[^[:space:]]+)/i", "\\1<A HREF=\"http://\\2\" TARGET='_blank'><font color=blue><u>\\2</u></font></A>", $str);
	$str = preg_replace("/([^(HREF=\"?'?)|(SRC=\"?'?)]|\(|^)((http|https|ftp|telnet|news|mms):\/\/[a-zA-Z0-9\.-]+\.[\xA1-\xFEa-zA-Z0-9\.:&#=_\?\/~\+%@;\-\|\,]+)/i", "\\1<A HREF=\"\\2\" TARGET='_blank'><font color=blue><u>\\2</u></font></A>", $str);
	// 이메일 정규표현식 수정 061004
	//$str = preg_replace("/(([a-z0-9_]|\-|\.)+@([^[:space:]]*)([[:alnum:]-]))/i", "<a href='mailto:\\1'>\\1</a>", $str);
	$str = preg_replace("/([0-9a-z]([-_\.]?[0-9a-z])*@[0-9a-z]([-_\.]?[0-9a-z])*\.[a-z]{2,4})/i", "<a href='mailto:\\1'>\\1</a>", $str);
	$str = preg_replace("/\t_nbsp_\t/", "&nbsp;" , $str);
	$str = preg_replace("/\t_lt_\t/", "&lt;", $str);
	$str = preg_replace("/\t_gt_\t/", "&gt;", $str);

	return $str;
}

?>