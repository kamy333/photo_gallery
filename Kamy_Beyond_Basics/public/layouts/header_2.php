<?php if (!isset($layout_context)) {$layout_context = "public";	}?>
<?php // if (isset($_SESSION["nom"])) {$nom=$_SESSION["nom"]; } else { $nom=false;}?>
<?php // if (isset($_SESSION["username"])) {$username=$_SESSION["username"]; } else { $username=false;}?>

<?php
//echo isset($session->user_id) ? "true" : "false";
?>
<?php $page_name = $_SERVER['PHP_SELF'];?>


<!-- TODO stylesheet footer  header below layout context -->
<?php if (!isset($layout_header)) {$layout_header = "normal";	}?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
;
    <title>ikamy.ch Photo Gallery <?php if ($layout_context == "admin") { echo "Admin"; } ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

<?php if ($layout_context=="public"){  ?>

<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/custom.css">
    <script src="js/respond.js"></script>

<?php    } else { ?>
<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../css/custom.css">
    <script src="../js/respond.js"></script>

<?php } ?>

</head>

<body>


<?php if (isset($fluid_view) && ($fluid_view)){?>
<!--<div class="container-fluid">  full page wide-->
<div class="container-fluid">
<?php } else {
    ?>
    <div class="container">
<?php } ?>



