<?php include('./partials/header.php') ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Admin</h1><br>

        <?php
            if(isset($_SESSION['add'])){
            echo $_SESSION['add'];//Displaying session message
            unset($_SESSION['add']);//removing session message  
            }
            
            if(isset($_SESSION['delete'])){
                echo $_SESSION['delete'];//Displaying session message
                unset($_SESSION['delete']);//removing session message  
            }
            if(isset($_SESSION['update'])){
                echo $_SESSION['update'];//Displaying session message
                unset($_SESSION['update']);//removing session message  
            }
            if(isset($_SESSION['change-pwd'])){
                echo $_SESSION['change-pwd'];//Displaying session message
                unset($_SESSION['change-pwd']);//removing session message  
            }
            if(isset($_SESSION['pwd-not-match'])){
                echo $_SESSION['pwd-not-match'];//Displaying session message
                unset($_SESSION['pwd-not-match']);//removing session message  
            }
            if(isset($_SESSION['user-not-found'])){
                echo $_SESSION['user-not-found'];//Displaying session message
                unset($_SESSION['user-not-found']);//removing session message  
            }
        ?>  
        <br>
        <br>

        <a href="add-admin.php" class="btn-primary" >Add Admin</a>
        <br>
        <table class="tbl-full"><br>
            <tr>
                <th>S.N</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Action</th>
            </tr>

            <?php
            $sql = "SELECT * FROM `tbl-admin`";
            $res = mysqli_query($conn, $sql);
            $sn = 0;
            if($res){
                $rows = mysqli_num_rows($res);
                if($rows>0){
                    //we have data in DB
                    while($rows= mysqli_fetch_assoc($res)){
                        $id = $rows['id']; 
                        $fullname = $rows['fullname'];
                        $username = $rows['username'];
                        $sn++;
                        //Display data
                        ?>
                        <tr>
                            <td><?php echo $sn ?></td>
                            <td><?php echo $fullname ?></td>
                            <td><?php echo $username ?></td>
                            <td>
                            <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
                            <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary"> Update Admin</a>
                            <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger"> Delete Admin</a>
                            </td>
                        </tr>
                        <?php
                    }
                }else{
                    //we dont have any data
                }
            }
            ?>
        </table>







    </div>
</div>
<?php include('partials/footer.php') ?>