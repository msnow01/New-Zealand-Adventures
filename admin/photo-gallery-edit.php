<?php
session_start();

$dir="../";
$pageredirect = "photo-gallery.php";
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
                <h1>Photo Gallery</h1>
                <a href="photo-gallery.php">Back</a>&nbsp;
                <a href="/admin">Home</a>
                <p>&nbsp;</p>
                <?php
                if (isset($_POST['submit'])){
                    $date = $_POST['date'];
                    $caption = addslashes($_POST['caption']);
                    $home = $_POST['home'];

                    if ($id){
                    //UPDATE EXISTING PHOTO
                        $query = "UPDATE NZphoto SET date='".$date."', caption='".$caption."', home='".$home."' WHERE ID=".$id."";
                        if (mysqli_query($link,$query)){
                            echo "<div class='alert alert-success'>Successfully updated!</div>";
                        } else {
                            echo "<div class='alert alert-danger'>Sorry, there was an error. Please try again.</div>";
                        }
                    } else {
                        //INSERT NEW PHOTO
                        $target_dir = $dir."img/";
                        $imageFileType = strtolower(pathinfo(basename($_FILES["image"]["name"]),PATHINFO_EXTENSION));
                        $current_date_file_name = date("mdyGis");
                        $newfilename = "image".$current_date_file_name.".".$imageFileType;
                        $target_file = $target_dir.$newfilename;

                        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                            $query = "INSERT INTO NZphoto (image, date, home, caption) VALUES ('".$newfilename."', '".$date."', '".$home."', '".$caption."')";
                            if (mysqli_query($link,$query)){
                                echo "<div class='alert alert-success'>Successfully added!</div>";
                            } else {
                                echo "<div class='alert alert-danger'>Sorry, there was an error. Please try again.</div>";
                            }
                        } else {
                            echo "<div class='alert alert-danger'>Sorry, there was an error uploading your file. Please try again.</div>";
                        }
                    }
                }

                $query = "SELECT * from NZphoto WHERE ID=".$id."";
                $row = mysqli_fetch_assoc(mysqli_query($link,$query));

                ?>
                <form method="post" style="text-align: left;" enctype="multipart/form-data">
                    <p>Date: <input type="date" value="<?php echo $row['date']; ?>" name="date"></input></p>
                    <p>Caption: <input type="text" value="<?php echo $row['caption']; ?>" name="caption"></input></p>
                    <?php
                    if (!$id){
                        echo '<p>Image: <input type="file" name="image"></input></p>';
                    }
                    ?>
                    <p>Home: <input type="checkbox" name="home" value="1"
                    <?php
                    if ($row['home'] == 1){
                        echo " checked ";
                    }
                    ?>
                    ></p>
                    <p><input type="submit" class="btn btn-light shadow" name="submit" value="Save"></input></p>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?php
                if ($id){
                    echo '<img src="'.$dir.'img/'.$row['image'].'" width="100%">';
                }
                ?>
            </div>
        </div>
    </div>
</section>
