<?php
session_start();

$dir="../";
$pageredirect = "travel-videos.php";
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
                <h1>Travel Videos</h1>
                <a href="/admin">Home</a>
                <p>&nbsp;</p>
                <a href="travel-videos-edit.php" style="text-align: left !important;" class="btn btn-light shadow">Add Video</a>
                <p>&nbsp;</p>
                <table class="table table-striped">
                    <thead>
                    <tr>
                      <th scope="col">Date</th>
                      <th scope="col">Title</th>
                      <th scope="col">URL</th>
                      <th scope="col"></th>
                      <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php

                        if (isset($_POST['delete'])){
                            $identification = $_POST['identification'];

                            //DELETE QUERY
                            $query = "DELETE FROM NZvideo WHERE ID=".$identification;
                            if (mysqli_query($link,$query)){
                                echo "<div class='alert alert-success'>Successfully deleted!</div>";
                            } else {
                                echo "<div class='alert alert-danger'>Sorry, there was an error. Please try again.</div>";
                            }
                        }


                        $query = "SELECT * from NZvideo ORDER BY date DESC";
                        if ($result = $link->query($query)) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<tr>
                                  <td>'.$row['date'].'</td>
                                  <td>'.$row['title'].'</td>
                                  <td><a target="_blank" href="https://www.youtube-nocookie.com/embed/'.$row['url'].'">'.$row['url'].'</a></td>';
                                  echo '<td><a href="travel-videos-edit.php?id='.$row['ID'].'">Edit</a></td>';
                                  echo '<td>
                                      <form method="post">
                                          <input type="number" style="display:none" name="identification" value="'.$row['ID'].'"></input>
                                          <input type="submit" name="delete" value="Delete"></input>
                                      </form>
                                  </td>';
                                echo '</tr>';
                            }
                        }
                        ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</section>
