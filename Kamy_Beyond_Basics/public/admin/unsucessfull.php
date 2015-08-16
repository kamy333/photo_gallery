
<?php
require_once('../../includes/initialize.php');
if (!$session->is_logged_in()) { redirect_to("login.php"); }
?>

<?php include_layout_template('admin_header.php'); ?>

$session->logout();

<h1>Menu Unsuccessfull</h1>

<?php echo output_message($message); ?>
<ul>
    <li><a href="list_photos.php">List Photos</a></li>
    <li><a href="logfile.php">View Log file</a></li>
    <li><a href="logout.php">Logout</a></li>
    <li><a href="user_admin.php">User</a></li>
    <li><a href="../index.php">&laquo; Public</a></li>

</ul>



<?php include_layout_template('admin_footer.php'); ?>

