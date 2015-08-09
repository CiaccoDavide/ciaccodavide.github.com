<!DOCTYPE html>
<html>
<head>
  <link href='http://fonts.googleapis.com/css?family=Lato:100,300,100italic,300italic|Quicksand:300,400|Source+Code+Pro:200,300,400|Raleway:100,200' rel='stylesheet' type='text/css'>

  <style type="text/css">
  *               {padding:0;margin:0;font: 26px 'Quicksand', sans-serif;color:#eee;}
  body            {background:#111;padding-top:40px;}
  h2              {font-size:20px;font-weight: 100;padding-bottom: 10px;padding-top: 30px;}
  header          {font-size:20px;position:fixed;left:10px;top:0px;right:10px;height:30px;padding:4px;}
  p               {font-size:18px;font-weight: 100;}
  small           {font-size:14px;color:#bbb;}
  .foot           {text-align:center;width:600px;}
  .main{text-align:center;width:600px;height:400px;margin-left:10px;box-shadow:inset 0 0 10px 0 #000;border:solid 1px #333;overflow:hidden;border-radius: 3px;}
  .grid{width: 540px;height:378px;position:relative;left:50%;top:50%;margin-left:-270px;margin-top:-189px;overflow: auto;}
  .grid span{position:relative;border: solid 1px #333;width:400px;height:38px;box-shadow:inset 0 0 3px 0 #000;border-radius: 4px;font-weight:100;font: 28px 'Quicksand', sans-serif;margin: 10px;display: block;left:50%;margin-left: -200px;}/*54px di larghezza margine compreso*/
  .grid span:hover{cursor: pointer;background:#1e1e1e;}
  .n0{border: solid 1px #dddddd;color:#dddddd;}
  .n1{border: solid 1px #FF5656;color:#FF5656;}
  .n2{border: solid 1px #FFBB56;color:#FFBB56;}
  .n3{border: solid 1px #C6FF56;color:#C6FF56;}
  .n4{border: solid 1px #72FF56;color:#72FF56;}
  .n5{border: solid 1px #56FF9C;color:#56FF9C;}
  .n6{border: solid 1px #56FFFF;color:#56FFFF;}
  .n7{border: solid 1px #7CB3FF;color:#7CB3FF;}
  .n8{border: solid 1px #927CFF;color:#927CFF;}
  .n9{border: solid 1px #DE7CFF;color:#DE7CFF;}
  #pos{z-index:-1;position:absolute;border: solid 1px #aaa;width:44px;height:44px;padding:1px;border-radius: 6px;margin: 3px;float:left;left:54px;top:54px;background: rgba(255,255,255,0.1);}
  </style>
</head>
<body>

  <header>
  </header>

<?php include './fun.php'; session_start(); $username=$_SESSION['username']; ?>

  <div class="main">
  <div class="grid">
  </div>
  </div>
  <div class="foot"><small>unlock a new level playing the last one.</small></div>

  <script src="./js/jquery.min.js"></script>
  <script type="text/javascript" src="http://www.kongregate.com/javascripts/kongregate_api.js"></script>
  <script>

  var l=<?php echo lastLevel($username); ?>,output="<small>Select one level:</small>";
  
  for(i=l;i>=0;i--)output+='<span class="n'+(i%10)+'" id="'+(i)+'">Level #'+(i)+'</span>';
  $('.grid').html(output);
  $('.grid>span').click(function() {
    window.location = './grid.php?l='+this.id;
  });

  function move(keycode){
      if(keycode==13||keycode==78)window.location = './grid.php?l='+l;//next level
      if(keycode==27||keycode==88)window.location = './?id=' + parent.kongregate.services.getUserId()  +
									                   '&usr=' + parent.kongregate.services.getUsername() +
									                   '&token=' + parent.kongregate.services.getGameAuthToken();//back
    }
    $(document).keydown(function(e){
      move(e.which);
      e.preventDefault();
    });
  </script>

</body>
</html>
