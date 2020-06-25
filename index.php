<?php 
	include 'simple_html_dom.php';
	include 'event.php';

	$url = 'https://sinhvien.ictu.edu.vn/hoat-dong/diem-ca-nhan/';
	$id = $_GET['id'];
	$page = file_get_html($url.$id.'.html');

	$name = $page->find('h1', 0)->plaintext;
	$class = $page->find('h2', 0)->plaintext;
	$temp = $page->find('h3', 0)->find('span', 0)->plaintext;
	$true = $page->find('h3', 1)->find('span', 0)->plaintext;
	$wait = $page->find('h3', 1)->find('span', 1)->plaintext;
	$img = $page->find('img', 2)->src;
	$start = strpos($page, 'list');
	$end = strpos($page, '],list_emu') - $start;
	$data = substr($page, $start, $end);
	$arr_data = explode('{', $data);
	$list_event = array();
	for ($i = 1; $i < sizeof($arr_data); $i++) {
		$a = explode(',', $arr_data[$i]);

		$id = substr($a[0], strpos($a[0], ':') + 1);
		$name = str_replace("\"", "", substr($a[1], strpos($a[1], ':') + 1));
		$name = str_replace("\\", "", $name);
		array_push($list_event, new Event($id, $name));
	}

	$arr = array("name" => $name,
		"class" => $class,
		"temp" => $temp,
		"true" => $true,
		"wait" => $wait,
		"img" => $img,
		"list_event" => $list_event);

	$json = stripslashes(json_encode($arr, JSON_UNESCAPED_UNICODE));
	echo $json;
?>