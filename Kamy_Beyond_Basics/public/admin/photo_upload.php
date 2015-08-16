<?php
require_once('../../includes/initialize.php');
if (!$session->is_logged_in()) { redirect_to("login.php"); }
?>
<?php
	$max_file_size = 1048576;   // expressed in bytes
	                            //     10240 =  10 KB
	                            //    102400 = 100 KB
	                            //   1048576 =   1 MB
	                            //  10485760 =  10 MB

	if(isset($_POST['submit'])) {
		$photo = new Photograph();
		$photo->caption = $_POST['caption'];
		$photo->attach_file($_FILES['file_upload']);
		if($photo->save()) {
			// Success
      $session->message("Photograph uploaded successfully.");
			redirect_to('list_photos.php');
		} else {
			// Failure
      $message = join("<br />", $photo->errors);
		}
	}
	
?>

<?php $layout_context = "admin"; ?>
<?php $active_menu="admin" ?>
<?php $stylesheets="" //custom_form  ?>
<?php $javascript="form_admin" ?>
<?php //include_layout_template('admin_header.php'); ?>

<?php include(SITE_ROOT.DS.'public'.DS.'layouts'.DS."header_2.php") ?>
<?php include(SITE_ROOT.DS.'public'.DS.'layouts'.DS."nav.php") ?>

<a href="list_photos.php">&laquo; Back</a><br>

	<h2> Upload</h2>



	<?php echo output_message($message); ?>
  <form action="photo_upload.php" enctype="multipart/form-data" method="POST">
    <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max_file_size; ?>" />
    <p><input type="file" name="file_upload" /></p>
    <p>Caption: <input type="text" name="caption" value="" /></p>
    <input type="submit" name="submit" value="Upload" />
  </form>


<?php include(SITE_ROOT.DS.'public'.DS.'layouts'.DS."footer_2.php") ?>
		
