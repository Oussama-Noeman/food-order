<?php
include('partials/header.php');
if(isset($_GET['id'])&&isset($_GET['image_name'])){
    $id = $_GET['id'];
    $current_image = $_GET['image_name'];

    $sql = "SELECT * FROM `tbl-category` WHERE id=$id";
    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);
    if($count==1){
        $row = mysqli_fetch_assoc($res);
        $title = $row['title'];
        if($row['featured']==="Yes"){
            $featured = "Yes";
        }else{
            $featured = "No";
        }
        if($row['active']==="Yes"){
            $active = "Yes";
        }else{
            $active = "No";
        }

        
    }else{
        $_SESSION['no-category-found'] = "<div class='error'>Category not found</div>";
        header("Location:".SITEURL."admin/manage-category.php");
    }
}
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>
        <br>
        <br>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>New Title:</td>
                    <td><input type="text" name="title" value="<?php echo $title; ?>"></td>
                </tr>
                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php
                            if($current_image!=""){
                            //Disaplay the Image    
                        ?>
                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image ?>" width="150px">
                    

                        <?php
                            }else{
                                echo "<div class='error'>Image not added</div>";
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>New Image :</td>
                    <td>
                        <input type="file" name= "image">
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes" <?php if ($featured == "Yes") {echo "checked";} ?>>Yes
                        <input type="radio" name="featured" value="No" <?php if ($featured == "No") {echo "checked";} ?>>No
                     </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input <?php if ($active === "Yes") {echo "checked";} ?> type="radio" name="active" value="Yes" >Yes
                        <input <?php if ($active === "No") {echo "checked";} ?> type="radio" name="active" value="No" >No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
    </div>
</div>
<?php
if(isset($_POST['submit'])){
    $id = $_POST['id'];
    $title = $_POST['title'];
    $current_image = $_POST['current_image'];
    $featured = $_POST['featured'];
    $active = $_POST['active'];

    if(isset($_FILES['image']['name'])){
        $image_name = $_FILES['image']['name'];
        if($image_name!=""){    
            //auto rename our image
            //get the Extension of our image(jpg, png, gif, etc)e.g "specialfood1.jpg"
            $expload = explode(".", $image_name);
            $ext = end($expload);
            //rename the image
            $image_name = "Food_Category_" . rand(000, 999) . '.' . $ext;//e.g Food_Category_834.jpg

            $source_path = $_FILES['image']['tmp_name'];
            $destination_path = "../images/category/".$image_name;

            $upload = move_uploaded_file($source_path, $destination_path);

                if(!$upload){
                    $_SESSION['upload'] = "<div class='error'>Failed to ypload Image.</div>";

                    header("Location:" . SITEURL . "admin/add-category.php");
                    die();
                }
            $remove_path = "../images/category/".$current_image;
            $remove = unlink($remove_path);

            if(!$remove){
                $_SESSION['failed-remove'] = "<div class='error'>Failed to romove image</div>";
            }

        }else{
            $image_name = $current_image;
        }
    }else{
        $image_name = "";   
    }
    $sql2 = "UPDATE `tbl-category` SET 
                title='$title',
                `img-name`='$image_name',
                featured='$featured',
                active='$active'
                WHERE id=$id ";

    $res2 = mysqli_query($conn, $sql2);
    if($res2){
        $_SESSION['update'] = "<div class='succes'>Category Updated</div>";
        header("Location:" . SITEURL . "admin/manage-category.php");
    }else{
        $_SESSION['update'] = "<div class='error'>Failed to update Category</div>";
        header("Location:" . SITEURL . "admin/manage-category.php");
    }
}

?>
<?php
include('partials/footer.php')
?>