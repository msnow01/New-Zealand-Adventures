<body>

<?php include $dir."inc/menu.php"; ?>

<!-- social media icons -->
<div class="social fixed-top" data-aos="fade-left">
    <?php include $dir."inc/social.php"; ?>
</div>

<!-- days travelled -->

<?php
$filename = $dir."admin/days-travelled-date.txt";
$myfilepointer = fopen($filename, "r") or die("Unable to open file!");
$start_date = fread($myfilepointer,filesize($filename));
fclose($myfilepointer);
$current_date = date("Y-m-d");
$datetime1 = strtotime($current_date);
$datetime2 = strtotime($start_date);
$secs = $datetime1 - $datetime2;
$days_travelled = $secs / 86400;
?>

<div class="black fixed-top shadow" data-aos="fade-left">
    <p>
        <span class="daysaway">Days Travelled</span>
        <span class="number"><?php echo number_format($days_travelled); ?></span>
    </p>
</div>
