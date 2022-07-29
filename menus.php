<div class="contents" id="menus">
    <h1>Menus</h1>
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
            <div class="menu">
                <img src="<?php echo SITEURL; ?>images/menus/<?php echo $image_name; ?>" alt="" width="200px" height="300px">
                <div>
                    <h3><?php echo $title ?></h3>
                    <p class="desc"><?php echo $descritpion; ?></p>
                    <p><?php echo $price; ?></p>
                </div>
                <div class="button-book"><a href="">Book Now</a></div>
            </div>
                
        <?php
                }
            } else{
                echo "<div class='failed'>Not Found</div>";
            }
        ?>
    </div>
</div>

