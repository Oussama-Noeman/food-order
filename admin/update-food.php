<?php
include('./partials/header.php')
?>
<div class="main-content">
    <div class="wrapper">
        <h1>Edit Food</h1><br><br>
        <?php
        if(isset($_GET['id'])&&isset($_GET['image_name'])){
            $id = $_GET['id'];
            $current_image = $_GET['image_name'];
            $sql = "SELECT * FROM `tbl-food` WHERE id = $id";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            if($count==1){
                $row = mysqli_fetch_assoc($res);
                $title = $row['title'];
                $description = $row['description'];
                $price = $row['price'];
                $featured = $row['featured'];
                $active = $row['active'];
                $category_id=$row['category-id'];
            }else{
                $_SESSION['user-not-found'] = "<div class='error'>User Not found</div>";
                header("Location:" . SITEURL . "admin/manage-food.php");
            }
        }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="title" value="<?php echo $title?>"></td>
                </tr>
                <tr>
                <tr>
                    <td>Description:</td>
                    <td><textarea name="description"  cols="30" rows="5"><?php echo $description ?></textarea></td>
                </tr>
                <tr>
                <tr>
                    <td>Price:</td>
                    <td><input type="number" name="price" value="<?php echo  $price ?>"></td>
                </tr>
                <tr>
                    <td>Current Image :</td>
                <td>
                        <?php
                            if($current_image!=""){
                            //Disaplay the Image    
                        ?>
                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image ?>" width="100px">
                    

                        <?php
                            }else{
                                echo "<div class='error'>Image not added</div>";
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Select Image :</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category" >
                            <?php
                            //Display all active category in DB
                            $sql2 = "SELECT * FROM `tbl-category` WHERE active='Yes'";
                            $res2 = mysqli_query($conn, $sql2);
                            $count2 = mysqli_num_rows($res2);
                            if($count2>0){
                                //we have categories
                                while($row2 = mysqli_fetch_assoc($res2)){
                                    $id_cat = $row2['id'];
                                    $categorie_title = $row2['title'];
                                    ?>
                                    <option <?php if ($id_cat== $category_id) {
                                        echo "Selected";} ?>  value="<?php echo $id_cat; ?>"><?php echo $categorie_title ?></option>
                                    <?php
                                    
                            }
                            }else{
                                //we dont have categories
                                ?>
                                <option value="0">No category found in DB</option>
                                <?php
                            }
                            ?>
                            
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input <?php if ($featured == "Yes") {
                            echo "checked";} ?> type="radio" name="featured" value="Yes" >Yes
                        <input <?php if ($featured == "No") {
                            echo "checked";} ?> type="radio" name="featured" value="No">No
                     </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input <?php if ($active == "Yes") {
                            echo "checked";} ?> type="radio" name="active" value="Yes">Yes
                        <input <?php if ($active == "No") {
                            echo "checked";} ?> type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Food" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php
if(isset($_POST['submit'])){
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    if(isset($_POST['category'])){
        $category_id = $_POST['category'];
    }
    $featured = $_POST['featured'];
    $active = $_POST['active'];
    if (isset($_FILES['image']['name'])) {
        $image_name = $_FILES['image']['name'];
        if ($image_name != "") {
            $expload = explode(".", $image_name);
            $ext = end($expload);

            $image_name = "Food-Name" . rand(000, 999) . "." . $ext;
            $src = $_FILES['image']['tmp_name'];
            $path = "../images/food/" . $image_name;

            $upload = move_uploaded_file($src, $path);
            if (!$upload) {
                $_SESSION['upload'] = "<div class='error'>Image not uploaded";
                header("Location:" . SITEURL . "admin/manage-food.php");
                die();
            }
            $remove_path = "../images/food/" . $current_image;
            $remove = unlink($remove_path);
        } else {
            $image_name = $current_image;
        }
    }else{
        $image_name = "";
    }
    $sql3 = "UPDATE `tbl-food` SET
            title='$title',
            `description`='$description',
            price='$price',
            `img-name`='$image_name',
            `category-id`=$category_id,
            featured='$featured',
            active='$active' 
            WHERE id=$id
            ";
    $result = mysqli_query($conn, $sql3);
    if($result){
        $_SESSION['update'] = "<div class='succes'>Food is updated</div>";
        header("Location:".SITEURL."admin/manage-food.php");
    }else{
        $_SESSION['update'] = "<div class='error'>Failed to update Food</div>";
        header("Location:".SITEURL."admin/manage-food.php");
    }
}
?>

<?php
include('./partials/footer.php')
?>