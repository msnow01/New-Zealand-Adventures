<?php
session_start();

$dir="";

include $dir."inc/connection.php";
$page = $_GET['page'];
if (!$page){
    $page = "/";
}

//login form functionality
if (isset($_POST['submit'])) {

    $error = FALSE;
    $email = stripslashes($_POST['email']);
    $pass = stripslashes($_POST['password']);
    $password = sha1($pass); //encrypt password

    $query = "SELECT * from NZuser WHERE email='".$email."' and password='".$password."' and approved='1'";
    $result = mysqli_query($link,$query);
    $rowcount = mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);

    // set session variable
    if ($rowcount == 1){
        $_SESSION['login_user'] = $row['email'];
        $_SESSION['login_type'] = $row['type'];
    } else {
        $error = TRUE;
    }

}

if (isset($_SESSION['login_user'])) {
    $location = "location: ".$page;
    header($location);
}

$space = "<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>";
include $dir."inc/header.php";
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
                <h1>Log In</h1>
                <p>___</p>
                <?php echo $privacynotice; ?>
                <form method="post" action="">
                    <?php
                    if ($error == TRUE){
                        echo '<div class="alert alert-danger" role="alert">Incorrect email or password. Please try again.<br>Please note that your account will not be active until it has been verified. Please wait for confirmation via email.</div>';
                    }
                    ?>
                    <p><label for="email">Email address: </label><input type="email" required class="form-control" name="email" id="email"></p>
                    <p><label for="password">Password: </label><input type="password" required class="form-control" name="password" id="password"></p>
                    <a href="forgot-password.php">Forgot password?</a>
                    <p class="smallfont">If you don't have an account, <a href="signup.php">sign up</a> now.</p>
                    <p><input class="btn btn-light shadow submit" type="submit" name="submit" id="submit" value="Log In"></p>
                </form>
            </div>
        </div>
    </div>
</section>
<p>&nbsp;</p>
<p>&nbsp;</p>
<?php include $dir."inc/bottom.php"; ?>
