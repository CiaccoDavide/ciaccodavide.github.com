<?php

session_start();

if(isset($_SESSION["username"])){
    header("location:../index.php");
    exit();
}

  include './dbconnect.php';
    $username=$_POST['u'];

    
    $id=0;
    /* Create a prepared statement */
    if($stmt = $mysqli -> prepare("SELECT id FROM pgs WHERE name=?")) {
        /* Bind parameters
        s - string, b - blob, i - int, etc */
        $stmt -> bind_param("s", $username);
        /* Execute it */
        $stmt -> execute();
        /* Bind results */
        $stmt -> bind_result($id);
        /* Fetch the value */
        $stmt -> fetch();
        /* Close statement */
        $stmt -> close();
    }
    if($id==0||$id==null){
    mt_srand();
    $dynasty=mt_rand(0,5);
    $sw_id=mt_rand(0,70000);
    $sh_id=mt_rand(0,70000);
        /* Create a prepared statement */
        if($stmt = $mysqli -> prepare("INSERT INTO pgs VALUES (null,'$username',$dynasty,$sw_id,$sh_id,NOW())")) {
            /* Bind parameters
            s - string, b - blob, i - int, etc */
            $stmt -> bind_param("s", $username);
            /* Execute it */
            $stmt -> execute();
            /* Close statement */
            $stmt -> close();
        }
    }
    $_SESSION['username']=$username;
    header("location:../index.php");
    exit();
?>