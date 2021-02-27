<?php
session_start();

$dir="../";
$pageredirect = "account-manager.php";
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
                <h1>Account Manager</h1>
                <a href="/admin">Home</a>
                <?php

                $query = "SELECT * from NZuser WHERE approved='0'";
                if ($result = $link->query($query)) {
                    while ($row = $result->fetch_assoc()) {
                        $userid = $row['ID'];
                        $approveindex = "approve".$userid;
                        $denyindex = "deny".$userid;


                        //approve user
                        if (isset($_POST[$approveindex])){

                            $emailaddress = $_POST['email'];

                            $query = "UPDATE NZuser SET approved='1' WHERE ID='".$userid."'";
                            if (mysqli_query($link,$query)){

                                $to = $emailaddress;
                                $subject = "NZ Adventures - Account Verified";
                                $message = "<p>Hi there!</p><p>Thanks for signing up to NZ Adventures, your account has been verified.</p><p>You can now log in to get access to all content and subscribe to updates.</p><p></p><p>Don't forget to keep in touch!</p><p>~ Miriam</p>";
                                $header = "From:noreply@miriamsnow.com\r\n";
                                $header .= "MIME-Version: 1.0\r\n";
                                $header .= "Content-type: text/html\r\n";
                                $retval = mail ($to,$subject,$message,$header);
                                if ($retval == TRUE) {
                                    echo "<div class='alert alert-success'>Approved!</div>";
                                } else {
                                    echo "<div class='alert alert-warning'>Sorry, there was an error. Please try again.</div>";
                                }
                            } else {
                                echo "<div class='alert alert-warning'>Sorry, there was an error. Please try again.</div>";
                            }
                        }


                        if (isset($_POST[$denyindex])){
                            $query = "DELETE FROM NZuser WHERE ID='".$userid."'";
                            if (mysqli_query($link,$query)){
                                echo "<div class='alert alert-danger'>Denied!</div>";
                            } else {
                                echo "<div class='alert alert-warning'>Sorry, there was an error. Please try again.</div>";
                            }
                        }

                    }
                }

                ?>

                <p>&nbsp;</p>
                <table class="table table-striped">
                    <thead>
                    <tr>
                      <th scope="col">Status</th>
                      <th scope="col">First</th>
                      <th scope="col">Last</th>
                      <th scope="col">Email</th>
                      <th scope="col">Subscribed</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * from NZuser WHERE type!='admin' ORDER BY last ASC";
                        if ($result = $link->query($query)) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<tr>
                                  <td>';
                                  if ($row['approved'] == 1){
                                      echo "Approved";
                                  } else {
                                      echo "<form method='post'>
                                      <input type='email' style='display:none;' value='".$row['email']."' name='email' id='email'></input>
                                      <input type='submit' class='shadow btn btn-light' value='Approve' name='approve".$row['ID']."'></input>
                                      <input type='submit' class='shadow btn btn-dark' value='Deny' name='deny".$row['ID']."'></input>
                                      </form>";
                                  }

                                 echo '</td>
                                  <td>'.$row['first'].'</td>
                                  <td>'.$row['last'].'</td>
                                  <td>'.$row['email'].'</td><td>';

                                  if ($row['subscribed'] == 1){
                                      echo 'Yes';
                                  } else {
                                      echo 'No';
                                  }
                                 echo '</td></tr>';
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
