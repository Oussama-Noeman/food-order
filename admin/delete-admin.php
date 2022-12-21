<?php
    include('../config/config-db.php');
    //1-get the id of admin to be deleted
    $id = $_GET['id'];
    //2- create SQL query to delete admin
    $sql = "DELETE FROM `tbl-admin` WHERE id=$id";
    //3-Redirect to manage adin page with message (success/error)
    $res = mysqli_query($conn, $sql);
    if($res){

    $_SESSION['delete'] = "<div class='succes'>Admin Deleted Successfully</div>";
    header("Location:" . SITEURL . "admin/manage-admin.php");

    }else{

    $_SESSION['delete'] = "<div class='error'>Failed to delete Admin</div>";
    header("Location:" . SITEURL . "admin/manage-admin.php");

    }
?>