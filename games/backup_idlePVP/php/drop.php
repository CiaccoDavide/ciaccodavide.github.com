<?php
    include 'dbconnect.php';
    // $username=$_POST['u'];
    $username=$_GET['u'];

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
   
    mt_srand();
    $id=mt_rand(0,1000000000);
    $type=mt_rand(0,1);
    $q=quality($id);
    $better=0;

    function quality($id){
        $id=$id%100000;
        if($id<71899){return 0;}
        else if($id<91899){return 1;}
        else if($id<97899){return 2;}
        else if($id<99899){return 3;}
        else if($id<99993){return 4;}
        else {return 5;}
    }
    function qToString($q){
      switch($q){
        case 0: return "Common";break;
        case 1: return "Magic";break;
        case 2: return "Rare";break;
        case 3: return "Epic";break;
        case 4: return "Legendary";break;
        case 5: return "Unique";break;
        default: return "Common";break;
      }return "Common";
    }
    $q_string=qToString($q);

    mt_srand($id);
    $stat_R=mt_rand(30,220);
    $stat_G=mt_rand(30,220);
    $stat_B=mt_rand(30,220);
    $stat_Rr=220-$stat_R;
    $stat_Gr=220-$stat_G;
    $stat_Br=220-$stat_B;

    $randomer=mt_rand($q*80,100*($q+1));

    //apply randomizer
    $stat_R+=$randomer;
    $stat_G+=$randomer;
    $stat_B+=$randomer;
    $stat_Rr+=$randomer;
    $stat_Gr+=$randomer;
    $stat_Br+=$randomer;

    $q_bonus_ratio=0.5; //ora il max è 9020 //$q_bonus_ratio=1.3;
    $stat_R=intval($stat_R*(1+$q/$q_bonus_ratio));
    $stat_G=intval($stat_G*(1+$q/$q_bonus_ratio));
    $stat_B=intval($stat_B*(1+$q/$q_bonus_ratio));
    $stat_Rr=intval($stat_Rr*(1+$q/$q_bonus_ratio));
    $stat_Gr=intval($stat_Gr*(1+$q/$q_bonus_ratio));
    $stat_Br=intval($stat_Br*(1+$q/$q_bonus_ratio));

    //da passare se voglio migliorare il caso in cui le 2 stat sono uguali
    $pts=$stat_R+$stat_G+$stat_B+$stat_Rr+$stat_Gr+$stat_Br;
    
    if($type==0){//sword
        $user_q=quality($user_sw_id);
        $user_q_string=qToString($user_q);
        mt_srand($user_sw_id);
    }else{//shield
        $user_q=quality($user_sh_id);
        $user_q_string=qToString($user_q);
        mt_srand($user_sh_id);
    }
    $user_stat_R=mt_rand(30,220);
    $user_stat_G=mt_rand(30,220);
    $user_stat_B=mt_rand(30,220);
    $user_randomer=mt_rand($user_q*80,100*($user_q+1));

    $user_stat_Rr=220-$user_stat_R+$user_randomer;
    $user_stat_Gr=220-$user_stat_G+$user_randomer;
    $user_stat_Br=220-$user_stat_B+$user_randomer;

    $user_stat_R+=$user_randomer;
    $user_stat_G+=$user_randomer;
    $user_stat_B+=$user_randomer;

    $user_stat_R=intval($user_stat_R*(1+$user_q/$q_bonus_ratio));
    $user_stat_G=intval($user_stat_G*(1+$user_q/$q_bonus_ratio));
    $user_stat_B=intval($user_stat_B*(1+$user_q/$q_bonus_ratio));
    $user_stat_Rr=intval($user_stat_Rr*(1+$user_q/$q_bonus_ratio));
    $user_stat_Gr=intval($user_stat_Gr*(1+$user_q/$q_bonus_ratio));
    $user_stat_Br=intval($user_stat_Br*(1+$user_q/$q_bonus_ratio));

    $user_pts=$user_stat_R+$user_stat_G+$user_stat_B+$user_stat_Rr+$user_stat_Gr+$user_stat_Br;



    if($user_dynasty==0&&($stat_R>$user_stat_R||($user_stat_R==$stat_R&&$pts>$user_pts)))    
        $better=equipNew($id,$type,$mysqli,$user_id);
    else if($user_dynasty==1&&($stat_G>$user_stat_G||($user_stat_G==$stat_G&&$pts>$user_pts)))    
        $better=equipNew($id,$type,$mysqli,$user_id);
    else if($user_dynasty==2&&($stat_B>$user_stat_B||($user_stat_B==$stat_B&&$pts>$user_pts)))    
        $better=equipNew($id,$type,$mysqli,$user_id);
    else if($user_dynasty==3&&($stat_Rr>$user_stat_Rr||($user_stat_Rr==$stat_Rr&&$pts>$user_pts)))    
        $better=equipNew($id,$type,$mysqli,$user_id);
    else if($user_dynasty==4&&($stat_Gr>$user_stat_Gr||($user_stat_Gr==$stat_Gr&&$pts>$user_pts)))    
        $better=equipNew($id,$type,$mysqli,$user_id);
    else if($user_dynasty==5&&($stat_Br>$user_stat_Br||($user_stat_Br==$stat_Br&&$pts>$user_pts)))    
        $better=equipNew($id,$type,$mysqli,$user_id);

    function equipNew($id,$type,$mysqli,$user_id){
        if($type==0){
            if($stmt = $mysqli -> prepare("UPDATE pgs SET sw_id=? WHERE id=?")) {
                /* Bind parameters
                s - string, b - blob, i - int, etc */
                $stmt -> bind_param("ii",$id,$user_id);
                /* Execute it */
                $stmt -> execute();
                /* Close statement */
                $stmt -> close();
            }
        }else{
            if($stmt = $mysqli -> prepare("UPDATE pgs SET sh_id=? WHERE id=?")) {
                /* Bind parameters
                s - string, b - blob, i - int, etc */
                $stmt -> bind_param("ii",$id,$user_id);
                /* Execute it */
                $stmt -> execute();
                /* Close statement */
                $stmt -> close();
            }
        }
        return 1;
    }

    if($stmt = $mysqli -> prepare("INSERT INTO gears (id,type,user_id) VALUES (?,?,?)")) {
        /* Bind parameters
        s - string, b - blob, i - int, etc */
        $stmt -> bind_param("iii", $id,$type,$user_id);
        /* Execute it */
        $stmt -> execute();
        /* Close statement */
        $stmt -> close();
    }   









    /* Close connection */
    $mysqli -> close();

    $json = array($id,$type,$better,$stat_R,$stat_G,$stat_B,$stat_Rr,$stat_Gr,$stat_Br);
    //ritorno solo id e tipo perche' tanto posso ricalcolare tutto in js
    echo json_encode($json);
?>
