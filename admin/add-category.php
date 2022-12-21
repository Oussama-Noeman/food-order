<?php
include('partials/header.php');
?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1><br><br>

        <?php
        if(isset($_SESSION['add'])){
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if(isset($_SESSION['upload'])){
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="title" placeholder="Category title"></td>
                </tr>
                <tr>
                    <td>Select Image :</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes" >Yes
                        <input type="radio" name="featured" value="No">No
                     </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php
if(isset($_POST['submit'])){
    if(!isset($_POST['title']) || empty($_POST['title'])){
        header("Location:" . SITEURL . "admin/add-category.php");
        exit();
    }else{
        $title = $_POST['title'];
    }

    if(isset($_POST['featured'])){
        $featured=$_POST['featured'];
    }else{
        $featured = "No";
    }

    if(isset($_POST['active'])){
        $active=$_POST['active'];
    }else{
        $active = "No";
    }

    if(isset($_FILES['image']['name'])){
        //upload the image
        //to upload image we need image name, source path and destination path
        $image_name = $_FILES['image']['name'];

        //upload iage if only image is selected
        if($image_name !=""){

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
        }


    }else{
        $image_name = "";
    }
        

    $sql = "INSERT INTO `tbl-category` SET
            title='$title',
            `img-name`='$image_name',
            featured='$featured',
            active='$active'
            ";

    $res = mysqli_query($conn, $sql);
    if($res){
        $_SESSION['add'] = "<div class='succes'>Added Successfully.</div>";
        header("Location:" . SITEURL . "admin/manage-category.php");
    }else{  
        $_SESSION['add'] = "<div class='error'>Failed to add.</div>";
        header("Location:" . SITEURL . "admin/add-category.php");
    }
}
?>

<?php include('partials/footer.php') ?>