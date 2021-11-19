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
    <!--    add session token to memorize password-->
</ul>
<h1>Admin page</h1>
<?php
$password = "caraART21";
$enteredPassword = isset($_POST["pass"]) ? $_POST["pass"] : "";


if ($password === $enteredPassword) {

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

    ?>
<!-- TODO javascript checing to make sure that all fields are filled in-->
    <h3>Add a painting</h3>
    <form action="admin.php" method="post">
        <p><label for="paintingName">Name:</label><input type="text" id="paintingName" name="paintingName"/></p>
        <p><label for="width">Width:</label><input type="text" id="width" name="width"/></p>
        <p><label for="height">Height:</label><input type="text" id="height" name="height"/></p>
        <p><label for="price">Price:</label><input type="text" id="price" name="price"/></p>
        <p><label for="description">Description:</label><textarea id="description" name="description"></textarea></p>
    </form>
    <?php
    if ($result->num_rows > 0) {
        ?>
        <h3>Orders</h3>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Phone</th>
                <th>E-mail</th>
                <th>Address</th>
                <th>Painting name</th>
                <th>Painting ID</th>
            </tr>
            <?php
            while ($row = $result->fetch_assoc()) {
                echo "<tr>\n";
                echo "<td>" . $row["id"] . "</td>\n";
                echo "<td>" . $row["userName"] . "</td>\n";
                echo "<td>" . $row["phone"] . "</td>\n";
                echo "<td>" . $row["email"] . "</td>\n";
                echo "<td>" . $row["address"] . "</td>\n";
                echo "<td>" . $row["paintingName"] . "</td>\n";
                echo "<td>" . $row["paintingID"] . "</td>\n";
                echo "</tr>\n";
            }
            ?>
        </table>
        <?php
    }
} else { ?>
    <form action="admin.php" method="post">
        <p><label for="pass"></label><input type="text" id="pass" name="pass"/><input type="submit"></p>
    </form>
    <?php
}


//for adding art listings
//$sql = "INSERT INTO `ArtworkSystemArt` (`id`, `date`, `name`, `width`, `height`, `price`, `description`) VALUES (NULL, CURRENT_TIMESTAMP, '$name', '$width', '$height', '$price', '$description')";
?>

</body>
</html>