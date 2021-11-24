<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Track&Trace</title>
</head>
<body>
<ul id="navBar">
    <li><a href="index.html">Home</a></li>
    <li><a href="listart.php">Art Listing</a></li>
    <li><a href="trackAndTrace.php">Track & Trace</a></li>
</ul>
<h1>Track&Trace</h1>
<?php
$name = isset($_POST['name']) ? $_POST['name'] : "";
$phone = isset($_POST['phone']) ? $_POST['phone'] : "";
$date = isset($_POST['date']) ? $_POST['date'] : "";

if (!empty($name) && !empty($phone) && !empty($date)) {
    require_once "/home/cxb19183/DEVWEB/2021/functions/pass.php";

// connect to MySQL
    $host = "devweb2021.cis.strath.ac.uk";
    $user = "cxb19183";
    $password = get_cxb_19183_pass();
    $dbname = "cxb19183";
    $conn = new mysqli($host, $user, $password, $dbname);

    if ($conn->connect_error) {
        die("Unable to connect to database.");
    }
    $sql = "INSERT INTO `ArtworkSystemTrack&Trace` (`id`, `name`, `phone`, `date`) VALUES (NULL, '$name', '$phone', '$date')";
    $result = $conn->query($sql);
    if (!$result) {
        die("Failed to book appointment.");
    }else{
        echo "Thank you for booking an appointment.";
    }
} else {
    ?>

    <form action="trackAndTrace.php" method="post" id="tackAndTrace">
        <p><label for="name">Name:<input type="text" id="name" name="name"/></label></p>
        <p><label for="phone">Phone number:<input type="text" id="phone" name="phone"/></label></p>
        <p><label for="date">Date:<input type="date" id="date" name="date"/></label></p>
        <p><input type="submit" value="Submit"></p>
    </form>
    <?php
}
?>
</body>
</html>
