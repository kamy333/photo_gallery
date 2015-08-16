<?php
require_once("../../includes/initialize.php");

if($session->is_logged_in()) {
  redirect_to("index.php");
}

// Remember to give your form's submit tag a name="submit" attribute!
if (isset($_POST['submit'])) { // Form has been submitted.

  $username = trim($_POST['username']);
  $password = trim($_POST['password']);
  
  // Check database to see if username/password exist.
	$found_user = User::authenticate($username, $password);
	
  if ($found_user) {
    $session->login($found_user);
	log_action('Login', "{$found_user->username} logged in.");
    redirect_to("index.php");
  } else {
    // username/password combo was not found in the database
    $message = "Username/password combination incorrect.";
  }
  
} else { // Form has not been submitted.
  $username = "";
  $password = "";
}

?>
<?php $layout_context = "admin"; ?>
<?php $active_menu="admin" ?>
<?php $stylesheets="" //custom_form  ?>
<?php $javascript="form_admin" ?>
<?php //include_layout_template('admin_header.php'); ?>

<?php //include_layout_template('header_2.php'); ?>
<?php include(SITE_ROOT.DS.'public'.DS.'layouts'.DS."header_2.php") ?>
<?php //include_layout_template('nav.php'); ?>
<?php include(SITE_ROOT.DS.'public'.DS.'layouts'.DS."nav.php") ?>


<?php echo output_message($message); ?>

<div class="row">

    <div class="col-md-4 col-md-offset-4  col-lg-4 col-lg-offset-4 ">
        <form id="myform" class="form-signin " action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <h2 class="form-signin-heading text-center">Please sign into ikamy.ch Staff area</h2>
            <h6><a href="login_lost_pwd.php">Forgot login?</a></h6>

            <label for="username" class="sr-only">username</label>
            <input type="text" name="username" id="username" class="form-control" placeholder="Username" required autofocus <?php echo 'value="'.htmlentities($username, ENT_COMPAT, 'utf-8') . '"';?>>

            <label for="password" class="sr-only">Password</label>
            <input type="password"  name="password" id="password" class="form-control" placeholder="Password" required>

            <div class="checkbox">
                <label>
                    <input type="checkbox" value="remember-me"> Remember me
                </label>
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit" value="submit">Sign in</button>
        </form>

    </div>

</div>

<?php //include_layout_template('admin_footer.php'); ?>
<?php include_layout_template('footer_2.php'); ?>
<?php include(SITE_ROOT.DS.'public'.DS.'layouts'.DS."footer_2.php") ?>
