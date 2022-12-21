<?php include('partials/header.php') ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Food</h1>
        <table class="tbl-full"><br><br>
        <a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Add Food</a><br><br>

        <?php
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
            if(isset($_SESSION['delete'])){
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }
            if(isset($_SESSION['update'])){
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
            if(isset($_SESSION['remove'])){
                echo $_SESSION['remove'];
                unset($_SESSION['remove']);
            }
        ?>
            <tr>
                <th>S.N</th>
                <th>title</th>
                <th>description</th>
                <th>price</th>
                <th>img-name</th>
                <th>featured</th>
                <th>active</th>
                <th>Actions</th>
            </tr>
            <tr>
                <?php
                $sn = 0;
                $sql = "SELECT * FROM `tbl-food`";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);
                if($count>0){
                    while($row=mysqli_fetch_assoc($res)){
                        $id = $row['id'];
                        $title = $row['title'];
                        $description = $row['description'];
                        $price = $row['price'];
                        $image_name = $row['img-name'];
                        $featured = $row['featured'];
                        $active = $row['active'];

                        $sn++;
                        ?>
                        <tr>
                        <td><?php echo $sn  ?></td>
                        <td><?php echo $title  ?></td>
                        <td><?php echo  $description ?></td>
                        <td><?php echo $price ?></td>
                        <td> <?php 
                                if($image_name!=""){
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" width="100px" >
                                    <?php
                                }else{
                            echo "<div class='error'>Image not added.</div>";
                                }
                                ?></td>
                        <td><?php echo $featured ?></td>
                        <td><?php echo $active ?></td>
                        <td>
                        <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id;?>&image_name=<?php echo $image_name; ?>" class="btn-secondary"> Update food</a>
                        <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger"> Delete food</a>
                        </td>
                        </tr>
                        <?php 
                    }
                }
                ?>
                
            </tr>
        </table>
    </div>
</div>
<?php include('partials/footer.php') ?>