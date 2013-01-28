<?php
	$db = "my_floatingminds"; $acc = "floatingminds"; $acx = "ciakkor91"; $host = "localhost";
	mysql_connect("$host", "$acc", "$acx")or die("cannot connect"); 
	mysql_select_db("$db")or die("cannot select DB");
	$time = date('dHis', strtotime(mysql_real_escape_string($_POST['date'] . ' ' . $_POST['time'])));
?>