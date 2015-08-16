<?php require_once("../../includes/initialize.php"); ?>
<?php if (!$session->is_logged_in()) { redirect_to("login.php"); } ?>
<?php
  // Find all the photos
 // $photos = Photograph::find_all();

$page= !empty($_GET)? (int) $_GET["page"]:1;
$per_page=2;
$total_count=Photograph::count_all();
$pagination= new Pagination($page,$per_page,$total_count);


$sql = "SELECT * FROM photographs ";
$sql .= "LIMIT {$per_page} ";
$sql .= "OFFSET {$pagination->offset()}";
$photos = Photograph::find_by_sql($sql);


?>
<?php $layout_context = "admin"; ?>
<?php $active_menu="admin" ?>
<?php $stylesheets="" //custom_form  ?>
<?php $javascript="form_admin" ?>
<?php //include_layout_template('admin_header.php'); ?>

<?php include(SITE_ROOT.DS.'public'.DS.'layouts'.DS."header_2.php") ?>
<?php include(SITE_ROOT.DS.'public'.DS.'layouts'.DS."nav.php") ?>



<a href="index.php">&laquo; Back</a>  <a href="../index.php">&laquo; Public</a><br>
<br>


<div id="">
    <nav>
        <ul class="pagination">
    <?php
    if($pagination->total_pages() > 1) {

   //     <li><a href="#">Previous</a></li>
        if($pagination->has_previous_page()) {
            echo "<li><a href=\"list_photos.php?page=";
            echo urldecode($pagination->previous_page());
            echo "\">&laquo; Previous</a></li> ";
        }

        for($i=1; $i <= $pagination->total_pages(); $i++) {
            if($i == $page) {
                echo " <li class=\"active\"><a href='#'>{$i}</a></li> ";

            } else {
                echo "<li class=\"\"><a href=\"list_photos.php?page={$i}\">{$i}</a></li> ";
            }
        }

        if($pagination->has_next_page()) {
            echo "<li> <a href=\"list_photos.php?page=";
            echo urldecode($pagination->next_page());
            echo "\">Next &raquo;</a></li> ";
        }

    }

    ?>
           </ul>
        </nav>
</div>

<h2>Photographs</h2>

<?php echo output_message($message); ?>
<table class="bordered">
  <tr>
    <th>Image</th>
    <th>Filename</th>
    <th>Caption</th>
    <th>Size</th>
    <th>Type</th>
		<th>Comments</th>
		<th>&nbsp;</th>
  </tr>
<?php foreach($photos as $photo): ?>
  <tr>
    <td><img src="../<?php echo $photo->image_path(); ?>" width="100" /></td>
    <td><?php echo $photo->filename; ?></td>
    <td><?php echo $photo->caption; ?></td>
    <td><?php echo $photo->size_as_text(); ?></td>
    <td><?php echo $photo->type; ?></td>
		<td>
			<a href="comments.php?id=<?php echo $photo->id; ?>">
				<?php echo count($photo->comments()); ?>
			</a>
		</td>
		<td><a href="delete_photo.php?id=<?php echo $photo->id; ?>">Delete</a></td>
  </tr>
<?php endforeach; ?>
</table>
<br />
<a href="photo_upload.php">Upload a new photograph</a>

<?php include(SITE_ROOT.DS.'public'.DS.'layouts'.DS."footer_2.php") ?>
