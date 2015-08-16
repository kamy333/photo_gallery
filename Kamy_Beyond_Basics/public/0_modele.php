<?php require_once('../includes/initialize.php'); ?>
<?php if (!$session->is_logged_in()) { redirect_to("login.php"); } ?>
<?php if(User::is_chauffeur()){ redirect_to('index.php');}?>

<?php $layout_context = "public"; ?>
<?php $active_menu="admin"; ?>
<?php $stylesheets="";  ?>
<?php $fluid_view=true; ?>
<?php $javascript=""; ?>
<?php $incl_message_error=true; ?>
<?php //include_layout_template('header_2.php'); ?>
<?php include(SITE_ROOT.DS.'public'.DS.'layouts'.DS."header_2.php") ?>
<?php //include_layout_template('nav.php'); ?>
<?php include(SITE_ROOT.DS.'public'.DS.'layouts'.DS."nav.php") ?>



<h4 class="text-center"><mark><a href="<?php echo $_SERVER["PHP_SELF"] ?>">my modele</a> </mark></h4>

<h5>Client</h5>
<ul>
    <li>id</li>
    <li>company_name</li>
    <li>first_name</li>
    <li>last_name</li>
    <li>address</li>
    <li>zip</li>
    <li>city</li>
    <li>country</li>
    <li>phone</li>
    <li>mobile</li>
    <li>email</li>
    <li>website</li>
    <li>comment</li>
</ul>


<?php include(SITE_ROOT.DS.'public'.DS.'layouts'.DS."footer_2.php") ?>
