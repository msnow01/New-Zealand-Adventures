<?PHP

//put db connection info below
$hostDB = "";
$userDB = "";
$passwordDB = "";
$databaseDB = "";

$link = mysqli_connect($hostDB, $userDB, $passwordDB, $databaseDB);

if (!$link) {
    echo "Error: Unable to connect to MySQL ".mysqli_connect_error();
} else {
   // echo "Successfully connected to DB!";
}

?>
