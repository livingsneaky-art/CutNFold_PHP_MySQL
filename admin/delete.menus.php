<?php 

    include('../configs/constants.php');
    include('login.check.php');

    if(isset($_GET['id']) AND isset($_GET['image'])){

        ///get id to delete
        $id = $_GET['id'];
        $image = $_GET['image'];

       

        //creating sql command to delete
        $sql = "DELETE FROM menus_types WHERE id=$id;";

        //to execute the query
        $res = $conn->query($sql);

        if ($res == TRUE){
            //to remove image file
            if ($image != ""){
                $path = "../images/menus/".$image;
                $remove = unlink($path);
    
                if($remove == FALSE){
                    $_SESSION['remove'] = "<h2 class='failed'>FAILED TO REMOVE IMAGE</h2>";
                    //redirect to manage page
                    header('location:'.SITEURL.'admin/manage.menus.php');
    
                    die();
                }
            }
            //creating session 
            $_SESSION['delete'] = "<h2 class='success'>DELETED SUCCESSFULLY</h2>";
            //redirect to manage page
            header('location:'.SITEURL.'admin/manage.menus.php');
        } else {
            $_SESSION['delete'] = "<h2 class='failed'>DELETE FAILED</h2>";
            header('location:'.SITEURL.'admin/manage.menus.php');
        }

    } else {
        header('location:'.SITEURL.'admin/manage.menus.php');
    }
?>