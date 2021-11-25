<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Art Listing</title>
    <link rel="stylesheet" href="styleSheet.css">
    <script>
        function order(id) {
            return window.location = "order.php?id=" + id;
        }
    </script>
</head>
<body>
<nav id="navBar">
    <ul>
        <li><a href="index.html">Home</a></li>
        <li><a href="listart.php" class="active">Art Listing</a></li>
        <li><a href="trackAndTrace.php">Track & Trace</a></li>
    </ul>
</nav>
<h1>Art Details</h1>
<?php
$paintingID = isset($_GET['id']) ? strip_tags($_GET['id']) : "";

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
    $imageForDisplay = base64_encode($row["image"]);
    ?>
    <div id="artDetails">
        <img src="data:image/*;base64,<?php echo $imageForDisplay; ?>" alt="<?php echo $row["name"]; ?>">
        <table>
            <tr>
                <td><h5>ID</h5></td>
                <td><?php echo $row["id"]; ?></td>
            </tr>
            <tr>
                <td><h5>Name</h5></td>
                <td><?php echo $row["name"]; ?></td>
            </tr>
            <tr>
                <td><h5>Width (mm)</h5></td>
                <td><?php echo $row["width"]; ?></td>
            </tr>
            <tr>
                <td><h5>Height (mm)</h5></td>
                <td><?php echo $row["height"]; ?></td>
            </tr>
            <tr>
                <td><h5>Price (£)</h5></td>
                <td><?php echo $row["price"]; ?></td>
            </tr>
            <tr>
                <td><h5>Description</h5></td>
                <td><?php echo $row["description"]; ?></td>
            </tr>
        </table>
        <button onclick="location.href='order.php?id=<?php echo $row["id"]; ?>&name=<?php echo $row["name"]; ?>'">
            Order
        </button>
        <button onclick="location.href='listart.php'">Back</button>
    </div>
    <?php
}

?>
</body>
</html>