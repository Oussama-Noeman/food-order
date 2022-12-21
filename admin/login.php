<?php 
include('../config/config-db.php')
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/admin.css">
    <title>Login</title>
</head>
<body>
    <div class="login">
        <h1 class="text-center">Login</h1><br><br>
        <?php 
        if(isset($_SESSION['login'])){
            echo $_SESSION['login'];//Displaying session message
            unset($_SESSION['login']);//removing session message  
            }
        if(isset($_SESSION['no-login-message'])){
            echo $_SESSION['no-login-message'];//Displaying session message
            unset($_SESSION['no-login-message']);//removing session message  
            }
        if(isset($_SESSION['error'])){
            echo $_SESSION['error'];//Displaying session message
            unset($_SESSION['error']);//removing session message  
            }
        ?>

        <!-- Login form -->
        <form action="" method="post" class="text-center">
            Username: <br>
            <input type="text" name="username" placeholder="Enter username"><br><br>
            Password:<br>
            <input type="password" name="password" placeholder="Enter password"><br><br><br>    

            <input type="submit" name="submit" value="Login" class="btn-primary"><br><br><br> 
        </form>
        <p class="text-center">Created By - <a href="#">Oussama Noeman</a></p>
    </div>
</body>
</html>

<?php

if(isset($_POST['submit'])){
    if(!isset($_POST['username'])||empty($_POST['username'])){
        $_SESSION['error']="<div class='error text-center'>All field are required</div> ";
    }
    if(!isset($_POST['password'])||empty($_POST['password'])){
        $_SESSION['error'] = "<div class='error text-center'>All field are required</div>";
    }
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn,md5($_POST['password'])) ;

    $sql = "SELECT * FROM `tbl-admin` WHERE username='$username' AND password='$password'";
    $res = mysqli_query($conn, $sql);

        $count = mysqli_num_rows($res);
        if($count==1){
            $_SESSION['login']="<div class='succes '>Login success</div>";
            $_SESSION['user'] = $username;  

            header("Location:" . SITEURL . "admin/");   
            
        }else{
            $_SESSION['login']="<div class='error text-center '>Failed to login</div>";
            header("Location:" . SITEURL . "admin/login.php ");
        }
      
}
?>