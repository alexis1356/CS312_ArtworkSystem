<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order</title>
    <link rel="stylesheet" href="styleSheet.css">
</head>
<body>
<nav id="navBar">
    <ul>
        <li><a href="index.html">Home</a></li>
        <li><a href="listart.php" class="active">Art Listing</a></li>
        <li><a href="trackAndTrace.php">Track & Trace</a></li>
    </ul>
</nav>
<h1>Place an Order</h1>
<?php

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
$name = isset($_POST["name"]) ? $conn->real_escape_string($_POST["name"]) : "";
$email = isset($_POST["email"]) ? $conn->real_escape_string($_POST["email"]) : "";
$phone = isset($_POST["phone"]) ? $conn->real_escape_string($_POST["phone"]) : "";
$address = isset($_POST["address"]) ? $conn->real_escape_string($_POST["address"]) : "";
$paintingID = isset($_POST["paintingID"]) ? $conn->real_escape_string($_POST["paintingID"]) : "";
$paintingName = isset($_POST["paintingName"]) ? $conn->real_escape_string($_POST["paintingName"]) : "";

//check if all fields contain values
if (empty($name) || empty($email) || empty($phone) || empty($address)) {
?>
<p>Please provide all details below</p>
<!--    //form for ordering art piece-->
<!--    //name phone number, email, postal address, show name and id of selected painting-->
<!--TODO Could implement grid over here-->

<form method="post">
    <label for="name">Name:</label><input type="text" id="name" name="name"/>
    <label for="phone">Phone number:</label><input type="text" id="phone" name="phone"/>
    <label for="email">Email:</label><input type="text" id="email" name="email"/>
    <label for="address">Postal address:</label><input type="text" id="address" name="address"/>
    <input type="submit" value="Order">
    <?php
    } else {
        $sql = "INSERT INTO `ArtworkSystemOrders` (`userName`, `phone`, `email`, `address`, `paintingName`, `paintingID`) VALUES ('$name', '$phone', '$email', '$address', '$paintingName', '$paintingID')";
        $result = $conn->query($sql);
        if (!$result) {
            die("Failed to insert.");
        } else {
            echo "Thank you for ordering my art. You will receive an email once it will be sent.";
        }
    }
    // Disconnect
    $conn->close();
    ?>
</body>
</html>