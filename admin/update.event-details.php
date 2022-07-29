<?php
    include('partials/admin-header.php');
    include('login.check.php');
?>

    <div class="main" style="height:100vh;">

        <div class="container">
            <h1>UPDATE EVENT DETAILS</h1>

            <?php
                //Get id to be edit
                $id = $_GET['id'];
                $booking = $_GET['booking'];
                //SQL query to get data
                $sql = "SELECT * FROM event_details WHERE id = ?;";

                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $res = $stmt->get_result();
                $row = $res->fetch_assoc();
                
                $id = $row['id'];
                $event = $row['event_type'];
                $start = $row['startTime'];
                $end = $row['endTime'];
                $eventAddress = $row['eventAddress'];

                $sql_2 = "SELECT * FROM events WHERE id = ?;";

                $stmt_2 = $conn->prepare($sql_2);
                $stmt_2->bind_param("i", $event);
                $stmt_2->execute();
                $res_2 = $stmt_2->get_result();
                $row_2 = $res_2->fetch_assoc();
                $event_id = $row_2['id'];
                $event_title = $row_2['title'];
            ?>
            <a href="<?php echo SITEURL; ?>admin/update.booking.php?id=<?php echo $booking; ?>" class="btn-blue btn">Back to booking details</a>
            <br><br>
            <form action="" method="POST" class="form">
               <div>
                    <label for="event">Event Type:</label>
                    <p><?php echo $event_title; ?></p>
                    <p>Change to:</p>
                    <select name="event">
                        <option default value="<?php echo $event_id; ?>"></option>
                        <?php
                            //to get data from database
                            $sql = "SELECT * FROM events;";
                            //execute the query
                            $res = $conn->query($sql);
                            //count rows
                            $count = $res->num_rows;

                            if($count > 0){
                                while($row = $res->fetch_assoc()){
                                    $title = $row['title'];
                                    $e_id = $row['id'];
                        ?>
                            <option value="<?php echo $e_id; ?>"><?php echo $title; ?></option>
                            <?php 
                                }
                            } 
                        ?>
                    </select>  
               </div>
               <div>
                    <label for="start">Time Start:</label>
                    <p><?php echo $start; ?></p>
                    <p>Change to:</p>
                    <input type="datetime-local" name="start" value="<?php echo $start; ?>">  
               </div>
               <div>
                    <label for="end">Time End:</label>
                    <p><?php echo $end; ?></p>
                    <p>Change to:</p>
                    <input type="datetime-local" name="end" value="<?php echo $end; ?>">  
               </div>
               <div>
                    <label for="address">Address:</label>
                    <input type="text" name="address" value="<?php echo $eventAddress; ?>">  
               </div>
                <input type="hidden" name="id" value="<?php echo $id; ?>">
               <button class="button" type="submit" name="submit">Submit</button>
           </form>
        </div>
    </div>

<?php

    if (isset($_POST['submit'])){
        $id = $_POST['id'];
        $event = $_POST['event'];
        $eventAddress = $_POST['address'];

        if ($_POST['start']){
            $start = $_POST['start'];
        }

        if ($_POST['end']){
            $end = $_POST['end'];
        }

        //SQL query to to update admin
        $sql = "UPDATE event_details
            SET 
            event_type = '$event',
            startTime = '$start',
            endTime = '$end',
            eventAddress = '$eventAddress'
            WHERE id = $id;";

        //to execute the query

        $res = $conn->query($sql);

        if ($res == TRUE){
            $_SESSION['update-event'] = "<h2 class='success'>UPDATE EVENT SUCCESSFUL</h2>";
            header("location:".SITEURL."admin/manage.bookings.php");
        } else {
            $_SESSION['update-event'] = "<h2 class='failed'>UPDATE EVENT FAILED</h2>";
            header("location:".SITEURL."admin/manage.bookings.php");
        }
    }
    
?>

<?php
    include('partials/footer.php');
?>