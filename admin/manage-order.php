<?php
include('./partials/header.php');
?>
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Order</h1><br>
        <?php 
        if(isset($_SESSION['update'])){
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        ?>
        <table class="tbl-full"><br>
            <tr>
                <th>S.N</th>
                <th>Food</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Total</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Customer Name</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Address</th>
                <th>Action</th>
            </tr>
            <?php
            $sn = 0;
            $sql = "SELECT * FROM `tbl-order`";
            $res = mysqli_query($conn, $sql);
            if($res){
                $count = mysqli_num_rows($res);
                if($count>0){
                    while($row = mysqli_fetch_assoc($res)){
                        $sn++;
                        $id = $row['id'];
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
                        ?>
                        <tr>
                        <td><?php echo $sn ?></td>
                        <td><?php echo $food ?></td>
                        <td>$<?php echo $price ?></td>
                        <td><?php echo $qty ?></td>
                        <td>$<?php echo $total ?></td>
                        <td><?php echo $order_date ?></td>
                        <td><?php echo $status ?></td>
                        <td><?php echo $customer_name ?></td>
                        <td><?php echo $customer_contact ?></td>
                        <td><?php echo $customer_email ?></td>
                        <td><?php echo $customer_address?></td>
                        <td>
                           <a href="update-order.php?id=<?php echo $id; ?>" class="btn-secondary"> Update Order</a>                         
                        </td>
                    </tr>
                    <?php
                    }
                }else{
                    echo "<div>No Data Found</div>";
                }
            }else{
                echo "<div>DB ERROR</div>";
            }
            ?>
            

        </table>
    </div>
</div>
    <?php
include('./partials/footer.php');
?>