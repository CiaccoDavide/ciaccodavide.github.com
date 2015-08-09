<!DOCTYPE html>
<html>
<head>
  <link href='http://fonts.googleapis.com/css?family=Lato:100,300,100italic,300italic|Quicksand:300,400|Source+Code+Pro:200,300,400|Raleway:100,200' rel='stylesheet' type='text/css'>

  <style type="text/css">
  *               {padding:0;margin:0;font: 26px 'Quicksand', sans-serif;color:#eee;}
  body            {background:#111;padding-top:20px;}
  h2              {font-size:20px;font-weight: 100;padding-bottom: 10px;padding-top: 30px;}
  header          {font-size:20px;position:fixed;left:10px;top:0px;right:10px;height:30px;padding:4px;}
  p               {font-size:18px;font-weight: 100;}
  small           {font-size:14px;color:#bbb;}
  h1{font-size: 50px;display: inline-block;height: 60px;width: 60px;margin:2px;border-radius: 6px;}
  .foot           {text-align:center;width:600px;}
  .main{text-align:center;width:600px;height:420px;margin-left:10px;box-shadow:inset 0 0 10px 0 #000;border:solid 1px #333;overflow:hidden;border-radius: 3px;}
  .grid{width: 540px;height:378px;position:relative;left:50%;top:50%;margin-left:-270px;margin-top:-189px;}
  .grid span{position:relative;border: solid 1px #333;width:400px;height:36px;box-shadow:inset 0 0 3px 0 #000;border-radius: 4px;font-weight:100;font: 24px 'Quicksand', sans-serif;margin: 10px;display: block;left:50%;margin-left: -200px;}/*54px di larghezza margine compreso*/
  .grid span:hover{cursor: pointer;background:#1e1e1e;}
  #n0{border: solid 1px #dddddd;color:#dddddd;}
  #n1{border: solid 1px #FF5656;color:#FF5656;}
  #n2{border: solid 1px #FFBB56;color:#FFBB56;}
  #n3{border: solid 1px #C6FF56;color:#C6FF56;}
  #n4{border: solid 1px #72FF56;color:#72FF56;}
  #n5{border: solid 1px #56FF9C;color:#56FF9C;}
  #n6{border: solid 1px #56FFFF;color:#56FFFF;}
  #n7{border: solid 1px #7CB3FF;color:#7CB3FF;}
  #n8{border: solid 1px #927CFF;color:#927CFF;}
  #n9{border: solid 1px #DE7CFF;color:#DE7CFF;}
  #t1{border: solid 1px rgba(255, 215, 0, 0.4);color:#ffd700;border-radius: 6px;margin-bottom: 1px;}
  #t2{border: solid 1px rgba(192, 192, 192, 0.4);color:#eee;border-radius: 6px;margin-bottom: 1px;}
  #t3{border: solid 1px rgba(205, 127, 50, 0.4);color:#cd7f32;border-radius: 6px;}
  #pos{z-index:-1;position:absolute;border: solid 1px #aaa;width:44px;height:44px;padding:1px;border-radius: 6px;margin: 3px;float:left;left:54px;top:54px;background: rgba(255,255,255,0.1);}
  .title{display: inline-block;margin-bottom: 8px;}
  .dailytop{position:relative;border: solid 1px #333;width:460px;height:auto;box-shadow:inset 0 0 3px 0 #000;border-radius: 4px;font-weight:100;font: 20px 'Quicksand', sans-serif;margin: 10px;display: block;left:50%;margin-left: -250px;bottom:0;overflow: auto;padding-bottom: 8px;padding-left: 20px;padding-right: 20px;}
  .dailytop b{font-size: 20px;}
  .dailytop small{padding: 0;margin: 0;display:block;}
  .tutbtn{position:fixed;left:10px;top:0px;border: solid 1px #333;box-shadow:inset 0 0 3px 0 #000;border-radius: 4px;font-weight:100;font: 11px 'Quicksand', sans-serif;display: block;padding: 2px;}
  .tutbtn:hover{cursor:pointer;border: solid 1px #fff;}
  .tutbtn img{width:8px;height:8px;margin-right:4px;}
  </style>
</head>
<body>

<?php
	include './fun.php';
	$username=$_GET['usr'];
	session_start();
	$_SESSION['username']=$username;
  $day=date("Y-m-d");
?>

  <div class="main">
  <div class="grid">
  <div class="tutbtn"><?php echo getMedals($username); ?></div>
  <div class="title"><h1 id="n1">Z</h1><h1 id="n2">3</h1><h1 id="n4">R</h1><h1 id="n6">0</h1><h1 id="n7">E</h1><h1 id="n9">D</h1></div>
  <p>Welcome, <?php echo $username; ?>!</p>
  <p>Level <?php echo getUserLevel($username); ?></p>
    <span id="n5" class="play">Play!</span>
    <span id="n2" class="daily">Daily Challenge</span>
<div class="dailytop">
    <b>Daily Top 6</b><br>
    <?php
    	echo getDailyTop($day);
    ?>
</div>
  </div>
  </div>
  <div class="foot"><small id="fyi">FYI there are N possible different levels.</small></div>

  <script src="./js/jquery.min.js"></script>
  <script>
  parent.kongregate.stats.submit("userlevel",<?php echo getUserLevel($username); ?>);
  $('.play').click(function() {
    window.location = './levels.php?levels=100';
  });
  $('.daily').click(function() {
    window.location = './daily.php';
  });
  var h=24-<?php echo date("H");?>;
  var m=60-<?php echo date("i");?>;
  var s=60-<?php echo date("s");?>;
  //countdown
  countdown();
  function countdown(){
    setInterval(function(){
      if(s<0){s=59;m--;}
      if(m<0){m=59;h--;}
      if(h<0){h=23;m=59;s=59;}
      $('#fyi').text('Time left for the daily challenge: '+h+'h '+m+'m '+s+'s');
      s--;
    },1000);
  }
  </script>

</body>
</html>
