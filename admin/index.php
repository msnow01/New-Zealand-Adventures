<?php
session_start();

$dir="../";
$pageredirect = "";
include "redirect-inc.php";

?>

<!DOCTYPE html>
<html lang="en">

<?php
include $dir."inc/header.php";
include $dir."inc/connection.php";
include $dir."inc/functions.php";
include $dir."inc/top.php";
?>

<section class="section" style="text-align: left">
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <div class="container">
        <div class="row">
            <a class="col-md-3 shadow block" href="blog-posts.php">
                <h1>Blog<br>Posts</h1>
                <p>&nbsp;</p>
                <i class="far fa-newspaper"></i>
            </a>
            <a class="col-md-3 shadow block" href="photo-gallery.php">
                <h1>Photo<br>Gallery</h1>
                <p>&nbsp;</p>
                <i class="fas fa-camera-retro"></i>
            </a>
            <a class="col-md-3 shadow block" href="travel-videos.php">
                <h1>Travel<br>Videos</h1>
                <p>&nbsp;</p>
                <i class="fas fa-film"></i>
            </a>
        </div>
        <div class="row">
            <a class="col-md-3 shadow block" href="days-travelled.php">
                <h1>Days<br>Travelled</h1>
                <p>&nbsp;</p>
                <i class="far fa-calendar-alt"></i>
            </a>
            <a class="col-md-3 shadow block" href="account-manager.php">
                <h1>Account<br>Manager</h1>
                <p>&nbsp;</p>
                <i class="fas fa-user-friends"></i>
            </a>
            <a class="col-md-3 shadow block" href="update-subscribers.php">
                <h1>Update<br>Subscribers</h1>
                <p>&nbsp;</p>
                <i class="far fa-paper-plane"></i>
            </a>
        </div>
    </div>
</section>
