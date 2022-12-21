<?php
include('./partials/header.php');
if (isset($_POST['submit'])) {
    if (!isset($_POST['full_name']) || empty($_POST['full_name'])) {
        header("Location: add-admin.php?error=Full name is required");
        exit();
    }
    if (!isset($_POST['username']) || empty($_POST['username'])) {
        header("Location: add-admin.php?error=username is required");
        exit();
    }
    if (!isset($_POST['password']) || empty($_POST['password'])) {
        header("Location: add-admin.php?error=password is required");
        exit();
    }
    $fname = mysqli_escape_string($conn, $_POST['full_name']);
    $username = mysqli_escape_string($conn, $_POST['username']);
    $password = md5($_POST['password']);

    //add in db
    $sql = "INSERT INTO `tbl-admin` SET 
        fullname='$fname',
        username='$username',
        password='$password'" ;
    $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    //check if the data inserted
    if($res){
        $_SESSION['add'] = "Admin Added Successfuly";
        header("Location: " . SITEURL."admin/manage-admin.php");
    }else{
        $_SESSION['add'] = "Failed to add Admin";
        header("Location: " . SITEURL."admin/add-admin.php");
    }

}
?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1><br>

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add']; //Displaying session message
            unset($_SESSION['add']); //removing session message 
        }
        ?>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td><input type="text" name="full_name" placeholder="Enter your name"></td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td><input type="text" name="username" placeholder="Enter username"></td>
                </tr>
                <tr>
                    <td>Pssword:</td>
                    <td><input type="password" name="password" placeholder="Enter password"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>




<?php include('partials/footer.php');?>
