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
    <li><a href="admin.php">Admin</a></li>
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
<form action="processOrder.php" method="post">
    <table>
        <tr>
            <td for="name">Name:</td>
            <td><input type="text" id="name" name="name"/></td>
        </tr>
        <tr>
            <td for="phone">Phone number:</td>
            <td><input type="text" id="phone" name="phone"/></td>
        </tr>
        <tr>
            <td for="email">Email:</td>
            <td><input type="text" id="email" name="email"/></td>
        </tr>
        <tr>
            <td for="address">Postal address:</td>
            <td><input type="text" id="address" name="address"/></td>
        </tr>
        <tr>
            <td><input type="submit" value="Order"></td>
            <input type="hidden" id="paintingID" name="paintingID" value="<?php echo $paintingID; ?>">
            <input type="hidden" id="paintingName" name="paintingName" value="<?php echo $paintingName; ?>">
        </tr>
    </table>
</form>
</body>
</html>