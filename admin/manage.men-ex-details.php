<?php
    include('partials/admin-header.php');
    include('login.check.php');
?>
<div class="main" style="height:100vh;">
        <div class="container">
            <h2>MANAGE ORDER DETAILS</h2>

            <?php

                if (isset($_SESSION['update'])){
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }

                if (isset($_SESSION['update-event'])){
                    echo $_SESSION['update-event'];
                    unset($_SESSION['update-event']);
                }

            ?>

            <table class="tbl-full" style="height:auto;">
            
                <tr>
                    <th>ID</th>
                    <th>Total</th>
                    <th>Menu Total</th>
                    <th>Extras Total</th>
                    <th>Minimum Payment</th>
                    <th>Paid</th>
                    <th>Balance</th>
                   
                </tr>

                <?php
                    //TO GET DATA
                    $booking = $_GET['id'];
                    $sql = "SELECT * FROM payment_details
                    WHERE id = (
                        SELECT receiptID
                        FROM bookings
                        WHERE id = $booking);";
                    //CATCHER
                    $res = mysqli_query($conn, $sql);

                    if ($res == TRUE){
                        // PRESENT ROWS
                        $count = mysqli_num_rows($res);

                        if ($count > 0){
                            //Loop through data
                            while($rows = mysqli_fetch_assoc($res)){
                                $id = $rows['id'];
                                $extras = $rows['extras_total'];
                                $menu = $rows['menus_total'];
                                $min = $rows['minPayment'];
                                $paid = $rows['paid'];
                                $balance = $rows['balance'];
                                $total = $rows['total'];

                                ?>

                                <tr>
                                    <td><?php echo $id; ?></td>
                                    <td><?php echo $total; ?></td>
                                    <td><?php echo $menu; ?></td>
                                    <td><?php echo $extras; ?></td>
                                    <td><?php echo $min; ?></td>
                                    <td><?php echo $paid; ?></td>
                                    <td><?php echo $balance; ?></td>
                                    
                                    <td class="btn-st">
                                        <a href="<?php echo SITEURL; ?>admin/update.orders.php?id=<?php echo $id; ?>&booking=<?php echo $booking; ?>" class="btn-green btn">Update</a>
                                       
                                    </td>
                                </tr>

                            <?php
                            }
                        }
                    } else {

                    }

                ?>
            </table>

        </div>
        
    </div>
<?php
    include('partials/footer.php');
?>