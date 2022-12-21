<?php
include('./partials/header.php');

?>
<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br>
        <br>
        <?php 
            if(isset($_GET['id'])){
            $id = $_GET['id'];
            }
        ?>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>
                        <label for="">Old Password:</label>
                    </td>
                    <td>
                        <input type="password" name="old_password" placeholder="Enter old Password">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="">New  Password:</label>
                    </td>
                    <td>
                        <input type="password" name="new_password" placeholder="Enter New Password">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="">Confirm  Password:</label>
                    </td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="confirm  Password">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="change Password" class="btn-secondary">
                    </td>
                </tr>
                
               
            </table>
        </form>

    </div>
</div>

<?php
if(isset($_POST['submit'])){
    $id = $_POST['id'];
    $current_password =md5($_POST['old_password']) ;
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);

    $sql = "SELECT * FROM `tbl-admin` WHERE id=$id AND password='$current_password'";

    $res = mysqli_query($conn, $sql);
    if($res){
        $count = mysqli_num_rows($res);
        if($count==1){
            // $row = mysqli_fetch_assoc($res);
            if($new_password==$confirm_password){
                $sql2 = "UPDATE `tbl-admin` SET
                    password = '$new_password'
                    WHERE id =$id
                    ";

                $res2 = mysqli_query($conn, $sql2);
                if($res2){
                    $_SESSION['change-pwd']= "Password changed successfully";
                    header("Location: ".SITEURL."admin/manage-admin.php");
                }else{
                    $_SESSION['change-pwd']= "failed to change password";
                    header("Location: ".SITEURL."admin/manage-admin.php");
                }
            }else{
                $_SESSION['pwd-not-match']= "Password did not match";
                header("Location: ".SITEURL."admin/manage-admin.php");
            }
        }else{
            $_SESSION['user-not-found']= "User not found";
                header("Location: ".SITEURL."admin/manage-admin.php");
        }
    }
    
}else{

}
?>

<?php include('./partials/footer.php');?>