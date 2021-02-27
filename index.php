<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<?php
$dir="";
$space = "<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>";
include $dir."inc/header.php";
include $dir."inc/connection.php";
include $dir."inc/functions.php";
include $dir."inc/top.php";
?>

<!-- background video -->
<video width="100%" muted loop autoplay playsinline>
    <source src="img/mountainvideo-sm.mp4" type="video/mp4"></source>
</video>

<!-- home -->
<section class="section" data-aos="fade-up" id="Home">
    <a id="Hometab"></a>
    <?php echo $space; ?>
    <?php echo $space; ?>
    <h1>New Zealand</h1>
    <h2>ADVENTURES</h2>
</section>

<!-- blog -->
<?php

listblog($dir);

listphoto($dir);

listvideo($dir);

include $dir."inc/bottom.php";

?>
