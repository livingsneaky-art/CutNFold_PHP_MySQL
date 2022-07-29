<?php
    include('partials/admin-header.php');
    include('login.check.php');
?>

<div style="background-color:#F7DAD9; height:100%; padding-top:1em; padding-bottom:1em;">
    <br>
        <div class="form-container">
            <form action="" method="POST" class="form-overlay">

            <?php 

            include('edit-orders.php');

            $booking = $_GET['id'];

            if (isset($_SESSION['menu'])){
                echo $_SESSION['menu'];
                unset($_SESSION['menu']);
            }

        ?>
            
            <a href="<?php echo SITEURL; ?>admin/update.booking.php?id=<?php echo $booking; ?>" class="btn-blue btn">Back to booking details</a>
                <!-----MENUS CHOICES------->
                <h2>Menus</h2>
                <div class="input">
                
                    <div class="grid-container">
                        
                        <?php
                            //to get data from database
                            $sql = "SELECT * FROM menus_types;";
                            //execute the query
                            $res = mysqli_query($conn, $sql);
                            //count rows
                            $count = mysqli_num_rows($res);

                            if($count > 0){
                                while($row = mysqli_fetch_assoc($res)){
                                    $id = $row['id'];
                                    $title = $row['title'];
                                    $image_name = $row['image'];
                                    $descritpion = $row['description'];
                                    $price = $row['price'];
                        ?>
                            <div class="center">
                                <img src="<?php echo SITEURL; ?>images/menus/<?php echo $image_name; ?>" alt="" width="100px" height="200px">
                                <div>
                                    <h3><?php echo $title ?></h3>
                                    <p class="desc"><?php echo $descritpion; ?></p>
                                    <p><?php echo $price; ?></p>
                                </div>
                                <input type="checkbox" name="menu[]" value="<?php echo $id; ?>">
                                <br>
                                Quantity:
                                <input type="number" name="menu_qty[<?php echo $id; ?>]" min="1" max="10">
                            </div>
                            <?php 
                                }
                            }
                        ?>
                            
                    </div>
                </div>

                <!-----EXTRAS CHOICES------->
                <h2>Extras</h2>
                <div class="input">
                
                    <div class="grid-container">
                        
                        <?php
                            //to get data from database
                            $sql = "SELECT * FROM extras_types;";
                            //execute the query
                            $res = mysqli_query($conn, $sql);
                            //count rows
                            $count = mysqli_num_rows($res);

                            if($count > 0){
                                while($row = mysqli_fetch_assoc($res)){
                                    $id = $row['id'];
                                    $title = $row['title'];
                                    $image_name = $row['image'];
                                    $descritpion = $row['description'];
                                    $price = $row['price'];
                        ?>
                            <div class="center">
                                <img src="<?php echo SITEURL; ?>images/extras/<?php echo $image_name; ?>" alt="" width="100px" height="200px">
                                <div>
                                    <h3><?php echo $title ?></h3>
                                    <p class="desc"><?php echo $descritpion; ?></p>
                                    <p><?php echo $price; ?></p>
                                </div>
                                <input type="checkbox" name="extra[]" value="<?php echo $id; ?>">
                                <br>
                                Quantity:
                                <input type="number" name="extra_qty[<?php echo $id; ?>]" min="1" max="10">
                            </div>
                            <?php 
                                }
                            }
                        ?>
                            
                    </div>
                    <input type="hidden" value="<?php echo $booking; ?>" name="booking">
                </div>
                <center style="margin-top: 20px;">
                   <button class="button" type="submit" name="submit" >Submit</button> 
                </center>
            </form>
        </div>
    </div>


<?php
    include('partials/footer.php');
?>