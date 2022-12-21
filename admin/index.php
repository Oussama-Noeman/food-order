<?php include('partials/header.php') ?>
    <div class="main-content">
        <div class="wrapper">
            <h2>Dashboard</h2><br><br>
            <?php
                if(isset($_SESSION['login'])){
                    echo $_SESSION['login'];//Displaying session message
                    unset($_SESSION['login']);//removing session message  
                    }    
            ?><br><br>
            <?php
            $sql = "SELECT * FROM `tbl-category`";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            ?>

            <div class="col-4 text-center">
                <h1><?php echo $count ?></h1><br>
                Categories
            </div>

            <?php
            $sql2 = "SELECT * FROM `tbl-food`";
            $res2 = mysqli_query($conn, $sql2);
            $count2 = mysqli_num_rows($res2);
            ?>
            <div class="col-4 text-center">
                <h1><?php echo $count2 ?></h1><br>
                Food
            </div>
            <?php
            $sql3 = "SELECT * FROM `tbl-order`";
            $res3 = mysqli_query($conn, $sql3);
            $count3 = mysqli_num_rows($res3);
            ?>
            <div class="col-4 text-center">
                <h1><?php echo $count3 ?></h1><br>
                Order
            </div>
            <?php
            $sql4 = "SELECT SUM(total) AS Total FROM `tbl-order` WHERE status='Delivred'";
            $res4 = mysqli_query($conn, $sql4);
            $row4 = mysqli_fetch_assoc($res4);
            $total_revenue=$row4['Total']
            ?>
            <div class="col-4 text-center">
                <h1>$<?php echo $total_revenue ?></h1><br>
                Revenue Generated
            </div>
            
            <div class="clearfix"></div>
        </div>
    </div>
    <?php include('partials/footer.php') ?>
