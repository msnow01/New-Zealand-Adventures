<?php

$dir="";

include $dir."inc/header.php";
include $dir."inc/connection.php";
include $dir."inc/functions.php";
include $dir."inc/top.php";
?>

<section class="section" style="text-align: left">
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <div class="container">
        <div class="row" data-aos="fade-up">
            <div class="col-md-12">
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <h1>Forgot Password</h1>
                <p>___</p>

                <?php
                // form functionality
                if (isset($_POST['submit'])) {
                    $error = FALSE;
                    $emailaddress = stripslashes($_POST['email']);

                    //confirm existing account
                    $query = "SELECT * from NZuser WHERE email='".$emailaddress."' and approved='1'";
                    $rowcount = mysqli_num_rows(mysqli_query($link,$query));
                    if ($rowcount < 1){
                        $error = TRUE;
                        echo '<div class="alert alert-danger" role="alert">Sorry, there is no account associated with this email address. Please <a href="signup.php">sign up</a>.</div>';
                    }

                    if ($error == FALSE) {
                            $hashemail = sha1($emailaddress);
                            //send email
                            $to = $emailaddress;
                            $subject = "NZ Adventures - Password Reset";
                            $message = "<p>Hey! There was a request to reset your password.</p><p>If you didn't do this, don't worry, you can ignore this email.</p><p>If you did make this request, please click the following link to <a href='https://nzadventures.miriamsnow.com/password-reset.php?id=".$hashemail."' target='_blank'>reset your password</a>.</p><p>Thanks!</p><p>~ Miriam</p>";
                            $header = "From:noreply@miriamsnow.com \r\n";
                            $header .= "MIME-Version: 1.0\r\n";
                            $header .= "Content-type: text/html\r\n";
                            $retval = mail ($to,$subject,$message,$header);
                            if ($retval == TRUE) {
                                echo "<div class='alert alert-success'>Thank you! You have been sent an email with a link to reset your password.<br>Please check your spam folder if you do not receive an email within 30 minutes.</div>";
                            } else {
                                echo "<div class='alert alert-danger'>Sorry, there was an error sending an email to your account. Please try again later.</div>";
                            }
                    }
                }
                ?>
                <form method="post" action="">
                    <p><label for="email">Please confirm your email address: </label><input type="email" required class="form-control" name="email" id="email"></p>
                    <p><input class="btn btn-light shadow submit" type="submit" name="submit" id="submit" value="Submit"></p>
                </form>
            </div>
        </div>
    </div>
</section>
<p>&nbsp;</p>
<p>&nbsp;</p>
<?php include $dir."inc/bottom.php"; ?>
