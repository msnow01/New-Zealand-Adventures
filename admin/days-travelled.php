<?php
session_start();

$dir="../";
$pageredirect = "days-travelled.php";
include "redirect-inc.php";

?>

<!DOCTYPE html>
<html lang="en">

<?php
$space = "<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>";
include $dir."inc/header.php";
include $dir."inc/connection.php";
include $dir."inc/functions.php";
include $dir."inc/top.php";
?>

<section class="section">
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <p>&nbsp;</p>
                <h1>Days Travelled</h1>
                <a href="/admin">Home</a>
                <p>&nbsp;</p>
                <?php
                if (isset($_POST['submit'])) {
                    $date = $_POST['date'];
                    $filepointer = fopen('days-travelled-date.txt', 'w');
                    fwrite($filepointer, $date);
                    fclose($filepointer);
                }

                $myfile = fopen("days-travelled-date.txt", "r") or die("Unable to open file!");
                $currentdate = fread($myfile,filesize("days-travelled-date.txt"));
                fclose($myfile);
                ?>

                <form method="post">
                    <p>Start Date: <input type="date" value="<?php echo $currentdate; ?>" name="date"></input></p>
                    <p><input type="submit" name="submit" value="Save"></input></p>
                </form>
            </div>
        </div>
    </div>
</section>
