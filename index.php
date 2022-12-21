<?php include('./partials-front/header.php'); ?>
<!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>
            <?php
                if(isset($_POST['submit'])){
                $search = mysqli_escape_string($conn,$_POST['search']);
                header("Location:" . SITEURL . "food-search.php?search=$search");
                }
            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->
        <?php
        if(isset($_SESSION['order'])){
            echo $_SESSION['order'];
            unset($_SESSION['order']);
        }
        ?>
    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>
            <?php
            $sql = "SELECT * FROM `tbl-category` WHERE active='Yes' AND featured='Yes' LIMIT 3";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            if($res){
                if($count>0){
                    while($row=mysqli_fetch_assoc($res)){
                        $id = $row['id'];
                        $image = $row['img-name'];
                        $title = $row['title'];
                        ?>
                        <a href="category-foods.php?category-id=<?php echo $id; ?>">
            <div class="box-3 float-container">
                <?php
                if($image==""){
                            echo "<div class='error'>Image not available</div>";
                }else{
                    ?>
                    <img src="images/category/<?php echo $image; ?>"  class="img-responsive img-curve">
                    <?php
                }
                ?>
                
                <br><br><br>
                <h3 class="float-text text-white"><?php echo $title; ?></h3>
            </div>
                    </a>
                    <?php
                    }
                }else{
                    $_SESSION['no-data-found'] = "<div class='error'>No data found</div>";
                    header("Location:" . SITEURL . "index.php");
                }
            }else{
                $_SESSION['DB-error'] = "<div>DB error.</div>";
                header("Location:" . SITEURL . "index.php");
            }
            ?>
            

           

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
            $sql2 = "SELECT * FROM `tbl-food` WHERE active='Yes'";
            $res2 = mysqli_query($conn, $sql2);
            $count2 = mysqli_num_rows($res2);
            if($count2>0){
                while($row2=mysqli_fetch_assoc($res2)){
                    $id = $row2['id'];
                    $title = $row2['title'];
                    $price = $row2['price'];
                    $description = $row2['description'];
                    $image = $row2['img-name'];
                    ?>
                    <div class="food-menu-box">
                     <div class="food-menu-img">
                        <?php
                            if($image!=""){
                            ?>
                        <img src="images/food/<?php echo $image; ?>"  class="img-responsive img-curve">
                        <?php
                         }else{  
                        echo "<div class='error'>No image Yet.";
                         }
                        ?>
                       
                    </div>
                    <div class="food-menu-desc">
                        <h4><?php echo $title ?></h4>
                        <p class="food-price">$<?php echo $price; ?></p>
                        <p class="food-detail">
                            <?php echo $description ?>
                        </p>
                        <br>

                        <a href="order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                </div>
            </div>
                    <?php
                }
            }else{
                echo "";
            }
            ?>

            
            <div class="clearfix"></div>
        </div>

        <p class="text-center">
            <a href="#">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

<?php 
include('./partials-front/footer.php')
?>