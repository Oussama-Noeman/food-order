<?php
include('../config/config-db.php');
if (isset($_GET['id'])&&isset($_GET['image_name'])) {
    $id = $_GET['id'];
    $current_image = $_GET['image_name'];
}
    if($current_image!=""){
    $path = "../images/food/" . $current_image;
    $remove = unlink($path);
    if(!$remove){
        $_SESSION['remove'] = "<div class='error'>Failed to remove current image</div>";
        header("Location:" . SITEURL . "admin/manage-food");
    }
    }
$sql = "DELETE FROM `tbl-food` WHERE id = $id";
$res = mysqli_query($conn, $sql);
if($res){
    $_SESSION['delete'] = "<div class='succes'>Food Deleted successfully</div>";
    header("Location:" . SITEURL . "admin/manage-food.php");
}else{
    $_SESSION['delete'] = "<div class='error'>Failed to delete food</div>";
    header("Location:" . SITEURL . "admin/manage-food.php");
}
?>