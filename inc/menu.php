<script>
$(window).scroll(function () {
        var position = $(this).scrollTop();
        $('.section').each(function() {
            var target = $(this).offset().top;
            var targetBot = target + $(this).height();
            var id = $(this).attr('id');
            $('nav a[data-id=' + id + ']').removeClass('hovered');
            if (position >= target && targetBot >= position) {
                $('nav a[data-id=' + id + ']').addClass('hovered');
            }
        });
});
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

 <nav class="navbar navbar-expand-lg shadow navbar-light bg-light fixed-top justify-content-between">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <?php
            $query = "SELECT * from NZmenu ORDER BY ID";
            if ($result = $link->query($query)) {
                while ($row = $result->fetch_assoc()) {
                    echo '<li class="nav-item">';
                    if (!isset($_SESSION['login_user'])) {
                        echo '<a href="'.$dir.'/#'.$row['title'].'tab" data-id="'.$row['title'].'" class="nav-link" title="'.$row['title'].'">';
                    } else {
                        echo '<a href="'.$dir.''.$row['title'].'" data-id="'.$row['title'].'" class="nav-link" title="'.$row['title'].'">';
                    }
                    echo $row['title'];
                    echo "</a></li>";
               }
           }
            ?>
        </ul>
        <span class="navbar-text">
            <?php
            if (!isset($_SESSION['login_user'])) {
                echo '<a href="'.$dir.'signup.php" class="btn btn-light shadow">Sign Up</a>';
                echo '<a class="btn btn-dark shadow" href="'.$dir.'login.php">Log In</a>';
            } else {
                echo '<a href="'.$dir.'subscribe.php" class="btn btn-light shadow">Subscribe</a>';
                echo '<a class="btn btn-dark shadow" href="'.$dir.'logout.php">Log Out</a>';
            }
            ?>
        </span>
    </div>
</nav>
