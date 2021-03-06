<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Art Listing</title>
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
<h1>Art Listing</h1>
<div id="artListing">
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
    $countRows = "SELECT count(*) FROM `ArtworkSystemArt`";
    $result = $conn->query($countRows);
    if (!$result) {
        die("Cannot count number of rows.");
    }
    $numberOfRows = $result->fetch_row()[0];


    $pagination = 12;
    //$lastpage = ceil($numberOfRows / $pagination);
    //$pageno = 0;
    //if ($pageno > $lastpage) {
    //    $pageno = $lastpage;
    //} // if
    //if ($pageno < 1) {
    //    $pageno = 1;
    //} // if
    //$limit = 'LIMIT ' . ($pageno - 1) * $pagination . ',' . $pagination;

    $sql = "SELECT * FROM `ArtworkSystemArt` ";

    // Handle results
    $result = $conn->query($sql);
    if (!$result) {
        die("No results were retrieved.");
    }

    if ($result->num_rows > 0) {
        echo "<table>";
        ?>

        <tr>
            <th></th>
            <th>Name</th>
            <th>Price</th>
            <th></th>
        </tr>
        <?php
        while ($row = $result->fetch_assoc()) {
            $imageForDisplay = base64_encode($row["image"]);
            echo "<tr>\n";
            echo "<td><img id='thumbNail' src='data:image/*;base64," . $imageForDisplay . " ' alt='" . $row["name"] . "'></td>";
            echo "<td>" . $row["name"] . "</td>\n";
            echo "<td>" . $row["price"] . "</td>\n";
            ?>
            <td>
                <button onclick="location.href='artDetails.php?id=<?php echo $row["id"]; ?>'">More</button>
            </td>
            </tr>
            <?php
        }
        echo "</table>\n";
    }
    ?>
</div>
</body>
</html>