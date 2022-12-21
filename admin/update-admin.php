<?php
include('./partials/header.php');
$id = $_GET['id'];

$sql = "SELECT * FROM `tbl-admin` WHERE id=$id";
$res = mysqli_query($conn, $sql);
if($res){
    $count = mysqli_num_rows($res);
    if($count==1){
    $row = mysqli_fetch_assoc($res);
    $fullname = $row['fullname'];
    $username = $row['username'];
    }else{
        header("Location: " . SITEURL . "admin/manage-admin.php");
    }
}
?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        <br>
        <br>
        <form action=""  method="POST">
        <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td><input type="text" name="full_name" value="<?php echo $fullname; ?>" ></td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td><input type="text" name="username" value="<?php echo $username; ?>" ></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>


    </div>
</div>
<?php
    if(isset($_POST['submit'])){
    $id = $_POST['id'];//haydi yalli 3melneha hidden
    $fullname = $_POST['full_name'];
    $username = $_POST['username'];

    $sql = "UPDATE `tbl-admin` SET
        fullname = '$fullname',
        username = '$username' 
        WHERE id='$id'
        ";

    $res = mysqli_query($conn, $sql);
    if($res){
        $_SESSION['update'] = "<div class='succes'>Admin Updated Successfully.</div>";
        header("Location: " . SITEURL . "admin/manage-admin.php");

    }else{
        $_SESSION['update'] = "<div class='error'>Failed to update admin.</div>";
        header("Location: " . SITEURL . "admin/manage-admin.php");
    }
    }
?>


<?php
include('./partials/footer.php');
?>