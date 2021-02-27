<?php

function printViewMore($url, $color) {
echo '<div class="row">
    <div class="col-md-12">
        <div class="viewmore">
            <p><a class="viewmorelink" style="color: '.$color.'" href="'.$url.'">View More <i class="fa fa-arrow-right"></i></a></p>
        </div>
    </div>
</div>
</div>';
}

function listblog($dir) {
    include "connection.php";

    $home = FALSE;
    if ($dir == ""){
        $home = TRUE;
    }

    echo '<section class="section" id="Blog">';
        if ($home == TRUE){
            echo '<a id="Blogtab"></a>';
        }
        echo '<div class="container">
            <div class="row" data-aos="fade-up">
                <div class="col-md-12">
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                    <h1>BLOG POSTS</h1>
                    <p>___</p>
                    <p>&nbsp;</p>
                </div>
            </div>
            <div class="row" data-aos="fade-up">';
                if ($home == TRUE) {
                    $query = "SELECT * from NZblog ORDER BY date DESC LIMIT 6";
                } else {
                    $query = "SELECT * from NZblog ORDER BY date DESC";
                }
                if ($result = $link->query($query)) {
                    while ($row = $result->fetch_assoc()) {
                        $textcontent = strip_tags($row['text']);
                        $substr = explode(" ",$textcontent);
                        echo '<div class="col-md-4">';
                        echo '<h2><a style="color: black" href="'.$dir.'blog/details?id='.$row['ID'].'" class="viewmorelink">'.$row['title'].'</a></h2>';
                        echo '<span class="smallfont"><p>Date: '.$row['date'].'<br>';
                        for ($i=0; $i<25; $i++){
                            echo $substr[$i]." ";
                        }
                        echo '...</p></span>';
                        echo '<p>&nbsp;</p>';
                        echo '</div>';
                    }
                }
            echo '</div>';
            if ($home == TRUE) {
                printViewMore("blog", "black");
            }
        echo '</div>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
    </section>';
}

function printPhoto($photo, $caption, $date, $dir) {
    $modalid = explode(".", $photo);

    if ($dir != ""){
        echo '<a data-toggle="modal" data-target="#'.$modalid[0].'" href="#">';
    } else {
        echo '<a class="photolink" href="photo">';
    }

    echo '<img class="photo" src="'.$dir.'img/'.$photo.'">';
    echo '</a>';
    echo '<p class="caption">'.$caption.'<br>';
    echo '<span class="smallfont">Date: '.$date.'</span></p>';
}

function listphoto($dir) {

    $home = FALSE;
    if ($dir == ""){
        $home = TRUE;
    }

    include "connection.php";

    //CREATE ARRAYS FOR PHOTOS, CAPTIONS AND ALBUMS
    $photos = array();
    $captions = array();
    $dates = array();

    if ($home == TRUE){
        $query = "SELECT * from NZphoto WHERE home=1 ORDER BY date DESC";
    } else {
        $query = "SELECT * from NZphoto ORDER BY date DESC";
    }

    if ($result = $link->query($query)) {
        while ($row = $result->fetch_assoc()) {
            array_push($photos, $row['image']);
            array_push($captions, $row['caption']);
            array_push($dates, $row['date']);
        }
    }

    $photosCount = sizeof($photos);

    //MODALS FOR EACH PHOTO
    for ($i=0; $i<$photosCount; $i++){
        $modalid = explode(".", $photos[$i]);
        echo '<div class="modal fade" id="'.$modalid[0].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <img width="100%" src="'.$dir.'img/'.$photos[$i].'">
                    </div>
                </div>
            </div>
        </div>';
    }

    //PRINT OUT PHOTOS
    echo '<section class="section" id="Photo">';

        if ($home == TRUE){
            echo '<a id="Phototab"></a>';
        }

        echo '
        <div class="container">
            <div class="row" data-aos="fade-up">
                <div class="col-md-12">
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                    <h1>Photo Gallery</h1>
                    <p>___</p>
                    <p>&nbsp;</p>
                </div>
            </div>';

            //SORT INTO THREE COLUMNS
            echo '
            <div class="row" data-aos="fade-up">
                <div class="col-md-4">';

            for ($i = 0; $i < $photosCount; $i++) {
                if ($i%3 == 0){
                    printPhoto($photos[$i], $captions[$i], $dates[$i], $dir);
                }
            }

            echo '</div>
            <div class="col-md-4">';

            for ($i = 0; $i < $photosCount; $i++) {
                if ($i%3 == 1){
                    printPhoto($photos[$i], $captions[$i], $dates[$i], $dir);
                }
            }

            echo '</div>
            <div class="col-md-4">';

            for ($i = 0; $i < $photosCount; $i++) {
                if ($i%3 == 2){
                    printPhoto($photos[$i], $captions[$i], $dates[$i], $dir);
                }
            }

            echo '</div>
            </div>';

            if ($home == TRUE){
                printViewMore("photo", "white");
            }
        echo '</div>
    </section>';
}

function listvideo($dir) {

    include "connection.php";

    $home = FALSE;
    if ($dir == ""){
        $home = TRUE;
    }

    echo '
    <section class="section" id="Video">
        <a id="Videotab"></a>
        <div class="container">
            <div class="row" data-aos="fade-up">
                <div class="col-md-12">
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                    <h1>Travel Videos</h1>
                    <p>___</p>
                    <p>&nbsp;</p>
                </div>
            </div>';

            if ($home != TRUE){
                echo '<div class="row"><div class="col-md-12">';
                echo "<p class='smallfont'>Please do not share videos with other users. Content is private and intended for users with approved accounts only.</p><p>&nbsp;</p>";
                echo '</div></div>';
            }

            echo '<div class="row" data-aos="fade-up">';

            if($home == TRUE){
                $query = "SELECT * from NZvideo WHERE home=1 ORDER BY date DESC";
            } else {
                $query = "SELECT * from NZvideo ORDER BY date DESC";
            }

            $rowcount = mysqli_num_rows(mysqli_query($link,$query));
            if ($rowcount == 1){
                echo "<div class='col-md-3'></div>";
            }

            if ($result = $link->query($query)) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="col-md-6"><iframe ';
                    if ($home == TRUE){
                      echo ' class="photolink" ';
                    }
                    echo 'width="100%" height="300" src="https://www.youtube-nocookie.com/embed/'.$row['url'].'" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    <p style="text-align:left;" class="smallfont">Date: '.$row['date'].'</p>
                    </div>';
                }
            }

            if ($rowcount == 1){
                echo "<div class='col-md-3'></div>";
            }

            echo '</div>';

            if ($home == TRUE){
                printViewMore("video", "black");
            }

        echo '
        </div>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
    </section>';
}
?>
