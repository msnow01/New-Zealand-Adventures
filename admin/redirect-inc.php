<?php

if (!isset($_SESSION['login_user'])) {
    $location = "location: ".$dir."login.php?page=admin/".$pageredirect;
    header($location);
} else if ($_SESSION['login_type'] != 'admin') {
    $location = "location: ".$dir."login.php?page=admin/";
    header($location);
}

?>
