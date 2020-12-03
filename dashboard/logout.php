<?php
    session_start();
    include'../connection.php';
    // $insert_time = "UPDATE users SET login_time = false WHERE id ='".$_SESSION['id']."'";
    // mysqli_query($link,$insert_time);
    unset($_SESSION['id']);
    session_destroy(); 
    setcookie("id", "", time() - 60*60);
    $_COOKIE["id"] = "";  
    header("Location:../index.php");

?>