<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Art Listing</title>
    <script>
        function order(id) {
            return window.location = "order.php?id=" + id;
        }
    </script>
</head>
<body>
<ul id="navBar">
    <li><a href="index.html">Home</a></li>
    <li><a href="listart.php">Art Listing</a></li>
    <li><a href="trackAndTrace.php">Track & Trace</a></li>
</ul>
<h1>Art Details</h1>
<?php
$paintingID= isset($_GET['id']) ? strip_tags($_GET['id']) : "";

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
$sql = "SELECT * FROM `ArtworkSystemArt` WHERE id = '$paintingID'";

// Handle results
$result = $conn->query($sql);
if (!$result) {
    die("No results were retrieved.");
}
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    ?>
    <div id="artDetails">
        <h5>ID</h5>
        <p><?php echo $row["id"];?></p>
        <h5>Name</h5>
        <p><?php echo $row["name"];?></p>
        <h5>Width <p>(mm)</p></h5>
        <p><?php echo $row["width"];?></p>
        <h5>Height <p>(mm)</p></h5>
        <p><?php echo $row["height"];?></p>
        <h5>Price</h5>
        <p><?php echo $row["price"];?></p>
        <h5>Description</h5>
        <p><?php echo $row["description"];?></p>
        <button onclick="location.href='order.php?id=<?php echo $row["id"]; ?>&name=<?php echo $row["name"]; ?>'">Order</button>
        <button onclick="location.href='listart.php'">Back</button>
    </div>
<?php
}

?>
</body>
</html>