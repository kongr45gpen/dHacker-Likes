<!DOCTYPE html>
<html>
<head>
<title>DeltaHacker Facebook Likes</title>
<link rel="stylesheet" href="bootstrap.css" type="text/css">
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
.container {
	padding-top: 20px;
}
</style>
<meta charset="utf-8">
</head>

<body>
<div class="container">
<?php

if(isset($_GET['fans'])) {
	$response = (int) $_GET['fans'];
} elseif(isset($fans)) {
	$response = (int) $fans;
} else {
	$response = file_get_contents('http://graph.facebook.com/deltahacker?fields=likes');
	$response = json_decode($response,1);
	$response = $response['likes'];
	$response = (int) $response;
}
$nexttarget = ceil(log($response+1,2)/5)*5;
?>

<h1><a href="http://deltahacker.gr/" class="mlink">&nabla;3lta H@ck3<span style="-moz-transform: scale(-1, 1);-webkit-transform: scale(-1, 1);-o-transform: scale(-1, 1);transform: scale(-1, 1);display:inline-block;">R</span></a></h1>
<p><a href="http://facebook.com/deltaHacker">Η ομάδα του DeltaHacker</a> έχει <span class="well well-small" style="font-weight:bold;font-size:25px;display:inline;padding:5px;padding-top:3px;padding-bottom:3px;"><?php echo number_format($response); ?></span> οπαδούς, δηλαδή <span style="font-size:15px;">2^</span><span  style="font-weight:bold;font-size:25px;"><?php echo round(log($response,2),2)/*log_2(f)*/ ?></span>.</p>
<p>Για να φτάσουμε τους 2^<b><?php echo (int) log($response,2)+1; ?></b> οπαδούς χρειαζόμαστε <?php echo number_format(pow(2,(int)log($response,2)+1)); ?> άτομα, δηλαδή άλλους <?php echo number_format((int) pow(2,(int)log($response,2)+1)-$response); ?>.</p>
<p>Για τον απώτερο στόχο των 2^<?php echo $nexttarget ; ?> (<?php echo number_format(pow(2,$nexttarget)) ?>), δηλαδή άλλα <?php echo number_format(pow(2,$nexttarget)-$response) ?> άτομα.</p>
<h2>Δείξτε ενδιαφέρον στο DeltaHacker</h2><p><iframe src="http://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.facebook.com%2FdeltaHacker&amp;send=false&amp;layout=standard&amp;width=650&amp;show_faces=true&amp;action=like&amp;colorscheme=light&amp;font&amp;height=30" style="border:none; overflow:hidden; width:650px; height:28px;"></iframe></p>
<hr />
<iframe src="http://ghbtns.com/github-btn.html?user=kongr45gpen&repo=dHacker-Likes&type=watch&count=true" allowtransparency="true" frameborder="0" scrolling="0" width="110px" height="20px"></iframe>
</div>
</body>
</html>
