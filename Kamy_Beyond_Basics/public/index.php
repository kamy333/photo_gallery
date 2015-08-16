<?php require_once("../includes/initialize.php"); ?>
<?php




// 1 the current page number we are default 1
 $page= !empty($_GET)? (int) $_GET["page"]:1;

// 2 number of item per parge  (LIMIT)
 $per_page=10;

//3 Total record count in table some it can be where clause
 $total_count=Photograph::count_all();

//$sql="SELECT * from photographs "


// Find all photos
// use pagination instead
//$photos = Photograph::find_all();


$pagination= new Pagination($page,$per_page,$total_count);

// Instead of finding all records, just find the records
// for this page
$sql = "SELECT * FROM photographs ";
$sql .= "LIMIT {$per_page} ";
$sql .= "OFFSET {$pagination->offset()}";
$photos = Photograph::find_by_sql($sql);

// Need to add ?page=$page to all links we want to
// maintain the current page (or store $page in $session)

?>

<?php $layout_context = "public"; ?>
<?php $active_menu="admin" ?>
<?php $stylesheets="" //custom_form  ?>
<?php $javascript="form_admin" ?>
<?php //include_layout_template('admin_header.php'); ?>

<?php include(SITE_ROOT.DS.'public'.DS.'layouts'.DS."header_2.php") ?>
<?php include(SITE_ROOT.DS.'public'.DS.'layouts'.DS."nav.php") ?>

<?php foreach($photos as $photo): ?>
  <div style="float: left; margin-left: 20px;">
		<a href="photo.php?id=<?php echo $photo->id; ?>">
			<img src="<?php echo $photo->image_path(); ?>" height="" width="200" />
		</a>
    <p><?php echo $photo->caption; ?></p>
  </div>
<?php endforeach; ?>

<div id="pagination" style="clear: both;">
    <?php
    if($pagination->total_pages() > 1) {

        if($pagination->has_previous_page()) {
            echo "<a href=\"index.php?page=";
            echo urldecode($pagination->previous_page());
            echo "\">&laquo; Previous</a> ";
        }

        for($i=1; $i <= $pagination->total_pages(); $i++) {
            if($i == $page) {
                echo " <span class=\"selected\">{$i}</span> ";
            } else {
                echo " <a href=\"index.php?page={$i}\">{$i}</a> ";
            }
        }

        if($pagination->has_next_page()) {
            echo " <a href=\"index.php?page=";
            echo urldecode($pagination->next_page());
            echo "\">Next &raquo;</a> ";
        }

    }

    ?>
</div>

<?php include(SITE_ROOT.DS.'public'.DS.'layouts'.DS."footer_2.php") ?>
