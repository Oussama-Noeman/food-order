<?php
include('../config/config-db.php');
if(isset($_GET['id']) && isset($_GET['image_name'])){
    $id = $_GET['id'];
    $img_name = $_GET['image_name'];
    if($img_name!==""){
        $path = "../images/category/" . $img_name;
        $remove = unlink($path);
        if(!$remove){
            $_SESSION['remove'] = "<div class='error'>Failed to remove category image</div>";
            header("Location:" . SITEURL . "admin/manage-category.php");
            die();
        }
    }
    $sql = "DELETE  FROM `tbl-category` WHERE id=$id ";

    $res = mysqli_query($conn, $sql);

    if($res){
        $_SESSION['delete'] = "<div class='succes'>Category deleted successfully</div>";
        header("Location:" . SITEURL . "admin/manage-category.php");
    }else{
        $_SESSION['delete'] = "<div class='error'>Failed to delete category</div>";
        header("Location:" . SITEURL . "admin/manage-category.php");
    }
}else{
    header("Location:" . SITEURL . "admin/manage-category.php");
}
?>