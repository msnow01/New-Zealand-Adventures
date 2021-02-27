<?php
session_start();

$dir="../";
$pageredirect = "blog-posts.php";
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

$id = $_GET['id'];

?>

<section class="section">
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <p>&nbsp;</p>
                <h1>Blog Posts</h1>
                <a href="blog-posts.php">Back</a>&nbsp;
                <a href="/admin">Home</a>
                <p>&nbsp;</p>
                <?php
                if (isset($_POST['submit'])){
                    $date = $_POST['date'];
                    $title = addslashes($_POST['title']);
                    $text = addslashes($_POST['text']);

                    if ($id){
                    //UPDATE EXISTING BLOG
                        $query = "UPDATE NZblog SET title='".$title."', date='".$date."', text='".$text."' WHERE ID=".$id."";
                        if (mysqli_query($link,$query)){
                            echo "<div class='alert alert-success'>Successfully updated!</div>";
                        } else {
                            echo "<div class='alert alert-danger'>Sorry, there was an error. Please try again.</div>";
                        }
                    } else {
                        //INSERT NEW BLOG
                        $query = "INSERT INTO NZblog (title, date, text) VALUES ('".$title."', '".$date."', '".$text."')";
                        if (mysqli_query($link,$query)){
                            echo "<div class='alert alert-success'>Successfully added!</div>";
                        } else {
                            echo "<div class='alert alert-danger'>Sorry, there was an error. Please try again.</div>";
                        }
                    }
                }

                $query = "SELECT * from NZblog WHERE ID=".$id."";
                $row = mysqli_fetch_assoc(mysqli_query($link,$query));

                ?>
                <form method="post" style="text-align: left;">
                    <p>Date: <input type="date" value="<?php echo $row['date']; ?>" name="date"></input></p>
                    <p>Title: <input type="text" value="<?php echo $row['title']; ?>" name="title"></input></p>
                    <p><input type="submit" class="btn btn-light shadow" name="submit" value="Save"></input></p>
                    <p><textarea class="form-control" name="text"><?php echo $row['text']; ?></textarea></p>
                </form>
            </div>
        </div>
    </div>
</section>

<?php include "tiny.php"; ?>
