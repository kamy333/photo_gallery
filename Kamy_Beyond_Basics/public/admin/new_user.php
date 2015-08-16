<?php require_once('../../includes/initialize.php'); ?>
<?php if (!$session->is_logged_in()) { redirect_to("login.php"); } ?>
<?php //if(User::is_chauffeur()){ redirect_to('index.php');}?>

<?php
//echo isset($session->user_id) ? "true" : "false";
?>





<?php
if (isset($_POST['submit'])) {
  // Process the form
  $user= new User();
  // validations
  $required_fields = array("username", "password","email","nom","user_type_id");

 foreach($_POST as $key =>$val) {
     $$key=trim($val);

 }
    $user->username=$username;
    $user->password=$password;
    $user->nom=$nom;
    $user->user_type_id=$user_type_id;

//echo '<tt><pre>' . var_export($user, TRUE) . '</pre></tt>';

    $user->create();


} // end: if (isset($_POST['submit']))

?>

<?php $layout_context = "admin"; ?>
<?php $active_menu="admin" ?>
<?php $stylesheets="" //custom_form  ?>
<?php $javascript="form_admin" ?>
<?php //include_layout_template('admin_header.php'); ?>

<?php include(SITE_ROOT.DS.'public'.DS.'layouts'.DS."header_2.php") ?>
<?php include(SITE_ROOT.DS.'public'.DS.'layouts'.DS."nav.php") ?>







<div class="row">

</div>

<div class="row visible-lg visible-md">
<div class ="">


    <h2 class="text-center">Create a new user</h2>
</div>
    </div>


<div class="row">
    <div class="col-md-7 col-md-offset-2 col-lg-7 col-lg-offset-2">

        <div class ="background_light_blue">

        <form id=""  class="group form-horizontal" autocomplete="off" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">


    <fieldset id="" title="Create a new user">
    <legend class="text-center" style="color: #0000ff">New user</legend>



        <div class="form-group">
            <label   class="col-sm-3 control-label"  for="username">Username</label>
                <div class="col-sm-9">
            <input  class="form-control" type="text" autocomplete="off" name="username" id="username" value="" required />
            </div></div>

            <div class="form-group">
            <label   class="col-sm-3 control-label" for="password">Password</label>
                <div class="col-sm-9">
            <input  class="form-control" type="password" autocomplete="off" name="password" id="password" value=""  />
            </div></div>

            <div class="form-group">
            <label  class="col-sm-3 control-label"  for="email">Email</label>
                <div class="col-sm-9">
            <input  class="form-control" type="email" name="email" id="email" placeholder="Email"  />
            </div></div>


                <div class="form-group">
            <label  class="col-sm-3 control-label"  for="nom">Fullname</label>
                    <div class="col-sm-9">
            <input  class="form-control" type="text" name="nom" id="nom" value=""  placeholder="prénom nom"/>
                </div></div>


                        <div class="form-group">
            <label  class="col-sm-3 control-label"  for="user_type_id">User type id</label>
                            <div class="col-sm-9">
            <select  class="form-control"  name="user_type_id" id="user_type_id" required>
            <option value="" disabled selected>Choisir type user ID</option>
            <option value="1">admin</option>
            <option value="2">manager</option>
            <option value="3">secretary</option>
            <option value="4">employee</option>
            </select>
            </div></div>


        <div class="col-sm-offset-3 col-sm-7 col-xs-2">
            <button type="submit" name="submit" class="btn btn-primary">New Admin</button>
        </div>

        <div class="text-right" >
            <a href="manage_admins.php" class="btn btn-info " role="button">Cancel</a>
        </div>


      </fieldset>
    </form>
   <!-- <br />
    <a href="manage_admins.php">Cancel</a>-->
    </div>
  </div>
</div>

<?php //include_layout_template('admin_footer.php'); ?>
<?php include_layout_template('footer_2.php'); ?>
