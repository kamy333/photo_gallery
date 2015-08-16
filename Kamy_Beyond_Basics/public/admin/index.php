<?php
require_once('../../includes/initialize.php');
if (!$session->is_logged_in()) { redirect_to("login.php"); }
?>

<?php $layout_context = "admin"; ?>
<?php $active_menu="admin" ?>
<?php $stylesheets="" //custom_form  ?>
<?php $javascript="form_admin" ?>
<?php //include_layout_template('admin_header.php'); ?>

<?php include(SITE_ROOT.DS.'public'.DS.'layouts'.DS."header_2.php") ?>
<?php include(SITE_ROOT.DS.'public'.DS.'layouts'.DS."nav.php") ?>


<h2>Menu</h2>

	<?php echo output_message($message); ?>
	<ul>
		<li><a href="list_photos.php">List Photos</a></li>
		<li><a href="logfile.php">View Log file</a></li>
		<li><a href="logout.php">Logout</a></li>
        <li><a href="user_admin.php">User</a></li>
        <li><a href="../index.php">&laquo; Public</a></li>

    </ul>



<?php include(SITE_ROOT.DS.'public'.DS.'layouts'.DS."footer_2.php") ?>
		
