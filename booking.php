<!DOCTYPE html>
<html lang="en">
<head>
  <title>House Rental Management System</title>
  <meta charset="utf-8">
   <link rel="stylesheet" type="text/css" href="table.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">House Rental Management System</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="index.html">Home</a></li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="viewhouse.php">View Properties <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="viewproperty.php">Houses</a></li>
            <li><a href="review_rating.php">Rating</a></li>
          </ul>
        </li>
        <li><a href="landlord.php">Landlords</a></li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Properties<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="property.php">Properties</a></li>
            <li><a href="review_rating.php">Ratings</a></li>
          </ul></li>
        <li><a href="booking.php">Booking</a></li>
        
      </ul>
      <ul class="nav navbar-nav navbar-right">
      <li><a href="#"><span class="glyphicon glyphicon-user"></span>Hi <?php session_start();echo $_SESSION['uname'];?></a>
         </li>
        <li><a href="index.html"><span class="glyphicon glyphicon-user"></span> Sign Out</a></li>
      </ul>
    </div>
  </div>
</nav>

<?php
// Connect to the database (replace with your actual database credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "house_rental_system";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve available houses
$sql = "SELECT * FROM property WHERE  status = 'vacant'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Display the available houses in a table
    echo "<table border='1'>
            <tr>
                <th>Property ID</th>
                <th>Address</th>
                <th>Description</th>
                <th>Number of rooms</th>
                <th>Amenities</th>
                <th>rental_rate</th>
                <th>Action</th>
            </tr>";
          
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['id'] . "</td>
                <td>" . $row['address'] . "</td>
                <td>" . $row['description'] . "</td>
                <td>" . $row['number_of_rooms'] . "</td>
                <td>" . $row['amenities'] . "</td>
                <td>" . $row['rental_rate'] . "</td>
                <td><a href='booking.html? property_id=" . $row['id'] . "'>Book Now</a></td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "No available houses.";
}

// Close the database connection
$conn->close();
?>
</body>
</html>