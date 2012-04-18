<?php
ini_set('precision','5'); //Όχι στα μακροσκελή νούμερα!
header('Content-Type','text/html; charset=utf-8'); //Για να βγαίνουν τα ελληνικά
?>
<!DOCTYPE html>
<html><head>
<title>DeltaHacker Facebook Likes</title>
<style type="text/css">
h1 {
	background-color: black;
	padding: 4px;
	color: lime;
	float: left;
	margin: 5px;
	border-radius: 5px;
}
.mlink {
	color: inherit;
	text-decoration: none;
}
.mlink:hover, .mlink:hover span {
	text-decoration: underline;
}
.mlink:active {
	  text-shadow: rgba(0,0,0,0.5) -1px 0, rgba(0,0,0,0.3) 0 -1px, rgba(255,255,255,0.5) 0 1px, rgba(0,0,0,0.3) -1px -2px;
}
</style>
</head>
<body><?php

define('OPEN','<td class="vMid hCent"><span class="tlTxHf stats fwb">'); //Το τμήμα κώδικα ακριβώς πριν τον αριθμό των φαν

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
	$response = explode('<',$response); //Κρατάμε μόνο το νούμερο και πετάμε οτιδήποτε μετά από το <
	$response = $response[0];
	$response = preg_replace('/[^0-9]/', '', $response); //Κρατάμε μόνο τους αριθμούς και όχι το κόμμα/την τελεία
	$response = (int) $response;
} else {
	$response = (int) $_GET['fans'];
}
?><h1><a href="http://deltahacker.gr/" class="mlink">d3lta H@ck3<span style="-moz-transform: scale(-1, 1);-webkit-transform: scale(-1, 1);-o-transform: scale(-1, 1);transform: scale(-1, 1);display:inline-block;">R</span></a></h1>
<p><a href="http://facebook.com/deltaHacker">Η ομάδα του DeltaHacker</a> έχει <span style="font-weight:bold;font-size:25px;"><?php echo $response; ?></span> οπαδούς, δηλαδή <span style="font-size:15px;">2^</span><span  style="font-weight:bold;font-size:25px;"><?php echo log($response,2)/*log_2(f)*/ ?></span>.</p>
<p>Για να φτάσουμε τους 2^<b><?php echo (int) log($response,2)+1; ?></b> οπαδούς χρειαζόμαστε <?php echo pow(2,(int)log($response,2)+1); ?> άτομα, δηλαδή άλλους <?php echo (int) pow(2,(int)log($response,2)+1)-$response; ?>.</p>
<p>Ένας εφικτός στόχος είναι οι 2^<?php echo log(4000,2); ?> (4000), δηλαδή άλλα <?php echo 4000-$response ?> άτομα.</p>
<p>Για τον τελικό στόχο των 2^12.288 (<?php echo pow(2,12.2877); ?>) θα πρέπει να αποκτήσουμε <?php echo pow(2,12.2877)-$response ?> περισσότερα άτομα που θα κάνουν like.</p>
<h2>Δείξτε ενδιαφέρον στο DeltaHacker</h2><p><iframe src="http://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.facebook.com%2FdeltaHacker&amp;send=false&amp;layout=standard&amp;width=650&amp;show_faces=true&amp;action=like&amp;colorscheme=light&amp;font&amp;height=30" style="border:none; overflow:hidden; width:650px; height:28px;"></iframe>
</p>
</body></html>