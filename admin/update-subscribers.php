<?php
session_start();

$dir="../";
$pageredirect = "update-subscribers.php";
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
        <div class="row">
            <div class="col-md-12">
                <p>&nbsp;</p>
                <h1>Update Subscribers</h1>
                <a href="/admin">Home</a>
                <p>&nbsp;</p>

                <?php
                if (isset($_POST['submit'])){
                    $date = $_POST['date'];
                    $text = $_POST['text'];

                    $subject = "NZ Adventures - Subscriber Update";
                    $message = "<p>Date: ".$date."</p>".$text."<p>~ Miriam</p><p>If you no longer wish to receive updates, please <a href='https://nzadventures.miriamsnow.com/unsubscribe.php'>click here to unsubscribe</a>.</p>";
                    $header = "From:noreply@miriamsnow.com \r\n";
                    $header .= "MIME-Version: 1.0\r\n";
                    $header .= "Content-type: text/html\r\n";

                    $query = "SELECT * from NZuser WHERE approved='1' AND subscribed='1'";
                    if ($result = $link->query($query)) {
                        while ($row = $result->fetch_assoc()) {
                            $check = FALSE;
                            $check = mail($row['email'],$subject,$message,$header);
                            if ($check == TRUE) {
                              echo "Sent to ".$row['email']."<br>";
                            }
                        }
                    }
                }
                ?>

                <form method="post" style="text-align: left;">
                    <p>Date: <input type="date" name="date"></input></p>
                    <p><input type="submit" class="btn btn-light shadow" name="submit" value="Send"></input></p>
                    <p><textarea class="form-control" name="text"></textarea></p>
                </form>
            </div>
        </div>
    </div>
</section>

<?php include "tiny.php"; ?>
