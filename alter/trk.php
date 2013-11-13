<?php
$t = $_GET['t'];
$t=stripslashes($t);
$t=mysql_real_escape_string($t);
ob_start();
$host="localhost";
$username="ciaccodavide";
$password="ciakkor91";
$db_name="my_ciaccodavide";
$tbl_name=$t;
mysql_connect("$host", "$username", "$password")or die("cannot connect");
mysql_select_db("$db_name")or die("cannot select DB");

	date_default_timezone_set('Italy/Rome');
    $date = date('Y/m/d H:i:s');
	$y=date('Y');
	$m=date('m');
	$d=date('d');
	$h=date('H:i:s');

	$cip = $_SERVER['HTTP_CLIENT_IP'];
	$hxff = $_SERVER['HTTP_X_FORWARDED_FOR'];
	$hxf = $_SERVER['HTTP_X_FORWARDED'];
	$hff = $_SERVER['HTTP_FORWARDED_FOR'];
	$hf = $_SERVER['HTTP_FORWARDED'];
	$ra = $_SERVER['REMOTE_ADDR'];
	
	mysql_query("INSERT INTO $tbl_name VALUES ('','$y','$m','$d','$h','$cip','$hxff','$hxf','$hff','$hf','$ra')");
ob_end_flush();
	
$img = imagecreatetruecolor(1,1);
$c = imagecolorallocatealpha($img,0,0,0,0);
imagefill($img, 0, 0, $c);
header("Content-type: image/png");
imagepng($img);
imagedestroy($img);
//every tot(10?) sec -> send tot to database [fattibile con un php all'interno di un iframe invisibile, anonimo(solo tempo speso sul sito, magari pure la pagina su cui si trova: un codice o una smallword)]
?>