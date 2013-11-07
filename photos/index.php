<?php
		
echo '<p>Show:&nbsp <a href="index.php?show=all" id="all">All</a>,&nbsp <a href="index.php?show=rgb" id="rgb">Color</a>,&nbsp <a href="index.php?show=bn" id="bn">Black&ampWhite</a>.</p>
<br>';
		
$show=$_GET['show'];
$i=0;
if($show==null||$show=='all'){
	$handle = opendir(dirname(realpath(__FILE__)).'/thumbs/all/');
	$f=array();
	while($file = readdir($handle)){
		if($file !== '.' && $file !== '..'){
			$f[]=$file;
		}
	}
	unset($file,$handle); 
	sort($f);
	foreach($f as $file){
		echo '<photo id="all"><p><a href="photos/index.php?start='.$i.'&show='.$show.'" target="_blank"><img src="thumbs/all/'.$file.'" height="100" /></a></p></photo>';
		$i++;
	}
}
if($show=='bn'){
	$handle = opendir(dirname(realpath(__FILE__)).'/thumbs/bn/');
	$f=array();
	while($file = readdir($handle)){
		if($file !== '.' && $file !== '..'){
			$f[]=$file;
		}
	}
	unset($file,$handle); 
	sort($f);
	foreach($f as $file){
		echo '<photo id="bn"><p><a href="photos/index.php?start='.$i.'&show='.$show.'" target="_blank"><img src="thumbs/bn/'.$file.'" height="100" /></a></p></photo>';
		$i++;
	}
}
if($show=='rgb'){
	$handle = opendir(dirname(realpath(__FILE__)).'/thumbs/rgb/');
	$f=array();
	while($file = readdir($handle)){
		if($file !== '.' && $file !== '..'){
			$f[]=$file;
		}
	}
	unset($file,$handle); 
	sort($f);
	foreach($f as $file){
		echo '<photo id="rgb"><p><a href="photos/index.php?start='.$i.'&show='.$show.'" target="_blank"><img src="thumbs/rgb/'.$file.'" height="100" /></a></p></photo>';
		$i++;
	}
}
			
?>