<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin</title>
    <link rel="stylesheet" href="styleSheet.css">
</head>
<body>
<nav id="navBar">
    <ul>
        <li><a href="index.html">Home</a></li>
        <li><a href="listart.php">Art Listing</a></li>
        <li><a href="trackAndTrace.php">Track & Trace</a></li>
        <li><a href="admin.php" class="active">Admin</a></li>
    </ul>
</nav>
<h1>Admin page</h1>
<?php
session_start();
$password = "caraART21";
$enteredPassword = isset($_POST["pass"]) ? $_POST["pass"] : "";
if ($password === $enteredPassword) {
    $_SESSION["pass"] = 1;
    //TODO add expiration?
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $_SESSION["pass"] = 0;
}

if ($_SESSION["pass"]) {

    require_once "/home/cxb19183/DEVWEB/2021/functions/pass.php";

// connect to MySQL
    $host = "devweb2021.cis.strath.ac.uk";
    $user = "cxb19183";
    $password = get_cxb_19183_pass();
    $dbname = "cxb19183";
    $conn = new mysqli($host, $user, $password, $dbname);

    if ($conn->connect_error) {
        die("Cannot connect to database.");
    }
// for adding new painting
    $name = isset($_POST["paintingName"]) ? $conn->real_escape_string($_POST["paintingName"]) : "";
    $width = isset($_POST["width"]) ? $conn->real_escape_string($_POST["width"]) : "";
    $height = isset($_POST["height"]) ? $conn->real_escape_string($_POST["height"]) : "";
    $price = isset($_POST["price"]) ? $conn->real_escape_string($_POST["price"]) : "";
    $description = isset($_POST["description"]) ? $conn->real_escape_string($_POST["description"]) : "";

    ?>
    <form method="post" id="addImage" enctype="multipart/form-data">
        <h3>Add a painting</h3>
        <?php

        // Add new painting
        if (!empty($name) && !empty($width) && !empty($height) && !empty($price) && !empty($description) && filesize($_FILES['myimage']['tmp_name'])) {
            $image = addslashes(file_get_contents($_FILES['myimage']['tmp_name']));
            $sqlAddPainting = "INSERT INTO `ArtworkSystemArt` (`id`, `date`, `name`, `width`, `height`, `price`, `description`, `image`) VALUES (NULL, CURRENT_TIMESTAMP, '$name', '$width', '$height', '$price', '$description', '$image')";
            $result1 = $conn->query($sqlAddPainting);
            if (!$result1) {
                die("Could not add a painting to the database.");
            }
        } else {
            echo "Please fill in all fields correctly.";
        }

        ?>
        <label for="paintingName">Name:</label><input type="text" id="paintingName" name="paintingName"/>
        <label for="width">Width:</label><input type="text" id="width" name="width"/>
        <label for="height">Height:</label><input type="text" id="height" name="height"/>
        <label for="price">Price:</label><input type="text" id="price" name="price"/>
        <label for="description">Description:</label><textarea id="description" name="description"></textarea>
        <input type="file" name="myimage" accept="image/*">
        <input type="submit" value="Submit">
    </form>
    <?php
    $sqlGetOrders = "SELECT * FROM `ArtworkSystemOrders`";
// Handle results
    $result = $conn->query($sqlGetOrders);
    if (!$result) {
        die("No results were retrieved.");
    }

    if ($result->num_rows > 0) {
        ?>
        <div class="adminTable">
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
        </div>
        <?php
        $sqlGetOrders = "SELECT * FROM `ArtworkSystemTrack&Trace`";
        // Handle results
        $result = $conn->query($sqlGetOrders);
        if (!$result) {
            die("No results were retrieved.");
        }
        if ($result->num_rows > 0) {
            ?>
            <div class="adminTable">
                <h3>Track & Trace bookings</h3>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Date</th>
                    </tr>
                    <?php
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>\n";
                        echo "<td>" . $row["id"] . "</td>\n";
                        echo "<td>" . $row["name"] . "</td>\n";
                        echo "<td>" . $row["phone"] . "</td>\n";
                        echo "<td>" . $row["date"] . "</td>\n";
                        echo "</tr>\n";
                    }
                    ?>
                </table>
            </div>
            <?php
            $conn->close();
        }
    }
} else { ?>
    <form action="admin.php" method="post" id="adminLogin">
        <label for="pass"></label><input type="text" id="pass" name="pass"/><input type="submit">
    </form>
    <?php

}
?>

</body>
</html>