<?php

session_start();

$dir="../";

if (!isset($_SESSION['login_user'])) {
    $location = "location: ".$dir."login.php?page=video";
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

listvideo($dir);

include $dir."inc/bottom.php";

?>
