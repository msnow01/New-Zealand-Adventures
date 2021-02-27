<?php

$dir="";

include $dir."inc/header.php";
include $dir."inc/connection.php";
include $dir."inc/functions.php";
include $dir."inc/top.php";

//get user from id in url
$hashemail = $_GET['id'];
if (!$hashemail){
    echo "<meta http-equiv='refresh' content='0;URL=/'>";
}
$query = "SELECT * FROM NZuser";
if ($result = $link->query($query)) {
    while ($row = $result->fetch_assoc()) {
        if ($hashemail == sha1($row['email'])){
            $therowid = $row['ID'];
        }
    }
}

?>

<section class="section" style="text-align: left">
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <div class="container">
        <div class="row" data-aos="fade-up">
            <div class="col-md-12">
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <h1>Password Reset</h1>
                <p>___</p>

            <?php
            if(isset($_POST['submit'])){
                $password = $_POST['password'];
                $password2 = $_POST['password2'];
                //check that both passwords match
                if ($password != $password2){
                    echo "<div class='alert alert-danger'>Sorry, passwords do not match. Please try again.</div>";
                } else if ($password == $password2){
                    //hash password and update db
                    $hashpass = sha1($password);
                    $query = "UPDATE NZuser SET password='".$hashpass."' WHERE ID='".$therowid."'";
                    if (mysqli_query($link,$query)){
                        echo "<div class='alert alert-success'>Your password has successfully been reset. Please <a href='login.php' title='go to log in form'>log in</a> again.</div>";
                    } else {
                        echo "<div class='alert alert-danger'>Sorry, there was an error. Please try again later.</div>";
                    }
                }
            }
            ?>
            <!-- password reset form -->
            <form action="" method="post">
                <p><label for="password">New password: </label><input type="password" name="password" id="password" class="form-control"></p>
                <p><label for="password2">Confirm password: </label><input type="password" name="password2" id="password2" class="form-control"></p>
                <p><script>function recaptchaCallback() {$('#submit').removeAttr('disabled');}</script>
                <script src="https://www.google.com/recaptcha/api.js" async defer></script>
                <div class="g-recaptcha" data-callback="recaptchaCallback" data-expired-callback="capcha_expired" data-sitekey="SITEKEY"></div></p>
                <p><input type="submit" class="submit btn btn-light shadow" name="submit" id="submit"></p>
            </form>
        </div>
    </div>
</div>
</section>
<p>&nbsp;</p>
<p>&nbsp;</p>
<?php include $dir."inc/bottom.php"; ?>
