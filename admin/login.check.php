<?php

    if(!isset($_SESSION['user'])){
        $_SESSION['no-login-message'] = "<h2 class='failed'>Please login to access Admin Page</h2>";
        header('location:'.SITEURL.'admin/login.php');
        
    }

?>