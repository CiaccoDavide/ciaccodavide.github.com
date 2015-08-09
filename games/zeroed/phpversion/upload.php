<?php


include './fun.php';


	$level=$_GET['level'];
	$score=$_GET['score'];
	session_start();
	$username=$_SESSION['username'];

	$db = mysqli_connect('localhost', 'grid', '', 'zeroed');
	$result=mysqli_query($db, "SELECT score FROM scores WHERE level=$level AND user='$username'");
	$count=mysqli_num_rows($result);
	if($count>0){
		$row=mysqli_fetch_array($result);
		$old_score=$row['score'];
		if($old_score<$score){
			mysqli_query($db, "UPDATE scores SET score=$score,data=NOW() WHERE level=$level AND user='$username'");
			addExp($score-$old_score,$username);
		}
	}else{
		mysqli_query($db, "INSERT INTO scores VALUES (null,$level,'$username',$score,NOW())");
		addExp($score,$username);
	}

	$db = mysqli_connect('localhost', 'grid', '', 'zeroed');
	$result=mysqli_query($db, "SELECT lastlevel FROM utenti WHERE username='$username' AND lastlevel=$level");
	$count=mysqli_num_rows($result);
	if($count>0) mysqli_query($db, "UPDATE utenti SET lastlevel=$level+1 WHERE username='$username'");

?>
