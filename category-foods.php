<?php
include('./partials-front/header.php');
if(isset($_GET['category-id'])){
    $category_id = $_GET['category-id'];
    $sql2 = "SELECT title FROM `tbl-category` WHERE id=$category_id";
    $res2 = mysqli_query($conn, $sql2);
    if($res2){
        $row = mysqli_fetch_assoc($res2);
        $title=$row['title'];
    }
}else{
    header("Location:" . SITEURL . "index.php");
}
?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white"><?php echo $title;  ?></a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <?php
            $sql = "SELECT * FROM `tbl-food` WHERE `category-id`='$category_id' ";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            if($count>0){
                while($row= mysqli_fetch_assoc($res)){
                    $id = $row['id'];
                    $title = $row['title'];
                    $description = $row['description'];
                    $price = $row['price'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                    $image_name = $row['img-name'];?>
                    <div class="food-menu-box">
                    <div class="food-menu-img">
                        <?php
                        if($image_name!=""){
                            ?>
                            <img src="images/food/<?php echo $image_name; ?>"$image_name class="img-responsive img-curve"> 
                            <?php
                        }
                        ?>
             
                    </div>
                    <div class="food-menu-desc">
                        <h4><?php echo $title; ?></h4>
                        <p class="food-price">$<?php echo $price; ?></p>
                        <p class="food-detail">
                            <?php echo $description; ?>
                        </p>
                        <br>

                        <a href="order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                    </div>
                </div>

                <?php
                    }
                }else{
                echo "<div class='error'>No Data Found</div>";
                }
            ?>
            <div class="clearfix"></div>        

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->


    <?php include('./partials-front/footer.php');?>