<?php
include('./partials/header.php');
?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1><br><br>


        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="title" placeholder="Category title"></td>
                </tr>
                <tr>
                <tr>
                    <td>Description:</td>
                    <td><textarea name="description"  cols="30" rows="5"></textarea></td>
                </tr>
                <tr>
                <tr>
                    <td>Price:</td>
                    <td><input type="number" name="price"></td>
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
                            //Displa all active category in DB
                            $sql = "SELECT * FROM `tbl-category` WHERE active='Yes'";
                            $res = mysqli_query($conn, $sql);
                            $count = mysqli_num_rows($res);
                            if($count>0){
                                //we have categories
                                while($row = mysqli_fetch_assoc($res)){
                                    $id = $row['id'];
                                    $categorie_title = $row['title'];
                                    ?>
                                    <option value="<?php echo $id; ?>"><?php echo $categorie_title ?></option>
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
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php
if(isset($_POST['submit']))
{
    if(isset($_POST['title']))
    {
        $title = $_POST['title'];
    }
    if(isset($_POST['description']))
    {
        $description = $_POST['description'];
    }
    if(isset($_POST['price']))
    {
        $price = $_POST['price'];
    }
    if(isset($_POST['category']))
    {
        $category_id = $_POST['category'];
    }
    if(isset($_POST['featured'])){
        $featured = $_POST['featured'];
    }else{
        $featured = 'No';
    }
    if(isset($_POST['active'])){
        $active = $_POST['active'];
    }else{
        $active = 'No';
    }
    if(isset($_FILES['image']['name'])){
        $image_name = $_FILES['image']['name'];
        if($image_name!=""){
            $expload = explode(".", $image_name);
            $ext = end($expload);
            $image_name="Food-Image".rand(000,999).".".$ext;

            $source_path = $_FILES['image']['tmp_name'];
            $destination_path = "../images/food/" . $image_name;

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

    $sql2 = "INSERT INTO `tbl-food` SET
             title='$title',
             `description`='$description',
             price='$price',
             `img-name`='$image_name',
             `category-id`='$category_id',
             featured='$featured',
             active='$active'
             ";
    $res2 = mysqli_query($conn, $sql2);
    if($res2){
        $_SESSION['add'] = "<div class='succes'>Food Added Successfully</div>";
        header("Location:" . SITEURL . "admin/manage-food.php");
    }else{
        $_SESSION['add'] = "<div class='error'>No food Added</div>";
        header("Location:" . SITEURL . "admin/manage-food.php");
    }

}
?>
<?php
include('./partials/footer.php');
?>