﻿<?php
ini_set('precision','5'); //Όχι στα μακροσκελή νούμερα!
header('Content-Type','text/html; charset=utf-8'); //Για να βγαίνουν τα ελληνικά
?>
<!DOCTYPE html>
<html><head><title>DeltaHacker Facebook Likes</title></head>
<body><?php

define('OPEN','placePageStats\\">\\u003cdiv>\\u003cspan class=\\"uiNumberGiant fsxxl fwb\\">'); //Το τμήμα κώδικα ακριβώς πριν τον αριθμό των φαν

if(!isset($_GET['fans'])) {
	$url='http://www.facebook.com/deltaHacker';
	$params['http']['method'] = 'GET';
	$params['http']['header'] = 'User-Agent: Mozilla/5.0 (Windows NT 5.1) AppleWebKit/535.1 (KHTML, like Gecko) Chrome/13.0.782.24 Safari/535.1'; //Ξεγελάμε το Facebook που νομίζει ότι είμαστε πραγματικός browser
	$ctx = stream_context_create($params);
	$fp = @fopen($url, 'rb', false, $ctx);
	if (!$fp) {
		throw new Exception("Πρόβλημα με το $url !, $php_errormsg");
	}
	$response = @stream_get_contents($fp);
	if ($response === false) {
		throw new Exception("Πρόβλημα κατά την ανάγνωση αρχείων από το $url !, $php_errormsg");
	}
	$response = explode(OPEN,$response); //Χωρίζουμε το μέρος πριν από τη σταθερά OPEN από τον κώδικα μετά από αυτήν
	$response = $response[1];
	$response = explode('\\',$response); //Κρατάμε μόνο το νούμερο και πετάμε οτιδήποτε μετά από το \
	$response = $response[0];
	$response = preg_replace('/[^0-9]/', '', $response); //Κρατάμε μόνο τους αριθμούς και όχι το κόμμα/την τελεία
	$response = (int) $response;
} else {
	$response = (int) $_GET['fans'];
}
?><h1>d3lta H@ck3<span style="-moz-transform: scale(-1, 1);-webkit-transform: scale(-1, 1);-o-transform: scale(-1, 1);transform: scale(-1, 1);">R</span></h1>
<p>Η ομάδα του DeltaHacker έχει <span style="font-weight:bold;font-size:25px;"><?php echo $response; ?></span> οπαδούς, δηλαδή <span style="font-size:15px;">2^</span><span  style="font-weight:bold;font-size:25px;"><?php echo log($response,2)/*log_2(f)*/ ?></span>.</p>
<p>Για να φτάσουμε τους 2^<b><?php echo (int) log($response,2)+1; ?></b> οπαδούς χρειαζόμαστε <?php echo pow(2,(int)log($response,2)+1); ?> άτομα, δηλαδή άλλους <?php echo (int) pow(2,(int)log($response,2)+1)-$response; ?>.</p>
<p>Ένας πιο εφικτός στόχος είναι οι 2^<?php echo log(2000,2); ?> (2000), δηλαδή άλλα <?php echo 2000-$response ?> άτομα.</p>
<p>Για τον τελικό στόχο των 2^12.288 (<?php echo pow(2,12.2877); ?>) θα πρέπει να αποκτήσουμε <?php echo pow(2,12.2877)-$response ?> περισσότερα άτομα που θα κάνουν like.</p>
</body></html>