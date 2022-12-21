<?php
include('../config/config-db.php');
session_destroy();
header("Location:".SITEURL."admin/login.php")
?>