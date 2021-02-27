<?php

session_start();

$id = $_GET['id'];
$dir="../";

if (!isset($_SESSION['login_user'])) {
    $location = "location: ".$dir."login.php?page=blog/details.php?id=".$id;
    header($location);
}

?>

<!DOCTYPE html>
<html lang="en">

<?php
$space = "<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>";
include $dir."inc/header.php";
include $dir."inc/connection.php";
include $dir."inc/functions.php";
include $dir."inc/top.php";


$query = "SELECT * from NZblog WHERE id='".$id."'";
$row = mysqli_fetch_assoc(mysqli_query($link,$query));
$url = $dir."blog";

?>

<section class="section" id="blogdetails">
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <div class="container">
        <div class="row" data-aos="fade-up">
            <div class="col-md-12">
                <p>&nbsp;</p>
                <h1><?php echo $row['title']; ?></h1>
                <p>___</p>
                <p>&nbsp;</p>
                <p class="smallfont">Date: <?php echo $row['date']; ?></p>
                <span style="text-align: left;">
                    <?php echo $row['text']; ?>
                </span>
                <p>&nbsp;</p>
            </div>
        </div>
        <?php
        printViewMore($url, "black"); ?>
    </div>
</section>


<?php include $dir."inc/bottom.php"; ?>
