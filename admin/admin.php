<?php
    include('partials/admin-header.php');
    include('login.check.php');
?>

    <div class="main" style="height:64vh;">
        <div class="container admin">
            <h1>ADMIN PAGE</h1>

            <ul style="list-style:none; display:flex; gap: 1em">
                <li><a href="<?php echo SITEURL; ?>admin/manage.admin.php" class="button">MANAGE ADMIN</a></li>
                <li><a href="<?php echo SITEURL; ?>admin/manage.bookings.php" class="button">MANAGE BOOKINGS</a></li>
                <li><a href="<?php echo SITEURL; ?>admin/manage.menus.php" class="button">MANAGE MENUS</a></li>
                <li><a href="<?php echo SITEURL; ?>admin/manage.extras.php" class="button">MANAGE EXTRAS</a></li>
                <li><a href="<?php echo SITEURL; ?>admin/manage.events.php" class="button">MANAGE EVENTS</a></li>
            </ul>
        </div>
    </div>

<?php
    include('partials/footer.php');
?>