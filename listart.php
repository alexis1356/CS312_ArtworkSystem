<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Art Listing</title>
    <script>
        //    document.getElementById("orderButton").onclick = function () {
        // let id = document.getElementById("orderButton").value;
        function order(id) {
            //    if (id) {
           return  window.location = "order.php?id=" + id;
            //     }

        }
    </script>
</head>
<body>
<ul id="navBar">
    <li><a href="index.html">Home</a></li>
    <li><a href="listart.php">Art Listing</a></li>
    <li><a href="trackAndTrace.html">Track & Trace</a></li>
</ul>
<h1>Art Listing</h1>
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
$sql = "SELECT * FROM `ArtworkSystemArt`";

// Handle results
$result = $conn->query($sql);
if (!$result) {
    die("No results were retrieved.");
}

if ($result->num_rows > 0) {
?>
<table>
    <tr>
        <th>Name</th>
        <th>Date</th>
        <th>Width(mm)</th>
        <th>Height(mm)</th>
        <th>Price</th>
        <th>Description</th>
        <th>ID</th>
        <th></th>
    </tr>
    <?php
    while ($row = $result->fetch_assoc()) {
        //  $days = strtotime($row["time"]) / 86400;

        echo "<tr>\n";
        echo "<td>" . $row["name"] . "</td>\n";
        echo "<td>" . $row["date"] . "</td>\n";
        echo "<td>" . $row["width"] . "</td>\n";
        echo "<td>" . $row["height"] . "</td>\n";
        echo "<td>" . $row["price"] . "</td>\n";
        echo "<td>" . $row["description"] . "</td>\n";
        echo "<td>" . $row["id"] . "</td>\n";
        echo "<td><button onclick='order(" . $row["id"] . ")'>Order</button></td>";
        echo "</tr>\n";

    }
    echo "</table>\n";
    }
    ?>
</body>
</html>