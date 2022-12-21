<?php
include('./partials/header.php');
if(isset($_GET['id'])){
    $id = $_GET['id'];

    $sql = "SELECT * FROM `tbl-order` WHERE id=$id";
    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);
    if($count==1){
        $row = mysqli_fetch_assoc($res);
        $food = $row['food'];
        $price = $row['price'];
        $qty = $row['qty'];
        $total = $row['total'];
        $order_date = $row['order-date'];
        $status = $row['status'];
        $customer_name = $row['customer-name'];
        $customer_contact = $row['customer-contact'];
        $customer_email = $row['customer-email'];
        $customer_address = $row['customer-address'];

    }
}
?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Order</h1>
        <br>
        <br>
        <form action=""  method="POST">
        <table class="tbl-30">
                <tr>
                    <td>Food:</td>
                    <td><b><?php echo $food; ?></b></td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td><b>$ <?php echo $price; ?></b></td>
                </tr>
                <tr>
                    <td>Qty:</td>
                    <td><input type="number" name="qty" value="<?php echo $qty; ?>" ></td>
                </tr>

                <tr>
                    <td>Status:</td>
                    <td>
                        <select name="status" >
                            <option value="Ordered">Ordered</option>
                            <option value="On Delivery">On Delivery</option>
                            <option value="Delivred">Delivred</option>
                            <option value="Canceled">Canceled</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Customer Name:</td>
                    <td><input type="text" name="Customer-name" value="<?php echo $customer_name; ?>" ></td>
                </tr>
                <tr>
                    <td>Contact:</td>
                    <td><input type="number" name="Customer-contact" value="<?php echo $customer_contact; ?>" ></td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><input type="email" name="Customer-email" value="<?php echo $customer_email; ?>" ></td>
                </tr>
                <tr>
                    <td>address:</td>
                    <td><input type="text" name="Customer-address" value="<?php echo $customer_address; ?>" ></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="food" value="<?php echo $food; ?>">
                        <input type="hidden" name="price" value="<?php echo $price; ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>


    </div>
</div>
<?php 
if(isset($_POST['submit'])){
    $id = $_POST['id'];
    $food = $_POST['food'];
    $price = $_POST['price'];
    $qty = $_POST['qty'];
    $total = $price * $qty;
    $status = $_POST['status'];
    $customer_name = $_POST['Customer-name'];
    $customer_contact = $_POST['Customer-contact'];
    $customer_email = $_POST['Customer-email'];
    $customer_address = $_POST['Customer-address'];

    $sql2 = "UPDATE `tbl-order` SET 
            qty='$qty',
            total='$total',
            status='$status',
            `customer-name`='$customer_name',
            `customer-contact`='$customer_contact',
            `customer-email`='$customer_email',
            `customer-address`='$customer_address'
            WHERE id=$id ";
    $res2 = mysqli_query($conn, $sql2);
    if($res2){
        $_SESSION['update'] = "<div class='succes'>Order Updated</div>";
        header("Location:" . SITEURL . "admin/manage-order.php");
    }else{
        $_SESSION['update'] = "<div class='error'>Failed to Update Order</div>";
        header("Location:" . SITEURL . "admin/manage-order.php");
    }
}
?>

<?php
include('./partials/footer.php');
?>