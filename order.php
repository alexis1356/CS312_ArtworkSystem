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
$paintingID = isset($_GET['id']) ? strip_tags($_GET['id']) : "";
$paintingName = isset($_GET['name']) ? strip_tags($_GET['name']) : "";

echo "<h3>Selected painting ID is $paintingID and name is $paintingName. Please enter your details below.</h3>";
?>
<!--use grid and not table-->
<!-- TODO javascript checing to make sure that all fields are filled in-->
<form action="processOrder.php" method="post">
    <label for="name">Name:</label><input type="text" id="name" name="name"/>
    <label for="phone">Phone number:</label><input type="text" id="phone" name="phone"/>
    <label for="email">Email:</label><input type="text" id="email" name="email"/>
    <label for="address">Postal address:</label><input type="text" id="address" name="address"/>
    <input type="submit" value="Order">
    <input type="hidden" id="paintingID" name="paintingID" value="<?php echo $paintingID; ?>">
    <input type="hidden" id="paintingName" name="paintingName" value="<?php echo $paintingName; ?>">

</form>
</body>
</html>