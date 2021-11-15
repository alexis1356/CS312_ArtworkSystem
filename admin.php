<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin</title>
</head>
<body>
<ul id="navBar">
    <li><a href="index.html">Home</a></li>
    <li><a href="listart.php">Art Listing</a></li>
    <li><a href="trackAndTrace.html">Track & Trace</a></li>
    <li><a href="admin.php">Admin</a></li>
</ul>
<h1>Admin page</h1>
<?php
$password = "caraART21";
$enteredPassword = isset($_POST["pass"]) ? $_POST["pass"] : "";
if ($_SERVER["REQUEST_METHOD"] === "POST" && $password === $enteredPassword) {

    require_once "/home/cxb19183/DEVWEB/2021/functions/pass.php";

// connect to MySQL
    $host = "devweb2021.cis.strath.ac.uk";
    $user = "cxb19183";
    $password = get_cxb_19183_pass();
    $dbname = "cxb19183";
    $conn = new mysqli($host, $user, $password, $dbname);

    if ($conn->connect_error) {
        die();
    }
    $sql = "SELECT * FROM `ArtworkSystemOrders`";

    // Handle results
    $result = $conn->query($sql);
    if (!$result) {
        die();
    }

    if ($result->num_rows > 0) {
        echo "<table>\n";
        echo "<tr>\n";
        echo "<th>Width</th>\n";
        echo "<th>Height</th>\n";
        echo "<th>Postage</th>\n";
        echo "<th>E-mail</th>\n";
        echo "<th>Price(ex vat)</th>\n";
        echo "<th>Requested</th>\n";
        echo "</tr>\n";
        while ($row = $result->fetch_assoc()) {
            $post = $row["postage"];
            $days = (strtotime(date('Y/m/d h:i:s a', time())) - strtotime($row["time"])) / 86400;

            echo "<tr>\n";
            echo "<td>" . $row["width"] . "</td>\n";
            echo "<td>" . $row["height"] . "</td>\n";
            echo "<td>" . $row["postage"] . "</td>\n";
            echo "<td>" . $row["email"] . "</td>\n";
            echo "<td>" . $row["price"] . "</td>\n";
            echo "<td>" . $row["time"] . "</td>\n";
            echo "</tr>\n";

        }
        echo "</table>\n";
    }
} else { ?>
    <form action="getrequests.php" method="post">
        <p><label for="pass"></label><input type="text" id="pass" name="pass"/><input type="submit"></p>
    </form>
    <?php
}

//for adding art listings
//$sql = "INSERT INTO `ArtworkSystemArt` (`id`, `date`, `name`, `width`, `height`, `price`, `description`) VALUES (NULL, CURRENT_TIMESTAMP, '$name', '$width', '$height', '$price', '$description')";
?>

</body>
</html>