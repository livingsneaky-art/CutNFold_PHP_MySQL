<?php
    include('partials/admin-header.php');
    include('login.check.php');
?>

    <div class="main" style="height:100vh;">

        

        <div class="container">
            <h1>UPDATE ORDER DETAILS</h1>

            <?php
            if (isset($_SESSION['delete'])){
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
            }
            if (isset($_SESSION['update'])){
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
            }
        ?>

            <?php
                //Get id to be edit
                
                $booking = $_GET['booking'];
                //SQL query to get data 
               
            ?>

            <table class="tbl-full" style="height:auto; table-layout: auto;
    width: 100%;">
            <a href="<?php echo SITEURL; ?>admin/update.booking.php?id=<?php echo $booking; ?>" class="btn-blue btn">Back to booking details</a>
            <br><br>
            <a href="<?php echo SITEURL; ?>admin/add-orders.php?id=<?php echo $booking; ?>" class="btn-blue btn">Add Menus/Extras</a>
            <br><br>
            <h2>Menu/Extras</h2>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Quantity</th>
                </tr>
                <?php
                    //TO GET DATA
                    $query_menu = "SELECT mt.id, mt.title, mt.description, mt.price, mb.quantity FROM menus_types mt, menus_bookings mb
                    WHERE mt.id = mb.type
                    AND mb.bookingID = ?;";  
                    
                    $stmt_menu = $conn->prepare($query_menu);
                    $stmt_menu->bind_param("i", $booking);
                    $stmt_menu->execute();
                    $res_menu = $stmt_menu->get_result();
                   
                            //Loop through data
                        while($rows_menu = $res_menu->fetch_assoc()){
                            $menu_id = $rows_menu['id'];
                            $menu_title = $rows_menu['title'];
                            $menu_desc = $rows_menu['description'];
                            $menu_price = $rows_menu['price'];
                            $menu_qty = $rows_menu['quantity'];
                            ?>

                            <tr>
                                <td><?php echo $menu_title; ?></td>
                                <td><?php echo $menu_desc; ?></td>
                                <td><?php echo $menu_price; ?></td>
                                <td><?php echo $menu_qty; ?></td>
                                <td class="btn-st">
                                    <div><a href="<?php echo SITEURL; ?>admin/delete.menu.book.php?menu_id=<?php echo $menu_id; ?>&booking=<?php echo $booking; ?>" class="btn-red btn">Delete</a></div>
                                </td>
                            </tr>

                            <?php
                            }
                ?>
                <?php
                    //TO GET DATA
                    $query_extras = "SELECT et.id, et.title, et.description, et.price, eb.quantity FROM extras_types et, extras_bookings eb
                    WHERE et.id = eb.type
                    AND eb.bookingID = ?;";   
                    
                    $stmt_extras = $conn->prepare($query_extras);
                    $stmt_extras->bind_param("i", $booking);
                    $stmt_extras->execute();
                    $res_menu = $stmt_menu->get_result();
                    $res_extras = $stmt_extras->get_result();
                   
                            //Loop through data
                        while($row_extras = $res_extras->fetch_assoc()){
                            $extras_id = $row_extras['id'];
                            $extras_title = $row_extras['title'];
                            $extras_desc = $row_extras['description'];
                            $extras_price = $row_extras['price'];
                            $extras_qty = $row_extras['quantity'];
                            ?>

                            <tr>
                                <td><?php echo $extras_title; ?></td>
                                <td><?php echo $extras_desc; ?></td>
                                <td><?php echo $extras_price; ?></td>
                                <td><?php echo $extras_qty; ?></td>
                                <td class="btn-st">
                                    <div><a href="<?php echo SITEURL; ?>admin/delete.extras.book.php?extra_id=<?php echo $extras_id; ?>&booking=<?php echo $booking; ?>" class="btn-red btn">Delete</a></div>
                                </td>
                            </tr>

                            <?php
                            }
                ?>
            </table>
        </div>
    </div>

<?php
    include('partials/footer.php');
?>