<?php

session_start();

if(!isset($_SESSION["username"])){
    header("location:login.php");
    exit();
}

  include './php/dbconnect.php';
    // $username=$_POST['u'];
    $username=$_SESSION["username"];


    /* Create a prepared statement */
    if($stmt = $mysqli -> prepare("SELECT id,dynasty,sw_id,sh_id FROM pgs WHERE name=?")) {
        /* Bind parameters
        s - string, b - blob, i - int, etc */
        $stmt -> bind_param("s", $username);
        /* Execute it */
        $stmt -> execute();
        /* Bind results */
        $stmt -> bind_result($user_id,$user_dynasty,$user_sw_id,$user_sh_id);
        /* Fetch the value */
        $stmt -> fetch();
        /* Close statement */
        $stmt -> close();
    }
    
    $dynasty=$user_dynasty;
    // $sword_id=mt_rand(0,1000000000);
    // $shield_id=mt_rand(0,1000000000);
    
    function toZero($stat){
        if($stat>0)return $stat;
        return 0;
    }
    $pts=0;
    $pts+=($sword_stat_R/2)+toZero(($sword_stat_R/2)-$shield_stat_R);
    $pts+=($sword_stat_G/2)+toZero(($sword_stat_G/2)-$shield_stat_G);
    $pts+=($sword_stat_B/2)+toZero(($sword_stat_B/2)-$shield_stat_B);
    $pts+=($sword_stat_Rr/2)+toZero(($sword_stat_Rr/2)-$shield_stat_Rr);
    $pts+=($sword_stat_Gr/2)+toZero(($sword_stat_Gr/2)-$shield_stat_Gr);
    $pts+=($sword_stat_Br/2)+toZero(($sword_stat_Br/2)-$shield_stat_Br);

    function pDD($num){
        return intval($num*100)/100;
    }
    $pts=pDD($pts);





    function dToDynasty($d){
      switch($d){
        case 0: return "Fire";break;
        case 1: return "Venom";break;
        case 2: return "Water";break;
        case 3: return "Wind";break;
        case 4: return "Entropy";break;
        case 5: return "Electricity";break;
        default: return "Fire";break;
      }return "Fire";
    }
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <link rel="stylesheet" type="text/css" href="./tooltipster.css" />
    <link rel="stylesheet" href="./jquery.mCustomScrollbar.css" />
  <style type="text/css">
  *               {padding:10px;margin:0;font-family: Verdana,Geneva,sans-serif;}
  body            {background:#2A363B;color:#fff;overflow-x:scroll;padding-top:20px;font-size:14px;max-width:800px;
-webkit-touch-callout: none;
    -webkit-user-select: none;
    -khtml-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
  }
  header{background:#E84A5F;padding:10px;border-radius: 3px;position: relative;}
  .gear{background:#1A262B;padding:10px;border-radius: 3px;margin: 20px 0;}
  h1{padding: 0}
  h2{background:#2A363B;color:#99B898;}
  h3{/*background:#FECEA8;color:#2A363B;*/color:#99B898;padding:5px;padding-bottom: 0;padding-top: 20px;}
  h4{color:#FECEA8;padding-bottom: 0;}
  h5{color:#FECEA8;}
  p{
    /*background:#2A363B;*/
    padding: 2px 10px;
  }
  a{text-decoration: none;color:#777;}
  a:hover{text-decoration: underline;color:#aaa;}
  g{color:#2A363B;padding:0;}
#sword_one{width:80px;height: 200px;box-shadow:inset 0 0 10px 0 #000;overflow:hidden;border-radius: 3px;padding:0;margin:10px;margin-top: 5px;display:inline-block;}
#sword_one{background: url("./php/spade.php?id=<?php echo $sword_id; ?>&q=10&invert=0");}
#shield_one{width:80px;height: 80px;box-shadow:inset 0 0 10px 0 #000;overflow:hidden;border-radius: 3px;padding:0;margin:10px;margin-top: 5px;display:inline-block;}
#shield_one{background: url("./php/shield.php?id=<?php echo $shield_id; ?>&q=10&invert=0");}
#treasure{width:200px;height: 200px;box-shadow:inset 0 0 10px 0 #000;overflow:hidden;border-radius: 3px;padding:0;margin:10px;margin-top: 5px;position: relative;left: 50%;margin-left:-100px;}
#treasure{background: url("./imgs/treasure_chest.png");
background-repeat: no-repeat;
background-position: center;
background-color: #1f1f1f;}
#treasure:hover{cursor: pointer;}

#sword_graph{width:80px;height: 80px;box-shadow:inset 0 0 10px 0 #000;overflow:hidden;border-radius: 3px;padding:0;margin:10px;margin-top: 5px;display:inline-block;}
#sword_graph{background: url("./php/graph.php?id=<?php echo $sword_id; ?>");}
#shield_graph{width:80px;height: 80px;box-shadow:inset 0 0 10px 0 #000;overflow:hidden;border-radius: 3px;padding:0;margin:10px;margin-top: 5px;display:inline-block;}
#shield_graph{background: url("./php/graph.php?id=<?php echo $shield_id; ?>");}
.q0{border:solid 1px #999; !important}
.q1{border:solid 1px #04A3E4; !important}
.q2{border:solid 1px #cFcF14; !important}
.q3{border:solid 1px #D107FF; !important}
.q4{border:solid 1px #FF3C35; !important}
.q5{border:solid 1px #FFA347; !important}
/*QUALITY COLORS*/
#q0{color:#bbb;}
#q1{color:#04A3E4;}
#q2{color:#cFcF14;}
#q3{color:#D107FF;}
#q4{color:#FF3C35;}
#q5{color:#FFA347;}

td{background:#142025;padding:4px;text-align:center;width:40px;font-size:10px;}
table{margin-bottom:20px;}
#sword_stats,#shield_stats{margin:0;padding:0;}
.element{margin:0;padding:0;}
td img{height:20px;}
small{font-size:9px;color:#888;margin-bottom:8px;}
sml{font-size:10px;padding:0;margin:0;}
.centrato{text-align: center;padding: 0;margin:0;}
.achbox{background: #232f34;padding: 5px 0;margin:6px;}
.achbox small{padding: 1px 8px;display: block;margin:0;}
.achbox p{padding: 1px 8px;display: block;margin:0;color:#ad8;}
.done{color:#8da;}
.logout{position: absolute;right: -8px;top:-4px;}
.logout a{color:#2A363B;text-decoration: none;}
.logout a:hover{color:#3A465B;text-decoration: underline;}
#treasure_stats{width:260px;position: relative;left: 50%;margin-left: -130px;}



  </style>
</head>
<body>

  <header>
    <h1><?php echo $username; ?></h1>
      <p><g>Rank:</g> <span id="rank_holder"></span></p>
      <p><g>Ratio:</g> 156/65 <g>[won/lost]</g></p>
      <p><g>Dynasty:</g> <?php echo dToDynasty($dynasty); ?></p>
      <div class="logout"><a href="./php/esci.php">.logout</a></div>
  </header>

  <div class="gear" id='gearPanel'>
    
  </div>

  <div class="gear">
    <h1>Rewards</h1>
    <br>
    <div class="centrato" id="treasure_title">
      <p id="q0">Treasure Chest</p>
      <small>-</small>
    </div>
    <div id="treasure" class="q0"></div>
    <div class="centrato">
      <small>(tap to open)</small>
    </div>

    <div class="centrato" id="treasure_stats">
      
    </div>
  </div>

  <div class="gear">
    <h1>Last Duels</h1>
  </div>

  <div class="gear">
    <h1>Last Drops</h1>
  </div>

  <div class="gear">
    <h1>Tournaments</h1>
    <h3>Global</h3>
    <p>1. Username</p>
    <p>2. Username</p>
    <p>3. Username</p>
    <a href="#">.full list</a>

    <h3>Dynasty</h3>
    <h4>Fire</h4>
    <p>1. Username</p>
    <p>2. Username</p>
    <p>3. Username</p>
    <a href="#">.full list</a>

    <h4>Venom</h4>
    <p>1. Username</p>
    <p>2. Username</p>
    <p>3. Username</p>
    <a href="#">.full list</a>

    <h4>Water</h4>
    <p>1. Username</p>
    <p>2. Username</p>
    <p>3. Username</p>
    <a href="#">.full list</a>

    <h4>Wind</h4>
    <p>1. Username</p>
    <p>2. Username</p>
    <p>3. Username</p>
    <a href="#">.full list</a>

    <h4>Entropy</h4>
    <p>1. Username</p>
    <p>2. Username</p>
    <p>3. Username</p>
    <a href="#">.full list</a>

    <h4>Electricity</h4>
    <p>1. Username</p>
    <p>2. Username</p>
    <p>3. Username</p>
    <a href="#">.full list</a>

    <p></p>
  </div>

  <div class="gear">
    <h1>Awards</h1>
    <p>(Achievements)</p>
    <div id="ach">
      <div class="achbox">
        <small> ✓ 10 Duels won</small>
        <p> ✓ 20 Duels won</p>
        <small> → 40 Duels won</small>
      </div>
      <div class="achbox">
        <small> ✓ 10 Duels won</small>
        <p> ✓ 20 Duels won</p>
        <small> → 40 Duels won</small>
      </div>
    </div>
  </div>

  <div class="gear">
    <h1>About this game</h1>
    <br>
    <p>This is a game played by my server, you can only create new "players" and monitor them while they duel with the others!</p>
    <p>You can create a new player entering a new name, if the name already exists means that an other user already used that name.</p>
    <p>If you want you can still monitor other players characters and help them opening treasures!</p>
    <p>Every time you open a treasure, a sword or a necklace will be dropped and equipped if it's more powerful for the character's specific dynasty</p>
    <p>This is a world where everybody fight each other randomly and in organized tournaments!</p>
    <p>Yes, every character will fight naked, only wearing that necklace and with his sword in his hands.</p>
    <p>This world is divided into dynasties.</p>
    <p>Every day (always at the same hour) a tournament is held to choose one champions from each dynasty.</p>
    <p>When the six champions will be chosen they will fight in one last tournament to find out who is the global champion, the strongest and which dynasty is the best!</p>
    <p></p>
    <br>
  </div>

  <div class="gear">
    <h1>Settings</h1>
    <p>Change user</p>
  </div>

  <br>
  <br>
  <br>
  <script src="./jquery.min.js"></script>
  <script src="./jquery.timer.js"></script>
  <script src="./jquery.mCustomScrollbar.concat.min.js"></script>

	<script>
		$(window).load(function(){
			$(".minions").mCustomScrollbar({
				axis:"y",
				theme: "minimal",
				mouseWheel:{ scrollAmount: 1000,preventDefault: true }
			});
		});












		function scala(num){
		segno=1;
		if(num<0){num*=-1;segno=-1;}
		  if(num < 1e3)         return pDD(segno*num);
		  else if(num >= 1e39)  return pDD(segno*num/1e39) + " Duodecillions";
		  else if(num >= 1e36)  return pDD(segno*num/1e36) + " Undecillions";
		  else if(num >= 1e33)  return pDD(segno*num/1e33) + " Decillions";
		  else if(num >= 1e30)  return pDD(segno*num/1e30) + " Nonillions";
		  else if(num >= 1e27)  return pDD(segno*num/1e27) + " Octillions";
		  else if(num >= 1e24)  return pDD(segno*num/1e24) + " Septillions";
		  else if(num >= 1e21)  return pDD(segno*num/1e21) + " Sextillions";
		  else if(num >= 1e18)  return pDD(segno*num/1e18) + " Quintillions";
		  else if(num >= 1e15)  return pDD(segno*num/1e15) + " Quadrillions";
		  else if(num >= 1e12)  return pDD(segno*num/1e12) + " T";
		  else if(num >= 1e9)   return pDD(segno*num/1e9) + " B";
		  else if(num >= 1e6)   return pDD(segno*num/1e6) + " M";
		  else if(num >= 1e3)   return pDD(segno*num/1e3) + " K";
		}function pDD(num){//tieni solo 2 cifre decimali - parsaDueDecimali
		  return Math.floor(100*num)/100;
		}/*
		//right click disabled
		$('html').bind('contextmenu', function(){
		      return false;
		});
*/


    var username='<?php echo $username; ?>';

		var treasure_finding_status=0;
    var treasure_found_id=0;
    var treasure_found_type=0;
    var treasure_found_better=0;
    var tfs_0=tfs_1=tfs_2=tfs_3=tfs_4=tfs_5=0;
    var treasure_stats_header='<table><tr><td class="element"><img class="element" src="./imgs/icon_0_fire.png" alt="Fire"/></td><td class="element"><img class="element" src="./imgs/icon_1_venom.png" alt="Venom"/></td><td class="element"><img class="element" src="./imgs/icon_2_water.png" alt="Water"/></td><td class="element"><img class="element" src="./imgs/icon_3_wind.png" alt="Wind"/></td><td class="element"><img class="element" src="./imgs/icon_4_entropy.png" alt="Entropy"/></td><td class="element"><img class="element" src="./imgs/icon_5_electricity.png" alt="Electricity"/></td></tr><tr>';
    var treasure_stats_corpo='<td> - </td><td> - </td><td> - </td><td> - </td><td> - </td><td> - </td>';
    var treasure_stats_coda='</tr></table>';
    $('#treasure_stats').html(treasure_stats_header+treasure_stats_corpo+treasure_stats_coda);

		$('#treasure').click(function(){
			if(treasure_finding_status==0){
				loadDrop();
			}
			if(treasure_finding_status==2) newChest();
		});

		function loadDrop(){
			treasure_finding_status=1;
			$('#treasure').css(	{
				'background':'url("./imgs/loading.gif")',
				'background-repeat':'no-repeat',
				'background-position':'center',
				'background-color':'#1f1f1f'}
			);
      $.post("./php/drop.php?u="+username, {u:username}, function(data){
        //Il risultato del post è nell'alert
        treasure_found_id=data[0];
        treasure_found_type=data[1];
        treasure_found_better=data[2];
        tfs_0=data[3];
        tfs_1=data[4];
        tfs_2=data[5];
        tfs_3=data[6];
        tfs_4=data[7];
        tfs_5=data[8];
      }, "json");

			setTimeout(showDrop, 1000);
		}
		function showDrop(){
			var swsh=treasure_found_type;
			var id=treasure_found_id;
      var q=quality(id);
			if(swsh==1){
				$('#treasure').css({
					'background':'url("./php/shield.php?id='+id+'")',
					'background-repeat':'no-repeat',
					'background-position':'center',
					'background-color':'#1f1f1f'}
				);
        $('#treasure_title').html('<p id="q'+q+'">'+qToString(q)+' Necklace</p><small>#'+id+'</small>');
			}else{
				$('#treasure').css({
					'background':'url("./php/spade.php?id='+id+'")',
					'background-repeat':'no-repeat',
					'background-position':'center',
					'background-color':'#1f1f1f'}
				);
        $('#treasure_title').html('<p id="q'+q+'">'+qToString(q)+' Sword</p><small>#'+id+'</small>');
			}
			$('#treasure').removeClass('q0 q1 q2 q3 q4 q5').addClass('q'+q);





      treasure_stats='';

      treasure_stats+='<td>'+tfs_0+'</td>';
      treasure_stats+='<td>'+tfs_1+'</td>';
      treasure_stats+='<td>'+tfs_2+'</td>';
      treasure_stats+='<td>'+tfs_3+'</td>';
      treasure_stats+='<td>'+tfs_4+'</td>';
      treasure_stats+='<td>'+tfs_5+'</td>';



      $('#treasure_stats').html(treasure_stats_header+treasure_stats+treasure_stats_coda);

      if(treasure_found_better==1){
        updateGearPanel();
      }

			setTimeout(canGoBackNow, 1000);
		
		}
		function canGoBackNow(){
			treasure_finding_status=2;
		}
		function newChest(){
			$('#treasure').css(	{
				'background':'url("./imgs/treasure_chest.png")',
				'background-repeat':'no-repeat',
				'background-position':'center',
				'background-color':'#1f1f1f'}
			);
			$('#treasure').removeClass('q0 q1 q2 q3 q4 q5').addClass('q0');
      $('#treasure_title').html('<p id="q0">Treasure Chest</p><sml>-</sml>');
      $('#treasure_stats').html(treasure_stats_header+treasure_stats_corpo+treasure_stats_coda);
			treasure_finding_status=0;
		}


		function quality(id){
	        id=id%100000;
	        if(id<71899){return 0;}
	        else if(id<91899){return 1;}
	        else if(id<97899){return 2;}
	        else if(id<99899){return 3;}
	        else if(id<99999){return 4;}
	        else {return 5;}
	    }
      function qToString(q){
        switch(q){
          case 0: return "Common";break;
          case 1: return "Magic";break;
          case 2: return "Rare";break;
          case 3: return "Epic";break;
          case 4: return "Legendary";break;
          case 5: return "Unique";break;
          default: return "Common";break;
        }return "Common";
      }


var sw_data = new Array(7);
var sh_data = new Array(7);
        var sword_randomer=0;
        var shield_randomer=0;

updateGearPanel();
function updateGearPanel(){
  $.post("./php/getUserGear.php?u="+username, {u:username}, function(data){
        
        sw_data[0]=data[0];
        sw_data[1]=data[1];
        sw_data[2]=data[2];
        sw_data[3]=data[3];
        sw_data[4]=data[4];
        sw_data[5]=data[5];
        sw_data[6]=data[6];

        sh_data[0]=data[7];
        sh_data[1]=data[8];
        sh_data[2]=data[9];
        sh_data[3]=data[10];
        sh_data[4]=data[11];
        sh_data[5]=data[12];
        sh_data[6]=data[13];

        sword_randomer=data[14];
        shield_randomer=data[15];

$('#rank_holder').html((10-quality(sw_data[0])-quality(sh_data[0])));

$('#gearPanel').html('<h1>Gear</h1><br><p id="q'+quality(sw_data[0])+'">'+qToString(sw_data[0])+' Sword <sml>['+sword_randomer+']</sml><small>#'+sw_data[0]+'</small></p><div id="sword_one" class="q'+quality(sw_data[0])+'"></div><div id="sword_graph" class="q'+quality(sw_data[0])+'"></div><div id="sword_stats"><table><tr><td class="element"><img class="element" src="./imgs/icon_0_fire.png" alt="Fire"/></td><td class="element"><img class="element" src="./imgs/icon_1_venom.png" alt="Venom"/></td><td class="element"><img class="element" src="./imgs/icon_2_water.png" alt="Water"/></td><td class="element"><img class="element" src="./imgs/icon_3_wind.png" alt="Wind"/></td><td class="element"><img class="element" src="./imgs/icon_4_entropy.png" alt="Entropy"/></td><td class="element"><img class="element" src="./imgs/icon_5_electricity.png" alt="Electricity"/></td></tr><tr><td>'+sw_data[1]+'</td><td>'+sw_data[2]+'</td><td>'+sw_data[3]+'</td><td>'+sw_data[4]+'</td><td>'+sw_data[5]+'</td><td>'+sw_data[6]+'</td></tr></table></div><p id="q'+quality(sh_data[0])+'">'+qToString(sh_data[0])+' Necklace <sml>['+shield_randomer+']</sml><small>#'+sh_data[0]+'</small></p><div id="shield_one" class="q'+quality(sh_data[0])+'"></div><div id="shield_graph" class="q'+quality(sh_data[0])+'"></div><div id="sword_stats"><table><tr><td class="element"><img class="element" src="./imgs/icon_0_fire.png" alt="Fire"/></td><td class="element"><img class="element" src="./imgs/icon_1_venom.png" alt="Venom"/></td><td class="element"><img class="element" src="./imgs/icon_2_water.png" alt="Water"/></td><td class="element"><img class="element" src="./imgs/icon_3_wind.png" alt="Wind"/></td><td class="element"><img class="element" src="./imgs/icon_4_entropy.png" alt="Entropy"/></td><td class="element"><img class="element" src="./imgs/icon_5_electricity.png" alt="Electricity"/></td></tr><tr><td>'+sh_data[1]+'</td><td>'+sh_data[2]+'</td><td>'+sh_data[3]+'</td><td>'+sh_data[4]+'</td><td>'+sh_data[5]+'</td><td>'+sh_data[6]+'</td></tr></table></div>');

        $('#sword_one').css({
          'background':'url("./php/spade.php?id='+sw_data[0]+'")',
          'background-repeat':'no-repeat',
          'background-position':'center',
          'background-color':'#1f1f1f'}
        );$('#sword_graph').css({
          'background':'url("./php/graph.php?id='+sw_data[0]+'")',
          'background-repeat':'no-repeat',
          'background-position':'center',
          'background-color':'#1f1f1f'}
        );$('#shield_one').css({
          'background':'url("./php/shield.php?id='+sh_data[0]+'")',
          'background-repeat':'no-repeat',
          'background-position':'center',
          'background-color':'#1f1f1f'}
        );$('#shield_graph').css({
          'background':'url("./php/graph.php?id='+sh_data[0]+'")',
          'background-repeat':'no-repeat',
          'background-position':'center',
          'background-color':'#1f1f1f'}
        );

      }, "json");


}



      //achievements
      /*
        duels won
        rarity gear found
        better gear found (?)
      */


      var duels_won=1243;
      var gear_0=56347;
      var gear_1=645;
      var gear_2=435;
      var gear_3=123;
      var gear_4=11;
      var gear_5=4;

      var ach_output='';
      ach_output+=calcolaAch('Duesl won',duels_won);
      ach_output+=calcolaAch('Unique items found',gear_5);
      ach_output+=calcolaAch('Legendary items found',gear_4);
      ach_output+=calcolaAch('Epic items found',gear_3);
      ach_output+=calcolaAch('Rare items found',gear_2);
      ach_output+=calcolaAch('Magic items found',gear_1);
      ach_output+=calcolaAch('Common items found',gear_0);

      function calcolaAch(s,n) {
        x=1;
        out='<div class="achbox">';
        while(x<=n-x){
          out+='<small class="done"> ✓ '+scala(x)+' '+s+'</small>';
          x*=2;
        }
        if(x!=10||n-x>=0){out+='<p> ✓ '+scala(x)+' '+s+'</p>';x*=2;}
        out+='<small> → '+scala(x)+' '+s+' ['+scala(n)+'/'+scala(x)+']</small>';
        return out+'</div>';
      }

      $('#ach').html(ach_output);

      //prevent textselect, longtap
      $(document).ready(function(){

         $('body').disableSelection();
          
      });
      $.fn.extend({
        disableSelection: function() {
          this.each(function() {
            this.onselectstart = function() {
              return false;
            };
            this.unselectable = "on";
            $(this).css('-moz-user-select', 'none');
            $(this).css('-webkit-user-select', 'none');
          });
          return this;
        }
      });

	</script>

</body>
</html>
