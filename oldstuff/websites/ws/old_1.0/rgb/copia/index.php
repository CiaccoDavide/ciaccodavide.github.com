<!doctype html>  
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Ciacco Davide - RGB</title>
		<meta name="description" content="Realized using css3, html5, JS and PHP">
		<meta name="author" content="Davide Ciacco">
		<meta name="viewport" content="width=800, user-scalable=yes">
		<link href='http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="css/rgb.css">
		<script type='text/javascript' src='http://code.jquery.com/jquery-1.6.js'></script>
		<script src="jquery.iphone-switch.js" type="text/javascript"></script>
		<script src="jquery.transit.js" type="text/javascript"></script>
	</head>
	<body>
	<div id="menu">
		<a href="../"><li>&nbsp - Home</li></a>
		<a href="#"><li>&nbsp - Projects</li></a>
		<a href="#"><li>&nbsp - Photos</li></a>
		<a href="#"><li>&nbsp - About</li></a>
	</div>
	<div id="back">
<?php
@include("time.php");
/*return a "random" value between 2 and 10 (1 = 10) using time.php*/
/**/	for($i=0;$i<strlen($time);$i++) {						/**/
/**/			$t=$t+$time[$i];								/**/
/**/	}														/**/
/**/	$t=strval($t);											/**/
/**/	while(strlen($t)>1) {									/**/
/**/		for($i=0;$i<strlen($t);$i++) {						/**/
/**/			$s=$s+$t[$i];									/**/
/**/		}													/**/
/**/		$t=$s;												/**/
/**/	}														/**/
/**/	if($t==1)												/**/
/**/		$t=10;												/**/
/*----------------------------------------------------------------*/
@include("pi10k.php");
//choose a random starting point for Pi-string using Mersenne twister.
$r = mt_rand(0,strlen($pi)-1000);
	for($i=$r-1;$i!=$r+1000;$i++) {
	
		if($pi[$i]==1)
			$color='a';
		if($pi[$i]==2)
			$color='b';
		if($pi[$i]==3)
			$color='c';
		if($pi[$i]==4)
			$color='d';
		if($pi[$i]==5)
			$color='e';
		if($pi[$i]==6)
			$color='f';
		if($pi[$i]==7)
			$color='g';
		if($pi[$i]==8)
			$color='h';
		if($pi[$i]==9)
			$color='i';
		
		$size=$pi[$i+1]*60;
			
			echo '<backtext &nbsp id="'.$color.'" &nbsp style="width:'.$size.'px;"></backtext>';
		
		if($i==strlen($pi))
			$i=1;
	}
?>
</div>
		<div class="contents">
			<div class="intestazione">
				<big>R<med>andom</med>G<med>enerated</med>B<med>ackground</med></big><small>Created by <a href="../">Davide Ciacco</a></small>
			</div>
			<div id="post">
				<div class="button" id="1"></div>
				<h2>Project #1</h2><br>
				<h1>Random Generated Background</h1><br>
				<p>PHP, HTML and CSS interacting together to create a "random" generated background that changes every session. "Randomization" depends on time and the entropy of number Pi.</p>
				<br><br>
				<p>Generation process:</p>
				<br><p>- The firsts 10'000 digits of Pi are stored in a php string into "pi10k.php"</p>
				<p>Random number generated using Mersenne Twister:<php>&nbsp <?echo$r?></php>&nbsp (This number sets the starting position on 10'000 digits of Pi)</p>
				<br><p>- Another random number (from 2 to 10) sets the lapse for the extraction of single numbers from Pi digits.</p>
				<p>Time value:<php>&nbsp <?echo$time?></php>&nbsp [Day:&nbsp <php><?echo$time[0];echo$time[1];?></php>&nbsp h:&nbsp <php><?echo$time[2];echo$time[3];?></php>&nbsp Min:&nbsp <php><?echo$time[4];echo$time[5];?></php>&nbsp Secs:&nbsp <php><?echo$time[6];echo$time[7];?></php>]</p>
				<p>Random(2-10) based on time value:<php>&nbsp <?echo$t?></php></p>
			</div>




</div>
		</div>
		
		<div class="sharing">
			<a href="http://twitter.com/share" class="twitter-share-button" data-text="Work in progress #Ciacco Davide" data-url="http://ciaccodavi.de" data-count="small"></a>
		</div>
		<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
		
		<script type="text/javascript">
		$('#1').iphoneSwitch("off", 
		function() {$('#back').css({ 'visibility' : 'visible'});},
		function() {$('#back').css({ 'visibility' : 'hidden'});},
		{switch_off_container_path: 'iphone_switch_container_on.png'});
		</script>

	</body>
</html>