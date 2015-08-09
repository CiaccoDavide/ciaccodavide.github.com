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
  .grid{width: 540px;height:378px;position:relative;left:50%;top:50%;margin-left:-270px;margin-top:-189px;}
  .grid span{border: solid 1px #333;width:38px;height:38px;padding:1px;box-shadow:inset 0 0 3px 0 #000;border-radius: 4px;margin: 6px;float: left;font-weight:100;font: 28px 'Quicksand', sans-serif;}/*54px di larghezza margine compreso*/
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
  #gameover{
    width: 560px;
    height: 380px;
    margin-left: -282px;
    margin-top: -192px;
    background: rgba(10,10,10,0.9);
    position: absolute;top: 50%;left: 50%;
    box-shadow:inset 0 0 10px 0 #000;border:solid 1px #333;overflow:hidden;border-radius: 3px;
  }
  progress{border: solid 1px #333;width:280px;height:20px;padding:1px;background: #111;box-shadow:inset 0 0 3px 0 #000;border-radius: 4px;margin-bottom: 20px;margin-top: 4px;}
  -webkit-progress-value{background: #1b7ded; /* Old browsers */
background: -moz-linear-gradient(top,  #1b7ded 0%, #0755a9 18%, #1364b5 96%, #408fe4 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#1b7ded), color-stop(18%,#0755a9), color-stop(96%,#1364b5), color-stop(100%,#408fe4)); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top,  #1b7ded 0%,#0755a9 18%,#1364b5 96%,#408fe4 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top,  #1b7ded 0%,#0755a9 18%,#1364b5 96%,#408fe4 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top,  #1b7ded 0%,#0755a9 18%,#1364b5 96%,#408fe4 100%); /* IE10+ */
background: linear-gradient(to bottom,  #1b7ded 0%,#0755a9 18%,#1364b5 96%,#408fe4 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#1b7ded', endColorstr='#408fe4',GradientType=0 ); /* IE6-9 */
border-radius: 2px;}
  progress[value]::-moz-progress-bar{background: #1b7ded; /* Old browsers */
background: -moz-linear-gradient(top,  #1b7ded 0%, #0755a9 18%, #1364b5 96%, #408fe4 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#1b7ded), color-stop(18%,#0755a9), color-stop(96%,#1364b5), color-stop(100%,#408fe4)); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top,  #1b7ded 0%,#0755a9 18%,#1364b5 96%,#408fe4 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top,  #1b7ded 0%,#0755a9 18%,#1364b5 96%,#408fe4 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top,  #1b7ded 0%,#0755a9 18%,#1364b5 96%,#408fe4 100%); /* IE10+ */
background: linear-gradient(to bottom,  #1b7ded 0%,#0755a9 18%,#1364b5 96%,#408fe4 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#1b7ded', endColorstr='#408fe4',GradientType=0 ); /* IE6-9 */
border-radius: 2px;
}
#topRecord{font-size:14px;color:#bbb;float: right;margin-top: -20px;}
.next{font-size:16px;position:absolute;left:50%;margin-left:-200px;bottom:4px;width:400px;height: auto;border-radius: 4px;color:#C6FF56;}
.leads{
  width: 540px;
  height: 360px;
  margin-left: -282px;
  margin-top: -192px;
  background: rgba(10,10,10,0.9);
  position: absolute;top: 50%;left: 50%;
  box-shadow:inset 0 0 10px 0 #000;border:solid 1px #333;overflow-x:hidden;overflow-y:auto;border-radius: 3px;
  padding:10px;
}.voce{font-size:16px;color:#aaa;}
  </style>
</head>
<body>

<?php
  include './fun.php';
  session_start();
  $username=$_SESSION['username'];
  $day=date("Y-m-d");
?>

  <header>
    <p>Points: <output id="points">0</output></p>
    <div id="topRecord">Record: <?php echo getDailyRecord($day); ?></div>
  </header>
  <div class="main">
  <div class="grid">
    <span id="pos"></span>
    <div id="tiles">

    </div>
    <span id="gameover"></span>
    <div class="leads"><?php echo getDailyLeaderboard($day); ?></div>
  </div>
  </div>
  <div class="foot"><small>press R to RESET . press L to toggle the LEADERBOARD . press X or ESC to EXIT<br>use WASD or the ARROW KEYS to MOVE</small></div>

  <script src="./js/jquery.min.js"></script>
  <script src="./js/seedrandom.min.js"></script>
  <script>

    $("#gameover").hide();
    $(".leads").toggle();

    /*START DECLARATION*/
    var exp=<?php echo getUserExp($username); ?>,level=<?php echo getUserLevel($username); ?>,points=0,varz=3.69,score=0,gameover=false;
    var expCap=Math.floor(100*(Math.pow(1.1,level))),expToAdd=0,record=<?php echo getYourDailyRecord($username,$day); ?>,w=10,h=7,mode=0,tiles="",max=9;
        var pos={x:0,y:0,passi:0,direction:0,moving:!1,move:function(a){if(this.moving)if(0<this.passi){0<grid[this.x][this.y]&&(grid[this.x][this.y]--,points++);switch(a){case 0:this.x--;break;case 1:this.y--;break;case 2:this.x++;break;case 3:this.y++}this.passi--}else this.moving=!1,0==grid[this.x][this.y]&&gameOver();else this.passi=grid[this.x][this.y],0<this.passi&&(points+=this.passi-1,this.direction=a,grid[this.x][this.y]=1,this.moving=!0);0>this.x&&(this.x=w-1);0>this.y&&(this.y=h-1);this.x>w-1&&
        (this.x=0);this.y>h-1&&(this.y=0)}},grid=[[0,0,0,0,0,0,0],[0,0,0,0,0,0,0],[0,0,0,0,0,0,0],[0,0,0,0,0,0,0],[0,0,0,0,0,0,0],[0,0,0,0,0,0,0],[0,0,0,0,0,0,0],[0,0,0,0,0,0,0],[0,0,0,0,0,0,0],[0,0,0,0,0,0,0]];
    var day="<?php echo $day; ?>";
    procGeneration("<?php echo $day; ?>");
    function procGeneration(a){Math.seedrandom(a);mode=Math.floor(100*Math.random()%4);w=Math.floor(100*Math.random()%8)+3;h=Math.floor(100*Math.random()%5)+3;$(".grid").width(54*w);$(".grid").height(54*h);$(".grid").css("margin-left",-(54*w)/2);$(".grid").css("margin-top",-(54*h)/2);pos.x=Math.floor(10*Math.random()%w);pos.y=Math.floor(10*Math.random()%h);max=Math.floor(100*Math.random()%7)+3;for(a=0;a<h;a++)for(var b=0;b<w;b++)grid[b][a]=Math.floor(10*Math.random()%max+1)}
    $("#output_random").text(w+","+h);runtimeLoop();function runtimeLoop(){setInterval(function(){tiles="";pos.moving&&pos.move(pos.direction);$("#pos").css("left",54*pos.x);$("#pos").css("top",54*pos.y);for(var a=0;a<h;a++)for(var b=0;b<w;b++)tiles+="<span id=n"+grid[b][a]+">"+grid[b][a]+"</span>";document.getElementById("tiles").innerHTML=tiles;score=(points+zerosCellsPoints()+zerosRowsPoints()+zerosColsPoints())*varz;$("#points").text(Math.floor(score/varz))},200)}
    function zerosCells(){for(var a=0,b=0;b<h;b++)for(var c=0;c<w;c++)0==grid[c][b]&&a++;return a}function zerosCellsPoints(){for(var a=zerosCells(),b=0;0<a;)b+=a,a--;return b}function zerosRows(){for(var a=0,b=0,c=0;c<h;c++){for(var d=a=0;d<w;d++)0!=grid[d][c]&&a++;0==a&&b++}return b}function zerosRowsPoints(){return 10*zerosRows()*w}function zerosCols(){for(var a=0,b=0,c=0;c<w;c++){for(var d=a=0;d<h;d++)0!=grid[c][d]&&a++;0==a&&b++}return b}function zerosColsPoints(){return 10*zerosCols()*h}
    function bonusExp(){return Math.floor(score/varz)>record?Math.floor(score/varz)-record:0}
    function gameOver(){gameover=!0;score=(points+zerosCellsPoints()+zerosRowsPoints()+zerosColsPoints())*varz;$("#gameover").show("slow").html('<h2>Game Over!</h2><h3 id="output_level">Level '+level+'</h3><p id="output_exp">Exp: '+exp+'/100</p><progress id="progressbar" value="'+exp+'" max="'+expCap+'"></progress><br><p>Exp bonus: +'+bonusExp()+"exp</p><p>Best score: "+record+"</p><h3>Score: "+Math.floor(score/varz)+"</h3><p>Points: "+points+"</p><p>"+zerosCells()+" zeros cells: +"+zerosCellsPoints()+
    "pts</p><p>"+zerosRows()+" zeros rows: +"+zerosRowsPoints()+"pts</p><p>"+zerosCols()+" zeros columns: +"+zerosColsPoints()+"pts</p><br>");expToAdd=bonusExp();upload();applyExp()}function applyExp(){$("#progressbar").val(exp);$("#progressbar").prop("max",expCap);$("#output_exp").text("Exp: "+exp+"/"+expCap);$("#output_level").text("Level: "+level);0<expToAdd&&(expToAdd--,exp++,exp>=expCap&&(exp=0,level++),expCap=Math.floor(100*Math.pow(1.1,level)),setTimeout("applyExp()",20))}
    function upload(){$.get("uploadDaily.php?day="+day+"&score="+Math.floor(score/varz))}function move(a){pos.moving||(36<a&&41>a?pos.move(a-37):65==a?pos.move(0):87==a?pos.move(1):68==a?pos.move(2):83==a&&pos.move(3));82==a&&location.reload();if(27==a||88==a)window.location="./?id="+parent.kongregate.services.getUserId()+"&usr="+parent.kongregate.services.getUsername()+"&token="+parent.kongregate.services.getGameAuthToken();76==a&&$(".leads").toggle("slow")}$(document).keydown(function(a){move(a.which);a.preventDefault()});
  </script>

</body>
</html>
