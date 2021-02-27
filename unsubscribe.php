<?php
session_start();

$dir="";

if (!isset($_SESSION['login_user'])) {
    $location = "location: ".$dir."login.php?page=unsubscribe.php";
    header($location);
}

$space = "<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>";
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
                <h1>Unsubscribe</h1>
                <p>___</p>

                <?php
                //subscribe form functionality
                if (isset($_POST['submit'])) {

                    $error = FALSE;
                    $email = stripslashes($_POST['email']);

                    //confirm subscription to logged in user
                    if ($_SESSION['login_user'] != $email){
                        $error = TRUE;
                        echo '<div class="alert alert-danger" role="alert">Sorry, you cannot unsubscribe another user. Please try again.</div>';
                    }

                    //confirm existing account
                    $query = "SELECT * from NZuser WHERE email='".$email."' and approved='1'";
                    $rowcount = mysqli_num_rows(mysqli_query($link,$query));
                    if ($rowcount < 1){
                        $error = TRUE;
                        echo '<div class="alert alert-danger" role="alert">Sorry, there is no account associated with this email address. Please <a href="signup.php">sign up</a> before unsubscribing.</div>';
                    }

                    if ($error == FALSE) {
                        $query = "UPDATE NZuser SET subscribed='0' WHERE email='".$email."' and approved='1'";
                        if (mysqli_query($link,$query)){
                            echo "<div class='alert alert-success'>You have been successfully unsubscribed!</div>";
                        } else {
                            echo "<div class='alert alert-danger'>Sorry, there was an error. Please try again later.</div>";
                        }
                    }
                }
                ?>

                <form method="post" action="">
                    <p>Unsubscribe from email notifications when new content is posted.</p>
                    <p><label for="email">Please confirm your email address: </label><input type="email" required class="form-control" name="email" id="email"></p>
                    <p class="smallfont">If you have not subscribed, you can <a href="subscribe.php">subscribe now</a>.</p>
                    <p><input class="btn btn-light shadow submit" type="submit" name="submit" id="submit" value="Subscribe"></p>
                </form>
            </div>
        </div>
    </div>
</section>
<p>&nbsp;</p>
<p>&nbsp;</p>
<?php include $dir."inc/bottom.php"; ?>
