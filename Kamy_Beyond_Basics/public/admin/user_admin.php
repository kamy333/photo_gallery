<?php
require_once('../../includes/initialize.php');
if (!$session->is_logged_in()) { redirect_to("login.php"); }
?>

<?php $users= User::find_all() ?>
<?php //var_dump($users) ?>

<?php $layout_context = "admin"; ?>
<?php $active_menu="admin" ?>
<?php $stylesheets="" //custom_form  ?>
<?php $javascript="form_admin" ?>
<?php //include_layout_template('admin_header.php'); ?>

<?php //include_layout_template('header_2.php'); ?>
<?php include(SITE_ROOT.DS.'public'.DS.'layouts'.DS."header_2.php") ?>
<?php //include_layout_template('nav.php'); ?>
<?php include(SITE_ROOT.DS.'public'.DS.'layouts'.DS."nav.php") ?>

<a href="index.php">Index</a> &nbsp;&nbsp; <a href="new_user.php">Add New User</a>
<br><br>

<div class="table-responsive">
<table class='table table-striped table-bordered table-hover table-condensed '>
<tr>
<th>Id</th>
<th>username</th>
<th>nom</th>
<th>email</th>
<th>User Type</th>
<th>User type ID</th>
<th colspan="2" class="text-center">Actions</th>
    s
</tr>

<?php foreach ($users as $user  ): ?>
<?php  echo $user->display_table() ?>
<?php endforeach ;?>
</table>
</div>




<?php  ?>
<?php include_layout_template('footer_2.php'); ?>

