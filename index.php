<?php
        include('partials-front/header.php');
?>
    <!---main section--->
    <div class="main">
        <div class="welcome">
            <div class="welcome-text">
                <div>
                   Book your special moments with us! 
                </div>
                <a href="<?php echo SITEURL; ?>booking.php" class="button">
                    Get Started
                </a>
            </div>
            <img src="./images/welcome.jpg" alt="">
        </div>
        <?php
             include('events.php');

             include('menus.php');
    
             include('extras.php');


        ?>
    </div>


<?php
   

    include('partials-front/footer.php');
?>