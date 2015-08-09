<?php

	function getUserLevel($username){
		$level=0;
		$db = mysqli_connect('localhost', 'grid', '', 'zeroed');
		$result=mysqli_query($db, "SELECT level FROM utenti WHERE username='$username'");
		$count=mysqli_num_rows($result);
		if($count>0){
			$row=mysqli_fetch_array($result);
			$level=$row['level'];
		}else{
			mysqli_query($db, "INSERT INTO utenti VALUES ('$username',0,0,0)");
		}return $level;
	}function getUserExp($username){
		$exp=0;
		$db = mysqli_connect('localhost', 'grid', '', 'zeroed');
		$result=mysqli_query($db, "SELECT exp FROM utenti WHERE username='$username'");
		$count=mysqli_num_rows($result);
		if($count>0){
			$row=mysqli_fetch_array($result);
			$exp=$row['exp'];
		}return $exp;
	}function getRecord($username,$lvl){
		$record=0;
		$db = mysqli_connect('localhost', 'grid', '', 'zeroed');
		$result=mysqli_query($db, "SELECT score FROM scores WHERE user='$username' AND level=$lvl");
		$count=mysqli_num_rows($result);
		if($count>0){
			$row=mysqli_fetch_array($result);
			$record=$row['score'];
		}return $record;
	}
	function getDailyRecord($day){
		$record=0;
		$db = mysqli_connect('localhost', 'grid', '', 'zeroed');
		$result=mysqli_query($db, "SELECT score FROM daily WHERE day='$day' ORDER BY score DESC LIMIT 1");
		$count=mysqli_num_rows($result);
		if($count>0){
			$row=mysqli_fetch_array($result);
			$record=$row['score'];
		}return $record;
	}function getYourDailyRecord($username,$day){
		$record=0;
		$db = mysqli_connect('localhost', 'grid', '', 'zeroed');
		$result=mysqli_query($db, "SELECT score FROM daily WHERE user='$username' AND day='$day'");
		$count=mysqli_num_rows($result);
		if($count>0){
			$row=mysqli_fetch_array($result);
			$record=$row['score'];
		}return $record;
	}

	function getDailyTop($day){
		$top='';
		$db = mysqli_connect('localhost', 'grid', '', 'zeroed');
		$result=mysqli_query($db, "SELECT user,score FROM daily WHERE day='$day' ORDER BY score DESC LIMIT 6");


		if($row=mysqli_fetch_array($result)){
			$top.='<small id="t1">#1 - '.$row['user'].' - '.$row['score'].'pts</small>';
			if($row=mysqli_fetch_array($result)){
				$top.='<small id="t2">#2 - '.$row['user'].' - '.$row['score'].'pts</small>';
				if($row=mysqli_fetch_array($result)){
					$top.='<small id="t3">#3 - '.$row['user'].' - '.$row['score'].'pts</small>';
					if($row=mysqli_fetch_array($result)){
						$top.='<small>#4 - '.$row['user'].' - '.$row['score'].'pts</small>';
						if($row=mysqli_fetch_array($result)){
							$top.='<small>#5 - '.$row['user'].' - '.$row['score'].'pts</small>';
							if($row=mysqli_fetch_array($result)){
								$top.='<small>#6 - '.$row['user'].' - '.$row['score'].'pts</small>';
							}else{
								return $top.'<small>#6 - username - 000pts</small>';
							}
						}else{
							return $top.'<small>#5 - username - 000pts</small><small>#6 - username - 000pts</small>';
						}
					}else{
						return $top.'<small>#4 - username - 000pts</small><small>#5 - username - 000pts</small><small>#6 - username - 000pts</small>';
					}
				}else{
					return $top.'<small id="t3">#3 - username - 000pts</small><small>#4 - username - 000pts</small><small>#5 - username - 000pts</small><small>#6 - username - 000pts</small>';
				}
			}else{
				return $top.'<small id="t2">#2 - username - 000pts</small><small id="t3">#3 - username - 000pts</small><small>#4 - username - 000pts</small><small>#5 - username - 000pts</small><small>#6 - username - 000pts</small>';
			}
		}else{
			return '<small id="t1">#1 - username - 000pts</small><small id="t2">#2 - username - 000pts</small><small id="t3">#3 - username - 000pts</small><small>#4 - username - 000pts</small><small>#5 - username - 000pts</small><small>#6 - username - 000pts</small>';
		}

		return $top;
	}

	function lastLevel($username){
		$lastlevel=0;
		$db = mysqli_connect('localhost', 'grid', '', 'zeroed');
		$result=mysqli_query($db, "SELECT lastlevel FROM utenti WHERE username='$username'");
		$count=mysqli_num_rows($result);
		if($count>0){
			$row=mysqli_fetch_array($result);
			$lastlevel=$row['lastlevel'];
		}else{
			mysqli_query($db, "INSERT INTO utenti VALUES ('$username',0,0,0)");
		}return $lastlevel;
	}


	function addExp($exp,$username){
		$db = mysqli_connect('localhost', 'grid', '', 'zeroed');
		$result=mysqli_query($db, "SELECT * FROM utenti WHERE username='$username'");

		$row=mysqli_fetch_array($result);
		$userlevel=$row['level'];
		$max_exp=floor(100*pow(1.1,$userlevel));

		$exp+=$row['exp'];

		while($exp>=$max_exp){
			$exp-=$max_exp;
			$userlevel++;
			$max_exp=floor(100*pow(1.1,$userlevel));
		}

		$db = mysqli_connect('localhost', 'grid', '', 'zeroed');
		mysqli_query($db, "UPDATE utenti SET level=$userlevel,exp=$exp WHERE username='$username'");
	}


		function getLeaderboard($lvl){
			$lead='<h2>Top 1000 of Level #'.$lvl.'</h2>';
			$pos=0;
			$db = mysqli_connect('localhost', 'grid', '', 'zeroed');
			$result=mysqli_query($db, "SELECT user,score,data FROM scores WHERE level='$lvl' ORDER BY score DESC LIMIT 1000");
			while($row=mysqli_fetch_array($result)){
				$pos++;
				$lead.='<div class="voce" id="t'.$pos.'">#'.$pos.' - '.$row['user'].' - '.$row['score'].'pts - '.$row['data'].'</div>';
			}
			return $lead;
		}

		function getDailyLeaderboard($day){
			$lead='<h2>Top 100 of this daily challenge</h2>';
			$pos=0;
			$db = mysqli_connect('localhost', 'grid', '', 'zeroed');
			$result=mysqli_query($db, "SELECT user,score FROM daily WHERE day='$day' ORDER BY score DESC LIMIT 100");
			while($row=mysqli_fetch_array($result)){
				$pos++;
				$lead.='<div class="voce" id="t'.$pos.'">#'.$pos.' - '.$row['user'].' - '.$row['score'].'pts</div>';
			}
			return $lead;
		}


		function getMedals($username){
			$medals='Medals: ';

			$gold=0;

			$db = mysqli_connect('localhost', 'grid', '', 'zeroed');
			$result=mysqli_query($db, "SELECT count(*) from (SELECT user,level,max(score) FROM (select user,level,score from scores order by score desc) as t group by level) as c where user='$username'");
			$row=mysqli_fetch_array($result);
			$gold=$row[0];
			$medals.=$gold.'<img src="./medalgold.png">';


			$silver=0;

			$db = mysqli_connect('localhost', 'grid', '', 'zeroed');
			$result=mysqli_query($db, "SELECT count(*) from (SELECT user,level,max(score) FROM (select * from scores where id not in (SELECT id from (SELECT id,user,level,max(score) FROM (SELECT id,user,level,score from scores order by score desc) as t group by level) as c)order by score desc) as t group by level) as c where user='$username'");
			$row=mysqli_fetch_array($result);
			$silver=$row[0];
			$medals.=$silver.'<img src="./medalsilver.png">';



			$bronze=0;

			$db = mysqli_connect('localhost', 'grid', '', 'zeroed');
			$result=mysqli_query($db, "SELECT count(*) from (
			  SELECT user,level,max(score) FROM (
			    select * from scores where id not in (

			      SELECT id FROM (

							SELECT id from (
								SELECT id,user,level,max(score) FROM (
									SELECT id,user,level,score from scores order by score desc
								) as t group by level
							) as c

						union

						SELECT id from (

							SELECT id,user,level,max(score) FROM (
								select * from scores where id not in (
									SELECT id from (
										SELECT id,user,level,max(score) FROM (
											SELECT id,user,level,score from scores order by score desc
										) as t group by level
									) as c
								)order by score desc
							) as t group by level

							) as c

			      )as w

			    )order by score desc
			  ) as d group by level
			) as b where user='$username'");
			$row=mysqli_fetch_array($result);
			$bronze=$row[0];
			$medals.=$bronze.'<img src="./medalbronze.png"> Daily challenges medals: ';



			$gold=0;

			$db = mysqli_connect('localhost', 'grid', '', 'zeroed');
			$result=mysqli_query($db, "SELECT count(*) from (SELECT user,day,max(score) FROM (select user,day,score from daily order by score desc) as t group by day) as c where user='$username'");
			$row=mysqli_fetch_array($result);
			$gold=$row[0];
			$medals.=$gold.'<img src="./medalgold.png">';


			$silver=0;

			$db = mysqli_connect('localhost', 'grid', '', 'zeroed');
			$result=mysqli_query($db, "SELECT count(*) from (SELECT user,day,max(score) FROM (select * from daily where id not in (SELECT id from (SELECT id,user,day,max(score) FROM (SELECT id,user,day,score from daily order by score desc) as t group by day) as c)order by score desc) as t group by day) as c where user='$username'");
			$row=mysqli_fetch_array($result);
			$silver=$row[0];
			$medals.=$silver.'<img src="./medalsilver.png">';



			$bronze=0;

			$db = mysqli_connect('localhost', 'grid', '', 'zeroed');
			$result=mysqli_query($db, "SELECT count(*) from (
				SELECT user,day,max(score) FROM (
					select * from daily where id not in (

						SELECT id FROM (

							SELECT id from (
								SELECT id,user,day,max(score) FROM (
									SELECT id,user,day,score from daily order by score desc
								) as t group by day
							) as c

						union

						SELECT id from (

							SELECT id,user,day,max(score) FROM (
								select * from daily where id not in (
									SELECT id from (
										SELECT id,user,day,max(score) FROM (
											SELECT id,user,day,score from daily order by score desc
										) as t group by day
									) as c
								)order by score desc
							) as t group by day

							) as c

						)as w

					)order by score desc
				) as d group by day
			) as b where user='$username'");
			$row=mysqli_fetch_array($result);
			$bronze=$row[0];
			$medals.=$bronze.'<img src="./medalbronze.png">';



			return $medals;
		}
?>
