<?php
include('./partials-front/header.php');
?>


    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>
            <?php
            $sql = "SELECT * FROM `tbl-category` WHERE active='Yes'";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            if($count>0){
                while($row = mysqli_fetch_assoc($res)){
                    $id = $row['id'];
                    $title = $row['title'];
                    $image = $row['img-name'];
                    ?>
                    <a href="category-foods.php?category-id=<?php echo $id; ?>">
                    <div class="box-3 float-container">
                        <?php
                        if($image==""){
                        echo "<div class='error'>No image Yet </div>";
                        }else{
                            ?>
                            <img src="images/category/<?php echo $image; ?>"  class="img-responsive img-curve">
                            <?php
                        }
                        ?>
                        

                        <h3 class="float-text text-white"><?php echo $title; ?></h3>
                    </div>
                    </a>
                <?php
                }
                

                
            }
            ?>
            

            

            

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->



    <?php include('./partials-front/footer.php');?>