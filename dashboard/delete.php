<?php 
session_start();

include'../connection.php';

$errors = null;

    $tn = $_SESSION['table_name'];

    $fetch = "SELECT * FROM $tn WHERE expense_id = '".$_POST['delete_id']."'";
    $result = mysqli_query($link,$fetch);

    if(mysqli_num_rows($result) > 0){
   
        $delete = "DELETE FROM $tn WHERE expense_id = '".$_POST['delete_id']."'";
        mysqli_query($link,$delete);
        $errors ="<div class='alert alert-success'>Successfully Deleted!</div><br>";

    } else {
        $errors = "<div class='alert alert-danger'>Invalid Delete ID.</div><br>";
    }   

//} else { $errors .= "<div class='alert alert-danger'>There are some errors - Please try again later.</div><br>".mysqli_error($link);}

$_SESSION['errors_delete'] = $errors;
 
?>