<?php
    include 'dbconnect.php';
    // $username=$_POST['u'];
    $username=$_GET['u'];

    /* Create a prepared statement */
    if($stmt = $mysqli -> prepare("SELECT sw_id,sh_id FROM pgs WHERE name=?")) {
        /* Bind parameters
        s - string, b - blob, i - int, etc */
        $stmt -> bind_param("s", $username);
        /* Execute it */
        $stmt -> execute();
        /* Bind results */
        $stmt -> bind_result($user_sw_id,$user_sh_id);
        /* Fetch the value */
        $stmt -> fetch();
        /* Close statement */
        $stmt -> close();
    }
   
    $sword_id=$user_sw_id;
    $shield_id=$user_sh_id;

    $sword_q=quality($sword_id);
    $shield_q=quality($shield_id);

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
    $sword_q_string=qToString($sword_q);
    $shield_q_string=qToString($shield_q);

    mt_srand($sword_id);
    $sword_stat_R=mt_rand(30,220);
    $sword_stat_G=mt_rand(30,220);
    $sword_stat_B=mt_rand(30,220);
    $sword_stat_Rr=220-$sword_stat_R;
    $sword_stat_Gr=220-$sword_stat_G;
    $sword_stat_Br=220-$sword_stat_B;

    $sword_randomer=mt_rand($sword_q*80,100*($sword_q+1));

    mt_srand($shield_id);
    $shield_stat_R=mt_rand(30,220);
    $shield_stat_G=mt_rand(30,220);
    $shield_stat_B=mt_rand(30,220);
    $shield_stat_Rr=220-$shield_stat_R;
    $shield_stat_Gr=220-$shield_stat_G;
    $shield_stat_Br=220-$shield_stat_B;

    $shield_randomer=mt_rand($shield_q*80,100*($shield_q+1));

    //apply randomizer
    $sword_stat_R+=$sword_randomer;
    $sword_stat_G+=$sword_randomer;
    $sword_stat_B+=$sword_randomer;
    $sword_stat_Rr+=$sword_randomer;
    $sword_stat_Gr+=$sword_randomer;
    $sword_stat_Br+=$sword_randomer;
    $shield_stat_R+=$shield_randomer;
    $shield_stat_G+=$shield_randomer;
    $shield_stat_B+=$shield_randomer;
    $shield_stat_Rr+=$shield_randomer;
    $shield_stat_Gr+=$shield_randomer;
    $shield_stat_Br+=$shield_randomer;

    $q_bonus_ratio=0.5; //ora il max è 9020 //$q_bonus_ratio=1.3;
    $sword_stat_R=intval($sword_stat_R*(1+$sword_q/$q_bonus_ratio));
    $sword_stat_G=intval($sword_stat_G*(1+$sword_q/$q_bonus_ratio));
    $sword_stat_B=intval($sword_stat_B*(1+$sword_q/$q_bonus_ratio));
    $sword_stat_Rr=intval($sword_stat_Rr*(1+$sword_q/$q_bonus_ratio));
    $sword_stat_Gr=intval($sword_stat_Gr*(1+$sword_q/$q_bonus_ratio));
    $sword_stat_Br=intval($sword_stat_Br*(1+$sword_q/$q_bonus_ratio));
    $shield_stat_R=intval($shield_stat_R*(1+$shield_q/$q_bonus_ratio));
    $shield_stat_G=intval($shield_stat_G*(1+$shield_q/$q_bonus_ratio));
    $shield_stat_B=intval($shield_stat_B*(1+$shield_q/$q_bonus_ratio));
    $shield_stat_Rr=intval($shield_stat_Rr*(1+$shield_q/$q_bonus_ratio));
    $shield_stat_Gr=intval($shield_stat_Gr*(1+$shield_q/$q_bonus_ratio));
    $shield_stat_Br=intval($shield_stat_Br*(1+$shield_q/$q_bonus_ratio));














    $json = array($sword_id,$sword_stat_R,$sword_stat_G,$sword_stat_B,$sword_stat_Rr,$sword_stat_Gr,$sword_stat_Br,$shield_id,$shield_stat_R,$shield_stat_G,$shield_stat_B,$shield_stat_Rr,$shield_stat_Gr,$shield_stat_Br,$sword_randomer,$shield_randomer);
    //ritorno solo id e tipo perche' tanto posso ricalcolare tutto in js
    echo json_encode($json);
?>
