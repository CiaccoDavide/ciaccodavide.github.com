<?php


include './fun.php';


  $day=$_GET['day'];
  $score=$_GET['score'];
  session_start();
  $username=$_SESSION['username'];

  $db = mysqli_connect('localhost', 'grid', '', 'zeroed');
  $result=mysqli_query($db, "SELECT score FROM daily WHERE day='$day' AND user='$username'");
  $count=mysqli_num_rows($result);
  if($count>0){
    $row=mysqli_fetch_array($result);
    $old_score=$row['score'];
    if($old_score<$score){
      mysqli_query($db, "UPDATE daily SET score=$score WHERE day='$day' AND user='$username'");
      addExp($score-$old_score,$username);
    }
  }else{
    mysqli_query($db, "INSERT INTO daily VALUES (null,'$day','$username',$score)");
    addExp($score,$username);
  }

?>
