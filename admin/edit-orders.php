<?php
  include('login.check.php');

if(isset($_POST['submit'])){    
    //no empty values to be inserted in database
    $booking = $_POST['booking'];
    $menu_qty = $_POST['menu_qty'];
    $extra_qty = $_POST['extra_qty'];
    
    //create menu record
    if (!empty($_POST['menu'])){
        $menus = $_POST['menu'];
        
        $menu_query = "INSERT INTO menus_bookings
            SET
            quantity = ?,
            bookingID = (
                SELECT id
                FROM bookings
                WHERE id = ?),
            type = (
                SELECT id
                FROM menus_types
                WHERE id = ?);";

        $menu_stmt = $conn->prepare($menu_query);
        $menu_stmt->bind_param("iii", $m_qty, $booking, $menu);

        foreach ($menus as $menu){
            $m_qty = $menu_qty[$menu];
           $res_menu = $menu_stmt->execute();
        }

        if(!$res_menu){
            echo $conn->error;
        }
    }

    ///create extras record
    if (!empty($_POST['extra'])){
        $extras = $_POST['extra'];

        $extras_query = "INSERT INTO extras_bookings
            SET
            quantity = ?,
            bookingID = (
                SELECT id
                FROM bookings
                WHERE id = ?),
            type = (
                SELECT id
                FROM extras_types
                WHERE id = ?);";

        $extras_stmt = $conn->prepare($extras_query);
        $extras_stmt->bind_param("iii", $e_qty, $booking, $extra);

        foreach ($extras as $extra){
            $e_qty = $extra_qty[$extra];
            $res_extras = $extras_stmt->execute();
        }

    
         if(!$res_extras){
             echo $conn->error;
         }
    }

    //calculate fees
    $menu_sql = "SELECT SUM(mt.price * mb.quantity) as 'menu total'
    FROM menus_types mt, menus_bookings mb
    WHERE mt.id = mb.type
    AND mb.bookingID = ?;";

    $stmt_menu = $conn->prepare($menu_sql);
    $stmt_menu->bind_param("i", $booking);
    $stmt_menu->execute();
    $result_menu = $stmt_menu->get_result();
    $row_menu = $result_menu->fetch_assoc();
    $menu_total = $row_menu['menu total'];

    $extras_sql = "SELECT SUM(et.price * eb.quantity) as 'extras total'
    FROM extras_types et, extras_bookings eb
    WHERE et.id = eb.type
    AND eb.bookingID = ?;";

    $stmt_extras = $conn->prepare($extras_sql);
    $stmt_extras->bind_param("i", $booking);
    $stmt_extras->execute();
    $result_extras = $stmt_extras->get_result();
    $row_extras = $result_extras->fetch_assoc();
    $extras_total = $row_extras['extras total'];

    $total = $menu_total + $extras_total;
    $min = $total * .50;


    $payid_query = "SELECT receiptID FROM bookings 
                    WHERE id = ?;";
    $pay = $conn->prepare($payid_query);
    $pay->bind_param("i", $booking);
    $pay->execute(); 
    $res_pay_id = $pay->get_result(); 
    $row_pay = $res_pay_id->fetch_assoc();
    $payment_id = $row_pay['receiptID'];
    
    //create payment details
    $query_pay = "UPDATE payment_details
        SET extras_total = ?,
        menus_total = ?,
        total = ?,
        balance = ?,
        minPayment = ?
        WHERE id = ?;
      ";

    $stmt_pay = $conn->prepare($query_pay);
    $stmt_pay->bind_param("iiiiii", $extras_total, $menu_total, $total, $total, $min, $payment_id);
    $res_pay = $stmt_pay->execute();

    if(!$res_pay){
        echo $conn->error;
    } 

    //add receipt to booking record
    

    if ($res_pay){
        
       echo "<h2 class='success'>BOOKED SUCCESSFULLY.</h2>";

       echo "<a class='btn btn-blue' href='update.orders.php?booking=$booking'>Back to orders.</a>" ;
        
    } else {
        echo "<h2 class='failed'>BOOKING FAILED</h2>";
    }
}
?>