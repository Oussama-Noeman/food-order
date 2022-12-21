<?php
include('./partials-front/header.php');
if(isset($_GET['food_id'])){
    $food_id = $_GET['food_id'];

    $sql = "SELECT * FROM `tbl-food` WHERE id=$food_id";
    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);
    if($count>0){
        $row = mysqli_fetch_assoc($res);
        $title = $row['title'];
        $price = $row['price'];
        $image_name = $row['img-name'];
    }else{
        header("Location:" . SITEURL . "index.php");
    }
}else{
    header("Location:" . SITEURL . "index.php");
}
?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" class="order" method="POST">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <?php 
                        if($image_name!=""){
                            ?>
                        <img src="images/food/<?php echo $image_name; ?>"  class="img-responsive img-curve">
                            <?php
                        }
                        ?>
                        
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <h3><input type="hidden" name="title" value="<?php echo $title; ?>"></h3>
                        <p class="food-price">$<?php echo $price; ?></p>
                        <h3><input type="hidden" name="price" value="<?php echo $price; ?>"></h3>

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Vijay Thapa" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. hi@vijaythapa.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>


                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->
<?php
if(isset($_POST['submit'])){
    $food = $_POST['title'];
    $price = $_POST['price'];
    $qty = $_POST['qty'];
    $total = $price * $qty;
    $order_date = date("Y-m-d h:i:sa");
    $status = "Ordered";

    $full_name = $_POST['full-name'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $address = $_POST['address'];

    $sql2 = "INSERT INTO `tbl-order` SET
            food='$food',
            price='$price',
            qty='$qty',
            total='$total',
            `order-date`='$order_date',
            status='$status',
            `customer-name`='$full_name',
            `customer-contact`='$contact',
            `customer-email`='$email',
            `customer-address`='$address'
            ";
    $res2 = mysqli_query($conn, $sql2);
    if($res2){
        $_SESSION['order'] = "<div class='succes'>Ordered Successfully</div>";
        header("Location:" . SITEURL);
    }else{
        $_SESSION['order'] = "<div class='error'>Failed to Order</div>";
        header("Location:" . SITEURL);
    }

}
?>

    <?php include('./partials-front/footer.php');?>