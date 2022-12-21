<?php include('partials/header.php') ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Category</h1><br><br><br>

        <a href="<?php echo SITEURL."admin/add-category.php" ?>" class="btn-primary" >Add Category</a>
        <br><br>
        <?php
        if(isset($_SESSION['add'])){
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if(isset($_SESSION['delete'])){
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        if(isset($_SESSION['remove'])){
            echo $_SESSION['remove'];
            unset($_SESSION['remove']);
        }
        if(isset($_SESSION['update'])){
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        if(isset($_SESSION['upload'])){
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        if(isset($_SESSION['failed-remove'])){
            echo $_SESSION['failed-remove'];
            unset($_SESSION['failed-remove']);
        }
        if(isset($_SESSION['no-category-found'])){
            echo $_SESSION['no-category-found'];
            unset($_SESSION['no-category-found']);
        }
        ?>
        <br><br>
        <table class="tbl-full"><br>
            <tr>
                <th>S.N</th>
                <th>Title</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>
            <?php
            $sn = 0;
            $sql = "SELECT * FROM `tbl-category`";
            $res = mysqli_query($conn, $sql);
            if($res){
                $rows = mysqli_num_rows($res);
                if ($rows > 0) {
                    while ($rows = mysqli_fetch_assoc($res)) {
                        $id = $rows['id'];
                        $title = $rows['title'];
                        $img_name = $rows['img-name'];
                        $featured = $rows['featured'];
                        $active = $rows['active'];
                        $sn++;  
                        ?>
                        <tr>
                            <td><?php echo $sn ?></td>
                            <td><?php echo $title?></td>
                            <td>
                                <?php 
                                if($img_name!=""){
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $img_name; ?>" width="100px" >
                                    <?php
                                }else{
                            echo "<div class='error'>Image not added.</div>";
                                }
                                ?>
                            </td>
                            <td><?php echo $featured ?></td>
                            <td><?php echo $active ?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>&image_name=<?php echo $img_name; ?>" class="btn-secondary">Update Category</a>
                                <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $img_name; ?>" class="btn-danger">Delete Category</a>
                            </td>
                        </tr>
                        <?php
                    }
                }
            }else{
                ?>
                <tr>
                    <td colspan="6"><div class="error">No Category Added.</div></td>
                </tr>

                <?php
            }
            ?>
        </table>
    </div>
</div>
<?php include('partials/footer.php') ?>