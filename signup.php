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

<section class="section" style="text-align: left;">
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <div class="container">
        <div class="row" data-aos="fade-up">
            <div class="col-md-12">
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <h1>Sign Up</h1>
                <p>___</p>
                <?php echo $privacynotice; ?>

                <?php

                //sign up form functionality
                if (isset($_POST['submit'])) {
                    $error = FALSE;

                    $first = stripslashes($_POST['first']);
                    $last = stripslashes($_POST['last']);
                    $email = stripslashes($_POST['email']);
                    $pass = stripslashes($_POST['password']);
                    $password = sha1($pass); //encrypt password

                    //check for existing email
                    $querycheck = "SELECT * from NZuser WHERE email='".$email."'";
                    $rowcount = mysqli_num_rows(mysqli_query($link,$querycheck));
                    if ($rowcount > 0){
                        $error = TRUE;
                        echo "<div class='alert alert-danger'>Sorry, there is already an account associated with this email address.</div>";
                    }

                    //validate recapthca
                    $secretKey = 'SECRETKEY';
                    $captcha = $_POST['g-recaptcha-response'];
                    $ip = $_SERVER['REMOTE_ADDR'];
                    $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha."&remoteip=".$ip);
                    $responseKeys = json_decode($response,true);
                    if (!$captcha || (intval($responseKeys["success"]) !== 1)) {
                        $error = TRUE;
                        echo "<div class='alert alert-danger'>Please verify that you are not a robot.</div>";
                    }

                    if ($error == FALSE){
                        $query = "INSERT INTO NZuser (email, password, first, last, approved, type) VALUES ('".$email."', '".$password."', '".$first."', '".$last."', '0', 'user')";

                        if (mysqli_query($link,$query)){
                            $to = "EMAILADDRESS";
                            $subject = "NZ Adventures - New Sign Up";
                            $message = "<p>A new account has been created for the following contact:</p><p>Name: ".$first." ".$last."</p><p>Email: ".$email."</p><p><a href='https://nzadventures.miriamsnow.com/admin'>Account Manager</a></p>";
                            $header = "From:noreply@miriamsnow.com \r\n";
                            $header .= "MIME-Version: 1.0\r\n";
                            $header .= "Content-type: text/html\r\n";
                            $retval = mail ($to,$subject,$message,$header);
                            if ($retval == TRUE) {
                                echo "<div class='alert alert-success'>Thank you for signing up! You will be notified via email when your account has been verified.<br>Please check your spam folder if you do not receive an email within 3 business days.</div>";
                            } else {
                                echo "<div class='alert alert-danger'>Sorry, there was an error verifying your account. Please try again later.</div>";
                            }

                        } else {
                            echo "<div class='alert alert-danger'>Sorry, there was an error. Please try again later.</div>";
                        }
                    }
                }
                ?>

                <form method="post" action="">
                    <p><label for="first">First name: </label><input type="text" required class="form-control" name="first" id="first"></p>
                    <p><label for="last">Last name: </label><input type="text" required class="form-control" name="last" id="last"></p>
                    <p><label for="email">Email address: </label><input type="email" required class="form-control" name="email" id="email"></p>
                    <p><label for="password">Password: </label><input type="password" required class="form-control" name="password" id="password"></p>
                    <p class="smallfont">If you already have an account, <a href="login.php">log in</a> now.</p>
                    <p><script>function recaptchaCallback() {$('#submit').removeAttr('disabled');}</script>
                    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
                    <div class="g-recaptcha" data-callback="recaptchaCallback" data-expired-callback="capcha_expired" data-sitekey="SITEKEY"></div></p>
                    <p><input class="btn btn-light shadow submit" type="submit" name="submit" id="submit" disabled value="Sign Up"></p>
                </form>
            </div>
        </div>
    </div>
</section>
<p>&nbsp;</p>
<p>&nbsp;</p>
<?php include $dir."inc/bottom.php"; ?>
