<?php
    include('partials/admin-header.php');
    include('login.check.php');
?>

    <!---main section--->
    <div class="main" style="height:100%;">
        <div class="container">
            <h2>MANAGE EVENTS</h2>

            <?php
                if (isset($_SESSION['add'])){
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }

                if (isset($_SESSION['remove'])){
                    echo $_SESSION['remove'];
                    unset($_SESSION['remove']);
                }

                if (isset($_SESSION['delete'])){
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }

                if (isset($_SESSION['update'])){
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }

                if (isset($_SESSION['upload'])){
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }
            ?>

            <a href="add.events.php" class="button">ADD EVENT</a>

            <table class="tbl-full" style="height:auto;">
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Image</th>
                
                </tr>
                <?php
                    //TO GET DATA
                    $sql = "SELECT * FROM events;";
                    //CATCHER
                    $res = $conn->query($sql);

                    if ($res == TRUE){
                        // PRESENT ROWS
                        $count = $res->num_rows;

                        if ($count > 0){
                            //Loop through data
                            while($rows = $res->fetch_assoc()){
                                $id = $rows['id'];
                                $title = $rows['title'];
                                $image = $rows['image_name'];

                                ?>

                                <tr>
                                    <td><?php echo $id; ?></td>
                                    <td><?php echo $title; ?></td>
                                    <td><img src="<?php echo SITEURL; ?>images/events/<?php echo $image; ?>" alt="" width="100px"></td>
                                    <td>
                                        <a href="<?php echo SITEURL; ?>admin/update.events.php?id=<?php echo $id; ?>" class="btn-green btn">Update Events</a>
                                        <a href="<?php echo SITEURL; ?>admin/delete.events.php?id=<?php echo $id; ?>&image=<?php echo $image; ?>" class="btn-red btn">Delete Events</a>
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