<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order</title>
</head>
<body>
<ul id="navBar">
    <li><a href="index.html">Home</a></li>
    <li><a href="listart.php">Art Listing</a></li>
    <li><a href="trackAndTrace.html">Track & Trace</a></li>
</ul>
<h1>Place an Order</h1>
<?php
$paintingID = isset($_GET['id']) ? $_GET['id'] : "";

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
$sql = "SELECT `name` FROM `ArtworkSystemArt` WHERE `id` = $paintingID";

// Handle results
$result = $conn->query($sql);
if (!$result) {
    die("No results were retrieved.");
}
$paintingName = $result->fetch_assoc()["name"];
// Disconnect
$conn->close();

echo "<h3>Selected painting ID is $paintingID and name is  $paintingName</h3>";
?>
<!--use grid and not table-->
<!-- TODO javascript checing to make sure that all fields are filled in-->
<form action="processOrder.php" method="post">
    <p><label for="name">Name:<input type="text" id="name" name="name"/></label></p>
    <p><label for="phone">Phone number:<input type="text" id="phone" name="phone"/></label></p>
    <p><label for="email">Email:<input type="text" id="email" name="email"/></label></p>
    <p><label for="address">Postal address:<input type="text" id="address" name="address"/></label></p>
    <p><input type="submit" value="Order"></p>
    <input type="hidden" id="paintingID" name="paintingID" value="<?php echo $paintingID; ?>">
    <input type="hidden" id="paintingName" name="paintingName" value="<?php echo $paintingName; ?>">

</form>
</body>
</html>