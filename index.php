<?php
ini_set('precision','5'); //��� ��� ���������� �������!
header('Content-Type','text/html; charset=utf-8'); //��� �� �������� �� ��������
?>
<!DOCTYPE html>
<html><head><title>DeltaHacker Facebook Likes</title></head>
<body><?php

define('OPEN','placePageStats\\">\\u003cdiv>\\u003cspan class=\\"uiNumberGiant fsxxl fwb\\">'); //�� ����� ������ ������� ���� ��� ������ ��� ���

if(!isset($_GET['fans'])) {
	$url='http://www.facebook.com/deltaHacker';
	$params['http']['method'] = 'GET';
	$params['http']['header'] = 'User-Agent: Mozilla/5.0 (Windows NT 5.1) AppleWebKit/535.1 (KHTML, like Gecko) Chrome/13.0.782.24 Safari/535.1'; //�������� �� Facebook ��� ������� ��� ������� ����������� browser
	$ctx = stream_context_create($params);
	$fp = @fopen($url, 'rb', false, $ctx);
	if (!$fp) {
		throw new Exception("�������� �� �� $url !, $php_errormsg");
	}
	$response = @stream_get_contents($fp);
	if ($response === false) {
		throw new Exception("�������� ���� ��� �������� ������� ��� �� $url !, $php_errormsg");
	}
	$response = explode(OPEN,$response); //��������� �� ����� ���� ��� �� ������� OPEN ��� ��� ������ ���� ��� �����
	$response = $response[1];
	$response = explode('\\',$response); //������� ���� �� ������� ��� ������ ��������� ���� ��� �� \
	$response = $response[0];
	$response = preg_replace('/[^0-9]/', '', $response); //������� ���� ���� �������� ��� ��� �� �����/��� ������
	$response = (int) $response;
} else {
	$response = (int) $_GET['fans'];
}
?><p>� ����� ��� DeltaHacker ���� <span style="font-weight:bold;font-size:25px;"><?php echo $response; ?></span> �������, ������ <span style="font-size:15px;">2^<span  style="font-weight:bold;font-size:25px;"><?php echo log($response,2)/*log_2(f)*/ ?></span></p>
<p>��� �� �������� ���� 2^<b><?php echo (int) log($response,2)+1; ?></b> ������� ������������ <?php echo pow(2,(int)log($response,2)+1); ?> �����, ������ ������ <?php echo (int) pow(2,(int)log($response,2)+1)-$response; ?>.</p>
</body></html>